	
<?php
  $this->load->view('dashboard/header'); 
  $this->load->view('pembelian/outstanding/style'); 


  $this->load->view('dashboard/topbar');
  $this->load->view('dashboard/sidebar'); 
  $this->load->view('pembelian/outstanding/content'); 


  $this->load->view('dashboard/footer'); 
  $this->load->view('pembelian/outstanding/footer'); 
?>