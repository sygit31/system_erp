<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_packing extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_packing order by desain");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc packing' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama desc");
	}

	function approval() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function pengawas() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas packing' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $desain, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain from erp_qc_packing where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_packing where desain='$desain'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_packing where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $desain, $produk, $mesin) {
		return $this->db->query("Select qo.id, qo.desain, qo.nmr, qo.tgl, to_char(qo.jam,'hh24:mi') jam, qo.mesin_hitung, qo.cutter, qo.produk, qo.kode_sortir, qo.kode_qc, qo.kode_packing, qo.hasil_baik, qo.rim_baik, qo.rim_sampling, qo.plus, qo.mins, qo.ku, qo.holo, qo.kts, qo.total, qo.remark, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) pengawas, nvl(ha3.nick_name, ha3.nama) approval
			from erp_qc_packing qo join erp_karyawan ha on ha.id=qo.id_pemeriksa join erp_karyawan ha2 on ha2.id=qo.id_pengawas join erp_karyawan ha3 on ha3.id=qo.id_approval
			where to_char(qo.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else qo.desain end)='$desain' and (case when '$produk'='All' then 'All' else qo.produk end)='$produk' and (case when '$mesin'='All' then 'All' else qo.mesin_hitung end)='$mesin'
			order by qo.tgl desc, qo.produk, qo.jam desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_packing")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $desain, $tgl, $jam, $mesin, $produk, $cutter, $sortir, $qc, $packing, $id_pemeriksa, $id_approval, $id_pengawas, $hasil_baik, $total, $rim, $sampling, $plus, $mins, $ku, $holo, $kts, $remark) {
		$this->db->query("Insert into erp_qc_packing(id, desain, nmr, tgl, jam, mesin_hitung, cutter, produk, kode_sortir, kode_qc, kode_packing, hasil_baik, rim_baik, rim_sampling, plus, mins, ku, holo, kts, total, id_pemeriksa, id_pengawas, id_approval, remark) values('$urut', '$desain', '$nmr', '$tgl', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$mesin', '$cutter', '$produk', '$sortir', '$qc', '$packing', '$hasil_baik', '$rim', '$sampling', '$plus', '$mins', '$ku', '$holo', '$kts', '$total', '$id_pemeriksa', '$id_pengawas', '$id_approval', '$remark')");
	}

	function update($id_edit, $nmr, $desain, $tgl, $jam, $mesin, $produk, $cutter, $sortir, $qc, $packing, $id_pemeriksa, $id_approval, $id_pengawas, $hasil_baik, $total, $rim, $sampling, $plus, $mins, $ku, $holo, $kts, $remark) {
		$this->db->query("Update erp_qc_packing set desain='$desain', nmr='$nmr', tgl='$tgl', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), mesin_hitung='$mesin', cutter='$cutter', produk='$produk', kode_sortir='$sortir', kode_qc='$qc', kode_packing='$packing', hasil_baik='$hasil_baik', rim_baik='$rim', rim_sampling='$sampling', plus='$plus', mins='$mins', ku='$ku', holo='$holo', kts='$kts', total='$total', id_pemeriksa='$id_pemeriksa', id_pengawas='$id_pengawas', id_approval='$id_approval', remark='$remark' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select qo.desain, qo.nmr, qo.tgl, to_char(qo.jam,'hh24:mi') jam, qo.mesin_hitung, qo.cutter, qo.produk, qo.kode_sortir, qo.kode_qc, qo.kode_packing, qo.hasil_baik, qo.rim_baik, qo.rim_sampling, qo.plus, qo.mins, qo.ku, qo.holo, qo.kts, qo.total, qo.id_pemeriksa, qo.id_pengawas, qo.id_approval, qo.remark
			from erp_qc_packing qo where qo.id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_packing where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select qo.nmr, to_char(qo.tgl, 'DD-MM-YYYY') tgl, to_char(qo.jam,'hh24:mi') jam, qo.cutter, qo.produk, qo.kode_sortir, qo.kode_qc, qo.kode_packing, qo.hasil_baik, qo.rim_baik, qo.rim_sampling, qo.plus, qo.mins, qo.total, qo.ku, qo.holo, qo.kts, qo.remark, nvl(ha.nick_name, ha.nama) approval, nvl(ha2.nick_name, ha2.nama) pemeriksa, nvl(ha3.nick_name, ha3.nama) pengawas,
			(select wm_concat(replace(remark, ',', '@_')) from erp_qc_packing_su where tgl=qo.tgl and desain=qo.desain) s_remark
			from erp_qc_packing qo join erp_karyawan ha on ha.id=qo.id_approval join erp_karyawan ha2 on ha2.id=qo.id_pemeriksa join erp_karyawan ha3 on ha3.id=qo.id_pengawas
			where qo.nmr=(Select nmr from erp_qc_packing where id='$id_cetak') and qo.desain=(Select desain from erp_qc_packing where id='$id_cetak')
			order by qo.produk, qo.jam")->result_array();
		$query_su = $this->db->query("Select produk, sum(bahan) bahan, sum(baik) baik, sum(temuan) temuan
			from erp_qc_packing_su where tgl=(select tgl from erp_qc_packing where id='$id_cetak') and desain=(select desain from erp_qc_packing where id='$id_cetak')
			group by produk order by produk")->result_array();

		return [$query, $query_su]; 
	}

	function s_filter($tgl1, $tgl2, $desain, $produk) {
		return $this->db->query("Select qp.id, qp.desain, qp.tgl, qp.produk, qp.bahan, qp.baik, qp.temuan, qp.remark,
			(select max(nmr) from erp_qc_packing where desain=qp.desain and tgl=qp.tgl) nmr
			from erp_qc_packing_su qp
			where to_char(qp.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$desain'='All' then 'All' else qp.desain end)='$desain' and (case when '$produk'='All' then 'All' else qp.produk end)='$produk'
			order by qp.tgl desc, qp.produk")->result_array();
	}

	function s_urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_packing_su")->row_array();
		return $query['ID'] + 1;
	}

	function s_simpan($urut, $desain, $tgl, $produk, $bahan, $baik, $temuan, $remark) {
		$this->db->query("Insert into erp_qc_packing_su(id, desain, tgl, produk, bahan, baik, temuan, remark) values('$urut', '$desain', '$tgl', '$produk', '$bahan', '$baik', '$temuan', '$remark')");
	}

	function s_update($id_edit, $desain, $tgl, $produk, $bahan, $baik, $temuan, $remark) {
		$this->db->query("Update erp_qc_packing_su set desain='$desain', tgl='$tgl', produk='$produk', bahan='$bahan', baik='$baik', temuan='$temuan', remark='$remark' where id='$id_edit'");
	}

	function s_edit($id_edit) {
		return $this->db->query("Select qp.desain, qp.tgl, qp.produk, qp.bahan, qp.baik, qp.temuan, qp.remark
			from erp_qc_packing_su qp where qp.id='$id_edit'")->row_array();
	}

	function s_hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_packing_su where id='$id_hapus'");
	}

}