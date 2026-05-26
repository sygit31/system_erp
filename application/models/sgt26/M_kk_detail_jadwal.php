<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_kk_detail_jadwal extends CI_Model 
	{

		public function getJadwalByTgl($data) 
		{
			$sql = "SELECT SUM(JAM) JAM FROM ERP_KK_DETAIL_JADWAL WHERE STATUS = 'T' AND TANGGAL = '".$data."'";

			$query = $this->db->query($sql);
			return $query->result();
		}


		
	}
?>