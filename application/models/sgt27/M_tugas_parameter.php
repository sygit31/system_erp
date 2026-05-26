<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_tugas_parameter extends CI_Model 
	{
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TUGAS_PARAMETER (ID,ID_TUGAS,PARAMETER,PROGRES) 
                    VALUES (SEQ_TUGAS_PARAMETER.NEXTVAL,SEQ_TUGAS.CURRVAL,"
                    .$this->db->escape($data['parameter']).","
                    .$this->db->escape($data['progres']).")";
			
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

		public function getTugasParameterByStatusTugasNDate($status) {

			$sql = "SELECT P.* FROM ERP_TUGAS_PARAMETER P
            JOIN ERP_TUGAS T ON P.ID_TUGAS = T.ID
            WHERE T.STATUS = '$status'
            AND T.PERIODE_AKHIR >= CURRENT_DATE-1";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getTugasParameterByIdTugas($id_tugas) {

			$sql = "SELECT P.* FROM ERP_TUGAS_PARAMETER P
			JOIN ERP_TUGAS T ON P.ID_TUGAS = T.ID
			WHERE P.ID_TUGAS IN ($id_tugas)";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>