<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_jabatan extends CI_Model {

    function jabatan() {
        return $this->db->query("Select * from erp_jabatan where level_jabatan>'0' order by level_jabatan");
    }

    function filter($cari) {
        $jabatan = $this->db->query("Select * from erp_jabatan where upper(nama) like '%$cari%' and level_jabatan>'0' order by level_jabatan");
        return $jabatan;
    }

    function simpan($kode, $jabatan, $level_jabatan, $id_edit) {
        if ($id_edit != 0) {
            $this->db->query("Update erp_jabatan set kode='$kode', nama='$jabatan', level_jabatan='$level_jabatan' where id='$id_edit'");
        }else{
            $nmr = $this->db->query("Select max(id) as id from erp_jabatan");
            $urut = $nmr->row_array();
            $id = $urut['ID'] + 1;
            $this->db->query("Insert into erp_jabatan(id, kode, nama, level_jabatan, status) values ('$id','$kode','$jabatan','$level_jabatan','1')");
        }
    }

}