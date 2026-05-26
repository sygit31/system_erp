<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Profit's Holo</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/profits-1.png">

  <style>
    blink, .blink {
    animation: blinker 3s linear infinite;
    }
    
    blink1, .blink1 {
    animation: blinker 1s linear infinite;
    }

    blink2, .blink2 {
    animation: blinker 1.5s linear infinite;
    }
    @keyframes blinker {  
    0% { opacity: 0; }
    from { color: #17A2B8; }
    to { color: white; }
    }

  </style>  

  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/adminlte.min.css">

  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
  
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">
  
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->
  <link href="<?php echo base_url();?>assets/css/opensans.css" rel="stylesheet">

  <!-- Alertify -->
  <script src="<?php echo base_url();?>assets/alertify/alertify.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/alertify.core.css" />
  <link rel="stylesheet" href="<?php echo base_url();?>assets/alertify/alertify.custom.css" id="toggleCSS" />
