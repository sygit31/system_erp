<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_akses extends CI_Model 
	{

		public function getAkses($data) 
		{
			$sql = "SELECT * FROM ERP_AKSES WHERE ID_AKUN = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}
		

		public function getAllAkses() 
		{
			$sql = "SELECT K.NAMA,BAG.NAMA NAMA_BAGIAN,A.* FROM ERP_AKSES A JOIN ERP_AKUN B ON A.ID_AKUN = B.ID JOIN ERP_KARYAWAN K ON B.ID_KARYAWAN = K.ID JOIN ERP_BAGIAN BAG ON K.ID_BAGIAN = BAG.ID ORDER BY K.NAMA,BAG.NAMA";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function save($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_AKSES (ID,ID_AKUN,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W) 
					VALUES (SEQ_AKSES.NEXTVAL,SEQ_AKUN.CURRVAL,"
					.$data['A'].",".$data['B'].",".$data['C'].","
					.$data['D'].",".$data['E'].",".$data['F'].",".$data['G'].",".$data['H'].",".$data['I'].",".$data['J'].","
					.$data['K'].",".$data['L'].",".$data['M'].",".$data['N'].",".$data['O'].",".$data['P'].",".$data['Q'].","
					.$data['R'].",".$data['S'].",".$data['T'].",".$data['U'].",".$data['V'].",".$data['W'].")";
			
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


		public function edit($data) 
		{

			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_AKSES SET A=".$data['A'].",B=".$data['B'].",C=".$data['C'].",D=".$data['D'].
					",E=".$data['E'].",F=".$data['F'].",G=".$data['G'].",H=".$data['H'].",I=".$data['I'].",J=".$data['J'].
					",K=".$data['K'].",L=".$data['L'].",M=".$data['M'].",N=".$data['N'].",O=".$data['O'].",P=".$data['P'].
					",Q=".$data['Q'].",R=".$data['R'].",S=".$data['S'].",T=".$data['T'].",U=".$data['U'].",V=".$data['V'].
					",W=".$data['W'].
					" WHERE ID_AKUN = ". $data['ID_AKUN'];
			
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