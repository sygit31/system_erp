<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class m_adm_akun extends CI_Model 
{

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
            order by ha.nama");
		return $show_akun;
	}

	function get_menu() {
		$menu = $this->db->query("Select ac.judul_menu, ad.nama_menu, ad.level_menu, ad.id id_menu_detail
            from erp_adm_menu ac join erp_adm_menu_detail ad on ad.id_menu=ac.id
            order by ac.judul_menu, ad.level_menu, ad.id");
		return $menu;
	}

	function get_akses($id_akun) {
		$show_akses = $this->db->query("Select ab.id_menu_detail
            from erp_akun aa right join erp_adm_akses ab on aa.id=ab.id_akun
            where aa.id='$id_akun'");
		$akses = $show_akses->result_array();
		return $akses;
	}

	function simpan_akses($data) {
		$nmr = $this->db->query("Select max(id) as id from erp_adm_akses");
    	$urut = $nmr->row_array();
    	$id = $urut['ID'] + 1;
    	$id_akun = $data[0];

    	$dt_akun = $this->db->query("Select id from erp_adm_akses where id_akun='$id_akun'");
    	$dt = $dt_akun->result_array();
    	$qty=0;

    	foreach ($dt as $val) {
    		$id_edit = $val['ID'];
    		if (isset($data[1][$qty])) {
    			$id_menu_detail = $data[1][$qty];
    			$this->db->query("Update erp_adm_akses set id_akun='$id_akun',id_menu_detail='$id_menu_detail' where id='$id_edit'");
    			$qty = $qty + 1;
    		}else{
    			$this->db->query("Delete from erp_adm_akses where id='$id_edit'");
    		}    		
    	}

    	if (count($dt) < count($data[1])) {
    		for ($i=$qty; $i<count($data[1]); $i++) {
    			$id_menu_detail = $data[1][$i];
    			$this->db->query("Insert into erp_adm_akses values('$id','$id_akun','$id_menu_detail')");
    			$id++;
    		}
    	}
	}

    function filter_akun($cari) {
        $kayawan = $this->db->query("Select distinct(ha.nama), hb.nama bagian, hc.nama jabatan, aa.id_karyawan, aa.id id_akun, aa.id id_akun
            from erp_akun aa join erp_karyawan ha on ha.id=aa.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where upper(ha.nama) like '%$cari%'
            order by ha.nama");
        return $kayawan;
    }

    function show_menu($id_akun) {
        $show_menu = $this->db->query("select ab.id_akun, ad.kode_menu
            from erp_adm_akses ab join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail where ab.id_akun='$id_akun'");
        return $show_menu->result_array();
    }

    function simpan_akun($username,$password,$id_karyawan) {
        $nmr = $this->db->query("Select max(id) as id from erp_akun");
        $urut = $nmr->row_array();
        $id = $urut['ID'] + 1;

        $this->db->query("Insert into erp_akun values('$id','$username','$password','$id_karyawan','1')");
    }

}

?>