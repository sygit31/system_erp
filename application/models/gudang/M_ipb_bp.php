<?php 
class M_ipb_bp extends CI_Model {

	function unit() {
		return $this->db->query("Select * from erp_hr_unit order by kd_unit");
	}

	function kd_unit() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		$query = $this->db->query("Select distinct ha.kd_unit, ha.id_bagian, ha.nama, hb.nama bagian from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'");
		$data = $query->row_array();
		return array($data['KD_UNIT'],$id_kary, $data['ID_BAGIAN']);
	}

	function jenis() {
		return $this->db->query("Select distinct jenis from erp_gdg_location
			where jenis='BAHAN CHEMICAL' or jenis='BAHAN NON CHEMICAL'
			order by jenis");
	}

	function nomor() {
		return $this->db->query("Select distinct nmr from erp_ipb_bp order by nmr desc");
	}

	function bagian($kd_menu, $id_kary) {
		if ($kd_menu == 'gdg_ipb_pembantu_approve') {
			return $this->db->query("Select distinct hb.nama bagian, hb.id from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id order by hb.nama");
		}else{
			return $this->db->query("Select distinct id, bagian from
				(select distinct hb.nama bagian, hb.id from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'
				union
				select distinct hb.nama bagian, hb.id from erp_bagian hb join erp_jabatan_rangkap hf on hf.id_bagian=hb.id where hf.id_karyawan='$id_kary')
				order by bagian");
		}
	}

	function barang() {
		return $this->db->query("Select distinct gk.id_barang, pc.nama, pc.spesifikasi from erp_ipb_bp_detail gk join erp_barang pc on pc.id=gk.id_barang where pc.aktif<>0 order by pc.nama");
	}

	function approve($kd_unit) {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.kd_unit='$kd_unit' and af.trans='Approve IPB Bahan Pembantu' order by ha.nama");
	}

	function receive($kd_unit) {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.trans='Receive IPB Bahan Pembantu' order by ha.nama");
	}

	function kd_status($kd_menu, $id_kary) {
		$query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail where aa.id_karyawan='$id_kary' and ad.kode_menu='$kd_menu'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function bahan($jenis) {
		$tgl_start = '220401';
		$query = $this->db->query("Select pc.id, gh.jenis, pc.nama, pc.spesifikasi, pc.satuan,
			(select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and (lokasi='1' or lokasi='2' or lokasi='5') and status='1' and kd_unit=gh.kd_unit) saldo_awal,
			(select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and to_char(gs.tgl,'YYMMDD')>='$tgl_start' and gs.kd_unit=gh.kd_unit) masuk,
			(select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb where gk.id_barang=pc.id and to_char(gj.tgl,'YYMMDD')>='$tgl_start' and gj.kd_unit=gh.kd_unit) keluar
			from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location
			where pc.aktif='1' and (pc.kategori='PRODUKSI' or pc.kategori='PROOF') and gh.jenis='$jenis' order by pc.nama");
		return $query->result_array();
	}

	function kode_bagian($bagian) {
		$query = $this->db->query("Select hb.kode from erp_bagian hb where hb.id='$bagian'");
		$data = $query->row_array();
		return $data['KODE'];
	}

	function isi_nama($id_bagian, $kd_unit) {
		$level = 4;
		$query = $this->db->query("Select distinct a.id, a.nama from
			(select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan hc on hc.id=ha.id_jabatan where ha.status<>0 and ha.id_bagian='$id_bagian'
			union
			select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan_rangkap hf on hf.id_karyawan=ha.id join erp_jabatan hc on hc.id=hf.id_jabatan where hf.id_bagian='$id_bagian') a
			where a.kd_unit='$kd_unit' and substr(a.level_jabatan,0,1)<='$level' order by a.nama");
		$create = $query->result_array();

		$level = 3;
		$query = $this->db->query("Select a.id, a.nama from
			(select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan hc on hc.id=ha.id_jabatan where ha.status<>0 and ha.id_bagian='$id_bagian'
			union
			select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan_rangkap hf on hf.id_karyawan=ha.id join erp_jabatan hc on hc.id=hf.id_jabatan where hf.id_bagian='$id_bagian') a
			where a.kd_unit='$kd_unit' and substr(a.level_jabatan,0,1)<='$level' order by a.nama");
		$app = $query->result_array();

		return array($create, $app);
	}

	function auto_no($id_edit, $thn, $romawi, $kd_unit, $jenis, $bagian) {
		if ($bagian == '') {return;}

		$query = $this->db->query("Select kode_transaksi from erp_hr_unit where kd_unit='$kd_unit'");
		$data = $query->row_array();
		$kode_transaksi = $data['KODE_TRANSAKSI'];
		$kode_bagian = $this->kode_bagian($bagian);

		if ($id_edit != '') {
			$query = $this->db->query("Select to_char(tgl,'YY') thn, nmr, jenis from erp_ipb_bp where id=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
			$data_edit = $query->row_array();
			$thn_edit = $data_edit['THN'];
			$nmr_edit = $data_edit['NMR'];
			$jenis_edit = $data_edit['JENIS'];

			if ($thn_edit == $thn && $jenis_edit == $jenis) {return $nmr_edit;}
		}

		$query = $this->db->query("Select max(substr(nmr,0,3)) nmr from erp_ipb_bp where to_char(tgl,'YY')='$thn' and jenis='$jenis' and nmr like '%$kode_bagian%'");
		$data = $query->row_array();
		$urut = sprintf('%03d', $data['NMR'] + 1);
		return $urut . $kode_transaksi . $kode_bagian . '/' . $romawi . '/' . $thn;
	}

	function filter($tgl1, $tgl2, $kd_unit, $id_bagian, $jenis, $id_barang) {
		$t_jenis = $this->jenis()->result_array();
		$dt_jenis = array();
		foreach ($t_jenis as $dt) {array_push($dt_jenis, $dt['JENIS']);}
		$dt_jenis = implode("','", $dt_jenis);

		return $this->db->query("Select gk.id id_detail, to_char(gj.tgl,'DD-MM-YYYY') tgl, ha.nama pemesan, hb.nama bagian, gj.nmr, pc.nama, pc.spesifikasi, gk.satuan, gk.qty, gk.status, gk.keterangan, gj.jenis
			from erp_ipb_bp gj join erp_ipb_bp_detail gk on gk.id_ipb=gj.id join erp_karyawan ha on ha.id=gj.id_order join erp_bagian hb on hb.id=gj.id_bagian join erp_barang pc on pc.id=gk.id_barang
			where to_char(gj.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$kd_unit'='All' then 'All' else gj.kd_unit end)='$kd_unit' and (case when '$id_bagian'='All' then 'All' else to_char(hb.id) end)='$id_bagian' and (case when '$jenis'='All' then 'All' else gj.jenis end)='$jenis' and (case when '$id_barang'='All' then 'All' else to_char(gk.id_barang) end)='$id_barang' and gj.jenis in ('".$dt_jenis."') 
			order by gj.tgl desc, gj.jenis, gj.nmr desc, pc.nama");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_ipb_bp");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_ipb_bp where id=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
		$this->db->query("Delete from erp_ipb_bp_detail where id_ipb=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
	}

	function simpan($id_ipb, $kd_unit, $tgl, $nmr, $id_akun, $id_order, $id_approve, $jenis, $id_bagian) {
		$this->db->query("Insert into erp_ipb_bp(id, kd_unit, tgl, nmr, id_bagian, id_akun, id_order, id_approve, updated, jenis) values('$id_ipb','$kd_unit','$tgl','$nmr','$id_bagian','$id_akun','$id_order','$id_approve',sysdate,'$jenis')");
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_ipb_bp_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($id_detail,$id_ipb,$id_barang,$satuan,$qty,$keterangan) {
		$this->db->query("Insert into erp_ipb_bp_detail(id, id_ipb, id_barang, satuan, qty, keterangan, status) values('$id_detail','$id_ipb','$id_barang','$satuan','$qty','$keterangan',1)");
	}

	function edit($status, $id_edit) {
		$query = $this->db->query("Select to_char(gj.tgl,'DD-MM-YYYY') tgl, gj.nmr, gj.kd_unit, gk.id_barang, gk.satuan, gk.qty, gk.keterangan, pc.nama bahan, pc.spesifikasi, gj.jenis,
			(select id from erp_karyawan where id=gj.id_order) id_order,
			(select id from erp_karyawan where id=gj.id_approve) id_approve,
			(select nama from erp_karyawan where id=gj.id_order) nama_order,
			(select nama from erp_karyawan where id=gj.id_approve) nama_approve,
			(select nama from erp_karyawan where id=gj.id_receive) nama_receive,
			(select nama bagian from erp_bagian where id=gj.id_bagian) bagian_order,
			(select hb.nama bagian from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id where ha.id=gj.id_approve) bagian_approve
			from erp_ipb_bp gj join erp_ipb_bp_detail gk on gk.id_ipb=gj.id join erp_barang pc on pc.id=gk.id_barang
			where gk.status='$status' and gj.id=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')
			order by pc.nama");
		return $query->result_array();
	}

	function app($id, $status, $id_receive) {
		$query = $this->db->query("Select * from erp_ipb_bp_detail where id_ipb=(select id_ipb from erp_ipb_bp_detail where id='$id')");

		if ($status == 0) {
			if ($query->num_rows() == 1) {
				$this->db->query("Delete from erp_ipb_bp where id=(select id_ipb from erp_ipb_bp_detail where id='$id')");
			}
			$this->db->query("Delete from erp_ipb_bp_detail where id='$id'");
		}else{
			$this->db->query("Update erp_ipb_bp set id_receive='$id_receive' where id=(select id_ipb from erp_ipb_bp_detail where id='$id')");
			$this->db->query("Update erp_ipb_bp_detail set status='$status' where id='$id'");			
		}
	}
}