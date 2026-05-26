</head>

  <?php
    //session_start();
    if(!isset($_SESSION['logERP'])){
      //die("Anda belum login");
      header("location:". base_url());
    }
  ?> 
  

<body class="hold-transition sidebar-mini">

<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand border-bottom navbar-dark bg-info">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i id="hide_sidebar" class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo base_url();?>index.php/dashboard" class="nav-link"><b>Home</b></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <?php $CRE = explode('|',$_SESSION['logERP']); ?>
        <a href="#" class="nav-link"><span class="blink1"><?php echo $CRE[1];?></span></blink></a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">|</a>
      </li>
      <li class="nav-item" id="li_akun">
        <a href="<?php echo site_url('akun'); ?>" class="nav-link">Akun</a>
      </li>
      <li class="nav-item" id="li_akun_separator">
        <a href="#" class="nav-link">|</a>
      </li>
      <li class="nav-item">
        <a href="<?php echo site_url('login/logout'); ?>" class="nav-link">Logout</a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->



