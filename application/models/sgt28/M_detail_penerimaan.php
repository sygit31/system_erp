<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_detail_penerimaan extends CI_Model 
{

	public function save($data) 
	{

		$this->db=$this->load->database('default',true);

		$success = true;

		for($i=1;$i<=sizeof($data);$i++){
			if (isset($data[$i]['QTY_TERIMA'])) {
				$sql = "INSERT INTO erp_penerimaan_detail(ID_DETAIL_TERIMA,ID_TERIMA,QTY_TERIMA,SATUAN,BARCODE,STATUS_QC,KODE_ROLL,GRADE)
				VALUES (SEQ_DETAIL_PENERIMAAN.NEXTVAL,SEQ_PENERIMAAN.CURRVAL,".$this->db->escape($data[$i]['QTY_TERIMA']).",".$this->db->escape($data[$i]['SATUAN']).",".$this->db->escape($data[$i]['BARCODE']).",'INCOME','','')";
				
				$success = $this->db->query($sql);

				if ($success) {
					$sql = "INSERT INTO erp_log_mutasi_pet VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),SEQ_DETAIL_PENERIMAAN.CURRVAL,'IN','LPB')";
					
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



	public function saveLain($data) 
	{
		$this->db=$this->load->database('default',true);

		$success = true;

		$sql = "INSERT INTO erp_penerimaan_detail VALUES (SEQ_DETAIL_PENERIMAAN.NEXTVAL,SEQ_PENERIMAAN.CURRVAL,".$this->db->escape($data['QTY_TERIMA']).",".$this->db->escape($data['SATUAN']).",'','INCOME','','')";
		
		$success = $this->db->query($sql);

		if ($success) {
			$sql = "INSERT INTO erp_log_mutasi_pet VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),SEQ_DETAIL_PENERIMAAN.CURRVAL,'IN','LPB')";
			
			$success = $this->db->query($sql);
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


	public function saveSingle($data) 
	{

		$this->db=$this->load->database('default',true);

		$success = true;
		


		$sql = "INSERT INTO erp_penerimaan_detail VALUES (SEQ_DETAIL_PENERIMAAN.NEXTVAL,".$this->db->escape($data['ID_TERIMA']).",".$this->db->escape($data['QTY_TERIMA']).",".$this->db->escape($data['SATUAN']).",".$this->db->escape($data['BARCODE']).",".$this->db->escape($data['STATUS_QC']).",".$this->db->escape($data['KODE_ROLL']).",".$this->db->escape($data['GRADE']).")";
		
		$success = $this->db->query($sql);

		if ($success) {
			$sql = "INSERT INTO erp_log_mutasi_pet VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),SEQ_DETAIL_PENERIMAAN.CURRVAL,'IN','".$data['STATUS_QC']."')";
			
			$success = $this->db->query($sql);
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
		$sql = "SELECT SUM(DP.QTY_TERIMA) QTY FROM erp_penerimaan P JOIN erp_penerimaan_detail DP ON P.ID_TERIMA=DP.ID_TERIMA WHERE DP.STATUS_QC NOT IN ('REJECT') AND P.ID_PO_DETAIL = ".$data;

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getDetailPenerimaanById($data) 
	{
		$sql = "SELECT * FROM erp_penerimaan_detail WHERE ID_DETAIL_TERIMA=".$data;

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getById($data) 
	{
		$sql = "SELECT * FROM erp_penerimaan_detail WHERE ID_DETAIL_TERIMA = ".$data;

		$query = $this->db->query($sql);
		return $query->result();
	}

	
	public function getPenerimaanBarang() 
	{
		$sql = "SELECT P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC,MB.TAHUN 
		FROM erp_penerimaan_detail DP JOIN 
		erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN 
		erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN 
		erp_po PO ON PD.ID_PO = PO.ID JOIN 
		erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN 
		erp_barang MB ON MS.ID_BARANG = MB.ID JOIN 
		erp_supplier MSUP ON MS.ID_SUPPLIER = MSUP.ID 
		WHERE P.TGL_TERIMA 
		BETWEEN ADD_MONTHS( SYSDATE, -6 ) AND SYSDATE 
		AND PO.KD_UNIT = 12
		ORDER BY P.TGL_TERIMA DESC,DP.BARCODE DESC";

		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getPenerimaanForCek() 
	{
		$sql = "SELECT DP.ID_DETAIL_TERIMA,P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_po PO ON PD.ID_PO = PO.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang MB ON MS.ID_BARANG = MB.ID JOIN erp_supplier MSUP ON MS.ID_SUPPLIER = MSUP.ID WHERE STATUS_QC = 'INCOME' and PO.Kd_unit='12' ORDER BY P.TGL_TERIMA DESC,DP.BARCODE";


		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getPenerimaanBarangFilter($data) 
	{
		// $sql = "SELECT P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_po PO ON PD.ID_PO = PO.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang MB ON MS.ID_BARANG = MB.ID JOIN erp_supplier MSUP ON MS.ID_SUPPLIER = MSUP.ID";

		// $sql .= " WHERE P.TGL_TERIMA BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."'  ORDER BY P.TGL_TERIMA DESC,DP.BARCODE DESC";

		// $query = $this->db->query($sql);
		// return $query->result();

		// =======================================
		
		$sql = "SELECT P.TGL_TERIMA,PO.NOMER,P.NO_SP,MSUP.NAMA NAMA_SUPPLIER,MB.NAMA NAMA_BARANG,DP.BARCODE,DP.QTY_TERIMA,DP.SATUAN,DP.STATUS_QC,MB.TAHUN 
		FROM erp_penerimaan_detail DP JOIN 
		erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN 
		erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN 
		erp_po PO ON PD.ID_PO = PO.ID JOIN 
		erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN 
		erp_barang MB ON MS.ID_BARANG = MB.ID JOIN 
		erp_supplier MSUP ON MS.ID_SUPPLIER = MSUP.ID 
		WHERE MB.TAHUN LIKE '%".$data['tahun']."%' AND
		P.TGL_TERIMA BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."'
		ORDER BY P.TGL_TERIMA DESC,DP.BARCODE DESC";

		$query = $this->db->query($sql);
		return $query->result();
	}

	
	public function getPenerimaanOkByIdGudangOrder($IdGudangOrder) 
	{
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' AND B.ID = (SELECT ID_BARANG FROM ERP_GUDANG_ORDER WHERE ID = ".$IdGudangOrder.") ORDER BY P.TGL_TERIMA,DP.BARCODE";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getPenerimaanOk() 
	{
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' ORDER BY P.TGL_TERIMA,DP.BARCODE";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getPenerimaanOkByIdBarang($data) 
	{
			// $sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' AND B.ID = '".$data."' ORDER BY P.TGL_TERIMA,DP.BARCODE";
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,B.ID,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID WHERE DP.STATUS_QC = 'T_OK' AND B.ID = '".$data."' ORDER BY P.TGL_TERIMA,DP.KODE_ROLL";

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
				$sql = "UPDATE erp_penerimaan_detail SET STATUS_QC = 'OUT' WHERE ID_DETAIL_TERIMA = ". $data[$i]['ID_DETAIL_TERIMA'];

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
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM 
		erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN 
		erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN 
		erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN 
		erp_barang B ON MS.ID_BARANG = B.ID JOIN 
		erp_test_qc TQ ON TQ.ID_DETAIL_TERIMA = DP.ID_DETAIL_TERIMA 
		WHERE (DP.STATUS_QC = 'T_OK' OR DP.STATUS_QC LIKE 'RM__%') AND B.FLAG_PENERIMAAN = 'LABEL'
		ORDER BY P.TGL_TERIMA DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getCetak() 
	{
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_test_qc TQ ON TQ.ID_DETAIL_TERIMA = DP.ID_DETAIL_TERIMA WHERE DP.STATUS_QC IN ('T_OK','OUT','BOOKING') ORDER BY P.TGL_TERIMA DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getStokBayangan() 
	{
			//link ke QC validasi, tapi hasilnya double
			// $sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,erp_po.NOMER,B.ID ID_BARANG,QV.ID_DETAIL_TERIMA MUTASI_ID_DETAIL_TERIMA,DP.STATUS_QC FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_po ON PD.ID_PO = erp_po.ID JOIN ERP_QC_VALIDASI QV ON DP.ID_DETAIL_TERIMA = QV.MUTASI_ID_DETAIL_TERIMA WHERE DP.STATUS_QC LIKE 'QC_R%' ORDER BY B.NAMA,P.TGL_TERIMA";
		
			//tanpa link ke QC validasi
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,erp_po.NOMER,B.ID ID_BARANG,DP.STATUS_QC FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_po ON PD.ID_PO = erp_po.ID WHERE DP.STATUS_QC LIKE 'QC_R%' ORDER BY B.NAMA,P.TGL_TERIMA";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getFailtest() 
	{
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,erp_po.NOMER,B.ID ID_BARANG,DP.STATUS_QC,RG.QTY FROM erp_penerimaan_detail DP JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_po ON PD.ID_PO = erp_po.ID LEFT JOIN ERP_RETOUR_GUDANG RG ON DP.ID_DETAIL_TERIMA = RG.ID_DETAIL_TERIMA WHERE DP.STATUS_QC LIKE 'T_FAIL%' ORDER BY B.NAMA,P.TGL_TERIMA";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getAllTest($data = array(),$filter = null) 
	{
			// $sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,erp_po.NOMER,B.ID ID_BARANG,TQ.NOMER NOMER_TEST_QC,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM erp_penerimaan_detail DP JOIN erp_test_qc TQ ON DP.ID_DETAIL_TERIMA = TQ.ID_DETAIL_TERIMA JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_po ON PD.ID_PO = erp_po.ID WHERE DP.STATUS_QC <> 'INCOME' ORDER BY NOMER_TEST_QC DESC,DP.KODE_ROLL DESC";
		
		$sql = "SELECT DP.ID_DETAIL_TERIMA,DP.BARCODE,B.NAMA,P.TGL_TERIMA,DP.QTY_TERIMA,DP.SATUAN,DP.KODE_ROLL,erp_po.NOMER,B.ID ID_BARANG,TQ.NOMER NOMER_TEST_QC,DP.GRADE,TO_CHAR(TQ.TANGGAL,'DD-MM-YYYY')TANGGAL_QC FROM erp_penerimaan_detail DP JOIN erp_test_qc TQ ON DP.ID_DETAIL_TERIMA = TQ.ID_DETAIL_TERIMA JOIN erp_penerimaan P ON DP.ID_TERIMA = P.ID_TERIMA JOIN erp_po_detail PD ON P.ID_PO_DETAIL = PD.ID JOIN erp_material_supply MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN erp_barang B ON MS.ID_BARANG = B.ID JOIN erp_po ON PD.ID_PO = erp_po.ID WHERE DP.STATUS_QC <> 'INCOME' AND ERP_PO.KD_UNIT='12' ";

		if ($filter) {
			$sql .= " AND (P.TGL_TERIMA BETWEEN '".$data['tanggalAwal']."' AND '".$data['tanggalAkhir']."')";
		}else{
			$sql .= " AND (P.TGL_TERIMA BETWEEN ADD_MONTHS(CURRENT_DATE, -3) AND CURRENT_DATE)";
		}


		$sql .= " ORDER BY TGL_TERIMA DESC,NOMER_TEST_QC DESC,DP.KODE_ROLL DESC";

			// print_r($sql);
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function UpdateStatusKodeRoll($data)
	{
		$this->db=$this->load->database('default',true);

		$sql = "UPDATE erp_penerimaan_detail SET STATUS_QC = '".$data["STATUS_QC"]."', KODE_ROLL = '".$data["KODE_ROLL"]."',GRADE = '".$data["GRADE"]."' WHERE ID_DETAIL_TERIMA = ".$data["ID_DETAIL_TERIMA"];
		
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

	public function UpdateStatus($data)
	{
		$this->db=$this->load->database('default',true);

		$sql = "UPDATE erp_penerimaan_detail SET STATUS_QC = '".$data["STATUS_QC"]."' WHERE ID_DETAIL_TERIMA = ".$data["ID_DETAIL_TERIMA"];
		
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


	public function UpdateStatusDanJumlah($data)
	{
		$this->db=$this->load->database('default',true);

		$sql = "UPDATE erp_penerimaan_detail SET STATUS_QC = '".$data["STATUS_QC"]."',QTY_TERIMA = '".$data["QTY_TERIMA"]."' WHERE ID_DETAIL_TERIMA = ".$data["ID_DETAIL_TERIMA"];
		
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

		// public function getStokByIdBarang($data) 
		// {
		// 	$sql = "SELECT SUM(DP.QTY_TERIMA) QTY FROM erp_penerimaan P JOIN erp_penerimaan_detail DP ON P.ID_TERIMA=DP.ID_TERIMA WHERE DP.STATUS_QC NOT IN ('REJECT') AND P.ID_PO_DETAIL = ".$data;

		// 	$query = $this->db->query($sql);
		// 	return $query->result();
		// }

	public function getListStokByIdBarang($data) 
	{
		$sql = "SELECT PD.*,B.NAMA FROM erp_penerimaan_detail PD
		JOIN erp_penerimaan P ON PD.ID_TERIMA = P.ID_TERIMA 
		JOIN erp_po_detail POD ON P.ID_PO_DETAIL = POD.ID
		JOIN erp_material_supply MS ON POD.ID_MATERIAL_SUPPLY = MS.ID
		JOIN erp_barang B ON MS.ID_BARANG = B.ID
		WHERE PD.STATUS_QC = 'T_OK' AND MS.ID_BARANG = '".$data."'
		ORDER BY PD.KODE_ROLL,PD.ID_DETAIL_TERIMA";

		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>