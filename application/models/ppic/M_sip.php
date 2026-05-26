<?php class M_sip extends CI_Model {

	function db_perdana() {
		$perdana = $this->load->database('perdana', TRUE);
		return $perdana;
	}

	function karyawan() {
		$kary = explode('|', $_SESSION['logERP']);
		$id_kary = $kary[0];
		
		$query = $this->db->query("Select ha.nama, hb.nama bagian, ha.id_bagian, hb.kd_dept_simpg, ha.kd_unit from erp_karyawan ha join erp_bagian hb on hb.id=ha.id_bagian where ha.id='$id_kary'");
		$data = $query->row_array();
		return array($data['NAMA'], $data['BAGIAN'], $data['ID_BAGIAN'], $data['KD_DEPT_SIMPG'], $id_kary, $data['KD_UNIT']);
	}

	function bagian() {		
		return $this->db->query("Select * from erp_bagian where kd_dept_simpg is not null order by nama");
	}
	
	function unit() {
		return $this->db->query("Select * from erp_hr_unit where status<>'0' order by unit desc");
	}

	function no_sip() {
		$kary = $this->karyawan();
		$id_bagian = $kary[2];

		return $this->db->query("Select distinct ce.no_sip, ce.tanggal from erp_ppic_sip ce join erp_karyawan ha on ha.id=ce.id_karyawan where ha.id_bagian='$id_bagian' order by ce.tanggal desc, ce.no_sip desc");
	}

	function material() {
		return $this->db->query("Select pc.id id_material, pc.jenis, pc.satuan, no_rekjurnal,
		case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama,pc.spesifikasi,pc.kode_sakti
		from erp_barang pc 
		left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
		select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
		on pc.kode_sakti= b.kode    
		where pc.jenis not like '%WIP%' and pc.aktif<>'0' and pc.kode_simpg is not null 
		order by pc.nama");
	}

	     

	function satuan() {
		return $this->db->query("Select * from erp_pemb_satuan order by satuan");
	}

	function kd_kategori() {
		return $this->db->query("Select * from erp_ppic_kategori where status='1' order by id");
	}

	function filter($tgl1, $tgl2, $cari, $final, $kd_unit, $no_sip, $kd_kategori) {
		$kary = $this->karyawan();
		$id_kary = $kary[4];
		$bagian = '/' . $kary[3] . '/';
		
		return $this->db->query("Select ce.id, ce.kd_unit, to_char(ce.tanggal, 'dd-mm-yyyy') tanggal, ce.no_sip, ce.sifat, ce.persediaan, ha.nama nama_pemesan, hc.nama jabatan, pc.kode,  case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama_material, pc.spesifikasi, cf.satuan, cf.qty, to_char(cf.deadline, 'dd-mm-yyyy') deadline, cf.urut_sip, cf.id id_detail_sip, cf.keterangan,
			(Select kategori from erp_ppic_kategori where kode=cf.kd_kategori) kategori,
			(Select nvl(sum(pm2.qty),0) from erp_pemb_sp_detail pm2 join erp_po_detail pb2 on pb2.id=pm2.id_po_detail where pb2.id_sip_detail=cf.id) datang,
			(Select nvl(sum(qty),0) from erp_po_detail where id_sip_detail=cf.id) qty_po,
			(Select count(pb2.id_po) from erp_po_detail pb2 join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail where cf2.id_sip=ce.id) po,
			(Select final from erp_ppic_sip_detail where id=cf.id) final,
			(Select nomor_sip from sip_head_sakti where nomor_sip=concat(concat(substr(ce.no_sip,-2),substr(ce.no_sip,0,4)),substr(ce.no_sip,14,2))) sip_sakti_holo,
			(Select nomor_sip from hpd_sip_head where nomor_sip=concat(concat(substr(ce.no_sip,-2),substr(ce.no_sip,0,4)),substr(ce.no_sip,14,2))) sip_sakti_perdana,
			(Select nama from erp_bagian where kd_dept_simpg=substr(ce.no_sip,14,2) and rownum=1) bagian,
			(Select xmlagg(xmlelement(e,pa2.nomer||', ')).extract('//text()') from erp_po pa2 join erp_po_detail pb2 on pb2.id_po=pa2.id join erp_ppic_sip_detail cf2 on cf2.id=pb2.id_sip_detail join erp_ppic_sip ce2 on ce2.id=cf2.id_sip where cf2.id=cf.id and rownum='1') nmr_po
			from erp_ppic_sip_detail cf join erp_ppic_sip ce on ce.id=cf.id_sip join erp_karyawan ha on ha.id=ce.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_jabatan hc on hc.id=ha.id_jabatan join erp_barang pc on pc.id=cf.id_barang
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode 
			where ce.kd_unit='$kd_unit' and (ce.no_sip like '%$bagian%' or ce.id_karyawan='$id_kary') and to_char(ce.tanggal,'YYMMDD') between '$tgl1' and '$tgl2' and upper(pc.nama) like '%$cari%' and cf.final<>'2' and (case when '$final'='All' then 'All' when (Select final from tbl_detail_spp where trim(nomer_sip)=ce.no_sip and kode_barang=pc.kode_simpg and rownum='1') is null then 'F' else (Select final from tbl_detail_spp where trim(nomer_sip)=ce.no_sip and kode_barang=pc.kode_simpg and rownum='1') end) ='$final' and ce.kd_unit='$kd_unit' and (case when '$no_sip'='All' then '$no_sip' else ce.no_sip end)='$no_sip' and (case when '$kd_kategori'='All' then '$kd_kategori' else cf.kd_kategori end)='$kd_kategori'
			order by ce.tanggal desc, ce.no_sip desc, pc.nama");
	}

	function auto_no($year, $kode_departemen, $kd_unit, $id_sip) {
		$query = $this->db->query("Select substr(no_sip, 0, 4) urut, kd_unit from erp_ppic_sip where id='$id_sip'");
		$data = $query->row_array();

		if ($id_sip == '' || $kd_unit != $data['KD_UNIT']) {
			$query = $this->db->query("Select max(substr(ce.no_sip,0,4)) urut from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id where cf.final<>'2' and substr(ce.no_sip,14,2)='$kode_departemen' and ce.kd_unit='$kd_unit' and to_char(ce.tanggal,'YY')='$year' and trim(translate(substr(ce.no_sip,0,4), '0123456789', ' ')) is null");
			$data = $query->row_array();
			$urut_sip = sprintf('%04d', $data['URUT'] + 1);
		}else{
			$urut_sip = $data['URUT'];
		}
		return $urut_sip;
	}

	function ck_nmr($no_sip) {
		$query = $this->db->query("Select * from erp_ppic_sip where no_sip='$no_sip'");
		return $query->num_rows();
	}

	function ck_po($no_sip) {
		$query = $this->db->query("Select * from erp_po_detail pb join erp_ppic_sip_detail cf on cf.id=pb.id_sip_detail join erp_ppic_sip ce on ce.id=cf.id_sip where ce.no_sip='$no_sip'");
		return $query->num_rows();
	}

	function ck_block_id_barang($id_materials) {
		$query = $this->db->query("select * from erp_barang where id in(select id_barang from erp_barang_block where id_barang='$id_materials' and aktif='1')");
		return  $query->result_array();
	}


	function hapus_sip($id_sip, $nmr_sip) {		
		$this->db->query("Delete from erp_ppic_sip where id='$id_sip' or no_sip='$nmr_sip'");
		$this->db->query("Delete from erp_ppic_sip_detail where id_sip='$id_sip'");
	}

	function urut_sip() {
		$data = $this->db->query("Select max(id) id from erp_ppic_sip");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan($id_sip, $tanggal, $id_kary, $nmr_sip, $sifat, $kd_unit, $persediaan) {
		$this->db->query("Insert into erp_ppic_sip(id, tanggal, id_karyawan, no_sip, sifat, kd_unit, persediaan) values('$id_sip',TO_DATE('$tanggal','DD/MM/YYYY'),'$id_kary','$nmr_sip','$sifat','$kd_unit','$persediaan')");
	}

	function urut_sip_detail() {
		$data = $this->db->query("Select max(id) id from erp_ppic_sip_detail");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function simpan_detail($id_ppic_detail, $id_sip, $id_material, $qty, $deadline, $urut_sip, $keterangan, $satuan, $kd_kategori) {
		$qty = str_replace('.', ',', $qty);
		$keterangan = str_replace("'", "''", $keterangan);
		$this->db->query("Insert into erp_ppic_sip_detail(id, id_sip, id_barang, qty, deadline, final, urut_sip, keterangan, satuan, kd_kategori, status) values('$id_ppic_detail','$id_sip','$id_material','$qty',to_date('$deadline','DD/MM/YYYY'),'0','$urut_sip','$keterangan','$satuan','$kd_kategori','1')");
	}

	function edit($id_sip_detail) {
		$query = $this->db->query("Select ce.id id_sip, ce.no_sip, ce.sifat, to_char(ce.tanggal, 'dd-mm-yyyy') tanggal, ce.persediaan, pc.id id_barang, pc.jenis, cf.satuan, pc.nama, pc.spesifikasi, cf.id id_sip_detail, cf.qty, to_char(cf.deadline, 'dd-mm-yyyy') deadline, cf.keterangan, cf.kd_kategori, hd.kd_unit, hd.kode_transaksi,
			(Select nama from erp_bagian where kd_dept_simpg=substr(ce.no_sip,14,2) and rownum=1) bagian
			from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang join erp_hr_unit hd on hd.kd_unit=ce.kd_unit
			where cf.final<>'2' and ce.id=(select id_sip from erp_ppic_sip_detail where id='$id_sip_detail') order by cf.urut_sip");
		return $query->result_array();
	}

	function batal($id_sip_detail, $id_sip) {		
		$this->db->query("Delete from erp_ppic_sip_detail where id='$id_sip_detail'");

		// Atur Ulang Urut SIP
		$query = $this->db->query("Select ce.id, ce.no_sip, cf.id id_detail from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id where cf.final<>'2' and ce.id='$id_sip' order by cf.urut_sip");
		$data = $query->result_array();

		if (count($data) == 0) {
			$this->db->query("Delete from erp_ppic_sip where id='$id_sip'");
			return;
		}
		for ($i=0 ;$i<count($data); $i++) {
			$id = $data[$i]['ID'];
			$id_detail = $data[$i]['ID_DETAIL'];
			$urut_sip = $i+1;

			$this->db->query("Update erp_ppic_sip_detail set urut_sip='$urut_sip' where id='$id_detail'");
		}
	}

	function cetak($id_sip_detail) {
		$query = $this->db->query("Select ce.no_sip, to_char(ce.tanggal,'DD-Mon-YYYY') tgl, ce.persediaan,  case when pc.kode_sakti is null then pc.nama when kode_sakti is not null then b.nama_barang_sakti end nama, pc.spesifikasi, pc.no_rekjurnal, initcap(pc.jenis) jenis, cf.qty, cf.satuan, to_char(cf.deadline,'DD-Mon-YYYY') deadline, nvl(cf.keterangan,' ') keterangan, cf.kd_kategori, initcap(hd.unit) unit, ce.sifat,
			(select nama from erp_bagian where kd_dept_simpg=substr(ce.no_sip,14,2) and rownum=1) bagian
			from erp_ppic_sip ce join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc on pc.id=cf.id_barang 
			left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode  
			join erp_karyawan ha on ha.id=ce.id_karyawan join erp_bagian hb on hb.id=ha.id_bagian join erp_hr_unit hd on hd.kd_unit=ce.kd_unit
			where cf.final<>'2' and ce.id=(select id_sip from erp_ppic_sip_detail where id='$id_sip_detail') order by cf.id");
		return $query->result_array();
	}

	function data_sip($nmr) {
		$query = $this->db->query("Select ce.no_sip, substr(ce.no_sip,14,2) kode_departemen, to_date(ce.tanggal,'DD/MM/YYYY') tanggal, substr(replace(ha.nama,' ',''),0,8) username, ce.kd_unit, case when pc.kode_sakti is null then kode_simpg when kode_sakti is not null then pc.kode_sakti end  kode_simpg,  case when pc.kode_sakti is null then substr(pc.nama,0,60) when kode_sakti is not null then substr(b.nama_barang_sakti,0,60) end  nama_barang, substr(pc.spesifikasi,0,60) spesifikasi,pc.kode_sakti, pc.no_rekjurnal, cf.qty, cf.deadline, cf.keterangan, cf.urut_sip, cf.satuan 
		from erp_ppic_sip ce join erp_karyawan ha on ha.id=ce.id_karyawan 
		join erp_ppic_sip_detail cf on cf.id_sip=ce.id join erp_barang pc 
		 left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
				select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
				on pc.kode_sakti= b.kode    
		on pc.id=cf.id_barang where cf.final<>'2' and ce.no_sip='$nmr' order by cf.urut_sip
		");
		return $query->result_array();
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


	// ========================================  Menu SAKTI  ========================================
	// ==============================================================================================

	function hapus_sakti($nmr_simpg, $nmr_sakti) {
		if (substr($nmr_simpg,9,3) == 'HLG') {
			$this->db->query("Delete from sip_head_sakti where nomor_sip='$nmr_sakti'");
			$this->db->query("Delete from sip_item where nomor_sip='$nmr_sakti'");
		} else {
			$this->db->query("Delete from hpd_sip_head where nomor_sip='$nmr_sakti'");
			$this->db->query("Delete from hpd_sip_item where nomor_sip='$nmr_sakti'");
		}
	}

	function simpan_header_sakti($tanggal, $nmr_sip, $kode_unit, $kode_departemen, $username) {
		if ($kode_unit == '12') {
			$this->db->query("Insert into sip_head_sakti(NOMOR_SIP,KODE_DEPT,TANGGAL_DOKUMEN,TANGGAL_PAKAI,USERS,LAST_UPDATE) values('$nmr_sip','$kode_departemen','$tanggal','$tanggal','$username',sysdate)");
		} else {
			$this->db->query("Insert into hpd_sip_head(NOMOR_SIP,KODE_DEPT,TANGGAL_DOKUMEN,TANGGAL_PAKAI,USERS,LAST_UPDATE) values('$nmr_sip','$kode_departemen','$tanggal','$tanggal','$username',sysdate)");
		}
	}

	function simpan_detail_sakti($kode_unit, $nmr_sip, $urut_sip, $nama_barang, $qty, $satuan, $kode_barang, $spesifikasi) {
		if ($kode_unit == '12') {
			$this->db->query("Insert into sip_item(NOMOR_SIP, ITEM_SIP, NAMA_BARANG, QTY, SATUAN, KODE_BARANG, SPESIFIKASI) values('$nmr_sip','$urut_sip','$nama_barang','$qty','$satuan','$kode_barang','$spesifikasi')");
		} else {
			$this->db->query("Insert into hpd_sip_item(NOMOR_SIP, ITEM_SIP, NAMA_BARANG, QTY, SATUAN, KODE_BARANG, SPESIFIKASI) values('$nmr_sip','$urut_sip','$nama_barang','$qty','$satuan','$kode_barang','$spesifikasi')");
		}
	}

}
