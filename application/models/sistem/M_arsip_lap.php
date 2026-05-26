<?php 
class M_arsip_lap extends CI_Model {

	function bagian() {
		return $this->db->query("Select upper(hb.nama) bagian from erp_bagian hb order by hb.nama");
	}

	function filter($bagian) {
		return $this->db->query("Select sn.id, sn.kode_rak, sn.nomor_box, sn.isi, sn.retensi, sn.status, ha.nama karyawan, hb.nama bagian from erp_sis_arsip sn join erp_karyawan ha on ha.id=sn.id_karyawan join erp_bagian hb on hb.id=sn.id_bagian where (case when '$bagian'='ALL' then 'ALL' else hb.nama end)='$bagian'");
	}

}
?>