<?php class M_location extends CI_Model {

	function status_menu($kode_menu, $id_kary) {
		$query = $this->db->query("Select status from erp_adm_akses where id_menu_detail=(Select id from erp_adm_menu_detail where kode_menu='$kode_menu') and id_akun=(Select id from erp_akun where id_karyawan='$id_kary')");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function unit() {
		return $this->db->query("Select * from erp_hr_unit order by kd_unit desc");
	}

	function pic() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.status='1' order by ha.nama");
	}

	function material() {
		return $this->db->query("Select pc.id, pc.kode, pc.nama, pc.spesifikasi, pc.min_stok from erp_barang pc where pc.aktif<>'0' order by pc.nama");
	}

	function lokasi($id_kary) {
		return $this->db->query("Select distinct gv.no_lokasi from erp_gdg_location_brg gv join erp_gdg_location_pic gi on gi.id_location=gv.id_location where gi.id_karyawan='$id_kary' order by gv.no_lokasi");
	}

	function filter($kd_unit, $nama, $pic) {
		$query = $this->db->query("Select distinct v.id, v.location, v.jenis, v.kd_unit,
			(select xmlagg(xmlelement(e,nama||', ') order by nama).extract('//text()') from v_location where location=v.location) pic,
			(select xmlagg(xmlelement(e,'@'||id_kary||'@') order by nama).extract('//text()') from v_location where location=v.location) id_kary,
			(select count(id) from erp_gdg_location_brg where id_location=v.id) qty_brg,
			(select count(id) from erp_cc_so where lokasi=to_char(v.id)) qty_so
			from v_location v
			where (case when '$kd_unit'='All' then 'All' else v.kd_unit end)='$kd_unit' and upper(v.location) like '%$nama%' and (select xmlagg(xmlelement(e,upper(nama)||', ')).extract('//text()') from v_location where location=v.location) like '%$pic%'
			group by v.id, v.location, v.jenis, v.kd_unit
			order by v.kd_unit, v.location");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_location");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function cek_nama($id_edit, $nama) {
		$id_edit = $id_edit == '' ? 'x' : $id_edit;
		$query = $this->db->query("Select * from erp_gdg_location where upper(location)='$nama' and (case when '$id_edit'='x' then 'y' else to_char(id) end)<>'$id_edit'");
		return $query->num_rows();
	}

	function simpan($urut, $nama, $jenis, $kd_unit) {
		$this->db->query("Insert into erp_gdg_location(id, location, jenis, kd_unit) values('$urut','$nama','$jenis','$kd_unit')");
	}

	function update($id_edit, $nama, $jenis, $kd_unit) {
		$this->db->query("Update erp_gdg_location set location='$nama', jenis='$jenis', kd_unit='$kd_unit' where id='$id_edit'");
	}

	function dt_pic($id_edit) {
		$query = $this->db->query("Select id_karyawan from erp_gdg_location_pic where id_location='$id_edit'");
		return $query->result_array();
	}

	function hapus_pic($id_edit, $id_kary) {
		$this->db->query("Delete from erp_gdg_location_pic where id_location='$id_edit' and id_karyawan='$id_kary'");
	}

	function urut_pic() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_location_pic");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_pic($urut_pic, $urut, $pic) {
		$query = $this->db->query("Select * from erp_gdg_location_pic where id_location='$urut' and id_karyawan='$pic'");
		if ($query->num_rows() == 0) {
			$this->db->query("Insert into erp_gdg_location_pic(id, id_location, id_karyawan) values('$urut_pic','$urut','$pic')");
		}
	}

	function edit($id_edit) {
		$query = $this->db->query("Select distinct v.location, v.jenis, v.kd_unit,
			(select xmlagg(xmlelement(e,id_kary||', ')).extract('//text()') from v_location where location=v.location) pic
			from v_location v
			where v.id='$id_edit'
			group by v.id, v.location, v.jenis, v.kd_unit");
		return $query->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_gdg_location where id='$id_hapus'");
		$this->db->query("Delete from erp_gdg_location_pic where id_location='$id_hapus'");
		$this->db->query("Delete from erp_gdg_location_brg where id_location='$id_hapus'");
	}

	function info($id_location, $tipe, $nama, $status, $no_lokasi) {
		$query = $this->db->query("Select gv.id, gv.tipe, pc.kode, pc.nama, pc.spesifikasi, gv.status, gv.no_lokasi, pc.min_stok
			from erp_gdg_location_brg gv join erp_barang pc on pc.id=gv.id_barang
			where pc.aktif<>'0' and gv.id_location='$id_location' and (case when '$tipe'='All' then 'All' else gv.tipe end)='$tipe' and (lower(pc.nama) like '%$nama%' or lower(pc.spesifikasi) like '%$nama%') and gv.status='$status' and (case when '$no_lokasi'='All' then 'All' else gv.no_lokasi end)='$no_lokasi'
			order by pc.nama");
		return $query->result_array();
	}

	function urut_brg() {
		$query = $this->db->query("Select max(id) urut from erp_gdg_location_brg");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_p($urut_brg, $id_location, $tipe, $id_barang, $status, $no_lokasi, $min_stok) {
		$query = $this->db->query("Select * from erp_gdg_location_brg where id_location='$id_location' and id_barang='$id_barang'");
		if ($query->num_rows() == 0) {
			$this->db->query("Insert into erp_gdg_location_brg(id, id_location, no_lokasi, tipe, id_barang, status) values('$urut_brg', '$id_location', '$no_lokasi', '$tipe', '$id_barang', '$status')");
		}else{
			$this->db->query("Update erp_gdg_location_brg set status='1' where id_barang='$id_barang'");
		}
		$this->db->query("Update erp_barang set min_stok='$min_stok' where id='$id_barang'");
	}

	function update_p($id_edit, $id_location, $tipe, $id_barang, $status, $no_lokasi, $min_stok) {
		$this->db->query("Update erp_gdg_location_brg set no_lokasi='$no_lokasi', tipe='$tipe', id_barang='$id_barang', status='$status' where id='$id_edit'");
		$this->db->query("Update erp_barang set min_stok='$min_stok' where id='$id_barang'");
	}

	function edit_barang($id_edit) {
		$query = $this->db->query("Select pc.id, pc.kode, gv.tipe, gv.no_lokasi, gv.status, pc.min_stok
			from erp_barang pc join erp_gdg_location_brg gv on gv.id_barang=pc.id
			where gv.id='$id_edit'");
		return $query->row_array();
	}

	function hapus_barang($id_hapus) {
		$this->db->query("Delete from erp_gdg_location_brg where id='$id_hapus'");
	}

}