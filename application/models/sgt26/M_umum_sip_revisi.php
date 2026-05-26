<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_umum_sip_revisi extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_UMUM_SIP_REVISI 
				(ID,ID_SIP_DETAIL,TANGGAL,JUMLAH)
				VALUES
				(SEQ_UMUM_SIP_REVISI.NEXTVAL,SEQ_UMUM_SIP_DETAIL.CURRVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),".$data.")";
			
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

			$sql = "UPDATE ERP_UMUM_SIP_REVISI SET 
				TANGGAL = TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),
				JUMLAH = ".$data['jumlah']."
				WHERE ID_SIP_DETAIL = ". $data['id_sip_detail'];
			
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