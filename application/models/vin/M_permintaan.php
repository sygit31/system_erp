<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_permintaan extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_PERMINTAAN
				(ID,TANGGAL,ID_BAGIAN,ID_KARYAWAN)
				VALUES
				(SEQ_PERMINTAAN.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),"
				.$data['id_bagian'].",".$data['id_karyawan'].")";
			
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

		public function getBagian() 
		{
			$sql = "SELECT DISTINCT P.ID_BAGIAN,B.NAMA BAGIAN FROM ERP_PERMINTAAN P JOIN 
			ERP_PERMINTAAN_DETAIL PD ON P.ID = PD.ID_PERMINTAAN JOIN
			ERP_BAGIAN B ON P.ID_BAGIAN = B.ID JOIN
			ERP_KARYAWAN K ON P.ID_KARYAWAN = K.ID
			WHERE PD.STATUS = 'ORDER'";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getBagianSIP() 
		{
			$sql = "SELECT DISTINCT P.ID_BAGIAN,B.NAMA BAGIAN FROM ERP_PERMINTAAN P JOIN 
            ERP_PERMINTAAN_DETAIL PD ON P.ID = PD.ID_PERMINTAAN JOIN
            ERP_PERMINTAAN_FILTER PF ON PF.ID_PERMINTAAN_DETAIL = PD.ID JOIN
            ERP_UMUM_SIP_DETAIL SD ON SD.ID_PERMINTAAN_FILTER = PF.ID JOIN
            ERP_BAGIAN B ON P.ID_BAGIAN = B.ID JOIN
            ERP_KARYAWAN K ON P.ID_KARYAWAN = K.ID
            WHERE SD.STATUS = 'sip'";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getPermintaanDetail() 
		{
			$sql = "SELECT PD.ID,P.TANGGAL,P.ID_BAGIAN,B.NAMA BAGIAN,BR.NAMA BARANG,PD.JUMLAH,BR.SATUAN,PD.KETERANGAN,BR.SPESIFIKASI FROM ERP_PERMINTAAN P 
			JOIN ERP_PERMINTAAN_DETAIL PD ON P.ID = PD.ID_PERMINTAAN
			JOIN ERP_BAGIAN B ON P.ID_BAGIAN = B.ID
			JOIN ERP_KARYAWAN K ON P.ID_KARYAWAN = K.ID
			JOIN ERP_BARANG BR ON PD.ID_BARANG = BR.ID
			WHERE PD.STATUS = 'ORDER'
			ORDER BY TANGGAL,BARANG";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getPermintaanDetailSIP() 
		{
			$sql = "SELECT SD.ID,P.TANGGAL,P.ID_BAGIAN,B.NAMA BAGIAN,BR.NAMA BARANG,SR.JUMLAH,BR.SATUAN,PD.KETERANGAN,BR.SPESIFIKASI,
            (SELECT NVL((SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
            WHERE ID_SIP_DETAIL = SD.ID),0) JUMLAH FROM DUAL) PEMENUHAN,
            SR.JUMLAH - (SELECT NVL((SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
            WHERE ID_SIP_DETAIL = SD.ID),0) JUMLAH FROM DUAL) KEKURANGAN
            FROM ERP_PERMINTAAN P 
            JOIN ERP_PERMINTAAN_DETAIL PD ON P.ID = PD.ID_PERMINTAAN
            JOIN ERP_PERMINTAAN_FILTER PF ON PF.ID_PERMINTAAN_DETAIL = PD.ID
            JOIN ERP_UMUM_SIP_DETAIL SD ON SD.ID_PERMINTAAN_FILTER = PF.ID
            JOIN ERP_UMUM_SIP_REVISI SR ON SR.ID_SIP_DETAIL = SD.ID
            JOIN ERP_BAGIAN B ON P.ID_BAGIAN = B.ID
            JOIN ERP_KARYAWAN K ON P.ID_KARYAWAN = K.ID
            JOIN ERP_BARANG BR ON PD.ID_BARANG = BR.ID
            LEFT JOIN ERP_UMUM_SIP_PEMENUHAN SP ON SP.ID_SIP_DETAIL = SD.ID
            WHERE SD.STATUS = 'sip'
            ORDER BY TANGGAL,BARANG";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getLaporanPermintaanTrack() 
		{
			$sql = "SELECT DISTINCT
			PD.ID, 
			P.TANGGAL,B.NAMA BAGIAN,
			PD.JUMLAH,PD.KETERANGAN,
			BG.NAMA BARANG,BG.SPESIFIKASI,BG.SATUAN,
			PF.JUMLAH JUMLAH_FILTER, 
			SD.JUMLAH JUMLAH_SIP,
			S.NO_SIP,
			R.JUMLAH JUMLAH_REVISI,
			(SELECT NVL((SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
				WHERE ID_SIP_DETAIL = SD.ID),0) JUMLAH FROM DUAL) PEMENUHAN,
			R.JUMLAH - (SELECT NVL((SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
				WHERE ID_SIP_DETAIL = SD.ID),0) JUMLAH FROM DUAL) KEKURANGAN
			FROM ERP_PERMINTAAN P
			JOIN ERP_BAGIAN B ON B.ID = P.ID_BAGIAN
			JOIN ERP_PERMINTAAN_DETAIL PD ON PD.ID_PERMINTAAN = P.ID
			JOIN ERP_BARANG BG ON PD.ID_BARANG = BG.ID
			LEFT JOIN ERP_PERMINTAAN_FILTER PF ON PD.ID = PF.ID_PERMINTAAN_DETAIL 
			LEFT JOIN ERP_UMUM_SIP_DETAIL SD ON PF.ID = SD.ID_PERMINTAAN_FILTER 
			JOIN ERP_UMUM_SIP S ON S.ID = SD.ID_SIP
			JOIN ERP_KARYAWAN K ON K.ID = P.ID_KARYAWAN
			JOIN ERP_UMUM_SIP_REVISI R ON R.ID_SIP_DETAIL = SD.ID
			LEFT JOIN ERP_UMUM_SIP_PEMENUHAN SP ON SD.ID = SP.ID_SIP_DETAIL
			ORDER BY B.NAMA,PD.ID";

			$query = $this->db->query($sql);
			return $query->result();
		}



	}
?>