<?php 
class M_submit extends CI_Model {

	function show_submit() {
		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];

		$query = $this->db->query("Select hb.nama bagian, ha.nama, cg.id id_budget, to_char(cg.tgl_submit,'DD-MM-YYYY') tgl_submit, ch.approval_status, to_char(ch.tgl_approval,'DD-MM-YYYY') tgl_approval, cg.nmr,
			(Select count(id) from erp_ppic_budget_app where id_budget=cg.id and approval_status='0') reject_status,
			(Select replace(sum(budget_beli * harga),',','.') from erp_ppic_budget_detail where id_budget=cg.id) total
			from erp_ppic_budget cg join erp_karyawan ha on ha.id=cg.id_kary join erp_ppic_budget_app ch on ch.id_budget=cg.id join erp_karyawan ha2 on ha2.id=ch.id_kary join erp_bagian hb on hb.id=ha.id_bagian
			where ha2.id='$id_kary'");
		return $query->result_array();		
	}

	function show_budget($id_budget) {
		$query = $this->db->query("Select pc.nama nama_material, pc.satuan, ci.kebutuhan, ci.safety_stock, ci.saldo, ci.moq, ci.outstanding, replace(ci.budget_beli,',','.') budget_beli, ci.harga, ci.mata_uang
			from erp_ppic_budget cg join erp_ppic_budget_detail ci on cg.id=ci.id_budget join erp_barang pc on pc.id=ci.id_barang
			where cg.id='$id_budget'
			order by pc.nama");
		return $query->result_array();
	}

	function simpan_approval($id_budget,$status) {
		$kary = explode('|',$_SESSION['logERP']);
		$id_kary = $kary[0];

		$this->db->query("Update erp_ppic_budget_app set approval_status='$status', tgl_approval=sysdate where id_budget='$id_budget' and id_kary='$id_kary'");
	}

}
?>