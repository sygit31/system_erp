<?php class M_foil_stamping extends CI_Model {

	function dt_desain() {
		return $this->db->query("Select distinct desain from erp_kk where desain<>'-' order by desain desc");
	}

	function dt_kk() {
		return $this->db->query("Select id, keterangan_penggunaan, desain from erp_gudang_order order by desain desc, keterangan_penggunaan desc");
	}

	function dt_pp() {
		return $this->db->query("Select distinct nmr_pp from erp_foil_stamping_detail order by nmr_pp desc");
	}

	function dt_seri() {
		return $this->db->query("Select distinct seri from erp_kk where seri<>'-' order by seri");
	}

	function dt_pengawas() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.kd_unit='12' and lower(af.trans)='pengawas produksi' order by ha.nama");
	}

	function dt_pengawas2() {
		$id_bagian_stamping = '31';
		$kd_unit = '12';
		$level_jabatan = '4';
		return $this->db->query("Select a.id, a.nama from
			(select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan hc on hc.id=ha.id_jabatan where ha.status<>0 and ha.id_bagian='$id_bagian_stamping'
			union
			select distinct ha.id, ha.nama, ha.kd_unit, hc.level_jabatan from erp_karyawan ha join erp_jabatan_rangkap hf on hf.id_karyawan=ha.id join erp_jabatan hc on hc.id=hf.id_jabatan where hf.id_bagian='$id_bagian_stamping') a
			where a.kd_unit='$kd_unit' and substr(a.level_jabatan,0,1)='$level_jabatan' order by a.nama");
	}

	function isi_kode_kertas($desain, $seri) {
		$seri = $seri == 'SERI I' ? '1' : ($seri == 'SERI II' ? '2' : ($seri == 'SERI III' ? '3' : '4'));
		$query = $this->db->query("Select sb.no_roll, sb.baik_sht panjang
			from tbl_keluar sb join tbl_master_bahan se on se.kode_bahan=sb.kode_bahan
			where se.desain='$desain' and substr(sb.kode_bahan, -1)='$seri' and se.jenis='BJ'
			order by se.seri, sb.no_roll desc");
		return $query->result_array();
	}

	function isi_kode_foil($desain, $seri) {
		$query = $this->db->query("Select distinct df.kode, df.id, df.id_gudang_order, ('mut' || '__') kode_asal, ca.desain
			from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order
			where df.station_akhir='Stamping' and df.aktif='2' and ca.desain='$desain' and ca.seri='$seri' and
			(select count(id) from erp_foil_stamping_detail where id_mutasi=df.id)=0
			union all
			Select dn.kode_foil kode, dn.id_mutasi id, dn.id_gudang_order, ('stamp' || '__' || dt.id) kode_asal, ca.desain
			from erp_foil_stamping_detail dn join erp_gudang_order ca on ca.id=dn.id_gudang_order join erp_foil_sisa dt on dt.id_foil_detail=dn.id
			where sisa_status='0' and ca.desain='$desain' and ca.seri='$seri' and
			(select count(id) from erp_foil_stamping_detail where id_sisa_foil=dt.id)=0
			order by kode desc");
		return $query->result_array();
	}

	function isi_foil($id_mutasi, $id_detail, $kode_asal, $id_asal) {
		if ($kode_asal == 'mut') {
			$query = $this->db->query("Select distinct df.qty panjang,
				(df.qty_roll-(select nvl(sum(qty_roll),0) from erp_foil_stamping_detail where id_mutasi=df.id)) qty_roll,
				(select qty_roll from erp_foil_stamping_detail where id_mutasi=df.id and id='$id_detail') qty_edit
				from erp_prod_mutasi df
				where df.id='$id_mutasi'");
		}else{
			$query = $this->db->query("Select dt.panjang, dt.qty_roll, 0 qty_edit
				from erp_foil_sisa dt
				where id='$id_asal'");
		}

		return $query->row_array();
	}

	function filter($tgl1, $tgl2, $desain, $kk, $pp, $seri, $shift, $pengawas, $mesin, $kode) {
		$query = $this->db->query("Select dn.id id_detail, dm.desain, to_char(dm.tgl,'DD-MM-YYYY') tgl, to_char(dm.delivery,'DD-MM-YYYY') delivery, ca.seri, dn.shift, dn.mesin, dn.nmr_pp, dn.kode_kertas, dn.panjang_kertas, ca.keterangan_penggunaan kk, dn.kode_foil, dn.panjang, dn.qty_roll, dn.hasil, dn.waste, dn.sisa, ha.nama pengawas, dn.keterangan,
			(select max(id) from erp_foil_stamping_detail where id_mutasi=dn.id_mutasi) edit_mutasi
			from erp_foil_stamping dm join erp_foil_stamping_detail dn on dn.id_foil=dm.id join erp_gudang_order ca on ca.id=dn.id_gudang_order join erp_karyawan ha on ha.id=dm.id_pengawas_stamping
			where to_char(dm.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and ca.desain='$desain' and (case when '$kk'='All' then 'All' else to_char(ca.id) end)='$kk' and (case when '$pp'='All' then 'All' else dn.nmr_pp end)='$pp' and (case when '$seri'='All' then 'All' else ca.seri end)='$seri' and (case when '$shift'='All' then 'All' else dn.shift end)='$shift' and (case when '$pengawas'='All' then 'All' else to_char(dm.id_pengawas_stamping) end)='$pengawas' and (case when '$mesin'='All' then 'All' else dn.mesin end)='$mesin' and dn.kode_foil like '%$kode%'
			order by dm.tgl desc, dn.mesin, dn.shift, dn.kode_kertas");
		return $query->result_array();
	}

	function batal($id_edit) {
		$this->db->query("Delete from erp_foil_stamping where id=(select id_foil from erp_foil_stamping_detail where id='$id_edit')");
		$this->db->query("Delete from erp_foil_stamping_detail where id_foil=(select id_foil from erp_foil_stamping_detail where id='$id_edit')");
		$this->db->query("Delete from erp_foil_sisa where id_foil_detail='$id_edit'");
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_foil_stamping");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function urut_detail() {
		$query = $this->db->query("Select max(id) urut from erp_foil_stamping_detail");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id_foil, $desain, $tgl, $delivery, $id_pengawas_stamping) {
		$this->db->query("Insert into erp_foil_stamping(id, desain, tgl, id_pengawas_stamping, delivery) values('$id_foil','$desain','$tgl','$id_pengawas_stamping','$delivery')");
	}

	function simpan_detail($id_detail, $id_foil, $nmr_pp, $mesin, $shift, $id_mutasi, $kode_foil, $qty_roll, $panjang_foil, $id_gudang_order, $kode_kertas, $panjang_kertas, $hasil, $waste, $sisa, $id_asal, $keterangan) {
		$this->db->query("Insert into erp_foil_stamping_detail(id, id_foil, nmr_pp, mesin, shift, id_mutasi, kode_foil, qty_roll, panjang, id_gudang_order, kode_kertas, panjang_kertas, hasil, waste, sisa, sisa_status, id_sisa_foil, keterangan) values('$id_detail','$id_foil','$nmr_pp','$mesin','$shift','$id_mutasi','$kode_foil','$qty_roll','$panjang_foil','$id_gudang_order','$kode_kertas','$panjang_kertas','$hasil','$waste','$sisa','0','$id_asal','$keterangan')");
	}

	function sisa_mutasi($id_mutasi) {
		$query = $this->db->query("Select df.qty panjang, (df.qty_roll - 
			(select nvl(sum(qty_roll), 0) from erp_foil_stamping_detail where id_mutasi=df.id)) qty_roll
			from erp_prod_mutasi df where id='$id_mutasi'");
		return array($query->row_array()['QTY_ROLL'], $query->row_array()['PANJANG']);
	}

	function urut_sisa() {
		$query = $this->db->query("Select max(id) urut from erp_foil_sisa");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_sisa($id_sisa, $id_detail, $roll_sisa, $panjang_sisa) {
		if ($roll_sisa > 0 && $panjang_sisa > 0) {
			$this->db->query("Insert into erp_foil_sisa(id, id_foil_detail, qty_roll, panjang) values('$id_sisa', '$id_detail', '$roll_sisa', '$panjang_sisa')");
		}
	}

	function edit($id_edit) {
		$query = $this->db->query("Select distinct dm.desain, to_char(dm.tgl,'DD-MM-YYYY') tgl, dm.tgl tgl_order, ca.seri, dm.delivery, dm.id_pengawas_stamping, dn.shift, dn.mesin, dn.nmr_pp, dn.kode_kertas, dn.panjang_kertas, dn.kode_foil, dn.panjang, dn.qty_roll, dn.hasil, dn.waste, dn.sisa, dn.id_mutasi, dn.id_gudang_order, dn.kode_foil, dn.panjang, dn.qty_roll, dn.id id_detail, ha.nama pengawas, dn.keterangan, nvl2(dn.id_sisa_foil, 'stamp__' || dn.id_sisa_foil, 'mut__') kode_asal
			from erp_foil_stamping dm join erp_foil_stamping_detail dn on dn.id_foil=dm.id join erp_gudang_order ca on ca.id=dn.id_gudang_order join erp_karyawan ha on ha.id=dm.id_pengawas_stamping
			where dm.id=(select id_foil from erp_foil_stamping_detail where id='$id_edit')
			order by dm.tgl desc, ca.seri, dn.kode_kertas");
		return $query->result_array();
	}

	function cetak($id_cetak) {
		$query = $this->db->query("Select distinct dm.desain, to_char(dm.tgl,'DD-MM-YYYY') tgl, dm.tgl tgl_order, ca.seri, dm.delivery, dm.id_pengawas_stamping, dn.shift, dn.mesin, dn.nmr_pp, dn.kode_kertas, dn.panjang_kertas, dn.kode_foil, dn.panjang, dn.qty_roll, dn.hasil, dn.waste, dn.sisa, dn.id_mutasi, dn.id_gudang_order, dn.id id_detail, ha.nama pengawas, dn.keterangan
			from erp_foil_stamping dm join erp_foil_stamping_detail dn on dn.id_foil=dm.id join erp_gudang_order ca on ca.id=dn.id_gudang_order join erp_karyawan ha on ha.id=dm.id_pengawas_stamping
			where dm.desain=(select dm2.desain from erp_foil_stamping_detail dn2 join erp_foil_stamping dm2 on dm2.id=dn2.id_foil where dn2.id='$id_cetak') and
			dm.tgl=(select dm2.tgl from erp_foil_stamping_detail dn2 join erp_foil_stamping dm2 on dm2.id=dn2.id_foil where dn2.id='$id_cetak') and
			ca.seri=(select ca2.seri from erp_gudang_order ca2 join erp_foil_stamping_detail dn2 on dn2.id_gudang_order=ca2.id where dn2.id='$id_cetak')
			order by dn.mesin, dn.shift, dn.kode_kertas");
		return $query->result_array();
	}

	function hapus($id_detail) {
		$query = $this->db->query("Select * from erp_foil_stamping_detail where id_foil=(select id_foil from erp_foil_stamping_detail where id='$id_detail')");

		if ($query->num_rows() == 1) {
			$this->db->query("Delete from erp_foil_stamping where id=(select id_foil from erp_foil_stamping_detail where id='$id_detail')");
		}

		$query = $this->db->query("Select id_sisa_foil from erp_foil_stamping_detail where id='$id_detail'");
		$id_sisa_foil = $query->row_array()['ID_SISA_FOIL'];
		if ($id_sisa_foil != '') {
			$this->db->query("Update erp_foil_stamping_detail set sisa_status='0' where id='$id_sisa_foil'");
		}

		$this->db->query("Delete from erp_foil_stamping_detail where id='$id_detail'");
		$this->db->query("Delete from erp_foil_sisa where id_foil_detail='$id_detail'");
	}

}