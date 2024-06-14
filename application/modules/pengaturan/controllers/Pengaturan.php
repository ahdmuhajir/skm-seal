<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_master');
		$this->load->model('M_loket');
		$this->load->model('M_profilaplikasi');
	}
	
	
 

	function profilaplikasi($bulan='setahun', $tahun=false)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		if ($bulan == 'setahun') {
			$tahun = date('Y');
		}

		$loket 		= $this->M_master->apiLoket();
		 
		$data = [
			'title'				=> 'Pengaturan',
			'sub'				=> 'Profil Aplikasi',
			'icon'				=> 'fa-user-circle',
			'loket'				=> $this->M_loket->detil_loket($loket,$tahun, $bulan),
			'total_responden' 	=> $this->M_loket->responden($loket,$tahun, $bulan),
			'menu'				=> 'profilaplikasi',
			'f_bulan'			=> $bulan,
			'f_tahun'			=> $tahun,
			'bulan'				=> $this->M_master->getall('bulan')->result(),
			'tahun'				=> $this->M_master->getall('tahun')->result(),
			'profilaplikasi'	=>  $this->M_master->getWhere('profil_aplikasi',['id_profilaplikasi' => 1])->row(),
			  
		];
		 
			$this->template->load('tema/index','profilaplikasi',$data);
			
	}

 

	function update_profilaplikasi()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		
		
		
		
		if (!empty($_FILES["gambar1"]["name"])) {
			$id=rand(5,99999999);
		
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['max_size']             = 15000;
			$config['max_width']            = 16000;
			$config['max_height']           = 16000;
			$config['file_name']           	= $id.$_FILES["gambar1"]["name"];
			$this->load->library('upload', $config);
		 
			$data = [ 
				'logo_aplikasi'		=> $id.$_FILES["gambar1"]["name"],
			];
				
			$where = [
				'id_profilaplikasi'		=> 1
			];
			$this->upload->do_upload('gambar1');
			$this->M_master->update('profil_aplikasi',$where,$data);
			
		}
		
		
		if (!empty($_FILES["gambar2"]["name"])) {
			$id=rand(5,99999999);
		
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['max_size']             = 15000;
			$config['max_width']            = 16000;
			$config['max_height']           = 16000;
			$config['file_name']           	= $id.$_FILES["gambar2"]["name"];
			$this->load->library('upload', $config);
		 
		
			$data = [ 
				'favicon_aplikasi'		=> $id.$_FILES["gambar2"]["name"],
			];
				
			$where = [
				'id_profilaplikasi'		=> 1
			];
			$this->upload->do_upload('gambar2');
			$this->M_master->update('profil_aplikasi',$where,$data);
			
		}
		
		
		if (!empty($_FILES["gambar3"]["name"])) {
			$id=rand(5,99999999);
		
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'jpg|jpeg|png';
			$config['max_size']             = 15000;
			$config['max_width']            = 16000;
			$config['max_height']           = 16000;
			$config['file_name']           	= $id.$_FILES["gambar3"]["name"];
			$this->load->library('upload', $config);
			 
			$data = [ 
				'logo_instansi'		=> $id.$_FILES["gambar3"]["name"],
			];
				
			$where = [
				'id_profilaplikasi'		=> 1
			];
			$this->upload->do_upload('gambar3');
			$this->M_master->update('profil_aplikasi',$where,$data);
			
		}
		
	
		//`id_profilaplikasi`, `nama_instansi`, `alamat_instansi`, `notelp_instansi`, `email_instansi`, `logo_instansi`, `nama_aplikasi`, `logo_aplikasi`, `favicon_aplikasi`
		$data = [
			'nama_instansi'	=> $this->input->post('nama_instansi'),
			'alamat_instansi'	=> $this->input->post('alamat_instansi'),
			'notelp_instansi'	=> $this->input->post('notelp_instansi'),
			'email_instansi'	=> $this->input->post('email_instansi'), 
			'nama_aplikasi'	=> $this->input->post('nama_aplikasi'),  
		];

		$where = [
			'id_profilaplikasi'		=> 1
		];

		$cek = $this->M_master->update('profil_aplikasi',$where,$data);
		
		
		if(!$cek){
			$this->session->set_flashdata('success', 'profil aplikasi berhasil diupdate');
			redirect('pengaturan/profilaplikasi','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'update profil aplikasi  gagal..');
			redirect('pengaturan/profilaplikasi','refresh');
		}
	}
 
 
 
 
	/* USER */
	
	public function user()
	{
		$this->output->delete_cache();
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'title'			=> 'Pengguna',
			'sub'			=> 'Kelola Pengguna',
			'icon'			=> 'fa-rss-square',
			'pengguna'			=> $this->M_master->getall('admin')->result(),
			'menu'			=> 'user'
		];

		
		$this->template->load('tema/index','pengguna',$data);
	}
	
	
	function addpengguna()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		
		$id=rand(5,99999999);
		
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 15000;
		$config['max_width']            = 16000;
		$config['max_height']           = 16000;
		$config['file_name']           	= $id.".jpeg";
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;
		
		
		
		 
		if (!empty($_FILES["image"]["name"])) {
			$data = [
				'nama_lengkap'	=> $this->input->post('nama_lengkap'),
				'username'		=> $this->input->post('username'),
				'password'	=> md5($this->input->post('password')), 
				'foto'		=> $id.".jpeg",
			];
				$this->upload->do_upload('image');
				$cek = $this->M_master->input('admin',$data);		
				if (!$cek) {
					$this->session->set_flashdata('success', 'Pengguna ditambah');
					redirect('pengaturan/user','refresh');
				}
				else
				{
					$this->session->set_flashdata('error', 'Gagal');
					redirect('pengaturan/user','refresh');
				}
		} 
		else 
		{
			$data = [
				'nama_lengkap'	=> $this->input->post('nama_lengkap'),
				'username'		=> $this->input->post('username'),
				'password'	=> md5($this->input->post('password')), 
			];

			$cek = $this->M_master->input('admin',$data);			
			if (!$cek) {
				$this->session->set_flashdata('success', 'Pengguna ditambah');
				redirect('pengaturan/user','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal');
				redirect('pengaturan/user','refresh');
			}
		}
		
		
		
	}
	
	

	function detilpengguna($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = $this->M_master->getWhere('admin',['id_admin'=> $id])->row();
		echo json_encode($data);
	}





	function updatepengguna()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$id=rand(5,99999999);
		$where = ['id_admin' => $this->input->post('id_pengguna')];
		
		$config['upload_path']          = './assets/img/';
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 15000;
		$config['max_width']            = 16000;
		$config['max_height']           = 16000;
		$config['file_name']           	= $id.".jpeg";
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

 		 if($this->input->post('password')!="") {
			 $pass=md5($this->input->post('password'));
		 } else {
			 $pass = $this->input->post('passwordlama');
		 }
		 
		 
		 if($this->session->userdata('ses_id')==$this->input->post('id_pengguna')) {
			
			$this->session->set_userdata('ses_username',$this->input->post('username')); 
			$this->session->set_userdata('ses_namalengkap',$this->input->post('nama_lengkap'));
			$this->session->set_userdata('ses_foto', $id.".jpeg");
			
		 }

		if (!empty($_FILES["image"]["name"])) {
			$data 	= array(
				'nama_lengkap'			=> $this->input->post('nama_lengkap'),
				'username'		=> $this->input->post('username'),
				'password'		=> $pass,
				'foto'		=> $id.".jpeg", 
			);
		
			if ( ! $this->upload->do_upload('image')){
				$this->output->delete_cache();
				$this->session->set_flashdata('error',$this->upload->display_errors());
				redirect('pengaturan/user','refresh');
			}
			else
			{
				$this->output->delete_cache();
				$this->M_master->update('admin', $where, $data);			
				$this->session->set_flashdata('success','Pengguna post Success');
				redirect('pengaturan/user','refresh');
			}
		} 
		else 
		{
			$data 	= array(
				'nama_lengkap'			=> $this->input->post('nama_lengkap'),
				'username'		=> $this->input->post('username'),
				'password'		=> $pass,
			);
			
			$this->M_master->update('admin', $where, $data);			
			$this->session->set_flashdata('success','Pengguna post Success');
			redirect('pengaturan/user','refresh');
		}
		
	}



	function hapuspengguna($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		 
		$cek = $this->M_master->delete('admin',['id_admin' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Pengguna dihapus');
			redirect('pengaturan/user','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('pengaturan/user','refresh');
		}
	}





	/* UNIT */
	
	public function unit()
	{
		$this->output->delete_cache();
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = [
			'title'			=> 'Unit',
			'sub'			=> 'Kelola Unit',
			'icon'			=> 'fa-rss-square',
			'unit'			=> $this->M_master->getall('unit')->result(),
			'menu'			=> 'unit'
		];

		
		$this->template->load('tema/index','unit',$data);
	}
	
	
	function addunit()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		 
	 
			$data = [
				'nama_unit'	=> $this->input->post('nama_unit'), 
				'created_date'	=> date("Y-m-d H:i:s"), 
			];

			$cek = $this->M_master->input('unit',$data);			
			if (!$cek) {
				$this->session->set_flashdata('success', 'Unit ditambah');
				redirect('pengaturan/unit','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal');
				redirect('pengaturan/unit','refresh');
			}
		 
		
		
	}
	
	

	function detilunit($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		$data = $this->M_master->getWhere('unit',['id_unit'=> $id])->row();
		echo json_encode($data);
	}





	function updateunit()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

			$where = ['id_unit' => $this->input->post('id_unit')];
		 
			$data 	= array(
				'nama_unit'			=> $this->input->post('nama_unit'), 
			);
			
			$this->M_master->update('unit', $where, $data);			
			$this->session->set_flashdata('success','Unit post Success');
			redirect('pengaturan/unit','refresh');
		}
		




	function hapusunit($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		 
		$cek = $this->M_master->delete('unit',['id_unit' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Unit dihapus');
			redirect('pengaturan/unit','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('pengaturan/unit','refresh');
		}
	 
	

	}
	
	
	
	
	
	/* PELAYANAN */
	
	public function pelayanan()
	{
		$this->output->delete_cache();
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		
		 
		$this->db->order_by('id_unit', 'asc'); 
		$pelayanan = $this->db->get('pelayanan');

		$data = [
			'title'			=> 'Pelayanan',
			'sub'			=> 'Kelola Pelayanan',
			'icon'			=> 'fa-rss-square', 
			'unit'			=> $this->M_master->getall('unit')->result(),
			'units'			=> $this->M_master->getall('unit')->result(),
			'pelayanan'		=> $pelayanan->result(),
			'menu'			=> 'pelayanan'
		];

		
		$this->template->load('tema/index','pelayanan',$data);
	}
	
	
	function addpelayanan()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}
		 
	 
			$data = [
				'id_unit'	=> $this->input->post('id_unit'), 
				'nama_pelayanan'	=> $this->input->post('nama_pelayanan'), 
				'created_date'	=> date("Y-m-d H:i:s"), 
			];

			$cek = $this->M_master->input('pelayanan',$data);			
			if (!$cek) {
				$this->session->set_flashdata('success', 'Pelayanan ditambah');
				redirect('pengaturan/pelayanan','refresh');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal');
				redirect('pengaturan/pelayanan','refresh');
			}
		 
		
		
	}
	
	

	function detilpelayanan($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}


		 
		$data = $this->M_master->getWhere('pelayanan',['id_pelayanan'=> $id])->row();
		echo json_encode($data);
	}





	function updatepelayanan()
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

			$where = ['id_pelayanan' => $this->input->post('id_pelayanan')];
		 
			$data 	= array(
				'nama_pelayanan'			=> $this->input->post('nama_pelayanan'), 
			);
			
			$this->M_master->update('pelayanan', $where, $data);			
			$this->session->set_flashdata('success','Pelayanan post Success');
			redirect('pengaturan/pelayanan','refresh');
		}
		




	function hapuspelayanan($id)
	{
		if ($this->session->userdata('ses_username') == null) {
			redirect('survey/admin','refresh');
		}

		 
		$cek = $this->M_master->delete('pelayanan',['id_pelayanan' => $id]);
		if (!$cek) {
			$this->session->set_flashdata('success', 'Pelayanan dihapus');
			redirect('pengaturan/pelayanan','refresh');
		}
		else
		{
			$this->session->set_flashdata('error', 'Gagal');
			redirect('pengaturan/pelayanan','refresh');
		}
	 
	

	}
	
	
	
	
	

}

/* End of file Loket.php */
/* Location: ./application/modules/loket/controllers/Loket.php */