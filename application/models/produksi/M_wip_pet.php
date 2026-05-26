<?php class M_wip_pet extends CI_Model {

	function kk() {
		return $this->db->query("Select nomer kk from erp_kk order by id desc");
	}

	function seri() {
		return $this->db->query("Select distinct(seri) seri from erp_kk where length(seri)>=4 order by seri");
	}

	function pengawas_produksi() {
		return $this->db->query("Select initcap(nvl(ha.nick_name, ha.nama)) nama, ha.id from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='pembuat wip' and ha.status='1' order by ha.nama");
	}

	function pengawas_gudang() {
		return $this->db->query("Select initcap(nvl(ha.nick_name, ha.nama)) nama, ha.id from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='penerima wip' and ha.status='1' order by ha.nama");
	}

	function approval() {
		return $this->db->query("Select initcap(nvl(ha.nick_name, ha.nama)) nama, ha.id from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where lower(af.trans)='approval wip' and ha.status='1' order by ha.nama");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)>=4 order by desain desc");
	}

	function filter($tgl1, $tgl2, $seri, $kk, $desain) {
		return $this->db->query("Select df.id, to_char(df.tgl, 'DD-MM-YYYY') tgl, ca.keterangan_penggunaan kk, ca.seri, df.nmr nmr_mutasi, df.kode, df.qty panjang,
			(select nmr_ipb from erp_wip_pet where id_prod_mutasi=df.id and rownum='1') nmr_ipb
			from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order
			where to_char(df.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk' and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='Belah' and df.aktif='2'
			order by df.tgl desc, df.nmr desc, df.kode");
	}

	function dt_roll($nmr_mutasi) {
		$query = $this->db->query("Select id from erp_prod_mutasi where nmr='$nmr_mutasi'");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_wip_pet");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_ipb($urut,  $tgl, $nama_barang, $nmr_mutasi, $nmr_ipb, $id_prod_mutasi,$id_pengawas_produksi, $id_pengawas_gudang, $id_approval) {
		$this->db->query("Insert into erp_wip_pet(id, tgl, nama_barang, nmr_mutasi, nmr_ipb, id_prod_mutasi, id_pengawas_produksi, id_pengawas_gudang, id_approval) values('$urut','$tgl','$nama_barang','$nmr_mutasi','$nmr_ipb','$id_prod_mutasi','$id_pengawas_produksi','$id_pengawas_gudang','$id_approval')");
	}

	function cetak($kk, $ipb) {
		$query = $this->db->query("Select distinct dj.nmr_ipb, to_char(dj.tgl,'DD-Mon-YYYY') tgl, ca.seri, ca.keterangan_penggunaan kk, dj.nama_barang, df.kode, df.qty, initcap(ha.nick_name) pengawas_produksi, initcap(ha2.nick_name) pengawas_gudang, initcap(ha3.nama) approval
			from erp_wip_pet dj join erp_prod_mutasi df on df.id=dj.id_prod_mutasi join erp_prod_mutasi_detail de on de.id_prod_mutasi=df.id join erp_prod_pet_detail dc on dc.id=de.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_karyawan ha on ha.id=dj.id_pengawas_produksi join erp_karyawan ha2 on ha2.id=dj.id_pengawas_gudang join erp_karyawan ha3 on ha3.id=dj.id_approval
			where ca.keterangan_penggunaan='$kk' and dj.nmr_ipb='$ipb' and df.aktif='2'
			order by df.kode");
		return $query->result_array();
	}

}