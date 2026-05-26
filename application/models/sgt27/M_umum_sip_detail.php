<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_umum_sip_detail extends CI_Model 
	{

		
		public function save($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_UMUM_SIP_DETAIL
				(ID,ID_SIP,ID_PERMINTAAN_FILTER,JUMLAH,STATUS)
				VALUES
				(SEQ_UMUM_SIP_DETAIL.NEXTVAL,SEQ_UMUM_SIP.CURRVAL,
				".$data['id_pf'].",".$data['jumlah'].",'".$data['status']."')";
			
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

		public function update($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_UMUM_SIP_DETAIL SET 
				STATUS = '".$data['status']."'
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