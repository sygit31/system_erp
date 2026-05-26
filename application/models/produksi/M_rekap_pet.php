<?php
class M_rekap_pet extends CI_Model {

	function periode($desain) {
		$query = $this->db->query("Select distinct to_char(gj.tanggal, 'Mon-YYYY') periode, to_char(gj.tanggal, 'YYMM') tgl
			from erp_ipb gj join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk
			where cj.desain='$desain'
			order by to_char(gj.tanggal, 'YYMM')");
		$data = $query->result_array();
		return $data;
	}

	function filter($desain) {
		$query = $this->db->query("Select distinct to_char(gj.tanggal, 'Mon-YYYY') bln, cj.seri, to_char(gj.tanggal, 'YYMM') tgl,
			(select sum(gb2.qty_terima) from erp_penerimaan_detail gb2 join erp_ipb_detail gk2 on gk2.id_detail_terima=gb2.id_detail_terima join
			erp_ipb gj2 on gj2.id=gk2.id_ipb join erp_kk_detail ck2 on ck2.id=gj2.id_kk_detail join erp_kk cj2 on cj2.id=ck2.id_kk
			where cj2.seri=cj.seri and to_char(gj2.tanggal, 'Mon-YYYY')=to_char(gj.tanggal, 'Mon-YYYY') and cj2.desain=cj.desain) qty
			from erp_ipb gj join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk
			where cj.desain='$desain'
			order by to_char(gj.tanggal, 'YYMM'), cj.seri");
		$data = $query->result_array();
		return $data;
	}

}
