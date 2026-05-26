<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_terima_bskk extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_TERIMA_BSKK 
            (ID,JENIS,JUMLAH,TANGGAL)
            VALUES
            (MI_MASTER_TERIMA_BSKK.NEXTVAL,'". $data['JENIS'] ."',
            '". $data['JUMLAH'] ."','". $data['TANGGAL'] ."')";
			
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

		public function getTerimaOra($bulan,$tahun) 
		{
			$sql = "SELECT jumlah, CONCAT( jenis, ' ', tanggal) jenis FROM master_terima_bskk
			WHERE DATE_FORMAT(tanggal,'%Y%m') = '".$tahun.$bulan."' 
			ORDER BY tanggal";

			$query = $this->db->query($sql);
			return $query->result();
		}
		
		// ===================================================
		// ===================================================
		// ===================================================

		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO MASTER_TERIMA_BSKK 
            (JENIS,JUMLAH,TANGGAL)
            VALUES
            ('". $data['JENIS'] ."',
            '". $data['JUMLAH'] ."','". $data['TANGGAL'] ."')";
			
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

		public function getTerima($bulan,$tahun) 
		{
			$sql = "SELECT jumlah, CONCAT( jenis, ' ', DATE_FORMAT(tanggal,'%d/%m/%Y')) jenis FROM master_terima_bskk
			WHERE DATE_FORMAT(tanggal,'%Y%m') = '".$tahun.$bulan."' 
			ORDER BY tanggal";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getDataLast() 
		{
			$sql = "SELECT *,DATE_FORMAT(tanggal,'%d/%m/%Y') tanggal_format FROM master_terima_bskk
			where tanggal > DATE_ADD(NOW(), INTERVAL -12 MONTH)
			order by id desc";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
		
	}
?>