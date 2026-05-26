	
<?php
  $this->load->view('dashboard/header'); 
  $this->load->view('qc/cetak_label/style'); 


  $this->load->view('dashboard/topbar');
  $this->load->view('dashboard/sidebar'); 
  $this->load->view('qc/cetak_label/content'); 


  $this->load->view('dashboard/footer'); 
  $this->load->view('qc/cetak_label/footer'); 
?>