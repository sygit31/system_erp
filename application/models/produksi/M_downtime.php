<?php class M_downtime extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)='4' order by desain desc");
	}

	function seri() {
		return $this->db->query("Select distinct seri from erp_kk where length(seri)>1 and nomer not like '%PROOF%' order by seri");
	}

	function kk() {
		return $this->db->query("Select cj.id, cj.nomer kk, cj.desain from erp_kk cj where cj.nomer not like '%PROOF%' order by cj.desain desc, cj.nomer desc");
	}

	function proses() {
		return $this->db->query("Select distinct rf.nama proses
			from erp_tek_mesin ta join erp_rnd_proses rb on rb.id_mesin=ta.id join erp_station rf on rf.id=rb.id_station
			order by rf.nama");
	}

	function nama_mesin() {
		return $this->db->query("Select distinct rf.nama proses, ta.nama_mesin
			from erp_tek_mesin ta join erp_rnd_proses rb on rb.id_mesin=ta.id join erp_station rf on rf.id=rb.id_station
			order by ta.nama_mesin");
	}

	function operator() {
		return $this->db->query("Select ha.id, ha.nama from erp_karyawan ha where ha.tgl_keluar is null and ha.status='1' and ha.id_jabatan=12 and ha.kd_unit='12' order by ha.nama");
	}

	function jenis_downtime() {
		return $this->db->query("Select id, kode, keterangan from erp_prod_mst_downtime where status='1' order by kode");
	}

	function filter($tgl1, $tgl2, $proses, $nama_mesin, $desain, $kk, $seri) {
		return $this->db->query("Select dk.id, to_char(dk.tgl, 'DD-MM-YYYY') tgl, cj.nomer kk, cj.seri, dk.pp, dk.proses, dk.nama_mesin, dk.shift, (dl.kode|| ' - ' || dl.keterangan) jenis, to_char(dk.mulai,'hh24:mi') mulai, to_char(dk.selesai,'hh24:mi') selesai, dk.keterangan,
			(select xmlagg(xmlelement(e,nama||', ')).extract('//text()') from erp_karyawan ha2 join erp_prod_kary ds2 on ds2.id_operator=ha2.id where ds2.status='2' and ds2.id_pet_detail=dk.id) operator
			from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime left join erp_kk cj on cj.id=dk.id_kk
			where dk.status='1' and to_char(dk.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and dk.proses='$proses' and (case when '$kk'='All' then 'All' else cj.nomer end)='$kk' and (case when '$seri'='All' then 'All' else cj.seri end)='$seri' and dk.nama_mesin='$nama_mesin' and dk.desain='$desain'
			order by to_char(dk.tgl,'YYMMDD') desc, dk.mulai");
	}

	function isi_operator($proses, $desain, $nama_mesin, $shift) {
		$query = $this->db->query("Select xmlagg(xmlelement(e,ds.id_operator || ',')).extract('//text()') id from erp_prod_kary ds where ds.status='2' and ds.id_pet_detail=(select max(id) from erp_prod_downtime where proses='$proses' and desain='$desain' and nama_mesin='$nama_mesin' and shift='$shift')");
		return $query->row_array()['ID'];
	}

	function id_prod_proses($proses,$nama_mesin,$shift) {
		$query = $this->db->query("Select id from erp_prod_proses where proses='$proses' and nama_mesin='$nama_mesin' and shift='$shift'");
		$data = $query->row_array();
		return $data['ID'];
	}

	function urut_downtime() {
		$query = $this->db->query("Select max(id) urut from erp_prod_downtime");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan($id_downtime, $id_kk, $id_jenis, $id_prod_proses, $tanggal, $proses, $nama_mesin, $shift, $mulai, $selesai, $keterangan, $desain, $pp) {
		$this->db->query("Insert into erp_prod_downtime(id, pp, id_kk, id_mst_downtime, id_prod_proses, tgl, proses, nama_mesin, shift, mulai, selesai, keterangan, status, desain) values('$id_downtime', '$pp', '$id_kk', '$id_jenis', '$id_prod_proses', '$tanggal', '$proses', '$nama_mesin', '$shift', to_date('$mulai','DD-MM-YYYY HH24:MI:SS'), to_date('$selesai','DD-MM-YYYY HH24:MI:SS'), '$keterangan', '1', '$desain')");
	}

	function urut_opt() {
		$query = $this->db->query("Select max(id) urut from erp_prod_kary");
		$data = $query->row_array();
		return $data['URUT'] + 1;
	}

	function simpan_opt($urut_opt, $id_downtime, $id_operator, $status) {
		$this->db->query("Insert into erp_prod_kary(id, id_pet_detail, id_operator, status) values('$urut_opt','$id_downtime','$id_operator', '$status')");
	}

	function edit($id_edit) {
		$query = $this->db->query("Select dk.tgl, dk.proses, dk.id_kk, dk.nama_mesin, dk.shift, dk.id_mst_downtime, to_char(dk.mulai,'hh24:mi') mulai, to_char(dk.selesai,'hh24:mi') selesai, dl.keterangan jenis, dk.keterangan, dk.desain, dk.pp,
			(select xmlagg(xmlelement(e, id_operator||',')).extract('//text()') from erp_prod_kary where status='2' and id_pet_detail=dk.id) operator
			from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime
			where dk.id='$id_edit'");
		return $query->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_prod_downtime where id='$id_hapus'");
		$this->db->query("Delete from erp_prod_kary where id_pet_detail='$id_hapus' and status='2'");
	}

}