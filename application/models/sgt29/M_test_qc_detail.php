<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_test_qc_detail extends CI_Model 
	{
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_QC_DETAIL VALUES (SEQ_TEST_QC_DETAIL.NEXTVAL,SEQ_TEST_QC.CURRVAL,".$this->db->escape($data['id_test_code']).",".$this->db->escape($data['hasil_test']).")";
			
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
			$this->db=$this->load->database('default',true);

			$sql = "DELETE FROM ERP_TEST_QC_DETAIL WHERE ID_TEST_QC = ".$data;
			
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


		public function getSaveTest($data) 
		{
			$sql = "SELECT D.ID_TEST_CODE,D.HASIL_TEST FROM ERP_TEST_QC_DETAIL D JOIN ERP_TEST_QC T ON D.ID_TEST_QC = T.ID WHERE T.ID_DETAIL_TERIMA = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>