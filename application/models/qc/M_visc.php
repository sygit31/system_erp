<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_visc extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order where length(desain)='4' order by desain desc");
	}

	function pemeriksa() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pengawas qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function operator() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' and ha.id_jabatan=12 and ha.kd_unit='12' order by ha.nama");
	}

	function operator2() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='operator produksi' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function mengetahui() {
		return $this->db->query("Select ha.id, nvl(initcap(nick_name), initcap(ha.nama)) nama
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval qc' and ha.kd_unit='12' and ha.status<>0 and ha.tgl_keluar is null
			order by ha.nama");
	}

	function auto_no($id_edit, $tahun, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') tahun from erp_qc_visc where id='$id_edit'");
			$data = $query->row_array();

			if ($data['TAHUN'] == $tahun) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr, to_char(max(tgl), 'DD-MM-YYYY') tgl from erp_qc_visc where to_char(tgl, 'YY')='$tahun'");
		$data = $query->row_array();
		$tgl1 = new DateTime($tgl);
		$tgl2 = new DateTime($data['TGL']);

		if ($tgl1 < $tgl2) {
			$query = $this->db->query("Select distinct nmr from erp_qc_visc where to_char(tgl, 'DD-MM-YYYY')='$tgl'");
			return sprintf('%04d', $query->row_array()['NMR']);
		}

		return $data['TGL'] == $tgl ? sprintf('%04d', $data['NMR']) : sprintf('%04d', $data['NMR'] + 1);
	}

	function filter($tgl1, $tgl2, $desain, $kode_roll) {
		return $this->db->query("Select qd.id, qd.tgl, qd.nmr, to_char(qd.jam,'hh24:mi') jam, qd.kode_1, qd.kode_2, qd.station_1, qd.station_2, qd.station_3, qd.station_4, initcap(ha.nama) pemeriksa, initcap(ha2.nama) operator, initcap(ha3.nama) mengetahui, qd.keterangan
			from erp_qc_visc qd join erp_karyawan ha on ha.id=qd.id_pemeriksa join erp_karyawan ha2 on ha2.id=qd.id_operator join erp_karyawan ha3 on ha3.id=qd.id_mengetahui
			where to_char(qd.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and qd.desain='$desain' and (qd.kode_1 like '%$kode_roll%' or qd.kode_2 like '%$kode_roll%')
			order by qd.jam desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_visc")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $nmr, $desain, $tgl, $jam, $proses_1, $proses_2, $kode_1, $kode_2, $station_1, $station_2, $station_3, $station_4, $id_pemeriksa, $id_operator, $id_mengetahui, $keterangan) {
		$this->db->query("Insert into erp_qc_visc(id, nmr, desain, tgl, jam, proses_1, proses_2, kode_1, kode_2, station_1, station_2, station_3, station_4, id_pemeriksa, id_operator, id_mengetahui, keterangan) values('$urut', '$nmr', '$desain', '$tgl', to_date('$jam','DD-MM-YYYY HH24:MI:SS'), '$proses_1', '$proses_2', '$kode_1', '$kode_2', '$station_1', '$station_2', '$station_3', '$station_4', '$id_pemeriksa', '$id_operator', '$id_mengetahui', '$keterangan')");
	}

	function update($id_edit, $nmr, $desain, $tgl, $jam, $proses_1, $proses_2, $kode_1, $kode_2, $station_1, $station_2, $station_3, $station_4, $id_pemeriksa, $id_operator, $id_mengetahui, $keterangan) {
		$this->db->query("Update erp_qc_visc set nmr='$nmr', desain='$desain', tgl='$tgl', jam=to_date('$jam','DD-MM-YYYY HH24:MI:SS'), proses_1='$proses_1', proses_2='$proses_2', kode_1='$kode_1', kode_2='$kode_2', station_1='$station_1', station_2='$station_2', station_3='$station_3', station_4='$station_4', id_pemeriksa='$id_pemeriksa', id_operator='$id_operator', id_mengetahui='$id_mengetahui', keterangan='$keterangan' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select qd.nmr, qd.desain, qd.tgl, to_char(qd.jam,'hh24:mi') jam, qd.proses_1, qd.proses_2, qd.kode_1, qd.kode_2, qd.station_1, qd.station_2, qd.station_3, qd.station_4, qd.id_pemeriksa, qd.id_operator, qd.id_mengetahui, qd.keterangan
			from erp_qc_visc qd
			where qd.id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_visc where id='$id_hapus'");
	}

	function cetak($id_cetak) {
		return $this->db->query("Select qd.nmr, to_char(qd.tgl, 'DD-MM-YYYY') tgl, to_char(qd.jam,'hh24:mi') jam, qd.kode_1, qd.kode_2, replace(qd.station_1, ',', '.') station_1, replace(qd.station_2, ',', '.') station_2, replace(qd.station_3, ',', '.') station_3, replace(qd.station_4, ',', '.') station_4, qd.keterangan, qd.desain,
			(select initcap(nama) from erp_karyawan where id=(select id_pemeriksa from erp_qc_visc where id='$id_cetak')) pemeriksa,
			(select initcap(nama) from erp_karyawan where id=(select id_mengetahui from erp_qc_visc where id='$id_cetak')) mengetahui,
			(select initcap(nama) from erp_karyawan where id=(select id_operator from erp_qc_visc where id='$id_cetak')) operator
			from erp_qc_visc qd
			where qd.nmr=(select nmr from erp_qc_visc where id='$id_cetak') and qd.desain=(select desain from erp_qc_visc where id='$id_cetak')
			order by qd.jam")->result_array();
	}

	function open_set() {
		return $this->db->query("Select * from erp_qc_target where kode='VISC-D1' or kode='VISC-R1' or kode='VISC-R2' or kode='VISC-R3'")->result_array();
	}

	function simpan_set($visc_d1, $visc_r1, $visc_r2, $visc_r3) {
		$this->db->query("Update erp_qc_target set target='$visc_d1[0]', max='$visc_d1[1]', min='$visc_d1[2]' where kode='VISC-D1'");
		$this->db->query("Update erp_qc_target set target='$visc_r1[0]', max='$visc_r1[1]', min='$visc_r1[2]' where kode='VISC-R1'");
		$this->db->query("Update erp_qc_target set target='$visc_r2[0]', max='$visc_r2[1]', min='$visc_r2[2]' where kode='VISC-R2'");
		$this->db->query("Update erp_qc_target set target='$visc_r3[0]', max='$visc_r3[1]', min='$visc_r3[2]' where kode='VISC-R3'");
	}

}