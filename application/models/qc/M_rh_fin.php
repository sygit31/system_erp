<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_rh_fin extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_rh_fg order by desain desc");
	}

	function seri() {
		return $this->db->query("Select substr(kode_bahan, -1) seri from tbl_master_bahan where desain='2025' and jenis='BJ' order by kode_bahan");
	}

	function isi_rim($desain) {
		$tgl = date('ymd', strtotime('-15 days'));
		return $this->db->query("Select distinct si.kode_rim, substr(si.kode_bahan, -1) seri
			from tbl_detail_rim_rfid si
			where substr(si.kode_bahan, 4, 4)='$desain' and to_char(si.date_input, 'YYMMDD')>'$tgl' and substr(si.kode_bahan, -1)<4
			order by si.kode_rim desc")->result_array();
	}

	function filter($tgl1, $tgl2, $desain, $kode) {
		return $this->db->query("Select qj.id, qj.tgl, qj.rim, qj.seri, qj.rh, qj.suhu,
			(select kode_palette from tbl_palette where kode_rim=qj.rim) pallet,
			(select count(kode_rim) from tbl_detail_outgoing_rfid where kode_rim=qj.rim) kirim
			from erp_qc_rh_fg qj
			where to_char(qj.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else qj.desain end)='$desain' and qj.rim like '%$kode%'
			order by qj.tgl desc, qj.seri, (select kode_palette from tbl_palette where kode_rim=qj.rim), qj.rim desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_rh_fg");
		return $query->row_array()['ID'] + 1;
	}

	function simpan($urut, $desain, $tgl, $rim, $seri, $rh, $suhu) {
		$this->db->query("Insert into erp_qc_rh_fg(id, tgl, desain, seri, rim, rh, suhu) values('$urut', '$tgl', '$desain', '$seri', '$rim', '$rh', '$suhu')");
	}

	function update($id_edit, $desain, $tgl, $rim, $seri, $rh, $suhu) {
		$this->db->query("Update erp_qc_rh_fg set tgl='$tgl', desain='$desain', seri='$seri', rim='$rim', rh='$rh', suhu='$suhu' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select * from erp_qc_rh_fg where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_rh_fg where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select qj.desain, qj.tgl, qj.rim, qj.seri, qj.rh, qj.suhu,
			(select kode_palette from tbl_palette where kode_rim=qj.rim) pallet
			from erp_qc_rh_fg qj
			where qj.tgl=(select tgl from erp_qc_rh_fg where id='$id_cetak') and (select kode_palette from tbl_palette where kode_rim=qj.rim) is not null
			order by qj.tgl desc, (select kode_palette from tbl_palette where kode_rim=qj.rim), qj.rim")->result_array();
	}

	function filter_p($tgl1, $tgl2, $desain, $seri, $sp, $pallet) {
		return $this->db->query("Select distinct sk.shipment_date, sk.no_sp, sh.kode_palette, substr(sg.kode_bahan, -1) seri, sh.tahun_palette, sg.nomor_sop, sum(sg.jumlah) lembar
			from tbl_palette sh join tbl_detail_outgoing_rfid sj on sj.kode_rim=sh.kode_rim join tbl_outgoing_rfid sk on sk.id_outgoing=sj.id_outgoing
			join tbl_detail_lbl_finishing_rfid sg on sg.kode_rim=sh.kode_rim 
			where to_char(sk.shipment_date, 'YYMMDD') between '$tgl1' and '$tgl2' and to_char(sh.tahun_palette)='$desain' and (case when '$seri'='All' then 'All' else substr(sg.kode_bahan, -1) end)='$seri' and sk.no_sp like '%$sp%' and sh.kode_palette like '%$pallet%'
			group by sk.shipment_date, sh.kode_palette, sk.no_sp, sg.kode_bahan, sh.tahun_palette, sg.nomor_sop
			order by sk.shipment_date desc, substr(sg.kode_bahan, -1), sh.kode_palette")->result_array();
	}

	function view($kode_palette, $tahun_palette, $nomor_sop) {
		return $this->db->query("Select distinct sh.kode_rim
			from tbl_palette sh join tbl_detail_lbl_finishing_rfid sg on sg.kode_rim=sh.kode_rim where sh.kode_palette='$kode_palette' and sh.tahun_palette='$tahun_palette' and sg.nomor_sop='$nomor_sop' order by sh.kode_rim")->result_array();
	}

}