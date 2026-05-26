<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pembelian extends CI_Model {

	function show_material() {
		return $this->db->query("Select pc.*, ca.nama rekening from erp_barang pc left join erp_cc_rekening ca on ca.no_rekjurnal=pc.no_rekjurnal where pc.aktif=1 and pc.jenis not like '%WIP%' and pc.jenis not like '%FG%' and pc.no_rekjurnal is not null order by pc.nama");
	}

	function filter($kategori,$jenis,$cari,$approved) {
		return $this->db->query("Select pc.*, ca.nama rekening from erp_barang pc left join erp_cc_rekening ca on ca.no_rekjurnal=pc.no_rekjurnal where pc.aktif='1' and
			(case when '$kategori'='All' then 'All' else pc.kategori end) like '$kategori' and 
			(case when '$jenis'='All' then 'All' else pc.jenis end) like '$jenis' and
			upper(pc.nama) like '%$cari%' and pc.jenis not like '%WIP%' and pc.jenis not like '%FG%' and (case when pc.no_rekjurnal is null then 'true' else 'false' end) like '$approved'
			order by pc.nama");
	}

	function show_rekjurnal() {
		return $this->db->query("Select * from erp_cc_rekening order by nama");
	}

	function show_bagian() {
		$id = $_SESSION['id_akun'];

		$data = $this->db->query("Select hb.nama bagian from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id join erp_akun aa on aa.id_karyawan=ha.id
			where aa.id='$id'");
		$bagian = $data->row_array();
		return $bagian['BAGIAN'];
	}

	function show_status() {
		$id_akun = $_SESSION['id_akun'];
		$query = $this->db->query("Select ab.status from erp_adm_akses ab where ab.id_akun='$id_akun' and ab.id_menu_detail='27'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function auto_no($jenis) {
		$query = $this->db->query("Select count(id) as id from erp_barang where substr(jenis,0,3) like '%$jenis%'");
		$data = $query->row_array();
		$id = $data['ID'] + 1;
		return sprintf('%04d',$id);
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_barang");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_material($id,$kode,$nama_material,$spesifikasi,$satuan,$min_stok,$kategori,$jenis,$tahun,$qc_test,$id_kary) {
		$this->db->query("Insert into erp_barang(ID, KODE, NAMA, SPESIFIKASI, SATUAN, MIN_STOK, TGL_INPUT, ID_INPUT, KATEGORI, JENIS, TAHUN, AKTIF, QC_TEST, UPDATED) values('$id','$kode','$nama_material','$spesifikasi','$satuan','$min_stok',sysdate,'$id_kary','$kategori','$jenis','$tahun','1','$qc_test',sysdate)");
	}

	function show_supplier() {
		$data = $this->db->query("Select pe.*, pf.* from erp_supplier pe join erp_supplier_term pf on pf.id_supplier=pe.id where pe.aktif='1' order by pe.nama");
		return $data;
	}

	function urut_supplier() {
		$nmr = $this->db->query("Select max(id) as id from erp_supplier");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_supplier($id_supplier,$kode,$nama,$alamat,$kota,$negara,$kode_pos,$phone,$fax,$email,$kontak,$title,$npwp,$klasifikasi,$id_input) {
		$this->db->query("Insert into erp_supplier values('$id_supplier','$kode','$nama','$alamat','$kota','$negara','$kode_pos','$phone','$fax','$email','$kontak','$title','$npwp',to_date('".date('d/m/Y H:i:s')."', 'dd/mm/yyyy hh24:mi:ss'),'$klasifikasi','$id_input','1')");
	}

	function update_supplier($id_supplier,$kode,$nama,$alamat,$kota,$negara,$kode_pos,$phone,$fax,$email,$kontak,$title,$npwp,$klasifikasi,$id_input) {
		$this->db->query("Update erp_supplier set kode='$kode', nama='$nama', alamat='$alamat', kota='$kota', country='$negara', kode_pos='$kode_pos', phone='$phone', fax='$fax', email='$email', contact='$kontak', contact_title='$title', no_npwp='$npwp', tgl_input=to_date('".date('d/m/Y H:i:s')."', 'dd/mm/yyyy hh24:mi:ss'), klasifikasi='$klasifikasi',id_input='$id_input',aktif='1' where id='$id_supplier'");
	}

	function urut_term() {
		$nmr = $this->db->query("Select max(id) as id from erp_supplier_term");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_term($id_term,$id_supplier,$cost,$route,$rekening) {
		$this->db->query("Insert into erp_supplier_term values('$id_term','$id_supplier','$cost','$route','$rekening')");
	}

	function update_term($id_term,$id_supplier,$cost,$route,$rekening) {
		$this->db->query("Update erp_supplier_term set id_supplier='$id_supplier', ship_cost='$cost', ship_route='$route', rekening='$rekening' where id='$id_term'");
	}

	function filter_supplier($klasifikasi,$cari) {
		$data = $this->db->query("Select pe.id id_supplier, pe.*, pf.* from erp_supplier pe join erp_supplier_term pf on pf.id_supplier=pe.id where pe.aktif='1' and (case when '$klasifikasi'='All' then 'All' else pe.klasifikasi end) like '$klasifikasi' and upper(pe.nama) like '%$cari%'
			order by pe.nama");
		return $data;
	}

	function hapus_supplier($id_supplier) {
		$this->db->query("Update erp_supplier set aktif='0' where id='$id_supplier'");
	}

	function get_supplier($id_supplier) {
		$data = $this->db->query("Select pe.id id_supplier, pe.*, pf.id id_term, pf.ship_cost, pf.ship_route, pf.rekening, 	pd.id id_material_supply, pd.lead_time, pd.harga, pd.mata_uang, pc.id id_material, pc.nama nama_barang, pc.spesifikasi, pc.satuan
			from erp_supplier pe join erp_supplier_term pf on pf.id_supplier=pe.id join erp_material_supply pd on pd.id_supplier=pe.id join erp_barang pc on pc.id=pd.id_barang
			where pe.aktif='1' and pd.aktif='1' and pe.id='$id_supplier' order by pe.nama, pc.nama");
		return $data->result_array();
	}

	function urut_material() {
		$nmr = $this->db->query("Select max(id) as id from erp_material_supply");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function non_aktif_material($id_supplier) {
		$this->db->query("Update erp_material_supply set aktif='0' where id_supplier='$id_supplier'");
	}

	function simpan_material_supply($id_material_supply,$id_supplier,$id_material,$lead_time,$harga,$mata_uang) {
		$this->db->query("Insert into erp_material_supply values('$id_material_supply','$id_supplier','$id_material','$lead_time','$harga','$mata_uang','1')");
	}

	function update_material($id_edit_material,$id_supplier,$id_material,$lead_time,$harga,$mata_uang) {
		$this->db->query("Update erp_material_supply set id_supplier='$id_supplier', id_barang='$id_material', lead_time='$lead_time', harga='$harga', mata_uang='$mata_uang', aktif='1' where id='$id_edit_material'");
	}

}
?>