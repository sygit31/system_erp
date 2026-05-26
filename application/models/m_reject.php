<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_reject extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_REJECT VALUES (SEQ_REJECT.NEXTVAL,".$this->db->escape($data['nomer']).",CURRENT_DATE,".$this->db->escape($data['nomer_po']).",".$this->db->escape($data['id_input']).")";
			
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


		public function getReject() {

			$sql = "SELECT * FROM ERP_REJECT";

			$query = $this->db->query($sql);
			return $query->result();
		}
		

		public function getRejectById($data) {
			
			$sql = "SELECT r.*,rd.*,dp.*,p.NO_SP,tq.NOMER NOMER_QC FROM ERP_REJECT r JOIN ERP_REJECT_DETAIL rd ON r.ID = rd.ID_REJECT JOIN ERP_PENERIMAAN_DETAIL dp ON rd.ID_DETAIL_TERIMA = dp.ID_DETAIL_TERIMA JOIN ERP_PENERIMAAN p ON dp.ID_TERIMA = p.ID_TERIMA  JOIN ERP_TEST_QC tq ON rd.ID_DETAIL_TERIMA = tq.ID_DETAIL_TERIMA WHERE r.ID = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>