<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prod_mutasi extends CI_Model 
{

	public function nextval() 
	{
		$sql = "SELECT MAX(ID) + 1 NEXTVAL FROM ERP_PROD_MUTASI";
		
		$query = $this->db->query($sql);
		$hsl = $query->result();
		return $hsl[0]->NEXTVAL;
	}

	
	public function save($data) 
	{
		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_PROD_MUTASI
					(ID,TGL,NMR,STATION_AWAL,
					STATION_AKHIR,KODE,QTY,QTY_PRODUKSI,
					QTY_ROLL,ID_PENGIRIM,ID_PENERIMA,
					ID_GUDANG_ORDER,AKTIF) 
				VALUES (".$this->db->escape($data['ID']).","
				.$this->db->escape($data['TGL']).","
				.$this->db->escape($data['NMR']).","
				.$this->db->escape($data['STATION_AWAL']).","
				.$this->db->escape($data['STATION_AKHIR']).","
				.$this->db->escape($data['KODE']).","
				.$this->db->escape($data['QTY']).","
				.$this->db->escape($data['QTY_PRODUKSI']).","
				.$this->db->escape($data['QTY_ROLL']).","
				.$this->db->escape($data['ID_PENGIRIM']).","
				.$this->db->escape($data['ID_PENERIMA']).","
				.$this->db->escape($data['ID_GUDANG_ORDER']).","
				.$this->db->escape($data['AKTIF']).")";
		
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