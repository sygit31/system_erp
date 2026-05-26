<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_bulanan_pet extends CI_Model {

    function desain() {
        return $this->db->query("Select distinct desain from erp_gudang_order where length(desain)=4 order by desain desc");
    }

    function id_barang($desain) {
        $query = $this->db->query("Select xmlagg(xmlelement(e,id_barang||',')).extract('//text()') id_barang from erp_lap_pet where desain='$desain' and status='1'");
        $data = $query->row_array()['ID_BARANG'];
        $id_barang = substr($data, 0, strlen($data)-1);
        return implode("','", explode(',', $id_barang)) ;
    }

    function filter($desain, $id_barang) {
        $query = $this->db->query("Select distinct to_char(ga.tgl_terima, 'Mon-YY') bulan, to_char(ga.tgl_terima, 'YYMM') bln,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_po pa2 on pa2.id=pb2.id_po join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang in ('" . $id_barang . "') and to_char(ga2.tgl_terima, 'YYMM')<to_char(ga.tgl_terima, 'YYMM')) masuk_awal,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_pengeluaran_detail gd2 on gd2.id_detail_terima=gb2.id_detail_terima join erp_pengeluaran gc2 on gc2.id_keluar=gd2.id_keluar join erp_gudang_order ca2 on ca2.id=gc2.id_gudang_order where ca2.id_barang in ('" . $id_barang . "') and to_char(gc2.tgl_keluar, 'YYMM')<to_char(ga.tgl_terima, 'YYMM')) keluar_awal,
            (select sum(dc2.reject) from erp_prod_pet_detail dc2 join erp_prod_retur_detail di2 on di2.id_prod_pet_detail=dc2.id join erp_prod_retur dh2 on dh2.id=di2.id_prod_retur join erp_prod_pet_detail_terima dd2 on dd2.id_prod_pet_detail=di2.id_prod_pet_detail join erp_penerimaan_detail gb2 on gb2.id_detail_terima=dd2.id_detail_terima join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join             erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail where cf2.id_barang in ('" . $id_barang . "') and to_char(dh2.tgl,'YYMM')<to_char(ga.tgl_terima, 'YYMM')) retur_awal,
            (Select sum(gm2.qty) from erp_gdg_retur gl2 join erp_gdg_retur_detail gm2 on gm2.id_gdg_retur=gl2.id join erp_po_detail pb2 on pb2.id=gm2.id_po_detail join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail where to_char(gl2.tgl,'YYMM')<to_char(ga.tgl_terima, 'YYMM') and cf2.id_barang in ('" . $id_barang . "')) reject_awal,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_po pa2 on pa2.id=pb2.id_po join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang in ('" . $id_barang . "') and to_char(ga2.tgl_terima, 'YYMM')=to_char(ga.tgl_terima, 'YYMM')) masuk,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_pengeluaran_detail gd2 on gd2.id_detail_terima=gb2.id_detail_terima join erp_pengeluaran gc2 on gc2.id_keluar=gd2.id_keluar join erp_gudang_order ca2 on ca2.id=gc2.id_gudang_order where ca2.id_barang in ('" . $id_barang . "') and to_char(gc2.tgl_keluar, 'YYMM')=to_char(ga.tgl_terima, 'YYMM') and ca2.seri='SERI I') keluar1,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_pengeluaran_detail gd2 on gd2.id_detail_terima=gb2.id_detail_terima join erp_pengeluaran gc2 on gc2.id_keluar=gd2.id_keluar join erp_gudang_order ca2 on ca2.id=gc2.id_gudang_order where ca2.id_barang in ('" . $id_barang . "') and to_char(gc2.tgl_keluar, 'YYMM')=to_char(ga.tgl_terima, 'YYMM') and ca2.seri='SERI II') keluar2,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_pengeluaran_detail gd2 on gd2.id_detail_terima=gb2.id_detail_terima join erp_pengeluaran gc2 on gc2.id_keluar=gd2.id_keluar join erp_gudang_order ca2 on ca2.id=gc2.id_gudang_order where ca2.id_barang in ('" . $id_barang . "') and to_char(gc2.tgl_keluar, 'YYMM')=to_char(ga.tgl_terima, 'YYMM') and ca2.seri='SERI III') keluar3,
            (select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_pengeluaran_detail gd2 on gd2.id_detail_terima=gb2.id_detail_terima join erp_pengeluaran gc2 on gc2.id_keluar=gd2.id_keluar join erp_gudang_order ca2 on ca2.id=gc2.id_gudang_order where ca2.id_barang in ('" . $id_barang . "') and to_char(gc2.tgl_keluar, 'YYMM')=to_char(ga.tgl_terima, 'YYMM') and ca2.seri='MMEA') keluar4,
            (select sum(dc2.reject) from erp_prod_pet_detail dc2 join erp_prod_retur_detail di2 on di2.id_prod_pet_detail=dc2.id join erp_prod_retur dh2 on dh2.id=di2.id_prod_retur join erp_prod_pet_detail_terima dd2 on dd2.id_prod_pet_detail=di2.id_prod_pet_detail join erp_penerimaan_detail gb2 on gb2.id_detail_terima=dd2.id_detail_terima join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail where cf2.id_barang in ('" . $id_barang . "') and to_char(dh2.tgl,'YYMM')=to_char(ga.tgl_terima, 'YYMM')) retur,
            (Select sum(gm2.qty) from erp_gdg_retur gl2 join erp_gdg_retur_detail gm2 on gm2.id_gdg_retur=gl2.id join erp_po_detail pb2 on pb2.id=gm2.id_po_detail join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail where to_char(gl2.tgl,'YYMM')=to_char(ga.tgl_terima, 'YYMM') and cf2.id_barang in ('" . $id_barang . "')) reject
            from erp_penerimaan ga join erp_penerimaan_detail gb on gb.id_terima=ga.id_terima join erp_po_detail pb on pb.id=ga.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang
            where pc.tahun='$desain' and pc.id in ('" . $id_barang . "')
            order by to_char(ga.tgl_terima, 'YYMM')");
        return $query->result_array(); // Ambil semua data keluar-masuk PET
    }

}