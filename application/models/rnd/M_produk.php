<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_produk extends CI_Model {

	function id_location() {
		return '3';
	}

	function show_produk() {
		$id_location = $this->id_location();
		return $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi, pc.kode, pc.ukuran, pc.tahun
			from erp_barang pc
			where pc.aktif='1' and pc.jenis='WIP - BAHAN WIP'
			order by pc.tahun desc, pc.nama");
	}

	function filter_produk($jenis,$cari) {
		$id_location = $this->id_location();

		return $this->db->query("Select pc.id, pc.kode, substr(pc.kode,0,1) jenis, pc.nama, pc.spesifikasi deskripsi, pc.satuan, pc.ukuran from erp_barang pc
			where pc.aktif<>'0' and pc.jenis='WIP - BAHAN WIP' and substr(pc.kode,0,1) like '%$jenis' and upper(pc.nama) like '%$cari%'
			order by pc.jenis, pc.nama");
	}

	function auto_kode($jenis) {
		$id_location = $this->id_location();

		$nmr = $this->db->query("Select max(substr(kode,-4)) as kode from erp_barang where substr(kode,0,1)='$jenis' and jenis='WIP - BAHAN WIP'");
		$kode = $nmr->row_array();
		return sprintf("%'04d\n", $kode['KODE'] + 1);
	}

	function simpan_produk($id_edit,$kode,$jenis,$nama,$deskripsi,$satuan,$ukuran) {
		$id_location = $this->id_location();
		$tahun = date('Y');

		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];

		if ($id_edit == '') {
			$query = $this->db->query("Select max(id) as id from erp_barang");
			$urut = $query->row_array();
			$id = $urut['ID'] + 1;
			
			$this->db->query("Insert into erp_barang (id, kode, nama, spesifikasi, ukuran, satuan, min_stok, tgl_input, id_input, kategori, jenis, tahun, aktif, qc_test, updated, updated_status) values ('$id','$kode','$nama','$deskripsi','$ukuran','$satuan','0',sysdate,'$id_kary','PRODUKSI','WIP - BAHAN WIP','$tahun','1','0',sysdate,'1')");
		}else{
			$this->db->query("Update erp_barang set kode='$kode', nama='$nama', spesifikasi='$deskripsi', satuan='$satuan', ukuran='$ukuran', updated=sysdate, updated_status='1' where id='$id_edit'");
		}
	}

	function hapus($id_hapus) {
		$this->db->query("Update erp_barang set aktif='0', updated_status='1' where id='$id_hapus'");
	}

}