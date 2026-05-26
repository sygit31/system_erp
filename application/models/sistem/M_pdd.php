<?php class M_pdd extends CI_Model {

    function user() {
        $kary = explode('|', $_SESSION['logERP']);
        $id_kary = $kary[0];
        
        $query = $this->db->query("Select ha.kd_unit, substr(hc.level_jabatan, 0, 1) lev, ha.id_bagian, ha.nama
            from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
            where ha.id='$id_kary'");
        $data = $query->row_array();
        return array($data['KD_UNIT'], $id_kary, $data['LEV'], $data['ID_BAGIAN'], $data['NAMA'], $id_kary);
    }

    function status_menu($kode_menu, $id_kary) {
        $query = $this->db->query("Select status from erp_adm_akses where id_menu_detail=(Select id from erp_adm_menu_detail where kode_menu='$kode_menu') and id_akun=(Select id from erp_akun where id_karyawan='$id_kary')");
        $data = $query->row_array();
        return $data['STATUS'];
    }

    function pengesah() {
        return $this->db->query("Select distinct jabatan, bagian from
            (Select distinct upper(hc.nama) jabatan, upper(hb.nama) bagian, hc.level_jabatan
            from erp_jabatan hc join erp_karyawan ha on ha.id_jabatan=hc.id join erp_bagian hb on hb.id=ha.id_bagian
            Union
            Select distinct upper(hc.nama) jabatan, upper(hb.nama), hc.level_jabatan
            from erp_jabatan_rangkap hf join erp_jabatan hc on hc.id=hf.id_jabatan join erp_bagian hb on hb.id=hf.id_bagian) tbl
            where substr(level_jabatan,0,1)<=3
            order by jabatan, bagian");
    }

    function bagian() {
        return $this->db->query("Select id, bagian, kd_unit from
            (select distinct hb.id, hb.nama bagian, ha.kd_unit
            from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id
            union select hb.id, hb.nama bagian, hf.kd_unit
            from erp_jabatan_rangkap hf join erp_bagian hb on hb.id=hf.id_bagian join erp_jabatan hc on hc.id=hf.id_jabatan)tbl
            order by bagian");
    }

    function isi_nama($kd_unit, $id_bagian) {
        $query = $this->db->query("Select distinct pemilik, jabatan, bagian from
            (select distinct trim(upper(concat(hc.nama, concat(' ', hb.nama)))) pemilik, hc.nama jabatan, hb.nama bagian, hc.level_jabatan, ha.kd_unit
            from erp_jabatan hc join erp_karyawan ha on ha.id_jabatan=hc.id join erp_bagian hb on hb.id=ha.id_bagian where hc.status<>0 and hb.status<>0
            union
            select distinct trim(upper(concat(hc.nama, concat(' ', hb.nama)))) pemilik, hc.nama jabatan, hb.nama bagian, hc.level_jabatan, hf.kd_unit
            from erp_jabatan hc join erp_jabatan_rangkap hf on hf.id_jabatan=hc.id join erp_bagian hb on hb.id=hf.id_bagian where hc.status<>0 and hb.status<>0) tbl
            where substr(level_jabatan,0,1)<=3 and kd_unit='$kd_unit'
            order by jabatan, bagian");
        return $query->result_array();
    }

    function nmr() {
        return $this->db->query("Select distinct nmr, kode_tipe from erp_pdd_master order by kode_tipe, nmr");
    }

    function tipe() {
        return $this->db->query("Select distinct kode, tipe from erp_pdd_tipe where status='1' order by kode");
    }

    function unit() {
        return $this->db->query("Select distinct kd_unit, unit from erp_hr_unit where status='1' order by unit");
    }

    function isi_revisi($id_edit, $nmr) {
        $query = $this->db->query("Select pa.kd_unit, pa.id_bagian, pa.kode_tipe, pa.nama, pa.pemilik, pa.pengesah, pa.sifat, pa.lingkup,
            (select max(cast(rev AS integer)) from erp_pdd_master where nmr=pa.nmr) rev
            from erp_pdd_master pa where upper(pa.nmr)='$nmr'");
        return $query->row_array();
    }

    function dt_master($id_view) {
        $query = $this->db->query("Select pa.kode_tipe, pa.nmr, pa.rev, pa.nama, hb.nama bagian, pa.status,
            (select tipe from erp_pdd_tipe where kode=pa.kode_tipe) tipe,
            (select count(id) from erp_pdd_dist where id_master=pa.id and id_read is not null) qty_dist
            from erp_pdd_master pa join erp_bagian hb on hb.id=pa.id_bagian where pa.id='$id_view'");
        return $query->row_array();
    }

    function dt_komen($id_view) {
        $query = $this->db->query("Select ha.nama, to_char(pc.tgl,'DD-Mon-YY') tgl, to_char(pc.tgl,'HH24:MI') jam, pc.note, ha.jkel
            from erp_pdd_note pc join erp_karyawan ha on ha.id=pc.id_kary where pc.id_master='$id_view' and pc.status='1' order by pc.tgl desc");
        return $query->result_array();
    }

    function urut_komen() {
        $query = $this->db->query("Select max(id) id from erp_pdd_note");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function post_komen($urut_komen, $id_view, $id_kary, $teks) {
        $this->db->query("Insert into erp_pdd_note(id, id_master, id_kary, tgl, note, status) values('$urut_komen', '$id_view', '$id_kary', sysdate, '$teks', '1')");
    }

    function filter($bagian, $tipe, $status, $unit, $id_kary, $lev_kary, $id_bagian_pic, $lingkup, $nmr, $cari, $menu) {
        $id_bagian_pic = $lev_kary == '1' || $menu == '2' ? 'All' : $id_bagian_pic;
        $query = $this->db->query("Select pa.id, hb.nama bagian, pa.nmr, pa.tgl, pb.tipe, pa.nama, pa.rev, pa.pemilik, pa.sifat, nvl(pa.keterangan, ' ') keterangan, pa.status, pb.kode, pa.kd_unit, pa.pengesah
            from erp_pdd_master pa join erp_pdd_tipe pb on pb.kode=pa.kode_tipe join erp_bagian hb on hb.id=pa.id_bagian
            where (case when '$bagian'='All' then 'All' else to_char(pa.id_bagian) end)='$bagian' and (case when '$tipe'='All' then 'All' else to_char(pa.kode_tipe) end)='$tipe' and pa.status='$status' and pa.kd_unit='$unit' and (case when '$lev_kary'='1' or '$menu' = '2' then 'All' when pb.distribusi='1' then '$id_bagian_pic' else to_char(pa.id_bagian) end)='$id_bagian_pic' and (case when '$lingkup'='All' then 'All' else pa.lingkup end)='$lingkup' and (case when '$nmr'='All' then 'All' else pa.nmr end)='$nmr' and upper(pa.nama) like '%$cari%' and
            (case when '$menu'='2' then '2' else (select to_char(status) from erp_pdd_dist where id_master=pa.id and to_char(id_bagian)='$id_bagian_pic') end)='2'
            order by pb.kode, pa.kd_unit, hb.nama, pa.nmr");
        return $query->result_array();
    }

    function data_update() {
        $query = $this->db->query("Select * from erp_pdd_master");
        return $query->result_array();
    }

    function kadaluarsa($nmr) {
        $this->db->query("Update erp_pdd_master set status='0' where nmr='$nmr'");
    }

    function urut() {
        $query = $this->db->query("Select max(id) id from erp_pdd_master");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function simpan($urut, $kd_unit, $lingkup, $sifat, $nmr, $tgl, $tipe, $nama, $revisi, $id_bagian, $pemilik, $pengesah, $ext, $keterangan) {
        $this->db->query("Insert into erp_pdd_master(id, kd_unit, lingkup, sifat, nmr, tgl, kode_tipe, nama, rev, id_bagian, pemilik, pengesah, filename, status, keterangan) values('$urut','$kd_unit','$lingkup','$sifat','$nmr','$tgl','$tipe','$nama','$revisi','$id_bagian','$pemilik','$pengesah','$ext','2','$keterangan')");
    }

    function update($id_edit, $kd_unit, $lingkup, $sifat, $nmr, $tgl, $tipe, $nama, $revisi, $id_bagian, $pemilik, $pengesah, $ext, $keterangan) {
        $this->db->query("Update erp_pdd_master set kd_unit='$kd_unit', lingkup='$lingkup', sifat='$sifat', nmr='$nmr', tgl='$tgl', kode_tipe='$tipe', nama='$nama', rev='$revisi', id_bagian='$id_bagian', pemilik='$pemilik', pengesah='$pengesah', keterangan='$keterangan' where id='$id_edit'");
    }

    function edit($id_edit) {
        $query = $this->db->query("Select tgl, kd_unit, id_bagian, kode_tipe, nmr, rev, nama, pemilik, pengesah, sifat, lingkup, pemilik, pengesah from erp_pdd_master where id='$id_edit'")->row_array();
        $query_lamp = $this->db->query("Select * from erp_pdd_lamp where id_master='$id_edit' order by judul")->result_array();

        return array($query, $query_lamp);
    }

    function dt_lamp($id_view) {
        return $this->db->query("Select * from erp_pdd_lamp where id_master='$id_view' order by judul")->result_array();
    }

    function hapus($id_hapus) {
        $query = $this->db->query("Select nmr, rev from erp_pdd_master where id='$id_hapus'");
        $nmr = $query->row_array()['NMR'];
        $rev = $query->row_array()['REV'] - 1;

        $this->db->query("Delete from erp_pdd_master where id='$id_hapus'");
        $this->db->query("Delete from erp_pdd_dist where id_master='$id_hapus'");
        $this->db->query("Delete from erp_pdd_note where id_master='$id_hapus'");
        $this->db->query("Update erp_pdd_master set status='2' where nmr='$nmr' and rev='$rev'");
    }

    function hapus_dist($id_edit) {
        $this->db->query("Delete from erp_pdd_dist where id_master='$id_edit'");
    }

    function dt_hapus($id_hapus) {
        return $this->db->query("Select id, ext from erp_pdd_lamp where id_master='$id_hapus'")->result_array();
    }

    function filter_new($mn, $id_bagian) {
        if ($mn == '2') {
            $query = $this->db->query("Select distinct pa.id, to_char(pa.tgl, 'DD-MM-YYYY') tgl, pb.tipe, pa.nmr, pa.nama, pa.rev
                from erp_pdd_master pa join erp_pdd_tipe pb on pb.kode=pa.kode_tipe
                where pa.status='1'");
        }else{
            $query = $this->db->query("Select distinct pa.id, to_char(pa.tgl, 'DD-MM-YYYY') tgl, pb.tipe, pa.nmr, pa.nama, pa.rev
                from erp_pdd_master pa join erp_pdd_dist pd on pd.id_master=pa.id join erp_pdd_tipe pb on pb.kode=pa.kode_tipe
                where pd.status='1' and pd.id_bagian='$id_bagian'");
        }
        return $query->result_array();
    }

    function submit_data($id_hapus) {
        $this->db->query("Update erp_pdd_master set status='2' where id='$id_hapus'");
    }

    function rec_data($id_hapus, $id_input, $id_bagian, $kd_unit) {
        $this->db->query("Update erp_pdd_dist set tgl_read=sysdate, id_read='$id_input', status='2' where id_master='$id_hapus' and id_bagian='$id_bagian' and kd_unit='$kd_unit'");
    }

    function dt_bagian($kd_unit) {
        $query = $this->db->query("Select distinct id_bagian from erp_pdd_master where kd_unit='$kd_unit' and id_bagian is not null");
        return $query->result_array();
    }

    function dt_dist($kd_unit) {
        return $this->db->query("Select id from erp_pdd_master where status='1' and kd_unit='$kd_unit'");
    }

    function urut_dist() {
        $query = $this->db->query("Select max(id) id from erp_pdd_dist");
        $urut = $query->row_array();
        return $urut['ID'] + 1;
    }

    function tipe_dist($id_hapus) {
        $query = $this->db->query("Select pb.distribusi, pa.id_bagian from erp_pdd_tipe pb join erp_pdd_master pa on pa.kode_tipe=pb.kode where pa.id='$id_hapus' and pa.status<>0");
        return $query->row_array();
    }

    function dist($urut_dist, $id_hapus, $id_input, $id_bagian, $kd_unit) {
        $query = $this->db->query("Select ha.id from erp_karyawan ha join erp_jabatan hc on hc.id=ha.id_jabatan where ha.id_bagian='$id_bagian' and substr(hc.level_jabatan, 0, 1)<=3");
        $id_read = $query->row_array()['ID'];

        $this->db->query("Insert into erp_pdd_dist(id, id_master, id_input, id_bagian, id_read, kd_unit, tgl_dist, tgl_read, status) values('$urut_dist', '$id_hapus', '$id_input', '$id_bagian', '$id_read', '$kd_unit', sysdate, sysdate, '2')");
    }

    function cetak_dist($id_cetak) {
        $query = $this->db->query("Select distinct pa.nmr, pa.rev, pa.nama, ha.nama pic, pa.tgl, pd.tgl_dist, pd.tgl_read
            from erp_pdd_master pa join erp_pdd_dist pd on pd.id_master=pa.id join erp_karyawan ha on ha.id=pd.id_read
            where pa.id='$id_cetak'
            order by ha.nama");
        return $query->result_array();
    }

    function filter_d($kd_unit, $tipe) {
        $query = $this->db->query("Select distinct pa.nmr, pa.nama, pa.rev, pa.tgl, pa.pemilik, pa.pengesah
            from erp_pdd_master pa join erp_pdd_tipe pb on pb.kode=pa.kode_tipe
            where pa.status='2' and pb.grup='$tipe' and pa.kd_unit='$kd_unit' and pa.lingkup<>'2'
            order by pa.nmr");
        return $query->result_array();
    }

    function urut_lamp() {
        $query = $this->db->query("Select max(id) id from erp_pdd_lamp")->row_array();
        return $query['ID'] + 1;
    }

    function simpan_lamp($urut_lamp, $id_file, $judul, $ext) {
        $this->db->query("Insert into erp_pdd_lamp(id, id_master, judul, ext) values('$urut_lamp','$id_file','$judul','$ext')");
    }

    function update_lamp($id_edit, $judul) {
        $this->db->query("Update erp_pdd_lamp set judul='$judul' where id='$id_edit'");
    }

    function hapus_lamp($id_lamp) {
        $this->db->query("Delete from erp_pdd_lamp where id='$id_lamp'");
    }

}