<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kk extends CI_Model 
{

	public function get_risalah() 
	{
		$sql = "SELECT cr.ID,cr.NMR,cr.TGL TGL_RISALAH,CR.DELIVERY TGL_DELIVERY,RPD.NAMA,RP.DESAIN,CRD.QTY,CRR.TGL TGL_REVISI,CRR.QTY QTY_REVISI,crd.ID_PROSES FROM erp_cs_risalah cr JOIN erp_cs_risalah_detail crd ON cr.ID = crd.ID_RISALAH LEFT JOIN erp_cs_risalah_revisi crr ON crd.ID = crr.ID_RISALAH_DETAIL JOIN ERP_RND_PROSES rp ON crd.ID_PROSES = rp.ID JOIN ERP_RND_PRODUK rpd ON rp.ID_PRODUK = rpd.ID";

		$query = $this->db->query($sql);
		return $query->result();
	}


	public function getKKAktif() 
	{
		$sql = "SELECT * FROM ERP_KK k
		WHERE STATUS ='OPEN'";

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function getBarangKK($id_kk) 
	{
		$sql = "SELECT b.*,kd.ID ID_KK_DETAIL FROM ERP_KK k
		JOIN erp_kk_detail kd ON k.ID=kd.ID_KK 
		JOIN erp_barang b ON kd.ID_BAHAN_BAKU=b.ID
		WHERE k.id = ".$id_kk;

		$query = $this->db->query($sql);
		return $query->result();
	}
}
?>