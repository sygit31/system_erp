<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_coating extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_coating order by desain desc");
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
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') tahun from erp_qc_coating where id='$id_edit'");
			$data = $query->row_array();

			if ($data['TAHUN'] == $tahun) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_coating where to_char(tgl, 'YY')='$tahun'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_coating where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function isi_roll($desain) {
		return $this->db->query("Select substr(gb.kode_roll, 0, 4) kode_roll, gb.qty_terima panjang
			from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk
			where cj.desain='$desain'
			order by substr(gb.kode_roll, 0, 4) desc")->result_array();
	}

	function filter($tgl1, $tgl2, $desain, $kode_roll) {
		return $this->db->query("Select ql.id, ql.tgl, ql.nmr, to_char(ql.jam,'hh24:mi') jam, ql.kode, ql.panjang, ql.speed, ql.arah_baca, ql.visc_1, ql.visc_2, ql.visc_3, ql.gsm_1, ql.gsm_2, ql.gsm_3, ql.acc, ql.rej, nvl(ha.nick_name, initcap(ha.nama)) pemeriksa, nvl(ha2.nick_name, initcap(ha2.nama)) approval, ql.keterangan
			from erp_qc_coating ql join erp_karyawan ha on ha.id=ql.id_pemeriksa join erp_karyawan ha2 on ha2.id=ql.id_approval
			where to_char(ql.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and ql.desain='$desain' and ql.kode like '%$kode_roll%'
			order by ql.tgl desc, to_char(ql.jam,'hh24:mi') desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_coating")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $desain, $tgl, $jam, $kode_roll, $panjang, $id_pemeriksa, $id_approval, $speed, $visual, $arah, $visc_1, $visc_2, $visc_3, $gsm_1, $gsm_2, $gsm_3, $acc, $rej, $keterangan) {
		$this->db->query("Insert into erp_qc_coating(id, desain, tgl, nmr, jam, kode, panjang, acc, rej, speed, visual, arah_baca, visc_1, visc_2, visc_3, gsm_1, gsm_2, gsm_3, id_pemeriksa, id_approval, keterangan) values('$urut', '$desain', '$tgl', '$nmr', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$kode_roll', '$panjang', '$acc', '$rej', '$speed', '$visual', '$arah', '$visc_1', '$visc_2', '$visc_3', '$gsm_1', '$gsm_2', '$gsm_3',  '$id_pemeriksa',  '$id_approval', '$keterangan')");
	}

	function update($id_edit, $nmr, $desain, $tgl, $jam, $kode_roll, $panjang, $id_pemeriksa, $id_approval, $speed, $visual, $arah, $visc_1, $visc_2, $visc_3, $gsm_1, $gsm_2, $gsm_3, $acc, $rej, $keterangan) {
		$this->db->query("Update erp_qc_coating set desain='$desain', tgl='$tgl', nmr='$nmr', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), kode='$kode_roll', panjang='$panjang', acc='$acc', rej='$rej', speed='$speed', visual='$visual', arah_baca='$arah', visc_1='$visc_1', visc_2='$visc_2', visc_3='$visc_3', gsm_1='$gsm_1', gsm_2='$gsm_2', gsm_3='$gsm_3', id_pemeriksa='$id_pemeriksa', id_approval='$id_approval', keterangan='$keterangan' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select ql.nmr, ql.desain, ql.tgl, to_char(ql.jam,'hh24:mi') jam, ql.kode, ql.panjang, ql.id_pemeriksa, ql.id_approval, ql.speed, ql.visual, ql.arah_baca, ql.visc_1, ql.visc_2, ql.visc_3, ql.gsm_1, ql.gsm_2, ql.gsm_3, ql.acc, ql.rej, ql.keterangan
			from erp_qc_coating ql where ql.id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_coating where id='$id_hapus'");
	}

	function open_set($dt_kode) {
		$list = implode("','", $dt_kode);
		return $this->db->query("Select * from erp_qc_target where kode in ('".$list."') order by id")->result_array();
	}

	function hapus_target($dt_kode) {
		$list = implode("','", $dt_kode);
		$this->db->query("Delete from erp_qc_target where kode in ('".$list."')");
	}

	function urut_target() {
		$query = $this->db->query("Select max(id) as id from erp_qc_target")->row_array();
		return $query['ID'] + 1;
	}

	function simpan_target($urut_target, $kode, $deskripsi, $target, $max, $min) {
		$this->db->query("Insert into erp_qc_target(id, kode, deskripsi, target, max, min, status) values('$urut_target', '$kode', '$deskripsi', '$target', '$max', '$min', '1')");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select ql.nmr, to_char(ql.tgl, 'DD-MM-YYYY') tgl, to_char(ql.jam,'hh24:mi') jam, ql.kode, ql.panjang, ql.speed, ql.visual, ql.arah_baca, replace(ql.visc_1, ',', '.') visc_1, replace(ql.visc_2, ',', '.') visc_2, replace(ql.visc_3, ',', '.') visc_3, replace(ql.gsm_1, ',', '.') gsm_1, replace(ql.gsm_2, ',', '.') gsm_2, replace(ql.gsm_3, ',', '.') gsm_3, ql.acc, ql.rej, ql.keterangan, nvl(ha.nick_name, ha.nama) pemeriksa, nvl(ha2.nick_name, ha2.nama) approval
			from erp_qc_coating ql join erp_karyawan ha on ha.id=ql.id_pemeriksa join erp_karyawan ha2 on ha2.id=ql.id_approval
			where ql.nmr=(Select nmr from erp_qc_coating where id='$id_cetak')
			order by ql.jam")->result_array();
	}

}