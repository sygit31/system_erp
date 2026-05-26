<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_saldo_akhir_bskk extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO SALDO_AKHIR_BSKK 
            (ID,BULAN,TAHUN,SALDO)
            VALUES
            (MI_SALDO_AKHIR_BSKK.NEXTVAL,'". $data['BULAN'] ."',
            '". $data['TAHUN'] ."','". $data['SALDO'] ."')";
			
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

		public function getSaldoOra($bulan,$tahun) 
		{
			$sql = "SELECT * FROM saldo_akhir_bskk
			WHERE bulan = '".$bulan."' AND tahun = '".$tahun."'";

			$this->db = $this->load->database('default', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
		// ========================================================
		// ========================================================
		// ========================================================

		public function getSaldo($bulan,$tahun) 
		{
			$sql = "SELECT * FROM saldo_akhir_bskk
			WHERE bulan = '".$bulan."' AND tahun = '".$tahun."'";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO SALDO_AKHIR_BSKK 
            (BULAN,TAHUN,SALDO)
            VALUES
            ('". $data['BULAN'] ."',
            '". $data['TAHUN'] ."','". $data['SALDO'] ."')";
			
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

		public function getDataLast() 
		{
			$sql = "SELECT * FROM saldo_akhir_bskk
			order by id desc
			limit 12";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>