<?php 

class M_project extends CI_Model{

    function show_pic() {
        return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_bagian hb on ha.id_bagian=hb.id join erp_jabatan hc on ha.id_jabatan=hc.id where ha.status='1' and ha.tgl_keluar is null order by nama");
    }

    function filter_project($cari,$periode,$status) {
        return $this->db->query("Select distinct sa.id, sa.nmr, to_char(sa.tgl,'DD-MM-YYYY') tgl, sa.nama, ha.id id_kary, ha.nama nama_kary, sa.tugas, to_char(sa.deadline,'DD-MM-YYYY') deadline, to_char(sa.target2,'DD-MM-YYYY') target2, to_char(sa.target3,'DD-MM-YYYY') target3, to_char(sa.finish,'DD-MM-YYYY') finish, sa.lev, sa.aktif, ha2.nama koordinator,
            (select replace(avg(replace(nilai,'.',',')),',','.') from erp_sis_project where aktif<>'0' and nmr=sa.nmr) nilai,
            (select count(nmr) from erp_sis_project where aktif<>'0' and nmr=sa.nmr and finish is null and aktif<>'2') qty
            from erp_sis_project sa join erp_karyawan ha on ha.id=sa.id_kary left join erp_karyawan ha2 on ha2.id=sa.id_koordinator
            where sa.aktif<>'0' and (case when '$periode'='All' then 'All' else substr(sa.tgl,-4,4) end) like '$periode' and (case when '$status'='All' then 'All' when sa.aktif='2' then 'Close' when sa.finish is null then 'Open' else 'Close' end) like '$status' and (upper(sa.nama) like '%$cari%' or upper(ha.nama) like '%$cari%' or upper(ha2.nama) like '%$cari%')
            order by sa.nmr, ha.id");
    }

    function show_ide() {
        return $this->db->query("Select sc.id id_ide, sc.tgl, sc.ide, sc.status, ha.id id_kary, ha.nama
            from erp_sis_ide sc join erp_karyawan ha on ha.id=sc.id_kary join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where sc.status='DIAJUKAN'
            order by sc.tgl desc");
    }

    function show_bobot() {
        return $this->db->query("Select * from erp_sis_bobot where status='1' order by id asc");
    }

    function auto_no($tahun){
        $query = $this->db->query("Select max(substr(nmr,-3)) as no_project from erp_sis_project where to_char(tgl,'yy')='$tahun'");
        $no_project = $query->row_array();
        $no_project = $tahun.'-'.sprintf("%'03d\n", $no_project['NO_PROJECT'] + 1);     
        return $no_project;
    }

    function non_aktif_project($id_project) {
        $this->db->query("Update erp_sis_project set aktif='0' where id='$id_project'");
    }

    function urut_id() {
        $query = $this->db->query("Select max(id) as id from erp_sis_project");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function simpan_project($id,$no_project,$tgl,$nama_project,$id_pic,$tugas,$deadline,$level,$id_ide,$id_koordinator) {
        $this->db->query("Insert into erp_sis_project values('$id','$no_project','$tgl','$nama_project','$id_pic','$tugas','$deadline','','','','$id_ide','1','$level','$id_koordinator','')");
    }

    function edit_project($id_edit,$no_project,$tgl,$nama_project,$id_pic,$tugas,$deadline,$level,$id_ide,$id_koordinator) {
        $this->db->query("Update erp_sis_project set nmr='$no_project',tgl='$tgl',nama='$nama_project',id_kary='$id_pic',tugas='$tugas',deadline='$deadline',lev='$level',id_koordinator='$id_koordinator' where id='$id_edit'");
    }

    function non_aktif_bobot() {
        $this->db->query("Update erp_sis_bobot set status='0' where status='1'");
    }

    function urut_id_bobot() {
        $query = $this->db->query("Select max(id) as id from erp_sis_bobot");
        $urut = $query->row_array();
        return $urut['ID'] + 1;        
    }

    function simpan_bobot($id_bobot,$level,$n1,$n2,$n3,$n4) {
        $this->db->query("Insert into erp_sis_bobot values('$id_bobot','$level','$n1','$n2','$n3','$n4','','1',sysdate)");
    }

    function ambil_project($id_project) {
        $query = $this->db->query("Select nmr from erp_sis_project where id='$id_project'");
        $data = $query->row_array();
        $nmr = $data['NMR']; 

        $query = $this->db->query("Select sa.id, sa.nmr, sa.tgl, sa.nama, ha.id id_kary, initcap(ha.nama) nama_kary, sa.tugas, sa.deadline, sa.lev, ha2.nama nama_koordinator, sa.id_ide
            from erp_sis_project sa join erp_karyawan ha on sa.id_kary=ha.id join erp_karyawan ha2 on ha2.id=sa.id_koordinator
            where sa.nmr='$nmr' and sa.aktif='1' and sa.finish is null");
        return $query->result_array();
    }

    function update_status_ide($id_ide) {
        $this->db->query("Update erp_sis_ide set status='PROJECT' where id='$id_ide'");
    }

    function simpan_revisi($id_project,$target2,$target3) {
        $this->db->query("Update erp_sis_project set target2='$target2', target3='$target3' where id='$id_project'");
    }

    function hapus_revisi($id_project) {
        $this->db->query("Update erp_sis_project set target2=null, target3=null where id='$id_project'");
    }

    function ambil_gambar($id_project) {
        $query = $this->db->query("Select sb.gambar, sa.finish from erp_sis_project_gbr sb right join erp_sis_project sa on sa.id=sb.id_project where sa.id='$id_project'");
        return $query->result_array();
    }

    function simpan_finish($id_project,$finish) {
        $this->db->query("Update erp_sis_project set finish='$finish' where id='$id_project'");
    }

    function urut_id_gambar() {
        $query = $this->db->query("Select max(id) as id from erp_sis_project_gbr");
        $urut = $query->row_array();
        return $urut['ID'] + 1;        
    }

    function simpan_gambar($id_gambar,$id_project,$file_name) {
        $this->db->query("Insert into erp_sis_project_gbr values('$id_gambar','$id_project','$file_name')");
    }

    function gambar_hapus($gambar_hapus) {
        $this->db->query("Delete from erp_sis_project_gbr where gambar='$gambar_hapus'");
    }

    function ambil_deadline($id_project) {
        $query = $this->db->query("Select deadline, target2, target3, id_ide from erp_sis_project where id='$id_project'");
        return $query->row_array();
    }

    function ambil_nilai($id_project) {
        $query = $this->db->query("Select sl.nilai1, sl.nilai2, sl.nilai3, sl.nilai4, sa.id_ide from
            erp_sis_bobot sl join erp_sis_project sa on sa.lev=sl.lev where sa.id='$id_project' and sl.status='1' and rownum='1'");
        return $query->row_array();
    }

    function simpan_reward($id_project,$nilai) {
        $this->db->query("Update erp_sis_project set nilai='$nilai' where id='$id_project'");
    }

    function hapus_project($id_project) {
        $this->db->query("Update erp_sis_project set aktif='0' where id='$id_project'");
    }

    function failed_project($id_project,$nilai_fail) {
        $this->db->query("Update erp_sis_project set aktif='2', nilai='$nilai_fail', finish=sysdate where id='$id_project'");
    }

    function batal_ide($id_ide) {
        $this->db->query("Update erp_sis_ide set status='DIBATALKAN' where id='$id_ide'");
    }

}

?>