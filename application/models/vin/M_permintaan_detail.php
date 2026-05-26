<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_permintaan_detail extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_PERMINTAAN_DETAIL
			(ID,ID_PERMINTAAN,ID_BARANG,JUMLAH,KETERANGAN,STATUS)
			VALUES (SEQ_PERMINTAAN_DETAIL.NEXTVAL,SEQ_PERMINTAAN.CURRVAL,"
			.$data['id_barang'].",".$data['jumlah'].",'"
			.$data['keterangan']."','".$data['status']."')";
			
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

		public function UpdateStatus($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_PERMINTAAN_DETAIL
			SET STATUS = '".$data['status']."'
			WHERE ID = ". $data['id_permintaan_detail'];
			
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