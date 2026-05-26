<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_rnd_produk_detail extends CI_Model 
	{

		public function getDataByIdProses($data) 
		{
			$sql = "SELECT PD.*,PS.DESAIN FROM ERP_RND_PRODUK_DETAIL PD 
					JOIN ERP_RND_PRODUK P ON PD.ID_PRODUK = P.ID 
					JOIN ERP_RND_PROSES PS ON P.ID = PS.ID_PRODUK
					WHERE PS.ID = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>