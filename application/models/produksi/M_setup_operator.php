<?php
class M_setup_operator extends CI_Model {

	function kode_flow() {
		return $this->db->query("Select distinct kode from erp_station_flow where active_flow_holo='Y' order by kode");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)='4' order by desain");
	}

	function proses() {
		return $this->db->query("Select distinct proses from erp_prod_proses order by proses");
		return $this->db->query("Select distinct rf.nama proses, re.urut from erp_station rf join erp_station_flow re on re.id_station=rf.id where re.active_flow_holo='Y' order by re.urut");
	}

	function operator() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' order by ha.nama");
	}

	function mesin($proses) {
		$query = $this->db->query("Select distinct ta.nama_mesin from erp_tek_mesin ta join erp_rnd_proses rb on rb.id_mesin=ta.id join erp_station rf on rf.id=rb.id_station
			where rf.nama='$proses' order by ta.nama_mesin");
		$data = $query->result_array();
		return $data;
	}

	function filter($desain, $proses) {
		return $this->db->query("Select distinct dg.id, da.desain, da.proses, da.nama_mesin, da.shift, ha.nama operator,
			(select count(id) from erp_prod_pet where id_prod_proses=da.id) qty_proses,
			(select count(id) from erp_prod_downtime where id_prod_proses=da.id) qty_downtime
			from erp_prod_proses da join erp_prod_proses_detail dg on dg.id_prod_proses=da.id join erp_karyawan ha on ha.id=dg.id_operator
			where da.desain='$desain' and (case when '$proses'='All..' then 'All..' else da.proses end)='$proses' and da.aktif='1' and dg.aktif='1'
			order by da.proses, da.nama_mesin, da.shift");
	}

	function urut_proses($desain, $proses, $mesin, $shift) {
		$query = $this->db->query("Select id from erp_prod_proses where desain='$desain' and proses='$proses' and nama_mesin='$mesin' and shift='$shift'");
		if ($query->num_rows() > 0) {
			$data = $query->row_array();
			return $data['ID'];
		}else{
			$query = $this->db->query("Select max(id) urut from erp_prod_proses");
			$data = $query->row_array();
			$id_prod_proses = $data['URUT'] + 1;

			$this->db->query("Insert into erp_prod_proses(id, desain, proses, nama_mesin, shift, aktif) values('$id_prod_proses','$desain','$proses','$mesin','$shift','1')");
			return $id_prod_proses;
		}
	}

	function urut_proses_detail() {
		$query = $this->db->query("Select max(id) urut from erp_prod_proses_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id_prod_proses_detail, $id_prod_proses, $id_operator) {
		$this->db->query("Insert into erp_prod_proses_detail(id, id_prod_proses, id_operator, updated, aktif) values('$id_prod_proses_detail','$id_prod_proses','$id_operator',sysdate,'1')");
	}

	function update($id_edit, $id_operator) {
		$this->db->query("Update erp_prod_proses_detail set id_operator='$id_operator', updated=sysdate where id='$id_edit'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select da.desain, da.proses, da.nama_mesin, da.shift, dg.id_operator
			from erp_prod_proses da join erp_prod_proses_detail dg on dg.id_prod_proses=da.id where dg.id='$id_edit'");
		return $query->row_array();
	}

	function batal($id) {
		$this->db->query("Update erp_prod_proses_detail set aktif='0' where id='$id'");
	}

}