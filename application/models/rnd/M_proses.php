<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_proses extends CI_Model {

    function show_proses() {
        return $this->db->query("Select rb.id, ra.kode, rb.desain, ra.nama, ra.deskripsi, ra.ukuran, rb.kode_station_flow
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id where rb.aktif='T' order by rb.desain desc, ra.nama");
    }

    function filter_proses($desain,$cari) {
        $data = $this->db->query("Select rb.id, ra.kode, rb.desain, ra.nama, ra.deskripsi, ra.ukuran, rb.kode_station_flow
            from erp_rnd_produk ra join erp_rnd_proses rb on rb.id_produk=ra.id where rb.aktif='T' and (case when '$desain'='All' then 'All' else rb.desain end) like '$desain' and upper(ra.nama) like '%$cari%' order by rb.desain desc, ra.nama");
        return $data;
    }

    function show_produk() {
        return $this->db->query("Select * from erp_rnd_produk where aktif='1' order by nama");
    }
    
    function show_mesin() {
        return $this->db->query("Select * from erp_tek_mesin order by nama_mesin");
    }

    function show_material() {
        return $this->db->query("Select nama, id, kode, satuan from erp_barang_1 where aktif='1' and kategori='PRODUKSI' order by nama");
    }

    function show_flow() {
        return $this->db->query("Select distinct kode from erp_station_flow where status='T'");
    }

    function ambil_station($kode) {
        $query = $this->db->query("Select re.id id_station_flow, rf.nama, re.urut from erp_station_flow re join erp_station rf on rf.id=re.id_station where re.status='T' and rf.status='Y' and re.kode='$kode'");
        return $query->result_array();
    }

    function urut_proses() {
    	$nmr = $this->db->query("Select max(id) as id from erp_rnd_proses");
    	$urut = $nmr->row_array();
    	return $urut['ID'] + 1;   
    }

    function simpan_proses($id_proses,$id_produk,$kode,$desain) {
    	$this->db->query("Insert into erp_rnd_proses values('$id_proses','$id_produk','$desain','T','$kode')");
    }

    function edit_proses($id_edit_proses,$id_produk,$kode,$desain) {
        $this->db->query("Update erp_rnd_proses set id_produk='$id_produk',desain='$desain',kode_station_flow='$kode' where id='$id_edit_proses'");
    }

    function hapus_mesin($id_hapus_mesin) {
        $this->db->query("Delete from erp_rnd_mesin where id='$id_hapus_mesin'");
    }

    function hapus_material($id_hapus_material) {
        $this->db->query("Delete from erp_rnd_bom where id='$id_hapus_material'");
    }

    function urut_rnd_mesin() {
        $nmr = $this->db->query("Select max(id) as id from erp_rnd_mesin");
        $urut = $nmr->row_array();
        return $urut['ID'] + 1;   
    }

    function simpan_rnd_mesin($id_rnd_mesin,$id_proses,$id_station,$id_mesin,$speed,$naik,$suhu,$tekanan) {
        $this->db->query("Insert into erp_rnd_mesin values('$id_rnd_mesin','$id_proses','$id_mesin','$speed','$naik','$suhu','$tekanan','1','$id_station')");
    }

    function update_rnd_mesin($id_edit_mesin,$id_proses,$id_station,$id_mesin,$speed,$naik,$suhu,$tekanan) {
        $this->db->query("Update erp_rnd_mesin set id_rnd_proses='$id_proses',id_mesin='$id_mesin',speed='$speed',naik='$naik',suhu='$suhu',tekanan='$tekanan',id_station_flow='$id_station' where id='$id_edit_mesin'");
    }

    function urut_rnd_bom() {
        $nmr = $this->db->query("Select max(id) as id from erp_rnd_bom");
        $urut = $nmr->row_array();
        return $urut['ID'] + 1;   
    }

    function simpan_rnd_bom($id_rnd_bom,$id_proses,$id_station,$id_material,$qty) {
        $this->db->query("Insert into erp_rnd_bom values('$id_rnd_bom','$id_proses','$id_material','$qty','1','$id_station')");
    }

    function update_rnd_bom($id_edit_bom,$id_proses,$id_station,$id_material,$qty) {
        $this->db->query("Update erp_rnd_bom set id_rnd_proses='$id_proses',id_barang='$id_material',qty='$qty',id_station_flow='$id_station' where id='$id_edit_bom'");
    }

    function preview_mesin($id_proses) {
        $data = $this->db->query("Select rf.nama, ta.nama_mesin, rc.speed, rc.naik, rc.suhu, rc.tekanan, ta.nomor, rc.id_mesin, rc.id id_rnd_mesin, rc.id_station_flow
            from erp_station rf join erp_station_flow re on re.id_station=rf.id join erp_rnd_mesin rc on rc.id_station_flow=re.id join erp_rnd_proses rb on rb.id=rc.id_rnd_proses join erp_tek_mesin ta on ta.id=rc.id_mesin
            where rc.aktif='1' and rb.id='$id_proses'
            order by re.urut, ta.nama_mesin");
        return $data->result_array();
    }

    function preview_material($id_proses) {
        $data = $this->db->query("Select rf.nama, pc.nama nama_material, pc.satuan, rd.qty, pc.kode kode_material, rf.nama proses_m, pc.id id_material, rd.id id_rnd_bom, rd.id_station_flow
            from erp_station rf join erp_station_flow re on re.id_station=rf.id join erp_rnd_bom rd on rd.id_station_flow=re.id join erp_rnd_proses rb on rb.id=rd.id_rnd_proses join erp_barang pc on pc.id=rd.id_barang
            where rd.aktif='1' and rb.id='$id_proses'
            order by re.urut, pc.nama");
        return $data->result_array();
    }

    function hapus_proses($id_proses) {
        $data = $this->db->query("Update erp_rnd_proses set aktif='0' where id='$id_proses'");
        $data = $this->db->query("Update erp_rnd_mesin2 set aktif='0' where id_proses='$id_proses'");
        $data = $this->db->query("Update erp_rnd_bom2 set aktif='0' where id_proses='$id_proses'");
    }

}
?>