<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_menu extends CI_Model 
{

	function show_menu() {
		$show_menu = $this->db->query("Select ac.*, ad.*, ad.id id_detail from erp_adm_menu ac join erp_adm_menu_detail ad on ad.id_menu=ac.id order by ac.judul_menu, ad.urut");
		return $show_menu;
	}

	function urut_id() {
		$query = $this->db->query("Select max(id) as id from erp_adm_menu");
    	$data = $query->row_array();
    	return $data['ID'] + 1;
	}

	function simpan_menu($id_menu,$judul) {
		$this->db->query("Insert into erp_adm_menu(id, judul_menu) values ('$id_menu','$judul')");
	}

	function update_menu($id_menu,$judul) {
		$this->db->query("Update erp_adm_menu set judul_menu ='$judul' where id='$id_menu'");
	}

	function urut_id_detail() {
		$query = $this->db->query("Select max(id) as id from erp_adm_menu_detail");
    	$data = $query->row_array();
    	return $data['ID'] + 1;
	}

	function simpan_menu_detail($id_menu_detail,$id_menu,$kode,$nama,$level,$urut) {
		$this->db->query("Insert into erp_adm_menu_detail(id, id_menu, kode_menu, nama_menu, level_menu, urut) values ('$id_menu_detail','$id_menu','$kode','$nama','$level','$urut')");
	}

	function update_menu_detail($id_menu_detail,$id_menu,$kode,$nama,$level,$urut) {
		$this->db->query("Update erp_adm_menu_detail set id_menu ='$id_menu', kode_menu='$kode', nama_menu='$nama', level_menu='$level', urut='$urut' where id='$id_menu_detail'");
	}

	function hapus_menu_detail($id_hapus) {
		$this->db->query("Delete from erp_adm_menu_detail where id='$id_hapus'");
	}

	function filter_menu($level,$cari) {
		$menu = $this->db->query("Select ac.*, ad.*, ad.id id_detail from erp_adm_menu ac join erp_adm_menu_detail ad on ad.id_menu=ac.id
			where (case when '$level'='All' then 'All' else to_char(ad.level_menu) end) like '$level' and upper(ac.judul_menu) like '%$cari%'
			order by ac.judul_menu, ad.urut");
		return $menu;
	}

	function show_edit($id_menu) {
		$query = $this->db->query("Select ac.judul_menu, ad.id id_detail, ad.id_menu, ad.kode_menu, ad.nama_menu, ad.level_menu from erp_adm_menu ac join erp_adm_menu_detail ad on ad.id_menu=ac.id
			where ad.id_menu='$id_menu'
			order by ac.id, ad.urut");
		return $query->result_array();
	}

	function hapus_detail($id_detail) {
		$this->db->query("Delete from erp_adm_menu_detail where id='$id_detail'");
	}

	function show_akses() {
		$show_akses = $this->db->query("Select ha.nama, hb.nama bagian, hc.nama jabatan 
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_akun aa on aa.id_karyawan=ha.id join erp_adm_akses ab on ab.id_akun=aa.id join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail
			order by ha.nama");
		return $show_akses;
	}

}

?>