<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_survey extends CI_Model {

	function getSoal()
	{
		return $this->db->get('pertanyaan');
	}

	function save_batch($data)
	{
		return $this->db->insert_batch('jawaban', $data);
	}

	function cekResponden($where)
	{
		return $this->db->get_where('jawaban', $where);
	}

	function save($table,$data)
	{
		$this->db->insert($table,$data);
	}

	function update($table,$where,$data)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	function get_responden()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('jawaban',['published' => '2'])->num_rows();
	}

	function get_responden_1()
	{
		$this->db->distinct();
		$this->db->select('id_responden');
		return $this->db->get_where('jawaban',['published' => '1']);
	}

	function join_get_responden_2($kolom,$param)
	{
		return $this->db->query('select * from (SELECT DISTINCT id_responden as a FROM jawaban where published = 2) as a  , responden  b where  a = b.id_responden and b.'.$kolom.' = "'.$param.'"');
	}


	 
	

	/*admin*/
	function auth($where)
	{
		return $this->db->get_where('admin', $where);
	}
	
	

}

/* End of file M_survey.php */
/* Location: ./application/modules/survey/models/M_survey.php */