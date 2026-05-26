<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_gudang extends CI_Model 
{
	function terima_kertas() {		
		$db_193 = $this->load->database('db_193', TRUE);
		$tgl = date('Y-m-d');
		$timbang = $db_193->query("Select a.tgl_npk, a.no_npk, left(a.no_roll,5) as no_roll, a.berat, b.berat as berat_pnp, c.toleransi from scan_terima a left join (timbang_ulang b inner join toleransi c on c.id_toleransi=b.id_toleransi) on a.id_masuk=b.id_masuk where a.tgl_npk='$tgl' order by a.desain desc, tgl_npk, right(a.no_roll,1), a.no_roll");
		return $timbang;
	}

	function filter_terima_kertas($data) {
		$tgl1 = date('Y-m-d', strtotime($data[0]));
		$tgl2 = date('Y-m-d', strtotime($data[1]));
		$cari = $data[2];

		$db_193 = $this->load->database('db_193', TRUE);
		$timbang = $db_193->query("Select a.tgl_npk, a.no_npk, left(a.no_roll,5) as no_roll, a.berat, b.berat as berat_pnp, c.toleransi from scan_terima a left join (timbang_ulang b inner join toleransi c on c.id_toleransi=b.id_toleransi) on a.id_masuk=b.id_masuk where a.tgl_npk between '$tgl1' and '$tgl2' and (a.no_npk like '%$cari%' or no_roll like '%$cari%') order by a.desain desc, tgl_npk, right(a.no_roll,1), a.no_roll");
		return $timbang;
	}

	function ekspedisi_kertas() {
		$tgl = date('d-m-Y', strtotime('-0 days'));
		$ekspedisi = $this->db->query("Select TGL_NPK, NO_NPK, LEBAR_CM, NO_ROLL, NETTO_KG, TGL_RENCANA, NOMOR_PP, PAKAI_KG, RUSAK_KG from TBL_TERIMA where TGL_RENCANA='$tgl' and substr(NO_ROLL,5,1)='B' order by NO_ROLL");
		return $ekspedisi;
	}

	function filter_ekspedisi_kertas($tgl1, $tgl2, $ukuran) {
		$ekspedisi = $this->db->query("Select TGL_NPK, NO_NPK, LEBAR_CM, NO_ROLL, NETTO_KG, TGL_RENCANA, NOMOR_PP, PAKAI_KG, RUSAK_KG from TBL_TERIMA where TGL_RENCANA >= '$tgl1' and TGL_RENCANA <= '$tgl2' and substr(NO_ROLL,5,1)='$ukuran' order by NO_ROLL");
		return $ekspedisi;
	}

}
?>