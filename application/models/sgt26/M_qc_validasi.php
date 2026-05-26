<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_qc_validasi extends CI_Model 
	{

		// public function getAkses($data) 
		// {
		// 	$sql = "SELECT * FROM ERP_AKSES WHERE ID_AKUN = ". $data;

		// 	$query = $this->db->query($sql);
		// 	return $query->result();
		// }
		

		// public function getAllAkses() 
		// {
		// 	$sql = "SELECT K.NAMA,BAG.NAMA NAMA_BAGIAN,A.* FROM ERP_AKSES A JOIN ERP_AKUN B ON A.ID_AKUN = B.ID JOIN ERP_KARYAWAN K ON B.ID_KARYAWAN = K.ID JOIN ERP_BAGIAN BAG ON K.ID_BAGIAN = BAG.ID ORDER BY K.NAMA,BAG.NAMA";

		// 	$query = $this->db->query($sql);
		// 	return $query->result();
		// }


		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_QC_VALIDASI (ID,ID_DETAIL_TERIMA,STATUS_QC,CATATAN,ID_INPUT,TANGGAL,MUTASI_ID_DETAIL_TERIMA,KATEGORI) 
					VALUES (SEQ_QC_VALIDASI.NEXTVAL,".$data['ID_DETAIL_TERIMA'].",'".$data['STATUS_QC']."','".$data['CATATAN']."',".$data['ID_INPUT'].",TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),".$data['MUTASI_ID_DETAIL_TERIMA'].",'".$data['KATEGORI']."')";
			
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