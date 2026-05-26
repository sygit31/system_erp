<?php class M_kp extends CI_Model {

	function desain($kd_unit) {
		return $this->db->query("Select distinct desain from erp_ppic_kp where kd_unit='$kd_unit' order by desain desc");
	}

	function filter($tgl1, $tgl2, $kd_unit, $cari, $desain, $tipe, $master) {
		return $this->db->query("Select cc.id id_kp, cd.id id_kp_detail, cc.tipe, pc.kode, to_char(cc.tanggal, 'dd-mm-yyyy') tanggal, to_char(cc.deadline, 'dd-mm-yyyy') deadline, cc.id, cc.nmr, cc.desain, pc.nama, cd.master, cd.qty, pc.spesifikasi, pc.ukuran, cc.keterangan, cd.note, cc.status,
			(select count(id_kp_detail) from erp_galv_proses where id_kp_detail=cd.id and result='Baik' and status<>0) as qty_baik,
			(select count(id_kp_detail) from erp_galv_proses where id_kp_detail=cd.id and result='Reject' and status<>0) as qty_reject
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_barang pc on pc.id=cc.id_produk
			where to_char(cc.tanggal, 'yymmdd') between '$tgl1' and '$tgl2' and cd.status<>'0' and cc.kd_unit='$kd_unit' and (case when '$desain'='All' then 'All' else cc.desain end) ='$desain' and (case when '$tipe'='All' then 'All' else cc.tipe end) ='$tipe' and (case when '$master'='All' then 'All' else cd.master end) ='$master' and cc.nmr like '%$cari%'
			order by cc.tanggal desc, pc.jenis, cc.nmr desc, cd.master");
	}

}