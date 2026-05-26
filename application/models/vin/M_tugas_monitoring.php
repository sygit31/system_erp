<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_tugas_monitoring extends CI_Model 
	{
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TUGAS_MONITORING 
            (ID,ID_TUGAS_PARAMETER,PROGRES,CATATAN,TANGGAL) VALUES 
            (SEQ_TUGAS_MONITORING.NEXTVAL,'".$data['id']."','".
            $data['progres']."','".$data['catatan']."','".$data['tanggal']."')";
			
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


		
		public function getMonitoringByIdTugas($idTugas) {

			$sql = "SELECT DISTINCT TM.TANGGAL,T.ID FROM ERP_TUGAS_MONITORING TM
			JOIN ERP_TUGAS_PARAMETER TP ON TM.ID_TUGAS_PARAMETER = TP.ID
			JOIN ERP_TUGAS T ON TP.ID_TUGAS = T.ID
			WHERE T.ID=$idTugas
			ORDER BY TANGGAL";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getMonitoringByIdTugasDANtanggal($idTugas,$tanggal) {

			$sql = "SELECT TM.*,TP.PARAMETER FROM ERP_TUGAS_MONITORING TM
			JOIN ERP_TUGAS_PARAMETER TP ON TM.ID_TUGAS_PARAMETER = TP.ID
			WHERE TP.ID_TUGAS = $idTugas AND TM.TANGGAL = '$tanggal'
			ORDER BY TP.PARAMETER";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>