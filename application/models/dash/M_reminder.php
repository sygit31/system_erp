<?php 
class M_reminder extends CI_Model {

	function isi_box() {
        return $this->db->query("Select waktu, content from erp_dash_box where status='1' order by no_box");
    }

    function video() {
        $query = $this->db->query("Select content from erp_dash_box where judul='Video' and status='1'");
        $data = $query->row_array();
        return $data['CONTENT'];
    }

}
?>