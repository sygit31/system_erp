<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_pengeluaran extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_PENGELUARAN VALUES (SEQ_PENGELUARAN.NEXTVAL,CURRENT_DATE,".$this->db->escape($data['NomerIPB']).",".$this->db->escape($data['IdGudangOrder']).",".$this->db->escape($data['IdLogin']).")";
			
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


		public function getPengeluaran() 
		{
			$sql = "SELECT TO_CHAR(P.TGL_KELUAR, 'DD/MM/YYYY') TGL_KELUAR,P.NO_IPB,DT.KODE_ROLL,MB.NAMA BARANG,DT.QTY_TERIMA QTY,B.NAMA BAGIAN,GO.KETERANGAN_PENGGUNAAN,GO.SERI FROM ERP_PENGELUARAN P JOIN ERP_PENGELUARAN_DETAIL DP ON P.ID_KELUAR = DP.ID_KELUAR JOIN ERP_PENERIMAAN_DETAIL DT ON DP.ID_DETAIL_TERIMA = DT.ID_DETAIL_TERIMA JOIN ERP_GUDANG_ORDER GO ON P.ID_GUDANG_ORDER = GO.ID JOIN ERP_BAGIAN B ON GO.ID_BAGIAN = B.ID JOIN ERP_BARANG MB ON GO.ID_BARANG = MB.ID WHERE P.TGL_KELUAR BETWEEN ADD_MONTHS( SYSDATE, -6 ) AND SYSDATE ORDER BY P.TGL_KELUAR DESC,DT.KODE_ROLL DESC";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getPengeluaranByFilter($data) 
		{
			$sql = "SELECT TO_CHAR(P.TGL_KELUAR, 'DD/MM/YYYY') TGL_KELUAR,P.NO_IPB,DT.KODE_ROLL,MB.NAMA BARANG,DT.QTY_TERIMA QTY,B.NAMA BAGIAN,GO.KETERANGAN_PENGGUNAAN,GO.SERI FROM ERP_PENGELUARAN P JOIN ERP_PENGELUARAN_DETAIL DP ON P.ID_KELUAR = DP.ID_KELUAR JOIN ERP_PENERIMAAN_DETAIL DT ON DP.ID_DETAIL_TERIMA = DT.ID_DETAIL_TERIMA JOIN ERP_GUDANG_ORDER GO ON P.ID_GUDANG_ORDER = GO.ID JOIN ERP_BAGIAN B ON GO.ID_BAGIAN = B.ID JOIN ERP_BARANG MB ON GO.ID_BARANG = MB.ID WHERE P.NO_IPB=P.NO_IPB";

			// $sql .= " WHERE TO_CHAR(P.TGL_KELUAR, 'DD/MM/YYYY') BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."' ORDER BY P.TGL_KELUAR DESC,DT.KODE_ROLL DESC";

			$tanggalAwal = $data['tanggalAwal'];
			$tanggalAkhir = $data['tanggalAkhir'];
			$seri = $data['seri'];

			if ($tanggalAwal !== "" AND $tanggalAkhir !== "") {
				$sql .= " AND (TO_CHAR(P.TGL_KELUAR, 'DD/MM/YYYY') BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."')";
			}

			if ($seri !== "") {
				$sql .= " AND (GO.SERI = '".$seri."')";
			}

			$sql .= " ORDER BY P.TGL_KELUAR DESC,DT.KODE_ROLL DESC";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>