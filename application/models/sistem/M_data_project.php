<?php 

class M_data_project extends CI_Model{

    function show() {
        return $this->db->query("Select distinct sa.id, sa.nmr, to_char(sa.tgl,'DD-MM-YYYY') tgl, sa.nama, ha.id id_kary, ha.nama nama_kary, sa.tugas, to_char(sa.deadline,'DD-MM-YYYY') deadline, to_char(sa.target2,'DD-MM-YYYY') target2, to_char(sa.target3,'DD-MM-YYYY') target3, to_char(sa.finish,'DD-MM-YYYY') finish, sa.lev, sa.aktif, ha2.nama koordinator,
            (select replace(avg(replace(nilai,'.',',')),',','.') from erp_sis_project where aktif<>'0' and nmr=sa.nmr) nilai,
            (select count(nmr) from erp_sis_project where aktif<>'0' and nmr=sa.nmr and finish is null and aktif<>'2') qty
            from erp_sis_project sa join erp_karyawan ha on ha.id=sa.id_kary left join erp_karyawan ha2 on ha2.id=sa.id_koordinator
            where sa.finish is null and sa.aktif='1' order by sa.nmr desc, ha.nama");
    }

    function filter($periode,$status,$cari) {
        return $this->db->query("Select distinct sa.id, sa.nmr, to_char(sa.tgl,'DD-MM-YYYY') tgl, sa.nama, ha.id id_kary, ha.nama nama_kary, sa.tugas, to_char(sa.deadline,'DD-MM-YYYY') deadline, to_char(sa.target2,'DD-MM-YYYY') target2, to_char(sa.target3,'DD-MM-YYYY') target3, to_char(sa.finish,'DD-MM-YYYY') finish, sa.lev, sa.aktif, ha2.nama koordinator,
            (select replace(avg(replace(nilai,'.',',')),',','.') from erp_sis_project where aktif<>'0' and nmr=sa.nmr) nilai,
            (select count(nmr) from erp_sis_project where aktif<>'0' and nmr=sa.nmr and finish is null and aktif<>'2') qty
            from erp_sis_project sa join erp_karyawan ha on ha.id=sa.id_kary left join erp_karyawan ha2 on ha2.id=sa.id_koordinator
            where sa.aktif<>'0' and (case when '$periode'='All' then 'All' else substr(sa.tgl,-4,4) end) like '$periode' and (case when '$status'='All' then 'All' when sa.aktif='2' then 'Close' when sa.finish is null then 'Open' else 'Close' end) like '$status' and (upper(sa.nama) like '%$cari%' or upper(ha.nama) like '%$cari%')
            order by sa.nmr desc, ha.nama");
    }

}

?>