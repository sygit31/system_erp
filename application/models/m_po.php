<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_po extends CI_Model 
	{

		public function getNomerPOByIdDetailTerima($data) 
		{
			$sql = "SELECT p.NOMER FROM ERP_PO p JOIN ERP_PO_DETAIL pd ON p.ID = pd.ID_PO JOIN ERP_PENERIMAAN pn ON pd.ID = pn.ID_PO_DETAIL JOIN ERP_PENERIMAAN_DETAIL dpn ON pn.ID_TERIMA = dpn.ID_TERIMA WHERE dpn.ID_DETAIL_TERIMA = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		
	}
?>