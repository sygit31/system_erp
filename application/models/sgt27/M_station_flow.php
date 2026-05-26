<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_station_flow extends CI_Model 
	{
			
		public function get_flow($ID_PROSES) 
		{
			$sql = "SELECT SF.ID ID_STATION_FLOW,S.NAMA,SF.URUT FROM 
			ERP_STATION_FLOW SF JOIN ERP_RND_PROSES P ON SF.KODE = P.KODE_STATION_FLOW 
			JOIN ERP_STATION S ON SF.ID_STATION = S.ID
			WHERE P.ID = ".$ID_PROSES." AND S.STATUS = 'Y' AND SF.STATUS = 'T'
			ORDER BY SF.URUT";

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>