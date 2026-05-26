<?php class M_lap_sip extends CI_Model {

	function db_perdana() {
		$perdana = $this->load->database('perdana', TRUE);
		return $perdana;
	}

	function get_karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		return $kary[0];
	}

	function karyawan() {
		return $this->db->query("Select distinct ha.id, ha.nama
			from erp_karyawan ha join erp_ppic_sip ce on ce.id_karyawan=ha.id
			where ha.status<>0
			order by nama");
	}

	function show_bagian() {
		return $this->db->query("Select nama bagian, kd_dept_simpg from erp_bagian order by nama");
	}

	function kd_kategori() {
		return $this->db->query("Select * from erp_ppic_kategori where status='1' order by id");
	}
	
	function unit() {
		return $this->db->query("Select * from erp_hr_unit where status<>'0' order by unit desc");
	}
	
	function nmr() {
		return $this->db->query("Select distinct no_sip, tanggal from erp_ppic_sip order by tanggal desc");
	}

	function bahan() {
		return $this->db->query("Select distinct cf.id_barang, pc.nama, pc.spesifikasi
			from erp_barang pc join erp_ppic_sip_detail cf on cf.id_barang=pc.id order by pc.nama");
	}

	function filter($tgl1, $tgl2, $nmr, $bagian, $id_kary, $final, $kd_unit, $kd_kategori, $id_barang) {
		$bagian = $bagian == 'All' ? 'All' : '/' . $bagian . '/';

		return $this->db->query("Select ce.id id_sip, cf.id id_sip_detail, to_char(ce.tanggal, 'dd-mm-yyyy') tanggal, ce.no_sip, ce.sifat, ha.nama nama_pemesan, hc.nama jabatan, pc.id id_material, pc.kode, pc.nama nama_material, pc.spesifikasi, pc.no_rekjurnal, cf.satuan, pc.jenis, cf.qty, to_char(cf.deadline, 'dd-mm-yyyy') deadline, cf.urut_sip,
			(Select nama from erp_bagian where kd_dept_simpg=substr(ce.no_sip,14,2) and rownum='1') bagian,
			(Select kategori from erp_ppic_kategori where kode=cf.kd_kategori) kategori,
			(Select nvl(pa2.nomer,'') from erp_po pa2 join erp_po_detail pb2 on pb2.id_po=pa2.id where pb2.id_sip_detail=cf.id and rownum='1') nomer_po,
			(Select nvl(sum(qty),0) from erp_po_detail where id_sip_detail=cf.id) qty_po,
			(Select nvl(sum(pm2.qty),0) from erp_pemb_sp_detail pm2 join erp_po_detail pb2 on pb2.id=pm2.id_po_detail where pb2.id_sip_detail=cf.id) qty_datang
			from erp_ppic_sip_detail cf join erp_ppic_sip ce on ce.id=cf.id_sip join erp_karyawan ha on ha.id=ce.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_barang pc on pc.id=cf.id_barang
			where to_char(ce.tanggal,'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$bagian'='All' then 'All' else ce.no_sip end) like '%$bagian%' and (case when '$id_kary'='All' then 'All' else to_char(ha.id) end)='$id_kary' and (case when '$final'='All' then 'All' else (Select final from tbl_detail_sip where trim(nomer_sip)=ce.no_sip and nomer_urut_sip=cf.urut_sip) end) ='$final' and ce.kd_unit='$kd_unit' and (case when '$kd_kategori'='All' then '$kd_kategori' else cf.kd_kategori end)='$kd_kategori' and (case when '$nmr'='All' then '$nmr' else ce.no_sip end)='$nmr' and (case when '$id_barang'='All' then '$id_barang' else to_char(cf.id_barang) end)='$id_barang'
			order by ce.tanggal desc, ce.no_sip, pc.nama");
	}

	function id_sip_bskk() {
		$query = $this->db->query("Select max(id) as id from erp_ppic_sip_bskk");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function finals($id_sip_bskk,$id_sip_detail,$tgl,$nmr) {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];

		$this->db->query("Update erp_ppic_sip_detail set final='1' where id='$id_sip_detail'");
		$this->db->query("Insert into erp_ppic_sip_bskk(id, id_input, tgl_input, nmr, id_sip_detail) values('$id_sip_bskk','$id_kary',sysdate,'$nmr','$id_sip_detail')");
	}

	// Membatalkan SIMPG
	function batal_simpg($id_sip_detail) {
		$admin = $this->load->database('admin', TRUE);

		$query = $this->db->query("Select ce.no_sip, cf.urut_sip from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id where cf.id='$id_sip_detail'");
		$data = $query->row_array();
		$no_sip = $data['NO_SIP'];
		$urut = $data['URUT_SIP'];

		$admin->query("Delete from tbl_detail_sip where nomer_sip='$no_sip' and nomer_urut_sip='$urut'");
	}

	// Membatalkan Sakti
	function batal_sakti($id_sip_detail) {
		$admin = $this->load->database('admin', TRUE);

		$query = $this->db->query("Select substr(ce.no_sip,20,2) tahun, substr(ce.no_sip,0,4) urut, substr(ce.no_sip,14,2) kd_dept, cf.urut_sip from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id where cf.id='$id_sip_detail'");
		$data = $query->row_array();
		$nomor_sip = $data['TAHUN'] . $data['URUT'] . $data['KD_DEPT'];
		$urut = $data['URUT_SIP'];

		$admin->query("Delete from sip_item where nomor_sip='$nomor_sip' and to_number(item_sip)='$urut'");
	}

	function cek_simpg($kd_unit, $nmr) {
		if ($kd_unit == '01') {
			$query = $this->db_perdana()->query("Select * from tbl_detail_spp where nomer_sip='$nmr'");
		}else{
			$query = $this->db->query("Select * from tbl_detail_spp where nomer_sip='$nmr'");
		}
		return $query->num_rows();
	}


	// ========================================  Menu SIMPG  ========================================
	// ==============================================================================================

	function hapus_simpg($nmr_simpg) {
		if (substr($nmr_simpg,9,3) == 'HPD') {
			$this->db_perdana()->query("Delete from tbl_header_sip where nomer_sip='$nmr_simpg'");
		}else{
			$this->db->query("Delete from tbl_header_sip where nomer_sip='$nmr_simpg'");		
		}
	}

	function data_sip($nmr) {
		$query = $this->db->query("Select ce.no_sip, substr(ce.no_sip,14,2) kode_departemen, ce.tanggal, substr(replace(ha.nama,' ',''),0,8) username, ce.kd_unit, pc.kode_simpg, substr(pc.nama,0,60) nama_barang, substr(pc.spesifikasi,0,60) spesifikasi, pc.no_rekjurnal, cf.qty, cf.deadline, cf.keterangan, cf.urut_sip, cf.satuan from erp_ppic_sip ce join erp_karyawan ha on ha.id=ce.id_karyawan join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang where cf.final<>'2' and ce.no_sip='$nmr' order by cf.urut_sip");
		return $query->result_array();
	}

	function simpan_header_simpg($nmr_sip, $kode_departemen, $tanggal, $username, $kode_unit, $kode_proyek, $kode_sub_unit) {
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Insert into tbl_header_sip(nomer_sip, kode_departemen, tanggal_pesan, username, lastupdate, kode_unit, kode_proyek, kode_sub_unit) values('$nmr_sip','$kode_departemen','$tanggal','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$kode_sub_unit')");
		}else{
			$this->db->query("Insert into tbl_header_sip(nomer_sip, kode_departemen, tanggal_pesan, username, lastupdate, kode_unit, kode_proyek, kode_sub_unit) values('$nmr_sip','$kode_departemen','$tanggal','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$kode_unit','$kode_proyek','$kode_sub_unit')");
		}
	}

	function simpan_detail_simpg($nmr_sip, $kode_barang, $satuan, $nomer_rekjurnal, $qty, $final, $alokasi, $urut_sip, $no_rekkredit, $deadline, $keterangan, $kode_unit) {
		$keterangan = str_replace("'", "''", $keterangan);
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Insert into tbl_detail_sip(nomer_sip, kode_barang, kode_satuan, nomer_rekjurnal, jumlah_pesan, final, alokasi_biaya, nomer_urut_sip, nomer_rekkredit, deltime, keterangan) values('$nmr_sip','$kode_barang','$satuan','$nomer_rekjurnal','$qty','$final','$alokasi','$urut_sip','$no_rekkredit','$deadline','$keterangan')");
		}else{
			$this->db->query("Insert into tbl_detail_sip(nomer_sip, kode_barang, kode_satuan, nomer_rekjurnal, jumlah_pesan, final, alokasi_biaya, nomer_urut_sip, nomer_rekkredit, deltime, keterangan) values('$nmr_sip','$kode_barang','$satuan','$nomer_rekjurnal','$qty','$final','$alokasi','$urut_sip','$no_rekkredit','$deadline','$keterangan')");
		}
	}

	function update_upload($no_sip, $kode_unit) {
		if ($kode_unit == '01') {
			$this->db_perdana()->query("Update tbl_header_sip set upload='T' where trim(nomer_sip)='$no_sip'");
		}else{
			$this->db->query("Update tbl_header_sip set upload='T' where trim(nomer_sip)='$no_sip'");
		}
	}
}
