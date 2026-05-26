<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_sticker extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_sticker order by desain");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc sticker' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
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
			where lower(af.trans)='operator sticker' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $desain, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain from erp_qc_sticker where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_sticker where desain='$desain'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_sticker where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $desain, $cari) {
		return $this->db->query("Select qq.id, qq.desain, qq.nmr, qq.tgl, to_char(qq.jam,'hh24:mi') jam, qq.kode_kertas, qq.panjang_kertas, qq.lebar_kertas, qq.gsm_kertas, qq.thickness_kertas, qq.jenis_lem, qq.gsm_lem, qq.thickness_lem, qq.gsm_srp, qq.thickness_srp, qq.gsm_total, qq.thickness_total, qq.daya_rekat, qq.acc_meter, qq.reject_meter, qq.remark, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval, initcap(nvl(ha3.nick_name, ha3.nama)) operator
			from erp_qc_sticker qq join erp_karyawan ha on ha.id=qq.id_pemeriksa join erp_karyawan ha2 on ha2.id=qq.id_approval join erp_karyawan ha3 on ha3.id=qq.id_operator
			where to_char(qq.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else qq.desain end)='$desain' and nvl(lower(qq.remark), 'all') like '%$cari%'
			order by qq.tgl desc, qq.jam desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_sticker")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $desain, $tgl, $jam, $kode_kertas, $lebar_kertas, $panjang_kertas, $id_pemeriksa, $id_approval, $id_operator, $gsm_kertas, $thickness_kertas, $jenis_lem, $gsm_lem, $thickness_lem, $gsm_srp, $thickness_srp, $gsm_total, $thickness_total, $daya_rekat, $acc_meter, $reject_meter, $remark) {
		$this->db->query("Insert into erp_qc_sticker(id, desain, nmr, tgl, jam, kode_kertas, panjang_kertas, lebar_kertas, gsm_kertas, thickness_kertas, jenis_lem, gsm_lem, thickness_lem, gsm_srp, thickness_srp, gsm_total, thickness_total, daya_rekat, acc_meter, reject_meter, id_operator, id_pemeriksa, id_approval, remark) values('$urut', '$desain', '$nmr', '$tgl', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$kode_kertas', '$panjang_kertas', '$lebar_kertas', '$gsm_kertas', '$thickness_kertas', '$jenis_lem', '$gsm_lem', '$thickness_lem', '$gsm_srp', '$thickness_srp', '$gsm_total', '$thickness_total', '$daya_rekat', '$acc_meter', '$reject_meter', '$id_operator', '$id_pemeriksa', '$id_approval', '$remark')");
	}

	function update($id_edit, $nmr, $desain, $tgl, $jam, $kode_kertas, $lebar_kertas, $panjang_kertas, $id_pemeriksa, $id_approval, $id_operator, $gsm_kertas, $thickness_kertas, $jenis_lem, $gsm_lem, $thickness_lem, $gsm_srp, $thickness_srp, $gsm_total, $thickness_total, $daya_rekat, $acc_meter, $reject_meter, $remark) {
		$this->db->query("Update erp_qc_sticker set nmr='$nmr', tgl='$tgl', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), kode_kertas='$kode_kertas', panjang_kertas='$panjang_kertas', lebar_kertas='$lebar_kertas', gsm_kertas='$gsm_kertas', thickness_kertas='$thickness_kertas', jenis_lem='$jenis_lem', gsm_lem='$gsm_lem', thickness_lem='$thickness_lem', gsm_srp='$gsm_srp', thickness_srp='$thickness_srp', gsm_total='$gsm_total', thickness_total='$thickness_total', daya_rekat='$daya_rekat', acc_meter='$acc_meter', reject_meter='$reject_meter', id_operator='$id_operator', id_pemeriksa='$id_pemeriksa', id_approval='$id_approval', remark='$remark' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select desain, nmr, tgl, to_char(jam,'hh24:mi') jam, kode_kertas, panjang_kertas, lebar_kertas, gsm_kertas, thickness_kertas, jenis_lem, gsm_lem, thickness_lem, gsm_srp, thickness_srp, gsm_total, thickness_total, daya_rekat, acc_meter, reject_meter, id_operator, id_pemeriksa, id_approval, remark from erp_qc_sticker where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_sticker where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select qq.nmr, to_char(qq.tgl, 'DD-MM-YYYY') tgl, to_char(qq.jam,'hh24:mi') jam, qq.kode_kertas, qq.lebar_kertas, qq.panjang_kertas, qq.gsm_kertas, qq.thickness_kertas, qq.jenis_lem, qq.gsm_lem, qq.gsm_srp, qq.thickness_srp, qq.gsm_total, qq.thickness_total, qq.daya_rekat, qq.acc_meter, qq.reject_meter, qq.remark, nvl(ha2.nick_name, ha2.nama) approval,
			(select wm_concat(distinct initcap(nvl(ha2.nick_name, ha2.nama))) from erp_qc_sticker qq2 join erp_karyawan ha2 on ha2.id=qq2.id_pemeriksa where qq2.nmr=qq.nmr and qq2.desain=qq.desain) pemeriksa,
			(select wm_concat(distinct initcap(nvl(ha3.nick_name, ha3.nama))) from erp_qc_sticker qq2 join erp_karyawan ha3 on ha3.id=qq2.id_operator where qq2.nmr=qq.nmr and qq2.desain=qq.desain) operator
			from erp_qc_sticker qq join erp_karyawan ha on ha.id=qq.id_pemeriksa join erp_karyawan ha2 on ha2.id=qq.id_approval
			where qq.nmr=(Select nmr from erp_qc_sticker where id='$id_cetak') and qq.desain=(Select desain from erp_qc_sticker where id='$id_cetak')
			order by qq.jam")->result_array();
	}

}