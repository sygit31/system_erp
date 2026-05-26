<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Data Historiss</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/historis.jpg">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ionicons.min.css">
  <link href="<?php echo base_url();?>assets/css/opensans.css" rel="stylesheet">

  <style>.menu:hover {background-color: #FDAC5E;  cursor: pointer;}</style>
</head> 

<body class="bg-dark">
    <div class="wrapper">
        <?php $this->load->view('dashboard/header'); ?>
        <?php $this->load->view('dashboard/footer'); ?>
        <?php $this->load->view('it/v_historis_topbar'); ?>

        <div class="card lighten-2 text-center z-depth-2 bg-dark" style="height: 90vh; overflow: hidden;">
            <div class="card-body">
                <img src="<?php echo base_url();?>assets/images/bank_data.jpg" id="file_jpg" class="img-responsive img-thumbnail" style="width: 100%; margin-top: -100px; clip-path: inset(100px 0 0 0);">
            </div>
        </div>
    </div>
</body>
</html>