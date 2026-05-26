<?php 
class M_stamping extends CI_Model {

	function filter($tgl1,$tgl2,$nm_operator,$nm_qc,$nm_pengawas,$seri) {
		return $this->db->query("Select substr(ssa.kode_bahan,4,4) desain, to_char(ssa.tgl_proses_stamp,'DD-Mon-YYYY') tgl_proses_stamp, ssa.shift_stamp, ssa.nomesin_stamp, ssa.nomor_pp, ssa.no_roll, substr(ssa.kode_bahan,-1) bahan, ssa.gramature, ssa.baik_sht panjang,
			(select initcap(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_operator=ha.id where sa.no_roll=ssa.no_roll) nm_operator,
			(select initcap(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_pengawas=ha.id where sa.no_roll=ssa.no_roll) nm_pengawas,
			(select initcap(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_qc=ha.id where sa.no_roll=ssa.no_roll) nm_qc,
			(select urut_pp from erp_stamp_barcode where no_roll=ssa.no_roll) urut_pp
			from tbl_keluar ssa
			where to_char(ssa.tgl_proses_stamp,'YYMMDD') between '$tgl1' and '$tgl2' and
			(case when '$nm_operator'='ALL' then 'ALL' else (select upper(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_operator=ha.id where sa.no_roll=ssa.no_roll) end)='$nm_operator' and
			(case when '$nm_qc'='ALL' then 'ALL' else (select upper(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_qc=ha.id where sa.no_roll=ssa.no_roll) end)='$nm_qc' and
			(case when '$nm_pengawas'='ALL' then 'ALL' else (select upper(ha.nama) from erp_karyawan ha join erp_stamp_barcode sa on sa.id_pengawas=ha.id where sa.no_roll=ssa.no_roll) end)='$nm_pengawas' and
			(case when '$seri'='ALL' then 'ALL' else substr(ssa.kode_bahan,-1) end)='$seri'
			order by ssa.tgl_proses_stamp desc, substr(ssa.kode_bahan,4,4) desc, ssa.kode_bahan, ssa.tgl_proses_stamp, substr(ssa.no_roll,0,5)");
	}

	function nm_qc() {
		return $this->db->query("Select ha.id, initcap(ha.nama) nama from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan where hb.nama='QUALITY CONTROL' and upper(hc.nama)='PENGAWAS' and ha.status='1' and ha.tgl_keluar is null and ha.kd_unit='12' order by ha.nama");
	}

	function nm_operator() {
		return $this->db->query("Select ha.id, initcap(ha.nama) nama from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan where (hb.nama='EMBOSS' or hb.nama='SLITTER' or hb.nama='STAMPING') and upper(hc.nama)='OPERATOR' and ha.status='1' and ha.tgl_keluar is null and ha.kd_unit='12' order by ha.nama");
	}

	function nm_pengawas() {
		return $this->db->query("Select ha.id, initcap(ha.nama) nama from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan where upper(hb.nama)='STAMPING' and upper(hc.nama)='PENGAWAS' and ha.status='1' and ha.tgl_keluar is null and ha.kd_unit='12' order by ha.nama");
	}

	function qty_edit($kode_roll) {
		$query = $this->db->query("Select * from erp_stamp_barcode where no_roll='$kode_roll'");
		return $query->num_rows();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_stamp_barcode");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($urut, $kode_roll, $id_operator, $id_qc, $urut_pp, $ukuran, $id_pengawas) {
		$this->db->query("Insert into erp_stamp_barcode(id, no_roll, id_operator, id_qc, urut_pp, ukuran, id_pengawas) values('$urut','$kode_roll','$id_operator','$id_qc','$urut_pp','$ukuran','$id_pengawas')");
	}

	function update($kode_roll, $id_operator, $id_qc, $urut_pp, $ukuran, $id_pengawas) {
		$this->db->query("Update erp_stamp_barcode set id_operator='$id_operator', id_qc='$id_qc', urut_pp='$urut_pp', ukuran='$ukuran', id_pengawas='$id_pengawas' where no_roll='$kode_roll'");
	}

}
?>