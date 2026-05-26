<?php

class M_reject extends CI_Model {

	function status_menu($kode_menu,$id_kary) {
		$query = $this->db->query("Select status from erp_adm_akses where id_menu_detail=(Select id from erp_adm_menu_detail where kode_menu='$kode_menu') and id_akun=(Select id from erp_akun where id_karyawan='$id_kary')");
		$data = $query->row_array();
		return $data['STATUS'];
	}

	function kd_unit($id_kary) {
		$query = $this->db->query("Select kd_unit from erp_karyawan where id='$id_kary'");
		$data = $query->row_array();
		return $data['KD_UNIT'];
	}

	function barang() {
		return $this->db->query("Select pc.id, pc.nama
			from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_galv_waktu va on va.id=vb.id_waktu join erp_barang pc on pc.id=va.id_produk
			order by pc.nama");
	}

	function seri() {
		return $this->db->query("Select distinct upper(seri) seri from erp_gudang_order where length(seri)>3 order by seri");
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_gudang_order order by desain desc");
	}

	function filter($tgl1, $tgl2, $kd_unit, $seri, $desain) {
		// return $this->db->query("Select vd.id, vc.no_kk, to_char(vd.tgl,'DD-Mon-YYYY') tgl, vd.nmr, pc.nama, vb.no_reg, vd.kondisi, vd.keterangan, vd.status, vc.nmr no_ipb,
		// 	(select cj2.seri from erp_kk cj2 join erp_galv_ipb vc2 on vc2.no_kk=cj2.nomer where vc2.id=vc.id and rownum=1) seri
		// 	from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp join erp_barang pc on pc.id=cc.id_produk join erp_karyawan ha on ha.id=vd.id_input
		// 	where vd.status<>'0' and to_char(vd.tgl,'YYMMDD') between '$tgl1' and '$tgl2' and ha.kd_unit='12' and (case when '$seri'='All..' then 'All..' else (select cj2.seri from erp_kk cj2 join erp_galv_ipb vc2 on vc2.no_kk=cj2.nomer where vc2.id=vc.id and rownum=1) end)='$seri' and cc.desain='$desain'
		// 	order by vd.tgl desc, vd.nmr desc, vb.no_reg desc");

		return $this->db->query("SELECT DISTINCT 
			vd.id,
			vc.no_kk,
			TO_CHAR(vd.tgl,'DD-Mon-YYYY') tgl,
			vd.nmr,
			pc.nama,
			vb.no_reg,
			vd.kondisi,
			vd.keterangan,
			vd.status,
			vc.nmr no_ipb,
			cj2.seri
			FROM   erp_galv_reject vd
			JOIN erp_galv_ipb vc       ON vc.id = vd.id_galv_ipb
			JOIN erp_galv_proses vb    ON vb.id = vc.id_galv_proses
			JOIN erp_ppic_kp_detail cd ON cd.id = vb.id_kp_detail
			JOIN erp_ppic_kp cc        ON cc.id = cd.id_kp
			JOIN erp_barang pc         ON pc.id = cc.id_produk
			JOIN erp_karyawan ha       ON ha.id = vd.id_input
			JOIN erp_kk cj2            ON vc.no_kk = cj2.nomer
			WHERE  vd.status <> '0'
			AND  TO_CHAR(vd.tgl,'YYMMDD') BETWEEN '$tgl1' AND '$tgl2'
			AND  ha.kd_unit = '12'
			AND  cc.desain = '$desain'
			ORDER BY 
			tgl     DESC,
			vd.nmr  DESC,
			vb.no_reg DESC");
	}

	function get_desain($nmr_ipb) {
		$query = $this->db->query("Select distinct cc.desain from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_galv_ipb vc on vc.id_galv_proses=vb.id
			where vc.nmr='$nmr_ipb'");
		$data = $query->row_array();
		return $data['DESAIN'];
	}

	function auto_no($desain) {
		$query = $this->db->query("Select max(substr(vd.nmr,0,3)) nmr
			from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp
			where vd.status<>'0' and cc.desain='$desain' and trim(TRANSLATE(substr(vc.nmr,0,3), '0123456789', ' ')) is null");
		$data = $query->row_array();
		return  sprintf('%03d', $data['NMR'] + 1);
	}

	function isi_ipb($kd_unit) {
		$data = $this->db->query("Select distinct vc.nmr, vc.tgl from erp_barang pc join erp_ppic_kp cc on cc.id_produk=pc.id join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_galv_ipb vc on vc.id_galv_proses=vb.id
			where vc.aktif='2' and vc.kd_unit='$kd_unit' and
			(select count(vd2.id) from erp_galv_reject vd2 join erp_galv_ipb vc2 on vc2.id=vd2.id_galv_ipb where vc2.nmr=vc.nmr and vd2.status<>'0')='0'
			order by vc.tgl desc");
		return $data->result_array();
	}

	function isi_pch($nmr_ipb) {
		$query = $this->db->query("Select vc.id, vb.no_reg, pc.nama, vc.nmr no_ipb, cc.desain
			from erp_galv_ipb vc join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp join erp_barang pc on pc.id=cc.id_produk
			where vc.aktif='2' and vc.nmr='$nmr_ipb' and (select count(id_galv_ipb) from erp_galv_reject where id_galv_ipb=vc.id and status<>0)='0'
			order by vb.no_reg");
		return $query->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) urut from erp_galv_reject");
		$data = $query->row_array();
		$urut = $data['URUT'] + 1;
		return $urut;
	}

	function cek_nomor($urut, $desain) {
		$query = $this->db->query("Select *
			from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_ppic_kp_detail cd on cd.id=vb.id_kp_detail join erp_ppic_kp cc on cc.id=cd.id_kp
			where vd.status<>'0' and cc.desain='$desain' and substr(vd.nmr,0,3)='$urut' and trim(TRANSLATE(substr(vd.nmr,0,3), '0123456789', ' ')) is null");
		return $query->num_rows();
	}

	function simpan($id_ipb, $tgl, $nmr, $id_galv_ipb, $id_kary, $kondisi, $keterangan) {
		$this->db->query("Insert into erp_galv_reject(id, tgl, nmr, id_galv_ipb, kondisi, status, updated, id_input, keterangan) values('$id_ipb','$tgl','$nmr','$id_galv_ipb','$kondisi','1',sysdate,'$id_kary','$keterangan')");
	}

	function hapus($nmr) {
		$this->db->query("Delete from erp_galv_reject where nmr='$nmr'");
	}

	function approve($nmr) {
		$this->db->query("Update erp_galv_reject set status='2', updated=sysdate where nmr='$nmr' and status='1'");
	}

	function isi_print($nmr) {
		// $query = $this->db->query("Select to_char(vd.tgl,'DD-Mon-YYYY') tgl, vd.nmr, pc.nama, vc.ukuran, vb.no_reg, vd.kondisi, vd.keterangan, vc.nmr no_ipb
		// 	from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb join erp_galv_proses vb on vb.id=vc.id_galv_proses join erp_galv_waktu va on va.id=vb.id_waktu join erp_barang pc on pc.id=va.id_produk
		// 	where vd.nmr='$nmr' and vd.status<>'0' order by vb.no_reg");
		// return $query->result_array();

		$query = $this->db->query("Select to_char(vd.tgl,'DD-Mon-YYYY') tgl, vd.nmr, pc.nama, vc.ukuran, vb.no_reg, vd.kondisi, vd.keterangan, vc.nmr no_ipb
			from erp_galv_reject vd join erp_galv_ipb vc on vc.id=vd.id_galv_ipb 
			join erp_galv_proses vb on vb.id=vc.id_galv_proses 
			JOIN erp_ppic_kp_detail cd ON cd.id = vb.id_kp_detail
			JOIN erp_ppic_kp cc        ON cc.id = cd.id_kp
			JOIN erp_barang pc         ON pc.id = cc.id_produk
			where vd.nmr='$nmr' and vd.status<>'0' order by vb.no_reg");
		return $query->result_array();
	}



	
}