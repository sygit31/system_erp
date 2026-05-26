<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prod_kary extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT MAX(ID) + 1 NEXTVAL FROM ERP_PROD_KARY";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}

	
	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_PROD_KARY
					(ID,ID_PET_DETAIL,ID_OPERATOR) 
				VALUES (".$this->db->escape($data['ID']).","
				.$this->db->escape($data['ID_PET_DETAIL']).","
				.$this->db->escape($data['ID_OPERATOR']).")";
		
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

	// public function getWasteSiapKirim() 
	// {
	// 	$sql = "SELECT * FROM TBL_KIRIM_WASTE k
	// 	WHERE NOMOR_SP_KIRIMAN = '' AND NO_BA = ''";

	// 	$query = $this->db->query($sql);
	// 	return $query->result();
	// }


}
?>