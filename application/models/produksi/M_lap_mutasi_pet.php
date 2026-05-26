<?php 
class m_lap_mutasi_pet extends CI_Model {
	
	function get_desain() {
		// return $this->db->query("Select distinct (desain) desain from erp_rnd_proses order by desain asc");
		return $this->db->query("Select distinct desain from erp_kk order by desain"); // Jumadi 22-Dec-21, Karena erp_rnd_proses tidak update, diubah ke erp_kk
	}
	function get_kk_per_desain($desain) {
		$query = $this->db->query("SELECT ca.ID, ca.keterangan_penggunaan kk,SUBSTR(keterangan_penggunaan,-4,4) desain FROM ERP_GUDANG_ORDER ca WHERE SUBSTR(keterangan_penggunaan,-4,4)='$desain'  ORDER BY ID DESC");
		return $query->result_array();
	}
	function get_proses_awal($kode_flow) {
		$query = $this->db->query(" SELECT DISTINCT(b.nama),a.urut FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c  WHERE 
			a.ID_STATION=b.ID and active_flow_holo='Y'
			AND c.KODE_STATION_FLOW=a.kode AND  a.deskripsi='$kode_flow' 
			ORDER BY urut ASC");
		return $query->result_array();
	}
	function get_kode_flow($desain) {
		$query = $this->db->query(" SELECT DISTINCT(a.kode),a.deskripsi FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c  WHERE 
		   a.ID_STATION=b.ID 
		  AND c.KODE_STATION_FLOW=a.kode AND c.desain='$desain' 
		  and a.active_flow_holo='Y'
		  ORDER BY kode ASC");
		return $query->result_array();
	}
	function get_proses_akhir($desain,$nama_proses_awal,$kode_flow) {
		if(($kode_flow == 'PET' && $nama_proses_awal == 'Metalize') || ($kode_flow == 'PET' && $nama_proses_awal == 'Emboss') )
		{
		$proses_akhir = $this->db->query(" SELECT DISTINCT(nama) FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c 
		WHERE urut IN(    SELECT DISTINCT((urut+2)) urut FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c  WHERE  
		c.KODE_STATION_FLOW=a.kode AND c.desain='$desain'  AND  a.deskripsi='$kode_flow' 
		AND nama='$nama_proses_awal' AND a.ID_STATION=b.ID) 
		AND a.ID_STATION=b.ID AND c.kode_station_flow=a.kode AND c.desain='$desain'  AND a.deskripsi='$kode_flow' ");
		}
		else
		{
			$proses_akhir = $this->db->query(" SELECT DISTINCT(nama) FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c 
		WHERE urut IN(    SELECT DISTINCT((urut+1)) urut FROM ERP_STATION_FLOW a,ERP_STATION b,ERP_RND_PROSES_VIN c  WHERE  
		c.KODE_STATION_FLOW=a.kode AND c.desain='$desain'  AND  a.deskripsi='$kode_flow' 
		AND nama='$nama_proses_awal' AND a.ID_STATION=b.ID) 
		AND a.ID_STATION=b.ID AND c.kode_station_flow=a.kode AND c.desain='$desain'  AND a.deskripsi='$kode_flow' ");
		}
		$cari_proses_akhir =$proses_akhir->result_array();		
		return  $cari_proses_akhir; 
	}
	
	function get_kk($nama_proses_awal,$tanggal) {
		$cari_kk = $this->db->query("SELECT DISTINCT(keterangan_penggunaan) AS kk FROM(
			SELECT b.kode,b.qty as hasil,a.ID
			,c.id_gudang_order
			,d.keterangan_penggunaan,e.nama,f.shift,f.proses 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE c.ID=a.id_prod_pet AND b.AKTIF='2' AND f.proses='$nama_proses_awal'
			AND a.ID=g.ID_PROD_PET_DETAIL and b.ID=g.ID_PROD_MUTASI
			AND TO_CHAR(b.tgl,'YYMMDD')='$tanggal'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES)");
		
		$cari_kk =$cari_kk->result_array();		
		return  $cari_kk; 
	}
	
	
	
	function get_nomor_mutasi($nama_proses_awal,$tanggal,$kk) {
		$cari_no_mutasi = $this->db->query("SELECT DISTINCT(nmr) AS nomor_mutasi,seri,kk  FROM(
			SELECT a.kode,a.hasil,a.ID,b.nmr,d.seri 
			,c.id_gudang_order
			,d.keterangan_penggunaan AS kk,e.nama,f.shift,f.proses 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
			AND a.ID=g.ID_PROD_PET_DETAIL AND b.STATION_AWAL='$nama_proses_awal'
			and TO_CHAR(b.tgl,'YYMMDD') = '$tanggal'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES)
			WHERE kk='$kk'
			");
		
		$cari_nomor =$cari_no_mutasi->result_array();		
		return  $cari_nomor; 
	}
	
	
	
	
	/*
	mutasi pake shift
	function info_no_mutasi($nama_proses_awal,$tanggal,$kk,$no_mutasi) {
		$cari_no_mutasi = $this->db->query(" select m.*,n.nama_pengirim,o.nama_penerima from(
			SELECT b.kode,b.qty as hasil,a.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
				   ,c.id_gudang_order
				   ,d.keterangan_penggunaan AS kk,e.nama,f.shift,b.id_pengirim,b.id_penerima
				   FROM 
				   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
				   ,ERP_PROD_PET c
				   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
				   WHERE  
				   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
				   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
				   and d.keterangan_penggunaan='$kk'
				   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
				   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')m,
				   (select j.id,nama as nama_pengirim from erp_karyawan j where id in(
	   SELECT id_pengirim
				   FROM 
				   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
				   ,ERP_PROD_PET c
				   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
				   WHERE  
				   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
				   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
				   and d.keterangan_penggunaan='$kk'
				   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
				   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) n, 
	   (select j.id,nama as nama_penerima from erp_karyawan j where id in(
	   SELECT id_penerima
				   FROM 
				   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
				   ,ERP_PROD_PET c
				   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
				   WHERE  
				   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
				   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
				   and d.keterangan_penggunaan='$kk'
				   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
				   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) o 
				   where m.id_pengirim=n.id and m.id_penerima=o.id
				   order by shift asc
			");
		
		$cari_nomor =$cari_no_mutasi->result_array();		
		return  $cari_nomor; 
	}
	*/
    
	function info_no_mutasi($nama_proses_awal,$tanggal,$kk,$no_mutasi) {
		if ($nama_proses_awal == 'Belah_sebelum revisi')
		{
			$cari_no_mutasi = $this->db->query(" select m.*,n.nama_pengirim,o.nama_penerima from(
				SELECT b.kode,b.qty as hasil,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
				,c.id_gudang_order
				,d.keterangan_penggunaan AS kk,e.nama,b.id_pengirim,b.id_penerima,b.qty_roll
				FROM 
				ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
				,ERP_PROD_PET c
				,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
				WHERE  
				c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
				AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
				and d.keterangan_penggunaan='$kk'
				AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
				AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal'
				group by b.kode,b.qty,d.seri,b.nmr,b.tgl,b.station_awal,b.station_akhir,b.qty_roll
				,c.id_gudang_order
				,d.keterangan_penggunaan,e.nama,b.id_pengirim,b.id_penerima
				)m,
					   (select j.id,nama as nama_pengirim from erp_karyawan j where id in(
		   SELECT id_pengirim
					   FROM 
					   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
					   ,ERP_PROD_PET c
					   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
					   WHERE  
					   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
					   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
					   and d.keterangan_penggunaan='$kk'
					   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
					   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) n, 
		   (select j.id,nama as nama_penerima from erp_karyawan j where id in(
		   SELECT id_penerima
					   FROM 
					   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
					   ,ERP_PROD_PET c
					   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
					   WHERE  
					   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
					   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
					   and d.keterangan_penggunaan='$kk'
					   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
					   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) o 
					   where m.id_pengirim=n.id and m.id_penerima=o.id
					   order by m.kode asc
				");
		    }
			else if(($nama_proses_awal == 'Pita') or($nama_proses_awal == 'Belah'))
			{
				$cari_no_mutasi = $this->db->query("select m.*,n.nama_pengirim,o.nama_penerima from(
						SELECT  distinct(b.kode),b.qty as hasil,b.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
							,c.id_gudang_order
							,d.keterangan_penggunaan AS kk,e.nama,f.shift,b.id_pengirim,b.id_penerima,b.qty_roll
							FROM 
							ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
						   ,ERP_PROD_PET c
						   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
							WHERE  
							c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
							AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
							and d.keterangan_penggunaan='$kk'
							AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
							AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal'
					)m,
						   (select j.id,nama as nama_pengirim from erp_karyawan j where id in(
			   SELECT id_pengirim
						   FROM 
						   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
						   ,ERP_PROD_PET c
						   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
						   WHERE  
						   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
						   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
						   and d.keterangan_penggunaan='$kk'
						   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
						   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) n, 
			   (select j.id,nama as nama_penerima from erp_karyawan j where id in(
			   SELECT id_penerima
						   FROM 
						   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
						   ,ERP_PROD_PET c
						   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
						   WHERE  
						   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
						   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
						   and d.keterangan_penggunaan='$kk'
						   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
						   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) o 
						   where m.id_pengirim=n.id and m.id_penerima=o.id
						   order by m.kode asc
					");
			}
			else
			{
			$cari_no_mutasi = $this->db->query("select m.*,n.nama_pengirim,o.nama_penerima from(
				select kode,sum(hasil)as hasil,seri,nmr,tgl,dari,ke,id_gudang_order,kk,nama,id_pengirim,id_penerima,qty_roll from(
					SELECT  distinct(b.kode),b.qty as hasil,b.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
						,c.id_gudang_order
						,d.keterangan_penggunaan AS kk,e.nama,f.shift,b.id_pengirim,b.id_penerima,b.qty_roll
						FROM 
						ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
					   ,ERP_PROD_PET c
					   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
						WHERE  
						c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
						AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
						and d.keterangan_penggunaan='$kk'
						AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
						AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')
						group by kode,seri,nmr,tgl,dari,ke,id_gudang_order,kk,nama,id_pengirim,id_penerima,qty_roll
				)m,
					   (select j.id,nama as nama_pengirim from erp_karyawan j where id in(
		   SELECT id_pengirim
					   FROM 
					   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
					   ,ERP_PROD_PET c
					   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
					   WHERE  
					   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
					   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
					   and d.keterangan_penggunaan='$kk'
					   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
					   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) n, 
		   (select j.id,nama as nama_penerima from erp_karyawan j where id in(
		   SELECT id_penerima
					   FROM 
					   ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
					   ,ERP_PROD_PET c
					   ,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
					   WHERE  
					   c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
					   AND g.ID_PROD_PET_DETAIL=a.ID AND f.proses='$nama_proses_awal'
					   and d.keterangan_penggunaan='$kk'
					   AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES and b.nmr='$no_mutasi'
					   AND TO_CHAR(b.tgl,'YYMMDD') ='$tanggal')) o 
					   where m.id_pengirim=n.id and m.id_penerima=o.id
					   order by m.kode asc
				");
	   }		
		$cari_nomor =$cari_no_mutasi->result_array();		
		return  $cari_nomor; 
	   }

}
?>
