<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_umum_sip extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_UMUM_SIP
				(ID,ID_BAGIAN,NO_SIP,TANGGAL)
				VALUES
				(SEQ_UMUM_SIP.NEXTVAL,".$data['id_bagian'].",'".$data['no_sip']."',
				'".$data['tanggal']."')";
			
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

		
		public function getSIPLastDetail() 
		{
			$sql = "SELECT s.ID ID_SIP,s.TANGGAL,b.NAMA BARANG,sd.JUMLAH,b.SATUAN,pd.KETERANGAN,bg.NAMA BAGIAN FROM ERP_UMUM_SIP s
			JOIN ERP_UMUM_SIP_DETAIL sd ON sd.ID_SIP = s.ID
			JOIN ERP_PERMINTAAN_FILTER pf ON sd.ID_PERMINTAAN_FILTER = pf.ID
			JOIN ERP_PERMINTAAN_DETAIL pd ON pf.ID_PERMINTAAN_DETAIL = pd.ID
			JOIN ERP_PERMINTAAN p ON pd.ID_PERMINTAAN = p.ID
			JOIN ERP_BARANG b ON pd.ID_BARANG = b.ID
			JOIN ERP_BAGIAN bg ON p.ID_BAGIAN = bg.ID
			WHERE s.TANGGAL > ADD_MONTHS(TRUNC(SYSDATE), -3)
			ORDER BY s.TANGGAL,b.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getSIPLast() 
		{
			$sql = "SELECT * FROM ERP_UMUM_SIP
			WHERE TANGGAL > ADD_MONTHS(TRUNC(SYSDATE), -24)";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getSIPOutstandingByBagianDanIdBarang($id_bagian,$id_barang) 
		{
			$sql = "SELECT S.TANGGAL,S.NO_SIP,R.JUMLAH,BR.SATUAN,
			R.JUMLAH - (SELECT NVL((SELECT SUM(JUMLAH) FROM ERP_UMUM_SIP_PEMENUHAN
			WHERE ID_SIP_DETAIL = SD.ID),0) JUMLAH FROM DUAL) KEKURANGAN 
			FROM ERP_PERMINTAAN P
			JOIN ERP_PERMINTAAN_DETAIL PD ON PD.ID_PERMINTAAN = P.ID
			JOIN ERP_PERMINTAAN_FILTER PF ON PF.ID_PERMINTAAN_DETAIL  = PD.ID
			JOIN ERP_UMUM_SIP_DETAIL SD ON SD.ID_PERMINTAAN_FILTER = PF.ID
			JOIN ERP_UMUM_SIP S ON S.ID = SD.ID_SIP
			JOIN ERP_BAGIAN B ON B.ID = P.ID_BAGIAN
			JOIN ERP_UMUM_SIP_REVISI R ON R.ID_SIP_DETAIL = SD.ID
			JOIN ERP_KARYAWAN K ON K.ID = P.ID_KARYAWAN
			JOIN ERP_BARANG BR ON BR.ID = PD.ID_BARANG
			WHERE SD.STATUS = 'sip'
			AND B.ID = ". $id_bagian ."
			AND BR.ID = ".$id_barang."
			ORDER BY S.TANGGAL";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getSipDetailByIdSip($data) 
		{
			$sql = "SELECT s.ID ID_SIP,sd.ID ID_SIP_DETAIL,s.TANGGAL,
            s.NO_SIP,b.NAMA BARANG,sr.JUMLAH,b.SATUAN,pd.KETERANGAN,
            bg.NAMA BAGIAN,b.ID ID_BARANG,b.SPESIFIKASI 
            FROM ERP_UMUM_SIP s
            JOIN ERP_UMUM_SIP_DETAIL sd ON sd.ID_SIP = s.ID
            JOIN ERP_UMUM_SIP_REVISI sr ON SR.ID_SIP_DETAIL = sd.ID
            JOIN ERP_PERMINTAAN_FILTER pf ON sd.ID_PERMINTAAN_FILTER = pf.ID
            JOIN ERP_PERMINTAAN_DETAIL pd ON pf.ID_PERMINTAAN_DETAIL = pd.ID
            JOIN ERP_PERMINTAAN p ON pd.ID_PERMINTAAN = p.ID
            JOIN ERP_BARANG b ON pd.ID_BARANG = b.ID
            JOIN ERP_BAGIAN bg ON p.ID_BAGIAN = bg.ID
            WHERE s.ID = ".$data."
            ORDER BY s.TANGGAL,b.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getMaxId() 
		{
			$sql = "SELECT MAX(ID) ID FROM ERP_UMUM_SIP";

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>