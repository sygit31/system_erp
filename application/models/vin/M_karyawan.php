<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_karyawan extends CI_Model 
	{

		public function getKaryawanById($id) 
		{
			$this->db = $this->load->database('default', true);
			
			$this->db->select('*');
			$this->db->from('ERP_KARYAWAN');
			$this->db->where('ID', $id);
			$query = $this->db->get();
			return $query->row();
		}

		public function getAllKaryawan() 
		{
			$sql = "SELECT * FROM ERP_KARYAWAN ORDER BY NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getAllKaryawanByIdBagian($ID_KARYAWAN) 
		{
			$sql = 
				"SELECT ID,NIK,NAMA FROM ERP_KARYAWAN 
				WHERE ID_BAGIAN IN 
					(
						SELECT ID_BAGIAN FROM ERP_VER_DEPT WHERE ID_KARYAWAN = ".$ID_KARYAWAN." 
					)
				ORDER BY NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getAllKaryawanByIdBagianVerdeptStruktur($ID_KARYAWAN) 
		{
			$sql = 
				"SELECT E.ID,E.NIK,E.NAMA FROM ERP_KARYAWAN E
                JOIN ERP_JABATAN J ON E.ID_JABATAN = J.ID
                WHERE E.ID_BAGIAN IN 
                    (
                        SELECT ID_BAGIAN FROM ERP_VER_DEPT WHERE ID_KARYAWAN = ".$ID_KARYAWAN." 
                    )
                AND J.LEVEL_JABATAN <= 6
                ORDER BY J.LEVEL_JABATAN,E.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getKaryawanByIdBagian($id) 
		{
			$sql = 
				"SELECT * FROM ERP_KARYAWAN
				WHERE ID_BAGIAN = ". $id ." AND STATUS = 1
				ORDER BY NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}
		
			public function getKaryawanKhususMutasiPET() 
		{
			$sql = 
				"SELECT a.* FROM ERP_KARYAWAN a,ERP_BAGIAN b,ERP_JABATAN c WHERE a.ID_BAGIAN=b.ID AND a.ID_JABATAN=c.ID 
				AND c.ID IN(6,7,10,11,12) AND b.ID IN(33,31,30,29,25,24,41,4.17,4,15)";

			$query = $this->db->query($sql);
			return $query->result();
		}
       
		function get_karyawanMutasiPET() {
			$cek_karyawan = $this->db->query("SELECT a.* FROM ERP_KARYAWAN a,ERP_BAGIAN b,ERP_JABATAN c WHERE a.ID_BAGIAN=b.ID AND a.ID_JABATAN=c.ID 
			AND c.ID IN(6,7,10,11,12) AND b.ID IN(33,31,30,29,25,24,41,4,17,4,15)
				");
		
			$cari_cek_karyawan =$cek_karyawan->result_array();		
			return  $cari_cek_karyawan; 
		   }
        
		   function get_id_karyawanMutasiPET($params) {
			$query = $this->db->query("SELECT a.* FROM ERP_KARYAWAN a,ERP_BAGIAN b,ERP_JABATAN c WHERE a.ID_BAGIAN=b.ID AND a.ID_JABATAN=c.ID 
			AND c.ID IN(6,7,10,11,12) AND b.ID IN(33,31,30,29,25,24,41,4,17,15) and a.nama='$params' ");
			return $query->result_array();
		}   
		   
		public function getKaryawanByIdBagianTotalLemburan($id_bagian) 
		{
			$sql = "SELECT K.ID,K.NIK,K.NAMA,
			(
				SELECT NVL(SUM(round(((SELESAI - MULAI) * (60 * 24)),0)),0) total_lembur FROM ERP_SPL
				WHERE ID_KARYAWAN = K.ID
				and STATUS = 'setuju'
				and extract(month from MULAI) = extract(month from current_date)
				and extract(year from MULAI) = extract(year from current_date) 
			) TOTAL_LEMBUR
			 FROM ERP_KARYAWAN K
			WHERE K.ID_BAGIAN = ". $id_bagian." 
			AND K.STATUS = 1 
			ORDER BY K.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}



	}
?>
