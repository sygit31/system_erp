<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_detail_penerimaan extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$success = true;

			for($i=1;$i<=sizeof($data);$i++){
				if (isset($data[$i]['QTY_TERIMA'])) {
					$sql = "INSERT INTO ERP_PENERIMAAN_DETAIL VALUES (SEQ_DETAIL_PENERIMAAN.NEXTVAL,SEQ_PENERIMAAN.CURRVAL,".$this->db->escape($data[$i]['QTY_TERIMA']).",".$this->db->escape($data[$i]['SATUAN']).",".$this->db->escape($data[$i]['BARCODE']).",'INCOME','','')";
			
					$success = $this->db->query($sql);

					if ($success) {
						$sql = "INSERT INTO ERP_LOG_MUTASI_PET VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),SEQ_DETAIL_PENERIMAAN.CURRVAL,'IN','LPB')";
			
						$success = $this->db->query($sql);
					}
				}
			}
			
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


		
		public function getQTYbyDetailPO($data) 
		{
			$sql = "SELECT SUM(DP.QTY_TERIMA) QTY FROM ERP_PENERIMAAN P JOIN ERP_PENERIMAAN_DETAIL DP ON P.ID_TERIMA=DP.ID_TERIMA WHERE DP.STATUS_QC NOT IN ('REJECT') AND P.ID_PO_DETAIL = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getById($data) 
		{
			$sql = "SELECT * FROM ERP_PENERIMAAN_DETAIL WHERE ID = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getPenerimaanBarang() 
		{
			$sql = "SELECT P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_PO PO ON PD.ID_PO = PO.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG MB ON MS.ID_BARANG = MB.ID JOIN ERP_SUPPLIER MSUP ON MS.ID_SUPPLIER = MSUP.ID WHERE P.TGL_TERIMA BETWEEN ADD_MONTHS( SYSDATE, -6 ) AND SYSDATE ORDER BY P.TGL_TERIMA DESC,DP.BARCODE DESC";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getPenerimaanForCek() 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_PO PO ON PD.ID_PO = PO.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG MB ON MS.ID_BARANG = MB.ID JOIN ERP_SUPPLIER MSUP ON MS.ID_SUPPLIER = MSUP.ID WHERE STATUS_QC = 'INCOME' ORDER BY P.TGL_TERIMA DESC,DP.BARCODE";


			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getPenerimaanBarangFilter($data) 
		{
			$sql = "SELECT P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_PO PO ON PD.ID_PO = PO.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG MB ON MS.ID_BARANG = MB.ID JOIN ERP_SUPPLIER MSUP ON MS.ID_SUPPLIER = MSUP.ID";

			$sql .= " WHERE P.TGL_TERIMA BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."'  ORDER BY P.TGL_TERIMA DESC,DP.BARCODE DESC";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		
		public function getPenerimaanOkByIdGudangOrder($IdGudangOrder) 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' AND B.ID = (SELECT ID_BARANG FROM ERP_GUDANG_ORDER WHERE ID = ".$IdGudangOrder.") ORDER BY P.TGL_TERIMA,DP.BARCODE";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getPenerimaanOk() 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' ORDER BY P.TGL_TERIMA,DP.BARCODE";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getPenerimaanOkByIdBarang($data) 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' AND B.ID = '".$data."' ORDER BY P.TGL_TERIMA,DP.BARCODE";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}


		public function UpdateStatusPengeluaranGudang($data) 
		{
			$this->db=$this->load->database('default',true);

			$success = true;

			for($i=0;$i<sizeof($data);$i++){
				if ($data[$i]['ID_DETAIL_TERIMA']!='') {
					$sql = "UPDATE ERP_PENERIMAAN_DETAIL SET STATUS_QC = 'OUT' WHERE ID_DETAIL_TERIMA = ". $data[$i]['ID_DETAIL_TERIMA'] ."";

					$success = $this->db->query($sql);
				}
			}
			
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

		public function getStok() 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN ERP_TEST_QC TQ ON TQ.ID_DETAIL_TERIMA = DP.ID_DETAIL_TERIMA WHERE DP.STATUS_QC = 'T_OK' ORDER BY P.TGL_TERIMA DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getCetak() 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN ERP_TEST_QC TQ ON TQ.ID_DETAIL_TERIMA = DP.ID_DETAIL_TERIMA WHERE DP.STATUS_QC IN ('T_OK','OUT') ORDER BY P.TGL_TERIMA DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getStokBayangan() 
		{
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,ERP_PO.NOMER,B.ID ID_BARANG FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN ERP_PO ON PD.ID_PO = ERP_PO.ID WHERE DP.STATUS_QC = 'T_FAIL' ORDER BY B.NAMA,P.TGL_TERIMA";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getAllTest($data = array(),$filter = null) 
		{
			// $sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,ERP_PO.NOMER,B.ID ID_BARANG,TQ.NOMER NOMER_TEST_QC,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_TEST_QC TQ ON DP.ID_DETAIL_TERIMA = TQ.ID_DETAIL_TERIMA JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN ERP_PO ON PD.ID_PO = ERP_PO.ID WHERE DP.STATUS_QC <> 'INCOME' ORDER BY NOMER_TEST_QC DESC,DP.KODE_ROLL DESC";
			
			$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,ERP_PO.NOMER,B.ID ID_BARANG,TQ.NOMER NOMER_TEST_QC,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM ERP_PENERIMAAN_DETAIL DP JOIN ERP_TEST_QC TQ ON DP.ID_DETAIL_TERIMA = TQ.ID_DETAIL_TERIMA JOIN ERP_PENERIMAAN P ON DP.ID_TERIMA = P.ID_TERIMA JOIN ERP_PO_DETAIL PD ON P.ID_PO_DETAIL = PD.ID JOIN ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN ERP_PO ON PD.ID_PO = ERP_PO.ID WHERE DP.STATUS_QC <> 'INCOME'";

			if ($filter) {
				$sql .= " AND (P.TGL_TERIMA BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."')";
			}


			$sql .= " ORDER BY NOMER_TEST_QC DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function UpdateStatusKodeRoll($data)
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_PENERIMAAN_DETAIL SET STATUS_QC = '".$data["STATUS_QC"]."', KODE_ROLL = '".$data["KODE_ROLL"]."',GRADE = '".$data["GRADE"]."' WHERE ID_DETAIL_TERIMA = ".$data["ID_DETAIL_TERIMA"];
			
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

	}
?>