<?php class M_tipe extends CI_Model {

	function filter() {
		$query = $this->db->query("Select pb.*, (select count(kode_tipe) from erp_pdd_master where kode_tipe=pb.kode) qty from erp_pdd_tipe pb order by pb.id");
		return $query->result_array();
	}

	function cek_kode($id_edit, $kode) {
		$query = $this->db->query("Select * from erp_pdd_tipe where kode='$kode' and (case when '$id_edit'='baru' then 'new' else to_char(id) end)<>'$id_edit'");
		return $query->num_rows();
	}

	function cek_tipe($id_edit, $tipe) {
		$query = $this->db->query("Select * from erp_pdd_tipe where tipe='$tipe' and (case when '$id_edit'='baru' then 'new' else to_char(id) end)<>'$id_edit'");
		return $query->num_rows();
	}

	function urut() {
		$query = $this->db->query("Select max(id) id from erp_pdd_tipe");
		$urut = $query->row_array();
		return $urut['ID'] + 1;
	}

	function simpan($urut, $kode, $tipe, $group, $distribusi) {
		$this->db->query("Insert into erp_pdd_tipe(id, kode, tipe, grup, distribusi, status ) values('$urut','$kode','$tipe','$group','$distribusi','1')");
	}

	function update($id_edit, $kode, $tipe, $group, $distribusi) {
		$this->db->query("Update erp_pdd_tipe set kode='$kode', tipe='$tipe', grup='$group', distribusi='$distribusi' where id='$id_edit'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select * from erp_pdd_tipe where id='$id_edit'");
		return $query->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_pdd_tipe where id='$id_hapus'");
	}

}