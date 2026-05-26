<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_karyawan extends CI_Model {

    function bagian() {
        return $this->db->query("Select * from erp_bagian where status<>0 order by nama");
    }

    function jabatan() {
        return $this->db->query("Select * from erp_jabatan where level_jabatan>'0' and status<>0 order by nama");
    }

    function unit() {
        return $this->db->query("Select * from erp_hr_unit order by id");
    }

    function kd_unit($id_kary) {
        $query = $this->db->query("Select kd_unit from erp_karyawan where id='$id_kary'");
        $data = $query->row_array();
        return $data['KD_UNIT'];
    }

    function r_jabatan($id_karyawan) {
        $query = $this->db->query("Select hf.id, hd.unit, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan
            from erp_karyawan ha join erp_jabatan_rangkap hf on hf.id_karyawan=ha.id join erp_jabatan hc on hc.id=hf.id_jabatan join erp_bagian hb on hb.id=hf.id_bagian join erp_hr_unit hd on hd.kd_unit=hf.kd_unit
            where ha.status<>'0' and ha.tgl_keluar is null and ha.id='$id_karyawan' order by hb.nama, hc.nama");
        return $query->result_array();
    }

    function filter($cari, $id_bagian, $id_jabatan, $status, $kd_unit, $jkel) {
        return $this->db->query("Select ha.nik, ha.nama, ha.nick_name, ha.kd_unit, ha.kd_status, hd.unit, ha.id id_karyawan, hb.nama bagian, hc.nama jabatan, ha.jkel, ha.status_premi, to_char(ha.tgl_masuk,'DD-MM-YYYY') tgl_masuk, to_char(ha.tgl_keluar,'DD-MM-YYYY') tgl_keluar, to_char(ha.tgl_penetapan,'DD-MM-YYYY') tgl_penetapan
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
            where (case when '$id_bagian'='All' then 'All' else to_char(ha.id_bagian) end) like '$id_bagian' and
            (case when '$id_jabatan'='All' then 'All' else to_char(ha.id_jabatan) end)='$id_jabatan' and
            (case when '$status'='All' then 'All' else ha.kd_status end)='$status' and
            (case when '$kd_unit'='All' then 'All' else to_char(ha.kd_unit) end)='$kd_unit' and
            ha.status='1' and
            upper(ha.nama) like '%$cari%' and hc.nama<>'Super Admin' and
            (case when '$jkel'='All' then 'All' else ha.jkel end)='$jkel' and ha.tgl_keluar is null
            order by ha.nama");
    }

    function urut_r_jabatan() {
        $query = $this->db->query("Select max(id) as id from erp_jabatan_rangkap");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function r_simpan($id_r_jabatan, $id_karyawan, $id_bagian, $id_jabatan, $kd_unit) {
        $this->db->query("Insert into erp_jabatan_rangkap(id, id_karyawan, id_bagian, id_jabatan, kd_unit) values('$id_r_jabatan','$id_karyawan','$id_bagian','$id_jabatan','$kd_unit')");
    }

    function r_hapus($id) {
        $this->db->query("Delete from erp_jabatan_rangkap where id='$id'");
    }

    function simpan($id_edit, $nik, $nama, $id_bagian, $id_jabatan, $status, $kd_unit, $jkel, $s_premi, $tgl_masuk, $tgl_penetapan, $nick_name) {
        if ($id_edit != '') {
            $this->db->query("Update erp_karyawan set nik='$nik', nama='$nama', id_bagian='$id_bagian', id_jabatan='$id_jabatan', kd_status='$status', kd_unit='$kd_unit', jkel='$jkel', status_premi='$s_premi', tgl_masuk='$tgl_masuk', tgl_penetapan='$tgl_penetapan', nick_name='$nick_name' where id='$id_edit'");
        }else{
            $query = $this->db->query("Select max(id) as id from erp_karyawan");
            $data = $query->row_array();
            $id = $data['ID'] + 1;

            $this->db->query("Insert into erp_karyawan(id, nik, nama, id_bagian, id_jabatan, status, kd_status, kd_unit, jkel, status_premi, tgl_masuk, tgl_penetapan, nick_name) values ('$id','$nik','$nama','$id_bagian','$id_jabatan','1','$status','$kd_unit','$jkel','$s_premi','$tgl_masuk','$tgl_penetapan','$nick_name')");
        }
    }

    function edit($id_edit) {
        $query = $this->db->query("Select distinct ha.nik, ha.nama, ha.nick_name, ha.id_bagian, ha.id_jabatan, ha.kd_status, ha.kd_unit, ha.jkel, ha.status_premi, ha.tgl_masuk, hb.nama bagian
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian
            where ha.id='$id_edit'");
        return $query->row_array();
    }

    function keluar($id_karyawan,$tgl_keluar) {        
        $this->db->query("Update erp_karyawan set tgl_keluar='$tgl_keluar', status='0' where id='$id_karyawan'");
    }

}