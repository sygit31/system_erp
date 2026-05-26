<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_waste extends CI_Model 
	{

		public function getDataByIdProses($data) 
		{
			$sql = "SELECT * FROM ERP_WASTE WHERE TAHUN = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>