<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_sj extends CI_Model
{

    function db_oraholo() {
        $admin = $this->load->database('admin', TRUE);
        return $admin;
    }

    function db_perdana() {
        $perdana = $this->load->database('perdana', TRUE);
        return $perdana;
    }

    function id_kary() {
        $kary = explode('|', $_SESSION['logERP']);
        return $kary[0];
    }

    function username($id_kary) {
        $query = $this->db->query("Select upper(substr(replace(nama,' ',''),0,8)) username from erp_karyawan where id='$id_kary'");
        $data = $query->row_array();
        return $data['USERNAME'];
    }
    
    function unit() {
        return $this->db->query("Select * from erp_hr_unit where status<>'0' order by unit desc");
    }

    function alokasi() {
        return $this->db->query("Select biaya, nomer_transaksi, kd_unit, alokasi from erp_pemb_alokasi order by biaya");
    }

    function supplier() {
        return $this->db->query("Select id, nama, kode_jenis from erp_supplier where aktif<>'0' order by nama");
    }

    function kategori() {
        return $this->db->query("Select * from erp_ppic_kategori order by kategori");
    }

    function kd_unit() {
        $kary = explode('|', $_SESSION['logERP']);
        $id_kary = $this->id_kary();
        
        $query = $this->db->query("Select ha.kd_unit from erp_karyawan ha where ha.id='$id_kary'");
        $data = $query->row_array();
        return $data['KD_UNIT'];
    }

    function jenis() {
        return $this->db->query("Select distinct jenis from erp_barang order by jenis");
    }

    function nmr() {
        return $this->db->query("Select distinct nmr, tgl from erp_pemb_sp order by tgl desc");
    }

    function filter($tgl1, $tgl2, $kd_unit, $kategori, $jenis, $nmr) {
        return $this->db->query("Select pm.id id_detail_sp, pe.nama supplier, to_char(pl.tgl,'dd-mm-yyyy') tgl,ce.no_sip, pl.nmr, pc.jenis, case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama_barang
           , pc.spesifikasi, pc.satuan, pm.qty qty_sp, pa.nomer, pb.harga, pb.qty qty_po, ha.nama kary,
            (select distinct cn2.kategori from erp_ppic_kategori cn2 join erp_ppic_sip_detail cf2 on cf2.kd_kategori=cn2.kode where cf2.id=pb.id_sip_detail) kategori,
            (select pn.nmr from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id where po.id_sp=pl.id and rownum='1') no_lpb,
            (select count(id) from erp_pemb_lpb_detail where id_sp=pl.id) qty_data
            from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_supplier pe on pe.id=pd.id_supplier join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip join erp_karyawan ha on ha.id=pl.id_input
            left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
            select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
            on pc.kode_sakti= b.kode 
            where to_char(pl.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and pm.status<>0 and ce.kd_unit='$kd_unit' and (case when '$nmr'='All' then 'All' else pl.nmr end)='$nmr' and (case when '$jenis'='All..' then 'All..' else pc.jenis end)='$jenis' and (case when '$kategori'='All..' then 'All..' else cf.kd_kategori end)='$kategori'
            order by pl.tgl desc, pl.nmr, pc.nama");
    }

    function data_po($id_supplier, $kd_unit) {
        $query = $this->db->query("select * from (Select pa.nomer no_po,pa.nomor_urut_sakti as urut_sakti, pe.nama supplier,case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama_barang , pc.spesifikasi, pb.qty qty_po, pb.satuan, pb.harga, pd.mata_uang, pb.id id_po_detail,
            (Select nvl(sum(qty),0) from erp_pemb_sp_detail where id_po_detail=pb.id and status<>0) qty_datang
            from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip join erp_supplier pe on pe.id=pd.id_supplier    
            left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
            select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
            on pc.kode_sakti= b.kode 
            where pd.id_supplier='$id_supplier' and ce.kd_unit='$kd_unit' and pb.status='OTW') where qty_po > qty_datang");
        return $query->result_array();
    }

    function cek_sp($id_sp_edit, $no_sp, $kd_unit) {
        if ($id_sp_edit == '') {
            $query = $this->db->query("Select * from erp_pemb_sp where nmr='$no_sp'");
        }else{
            $query = $this->db->query("Select * from erp_pemb_sp where nmr='$no_sp' and id<>'$id_sp_edit'");            
        }
        $qty_profits = $query->num_rows();

        if ($kd_unit == '01') {
            $query = $this->db->query("Select * from hpd_sj_head where trim(nomor_sj)='$no_sp'");
        }else{
            $query = $this->db->query("Select * from sj_head where trim(nomor_sj)='$no_sp'");
        }
        $qty_sakti = $query->num_rows();

        return $qty_profits + $qty_sakti;
    }

    function urut_sp() {
        $query = $this->db->query("Select max(id) id from erp_pemb_sp");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function total_datang($id_po_detail, $id_sp_edit) {
        if ($id_sp_edit == '') {
            $query = $this->db->query("Select nvl(sum(qty),0) qty from erp_pemb_sp_detail where id_po_detail='$id_po_detail'");
        }else{
            $query = $this->db->query("Select ((select sum(qty) from erp_pemb_sp_detail where id_po_detail='$id_po_detail')-pm.qty) qty from erp_pemb_sp_detail pm where pm.id_sp='$id_sp_edit' and pm.id_po_detail='$id_po_detail'");
        }
        $data = $query->row_array();
        return $data['QTY'];
    }

    function simpan($id_sp, $no_sp, $tgl, $id_kary, $no_kend) {
        $this->db->query("Insert into erp_pemb_sp(id, nmr, tgl, id_input, tgl_input, kend) values('$id_sp','$no_sp','$tgl','$id_kary',sysdate,'$no_kend')");
    }

    function urut_sp_detail() {
        $query = $this->db->query("Select max(id) id from erp_pemb_sp_detail");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function simpan_detail($id_sp_detail, $id_sp, $id_po_detail, $qty_datang, $nilai_beli) {
        $this->db->query("Insert into erp_pemb_sp_detail(id, id_sp, id_po_detail, qty, nilai_beli, status) values('$id_sp_detail','$id_sp','$id_po_detail','$qty_datang','$nilai_beli','1')");
    }

    function close_po($id_po_detail) {
        $this->db->query("Update erp_po_detail set status='FINISH' where id='$id_po_detail'");
    }

    function open_po($id_po_detail) {
        $this->db->query("Update erp_po_detail set status='OTW' where id='$id_po_detail'");
    }

    function edit($id_detail) {
        $query = $this->db->query("Select pl.id id_sp, pl.nmr, pl.tgl, pe.id supplier, pl.kend, pa.kd_unit, pa.nomer nmr_po, pc.nama barang, pc.spesifikasi, pb.qty qty_po, pm.qty qty_datang, pb.satuan, pb.harga, pb.mata_uang, pb.id id_po_detail
            from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_hr_unit hd on hd.kd_unit=pa.kd_unit join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_supplier pe on pe.id=pd.id_supplier where pl.id=(Select id_sp from erp_pemb_sp_detail where id='$id_detail')");
        return $query->result_array();
    }

    function cek_batal($id_detail) {
        $query = $this->db->query("Select * from erp_pemb_lpb_detail where id_sp=(select id_sp from erp_pemb_sp_detail where id='$id_detail')");
        return $query->num_rows();        
    }

    function batal($id_detail) {
        $query = $this->db->query("Select id_sp, id_po_detail from erp_pemb_sp_detail where id='$id_detail'");
        $data = $query->row_array();

        $id_sp = $data['ID_SP'];
        $query = $this->db->query("Select * from erp_pemb_lpb_detail where id_sp='$id_sp'");
        if ($query->num_rows() != 0) {return;}

        $this->del_lpb($id_sp);
        $this->db->query("Delete from erp_pemb_sp_detail where id='$id_detail'");
        $query = $this->db->query("Select * from erp_pemb_sp_detail where id_sp='$id_sp'");
        if ($query->num_rows() == 0) {
            $this->db->query("Delete from erp_pemb_sp where id='$id_sp'");
        }

        $id_po_detail = $data['ID_PO_DETAIL'];
        $this->open_po($id_po_detail);
    }

    function hapus($id_sp_edit) {
        $query = $this->db->query("Select * from erp_pemb_lpb_detail where id_sp='$id_sp_edit'");
        if ($query->num_rows() != 0) {return '1'; return;}

        $this->del_lpb($id_sp_edit);
        $this->db->query("Delete from erp_pemb_sp where id='$id_sp_edit'");
        $this->db->query("Delete from erp_pemb_sp_detail where id_sp='$id_sp_edit'");
    }

    function del_lpb($id_sp) {
        $this->db->query("Delete from erp_pemb_lpb_detail where id_lpb=(select id_lpb from erp_pemb_lpb_detail where id_sp='$id_sp')");
        $this->db->query("Delete from erp_pemb_lpb where id=(select id_lpb from erp_pemb_lpb_detail where id_sp='$id_sp')");
    }


    // ========================================  Menu Holo Perdana  ========================================
    // =====================================================================================================
    
    function dt_sp($id_sp) {
        $query = $this->db->query("Select pa.kd_unit, pc.kode_simpg kode_barang, pl.tgl, pm.qty, pb.satuan, pb.harga, pm.nomor_referensi,
            (select substr(kode_simpg, 0, 2) from erp_barang where id=cf.id_barang) kode_gudang, pm.id id_detail_sp,
            (select username from erp_akun where id_karyawan=pl.id_input) userid
            from erp_pemb_sp_detail pm join erp_pemb_sp pl on pl.id=pm.id_sp join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_barang pc on pc.id=cf.id_barang
            where pl.id='$id_sp'");
        return $query->result_array();
    }

    function nomor_referensi() {
        $query = $this->db->query("Select max(nomor_referensi) nomor_referensi from tbl_transaksi_lpb");
        $data = $query->row_array();
        return $data['NOMOR_REFERENSI'] + 1;
    }

    function upload_hpd($kode_gudang, $kode_barang, $tanggal_stok, $nomor_referensi, $tanggal_transaksi, $qty, $satuan, $harga, $userid) {
        $this->db->query("Insert into tbl_transaksi_lpb(kode_gudang, kode_barang, nomor_referensi, tanggal_transaksi, qty, satuan, harga, userid) values('$kode_gudang', '$kode_barang', '$nomor_referensi', '$tanggal_transaksi', '$qty', '$satuan', '$harga', '$userid')");
    }

    function update_sp($id_detail_sp, $nomor_referensi) {
        $this->db->query("Update erp_pemb_sp_detail set nomor_referensi='$nomor_referensi' where id='$id_detail_sp'");
    }

    function hapus_hpd($nomor_referensi) {
        $this->db->query("Delete from tbl_transaksi_lpb where nomor_referensi='$nomor_referensi'");
    }

    function dt_referensi($id_detail) {
        $query = $this->db->query("Select nomor_referensi from erp_pemb_sp_detail where id='$id_detail'");
        return $query->row_array()['NOMOR_REFERENSI'];
    }

    function lokasi() {
        return $this->db->query("Select a.kode_gudang, a.gudang,
            (select xmlagg(xmlelement(e,gi.id_karyawan||'@')).extract('//text()') id_kary from erp_gdg_location_pic gi join erp_gdg_location gh on gh.id=gi.id_location
            where gh.id=b.id) pic
            from tbl_master_gudang a join erp_gdg_location b on b.kd_hpd=a.kode_gudang order by a.gudang");
    }

}
