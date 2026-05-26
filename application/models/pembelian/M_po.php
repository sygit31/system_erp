<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_po extends CI_Model {

	function db_perdana() {
		$perdana = $this->load->database('perdana', TRUE);
		return $perdana;
	}

	function karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		
		$query = $this->db->query("Select substr(replace(ha.nama,' ',''),0,6) username, hb.nama bagian, ha.id_bagian, hb.kd_dept_simpg from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'");
		$data = $query->row_array();
		return array($data['USERNAME'], $data['BAGIAN'], $data['ID_BAGIAN'], $data['KD_DEPT_SIMPG'], $id_kary);
	}
	
	function unit() {
		return $this->db->query("Select * from erp_hr_unit where status<>'0' order by unit desc");
	}

	function supplier() {
		return $this->db->query("Select id, nama, kode_jenis, kode_keuangan from erp_supplier where aktif<>'0' order by nama");
	}

	function bayar() {
		return $this->db->query("Select * from erp_pemb_cara_bayar where aktif='1' order by keterangan");
	}

	function no_po() {
		return $this->db->query("Select distinct nomer, tgl from erp_po order by tgl desc");
	}

	function jenis() {
		return $this->db->query("Select * from erp_pemb_jenis order by id");
	}

	function jenis_bahan() {
		return $this->db->query("Select distinct jenis kategori from erp_barang order by jenis");
	}

	function kategori() {
		return $this->db->query("Select * from erp_ppic_kategori order by kategori");
	}

	function satuan() {
		return $this->db->query("Select * from erp_pemb_satuan order by satuan");
	}

	function bahan() {
		return $this->db->query("Select distinct  cf.id_barang, case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama, pc.spesifikasi
			from erp_barang pc join erp_ppic_sip_detail cf on cf.id_barang=pc.id join erp_po_detail pb on pb.id_sip_detail=cf.id
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode 
			order by nama");
	}

	function filter($tgl1, $tgl2, $supplier, $nmr_po, $kd_unit, $jenis, $kategori_hpd, $kategori, $id_barang) {
		return $this->db->query("Select pb.id_po, pe.nama supplier, pb.id id_detail_po, to_char(pa.tgl,'dd-mm-yyyy') tgl, pa.nomer, pc.jenis, case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama_barang, pc.spesifikasi, pb.satuan, pb.qty, pb.harga, pb.mata_uang, to_char(pb.del_time,'dd-mm-yyyy') del_time, pb.status,
			(select cn2.kategori from erp_ppic_kategori cn2 join erp_ppic_sip_detail cf2 on cf2.kd_kategori=cn2.kode where cf2.id=cf.id) kategori,
			(Select nvl(sum(qty),0) from erp_pemb_sp_detail where id_po_detail=pb.id) qty_datang,
			(Select count(pm2.id) from erp_pemb_sp_detail pm2 join erp_po_detail pb2 on pb2.id=pm2.id_po_detail where pb2.id_po=pb.id_po) qty_sp
			from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_supplier pe on pd.id_supplier=pe.id join erp_pemb_jenis pq on pq.id=pe.kode_jenis join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode 
			where pb.aktif='1' and to_char(pa.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$nmr_po'='All..' then 'All..' else pa.nomer end)='$nmr_po' and pa.kd_unit='$kd_unit' and (case when '$supplier'='All..' then 'All..' else trim(pe.nama) end)='$supplier' and (case when '$jenis'='All..' then 'All..' else pq.jenis end)='$jenis' and (case when '$kategori'='All..' then 'All..' else pc.jenis end)='$kategori' and (case when '$kategori_hpd'='All..' then 'All..' else cf.kd_kategori end)='$kategori_hpd' and (case when '$id_barang'='All..' then 'All..' else to_char(cf.id_barang) end)='$id_barang'
			order by pa.tgl desc, pa.nomer desc, pc.nama");
	}

	function data_deadline() {
		$tgl1 = date('ym01');
		$tgl2 = date('ymt');

		return $this->db->query("Select pb.id_po, pe.nama supplier, pb.id id_detail_po, to_char(pa.tgl,'dd-mm-yyyy') tgl, pa.nomer, pc.nama nama_barang, pc.jenis, pc.spesifikasi, pb.satuan, pb.qty, pb.harga, pb.mata_uang, to_char(pb.del_time,'dd-mm-yyyy') del_time, pb.status,
			(Select nvl(terkirim,0) from tbl_detail_spp where trim(nomer_spp)=trim(pa.nomer) and kode_barang=pc.kode_simpg and rownum=1) qty_datang,
			(select count(nomer_spp) from tbl_detail_sp where trim(nomer_spp)=trim(pa.nomer)) qty_sp,
			(Select final from tbl_detail_spp where trim(nomer_spp)=trim(pa.nomer) and kode_barang=pc.kode_simpg and rownum=1) final
			from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_supplier pe on pd.id_supplier=pe.id join erp_hr_unit hd on hd.kd_unit=pa.kd_unit join erp_pemb_jenis pq on pq.id=pe.kode_jenis
			where to_char(pb.del_time,'YYMMDD') between '$tgl1' and '$tgl2' and pb.aktif='1'
			order by pb.del_time, pa.nomer desc, pc.nama");
	}

	function filter_deadline($tgl1, $tgl2, $supplier, $nmr_po, $unit, $jenis, $cari, $kategori) {
		return $this->db->query("Select pb.id_po, pe.nama supplier, pb.id id_detail_po, to_char(pa.tgl,'dd-mm-yyyy') tgl, pa.nomer, pc.nama nama_barang, pc.jenis, pc.spesifikasi, pb.satuan, pb.qty, pb.harga, pb.mata_uang, to_char(pb.del_time,'dd-mm-yyyy') del_time, pb.status,
			(Select nvl(terkirim,0) from tbl_detail_spp where trim(nomer_spp)=trim(pa.nomer) and kode_barang=pc.kode_simpg and rownum=1) qty_datang,
			(select count(nomer_spp) from tbl_detail_sp where trim(nomer_spp)=trim(pa.nomer)) qty_sp,
			(Select final from tbl_detail_spp where trim(nomer_spp)=trim(pa.nomer) and kode_barang=pc.kode_simpg and rownum=1) final
			from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_barang pc on pc.id=pd.id_barang join erp_supplier pe on pd.id_supplier=pe.id join erp_hr_unit hd on hd.kd_unit=pa.kd_unit join erp_pemb_jenis pq on pq.id=pe.kode_jenis
			where pb.aktif='1' and to_char(pb.del_time,'YYMMDD') between '$tgl1' and '$tgl2' and upper(pc.nama) like '%$cari%' and (case when '$nmr_po'='All' then 'All' else pa.nomer end)='$nmr_po' and (case when '$unit'='All' then 'All' else hd.unit end)='$unit' and (case when '$supplier'='All' then 'All' else trim(pe.nama) end)='$supplier' and (case when '$jenis'='All' then 'All' else pq.jenis end)='$jenis' and (case when '$kategori'='All' then 'All' else pc.jenis end)='$kategori'
			order by pb.del_time, pa.nomer desc, pc.nama");
	}

	function auto_no($id_edit, $bln, $thn, $jenis, $id_supplier, $kd_unit, $kd_transaksi, $kd_jenis) {
		$kode = '';

		$query = $this->db->query("Select to_char(pa.tgl, 'YY') year, pa.nomer, pd.id_supplier, ce.kd_unit from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip where pa.id='$id_edit'");
		$data = $query->row_array();

		if ($id_edit == '' || $thn != $data['YEAR'] || $id_supplier != $data['ID_SUPPLIER'] || $kd_unit != $data['KD_UNIT']) {
			if ($jenis == '1') {
				$query = $this->db->query("Select max(substr(nomer,0,6)) urut from erp_po where kd_unit='$kd_unit' and to_char(tgl,'YY')='$thn' and substr(nomer,16,1)='P'");
			} else if ($jenis == '2') {
				$query = $this->db->query("Select max(substr(nomer,0,6)) urut from erp_po where kd_unit='$kd_unit' and to_char(tgl,'YY')='$thn' and substr(nomer,16,1)='R' and upper(substr(nomer,0,6))=lower(substr(nomer,0,6))");
			} else if ($jenis == '3') {
				$query = $this->db->query("Select regexp_replace(substr(nomer,0,6), '[0-9]', '') kode from erp_po where to_char(tgl,'YY')>='19' and id_supplier='$id_supplier' order by tgl desc");
				$data = $query->row_array();
				$kode = $data['KODE'];

				$query = $this->db->query("Select max(regexp_replace(substr(nomer,0,6), '$kode', '')) urut from erp_po
					where kd_unit='$kd_unit' and to_char(tgl,'YY')='$thn' and regexp_replace(substr(nomer,0,6), '[0-9]', '')='$kode'");
			} else if ($jenis == '4') {
				$kode = 'IMP';
				$query = $this->db->query("Select max(regexp_replace(substr(nomer,0,6), '$kode', '')) urut from erp_po
					where kd_unit='$kd_unit' and to_char(tgl,'YY')='$thn' and regexp_replace(substr(nomer,0,6), '[0-9]', '')='$kode'");
			}
			$data = $query->row_array();
			$urut = sprintf('%06d', $data['URUT'] + 1) . $kode;
			$nmr_po = substr($urut, -6) . $kd_transaksi . $kd_jenis . '/' . $bln . '-' . $thn;
		}else{
			$nmr_po = $data['NOMER'];			
		}

		return $nmr_po;
	}

	function investasi($kd_unit) {
		if ($kd_unit == '12') {
			$query = $this->db->query("Select a.nomor_investasi, a.total_budget,
				(select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pa.kd_unit='$kd_unit' and pa.no_investasi=a.nomor_investasi) terpakai
				from v_invest a order by a.nomor_investasi desc");
		}else{
			$query =  $this->db->query("Select a.nomor_investasi,
				(nominal + nvl((Select sum(nominal) from hpd_ijin_investasi_adendum where nomor_investasi=a.nomor_investasi),0)) total_budget,
				(select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pa.kd_unit='$kd_unit' and pa.no_investasi=a.nomor_investasi) terpakai
				from hpd_ijin_investasi_nom a order by nomor_investasi desc");
		}
		return $query->result_array();
	}

	// Jika Sakti Lemot
	function data_sip($id_supplier, $kd_unit) {
		$query = $this->db->query("Select distinct pd.id id_material_supply, pd.mata_uang, case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama, pc.spesifikasi, cf.satuan, cf.id id_sip_detail, ce.no_sip, cf.qty qty_sip, pc.no_rekjurnal, ha.nama pemesan, ce.tanggal, ce.no_sip nomor_sakti,
			(select sum(qty) from erp_po_detail where id_sip_detail=cf.id) qty_po,
			(Select nama from erp_bagian where kd_dept_simpg=substr(ce.no_sip,14,2) and rownum=1) bagian
			from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang join erp_material_supply pd on pd.id_barang=pc.id join erp_karyawan ha on ha.id=ce.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode    
			where pd.id_supplier='$id_supplier' and ce.kd_unit='$kd_unit' and cf.final='0'
			order by ha.nama, ce.no_sip, ce.tanggal, nama");
		return $query->result_array();
	}

	function data_sip2($id_supplier, $kd_unit) {
		$query = $this->db->query("Select distinct pd.id id_material_supply, pd.mata_uang, pc.nama, pc.spesifikasi, cf.satuan, cf.id id_sip_detail, ce.no_sip, cf.qty qty_sip, pc.no_rekjurnal, ha.nama pemesan, hb.nama bagian, ce.tanggal,
			(case when ce.kd_unit='12' then
			(Select nomor_sip from sip_item where nomor_sip=concat(concat(substr(ce.no_sip,-2),substr(ce.no_sip,0,4)),substr(ce.no_sip,14,2)) and kode_barang=pc.kode_simpg) else
			(Select nomor_sip from hpd_sip_item where nomor_sip=concat(concat(substr(ce.no_sip,-2),substr(ce.no_sip,0,4)),substr(ce.no_sip,14,2)) and kode_barang=pc.kode_simpg) end) nomor_sakti,
			(select sum(qty) from erp_po_detail where id_sip_detail=cf.id) qty_po
			from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang join erp_material_supply pd on pd.id_barang=pc.id join erp_karyawan ha on ha.id=ce.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian
			where pd.id_supplier='$id_supplier' and ce.kd_unit='$kd_unit' and cf.final='0'
			order by ha.nama, ce.no_sip, ce.tanggal, pc.nama");
		return $query->result_array();
	}

	function rekjurnal($id) {
		$query = $this->db->query("Select pc.no_rekjurnal from erp_barang pc join erp_material_supply pd on pd.id_barang=pc.id where pd.id='$id'");
		$data = $query->row_array();
		return $data['NO_REKJURNAL'];
	}

	function sisa_budget($kode_unit, $periode, $rekjurnal) {
		$query = $this->db->query("Select (cc.budget + (select nvl(sum(budget), 0) from erp_cc_budget_add where id_budget=cc.id) -
			(select nvl(sum(pb.qty*pb.harga), 0) from erp_po_detail pb join erp_po pa on pa.id=pb.id_po where pb.no_rekjurnal=cc.no_rekjurnal and pa.kd_unit=cc.kd_unit and to_char(pa.tgl, 'YYMM')=to_char(cc.periode, 'YYMM'))) sisa_budget
			from erp_cc_budget cc
			where cc.status='1' and cc.kd_unit='$kode_unit' and to_char(cc.periode, 'YYMM')='$periode' and cc.no_rekjurnal='$rekjurnal'");
		$data = $query->row_array();
		return $data['SISA_BUDGET'];
	}

	function harga_edit($id_po, $rekjurnal) {
		$query = $this->db->query("Select nvl(sum(harga*qty),0) harga_edit from erp_po_detail where id_po='$id_po' and no_rekjurnal='$rekjurnal'");
		$data = $query->row_array();
		return $data['HARGA_EDIT'];
	}

	function urut_po() {
		$query = $this->db->query("Select max(id) id from erp_po");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function cek_nomor($urut_po,$kode_unit,$thn,$id,$nmr_po,$jenis) {
		$query = $this->db->query("Select nomer from erp_po where id='$id'");
		$data = $query->row_array();
		$nmr_edit = $data['NOMER'];

		if ($nmr_edit == $nmr_po && $id != '') {return 0;}

		$query = $this->db->query("Select count(id) qty from erp_po where kd_unit='$kode_unit' and substr(nomer,0,6)='$urut_po' and substr(nomer,-2)='$thn' and substr(nomer,16,1)='$jenis'");
		$data = $query->row_array();
		$qty_po_profits = $data['QTY'];

		return $qty_po_profits;
	}

	function cek_validasi($nmr_sakti, $kode_unit) {
		if ($kode_unit == '12') {
			$query = $this->db->query("Select count(nomor_spp) qty from spp_head where nomor_spp='$nmr_sakti' and verifikator is not null");
		}else{
			$query = $this->db->query("Select count(nomor_spp) qty from hpd_spp_head where nomor_spp='$nmr_sakti' and verifikator is not null");
		}

		$data = $query->row_array();
		return $data['QTY'];
	}

	function cek_npwp_supplier($id_supplier) {
		$query = $this->db->query("Select binary_pajak from supplier_sakti where kode=(select kode_keuangan from erp_supplier where id='$id_supplier') and binary_pajak=(select pq.binary_pajak from erp_supplier pe join erp_pemb_jenis pq on pq.id=pe.kode_jenis where pe.id='$id_supplier')");
		return $query->num_rows();
	}

	function cek_kadaluarsa_investasi($kode_unit,$investasi,$tgl) {
		if ($kode_unit == '12') {
			$query = $this->db->query("Select nomor_investasi from ijin_investasi where nomor_investasi='$investasi' and to_char(tgl_final,'YYMMDD')>='$tgl'");
		}else{
			$query = $this->db->query("Select nomor_investasi from hpd_ijin_investasi where nomor_investasi='$investasi' and to_char(tgl_final,'YYMMDD')>='$tgl'");
		}

		return $query->num_rows();
	}

	function cek_pkp($kode_keuangan, $jenis) {
		$query = $this->db->query("Select nppkp from hlg_relasi where kode='$kode_keuangan'");
		$data = $query->row_array();

		if ($query->num_rows() == 0 || ($jenis == 'R' && ($data['NPPKP'] == null || strlen($data['NPPKP']) <= 15)) || ($jenis != 'R' && $data['NPPKP'] != null)) {
			return '';
		}

		return 'ok';
	}

	function simpan($id_po, $nmr, $tanggal, $id_bagian, $id_bayar, $id_kary, $investasi, $kode_unit, $discount, $top, $ppn, $nomor_urut, $id_supplier, $lokal, $kurs) {
		$this->db->query("Insert into erp_po(id, nomer, tgl, id_bagian, tgl_input, id_input, id_cara_bayar, no_investasi, kd_unit, top, discount, ppn, nomor_urut_sakti, id_supplier, lokal, kurs) values('$id_po','$nmr','$tanggal','$id_bagian',sysdate,'$id_kary','$id_bayar','$investasi','$kode_unit','$top','$discount','$ppn','$nomor_urut','$id_supplier','$lokal','$kurs')");
	}

	function update_nmr_profits($nmr, $nomor_urut) {
		$this->db->query("Update erp_po set nomor_urut_sakti='$nomor_urut' where nomer='$nmr'");
	}

	function no_rekjurnal($id_sip_detail) {
		$query = $this->db->query("Select pc.no_rekjurnal from erp_barang pc join erp_ppic_sip_detail cf on cf.id_barang=pc.id where cf.id='$id_sip_detail'");
		$data = $query->row_array();
		return $data['NO_REKJURNAL'];
	}

	function urut_po_detail() {
		$query = $this->db->query("Select max(id) id from erp_po_detail");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function simpan_detail($id_po_detail, $id_po, $qty, $harga, $mata_uang, $del_time, $satuan, $id_material_supply, $id_sip_detail, $no_rekjurnal) {
		$this->db->query("Insert into erp_po_detail(id, id_po, id_material_supply, qty, harga, mata_uang, del_time, status, satuan, id_sip_detail, aktif, no_rekjurnal) values('$id_po_detail','$id_po','$id_material_supply','$qty','$harga','$mata_uang','$del_time','OTW','$satuan','$id_sip_detail','1','$no_rekjurnal')");
	}

	function cetak($nomer_spp) {
		if (substr($nomer_spp,11,3) == 'HLG') {$kd_unit = '12';}else{$kd_unit = '01';}		
		$nomor_spp = substr($nomer_spp,-2).substr($nomer_spp,0,6).substr($nomer_spp,15,1);

		$query = $this->db->query("Select distinct pa.nomer, to_char(pa.tgl,'DD-Mon-YYYY') tgl, pe.nama supplier, pe.alamat, pe.kota, pb.satuan, case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama, pc.spesifikasi, pb.harga, to_char(pb.del_time,'DD-Mon-YYYY') del_time, pa.top, pa.ppn,
			(select sum(qty) from erp_po_detail where id_material_supply=pb.id_material_supply and id_po=pa.id and satuan=pb.satuan and harga=pb.harga) qty,
			(case when '$kd_unit'='12' then
			(Select nomor_urut from spp_head where nomor_spp='$nomor_spp') else
			(Select nomor_urut from hpd_spp_head where nomor_spp='$nomor_spp') end) nomor_spp,
			(Select ha.nick_name from erp_karyawan ha join erp_pejabat pf on pf.id_karyawan=ha.id where pf.kd_unit='$kd_unit' and pf.status='4' and aktif='1' and rownum='1') gm,
			(Select ha.nick_name from erp_karyawan ha join erp_pejabat pf on pf.id_karyawan=ha.id where pf.kd_unit='$kd_unit' and pf.status='3' and aktif='1' and rownum='1') pimpinan,
			(Select ha.nick_name from erp_karyawan ha join erp_pejabat pf on pf.id_karyawan=ha.id where pf.kd_unit='$kd_unit' and pf.status='2' and aktif='1' and rownum='1') akuntan,
			(Select ha.nick_name from erp_karyawan ha join erp_pejabat pf on pf.id_karyawan=ha.id where pf.kd_unit='$kd_unit' and pf.status='1' and aktif='1' and rownum='1') pembelian,
			(Select distinct alamat kirim from erp_hr_unit where kd_unit='$kd_unit') alamat_kirim
			from erp_po pa join erp_po_detail pb on pa.id=pb.id_po join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_barang pc on pc.id=pd.id_barang
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode 
			where pa.nomer='$nomer_spp'");
		return $query->result_array();
	}


	function edit($id) {
		$query = $this->db->query("Select pa.id, pb.id id_detail, pb.id_sip_detail, pa.nomer, pa.tgl, hd.unit, pd.id_supplier, pe.nama supplier, pe.kode_keuangan, pe.kode_jenis, pi.keterangan cara_bayar, pa.discount, pa.top, pa.no_investasi, ce.no_sip, pc.nama barang, pc.spesifikasi, pc.no_rekjurnal, pb.satuan, cf.qty qty_sip, pb.qty, pb.harga, pb.mata_uang, to_char(pb.del_time,'dd-mm-yyyy') del_time, pb.id_material_supply, cf.satuan satuan_sip, pa.kd_unit, hd.kode_transaksi, pa.id_cara_bayar, nvl(pa.kurs,1) kurs
			from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip join erp_barang pc on pc.id=cf.id_barang join erp_pemb_cara_bayar pi on pi.id=pa.id_cara_bayar join erp_hr_unit hd on hd.kd_unit=ce.kd_unit
			where pa.id='$id' and pb.aktif<>'0'
			order by pc.nama");
		return $query->result_array();
	}

	function kode_unit($nmr) {
		$query = $this->db->query("Select kd_unit from erp_po where nomer='$nmr'");
		return $query->row_array()['KD_UNIT'];
	}

	function batal($id_detail, $id) {
		$this->db->query("Delete from erp_po_detail where id='$id_detail'");

		$query = $this->db->query("Select * from erp_po_detail where id_po='$id'");
		if ($query->num_rows() == 0) {
			$this->db->query("Delete from erp_po where id='$id'");
		}
	}

	function hapus_profits($id_po) {
		$query = $this->db->query("Select nomer from erp_po where id='$id_po'");
		$data = $query->row_array();

		$this->db->query("Delete from erp_po where id='$id_po'");
		$this->db->query("Delete from erp_po_detail where id_po='$id_po'");

		return $data['NOMER'];
	}

	function data_po($nmr) {
		$query = $this->db->query("Select pa.nomer, pe.kode_simpg, pe.kode_keuangan, pi.kode, pi.cara_bayar, pa.tgl, pa.discount, pa.top, pa.ppn, substr(replace(ha.nama,' ',''),0,8) username, hd.kd_unit, pa.no_investasi, ce.no_sip, pc.kode_simpg kode_barang, pb.satuan, pc.no_rekjurnal, pb.harga, (pb.qty*pb.harga) nilai_beli, pb.del_time deadline, pb.qty, cf.urut_sip, pb.mata_uang, pa.kurs, pa.nomor_urut_sakti
			from erp_po pa join erp_po_detail pb on pb.id_po=pa.id join erp_material_supply pd on pd.id=pb.id_material_supply join erp_supplier pe on pe.id=pd.id_supplier join erp_pemb_cara_bayar pi on pi.id=pa.id_cara_bayar join erp_karyawan ha on ha.id=pa.id_input join erp_hr_unit hd on hd.kd_unit=pa.kd_unit join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip join erp_barang pc on pc.id=cf.id_barang
			where pa.nomer='$nmr'");
		return $query->result_array();
	}

	function cek_simpg($kd_unit, $nmr) {
		if ($kd_unit == '01') {
			$query = $this->db_perdana()->query("Select * from tbl_detail_sp where nomer_spp='$nmr'");
		}else{
			$query = $this->db->query("Select * from tbl_detail_sp where nomer_spp='$nmr'");
		}
		return $query->num_rows();
	}


	// ========================================  Menu SIMPG  ========================================
	// ==============================================================================================

	function simpan_simpg($nmr, $kode_supplier_simpg, $kode_bayar, $tanggal, $discount, $keterangan, $top, $ppn, $value_pph, $kode_akuntan, $kode_pimpinan, $kode_saksi, $kode_pembelian, $username, $kode_unit, $kode_proyek, $sub_unit, $nmr_internal, $upload, $investasi, $nomor_spp, $valid_fa, $spp_urut, $pendanaan) {
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Insert into tbl_header_spp values('$nmr','$kode_supplier_simpg','$kode_bayar','$tanggal','$discount','$keterangan','$top','$ppn','$value_pph','$kode_akuntan','$kode_pimpinan','$kode_saksi','$kode_pembelian','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$sub_unit','$nmr_internal','$upload','$investasi','$nomor_spp','$valid_fa','$spp_urut','$pendanaan','0092')");
		}else{
			$this->db->query("Insert into tbl_header_spp(nomer_spp, kode, kode_cara_bayar, tanggal_beli, disc_harga, keterangan, top, value_ppn, value_pph, kode_nmakuntan, kode_pimpinan, kode_saksi, kode_pembelian, username, lastupdate, kode_unit, kode_proyek, kode_sub_unit, nomer_po_intern, upload, nomor_investasi, nomor_spp, valid_fa, nomor_spp_urut, pendanaan, kode_gm) values('$nmr','$kode_supplier_simpg','$kode_bayar','$tanggal','$discount','$keterangan','$top','$ppn','$value_pph','$kode_akuntan','$kode_pimpinan','$kode_saksi','$kode_pembelian','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$sub_unit','$nmr_internal','$upload','$investasi','$nomor_spp','$valid_fa','$spp_urut','$pendanaan','0092')");
		}
	}

	function simpan_detail_simpg($kode_unit, $nmr, $nomer_sip, $kode_barang, $kode_satuan, $no_rekjurnal, $kode_currency, $harga, $kurs, $nilai_beli, $terkirim, $final,  $qty_disc, $batal, $username, $urut) {
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Insert into tbl_detail_spp(nomer_spp, nomer_sip, kode_barang, kode_satuan, nomer_rekjurnal, kode_currency, price, kurs, nilaibeli, terkirim, final, satuan_harga, qty_disc, batal, username, nomer_urut_spp, lastupdate) values('$nmr','$nomer_sip','$kode_barang','$kode_satuan','$no_rekjurnal','$kode_currency','$harga','$kurs','$nilai_beli','$terkirim','$final','$kode_satuan','$qty_disc','$batal','$username','$urut',to_char(sysdate,'DD-MM-YY HH:MI:SS'))");
		}else{
			$this->db->query("Insert into tbl_detail_spp(nomer_spp, nomer_sip, kode_barang, kode_satuan, nomer_rekjurnal, kode_currency, price, kurs, nilaibeli, terkirim, final, satuan_harga, qty_disc, batal, username, nomer_urut_spp, lastupdate) values('$nmr','$nomer_sip','$kode_barang','$kode_satuan','$no_rekjurnal','$kode_currency','$harga','$kurs','$nilai_beli','$terkirim','$final','$kode_satuan','$qty_disc','$batal','$username','$urut',to_char(sysdate,'DD-MM-YY HH:MI:SS'))");
		}
	}

	function kode_currency($mata_uang) {
		$query = $this->db->query("Select kode_currency from tbl_master_currency where currency='$mata_uang'");
		$data = $query->row_array();
		return $data['KODE_CURRENCY'];
	}

	function simpan_simpg_subdetail($kode_unit, $nmr, $kode_barang, $deadline, $qty, $no_rekjurnal, $kode_satuan, $nomer_sip) {
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Insert into tbl_subdetail_spp(nomer_spp, kode_barang, deltime, qty, nomer_rekjurnal, kode_satuan, nomer_sip) values('$nmr','$kode_barang','$deadline','$qty','$no_rekjurnal','$kode_satuan','$nomer_sip')");
		}else{
			$this->db->query("Insert into tbl_subdetail_spp(nomer_spp, kode_barang, deltime, qty, nomer_rekjurnal, kode_satuan, nomer_sip) values('$nmr','$kode_barang','$deadline','$qty','$no_rekjurnal','$kode_satuan','$nomer_sip')");
		}
	}

	function hapus_simpg($nmr_simpg) {
		if (substr($nmr_simpg,11,3) == 'HPD') {
			$this->db_perdana()->query("Update tbl_header_spp set upload='' where nomer_spp='$nmr_simpg'");
			$this->db_perdana()->query("Delete from tbl_header_spp where nomer_spp='$nmr_simpg'");
		}else{
			$this->db->query("Update tbl_header_spp set upload='' where nomer_spp='$nmr_simpg'");
			$this->db->query("Delete from tbl_header_spp where nomer_spp='$nmr_simpg'");		
		}
	}

	function update_nmr_simpg($nmr, $nomor_urut) {
		if (substr($nmr,11,3) == 'HPD') {
			$query = $this->db_perdana()->query("Update tbl_header_spp set upload='T', nomor_spp_urut='$nomor_urut' where trim(nomer_spp)='$nmr'");
		}else{
			$query = $this->db->query("Update tbl_header_spp set upload='T', nomor_spp_urut='$nomor_urut' where trim(nomer_spp)='$nmr'");
		}
	}


	// ========================================  Menu Sakti  ========================================
	// ==============================================================================================

	function nomor_urut($id_edit) {
		$query = $this->db->query("Select nomor_urut_sakti from erp_po where id='$id_edit'");
		$data = $query->row_array();
		return $data['NOMOR_URUT_SAKTI'];
	}

	function spp_urut($year) {
		$query = $this->db->query("Select max(nomor_spp) nomor_spp from nomor_urut_spp where substr(nomor_spp, 0, 2)='$year'");
		$data = $query->row_array();
		if ($query->row_array()['NOMOR_SPP'] == null) {
			return $year . '000000001';
		}else{
			return $data['NOMOR_SPP'] + 1;
		}
	}

	function simpan_spp_urut($nomor_urut, $users) {
		$query = $this->db->query("Insert into nomor_urut_spp(nomor_spp, users, last_update) values('$nomor_urut','$users',sysdate)");
	}

	function simpan_sakti($kode_unit, $nomor_spp, $kode_supplier, $tanggal_spp, $mata_uang, $cara_bayar, $saksi_ahli, $limit, $tt_supplier, $nomor_um, $pendanaan, $kode_proyek, $jenis_ppn, $jenis_spp, $tanggal_ver, $verifikator, $users, $lokalimpor, $jenis_bayar, $pkp_non_pkp, $alamat_kirim, $migrasi, $nomor_investasi, $keterangan, $nomor_urut, $kurs_kalkulasi) {
		if ($kode_unit == '01') {
			$this->db->query("Insert into hpd_spp_head(nomor_spp, kode_supplier, tanggal_spp, tanggal_adm, mata_uang, cara_bayar, saksi_ahli, limit, tt_supplier, nomor_um, pendanaan, 
				kode_proyek, jenis_ppn, jenis_spp, tanggal_ver, verifikator, users, last_update, lokalimpor, jenis_bayar, pkp_non_pkp, alamat_kirim, migrasi, nomor_investasi, keterangan, nomor_urut, kurs_kalkulasi)
				values('$nomor_spp','$kode_supplier','$tanggal_spp','$tanggal_spp','$mata_uang','$cara_bayar','$saksi_ahli','$limit','$tt_supplier','$nomor_um','$pendanaan','$kode_proyek','$jenis_ppn','$jenis_spp','$tanggal_ver','$verifikator','$users',sysdate,'$lokalimpor','$jenis_bayar','$pkp_non_pkp','$alamat_kirim','$migrasi','$nomor_investasi','$keterangan','$nomor_urut','$kurs_kalkulasi')");
		}else{
			$this->db->query("Insert into spp_head(nomor_spp, kode_supplier, tanggal_spp, tanggal_adm, mata_uang, cara_bayar, saksi_ahli, limit, tt_supplier, nomor_um, pendanaan, 
				kode_proyek, jenis_ppn, jenis_spp, tanggal_ver, verifikator, users, last_update, lokalimpor, jenis_bayar, pkp_non_pkp, alamat_kirim, migrasi, nomor_investasi, keterangan, nomor_urut, kurs_kalkulasi)
				values('$nomor_spp','$kode_supplier','$tanggal_spp','$tanggal_spp','$mata_uang','$cara_bayar','$saksi_ahli','$limit','$tt_supplier','$nomor_um','$pendanaan','$kode_proyek','$jenis_ppn','$jenis_spp','$tanggal_ver','$verifikator','$users',sysdate,'$lokalimpor','$jenis_bayar','$pkp_non_pkp','$alamat_kirim','$migrasi','$nomor_investasi','$keterangan','$nomor_urut','$kurs_kalkulasi')");
		}
	}

	function simpan_sakti_detail($kode_unit, $nomor_spp, $nomor_sip, $item_sip, $kode_rekening, $qty, $harga, $users, $migrasi, $tanggal_kirim) {
		if ($kode_unit == '01') {
			$this->db->query("Insert into hpd_spp_item(nomor_spp, nomor_sip, item_sip, kode_rekening, qty, harga, users, last_update, migrasi) values('$nomor_spp','$nomor_sip','$item_sip','$kode_rekening','$qty','$harga','$users',sysdate,'$migrasi')");
			$this->db->query("Insert into hpd_spp_rencana_kirim(nomor_spp, nomor_sip, item_sip, tanggal_kirim, qty) values('$nomor_spp','$nomor_sip','$item_sip','$tanggal_kirim','$qty')");
		} else {
			$this->db->query("Insert into spp_item(nomor_spp, nomor_sip, item_sip, kode_rekening, qty, harga, users, last_update, migrasi) values('$nomor_spp','$nomor_sip','$item_sip','$kode_rekening','$qty','$harga','$users',sysdate,'$migrasi')");
			$this->db->query("Insert into spp_rencana_kirim(nomor_spp, nomor_sip, item_sip, tanggal_kirim, qty) values('$nomor_spp','$nomor_sip','$item_sip','$tanggal_kirim','$qty')");
		}
	}

	function hapus_sakti($nmr_simpg, $nmr_sakti) {
		if (substr($nmr_simpg,11,3) == 'HLG') {
			$this->db->query("Delete from spp_head where nomor_spp='$nmr_sakti'");
			$this->db->query("Delete from spp_item where nomor_spp='$nmr_sakti'");
			$this->db->query("Delete from spp_rencana_kirim where nomor_spp='$nmr_sakti'");
		} else {
			$this->db->query("Delete from hpd_spp_head where nomor_spp='$nmr_sakti'");
			$this->db->query("Delete from hpd_spp_item where nomor_spp='$nmr_sakti'");
			$this->db->query("Delete from hpd_spp_rencana_kirim where nomor_spp='$nmr_sakti'");
		}
	}

}
