<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_supplier extends CI_Model {

	function jenis() {
		return $this->db->query("Select * from erp_pemb_jenis order by id");
	}

	function supplier_sakti() {
		return $this->db->query("Select distinct kode, nama, telepon, email_keu, fax, cnt_person, npwp, alamat, kota, initcap(negara) negara, kode_pos from supplier_sakti where to_char(lastupd,'YY')>='23' or nama like 'KOP. KARYAWAN PURA GROUP%' order by nama");
	}

	function filter($cari, $jenis) {
		$data = $this->db->query("Select pe.*, pq.jenis from erp_supplier pe join erp_pemb_jenis pq on pq.id=pe.kode_jenis where pe.aktif='1' and upper(pe.nama) like '%$cari%' and (case when '$jenis'='ALL' then 'ALL' else to_char(pq.id) end)='$jenis' order by pe.nama");
		return $data;
	}

	function material() {
		return $this->db->query("Select * from erp_barang where aktif='1' order by nama");
	}

	function mata_uang() {
		return $this->db->query("Select * from erp_pemb_cur order by code_currency");
	}

	function supplier_simpg() {
		return $this->db->query("Select spl.kode, spl.nama, spl.alamat1, spl.kota, spl.telpon, spl.contact_person, spl.kode_keuangan
			from tbl_master_customer_suplier spl where spl.nama is not null and spl.kode_keuangan is not null and
			(select count(id) from erp_supplier where kode_simpg=spl.kode)=0
			order by nama");
	}

	function show_supplier() {
		$data = $this->db->query("Select pe.*, pq.jenis from erp_supplier pe join erp_pemb_jenis pq on pq.id=pe.kode_jenis where pe.aktif='1' order by pe.nama");
		return $data;
	}

	function show_material($id_supplier) {
		$query = $this->db->query("Select distinct pc.id, pc.kode, concat(pc.nama, pc.spesifikasi) nama, pc.satuan from erp_barang pc where pc.aktif=1 and pc.jenis<>'WIP - BAHAN WIP' and
			(Select count(id_barang) from erp_material_supply where id_barang=pc.id and (case when '$id_supplier'='' then '$id_supplier' else to_char(id_supplier) end)='$id_supplier')=0
			order by nama");
		return $query->result_array();
	}

	function urut_supplier_simpg() {
		$admin = $this->load->database('admin', TRUE);
		$query = $admin->query("Select max(kode)+1 as kode from tbl_master_customer_suplier");
		$data = $query->row_array();
		return sprintf('%08d', $data['KODE']);
	}

	function simpan_supplier_simpg($kode_simpg, $nickname, $nama, $alamat, $kota, $negara, $phone, $fax, $email, $kontak, $npwp, $kode_keuangan) {
		$admin = $this->load->database('admin', TRUE);
		$username = explode('|', $_SESSION['logERP']);
		$username = substr($username[1], 0, 10);

		$admin->query("Insert into tbl_master_customer_suplier(kode, kode_area, nickname, nama, alamat1, kota, negara, telpon, fax, contact_person, email_address, npwp, status_customer, username, lastupdate, kode_keuangan, tgl_input_supplier) values('$kode_simpg','2','$nickname','$nama','$alamat','$kota','$negara','$phone','$fax','$kontak','$email','$npwp','2','$username',sysdate,'$kode_keuangan',sysdate)");
	}

	function update_supplier_simpg($id_supplier, $nickname, $nama, $alamat, $kota, $negara, $phone, $fax, $email, $kontak, $npwp, $kode_keuangan) {
		$admin = $this->load->database('admin', TRUE);
		$username = explode('|', $_SESSION['logERP']);
		$username = substr($username[1], 0, 10);

		$query = $this->db->query("Select kode_simpg from erp_supplier where id='$id_supplier'");
		$data = $query->row_array();
		$kode = $data['KODE_SIMPG'];

		$admin->query("Update tbl_master_customer_suplier set nickname='$nickname', nama='$nama', alamat1='$alamat', kota='$kota', negara='$negara', telpon='$phone', fax='$fax', contact_person='$kontak', email_address='$email', npwp='$npwp', username='$username',lastupdate=sysdate,kode_keuangan='$kode_keuangan' where kode='$kode'");
	}

	function urut_supplier() {
		$nmr = $this->db->query("Select max(id) as id from erp_supplier");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_supplier($id_supplier, $kode, $nama, $alamat, $kota, $negara, $kode_pos, $phone, $fax, $email, $kontak, $title, $npwp, $id_input, $kode_keuangan, $rekening, $jenis, $kode_simpg) {
		$query = $this->db->query("Select count(id) as qty from erp_supplier where kode_simpg='$kode_simpg'");
		$data = $query->row_array();
		$qty = $data['QTY'];

		if ($qty == 0) {
			$this->db->query("Insert into erp_supplier(id, kode, nama, alamat, kota, country, kode_pos, phone, fax, email, contact, contact_title, no_npwp, tgl_input, klasifikasi, id_input, aktif, kode_keuangan, kode_simpg, rekening, kode_jenis) values('$id_supplier','$kode','$nama','$alamat','$kota','$negara','$kode_pos','$phone','$fax','$email','$kontak','$title','$npwp',sysdate,'','$id_input','1','$kode_keuangan','$kode_simpg','$rekening','$jenis')");
		}
	}

	function update_supplier($id_supplier, $kode, $nama, $alamat, $kota, $negara, $kode_pos, $phone, $fax, $email, $kontak, $title, $npwp, $id_input, $kode_keuangan, $rekening, $jenis) {
		$this->db->query("Update erp_supplier set kode='$kode', nama='$nama', alamat='$alamat', kota='$kota', country='$negara', kode_pos='$kode_pos', phone='$phone', fax='$fax', email='$email', contact='$kontak', contact_title='$title', no_npwp='$npwp', tgl_input=sysdate,id_input='$id_input',aktif='1',kode_keuangan='$kode_keuangan',rekening='$rekening',kode_jenis='$jenis' where id='$id_supplier'");
	}

	function urut_material() {
		$nmr = $this->db->query("Select max(id) as id from erp_material_supply");
		$urut = $nmr->row_array();
		return $urut['ID'] + 1;
	}

	function edit_material($id_supplier,$id_material) {
		$query = $this->db->query("Select id from erp_material_supply where id_supplier='$id_supplier' and id_barang='$id_material' and aktif='1'");
		$data = $query->row_array();
		return $data['ID'];
	}

	function simpan_material($id_material_supply, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity) {
		$this->db->query("Insert into erp_material_supply values('$id_material_supply','$id_supplier','$id_material','$lead_time','$harga','$mata_uang','1','$moq','$capacity')");
	}

	function update_material($id_edit_material, $id_supplier, $id_material, $lead_time, $harga, $mata_uang, $moq, $capacity) {
		$this->db->query("Update erp_material_supply set id_supplier='$id_supplier', id_barang='$id_material', lead_time='$lead_time', harga='$harga', mata_uang='$mata_uang', moq='$moq', capacity='$capacity', aktif='1' where id='$id_edit_material'");
	}

	function get_supplier($id_supplier) {
		$data = $this->db->query("Select distinct pe.nama nama_supplier, pe.kode, pe.alamat, pe.phone, pe.fax, pe.kota, pe.kode_pos, pe.country, pe.contact, pe.contact_title, pe.email, pe.no_npwp, pe.rekening, pq.jenis, pc.id id_material, pc.kode kode_barang, pc.nama nama_barang, pc.satuan, pc.spesifikasi, pd.lead_time, pd.harga, pd.mata_uang, pd.moq, pd.capacity, pd.id id_material_supply, pe.kode_keuangan, pq.jenis, pe.kode_jenis
			from erp_supplier pe left join erp_material_supply pd on pd.id_supplier=pe.id left join erp_barang pc on pc.id=pd.id_barang join erp_pemb_jenis pq on pq.id=pe.kode_jenis
			where pe.aktif='1' and (case when pd.aktif is null then '1' else pd.aktif end)='1' and pe.id='$id_supplier' order by pe.nama, pc.nama");
		return $data->result_array();
	}

	function hapus_supplier($id_supplier) {
		$this->db->query("Update erp_supplier set aktif='0' where id='$id_supplier'");
		$this->db->query("Update erp_material_supply set aktif='0' where id_supplier='$id_supplier'");
	}

	function ambil_simpg($kode) {
		$query = $this->db->query("Select * from tbl_master_customer_suplier where kode='$kode'");
		return $query->row_array();
	}
}
