<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>
	.select2-container--open {
		z-index: 9999999;
	}
</style>

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White">Laporan Monitoring KK</font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<?php $this->load->view('produksi/v_lap_pet_table'); ?>

							<button id="btn_excel" style="width: 120px;" type="button" class="btn btn-success mt-4 ml-1" title="Export to Excel"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
							<button style="width: 120px;" type="button" onclick="cetak()" class="btn btn-danger mt-4" title="Export to Excel"><i class="fa fa-print mr-2"></i><b>Print</b></button>
						</font>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<font color="Green" size="2">ERP @2019</font>
			</div>
		</div>

	</section>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Cetak Data -->
<div id="printable" style="display: none; overflow-y: hidden;">
	<div>
		<img src="<?php echo base_url();?>assets/images/logo_pnp.png" class="img-responsive img-thumbnail" style="width: 150px; margin-top: 0mm; position: absolute; border: none;">
	</div>
	<h5 style="text-align: center; margin-top: 2mm;" id="judul_1">Laporan Monitoring KK</h5>
	<table id="data_header" class="mb-1" width="100%">
		<tr>
			<td width="10%">No. KK</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="10%">Oplah</td>
			<td width="5%">:</td>
			<td width="20%"></td>
		</tr>
		<tr>
			<td>Seri</td>
			<td>:</td>
			<td></td>
			<td>Realisasi</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td></td>
			<td>Deltime</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>

	<table id="data-table1" class="data-print" style="width:100%; border: 1px solid blue;">
		<thead align="center">
			<tr>
				<th colspan="2">Gudang</th>
				<th colspan="4">Emboss</th>
				<th colspan="2">Metalize</th>
				<th colspan="2">Coating Sensitize</th>
				<th colspan="2">Coating Readible</th>
				<th colspan="2">Sliter Belah</th>
				<th colspan="2">Pita (36.5 cm)</th>
			</tr>
			<tr>
				<th>Tanggal</th>
				<th>Bon</th>
				<th>Hasil Baik</th>
				<th>Reject</th>
				<th>Selisih Teller</th>
				<th>PCH Terpakai</th>
				<th>Hasil Baik</th>
				<th>Waste</th>
				<th>Hasil Baik</th>
				<th>Waste</th>
				<th>Hasil Baik</th>
				<th>Waste</th>
				<th>Hasil Baik</th>
				<th>Waste</th>
				<th>Hasil Baik</th>
				<th>Waste</th>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot style="font-weight: bold;"><tr></tr><tr></tr></tfoot>
	</table>

	<div style="margin-top: 10px; margin-left: 50px;"></div>
	<table width="70%" style="line-height: 10px;">
		<tr>
			<td align="center">Kudus, <?php echo date('d-M-Y'); ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
		<tr style="height: 5px;"></tr>
		<tr>
			<td align="center">Disiapkan oleh,</td>
			<td></td>
			<td align="center">Mengetahui,</td>
			<td></td>
			<td></td>
			<td></td>
			<td align="center">Validator,</td>
		</tr>
		<tr style="height: 15mm;"></tr>
		<tr>
			<td align="center"><b>Admin Produksi</b></td>
			<td></td>
			<td align="center"><b>Kabag Produksi</b></td>
			<td></td>
			<td align="center"><b>Kabag PPIC</b></td>
			<td></td>
			<td align="center"><b>Ulil Albab A.</b></td>
		</tr>
	</table>
</div>

<style>
	@media print {
		@page {
			size: landscape
		}

		body {
			font-size: 12px;
			padding-top: 0mm;
			height: 100%;
			margin-left: 0cm;
			margin-right: 2.5cm;
		}
	}

	.data-print td,
	.data-print th {
		border: 1px solid #408080;
	}

	.data-print tbody td,
	.data-print tfoot td {
		padding-right: 8px;
	}
</style>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Custom JS -->
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
	$(document).ready(function() {
		$('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});
		pagination();
	});

// Export To Excel
	function XLExport(tableId) {
		var tab_text = "<table border='1px'><tr>";
		var tab = document.getElementById(tableId);
		for (j=0; j<tab.rows.length; j++) {
			tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
		}

		tab_text = tab_text + "</table>";
		sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
		return (sa);
	}
	$('#btn_excel').click(function() {
		$('#data-table').DataTable().destroy();
		XLExport('data-table');
		pagination();
	});

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		$('#data-table').DataTable({
			"paging": false,
			"order": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"colReorder": true
		});
	}

