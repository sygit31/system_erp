<?php 
class M_rfq extends CI_Model {

	function show_rfq() {
		$tgl1 = date('d-m-Y', strtotime('-30 days'));
		$tgl2 = date('d-m-Y', strtotime('-0 days'));
		return $this->db->query("Select pg.id id_rfq, pg.nmr, pg.tgl, pg.deadline, pe.nama nama_supplier, pc.nama nama_material, pc.spesifikasi, pc.satuan, pg.qty, pg.deltime, pg.storage
			from erp_pemb_rfq pg join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where pg.tgl between '$tgl1' and '$tgl2' and pg.aktif='1' order by pg.tgl desc, pe.nama");
	}

	function filter_rfq($tgl1,$tgl2,$cari_material,$cari_supplier) {
		return $this->db->query("Select pg.id id_rfq, pg.nmr, pg.tgl, pg.deadline, pe.nama nama_supplier, pc.nama nama_material, pc.spesifikasi, pc.satuan, pg.qty, pg.deltime, pg.storage
			from erp_pemb_rfq pg join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where pg.aktif='1' and pg.tgl between '$tgl1' and '$tgl2' and upper(pc.nama) like '%$cari_material%' and upper(pe.nama) like '%$cari_supplier%'
			order by pg.tgl desc, pe.nama");
	}

	function show_supplier() {
		return $this->db->query("Select * from erp_supplier");
	}

	function show_barang() {
		return $this->db->query("Select * from erp_barang");
	}

	function auto_no($tahun) {
		$query = $this->db->query("Select max(substr(nmr,-3)) nmr from erp_pemb_rfq where to_char(tgl,'yy')='$tahun'");
		$dt = $query->row_array();
		return $dt['NMR'] + 1;
	}

	function urut_rfq() {
		$query = $this->db->query("Select max(id) id from erp_pemb_rfq");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_rfq($id_rfq,$nmr,$tgl,$deadline,$id_supplier,$deltime,$id_material,$qty,$storage,$id_rfq) {
		$this->db->query("Insert into erp_pemb_rfq values('$id_rfq','$nmr','$tgl','$deadline','$id_supplier','$id_material','$qty','$deltime','$storage','1')");
	}

	function update_rfq($id_rfq,$nmr,$tgl,$deadline,$id_supplier,$deltime,$id_material,$qty,$storage,$id_rfq) {
		$this->db->query("Update erp_pemb_rfq set nmr='$nmr',tgl='$tgl',deadline='$deadline',id_supplier='$id_supplier',id_material='$id_material',qty='$qty',deltime='$deltime',storage='$storage' where id='$id_rfq'");
	}

	function hapus_rfq($id_hapus_rfq) {
		$data = $this->db->query("Update erp_pemb_rfq set aktif='0' where id='$id_hapus_rfq'");
	}

}
?>