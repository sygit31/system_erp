<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_ipb extends CI_Model 
	{

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