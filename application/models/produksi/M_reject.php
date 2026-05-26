<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_reject extends CI_Model
{
	function karyawan_produksi() {
		return $this->db->query("Select * from erp_karyawan where (id_bagian='24' or id_bagian='25') and id_jabatan='11' and status<>0 and tgl_keluar is null order by nama");
	}

	function karyawan_qc() {
		return $this->db->query("Select ha.id, upper(ha.nama) nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.trans='Pengawas QC' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by upper(ha.nama)");
	}

	function karyawan_gudang() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.trans='Receive IPB Bahan Pembantu' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null order by ha.nama");
	}

	function akses() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];

		$query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun where aa.id_karyawan='$id_kary' and ab.id_menu_detail='151'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order where length(desain)=4 order by desain desc");
	}

	function filter($tgl1, $tgl2, $cari, $desain) {
		$akses = $this->akses();
		$status = '1';

		return $this->db->query("Select distinct di.id, to_char(dh.tgl, 'DD-MM-YYYY') tgl, dh.tgl tgl2, dh.nmr, ca.keterangan_penggunaan kk, pc.nama, pc.spesifikasi, gb.kode_roll, gb.qty_terima, dc.reject, pc.satuan, di.status,
			(select count(id) from erp_gdg_prod_retur where id_prod_retur_detail=di.id) qty
			from erp_prod_retur dh join erp_prod_retur_detail di on di.id_prod_retur=dh.id join erp_prod_pet_detail dc on dc.id=di.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet join erp_prod_pet_detail_terima dd on dd.id_prod_pet_detail=dc.id join erp_penerimaan_detail gb on gb.id_detail_terima=dd.id_detail_terima join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_barang pc on pc.id=ca.id_barang
			where to_char(dh.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and upper(gb.kode_roll) like '%$cari%' and ca.desain='$desain'
			order by dh.tgl desc, di.id");
	}

	function auto_no($id_detail, $tahun, $bln_romawi) {
		if ($id_detail != '') {
			$query = $this->db->query("Select nmr, to_char(tgl,'YYYY') tahun from erp_prod_retur where id=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");
			$data = $query->row_array();
			if ($tahun == $data['TAHUN']) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(substr(nmr,0,3)) urut from erp_prod_retur where desain='$tahun'");
		$data = $query->row_array();
		return sprintf('%03d', $data['URUT'] + 1) . '/PNP-HLG/EMB-COAT-SLITTER/' . $tahun;
	}

	function data_reject($desain) {
		$query = $this->db->query("Select distinct dc.id, pc.nama, ca.keterangan_penggunaan kk, dc.kode, dc.panjang, dc.reject
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses join erp_barang pc on pc.id=ca.id_barang
			where ca.desain='$desain' and dc.reject>0 and da.proses='Emboss' and substr(ca.keterangan_penggunaan,-4)>'2020' and
			(select count(id) from erp_prod_retur_detail where id_prod_pet_detail=dc.id)=0");
		return $query->result_array();
	}

	function hapus($id_detail) {
		$this->db->query("Delete from erp_prod_retur where id=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");
		$this->db->query("Delete from erp_prod_retur_detail where id_prod_retur=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_prod_retur");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($urut, $tgl, $nmr, $id_dibuat, $id_disetujui, $id_diterima, $desain) {
		$this->db->query("Insert into erp_prod_retur(id, tgl, nmr, dibuat, disetujui, diterima, desain) values('$urut', '$tgl', '$nmr', '$id_dibuat', '$id_disetujui', '$id_diterima', '$desain')");
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_prod_retur_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($urut_detail, $urut, $id_prod_pet_detail) {
		$this->db->query("Insert into erp_prod_retur_detail(id, id_prod_retur, id_prod_pet_detail, status) values('$urut_detail','$urut','$id_prod_pet_detail','1')");
	}

	function edit($id_detail) {
		$query = $this->db->query("Select dh.nmr, dh.tgl, di.id_prod_pet_detail, pc.nama, ca.keterangan_penggunaan kk, dc.kode, dc.panjang, dc.reject, ca.seri, dc.panjang, dc.hasil, dc.reject, dh.desain,
			(select upper(nama) from erp_karyawan where id=dh.dibuat) dibuat,
			(select upper(nama) from erp_karyawan where id=dh.disetujui) disetujui,
			(select upper(nama) from erp_karyawan where id=dh.diterima) diterima
			from erp_prod_pet db join erp_prod_pet_detail dc on dc.id_prod_pet=db.id join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_barang pc on pc.id=ca.id_barang join erp_prod_retur_detail di on di.id_prod_pet_detail=dc.id join erp_prod_retur dh on di.id_prod_retur=dh.id
			where dh.id=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");
		return $query->result_array();
	}

	function batal($id_detail) {
		$query = $this->db->query("Select * from erp_prod_retur_detail where id_prod_retur=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");
		if ($query->num_rows() == 1) {
			$this->db->query("Delete from erp_prod_retur where id=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");			
		}
		$this->db->query("Delete from erp_prod_retur_detail where id='$id_detail'");	
	}

	function approve($id_detail) {
		$query = $this->db->query("Update erp_prod_retur_detail set status='2' where id_prod_retur=(select id_prod_retur from erp_prod_retur_detail where id='$id_detail')");	
	}

}
