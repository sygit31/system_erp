<!DOCTYPE html>
<html lang="en">
<head>
  <title>SISTEM ERP</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/login/css/util.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/plus/login/css/main.css">
<!--===============================================================================================-->

  <style>
    blink, .blink {
    animation: blinker 2s linear infinite;
    }
    @keyframes blinker {  
    50% { opacity: 0; }
    }

  </style>
</head>

<?php
  //session_start();
  if(isset($_SESSION['logERP'])){
    //die("Anda belum login");
    header("location:". base_url()."index.php/dashboard");
  }
?> 

<body>
  
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="<?php echo site_url('login/cek_login'); ?>" method="post">
          <span class="login100-form-title">
            <span class="blink"><img src="<?php echo base_url(); ?>assets/plus/image/logo pnp small.PNG">
            <br>
            ERP &nbsp HOLOGRAFI</span>
          </span>

          <div class="wrap-input100 validate-input m-b-16" data-validate="Please enter username">
            <input class="input100" type="text" name="username" placeholder="Username">
            <span class="focus-input100"></span>
          </div>

          <div class="wrap-input100 validate-input" data-validate = "Please enter password">
            <input class="input100" type="password" name="password" placeholder="Password">
            <span class="focus-input100"></span>
          </div>
          <br>
          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn">
              Sign in
            </button>
          </div>
          <br>
        </form>
      </div>
    </div>
  </div>
  
  
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/plus/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/plus/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/plus/vendor/bootstrap/js/popper.js"></script>
  <script src="<?php echo base_url(); ?>assets/plus/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/plus/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="<?php echo base_url(); ?>assets/plus/login/js/main.js"></script>

</body>
</html>