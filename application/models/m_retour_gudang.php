<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_retour_gudang extends CI_Model 
	{
		public function getQTYbyOrderGudang($data) 
		{
			$sql = "SELECT SUM(QTY) QTY FROM ERP_RETOUR_GUDANG WHERE ID_GUDANG_ORDER = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>