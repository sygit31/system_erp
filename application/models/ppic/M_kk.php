<?php class M_kk extends CI_Model {

	function karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		
		$query = $this->db->query("Select id_bagian from erp_karyawan where id='$id_kary'");
		$data = $query->row_array();
		return $id_kary . '@' . $data['ID_BAGIAN'];
	}

	function kk() {
		return $this->db->query("Select distinct id, nomer, desain, tgl_proses from erp_kk order by desain desc, tgl_proses desc, nomer desc");
	}

	function barang() {
		$tahun = '2025';
		return $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi, pc.satuan from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id where pc.aktif='1' and gv.id_location='2' and pc.jenis like '%BB%' and pc.tahun>='$tahun' order by pc.nama");
	}

	function satuan() {
		return $this->db->query("Select * from erp_pemb_satuan order by satuan");
	}

	function auto_no($id_edit, $bln, $bln_romawi, $desain, $thn) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nomer, to_char(tgl_proses,'MM') bln, desain from erp_kk where id=(select id_kk from erp_kk_detail where id='$id_edit')");
			$data = $query->row_array();
			if ($data['DESAIN'] == $desain && $data['BLN'] == $bln) {
				return $data['NOMER'];
			}
		}

		$auto_no = $this->db->query("Select nvl(max(substr(nomer,0,3)),0) as nmr from erp_kk where desain='$desain'");
		$urut = $auto_no->row_array();	
		return sprintf("%'03d\n", $urut['NMR'] + 1) . '/PNP-HLG/PPC/KKM/' . $bln_romawi . '/' . $desain;
	}

	function filter($tgl1, $tgl2, $desain, $seri, $nmr, $id_bahan) {
		return $this->db->query("Select ck.id id_detail, cj.desain, cj.nomer, cj.seri, to_char(cj.tgl_proses,'DD-MM-YYYY') tgl_proses, pc.nama, pc.spesifikasi, ck.jumlah qty, pc.satuan, cj.status,
			(select to_char(tanggal_penggunaan, 'DD-MM-YYYY') tanggal_penggunaan from erp_gudang_order where relasi='KK DETAIL' and id_relasi=ck.id and rownum='1') deadline,
			(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb where gj.id_kk_detail=ck.id) realisasi
			from erp_kk cj join erp_kk_detail ck on ck.id_kk=cj.id join erp_barang pc on pc.id=ck.id_bahan_baku
			where to_char(cj.tgl_proses, 'YYMMDD') between '$tgl1' and '$tgl2' and cj.desain='$desain' and (case when '$seri'='All' then 'All' else cj.seri end)='$seri' and (case when '$nmr'='All' then 'All' else to_char(cj.id) end)='$nmr' and (case when '$id_bahan'='All' then 'All' else to_char(pc.id) end)='$id_bahan'
			order by cj.desain desc, cj.nomer desc");
	}

	function urut_kk() {
		$data = $this->db->query("Select max(id) id from erp_kk");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_kk($urut_kk, $id_cs_risalah_detail, $tgl, $id_proses, $qty, $status, $id_input, $nmr, $seri, $desain) {
		$this->db->query("Insert into erp_kk(id, id_cs_risalah_detail, tgl_proses, id_proses, qty, status, tgl_input, id_input, nomer, seri,
			desain) values('$urut_kk', '$id_cs_risalah_detail', '$tgl', '$id_proses', '$qty', '$status', sysdate, '$id_input', '$nmr', '$seri', '$desain')");
	}

	function urut_kk_detail() {
		$data = $this->db->query("Select max(id) id from erp_kk_detail");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_kk_detail($urut_kk_detail, $urut_kk, $id_bahan, $qty) {
		$this->db->query("Insert into erp_kk_detail(id, id_kk, id_bahan_baku, jumlah) values('$urut_kk_detail', '$urut_kk', '$id_bahan', '$qty')");
	}

	function urut_gudang_order() {
		$data = $this->db->query("Select max(id) id from erp_gudang_order");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_gudang_order($urut_gudang_order, $tgl, $id_bahan, $qty, $satuan, $deadline, $nmr, $id_bagian, $status, $seri, $relasi, $urut_kk_detail, $desain) {
		$this->db->query("Insert into erp_gudang_order(id, tanggal, id_barang, qty, satuan, tanggal_penggunaan, keterangan_penggunaan, id_bagian, status, seri, relasi, id_relasi, desain) values('$urut_gudang_order', '$tgl', '$id_bahan', '$qty', '$satuan', '$deadline', '$nmr', '$id_bagian', '$status', '$seri', '$relasi', '$urut_kk_detail', '$desain')");
	}

	function cek_transaksi($id_kk_detail) {
		$num = 0;
		$query = $this->db->query("Select * from erp_ipb where id_kk_detail='$id_kk_detail'");
		$num = $num + $query->num_rows();
		$query = $this->db->query("Select * from erp_ipb_bp_realisasi where id_kk=(select id_kk from erp_kk_detail where id='$id_kk_detail')");
		$num = $num + $query->num_rows();
		$query = $this->db->query("Select * from erp_galv_ipb where no_kk=(select distinct nomer from erp_kk cj join erp_kk_detail ck on ck.id_kk=cj.id where ck.id='$id_kk_detail')");
		$num = $num + $query->num_rows();

		return $num;
	}

	function edit($id_edit) {
		$query = $this->db->query("Select cj.desain, cj.tgl_proses tgl, cj.nomer nmr, cj.seri, ck.id_bahan_baku, ck.jumlah qty, cj.status, pc.satuan, pc.nama, pc.spesifikasi,
			(select tanggal_penggunaan from erp_gudang_order where relasi='KK DETAIL' and id_relasi=ck.id and rownum='1') deadline
			from erp_kk cj join erp_kk_detail ck on ck.id_kk=cj.id join erp_barang pc on pc.id=ck.id_bahan_baku
			where ck.id='$id_edit'
			order by ck.jumlah");
		return $query->result_array();
	}

	function hapus_gudang_order($id_hapus) {
		$this->db->query("Delete from erp_gudang_order where id_relasi='$id_hapus' and relasi='KK DETAIL'");
	}

	function hapus_kk($id_hapus) {
		$query = $this->db->query("Select * from erp_kk_detail where id_kk=(select id_kk from erp_kk_detail where id='$id_hapus')");

		if ($query->num_rows() == 1) {
			$this->db->query("Delete from erp_kk where id=(select id_kk from erp_kk_detail where id='$id_hapus')");
		}
	}

	function hapus_kk_detail($id_hapus) {
		$this->db->query("Delete from erp_kk_detail where id='$id_hapus'");
	}

	function close_gudang_order($id_hapus) {
		$this->db->query("Update erp_gudang_order set status='CLOSE' where id_relasi='$id_hapus' and relasi='KK DETAIL'");
	}

	function close_kk($id_hapus) {
		$this->db->query("Update erp_kk set status='CLOSE' where id=(select id_kk from erp_kk_detail where id='$id_hapus')");
	}

}