<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_saldo extends CI_Model {

    function barang() {
        return $this->db->query("Select pc.id, pc.nama, pc.spesifikasi, pc.satuan from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location
            where pc.aktif='1' and pc.kategori='PRODUKSI' and (gh.jenis='BAHAN CHEMICAL' or gh.jenis='BAHAN NON CHEMICAL') order by pc.nama");
    }

    function tahun() {
        return $this->db->query("Select distinct(tanggal) tahun from
            (select to_char(tgl,'YYYY') tanggal from erp_gdg_saldo) order by tanggal");
    }

    function filter($tahun,$cari) {
        return $this->db->query("Select ge.id, pc.kode, pc.nama, pc.spesifikasi, pc.satuan, ge.saldo, ge.harga, to_char(ge.tgl, 'DD-MM-YYYY') tgl
            from erp_gdg_saldo ge join erp_barang pc on pc.id=ge.id_barang
            where (case when '$tahun'='All..' then 'All..' else to_char(ge.tgl,'yyyy') end) ='$tahun' and upper(pc.nama) like '%$cari%'
            order by to_char(ge.tgl, 'YYMMDD') desc, pc.nama");
    }

    function urut() {
        $data = $this->db->query("Select max(id) id from erp_gdg_saldo");
        $urut = $data->row_array();
        return $urut['ID'] + 1;
    }

    function simpan($id,$id_barang,$saldo,$harga) {
        $this->db->query("Insert into erp_gdg_saldo(id, id_barang, tgl, saldo, harga, umur, aktif, keterangan) values('$id','$id_barang',sysdate,'$saldo','$harga',null,'1','')");
    }

}
