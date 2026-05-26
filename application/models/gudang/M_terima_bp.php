<?php class M_terima_bp extends CI_Model {

	function id_kary() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];	
	}

	function unit() {
		return $this->db->query("Select * from erp_hr_unit order by kd_unit");
	}

	function bagian() {
		return $this->db->query("Select distinct hb.nama, hb.kd_dept_simpg from erp_bagian hb join erp_gdg_terima gs on gs.kd_bagian=hb.kd_dept_simpg order by hb.nama");
	}

	function dt_sip() {
		return $this->db->query("Select distinct tanggal, no_sip from erp_ppic_sip order by tanggal desc, no_sip desc");
	}

	function dt_po() {
		return $this->db->query("Select distinct tgl, nomer from erp_po order by tgl desc, nomer desc");
	}

	function jenis($kd_menu) {
		$id_kary = $this->id_kary();
		return $this->db->query("Select distinct gh.jenis from erp_gdg_location gh join erp_gdg_location_pic gi on gi.id_location=gh.id where gi.id_karyawan='$id_kary' and (case when '$kd_menu'='gdg_perdana' then '$kd_menu' else gh.jenis end)<>'BAHAN BAKU'
			order by gh.jenis");
	}

	function dt_barang($kd_unit, $kode_dept) {
		return $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi, gh.jenis
			from erp_barang pc join erp_ppic_sip_detail cf on pc.id=cf.id_barang join erp_ppic_sip ce on ce.id=cf.id_sip join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location
			where substr(ce.no_sip,14,2)='$kode_dept' and ce.kd_unit='$kd_unit'
			order by pc.nama");
	}

	function barang_non_tunai() {
		$id_kary = $this->id_kary();
		return $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi, pc.satuan, gh.jenis
			from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location join erp_gdg_location_pic gi on gi.id_location=gh.id
			where gi.id_karyawan='$id_kary'
			order by pc.nama");
	}

	function dt_bagian($id_akun) {
		$query = $this->db->query("Select distinct hb.kd_dept_simpg, ha.kd_unit
			from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id join erp_akun aa on aa.id_karyawan=ha.id
			where aa.id='$id_akun'
			union
			select distinct hb.kd_dept_simpg, hf.kd_unit
			from erp_bagian hb join erp_jabatan_rangkap hf on hf.id_bagian=hb.id join erp_karyawan ha on ha.id=hf.id_karyawan join erp_akun aa on aa.id_karyawan=ha.id
			where aa.id='$id_akun'");
		return $query->result_array();
	}

	function filter($tgl1, $tgl2, $kd_unit, $jenis, $sip, $cari, $po, $dt_bagian, $dt_unit, $kd_akses, $bagian) {
		$dt_bagian = implode("','", $dt_bagian);
		$dt_unit = implode("','", $dt_unit);
		$dt_bagian = $kd_akses == '2' ? $kd_akses : $dt_bagian;

		$query = $this->db->query("Select distinct gs.id, gt.id id_detail, hd.unit, gs.nmr, to_char(gs.tgl,'DD-MM-YYYY') tgl, gs.tgl tgl_desc, ce.no_sip, gs.nmr_sp, pc.nama, pc.spesifikasi, gt.satuan, cf.qty qty_sip, gt.qty qty_datang, gt.keterangan, gs.no_kend, pa.nomer nmr_po, gs.tipe, hb.nama bagian
			from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id join erp_barang pc on pc.id=gt.id_barang join erp_gdg_location_brg gv on gv.id_barang=pc.id join	erp_gdg_location gh on gh.id=gv.id_location join erp_hr_unit hd on hd.kd_unit=gs.kd_unit join erp_bagian hb on hb.kd_dept_simpg=gs.kd_bagian
			left join
			(erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id) on cf.id=gt.id_sip_detail
			left join
			(erp_po pa join erp_po_detail pb on pb.id_po=pa.id) on pb.id=gt.id_po_detail
			where (case when '$kd_unit'='All' then 'All' else gs.kd_unit end)='$kd_unit' and to_char(gs.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$bagian'='All' then 'All' else gs.kd_bagian end)='$bagian' and (case when '$jenis'='All' then 'All' else gh.jenis end)='$jenis' and (case when '$sip'='All' then 'All' else ce.no_sip end)='$sip' and (case when '$po'='All' then 'All' else pa.nomer end)='$po' and (upper(pc.nama) like '%$cari%' or upper(pc.spesifikasi) like '%$cari%') and (case when '$kd_akses'='2' then '$kd_akses' else gs.kd_bagian end) in ('".$dt_bagian."') and gs.kd_unit in ('".$dt_unit."')
			order by gs.tgl desc, gs.nmr desc, pc.nama");
		return $query->result_array();
	}

	function dt_akun() {
		$id_kary = $this->id_kary();
		$query = $this->db->query("Select distinct ha.kd_unit, hb.kd_dept_simpg kode_bagian from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'");
		$data = $query->row_array();
		return array($data['KODE_BAGIAN'],$data['KD_UNIT'],$id_kary);
	}

	function auto_no($id_edit, $thn, $kd_unit) {
		$kode_bagian = $this->dt_akun()[0];
		$query = $this->db->query("Select kode_transaksi from erp_hr_unit where kd_unit='$kd_unit'");
		$data = $query->row_array();
		$kode_transaksi = str_replace("PNP", "SP", $data['KODE_TRANSAKSI']);

		if ($id_edit != '') {
			$query = $this->db->query("Select to_char(tgl,'YY') thn, nmr, kd_unit from erp_gdg_terima where id='$id_edit'");
			$data_edit = $query->row_array();
			if ($data_edit['THN'] == $thn && $data_edit['KD_UNIT'] == $kd_unit) {return $data_edit['NMR'];}
		}

		$query = $this->db->query("Select max(substr(nmr,0,5)) nmr from erp_gdg_terima where to_char(tgl,'YY')='$thn' and kd_unit='$kd_unit' and kd_bagian='$kode_bagian'");
		$data = $query->row_array();
		$urut = sprintf('%05d', $data['NMR'] + 1);
		return $urut . $kode_transaksi . $thn;
	}

	function data_sip($id_barang, $jenis, $kd_unit) {
		$year = implode("','", range(date('Y')-1, date('Y')));
		$kode_bagian = $this->dt_akun()[0];
		$query = $this->db->query("Select distinct cf.id id_sip_detail, ce.tanggal, to_char(ce.tanggal,'DD-MM-YYYY') tgl, ce.no_sip, cf.satuan, pc.kode, pc.nama, pc.spesifikasi, cf.qty qty_sip, pa.nomer nmr_po,
			(select nvl(sum(qty),0) from erp_gdg_terima_detail where id_sip_detail=cf.id) qty_datang,
			concat(cf.satuan, (select xmlagg(xmlelement(e,','||konversi)).extract('//text()') from erp_pemb_satuan_konv where id_barang=cf.id_barang)) satuan_konv
			from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location left join
			(erp_po_detail pb join erp_po pa on pa.id=pb.id_po) on pb.id_sip_detail=cf.id
			where ce.kd_unit='$kd_unit' and gh.kd_unit='$kd_unit' and cf.final='0' and substr(ce.no_sip,14,2)='$kode_bagian' and gh.jenis='$jenis' and
			(case when '$id_barang'='All' then 'All' else to_char(pc.id) end)='$id_barang' and to_char(ce.tanggal, 'YYYY') in ('".$year."')
			order by ce.tanggal desc, ce.no_sip, pc.nama");
		return $query->result_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_gdg_terima where id='$id_edit'");
		$this->db->query("Delete from erp_gdg_terima_detail where id_gdg_terima='$id_edit'");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_terima");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function kd_bagian() {
		$id_kary = $this->id_kary();
		$query = $this->db->query("Select hb.kd_dept_simpg from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id where ha.id='$id_kary'");
		return $query->row_array()['KD_DEPT_SIMPG'];
	}

	function simpan($id, $kd_unit, $kd_bagian, $tgl, $nmr, $nmr_sp, $id_akun, $no_kend, $tipe) {
		$this->db->query("Insert into erp_gdg_terima(id, kd_unit, kd_bagian, tgl, nmr, nmr_sp, id_akun, updated, no_kend, tipe) values('$id','$kd_unit','$kd_bagian','$tgl','$nmr','$nmr_sp','$id_akun',sysdate,'$no_kend','$tipe')");
	}

	function id_barang($id_sip_detail) {
		$query = $this->db->query("Select concat(cf.id_barang, concat('@', nvl(pb.id,0))) id from erp_ppic_sip_detail cf left join erp_po_detail pb on pb.id_sip_detail=cf.id where cf.id='$id_sip_detail'");
		$data = $query->row_array();
		return explode('@', $data['ID']);
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_terima_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($id_detail, $id, $id_sip_detail, $id_barang, $qty, $satuan, $deskripsi, $id_po_detail) {
		$this->db->query("Insert into erp_gdg_terima_detail(id, id_gdg_terima, id_sip_detail, id_barang, qty, satuan, keterangan, status, id_po_detail) values('$id_detail','$id','$id_sip_detail','$id_barang','$qty','$satuan','$deskripsi',1,'$id_po_detail')");
	}

	function hapus($id_detail) {
		$query = $this->db->query("Select * from erp_gdg_terima_detail where id_gdg_terima=(select id_gdg_terima from erp_gdg_terima_detail where id='$id_detail')");
		if ($query->num_rows() == '1') {
			$this->db->query("Delete from erp_gdg_terima where id=(select id_gdg_terima from erp_gdg_terima_detail where id='$id_detail')");
		}
		$this->db->query("Delete from erp_gdg_terima_detail where id='$id_detail'");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select to_char(gs.tgl,'DD-MM-YYYY') tgl, gs.nmr, gs.kd_unit, gs.nmr_sp, gt.id_sip_detail, ce.no_sip nmr_sip, gt.satuan, cf.qty qty_sip, gt.qty qty_datang, gt.keterangan deskripsi, gs.no_kend,
			(select nama from erp_barang where id=cf.id_barang) nama,
			(select spesifikasi from erp_barang where id=cf.id_barang) spesifikasi,
			(select xmlagg(xmlelement(e,pa.nomer||', ')).extract('//text()') from erp_po pa join erp_po_detail pb on pb.id_po=pa.id where pb.id_sip_detail=cf.id) nmr_po,
			concat(cf.satuan, (select xmlagg(xmlelement(e,','||konversi)).extract('//text()') from erp_pemb_satuan_konv where id_barang=cf.id_barang)) satuan_konv
			from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id join erp_ppic_sip_detail cf on cf.id=gt.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip
			where gs.id='$id_edit' order by gt.id");
		return $query->result_array();
	}

	function cetak($dt_cetak) {
		$kd_unit = $this->dt_akun()[1];
		$id_cetak = implode("','", $dt_cetak);
		$query = $this->db->query("Select pc.id, pc.kode, pc.nama, pc.spesifikasi, gv.no_lokasi, gt.qty
			from erp_barang pc join erp_gdg_terima_detail gt on gt.id_barang=pc.id join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location
			where gh.kd_unit='$kd_unit' and gt.id in ('".$id_cetak."') order by pc.nama");
		return $query->result_array();
	}

}