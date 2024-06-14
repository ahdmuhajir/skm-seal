<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tes2 extends CI_Model {

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

	function save($data)
	{
		$this->db->insert('jawaban', $data);
	}

}

/* End of file M_tes2.php */
/* Location: ./application/modules/tes2/models/M_tes2.php */