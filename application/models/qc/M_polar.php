<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_polar extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_polar order by desain");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc polar' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function approval() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function operator() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='operator polar' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $desain, $tgl, $tipe) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain, tipe from erp_qc_polar where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain && $data['TIPE'] == $tipe) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_polar where desain='$desain' and tipe='$tipe'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_polar where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $desain, $produk, $mesin) {
		return $this->db->query("Select ql.id, ql.desain, ql.nmr, ql.tgl, ql.mesin, ql.produk, to_char(ql.jam,'hh24:mi') jam, ql.rh_ruang, ql.sh_ruang, ql.label_cutter, ql.kode_sortir, ql.kode_qc, ql.qty_bahan, ql.qty_sampling, ql.qty_sisipan, ql.siku, ql.miss_reg, ql.qty_acc, ql.qty_rej, ql.ku, ql.holo, ql.kertas, ql.remark, nvl(ha3.nick_name, ha3.nama) operator
			from erp_qc_polar ql join erp_karyawan ha on ha.id=ql.id_pemeriksa join erp_karyawan ha2 on ha2.id=ql.id_approval join erp_karyawan ha3 on ha3.id=ql.id_operator
			where to_char(ql.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else ql.desain end)='$desain' and (case when '$produk'='All' then 'All' else ql.produk end)='$produk' and (case when '$mesin'='All' then 'All' else ql.mesin end)='$mesin'
			order by ql.tgl desc, ql.mesin, ql.jam desc, ql.produk")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_polar")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $desain, $tgl, $jam, $mesin, $produk, $rh_ruang, $sh_ruang, $id_pemeriksa, $id_approval, $id_operator, $label_cutter, $kode_sortir, $kode_qc, $qty_bahan, $qty_sampling, $qty_sisipan, $siku, $miss_reg, $qty_acc, $qty_rej, $ku, $holo, $kertas, $remark, $tipe) {
		$this->db->query("Insert into erp_qc_polar(id, desain, nmr, tgl, mesin, produk, jam, rh_ruang, sh_ruang, label_cutter, kode_sortir, kode_qc, qty_bahan, qty_sampling, qty_sisipan, siku, miss_reg, qty_acc, qty_rej, ku, holo, kertas, id_pemeriksa, id_approval, id_operator, remark, tipe) values('$urut', '$desain', '$nmr', '$tgl', '$mesin', '$produk', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$rh_ruang', '$sh_ruang', '$label_cutter', '$kode_sortir', '$kode_qc', '$qty_bahan', '$qty_sampling', '$qty_sisipan', '$siku', '$miss_reg', '$qty_acc', '$qty_rej', '$ku', '$holo', '$kertas', '$id_pemeriksa', '$id_approval', '$id_operator', '$remark', '$tipe')");
	}

	function update($id_edit, $nmr, $desain, $tgl, $jam, $mesin, $produk, $rh_ruang, $sh_ruang, $id_pemeriksa, $id_approval, $id_operator, $label_cutter, $kode_sortir, $kode_qc, $qty_bahan, $qty_sampling, $qty_sisipan, $siku, $miss_reg, $qty_acc, $qty_rej, $ku, $holo, $kertas, $remark, $tipe) {
		$this->db->query("Update erp_qc_polar set nmr='$nmr', desain='$desain', tgl='$tgl', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), mesin='$mesin', produk='$produk', rh_ruang='$rh_ruang', sh_ruang='$sh_ruang', id_pemeriksa='$id_pemeriksa', id_approval='$id_approval', id_operator='$id_operator', label_cutter='$label_cutter', kode_sortir='$kode_sortir', kode_qc='$kode_qc', qty_bahan='$qty_bahan', qty_sampling='$qty_sampling', qty_sisipan='$qty_sisipan', siku='$siku', miss_reg='$miss_reg', qty_acc='$qty_acc', qty_rej='$qty_rej', ku='$ku', holo='$holo', kertas='$kertas', remark='$remark', tipe='$tipe' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select desain, nmr, tgl, mesin, produk, to_char(jam,'hh24:mi') jam, rh_ruang, sh_ruang, label_cutter, kode_sortir, kode_qc, qty_bahan, qty_sampling, qty_sisipan, siku, miss_reg, ku, holo, kertas, remark, id_pemeriksa, id_approval, id_operator from erp_qc_polar where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_polar where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select ql.nmr, to_char(ql.tgl, 'DD-MM-YYYY') tgl, ql.mesin, ql.produk, to_char(ql.jam,'hh24:mi') jam, ql.rh_ruang, ql.sh_ruang, ql.label_cutter, ql.kode_sortir, ql.kode_qc, ql.qty_bahan, ql.qty_sampling, ql.qty_sisipan, ql.siku, ql.miss_reg, ql.qty_acc, ql.qty_rej, ql.ku, ql.holo, ql.kertas, ql.remark, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval,
			(select wm_concat(distinct nvl(ha3.nick_name, ha3.nama)) from erp_qc_polar ql2 join erp_karyawan ha3 on ha3.id=ql2.id_operator where ql2.nmr=ql.nmr and ql2.tipe=ql.tipe and to_char(ql2.tgl, 'YY')=to_char(ql.tgl, 'YY')) operator
			from erp_qc_polar ql join erp_karyawan ha on ha.id=ql.id_pemeriksa join erp_karyawan ha2 on ha2.id=ql.id_approval
			where ql.nmr=(Select nmr from erp_qc_polar where id='$id_cetak') and ql.desain=(Select desain from erp_qc_polar where id='$id_cetak') and ql.tipe=(Select tipe from erp_qc_polar where id='$id_cetak')
			order by ql.mesin, ql.jam, ql.produk")->result_array();
	}

}