<!DOCTYPE html>
<html lang="en" >

	<head>
	  	<meta charset="UTF-8">
	  	<title>Profit's Holo</title>
		<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/images/profits-1.png">
	  
	  	<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/dist/css/adminlte.min.css">

	  
	    <style>
	      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
	      /*@import url(https://fonts.googleapis.com/css?family=Exo:100,200,400);*/
		/*@import url(https://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);*/

			body{
				margin: 0;
				padding: 0;
				background: #fff;

				color: #fff;
				font-family: Arial;
				font-size: 12px;
			}

			.body{
				position: absolute;
				top: -20px;
				left: -20px;
				right: -40px;
				bottom: -40px;
				width: auto;
				height: auto;
				background-image: url('<?php echo base_url(); ?>assets/images/login3-1.jpg');
				background-size: cover;
				/*-webkit-filter: blur(5px);*/
				-webkit-filter: blur(0px);
				z-index: 0;
			}

			.grad{
				position: absolute;
				top: -20px;
				left: -20px;
				right: -40px;
				bottom: -40px;
				width: auto;
				height: auto;
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
				z-index: 1;
				opacity: 0.7;
			}

			.header{
				position: absolute;
				/*top: calc(50% - 35px);*/
				top: calc(50% - 55px);
				left: calc(52% - 255px);
				/*left: calc(35% - 225px);*/
				z-index: 2;
			}

			.header div{
				float: left;
				color: #fff;
				font-family: 'Exo', sans-serif;
				font-size: 35px;
				font-weight: 200;
			}

			.header div span{
				/*color: #5379fa !important;*/
				color: Green !important;
			}

			.login{
				position: absolute;
				top: calc(50% - 75px);
				left: calc(50% - 50px);
				height: 150px;
				width: 350px;
				padding: 10px;
				z-index: 2;
			}

			.login input[type=text]{
				width: 250px;
				height: 30px;
				background: transparent;
				border: 1px solid rgba(255,255,255,0.6);
				border-radius: 2px;
				color: #fff;
				font-family: 'Exo', sans-serif;
				font-size: 16px;
				font-weight: 400;
				padding: 4px;
			}

			.login input[type=password]{
				width: 250px;
				height: 30px;
				background: transparent;
				border: 1px solid rgba(255,255,255,0.6);
				border-radius: 2px;
				color: #fff;
				font-family: 'Exo', sans-serif;
				font-size: 16px;
				font-weight: 400;
				padding: 4px;
				margin-top: 10px;
			}

			.login input[type=button]{
				width: 260px;
				height: 35px;
				background: #fff;
				border: 1px solid #fff;
				cursor: pointer;
				border-radius: 2px;
				color: #a18d6c;
				font-family: 'Exo', sans-serif;
				font-size: 16px;
				font-weight: 400;
				padding: 6px;
				margin-top: 10px;
			}

			.login input[type=button]:hover{
				opacity: 0.8;
			}

			.login input[type=button]:active{
				opacity: 0.6;
			}

			.login input[type=text]:focus{
				outline: none;
				border: 1px solid rgba(255,255,255,0.9);
			}

			.login input[type=password]:focus{
				outline: none;
				border: 1px solid rgba(255,255,255,0.9);
			}

			.login input[type=button]:focus{
				outline: none;
			}

			::-webkit-input-placeholder{
			   color: rgba(255,255,255,0.6);
			}

			::-moz-input-placeholder{
			   color: rgba(255,255,255,0.6);
			}

		    blink, .blink {
			    animation: blinker 3s linear infinite;
		    }
		    @keyframes blinker {  
			    50% { opacity: 0; }
		    }

		    blinks, .blinks {
			    animation: blinkers 2.5s linear infinite;
		    }
		    @keyframes blinkers {  
			    50% { opacity: 0; }
		    }

	    </style>

	    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script> -->

	</head>

	<body>
		<?php
		  	//session_start();
		  	if(isset($_SESSION['logERP'])){
			    //die("Anda belum login");
			    header("location:". base_url()."index.php/dashboard");
		  	}
		?> 

	  	<div class="body"></div>
			<div class="grad"></div>
			<div class="header">
				<!-- <div><blink><font style="color: Red"><b><strong>PNP</strong></b></font></blink><blinks><span>Holografi &nbsp &nbsp &nbsp</span></blinks></div> -->
				<div><blink>&nbsp &nbsp &nbsp<img src="<?php echo base_url(); ?>assets/images/profits-1-kecil.png"><br /><b><strong><font color="white">PROFIT'S</font></strong></b></blink></div>
				<!-- <div><blink>&nbsp &nbsp &nbsp<img src="<?php //echo base_url(); ?>assets/images/profit_kecil.png"></blink></div> -->
			</div>
			<br>
			<div class="login">
		        <form action="<?php echo site_url('login/cek_login'); ?>" method="post" autocomplete="off">
					<table>
						<tr>
							<td><input type="text" placeholder="username" name="username" required><br></td>
						</tr>
						<tr>
							<td><input type="password" placeholder="password" name="password" required><br></td>
						</tr>
						<tr height="10"></tr>
						<tr>
							<td><button type="submit" class="btn btn-block btn-primary">Login</button></td>
						</tr>
					</table>
		        </form>
			</div>
	  	<!-- <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->

	</body>

	<script>
		document.getElementsByName('username')[0].focus();
	</script>

</html>
