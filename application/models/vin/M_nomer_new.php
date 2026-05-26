<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_nomer_new extends CI_Model 
	{

		public function getLastIpbPetGudang($data) 
		{
			$sql = "SELECT * FROM ERP_NOMER_NEW
            WHERE TAHUN = ".$data['TAHUN']." 
            AND KETERANGAN = '".$data['KETERANGAN']."'";
			
			$query = $this->db->query($sql);
			// return $sql;
			return $query->result();
		}
		
		
		
	  public function getLastMutasiPet($desain,$seri,$jenis) 
		{
			$sql = "SELECT nomor,jenis,seri FROM ERP_GEN_NOMOR
            WHERE DESAIN = ".$desain." AND SERI =".$seri." 
            AND JENIS = '".$jenis."'";
			
			$query = $this->db->query($sql);
			// return $sql;
			$cari_nomor =$query->result_array();	
			return  $cari_nomor; 
		}
	

		public function updateNomer($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER_NEW SET NOMER = '".$data['NOMER']."' 
			WHERE KETERANGAN = '".$data['KETERANGAN']."'
			AND TAHUN = ".$data['TAHUN'];
			
			$success = $this->db->query($sql);

			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}

			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}
		
		public function updateNomerMutasi($desain,$no_urut,$seri,$jenis) 
		{
		$this->db->query("Update ERP_GEN_NOMOR set NOMOR='$no_urut' where desain='$desain' and seri='$seri' and jenis='$jenis'"); 
		}
	}
	
?>