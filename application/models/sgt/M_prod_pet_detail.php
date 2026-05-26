<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prod_pet_detail extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT MAX(ID) + 1 NEXTVAL FROM ERP_PROD_PET_DETAIL";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}

	
	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_PROD_PET_DETAIL 
					(ID,ID_PROD_PET,KODE,MULAI,SELESAI,PANJANG,
					HASIL,REJECT,SISA,AKTIF,TELLER,QTY_ROLL,
					REJECT_KONVERSI) 
				VALUES (".$this->db->escape($data['ID']).","
				.$this->db->escape($data['ID_PROD_PET']).","
				.$this->db->escape($data['KODE']).","
				."To_date(".$this->db->escape($data['MULAI']).",'DD/MM/YYYY HH24:MI:SS'),"
				."To_date(".$this->db->escape($data['SELESAI']).",'DD/MM/YYYY HH24:MI:SS'),"
				.$this->db->escape($data['PANJANG']).","
				.$this->db->escape($data['HASIL']).","
				.$this->db->escape($data['REJECT']).","
				.$this->db->escape($data['SISA']).","
				.$this->db->escape($data['AKTIF']).","
				.$this->db->escape($data['TELLER']).","
				.$this->db->escape($data['QTY_ROLL']).","
				.$this->db->escape($data['REJECT_KONVERSI']).")";
		
		// print_r($sql);
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