<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_log_mutasi_pet_stok extends CI_Model 
	{
		public function UpdateStok($sum,$roll,$meter) 
		{
			$sql = "SELECT * FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL = TO_CHAR(CURRENT_DATE,'DD-MM-YYYY')";
			// $sql = "SELECT * FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL = '17/9/2019'"; //coba

			$query = $this->db->query($sql);
			$stokSekarang = $query->result();

			// print_r($stokSekarang);

			$stokRoll = 0;
			$stokMeter = 0;

			if (!empty($stokSekarang)) {
				// print_r('sekarang');

				$stokRoll = (int)$stokSekarang[0]->STOK_ROLL + (int)($sum.$roll);
				$stokMeter = (int)$stokSekarang[0]->STOK_METER + (int)($sum.$meter);

				// Update yang sekarang //////////////////////////////////////////////////////////
				$sql = "UPDATE ERP_LOG_MUTASI_PET_STOK SET STOK_ROLL = ".$stokRoll.",STOK_METER=".$stokMeter." WHERE ID = ".$stokSekarang[0]->ID;
					
				$success = $this->db->query($sql);
			}else{
				// print_r('terakhir');
				$sql = "SELECT * FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL = (SELECT MAX(TANGGAL) FROM ERP_LOG_MUTASI_PET_STOK)";

				$query = $this->db->query($sql);
				$stokTerakhir = $query->result();

				if (!empty($stokTerakhir)) {
					$stokRoll = (int)$stokTerakhir[0]->STOK_ROLL + (int)($sum.$roll);
					$stokMeter = (int)$stokTerakhir[0]->STOK_METER + (int)($sum.$meter);
				}

				// Insert Baru //////////////////////////////////////////////////////////
				$sql = "INSERT INTO ERP_LOG_MUTASI_PET_STOK VALUES (SEQ_LOG_MUTASI_PET_STOK.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD-MM-YYYY'),".$stokRoll.",".$stokMeter.")";
					
				$success = $this->db->query($sql);
			}

			$this->db->trans_commit();
			$this->db->trans_complete();

		}
		
		public function getLogByDate($dataDate) 
		{
			$sql = "SELECT * FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL = '".$dataDate."'";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getLogMaxDateBefore($dataDate) 
		{
			$sql = "SELECT * FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL = (SELECT MAX(TANGGAL) FROM ERP_LOG_MUTASI_PET_STOK WHERE TANGGAL < '".$dataDate."')";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>