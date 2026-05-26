<?php class M_kp extends CI_Model {

	function id_location() {
		return '3';
	}

	function karyawan($kd_menu) {
		$kary = explode('|', $_SESSION['logERP']);
		$query = $this->db->query("Select ha.id, ha.nama, ha.kd_unit,
			(select ab.status from erp_adm_akses ab join erp_akun aa on aa.id=ab.id_akun join erp_adm_menu_detail ad on ad.id=ab.id_menu_detail where ad.kode_menu='$kd_menu' and aa.id_karyawan=ha.id) akses
			from erp_karyawan ha where ha.id='$kary[0]'");
		return $query->row_array();
	}

	function desain() {
		return $this->db->query("Select distinct desain from erp_ppic_kp order by desain desc");
	}

	function produk() {
		$id_location = $this->id_location();
		return $this->db->query("Select distinct pc.id, pc.nama, pc.spesifikasi, pc.kode, pc.ukuran, pc.tahun
			from erp_barang pc
			where pc.aktif='1' and pc.jenis='WIP - BAHAN WIP'
			order by pc.tahun desc, pc.nama");
	}

	function filter_kp($tgl1, $tgl2, $kd_unit, $cari, $desain, $tipe, $master, $nama, $jenis) {
		$produk=$this->db->query("Select cc.id id_kp, cd.id id_kp_detail, cc.tipe, pc.kode, to_char(cc.tanggal, 'dd-mm-yyyy') tanggal, to_char(cc.deadline, 'dd-mm-yyyy') deadline, cc.id, cc.nmr, cc.jenis, cc.desain, pc.nama, cd.master, cd.qty, pc.spesifikasi, pc.ukuran, cc.keterangan, cd.note, cc.status, cc.kd_unit, cd.updated_status,
			(select count(id_kp_detail) from erp_galv_proses where id_kp_detail=cd.id and result='Baik' and status<>0) as qty_baik,
			(select count(id_kp_detail) from erp_galv_proses where id_kp_detail=cd.id and result='Reject' and status<>0) as qty_reject
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_barang pc on pc.id=cc.id_produk
			where to_char(cc.tanggal, 'YYMMDD') between '$tgl1' and '$tgl2' and cd.status<>'0' and cc.kd_unit like '%$kd_unit' and (case when '$desain'='All' then 'All' else cc.desain end) ='$desain' and (case when '$tipe'='All' then 'All' else cc.tipe end) ='$tipe' and (case when '$master'='All' then 'All' else cd.master end) ='$master' and cc.nmr like '%$cari%' and upper(pc.nama) like '%$nama%' and (case when '$jenis'='All' then 'All' else cc.jenis end)='$jenis'
			order by cc.tanggal desc, pc.jenis, cc.nmr desc, cd.master");
		return $produk;
	}

	function auto_no($desain, $unit, $tipe) {
		$auto_no = $this->db->query("Select nvl(max(substr(nmr,0,3)),0) as nmr from erp_ppic_kp
			where desain = '$desain' and kd_unit='$unit' and tipe='$tipe' and status<>0");
		$urut = $auto_no->row_array();		
		return sprintf("%'03d\n", $urut['NMR'] + 1);
	}

	function cek_nomor($urut,$unit,$desain) {
		$query = $this->db->query("Select count(id) qty from erp_ppic_kp where status<>'0' and substr(nmr,0,3)='$urut' and kd_unit='$unit' and desain='$desain'");
		$data = $query->row_array();
		return $data['QTY'];
	}

	function simpan_kp($data) {

		// Ambil Post Data
		$tanggal = date('d-m-Y',strtotime($data[0]));
		$no_kp = $data[1];
		$tipe = $data[2];
		$id_produk = $data[3];
		$deadline = date('d-m-Y',strtotime($data[4]));
		$desain = $data[5];
		$unit = $data[10];
		$keterangan = $data[11];
		$jenis = $data[12];
		$master = array("Silver","Matrix","Madle","PCH");
		$mst = array("SL","MT","MD","PC");
		if ($unit == '12') {$cukai = 'C';}else{$cukai = 'N';}
		$urut_kp = substr($no_kp,0,3);

        // Ambil Id KP
		$nmr = $this->db->query("Select max(id) as id from erp_ppic_kp");
		$urut = $nmr->row_array();
		$id_kp = $urut['ID'] + 1;

        // Ambil Id KP Detail
		$nmr = $this->db->query("Select max(id) as id from erp_ppic_kp_detail");
		$urut = $nmr->row_array();
		$id_kp_detail = $urut['ID'] + 1;

        // Ambil Id Galv Proses
		$nmr = $this->db->query("Select max(id) as id from erp_galv_proses");
		$urut = $nmr->row_array();
		$id_galv_proses = $urut['ID'] + 1;

        // Simpan KP
		$this->db->query("Insert into erp_ppic_kp (id, kd_unit, tanggal, nmr, jenis, tipe, id_produk, deadline, desain, status, updated, updated_status, keterangan) values ('$id_kp','$unit','$tanggal','$no_kp','$jenis','$tipe','$id_produk','$deadline','$desain','1',sysdate,'1','$keterangan')");

		// Simpan Detail KP
		for ($i=6; $i<=9; $i++) {
			if ($data[$i] != '' && $data[$i] != '0') {
				$index = $i - 6;
				$note = $data[$i+7];
				$this->db->query("Insert into erp_ppic_kp_detail (id, id_kp, master, qty, status, updated, updated_status, note) values ('$id_kp_detail','$id_kp','$master[$index]','$data[$i]','1',sysdate,'1','$note')");

				// Booking nomor proses Galvanik
				$kode = $mst[$index];
				$qty = $data[$i];
				for ($j=1; $j<=$qty; $j++) {
					$urut = sprintf("%'02d", $j);
					$kode_proses = $cukai . $urut_kp . '/' . $kode . '/' . $urut;
					$this->db->query("Insert into erp_galv_proses (id, id_kp_detail, kode_proses, updated, status, updated_status) values ('$id_galv_proses','$id_kp_detail','$kode_proses',sysdate,'1','1')");
					$id_galv_proses++;
				}
				$id_kp_detail++;
			}
		}		
	}

	function cetak($id_kp_detail) {
		$query = $this->db->query("Select cd.master, cd.qty, cc.nmr, (case when cc.kd_unit='01' then 'Non Cukai' else 'Cukai' end) jenis, cc.tipe, pc.nama, pc.spesifikasi, pc.ukuran, initcap(to_char(cc.tanggal,'DD-MONTH-YYYY')) tgl, initcap(to_char(cc.deadline,'DD-MONTH-YYYY')) deadline,
			(select concat(ha.nama, concat('@', af.title)) from erp_karyawan ha join erp_adm_approval af on af.id_karyawan=ha.id where af.kd_unit=cc.kd_unit and trans='Approval KP' and af.status='1' and rownum='1') pic,
			(select count(id) from erp_ppic_kp_detail where id_kp=cc.id) qty_master
			from erp_ppic_kp cc join erp_ppic_kp_detail cd on cd.id_kp=cc.id join erp_barang pc on pc.id=cc.id_produk
			where cc.id=(select id_kp from erp_ppic_kp_detail where id='$id_kp_detail')");
		return $query->result_array();
	}

	function hapus($id_kp_detail) {
		$this->db->query("Delete from erp_galv_proses where id_kp_detail in (select id from erp_ppic_kp_detail where id_kp=(select id_kp from erp_ppic_kp_detail where id='$id_kp_detail'))");
		$this->db->query("Delete from erp_ppic_kp where id=(select id_kp from erp_ppic_kp_detail where id='$id_kp_detail')");
		$this->db->query("Delete from erp_ppic_kp_detail where id_kp=(select id_kp from erp_ppic_kp_detail where id='$id_kp_detail')");
	}

	function cek_data($id_kp_detail) {
		$query = $this->db->query("Select updated_status from erp_ppic_kp_detail where id='$id_kp_detail'");
		return $query->row_array()['UPDATED_STATUS'];
	}

}