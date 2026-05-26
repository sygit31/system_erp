<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class M_gudang_order extends CI_Model 
	{

		public function getOrder() 
		{
			$sql = "SELECT GO.*,MB.NAMA BAGIAN,B.NAMA BARANG FROM ERP_GUDANG_ORDER GO JOIN ERP_BAGIAN MB ON GO.ID_BAGIAN = MB.ID JOIN ERP_BARANG B ON GO.ID_BARANG = B.ID WHERE GO.STATUS = 'OPEN' ORDER BY GO.TANGGAL";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function updateStatus($data)
		{
			$sql = "UPDATE ERP_GUDANG_ORDER SET STATUS = '". $data['status'] ."' WHERE ID = '". $data['id'] ."'";

			$selesai = true;
			if (!$this->db->simple_query($sql))
			{
				$selesai = false;
			    $error = $this->db->error();
			    echo "<script type='text/javascript'>alert('". $error ."');</script>";
			}

			$this->db->trans_complete();
			return $selesai;
		}
	}
?>