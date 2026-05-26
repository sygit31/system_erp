<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_log_mutasi_pet extends CI_Model 
	{

		public function getLogByDate($dataDate,$dataStatus,$dataAlokasi) 
		{
			$sql = "SELECT * FROM ERP_LOG_MUTASI_PET L JOIN 
					ERP_PENERIMAAN_DETAIL PD ON L.ID_DETAIL_TERIMA = PD.ID_DETAIL_TERIMA
					WHERE TANGGAL = '".$dataDate."' AND STATUS = '".$dataStatus."' AND ALOKASI = '".$dataAlokasi."'";

			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>