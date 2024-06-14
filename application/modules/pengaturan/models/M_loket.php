<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_loket extends CI_Model {
	function get_nilai_loket($id,$bulan,$tahun)
	{
		if ($bulan=='setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->join('responden', 'responden.id_responden = jawaban.id_responden');
		$this->db->join('unit', 'responden.loket = unit.id_loket');
		$this->db->where('unit.id_loket', $id);
		$this->db->where($query);
		$this->db->where('jawaban.published', '2');
		return $this->db->get('jawaban');
	}

	function get_responden_by_loket($id,$bulan,$tahun)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->distinct();
		$this->db->select('jawaban.id_responden');
		$this->db->join('responden', 'responden.id_responden = jawaban.id_responden');
		$this->db->join('unit', 'responden.loket = unit.id_loket');
		$this->db->where('unit.id_loket', $id);
		$this->db->where($query);
		$this->db->where('jawaban.published', '2');
		return $this->db->get('jawaban');
	}	

	function get_pilihan($id,$bulan,$tahun,$pilihan)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->join('responden', 'unit.id_loket = responden.loket');
		$this->db->join('jawaban', 'responden.id_responden = jawaban.id_responden');
		$this->db->where('jawaban.jawaban', $pilihan);
		$this->db->where('jawaban.id_pertanyaan', $id);
		$this->db->where($query);
		$this->db->order_by('jawaban.created_date', 'desc');
		$this->db->group_by('unit.id_loket');
		return $this->db->get('unit');
	}	

	function get_hasil_pilihan($id,$bulan,$tahun,$pilihan,$loket)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->join('responden', 'unit.id_loket = responden.loket');
		$this->db->join('jawaban', 'responden.id_responden = jawaban.id_responden');
		$this->db->where('jawaban.id_pertanyaan', $id);
		$this->db->where('jawaban.jawaban', $pilihan);
		$this->db->where('unit.id_loket', $loket);
		$this->db->where($query);
		$this->db->order_by('jawaban.created_date', 'desc');
		return $this->db->get('unit');
	}	
	
	function detil_loket($data,$tahun, $bulan)
	{
		$hasil 	= [];
		$no 	= 1;
		if ($data) 
		{
			foreach ($data as $dat) {
				$hasil[$no++] = [
					'id_loket'				=> $dat->id_loket,
					'jenis_layanan'			=> $dat->jenis_layanan,
					'jumlah_responden'		=> $this->_jumlahResponden($dat->id_loket,$tahun, $bulan),
					'persen'				=> $this->_persen($dat->id_loket,$tahun, $bulan),
					'kepuasan'				=> $this->_getKepuasan($dat->id_loket,$tahun, $bulan),
				];
			}
		}
		return $hasil;
	}

	function responden($data,$tahun, $bulan)
	{
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(jawaban.created_date)', $bulan);
		}
		$this->db->where('YEAR(jawaban.created_date)', $tahun);
		$this->db->where('published', '2');
		$this->db->join('jawaban', 'jawaban.id_responden = responden.id_responden');
		$this->db->group_by('jawaban.id_responden');
		return $this->db->get('responden')->num_rows();
	}

}

/* End of file M_loket.php */
/* Location: ./application/modules/loket/models/M_loket.php */