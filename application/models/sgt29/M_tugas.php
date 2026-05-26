<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_tugas extends CI_Model 
	{
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TUGAS (ID,PERIODE_AWAL,PERIODE_AKHIR,ID_PROJECT,ID_PIC,ID_KARYAWAN,TUGAS,
                        TARGET,NILAI,NILAI_APPROV,STATUS) 
                    VALUES (SEQ_TUGAS.NEXTVAL,"
                    .$this->db->escape($data['tanggal_awal']).","
                    .$this->db->escape($data['tanggal_akhir']).","
                    .$this->db->escape($data['project']).","
                    .$this->db->escape($data['pic']).","
                    .$this->db->escape($data['karyawan']).","
                    .$this->db->escape($data['tugas']).","
                    .$this->db->escape($data['target']).","
                    .$this->db->escape($data['nilai']).","
                    .$this->db->escape($data['nilai_app']).","
                    .$this->db->escape($data['status']).")";
			
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


		public function getTugasByStatus($status) {

			$sql = "SELECT T.*,P.NAMA PIC,K.NAMA KARYAWAN,B.NAMA BAGIAN,NVL(SP.TUGAS, 'Tugas Pokok') PROJECT FROM ERP_TUGAS T
			JOIN ERP_KARYAWAN P ON T.ID_PIC = P.ID
			JOIN ERP_KARYAWAN K ON T.ID_KARYAWAN = K.ID
			JOIN ERP_BAGIAN B ON K.ID_BAGIAN = B.ID
			LEFT JOIN ERP_SIS_PROJECT SP ON T.ID_PROJECT = SP.ID
			WHERE T.STATUS = '$status'
			AND T.PERIODE_AKHIR >= CURRENT_DATE-1
			ORDER BY B.NAMA,K.NAMA";


			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getTugasanByIdKaryawanStatus($IdKaryawan,$status) {

			$sql = "SELECT T.*,P.NAMA PIC,K.NAMA KARYAWAN,B.NAMA BAGIAN,NVL(SP.TUGAS, 'Tugas Pokok') PROJECT 
			FROM ERP_TUGAS T
            JOIN ERP_KARYAWAN P ON T.ID_PIC = P.ID
            JOIN ERP_KARYAWAN K ON T.ID_KARYAWAN = K.ID
            JOIN ERP_BAGIAN B ON K.ID_BAGIAN = B.ID
            LEFT JOIN ERP_SIS_PROJECT SP ON T.ID_PROJECT = SP.ID
            WHERE T.STATUS = '$status'
			AND T.PERIODE_AKHIR >= CURRENT_DATE-1
            AND B.ID IN
                (
                    SELECT ID_BAGIAN FROM ERP_VER_DEPT WHERE ID_KARYAWAN = ".$IdKaryawan." 
                )
            ORDER BY B.NAMA,K.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateApproval($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_TUGAS SET 
					NILAI_APPROV = ".$this->db->escape($data['approval']).",
					STATUS = ".$this->db->escape($data['status'])." 
					WHERE ID = ".$this->db->escape($data['id']);
			
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


		public function updateStatus($id,$status) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_TUGAS SET 
					STATUS = '".$status."' 
					WHERE ID = ".$id;
			
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