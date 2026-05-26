<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_stok extends CI_Model {

    function jenis($id_kary) {
        return $this->db->query("Select distinct gh.* from erp_gdg_location gh join erp_gdg_location_pic gi on gi.id_location=gh.id where gi.id_karyawan='$id_kary' order by gh.jenis");
    }

    function lokasi() {
        return $this->db->query("Select distinct no_lokasi from erp_gdg_location_brg order by no_lokasi");
    }

    function filter($tgl1, $tgl2, $id_location, $cari, $no_lokasi) {
        $tgl_start = '220401';
        $syntax = "Select distinct pc.id, pc.nama, pc.kode_simpg, pc.spesifikasi, pc.satuan, pc.min_stok, pc.kode, gv.no_lokasi,
            (select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and lokasi='$id_location' and status='1' and gh.kd_unit=kd_unit) s_awal,
            (select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and to_char(gs.tgl,'YYMMDD')<'$tgl1' and to_char(gs.tgl,'YYMMDD')>='$tgl_start' and GH.KD_UNIT=GS.KD_UNIT) masuk_awal,
            (select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb join erp_karyawan ha on ha.id=gj.id_receive where gk.id_barang=pc.id and to_char(gj.tgl,'YYMMDD')<'$tgl1' and to_char(gj.tgl,'YYMMDD')>='$tgl_start' and  GH.KD_UNIT=ha.KD_UNIT ) keluar_awal,
            (select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and to_char(gs.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and GH.KD_UNIT=GS.KD_UNIT ) masuk,
            (select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb join erp_karyawan ha on ha.id=gj.id_receive where gk.id_barang=pc.id and to_char(gj.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and  GH.KD_UNIT=ha.KD_UNIT ) keluar
            from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location join erp_gdg_location_pic gi on gi.id_location=gh.id
            where pc.aktif='1' and gv.status='1' and gh.id='$id_location' and upper(pc.nama) like '%$cari%' and (case when '$no_lokasi'='All' then 'All' else gv.no_lokasi end)='$no_lokasi'
            order by pc.nama";

        $query = $this->db->query("Select distinct pc.id, pc.nama, pc.kode_simpg, pc.spesifikasi, pc.satuan, pc.min_stok, pc.kode, gv.no_lokasi,
            (select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and lokasi='$id_location' and status='1' and gh.kd_unit=kd_unit) s_awal,
            (select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and to_char(gs.tgl,'YYMMDD')<'$tgl1' and to_char(gs.tgl,'YYMMDD')>='$tgl_start' and GH.KD_UNIT=GS.KD_UNIT) masuk_awal,
            (select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb join erp_karyawan ha on ha.id=gj.id_receive where gk.id_barang=pc.id and to_char(gj.tgl,'YYMMDD')<'$tgl1' and to_char(gj.tgl,'YYMMDD')>='$tgl_start' and  GH.KD_UNIT=ha.KD_UNIT ) keluar_awal,
            (select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and to_char(gs.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and GH.KD_UNIT=GS.KD_UNIT ) masuk,
            (select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb join erp_karyawan ha on ha.id=gj.id_receive where gk.id_barang=pc.id and to_char(gj.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and  GH.KD_UNIT=ha.KD_UNIT ) keluar
            from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location join erp_gdg_location_pic gi on gi.id_location=gh.id
            where pc.aktif='1' and gv.status='1' and gh.id='$id_location' and upper(pc.nama) like '%$cari%' and (case when '$no_lokasi'='All' then 'All' else gv.no_lokasi end)='$no_lokasi'
            order by pc.nama");
        return $query->result_array();
        // return $syntax;
    }   

}