<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_bskk extends CI_Model 
	{
		public function saveOra($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO MASTER_BSKK 
            (ID_BSKK,KODE_REKENING,DEPARTEMEN,INVEST,TANGGAL,
            KETERANGAN,NO_BPKK,DEBET)
            VALUES
            (MI_MASTER_BSKK.NEXTVAL,'". $data['KODE_REKENING'] ."',
            '". $data['DEPARTEMEN'] ."','". $data['INVEST'] ."',
            '". $data['TANGGAL'] ."','". $data['KETERANGAN'] ."',
            '". $data['NO_BPKK'] ."','". $data['DEBET'] ."')";
			
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

		// ==================================================================
		// ==================================================================
		// ==================================================================

		public function getExportBSKK($bulan,$tahun) 
		{
			$sql = "SELECT b.*,d.kode_departement,d.alokasi,DATE_FORMAT(b.tanggal,'%d/%m/%Y') tanggal_format FROM master_bskk b
			JOIN master_departemen d ON b.departemen = d.id_departement
			WHERE DATE_FORMAT(b.tanggal,'%Y%m') = '".$tahun.$bulan."' 
			ORDER BY b.kode_rekening,b.tanggal";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
		

		public function save($data) 
		{
			$this->db=$this->load->database('mi',true);
			$this->db->trans_begin();

			$sql = "INSERT INTO MASTER_BSKK 
            (KODE_REKENING,DEPARTEMEN,INVEST,TANGGAL,
            KETERANGAN,NO_BPKK,DEBET)
            VALUES
            ('". $data['KODE_REKENING'] ."',
            '". $data['DEPARTEMEN'] ."','". $data['INVEST'] ."',
            '". $data['TANGGAL'] ."','". $data['KETERANGAN'] ."',
            '". $data['NO_BPKK'] ."','". $data['DEBET'] ."')";
			
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

		public function edit($data) 
		{
			$this->db=$this->load->database('mi',true);
			$this->db->trans_begin();

			$sql = "UPDATE MASTER_BSKK SET
            KODE_REKENING = '". $data['KODE_REKENING'] ."',
			DEPARTEMEN = '". $data['DEPARTEMEN'] ."',
			INVEST = '". $data['INVEST'] ."',
			TANGGAL = '". $data['TANGGAL'] ."',
            KETERANGAN = '". $data['KETERANGAN'] ."',
			NO_BPKK = '". $data['NO_BPKK'] ."',
			DEBET = '". $data['DEBET'] ."' 
           	WHERE id_bskk = ". $data['ID_BSKK'];
			
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
			$sql = "SELECT *,DATE_FORMAT(b.tanggal,'%d/%m/%Y') tanggal_format FROM master_bskk b
			JOIN master_departemen d ON b.departemen = d.id_departement
			where b.tanggal > DATE_ADD(NOW(), INTERVAL -3 MONTH)
			order by b.id_bskk desc";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getById($dataX) 
		{
			$sql = "SELECT * FROM master_bskk b
			JOIN master_departemen d ON b.departemen = d.id_departement
			WHERE b.id_bskk = '". $dataX ."'";

			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
			// return $sql;
		}

	}
?>