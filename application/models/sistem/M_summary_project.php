<?php 

class M_summary_project extends CI_Model{

    function karyawan() {
        return $this->db->query("Select id, nama from erp_karyawan where status<>'0' order by nama");
    }

    function show() {
        return $this->db->query("Select distinct ha.id id_pic, ha.nama, hc.nama jabatan, hb.nama bagian,
            (select count(distinct(nmr)) from erp_sis_project where id_koordinator=ha.id and aktif='1') qty_project,
            (select count(distinct(nmr)) from erp_sis_project where id_koordinator=ha.id and finish is null and aktif='1') qty_open,
            (select replace(avg(s_nilai),',','.') from (select distinct b.nmr, b.id_koordinator, (select avg(replace(a.nilai,'.',','))
            from erp_sis_project a where a.nmr=b.nmr) s_nilai from erp_sis_project b) where id_koordinator=ha.id) nilai
            from erp_karyawan ha join erp_bagian hb on ha.id_bagian=hb.id join erp_jabatan hc on ha.id_jabatan=hc.id
            where ha.status<>'0'
            order by ha.nama");
    }

    function filter($periode,$id_kary) {
        return $this->db->query("Select distinct ha.id id_pic, ha.nama, hc.nama jabatan, hb.nama bagian,
            (select count(distinct(nmr)) from erp_sis_project where id_koordinator=ha.id and aktif='1' and (case when '$periode'='All' then 'All' else substr(tgl,-4,4) end)='$periode') qty_project,
            (select count(distinct(nmr)) from erp_sis_project where id_koordinator=ha.id and finish is null and aktif='1' and (case when '$periode'='All' then 'All' else substr(tgl,-4,4) end)='$periode') qty_open,
            (select replace(avg(s_nilai),',','.') from (select distinct b.tgl, b.nmr, b.id_koordinator, (select avg(replace(a.nilai,'.',',')) from erp_sis_project a where a.nmr=b.nmr) s_nilai from erp_sis_project b) where id_koordinator=ha.id and (case when '$periode'='All' then 'All' else substr(tgl,-4,4) end)='$periode') nilai
            from erp_karyawan ha join erp_bagian hb on ha.id_bagian=hb.id join erp_jabatan hc on ha.id_jabatan=hc.id
            where ha.status<>'0' and (case when '$id_kary'='All' then 'All' else to_char(ha.id) end)='$id_kary'
            order by ha.nama");
    }

    function summary_pic($id,$periode) {
        $query = $this->db->query("Select sa.nmr, sa.tgl, ha.nama pic, sa.nama, sa.tugas, (greatest(nvl(sa.deadline,'1/1/1970'), nvl(sa.target2,'1/1/1970'), nvl(sa.target3,'1/1/1970'))) max_date, sa.finish, sa.target2, sa.target3,
            (select replace(avg(replace(nilai,'.',',')),',','.') from erp_sis_project where nmr=sa.nmr and finish is not null) nilai
            from erp_sis_project sa join erp_karyawan ha on ha.id=sa.id_kary
            where sa.aktif<>'0' and sa.id_koordinator='$id' and
            (case when '$periode'='All' then 'All' else substr(sa.tgl,-4,4) end)='$periode'
            order by sa.nmr");
        return $query->result_array();
    }


}

?>