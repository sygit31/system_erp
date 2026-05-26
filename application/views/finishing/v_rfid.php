

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
					<b><font color="White">Cetak Label Barcode (RFID)</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 14px; overflow-y: hidden;">
							<table style="width: 600px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="75%" colspan="2" class="filter">Label Number</th>
										<td></td>
										<th width="25%" class="filter">Kode Pengawas</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_number1" type="number" class="form-control text-center" placeholder="Start Label Number"></td>
										<td><input id="f_number2" type="number" class="form-control text-center" placeholder="End Label Number"></td>
										<td></td>
										<td>
											<select class="select" id="f_pengawas" style="width: 100%;">
												<option value="">Pilih Pengawas..</option>
												<?php foreach ($pengawas->result_array() as $dt) { ?>
													<option><?php echo $dt['KODE_PENGAWAS']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card-footer">
							<table>
								<tr>
									<td width="150"><button type="button" onclick="filter()" class="btn btn-block btn-info" title="View Data" style="width: 150px;"><i class="fa fa-send-o m-2"></i><b>View</b></button></td>
									<td width="10"></td>
									<td width="150"><button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
								</tr>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 14px;">
							<div class="data-table m-3"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
		</div>
	</section>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="salah_isian" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
			<div class="modal-footer">
				<button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
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

// Load Dokumen
$(document).ready(function() {
	$(".select").select2();
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
});

// Pagination
function pagination() {
	var tbl_data = document.getElementById('data-table');
	var qty_data = tbl_data.rows.length;
	var filename = '';

	if (qty_data > 1) {
		var seri = tbl_data.rows[1].cells[1].innerHTML;
		var tgl = tbl_data.rows[1].cells[3].innerHTML;
		var currentdate = new Date(); 
		var time = ("0"+currentdate.getHours()).slice(-2) + "." + ("0"+currentdate.getMinutes()).slice(-2) + "."  + ("0"+currentdate.getSeconds()).slice(-2);
		filename = 'S' + seri + '  ' + tgl + '  ' + time;
	}

	$('#data-table').DataTable().destroy();
	var data_table = $('#data-table').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"info": false,
		"order": [0, "asc"],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"dom": 'frtipB',
		"buttons": [{
			extend: 'excel',
			exportOptions: {
				columns: [ 1, 2, 3, 4 ]
			},
			className: 'invisible excel',
			filename: filename,
			title: ''
		}],
		"colReorder": true
	});

	setTimeout(function() {
		data_table.columns.adjust().draw();
	}, 1000);
}

// Tampilkan error isian
function error_isian(str) {
	$('#keterangan_isian').html(str);
	$('#btnIsian').click();
	throw new Error("Error isian!");
}

// Filter Data
function filter() {
	var number1 = document.getElementById('f_number1').value;
	var number2 = document.getElementById('f_number2').value;
	var pengawas = document.getElementById('f_pengawas').value;
	var data = [number1, number2, pengawas];

	if (number1 == '') {error_isian('Nomor Label Awal belum diisi..');}
	if (number2 == '') {error_isian('Nomor Label Akhir belum diisi..');}
	if (number1.length != 10) {error_isian('Nomor Label Awal salah..');}
	if (number2.length != 10) {error_isian('Nomor Label Akhir salah..');}
	if (number1 > number2) {error_isian('Nomor Akhir harus lebih besar dari Nomor Awal..');}	
	if (pengawas == '') {error_isian('Kode Pengawas belum diisi..');}

	$('#btnProgress').click();
	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/finishing/Rfid/filter" ?>',
		success: function(data) {
			setTimeout(function() {
				$('.data-table').html(data);
				pagination();

				$('#btnOk').click();
			}, 500);			
		}
	}); 
}

</script>