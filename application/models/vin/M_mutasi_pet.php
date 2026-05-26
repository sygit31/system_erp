<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mutasi_pet extends CI_Model 
{

	public	function filter($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir) {  
		if ($proses_awal == 'semua')		
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id AND TO_CHAR(a.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";
		}
		else
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id AND TO_CHAR(a.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' and a.station_awal='$proses_awal' and a.station_akhir='$proses_akhir'
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";

		}
		$query = $this->db->query($sql);
		return $query->result();
	}

	public	function filter2($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir,$cek_roll,$kode_roll) {  

		if ($proses_awal == 'semua' && $cek_roll =='CENTANG')		
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id and a.kode like '%$kode_roll%'   
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";
		}
		else if ($proses_awal == 'semua' && $cek_roll =='')		
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id AND TO_CHAR(a.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' 
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";
		}
		else if ($proses_awal != 'semua' && $cek_roll =='CENTANG')
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id and a.kode like '%$kode_roll%'  
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";

		}
		else if ($proses_awal != 'semua' && $cek_roll =='')
		{
			$sql = "select sum(a.qty) as total,station_awal as dari,station_akhir as ke,to_char(tgl,'DD-MM-YYYY') as tgl,nmr as nomor_mutasi,b.keterangan_penggunaan as kk,b.seri 
			from erp_prod_mutasi a,erp_gudang_order b where  a.aktif='2'
			and a.id_gudang_order=b.id AND TO_CHAR(a.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' and a.station_awal='$proses_awal' and a.station_akhir='$proses_akhir'
			group by station_awal,station_akhir,tgl,nmr,B.KETERANGAN_PENGGUNAAN,b.seri";

		}
		$query = $this->db->query($sql);
		return $query->result();
	}

	public	function get_export_excel_all($tanggal_awal,$tanggal_akhir,$proses_awal,$proses_akhir,$kode_flow) {  
		if ($proses_awal == 'semua')		
		{
			$sql = "
			SELECT b.kode,b.qty as hasil,a.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
			,c.id_gudang_order
			,d.keterangan_penggunaan AS kk,e.nama,f.shift,'SEMUA' as tanda 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE  
			c.ID=a.id_prod_pet AND b.AKTIF='2' 
			AND g.ID_PROD_PET_DETAIL=a.ID  and g.ID_PROD_MUTASI=b.ID
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND TO_CHAR(b.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir' order by tgl,nmr,kk,kode";
		}
		else
		{
			$sql = "
			SELECT b.kode,b.qty as hasil,a.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
			,c.id_gudang_order
			,d.keterangan_penggunaan AS kk,e.nama,f.shift,'NON SEMUA' as tanda 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE  
			c.ID=a.id_prod_pet AND b.AKTIF='2' AND b.station_awal='$proses_awal' and b.station_akhir='$proses_akhir'
			AND g.ID_PROD_PET_DETAIL=a.ID and g.ID_PROD_MUTASI=b.ID 
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND TO_CHAR(b.tgl,'YYMMDD') BETWEEN '$tanggal_awal' AND '$tanggal_akhir'order by tgl,nmr,kk,kode";
		}
		$query = $this->db->query($sql);
		return $query->result();
	} 

	public	function get_detail_mutasi($nomor_mutasi,$tgl_mutasi,$kk) {  
		$sql = "SELECT m.seri,m.nmr AS nomor_mutasi,m.tgl,m.dari,m.ke,m.kk,m.hasil,m.shift,m.kode,m.id,n.nama_pengirim,o.nama_penerima,n.id as id_pengirim,o.id as id_penerima  FROM(
			SELECT distinct(b.kode),b.qty as hasil,b.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
			,c.id_gudang_order
			,d.keterangan_penggunaan AS kk,e.nama,f.shift,b.id_pengirim,b.id_penerima
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
			WHERE  
			c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
			AND g.ID_PROD_PET_DETAIL=a.ID  and  b.nmr='$nomor_mutasi'
			and d.keterangan_penggunaan='$kk'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND TO_CHAR(b.tgl,'YYMMDD') ='$tgl_mutasi')m,
		(select j.id,nama as nama_pengirim from erp_karyawan j where id in(
			SELECT id_pengirim
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
			WHERE  
			c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
			AND g.ID_PROD_PET_DETAIL=a.ID  and  b.nmr='$nomor_mutasi'
			and d.keterangan_penggunaan='$kk'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND TO_CHAR(b.tgl,'YYMMDD') ='$tgl_mutasi')) n,
		(select j.id,nama as nama_penerima from erp_karyawan j where id in(
			SELECT id_penerima
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f  
			WHERE  
			c.ID=a.id_prod_pet AND b.AKTIF='2' and b.ID=g.ID_PROD_MUTASI
			AND g.ID_PROD_PET_DETAIL=a.ID and  b.nmr='$nomor_mutasi'
			and d.keterangan_penggunaan='$kk'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND TO_CHAR(b.tgl,'YYMMDD') ='$tgl_mutasi')) o 
		where m.id_pengirim=n.id and m.id_penerima=o.id 
		order by shift asc";

		$query = $this->db->query($sql);
		return $query->result();
	}

	function cek_roll_edit_mutasi($dari) {  
		$cek_roll =$this->db->query("SELECT seri,id,nmr AS nomor_mutasi,tgl,dari,ke,kk,hasil,shift,kode FROM(
			SELECT b.kode,b.qty as hasil,b.ID,d.seri,b.nmr,b.tgl,b.station_awal AS dari,b.station_akhir AS ke
			,c.id_gudang_order
			,d.keterangan_penggunaan AS kk,e.nama,f.shift 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE  
			c.ID=a.id_prod_pet AND (b.AKTIF='1' or b.aktif='3')
			AND g.ID_PROD_PET_DETAIL=a.ID and g.ID_PROD_MUTASI=b.ID 
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES
			AND b.station_awal='$dari'
			)
		order by id desc");

		$cek_roll =$cek_roll->result_array();		
		return  $cek_roll; 
	}

	function get_kk_mutasi($nama_proses_awal,$desain) {
		$cari_kk = $this->db->query("SELECT DISTINCT(keterangan_penggunaan) as kk FROM(
			SELECT a.kode,a.hasil,a.ID
			,c.id_gudang_order
			,d.keterangan_penggunaan,e.nama,f.shift,f.proses 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE c.ID=a.id_prod_pet AND (b.AKTIF='1' or b.aktif='3') 
			AND f.proses='$nama_proses_awal' and d.desain='$desain' and g.ID_PROD_PET_DETAIL=a.ID
			and b.ID=g.ID_PROD_MUTASI
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES)");

		$cari_kk =$cari_kk->result_array();		
		return  $cari_kk; 
	}

	function get_kk_aja() {
		$cari_kk_aja = $this->db->query("SELECT DISTINCT(keterangan_penggunaan) as kk FROM(
			SELECT a.kode,a.hasil,a.ID
			,c.id_gudang_order
			,d.keterangan_penggunaan,e.nama,f.shift,f.proses 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE c.ID=a.id_prod_pet  
			and g.ID_PROD_PET_DETAIL=a.ID
			and b.ID=g.ID_PROD_MUTASI
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES order by id asc)
		");

		$cari_kk_aja =$cari_kk_aja->result_array();		
		return  $cari_kk_aja; 
	}

	function get_roll_mutasi($kk,$nama_proses_awal,$nama_proses_akhir) {
		$cari_roll_mutasi = $this->db->query("	SELECT distinct b.kode,b.qty AS hasil,b.ID
			,c.id_gudang_order
			,d.keterangan_penggunaan,d.seri,e.nama,f.shift,f.proses,b.qty_roll 
			FROM 
			ERP_PROD_PET_DETAIL a,ERP_PROD_MUTASI b,ERP_PROD_MUTASI_DETAIL g
			,ERP_PROD_PET c
			,ERP_GUDANG_ORDER d,ERP_BARANG e,ERP_PROD_PROSES f 
			WHERE  d.keterangan_penggunaan='$kk' AND  
			c.ID=a.id_prod_pet AND (b.AKTIF='1' or b.AKTIF='3') AND b.station_awal='$nama_proses_awal' and b.station_akhir='$nama_proses_akhir'
			AND d.ID=c.id_gudang_order AND e.ID=d.id_barang AND f.ID=c.ID_PROD_PROSES 
			AND a.ID=g.ID_PROD_PET_DETAIL and b.ID=g.ID_PROD_MUTASI
			ORDER BY b.kode ASC 
			");

		$cari_roll =$cari_roll_mutasi->result_array();		
		return  $cari_roll; 
	}

	function urut() {
		$data = $this->db->query("Select max(id) id from ERP_PROD_MUTASI");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function urut_detail() {
		$data = $this->db->query("Select max(id) id from ERP_PROD_MUTASI_DETAIL");
		$urut = $data->row_array();
		return $urut['ID'] + 1;
	}

	function cari_id_kk_aja($kk) {
		$data = $this->db->query("Select id from ERP_GUDANG_ORDER where keterangan_penggunaan='$kk' ");
		$id_kk= $data->row_array();
		return $id_kk['ID'];
	}

	function cari_dummy_prod_pet_detail($dummy_prod_mutasi) {
		$data = $this->db->query("Select id_prod_pet_detail from ERP_PROD_MUTASI_DETAIL where id_prod_mutasi='$dummy_prod_mutasi' ");
		$id_dummy_prod_pet_detail = $data->row_array();
		return $id_dummy_prod_pet_detail['ID_PROD_PET_DETAIL'];
	}

	function tambah_roll_gabungan_prod_mutasi($urut,$tgl_mutasi,$no_mutasi,$dari,$ke,$roll_gabungan,$jumlah_gabungan,$id_pengirim,$id_penerima,$id_kk) {
		$this->db->query("Insert into ERP_PROD_MUTASI (id,tgl,nmr,station_awal,station_akhir,kode,qty,qty_produksi,qty_roll,id_pengirim,id_penerima,id_gudang_order,aktif) VALUES('$urut',TO_DATE('$tgl_mutasi','DD/MM/YYYY'),'$no_mutasi','$dari','$ke','$roll_gabungan',$jumlah_gabungan,'0','1','$id_pengirim','$id_penerima','$id_kk','2')"); 
		
	} 

	function tambah_roll_gabungan_prod_mutasi_detail($urut_detail,$id_dummy_prod_pet_detail,$urut) {
		$this->db->query("Insert into ERP_PROD_MUTASI_DETAIL (id,id_prod_pet_detail,id_prod_mutasi) VALUES($urut_detail,$id_dummy_prod_pet_detail,$urut)"); 
	} 

	function save_mutasi($urut,$nomor_mutasi,$tgl_mutasi,$id_mutasi,$station_awal,$station_akhir) {
		$this->db->query("Insert into ERP_PROD_MUTASI VALUES('$urut','$id_mutasi',to_date('$tgl_mutasi','DD/MM/YYYY'),'$nomor_mutasi','$station_awal','$station_akhir','1')"); 
	} 

	function update_gabung_roll_prod_mutasi($kode_roll,$urut,$no_mutasi) {
		$this->db->query("Update erp_prod_mutasi set aktif='4',id_kode_gabungan='$urut' where kode='$kode_roll' and nmr='$no_mutasi'"); 
	}

	function update_prod_mutasi($id_mutasi,$nomor_mutasi,$tgl_mutasi,$pengirim,$penerima) {
		$this->db->query("Update erp_prod_mutasi set aktif='2',id_pengirim='$pengirim',id_penerima='$penerima',nmr='$nomor_mutasi',tgl=to_date('$tgl_mutasi','DD-MM-YYYY') where id='$id_mutasi'"); 
		return "Update erp_prod_mutasi set aktif='2',id_pengirim='$pengirim',id_penerima='$penerima',nmr='$nomor_mutasi',tgl=to_date('$tgl_mutasi','YYMMDD') where id='$id_mutasi'";
	}

	function update_status_edit_mutasi($no_mutasi_lama,$kk) {
		$this->db->query("Update erp_prod_mutasi set aktif='3' where nmr='$no_mutasi_lama' and id_gudang_order in(select id from erp_gudang_order where keterangan_penggunaan='$kk')"); 
	}
    /*
	  function update_edit_mutasi_detail($no_mutasi,$kk,$id_pengirim,$id_penerima,$shift,$kode_roll,$meter,$id_prod_mutasi,$no_mutasi_lama,$tgl_mutasi) {
		$this->db->query("Update erp_prod_mutasi set aktif='2',id_pengirim='$id_pengirim',id_penerima='$id_penerima',nmr='$no_mutasi',tgl= TO_CHAR('$tgl_mutasi','YYMMDD') where id='$id_prod_mutasi'");  
	}
   */
	
	function update_edit_mutasi_detail($no_mutasi,$id_pengirim,$id_penerima,$id_prod_mutasi,$tgl_mutasi,$kk) {
		$this->db->query("Update erp_prod_mutasi set aktif='2',id_pengirim='$id_pengirim',id_penerima='$id_penerima',nmr='$no_mutasi',tgl= TO_DATE('$tgl_mutasi','DD/MM/YYYY'),id_gudang_order=(select id from erp_gudang_order where keterangan_penggunaan='$kk') where id='$id_prod_mutasi'");  
		 // $this->db->query("Update erp_prod_mutasi set aktif='2',id_pengirim='354',id_penerima='89',nmr='009/PNP-HLG/MHB-Coat sens/XI/2021',tgl= TO_DATE('22-11-2021','DD/MM/YYYY') where id='12033'");
	}

	public function save($data) 
	{

		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_IPB
		(ID,TANGGAL,ID_KK_DETAIL,NOMER)
		VALUES
		(SEQ_IPB.NEXTVAL,'".$data['TANGGAL']."',"
			.$data['ID_KK_DETAIL'].",'".$data['NOMER']."')";
			
			$success = $this->db->query($sql);

			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}

			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}



		public function update($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_IPB SET 
			PENERIMA = '".$data['PENERIMA']."',
			PEMBERI = '".$data['PEMBERI']."',
			PENGAWAS = '".$data['PENGAWAS']."' 
			WHERE ID=".$data['ID'];
			
			$success = $this->db->query($sql);

			if(!$success){
				$success = false;
				$errNo   = $this->db->_error_number();
				$errMess = $this->db->_error_message();
				array_push($errors, array($errNo, $errMess));
			}

			$this->db->trans_commit();
			$this->db->trans_complete();
			return $success;
		}
		
		

		public function getIpbOrder() 
		{
			$sql = "SELECT DISTINCT I.TANGGAL,I.NOMER,KD.* FROM ERP_IPB I
			JOIN ERP_IPB_DETAIL ID ON I.ID=ID.ID_IPB
			JOIN ERP_KK_DETAIL KD ON I.ID_KK_DETAIL = KD.ID
			WHERE STATUS = 'ORDER'
			ORDER BY NOMER";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getIpbOrderByIdKK($id_kk_detail) 
		{
			$sql = "SELECT DISTINCT I.NOMER,I.ID FROM ERP_IPB I
			JOIN ERP_IPB_DETAIL ID ON I.ID=ID.ID_IPB
			JOIN ERP_KK_DETAIL KD ON I.ID_KK_DETAIL = KD.ID
			WHERE I.ID_KK_DETAIl = ".$id_kk_detail." AND STATUS = 'ORDER'
			ORDER BY NOMER";

			$query = $this->db->query($sql);
			// return $sql;
			return $query->result();
		}

		public function getCetakById($id_ipb) 
		{
			$sql = "SELECT I.*,ID.*,PD.KODE_ROLL,B.NAMA,B.TAHUN,
			GO.KETERANGAN_PENGGUNAAN NO_KK,GO.SERI,PD.QTY_TERIMA,B.SPESIFIKASI FROM ERP_IPB I
			JOIN ERP_IPB_DETAIL ID ON I.ID=ID.ID_IPB
			JOIN ERP_PENERIMAAN_DETAIL PD ON ID.ID_DETAIL_TERIMA = PD.ID_DETAIL_TERIMA
			JOIN ERP_PENERIMAAN P ON PD.ID_TERIMA = P.ID_TERIMA
			JOIN ERP_PO_DETAIL POD ON P.ID_PO_DETAIL = POD.ID
			JOIN ERP_MATERIAL_SUPPLY MS ON POD.ID_MATERIAL_SUPPLY = MS.ID
			JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID
			JOIN ERP_GUDANG_ORDER GO ON I.ID_KK_DETAIL=GO.ID_RELASI
			WHERE I.ID = ". $id_ipb;

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getAllIPB() 
		{
			// $sql = "SELECT I.*,K.NOMER NO_KK,K.SERI FROM ERP_IPB I
			// JOIN ERP_KK_DETAIL KD ON I.ID_KK_DETAIL = KD.ID
			// JOIN ERP_KK K ON KD.ID_KK = K.ID
			// ORDER BY I.ID";

			$sql = "SELECT I.*,K.NOMER NO_KK,K.SERI,PD.KODE_ROLL,PD.QTY_TERIMA FROM ERP_IPB I
			JOIN ERP_IPB_DETAIL ID ON I.ID = ID.ID_IPB
			JOIN ERP_PENERIMAAN_DETAIL PD ON ID.ID_DETAIL_TERIMA = PD.ID_DETAIL_TERIMA
			JOIN ERP_KK_DETAIL KD ON I.ID_KK_DETAIL = KD.ID
			JOIN ERP_KK K ON KD.ID_KK = K.ID
			ORDER BY I.ID DESC";

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
	?>
