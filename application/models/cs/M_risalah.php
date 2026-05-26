<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_risalah extends CI_Model {

    function show_risalah(){
        $date1 = date_create(date('Y-m-d', strtotime('-30 days')));
        $date2 = date_create(date('Y-m-d'));

        $tgl1 = date_format($date1,'d-m-Y');
        $tgl2 = date_format($date2,'d-m-Y');

        return $this->db->query("Select ub.id id_detail, ua.id id_risalah, ua.tgl, rb.desain, ua.nmr, ua.delivery, ra.nama, ra.satuan, ub.qty,
            (Select sum(qty) from erp_cs_risalah_revisi where id_risalah_detail=ub.id) as qty_rev
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah
            where ua.tgl between '$tgl1' and '$tgl2'
            order by rb.desain desc, ua.id, ra.nama");
    }

    function filter_risalah($tgl1,$tgl2,$desain,$cari){
        return $this->db->query("Select ub.id id_detail, ua.id id_risalah, ua.tgl, rb.desain, ua.nmr, ua.delivery, ra.nama, ra.satuan, ub.qty,
            (Select sum(qty) from erp_cs_risalah_revisi where id_risalah_detail=ub.id) as qty_rev
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah
            where ua.tgl between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else rb.desain end)='$desain' and upper(ua.nmr) like '%$cari%'
            order by rb.desain desc, ua.id, ra.nama");
    }

    function show_produk(){
        return $this->db->query("Select rb.id, ra.nama, rb.desain from erp_rnd_proses rb join erp_rnd_produk ra on ra.id=rb.id_produk order by rb.desain desc, ra.nama");
    }

    function simpan_risalah($data){
        $no_risalah = $data[0]['no_risalah'];
        $tanggal = date('d-m-Y',strtotime($data[0]['tgl']));
        $delivery = date('d-m-Y',strtotime($data[0]['delivery']));
        $nmr = $this->db->query("Select max(id) as id from erp_cs_risalah");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;

        $this->db->query("Insert into erp_cs_risalah (id, nmr, tgl, delivery) values ('$id','$no_risalah','$tanggal','$delivery')");
        
        $nmr = $this->db->query("Select max(id) as id from erp_cs_risalah_detail");
        $urut = $nmr->row_array();
        $id_detail = $urut['ID'] + 1;

        for($i = 0; $i < count($data); $i++) {
            $id_produk = $data[$i]['id_produk'];
            $qty = $data[$i]['qty'];
            $this->db->query("Insert into erp_cs_risalah_detail (id, id_risalah, id_proses, qty) values ('$id_detail','$id','$id_produk','$qty')");
            $id_detail++;
        }
    }

}

?>