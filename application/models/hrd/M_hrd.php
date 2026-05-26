<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_hrd extends CI_Model 
{
	function show_karyawan() {
		$show_karyawan = $this->db->query("Select ha.nik, ha.nama, ha.kd_status, hd.unit, ha.id id_karyawan, hb.nama bagian, hc.nama jabatan, ha.jkel, ha.status_premi, ha.tgl_masuk, ha.tgl_keluar, ha.tgl_penetapan
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
            where hc.nama<>'Super Admin' and ha.status='1' and ha.tgl_keluar is null
            order by ha.nama");
		return $show_karyawan;
	}

	function show_bagian() {
		$show_bagian = $this->db->query("Select * from erp_bagian order by nama");
		return $show_bagian;
	}

    function unit() {
        return $this->db->query("Select * from erp_hr_unit order by id");
    }

    function show_jabatan() {
      $show_jabatan = $this->db->query("Select * from erp_jabatan where level_jabatan>'0' order by level_jabatan");
      return $show_jabatan;
  }

  function filter_karyawan($cari,$bagian,$jabatan,$status,$unit,$jkel) {
    $kayawan = $this->db->query("Select ha.nik, ha.nama, ha.kd_status, hd.unit, ha.id id_karyawan, hb.nama bagian, hc.nama jabatan, ha.jkel, ha.status_premi, ha.tgl_masuk, ha.tgl_keluar, ha.tgl_penetapan
        from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
        where (case when '$bagian'='All' then 'All' else hb.nama end) like '$bagian' and
        (case when '$jabatan'='All' then 'All' else hc.nama end) like '$jabatan' and
        (case when '$status'='All' then 'All' else ha.kd_status end) like '$status' and
        (case when '$unit'='All' then 'All' else ha.kd_unit end) like '$unit' and
        ha.status='1' and
        (upper(ha.nama) like '%$cari%' or upper(ha.nama) like '%$cari%') and hc.nama<>'Super Admin' and
        (case when '$jkel'='All' then 'All' else ha.jkel end) like '$jkel' and ha.tgl_keluar is null
        order by ha.nama");
    return $kayawan;
}

function simpan_karyawan($nik, $nama, $id_bagian, $id_jabatan, $id_edit, $status, $kd_unit, $jkel, $s_premi, $tgl_masuk, $tgl_penetapan) {
   if ($id_edit != 0) {

            // Jika Status Karyawan Berubah
    $query = $this->db->query("Select kd_status from erp_karyawan where id='$id_edit'");
    $data = $query->row_array();
    $kd_status = $data['KD_STATUS'];

    if ($kd_status == $status) {
        $this->db->query("Update erp_karyawan set nik='$nik', nama='$nama', id_bagian='$id_bagian', id_jabatan='$id_jabatan',kd_status='$status',kd_unit='$kd_unit',jkel='$jkel',status_premi='$s_premi',tgl_masuk='$tgl_masuk' where id='$id_edit'");
        return;
    }
}

        // Simpan Baru
$nmr = $this->db->query("Select max(id) as id from erp_karyawan");
$urut = $nmr->row_array();
$id = $urut['ID'] + 1;
if ($tgl_masuk == '01-01-1970') {$tgl_masuk = '';}
if ($tgl_penetapan == '01-01-1970') {$tgl_penetapan = '';}
$this->db->query("Insert into erp_karyawan(id, nik, nama, id_bagian, id_jabatan, status, kd_status, kd_unit, jkel, status_premi, tgl_masuk, tgl_penetapan) values ('$id','$nik','$nama','$id_bagian','$id_jabatan','1','$status','$kd_unit','$jkel','$s_premi','$tgl_masuk','$tgl_penetapan')");
}

function filter_bagian($cari) {
    $bagian = $this->db->query("Select * from erp_bagian where upper(nama) like '%$cari%' order by nama");
    return $bagian;
}

function simpan_bagian($kode,$bagian,$id_edit) {
    if ($id_edit != 0) {
        $this->db->query("Update erp_bagian set kode='$kode', nama='$bagian' where id='$id_edit'");
    }else{
        $nmr = $this->db->query("Select max(id) as id from erp_bagian");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;
        $this->db->query("Insert into erp_bagian values ('$id','$kode','$bagian','')");
    }
}

function filter_jabatan($cari) {
    $jabatan = $this->db->query("Select * from erp_jabatan where upper(nama) like '%$cari%' and level_jabatan>'0' order by level_jabatan");
    return $jabatan;
}

function simpan_jabatan($kode,$jabatan,$level_jabatan,$id_edit) {
    if ($id_edit != 0) {
        $this->db->query("Update erp_jabatan set kode='$kode', nama='$jabatan', level_jabatan='$level_jabatan' where id='$id_edit'");
    }else{
        $nmr = $this->db->query("Select max(id) as id from erp_jabatan");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;
        $this->db->query("Insert into erp_jabatan values ('$id','$kode','$jabatan','$level_jabatan')");
    }
}

function keluar($id_karyawan,$tgl_keluar) {        
    $this->db->query("Update erp_karyawan set tgl_keluar='$tgl_keluar' where id='$id_karyawan'");
}

}
?>