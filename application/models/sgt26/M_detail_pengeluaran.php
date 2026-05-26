<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_detail_pengeluaran extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$success = true;

			for($i=0;$i<sizeof($data);$i++){
				if ($data[$i]['ID_DETAIL_TERIMA']!='') {
					$sql = "INSERT INTO ERP_PENGELUARAN_DETAIL VALUES (SEQ_DETAIL_PENGELUARAN.NEXTVAL,SEQ_PENGELUARAN.CURRVAL,".$this->db->escape($data[$i]['ID_DETAIL_TERIMA']).")";
		
					$success = true;
					$success = $this->db->query($sql);

					if ($success) {
						$sql = "INSERT INTO ERP_LOG_MUTASI_PET VALUES (SEQ_LOG_MUTASI_PET.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),".$this->db->escape($data[$i]['ID_DETAIL_TERIMA']).",'OUT',".$this->db->escape($data[$i]['SERI']).")";
			
						$success = $this->db->query($sql);
						// print_r($sql);
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


		public function getQTYbyOrderGudang($data) 
		{
			$sql = "SELECT SUM(DPEN.QTY_TERIMA) QTY FROM ERP_PENGELUARAN P JOIN ERP_PENGELUARAN_DETAIL DP ON P.ID_KELUAR = DP.ID_KELUAR JOIN ERP_PENERIMAAN_DETAIL DPEN ON DP.ID_DETAIL_TERIMA = DPEN.ID_DETAIL_TERIMA WHERE P.ID_GUDANG_ORDER = ".$data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>