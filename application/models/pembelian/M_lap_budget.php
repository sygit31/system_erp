<?php 
class M_lap_budget extends CI_Model {

	function show_budget() {
		$query = $this->db->query("Select distinct ha.nama, cg.id id_budget, cg.tgl_submit, cg.nmr,
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id) status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id) qty_status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id and approval_status='0') reject_status,
			(Select replace(sum(replace(budget_beli,'.',',') * harga),',','.') from erp_ppic_budget_detail where id_budget=cg.id) total
			from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan_submit join erp_ppic_budget_app ch on ch.id_budget=cg.id
			where
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id)=(Select count(id) from erp_ppic_budget_app where id_budget=cg.id)
			");
		return $query;		
	}

	function filter_budget($periode) {
		$query = $this->db->query("Select distinct ha.nama, cg.id id_budget, cg.tgl_submit, cg.nmr,
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id) status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id) qty_status,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id and approval_status='0') reject_status,
			(Select replace(sum(replace(budget_beli,'.',',') * harga),',','.') from erp_ppic_budget_detail where id_budget=cg.id) total
			from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_karyawan_submit join erp_ppic_budget_app ch on ch.id_budget=cg.id
			where ch.approval_status='1' and (case when '$periode'='All' then 'All' else to_char(cg.tgl_submit,'MM/YYYY') end)='$periode' and
			(Select sum(approval_status) from erp_ppic_budget_app where id_budget=cg.id)=(Select count(id) from erp_ppic_budget_app where id_budget=cg.id)");
		return $query;		
	}

}
?>