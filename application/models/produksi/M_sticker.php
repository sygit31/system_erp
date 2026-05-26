<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_sticker extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order where status='OPEN' and length(desain)='4' order by desain desc");
	}

	function operator() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' and ha.id_jabatan=12 and ha.kd_unit='12' order by ha.nama");
	}

	function pengawas() {
		return $this->db->query("Select ha.id, ha.nama,
			(select id_pengawas from erp_sticker where id=(select max(id) from erp_sticker)) last_pgws
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where ha.tgl_keluar is null and ha.status='1' and af.trans='Pengawas Produksi' and af.kd_unit='12' order by ha.nama");
	}

	function pp() {
		return $this->db->query("Select distinct sb.nomor_pp, se.desain from tbl_keluar sb join tbl_master_bahan se on se.kode_bahan=sb.kode_bahan where se.desain>=2023 and substr(sb.kode_bahan, -1)='1' order by se.desain desc, sb.nomor_pp desc");
	}

	function no_roll() {
		return $this->db->query("Select distinct sb.no_roll, se.desain from tbl_keluar sb join tbl_master_bahan se on se.kode_bahan=sb.kode_bahan where se.desain>=2023 and substr(sb.kode_bahan, -1)='4'
			order by se.desain desc, substr(sb.no_roll, 0, 5) desc");
	}

	function last_opt() {
		$query = $this->db->query("Select xmlagg(xmlelement(e,dv.id_operator || ',')).extract('//text()') id from erp_sticker_opt dv where dv.id_sticker=(select max(id) from erp_sticker)");
		return $query->row_array();
	}

	function auto_no($id_edit, $thn) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YYYY') thn from erp_sticker where id='$id_edit'");
			$data = $query->row_array();

			if ($data['THN'] == $thn) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr from erp_sticker where to_char(tgl, 'YYYY')='$thn'");
		$data = $query->row_array();
		return sprintf('%03d', $data['NMR']);
	}

	function filter($tgl1, $tgl2, $desain, $pp) {
		$query = $this->db->query("Select du.id, du.nmr, du.desain, du.tgl, du.shift, nvl(initcap(ha.nick_name),initcap(ha.nama)) pengawas, du.pp, ta.nama_mesin, to_char(du.mulai,'hh24:mi') mulai, to_char(du.selesai,'hh24:mi') selesai, du.kode_kertas, du.lebar, du.panjang, du.hasil, du.keterangan,
			(select xmlagg(xmlelement(e,nvl(initcap(ha.nick_name),initcap(ha.nama))||',') order by nick_name).extract('//text()') from erp_karyawan ha join erp_sticker_opt dv on dv.id_operator=ha.id where dv.id_sticker=du.id) operator,
			(select xmlagg(xmlelement(e,kode_srp||' : '||hasil||', ') order by kode_srp).extract('//text()') from erp_sticker_bhn where id_sticker=du.id) srp
			from erp_sticker du join erp_tek_mesin ta on ta.id=du.id_mesin join erp_karyawan ha on ha.id=du.id_pengawas
			where to_char(du.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and du.desain='$desain' and (case when '$pp'='All' then 'All' else du.pp end)='$pp'
			order by du.desain desc, du.tgl desc, du.mulai");
		return $query->result_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_sticker_opt where id_sticker='$id_edit'");
		$this->db->query("Delete from erp_sticker_bhn where id_sticker='$id_edit'");
		$this->db->query("Delete from erp_sticker where id='$id_edit'");
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_sticker");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan($urut, $desain, $nmr, $tgl, $shift, $id_pengawas, $pp, $id_mesin, $mulai, $selesai, $no_roll, $lebar, $panjang, $hasil, $keterangan) {
		$this->db->query("Insert into erp_sticker(id, desain, nmr, tgl, shift, id_pengawas, pp, id_mesin, mulai, selesai, kode_kertas, lebar, panjang, hasil, keterangan) values('$urut', '$desain', '$nmr', '$tgl', '$shift', '$id_pengawas', '$pp', '$id_mesin', to_date('$mulai','DD-MM-YYYY HH24:MI:SS'),to_date('$selesai','DD-MM-YYYY HH24:MI:SS'), '$no_roll', '$lebar', '$panjang', '$hasil', '$keterangan')");
	}

	function urut_opt() {
		$query = $this->db->query("Select max(id) as id from erp_sticker_opt");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_opt($urut_opt, $urut, $id_operator) {
		$this->db->query("Insert into erp_sticker_opt(id, id_sticker, id_operator) values('$urut_opt', '$urut', '$id_operator')");
	}

	function urut_srp() {
		$query = $this->db->query("Select max(id) as id from erp_sticker_bhn");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_srp($urut_srp, $urut, $t_kode, $t_lebar, $t_panjang, $t_hasil, $t_reject, $t_sisa) {
		$this->db->query("Insert into erp_sticker_bhn(id, id_sticker, kode_srp, lebar, panjang, hasil, reject, sisa) values('$urut_srp', '$urut', '$t_kode', '$t_lebar', '$t_panjang', '$t_hasil', '$t_reject', '$t_sisa')");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select du.desain, du.nmr, du.tgl, du.shift, du.id_pengawas, to_char(du.mulai,'HH24:MI') mulai, to_char(du.selesai,'HH24:MI') selesai, du.pp, du.kode_kertas, du.lebar, du.panjang, du.hasil, du.keterangan,
			(Select xmlagg(xmlelement(e,id_operator||',')).extract('//text()') id from erp_sticker_opt where id_sticker=du.id) id_operator,
			(select xmlagg(xmlelement(e,kode_srp||'@'||lebar||'@'||panjang||'@'||hasil||'@'||reject||'@'||sisa||'@@') order by kode_srp).extract('//text()') from erp_sticker_bhn where id_sticker=du.id) srp
			from erp_sticker du
			where du.id='$id_edit'");
		return $query->row_array();
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select du.shift, du.pp, du.tgl, du.nmr, du.desain, to_char(du.mulai,'hh24:mi') mulai, to_char(du.selesai,'hh24:mi') selesai, du.kode_kertas, du.lebar, du.panjang, du.hasil, du.keterangan, nvl(initcap(ha.nick_name),initcap(ha.nama)) pengawas,
			(select xmlagg(xmlelement(e,nvl(initcap(ha.nick_name),initcap(ha.nama))||',') order by nick_name).extract('//text()') from erp_karyawan ha join erp_sticker_opt dv on dv.id_operator=ha.id where dv.id_sticker=du.id) operator,
			(select xmlagg(xmlelement(e, to_char(dk.mulai,'hh24:mi') || ' - ' || to_char(dk.selesai,'hh24:mi') || ' ' || dl.keterangan || '@') order by dk.mulai).extract('//text()') from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime where dk.tgl=du.tgl and dk.proses=ta.proses and dk.nama_mesin=ta.nama_mesin and dk.pp=du.pp) downtime,
			(select
			xmlagg(xmlelement(e,kode_srp||'@') order by kode_srp).extract('//text()') || '@@' ||
			xmlagg(xmlelement(e,lebar||'@') order by kode_srp).extract('//text()') || '@@' ||
			xmlagg(xmlelement(e,panjang||'@') order by kode_srp).extract('//text()') || '@@' ||
			xmlagg(xmlelement(e,hasil||'@') order by kode_srp).extract('//text()') || '@@' ||
			xmlagg(xmlelement(e,reject||'@') order by kode_srp).extract('//text()') || '@@' ||
			xmlagg(xmlelement(e,sisa||'@') order by kode_srp).extract('//text()')
			from erp_sticker_bhn where id_sticker=du.id) srp
			from erp_sticker du join erp_tek_mesin ta on ta.id=du.id_mesin join erp_karyawan ha on ha.id=du.id_pengawas
			where du.shift || du.pp || du.tgl=(select shift || pp || tgl from erp_sticker where id='$id_cetak') order by du.mulai");
		return $query->result_array();
	}

}