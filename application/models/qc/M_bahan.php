<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_bahan extends CI_Model {

	function barang() {
		return $this->db->query("Select distinct pc.id, pc.nama, pc.*
			from erp_barang pc join erp_test_group qa on qa.id_master_barang=pc.id
			where pc.aktif='1' and pc.kode_sakti is not null and (pc.flag_penerimaan='NON LABEL' or pc.flag_penerimaan is null)
			order by pc.nama");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function approval() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $tahun, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') tahun from erp_qc_bahan where id='$id_edit'");
			$data = $query->row_array();

			if ($data['TAHUN'] == $tahun) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_bahan where to_char(tgl, 'YY')='$tahun'")->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($query['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_bahan where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $query['TGL'] == $tgl ? sprintf('%04d', $query['NMR']) : sprintf('%04d', $query['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $id_barang) {
		return $this->db->query("Select qm.id, qm.tgl, qm.tgl_pbt, qm.nmr, qm.qty, pc.nama barang, qm.satuan, qm.solid, qm.visc, qm.densitas, qm.visual, qm.acc, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval, qm.keterangan
			from erp_qc_bahan qm join erp_karyawan ha on ha.id=qm.id_pemeriksa join erp_karyawan ha2 on ha2.id=qm.id_approval join erp_barang pc on pc.id=qm.id_barang
			where to_char(qm.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$id_barang'='All' then 'All' else to_char(qm.id_barang) end)='$id_barang'
			order by qm.tgl desc, pc.nama")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_bahan")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $tgl_pbt, $tgl, $id_barang, $qty, $satuan, $solid, $visc, $densitas, $visual, $acc, $id_pemeriksa, $id_approval, $keterangan) {
		$this->db->query("Insert into erp_qc_bahan(id, nmr, tgl_pbt, tgl, id_barang, qty, satuan, solid, visc, densitas, visual, acc, id_pemeriksa, id_approval, keterangan) values('$urut', '$nmr', '$tgl_pbt', '$tgl', '$id_barang', '$qty', '$satuan', '$solid', '$visc', '$densitas', '$visual', '$acc', '$id_pemeriksa', '$id_approval', '$keterangan')");
	}

	function update($id_edit, $nmr, $tgl_pbt, $tgl, $id_barang, $qty, $satuan, $solid, $visc, $densitas, $visual, $acc, $id_pemeriksa, $id_approval, $keterangan) {
		$this->db->query("Update erp_qc_bahan set nmr='$nmr', tgl_pbt='$tgl_pbt', tgl='$tgl', id_barang='$id_barang', qty='$qty', satuan='$satuan', solid='$solid', visc='$visc', densitas='$densitas', visual='$visual', acc='$acc', id_pemeriksa='$id_pemeriksa', id_approval='$id_approval', keterangan='$keterangan' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select nmr, tgl_pbt, tgl, id_barang || '@' || satuan barang, qty, satuan, solid, visc, densitas, visual, acc, id_pemeriksa, id_approval, keterangan
			from erp_qc_bahan  where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_bahan where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select qm.nmr, qm.tgl_pbt, to_char(qm.tgl, 'DD-MM-YYYY') tgl, pc.nama barang, qm.qty, qm.solid, qm.visc, qm.densitas, qm.visual, qm.acc, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) mengetahui, qm.keterangan
			from erp_qc_bahan qm join erp_barang pc on pc.id=qm.id_barang join erp_karyawan ha on ha.id=qm.id_pemeriksa join erp_karyawan ha2 on ha2.id=qm.id_approval
			where qm.nmr=(select nmr from erp_qc_bahan where id='$id_cetak') and to_char(qm.tgl, 'YY')=(select to_char(tgl, 'YY') from erp_qc_bahan where id='$id_cetak')")->result_array();
	}

}