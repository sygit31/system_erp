<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_material extends CI_Model {

	function status_menu($menu, $id_kary) {
		$query = $this->db->query("Select ab.status from erp_adm_akses ab join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail join erp_akun aa on aa.id=ab.id_akun where aa.id_karyawan='$id_kary' and ad.kode_menu='$menu'");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function bagian() {
		$id = $_SESSION['id_akun'];

		$data = $this->db->query("Select hb.nama bagian from erp_bagian hb join erp_karyawan ha on ha.id_bagian=hb.id join erp_akun aa on aa.id_karyawan=ha.id
			where aa.id='$id'");
		$bagian = $data->row_array();
		return $bagian['BAGIAN'];
	}

	function fKategori() {
		return $this->db->query("Select distinct kategori from erp_barang where jenis is not null order by kategori desc");
	}

	function jenis() {
		return $this->db->query("Select distinct kategori, jenis from erp_barang where jenis is not null order by kategori desc, jenis");
	}

	function karyawan() {
		return $this->db->query("Select distinct ha.id, ha.nama from erp_karyawan ha join erp_barang pc on pc.id_input=ha.id order by ha.nama");
	}

	function satuan() {
		return $this->db->query("Select * from erp_pemb_satuan order by satuan");
	}

	function material() {
		return $this->db->query("Select pc.*, ca.nama rekening, ha.nama pengguna, pc.deskripsi,
			(select count(id) from erp_ppic_sip_detail where id_barang=pc.id) qty,
			(select pe2.nama from erp_supplier pe2 join erp_material_supply pd2 on pd2.id_supplier=pe2.id where pd2.id_barang=pc.id and rownum='1') supplier
			from erp_barang pc left join erp_cc_rekening ca on ca.no_rekjurnal=pc.no_rekjurnal join erp_karyawan ha on ha.id=pc.id_input
			where pc.aktif<>'0' and pc.jenis not like '%WIP%' and pc.jenis not like '%FG%' and pc.no_rekjurnal is null order by pc.nama");
	}

	function filter($kategori, $jenis, $cari, $approved, $id_karyawan) {
		return $this->db->query("Select pc.*,pc.kode_sakti ||' ' || b.nama_barang_sakti as nama_barang_sakti, ca.nama rekening, ha.nama pengguna, pc.deskripsi,
			(select count(id) from erp_ppic_sip_detail where id_barang=pc.id) qty,
			(select pe2.nama from erp_supplier pe2 join erp_material_supply pd2 on pd2.id_supplier=pe2.id where pd2.id_barang=pc.id and rownum='1') supplier
			from erp_barang pc left join  (select b.kode,b.nama as nama_barang_sakti from erp_barang a,(select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
			select kode,jenis,nama from bahan_tmp where kode is not null) b  where a.kode_sakti =b.kode) b
			on pc.kode_sakti= b.kode  left join erp_cc_rekening ca on ca.no_rekjurnal=pc.no_rekjurnal join erp_karyawan ha on ha.id=pc.id_input
			where pc.aktif<>'0'  and (case when '$kategori'='All' then 'All' else pc.kategori end) like '$kategori' and 
			(case when '$jenis'='All' then 'All' else pc.jenis end) like '$jenis' and (upper(pc.nama) like '%$cari%' or upper(pc.spesifikasi) like '%$cari%') 
			--and pc.jenis not like '%WIP%' 
			and pc.tahun >=2020
			and pc.jenis not like '%FG%' and (case when pc.no_rekjurnal is null then '0' else '1' end) like '$approved' and (case when '$id_karyawan'='All' then 'All' else to_char(pc.id_input) end)='$id_karyawan'
			order by pc.nama");
	}

	function auto_no($jenis) {
		$query = $this->db->query("Select count(id) as id from erp_barang where substr(jenis,0,3) like '%$jenis%'");
		$data = $query->row_array();
		$id = $data['ID'] + 1;
		return sprintf('%04d', $id);
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_barang");
		$data = $query->row_array();
		return $data['ID'] + 1;
	}

	function hapus($id_barang) {
		$this->db->query("Update erp_barang set aktif='0', updated=sysdate where id='$id_barang'");
	}

	function cek_barang($nama, $spesifikasi) {
		$query = $this->db->query("Select * from erp_barang where aktif<>'0' and upper(nama)='$nama' and upper(spesifikasi)='$spesifikasi'");
		return $query->num_rows();
	}

	function simpan($id, $kode, $nama_material, $spesifikasi, $satuan, $min_stok, $kategori, $jenis, $tahun, $qc_test, $id_kary, $deskripsi,$kode_barang_sakti) {
		$this->db->query("Insert into erp_barang(id, kode, nama, spesifikasi, ukuran, satuan, min_stok, tgl_input, id_input, kategori, jenis, tahun, aktif, qc_test, updated, updated_status, deskripsi,kode_sakti) values('$id','$kode','$nama_material','$spesifikasi','-','$satuan','$min_stok',to_date(sysdate,'DD/MM/YYYY'),'$id_kary','$kategori','$jenis','$tahun','1','$qc_test',to_date(sysdate,'DD/MM/YYYY'),'0','$deskripsi','$kode_barang_sakti')");
	}
    
	function simpan_block_barang($id) {
		$this->db->query("Insert into erp_barang_block(id_barang,aktif) values('$id','1')");
	}


	function rekjurnal() {
		return $this->db->query("Select * from erp_cc_rekening order by nama");
	}

	function supplier() {
		return $this->db->query("Select id, nama from erp_supplier order by nama");
	}
    
	function nama_barang_sakti_baru() {
		return $this->db->query("select kode,jenis,nama from hpd_bahan_tmp  where kode is not null and kode not in(select kode_sakti from erp_barang where kode_sakti is not null)  union all
		select kode,jenis,nama from bahan_tmp where kode is not null and kode not in(select kode_sakti from erp_barang where kode_sakti is not null) order by jenis asc");
	}
     
	function nama_barang_sakti() {
		return $this->db->query("select kode,jenis,nama from hpd_bahan_tmp  where kode is not null  union all
		select kode,jenis,nama from bahan_tmp where kode is not null  order by jenis asc");
	}

	function nama_barang_sakti_by_id($id) {
		$query = $this->db->query("select kode,jenis,nama from hpd_bahan_tmp  where kode is not null and kode='$id' union all
		select kode,jenis,nama from bahan_tmp where kode is not null and kode='$id' order by jenis asc");
		$data = $query->row_array();
		$nama = $data['NAMA'] ;
		return $nama;
	}
	function simpg() {
		return $this->db->query("Select distinct spi.kode_barang, spi.nama_barang, spi.nomer_rekjurnal, spo.nama_jenisjurnal
			from tbl_master_barang spi join tbl_detail_sip spb on spb.kode_barang=spi.kode_barang join tbl_header_sip spa on spa.nomer_sip=spb.nomer_sip join tbl_master_rekening spo on spo.nomer_rekjurnal=spi.nomer_rekjurnal
			where to_char(spa.tanggal_pesan,'YY')>='14' and (select count(kode_simpg) from erp_barang where kode_simpg=spi.kode_barang) = 0
			order by spi.nama_barang");
	}

	function username_input($id_barang) {
		$query = $this->db->query("Select username from erp_akun where id_karyawan=(select id_input from erp_barang where id='$id_barang')");
		$data = $query->row_array();
		return $data['USERNAME'];
	}

	function kode_barang($kategori, $kode) {
		$admin = $this->load->database('admin', TRUE);
		$query = $admin->query("Select max(substr(kode_barang,-5)) urut from tbl_master_barang where kategori='$kategori'");
		$data = $query->row_array();
		$urut = $data['URUT'] + 1;
		return '12.' . $kode . '.' . sprintf('%05d', $urut);
	}

	function simpan_simpg($kode_barang, $satuan, $nama, $kategori, $username, $rekjurnal, $min_stok) {
		$admin = $this->load->database('admin', TRUE);

		$query = $admin->query("Select max(id_barang) as id from tbl_master_barang");
		$data = $query->row_array();
		$id_barang = $data['ID'] + 1;

		$admin->query("Insert into tbl_master_barang(kode_barang, kode_satuan, nama_barang, kategori, username, lastupdate, nomer_rekjurnal, tgl_input_barang, min_stok, persatuan, satuan_hitung2, panjang, id_barang) values('$kode_barang','$satuan','$nama','$kategori','$username',to_char(sysdate,'DD-MM-YY HH:MI:SS'),'$rekjurnal',sysdate,'$min_stok','1','$satuan','0','$id_barang')");
	}

	function simpan_update($id_barang, $rek_jurnal, $kode_simpg,$id_barang_sakti) {
		$this->db->query("Update erp_barang set no_rekjurnal='$rek_jurnal',kode_sakti='$id_barang_sakti', kode_simpg='$kode_simpg', updated=sysdate where id='$id_barang'");
	}

	function buka_block($id_barang) {
		$this->db->query("Update erp_barang_block set aktif='0' where id_barang='$id_barang'");
	}

	function update_rekening($id_barang, $rekjurnal) {
		$this->db->query("Update erp_barang set no_rekjurnal='$rekjurnal', updated=sysdate where id='$id_barang'");
		$this->db->query("Update tbl_master_barang set nomer_rekjurnal='$rekjurnal' where kode_barang=(select kode_simpg from erp_barang where id='$id_barang')");
	}

	function update_id_barang_sakti($id_barang, $id_barang_sakti) {
		$this->db->query("Update erp_barang set kode_sakti='$id_barang_sakti', updated=sysdate where id='$id_barang'");	
	}

	function update_material($id_barang, $nama, $spesifikasi, $satuan, $deskripsi) {
		$this->db->query("Update erp_barang set nama='$nama', satuan='$satuan', spesifikasi='$spesifikasi', updated=sysdate, deskripsi='$deskripsi' where id='$id_barang'");

		$query = $this->db->query("Select kode_simpg from erp_barang where id='$id_barang'");
		$data = $query->row_array();
		$kode_simpg = $data['KODE_SIMPG'];

		if ($kode_simpg != '') {
			$nama_simpg = substr($nama . ' - ' . $spesifikasi, 0, 60);
			$this->db->query("Update tbl_master_barang set nama_barang='$nama_simpg', lastupdate=to_char(sysdate,'DD-MM-YY HH:MI:SS') where kode_barang='$kode_simpg'");
		}
	}
}