<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_its extends CI_Model {

	function get_karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		$id_menu_detail = '76'; // Menu Bank Data

		$query = $this->db->query("Select ha.id_bagian,ab.status akses
			from erp_karyawan ha join erp_akun aa on aa.id_karyawan=ha.id join erp_adm_akses ab on ab.id_akun=aa.id
			where ha.id='$id_kary' and ab.id_menu_detail='$id_menu_detail'");
		$data = $query->row_array();
		$id_bagian = $data['ID_BAGIAN'];
		$akses = $data['AKSES'];

		return array($id_bagian, $akses, $id_kary);
	}

	function pemilik() {
		return $this->db->query("Select distinct upper(ha.nama) nama, ha.id from erp_karyawan ha join erp_jabatan hb on hb.id=ha.id_jabatan where ha.status<>0 and substr(hb.level_jabatan,0,1)<4 and ha.tgl_keluar is null order by nama");
	}

	function show_kategori() {
		return $this->db->query("Select ib.*, ic.*, ic.id id_kategori_detail from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id where ic.aktif='1' order by ib.kategori, ic.sub_kategori");
	}

	function urut_kategori() {
		$query = $this->db->query("Select max(id) as id from erp_its_kategori");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function urut_kategori_detail() {
		$query = $this->db->query("Select max(id) as id from erp_its_kategori_detail");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_kategori($id_kategori, $kategori) {
		$this->db->query("Insert into erp_its_kategori values ('$id_kategori','$kategori','1')");
	}

	function update_kategori($id_kategori, $kategori) {
		$this->db->query("Update erp_its_kategori set kategori='$kategori' where id='$id_kategori'");
	}

	function simpan_sub_kategori($id_sub_kategori, $id_kategori, $sub_kategori) {
		$this->db->query("Insert into erp_its_kategori_detail values ('$id_sub_kategori','$id_kategori','$sub_kategori','1')");
	}

	function update_sub_kategori($id_sub_kategori, $sub_kategori) {
		$this->db->query("Update erp_its_kategori_detail set sub_kategori='$sub_kategori' where id='$id_sub_kategori'");
	}

	function filter_kategori($cari)	{
		return $this->db->query("Select ib.kategori, ic.sub_kategori, ic.id id_kategori_detail, ic.id_kategori from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id
			where ic.aktif='1' and (upper(ib.kategori) like '%$cari%' or upper(ic.sub_kategori) like '%$cari%')
			order by ib.kategori, ic.sub_kategori");
	}

	function edit_kategori($id_kategori) {
		$data = $this->db->query("Select ib.*, ic.*, ic.id id_kategori_detail from erp_its_kategori ib join erp_its_kategori_detail ic on ic.id_kategori=ib.id
			where ic.id_kategori='$id_kategori' and ic.aktif='1' order by sub_kategori");
		return $data->result_array();
	}

	function hapus_kategori($id_kategori_detail) {
		$this->db->query("Update erp_its_kategori_detail set aktif ='0' where id='$id_kategori_detail'");
	}


	// -----------------------------  Upload Bank Data  ------------------------------ //
	function show_tahun() {
		$karyawan = $this->get_karyawan();
		$id_bagian = $karyawan[0];
		$akses = $karyawan[1];
		if ($akses == '2') {
			$akun = 'All';
		} else {
			$akun = '2';
		}

		return $this->db->query("Select distinct ia.tahun from erp_karyawan ha join erp_its_data ia on ia.id_karyawan=ha.id where ia.aktif<>'0' and (case when '$akses'='2' then 'All' else ia.aktif end)='$akun' order by ia.tahun");
	}

	function show_karyawan() {
		return $this->db->query("Select distinct ha.nama from erp_its_data ia join erp_karyawan ha on ha.id=ia.id_karyawan
			where ia.aktif<>'0' order by ha.nama");
	}

	function filter_file($jenis, $tahun, $kategori, $cari, $nm_karyawan, $approved, $sub_kategori) {
		$karyawan = $this->get_karyawan();
		$id_bagian = $karyawan[0];
		$akses = $karyawan[1];
		$id_karyawan = $karyawan[2];

		return $this->db->query("Select ia.id id_data, ia.ext, ia.tahun, ia.jenis, ia.nama_file, ia.aktif, ha.nama karyawan, ib.kategori, ic.sub_kategori
			from erp_karyawan ha join erp_its_data ia on ia.id_karyawan=ha.id join erp_its_kategori_detail ic on ic.id=ia.id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
			where ia.aktif<>'0' and ia.aktif='$approved' and
			(case when '$jenis'='All' then 'All' else jenis end)='$jenis' and (case when '$tahun'='All' then 'All' else ia.tahun end)='$tahun' and (case when '$kategori'='All' then 'All' else ib.kategori end)='$kategori' and (case when '$sub_kategori'='All' then 'All' else ic.sub_kategori end)='$sub_kategori' and (upper(ia.nama_file) like '%$cari%' or upper(ia.tag) like '%$cari%' or upper(ib.kategori) like '%$cari%' or upper(ic.sub_kategori) like '%$cari%' or upper(ha.nama) like '%$cari%' or upper(ia.tahun) like '%$cari%' or upper(ia.jenis) like '%$cari%' or upper(ia.nama_file) like '%$cari%') and (case when '$nm_karyawan'='All' then 'All' else ha.nama end)='$nm_karyawan'
			order by ib.kategori, ic.sub_kategori, ia.tahun, ia.nama_file");
	}

	function auto_id_data() {
		$nmr = $this->db->query("Select max(id) as id from erp_its_data");
		$urut = $nmr->row_array();
		return $urut['ID'];
	}

	function simpan_file($id, $id_karyawan, $jenis, $tahun, $id_kategori_detail, $judul, $tag, $ext) {
		$karyawan = $this->get_karyawan();
		$akses = $karyawan[1];
		if ($akses == '1') {
			$aktif = '1';
		} else {
			$aktif = '2';
		}

		$this->db->query("Insert into erp_its_data(id, id_karyawan, nama_file, jenis, id_kategori_detail, tahun, tag, aktif, ext) values ('$id','$id_karyawan','$judul','$jenis','$id_kategori_detail','$tahun','$tag','$aktif','$ext')");
	}

	function update_file($id_edit, $id_karyawan, $jenis, $tahun, $id_kategori_detail, $judul, $tag) {
		$this->db->query("Update erp_its_data set id_karyawan='$id_karyawan', jenis='$jenis', tahun='$tahun', id_kategori_detail='$id_kategori_detail', nama_file='$judul', tag='$tag' where id='$id_edit'");
	}

	function delete_file($id, $filename) {
		if (!unlink($filename)) {
		};

		$this->db->query("Delete from erp_its_data where id='$id'");
		$this->db->query("Delete from erp_its_note where id_data='$id'");
	}

	function ambil_file($id) {
		$dt = $this->db->query("Select ia.jenis, ib.kategori, ic.sub_kategori, ia.tahun from erp_its_data ia join erp_its_kategori_detail ic on ic.id=id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori where ia.id='$id'");

		$data = $dt->row_array();
		$jenis = $data['JENIS'];
		$kategori = $data['KATEGORI'];
		$sub_kategori = $data['SUB_KATEGORI'];
		$tahun = $data['TAHUN'];

		return $this->db->query("Select ia.id id_data, ia.ext, ia.jenis, ib.kategori, ic.sub_kategori, ia.tahun, ia.nama_file, ia.id id_data, ia.tag from erp_its_data ia join erp_its_kategori_detail ic on ic.id=id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
			where ia.aktif<>'0' and ia.jenis='$jenis' and ib.kategori='$kategori' and ic.sub_kategori='$sub_kategori' and ia.tahun='$tahun'");
	}

	function show_komen($id) {
		return $this->db->query("Select ha.nama, id.note, to_char(id.tgl,'DD-Mon-YY') tgl, to_char(id.tgl,'HH:MI') jam from erp_its_note id join erp_its_data ia on ia.id=id.id_data join erp_karyawan ha on ha.id=id.id_karyawan where id.aktif='1' and ia.id='$id' order by id.id desc");
	}

	function simpan_comment($id_data, $id_kary, $note) {
		$nmr = $this->db->query("Select max(id) as id from erp_its_note");
		$urut = $nmr->row_array();
		$id_note = $urut['ID'] + 1;
		$date = date_create(date('Y-m-d h:i:s'));
		$tgl = date_format($date, 'd-m-Y hh24:mi:ss');

		$this->db->query("Insert into erp_its_note values ('$id_note','$id_data','$id_kary',to_date('" . date('d/m/Y H:i:s') . "', 'dd/mm/yyyy hh24:mi:ss'),'$note','1')");
	}

	function approve($id_data) {
		$this->db->query("Update erp_its_data set aktif='2' where id='$id_data'");
	}

	function status($id_data, $status) {
		$this->db->query("Update erp_its_data set aktif='$status' where id='$id_data'");

		$query = $this->db->query("Select ia.id_kategori_detail, ia.jenis, ia.tahun, ib.kategori, ic.sub_kategori, ia.nama_file from erp_its_data ia join erp_its_kategori_detail ic on ic.id=ia.id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori where ia.id='$id_data'");
		$data = $query->row_array();
		$id_kategori_detail = $data['ID_KATEGORI_DETAIL'];
		$jenis = $data['JENIS'];
		$tahun = $data['TAHUN'];
		$ext = pathinfo($data['NAMA_FILE'], PATHINFO_EXTENSION);
		$filename = 'images/bank_data/' . $id_data . '.' . $ext;

		$query = $this->db->query("Select id from erp_its_data where id_kategori_detail='$id_kategori_detail' and jenis='$jenis' and tahun='$tahun' and aktif<>'0'");
		$data = $query->row_array();

		if ($status == 0) {
			if (!unlink($filename)) {
			};
		} // Hapus File

		return $data['ID'];
	}

	function cek_file($id_data) {
		$query = $this->db->query("Select aktif from erp_its_data where id='$id_data'");
		$data = $query->row_array();
		return $data['AKTIF'];
	}

	function buka_offline($id_data) {
		$query = $this->db->query("Select nama_file, ext from erp_its_data where id='$id_data'");
		$data = $query->row_array();
		return $data['NAMA_FILE'] . '.' . $data['EXT'];
	}

	function edit($id_data) {
		$query = $this->db->query("Select ia.id_karyawan, ia.jenis, ia.tahun, ib.kategori, ic.sub_kategori, ia.nama_file, ia.tag, ia.ext
			from erp_its_data ia join erp_its_kategori_detail ic on ic.id=ia.id_kategori_detail join erp_its_kategori ib on ib.id=ic.id_kategori
			where ia.id='$id_data'");
		return $query->row_array();
	}

}
