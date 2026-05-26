<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_lpb extends CI_Model {

    function db_perdana() {
        $perdana = $this->load->database('perdana', TRUE);
        return $perdana;
    }

    function unit() {
        return $this->db->query("Select * from erp_hr_unit order by unit desc");
    }

    function jenis() {
        return $this->db->query("Select distinct jenis from erp_barang order by jenis");
    }

    function kategori() {
        return $this->db->query("Select * from erp_ppic_kategori order by kategori");
    }

    function nmr() {
        return $this->db->query("Select distinct nmr, tgl from erp_pemb_lpb order by tgl desc");
    }

    function filter($tgl1, $tgl2, $kd_unit, $jenis) {
        return $this->db->query("Select distinct pl.id id_sp, pe.nama supplier, to_char(pl.tgl,'dd-mm-yyyy') tgl_sp, pl.tgl, pl.nmr, hd.kd_unit, hd.unit, pa.nomer no_po, pl.kend, pe.kode_jenis,
            (Select sum(nilai_beli) from erp_pemb_sp_detail where id_sp=pl.id and status<>0) dpp
            from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_hr_unit hd on hd.kd_unit=pa.kd_unit
            where (select count(id_sp) from erp_pemb_lpb_detail where id_sp=pl.id)=0
            and to_char(pl.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and
            (case when '$jenis'='All' then 'All' else substr(pa.nomer,16,1) end)='$jenis' and
            (case when '$kd_unit'='All' then 'All' else pa.kd_unit end)='$kd_unit' and pm.status<>0 
            order by pl.tgl desc, pl.nmr desc");
    }

    function nomor_lpb($kode_unit, $kode_HD) {
        $query = $this->db->query("Select max(substr(nmr_sakti,13,5)) urut from erp_pemb_lpb where kd_unit='$kode_unit' and substr(nmr_sakti,3,1)='$kode_HD'");
        $data = $query->row_array();
        return sprintf('%05d', $data['URUT'] + 1);
    }

    function cek_sp($kd_unit, $no_sp) {
        if ($kd_unit == '01') {
            $query = $this->db->query("Select * from hpd_sj_head where nomor_sj='$no_sp'");
            return $query->num_rows();
        }else{
            $query = $this->db->query("Select * from sj_head where nomor_sj='$no_sp'");
            return $query->num_rows();
        }
    }

    function cek_nomer($kd_unit,$nomer_lpb,$resmi_polos) {
        $kode = $nomer_lpb . '/' . $resmi_polos . '/';
        $query = $this->db->query("Select distinct pn.nmr
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id join erp_pemb_sp pl on pl.id=po.id_sp
            where pn.nmr like '$kode%' and pn.kd_unit='$kd_unit'");
        return $query->num_rows();
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

    function urut_lpb() {
        $query = $this->db->query("Select max(id) id from erp_pemb_lpb");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function simpan($id, $nmr, $id_input, $nmr_sakti, $tanggal_lpb, $kode_unit) {
        $this->db->query("Insert into erp_pemb_lpb(id, nmr, tgl, id_input, tgl_input, nmr_sakti, kd_unit) values('$id','$nmr','$tanggal_lpb','$id_input',sysdate,'$nmr_sakti','$kode_unit')");
    }

    function urut_lpb_detail() {
        $query = $this->db->query("Select max(id) id from erp_pemb_lpb_detail");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function simpan_detail($id, $id_lpb, $id_sp) {
        $this->db->query("Insert into erp_pemb_lpb_detail(id, id_lpb, id_sp) values('$id','$id_lpb','$id_sp')");
    }

    function nomor_sj($kode_unit) {
        $query = $this->db->query("Select max(substr(sp_intern,5,10)) urut from erp_pemb_sp where substr(sp_intern,3,2)='$kode_unit'");
        $data = $query->row_array();
        return $data['URUT'] + 1;
    }

    function update_sj_intern($id_sp,$nomor_sj) {
        $this->db->query("Update erp_pemb_sp set sp_intern='$nomor_sj' where id='$id_sp'");
    }

    function filter_detail($tgl1, $tgl2, $kd_unit, $resmi, $jenis, $kategori, $nmr) {
        return $this->db->query("Select pe.nama supplier, to_char(pn.tgl,'dd-mm-yyyy') tgl, pl.nmr nmr_sp, pn.nmr nmr_lpb, pc.jenis,
            case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end barang, pc.spesifikasi, pb.satuan, pm.qty qty_datang, pb.harga, pn.lpb_urut, cf.kd_kategori kategori,
            (select distinct verifikator from lpb_head where nomor_lpb=pn.nmr_sakti and rownum='1') verifikator
            from erp_supplier pe join erp_material_supply pd on pd.id_supplier=pe.id join erp_po_detail pb on pb.id_material_supply=pd.id join erp_pemb_sp_detail pm on pm.id_po_detail=pb.id join erp_pemb_sp pl on pl.id=pm.id_sp join erp_pemb_lpb_detail po on po.id_sp=pl.id join erp_pemb_lpb pn on pn.id=po.id_lpb join erp_barang pc on pc.id=pd.id_barang join erp_po pa on pa.id=pb.id_po join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail    
            left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
            select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
            on pc.kode_sakti= b.kode
            where to_char(pn.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and pa.kd_unit='$kd_unit' and (case when '$jenis'='All' then 'All' else pc.jenis end)='$jenis' and (case when '$nmr'='All' then 'All' else pn.nmr end)='$nmr' and (case when '$kategori'='All' then 'All' else cf.kd_kategori end)='$kategori' and (case when '$resmi'='A' then 'A' else substr(pa.nomer,16,1) end)='$resmi'
            order by pn.tgl desc, pn.nmr desc, pc.nama");
    }

    function data_hapus($nmr) {
        return $this->db->query("Select distinct po.id_sp
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id where pn.nmr='$nmr'");
    }

    function hapus_sj_intern($id_sp) {
        $this->db->query("Update erp_pemb_sp set sp_intern='' where id='$id_sp'");
    }

    function batal_profits($nmr) {
        $this->db->query("Delete from erp_pemb_lpb_detail where id_lpb=(select id from erp_pemb_lpb where nmr='$nmr')");
        $this->db->query("Delete from erp_pemb_lpb where nmr='$nmr'");
    }

    function cetak($no_lpb) {
        $query = $this->db->query("Select hd.unit, pe.nama supplier, pe.alamat, pe.kota, to_char(pl.tgl,'DD-Mon-YYYY') tgl_sj, pa.nomer nomer_spp, pn.lpb_urut nomor_lpb_urut, to_char(pn.tgl,'DD-Mon-YYYY') tgl_lpb, pa.top, pc.no_rekjurnal nomer_rekjurnal,case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama_barang, pc.spesifikasi, pb.satuan kode_satuan, pb.harga, pm.nilai_beli, pb.mata_uang, pa.ppn, pm.qty qty_datang, pe.kode_keuangan,
            (select xmlagg(xmlelement(e,no_sip||', ')).extract('//text()') from (select distinct substr(ce2.no_sip,0,4) no_sip, pn2.id from erp_ppic_sip ce2 join erp_ppic_sip_detail cf2 on cf2.id_sip=ce2.id join erp_po_detail pb2 on pb2.id_sip_detail=cf2.id join erp_pemb_sp_detail pm2 on pm2.id_po_detail=pb2.id join erp_pemb_lpb_detail po2 on po2.id_sp=pm2.id_sp join erp_pemb_lpb pn2 on pn2.id=po2.id_lpb where pn2.nmr='$no_lpb')) sip,
            (select xmlagg(xmlelement(e,pl2.nmr||', ')).extract('//text()') from erp_pemb_sp pl2 join erp_pemb_lpb_detail po2 on po2.id_sp=pl2.id where po2.id_lpb=pn.id) sj_extern,
            (select xmlagg(xmlelement(e,pl2.sp_intern||', ')).extract('//text()') from erp_pemb_sp pl2 join erp_pemb_lpb_detail po2 on po2.id_sp=pl2.id where po2.id_lpb=pn.id) sj_intern
            from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_pemb_lpb_detail po on po.id_sp=pl.id join erp_pemb_lpb pn on pn.id=po.id_lpb join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_barang pc on pc.id=pd.id_barang join erp_hr_unit hd on hd.kd_unit=pa.kd_unit
            left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
            select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
            on pc.kode_sakti= b.kode
            where pn.nmr='$no_lpb'");
        return $query->result_array();
    }

    function filter_rekap($tgl1, $tgl2, $kd_unit, $resmi) {
        return $this->db->query("Select distinct po.id_lpb, pe.nama supplier, pn.nmr nomer_lpb, pn.tgl, to_char(pn.tgl,'dd-Mon-yyyy') tgl_lpb, to_char(pn.tgl+pa.top,'DD-Mon-YYYY') tgl_tempo, (case when to_char(pn.tgl,'yymm') >= '2204' and pa.ppn='10' then '11' else pa.ppn end) nilai_ppn,
            (select sum(pb2.harga*pm2.qty) from erp_po_detail pb2 join erp_pemb_sp_detail pm2 on pm2.id_po_detail=pb2.id join erp_pemb_sp pl2 on pl2.id=pm2.id_sp join erp_pemb_lpb_detail po2 on po2.id_sp=pl2.id where po2.id_lpb=po.id_lpb) nilai_dpp
            from erp_supplier pe join erp_material_supply pd on pd.id_supplier=pe.id join erp_po_detail pb on pb.id_material_supply=pd.id join erp_pemb_sp_detail pm on pm.id_po_detail=pb.id join erp_pemb_sp pl on pl.id=pm.id_sp join erp_pemb_lpb_detail po on po.id_sp=pl.id join erp_pemb_lpb pn on pn.id=po.id_lpb join erp_po pa on pa.id=pb.id_po
            where pn.lpb_urut is not null and to_char(pn.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and pa.kd_unit='$kd_unit' and (case when '$resmi'='All' then 'All' else substr(pa.nomer,16,1) end)='$resmi'
            order by pn.tgl desc, pn.nmr desc");
    }

    function detail_sp($id_detail,$rekap) {
        if ($rekap == 'false') {
            $query = $this->db->query("Select distinct pl.nmr nomor_sj, pa.nomer, pc.nama, pc.spesifikasi, pb.qty qty_po, pm.qty qty_datang, pb.harga, pm.nilai_beli total, pm.id_po_detail
                from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_barang pc on pc.id=pd.id_barang
                where pm.status<>0 and pl.id='$id_detail'
                order by pc.nama");
        }else{
            $query = $this->db->query("Select distinct pl.nmr nomor_sj, pa.nomer, pc.nama, pc.spesifikasi, pb.qty qty_po, pm.qty qty_datang, pb.harga, pm.nilai_beli total 
                from erp_pemb_sp pl join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_barang pc on pc.id=pd.id_barang join erp_pemb_lpb_detail po on po.id_sp=pl.id
                where pm.status<>0 and po.id_lpb='$id_detail'
                order by pc.nama");
        }

        return $query->result_array();
    }


    // ========================================  Menu Sakti  ========================================
    // ==============================================================================================

    function dt_sp($nomer_lpb) {
        $query = $this->db->query("Select distinct po.id_sp, pl.nmr nmr_sj from erp_pemb_sp pl join erp_pemb_lpb_detail po on po.id_sp=pl.id join erp_pemb_lpb pn on pn.id=po.id_lpb where pn.nmr='$nomer_lpb'");
        return $query->result_array();
    }

    function data_sj($id_sp) {
        $query = $this->db->query("Select distinct pl.nmr nomor_sj, pe.kode_keuangan kode_supplier, pn.tgl tanggal_dok, pa.kd_unit, pn.nmr nmr_lpb, pl.kend, pl.tgl tgl_sp, he.kode_sub_unit, pl.tgl tgl_terima, pn.nmr_sakti, pn.tgl tgl_lpb, pl.sp_intern
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id join erp_pemb_sp pl on pl.id=po.id_sp join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_po pa on pa.id=pb.id_po join erp_hr_sub_unit he on he.kd_unit=pn.kd_unit where pl.id='$id_sp' and he.status='1'");
        return $query->row_array();
    }

    function simpan_sj_head($nomor_sj, $kode_supplier, $tanggal_dok, $users, $supplier_kendaraan, $kd_unit) {
        if ($kd_unit == '01') {
            $this->db->query("Insert into hpd_sj_head(nomor_sj, kode_supplier, tanggal_dok, users, last_update, verifikator, tgl_ver, nomor_sj_supp, supplier_kendaraan) values('$nomor_sj','$kode_supplier','$tanggal_dok','$users',sysdate,'$users',sysdate,'$nomor_sj','$supplier_kendaraan')");
        } else {
            $this->db->query("Insert into sj_head(nomor_sj, kode_supplier, tanggal_dok, users, last_update, verifikator, tgl_ver, nomor_sj_supp, supplier_kendaraan) values('$nomor_sj','$kode_supplier','$tanggal_dok','$users',sysdate,'$users',sysdate,'$nomor_sj','$supplier_kendaraan')");
        }
    }

    function data_detail_sp($id_sp) {
        $query = $this->db->query("Select distinct trim(pa.nomer) nomer_spp, pl.nmr nomer_sp, pc.kode_simpg kode_barang, pc.no_rekjurnal nomer_rekjurnal, pm.nilai_beli nilaibeli, pm.qty, pb.satuan kode_satuan, trim(ce.no_sip) nomer_sip, pb.satuan satuan_harga, trim(substr(pc.jenis,0,3)) jenis, pa.kd_unit, cf.urut_sip item_sip, pn.nmr_sakti
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id join erp_pemb_sp pl on pl.id=po.id_sp join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip
            where pl.id='$id_sp'");
        return $query->result_array();
    }

    function simpan_sj_item($nomor_sj, $nomor_spp, $nomor_sip, $item_sip, $qty, $nomor_lpb, $kd_unit) {
        if ($kd_unit == '01') {
            $this->db->query("Insert into hpd_sj_item(nomor_sj, nomor_spp, nomor_sip, item_sip, qty, nomor_lpb) values('$nomor_sj','$nomor_spp','$nomor_sip','$item_sip','$qty','$nomor_lpb')");
        } else {
            $this->db->query("Insert into sj_item(nomor_sj, nomor_spp, nomor_sip, item_sip, qty, nomor_lpb) values('$nomor_sj','$nomor_spp','$nomor_sip','$item_sip','$qty','$nomor_lpb')");
        }
    }

    function data_lpb($nomer_lpb) {
        $query = $this->db->query("Select distinct pe.kode_keuangan kode_supplier, pb.mata_uang, pa.top, pe.kode_jenis, pn.tgl tgl_lpb, pa.kd_unit, pn.nmr_sakti nomor_lpb, pn.lpb_urut, pe.kode_simpg kode, pn.kd_unit, he.kode_sub_unit, pn.nmr nomer_lpb, pa.ppn, to_char(pn.tgl, 'YY') thn,
            (Select max(nomor_lpb)+1 urut from nomor_urut_lpb where substr(nomor_lpb,0,2)=to_char(pn.tgl,'YY')) nomor_urut,
            (Select sum(pm2.nilai_beli) from erp_pemb_sp_detail pm2 join erp_pemb_sp pl2 on pl2.id=pm2.id_sp join erp_pemb_lpb_detail po2 on po2.id_sp=pl2.id join erp_pemb_lpb pn2 on pn2.id=po2.id_lpb where pn2.id=pn.id) nilai_dpp
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id join erp_pemb_sp pl on pl.id=po.id_sp join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_po pa on pa.id=pb.id_po join erp_hr_sub_unit he on he.kd_unit=pn.kd_unit
            where pn.nmr='$nomer_lpb' and he.status='1'");
        return $query->row_array();
    }

    function simpan_lpb_head($nomor_lpb, $kode_supplier, $tgl_lpb, $barang_jasa, $users, $lokal_impor, $mata_uang, $limit, $nomor_urut, $kd_unit) {
        if ($kd_unit == '01') {
            $this->db->query("Insert into hpd_lpb_head(nomor_lpb, kode_supplier, tanggal_lpb, barang_jasa, users, last_update, lokal_impor, mata_uang, limit, tanggal_kurs, nomor_urut) values('$nomor_lpb','$kode_supplier','$tgl_lpb','$barang_jasa','$users',sysdate,'$lokal_impor','$mata_uang','$limit','$tgl_lpb','$nomor_urut')");
        } else {
            $this->db->query("Insert into lpb_head(nomor_lpb, kode_supplier, tanggal_lpb, barang_jasa, users, last_update, lokal_impor, mata_uang, limit, tanggal_kurs, nomor_urut) values('$nomor_lpb','$kode_supplier','$tgl_lpb','$barang_jasa','$users',sysdate,'$lokal_impor','$mata_uang','$limit','$tgl_lpb','$nomor_urut')");
        }

        $this->db->query("Insert into nomor_urut_lpb(nomor_lpb, users, last_update) values('$nomor_urut','$users',sysdate)");
    }

    function update_lpb($nomor_lpb,$nomor_urut) {
        $this->db->query("Update erp_pemb_lpb set lpb_urut='$nomor_urut' where nmr_sakti='$nomor_lpb'");
    }

    function data_lpb_detail($nomer_lpb) {
        $query = $this->db->query("Select distinct pa.nomer nomor_spp, ce.no_sip nomor_sip, cf.urut_sip item_sip, pm.qty, pl.nmr nomor_sj
            from erp_pemb_lpb pn join erp_pemb_lpb_detail po on po.id_lpb=pn.id join erp_pemb_sp pl on pl.id=po.id_sp join erp_pemb_sp_detail pm on pm.id_sp=pl.id join erp_po_detail pb on pb.id=pm.id_po_detail join erp_material_supply pd on pd.id=pb.id_material_supply join erp_po pa on pa.id=pb.id_po join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip
            where pn.nmr='$nomer_lpb'");
        return $query->result_array();
    }

    function simpan_lpb_item($nomor_lpb, $nomor_spp, $nomor_sip, $item_sip, $qty, $nomor_sj, $pph, $kd_unit) {
        if ($kd_unit == '01') {
            $this->db->query("Insert into hpd_lpb_item(nomor_lpb, nomor_spp, nomor_sip, item_sip, qty, nomor_sj, pph) values('$nomor_lpb','$nomor_spp','$nomor_sip','$item_sip','$qty','$nomor_sj','$pph')");
        } else {
            $this->db->query("Insert into lpb_item(nomor_lpb, nomor_spp, nomor_sip, item_sip, qty, nomor_sj, pph) values('$nomor_lpb','$nomor_spp','$nomor_sip','$item_sip','$qty','$nomor_sj','$pph')");
        }
    }

    function hapus_lpb_urut($lpb_urut) {
        $this->db->query("Delete from nomor_urut_lpb where nomor_lpb='$lpb_urut'");
    }

    function hapus_lpb_sakti($kd_unit, $nomor_lpb) {
        if ($kd_unit == '01') {
            $this->db->query("Delete from hpd_lpb_item where nomor_lpb='$nomor_lpb'");
            $this->db->query("Delete from hpd_lpb_head where nomor_lpb='$nomor_lpb'");
            $this->db->query("Delete from hpd_sj_item where nomor_lpb='$nomor_lpb'");
        } else {
            $this->db->query("Delete from lpb_item where nomor_lpb='$nomor_lpb'");
            $this->db->query("Delete from lpb_head where nomor_lpb='$nomor_lpb'");
            $this->db->query("Delete from sj_item where nomor_lpb='$nomor_lpb'");
        }
    }

    function hapus_sj_sakti($kd_unit, $nomor_sj) {
        if ($kd_unit == '01') {
            $this->db->query("Delete from hpd_sj_head where nomor_sj='$nomor_sj'");
        } else {
            $this->db->query("Delete from sj_head where nomor_sj='$nomor_sj'");
        }
    }


    // ========================================  Menu Sakti  ========================================
    // ==============================================================================================
    
    function cek_simpg($kd_unit, $nmr_lpb) {
        if ($kd_unit == '01') {
            $query = $this->db_perdana()->query("Select * from tbl_lpb where trim(nomer_lpb)='$nmr_lpb'");
        }else{
            $query = $this->db->query("Select * from tbl_lpb where trim(nomer_lpb)='$nmr_lpb'");
        }
        return $query->num_rows();
    }

    function simpan_sp_simpg($nomer_sp, $nomer_lpb, $no_kendaraan, $tanggal_sp, $username, $kode_unit, $kode_proyek, $kode_sub_unit, $status, $upload, $nomor_sj, $tanggal_terima, $nomor_lpb, $no_lc, $f_buat_lpb, $tgl_lpb) {
        if ($kode_unit == '01') {
            $this->db_perdana()->query("Insert into tbl_header_sp(nomer_sp, nomer_lpb, tanggal_lpb, no_kendaraan, tanggal_sp, username, lastupdate, kode_unit, kode_proyek, kode_sub_unit, status, upload, nomor_sj, tanggal_terima, nomor_lpb, no_lc, f_buat_lpb) values('$nomer_sp','$nomer_lpb','$tgl_lpb','$no_kendaraan','$tanggal_sp','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$kode_sub_unit','$status','$upload','$nomor_sj','$tanggal_terima','$nomor_lpb','$no_lc','$f_buat_lpb')");            
        }else{
            $this->db->query("Insert into tbl_header_sp(nomer_sp, nomer_lpb, tanggal_lpb, no_kendaraan, tanggal_sp, username, lastupdate, kode_unit, kode_proyek, kode_sub_unit, status, upload, nomor_sj, tanggal_terima, nomor_lpb, no_lc, f_buat_lpb) values('$nomer_sp','$nomer_lpb','$tgl_lpb','$no_kendaraan','$tanggal_sp','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$kode_sub_unit','$status','$upload','$nomor_sj','$tanggal_terima','$nomor_lpb','$no_lc','$f_buat_lpb')");
        }
    }

    function simpan_sp_simpg_detail($kd_unit, $nomer_spp, $nomer_sp, $kode_barang, $kode_gudang, $nomer_rekjurnal, $kurs, $nilaibeli, $qty1, $qty2, $kode_satuan, $nomer_sip, $nomer_urut_sp, $satuan_harga, $nomer_lpb) {
        if ($kd_unit == '01') {
            $this->db_perdana()->query("Insert into tbl_detail_sp(nomer_spp, nomer_sp, kode_barang, kode_gudang, nomer_rekjurnal, kurs, nilaibeli, qty1, qty2, kode_satuan, nomer_sip, nomer_urut_sp, satuan_harga, nomer_lpb) values('$nomer_spp','$nomer_sp','$kode_barang','$kode_gudang','$nomer_rekjurnal','$kurs','$nilaibeli','$qty1','$qty2','$kode_satuan','$nomer_sip','$nomer_urut_sp','$satuan_harga','$nomer_lpb')");
        }else{
            $this->db->query("Insert into tbl_detail_sp(nomer_spp, nomer_sp, kode_barang, kode_gudang, nomer_rekjurnal, kurs, nilaibeli, qty1, qty2, kode_satuan, nomer_sip, nomer_urut_sp, satuan_harga, nomer_lpb) values('$nomer_spp','$nomer_sp','$kode_barang','$kode_gudang','$nomer_rekjurnal','$kurs','$nilaibeli','$qty1','$qty2','$kode_satuan','$nomer_sip','$nomer_urut_sp','$satuan_harga','$nomer_lpb')");
        }
    }

    function simpan_simpg_lpb($nomer_lpb, $tgl_lpb, $kode, $nilai_dpp, $nilai_ppn, $nilai_pph, $debet, $top, $kode_rekkredit, $kode_rekdebet, $adjusment, $kurs, $nomer_tt, $tanggal_tt, $kode_unit, $kode_proyek, $kode_sub_unit, $upload, $nomor_lpb, $nomor_lpb_urut, $f_cetak) {
        if ($kode_unit == '01') {
            $this->db_perdana()->query("Insert into tbl_lpb(nomer_lpb, tanggal_lpb, kode, nilai_dpp, nilai_ppn, nilai_pph, debet, top, kode_rekkredit, kode_rekdebet, adjusment, kurs, nomer_tt, tanggal_tt, kode_unit, kode_proyek, kode_sub_unit, upload, nomor_lpb, nomor_lpb_urut, f_cetak) values('$nomer_lpb','$tgl_lpb','$kode','$nilai_dpp','$nilai_ppn','$nilai_pph','$debet','$top','$kode_rekkredit','$kode_rekdebet','$adjusment','$kurs','$nomer_tt','$tanggal_tt','$kode_unit','$kode_proyek','$kode_sub_unit','$upload','$nomor_lpb','$nomor_lpb_urut','$f_cetak')");
        }else{
            $this->db->query("Insert into tbl_lpb(nomer_lpb, tanggal_lpb, kode, nilai_dpp, nilai_ppn, nilai_pph, debet, top, kode_rekkredit, kode_rekdebet, adjusment, kurs, nomer_tt, tanggal_tt, kode_unit, kode_proyek, kode_sub_unit, upload, nomor_lpb, nomor_lpb_urut, f_cetak) values('$nomer_lpb','$tgl_lpb','$kode','$nilai_dpp','$nilai_ppn','$nilai_pph','$debet','$top','$kode_rekkredit','$kode_rekdebet','$adjusment','$kurs','$nomer_tt','$tanggal_tt','$kode_unit','$kode_proyek','$kode_sub_unit','$upload','$nomor_lpb','$nomor_lpb_urut','$f_cetak')");
        }
    }

    function hapus_lpb_simpg($nmr_lpb) {
        $query = $this->db->query("Select kd_unit from erp_pemb_lpb where nmr='$nmr_lpb'");
        $data = $query->row_array();
        $kode_unit = $data['KD_UNIT'];

        if ($kode_unit == '01') {
            $this->db_perdana()->query("Update tbl_lpb set upload=null where trim(nomer_lpb)='$nmr_lpb'");
            $this->db_perdana()->query("Delete from tbl_lpb where trim(nomer_lpb)='$nmr_lpb'");

            $this->db_perdana()->query("Update tbl_header_sp set upload=null where trim(nomer_lpb)='$nmr_lpb'");
            $this->db_perdana()->query("Delete from tbl_header_sp where trim(nomer_lpb)='$nmr_lpb'");
        }else{
            $this->db->query("Update tbl_lpb set upload='' where trim(nomer_lpb)='$nmr_lpb'");
            $this->db->query("Update tbl_header_sp set upload='' where trim(nomer_lpb)='$nmr_lpb'");
            
            $this->db->query("Delete from tbl_lpb where trim(nomer_lpb)='$nmr_lpb'");
            $this->db->query("Delete from tbl_header_sp where trim(nomer_lpb)='$nmr_lpb'");
        }
    }

}
