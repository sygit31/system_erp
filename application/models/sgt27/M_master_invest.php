<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_invest extends CI_Model 
	{
		public function getInvestOra() {
			$sql = "SELECT * FROM MASTER_INVEST";

			$query = $this->db->query($sql);
			return $query->result();
		}

		
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_INVEST 
            (KODE_INVEST,NOMOR_IJIN_INVEST,JENIS_INVEST,
			JUMLAH,DIAJUKAN_OLEH,RENCANA_BIAYA,PEMOHON,TANGGAL_IJIN_INVEST)
            VALUES
            ('". $data['KODE_INVEST'] ."','". $data['NOMOR_IJIN_INVEST'] ."',
            '". $data['JENIS_INVEST'] ."','". $data['JUMLAH'] ."',
            '". $data['DIAJUKAN_OLEH'] ."','". $data['RENCANA_BIAYA'] ."',
            '". $data['PEMOHON'] ."','". $data['TANGGAL_IJIN_INVEST'] ."')";
			
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

		public function getInvestJoinOra() {
			$sql = "SELECT I.*,DA.UNIT AJU_UNIT,DA.NAMA_DEPARTEMENT AJU_DEPT,DM.UNIT MOH_UNIT,DM.NAMA_DEPARTEMENT MOH_DEPT FROM MASTER_INVEST I
			JOIN MASTER_DEPARTEMEN DA ON I.DIAJUKAN_OLEH = DA.ID_DEPARTEMENT
			JOIN MASTER_DEPARTEMEN DM ON I.PEMOHON = DM.ID_DEPARTEMENT";

			$query = $this->db->query($sql);
			return $query->result();
		}


		// ===========================================================
		// ===========================================================
		// ===========================================================

		public function getInvest() {
			$sql = "SELECT KODE_INVEST,NOMOR_IJIN_INVEST,JENIS_INVEST,JUMLAH,
			DIAJUKAN_OLEH,RENCANA_BIAYA,PEMOHON,TANGGAL_IJIN_INVEST FROM MASTER_INVEST";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			$xyz = $query->result();
			return $xyz;
		}

		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO MASTER_INVEST 
            (KODE_INVEST,NOMOR_IJIN_INVEST,JENIS_INVEST,
			JUMLAH,DIAJUKAN_OLEH,RENCANA_BIAYA,PEMOHON,TANGGAL_IJIN_INVEST)
            VALUES
            ('". $data['KODE_INVEST'] ."','". $data['NOMOR_IJIN_INVEST'] ."',
            '". $data['JENIS_INVEST'] ."','". $data['JUMLAH'] ."',
            '". $data['DIAJUKAN_OLEH'] ."','". $data['RENCANA_BIAYA'] ."',
            '". $data['PEMOHON'] ."','". $data['TANGGAL_IJIN_INVEST'] ."')";
			
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

		
		public function getInvestJoin() {
			$sql = "SELECT I.KODE_INVEST,I.NOMOR_IJIN_INVEST,I.JENIS_INVEST,
			I.JUMLAH,I.DIAJUKAN_OLEH,I.RENCANA_BIAYA,I.PEMOHON,I.TANGGAL_IJIN_INVEST,
			DA.UNIT AJU_UNIT,DA.NAMA_DEPARTEMENT AJU_DEPT,DM.UNIT MOH_UNIT,
			DM.NAMA_DEPARTEMENT MOH_DEPT FROM MASTER_INVEST I
			JOIN MASTER_DEPARTEMEN DA ON I.DIAJUKAN_OLEH = DA.ID_DEPARTEMENT
			JOIN MASTER_DEPARTEMEN DM ON I.PEMOHON = DM.ID_DEPARTEMENT
			ORDER BY I.TANGGAL_IJIN_INVEST DESC";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();

		}


		
	}
?>