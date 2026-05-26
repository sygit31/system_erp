	
<?php
  $this->load->view('dashboard/header'); 
  $this->load->view('sgt/mk/monitoring/style'); 


  $this->load->view('dashboard/topbar');
  $this->load->view('dashboard/sidebar'); 
  $this->load->view('sgt/mk/monitoring/content'); 


  $this->load->view('dashboard/footer'); 
  $this->load->view('sgt/mk/monitoring/footer'); 
?>