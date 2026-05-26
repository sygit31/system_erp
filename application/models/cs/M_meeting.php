<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_meeting extends CI_Model
{
    function cek_status() {
        $tgl = date('ymd');
        $this->db->query("Update erp_cs_meeting set status='2' where to_char(tgl,'YYMMDD')<'$tgl' and status='1'");
    }

    function status_menu($id_menu_detail, $id_kary) {
        $query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail join erp_akun aa on aa.id=ab.id_akun where aa.id_karyawan='$id_kary' and ab.id_menu_detail='$id_menu_detail'");
        $data = $query->row_array();
        return $data['STATUS'];
    }

    function pic() {
        return $this->db->query("Select ha.id, upper(ha.nama) nama, hb.nama bagian from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.status='1' and ha.tgl_keluar is null order by nama");
    }

    function unit() {
        return $this->db->query("Select kd_unit, unit from erp_hr_unit order by id");
    }

    function kd_unit($id_kary) {
        $query = $this->db->query("Select kd_unit from erp_karyawan where id='$id_kary'");
        $data = $query->row_array();
        return $data['KD_UNIT'];
    }

    function filter($tgl1, $tgl2, $kd_unit) {
        return  $this->db->query("Select ud.id, ud.nmr, to_char(ud.tgl,'Day') hari, to_char(ud.tgl,'dd-mm-yyyy') tgl, to_char(ud.jam,'hh24:mi') jam, ud.ruang, ud.qty_person, ud.agenda, ud.lev, ha.nama, hb.nama bagian, ud.note, ud.status
            from erp_cs_meeting ud join erp_karyawan ha on ha.id=ud.id_kary join erp_bagian hb on hb.id=ha.id_bagian
            where to_char(ud.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and ud.kd_unit='$kd_unit' order by ud.tgl desc, ud.jam");
    }

    function auto_no($tahun) {
        $query = $this->db->query("Select max(substr(nmr,4,4)) nmr from erp_cs_meeting where to_char(tgl,'YY')='$tahun'");
        $data = $query->row_array();
        return sprintf('%04d', $data['NMR'] + 1);
    }

    function urut() {
        $query = $this->db->query("Select max(id) id from erp_cs_meeting");
        $data = $query->row_array();
        return $data['ID'] + 1;
    }

    function simpan($id, $nmr, $tgl, $jam, $ruang, $qty, $agenda, $lev, $id_kary, $keterangan, $kd_unit) {
        $this->db->query("Insert into erp_cs_meeting values('$id','$nmr','$tgl',to_date('$jam','DD-MM-YYYY HH24:MI:SS'),'$kd_unit','$ruang','$qty','$agenda','$lev','$id_kary','$keterangan','1')");
    }

    function edit($id_edit, $tgl, $jam, $ruang, $qty, $agenda, $lev, $id_kary, $keterangan, $kd_unit) {
        $this->db->query("Update erp_cs_meeting set tgl='$tgl',jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'),kd_unit='$kd_unit',ruang='$ruang',qty_person='$qty',agenda='$agenda',lev='$lev',id_kary='$id_kary',note='$keterangan',status='1' where id='$id_edit'");
    }

    function batal($id) {
        $this->db->query("Update erp_cs_meeting set status='0' where id='$id'");
    }

    function selesai($id) {
        $this->db->query("Update erp_cs_meeting set status='2' where id='$id'");
    }

    function agenda() {
        $day1 = '01';
        $day2 = '31';
        $tgl1 = date('ym') . $day1;
        $tgl2 = date('ym') . $day2;

        $query = $this->db->query("Select ud.id, ud.nmr, to_char(ud.tgl,'DD') urut_tgl, to_char(ud.tgl,'Day') hari, ud.tgl, to_char(ud.jam,'hh24:mi') waktu, ud.ruang, ud.qty_person, ud.agenda, ud.lev, ha.nama pic, hb.nama bagian, ud.note, ud.status from erp_cs_meeting ud join erp_karyawan ha on ha.id=ud.id_kary join erp_bagian hb on hb.id=ha.id_bagian where to_char(ud.tgl,'YYMMDD') between '$tgl1' and '$tgl2' order by ud.tgl desc, ud.jam");
        return $query->result_array();
    }

    function get_agenda($periode) {
        $query = $this->db->query("Select ud.id, ud.nmr, to_char(ud.tgl,'DD') urut_tgl, to_char(ud.tgl,'Day') hari, ud.tgl, to_char(ud.jam,'hh24:mi') waktu, ud.ruang, ud.qty_person, ud.agenda, ud.lev, ha.nama pic, hb.nama bagian, ud.note, ud.status from erp_cs_meeting ud join erp_karyawan ha on ha.id=ud.id_kary join erp_bagian hb on hb.id=ha.id_bagian where to_char(ud.tgl,'YYMM')='$periode' order by ud.tgl desc, ud.jam");
        return $query->result_array();
    }
}
