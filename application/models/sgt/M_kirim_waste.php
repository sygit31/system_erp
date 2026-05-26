<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kirim_waste extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT MAX(NO_URUT) + 1 NEXTVAL FROM TBL_KIRIM_WASTE";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}

	
	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO TBL_KIRIM_WASTE 
					(NO_URUT_KIRIM,TGL_KIRIM,NO_SPP,
					TGL_DELTIME_SPP,JENIS_WASTE,
					JUMLAH_KIRIM,KODE_BAHAN,NO_URUT,
					NOMOR_SP_KIRIMAN,JENIS) 
				VALUES (".$this->db->escape($data['NO_URUT_KIRIM']).","
				.$this->db->escape($data['TGL_KIRIM']).","
				.$this->db->escape($data['NO_SPP']).","
				.$this->db->escape($data['TGL_DELTIME_SPP']).","
				.$this->db->escape($data['JENIS_WASTE']).","
				.$this->db->escape($data['JUMLAH_KIRIM']).","
				.$this->db->escape($data['KODE_BAHAN']).","
				.$this->db->escape($data['NO_URUT']).","
				.$this->db->escape($data['NOMOR_SP_KIRIMAN']).","
				.$this->db->escape($data['JENIS']).")";
		
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

	public function getWasteSiapKirim() 
	{
		$sql = "SELECT * FROM TBL_KIRIM_WASTE k
		WHERE NOMOR_SP_KIRIMAN = '' AND NO_BA = ''";

		$query = $this->db->query($sql);
		return $query->result();
	}


}
?>