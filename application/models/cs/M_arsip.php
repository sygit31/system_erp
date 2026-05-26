<?php 
class M_arsip extends CI_Model {

	function karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		$query = $this->db->query("Select ha.nama, ha.id_bagian, hb.kode from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'
			union
			select ha.nama, hf.id_bagian, hb.kode from erp_karyawan ha join erp_jabatan_rangkap hf on hf.id_karyawan=ha.id join erp_bagian hb on hb.id=hf.id_bagian where ha.id='$id_kary'");
		$data = $query->result_array();

		$dt_bagian = array();
		foreach ($data as $dt) {
			array_push($dt_bagian, $dt['ID_BAGIAN']);
		}
		return array($id_kary, $data[0]['NAMA'], $dt_bagian, $data[0]['ID_BAGIAN'], $data[0]['KODE']);
	}

	function bagian() {
		return $this->db->query("Select distinct hb.id, hb.kode, hb.nama bagian from erp_bagian hb order by hb.nama");
	}

	function kode_rak() {
		return $this->db->query("Select distinct sp.kode, sp.rak, sp.baris, sp.kolom, sp.area,
			(select count(id) from erp_sis_arsip where kode_rak=sp.kode and status='1') isi
			from erp_sis_arsip_rak sp
			where sp.status='1' order by sp.kode");
	}

	function nomor_rak() {
		return $this->db->query("Select distinct substr(kode,0,2) nomor_rak from erp_sis_arsip_rak order by substr(kode,0,2)");
	}

	function status_menu($menu) {
		$id_kary = $this->karyawan()[0];
		$query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail where aa.id_karyawan='$id_kary' and ad.kode_menu='$menu'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function isi_kode_rak() {
		$query = $this->db->query("Select distinct sp.kode, sp.rak, sp.baris, sp.kolom
			from erp_sis_arsip_rak sp
			where (select count(id) from erp_sis_arsip where kode_rak=sp.kode and status='1')=0 and sp.status='1' order by sp.kode");
		return $query->result_array();
	}

	function filter($id_bagian, $kode_rak, $nomor_rak, $cari) {
		return $this->db->query("Select sn.id id_detail, ha.nama, hb.nama bagian, sn.kode_rak, sn.urut_box, sn.kode_box, to_char(sn.tgl, 'dd-mm-yyyy') tgl, sn.isi, sn.retensi, sn.id_bagian
			from erp_sis_arsip sn join erp_karyawan ha on ha.id=sn.id_karyawan join erp_bagian hb on hb.id=sn.id_bagian
			where sn.status='1' and (case when '$id_bagian'='All' then 'All' else to_char(sn.id_bagian) end)='$id_bagian' and (case when '$kode_rak'='All' then 'All' else sn.kode_rak end)='$kode_rak' and (case when '$nomor_rak'='All' then 'All' else substr(sn.kode_rak,0,2) end)='$nomor_rak' and lower(sn.isi) like '%$cari%'
			order by sn.kode_rak");
	}

	function urut_bagian($id_bagian) {
		$query = $this->db->query("Select max(urut_box) urut from erp_sis_arsip where id_bagian='$id_bagian' and status<>'0'");
		$data = $query->row_array();
		return sprintf('%03d', $data['URUT'] + 1);
	}

	function cek_urut_box($id_bagian, $urut_box, $id_edit) {
		if ($id_edit != '') {
			$query = $this->db->query("Select id from erp_sis_arsip where id='$id_edit' and id_bagian='$id_bagian' and urut_box='$urut_box' and status<>'0'");
			if ($query->num_rows() > 0) {return 0;}
		}

		$query = $this->db->query("Select id from erp_sis_arsip where id_bagian='$id_bagian' and urut_box='$urut_box' and status<>'0'");
		return $query->num_rows();
	}

	function cek_kode_rak($id_edit, $kode_rak) {
		if ($id_edit != '') {
			$query = $this->db->query("Select id from erp_sis_arsip where id='$id_edit' and kode_rak='$kode_rak' and status<>'0'");
			if ($query->num_rows() > 0) {return 0;}
		}

		$query = $this->db->query("Select id from erp_sis_arsip where kode_rak='$kode_rak' and status<>'0'");
		return $query->num_rows();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_sis_arsip");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id, $id_kary, $id_bagian, $kode_rak, $urut_box, $kode_box, $isi, $retensi, $tgl) {
		$this->db->query("Insert into erp_sis_arsip(id, id_karyawan, id_bagian, kode_rak, urut_box, kode_box, isi, retensi, status, tgl) values('$id','$id_kary','$id_bagian','$kode_rak','$urut_box','$kode_box','$isi','$retensi','1','$tgl')");
	}

	function update($id_edit, $id_kary, $id_bagian, $kode_rak, $urut_box, $kode_box, $isi, $retensi, $tgl) {
		$this->db->query("Update erp_sis_arsip set id_karyawan='$id_kary', id_bagian='$id_bagian', kode_rak='$kode_rak', urut_box='$urut_box', kode_box='$kode_box', isi='$isi', retensi='$retensi', tgl='$tgl' where id='$id_edit'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select ha.nama, sn.id_karyawan, hb.nama bagian, sn.id_bagian, sn.kode_rak, sn.urut_box, sn.kode_box, to_char(sn.tgl, 'dd-mm-yyyy') tgl, sn.isi, sn.retensi, hb.kode
			from erp_sis_arsip sn join erp_karyawan ha on ha.id=sn.id_karyawan join erp_bagian hb on hb.id=sn.id_bagian
			where sn.id='$id_edit'");
		return $query->row_array();
	}

	function cetak($kode_rak) {
		$query = $this->db->query("Select ha.nama, sn.id_karyawan, hb.nama bagian, sn.id_bagian, sn.kode_rak, sn.urut_box, sn.kode_box, to_char(sn.tgl, 'dd-mm-yyyy') tgl, sn.isi, sn.retensi, hb.kode, sn.tgl, sn.tgl_ambil
			from erp_sis_arsip sn join erp_karyawan ha on ha.id=sn.id_karyawan join erp_bagian hb on hb.id=sn.id_bagian
			where sn.kode_rak='$kode_rak' and sn.status='1'");
		return $query->row_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_sis_arsip where id=(select id_ipb from erp_sis_arsip_detail where id='$id_edit')");
		$this->db->query("Delete from erp_sis_arsip_detail where id_ipb=(select id_ipb from erp_sis_arsip_detail where id='$id_edit')");
	}

	function hapus($id_hapus) {
		$id_ambil = $this->karyawan()[0];
		$this->db->query("Update erp_sis_arsip set status='0', tgl_ambil=sysdate, id_ambil='$id_ambil' where id='$id_hapus'");
	}

	function lihat($rak) {
		$query = $this->db->query("Select hb.nama bagian, sn.kode_rak, sn.kode_box, sn.urut_box, sn.isi from erp_sis_arsip sn join erp_bagian hb on hb.id=sn.id_bagian where sn.kode_rak='$rak' and sn.status='1'");
		return $query->row_array();
	}

	function isi_ambil() {
		$tgl_start = date('ymd', strtotime('-3 months'));
		$query = $this->db->query("Select sn.id id_detail, ha.nama, hb.nama bagian, sn.kode_rak, sn.urut_box, sn.kode_box, to_char(sn.tgl, 'dd-mm-yyyy') tgl, to_char(sn.tgl_ambil, 'dd-mm-yyyy') tgl_ambil, sn.isi, sn.retensi, sn.id_bagian, ha2.nama nama_ambil
			from erp_sis_arsip sn join erp_karyawan ha on ha.id=sn.id_karyawan join erp_bagian hb on hb.id=sn.id_bagian join erp_karyawan ha2 on ha2.id=sn.id_ambil
			where sn.status='0' and to_char(sn.tgl_ambil, 'YYMMDD')>='$tgl_start'
			order by sn.tgl_ambil");
		return $query->result_array();
	}

}