<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_monitoring');
	}
	
	
	public function index($bulan='setahun', $tahun=false, $cetak = null)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		if ($bulan == 'setahun') {
			$tahun = date('Y');
		}
		if($this->uri->segment(3)!="") {
			$bulan =$this->uri->segment(3);
		}
		
		if($this->uri->segment(4)!="") {
			$tahun =$this->uri->segment(4);
		}
		
		

		$data = [
			'title'			=> 'Monitoring ',
			'sub'			=> '',
			'icon'			=> 'fa-user-circle',
			'unit'			=> $this->_get_unit($bulan,$tahun),
			'total_responden' 	=> $this->M_monitoring->responden($tahun, $bulan),
			'menu'			=> 'monitoring',
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'tahun'			=> $this->M_master->getall('tahun')->result(),
		];

		
		if ($cetak != null) {
			$this->load->view('cetakLaporan', $data);
		}
		else
		{
			$this->template->load('tema/index','monitoring',$data);
		}
	}


	 
	function kecewa($id_pertanyaan,$bulan,$tahun,$pilihan)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		/*Mengetahui Pertanyaan by id soal*/
		$pertanyaan = $this->M_master->getWhere('pertanyaan',['id_pertanyaan'=> $id_pertanyaan])->row();
		$kategori 	= $pertanyaan->kategori;

		/*MEnghitung jumlah Jawaban*/
		$no = 1;
		$rekap = array();
		$unit = $this->M_monitoring->get_pilihan($id_pertanyaan,$bulan,$tahun,
			$pilihan)->result();

		if (count($unit)>0) {
			foreach ($unit as $unit) {
				$rekap[$no] = [
					'id_unit'		=> $unit->id_unit,
					'id_pertanyaan'		=> $unit->id_pertanyaan,
					'nama_unit'	=> $unit->nama_unit,
					'jumlah'		=> $this->M_monitoring->get_hasil_pilihan($id_pertanyaan,$bulan,$tahun,
						$pilihan,$unit->id_unit)->num_rows()
				];

				$no++;
			}
		}

		/*sub Menu*/
		if ($pilihan == 'a') {
			$jenis = 'Kecewa';
		} else if ($pilihan == 'b') {
			$jenis = 'Kurang Puas';
		}  else if ($pilihan == 'c') {
			$jenis = 'Puas';
		}  else if ($pilihan == 'd') {
			$jenis = 'Sangat Puas';
		}

		$data = [
			'title'			=> 'Unit',
			'sub'			=> 'Jawaban '.$jenis,
			'icon'			=> 'fa-user-circle',
			'menu'			=> 'unit',
			'kategori'		=> $kategori,
			'bulan'			=> $bulan,
			'bulan_indo'	=> $this->M_master->tglindo($bulan),
			'tahun'			=> $tahun,
			'rekap'			=> $rekap
		];
		//echo json_encode($data);
		$this->template->load('tema/index','pilihan_unit',$data);
	}



	/*PRIVATE FUNCTION*/
	//unit
	private function _get_unit($bulan,$tahun)
	{
		$unit = $this->M_master->getall('unit')->result();
		$no = 1;
		foreach($unit as $unit)
		{
			$data[$no] = [
				'nama_unit'	=> $unit->nama_unit,
				'id_unit'		=> $unit->id_unit,
				'responden'		=> $this->M_monitoring->get_responden_by_unit($unit->id_unit,$bulan,$tahun)->num_rows(),
				'nilai'			=> $this->_get_nilai_unit($unit->id_unit,$bulan,$tahun)
			];
			$no++;
		}
		sort($data);
		return $data;
	}

	private function _get_nilai_unit($id,$bulan,$tahun)
	{
		$data 		= $this->M_monitoring->get_nilai_unit($id,$bulan,$tahun)->result();

		$responden 	= $this->M_monitoring->get_responden_by_unit($id,$bulan,$tahun)->num_rows();
		$total_soal	= $this->M_master->getall('pertanyaan')->num_rows();

		$no = 1;
		$total = 0;
		foreach($data as $data)
		{
			if ($data->jawaban == 'd') {
				$n = 4;;
			}
			else if($data->jawaban == 'c')
			{
				$n = 3;
			}
			else if ($data->jawaban == 'b') {
				$n = 2;
			}
			else
			{
				$n = 1;
			}
			$nilai[$no] = [
				'jawaban' => $n
			];
			$total += $nilai[$no]['jawaban'];
			$no++;
		}

		$nilai_max = $total_soal*4*$responden;
		if ($responden > 0) {
			$kepuasan = ($total/$nilai_max)*100;
		}
		else{
			$kepuasan = 0;
		}

		return $kepuasan;
	}

}

/* End of file Unit.php */
/* Location: ./application/modules/unit/controllers/Unit.php */