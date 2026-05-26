<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_sis_project extends CI_Model 
	{

		public function getProjectOpen() 
		{
			$sql = "SELECT ID,ID_KARY,NAMA || ' - ' || TUGAS AS NAMA FROM ERP_SIS_PROJECT WHERE FINISH IS NULL";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getProjectOpenByIdBagianVerDept($Id_Karyawan) 
		{
			$sql = "SELECT E.ID,E.ID_KARY,E.NAMA || ' - ' || E.TUGAS AS NAMA,K.ID_BAGIAN FROM ERP_SIS_PROJECT E
			JOIN ERP_KARYAWAN K ON E.ID_KARY = K.ID
			WHERE E.FINISH IS NULL
			AND ID_BAGIAN IN (SELECT ID_BAGIAN FROM ERP_VER_DEPT WHERE ID_KARYAWAN = ".$Id_Karyawan.")";

			$query = $this->db->query($sql);
			return $query->result();
		}
		
	}
?>