<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Data Penggunaan Master</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mb-3">
							<table style="width: 650px; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<td width="40%" colspan="2" class="filter">Tanggal Proses</td>
										<td></td>
										<td width="40%" class="filter">Nama Produk</td>
										<td></td>
										<td width="20%" class="filter">Desain</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-1 year')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fProduk" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>All</option>
												<?php foreach ($produk->result_array() as $dt) { ?>
													<option><?php echo $dt['NAMA']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option selected><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="data-table"></div>
						
					</div>

					<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success m-3" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
				</div>
			</div>

			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>

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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Sukses Simpan -->
<div class="modal fade" id="modal_sukses" style="z-index: 9999;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
			<div class="modal-footer">
				<button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Bon Galvanik -->
<div class="modal fade" id="modal_bon">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header">
					<div id="judul" style="font-size: 28px; font-weight: bold;"> Tanggal Bon Galvanik </div>
				</div>
				<div class="card-body">
					<table width="100%">
						<tr>
							<td width="40%" style="font-weight: bold;">Tanggal</td>
							<td width="60%"><input id="tgl" type="text" class="form-control datepicker bg-white" value="<?php echo date('d-M-Y'); ?>" style="cursor: pointer;" readonly></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button id="ya_simpan" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>Simpan</b></button>
					<button style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>Batal</b></button>
					<button id="btnBon" data-toggle="modal" data-target="#modal_bon" hidden></button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>

<script>

// Define Variable
var id_galv_proses = '';

// Load Dokumen
$(document).ready(function() {
	$(".select").select2(); // Combo Live Search
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
	filter();
});

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	$('#data-table').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"order": [[1, "asc"]],
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'excel invisible',
			title: 'Data Penggunaan Master'
		}]
	});
}

// Filter Data
function filter() {
	var tgl1 = document.getElementById('fTgl1').value;
	var tgl2 = document.getElementById('fTgl2').value;
	var produk = document.getElementById('fProduk').value;
	var desain = document.getElementById('fDesain').value;
	var data = [tgl1, tgl2, produk, desain];

	$('#btnProgress').click();
	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/galvanik/master/filter" ?>',
		success: function(data) {
			setTimeout(function() {$('#btnOk').click();}, 500);
			
			$('.data-table').html(data);
			pagination();
		}
	}); 
}

// Proses Bon Galvanik
function bon(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	
	id_galv_proses = data_table.rows[row].cells[0].innerHTML;
	$('#judul').html('Tanggal Bon Galvanik');
	$('#btnBon').click();
}

// Proses Kembali Galvanik
function kembali(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	
	id_galv_proses = data_table.rows[row].cells[0].innerHTML;	
	$('#judul').html('Tanggal Kembali Master');
	$('#btnBon').click();
}

// Simpan Tanggal
$('#ya_simpan').click(function() {
	var judul = $('#judul').html();
	var tgl = $('#tgl').val();
	var menu = judul == 'Tanggal Bon Galvanik' ? 'Bon' : 'Kembali';
	var data = [menu, tgl, id_galv_proses];

	$('#btnProgress').click();
	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/galvanik/master/simpan" ?>',
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('#btnSukses').click();
				filter();
			}, 500);
		}
	}); 
});

</script>