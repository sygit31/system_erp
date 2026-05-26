<?php 
class M_lap_pet extends CI_Model {
	
	function kk() {
		return $this->db->query("Select distinct keterangan_penggunaan kk, tanggal from erp_gudang_order order by tanggal desc, keterangan_penggunaan desc");
	}

	function info_kk($kk) {
		$query = $this->db->query("Select distinct ca.desain, ca.seri, ca.qty oplah, to_char(ca.tanggal,'DD-Mon-YYYY') tanggal, to_char(ca.tanggal_penggunaan,'DD-Mon-YYYY') deltime,
			(select nvl(sum(dc2.hasil),0) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_prod_proses da2 on da2.id=db2.id_prod_proses where da2.proses='Emboss' and db2.id_gudang_order=ca.id) realisasi
			from erp_gudang_order ca where ca.keterangan_penggunaan='$kk'");
		return $query->row_array();
	}

	function info_roll($kk) {
		$tgl = $this->db->query("Select distinct tbl.tgl, tanggal,
			(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gp on gp.id_detail_terima=gb.id_detail_terima join erp_ipb go on go.id=gp.id_ipb join erp_kk_detail ck on ck.id=go.id_kk_detail join erp_kk cj on cj.id=ck.id_kk where cj.nomer='$kk' and to_char(go.tanggal,'DD-Mon-YY')=tbl.tgl) bon,
			(select nvl(sum(dc.hasil),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Emboss' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) hasil_emboss,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Emboss' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) reject,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Emboss' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl and teller='1') teller,
			(select nvl(sum(dc.hasil),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Metalize' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) met_baik,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Metalize' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) met_waste,
			(select nvl(sum(dc.hasil),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Coating Sensitizing' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) sensi_baik,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Coating Sensitizing' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) sensi_waste,
			(select nvl(sum(dc.hasil),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Coating Readable' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) readible_baik,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Coating Readable' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) readible_waste,
			(select nvl(sum(dc.hasil),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Belah' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) belah_baik,
			(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Belah' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) belah_waste,
			(select nvl(sum(dc.hasil*dc.qty_roll),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Pita' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) hasil_pita,
			(select nvl(sum(dc.reject+dc.reject_konversi),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where da.proses='Pita' and dc.aktif='1' and ca.keterangan_penggunaan='$kk' and to_char(db.tanggal,'DD-Mon-YY')=tbl.tgl) reject_pita,
			(Select nvl(count(id),0) from erp_galv_ipb where to_char(tgl,'DD-Mon-YY')=tbl.tgl and no_kk='$kk') qty_pch
			from
			(select to_char(go.tanggal,'DD-Mon-YY') tgl, go.tanggal from erp_ipb go join erp_kk_detail ck on ck.id=go.id_kk_detail join erp_kk cj on cj.id=ck.id_kk where cj.nomer='$kk' union select distinct to_char(db.tanggal,'DD-Mon-YY') tgl, db.tanggal from erp_prod_pet db join erp_prod_proses da on da.id=db.id_prod_proses join erp_gudang_order ca on ca.id=db.id_gudang_order where ca.keterangan_penggunaan='$kk' union select distinct to_char(tgl,'DD-Mon-YY') tgl, tgl tanggal from erp_galv_ipb where no_kk='$kk') tbl
			order by tbl.tanggal");
		return $tgl->result_array();  // Pengembalian Nilai
	}

}
?>