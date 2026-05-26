<?php class M_ipb_realisasi extends CI_Model {

	function bagian ($id_kary) {
		return $this->db->query("Select distinct id, bagian from
			(select distinct hb.nama bagian, hb.id from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'
			union
			select distinct hb.nama bagian, hb.id from erp_bagian hb join erp_jabatan_rangkap hf on hf.id_bagian=hb.id where hf.id_karyawan='$id_kary')
			order by bagian");
	}

	function kk() {
		return $this->db->query("Select * from erp_kk order by desain desc, tgl_proses desc, nomer desc");
	}

	function jenis() {
		return $this->db->query("Select distinct jenis from erp_gdg_location where jenis='BAHAN CHEMICAL' or jenis='BAHAN NON CHEMICAL' order by jenis");
	}

	function mesin() {
		return $this->db->query("Select distinct ta.id, ta.nama_mesin, gr.id_bagian
			from erp_tek_mesin ta left join erp_ipb_bp_realisasi gr on gr.id_mesin=ta.id
			order by ta.nama_mesin");
	}

	function auto_no($id_edit, $thn) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') thn from erp_ipb_bp_realisasi where id='$id_edit'");
			$nmr = $query->row_array()['NMR'];
			$thn_edit = $query->row_array()['THN'];

			if ($thn_edit == $thn) {return $nmr;}
		}

		$query = $this->db->query("Select max(substr(nmr, -4)) nmr from erp_ipb_bp_realisasi where to_char(tgl,'YY')='$thn'");
		$data = $query->row_array();
		$urut = sprintf('%04d', $data['NMR'] + 1);
		return $thn . '-' . $urut;
	}

	function isi_mesin($id_bagian) {
		$query = $this->db->query("Select id, nama_mesin from erp_tek_mesin where id_bagian='$id_bagian'");
		return $query->result_array();
	}

	function isi_barang($id_bagian) {
		$query = $this->db->query("Select distinct gk.id_barang, pc.nama, pc.spesifikasi, gk.satuan from erp_ipb_bp_detail gk join erp_barang pc on pc.id=gk.id_barang join erp_ipb_bp gj on gj.id=gk.id_ipb where pc.aktif<>0 and
			gj.id_bagian='$id_bagian' order by pc.nama");
		return $query->result_array();
	}

	function filter($tgl1, $tgl2, $id_bagian, $kk, $id_mesin, $jenis, $cari) {
		$query = $this->db->query("Select distinct gr.id, to_char(gr.tgl,'DD-MM-YYYY') tgl, cj.nomer kk, ta.nama_mesin, pc.nama bahan, gr.satuan, gr.qty, gr.tgl t_tgl
			from erp_ipb_bp_realisasi gr left join erp_kk cj on cj.id=gr.id_kk join erp_barang pc on pc.id=gr.id_barang join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location left join erp_tek_mesin ta on ta.id=gr.id_mesin
			where to_char(gr.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and gr.id_bagian='$id_bagian' and (case when '$kk'='All' then 'All' else cj.nomer end)='$kk' and (case when '$id_mesin'='All' then 'All' else to_char(gr.id_mesin) end)='$id_mesin' and gh.jenis='$jenis' and pc.nama like '%$cari%'
			order by gr.tgl desc, pc.nama");
		return $query->result_array();
	}

	function isi_stok($id_bagian, $id_barang) {
		$query = $this->db->query("Select
			(select sum(addendum) from erp_cc_so where id_barang='$id_barang' and id_bagian='$id_bagian' and status='1') saldo_awal,
			(select sum(qty) from erp_ipb_bp_realisasi where id_bagian='$id_bagian' and id_barang='$id_barang') qty_pakai,
			(select sum(gk.qty) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb where gj.id_bagian='$id_bagian' and gk.id_barang='$id_barang') qty_bon
			from dual");
		return $query->row_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_ipb_bp_realisasi where nmr=(select nmr from erp_ipb_bp_realisasi where id='$id_edit')");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_ipb_bp_realisasi");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id_ipb, $nmr, $tgl, $id_bagian, $id_kk, $id_mesin, $id_barang, $satuan, $qty) {
		$this->db->query("Insert into erp_ipb_bp_realisasi(id, nmr, tgl, id_bagian, id_kk, id_mesin, id_barang, satuan, qty, updated, tipe, status) values('$id_ipb', '$nmr', '$tgl', '$id_bagian', '$id_kk', '$id_mesin', '$id_barang', '$satuan', '$qty', sysdate, '0', '1')");
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_ipb_bp_realisasi where id='$id_hapus'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select nmr, to_char(tgl,'DD-MM-YYYY') tgl, id_bagian, id_kk, id_mesin, id_barang, satuan, qty from erp_ipb_bp_realisasi where nmr=(select nmr from erp_ipb_bp_realisasi where id='$id_edit')");
		return $query->result_array();
	}

	function s_filter($tgl1, $tgl2, $id_bagian, $jenis, $cari) {
		$query = $this->db->query("Select distinct gj.jenis, pc.nama, gk.satuan,
			(select sum(addendum) from erp_cc_so where id_barang=pc.id and id_bagian=gj.id_bagian and status='1') s_opname,
			(select nvl(sum(gk2.qty),0) from erp_ipb_bp_detail gk2 join erp_ipb_bp gj2 on gj2.id=gk2.id_ipb where gk2.id_barang=pc.id and to_char(gj2.tgl,'YYMMDD')<'$tgl1' and gj2.id_bagian=gj.id_bagian) awal_bon,
			(select nvl(sum(qty),0) from erp_ipb_bp_realisasi where id_barang=pc.id and id_bagian=gj.id_bagian and to_char(tgl,'YYMMDD')<'$tgl1') awal_produksi,
			(select nvl(sum(gk2.qty),0) from erp_ipb_bp_detail gk2 join erp_ipb_bp gj2 on gj2.id=gk2.id_ipb where gk2.id_barang=pc.id and to_char(gj2.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and gj2.id_bagian=gj.id_bagian) qty_bon,
			(select nvl(sum(qty),0) from erp_ipb_bp_realisasi where id_barang=pc.id and id_bagian=gj.id_bagian and to_char(tgl,'YYMMDD') between '$tgl1' and '$tgl2') qty_produksi
			from erp_ipb_bp gj join erp_ipb_bp_detail gk on gk.id_ipb=gj.id join erp_barang pc on pc.id=gk.id_barang
			where gj.jenis='$jenis' and pc.nama like '%$cari%' and gj.id_bagian='$id_bagian'
			order by pc.nama");
		return $query->result_array();
	}

}