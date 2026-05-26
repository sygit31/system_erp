<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_rekening extends CI_Model {

    function show_rekening() {
        return $this->db->query("Select ca.id, ca.no_rekjurnal, ca.nama, ca.status, ha.nama nama_karyawan from erp_cc_rekening ca join erp_karyawan ha on ha.id=ca.id_input order by ca.nama");
    }

    function filter_rekening($cari) {
        return $this->db->query("Select ca.id, ca.no_rekjurnal, ca.nama, ca.status, ha.nama nama_karyawan from erp_cc_rekening ca join erp_karyawan ha on ha.id=ca.id_input where upper(ca.nama) like '%$cari%' order by ca.nama");
    }

    function urut_rekening() {
        $query = $this->db->query("Select max(id) as id from erp_cc_rekening");
        $urut = $query->row_array();
        $id = $urut['ID'] + 1;
        return $id;
    }

    function simpan_rekening($id_rekening,$nomor,$nama) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_kary = $kary[0];

        $this->db->query("Insert into erp_cc_rekening values ('$id_rekening','$nomor','$nama',sysdate,'$id_kary','1')");
    }

    function aktif_rekening($id_rekening,$aktif) {
        $this->db->query("Update erp_cc_rekening set status='$aktif' where id='$id_rekening'");
    }

}

?>