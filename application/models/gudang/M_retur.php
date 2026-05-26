<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_retur extends CI_Model
{

	function supplier() {
		return $this->db->query("Select * from erp_supplier where aktif<>0 order by nama");
	}

	function filter($tgl1, $tgl2, $supplier, $cari) {
		return $this->db->query("Select gm.id, to_char(gl.tgl,'dd-mm-yyyy') tgl, gl.nmr, pe.nama supplier, pa.nomer po, pc.nama, pc.spesifikasi, gm.kode, pc.satuan, gm.qty, gl.penerima, gl.no_kend
			from erp_gdg_retur gl join erp_gdg_retur_detail gm on gm.id_gdg_retur=gl.id join erp_supplier pe on pe.id=gl.id_supplier join erp_po_detail pb on pb.id=gm.id_po_detail join erp_po pa on pa.id=pb.id_po join erp_barang pc on pc.id=gm.id_barang
			where to_char(gl.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and upper(gl.nmr) like '%$cari%' and (case when '$supplier'='' then '' else upper(pe.nama) end) like '%$supplier%'
			order by gl.tgl desc, gm.kode");
	}

	function auto_no($id_detail, $tahun, $bln_romawi) {
		if ($id_detail != '') {
			$query = $this->db->query("Select substr(nmr,0,3) nmr, to_char(tgl,'YYYY') tahun from erp_gdg_retur where id=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
			$data = $query->row_array();
			if ($tahun == $data['TAHUN']) {
				return $data['NMR'] . '/PNP-HLG/GD2/' . $bln_romawi . '/' . $tahun;
			}
		}

		$query = $this->db->query("Select max(substr(nmr,0,3)) urut from erp_gdg_retur where to_char(tgl,'YYYY')='$tahun'");
		$data = $query->row_array();
		return sprintf('%03d', $data['URUT'] + 1) . '/PNP-HLG/GD2/' . $bln_romawi . '/' . $tahun;
	}

	function data_retur() {
		$query = $this->db->query("Select distinct di.id id_prod_retur_detail, pc.id id_barang, ga.id_po_detail, pc.nama, pc.spesifikasi, dc.kode, pc.satuan, dc.reject, dh.nmr ba
			from erp_prod_retur dh join erp_prod_retur_detail di on di.id_prod_retur=dh.id join erp_prod_pet_detail dc on dc.id=di.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_barang pc on pc.id=ca.id_barang join erp_prod_pet_detail_terima dd on dd.id_prod_pet_detail=dc.id join erp_penerimaan_detail gb on gb.id_detail_terima=dd.id_detail_terima join erp_penerimaan ga on ga.id_terima=gb.id_terima
			where di.status='2' and
			(select count(id) from erp_gdg_prod_retur where id_prod_retur_detail=di.id)=0
			order by dc.kode");
		return $query->result_array();
	}

	function cek_nmr($id_detail,$urut,$tahun) {
		$query = $this->db->query("Select * from erp_gdg_retur where substr(nmr,0,3)='$urut' and to_char(tgl,'YYYY')='$tahun' and id<>(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
		return $query->num_rows();
	}

	function hapus($id_detail) {
		$query = $this->db->query("Select id from erp_gdg_retur_detail where id_gdg_retur=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
		foreach($query->result_array() as $dt){
			$id = $dt['ID'];
			$this->db->query("Delete from erp_gdg_prod_retur where id_gdg_retur_detail='$id'");	
		}

		$this->db->query("Delete from erp_gdg_retur where id=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
		$this->db->query("Delete from erp_gdg_retur_detail where id_gdg_retur=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_retur");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function id_karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function simpan($urut, $tgl, $nmr, $id_supplier, $no_kend, $id_karyawan, $penerima) {
		$this->db->query("Insert into erp_gdg_retur(id, tgl, nmr, no_kend, id_supplier, id_karyawan, penerima) values('$urut','$tgl','$nmr','$no_kend','$id_supplier','$id_karyawan','$penerima')");
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_retur_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($urut_detail, $urut, $id_barang, $id_po_detail, $kode, $qty, $satuan) {
		$this->db->query("Insert into erp_gdg_retur_detail(id, id_gdg_retur, id_barang, id_po_detail, kode, qty, satuan, status) values('$urut_detail','$urut','$id_barang','$id_po_detail','$kode','$qty','$satuan','1')");
	}

	function urut_detail_retur() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_prod_retur");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail_retur($urut_detail_retur, $urut_detail, $id_prod_retur_detail) {
		$this->db->query("Insert into erp_gdg_prod_retur(id, id_gdg_retur_detail, id_prod_retur_detail) values('$urut_detail_retur','$urut_detail','$id_prod_retur_detail')");
	}

	function edit($id_detail) {
		$query = $this->db->query("Select distinct substr(gl.nmr,0,3) nmr, substr(gl.nmr,4,length(nmr)) nmr_trans, gl.tgl, pe.nama supplier, pe.alamat, gl.no_kend, gl.penerima, gn.id_prod_retur_detail, gm.id_barang, gm.id_po_detail, pc.nama, pc.spesifikasi, gm.kode, gm.satuan, gm.qty
			from erp_gdg_retur gl join erp_gdg_retur_detail gm on gm.id_gdg_retur=gl.id join erp_supplier pe on pe.id=gl.id_supplier join erp_gdg_prod_retur gn on gn.id_gdg_retur_detail=gm.id join erp_barang pc on pc.id=gm.id_barang where gm.id_gdg_retur=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
		return $query->result_array();
	}

	function batal($id_detail) {
		$query = $this->db->query("Select * from erp_gdg_retur_detail where id_gdg_retur=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");
		if ($query->num_rows() == 1) {
			$this->db->query("Delete from erp_gdg_retur where id=(select id_gdg_retur from erp_gdg_retur_detail where id='$id_detail')");			
		}
		$this->db->query("Delete from erp_gdg_retur_detail where id='$id_detail'");	
		$this->db->query("Delete from erp_gdg_prod_retur where id_gdg_retur_detail='$id_detail'");	
	}

}
