<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	function desain() {
		return $this->db->query("Select distinct desain from erp_qc_komplain order by desain desc")->result_array();
	}

	function komplain() {
		return $this->db->query("Select * from erp_qc_komplain where status='1' order by tgl desc, nmr desc")->result_array();
	}

	function filter_k($tgl1, $tgl2, $seri) {
		return $this->db->query("Select tbl.kd_reject, tbl.qty, tbl.total_qty from
			(Select qc.kd_reject,
			(select sum(qb.lbr) from erp_qc_sortir_temuan qb join erp_qc_sortir qa on qa.id=qb.id_qc where qb.kd_reject=qc.kd_reject and to_char(qa.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$seri'='0' then '0' else qa.seri end)='$seri') qty,
			(select sum(qb.lbr) from erp_qc_sortir_temuan qb join erp_qc_sortir qa on qa.id=qb.id_qc where to_char(qa.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and (case when '$seri'='0' then '0' else qa.seri end)='$seri') total_qty
			from erp_qc_kode qc where qc.status<>'0' order by qc.bahan, qc.kd_reject) tbl
			where tbl.qty>0")->result_array();
	}

	function filter_m($tgl1, $tgl2) {
		$adhesive = ['12.299.03747=EJ', '12.299.00081=GW', '12.299.00092=Readable'];

		return $this->db->query("Select distinct ql.tgl,
			(select avg(ql2.gsm_1+ql2.gsm_2+ql2.gsm_3) from erp_qc_coating ql2 where ql2.gsm_1>0 and ql2.gsm_2>0 and ql2.gsm_3>0 and ql2.tgl=ql.tgl) gsm_qc,
			(select avg(ql2.gsm_1) from erp_qc_coating ql2 where ql2.gsm_1>0 and ql2.tgl=ql.tgl) gsm_1,
			(select avg(ql2.gsm_2) from erp_qc_coating ql2 where ql2.gsm_2>0 and ql2.tgl=ql.tgl) gsm_2,
			(select avg(ql2.gsm_3) from erp_qc_coating ql2 where ql2.gsm_3>0 and ql2.tgl=ql.tgl) gsm_3,
			(select sum(dc.hasil) from erp_prod_pet_detail dc join erp_prod_pet db on db.id=dc.id_prod_pet where db.tanggal=ql.tgl and db.proses='Coating Readable') meter_pet,
			(select sum(a.qty) from simpg_tbl_hasil_produksi a join simpg_tbl_master_mesin b on b.kode_mesin=a.k_msn where a.tgl=ql.tgl and b.nama_mesin like '%READABLE PITA CUKAI%') meter_simpg,
			(select sum(qty) from simpg_gudang_kredit where tgl_trans_kredit=ql.tgl and (kode_barang='12.299.03747' or kode_barang='12.299.00081' or kode_barang='12.299.00092') and kode_gudang_tujuan='99') kg_bahan,
			(select sum(qty) from simpg_gudang_kredit where tgl_trans_kredit=ql.tgl and (kode_barang='12.299.03747') and kode_gudang_tujuan='99') kg_ej,
			(select sum(qty) from simpg_gudang_kredit where tgl_trans_kredit=ql.tgl and (kode_barang='12.299.00081') and kode_gudang_tujuan='99') kg_gw,
			(select sum(qty) from simpg_gudang_kredit where tgl_trans_kredit=ql.tgl and (kode_barang='12.299.00092') and kode_gudang_tujuan='99') kg_rd
			from erp_qc_coating ql
			where to_char(ql.tgl, 'YYMMDD') between '$tgl1' and '$tgl2'
			order by ql.tgl")->result_array();
	}

	function filter_rsss($tgl1, $tgl2, $ukuran) {
		return $this->db->query("Select distinct qd.tgl, desain,
			to_number(substr(replace(awal, '.', ','), 1, instr(replace(awal, '.', ','), '|') - 1)) as rh_awal,
			to_number(substr(replace(awal, '.', ','), instr(replace(awal, '.', ','), '|') + 1)) as suhu_awal
			from erp_qc_rh")->result_array();
	}

	function filter_r($tgl1, $tgl2, $ukuran) {
		return $this->db->query("Select distinct tbl.tgl,
			sum(case when rh_awal between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_a1,
			sum(case when rh_awal between 10 and 39.9 then 1 else 0 end) over (partition by tbl.tgl) as qty_a2,
			sum(case when rh_awal>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_a3,
			sum(case when rh_tengah between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_t1,
			sum(case when rh_tengah between 10 and 39.9 then 1 else 0 end) over (partition by tbl.tgl) as qty_t2,
			sum(case when rh_tengah>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_t3,
			sum(case when rh_akhir between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_r1,
			sum(case when rh_akhir between 10 and 39.9 then 1 else 0 end) over (partition by tbl.tgl) as qty_r2,
			sum(case when rh_akhir>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_r3
			from (select tgl,
			to_number(substr(replace(awal, '.', ','), 1, instr(replace(awal, '.', ','), '|') - 1)) as rh_awal,
			to_number(substr(replace(tengah, '.', ','), 1, instr(replace(tengah, '.', ','), '|') - 1)) as rh_tengah,
			to_number(substr(replace(akhir, '.', ','), 1, instr(replace(akhir, '.', ','), '|') - 1)) as rh_akhir
			from erp_qc_rh where tgl between date '$tgl1' and date '$tgl2' and (case when '$ukuran'='All' then 'All' else no_roll end) like '%$ukuran%') tbl
			order by tbl.tgl")->result_array();
	}

	function filter_rss($tgl1, $tgl2, $ukuran) {
		return $this->db->query("Select tgl, (qty_a1+qty_t1+qty_r1) qty, (qty_a2+qty_t2+qty_r2) qty_min, (qty_a3+qty_t3+qty_r3) qty_max from
			(select distinct tbl.tgl,
			sum(case when rh_awal between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_a1,
			sum(case when rh_awal<40 then 1 else 0 end) over (partition by tbl.tgl) as qty_a2,
			sum(case when rh_awal>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_a3,
			sum(case when rh_tengah between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_t1,
			sum(case when rh_tengah<40 then 1 else 0 end) over (partition by tbl.tgl) as qty_t2,
			sum(case when rh_tengah>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_t3,
			sum(case when rh_akhir between 40 and 58 then 1 else 0 end) over (partition by tbl.tgl) as qty_r1,
			sum(case when rh_akhir<40 then 1 else 0 end) over (partition by tbl.tgl) as qty_r2,
			sum(case when rh_akhir>58 then 1 else 0 end) over (partition by tbl.tgl) as qty_r3
			from (select tgl,
			to_number(substr(replace(awal, '.', ','), 1, instr(replace(awal, '.', ','), '|') - 1)) as rh_awal,
			to_number(substr(replace(tengah, '.', ','), 1, instr(replace(tengah, '.', ','), '|') - 1)) as rh_tengah,
			to_number(substr(replace(akhir, '.', ','), 1, instr(replace(akhir, '.', ','), '|') - 1)) as rh_akhir
			from erp_qc_rh where tgl between date '$tgl1' and date '$tgl2' and (case when '$ukuran'='All' then 'All' else no_roll end) like '%$ukuran%') tbl
			order by tbl.tgl)")->result_array();
	}

	function filter_s($tgl1, $tgl2) {
		return $this->db->query("Select distinct qa.tgl,
			(select sum(baik) from erp_qc_sortir where tgl=qa.tgl) baik,
			(select sum(r_holo+r_kertas) from erp_qc_sortir where tgl=qa.tgl) rusak
			from erp_qc_sortir qa
			where to_char(qa.tgl, 'YYMMDD') between '$tgl1' and '$tgl2'
			order by qa.tgl")->result_array();
	}

	function auto_no($id_edit, $tahun, $tgl) {
		if ($id_edit != '') {
			$query = $this->db->query("Select nmr, to_char(tgl, 'YY') tahun from erp_qc_komplain where id='$id_edit'");
			$data = $query->row_array();

			if ($data['TAHUN'] == $tahun) {return $data['NMR'];}
		}

		$query = $this->db->query("Select max(nmr) nmr from erp_qc_komplain where to_char(tgl, 'YY')='$tahun'")->row_array();
		return sprintf('%03d', $query['NMR'] + 1);
	}

	function filter_komplain($desain) {
		return $this->db->query("Select * from erp_qc_komplain where desain='$desain' and status='1' order by tgl desc, nmr desc")->result_array();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_komplain")->row_array();
		return $query['ID'] + 1;
	}

	function simpan($urut, $desain, $nmr, $tgl, $problem, $root_cause, $preventive) {
		$this->db->query("Insert into erp_qc_komplain(id, desain, nmr, tgl, problem, root_cause, preventive, status) values('$urut', '$desain', '$nmr', '$tgl', '$problem', '$root_cause', '$preventive', '1')");
	}

	function update($id_edit, $desain, $nmr, $tgl, $problem, $root_cause, $preventive) {
		$this->db->query("Update erp_qc_komplain set desain='$desain', nmr='$nmr', tgl='$tgl', problem='$problem', root_cause='$root_cause', preventive='$preventive' where id='$id_edit'");
	}

	function edit($id_edit) {
		return $this->db->query("Select * from erp_qc_komplain where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_komplain where id='$id_hapus'");
	}

}