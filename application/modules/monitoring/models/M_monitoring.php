<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_monitoring extends CI_Model {
	
	function responden($tahun, $bulan)
	{
		if ($bulan != 'setahun') {
			$this->db->where('MONTH(jawaban.created_date)', $bulan);
		}
		$this->db->where('YEAR(jawaban.created_date)', $tahun);
		$this->db->where('jawaban.published', '2');
		$this->db->join('jawaban', 'jawaban.id_responden = responden.id_responden');
		$this->db->group_by('jawaban.id_responden');
		return $this->db->get('responden')->num_rows();
	}
	
	
	function get_nilai_unit($id,$bulan,$tahun)
	{
		if ($bulan=='setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->join('responden', 'responden.id_responden = jawaban.id_responden');
		$this->db->join('unit', 'responden.id_unit = unit.id_unit');
		$this->db->where('unit.id_unit', $id);
		$this->db->where($query);
		$this->db->where('jawaban.published', '2');
		return $this->db->get('jawaban');
	}

	function get_responden_by_unit($id,$bulan,$tahun)
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
		$this->db->join('unit', 'responden.id_unit = unit.id_unit');
		$this->db->where('unit.id_unit', $id);
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

		$this->db->join('responden', 'unit.id_unit = responden.id_unit');
		$this->db->join('jawaban', 'responden.id_responden = jawaban.id_responden');
		$this->db->where('jawaban.jawaban', $pilihan);
		$this->db->where('jawaban.id_pertanyaan', $id);
		$this->db->where($query);
		$this->db->order_by('jawaban.created_date', 'desc');
		$this->db->group_by('unit.id_unit');
		return $this->db->get('unit');
	}	

	function get_hasil_pilihan($id,$bulan,$tahun,$pilihan,$unit)
	{
		if ($bulan == 'setahun') {
			$query = 'MONTH(jawaban.created_date) BETWEEN "01" and "'.date('m').'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}
		else
		{
			$query = 'MONTH(jawaban.created_date) = "'.$bulan.'" and YEAR(jawaban.created_date) = "'.$tahun.'"';
		}

		$this->db->join('responden', 'unit.id_unit = responden.id_unit');
		$this->db->join('jawaban', 'responden.id_responden = jawaban.id_responden');
		$this->db->where('jawaban.id_pertanyaan', $id);
		$this->db->where('jawaban.jawaban', $pilihan);
		$this->db->where('unit.id_unit', $unit);
		$this->db->where($query);
		$this->db->order_by('jawaban.created_date', 'desc');
		return $this->db->get('unit');
	}	

}

/* End of file M_unit.php */
/* Location: ./application/modules/unit/models/M_unit.php */