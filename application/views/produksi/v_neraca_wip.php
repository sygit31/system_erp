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
<style>.select2-container--open {z-index: 9999999;}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Neraca WIP</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body" style="font-size: 13px;">
				<div class="table-responsive">
					<table class="ml-3" style="width: 900px;">
						<thead>
							<tr align="center" style="line-height: 30px;">
								<th width="27.5%" colspan="2" class="filter">Periode Tanggal</th>
								<td></td>
								<th width="12.5%" class="filter">Desain</th>
								<td></td>
								<th width="12.5%" class="filter">Seri</th>
								<td></td>
								<th width="20%" class="filter">Proses</th>
								<td></td>
								<th width="27.5%" class="filter">KK</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
								<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
								<td></td>
								<td>
									<select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="fSeri" onchange="filter()" style="width: 100%;">
										<?php foreach ($seri->result_array() as $dt) { ?>
											<option selected><?php echo $dt['SERI']; ?></option>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="fProses" onchange="filter()" style="width: 100%;">
										<?php foreach ($proses->result_array() as $dt) { ?>
											<option><?php echo $dt['PROSES']; ?></option>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="fKk" onchange="filter()" style="width: 100%;">
										<option>All..</option>
										<?php foreach ($kk->result_array() as $dt) { ?>
											<option><?php echo $dt['KK']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="data-table table-responsive mt-2 p-2">
					<table id="data_table" class="table table-bordered table-striped" style="width: 750px;">
						<thead align="center">
							<tr>				
								<th>Tanggal</th>
								<th>Saldo Awal</th>
								<th>Penerimaan</th>
								<th>No. Mutasi</th>
								<th>No. KK</th>
								<th>Hasil Baik</th>
								<th>Reject/Waste</th>
								<th>Saldo Akhir</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>

				<div class="card-footer">								
					<button id="btn_excel" style="width: 120px;" type="button" class="btn btn-success mt-4 ml-1" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
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
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Menghitung..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
var data_table;

// Load Dokumen
$(document).ready(function() {
	$(".select").select2();
	$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
	filter();
});

// Filter Data
function filter() {
	var tgl1 = document.getElementById('fTgl1').value;
	var tgl2 = document.getElementById('fTgl2').value;
	var desain = document.getElementById('fDesain').value;
	var seri = document.getElementById('fSeri').value;
	var proses = document.getElementById('fProses').value;
	var kk = document.getElementById('fKk').value;
	var data = [tgl1, tgl2, desain, seri, proses, kk];

	$('#btnProgress').click();
	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/produksi/neraca_wip/filter" ?>',
		success: function(data) {
			data = JSON.parse(data);
			
			isi_table(data);
			setTimeout(function() {$('#btnOk').click();}, 500);			
		}
	});
}

// Isi Data Table
function isi_table(data) {
	var proses = $('#fProses').val();
	var dec = proses == 'Pita' ? '2' : '0';

	$('#data_table').DataTable().destroy();
	$('#data_table tbody tr').remove();

	var awal_masuk = desimal(data[0].AWAL_MASUK);
	var	awal_keluar = proses == 'Belah' ? desimal(data[0].AWAL_KELUAR)/2 : desimal(data[0].AWAL_KELUAR);
	var awal_reject = desimal(data[0].AWAL_REJECT);
	var saldo_awal = awal_masuk - awal_keluar - awal_reject;

	for (var i=0; i<data.length; i++) {
		kk = data[i].KK == null ? "" : data[i].KK.substring(0,data[i].KK.length-2);		
		mutasi = data[i].MUTASI == null ? "" : data[i].MUTASI.substring(0,data[i].MUTASI.length-2);		
		tgl = format_tgl(data[i].TGL);		
		masuk = desimal(data[i].MASUK);
		keluar = proses == 'Belah' ? desimal(data[i].KELUAR)/2 : desimal(data[i].KELUAR);
		reject = desimal(data[i].REJECT);
		saldo_akhir = saldo_awal + Number(masuk) - Number(keluar) - Number(reject);

		$('#data_table tbody').append('<tr><td align="center">'+tgl+'</td><td align="right">'+format_number(saldo_awal.toFixed(dec))+'</td><td align="right">'+format_number(masuk.toFixed(dec))+'</td><td align="center">'+mutasi+'</td><td align="center">'+kk+'</td><td align="right">'+format_number(keluar.toFixed(dec))+'</td><td align="right">'+format_number(reject.toFixed(dec))+'</td><td align="right">'+format_number(saldo_akhir.toFixed(dec))+'</td></tr>');
		saldo_awal = saldo_akhir;
	}
	isi_total(dec);
	pagination();
}

// Isi Data Total
function isi_total(dec) {
	var data_table = document.getElementById('data_table');
	var masuk = 0, keluar = 0, reject = 0;

	for (var i=1; i<data_table.rows.length; i++) {
		_masuk = angka(data_table.rows[i].cells[2].innerText);
		_keluar = angka(data_table.rows[i].cells[5].innerText);
		_reject = angka(data_table.rows[i].cells[6].innerText);
		masuk = masuk + Number(_masuk);
		keluar = keluar + Number(_keluar);
		reject = reject + Number(_reject);
	}

	$('#data_table tbody').append('<tr><td></td><td></td><td align="right"><b>'+format_number(masuk.toFixed(2))+'</b></td><td></td><td></td><td align="right"><b>'+format_number(keluar.toFixed(2))+'</b></td><td align="right"><b>'+format_number(reject.toFixed(dec))+'</b></td><td></td></tr>');
}

// Ubah Format Tanggal
function format_tgl(date) {
	var tgl = date.substring(4, 6);
	var month = parseInt(date.substring(2, 4)) - 1;
	var thn = date.substring(0, 2);
	var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];

	return tgl + '-' + bln[month] + '-' + thn;
}

// Pagination
function pagination() {
	$('#data_table').DataTable().destroy();
	data_table = $('#data_table').DataTable({
		"paging": false,
		"order": false,
		"lengthChange": false,
		"searching": false,
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {
				columns: ':visible'
			},
			className: 'invisible excel',
			title: 'Laporan Neraca WIP PET'
		}],
		"colReorder": true
	});

	setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
}

// Expands & Collapse Card Info
var info_1 = 0;
$('.info_1:eq(0)').on('click', function() {
	if (info_1 == 0) {
		$('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
		info_1 = 1;
	} else {
		$('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
		info_1 = 0;
	}
});

</script>