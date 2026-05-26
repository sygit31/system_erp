<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_barang extends CI_Model 
	{

		public function getAllBarangUmum() 
		{
			$sql = "SELECT * FROM ERP_BARANG ORDER BY NAMA";
			
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>