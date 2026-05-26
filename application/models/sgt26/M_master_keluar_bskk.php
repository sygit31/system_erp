<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_keluar_bskk extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_KELUAR_BSKK 
            (ID_KELUAR,BULAN,TAHUN,JUMLAH,KETERANGAN)
            VALUES
            (MI_MASTER_KELUAR_BSKK.NEXTVAL,'". $data['BULAN'] ."',
            '". $data['TAHUN'] ."','". $data['JUMLAH'] ."',
			'". $data['KETERANGAN'] ."')";
			
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

		public function getKeluarOra($bulan,$tahun) 
		{
			$sql = "SELECT * FROM master_keluar_bskk
			WHERE bulan = '".$bulan."' AND tahun = '".$tahun."'";

			$query = $this->db->query($sql);
			return $query->result();
		}
		
		// =============================================================
		// =============================================================
		// =============================================================

		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);

			$sql = "INSERT INTO MASTER_KELUAR_BSKK 
            (BULAN,TAHUN,JUMLAH,KETERANGAN)
            VALUES
            ('". $data['BULAN'] ."',
            '". $data['TAHUN'] ."','". $data['JUMLAH'] ."',
			'". $data['KETERANGAN'] ."')";
			
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

		public function getKeluar($bulan,$tahun) 
		{
			$sql = "SELECT * FROM master_keluar_bskk
			WHERE bulan = '".$bulan."' AND tahun = '".$tahun."'";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getDataLast() 
		{
			$sql = "SELECT * FROM master_keluar_bskk
			order by id_keluar desc
			limit 30";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>