<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_rewind extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)=4 order by desain desc");
	}

	function operator() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' and ha.id_jabatan=12 and ha.kd_unit='12' order by ha.nama");
	}

	function kk() {
		return $this->db->query("Select id, desain, keterangan_penggunaan kk from erp_gudang_order order by id desc");
	}

	function proses() {
		return $this->db->query("Select distinct proses from erp_prod_rewind order by proses desc");
	}

	function seri() {
		return $this->db->query("Select distinct upper(seri) seri from erp_gudang_order where length(seri)>3 order by upper(seri)");
	}

	function kode() {
		return $this->db->query("Select distinct desain, kode from erp_prod_rewind order by desain desc, kode desc");
	}

	function auto_no($id_edit, $desain) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, desain from erp_prod_rewind where id='$id_edit'");
			$data = $query->row_array();

			if ($data['DESAIN'] == $desain) {
				return $data['NMR'];
			}
		}

		$query = $this->db->query("Select max(nmr) nmr from erp_prod_rewind where desain='$desain'");
		$data = $query->row_array();
		return sprintf('%03d', $data['NMR']);
	}

	function isi_operator($desain, $shift, $proses) {
		$query = $this->db->query("Select xmlagg(xmlelement(e,id||',')).extract('//text()') id
			from
			(select distinct ha.id, id_rewind
			from erp_karyawan ha join erp_prod_rewind_opt dq on dq.id_operator=ha.id join erp_prod_rewind dp on dp.id=dq.id_rewind
			where dp.desain='$desain' and dp.shift='$shift' and dp.proses='$proses' and dq.id_rewind=(select max(id) from erp_prod_rewind where desain=dp.desain and shift=dp.shift and proses=dp.proses)
			order by dq.id_rewind)");
		return $query->row_array();
	}

	function isi_kode($proses, $id_gudang_order) {
		if ($proses == 'Rewind 1') {
			$query = $this->db->query("Select distinct df.kode,
				((select sum(qty) from erp_prod_mutasi where kode=df.kode and station_awal=df.station_awal)-(select nvl(sum(hasil+reject),0) from erp_prod_rewind where kode=df.kode and id_gudang_order=df.id_gudang_order and proses='Rewind 1')) qty
				from erp_prod_mutasi df
				where df.id_gudang_order='$id_gudang_order' and df.station_awal='Emboss' and
				(select sum(qty) from erp_prod_mutasi where kode=df.kode and station_awal=df.station_awal)>(select nvl(sum(hasil+reject),0) from erp_prod_rewind where kode=df.kode and id_gudang_order=df.id_gudang_order and proses='Rewind 1')
				order by df.kode");
		}else{
			$query = $this->db->query("Select distinct dp.kode,
				((select sum(hasil) from erp_prod_rewind where kode=dp.kode and id_gudang_order=dp.id_gudang_order and proses='Rewind 1')-(select nvl(sum(hasil+reject),0) from erp_prod_rewind where kode=dp.kode and id_gudang_order=dp.id_gudang_order and proses='Rewind 2')) qty
				from erp_prod_rewind dp
				where dp.id_gudang_order='$id_gudang_order' and dp.proses='Rewind 1' and
				(select sum(hasil) from erp_prod_rewind where kode=dp.kode and id_gudang_order=dp.id_gudang_order and proses='Rewind 1')>(select nvl(sum(hasil+reject),0) from erp_prod_rewind where kode=dp.kode and id_gudang_order=dp.id_gudang_order and proses='Rewind 2')
				order by dp.kode");
		}

		$query_seri = $this->db->query("Select seri from erp_gudang_order where id='$id_gudang_order'");
		return array($query->result_array(), $query_seri->row_array());
	}

	function filter($tgl1, $tgl2, $desain, $id_gudang_order, $proses, $seri, $kode) {
		$query = $this->db->query("Select dp.id, dp.nmr, dp.desain, dp.tgl, dp.shift, dp.proses, ca.keterangan_penggunaan kk, ca.seri, dp.kode, to_char(dp.mulai,'HH24:MI') mulai, to_char(dp.selesai,'HH24:MI') selesai, dp.panjang, dp.hasil, dp.reject, dp.sisa,
			(select xmlagg(xmlelement(e,nama||', ')).extract('//text()') from erp_karyawan ha join erp_prod_rewind_opt dq on dq.id_operator=ha.id where dq.id_rewind=dp.id) operator,
			(select count(id) from erp_prod_rewind where kode=dp.kode and id>dp.id) qty_next
			from erp_prod_rewind dp join erp_gudang_order ca on ca.id=dp.id_gudang_order
			where to_char(dp.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and dp.desain='$desain' and (case when '$id_gudang_order'='All' then 'All' else to_char(dp.id_gudang_order) end)='$id_gudang_order' and (case when '$proses'='All' then 'All' else dp.proses end)='$proses' and (case when '$seri'='All' then 'All' else (select seri from erp_gudang_order where id=dp.id_gudang_order) end)='$seri' and (case when '$kode'='All' then 'All' else dp.kode end)='$kode'
			order by ca.desain desc, dp.mulai desc");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) id from erp_prod_rewind");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan($id, $desain, $tgl, $shift, $proses, $id_gudang_order, $kode, $mulai, $selesai, $panjang, $baik, $reject, $sisa, $nmr) {
		$this->db->query("Insert into erp_prod_rewind(id, nmr, desain, tgl, shift, proses, id_gudang_order, kode, mulai, selesai, panjang, hasil, reject, sisa, status) values('$id', '$nmr', '$desain', '$tgl', '$shift', '$proses', '$id_gudang_order', '$kode', to_date('$mulai','DD-MM-YYYY HH24:MI:SS'), to_date('$selesai','DD-MM-YYYY HH24:MI:SS'), '$panjang', '$baik', '$reject', '$sisa', '1')");
	}

	function urut_opt() {
		$query = $this->db->query("Select max(id) id from erp_prod_rewind_opt");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_opt($id_opt, $id, $id_operator) {
		$this->db->query("Insert into erp_prod_rewind_opt(id, id_rewind, id_operator, updated, status) values('$id_opt', '$id', '$id_operator', sysdate, '1')");
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select * from erp_prod_rewind where id='$id_cetak'");
		$data = $query->row_array();
		$proses = $data['PROSES'];
		$shift = $data['SHIFT'];
		$id_gudang_order = $data['ID_GUDANG_ORDER'];
		$tgl = $data['TGL'];

		$query = $this->db->query("Select distinct dp.proses, dp.shift, ca.seri, ca.keterangan_penggunaan kk, pc.nama, pc.spesifikasi, pc.ukuran, dp.nmr, dp.desain, dp.tgl, dp.kode, dp.panjang, dp.hasil, dp.reject, dp.sisa, to_char(dp.mulai,'HH24:MI') mulai, to_char(dp.selesai,'HH24:MI') selesai, dp.keterangan, dp.mulai t_mulai
			from erp_prod_rewind dp join erp_gudang_order ca on ca.id=dp.id_gudang_order join erp_prod_rewind_opt dq on dq.id_rewind=dp.id join erp_karyawan ha on ha.id=dq.id_operator join erp_barang pc on pc.id=ca.id_barang
			where dp.proses='$proses' and dp.shift='$shift' and dp.id_gudang_order='$id_gudang_order' and dp.tgl='$tgl'
			order by dp.mulai, dp.kode");

		$opt = $this->db->query("Select xmlagg(xmlelement(e, nvl(ha.nick_name, upper(ha.nama))||',')).extract('//text()') operator from erp_karyawan ha join erp_prod_rewind_opt dq on dq.id_operator=ha.id where dq.id_rewind='$id_cetak' order by nvl(ha.nick_name, ha.nama)");

		$query_downtime = $this->db->query("Select distinct (to_char(dk.mulai,'hh24:mi') || ' - ' || to_char(dk.selesai,'hh24:mi') || ' ' || dl.keterangan) downtime, dk.mulai mulai_sort
			from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime join erp_kk_detail ck on ck.id_kk=dk.id_kk join erp_gudang_order ca on ca.id_relasi=ck.id
			where dk.tgl='$tgl' and dk.proses='$proses' and ca.id='$id_gudang_order' and dk.shift='$shift'
			order by dk.mulai");

		return array($query->result_array(), $opt->row_array(), $query_downtime->result_array());
	}

	function edit($id_edit) {
		$query = $this->db->query("Select dp.desain, dp.tgl, dp.shift, dp.proses, dp.id_gudang_order, dp.kode, to_char(dp.mulai,'HH24:MI') mulai, to_char(dp.selesai,'HH24:MI') selesai, dp.panjang, dp.hasil, dp.reject,
			(Select xmlagg(xmlelement(e,id_operator||',')).extract('//text()') id from erp_prod_rewind_opt where id_rewind=dp.id) id_operator
			from erp_prod_rewind dp
			where dp.id='$id_edit'");
		return $query->result_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_prod_rewind where id='$id_hapus'");
		$this->db->query("Delete from erp_prod_rewind_opt where id_rewind='$id_hapus'");
	}

}