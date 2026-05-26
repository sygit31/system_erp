<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pet extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)='4' order by desain desc");
	}

	function material() {
		return $this->db->query("Select id, nama, spesifikasi from erp_barang where flag_penggunaan='CONTINUE' order by nama");
	}

	function id_barang($desain) {
		$query = $this->db->query("Select xmlagg(xmlelement(e,id_barang||',')).extract('//text()') id_barang from erp_lap_pet where desain='$desain' and status='1'");
		$data = $query->row_array()['ID_BARANG'];
		$id_barang = substr($data, 0, strlen($data)-1);
		return implode("','", explode(',', $id_barang)) ;
	}

	function saldo_awal($tgl1, $id_barang) {
		$query = $this->db->query("Select nvl(sum(saldo),0) saldo, nvl(count(saldo),0) qty from erp_gdg_saldo where id_barang in ('" . $id_barang . "') and to_char(tgl,'YYMMDD')<'$tgl1' order by tgl desc");
		$data = $query->row_array();
		return array($data['SALDO'],$data['QTY']);
	}


	function saldo_masuk($tgl1, $id_barang) {
		$query = $this->db->query("Select nvl(sum(gb.qty_terima),0) terima, nvl(count(gb.qty_terima),0) qty from erp_penerimaan ga join erp_penerimaan_detail gb on gb.id_terima=ga.id_terima join erp_po_detail pb on pb.id=ga.id_po_detail join erp_material_supply pd on pd.id=pb.id_material_supply where pd.id_barang in ('" . $id_barang . "') and (gb.status_qc='T_OK' or gb.status_qc='OUT') and to_char(ga.tgl_terima,'YYMMDD')<'$tgl1'");
		$data = $query->row_array();
		return array($data['TERIMA'],$data['QTY']);
	}

	function saldo_keluar($tgl1, $id_barang) {
		$query = $this->db->query("Select nvl(sum(gb.qty_terima),0) keluar, nvl(count(gb.qty_terima),0) qty
			from erp_ipb go join erp_ipb_detail gp on gp.id_ipb=go.id join erp_penerimaan_detail gb on gb.id_detail_terima=gp.id_detail_terima join erp_kk_detail ck on ck.id=go.id_kk_detail join erp_kk cj on cj.id=ck.id_kk 
			where ck.id_bahan_baku in ('" . $id_barang . "') and to_char(go.tanggal,'YYMMDD')<'$tgl1' and gp.status='CLOSE'");
		$data = $query->row_array();
		return array($data['KELUAR'],$data['QTY']);
	}

	function masuk($tgl1, $tgl2, $id_barang) {
		$query = $this->db->query("Select to_char(ga.tgl_terima, 'YYMMDD') tgl_terima, gb.qty_terima,
			(select xmlagg(xmlelement(e,no_sp||', ')).extract('//text()') from (select distinct ga2.no_sp, ga2.tgl_terima from erp_penerimaan_detail gb2 join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang in ('" . $id_barang . "')) where to_char(tgl_terima,'YYMMDD')=to_char(ga.tgl_terima, 'YYMMDD')) sp
			from erp_penerimaan ga join erp_penerimaan_detail gb on gb.id_terima=ga.id_terima join erp_po_detail pb on pb.id=ga.id_po_detail join erp_material_supply pd on pd.id=pb.id_material_supply
			where pd.id_barang in ('" . $id_barang . "') and (gb.status_qc='T_OK' or gb.status_qc='BOOKING' or gb.status_qc='OUT') and to_char(ga.tgl_terima,'YYMMDD') between '$tgl1' and '$tgl2'");
		return $query->result_array();
	}

	function keluar($tgl1, $tgl2, $id_barang) {
		$query = $this->db->query("Select to_char(gj.tanggal, 'YYMMDD') tgl_keluar, gb.qty_terima, cj.seri,
			(select xmlagg(xmlelement(e,nomer||', ')).extract('//text()') from (select distinct substr(gj2.nomer,0,3) nomer, gj2.tanggal from erp_ipb gj2 join erp_ipb_detail gk2 on gk2.id_ipb=gj2.id join erp_penerimaan_detail gb2 on gb2.id_detail_terima=gk2.id_detail_terima join erp_penerimaan ga2 on ga2.id_terima=gb2.id_terima join erp_po_detail pb2 on pb2.id=ga2.id_po_detail join erp_material_supply pd2 on pd2.id=pb2.id_material_supply where pd2.id_barang in ('" . $id_barang . "')) where to_char(tanggal,'YYMMDD')=to_char(gj.tanggal, 'YYMMDD')) ipb
			from erp_ipb gj join erp_ipb_detail gk on gk.id_ipb=gj.id join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_penerimaan_detail gb on gb.id_detail_terima=gk.id_detail_terima join erp_kk cj on cj.id=ck.id_kk
			where ck.id_bahan_baku in ('" . $id_barang . "') and to_char(gj.tanggal,'YYMMDD') between '$tgl1' and '$tgl2' and gk.status='CLOSE'");
		return $query->result_array();
	}

	function retur_produksi($tgl1, $tgl2, $id_barang) {
		$query = $this->db->query("Select to_char(dh.tgl, 'YYMMDD') tgl, dc.reject, dh.nmr
			from erp_prod_pet_detail dc join erp_prod_retur_detail di on di.id_prod_pet_detail=dc.id join erp_prod_retur dh on dh.id=di.id_prod_retur join erp_prod_pet_detail_terima dd on dd.id_prod_pet_detail=di.id_prod_pet_detail join erp_penerimaan_detail gb on gb.id_detail_terima=dd.id_detail_terima join erp_penerimaan ga on ga.id_terima=gb.id_terima join erp_po_detail pb on pb.id=ga.id_po_detail join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail
			where cf.id_barang in ('" . $id_barang . "') and to_char(dh.tgl,'YYMMDD') between '$tgl1' and '$tgl2'");
		return $query->result_array();
	}

	function retur_suppplier($tgl1, $tgl2, $id_barang) {
		$query = $this->db->query("Select to_char(gl.tgl, 'YYMMDD') tgl, gm.qty, substr(gl.nmr,0,3) nmr
			from erp_gdg_retur gl join erp_gdg_retur_detail gm on gm.id_gdg_retur=gl.id join erp_po_detail pb on pb.id=gm.id_po_detail join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail
			where to_char(gl.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and cf.id_barang in ('" . $id_barang . "')");
		return $query->result_array();
	}
}
