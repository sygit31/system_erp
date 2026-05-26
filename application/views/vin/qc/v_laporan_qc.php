	
<?php
  $this->load->view('dashboard/header'); 
  $this->load->view('sgt/qc/laporan_qc/style'); 


  $this->load->view('dashboard/topbar');
  $this->load->view('dashboard/sidebar'); 
  $this->load->view('sgt/qc/laporan_qc/content'); 


  $this->load->view('dashboard/footer'); 
  $this->load->view('sgt/qc/laporan_qc/footer'); 
?>