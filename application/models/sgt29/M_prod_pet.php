<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prod_pet extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT MAX(ID) + 1 NEXTVAL FROM ERP_PROD_PET";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}

	
	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_PROD_PET 
					(ID,ID_PROD_PROSES,DESAIN,
					PROSES,NAMA_MESIN,SHIFT,ID_GUDANG_ORDER,
					TANGGAL,KETERANGAN,KODE_FLOW,
					NMR,ID_PENGAWAS) 
				VALUES (".$this->db->escape($data['ID']).","
				.$this->db->escape($data['ID_PROD_PROSES']).","
				.$this->db->escape($data['DESAIN']).","
				.$this->db->escape($data['PROSES']).","
				.$this->db->escape($data['NAMA_MESIN']).","
				.$this->db->escape($data['SHIFT']).","
				.$this->db->escape($data['ID_GUDANG_ORDER']).","
				.$this->db->escape($data['TANGGAL']).","
				.$this->db->escape($data['KETERANGAN']).","
				.$this->db->escape($data['KODE_FLOW']).","
				.$this->db->escape($data['NMR']).","
				.$this->db->escape($data['ID_PENGAWAS']).")";
		
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