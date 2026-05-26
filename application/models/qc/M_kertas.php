<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_kertas extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order where length(desain)='4' order by desain desc");
	}

	function karyawan_qc() {
		return $this->db->query("Select ha.id, upper(ha.nama) nama, af.trans
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where (af.trans='Approval QC' or af.trans='Pengawas Bahan') and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by upper(ha.nama)");
	}

	function auto_no($id_edit, $tahun, $day) {
		$query = $this->db->query("Select nmr from erp_qc_rh where to_char(tgl, 'YYMMDD')='$day'");
		if ($query->num_rows() > 0) {return sprintf('%03d', $query->row_array()['NMR']);}

		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') tahun from erp_qc_rh where id='$id_edit'");
			$data = $query->row_array();

			if ($data['TAHUN'] == $tahun) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, max(to_char(tgl, 'YYMMDD')) tgl from erp_qc_rh where to_char(tgl, 'YY')='$tahun'");
		$data = $query->row_array();
		return $data['TGL'] < $day ?  sprintf('%03d', $data['NMR'] + 1) : sprintf('%03d', $data['NMR']);
	}

	function isi_roll($desain, $ukuran) {
		return $this->db->query("Select substr(sa.no_roll, 0, 5) no_roll, sa.netto_kg
			from tbl_terima sa left join erp_qc_rh qd on qd.no_roll=substr(sa.no_roll, 0, 5) and qd.nmr is null
			where sa.desain='$desain' and sa.no_roll like '%$ukuran%'
			order by sa.no_roll desc")->result_array();
		return $this->db->query("Select substr(sa.no_roll, 0, 5) no_roll, qd.nmr, netto_kg
			from tbl_terima sa left join erp_qc_rh qd on qd.no_roll=substr(sa.no_roll, 0, 5)
			where sa.desain='$desain' and sa.no_roll like '%$ukuran%' and qd.nmr is null
			order by sa.no_roll")->result_array();
	}

	function filter($tgl1, $tgl2, $desain, $ukuran, $status) {
		$query = $this->db->query("Select qd.id, qd.nmr, qd.desain, qd.tgl, qd.no_roll, qd.pabrikasi, qd.awal, qd.tengah, qd.akhir, qd.visual, qd.acc,
			(select sa.tgl_npk || '|' || sa.lebar_cm || '|' || sa.netto_kg || '|' || sb.gramature || '|' || sb.thickness from tbl_terima sa join tbl_keluar sb on sa.no_roll=sb.no_roll where sa.no_roll=qd.no_roll || '/' || qd.desain) bahan
			from erp_qc_rh qd
			where to_char(qd.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and qd.desain='$desain' and (case when '$ukuran'='All' then 'All' else substr(qd.no_roll, -1) end)='$ukuran' and (case when '$status'='All' then 'All' else qd.acc end)='$status'
			order by qd.tgl desc, qd.no_roll");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_rh");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan($urut, $nmr, $tgl, $desain, $kode_roll, $pabrikasi, $pemeriksa, $approval, $awal, $tengah, $akhir, $visual, $acc, $berat) {
		$this->db->query("Insert into erp_qc_rh(id, nmr, tgl, desain, no_roll, pabrikasi, awal, tengah, akhir, visual, acc, id_pemeriksa, id_approval, berat) values('$urut', '$nmr', '$tgl', '$desain', '$kode_roll', '$pabrikasi', '$awal', '$tengah', '$akhir', '$visual', '$acc', '$pemeriksa', '$approval', '$berat')");
	}

	function update($id_edit, $nmr, $tgl, $desain, $kode_roll, $pabrikasi, $pemeriksa, $approval, $awal, $tengah, $akhir, $visual, $acc, $berat) {
		$this->db->query("Update erp_qc_rh set nmr='$nmr', tgl='$tgl', desain='$desain', no_roll='$kode_roll', pabrikasi='$pabrikasi', awal='$awal', tengah='$tengah', akhir='$akhir', visual='$visual', acc='$acc', id_pemeriksa='$pemeriksa', id_approval='$approval', berat='$berat' where id='$id_edit'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select nmr, tgl, desain, no_roll, pabrikasi, id_pemeriksa, awal, tengah, akhir, visual, acc, id_approval, berat from erp_qc_rh where id='$id_edit'");
		return $query->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_rh where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select qd.nmr, to_char(qd.tgl, 'DD-MM-YYYY') tgl, qd.desain, qd.no_roll, qd.berat, qd.pabrikasi, qd.id_pemeriksa, qd.awal, qd.tengah, qd.akhir, qd.visual, qd.acc, qd.id_approval, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval,
			(select sa.tgl_npk || '|' || sa.lebar_cm || '|' || sa.netto_kg || '|' || sb.gramature || '|' || sb.thickness from tbl_terima sa join tbl_keluar sb on sa.no_roll=sb.no_roll where sa.no_roll=qd.no_roll || '/' || qd.desain) bahan
			from erp_qc_rh qd join erp_karyawan ha on ha.id=qd.id_pemeriksa join erp_karyawan ha2 on ha2.id=qd.id_approval
			where qd.nmr=(select nmr from erp_qc_rh where id='$id_cetak') and qd.tgl=(select tgl from erp_qc_rh where id='$id_cetak')
			order by qd.no_roll");
		return $query->result_array();
	}

}