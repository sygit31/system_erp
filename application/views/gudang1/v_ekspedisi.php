

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
					<b><font color="White"><div id="headerinput">Ekspedisi Kertas Banderoll</div></font></b>
				</h3>
			</div>
			<div class="card-body">
				<table style="width: 50%; margin-bottom: 10px;">
					<tr align="center" style="line-height: 30px;">
						<td colspan="2" width="60%" class="filter">Tanggal</td>
						<td></td>
						<td width="20%" class="filter">Ukuran</td>
						<td></td>
						<td width="20%" class="filter">No. IPB</td>
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
							<select id="ukuran" onchange="filter()" style="cursor: pointer; width: 100%;">
								<option>52.5 Cm</option>
								<option>73 Cm</option>
							</select>
						</td>
						<td></td>						
						<td>
							<input type="text" id="no_ipb" style="width: 100%; height: 30px;"></td>
						</td>
					</tr>
				</table>
				<button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="cetak()" style="margin: 0; width: 100px;">Print</button>

				<font size="2" class="data-table" id="content">
					<?php $this->load->view('gudang/v_ekspedisi_table'); ?>
				</font>
			</div>
		</div>
	</section>
</div>

<!-- Print -->
<div id="printable"	style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px; display: none;">
	<table class="header-table" width="100%">
		<tr>
			<td colspan="3" align="center" style="font-size: 1.7em; line-height: 50px;">Data Mutasi Kertas Ke Stamping</td>
		</tr>			
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td width="86.1%"><input type="text" id="tgl_print" readonly></td>
		</tr>
		<tr>
			<td>No. IPB</td>
			<td>:</td>
			<td><input type="text" id="ipb_print"></td>
		</tr>
	</table>
	<font size="2" class="data-table" id="content-print">
		<?php $this->load->view('gudang/v_ekspedisi_table'); ?>
	</font>
</div>

<script>

	// Load Datepicker Plugin
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });	

	// Print Tabel
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var table_non_print = document.getElementsByClassName('table_non_print')[1];
		var table_print = document.getElementsByClassName('table_print')[1];

		document.getElementById('tgl_print').value = document.getElementById('tgl2').value;
		document.getElementById('ipb_print').value = document.getElementById('no_ipb').value;

		non_printable.style.display = "none";
		printable.style.display = "";
		table_non_print.style.display = "none";
		table_print.style.display = "";
		window.print();

		non_printable.style.display = "";
		printable.style.display = "none";
		table_non_print.style.display = "";
		table_print.style.display = "none";
	}

	// Filter Tabel
	function filter() {		
		var tgl1 = document.getElementById('tgl1').value;
		var tgl2 = document.getElementById('tgl2').value;
		var ukuran = document.getElementById('ukuran').value;
		arrData = [tgl1, tgl2, ukuran];

		var content = document.getElementById('content');
		var content_print = document.getElementById('content-print');

		$.ajax({
			data: {data: arrData},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/gudang/filter_ekspedisi_kertas" ?>',
			success: function(data) {
				$('.data-table').html(data);
				content_print.innerHTML = content.innerHTML;
			}
		});
	}

</script>