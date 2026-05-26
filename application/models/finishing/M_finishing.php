<?php 
class M_finishing extends CI_Model {

	function filter($tgl1,$tgl2) {
		return $this->db->query("Select nomor_pp_cutter, to_char(tgl_proses_cutter,'dd-mm-yyyy') tgl_proses_cutter, shift, no_spp, nomor_pp, substr(kode_bahan,-1) bahan, substr(no_roll,0,5) no_roll, baik_sht, baik_cutter, pakai_kg, substr(no_roll,-4) desain from tbl_keluar where to_char(tgl_proses_cutter,'YYMMDD') between '$tgl1' and '$tgl2' order by tgl_proses_cutter desc, nomor_pp_cutter, substr(no_roll,0,5)");
	}

	function cutter($pp_cutter,$desain) {
		$data = $this->db->query("Select nomor_pp_cutter, to_char(tgl_proses_cutter,'dd-mm-yyyy') tgl_proses_cutter, shift, no_spp, nomor_pp, substr(kode_bahan,-1) bahan, substr(no_roll,0,5) no_roll, baik_sht, baik_sht_teori, baik_cutter, pakai_kg from tbl_keluar where nomor_pp_cutter='$pp_cutter' and substr(no_roll,-4)='$desain' order by substr(no_roll,0,5)");

		return $data->result_array();
	}

	function db_simonita() {
		$simonita = $this->load->database('simonita', TRUE);
		return $simonita;
	}

	function simonita() {
		$data = $this->db_simonita()->query("Select * from tbl_master_produk");
		return $data->result_array();
	}

}
?>