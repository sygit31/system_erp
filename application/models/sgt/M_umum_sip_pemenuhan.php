<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_umum_sip_pemenuhan extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_UMUM_SIP_PEMENUHAN 
				(ID,ID_SIP_DETAIL,TANGGAL,JUMLAH)
				VALUES
				(SEQ_UMUM_SIP_PEMENUHAN.NEXTVAL,".$data['id_sip_detail'].",
				TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),".$data['jumlah'].")";
			
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

		
		public function getTotalPemenuhan() 
		{
			$sql = "SELECT NVL((
				SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
				WHERE ID_SIP_DETAIL = 18),0) JUMLAH 
				FROM DUAL";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>