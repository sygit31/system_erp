<?php 
class M_lap_jam extends CI_Model {

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
		return $this->db->query("Select distinct nama_mesin, proses from erp_prod_proses order by proses, nama_mesin desc");
	}
	
	function filter($tgl1, $tgl2, $desain, $kk, $proses, $mesin, $seri) {
		$query = $this->db->query("Select distinct tbl.tgl, tbl.kk,
			(select sum((dc2.selesai-dc2.mulai) * 24 * 60) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join
			erp_gudang_order ca2 on ca2.id=db2.id_gudang_order join erp_prod_proses da2 on da2.id=db2.id_prod_proses where db2.tanggal=tbl.tgl and ca2.desain=tbl.desain and da2.proses=tbl.proses and da2.nama_mesin=tbl.nama_mesin and ca2.keterangan_penggunaan=tbl.kk) prod,
			(select sum(dc2.hasil) from erp_prod_pet_detail dc2 join erp_prod_pet db2 on db2.id=dc2.id_prod_pet join
			erp_gudang_order ca2 on ca2.id=db2.id_gudang_order join erp_prod_proses da2 on da2.id=db2.id_prod_proses where db2.tanggal=tbl.tgl and ca2.desain=tbl.desain and da2.proses=tbl.proses and da2.nama_mesin=tbl.nama_mesin and ca2.keterangan_penggunaan=tbl.kk) hasil
			from
			(Select distinct db.tanggal tgl, ca.desain, ca.keterangan_penggunaan kk, da.proses, da.nama_mesin, ca.seri from erp_prod_pet db join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses
			union
			Select distinct dk.tgl tgl, cj.desain, cj.nomer kk, da.proses, da.nama_mesin, cj.seri from erp_prod_downtime dk join erp_kk cj on cj.id=dk.id_kk join erp_prod_proses da on da.id=dk.id_prod_proses) tbl
			where to_char(tbl.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and tbl.desain='$desain' and (case when '$kk'='All' then 'All' else tbl.kk end)='$kk' and tbl.proses='$proses' and tbl.nama_mesin='$mesin' and (case when '$seri'='All' then 'All' else tbl.seri end)='$seri'
			order by tgl");
		$dt_tgl_prod = $query->result_array();

		$query = $this->db->query("Select distinct dk.tgl, dl.kode, cj.nomer kk,
			(select sum(dk2.selesai-dk2.mulai) * 24 * 60 from erp_prod_downtime dk2 join erp_prod_proses da2 on da2.id=dk2.id_prod_proses join erp_kk cj2 on cj2.id=dk2.id_kk
			where dk2.tgl=dk.tgl and dk2.id_mst_downtime=dk.id_mst_downtime and cj2.desain='$desain' and da2.proses='$proses' and da2.nama_mesin='$mesin' and cj2.nomer=cj.nomer) downtime
			from erp_prod_downtime dk join erp_prod_mst_downtime dl on dl.id=dk.id_mst_downtime join erp_kk cj on cj.id=dk.id_kk
			where dl.status='1' and to_char(dk.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$kk'='All' then 'All' else cj.nomer end)='$kk' and (case when '$seri'='All' then 'All' else cj.seri end)='$seri'
			order by dk.tgl, dl.kode");
		$dt_downtime = $query->result_array();

		return array($dt_tgl_prod, $dt_downtime);
	}

}
?>