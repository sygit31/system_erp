<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_bagian extends CI_Model {

	function bagian() {
		return $this->db->query("Select * from erp_bagian order by nama");
	}

    function filter($cari) {
        return $this->db->query("Select * from erp_bagian where upper(nama) like '%$cari%' order by nama");
    }

    function simpan($kode, $bagian, $id_edit) {
        if ($id_edit != 0) {
            $this->db->query("Update erp_bagian set kode='$kode', nama='$bagian' where id='$id_edit'");
        }else{
            $nmr = $this->db->query("Select max(id) as id from erp_bagian");
            $urut = $nmr->row_array();
            $id = $urut['ID'] + 1;
            $this->db->query("Insert into erp_bagian(id, kode, nama, kd_dept_simpg, status) values ('$id','$kode','$bagian','','1')");
        }
    }

}