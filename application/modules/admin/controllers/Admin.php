<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_admin');

		date_default_timezone_set("Asia/Bangkok");

		//cek session
		if ($this->session->userdata('ses_id') == null) {
			redirect('survey/admin','refresh');
		}
	}




	/*FILTER*/
	function index($bulan = 'setahun',$tahun = false)
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
			'title'			=> 'Dashboard',
			'sub'			=> '',
			'tahun'			=> $this->M_master->getall('tahun')->result(),
			'bulan'			=> $this->M_master->getall('bulan')->result(),
			'icon'			=> 'clip-home-3',
			'f_bulan'		=> $bulan,
			'f_tahun'		=> $tahun,
			'soal'			=> $this->M_admin->getSoal()->result(),
			'kepuasan' 		=> $this->_get_kepuasan_filter($bulan,$tahun),
			'pendidikan'	=> $this->_get_pendidikan_filter($bulan,$tahun),
			'pekerjaan'		=> $this->_get_pekerjaan_filter($bulan,$tahun),
			'pengunjung' 	=> $this->M_master->get_responden_filter($bulan,$tahun),
			'hasil'			=> $this->_get_hasil_filter($bulan,$tahun),
			'responden'		=> $this->M_master->get_responden_filter($bulan,$tahun),
			's_publish'		=> $this->M_master->getall('unit')->num_rows(),
			'b_publish'		=> $this->M_admin->get_blm_publish($bulan,$tahun)->num_rows(),
			'menu'			=> 'Dashboard'
		];

		//menentukan tingkat kepuasan
		$kepuasan = $data['kepuasan'];
		if ($kepuasan >88.31){
			$mutu = 'A';
			$index = "Sangat Baik";
		}else if($kepuasan > 76.61){
			$mutu = 'B';
			$index = 'Baik';
		}else if($kepuasan > 65.00){
			$mutu = 'C';
			$index = 'Kurang Baik';
		}
		else if($kepuasan > 25.00 ) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		}
		else {
			$mutu = null;
			$index = null;
		}
		$data['tingkat_kepuasan']	= $index;
		$data['mutu'] 				= $mutu;
		$data['sub'] 				= 'Statistik';
		 

		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('pertanyaan')->result();
		$hasil = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'kepuasan'	=> $this->_get_nilai_filter($v->id_pertanyaan,$bulan,$tahun),
				'id_pertanyaan'	=> $v->id_pertanyaan,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'d', $bulan,$tahun),
				'p'			=> $this->_get_rataan_filter($v->id_pertanyaan,'c', $bulan,$tahun),
				'tp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'b', $bulan,$tahun),
				'kec'		=> $this->_get_rataan_filter($v->id_pertanyaan,'a', $bulan,$tahun),
			];
			$no++;
		}
		sort($hasil);

		$data_short = $this->_get_prioritas($hasil);
		sort($data_short);
		$data['rekap'] 	= $data_short;
		//echo json_encode($data['kepuasan']);
		$this->template->load('tema/index','index',$data);
	} 





	/*ADMIN*/
	function edit_admin()
	{
		$id = $this->session->userdata('ses_id');
		if ($id == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'title'			=> 'Edit User',
			'sub'			=> '',
			'icon'			=> 'fa-pencil',
			'admin'			=> $this->M_master->getWhere('admin',['id_admin' => $id])->row(),
			'menu'			=> 'edit_admin'
		];

		$this->template->load('tema/index','edit_admin',$data);
	}

	function update_admin()
	{
		$id = $this->session->userdata('ses_id');
		if ($id == null) {
			redirect('survey/admin','refresh');
		}

		$password 	= $this->input->post('password');
		$password2	= $this->input->post('password2');


		if ($password != $password2) {
			$this->session->set_flashdata('error', 'password dan ulang password tidak sama');
			redirect('admin/edit_admin','refresh');
		}

		$where = ['id_admin' => $id];
		$data  = [
			'username'	=> $this->input->post('username'),
			'password'	=> md5($password),
			'nama_lengkap'	=> $this->input->post('nama_lengkap')
		];

		$cek = $this->M_master->update('admin',$where,$data);
		if(!$cek){
			$this->session->set_flashdata('success', 'Data berhasil diupdate, Silahkan login ulang untuk melihat perubahan');
			redirect('admin/edit_admin','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'update data gagal..');
			redirect('admin/edit_admin','refresh');
		}
	}





	/*PERTANYAAN*/
	function pertanyaan()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		
	 

		$data = [
			'title'		=> 'Survey',
			'sub'		=> 'Kelola Pertanyaan Survey',
			'icon'		=> 'clip-home-3',
			'soal'		=> $this->M_admin->getSoal()->result(),
			'menu'		=> 'pertanyaan'
		];
		$this->template->load('tema/index','pertanyaan',$data);
	}


	function detilpertanyaan($id)
	{
		$data = $this->M_master->getWhere('pertanyaan',['id_pertanyaan' => $id])->row();
		echo json_encode($data);
	}


	function addpertanyaan()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d'),
			'id_pertanyaan' 	=> $this->input->post('id_pertanyaan')
		];

		$cek = $this->M_master->getWhere('pertanyaan',['id_pertanyaan' => $this->input->post('id_pertanyaan')])->num_rows();
		if ($cek > 0) {
			$this->session->set_flashdata('error', 'Nomor Pertanyaan Sudah Terdaftar, Silahkan Ganti Nomor atau Edit Nomor Pertanyaan Yang Sudah Ada...');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{			
			$cek = $this->M_master->input('pertanyaan',$data);
			if (!$cek) {
				$this->session->set_flashdata('success', 'Data Updated');
				redirect('admin/pertanyaan','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Error...');
				redirect('admin/pertanyaan','refresh');
			}
		}

	}
	

	function updatepertanyaan()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$where = ['id_pertanyaan' => $this->input->post('id_pertanyaan')];
		$data = [
			'soal'		=> $this->input->post('pertanyaan'),
			'kategori'	=> $this->input->post('kategori'),
			'a'			=> $this->input->post('a'),
			'b'			=> $this->input->post('b'),
			'c'			=> $this->input->post('c'),
			'd'			=> $this->input->post('d')
		];
		$cek = $this->M_master->update('pertanyaan',$where,$data);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data inserted');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan','refresh');
		}
	}
	
	

	function hapuspertanyaan($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$cek = $this->M_master->delete('pertanyaan',['id_pertanyaan' => $id]);
		//$this->M_master->delete('jawaban',['id_pertanyaan' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Deleted');
			redirect('admin/pertanyaan','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/pertanyaan','refresh');
		}
	}








	/*publish*/
	function publish()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$responden = $this->M_admin->get_responden_1()->result();

		$hasil = array();
		$no = 1;
		foreach ($responden as $h) {
			$hasil[$no]	= [
				'id_responden'	=> $h->id_responden,
				'nama_responden'=> $this->db->get_where('responden', ['id_responden' => $h->id_responden])->row()->nama, 
				'status'=> $this->db->get_where('jawaban', ['id_responden' => $h->id_responden])->row()->published,
				'tanggal'		=> $this->M_admin->get_tanggal_responden($h->id_responden),
				'rata'			=> $this->_get_rataan_2($h->id_responden)
			];
			$no++;
		}

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'Kelola Jawaban Responden',
			'icon'			=> 'fa-share',
			'rekap'			=> $hasil,
			'menu'			=> 'publish'
		];
		//echo json_encode($responden);
		$this->template->load('tema/index','publish',$data);
	}




	function detil($id_responden)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'title'			=> 'Survey',
			'sub'			=> 'pre publish',
			'icon'			=> 'fa-share',
			'rekap'			=> $this->M_admin->getdetil($id_responden),
			'menu'			=> 'publish'
		];
		$this->template->load('tema/index','detil',$data);
		//echo json_encode($data);
	}



	function aksipublish($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$where = ['id_responden' => $id];
		$this->db->where($where);
		$this->db->update('jawaban', ['published' => '2']);
		redirect('admin/publish','refresh');
	}
	
	
	
	function aksiunpublish($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$where = ['id_responden' => $id];
		$this->db->where($where);
		$this->db->update('jawaban', ['published' => '1']);
		redirect('admin/publish','refresh');
	}
	
	
	function hapusjawaban($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$cek = $this->M_master->delete('jawaban',['id_responden' => $id]);
	 
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Deleted');
			redirect('admin/publish','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/publish','refresh');
		}
	}



	/*SARAN*/
	function saran()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'title'			=> 'Kritik Dan Saran',
			'sub'			=> '',
			'icon'			=> 'clip-file',
			'rekap'			=> $this->M_admin->getSaran()->result(),
			'menu'			=> 'saran'
		];
		$this->template->load('tema/index','saran',$data);
	}



	function tanggapisaran($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$cek = $this->M_master->update('saran',['id_responden' => $id],['status' => '2']);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Updated');
			redirect('admin/saran','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/saran','refresh');
		}

	}
	
	function tanggapisaran2($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$cek = $this->M_master->update('saran',['id_responden' => $id],['status' => '1']);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Updated');
			redirect('admin/saran','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/saran','refresh');
		}

	}
	
	
	function hapussaran($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$cek = $this->M_master->delete('saran',['id_saran' => $id]);
		 
		if (!$cek) {
			$this->session->set_flashdata('success', 'Data Deleted');
			redirect('admin/saran','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Error...');
			redirect('admin/saran','refresh');
		}
	}


	

	function log_out()
	{
		session_destroy();
		redirect('survey','refresh');
	}




	/*cetak*/
	function cetaklaporan($bulan,$tahun)
	{
		$data['tgl_indo']	= $this->M_master->tglindo($bulan);
		$data['tahun']		= $tahun;
		$data['pengunjung']	= $this->M_master->getall('responden')->num_rows();

		//data umur
		$up40 	= $this->M_admin->get_umur('up40',$bulan,$tahun)->num_rows();
		$min40 	= $this->M_admin->get_umur('min40',$bulan,$tahun)->num_rows();
		//presentase umur
		$p40	= $up40/($up40+$min40);
		$m40 	= $min40/($up40+$min40);

		$data['umur'] = [
			'up40'	=> [
				'index'			=> '< 40',
				'jumlah'		=> $up40,
				'presentase'	=> number_format($p40*100,2)
			],
			'min40'	=> [
				'index'			=> '>= 40',
				'jumlah'		=> $min40,
				'presentase'	=> number_format($m40*100,2)
			]
		];

		//data JK
		$lk 	= $this->M_admin->getJK('laki-laki',$bulan,$tahun)->num_rows();
		$pr 	= $this->M_admin->getJK('perempuan',$bulan,$tahun)->num_rows();
		//presentase umur
		$plk	= $lk/($lk+$pr);
		$ppr 	= $pr/($lk+$pr);
		$data['jk'] = [
			'laki'	=> [
				'jk'		=> 'Laki-laki',
				'jumlah'	=> $lk,
				'presentase'=> number_format($plk*100,2)
			],
			'pr'	=> [
				'jk'		=> 'Perempuan',
				'jumlah'	=> $pr,
				'presentase'=> number_format($ppr*100,2)
			],
		];

		//index kepuasan
		$soal = $this->M_master->getall('pertanyaan')->result();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no] = [
				'kepuasan'	=> $this->_get_nilai_filter($v->id_pertanyaan,$bulan,$tahun),
				'id_pertanyaan'	=> $v->id_pertanyaan,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'d',$bulan,$tahun),
				'p'			=> $this->_get_rataan_filter($v->id_pertanyaan,'c',$bulan,$tahun),
				'tp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'b', $bulan,$tahun),
				'kec'		=> $this->_get_rataan_filter($v->id_pertanyaan,'a', $bulan,$tahun),
			];
			$no++;
		}
		$data['hasil']	= $hasil;
		$data['min']	= min($hasil);
		$data['max']	= max($hasil);

		//Index Kepuasan
		$kepuasan = $this->_get_kepuasan_filter($bulan,$tahun);
		if ($kepuasan >88.31){
			$mutu = 'A';
			$index = "Sangat Baik";
		}else if($kepuasan > 76.61){
			$mutu = 'B';
			$index = 'Baik';
		}else if($kepuasan > 65.00){
			$mutu = 'C';
			$index = 'Kurang Baik';
		}
		else if($kepuasan > 25.00 ) {
			$mutu = 'D';
			$index = 'Tidak Baik';
		}
		else {
			$mutu = null;
		}

		$data['tingkat_kepuasan'] = [
			'index'			=> $index,
			'mutu'			=> $mutu,
			'presentase'	=> $this->_get_kepuasan_filter($bulan,$tahun)
		];
		//echo json_encode($data);
		$this->load->view('cetak/cetak_laporan', $data);
	}

	function cetaksaran()
	{
		$data['rekap']	= $this->M_admin->getSaran()->result();
		$this->load->view('cetak/cetak_saran', $data);
	}

	function cetakrekap($bulan,$tahun)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		//hasilnya untuk index kepuasan per soal
		$soal = $this->M_master->getall('pertanyaan')->result();
		$hasil = array();
		$hasil_2 = array();
		$no = 1;
		foreach ($soal as $v) {
			$hasil[$no]= [
				'kepuasan'	=> $this->_get_nilai_filter($v->id_pertanyaan,$bulan,$tahun),
				'id_pertanyaan'	=> $v->id_pertanyaan,
				'kategori'	=> $v->kategori,
				'soal'		=> $v->soal,
				'sp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'d', $bulan,$tahun),
				'p'			=> $this->_get_rataan_filter($v->id_pertanyaan,'c', $bulan,$tahun),
				'tp'		=> $this->_get_rataan_filter($v->id_pertanyaan,'b', $bulan,$tahun),
				'kec'		=> $this->_get_rataan_filter($v->id_pertanyaan,'a', $bulan,$tahun),
			];
			$no++;
		}
		sort($hasil);

		//mengembalikan urutan by ID
		$data_short = $this->_get_prioritas($hasil);
		sort($data_short);
		$data['rekap'] 	= $data_short;
		$this->load->view('cetak/cetak1', $data);
	}

	function cetakrekapdetil($bulan,$tahun)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		
		$res = $this->M_admin->get_responden_1($bulan,$tahun)->result();
		$data['soal'] = $this->M_master->getall('pertanyaan')->result();
		$hasil =array();
		$jawaban = array();
		$no= 1;
		foreach ($res as $key) {
			$hasil[$no]= [
				'id_responden'	=> $key->id_responden,
				'jawaban' 		=> $this->_get_jawaban($key->id_responden)
			];
			$no++;
		}
		$data['rekap'] = $hasil;
		$data['bulan']	= $this->M_master->tglindo($bulan);
		$data['tahun']	= $tahun;
		//echo json_encode($data);
		$this->load->view('cetak/cetakrekapdetil', $data);
	}


	//private function
	private function _get_jawaban($id_responden)
	{
		$dt	= $this->M_master->getWhere('jawaban',['id_responden' => $id_responden])->result();
		$soal = $this->M_master->getall('pertanyaan')->result();
		$data = array();
		$no = 1;
		foreach ($soal as $soal) {
			$jw = $this->_jawaban($soal->id_pertanyaan,$id_responden);
			if ($jw == 'd') {
				$nilai = '4';
			}
			else if($jw == 'c')
			{
				$nilai = '3';
			}
			else if($jw == 'b')
			{
				$nilai = '2';
			}
			else
			{
				$nilai = '1';
			}

			array_push($data, $nilai);	
			$no++;
		}
		return $data;
	}

	private function _jawaban($soal,$id_responden)
	{
		$this->db->select('jawaban');
		$this->db->where('id_responden', $id_responden);
		$this->db->where('id_pertanyaan', $soal);
		$data =  $this->db->get('jawaban')->row();
		$hasil = $data->jawaban;
		return $hasil;
	}

	private function _get_prioritas($data)
	{
		$hasil = array();
		$no = 1;
		foreach ($data as $v) {
			$hasil[$no] = [
				'id_pertanyaan'	=> $v['id_pertanyaan'],
				'kepuasan'	=> $v['kepuasan'],
				'kategori'	=> $v['kategori'],
				'soal'		=> $v['soal'],
				'sp'		=> $v['sp'],
				'p'			=> $v['p'],
				'tp'		=> $v['tp'],
				'kec'		=> $v['kec'],
				'prioritas' => $no
			];
			$no++;
		}

		return $hasil;
	}

	private function _get_rataan($id_pertanyaan,$jawaban)
	{
		$data = $this->M_master->getWhere('jawaban',['published' => '2','jawaban' => $jawaban,'id_pertanyaan' => $id_pertanyaan])->num_rows();
		return $data;
	}

	private function _get_rataan_2($id_responden)
	{
		$soal = $this->M_master->getall('pertanyaan')->num_rows();
		$a = $this->M_master->getWhere('jawaban',['jawaban' => 'a','id_responden' => $id_responden])->num_rows();
		$b = $this->M_master->getWhere('jawaban',['jawaban' => 'b','id_responden' => $id_responden])->num_rows();
		$c = $this->M_master->getWhere('jawaban',['jawaban' => 'c','id_responden' => $id_responden])->num_rows();
		$d = $this->M_master->getWhere('jawaban',['jawaban' => 'd','id_responden' => $id_responden])->num_rows();

		$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($soal);
		return number_format($kepuasan,2);
	}


	/*PRIVATE FUNCTION FILTER*/
	private function _get_kepuasan_filter($bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$where = 'MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'" and published = "2"';
			$where_a = 'published = "2" and jawaban = "a" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_b = 'published = "2" and jawaban = "b" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_c = 'published = "2" and jawaban = "c" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_d = 'published = "2" and jawaban = "d" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
		}
		else
		{
			$where = 'MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'" and published = "2"';
			$where_a = 'published = "2" and jawaban = "a" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_b = 'published = "2" and jawaban = "b" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_c = 'published = "2" and jawaban = "c" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_d = 'published = "2" and jawaban = "d" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
		}

		$total = $this->M_master->getWhere('jawaban', $where)->num_rows();
		$soal = $this->M_master->getall('pertanyaan')->num_rows();
		$total_responden = $this->M_master->get_responden_filter($bulan,$tahun);
		$a = $this->M_master->getWhere('jawaban', $where_a )->num_rows();
		$b = $this->M_master->getWhere('jawaban', $where_b )->num_rows();
		$c = $this->M_master->getWhere('jawaban', $where_c )->num_rows();
		$d = $this->M_master->getWhere('jawaban', $where_d )->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/($total_responden*4*$soal);
			return number_format(($kepuasan*100),2);
		}
		return 0;
	}

	private function _get_pendidikan_filter($bulan,$tahun)
	{
		$pendidikan = $this->M_master->getall('pendidikan')->result();
		$no = 1;
		foreach ($pendidikan as $p) {
			$hasil[$no] = [
				'pendidikan'	=> $p->pendidikan,
				'jumlah'		=> $this->M_admin->join_get_responden_2_filter('pendidikan',$p->pendidikan,$bulan,$tahun)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _get_pekerjaan_filter($bulan,$tahun)
	{
		$pekerjaan = $this->M_master->getall('pekerjaan')->result();
		$no = 1;
		foreach ($pekerjaan as $p) {
			$hasil[$no] = [
				'pekerjaan'		=> $p->pekerjaan,
				'jumlah'		=> $this->M_admin->join_get_responden_2_filter('pekerjaan',$p->pekerjaan,$bulan,$tahun)->num_rows()
			];
			$no++;
		}
		return $hasil;
	}

	private function _get_hasil_filter($bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$where_a = 'published = "2" and jawaban = "a" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_b = 'published = "2" and jawaban = "b" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_c = 'published = "2" and jawaban = "c" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_d = 'published = "2" and jawaban = "d" and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
		}
		else
		{
			$where_a = 'published = "2" and jawaban = "a" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_b = 'published = "2" and jawaban = "b" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_c = 'published = "2" and jawaban = "c" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
			$where_d = 'published = "2" and jawaban = "d" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'"';
		}

		$sangat_puas 	= $this->M_master->getWhere('jawaban',$where_d)->num_rows();
		$puas 		 	= $this->M_master->getWhere('jawaban',$where_c)->num_rows();
		$tidak_puas 	= $this->M_master->getWhere('jawaban',$where_b)->num_rows();
		$kecewa 		= $this->M_master->getWhere('jawaban',$where_a)->num_rows();

		$all = $sangat_puas+$puas+$tidak_puas+$kecewa;

		if($all != 0)
		{
			$data = [
				[
					'name' 	=> 'sangat_puas',
					'y'		=> $sangat_puas,
					'color' => '#00FF00'
				],
				[
					'name' 	=> 'puas',
					'y'		=> $puas,
					'color' => 'blue'
				],
				[
					'name' 	=> 'tidak_puas',
					'y'		=> $tidak_puas,
					'color' => 'purple'
				],
				[
					'name' 	=> 'kecewa',
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

	private function _get_nilai_filter($id,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$awal = date('m',strtotime('2020-01-01'));
			$where = 'id_pertanyaan = "'.$id.'" and MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'" and published="2"';
			$where_a = 'id_pertanyaan = "'.$id.'" and published = "2" and jawaban = "a" and MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_b = 'id_pertanyaan = "'.$id.'" and published = "2" and jawaban = "b" and MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'" ';
			$where_c = 'id_pertanyaan = "'.$id.'" and published = "2" and jawaban = "c" and MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
			$where_d = 'id_pertanyaan = "'.$id.'" and published = "2" and jawaban = "d" and MONTH(created_date) BETWEEN "'.$awal.'" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
		}
		else
		{
			$where = 'MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id.'" and published="2"';
			$where_a = 'published = "2" and jawaban = "a" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id.'"';
			$where_b = 'published = "2" and jawaban = "b" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id.'"';
			$where_c = 'published = "2" and jawaban = "c" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id.'"';
			$where_d = 'published = "2" and jawaban = "d" and MONTH(created_date) = "'.$bulan.'"  and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id.'"';
		}

		//$total = $this->M_master->getWhere('jawaban',$where)->num_rows();
		$soal = $this->M_master->getall('pertanyaan')->num_rows();
		$total_responden = $this->M_master->get_responden_filter($bulan,$tahun);

		$a = $this->M_master->getWhere('jawaban',$where_a)->num_rows();
		$b = $this->M_master->getWhere('jawaban',$where_b)->num_rows();
		$c = $this->M_master->getWhere('jawaban',$where_c)->num_rows();
		$d = $this->M_master->getWhere('jawaban',$where_d)->num_rows();

		if ($total_responden != 0) {
			$kepuasan = (($d*4)+($c*3)+($b*2)+($a*1))/$total_responden;
			return number_format($kepuasan,2);
		}
		return 0;
	}

	private function _get_rataan_filter($id_pertanyaan,$jawaban,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$where = 'MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id_pertanyaan.'" and jawaban = "'.$jawaban.'" and published="2"';
		}
		else
		{
			$where = 'MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'" and id_pertanyaan = "'.$id_pertanyaan.'" and jawaban = "'.$jawaban.'" and published="2"';
		}
		$data = $this->M_master->getWhere('jawaban',$where)->num_rows();
		return $data;
	}


}

/* End of file Admin.php */
/* Location: ./application/modules/admin/controllers/Admin.php */