<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_karyawan extends CI_Model 
	{

		public function getKaryawanById($id) 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('ERP_KARYAWAN');
			$this->db->where('ID', $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function getAllKaryawan() 
		{
			$sql = "SELECT * FROM ERP_KARYAWAN ORDER BY NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>