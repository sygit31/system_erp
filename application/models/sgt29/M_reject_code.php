<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_reject_code extends CI_Model 
	{

		public function getRejectCode() 
		{
			$sql = "select concat('RC-',nvl(max(ID_REJECT_CODE),0)+1) no_urut from TBL_REJECT_CODE";
			$query = $this->db->query($sql);
			return $query->row_array();
		}

		public function getTestCode() 
		{
			$sql = "select a.test_code, a.test_description, b.id_detail_test_code from ERP_TEST_CODE a inner join ERP_TEST_CODE_DETAIL b on a.id_test_code=b.id_test_code";
			$query = $this->db->query($sql);
			return $query->result();
		}

		public function ShowRejectData()
		{
			$reject_data = $this->db->query("Select a.id_reject_code, a.reject_code, a.reject_description, c.test_code, c.test_description from tbl_reject_code a inner join (ERP_TEST_CODE_DETAIL b inner join ERP_TEST_CODE c on b.id_test_code=c.id_test_code) on a.id_detail_test_code=b.id_detail_test_code order by a.reject_code");
			return $reject_data;
		}

		Public function save($table,$data)
		{
			$this->db->insert($table,$data);
		}	


	}
?>