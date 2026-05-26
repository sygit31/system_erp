<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_nomer extends CI_Model 
	{
		public function getNomerLabel() {

			$sql = "SELECT LABEL_QC FROM ERP_NOMER WHERE ID = 1";

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


		public function getNomerTestQc() {

			$sql = "SELECT TEST_QC FROM ERP_NOMER WHERE ID = 1";

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


		public function getNomerReject() {

			$sql = "SELECT REJECT FROM ERP_NOMER WHERE ID = 1";

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

	}
?>