<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_po_detail extends CI_Model 
	{

		public function getPOoutstanding() 
		{
			$sql = "SELECT PD.ID,P.NOMER,S.NAMA NAMA_SUPPLIER,B.NAMA NAMA_BARANG,PD.QTY,PD.SATUAN,P.TGL,B.ID ID_BARANG,B.FLAG_PENERIMAAN FROM 
			ERP_PO_DETAIL PD JOIN ERP_PO P ON PD.ID_PO = P.ID JOIN 
			ERP_BAGIAN MB ON P.ID_BAGIAN = MB.ID JOIN 
			ERP_MATERIAL_SUPPLY MS ON PD.ID_MATERIAL_SUPPLY = MS.ID JOIN 
			ERP_BARANG B ON MS.ID_BARANG = B.ID JOIN 
			ERP_SUPPLIER S ON MS.ID_SUPPLIER = S.ID 
			WHERE PD.STATUS = 'OTW' AND B.ID = '1093'";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateStatus($data)
		{
			$sql = "UPDATE ERP_PO_DETAIL SET STATUS = '". $data['status'] ."' WHERE ID = '". $data['id'] ."'";

			$selesai = true;
			if (!$this->db->simple_query($sql))
			{
				$selesai = false;
			    $error = $this->db->error();
			    echo "<script type='text/javascript'>alert('". $error ."');</script>";
			}

			$this->db->trans_complete();
			return $selesai;
		}

		public function getPoDetailByIdDetailTerima($data) 
		{
			$sql = "SELECT PD.* FROM ERP_PO_DETAIL PD JOIN ERP_PENERIMAAN P ON PD.ID = P.ID_PO_DETAIL JOIN ERP_PENERIMAAN_DETAIL DP ON P.ID_TERIMA = DP.ID_TERIMA WHERE DP.ID_DETAIL_TERIMA = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>