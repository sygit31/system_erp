<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_reject_detail extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_REJECT_DETAIL VALUES (SEQ_REJECT_DETAIL.NEXTVAL,SEQ_REJECT.CURRVAL,".$data.")";
			
			$success = $this->db->query($sql);

			if ($success) {
				$sql = "INSERT INTO ERP_LOG_MUTASI_PET VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),".$data.",'OUT','REJECT')";
	
				$success = $this->db->query($sql);
			}

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


		public function getRejectDetail() {
			
			$sql = "SELECT rd.*,dp.*,p.NO_SP,tq.NOMER NOMER_QC FROM ERP_REJECT_DETAIL rd JOIN ERP_PENERIMAAN_DETAIL dp ON rd.ID_DETAIL_TERIMA = dp.ID_DETAIL_TERIMA JOIN ERP_PENERIMAAN p ON dp.ID_TERIMA = p.ID_TERIMA JOIN ERP_TEST_QC tq ON rd.ID_DETAIL_TERIMA = tq.ID_DETAIL_TERIMA";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>