<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_rnd_bom extends CI_Model 
	{

		public function getBOM($ID_PROSES,$ID_STATION_FLOW) 
		{
			$sql = "SELECT RB.ID ID_BOM, B.ID ID_BARANG, B.NAMA , RB.QTY, B.SATUAN, B.SPESIFIKASI,B.JENIS,B.TAHUN FROM ERP_RND_BOM RB 
            JOIN ERP_BARANG B ON RB.ID_BARANG = B.ID
            WHERE ID_RND_PROSES = ".$ID_PROSES." AND ID_STATION_FLOW = ".$ID_STATION_FLOW." AND B.AKTIF = 1 AND RB.AKTIF = 1
            ORDER BY B.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getBarangCountinueByProses($idProses) 
		{
			$sql = "SELECT BRG.NAMA,BRG.SPESIFIKASI,BRG.SATUAN FROM ERP_RND_BOM B 
			JOIN ERP_RND_PROSES P ON B.ID_RND_PROSES = P.ID
			JOIN ERP_BARANG BRG ON B.ID_BARANG = BRG.ID
			WHERE P.ID = ".$idProses." AND BRG.FLAG_PENGGUNAAN = 'CONTINUE'";

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>