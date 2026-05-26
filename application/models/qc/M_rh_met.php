<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_rh_met extends CI_Model {

	function db_mat() {
		return $this->load->database('db_mat', TRUE);
	}

	function isi_rim() {
		return $this->db_mat()->query("Select si.kode_rim,
			(select rh || '@' || suhu from erp_qc_rh_mat where rim=si.kode_rim) rh
			from tbl_detail_rim_materai si where to_char(si.tgl_mutasi, 'YY')>=26
			order by kode_rim")->result_array(); // Semua Tahun 2025
		return $this->db_mat()->query("Select si.kode_rim,
			(select rh || '@' || suhu from erp_qc_rh_mat where rim=si.kode_rim) rh
			from tbl_detail_rim_materai si
			where (select count(kode_rim) from tbl_detail_outgoing_materai where kode_rim=si.kode_rim)=0 and
			(select count(rim) from erp_qc_rh_mat where rim=si.kode_rim)=0 and substr(si.kode_rim,2,2)>21
			order by kode_rim")->result_array(); // Yang Belum Terkirim
	}

	function filter($tgl1, $tgl2, $kode) {
		return $this->db->query("Select qk.id, qk.tgl, qk.rim, qk.rh, qk.suhu,
			(select wm_concat(kode_palette) from edp.tbl_palette_materai@perdana_new where kode_rim=qk.rim) pallet,
			(select wm_concat(nomor_pp_cutter) from edp.tbl_detail_lbl_finishing_mat@perdana_new where kode_rim=qk.rim) kode_cutter
			from erp_qc_rh_mat qk
			where to_char(qk.tgl, 'YYMMDD') between '$tgl1' and '$tgl2' and qk.rim like '%$kode%'
			order by qk.tgl desc, qk.rim desc")->result_array();
	}

	function filter_pallet($tgl1, $tgl2) {
		return $this->db_mat()->query("Select distinct sk.shipment_date, sk.no_sp, sh.kode_palette, wm_concat(sj.kode_rim) rim,
			(select replace(avg(replace(qk2.rh, '.', ',')), ',', '.') from erp_qc_rh_mat qk2 join tbl_detail_outgoing_materai sj2 on sj2.kode_rim=qk2.rim join tbl_palette_materai sh2 on sh2.kode_rim=sj2.kode_rim where sh2.kode_palette=sh.kode_palette) rh,
			(select replace(avg(replace(qk2.suhu, '.', ',')), ',', '.') from erp_qc_rh_mat qk2 join tbl_detail_outgoing_materai sj2 on sj2.kode_rim=qk2.rim join tbl_palette_materai sh2 on sh2.kode_rim=sj2.kode_rim where sh2.kode_palette=sh.kode_palette) suhu
			from tbl_outgoing_materai sk join tbl_detail_outgoing_materai sj on sj.id_outgoing=sk.id_outgoing join tbl_palette_materai sh on sh.kode_rim=sj.kode_rim
			where to_char(sk.shipment_date, 'YYMMDD') between '$tgl1' and '$tgl2'
			group by sk.shipment_date, sk.no_sp, sh.kode_palette, sk.no_sp, sh.kode_palette
			order by sk.shipment_date desc, sh.kode_palette")->result_array();
	}

	function cek_data($rim) {
		return $this->db->query("Select * from erp_qc_rh_mat where rim='$rim'")->num_rows();
	}

	function urut() {
		$query = $this->db->query("Select max(id) as id from erp_qc_rh_mat");
		return $query->row_array()['ID'] + 1;
	}

	function simpan($urut, $tgl, $rim, $rh, $suhu) {
		$this->db->query("Insert into erp_qc_rh_mat(id, tgl, rim, rh, suhu) values('$urut', '$tgl', '$rim', '$rh', '$suhu')");
	}

	function update($tgl, $rim, $rh, $suhu) {
		$this->db->query("Update erp_qc_rh_mat set tgl='$tgl', rh='$rh', suhu='$suhu' where rim='$rim'");
	}

	function edit($id_edit) {
		return $this->db->query("Select * from erp_qc_rh_mat where id='$id_edit'")->row_array();
	}

	function hapus($id_hapus) {
		$this->db->query("Delete from erp_qc_rh_mat where id='$id_hapus'");
	}

}