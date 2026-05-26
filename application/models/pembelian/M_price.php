<?php 
class M_price extends CI_Model {

	function show_price() {
		return $this->db->query("Select ph.id id_price, pc.nama nama_material, pc.satuan, ph.nmr no_quotation, pe.nama nama_supplier, ph.net_price, ph.mata_uang, ph.deltime net_deltime
			from erp_pemb_price ph join erp_pemb_rfq pg on pg.id=ph.id_rfq join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where pg.aktif='1' and ph.aktif='1' order by pc.nama, pe.nama");
	}

	function show_rfq() {
		return $this->db->query("Select pg.id id_rfq, pg.nmr, pg.tgl, pg.deadline, pe.nama nama_supplier, pc.nama nama_material, pc.spesifikasi, pc.satuan, pg.qty, pg.deltime, pg.storage
			from erp_pemb_rfq pg join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where (select count(id_rfq) id from erp_pemb_price where id_rfq=pg.id and aktif='1')='0'
			order by pe.nama");
	}

	function filter_price($cari_material) {
		return $this->db->query("Select pg.id id_rfq, ph.id id_price, pc.nama nama_material, pc.satuan, ph.nmr no_quotation, pe.nama nama_supplier, ph.net_price, ph.mata_uang, ph.deltime net_deltime
			from erp_pemb_price ph join erp_pemb_rfq pg on pg.id=ph.id_rfq join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where pg.aktif='1' and ph.aktif='1' and upper(pc.nama) like '%$cari_material%'
			order by pc.nama, pe.nama");
	}

	function urut_price() {
		$query = $this->db->query("Select max(id) id from erp_pemb_price");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_price($id_price,$id_rfq,$no_quotation,$net_price,$mata_uang,$deltime) {
		$this->db->query("Insert into erp_pemb_price values('$id_price','$id_rfq','$no_quotation','$net_price','$mata_uang','$deltime','1')");
	}

	function update_price($id_price,$id_rfq,$no_quotation,$net_price,$mata_uang,$deltime) {
		$this->db->query("Update erp_pemb_price set id_rfq='$id_rfq',nmr='$no_quotation',net_price='$net_price',mata_uang='$mata_uang',deltime='$deltime' where id='$id_price'");
	}

	function hapus_price($id_hapus_price) {
		$data = $this->db->query("Update erp_pemb_price set aktif='0' where id='$id_hapus_price'");
	}

	function edit_price($id_price) {
		$query = $this->db->query("Select ph.id id_price, ph.id_rfq, pg.nmr no_rfq, pe.nama nama_supplier, pc.nama nama_material, pc.spesifikasi, pc.satuan, ph.nmr no_quotation, ph.net_price, ph.mata_uang, ph.deltime net_deltime
			from erp_pemb_price ph join erp_pemb_rfq pg on pg.id=ph.id_rfq join erp_barang pc on pc.id=pg.id_material join erp_supplier pe on pe.id=pg.id_supplier
			where ph.id='$id_price'");
		return $query->row_array();
	}

}
?>