<?php 
class M_rfid extends CI_Model {

	function kode_pengawas() {
		return $this->db->query("Select distinct kode_pengawas from tbl_detail_sortir where kode_pengawas is not null order by kode_pengawas");
	}

	function filter($number1, $number2) {
		return $this->db->query("Select distinct fa.kode_bahan, fa.kode_rim, to_char(fa.date_input,'dd-mm-yyyy') tanggal, fa.nomor_sop, to_char(fa.jatuh_tempo,'dd-mm-yyyy') jatuh_tempo,
			fa.kelompok_packing, fa.no_mesin_hitung,
			(select ssb.shift_stamp from tbl_keluar ssb join tbl_detail_lbl_finishing_rfid fc on fc.label_finishing=ssb.nomor_pp_cutter where fc.kode_rim=fa.kode_rim and ssb.kode_bahan=fa.kode_bahan and rownum='1') shift_stamp,
			(select ssb.nomesin_stamp from tbl_keluar ssb join tbl_detail_lbl_finishing_rfid fc on fc.label_finishing=ssb.nomor_pp_cutter where fc.kode_rim=fa.kode_rim and ssb.kode_bahan=fa.kode_bahan and rownum='1') nomesin_stamp,
			(select ssb.shift from tbl_keluar ssb join tbl_detail_lbl_finishing_rfid fc on fc.label_finishing=ssb.nomor_pp_cutter where fc.kode_rim=fa.kode_rim and rownum='1') shift_cutter,
			(select ssd.kode_pengawas from tbl_detail_sortir ssd join tbl_detail_lbl_finishing_rfid fc on fc.label_finishing=ssd.nomor_pp_cutter where fc.kode_rim=fa.kode_rim and rownum='1') shift_sortir
			from tbl_detail_rim_rfid fa
			where fa.no_label between '$number1' and '$number2' and
			(select ssb.nomesin_stamp from tbl_keluar ssb join tbl_detail_lbl_finishing_rfid fc on fc.label_finishing=ssb.nomor_pp_cutter where fc.kode_rim=fa.kode_rim and ssb.kode_bahan=fa.kode_bahan and rownum='1') is not null
			order by fa.kode_rim");
	}

}
?>