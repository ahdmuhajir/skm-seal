<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {


	function getSoal()
	{
		return $this->db->get('pertanyaan');
	}
	

	function get_responden_1()
	{
		$this->db->order_by('created_date','DESC');
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get('jawaban');
	}
	
	

	function get_blm_publish($bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(created_date) BETWEEN "01" and "'.date('m').'" and YEAR(created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'"';
		}

		$this->db->where($query);
		$this->db->where('published', '1');
		return $this->db->get('jawaban');
	}



	function join_get_responden_2($kolom,$param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM jawaban where published = 2) as a  , responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
	}


	function join_get_responden_2_filter($kolom,$param,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM jawaban where published = 2 and MONTH(created_date) BETWEEN "01" AND "'.date('m').'" and YEAR(created_date) = "'.$tahun.'") as a  , responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
		}
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM jawaban where published = 2 and MONTH(created_date) = "'.$bulan.'" and YEAR(created_date) = "'.$tahun.'") as a  , responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
	}
	
	

	function getdetil($id_responden)
	{
		$this->db->join('pertanyaan', 'pertanyaan.id_pertanyaan = jawaban.id_pertanyaan');
		$this->db->where('id_responden', $id_responden);
		return $this->db->get('jawaban')->result();
	}


	function getSaran()
	{
		$this->db->join('responden', 'responden.id_responden = saran.id_responden');
		$this->db->select('saran.*, responden.*, saran.status as statusku, responden.id_responden as id_respondenku, saran.created_date as tglbuat');
		//$this->db->where('saran.status','1');
		return $this->db->get('saran');
	}
	

	function get_umur($param,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'" and published="2"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'" and published="2"';
		}

		if ($param == 'up40') {
			$kolom = 'umur <';
		}
		else
		{
			$kolom = 'umur >=';
		}

		$this->db->join('jawaban', 'jawaban.id_responden = responden.id_responden');
		$this->db->group_by('jawaban.id_responden');
		$this->db->where($query);
		return $this->db->get_where('responden', [$kolom => 40 ]);
	}

	function getJK($jk,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'" and published="2"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"  and published="2"';
		}

		$this->db->join('jawaban', 'jawaban.id_responden = responden.id_responden');
		$this->db->where('jk', $jk);
		$this->db->where($query);
		$this->db->group_by('jawaban.id_responden');
		return $this->db->get('responden');
	}
	
	
	/*baru*/
	function getdetilresponden($id_responden)
	{
		$this->db->join('tb_loket', 'tb_loket.id_loket = responden.loket');
		return $this->db->get_where('responden', ['id_responden' => $id_responden])->row();
	}

	function get_rekap_hasil()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		$this->db->where('date(created_date)', date('2021-03-09'));
		$this->db->where('published', 2);
		return $this->db->get_where('jawaban');
	}

	function get_kuisioner($id_responden)
	{
		$pertanyaan =$this->db->get('tb_pertanyaan')->result();

		$no = 0;
		foreach ($pertanyaan as $p) {
			$hasil[$no++] = [
				'pertanyaan'	=> $p->soal,
				'jawaban'		=> $this->_get_jawaban($p->id_pertanyaan,$id_responden)
			];
		}

		return $hasil;
	}

	function _get_jawaban($id_pertanyaan,$id_responden)
	{
		$where = [
			'id_responden'		=> $id_responden,
			'jawaban.id_pertanyaan'			=> $id_pertanyaan
		];

		$this->db->join('tb_pertanyaan', 'tb_pertanyaan.id_pertanyaan = jawaban.id_pertanyaan');
		$data = $this->db->get_where('jawaban', $where)->row();

		if ($data) {
			$kolom = $data->jawaban;
			return $data->$kolom;
		}
		return null;
	}

	function get_tanggal_responden($id_responden)
	{
		$data = $this->db->get_where('jawaban',['id_responden' => $id_responden])->row(); 
		return $this->indo->konversi2($data->created_date);
	}

	function get_jam_responden($id_responden)
	{
		$data = $this->db->get_where('jawaban',['id_responden' => $id_responden])->row(); 
		return date('H:i:s', strtotime($data->created_date));
	}


	/*IMPORT*/
	function importAction()
	{
		$nama = uniqid().'.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		if ( ! $this->upload->do_upload('file')){
			$response = $this->upload->display_errors();
			$res = [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		}else{
			//proses import
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'].$config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$data_import  =	[]; 
			$no = 0;
			for ($i=1; $i < count($worksheet) ; $i++) {
				$data[$no] = [
					'id_jawaban'		=> '',
					'id_responden' 	=> $worksheet[$i][0],
					'id_pertanyaan' 		=> strtoupper($worksheet[$i][1]),
					'jawaban'		=> $worksheet[$i][2],
					'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][3])),
					'published'		=> $worksheet[$i][4],
				];
				$no++;
			}

			$cek = $this->db->insert_batch('jawaban', $data);
			if ($cek) {
				$res = [
					'kode'		=> 'success',
					'msg'		=> 'import success'
				];
			}
			else
			{
				$res = [
					'kode'		=> 'error',
					'msg'		=> 'import gagal'
				];
			}
			unlink('./assets/excel/'.$nama);

		}
		return $res;
	}

	function importResponden()
	{
		$nama = uniqid().'.xlsx';
		$config['upload_path']          = './assets/excel/';
		$config['allowed_types']        = 'xls|xlsx';
		$config['file_name']           	= $nama;
		$this->load->library('upload', $config);
		$this->upload->overwrite = true;

		if ( ! $this->upload->do_upload('file')){
			$response = $this->upload->display_errors();
			$res = [
				'kode'		=> 'error',
				'msg'		=> $response
			];
		}else{
			//proses import
			$spreadsheet 	= \PhpOffice\PhpSpreadsheet\IOFactory::load($config['upload_path'].$config['file_name']);
			$worksheet 		= $spreadsheet->getActiveSheet()->toArray();

			$data_import  =	[]; 
			$no = 0;
			for ($i=1; $i < count($worksheet) ; $i++) {
				$data[$no] = [
					'id'			=> uniqid(),
					'id_responden' 	=> $worksheet[$i][0],
					'nama' 			=> strtoupper($worksheet[$i][1]),
					'umur'			=> $worksheet[$i][2],
					'jk'			=> $worksheet[$i][3],
					'pendidikan'	=> $worksheet[$i][4],
					'pekerjaan'		=> $worksheet[$i][5],
					'loket'			=> $worksheet[$i][6],
					'created_date'	=> date('Y-m-d H:i:s', strtotime($worksheet[$i][7])),
					'status'		=> '1',
				];
				$no++;
			}

			$cek = $this->db->insert_batch('responden', $data);
			if ($cek) {
				$res = [
					'kode'		=> 'success',
					'msg'		=> 'import success'
				];
			}
			else
			{
				$res = [
					'kode'		=> 'error',
					'msg'		=> 'import gagal'
				];
			}
			unlink('./assets/excel/'.$nama);

		}
		return $res;
	}

}

/* End of file M_admin.php */
/* Location: ./application/modules/admin/models/M_admin.php */