// Isi Detail KK
	$('#kk').change(function() {
		var kk = $('#kk').val();

		$('#data-table').DataTable().destroy();
		$("#data-table tbody").find("tr").remove();
		$("#data-table tfoot td").remove();

		if (kk == '') {
			kosong();
			pagination();
			return;
		}

		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				data: {data: kk},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/lap_pet/info_kk" ?>',
				success: function(data) {

					data = JSON.parse(data);			
					data_kk = data[0];
					data_roll = data[1];

					$('#judul').html('Monitoring Kartu Kerja Mesin TA ' + data_kk.DESAIN); 
					$('#seri').val(data_kk.SERI);
					$('#oplah').val(formatNumber(data_kk.OPLAH));
					$('#tanggal').val(data_kk.TANGGAL);
					$('#realisasi').val(formatNumber(data_kk.REALISASI));
					$('#deltime').val(data_kk.DELTIME);

					isi_tabel(data_roll);

					setTimeout(function() {
						$('#btnOk').click();
						pagination();
					}, 500);
				}
			});
		}, 500);
	});

// Format Nomor
	function formatNumber(num) {
		if (num == 0) {
			return '';
		} else {
			return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
		}
	}

// Format Date :
	function format_date(num) {
		var date = num.substring(0, 2);
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var month = dt_month[parseInt(num.substring(3, 5)) - 1];
		var year = num.substring(6, 10);

		return date + '-' + month + '-' + year;
	}

// Kosong Isian
	function kosong() {
		$('#desain').val('');
		$('#seri').val('');
		$('#oplah').val('');
		$('#tanggal').val('');
		$('#deltime').val('');
		$('#judul').html('Monitoring Kartu Kerja Mesin'); 
	}

