<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_akun extends CI_Model 
{

	public function login($data) 
	{
		$this->db = $this->load->database('default', true);
		$username = $data['username'];
		$password = md5($data['password']);
		
		$this->db->select('*');
		$this->db->from('ERP_AKUN');
		$this->db->where('USERNAME', $username);
		$this->db->where('PASSWORD', $password);
		$this->db->where('AKTIF', '1');
		$query = $this->db->get();
		return $query->row();
	}

	public function getData($data) 
	{
		$this->db = $this->load->database('default', true);
		$id_karyawan = $data['id_karyawan'];
		$password = md5($data['password']);
		
		$this->db->select('*');
		$this->db->from('ERP_AKUN');
		$this->db->where('ID_KARYAWAN', $id_karyawan);
		$this->db->where('PASSWORD', $password);
		$query = $this->db->get();
		return $query->row();
	}

	
	public function UpdateUser($data) 
	{
		$this->db = $this->load->database('default', true);
		$id = $data['id'];
		
		$dataK = array('USERNAME' => $data['userbaru']);

		$this->db->where('ID', $id);
		$this->db->update('ERP_AKUN', $dataK);
	}

	public function UpdatePass($data) 
	{
		$this->db = $this->load->database('default', true);
		$id = $data['id'];
		
		$dataK = array('PASSWORD' => md5($data['password']));

		$this->db->where('ID', $id);
		$this->db->update('ERP_AKUN', $dataK);
	}

		// public function save($data) 
		// {
		// 	$this->db=$this->load->database('default',true);
		// 	$this->db->trans_begin();
		// 	$success = $this->db->insert('ERP_AKUN', $data);
		// 	$this->db->trans_commit();
		// 	$this->db->trans_complete();
		// 	if(!$success){
		// 		$success = false;
		// 		$errNo   = $this->db->_error_number();
		// 		$errMess = $this->db->_error_message();
		// 		array_push($errors, array($errNo, $errMess));
		// 	}
		// 	return $success;
		// }

	public function getAkun($data) 
	{
		$sql = "SELECT * FROM ERP_AKUN WHERE ID_KARYAWAN =". $data;
		$query = $this->db->query($sql);
		return $query->num_rows();
	}

	public function simpan($data) 
	{

		$this->db=$this->load->database('default',true);

		$sql = "INSERT INTO ERP_AKUN VALUES (SEQ_AKUN.NEXTVAL,'".$data['username']."','".$data['password']."','".$data['id_karyawan']."',1)";
		
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