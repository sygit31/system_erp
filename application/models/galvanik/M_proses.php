<?php class M_proses extends CI_Model {

	function get_tahun($kd_unit) {
		// return $this->db->query("Select distinct desain from erp_ppic_kp where kd_unit='$kd_unit' order by desain desc");
		return $this->db->query("Select distinct desain from erp_ppic_kp order by desain desc");
	}

	function filter($kd_unit, $tgl1, $tgl2, $desain, $tipe, $tahap, $cari, $quality, $nama) {
		return $this->db->query("Select cc.tipe, cc.desain, to_char(vb.mulai,'dd-mm-yyyy') tgl_proses, vb.no_bak, va.waktu, vb.timer_stop, to_char(vb.mulai,'HH24:MI:SS') mulai, to_char(vb.selesai,'HH24:MI:SS') selesai, cc.nmr no_kp, va.master, pc.nama nama_produk, vb.result, vb.no_reg, vb.note
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_galv_proses vb on vb.id_kp_detail=cd.id join erp_galv_waktu va on va.id=vb.id_waktu join erp_barang pc on pc.id=va.id_produk
			where vb.status != '0' and cc.kd_unit='$kd_unit' and to_char(vb.mulai,'YYMMDD') between '$tgl1' and '$tgl2' and cc.desain like '%$desain' and cc.tipe='$tipe' and (case when vb.status != '0' and '$tahap'='All' then 'All' else cd.master end) ='$tahap' and (case when '$quality'='All' then 'All' else vb.result end) ='$quality' and upper(cc.nmr) like '%$cari%' and upper(pc.nama) like '%$nama%'
			order by vb.mulai desc");
	}

}