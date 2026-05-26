<?php class M_neraca_wip extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_kk where length(desain)=4 order by desain desc");
	}

	function kk() {
		return $this->db->query("Select nomer kk from erp_kk order by id desc");
	}

	function seri() {
		return $this->db->query("Select distinct(seri) seri from erp_kk where length(seri)>1 order by seri");
	}

	function proses() {
		return $this->db->query("Select (select nama from erp_station where id=re.id_station) proses
			from erp_station_flow re where deskripsi='PET' and active_flow_holo='Y' order by urut");
	}

	function filter($diff, $tgl1, $tgl2, $desain, $seri, $proses, $kk) {
		if ($proses == 'Emboss') {
			$query = $this->db->query("Select dt.tgl,
				(select xmlagg(xmlelement(e,nmr||', ')).extract('//text()') from (select distinct substr(df.nmr,0,3) nmr, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') where to_char(tgl,'YYMMDD')=dt.tgl) mutasi,
				(select xmlagg(xmlelement(e,kk||', ')).extract('//text()') from (select distinct substr(ca.keterangan_penggunaan,0,3) kk, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') where to_char(tgl,'YYMMDD')=dt.tgl) kk,
				(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk where to_char(gj.tanggal,'YYMMDD')<'$tgl1' and cj.desain='$desain' and cj.seri='$seri' and (case when '$kk'='All..' then 'All..' else cj.nomer end)='$kk') awal_masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') awal_keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') awal_reject,
				(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk where to_char(gj.tanggal,'YYMMDD')=dt.tgl and cj.desain='$desain' and cj.seri='$seri' and (case when '$kk'='All..' then 'All..' else cj.nomer end)='$kk') masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') reject
				from
				(Select to_char((to_date('$tgl2') - rownum),'YYMMDD') tgl
				from dual connect by rownum <= '$diff' order by to_char((to_date('$tgl2') - rownum),'yymmdd')) dt");
		}else{
			$query = $this->db->query("Select dt.tgl,
				(select xmlagg(xmlelement(e,nmr||', ')).extract('//text()') from (select distinct substr(df.nmr,0,3) nmr, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') where to_char(tgl,'YYMMDD')=dt.tgl) mutasi,
				(select xmlagg(xmlelement(e,kk||', ')).extract('//text()') from (select distinct substr(ca.keterangan_penggunaan,0,3) kk, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') where to_char(tgl,'YYMMDD')=dt.tgl) kk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order join erp_prod_mutasi_detail de on de.id_prod_mutasi=df.id join erp_prod_pet_detail dc on dc.id=de.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_akhir='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') awal_masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') awal_keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') awal_reject,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order join erp_prod_mutasi_detail de on de.id_prod_mutasi=df.id join erp_prod_pet_detail dc on dc.id=de.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_akhir='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses' and (case when '$kk'='All..' then 'All..' else ca.keterangan_penggunaan end)='$kk') reject
				from
				(Select to_char((to_date('$tgl2') - rownum),'YYMMDD') tgl
				from dual connect by rownum <= '$diff' order by to_char((to_date('$tgl2') - rownum),'yymmdd')) dt");
		}
		return $query->result_array();
	}

	function filter2($diff, $tgl1, $tgl2, $desain, $seri, $proses, $kk) {
		if ($proses == 'Emboss') {
			$query = $this->db->query("Select dt.tgl,
				(select xmlagg(xmlelement(e,nmr||', ')).extract('//text()') from (select distinct substr(df.nmr,0,3) nmr, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') where to_char(tgl,'YYMMDD')=dt.tgl) mutasi,
				(select xmlagg(xmlelement(e,kk||', ')).extract('//text()') from (select distinct substr(ca.keterangan_penggunaan,0,3) kk, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') where to_char(tgl,'YYMMDD')=dt.tgl) kk,
				(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk join erp_gudang_order ca on ca.id_relasi=cj.id and ca.relasi='KK DETAIL' where to_char(gj.tanggal,'YYMMDD')<'$tgl1' and ca.desain='$desain' and cj.seri='$seri') awal_masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') awal_keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses') awal_reject,
				(select nvl(sum(gb.qty_terima),0) from erp_penerimaan_detail gb join erp_ipb_detail gk on gk.id_detail_terima=gb.id_detail_terima join erp_ipb gj on gj.id=gk.id_ipb join erp_kk_detail ck on ck.id=gj.id_kk_detail join erp_kk cj on cj.id=ck.id_kk join erp_gudang_order ca on ca.id_relasi=cj.id and ca.relasi='KK DETAIL' where to_char(gj.tanggal,'YYMMDD')=dt.tgl and ca.desain='$desain' and cj.seri='$seri') masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses') reject
				from
				(Select to_char((to_date('$tgl2') - rownum),'YYMMDD') tgl
				from dual connect by rownum <= '$diff' order by to_char((to_date('$tgl2') - rownum),'yymmdd')) dt");
		}else{
			$query = $this->db->query("Select dt.tgl,
				(select xmlagg(xmlelement(e,nmr||', ')).extract('//text()') from (select distinct substr(df.nmr,0,3) nmr, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') where to_char(tgl,'YYMMDD')=dt.tgl) mutasi,
				(select xmlagg(xmlelement(e,kk||', ')).extract('//text()') from (select distinct substr(ca.keterangan_penggunaan,0,3) kk, df.tgl from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') where to_char(tgl,'YYMMDD')=dt.tgl) kk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order join erp_prod_mutasi_detail de on de.id_prod_mutasi=df.id join erp_prod_pet_detail dc on dc.id=de.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_akhir='$proses') awal_masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') awal_keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')<'$tgl1' and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses') awal_reject,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order join erp_prod_mutasi_detail de on de.id_prod_mutasi=df.id join erp_prod_pet_detail dc on dc.id=de.id_prod_pet_detail join erp_prod_pet db on db.id=dc.id_prod_pet where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_akhir='$proses') masuk,
				(select nvl(sum(df.qty),0) from erp_prod_mutasi df join erp_gudang_order ca on ca.id=df.id_gudang_order where to_char(df.tgl,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and df.station_awal='$proses') keluar,
				(select nvl(sum(dc.reject),0) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet join erp_gudang_order ca on ca.id=db.id_gudang_order join erp_prod_proses da on da.id=db.id_prod_proses where dc.aktif<>'0' and to_char(db.tanggal,'YYMMDD')=dt.tgl and ca.desain='$desain' and ca.seri='$seri' and da.proses='$proses') reject
				from
				(Select to_char((to_date('$tgl2') - rownum),'YYMMDD') tgl
				from dual connect by rownum <= '$diff' order by to_char((to_date('$tgl2') - rownum),'yymmdd')) dt");
		}
		return $query->result_array();
	}

}
