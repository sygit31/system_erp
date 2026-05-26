<?php 

class M_penilai extends CI_Model{

	function unit() {
		return $this->db->query("Select * from erp_hr_unit order by id");
	}

	function bagian() {
		return $this->db->query("Select * from erp_bagian order by nama");
	}

	function show_penilai() {
		$data = $this->db->query("Select distinct(id_penilai), upper(nama) nama, nik, bagian, jabatan
			from (select sd.id_penilai, ha.nama, ha.nik, hb.nama bagian, hc.nama jabatan
			from erp_sis_kategori se join erp_sis_penilai sd on sd.id=se.id_sis_penilai join erp_karyawan ha on ha.id=sd.id_penilai join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where se.aktif='1' and ha.tgl_keluar is null) order by nama");
		return $data;
	}

	function show_karyawan() {
		$data = $this->db->query("Select ha.id id_karyawan, ha.nik, upper(ha.nama) nama, hb.nama bagian, hc.nama jabatan,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Atasan Langsung' and rownum='1' and se2.aktif='1') al,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Manajemen' and rownum='1' and se2.aktif='1') mj,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega' and rownum='1' and se2.aktif='1') kl,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega 1' and rownum='1' and se2.aktif='1') kl1,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega 2' and rownum='1' and se2.aktif='1') kl2,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='HR' and rownum='1' and se2.aktif='1') hr,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='IS' and rownum='1' and se2.aktif='1') nis,
			(select upper(ha2.nama) from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='K3' and rownum='1' and se2.aktif='1') k3
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where ha.status='1' and ha.tgl_keluar is null and
			(select count(id_karyawan) from erp_sis_kategori where id_karyawan=ha.id and aktif='1') > 0
			order by ha.nama");
		return $data;
	}

	function filter_karyawan($cari,$id_bagian,$kd_unit) {
		$data = $this->db->query("Select ha.id id_karyawan, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Atasan Langsung' and rownum='1' and se2.aktif='1') al,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Manajemen' and rownum='1' and se2.aktif='1') mj,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega' and rownum='1' and se2.aktif='1') kl,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega 1' and rownum='1' and se2.aktif='1') kl1,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='Kolega 2' and rownum='1' and se2.aktif='1') kl2,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='HR' and rownum='1' and se2.aktif='1') hr,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='IS' and rownum='1' and se2.aktif='1') nis,
			(select ha2.nama from erp_karyawan ha2 join erp_sis_penilai sd2 on sd2.id_penilai=ha2.id join erp_sis_kategori se2 on se2.id_sis_penilai=sd2.id where se2.id_karyawan=ha.id and sd2.kategori='K3' and rownum='1' and se2.aktif='1') k3
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where upper(ha.nama) like '%$cari%' and ha.status='1' and ha.tgl_keluar is null and (case when '$id_bagian'='All' then 'All' else to_char(hb.id) end)='$id_bagian' and (case when '$kd_unit'='All' then 'All' else ha.kd_unit end)='$kd_unit' and
			(select count(id_karyawan) from erp_sis_kategori where id_karyawan=ha.id and aktif='1') > 0
			order by ha.nama");
		return $data;
	}

	function data_karyawan() {
		$data = $this->db->query("Select ha.id id_karyawan, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where ha.status='1' order by ha.nama");
		return $data->result_array();
	}

	function ambil_karyawan($kategori) {
		$data = $this->db->query("Select ha.id id_karyawan, ha.nik, ha.nama, hb.nama bagian, hc.nama jabatan
			from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan
			where ha.status='1' and ha.tgl_keluar is null and
			(select count(sd.kategori) from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha2 on ha2.id=se.id_karyawan join erp_karyawan ha3 on ha3.id=sd.id_penilai where se.id_karyawan=ha.id and sd.kategori='$kategori' and se.aktif='1' and ha2.status='1')='0'
			order by ha.nama");
		return $data->result_array();
	}

	function urut_penilai() {
		$nmr = $this->db->query("Select max(id) as id from erp_sis_penilai");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_penilai($id_sis_penilai,$id_penilai,$kategori) {
		$this->db->query("Insert into erp_sis_penilai(id,id_penilai,kategori) values('$id_sis_penilai','$id_penilai','$kategori')");
	}

	function update_penilai($id_sis_penilai,$id_penilai,$kategori) {
		$this->db->query("Update erp_sis_penilai set id_penilai='$id_penilai',kategori='$kategori' where id='$id_sis_penilai'");
		$this->db->query("Update erp_sis_kategori set aktif='0' where id_sis_penilai='$id_sis_penilai'");
	}

	function urut_kategori() {
		$nmr = $this->db->query("Select max(id) as id from erp_sis_kategori");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_kategori($id_sis_kategori,$id_sis_penilai,$id_karyawan) {
		$this->db->query("Insert into erp_sis_kategori(id,id_sis_penilai,id_karyawan,aktif,tgl_input) values('$id_sis_kategori','$id_sis_penilai','$id_karyawan','1',sysdate)");
	}

	function update_kategori($id_sis_kategori,$id_sis_penilai,$id_karyawan) {
		$this->db->query("Update erp_sis_kategori set id_sis_penilai='$id_sis_penilai',id_karyawan='$id_karyawan',aktif='1' where id='$id_sis_kategori'");
	}

	function preview_penilai($id_penilai,$kategori,$unit) {
		$data = $this->db->query("Select sd.id id_sis_penilai, se.id id_sis_kategori, sd.id_penilai, sd.kategori, se.id_karyawan, ha.nama, hc.nama jabatan, hb.nama bagian, ha.nik,
			(select nama from erp_karyawan where id=sd.id_penilai) nama_penilai
			from erp_sis_penilai sd join erp_sis_kategori se on se.id_sis_penilai=sd.id join erp_karyawan ha on ha.id=se.id_karyawan join erp_jabatan hc on hc.id=ha.id_jabatan join erp_bagian hb on hb.id=ha.id_bagian join erp_hr_unit hd on hd.kd_unit=ha.kd_unit
			where (case when '$unit'='ALL' then 'ALL' else hd.unit end)='$unit' and sd.id_penilai='$id_penilai' and sd.kategori='$kategori' and se.aktif='1' and ha.status<>'0'
			order by ha.nama");
		return $data->result_array();
	}

	function filter_nilai($cari) {
		$data = $this->db->query("Select distinct(id_penilai), nama, nik, bagian, jabatan, aktif, status_premi
			from (select sd.id_penilai, se.aktif, ha.nama, ha.nik, hb.nama bagian, hc.nama jabatan, status_premi
			from erp_sis_kategori se join erp_sis_penilai sd on sd.id=se.id_sis_penilai join erp_karyawan ha on ha.id=sd.id_penilai join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan) where upper(nama) like '%$cari%' and aktif='1'");
		return $data;
	}

	function hapus_penilai($id_penilai) {
		$data = $this->db->query("Select id from erp_sis_penilai where id_penilai='$id_penilai'");
		$dt = $data->result_array();

		foreach ($dt as $value) {
			$id_sis_penilai = $value['ID'];
			$this->db->query("Update erp_sis_kategori set aktif='0' where id_sis_penilai='$id_sis_penilai'");
		}
	}

	function hapus_sis_kategori($id_sis_kategori) {
		$this->db->query("Update erp_sis_kategori set aktif='0' where id='$id_sis_kategori'");
	}

}

?>