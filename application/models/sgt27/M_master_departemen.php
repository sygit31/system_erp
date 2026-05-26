<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_master_departemen extends CI_Model 
	{
		public function getUnitOra() {
			$sql = "SELECT DISTINCT UNIT,ALOKASI FROM MASTER_DEPARTEMEN ORDER BY UNIT";
			
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		public function getByUnitOra($data) {
			$sql = "SELECT * FROM MASTER_DEPARTEMEN
			WHERE UNIT = '$data'";
			
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		// =============================================================
		// =============================================================
		// =============================================================

		public function getUnit() {
			// $sql = "SELECT DISTINCT UNIT,ALOKASI FROM MASTER_DEPARTEMEN ORDER BY UNIT";
			$sql = "SELECT DISTINCT UNIT FROM MASTER_DEPARTEMEN ORDER BY UNIT";
			
			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
		
		public function getByUnit($data) {
			$sql = "SELECT ID_DEPARTEMENT,KODE_DEPARTEMENT,NAMA_DEPARTEMENT,
			KABAG_DEPARTEMENT,UNIT,ALOKASI FROM MASTER_DEPARTEMEN
			WHERE UNIT = '$data'";
			
			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
			// return $sql();
		}

		public function getIdByKode($data) {
			// $sql = "SELECT DISTINCT UNIT,ALOKASI FROM MASTER_DEPARTEMEN ORDER BY UNIT";
			$sql = "SELECT id_departement FROM MASTER_DEPARTEMEN WHERE kode_departement = '".$data."'";
			
			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getByIdDepartemen($data) {
			$sql = "SELECT * FROM master_departemen WHERE id_departement = '".$data."'";
			
			$this->db = $this->load->database('mi', true);
			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>