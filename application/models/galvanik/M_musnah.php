<?php

class M_musnah extends CI_Model {

    function produk() {
        return $this->db->query("Select distinct cc.id_produk, pc.nama, cc.desain
            from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_barang pc on pc.id=cc.id_produk
            where substr(vb.kode_proses,0,1)='C' and vb.result='Baik' and cc.tipe='Produksi' and cc.kd_unit='12' and vb.status='1' and cc.desain>='2022'
            order by cc.desain desc, pc.nama desc");
    }

    function desain() {
        return $this->db->query("Select distinct cc.desain from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id where cc.desain>='2022' order by desain desc");
    }

    function periode() {
        return $this->db->query("Select distinct to_char(tgl, 'Mon-YYYY') periode, to_char(tgl, 'YYMM') from erp_galv_musnah where status<>0 order by to_char(tgl, 'YYMM') desc");
    }

    function filter_emboss($periode, $id_produk) {
        $query = $this->db->query("Select distinct to_char(ve.tgl,'Mon-YYYY') periode, ve.nmr, cd.master, vd.tgl tgl_st, vd.nmr nmr_st, va.no_master, ve.keterangan, cc.id_produk, to_char(ve.tgl,'YYMM') t_periode, ve.tgl tgl_musnah,
            (select count(ve2.id) from erp_galv_musnah ve2 join erp_galv_ipb vc2 on vc2.id_galv_proses=ve2.id_galv_proses join erp_galv_reject vd2 on vd2.id_galv_ipb=vc2.id where vd2.nmr=vd.nmr and vd2.tgl=vd.tgl and ve2.status<>'0') qty,
            (Select vc2.id from erp_galv_ipb vc2 join erp_galv_reject vd2 on vd2.id_galv_ipb=vc2.id join erp_galv_musnah ve2 on ve2.id_galv_proses=vc2.id_galv_proses where vd2.nmr=vd.nmr and ve2.status<>'0' and rownum='1') id
            from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_galv_waktu va on va.id=vb.id_waktu join erp_galv_ipb vc on vc.id_galv_proses=vb.id join erp_galv_reject vd on vd.id_galv_ipb=vc.id join erp_galv_musnah ve on ve.id_galv_proses=vc.id_galv_proses join erp_ppic_kp cc on cc.id=cd.id_kp
            where ve.status<>'0' and vd.status='2' and vc.aktif='2' and to_char(ve.tgl,'Mon-YYYY')='$periode' and cc.id_produk='$id_produk'
            order by vd.nmr");
        return $query->result_array();
    }

    function filter_galvanik($periode, $id_produk) {
        $query = $this->db->query("Select distinct ve.id, to_char(ve.tgl,'Mon-YYYY') periode, ve.nmr, cd.master, to_char(vb.mulai,'DD/MM/YYYY') tgl_st, vb.no_reg nmr_st, va.no_master, ve.keterangan, cc.id_produk, to_char(ve.tgl,'YYMM') t_periode, ve.tgl tgl_musnah,
            (select count(id) from erp_galv_proses where no_reg=vb.no_reg) qty,
            (select to_char(tgl_kembali,'DD/MM/YYYY') from erp_galv_bon where id_galv_proses=vb.id) tgl_master
            from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_galv_waktu va on va.id=vb.id_waktu join erp_galv_musnah ve on ve.id_galv_proses=vb.id join erp_ppic_kp cc on cc.id=cd.id_kp
            where ve.status<>'0' and to_char(ve.tgl,'Mon-YYYY')='$periode' and cc.id_produk='$id_produk' and vb.status<>'2'
            order by cd.master, vb.no_reg");
        return $query->result_array();
    }

    function auto_no($thn) {
        $query = $this->db->query("Select max(substr(ve.nmr,0,3)) nmr from erp_galv_musnah ve join erp_karyawan ha on ha.id=ve.id_input where substr(ve.nmr,-4)='$thn' and ve.status<>'0'");
        $data = $query->row_array();
        return  sprintf('%03d', $data['NMR'] + 1);
    }

    function ex_emboss($periode, $jenis, $desain, $tipe,$keterangan,$produk) { 
        $start_laporan = '210101';   

        $data = $this->db->query("Select distinct pc.nama, pc.kode, vd.nmr, cd.master,  to_char(vd.tgl,'DD-Mon-YYYY') tgl, vd.tgl tgl_retur,
            (select replace(substr(vb2.no_reg,0,4),'/') from erp_galv_proses vb2 join erp_galv_ipb vc2 on vc2.id_galv_proses=vb2.id join erp_galv_reject vd2 on vc2.id=vd2.id_galv_ipb where vd2.nmr=vd.nmr and rownum='1') kode_master,
            (select count(id) from erp_galv_reject where nmr=vd.nmr and status='2') qty_pch
            from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_galv_ipb vc on vc.id_galv_proses=vb.id join erp_galv_reject vd on vd.id_galv_ipb=vc.id
            where to_char(vd.tgl,'YYMMDD')<='$periode' and vd.status='2' and vc.aktif='2' and
            (case when '$jenis'='A' then 'A' else substr(vb.kode_proses,0,1) end)='$jenis' and (case when '$desain'='All' then 'All' else cc.desain end)='$desain' and (case when '$tipe'='All' then 'All' else cc.tipe end)='$tipe' and (case when '$produk'='All' then 'All' else pc.nama end)='$produk'
            and (select count(id) from erp_galv_musnah where id_galv_proses=vb.id and status<>'0')='0' and to_char(vd.tgl,'YYMMDD')>'$start_laporan'
            order by vd.tgl, vd.nmr");
        return $data->result_array();
    }

    function ex_reject($periode, $jenis, $desain, $tipe, $keterangan,$produk) {
        $data = $this->db->query("Select distinct vb.id, pc.nama, vb.no_reg, pc.kode, cd.master, vb.mulai, to_char(vb.mulai,'DD-Mon-YYYY') tgl,
            (select replace(substr(no_reg,0,4),'/') from erp_galv_proses where id=vb.id) kode_master
            from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id
            where substr(vb.kode_proses,0,1)='C' and vb.result='Reject' and to_char(vb.mulai,'YYMMDD')<='$periode' and
            (case when '$jenis'='A' then 'A' else substr(vb.kode_proses,0,1) end)='$jenis' and (case when '$desain'='All' then 'All' else cc.desain end)='$desain' and (case when '$tipe'='All' then 'All' else cc.tipe end)='$tipe' and (case when '$produk'='All' then 'All' else pc.nama end)='$produk'
            and (select count(id) from erp_galv_musnah where id_galv_proses=vb.id and status<>'0')='0'
            order by vb.mulai");
        return $data->result_array();
    }

    function ex_produksi($periode, $jenis, $desain, $tipe,$keterangan,$produk) {
        $data = $this->db->query("Select distinct vb.id, pc.nama, vb.no_reg, pc.kode, cd.master, to_char(vf.tgl_kembali,'DD-Mon-YYYY') tgl, vb.mulai,
            (select replace(substr(no_reg,0,4),'/') from erp_galv_proses where id=vb.id) kode_master
            from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_galv_bon vf on vf.id_galv_proses=vb.id
            where substr(vb.kode_proses,0,1)='C' and cd.master<>'PCH' and to_char(vf.tgl_kembali,'YYMMDD')<='$periode' and
            (case when '$jenis'='A' then 'A' else substr(vb.kode_proses,0,1) end)='$jenis' and (case when '$desain'='All' then 'All' else cc.desain end)='$desain' and (case when '$tipe'='All' then 'All' else cc.tipe end)='$tipe' and (case when '$produk'='All' then 'All' else pc.nama end)='$produk' 
            and (select count(id) from erp_galv_musnah where id_galv_proses=vb.id and status<>'0')='0' and vf.tgl_kembali is not null
            order by vb.mulai");
        return $data->result_array();
    }

    function urut() {
        $query = $this->db->query("Select max(id) urut from erp_galv_musnah");
        $data = $query->row_array();
        $urut = $data['URUT'] + 1;
        return $urut;
    }

    function cek_nomor($urut, $th, $bln) {
        $query = $this->db->query("Select count(id) qty from erp_galv_musnah where substr(nmr,0,3)='$urut' and substr(nmr,-4)='$th' and to_char(tgl, 'MM')<>'$bln' and status<>'0'");
        $data = $query->row_array();
        return $data['QTY'];
    }

    function dt_galv_proses($no_serah_terima) {
        $query = $this->db->query("Select vc.id_galv_proses from erp_galv_ipb vc join erp_galv_reject vd on vc.id=vd.id_galv_ipb where vd.nmr='$no_serah_terima' and vd.status='2'");
        return $query->result_array();
    }

    function simpan($id_musnah, $tgl, $nmr, $id_galv_proses, $id_kary, $keterangan) {
        $this->db->query("Insert into erp_galv_musnah(id, tgl, nmr, id_galv_proses, status, updated, id_input, keterangan) values('$id_musnah','$tgl','$nmr','$id_galv_proses','1',sysdate,'$id_kary','$keterangan')");
    }

    function hapus($id) {
        $this->db->query("Delete from erp_galv_musnah where id='$id'");
    }

    function dt_id($id) {
        $query = $this->db->query("Select ve.id from erp_galv_ipb vc join erp_galv_musnah ve on ve.id_galv_proses=vc.id_galv_proses where vc.nmr=(Select nmr from erp_galv_ipb where id='$id')");
        return $query->result_array();
    }

}