<?php class M_lap_jam extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk order by desain");
	}

	function kk() {
		return $this->db->query("Select cj.id, cj.nomer, cj.desain from erp_kk cj where cj.nomer not like '%PROOF%' order by cj.desain desc, cj.id desc");
	}

	function seri() {
		return $this->db->query("Select distinct seri from erp_kk where length(seri)>1 and nomer not like '%PROOF%' order by seri");
	}

	function proses() {
		return $this->db->query("Select distinct proses from erp_prod_downtime order by proses");
	}

	function jenis() {
		return $this->db->query("Select id, kode, keterangan from erp_prod_mst_downtime where status='1' order by kode");
	}

	function nama_mesin() {
		return $this->db->query("Select distinct nama_mesin, proses from erp_prod_downtime order by proses, nama_mesin desc");
	}
	
	function filter($tgl1, $tgl2, $desain, $kk, $proses, $mesin, $seri) {
		$query = $this->db->query("Select tgl,
			(select nomer from erp_kk where id=tbl.id_kk) kk,
			(select sum((dc2.selesai-dc2.mulai) * 24 * 60) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_gudang_order ca2 on ca2.id=db2.id_gudang_order join erp_kk_detail ck2 on ck2.id=ca2.id_relasi where ck2.id_kk=tbl.id_kk and db2.tanggal=tbl.tgl and ca2.desain=tbl.desain and db2.proses=tbl.proses and db2.nama_mesin=tbl.nama_mesin) efektif,
			(select sum((selesai-mulai) * 24 * 60) || '@' || sum(hasil) from erp_sticker where tgl=tbl.tgl and desain=tbl.desain) sticker,
			(select sum((dp.selesai-dp.mulai) * 24 * 60) || '@' || sum(dp.hasil) from erp_prod_rewind dp join erp_gudang_order ca on ca.id=dp.id_gudang_order join erp_kk_detail ck on ck.id=ca.id_relasi where dp.tgl=tbl.tgl and dp.desain=tbl.desain and dp.proses=tbl.proses and ck.id_kk=tbl.id_kk) rewind,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='A') da,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='B') db,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='C') dc,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='D') dd,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='E') de,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='F') df,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='G') dg,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='H') dh,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='I') di,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 left join erp_kk cj2 on cj2.id=dk2.id_kk join erp_prod_mst_downtime dl2 on dl2.id=dk2.id_mst_downtime where dk2.tgl=tbl.tgl and dk2.desain=tbl.desain and dk2.proses=tbl.proses and dk2.nama_mesin=tbl.nama_mesin and dk2.id_kk=tbl.id_kk and dl2.kode='J') dj,
			(select sum(dc2.hasil) || '@' || sum(dc2.hasil * dc2.qty_roll) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join erp_gudang_order ca2 on ca2.id=db2.id_gudang_order join erp_kk_detail ck2 on ck2.id=ca2.id_relasi where db2.tanggal=tbl.tgl and ca2.desain=tbl.desain and db2.proses=tbl.proses and db2.nama_mesin=tbl.nama_mesin and ck2.id_kk=tbl.id_kk) hasil
			from
			(select dk.desain, dk.tgl, dk.id_kk, dk.nama_mesin, dk.proses,
			(select nomer from erp_kk where id=dk.id_kk) kk
			from erp_prod_downtime dk
			union
			Select db.desain, db.tanggal tgl, ck.id_kk, db.nama_mesin, db.proses,
			(select nomer from erp_kk where id=ck.id_kk) kk
			from erp_kk cj join erp_kk_detail ck on ck.id_kk=cj.id join
			erp_gudang_order ca on ca.id_relasi=ck.id join erp_prod_pet db on db.id_gudang_order=ca.id) tbl
			where tbl.desain='$desain' and to_char(tbl.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$kk'='All' then 'All' else to_char(tbl.id_kk) end)='$kk' and tbl.proses='$proses' and tbl.nama_mesin='$mesin'");
		return $query->result_array(); // End Query
	}

}