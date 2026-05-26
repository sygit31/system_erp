<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kertas extends CI_Model {

	function db_42() {
		return $this->load->database('db_42', TRUE);
	}

	function db_admin() {
		return $this->load->database('admin', TRUE);
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)=4 order by desain desc");
	}

	function bahan() {
		return $this->db_admin()->query("Select distinct kode_bahan, lebar, desain from tbl_master_bahan where desain>='2020' and jenis='BB' order by desain desc, kode_bahan");
	}

	function spp() {
		return $this->db_admin()->query("Select distinct no_spp, desain from tbl_spp where desain>='2020' order by desain desc, no_spp");
	}

	function toleransi() {
		$query = $this->db_42()->query("Select id_toleransi, toleransi from toleransi where aktif='Y'");
		return $query->row_array();
	}

	function isi_bahan($desain, $lebar) {
		$query = $this->db_admin()->query("Select kode_bahan from tbl_master_bahan where jenis='BB' and lebar='$lebar' and desain='$desain'");
		$data = $query->row_array();
		return $data['KODE_BAHAN'];
	}

	function no_spp($kode_bahan) {
		$query = $this->db_admin()->query("Select no_spp from tbl_spp where kode_bahan='$kode_bahan'");
		$data = $query->row_array();
		return $data['NO_SPP'];
	}

	function f_filter($tgl1, $tgl2, $ukuran, $status, $desain) {
		return $this->db->query("Select c.tgl_bon, substr(b.nomor, 0, 3) no_penolakan_qc, substr(c.no_bon, 0, 3) bon, a.no_roll, replace(a.in_roll, ',', '.') in_roll, replace(a.in_deres, ',', '.') in_deres, a.keterangan
			from tbl_gdg_rsk_kredit_detail a join tbl_keluar c on c.no_roll=a.no_roll left join tbl_tolak_qc b on b.id=a.no_penolakan_qc
			where to_char(c.tgl_bon, 'YYMMDD') between '$tgl1' and '$tgl2' and (a.no_roll) like '%$ukuran%$desain%' and (case when '$status'='All' then 'All' else a.valid_reject end)='$status'
			order by c.tgl_bon desc, a.no_roll")->result_array();
	}

	function filter($data) {
		$tgl1 = date('ymd', strtotime($data[0]));
		$tgl2 = date('ymd', strtotime($data[1]));
		$cari = $data[2];
		$desain = $data[3];

		return $this->db_42()->query("Select distinct a.desain, a.kode_bahan, a.no_roll, a.id_masuk, a.tgl_npk, a.no_npk, left(a.no_roll,5) as no_roll, a.berat,
			(select ifnull(berat,0) from timbang_ulang where id_masuk=a.id_masuk order by id_timbang_ulang desc limit 1) berat_pnp,
			(select ifnull(c2.toleransi,0) from toleransi c2 join timbang_ulang b2 on b2.id_toleransi=c2.id_toleransi where b2.id_masuk=a.id_masuk order by b2.id_timbang_ulang desc limit 1) toleransi
			from scan_terima a
			where date_format(a.tgl_npk,'%y%m%d') between '$tgl1' and '$tgl2' and (a.no_npk like '%$cari%' or a.no_roll like '%$cari%') and a.desain='$desain'
			order by a.desain desc, a.tgl_npk, a.kode_bahan, a.no_roll");
	}

	function urut() {
		$query = $this->db_42()->query("Select max(id_masuk) as id from scan_terima");
		$urut = $query->row_array();
		return $urut['id'] + 1;
	}

	function simpan($id, $barcode, $tgl, $desain, $kode_bahan, $spp, $no_npk, $kode_roll, $berat_pdl, $berat_pnp, $netto, $id_toleransi) {
		$this->db_42()->query("Insert into scan_terima(barcode, id_masuk, tgl_input, desain, spp, no_npk, no_roll, berat, verified, kode_bahan, tgl_npk) values('$barcode', '$id', '$tgl', '$desain', '$spp', '$no_npk', '$kode_roll', '$berat_pdl', 'N', '$kode_bahan', '$tgl')");
	}

	function update($id_edit, $barcode, $tgl, $desain, $kode_bahan, $spp, $no_npk, $kode_roll, $berat_pdl) {
		$this->db_42()->query("Update scan_terima set barcode='$barcode', tgl_input='$tgl', desain='$desain', spp='$spp', no_npk='$no_npk', no_roll='$kode_roll', berat='$berat_pdl', verified='N', kode_bahan='$kode_bahan', tgl_npk='$tgl' 
			where id_masuk='$id_edit'");
	}

	function urut_timbang() {
		$query = $this->db_42()->query("Select max(id_timbang_ulang) as id from timbang_ulang");
		$urut = $query->row_array();
		return $urut['id'] + 1;
	}

	function id_toleransi($kode_roll) {
		$query = $this->db_42()->query("Select * from toleransi where aktif='Y'");
		$data = $query->row_array();
		$id_toleransi = $data['id_toleransi'];
		$uk = substr($kode_roll,-1) == 'A' ? $data['uk_73'] : $data['uk_52'];
		return array($id_toleransi, $uk);
	}

	function simpan_timbang($id_timbang_ulang, $id_masuk, $berat_pnp, $berat_timbangan, $id_toleransi) {
		$this->db_42()->query("Insert into timbang_ulang (id_timbang_ulang, id_masuk, berat, berat_timbangan, id_toleransi, tgl_input) values('$id_timbang_ulang', '$id_masuk', '$berat_pnp', '$berat_timbangan', '$id_toleransi', now())");
	}

	function hapus_timbang($id_timbang_ulang) {
		$this->db_42()->query("Delete from timbang_ulang where id_timbang_ulang='$id_timbang_ulang'");
	}

	function update_timbang($id_timbang_ulang, $id_masuk, $berat_pnp, $berat_timbangan, $id_toleransi) {
		$this->db_42()->query("Update timbang_ulang set id_masuk='$id_masuk', berat='$berat_pnp', berat_timbangan='$berat_timbangan', id_toleransi='$id_toleransi', tgl_input=now()
			where id_timbang_ulang='$id_timbang_ulang'");
	}

	function edit($id_edit) {
		$query = $this->db_42()->query("Select distinct a.id_masuk, a.barcode, date_format(a.tgl_npk,'%d-%b-%Y') tgl, a.desain, a.spp, a.no_npk, left(a.no_roll,5) as kode_roll, a.berat,
			(select id_timbang_ulang from timbang_ulang where id_masuk=a.id_masuk order by id_timbang_ulang desc limit 1) id_timbang_ulang,
			(select berat from timbang_ulang where id_masuk=a.id_masuk order by id_timbang_ulang desc limit 1) berat_pnp,
			(select c.toleransi from toleransi c join timbang_ulang b on b.id_toleransi=c.id_toleransi where b.id_masuk=a.id_masuk and aktif='Y' limit 1) toleransi,
			(select c.id_toleransi from toleransi c join timbang_ulang b on b.id_toleransi=c.id_toleransi where b.id_masuk=a.id_masuk and aktif='Y' limit 1) id_toleransi
			from scan_terima a
			where a.id_masuk='$id_edit'");
		return $query->row_array();
	}

	function hapus($id_hapus) {
		$this->db_42()->query("Delete from scan_terima where id_masuk='$id_hapus'");
		$this->db_42()->query("Delete from timbang_ulang where id_masuk='$id_hapus'");
	}

	function ekspedisi_kertas() {
		$tgl = date('ymd', strtotime('-0 days'));
		return $this->db->query("Select TGL_NPK, NO_NPK, LEBAR_CM, NO_ROLL, NETTO_KG, TGL_RENCANA, NOMOR_PP, PAKAI_KG, RUSAK_KG from TBL_TERIMA where to_char(TGL_RENCANA,'YYMMDD')='$tgl' and substr(NO_ROLL,5,1)='B' order by NO_ROLL");
	}

	function filter_ekspedisi($tgl1, $tgl2, $ukuran) {
		return $this->db->query("Select TGL_NPK, NO_NPK, LEBAR_CM, NO_ROLL, NETTO_KG, TGL_RENCANA, NOMOR_PP, PAKAI_KG, RUSAK_KG from TBL_TERIMA where TGL_RENCANA >= '$tgl1' and TGL_RENCANA <= '$tgl2' and substr(NO_ROLL,5,1)='$ukuran' order by NO_ROLL");
	}

}