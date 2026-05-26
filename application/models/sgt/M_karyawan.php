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