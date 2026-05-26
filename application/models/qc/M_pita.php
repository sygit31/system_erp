<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_pita extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_pita order by desain");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc pita' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function approval() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function operator() {
		return $this->db->query("Select ha.id, initcap(ha.nama) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='operator pita' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $desain, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain from erp_qc_pita where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_pita where desain='$desain'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_pita where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $desain, $seri, $mesin) {
		return $this->db->query("Select qr.id, qr.desain, qr.nmr, qr.tgl, qr.mesin, to_char(qr.jam,'hh24:mi') jam, qr.kode_foil, qr.panjang_bahan, qr.lebar_bahan, qr.seri, qr.lebar, qr.qty_roll, qr.panjang, qr.arah_baca, qr.cerah, qr.visual, qr.acc, qr.reject, qr.remark, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval, initcap(nvl(ha3.nick_name, ha3.nama)) operator
			from erp_qc_pita qr join erp_karyawan ha on ha.id=qr.id_pemeriksa join erp_karyawan ha2 on ha2.id=qr.id_approval join erp_karyawan ha3 on ha3.id=qr.id_operator
			where to_char(qr.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else qr.desain end)='$desain' and (case when '$seri'='All' then 'All' else qr.seri end)='$seri' and (case when '$mesin'='All' then 'All' else qr.mesin end)='$mesin'
			order by qr.tgl desc, qr.mesin, qr.jam desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_pita")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $desain, $nmr, $tgl, $mesin, $jam, $kode_foil, $panjang_bahan, $lebar_bahan, $seri, $lebar, $qty_roll, $panjang, $arah_baca, $cerah, $visual, $acc, $reject, $id_operator, $id_pemeriksa, $id_approval, $remark) {
		$this->db->query("Insert into erp_qc_pita(id, desain, nmr, tgl, mesin, jam, kode_foil, panjang_bahan, lebar_bahan, seri, lebar, qty_roll, panjang, arah_baca, cerah, visual, acc, reject, id_operator, id_pemeriksa, id_approval, remark) values('$urut', '$desain', '$nmr', '$tgl', '$mesin', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$kode_foil', '$panjang_bahan', '$lebar_bahan', '$seri', '$lebar', '$qty_roll', '$panjang', '$arah_baca', '$cerah', '$visual', '$acc', '$reject', '$id_operator', '$id_pemeriksa', '$id_approval', '$remark')");
	}

	function update($id_edit, $desain, $nmr, $tgl, $mesin, $jam, $kode_foil, $panjang_bahan, $lebar_bahan, $seri, $lebar, $qty_roll, $panjang, $arah_baca, $cerah, $visual, $acc, $reject, $id_operator, $id_pemeriksa, $id_approval, $remark) {
		$this->db->query("Update erp_qc_pita set desain='$desain', nmr='$nmr', tgl='$tgl', mesin='$mesin', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), kode_foil='$kode_foil', panjang_bahan='$panjang_bahan', lebar_bahan='$lebar_bahan', seri='$seri', lebar='$lebar', qty_roll='$qty_roll', panjang='$panjang', arah_baca='$arah_baca', cerah='$cerah', visual='$visual', acc='$acc', reject='$reject', id_operator='$id_operator', id_pemeriksa='$id_pemeriksa', id_approval='$id_approval', remark='$remark' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select desain, nmr, tgl, mesin, to_char(jam,'hh24:mi') jam, kode_foil, panjang_bahan, lebar_bahan, seri, lebar, qty_roll, panjang, arah_baca, cerah, visual, acc, reject, id_operator, id_pemeriksa, id_approval, remark from erp_qc_pita where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_pita where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select qr.desain, qr.nmr, qr.mesin, to_char(qr.tgl, 'DD-MM-YYYY') tgl, qr.mesin, to_char(qr.jam,'hh24:mi') jam, qr.kode_foil, qr.panjang_bahan, qr.lebar_bahan, qr.seri, qr.lebar, qr.qty_roll, qr.panjang, qr.arah_baca, qr.cerah, qr.visual, qr.acc, qr.reject, qr.remark, nvl(ha.nick_name, ha.nama) approval,
			(select wm_concat(distinct initcap(nvl(ha2.nick_name, ha2.nama))) from erp_qc_pita qr2 join erp_karyawan ha2 on ha2.id=qr2.id_pemeriksa where qr2.nmr=qr.nmr and qr2.desain=qr.desain) pemeriksa,
			(select wm_concat(distinct initcap(nvl(ha3.nick_name, ha3.nama))) from erp_qc_pita qr2 join erp_karyawan ha3 on ha3.id=qr2.id_operator where qr2.nmr=qr.nmr and qr2.desain=qr.desain) operator
			from erp_qc_pita qr join erp_karyawan ha on ha.id=qr.id_approval
			where qr.nmr=(Select nmr from erp_qc_pita where id='$id_cetak') and qr.desain=(Select desain from erp_qc_pita where id='$id_cetak')
			order by qr.mesin, qr.jam")->result_array();
	}

}