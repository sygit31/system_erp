<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_permintaan_filter extends CI_Model 
	{

		
		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_PERMINTAAN_FILTER
				(ID,TANGGAL,ID_PERMINTAAN_DETAIL,JUMLAH,STATUS)
				VALUES
				(SEQ_PERMINTAAN_FILTER.NEXTVAL,TO_CHAR(CURRENT_DATE,'DD.MM.YYYY'),"
				.$data['id_permintaan_detail'].",".$data['jumlah'].",'"
				.$data['status']."')";
			
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

		public function getPermintaanFilter() 
		{
			$sql = "SELECT pf.ID ID_PF,bg.NAMA BAGIAN,p.TANGGAL TANGGAL_PENGAJUAN,
			b.NAMA BARANG,pd.JUMLAH JUMLAH_ORDER,pf.JUMLAH JUMLAH_ACC,b.SATUAN,
			pd.KETERANGAN,b.SPESIFIKASI 
			FROM ERP_PERMINTAAN_FILTER pf
			JOIN ERP_PERMINTAAN_DETAIL pd ON pf.ID_PERMINTAAN_DETAIL = pd.ID
			JOIN ERP_PERMINTAAN p ON pd.ID_PERMINTAAN = p.ID
			JOIN ERP_BARANG b ON pd.ID_BARANG = b.ID
			JOIN ERP_BAGIAN bg ON P.ID_BAGIAN = bg.ID 
			WHERE pf.STATUS = 'seleksi'
			ORDER BY bg.NAMA,p.TANGGAL,b.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function UpdateStatus($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_PERMINTAAN_FILTER
			SET STATUS = '".$data['status']."'
			WHERE ID = ". $data['id_pf'];
			
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