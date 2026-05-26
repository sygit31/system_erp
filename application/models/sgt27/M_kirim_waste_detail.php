<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kirim_waste_detail extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT NVL(MAX(ID),0) + 1 NEXTVAL FROM TBL_KIRIM_WASTE_DETAIL";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}


	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO TBL_KIRIM_WASTE_DETAIL 
					(ID,NO_URUT_KIRIM,KODE_WASTE) 
				VALUES (".$this->db->escape($data['ID']).","
				.$this->db->escape($data['NO_URUT_KIRIM']).","
				.$this->db->escape($data['KODE_WASTE']).")";
		
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