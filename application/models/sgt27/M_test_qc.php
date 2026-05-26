<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_test_qc extends CI_Model 
	{
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_QC VALUES (SEQ_TEST_QC.NEXTVAL,CURRENT_DATE,".$this->db->escape($data['id_detail_terima']).",".$this->db->escape($data['id_login']).",".$this->db->escape($data['grade']).",".$this->db->escape($data['nomer']).",".$this->db->escape($data['id_stage']).")";
			
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


		public function getIdByIdDetailTerima($data) {

			$sql = "SELECT ID FROM ERP_TEST_QC WHERE ID_DETAIL_TERIMA = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getTestByIdDetailTerima($data) {

			$sql = "SELECT TQ.ID_DETAIL_TERIMA,TC.TEST_DESCRIPTION,TC.JENIS,TC.PRIORITAS,TQD.*,DTC.HASIL,DTC.RANGE,TQ.NOMER NOMER_TEST FROM ERP_TEST_QC TQ JOIN ERP_TEST_QC_DETAIL TQD ON TQ.ID = TQD.ID_TEST_QC JOIN ERP_TEST_CODE TC ON TQD.ID_TEST_CODE = TC.ID_TEST_CODE LEFT JOIN ERP_TEST_CODE_DETAIL DTC ON TQD.HASIL_TEST = DTC.ID_DETAIL_TEST_CODE WHERE TQ.ID_DETAIL_TERIMA =". $data ." ORDER BY TC.PRIORITAS,TC.TEST_DESCRIPTION";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getHasiltestByIdDetailTerima($data) {

			$sql = "SELECT TC.ID_TEST_CODE,TC.TEST_DESCRIPTION,TQD.HASIL_TEST,TCD.HASIL FROM ERP_TEST_QC TQ JOIN ERP_TEST_QC_DETAIL TQD ON TQ.ID = TQD.ID_TEST_QC JOIN ERP_TEST_CODE TC ON TQD.ID_TEST_CODE = TC.ID_TEST_CODE LEFT JOIN ERP_TEST_CODE_DETAIL TCD ON TQD.HASIL_TEST = TCD.ID_DETAIL_TEST_CODE WHERE TQ.ID_DETAIL_TERIMA = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function delete($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "DELETE FROM ERP_TEST_QC WHERE ID_DETAIL_TERIMA = ".$data;
			
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