<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rev_risalah extends CI_Model {

    function show_rev_risalah(){
        $date1 = date_create(date('Y-m-d', strtotime('-30 days')));
        $date2 = date_create(date('Y-m-d'));

        $tgl1 = date_format($date1,'d-m-Y');
        $tgl2 = date_format($date2,'d-m-Y');

        return $this->db->query("Select ua.nmr nmr_risalah, uc.tgl, rb.desain, uc.nmr, ua.delivery, ra.nama, ra.satuan, uc.qty
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah join erp_cs_risalah_revisi uc on uc.id_risalah_detail=ub.id
            where uc.tgl between '$tgl1' and '$tgl2' order by rb.desain desc, uc.tgl, ra.nama");
    }

    function filter_risalah_rev($tgl1,$tgl2,$desain,$cari) {
        return $this->db->query("Select ua.nmr nmr_risalah, uc.tgl, rb.desain, uc.nmr, ua.delivery, ra.nama, ra.satuan, uc.qty
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah join erp_cs_risalah_revisi uc on uc.id_risalah_detail=ub.id
            where uc.tgl between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else rb.desain end)='$desain' and upper(ua.nmr) like '%$cari%'
            order by rb.desain desc, uc.tgl, ra.nama");
    }

    function get_risalah() {
        return $this->db->query("Select ua.id, ub.id id_detail, rb.desain, ra.satuan, ua.nmr, ua.tgl, ua.delivery, ra.nama, ub.qty,
            (Select sum(qty) from erp_cs_risalah_revisi where id_risalah_detail=ub.id) as qty_rev
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id join erp_cs_risalah_detail ub on ub.id_proses=rb.id join erp_cs_risalah ua on ua.id=ub.id_risalah
            order by rb.desain desc, ua.id, ra.id");
    }

    function get_no_risalah($data) {
        $result = $this->db->query("Select distinct(nmr) as nmr from
            (select ua.nmr as nmr from erp_ppic_produk cb inner join erp_cs_risalah_detail vb on ra.id=ub.id_produk inner join erp_cs_risalah va on ua.id=ub.id_risalah where rb.desain='$data' order by rb.desain desc, ua.id, ra.id)");
        return $result->result();
    }

    function simpan_revisi($data){
        $nmr = $this->db->query("Select max(id) as id from erp_cs_risalah_revisi");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;
        $id_detail = $data[0];
        $no_revisi = $data[1];
        $tgl = date('d-m-Y',strtotime($data[2]));
        $qty = $data[3];

        $this->db->query("Insert into erp_cs_risalah_revisi (id,tgl,nmr,id_risalah_detail,qty) values ('$id','$tgl','$no_revisi','$id_detail','$qty')");
    }

    function filter_rev_risalah($tgl1,$tgl2,$desain,$cari) {
        $rev_risalah = $this->db->query("Select uc.tgl, rb.desain, uc.nmr, ua.delivery, ra.nama, ra.satuan, uc.qty from erp_cs_risalah va inner join (erp_ppic_produk cb inner join (erp_cs_risalah_revisi vc inner join erp_cs_risalah_detail vb on uc.id_risalah_detail=ub.id) on ra.id=ub.id_produk) on ua.id=ub.id_risalah where uc.tgl between '$tgl1' and '$tgl2' and if('$desain'='','',rb.desain)='$desain' and uc.nmr like '%$cari%' order by rb.desain desc, uc.id, ra.id");
        return $rev_risalah;
    }

}

?>