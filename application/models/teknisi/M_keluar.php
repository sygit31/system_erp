<?php class M_keluar extends CI_Model {

	function dt_unit() {
		return $this->db->query("Select * from erp_hr_unit order by kd_unit desc");
	}

	function dt_login() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		$query = $this->db->query("Select distinct ha.kd_unit, ha.id_bagian from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'");
		$data = $query->row_array();
		return array($data['KD_UNIT'], $data['ID_BAGIAN'], $id_kary);
	}

	function karyawan($kd_unit, $id_bagian) {
		return $this->db->query("Select * from erp_karyawan where kd_unit='$kd_unit' and id_bagian='$id_bagian' and status='1' and tgl_keluar is null order by nama");
	}

	function bahan($jenis, $kd_unit) {
		$query = $this->db->query("Select pc.id, pc.kode, pc.nama, pc.spesifikasi, pc.satuan,
			(select nvl(sum(addendum),0) from erp_cc_so where id_barang=pc.id and status='1' and kd_unit='$kd_unit') saldo_awal,
			(select nvl(sum(gt.qty),0) from erp_gdg_terima gs join erp_gdg_terima_detail gt on gt.id_gdg_terima=gs.id where gt.id_barang=pc.id and gs.kd_unit='$kd_unit') masuk,
			(select nvl(sum(gk.qty),0) from erp_ipb_bp_detail gk join erp_ipb_bp gj on gj.id=gk.id_ipb where gk.id_barang=pc.id and gj.kd_unit='$kd_unit') keluar
			from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id join erp_gdg_location gh on gh.id=gv.id_location
			where pc.aktif='1' and gh.jenis='$jenis' order by pc.nama");
		return $query->result_array();
	}

	function auto_no($id_edit,$bln, $thn, $kd_unit, $jenis) {
		$query = $this->db->query("Select substr(kode_transaksi, 6, 3) kode from erp_hr_unit where kd_unit='$kd_unit'");
		$data = $query->row_array();
		$kode = $data['KODE'];

		if ($id_edit != '') {
			$query = $this->db->query("Select to_char(tgl,'YY') thn, nmr, jenis from erp_ipb_bp where id=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
			$data_edit = $query->row_array();
			$thn_edit = $data_edit['THN'];
			$nmr_edit = $data_edit['NMR'];
			$jenis_edit = $data_edit['JENIS'];

			if ($thn_edit == $thn && $jenis_edit == $jenis) {return $nmr_edit;}
		}

		$query = $this->db->query("Select max(substr(nmr,0,4)) nmr from erp_ipb_bp where to_char(tgl,'YY')='$thn' and jenis='$jenis' and kd_unit='$kd_unit'");
		$data = $query->row_array();
		switch ($bln)
		{
			case '01':
			$romawi="I";
			break;
			case '02':
			$romawi="II";
			break;
			case '03':
			$romawi="III";
			break;
			case '04':
			$romawi= "IV";
			break;
			case '05':
			$romawi= "V";
			break;
			case '06':
			$romawi= "VI";
			break;
			case '07':
			$romawi= "VII";
			break;
			case '08':
			$romawi= "VIII";
			break;
			case '09':
			$romawi= "IX";
			break;
			case '10':
			$romawi= "X";
			break;
			case '11':
			$romawi="XI";
			break;
			case 12:
			$romawi= "XII";
			break;
		}

		$urut = sprintf('%04d', $data['NMR'] + 1);
		if($kd_unit=='12')
		{
			return $urut . '/TEK-' . $kode . '/' . $thn;
		}
		else if($kd_unit=='01')
		{
			return $urut . '/PNP-HOLO PERDANA/TEK1/'.$romawi.'/'. $thn;
		}
	}

	function filter($jenis, $tgl1, $tgl2, $kd_unit, $id_bahan, $id_kary) {
		$query = $this->db->query("Select gk.id id_detail, to_char(gj.tgl,'DD-MM-YYYY') tgl, gj.nmr, ha.nama kary, gj.jenis, pc.kode, pc.nama, pc.spesifikasi, gk.satuan, gk.qty, gk.keterangan
			from erp_ipb_bp gj join erp_ipb_bp_detail gk on gk.id_ipb=gj.id join erp_karyawan ha on ha.id=gj.id_order join erp_barang pc on pc.id=gk.id_barang
			where gj.jenis='$jenis' and to_char(gj.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and gj.kd_unit='$kd_unit' and (case when '$id_bahan'='All' then 'All' else to_char(pc.id) end)='$id_bahan' and (case when '$id_kary'='All' then 'All' else to_char(gj.id_order) end)='$id_kary'
			order by gj.tgl desc, gj.nmr desc, pc.nama");
		return $query->result_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_ipb_bp where id=(Select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
		$this->db->query("Delete from erp_ipb_bp_detail where id_ipb=(Select id_ipb from erp_ipb_bp_detail where id='$id_edit')");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_ipb_bp");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id_ipb, $kd_unit, $tgl, $nmr, $id_bagian, $id_akun, $id_order, $id_approve, $id_receive, $jenis) {
		$this->db->query("Insert into erp_ipb_bp(id, kd_unit, tgl, nmr, id_bagian, id_akun, id_order, id_approve, id_receive, updated, jenis) values('$id_ipb','$kd_unit','$tgl','$nmr','$id_bagian','$id_akun','$id_order','$id_approve','$id_receive',sysdate,'$jenis')");
		//$this->db->query("Insert into erp_ipb_bp(id, kd_unit, tgl, nmr) values('$id_ipb','$kd_unit','$tgl','$nmr')");
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_ipb_bp_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_detail($id_detail, $id_ipb, $id_barang, $satuan, $qty, $keterangan) {
		$this->db->query("Insert into erp_ipb_bp_detail(id, id_ipb, id_barang, satuan, qty, keterangan, status) values('$id_detail','$id_ipb','$id_barang','$satuan','$qty','$keterangan',1)");
	}

	function edit($id_edit) {
		$query =  $this->db->query("Select gj.nmr, to_char(gj.tgl,'DD-MM-YYYY') tgl, gj.id_order, gk.id_barang, gk.satuan, gk.qty, gk.keterangan, pc.kode, pc.nama, pc.spesifikasi, to_char(gj.tgl,'YY') thn,
			(select kode_transaksi from erp_hr_unit where kd_unit=gj.kd_unit) kode_transaksi
			from erp_ipb_bp gj join erp_ipb_bp_detail gk on gk.id_ipb=gj.id join erp_barang pc on pc.id=gk.id_barang
			where gj.id=(select id_ipb from erp_ipb_bp_detail where id='$id_edit')
			order by gk.id");
		return $query->result_array();
	}

	function hapus($id_hapus) {
		$query =  $this->db->query("Select * from erp_ipb_bp_detail where id_ipb=(Select id_ipb from erp_ipb_bp_detail where id='$id_hapus')");
		if ($query->num_rows() == '1') {
			$this->db->query("Delete from erp_ipb_bp where id=(Select id_ipb from erp_ipb_bp_detail where id='$id_hapus')");
		}
		$this->db->query("Delete from erp_ipb_bp_detail where id='$id_hapus'");
	}

}