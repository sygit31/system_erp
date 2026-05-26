<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_sortir extends CI_Model {

	function get_karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		return $id_kary;
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_sortir order by desain desc");
	}

	function auto_no($id_edit, $desain) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain from erp_qc_sortir where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr from erp_qc_sortir where desain='$desain'");
		$data = $query->row_array();
		return sprintf('%03d', $data['NMR']);
	}

	function isi_label($desain) {
		$query = $this->db->query("Select distinct sb.nomor_pp_cutter, sb.tgl_proses_stamp
			from tbl_keluar sb
			where sb.nomor_pp_cutter is not null and substr(sb.kode_bahan, 4, 4)='$desain'
			order by sb.tgl_proses_stamp desc, sb.nomor_pp_cutter desc");
		return $query->result_array();
	}

	function isi_mesin($desain, $label) {
		$query = $this->db->query("select distinct nomesin_stamp, shift_stamp, nomor_pp, substr(kode_bahan, 11, 1) seri from tbl_keluar
			where nomor_pp_cutter='$label' and substr(kode_bahan,4,4)='$desain' order by shift_stamp");
		return $query->result_array();
	}

	function pengawas_sortir() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where ha.tgl_keluar is null and ha.status='1' and af.trans='Pengawas Sortir' and af.kd_unit='12' order by ha.nama");
	}

	function pengawas_qc() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where ha.tgl_keluar is null and ha.status='1' and af.trans='Pengawas QC Sortir' and af.kd_unit='12' order by ha.nama");
	}

	function approval_qc() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where ha.tgl_keluar is null and ha.status='1' and af.trans='Approval QC' and af.kd_unit='12' order by ha.nama");
	}

	function waste() {
		return $this->db->query("Select * from erp_qc_kode where status<>'0' order by bahan, kd_reject");
	}


	function filter($tgl1, $tgl2, $desain, $seri, $id_pemeriksa) {
		$query = $this->db->query("Select da.id, da.nmr, da.desain, da.tgl, to_char(da.jam_mulai,'hh24:mi') jam_mulai, to_char(da.jam_selesai,'hh24:mi') jam_selesai, da.label_cutter, da.ms_stamping, da.shift_stamping, da.pp, da.seri, da.baik, da.r_holo, da.r_kertas, da.temuan_lbr, da.keterangan, ha.nama pengawas_sortir, ha2.nama pengawas_qc, ha3.nama kepala_qc, da.remark, da.aql,
			(select xmlagg(xmlelement(e,db.kd_reject || ':' || db.lbr || ',') order by dc.bahan, db.kd_reject).extract('//text()') from erp_qc_sortir_temuan db join erp_qc_kode dc on dc.kd_reject=db.kd_reject where db.id_qc=da.id) kd_reject
			from erp_qc_sortir da join erp_karyawan ha on ha.id=da.id_pengawas join erp_karyawan ha2 on ha2.id=da.id_pemeriksa join erp_karyawan ha3 on ha3.id=da.id_approval
			where to_char(da.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and da.desain='$desain' and (case when '$seri'='All' then 'All' else da.seri end)='$seri' and (case when '$id_pemeriksa'='All' then 'All' else to_char(da.id_pemeriksa) end)='$id_pemeriksa'
			order by da.desain desc, da.tgl desc, da.jam_mulai, da.shift_stamping");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_sortir");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan($urut, $id_edit, $desain, $nmr, $tgl, $grup, $jam_mulai, $jam_selesai, $label_cutter, $ms_stamping, $shift_stamping, $pp, $seri, $baik, $r_holo, $r_kertas, $temuan_lbr, $kode_sortir, $keterangan, $id_pemeriksa, $id_pengawas, $id_approval, $remark, $aql) {
		if ($id_edit == '') {
			$this->db->query("Insert into erp_qc_sortir(id, desain, nmr, tgl, grup, jam_mulai, jam_selesai, label_cutter, ms_stamping, shift_stamping, pp, seri, baik, r_holo, r_kertas, temuan_lbr, kode_sortir, keterangan, id_pemeriksa, id_pengawas, id_approval, remark, aql) values('$urut', '$desain', '$nmr', '$tgl', '$grup', to_date('$jam_mulai','DD-MM-YYYY HH24:MI:SS'),to_date('$jam_selesai','DD-MM-YYYY HH24:MI:SS'), '$label_cutter', '$ms_stamping', '$shift_stamping', '$pp', '$seri', '$baik', '$r_holo', '$r_kertas', '$temuan_lbr', '$kode_sortir', '$keterangan', '$id_pemeriksa', '$id_pengawas', '$id_approval', '$remark', '$aql')");
		}else{
			$this->db->query("Update erp_qc_sortir set desain='$desain', nmr='$nmr', tgl='$tgl', grup='$grup', jam_mulai=to_date('$jam_mulai','DD-MM-YYYY HH24:MI:SS'), jam_selesai=to_date('$jam_selesai','DD-MM-YYYY HH24:MI:SS'), label_cutter='$label_cutter', ms_stamping='$ms_stamping', shift_stamping='$shift_stamping', pp='$pp', seri='$seri', baik='$baik', r_holo='$r_holo', r_kertas='$r_kertas', temuan_lbr='$temuan_lbr', kode_sortir='$kode_sortir', keterangan='$keterangan', id_pemeriksa='$id_pemeriksa', id_pengawas='$id_pengawas', id_approval='$id_approval', remark='$remark', aql='$aql' where id='$id_edit'");
		}
	}

	function simpan_ed($id_edit, $r_holo, $r_kertas) {
		$this->db->query("Update erp_qc_sortir set r_holo='$r_holo', r_kertas='$r_kertas' where id='$id_edit'");
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) as id from erp_qc_sortir_temuan");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function cek_kode($urut, $kd_reject) {
		$query = $this->db->query("Select * from erp_qc_sortir_temuan where id_qc='$urut' and kd_reject='$kd_reject'");
		return $query->num_rows();
	}

	function simpan_detail($urut_detail, $urut, $kd_reject, $lbr) {
		$this->db->query("Insert into erp_qc_sortir_temuan(id, id_qc, kd_reject, lbr) values('$urut_detail', '$urut', '$kd_reject', '$lbr')");
	}

	function update_detail($urut, $kd_reject, $lbr) {
		$this->db->query("Update erp_qc_sortir_temuan set lbr='$lbr' where id_qc='$urut' and kd_reject='$kd_reject'");
	}

	function hapus_detail($urut, $kd_reject) {
		$this->db->query("Delete from erp_qc_sortir_temuan where id_qc='$urut' and kd_reject='$kd_reject'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select da.nmr, da.grup, da.desain, da.tgl, to_char(da.jam_mulai,'hh24:mi') jam_mulai, to_char(da.jam_selesai,'hh24:mi') jam_selesai, da.label_cutter, da.baik, da.r_holo, da.r_kertas, da.temuan_lbr, da.kode_sortir, da.keterangan, da.id_pemeriksa, da.id_pengawas, da.id_approval, da.remark, dc.bahan, db.lbr, dc.kd_reject, da.aql
			from erp_qc_sortir da left join (erp_qc_sortir_temuan db join erp_qc_kode dc on dc.kd_reject=db.kd_reject) on db.id_qc=da.id
			where da.id='$id_edit' order by dc.bahan, dc.kd_reject");
		return $query->result_array();
	}

	function hapus($id_hapus, $str) {
		if ($str == 'true') {
			$this->db->query("Delete from erp_qc_kode where id='$id_hapus'");
		}else{
			$this->db->query("Delete from erp_qc_sortir where id='$id_hapus'");
			$this->db->query("Delete from erp_qc_sortir_temuan where id_qc='$id_hapus'");
		}
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select da.id, da.nmr, da.grup, da.desain, to_char(da.tgl, 'DD/MM/YYYY') tgl, to_char(da.jam_mulai,'hh24:mi') jam_mulai, to_char(da.jam_selesai,'hh24:mi') jam_selesai, da.label_cutter, da.ms_stamping, da.shift_stamping, da.pp, da.seri, da.baik, da.r_holo, da.r_kertas, da.temuan_lbr, da.kode_sortir, da.keterangan, da.id_pemeriksa, da.id_pengawas, da.id_approval, da.remark, ha.nama pengawas, ha2.nama pemeriksa, ha3.nama approval, da.aql,
			(select xmlagg(xmlelement(e,db.kd_reject || ':' || db.lbr || ',') order by dc.bahan, db.kd_reject).extract('//text()') from erp_qc_sortir_temuan db join erp_qc_kode dc on dc.kd_reject=db.kd_reject where db.id_qc=da.id) kd_reject
			from erp_qc_sortir da join erp_karyawan ha on ha.id=da.id_pengawas join erp_karyawan ha2 on ha2.id=da.id_pemeriksa join erp_karyawan ha3 on ha3.id=da.id_approval
			where da.tgl=(select tgl from erp_qc_sortir where id='$id_cetak') and da.id_pemeriksa=(select id_pemeriksa from erp_qc_sortir where id='$id_cetak') and da.desain=(select desain from erp_qc_sortir where id='$id_cetak') order by da.desain, da.jam_mulai")->result_array();
		$query_waste = $this->db->query("Select distinct qb.kd_reject
			from erp_qc_sortir_temuan qb join erp_qc_sortir qa on qa.id=qb.id_qc
			where qa.tgl=(select tgl from erp_qc_sortir where id='$id_cetak') and qa.id_pemeriksa=(select id_pemeriksa from erp_qc_sortir where id='$id_cetak') and qa.desain=(select desain from erp_qc_sortir where id='$id_cetak')")->result_array();

		return [$query, $query_waste];
	}

	function urut_r() {
		$query = $this->db->query("Select max(id) as id from erp_qc_kode");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function cek_kode_r($id_edit, $kode, $reject) {
		if ($id_edit == '') {
			$query = $this->db->query("Select * from erp_qc_kode where kd_reject='$kode' or reject='$reject'");
		}else{
			$query = $this->db->query("Select * from erp_qc_kode where (kd_reject='$kode' or reject='$reject') and id<>'$id_edit'");
		}
		return $query->num_rows();
	}

	function simpan_r($urut_r, $bahan, $kode, $reject, $deskripsi) {
		$this->db->query("Insert into erp_qc_kode(id, bahan, kd_reject, reject, deskripsi, status) values('$urut_r', '$bahan', '$kode', '$reject', '$deskripsi', '1')");
	}

	function update_r($id_edit, $bahan, $kode, $reject, $deskripsi) {
		$this->db->query("Update erp_qc_kode set bahan='$bahan', kd_reject='$kode', reject='$reject', deskripsi='$deskripsi', status='1' where id='$id_edit'");
	}

	function edit_r($id_edit) {
		$query = $this->db->query("Select * from erp_qc_kode where id='$id_edit'");
		return $query->row_array();
	}

}