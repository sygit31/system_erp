<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_test_group extends CI_Model 
	{

	 	public function save($data) 
		{
			// print_r($data);

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_GROUP VALUES (SEQ_TEST_GROUP.NEXTVAL,".$data['idTest'].",".$data['idBarang'].")";
			
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

			$sql = "DELETE FROM ERP_TEST_GROUP WHERE ID = ". $data;
					
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

	
		public function getTestCodeByIdBarang($data) {
			$sql = "SELECT tc.* FROM ERP_TEST_GROUP tg JOIN ERP_TEST_CODE tc ON tg.ID_TEST_CODE = tc.ID_TEST_CODE WHERE tg.ID_MASTER_BARANG =". $data ." ORDER BY tc.PRIORITAS,tc.TEST_DESCRIPTION";

			$query = $this->db->query($sql);
			return $query->result();
		}
    }
?>