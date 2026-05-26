<?php

class M_pch extends CI_Model {

	function produk($kd_unit) {
		return $this->db->query("Select distinct pc.id, pc.nama, cc.desain
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_barang pc on pc.id=cc.id_produk
			where cc.tipe='Produksi' and pc.aktif='1' and vb.result='Baik' and cc.tipe='Produksi' and cc.kd_unit='$kd_unit' and cc.desain>='2022'
			order by cc.desain desc, pc.nama desc");
	}

	function data($id_produk, $diff, $tgl1, $tgl2) {
		$start_laporan = '2021';

		$query = $this->db->query("Select dt,
			(Select nvl(sum(ge.saldo),0) from erp_gdg_saldo ge where ge.id_barang like '%$id_produk' and ge.tgl<='$tgl1' and to_char(ge.tgl,'YYYY')>='$start_laporan') gdg_awal,
			(Select count(vb.id) from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where vb.status<>'0' and cc.id_produk='$id_produk' and vb.mulai<'$tgl1' and vb.result='Baik' and cd.master='PCH' and to_char(vb.mulai,'YYYY')>='$start_laporan') ef_baik_awal,
			(Select count(vc.id) from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where cc.id_produk='$id_produk' and vc.tgl<'$tgl1' and vc.aktif='2' and to_char(vc.tgl,'YYYY')>='$start_laporan') ipb_awal,
			(Select count(vb.id) from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where vb.status<>'0' and cc.id_produk='$id_produk' and vb.mulai<'$tgl1' and vb.result='Reject' and cd.master='PCH') ef_reject_awal,
			(Select count(ve.id) from erp_galv_musnah ve join erp_galv_proses vb on vb.id=ve.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where ve.status<>'0' and cc.id_produk='$id_produk' and ve.tgl<'$tgl1' and vb.result='Reject' and cd.master='PCH' and to_char(ve.tgl,'YYYY')>='$start_laporan') musnah_reject_awal,
			(Select count(vd.id) from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where cc.id_produk='$id_produk' and vd.tgl<'$tgl1' and vd.status='2' and cd.master='PCH') ex_emboss_awal,
			(Select count(ve.id) from erp_galv_musnah ve join erp_galv_ipb vc on vc.id_galv_proses=ve.id_galv_proses join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where ve.status<>'0' and cc.id_produk='$id_produk' and ve.tgl<'$tgl1' and cd.master='PCH') musnah_emboss_awal,
			(Select count(vb.id) from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where vb.status<>'0' and cc.id_produk='$id_produk' and to_char(vb.mulai,'YYMMDD')=dt and vb.result='Baik' and cd.master='PCH' and to_char(vb.mulai,'YYYY')>='$start_laporan') ef_baik,
			(Select count(vb.id) from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where cc.id_produk='$id_produk' and to_char(vb.mulai,'YYMMDD')=dt and vb.result='Reject' and to_char(vb.mulai,'YYYY')>='$start_laporan') ef_reject,
			(Select count(vd.id) from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where cc.id_produk='$id_produk' and to_char(vd.tgl,'YYMMDD')=dt and vd.status='2' and to_char(vd.tgl,'YYYY')>='$start_laporan') ex_emboss,
			(Select count(vc.id) from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where cc.id_produk='$id_produk' and to_char(vc.tgl,'YYMMDD')=dt and vc.aktif='2' and to_char(vc.tgl,'YYYY')>='$start_laporan') ipb,
			(Select count(ve.id) from erp_galv_musnah ve join erp_galv_proses vb on vb.id=ve.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where ve.status<>'0' and cc.id_produk='$id_produk' and to_char(ve.tgl,'YYMMDD')=dt and vb.result='Baik' and cd.master='PCH' and to_char(ve.tgl,'YYYY')>='$start_laporan') musnah_baik,
			(Select count(ve.id) from erp_galv_musnah ve join erp_galv_proses vb on vb.id=ve.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where ve.status<>'0' and cc.id_produk='$id_produk' and to_char(ve.tgl,'YYMMDD')=dt and vb.result='Reject' and cd.master='PCH' and to_char(ve.tgl,'YYYY')>='$start_laporan') musnah_reject,
			(Select count(ve.id) from erp_galv_musnah ve join erp_galv_ipb vc on vc.id_galv_proses=ve.id_galv_proses join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp where ve.status<>'0' and cc.id_produk='$id_produk' and to_char(ve.tgl,'YYMMDD')=dt and cd.master='PCH') musnah_emboss
			from
			(Select to_char((to_date('$tgl2') - rownum),'YYMMDD') dt
			from dual connect by rownum <= '$diff' order by to_char((to_date('$tgl2') - rownum),'yymmdd'))");
		return $query->result_array(); // Export Result
	}

	function filter_hpd($tgl1, $tgl2, $kd_unit) {
		$query = $this->db->query("Select distinct pc.id, pc.nama, pc.id,
			(select no_master from erp_galv_waktu where id_produk=pc.id and rownum=1) kode,
			(select count(vb.id) from erp_galv_proses vb join erp_galv_waktu va on va.id=vb.id_waktu where va.id_produk=pc.id and va.master='PCH' and vb.result='Baik' and to_char(vb.mulai, 'YYMMDD')<'$tgl1') masuk_awal,
			(select count(vc.id) from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_galv_waktu va on va.id=vb.id_waktu where va.id_produk=pc.id and va.master='PCH' and vb.result='Baik' and to_char(vc.tgl, 'YYMMDD')<'$tgl1') keluar_awal,
			(select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and to_char(tgl, 'YYMMDD')<'$tgl1') addendum_awal,
			(select count(vb.id) from erp_galv_proses vb join erp_galv_waktu va on va.id=vb.id_waktu where va.id_produk=pc.id and va.master='PCH' and vb.result='Baik' and to_char(vb.mulai, 'YYMMDD') between '$tgl1' and '$tgl2') masuk,
			(select count(vc.id) from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_galv_waktu va on va.id=vb.id_waktu where va.id_produk=pc.id and va.master='PCH' and vc.aktif='2' and to_char(vc.tgl, 'YYMMDD') between '$tgl1' and '$tgl2') keluar,
			(select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and to_char(tgl, 'YYMMDD') between '$tgl1' and '$tgl2') addendum
			from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id
			where cc.tipe='Produksi' and cc.kd_unit='$kd_unit' and cd.master='PCH'
			order by pc.nama");
		return $query->result_array();
	}

}