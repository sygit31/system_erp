<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_detail_test_code extends CI_Model 
	{

		public function save($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_CODE_DETAIL VALUES (SEQ_DETAIL_TEST_CODE.NEXTVAL,SEQ_TEST_CODE.CURRVAL,".$this->db->escape($data['Range']).",".$this->db->escape($data['Hasil']).",".$this->db->escape($data['Max']).",".$this->db->escape($data['Min']).",'ON')";
					
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


		public function editBaru($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_CODE_DETAIL VALUES (SEQ_DETAIL_TEST_CODE.NEXTVAL,".$this->db->escape($data['IdTestCode']).",".$this->db->escape($data['Range']).",".$this->db->escape($data['Hasil']).",".$this->db->escape($data['Max']).",".$this->db->escape($data['Min']).",'ON')";
					
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


		public function editLama($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_TEST_CODE_DETAIL SET HASIL = '".$data['Hasil']."',MAX = '".$data['Max']."',MIN = '".$data['Min']."' WHERE ID_DETAIL_TEST_CODE = ".$data['IdDetailTestCode'];
					
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


		public function delete($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_TEST_CODE_DETAIL SET STATUS = 'OFF' WHERE ID_DETAIL_TEST_CODE = ".$data;
					
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

		public function getByIdTestCode($data){

			$sql = "SELECT * FROM ERP_TEST_CODE_DETAIL WHERE STATUS = 'ON' AND ID_TEST_CODE =". $data . "ORDER BY RANGE DESC";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>