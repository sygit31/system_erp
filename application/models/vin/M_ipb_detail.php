<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_ipb_detail extends CI_Model 
	{

		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_IPB_DETAIL
				(ID,ID_IPB,ID_DETAIL_TERIMA,STATUS)
				VALUES
				(SEQ_IPB_DETAIL.NEXTVAL,SEQ_IPB.CURRVAL,"
				.$data['ID_DETAIL_TERIMA'].",'".$data['STATUS']."')";
			
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


		public function updateStatus($data) 
		{
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_IPB_DETAIL SET 
				STATUS = '".$data['STATUS']."' 
				WHERE ID_DETAIL_TERIMA = ".$data['ID_DETAIL_TERIMA'];
			
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


		public function getBarangByIdIpb($id_ipb) 
		{
			$sql = "SELECT * FROM ERP_IPB_DETAIL id
			JOIN ERP_PENERIMAAN_DETAIL pd ON id.ID_DETAIL_TERIMA = pd.ID_DETAIL_TERIMA
			WHERE ID_IPB = ". $id_ipb;

			$query = $this->db->query($sql);
			// return $sql;
			return $query->result();
		}

	}
?>