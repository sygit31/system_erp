<?php 

class M_nilai extends CI_Model{

    function show_periode($id_kary) {
        return $this->db->query("Select to_char(sf.tanggal,'Mon-YY') tanggal from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id where sd.id_penilai='$id_kary'
            order by sf.tanggal");
    }

    function show_nilai($id_kary) {
        $data = $this->show_periode($id_kary);
        $periode = ''; $kategori = '';
        foreach ($data->result_array() as $dt):
            $periode=$dt['TANGGAL'];
        endforeach;

        return $this->db->query("Select sd.id_penilai, to_char(sf.tanggal,'Mon-YY') tanggal, sd.kategori, ha.id, ha.nama, ha.nik, sh.n1, sh.n2, sh.n3, sh.n4, sh.n5
            from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan left join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id
            where ha.status='1' and sd.id_penilai='$id_kary' and sd.kategori='$kategori' and to_char(sf.tanggal,'Mon-YY')='$periode'
            order by sf.tanggal, ha.nama");
    }

    function unlock($id_kary) {
        $query = $this->db->query("Select status from erp_sis_unlock_nilai where id_penilai='$id_kary' and status='1'");
        $data = $query->row_array();
        return $query->num_rows() == 0 ? '' : $data['STATUS'];
    }

    function filter_nilai($id_kary,$periode,$kategori,$cari) {
        $data = $this->db->query("Select distinct sd.id_penilai, to_char(sf.tanggal,'Mon-YY') tanggal, sd.kategori, ha.id, ha.nama, ha.nik, sh.n1, sh.n2, sh.n3, sh.n4, sh.n5,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sd2.kategori='HR' and sd2.kategori='$kategori' and sd.id_penilai='$id_kary' and se2.id_karyawan=ha.id and to_char(sf2.tanggal,'Mon-YY')='$periode' and rownum='1') n6,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sd2.kategori='IS' and sd2.kategori='$kategori' and sd.id_penilai='$id_kary' and se2.id_karyawan=ha.id and to_char(sf2.tanggal,'Mon-YY')='$periode' and rownum='1') n7,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sd2.kategori='K3' and sd2.kategori='$kategori' and sd.id_penilai='$id_kary' and se2.id_karyawan=ha.id and to_char(sf2.tanggal,'Mon-YY')='$periode' and rownum='1') n8
            from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_sis_nilai sf on sf.id_sis_kategori=se.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan left join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id
            where ha.status='1' and sd.id_penilai='$id_kary' and sd.kategori='$kategori' and (case when '$periode'='All' then 'All' else to_char(sf.tanggal,'Mon-YY') end) ='$periode' and upper(ha.nama) like '%$cari%'
            order by ha.nama");
        return $data;
    }

    function ambil_kategori($id_kary) {
        $data = $this->db->query("Select distinct sd.kategori
            from erp_sis_penilai sd join erp_karyawan ha on ha.id=sd.id_penilai join erp_sis_kategori se on se.id_sis_penilai=sd.id
            where ha.status='1' and sd.id_penilai='$id_kary' and se.aktif='1'
            order by sd.kategori");
        return $data->result_array();
    }

    function ambil_periode_terakhir($id_penilai,$kategori,$periode) {
        $query = $this->db->query("Select to_char(max(sf.tanggal),'YYYYMM') periode from erp_sis_nilai sf join erp_sis_kategori se on se.id=sf.id_sis_kategori join erp_sis_penilai sd on sd.id=se.id_sis_penilai where sd.id_penilai='$id_penilai' and sd.kategori='$kategori' and to_char(sf.tanggal,'YYYYMM')<>'$periode'");
        $data = $query->row_array();
        return $data['PERIODE'];
    }

    function preview_penilai($id_penilai,$kategori,$periode,$previous,$unit,$status) {
        $data = $this->db->query("Select distinct(sd.id) id_sis_penilai, ha.nama, ha.nik, se.id id_sis_kategori,
            (select id from erp_sis_nilai where id_sis_kategori=se.id and to_char(tanggal,'YYYYMM')='$periode' and rownum='1') id_sis_nilai,
            (select count(sf2.id) from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where se2.id_karyawan=ha.id and to_char(sf2.tanggal,'YYYYMM')='$periode' and sd2.id_penilai<>'$id_penilai' and sd2.kategori='$kategori') qty_prev,
            (select sh.n1 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYYYMM')='$previous' and rownum='1') n1,
            (select sh.n2 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYYYMM')='$previous' and rownum='1') n2,
            (select sh.n3 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYYYMM')='$previous' and rownum='1') n3,
            (select sh.n4 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYYYMM')='$previous' and rownum='1') n4,
            (select sh.n5 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYYYMM')='$previous' and rownum='1') n5,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYYYMM')='$previous' and sd2.kategori='HR' and rownum='1') n6,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYYYMM')='$previous' and sd2.kategori='IS' and rownum='1') n7,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYYYMM')='$previous' and sd2.kategori='K3' and rownum='1') n8
            from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
            where ha.status='1' and (ha.tgl_keluar is null or to_char(ha.tgl_keluar,'YYYYMM')>='$periode') and sd.id_penilai='$id_penilai' and sd.kategori='$kategori' and se.aktif='1' and (case when '$unit'='All' then 'All' else initcap(hd.unit) end)='$unit' and (case when '$status'='All' then '$status' when ha.kd_status='BL' or ha.kd_status='KT' then 'Karyawan' else 'OS' end)='$status' and to_char(ha.tgl_masuk,'YYYYMM')<'$periode'
            order by ha.nama");
        return $data->result_array();
    }

    function preview_penilai2($id_penilai,$kategori,$periode,$previous,$unit,$status) {
        $data = $this->db->query("Select distinct(sd.id) id_sis_penilai, ha.nama, ha.nik, se.id id_sis_kategori,
            (select id from erp_sis_nilai where id_sis_kategori=se.id and to_char(tanggal,'YYMM')='$periode' and rownum='1') id_sis_nilai,
            (select sh.n1 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYMM')='$previous' and rownum='1') n1,
            (select sh.n2 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYMM')='$previous' and rownum='1') n2,
            (select sh.n3 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYMM')='$previous' and rownum='1') n3,
            (select sh.n4 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYMM')='$previous' and rownum='1') n4,
            (select sh.n5 from erp_sis_nilai sf join erp_sis_nilai_detail sh on sh.id_sis_nilai=sf.id where sf.id_sis_kategori=se.id and to_char(sf.tanggal,'YYMM')='$previous' and rownum='1') n5,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYMM')='$previous' and sd2.kategori='HR' and rownum='1') n6,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYMM')='$previous' and sd2.kategori='IS' and rownum='1') n7,
            (select sf2.nilai from erp_sis_nilai sf2 join erp_sis_kategori se2 on se2.id=sf2.id_sis_kategori join erp_sis_penilai sd2 on sd2.id=se2.id_sis_penilai where sf2.id_sis_kategori=se.id and to_char(sf2.tanggal,'YYMM')='$previous' and sd2.kategori='K3' and rownum='1') n8
            from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
            where ha.status='1' and (ha.tgl_keluar is null or to_char(ha.tgl_keluar,'YYMM')>='$periode') and sd.id_penilai='$id_penilai' and sd.kategori='$kategori' and se.aktif='1' and to_char(se.tgl_input,'YYMM')<='$periode' and (case when '$unit'='All' then 'All' else initcap(hd.unit) end)='$unit' and (case when '$status'='All' then '$status' when ha.kd_status='BL' or ha.kd_status='KT' then 'Karyawan' else 'OS' end)='$status'
            order by ha.nama");
        return $data->result_array();
    }

    function urut() {
        $data = $this->db->query("Select max(id) id from erp_sis_nilai");
        $urut = $data->row_array();
        return $urut['ID'] + 1;
    }

    function simpan_nilai($id_sis_nilai,$id_sis_kategori,$periode,$n1,$n2,$n3,$n4,$n5,$n_total) {
        $this->db->query("Insert into erp_sis_nilai(id,id_sis_kategori,tanggal,nilai,status) values('$id_sis_nilai','$id_sis_kategori','$periode','$n_total','1')");

        if ($n1=='' and $n2=='' and $n3=='' and $n4=='' and $n5=='') {return;}
        $this->db->query("Insert into erp_sis_nilai_detail(id_sis_nilai,n1,n2,n3,n4,n5) values('$id_sis_nilai','$n1','$n2','$n3','$n4','$n5')");
    }

    function edit_nilai($id_edit_nilai,$id_sis_kategori,$periode,$n1,$n2,$n3,$n4,$n5,$n_total) {
        $this->db->query("Update erp_sis_nilai set id_sis_kategori='$id_sis_kategori',tanggal='$periode',nilai='$n_total' where id='$id_edit_nilai'");
        $this->db->query("Update erp_sis_nilai_detail set n1='$n1',n2='$n2',n3='$n3',n4='$n4',n5='$n5' where id_sis_nilai='$id_edit_nilai'");
    }

}

?>