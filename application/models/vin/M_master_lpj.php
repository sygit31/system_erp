<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_lpj extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_LPJ 
            (ID_LPJ,KODE_INVEST,KODE_REKENING,ALOKASI_BIAYA,KODE_DEPARTEMEN,
			TANGGAL,KETERANGAN,SUPLIER,NO_LPJ_INTERNAL,
			NO_LPJ_EKSTERNAL,JUMLAH,SATUAN,HARGA_SATUAN,DEBET,PPH,PPN_RUPIAH,
			STATUS,ACTIVE_STATUS)
            VALUES
            (MI_MASTER_LPJ.NEXTVAL,'". $data['KODE_INVEST'] ."',
            '". $data['KODE_REKENING'] ."','". $data['ALOKASI_BIAYA'] ."',
            '". $data['KODE_DEPARTEMEN'] ."','". $data['TANGGAL'] ."',
            '". $data['KETERANGAN'] ."',
            '". $data['SUPLIER'] ."','". $data['NO_LPJ_INTERNAL'] ."',
            '". $data['NO_LPJ_EKSTERNAL'] ."','". $data['JUMLAH'] ."',
            '". $data['SATUAN'] ."','". $data['HARGA_SATUAN'] ."',
            '". $data['DEBET'] ."','". $data['PPH'] ."',
			'". $data['PPN_RUPIAH'] ."','". $data['STATUS'] ."',
            '". $data['ACTIVE_STATUS'] ."')";
			
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

		// ========================================================
		// ========================================================
		// ========================================================
		
		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO MASTER_LPJ 
            (KODE_INVEST,KODE_REKENING,ALOKASI_BIAYA,KODE_DEPARTEMEN,
			TANGGAL,KETERANGAN,SUPLIER,NO_LPJ_INTERNAL,
			NO_LPJ_EKSTERNAL,JUMLAH,SATUAN,HARGA_SATUAN,DEBET,PPH,PPN_RUPIAH,
			STATUS,ACTIVE_STATUS)
            VALUES
            ('". $data['KODE_INVEST'] ."',
            '". $data['KODE_REKENING'] ."','". $data['ALOKASI_BIAYA'] ."',
            '". $data['KODE_DEPARTEMEN'] ."', STR_TO_DATE('". $data['TANGGAL'] ."', '%m/%d/%Y'),
            '". $data['KETERANGAN'] ."',
            '". $data['SUPLIER'] ."','". $data['NO_LPJ_INTERNAL'] ."',
            '". $data['NO_LPJ_EKSTERNAL'] ."','". $data['JUMLAH'] ."',
            '". $data['SATUAN'] ."','". $data['HARGA_SATUAN'] ."',
            '". $data['DEBET'] ."','". $data['PPH'] ."',
			'". $data['PPN_RUPIAH'] ."','". $data['STATUS'] ."',
            '". $data['ACTIVE_STATUS'] ."')";
			
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

		public function getDataLast() 
		{
			$sql = "SELECT *,DATE_FORMAT(l.tanggal,'%d/%m/%Y') tanggal_format FROM master_lpj l
			join master_departemen d on l.kode_departemen = d.id_departement
			order by l.id_lpj desc
			limit 100";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>