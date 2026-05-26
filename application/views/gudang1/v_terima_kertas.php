

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/style_gudang.css' ?>">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url().'assets/js/jquery-1.12.4.js' ?>"></script>
<script src="<?php echo base_url().'assets/js/jquery-ui.js' ?>"></script>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Penerimaan Kertas Banderoll</div></font></b>
				</h3>
			</div>
			<div class="card-body">
				<table style="width: 70%; margin-bottom: 10px;">
					<tr align="center" style="line-height: 30px;">
						<td colspan="2" width="40%" class="filter">Tanggal</td>
						<td></td>
						<td width="25%" class="filter">No. Truk</td>
						<td></td>
						<td width="35%" class="filter">NPK - Roll</td>
					</tr>
					<tr>
						<td>
							<input type="text" class="datepicker" id="tgl1" onchange="filter()" value="<?php echo date('d-M-Y'); ?>" placeholder="Tanggal Awal" autocomplete="off" readonly style="width: 100%;">
						</td>
						<td>
							<input type="text" class="datepicker" id="tgl2" onchange="filter()" value="<?php echo date('d-M-Y'); ?>" placeholder="Tanggal Akhir" autocomplete="off" readonly style="width: 100%;">
						</td>
						<td></td>						
						<td>
							<input type="text" id="no_truk" onkeyup="filter()" style="width: 100%;"></td>
						</td>
						<td></td>						
						<td>
							<input type="text" id="cari" onkeyup="filter()" style="width: 100%; height: 30px;" placeholder="NPK atau Code Roll.."></td>
						</td>
					</tr>
				</table>
				<button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="cetak()" style="margin: 0; width: 100px;">Print</button>

				<font size="2">
					<?php $this->load->view('gudang/v_terima_kertas_table'); ?>
				</font>
			</div>
		</div>
	</section>
</div>

<div id="printable"	style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px; display: none;">
	<table width="100%">
		<tr>
			<td colspan="3" align="center" style="font-size: 1.5em; line-height: 30px;">Bukti Pemeriksaan Dan Pengecekan Timbang Ulang <br> Kertas Banderol 60 Gsm Pada Saat Bongkar</td>
		</tr>			
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td width="86.1%"><input type="text" id="print_tgl"></td>
		</tr>
		<tr>
			<td>No. Truk</td>
			<td>:</td>
			<td><input type="text" id="print_truk"></td>
		</tr>
	</table>
	<div class="content">
		<?php $this->load->view('gudang/v_terima_kertas_table'); ?>
	</div>
	<p align="right" style="font-size: 12px;">F-SMT-G2-001 Rev.0</p>
	<table style="text-align: center; margin: auto;">
		<tr>
			<td>Ditimbang,</td>
			<td width="60%"></td>
			<td>Menyetujui,</td>
		</tr>
		<tr>
			<td style="height: 60px;"></td>
		</tr>
		<tr>
			<td>( Petugas PNP )</td>
			<td></td>
			<td>( Petugas PTKP )</td>
		</tr>
	</table>
</div>

<script>

	// Load Datepicker Plugin
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });

	// Print Tabel
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		
		printable.style.display = "";
		non_printable.style.display = "none";
		window.print();

		printable.style.display = "none";
		non_printable.style.display = "";
	}

	// Filter Tabel
	function filter() {		
		var tgl1 = document.getElementById('tgl1').value;
		var tgl2 = document.getElementById('tgl2').value;
		var cari = document.getElementById('cari').value;
		arrData = [tgl1, tgl2, cari];

		$.ajax({
			data: {data: arrData},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/gudang/filter_terima_kertas" ?>',
			success: function(data) {
				$('.data-table').html(data);
			}
		});

		// Isi Header Print 
		document.getElementById('print_tgl').value = tgl2;
		document.getElementById('print_truk').value = document.getElementById('no_truk').value;
	}

</script>