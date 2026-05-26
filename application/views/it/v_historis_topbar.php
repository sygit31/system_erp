<style>.menu:hover {background-color: #FDAC5E;  cursor: pointer;}</style><style>.menu:hover {background-color: #FDAC5E;  cursor: pointer;}</style>
<div class="text-white" style="background-color: #FC942F;">
	<nav class="navbar navbar-expand">
		<ul class="navbar-nav">
			<li class="nav-item d-none d-sm-inline-block"><font size="5">
				<img class="img-circle" style="width: 5vh;" src="<?php echo base_url();?>assets\images\historis.jpg">
				<b class="ml-2">Data Historis Holografi</b></font>
			</li>
		</ul>
		
		<ul class="navbar-nav ml-auto">
			<li class="nav-item menu" title="Upload File" style="border-radius: 50px; width: 110px; height: 30px; line-height: 30px;" onclick="window.open('<?php echo site_url('it/data/show_data'); ?>', '_self');">
				<i class="ion-aperture m-2 h5 p-1"></i><b>Upload</b>
			</li>
			<li class="nav-item menu" title="Kategori File" style="border-radius: 50px; width: 110px; height: 30px; line-height: 30px;" onclick="window.open('<?php echo site_url('it/data/show_kategori'); ?>', '_self');" <?php if($_SESSION['akses'] == '1') {echo 'hidden';} ?>>
				<i class="ion-clipboard m-2 h5 p-1"></i><b>Master</b>
			</li>
			<li class="nav-item menu" title="Bantuan" style="border-radius: 50px; width: 110px; height: 30px; line-height: 30px;"  onclick="window.open('http://192.168.17.42/profits/assets/help/IT - Manual Book Data Historis.pdf')">
				<i class="ion-help m-2 h5 p-1"></i><b>Help</b>
			</li>
			<li class="nav-item menu" title="Keluar Aplikasi" style="border-radius: 50px; width: 110px; height: 30px; line-height: 30px;" onclick="window.open('<?php echo base_url();?>index.php/dashboard', '_self');">
				<i class="ion-log-out m-2 h5 p-1"></i><b>Close</b>
			</li>
		</ul>
	</nav>
	<nav class="navbar navbar-expand">
	</nav>
</div>

<script>
	
// Load Dokumen
	$(document).ready(function() {
		resize();
	});

// Resize Page
	$(window).resize(function(){
		resize();
	});

// Change Background
	function resize() {
		var screen_width = window.innerWidth;

		if (screen_width > 768) {
			$('.navbar-expand:eq(1)').hide();
			$('.navbar-nav:eq(1)').appendTo('.navbar-expand:eq(0)');
		}else{
			$('.navbar-expand:eq(1)').show();
			$('.navbar-nav:eq(1)').appendTo('.navbar-expand:eq(1)');
		}
	}

</script>