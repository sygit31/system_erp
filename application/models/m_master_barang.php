<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class m_master_barang extends CI_Model {

		public function SelectAll() {

			$sql = "SELECT * FROM ERP_BARANG";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function DetailTestById($data) {

			$sql = "SELECT g.id ID_TEST_GROUP,t.ID_TEST_CODE,t.TEST_CODE,t.TEST_DESCRIPTION,t.JENIS,t.PRIORITAS FROM ERP_BARANG b LEFT JOIN ERP_TEST_GROUP g on b.ID = g.ID_MASTER_BARANG join ERP_TEST_CODE t on g.ID_TEST_CODE = t.ID_TEST_CODE where b.ID = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function DetailTestByIdDetailTerima($data,$stage) {

			$sql = "SELECT g.id ID_TEST_GROUP,t.ID_TEST_CODE,t.TEST_CODE,t.TEST_DESCRIPTION,t.JENIS,t.PRIORITAS FROM ERP_BARANG b LEFT JOIN ERP_TEST_GROUP g on b.ID = g.ID_MASTER_BARANG join ERP_TEST_CODE t on g.ID_TEST_CODE = t.ID_TEST_CODE where t.STAGE = ".$stage." AND b.ID = (SELECT xMS.ID_BARANG FROM ERP_PENERIMAAN_DETAIL xD JOIN ERP_PENERIMAAN xP ON xD.ID_TERIMA = xP.ID_TERIMA JOIN ERP_PO_DETAIL xPD ON xPD.ID = xP.ID_PO_DETAIL JOIN ERP_MATERIAL_SUPPLY xMS ON xPD.ID_MATERIAL_SUPPLY = xMS.ID WHERE xD.ID_DETAIL_TERIMA =".$data.") ORDER BY t.PRIORITAS,t.TEST_DESCRIPTION";

			$query = $this->db->query($sql);
			return $query->result();
		}


		public function getTahunByIdDetailTerima($data) {

			$sql = "SELECT b.TAHUN,b.KODE FROM ERP_BARANG b JOIN ERP_MATERIAL_SUPPLY ms ON ms.ID_BARANG = b.ID JOIN ERP_PO_DETAIL pd ON pd.ID_MATERIAL_SUPPLY = ms.ID JOIN ERP_PENERIMAAN p ON p.ID_PO_DETAIL = pd.ID JOIN ERP_PENERIMAAN_DETAIL dp ON p.ID_TERIMA = dp.ID_TERIMA where dp.ID_DETAIL_TERIMA = ". $data;

			$query = $this->db->query($sql);
			return $query->result();
		}
	}
?>