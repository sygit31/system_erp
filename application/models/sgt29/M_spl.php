<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_spl extends CI_Model 
	{
				
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_SPL
            (ID,ID_KARYAWAN,ID_BAGIAN,MULAI,SELESAI,STATUS,TUJUAN)
            VALUES
            (SEQ_SPL.NEXTVAL,".$data['id_karyawan'].",".$data['id_bagian'].",
			TO_DATE('".$data['mulai']."','DD-MM-YYYY HH24:MI'),
			TO_DATE('".$data['selesai']."','DD-MM-YYYY HH24:MI'),
			'".$data['status']."','".$data['tujuan']."')";
			
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


		public function ubah($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_SPL
			SET
			MULAI = TO_DATE('".$data['mulai']."','DD-MM-YYYY HH24:MI'),
			SELESAI = TO_DATE('".$data['selesai']."','DD-MM-YYYY HH24:MI')
			WHERE
			ID = ". $data['id'];
			
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


		public function getSPLpengajuan() 
		{
			$sql = "SELECT A.ID,TO_CHAR(A.MULAI,'DD-MM-YYYY HH24:MI') MULAI,TO_CHAR(A.SELESAI,'DD-MM-YYYY HH24:MI') SELESAI,B.NAMA BAGIAN,K.NAMA KARYAWAN,A.TUJUAN 
			FROM ERP_SPL A JOIN
			ERP_BAGIAN B ON A.ID_BAGIAN = B.ID JOIN
			ERP_KARYAWAN K ON A.ID_KARYAWAN = K.ID
			WHERE A.STATUS = 'pengajuan'
			ORDER BY B.NAMA,A.MULAI,K.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getSPLpengajuanById($idx) 
		{
			$sql = "SELECT A.ID,TO_CHAR(A.MULAI,'YYYY-MM-DD HH24:MI') MULAI,TO_CHAR(A.SELESAI,'YYYY-MM-DD HH24:MI') SELESAI,B.NAMA BAGIAN,K.NAMA KARYAWAN 
			FROM ERP_SPL A JOIN
			ERP_BAGIAN B ON A.ID_BAGIAN = B.ID JOIN
			ERP_KARYAWAN K ON A.ID_KARYAWAN = K.ID
			WHERE A.ID = ". $idx ;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getSPLBelumLewat() 
		{
			$sql = "SELECT A.ID,TO_CHAR(A.MULAI,'DD-MM-YYYY HH24:MI') MULAI,TO_CHAR(A.SELESAI,'DD-MM-YYYY HH24:MI') SELESAI,A.TUJUAN,A.STATUS,B.NAMA BAGIAN, K.NAMA KARYAWAN FROM ERP_SPL A
			JOIN ERP_BAGIAN B ON A.ID_BAGIAN = B.ID
			JOIN ERP_KARYAWAN K ON A.ID_KARYAWAN = K.ID
			WHERE 
			(A.STATUS = 'pengajuan' or A.STATUS = 'setuju')
			AND A.MULAI > CURRENT_DATE
			ORDER BY
			B.NAMA,A.MULAI,K.NAMA" ;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getSPLTotalLembur() 
		{
			$sql = "SELECT DISTINCT K.ID,K.NIK,K.NAMA KARYAWAN, B.NAMA BAGIAN,
			(
				SELECT NVL(SUM(round(((SELESAI - MULAI) * (60 * 24)),0)),0) total_lembur FROM ERP_SPL
				WHERE ID_KARYAWAN = K.ID
				and STATUS = 'setuju'
			) TOTAL_LEMBUR
			 FROM ERP_KARYAWAN K 
			 JOIN ERP_SPL S ON S.ID_KARYAWAN = K.ID
			 JOIN ERP_BAGIAN B ON S.ID_BAGIAN = B.ID
			WHERE S.STATUS = 'setuju'" ;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function setStatus($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_SPL 
			SET STATUS = '". $data['status'] ."' 
			WHERE ID = ". $data['id'];
			
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