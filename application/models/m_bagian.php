<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_bagian extends CI_Model 
	{

		public function getAllBagian() 
		{
			$sql = "SELECT * FROM ERP_BAGIAN ORDER BY NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>