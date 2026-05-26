<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_akun extends CI_Model {

    function show_karyawan() {
        $show_karyawan = $this->db->query("Select ha.id, ha.nama, hb.nama bagian, hc.nama jabatan
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where (select count(id) from erp_akun where id_karyawan=ha.id) = '0'
            order by ha.nama");
        return $show_karyawan;
    }

    function show_akun() {
        $show_akun = $this->db->query("Select distinct(ha.nama), hb.nama bagian, hc.nama jabatan, aa.id_karyawan, aa.id id_akun
           from erp_akun aa join erp_karyawan ha on ha.id=aa.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
           where ha.status='1' or ha.tgl_keluar is null
           order by ha.nama");
        return $show_akun;
    }

    function filter_akun($cari) {
        $kayawan = $this->db->query("Select distinct(ha.nama), hb.nama bagian, hc.nama jabatan, aa.id_karyawan, aa.id id_akun
            from erp_akun aa join erp_karyawan ha on ha.id=aa.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where upper(ha.nama) like '%$cari%' and (ha.status='1' or ha.tgl_keluar is null)
            order by ha.nama");
        return $kayawan;
    }

    function get_akses($id_akun) {
        $data = $this->db->query("Select ac.judul_menu, ad.nama_menu, ad.level_menu, ad.id id_menu_detail,
            (select id from erp_adm_akses where id_akun='$id_akun' and id_menu_detail=ad.id and rownum=1) id_adm_akses,
            (select status from erp_adm_akses where id_akun='$id_akun' and id_menu_detail=ad.id and rownum=1) status
            from erp_adm_menu_detail ad join erp_adm_menu ac on ac.id=ad.id_menu
            order by ac.judul_menu, ad.urut");
        return $data;
    }

    function urut_adm_akses() {
        $nmr = $this->db->query("Select max(id) as id from erp_adm_akses");
        $urut = $nmr->row_array();
        return $urut['ID'] + 1;
    }

    function simpan_akses($id_adm_akses,$id_akun,$id_menu_detail,$status) {
        $this->db->query("Insert into erp_adm_akses(id, id_akun, id_menu_detail, status) values('$id_adm_akses','$id_akun','$id_menu_detail','$status')");
    }

    function update_akses($id_adm_akses,$id_akun,$id_menu_detail,$status) {
        $this->db->query("Update erp_adm_akses set status='$status' where id='$id_adm_akses'");
    }

    function show_menu($id_akun) {
        $show_menu = $this->db->query("select ab.id_akun, ad.kode_menu, ab.status
            from erp_adm_akses ab join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail where ab.id_akun='$id_akun'");
        return $show_menu->result_array();
    }

    function simpan_akun($username,$password,$id_karyawan) {
        $nmr = $this->db->query("Select max(id) as id from erp_akun");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;

        $this->db->query("Insert into erp_akun values('$id','$username','$password','$id_karyawan','1','1')");
    }

    function kd_akses($id_akun, $kd_menu) {
        $query = $this->db->query("Select status from erp_adm_akses where id_akun='$id_akun' and id_menu_detail=(select id from erp_adm_menu_detail where kode_menu='$kd_menu')");
        $data = $query->row_array();
        return $data['STATUS'];
    }

}

?>