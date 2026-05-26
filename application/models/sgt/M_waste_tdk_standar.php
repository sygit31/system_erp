<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_waste_tdk_standar extends CI_Model 
{

	public function get_stok_waste() 
	{
		$sql = "SELECT * FROM WASTE_TDK_STANDAR
		WHERE VALID_WASTE = '1'
		AND FLAG_KIRIM = '0'
		ORDER BY KODE_BAHAN,JENIS_WASTE,NO_SPP,TGL_WASTE";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function non_aktif($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "UPDATE WASTE_TDK_STANDAR SET FLAG_KIRIM='1'
		WHERE KODE_WASTE = '".$data."'";
		
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