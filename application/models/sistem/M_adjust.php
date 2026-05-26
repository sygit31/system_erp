<?php 

class M_adjust extends CI_Model {

    function karyawan() {
        return $this->db->query("Select ha.id, ha.nama, hb.nama bagian
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where hc.nama<>'Super Admin' and ha.status='1'
            order by ha.nama");
    }

    function level() {
        $kary = explode('|',$_SESSION['logERP']);
        $id = $kary[0];

        $query = $this->db->query("Select hc.level_jabatan from erp_karyawan ha join erp_jabatan hc on hc.id=ha.id_jabatan
            where ha.id='$id'");
        $data = $query->row_array();
        return $data['LEVEL_JABATAN'];
    }

    function filter($tgl1,$tgl2) {
        return $this->db->query("Select sm.id, to_char(sm.tgl,'dd-mm-yyyy') tgl, ha.nama, hb.nama bagian, hc.nama jabatan, sm.nilai, sm.keterangan, ha2.nama penilai
            from erp_karyawan ha join erp_sis_nilai_plus sm on sm.id_kary=ha.id join erp_karyawan ha2 on ha2.id=sm.id_input join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where sm.aktif='1' and sm.kategori='Khusus' and to_char(sm.tgl,'YYMMDD') between '$tgl1' and '$tgl2' order by ha.nama");
    }

    function filter_jabatan() {
        return $this->db->query("Select sm.id, to_char(sm.tgl,'dd-mm-yyyy') tgl, ha.nama, hb.nama bagian, hc.nama jabatan, sm.nilai, sm.keterangan, ha2.nama penilai
            from erp_karyawan ha join erp_sis_nilai_plus sm on sm.id_kary=ha.id join erp_karyawan ha2 on ha2.id=sm.id_input join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where sm.aktif='1' and sm.kategori='Jabatan' order by ha.nama");
    }

    function urut() {
        $data = $this->db->query("Select max(id) id from erp_sis_nilai_plus");
        $urut = $data->row_array();
        return $urut['ID'] + 1;
    }

    function simpan($id,$id_karyawan,$nilai,$keterangan,$kategori,$tgl) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_input = $kary[0];

        $this->db->query("Insert into erp_sis_nilai_plus values('$id','$id_karyawan','$id_input','$tgl','$nilai','$keterangan','1','$kategori')");
    }

    function edit($id_nilai_plus, $id_karyawan, $nilai, $keterangan, $kategori, $tgl) {
        $kary = explode('|',$_SESSION['logERP']);
        $id_input = $kary[0];

        $this->db->query("Update erp_sis_nilai_plus set id_kary='$id_karyawan', id_input='$id_input', tgl='$tgl', nilai='$nilai', keterangan='$keterangan', aktif='1', kategori='$kategori' where id='$id_nilai_plus'");
    }

    function hapus($id) {
        $this->db->query("Update erp_sis_nilai_plus set aktif='0' where id='$id'");
    }

}