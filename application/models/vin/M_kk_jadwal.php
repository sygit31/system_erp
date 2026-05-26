<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_kk_jadwal extends CI_Model 
	{

		public function cekByTanggal($data) 
		{
			$sql = "SELECT * FROM ERP_KK_JADWAL WHERE TANGGAL = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		
	}
?>