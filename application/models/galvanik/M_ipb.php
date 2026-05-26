<?php

class M_ipb extends CI_Model {

	function status_menu($kode_menu, $id_kary) {
		$query = $this->db->query("Select status from erp_adm_akses where id_menu_detail=(Select id from erp_adm_menu_detail where kode_menu='$kode_menu') and id_akun=(Select id from erp_akun where id_karyawan='$id_kary')");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function kk($kd_unit) {
		if ($kd_unit == '12') {
			return $this->db->query("Select ca.id, ca.keterangan_penggunaan kk, ca.seri, ca.desain from erp_gudang_order ca where status='OPEN' order by id desc");
		}else{
			return $this->db->query("Select co.id, co.nomer kk, '' seri, '' desain from p_kk co order by id desc");
		}
	}

	function nama_pengawas($kd_unit) {
		return $this->db->query("Select distinct nvl(initcap(nick_name), initcap(ha.nama)) nama, ha.id
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where af.trans='IPB PCH Emboss' and af.kd_unit='$kd_unit' and af.status='1'
			order by nvl(initcap(ha.nick_name), initcap(ha.nama))");
	}

	function nama_is($kd_unit) {
		return $this->db->query("Select distinct nvl(initcap(nick_name), initcap(ha.nama)) nama, ha.id
			from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id
			where af.trans='IPB PCH IS' and af.kd_unit='$kd_unit' and af.status='1'
			order by nvl(initcap(ha.nick_name), initcap(ha.nama))");
	}

	function seri() {
		return $this->db->query("Select distinct upper(seri) seri from erp_gudang_order where length(seri)>3 order by seri");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order order by desain desc");
	}

	function filter($tgl1, $tgl2, $kd_unit, $desain, $seri, $cari) {
		if ($kd_unit == '01') {$desain = 'All..'; $seri = 'All..';}
		return $this->db->query("Select vc.id, vc.no_kk, to_char(vc.tgl, 'dd-mm-yyyy') tgl, vc.nmr, pc.nama, vc.ukuran, vb.no_reg, vc.aktif, 
			(select cj2.seri from erp_kk cj2 join erp_galv_ipb vc2 on vc2.no_kk=cj2.nomer where vc2.id=vc.id and rownum='1') seri,
			(Select count(id) from erp_galv_reject where id_galv_ipb=vc.id and status='2' and rownum='1') qty_kembali
			from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp join erp_barang pc on pc.id=cc.id_produk
			where vc.aktif<>'0' and to_char(vc.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and vc.kd_unit='$kd_unit' and (case when '$kd_unit'='01' or '$seri'='All..' then 'All..' else (select cj2.seri from erp_kk cj2 join erp_galv_ipb vc2 on vc2.no_kk=cj2.nomer where vc2.id=vc.id and rownum='1') end)='$seri' and (case when '$kd_unit'='01' then '$desain' else cc.desain end)='$desain' and upper(pc.nama) like '%$cari%'
			order by vc.tgl desc, vc.id desc");
	}

	function isi_barang($kd_unit, $tipe, $desain) {
		if ($kd_unit == '01') {$desain = 'All';}
		$data = $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi deskripsi, pc.kode
			from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id
			where cd.master='PCH' and pc.aktif='1' and vb.status='1' and vb.result='Baik' and cc.kd_unit='$kd_unit' and cc.tipe='$tipe' and (case when '$desain'='All' then '$desain' else cc.desain end)='$desain' order by substr(pc.kode,0,1), pc.nama");
		return $data->result_array();
	}

	function auto_no($desain, $kd_unit, $tipe, $tahun) {
		if ($kd_unit == '12') {
			$query = $this->db->query("Select max(substr(vc.nmr,0,3)) nmr
				from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp
				where vc.aktif<>0 and vc.tipe='$tipe' and cc.desain='$desain' and vc.kd_unit='$kd_unit' and trim(TRANSLATE(substr(vc.nmr,0,3), '0123456789', ' ')) is null");
		}else{
			$query = $this->db->query("Select max(substr(vc.nmr,0,3)) nmr
				from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp
				where vc.aktif<>0 and vc.tipe='$tipe' and to_char(vc.tgl, 'YYYY')='$tahun' and vc.kd_unit='$kd_unit' and trim(TRANSLATE(substr(vc.nmr,0,3), '0123456789', ' ')) is null");			
		}
		$data = $query->row_array();
		return  sprintf('%03d', $data['NMR'] + 1);
	}

	function isi_pch($qty_ipb,$id_barang) {
		$query = $this->db->query("Select * from
			(Select vb.id, pc.nama, pc.spesifikasi deskripsi, pc.ukuran, vb.no_reg from erp_galv_proses vb join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp join erp_barang pc on pc.id=cc.id_produk where vb.result='Baik' and vb.status='1' and pc.id='$id_barang' and cd.master='PCH' order by substr(vb.no_reg,-3))
			where rownum<='$qty_ipb'");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_galv_ipb");
		$data = $query->row_array();
		$urut = $data['URUT'] + 1;
		return $urut;
	}

	function cek_nomor($desain, $tipe, $kd_unit, $urut, $th) {
		$query = $this->db->query("Select *
			from erp_galv_ipb vc join erp_karyawan ha on ha.id=vc.id_input join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp
			where vc.aktif<>'0' and vc.tipe='$tipe' and cc.desain='$desain' and ha.kd_unit='$kd_unit' and substr(vc.nmr,0,3)='$urut' and substr(vc.nmr,-4)='$th' and trim(TRANSLATE(substr(vc.nmr,0,3), '0123456789', ' ')) is null");
		return $query->num_rows();
	}

	function simpan($id_ipb,$tgl,$nmr,$id_galv_proses,$no_kk,$id_kary, $ukuran, $tipe, $kd_unit) {
		$this->db->query("Insert into erp_galv_ipb(id, tgl, tipe, nmr, id_galv_proses, ukuran, no_kk, aktif, updated, id_input, kd_unit) values('$id_ipb','$tgl','$tipe','$nmr','$id_galv_proses','$ukuran','$no_kk','1',sysdate,'$id_kary','$kd_unit')");

		// Update Status PCH
		$this->db->query("Update erp_galv_proses set status='2', updated=sysdate, updated_status='1' where id='$id_galv_proses'");
	}

	function hapus($id) {
		// Batal Status PCH
		$this->db->query("Update erp_galv_proses set status='1', updated=sysdate, updated_status='1' where id=(Select id_galv_proses from erp_galv_ipb where id='$id')");
		
		$this->db->query("Delete from erp_galv_ipb where id='$id'");
	}

	function approve($nmr) {
		$this->db->query("Update erp_galv_ipb set aktif='2' where nmr='$nmr' and aktif='1'");
	}

}