<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_test_code extends CI_Model 
	{

		public function getMaxTestCode() 
		{
			$sql = "select  concat('TC-',nvl(max(ID_TEST_CODE),0)+1) no_urut, nvl(max(ID_TEST_CODE),0)+1 nomor  from ERP_TEST_CODE";

			$query = $this->db->query($sql);
			return $query->row_array();
		}

  //     	public function getMasterStage() 
		// {
		// 	$sql = "select  * from TBL_MASTER_STAGE WHERE STATUS='AKTIF'";

		// 	$query = $this->db->query($sql);
		// 	return $query->result();
		// }

		public function getMasterStage() 
		{
			$sql = "select  * from ERP_STATION WHERE STATUS='Y'";

			$query = $this->db->query($sql);
			return $query->result();
		}

        public function getMasterTestCode() 
		{
			$sql = "select a.*,b.STAGE_NAME from ERP_TEST_CODE a,TBL_MASTER_STAGE b WHERE b.STATUS='AKTIF' and a.STAGE=b.ID_STAGE";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getMaxDetailTestCode() 
		{
			$sql = "select  nvl(max(ID_DETAIL_TEST_CODE),0)+1 nomor_detail  from ERP_TEST_CODE_DETAIL";

			$query = $this->db->query($sql);
			return $query->row_array();
		}

	 	public function saveTestCode($data) 
		{
			// print_r($data);

			$this->db=$this->load->database('default',true);

			$sql = "INSERT INTO ERP_TEST_CODE VALUES (TO_CHAR(CURRENT_DATE, 'DD-MM-YYYY'),SEQ_TEST_CODE.NEXTVAL,".$this->db->escape($data['Deskripsi']).",".$this->db->escape($data['Stage']).",concat(".$this->db->escape($data['Kode']).",SEQ_TEST_CODE.NEXTVAL),".$this->db->escape($data['Jenis']).",".$this->db->escape($data['Prioritas']).")";
			
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

		public function getAllData(){

			// $sql = "SELECT T.*,D.ID_DETAIL_TEST_CODE,D.RANGE,D.HASIL,D.MAX,D.MIN,S.STAGE_NAME FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE JOIN TBL_MASTER_STAGE S ON T.STAGE = S.ID_STAGE WHERE D.STATUS = 'ON' ORDER BY T.STAGE,T.JENIS,T.TEST_DESCRIPTION,D.RANGE";
			// $sql = "SELECT T.*,D.ID_DETAIL_TEST_CODE,D.RANGE,D.HASIL,D.MAX,D.MIN,S.STAGE_NAME FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE JOIN TBL_MASTER_STAGE S ON T.STAGE = S.ID_STAGE WHERE D.STATUS = 'ON' ORDER BY T.STAGE,T.JENIS,T.TEST_DESCRIPTION,TO_CHAR(D.RANGE)";
			
			
			$sql = "SELECT T.*,D.ID_DETAIL_TEST_CODE,D.RANGE,D.HASIL,D.MAX,D.MIN,S.NAMA STAGE_NAME FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE JOIN ERP_STATION S ON T.STAGE = S.ID WHERE D.STATUS = 'ON' ORDER BY T.STAGE,T.JENIS,T.TEST_DESCRIPTION,TO_CHAR(D.RANGE)";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getAllDataTestCodeOnly(){

			// $sql = "SELECT DISTINCT T.*,S.STAGE_NAME FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE JOIN TBL_MASTER_STAGE S ON T.STAGE = S.ID_STAGE WHERE D.STATUS = 'ON' AND S.STATUS = 'AKTIF' ORDER BY T.STAGE,T.JENIS,T.TEST_DESCRIPTION";
			
			$sql = "SELECT DISTINCT T.*,S.NAMA STAGE_NAME FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE JOIN ERP_STATION S ON T.STAGE = S.ID WHERE D.STATUS = 'ON' AND S.STATUS = 'Y' ORDER BY T.STAGE,T.JENIS,T.TEST_DESCRIPTION";

			$query = $this->db->query($sql);
			return $query->result();
		}

		public function getTestById($data){

			$sql = "SELECT T.*,D.* FROM ERP_TEST_CODE T JOIN ERP_TEST_CODE_DETAIL D ON T.ID_TEST_CODE = D.ID_TEST_CODE WHERE D.STATUS = 'ON' AND T.ID_TEST_CODE =". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function edit($data) 
		{
			// print_r($data);
			$this->db=$this->load->database('default',true);

			$sql = "UPDATE ERP_TEST_CODE SET TGL_INPUT_TEST_CODE = TO_CHAR(CURRENT_DATE, 'DD-MM-YYYY'),TEST_DESCRIPTION = '".$data['Deskripsi']."',STAGE='".$data['Stage']."',JENIS='".$data['Jenis']."',PRIORITAS='".$data['Prioritas']."' WHERE ID_TEST_CODE = ".$data['Id_Test_Code'];
					
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