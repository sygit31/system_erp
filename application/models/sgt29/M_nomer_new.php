<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_nomer_new extends CI_Model 
{

	public function getLastIpbPetGudang($data) 
	{
		$sql = "SELECT * FROM ERP_NOMER_NEW
		WHERE TAHUN = ".$data['TAHUN']." 
		AND KETERANGAN = '".$data['KETERANGAN']."'";
		
		$query = $this->db->query($sql);
			// return $sql;
		return $query->result();
	}

	public function updateNomer($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "UPDATE ERP_NOMER_NEW SET NOMER = '".$data['NOMER']."' 
		WHERE KETERANGAN = '".$data['KETERANGAN']."'
		AND TAHUN = ".$data['TAHUN'];
		
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