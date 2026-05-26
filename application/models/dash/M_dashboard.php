<?php 
class M_dashboard extends CI_Model {

	function dt_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		$query = $this->db->query("Select ha.id id_kary, sg.tanggal, ha.nama, sg.tinggi, sg.berat from erp_karyawan ha join erp_sis_bmi sg on sg.id_karyawan=ha.id where ha.id='$id_kary'
			order by sg.tanggal desc");
		return $query->result_array();
	}

	function tbl_bmi() {
		return $this->db->query("Select so.*, (select max(poin) from erp_sis_tbl_bmi where status='1') max_poin
			from erp_sis_tbl_bmi so where so.status='1' order by min");
	}

}

?>