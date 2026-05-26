<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_karyawan42 extends CI_Model 
	{

		public function getKaryawanById($id) 
		{
			$this->db = $this->load->database('IPB42', true);
			
			$this->db->select('*');
			$this->db->from('karyawan');
			$this->db->where('id', $id);
			$query = $this->db->get();
			return $query->row();
		}


	}
?>