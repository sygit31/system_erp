<?php class M_bmi extends CI_Model {

    function show_bagian() {
        return $this->db->query("Select distinct nama bagian from erp_bagian order by bagian");
    }

    function unit() {
        return $this->db->query("Select distinct unit from erp_hr_unit order by unit desc");
    }

    function urut_bmi() {
        $data = $this->db->query("Select max(id) id from erp_sis_bmi");
        $urut = $data->row_array();
        return $urut['ID'] + 1;
    }

    function simpan_bmi($id_bmi, $id_karyawan, $tinggi, $berat) {
        $tanggal = date("d/m/Y");
        $this->db->query("Insert into erp_sis_bmi values('$id_bmi','$id_karyawan','$tanggal','$tinggi','$berat','1')");
    }

    function edit_bmi($id_bmi, $id_karyawan, $tinggi, $berat) {
        $tanggal = date("d/m/Y");
        $this->db->query("Update erp_sis_bmi set tinggi='$tinggi',berat='$berat' where id='$id_bmi'");
    }

    function filter_bmi($bagian, $unit) {
        $month = sprintf('%02d', date('m'));
        $periode = $month . '-' . date('y');

        return $this->db->query("Select ha.id id_karyawan, ha.nama nama_karyawan, hb.nama bagian, ha.jkel,
            (select tinggi from erp_sis_bmi where id=(select max(id) id from erp_sis_bmi where id_karyawan=ha.id) and rownum='1') tinggi,
            (select berat from erp_sis_bmi where id_karyawan=ha.id and to_char(tanggal,'MM-YY')='$periode' and rownum='1') berat,
            (select id from erp_sis_bmi where id_karyawan=ha.id and to_char(tanggal,'MM-YY')='$periode' and rownum='1') id_bmi
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
            where ha.status='1' and (case when '$bagian'='All' then 'All' else hb.nama end) ='$bagian' and (case when '$unit'='All' then 'All' else hd.unit end) ='$unit' and ha.tgl_keluar is null
            order by ha.nama");
    }

    function get_year() {
        return $this->db->query("Select distinct(tanggal) tahun from
            (select to_char(tanggal,'YYYY') tanggal from erp_sis_bmi) order by tanggal asc");
    }

    function periode_bmi($year) {
        $data = $this->db->query("Select to_char(tanggal,'Mon-YY') periode from erp_sis_bmi where to_char(tanggal,'YYYY')='$year' order by tanggal");
        return $data->result_array();
    }

    function laporan_bmi($year) {
        $data = $this->db->query("Select ha.id id_karyawan, ha.nik, ha.nama nama_karyawan, hb.nama bagian, ha.jkel, to_char(sg.tanggal,'Mon-YY') periode, to_char(sg.tanggal,'YY') tahun, sg.tinggi, sg.berat
            from erp_sis_bmi sg join erp_karyawan ha on ha.id=sg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
            where to_char(sg.tanggal,'YYYY')='$year' and (case when ha.tgl_keluar is not null then to_char(ha.tgl_keluar,'YYMM') else '$year' end)='$year'
            order by ha.nama, ha.id, sg.tanggal");
        return $data->result_array();
    }

    function filter_periode_bmi($year) {
        $data = $this->db->query("Select to_char(tanggal,'Mon-YY') periode from erp_sis_bmi where (case when '$year'='All' then 'All' else to_char(tanggal,'YYYY') end) = '$year' order by tanggal");
        return $data->result_array();
    }

    function filter_laporan_bmi($year, $unit, $bagian, $min, $max, $nama) {
        $data = $this->db->query("Select ha.id id_karyawan, ha.nik, ha.nama nama_karyawan, hb.nama bagian, ha.jkel, to_char(sg.tanggal,'Mon-YY') periode, to_char(sg.tanggal,'YY') tahun, sg.tinggi, sg.berat
            from erp_sis_bmi sg join erp_karyawan ha on ha.id=sg.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
            where (case when '$year'='All' then 'All' else to_char(sg.tanggal,'YYYY') end) = '$year' and (case when '$unit'='All' then 'All' else ha.kd_unit end) ='$unit' and (case when '$bagian'='All' then 'All' else hb.nama end) ='$bagian' and upper(ha.nama) like '%$nama%' and
            (case when sg.tinggi='0' then 0 else
            ((replace(sg.berat,'.',',')-0.7)/(replace(sg.tinggi,'.',',')*replace(sg.tinggi,'.',','))) end)>='$min' and
            (case when sg.tinggi='0' then 0 else
            ((replace(sg.berat,'.',',')-0.7)/(replace(sg.tinggi,'.',',')*replace(sg.tinggi,'.',','))) end)<='$max'
            and (case when ha.tgl_keluar is not null then to_char(ha.tgl_keluar,'YYMM') else '$year' end)='$year'
            order by ha.nama, sg.tanggal");
        return $data->result_array();
    }
}
