<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_survey');
		$this->load->model('M_master');
		$this->load->model('M_monitoring');
		date_default_timezone_set('Asia/Jakarta');
	}
	
	
	public function index()
	{
		$this->_auto_reset();
		 
		$this->load->view('index');
	}
	
	
	public function statistik()
	{
		$this->_auto_reset();
		$data = [
			'kepuasan' 		=> $this->_get_kepuasan(),
			'loket'			=> $this->M_master->getall('unit')->num_rows(),
			'pendidikan'	=> $this->_get_pendidikan(),
			'pekerjaan'		=> $this->_get_pekerjaan(),
			'pengunjung' 	=> $this->M_survey->get_responden(),
			'hasil'			=>  $this->_get_hasil(),
			 
		];
		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan > 81.25 && $kepuasan < 100 ) {
			$index = "Sangat Baik";
		}else if($kepuasan > 62.50 && $kepuasan < 81.26){
			$index = 'Baik';
		}else if($kepuasan > 43.75 && $kepuasan < 62.51){
			$index = 'Kurang Baik';
		} else if($kepuasan > 24.9 && $kepuasan < 43.76){
			$index = 'Tidak Baik';
		} else {
			$index = null;
		}

		$data['tingkat_kepuasan'] = $index;
		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('pertanyaan')->result();
		$hasil = array();
		$rata  = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'id_pertanyaan'	=> $v->id_pertanyaan,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan($v->id_pertanyaan,'d'),
				'p'			=> $this->_get_rataan($v->id_pertanyaan,'c'),
				'tp'		=> $this->_get_rataan($v->id_pertanyaan,'b'),
				'kec'		=> $this->_get_rataan($v->id_pertanyaan,'a'),
				'kepuasan'	=> $this->_get_nilai($v->id_pertanyaan)
			];

			$rata[$no] = [

			];
			$no++;
		}
		$data['rekap'] = $hasil;
		$bulan = 'setahun'; $tahun = date('Y'); 
		$data['unit'] = $this->_get_unit($bulan,$tahun);
		
		//echo json_encode($data['hasil']);
		$this->load->view('statistik',$data);
	}


	
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
	
	
	
	public function faq()
	{
		$this->_auto_reset();
		$data = [
			  
			'faq'			=> $this->M_master->getall('faq')->result(),
		];
	 
		$this->load->view('faq',$data);
	}
	


	public function news()
	{
		$this->_auto_reset();
		
		 
	     $query = $this->db->query('select * from news order by id asc limit 0,4');
		
		
		$data = [ 
			'newss'			=> $query->result(),
		];
		 
		$this->load->view('news',$data);
	}
	


	public function dataunitlayanan()
	{
	 
			$data = [ 
				 
				'units'			=> $this->M_master->getall('unit')->result(),
				 
			];
			$this->load->view('form_unit_layanan', $data);
			 
		 
	}
	
	
	function fetch_pelayanan()
	 {
		 //$unit_id = $this->uri->segment(3);
		 $unit_id = $this->input->post('unit_id');
		 
	  $this->db->where('id_unit', $unit_id);
	  $this->db->order_by('id_pelayanan', 'ASC');
	  $query = $this->db->get('pelayanan');
	  $output = '<option value="">-- Pilih Pelayanan -- </option>';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->id_pelayanan.'">'.$row->nama_pelayanan.'</option>';
	  }
	  echo $output;
	}
	
	function post_datalayanan()
	 {
		 $idunit = $this->input->post('unit');
		 $idpelayanan = $this->input->post('pelayanan');
		 
		 if($this->session->userdata('ses_id')!="") {
			 $data = [ 
				'id_unit'		=> $idunit,
				'id_pelayanan'	=> $idpelayanan, 
			];
			
			$this->db->where('id_responden',$this->session->userdata('ses_id'));
			$this->db->update('responden', $data);
		 }
		 $this->session->set_userdata('ses_idunit',$idunit);
		 $this->session->set_userdata('ses_idpelayanan',$idpelayanan);
		 redirect('survey/pertanyaan','refresh');
	}
 
	

	public function dataresponden()
	{
		 
			$data = [ 
				'pekerjaan'		=> $this->M_master->getall('pekerjaan')->result(),
				'pendidikan'	=> $this->M_master->getall('pendidikan')->result(),
				'units'			=> $this->M_master->getall('unit')->result(),
			];
			$this->load->view('form_data_responden', $data);
			 
		 
	}



	function post_detil_responden()
	{
		  
		if($this->session->userdata('ses_id')=="") {
			$data = [ 
				'email'	=> $this->input->post('email'),
				'nama'			=> $this->input->post('nama'),
				'umur'			=> $this->input->post('umur'),
				'jk'			=> $this->input->post('jk'),
				'pekerjaan'		=> $this->input->post('pekerjaan'),
				'pendidikan'	=> $this->input->post('pendidikan'), 
				'created_date'	=> date("Y-m-d H:i:s"), 
			];
			
		  $this->db->insert('responden', $data);
		  $idresponden = $this->db->insert_id();  
		  
		  $this->session->set_userdata('ses_id',$idresponden);
		  $this->session->set_userdata('ses_nama',$this->input->post('nama'));
		  $this->session->set_userdata('ses_email',$this->input->post('email'));
		  $this->session->set_userdata('ses_umur',$this->input->post('umur'));
		  $this->session->set_userdata('ses_jk',$this->input->post('jk'));
		  $this->session->set_userdata('ses_pekerjaan',$this->input->post('pekerjaan'));
		  $this->session->set_userdata('ses_pendidikan',$this->input->post('pendidikan'));
		} else {
			$where = [ 
				'id_responden'	=> $this->session->userdata('ses_id'), 
			];
			$data = [ 
				'email'	=> $this->input->post('email'),
				'nama'			=> $this->input->post('nama'),
				'umur'			=> $this->input->post('umur'),
				'jk'			=> $this->input->post('jk'),
				'pekerjaan'		=> $this->input->post('pekerjaan'),
				'pendidikan'	=> $this->input->post('pendidikan'), 
				'created_date'	=> date("Y-m-d H:i:s"), 
			];
			 
		  $this->M_master->update('responden', $where, $data);
		}
		  redirect('survey/dataunitlayanan','refresh');
	}


	public function pertanyaan()
	{
		 
			$data['nsoal'] 		= $this->M_survey->getSoal()->num_rows();
			$data['soal']		= $this->M_survey->getSoal()->result();
			$data['noreg'] 		= $this->session->userdata('ses_id');
			 
			
			$this->load->view('form_pertanyaan', $data);
		 
		
	}



	function get_soal($param)
	{
		$data	= $this->M_survey->getSoal()->result();

		echo json_encode($data[$param]);
	}
	
	

	function getSoalCount()
	{
		$data	= $this->M_survey->getSoal()->num_rows();
		echo json_encode($data);
	}



	function jawaban()
	{
		$data = [ 
			'id_responden'	=>  $this->session->userdata('ses_id'),
			'id_pertanyaan'		=> $this->input->post('id_pertanyaan'),
			'jawaban'		=> $this->input->post('jawaban'),
			'created_date'		=> date("Y-m-d H:i:s"),
		];

		$cek_soal = $this->M_master->getWhere('jawaban_sementara',['id_pertanyaan' => $this->input->post('id_pertanyaan')])->num_rows();
		if ($cek_soal>0) {
			$cek 	= $this->M_master->update('jawaban_sementara',['id_pertanyaan' => $this->input->post('id_pertanyaan')],$data);
			if($cek){
				echo json_encode(array(
					'hasil' => 'berhasil'
				));
			} 
			else {
				echo json_encode(array(
					'hasil' => 'gagal'
				));
			}
		}
		else
		{
			$cek 	= $this->M_survey->save('jawaban_sementara',$data);
			if($cek){
				echo json_encode(array(
					'hasil' => 'berhasil'
				));
			} 
			else {
				echo json_encode(array(
					'hasil' => 'gagal'
				));
			}
		}
		
	}
	
	

	function upload_jawaban()
	{
		$id 	= $this->session->userdata('ses_id');
		$saran 	= $this->input->post('saran');

		$jawaban = $this->M_master->getWhere('jawaban_sementara',['id_responden' => $id])->result();
		
		if($saran!="") {
			$data_saran = [
				'id_responden'	=> $id,
				'saran'			=> $saran,
				'created_date'	=> date("Y-m-d H:i:s"),
			];
			
			$this->M_master->input('saran',$data_saran);
		}
		
		$cek 	= $this->M_survey->save_batch($jawaban);
		if($cek){
			$this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
			
			$this->session->sess_destroy();
			
			echo json_encode(array(
				'hasil' => 'berhasil'
			));
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}



	function saran($id_responden)
	{
		$data['responden'] =  $this->session->userdata('ses_id');
		$this->load->view('saran', $data);
	}



	function publish_jawaban($id_responden)
	{
		$where = ['published' => '1','id_responden' => $id_responden];
		$jawaban = $this->M_master->getWhere('jawaban',$where)->result();
		
		$publish 	= $this->M_survey->update('jawaban',$where,['published' => '2']);
		if(!$publish){
			redirect('survey','refresh');
		} 
		else {
			echo json_encode(array(
				'hasil' => 'gagal'
			));
		}
	}



	function reset($id)
	{
		$id= $this->session->userdata('ses_id');
		$this->M_master->delete('jawaban_sementara',['id_responden' => $id]);
		$this->M_master->delete('responden',['id_responden' => $id]);
		redirect('survey','refresh');
	}

	//private function
	private function _get_hasil()
	{
		$sangat_puas 	= $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'd'])->num_rows();
		$puas 		 	= $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'c'])->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'b'])->num_rows();
		$kecewa 		= $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'a'])->num_rows();

		$all = $sangat_puas+$puas+$tidak_puas+$kecewa;

		if($all != 0)
		{
			$data = [
				[
					'name' 	=> 'sangat_puas',
					/*'y'		=> floatval(number_format(($sangat_puas/$all)*100,2)),*/
					'y'		=> $sangat_puas,
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					/*'y'		=> floatval(number_format(($puas/$all)*100,2)),*/
					'y'		=> $puas,
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					/*'y'		=> floatval(number_format(($tidak_puas/$all)*100,2)),*/
					'y'		=> $tidak_puas,
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
					/*'y'		=> floatval(number_format(($kecewa/$all)*100,2)),*/
					'y'		=> $kecewa,
					'color' => 'red'
				]
			];
			return $data;
		}
		else
		{
			return null;
		}	
	}



	private function _get_kepuasan()
	{
		$total = $this->M_master->getall('jawaban')->num_rows();
		$soal = $this->M_master->getall('pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'a'])->num_rows();
		$b = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'b'])->num_rows();
		$c = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'c'])->num_rows();
		$d = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'd'])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4*$soal);
			return number_format(($kepuasan*100),2);
		}
		return 0;
	}
	
	

	private function _get_nilai($id)
	{
		$total = $this->M_master->getall('jawaban')->num_rows();
		$soal = $this->M_master->getall('pertanyaan')->num_rows();
		$total_responden = $this->M_survey->get_responden();
		$a = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'a','id_pertanyaan' => $id])->num_rows();
		$b = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'b','id_pertanyaan' => $id])->num_rows();
		$c = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'c','id_pertanyaan' => $id])->num_rows();
		$d = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => 'd','id_pertanyaan' => $id])->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden);
			return number_format($kepuasan,2);
		}
		return 0;
	}

	private function _get_rataan($id_pertanyaan,$jawaban)
	{
		$total_responden = $this->M_survey->get_responden();
		$data = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => $jawaban,'id_pertanyaan' => $id_pertanyaan])->num_rows();
		return $data;
	}

	private function _get_pendidikan()
	{
		$pendidikan = $this->M_master->getall('pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->M_survey->join_get_responden_2('pendidikan',$p->pendidikan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}


	private function _get_pekerjaan()
	{
		$pekerjaan = $this->M_master->getall('pekerjaan')->result();
		$no = 1;
		foreach ($pekerjaan as $p) {
			$hasil[$no] = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> $this->M_survey->join_get_responden_2('pekerjaan',$p->pekerjaan)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}
	

	private function _auto_reset()
	{
		$this->db->where('HOUR(created_date) < ', date('H'));
		$this->db->or_where('DAY(created_date) ', date('d'));
		$this->db->delete('jawaban_sementara');
	}




	/*admin page*/
	function admin()
	{
		$this->load->view('sesi/header');
		$this->load->view('admin/auth');
		$this->load->view('sesi/script');
	}	

	function auth()
	{
		$data = [
			'username'		=> $this->input->post('username') ,
			'password'		=> md5($this->input->post('password')),
		];

		$cek = $this->M_survey->auth($data)->num_rows();
		//echo json_encode($cek);
		if($cek>= 1){
			$user = $this->M_survey->auth($data)->row();
			$this->session->set_userdata('ses_username',$user->username);
			$this->session->set_userdata('ses_id',$user->id_admin);
			$this->session->set_userdata('ses_namalengkap',$user->nama_lengkap);
			$this->session->set_userdata('ses_foto',$user->foto);
			redirect('admin','refresh');
		}
		else{
			$this->session->set_flashdata('error', 'username atau password salah');
			redirect('survey/admin','refresh');
		}
	}

	function errorpage()
	{
		$this->load->view('404');
	}

}

/* End of file Tema.php */
/* Location: ./application/modules/tema/controllers/Tema.php */