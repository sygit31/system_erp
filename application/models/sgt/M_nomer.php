<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_nomer extends CI_Model 
	{
		public function getNomerLabel() {
			$sql = "SELECT LABEL_QC FROM ERP_NOMER WHERE ID = 1";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getNomerLabelByTahun($tahun) {
			$sql = "SELECT LABEL_QC FROM ERP_NOMER WHERE TAHUN = ". $tahun;

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getNomerKK($tahun){
			$sql = "SELECT KK FROM ERP_NOMER WHERE TAHUN = ". $tahun;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateNomerLabel($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET LABEL_QC = '".$data."' WHERE ID = 1";
			
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

		public function updateNomerLabelByTahun($data,$tahun) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET LABEL_QC = '".$data."' WHERE TAHUN = ".$tahun;
			
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

		public function updateNomerKKByTahun($data,$tahun) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET KK = '".$data."' WHERE TAHUN = ".$tahun;
			
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


		public function getNomerTestQc() {

			$sql = "SELECT TEST_QC FROM ERP_NOMER WHERE ID = 1";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getNomerTestQcByTahun($tahun) {

			$sql = "SELECT TEST_QC FROM ERP_NOMER WHERE TAHUN = ".$tahun;

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function updateNomerTestQc($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET TEST_QC = '".$data."' WHERE ID = 1";
			
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

		public function updateNomerTestQcByTahun($data,$tahun) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET TEST_QC = '".$data."' WHERE TAHUN = ".$tahun;
			
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

		public function getNomerReject() {

			$sql = "SELECT REJECT FROM ERP_NOMER WHERE ID = 1";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getNomerRejectByTahun($tahun) {

			$sql = "SELECT REJECT FROM ERP_NOMER WHERE TAHUN=".$tahun;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateNomerReject($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET REJECT = '".$data."' WHERE ID = 1";
			
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

		public function updateNomerRejectByTahun($data,$tahun) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET REJECT = '".$data."' WHERE TAHUN=".$tahun;
			
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


		public function getNomerBASTB() {

			$sql = "SELECT BASTB FROM ERP_NOMER WHERE ID = 1";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateNomerBASTB($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET BASTB = '".$data."' WHERE ID = 1";
			
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

		public function getNomerQCreject() {

			$sql = "SELECT LABEL_QC_REJECT FROM ERP_NOMER WHERE ID = 1";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getNomerQCrejectByTahun($tahun) {

			$sql = "SELECT LABEL_QC_REJECT FROM ERP_NOMER WHERE TAHUN=".$tahun;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateNomerQCreject($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET LABEL_QC_REJECT = '".$data."' WHERE ID = 1";
			
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

		public function updateNomerQCrejectByTahun($data,$tahun) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_NOMER SET LABEL_QC_REJECT = '".$data."' WHERE TAHUN=".$tahun;
			
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
		
	}
?>