// Isi Tabel Laporan
	function isi_tabel(data_roll) {
		var seri = $('#seri').val();
		var tgl = [];
		var total_bon = 0, total_emboss = 0, total_reject = 0, total_teller = 0, total_pch = 0, total_met_baik = 0, total_met_waste = 0, total_sensi_baik = 0, total_sensi_waste = 0, total_readible_baik = 0, total_readible_waste = 0, total_belah_baik = 0, total_belah_waste = 0, total_pita = 0, total_reject_pita = 0;

		if (seri == 'SERI I') {
			lebar_pita = 0.7;
		}else if (seri == 'MMEA') {
			lebar_pita = 0.6;
		}else{
			lebar_pita = 0.5;	
		}

		for (var i=0; i<data_roll.length; i++) {
			tanggal = data_roll[i].TGL;
			bon = data_roll[i].BON;
			hasil_emboss = data_roll[i].HASIL_EMBOSS;
			reject = data_roll[i].REJECT;
			teller = data_roll[i].TELLER;
			met_baik = data_roll[i].MET_BAIK;;
			met_waste = data_roll[i].MET_WASTE;
			sensi_baik = data_roll[i].SENSI_BAIK;
			sensi_waste = data_roll[i].SENSI_WASTE;
			readible_baik = data_roll[i].READIBLE_BAIK;
			readible_waste = data_roll[i].READIBLE_WASTE;
			belah_baik = desimal(data_roll[i].BELAH_BAIK);
			belah_waste = desimal(data_roll[i].BELAH_WASTE);
			hasil_pita = (desimal(data_roll[i].HASIL_PITA) * lebar_pita / 36.5).toFixed(2);
			reject_pita = desimal(data_roll[i].REJECT_PITA);
			pch = data_roll[i].QTY_PCH;

			$("#data-table tbody").append('<tr><td align="center">' + tanggal + '</td><td align="right">' + formatNumber(bon) + '</td><td align="right">' + formatNumber(hasil_emboss) + '</td><td align="right">' + formatNumber(reject) + '</td><td align="right">' + formatNumber(teller) + '</td><td align="center">' + formatNumber(pch) + '</td><td align="right">' + formatNumber(met_baik) + '</td><td align="right">' + formatNumber(met_waste) + '</td><td align="right">' + formatNumber(sensi_baik) + '</td><td align="right">' + formatNumber(sensi_waste) + '</td><td align="right">' + formatNumber(readible_baik) + '</td><td align="right">' + formatNumber(readible_waste) + '</td><td align="right">' + formatNumber(belah_baik) + '</td><td align="right">' + formatNumber(belah_waste) + '</td><td align="right">' + formatNumber(hasil_pita) + '</td><td align="right">' + formatNumber(reject_pita.toFixed(2)) + '</td></tr>');

			total_bon = Number(bon) + total_bon;
			total_emboss = Number(hasil_emboss) + total_emboss;
			total_reject = Number(reject) + total_reject;
			total_teller = Number(teller) + total_teller;
			total_pch = Number(pch) + total_pch;
			total_met_baik = Number(met_baik) + total_met_baik;
			total_met_waste = Number(met_waste) + total_met_waste;
			total_sensi_baik = Number(sensi_baik) + total_sensi_baik;
			total_sensi_waste = Number(sensi_waste) + total_sensi_waste;
			total_readible_baik = Number(readible_baik) + total_readible_baik;
			total_readible_waste = Number(readible_waste) + total_readible_waste;
			total_belah_baik = Number(belah_baik) + total_belah_baik;
			total_belah_waste = Number(belah_waste) + total_belah_waste;
			total_pita = total_pita + Number(hasil_pita);
			total_reject_pita = total_reject_pita + Number(reject_pita);
		}

		$("#data-table tfoot tr:eq(0)").append('<td>Total</td><td>' + formatNumber(total_bon) + '</td><td>' + formatNumber(total_emboss) + '</td><td>' + formatNumber(total_reject) + '</td><td>' + formatNumber(total_teller) + '</td><td>' + formatNumber(total_pch) + '</td><td>' + formatNumber(total_met_baik) + '</td><td>' + formatNumber(total_met_waste) + '</td><td>' + formatNumber(total_sensi_baik) + '</td><td>' + formatNumber(total_sensi_waste) + '</td><td>' + formatNumber(total_readible_baik) + '</td><td>' + formatNumber(total_readible_waste) + '</td><td>' + formatNumber(total_belah_baik) + '</td><td>' + formatNumber(total_belah_waste) + '</td><td>' + formatNumber(total_pita.toFixed(0)) + '</td><td>' + formatNumber(total_reject_pita.toFixed(0)) + '</td>');


		total_met_waste = total_met_baik == 0 ? '0.0' : (total_met_waste / total_met_baik * 100).toFixed(1);
		total_sensi_waste = total_sensi_baik == 0 ? '0.0' : (total_sensi_waste / total_sensi_baik * 100).toFixed(1);
		total_readible_waste = total_readible_baik == 0 ? '0.0' : (total_readible_waste / total_readible_baik * 100).toFixed(1);
		total_belah_waste = total_belah_baik == 0 ? '0.0' : (total_belah_waste / total_belah_baik * 100).toFixed(1);
		total_reject_pita = total_pita == 0 ? '0.0' : (total_reject_pita / total_pita * 100).toFixed(1);
		$("#data-table tfoot tr:eq(1)").append('<td>% Waste</td><td></td><td></td><td></td><td></td><td></td><td></td><td>' + total_met_waste + '</td><td></td><td>' + total_sensi_waste + '</td><td></td><td>' + total_readible_waste + '</td><td></td><td>' + total_belah_waste + '</td><td></td><td>' + total_reject_pita + '</td>');

		$('#data-table tfoot tr:eq(0) td:gt(0), #data-table tfoot tr:eq(1) td:gt(0)').css({'text-align': 'right'});
	}

// Cetak Laporan
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data_header = document.getElementById('data_header');

		$('#data-table').DataTable().destroy();
		$('#judul_1').html($('#judul').html()); 
		data_header.rows[0].cells[2].innerHTML = $('#kk').val();
		data_header.rows[0].cells[5].innerHTML = $('#oplah').val();
		data_header.rows[1].cells[2].innerHTML = $('#seri').val();
		data_header.rows[1].cells[5].innerHTML = $('#realisasi').val();
		data_header.rows[2].cells[2].innerHTML = $('#tanggal').val();
		data_header.rows[2].cells[5].innerHTML = $('#deltime').val();

		$('#data-table1 tbody')[0].innerHTML = $('#data-table tbody')[0].innerHTML;
		$('#data-table1 tfoot')[0].innerHTML = $('#data-table tfoot')[0].innerHTML;
		$('#data-table1 tr').css({'height': '10px'});

		printable.style.display = "";
		non_printable.style.display = "none";
		window.print();

		printable.style.display = "none";
		non_printable.style.display = "";
		pagination();
	}

</script>