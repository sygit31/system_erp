<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_penerimaan extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_PENERIMAAN VALUES (CURRENT_DATE,SEQ_PENERIMAAN.NEXTVAL,".$this->db->escape($data['Tanggal']).",".$this->db->escape($data['NomerSP']).",".$this->db->escape($data['IdLogin']).",".$this->db->escape($data['IdPoDetail']).")";
			
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