
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

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Setup Operator Mesin</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus info_1"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Kode Flow</th>
								<td width="60%">
									<select class="select" id="kode_flow" style="width: 100%;">
										<?php foreach ($kode_flow->result_array() as $dt) { ?>
											<option selected><?php echo $dt['KODE']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Proses</th>
								<td>
									<select class="select" id="proses" style="width: 100%;">
										<option value="">Pilih..</option>
										<?php foreach ($proses->result_array() as $dt) { ?>
											<option><?php echo $dt['PROSES']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Mesin</th>
								<td>
									<select class="select" id="mesin" style="width: 100%;">
										<option value="">Pilih..</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6"> 
						<table width="100%">
							<tr>
								<th width="40%">Desain</th>
								<td width="60%">
									<select class="select" id="desain" style="width: 100%;">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option selected><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Shift</th>
								<td>
									<select class="select" id="shift" style="width: 100%;">
										<option value="">Pilih..</option>
										<option>A</option>
										<option>B</option>
										<option>C</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Operator</th>
								<td>
									<select class="select" id="operator" style="width: 100%;">
										<option value="">Pilih..</option>
										<?php foreach ($operator->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
				<div class="card-footer mt-4">
					<table>
						<tr>
							<td width="150"><button type="button" class="btn btn-block btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
							<td width="10"></td>
							<td width="150"><button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
						</tr>
					</table>
				</div>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Data Operator Mesin</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 14px; overflow-y: hidden;">
							<table style="width: 400px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="35%" class="filter">Desain</th>
										<th></th>
										<th width="65%" class="filter">Proses</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select class="select" id="f_desain" onchange="filter()" style="width: 100%; text-align: center;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option selected><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_proses" onchange="filter()" style="width: 100%; text-align: center;">
												<option>All..</option>
												<?php foreach ($proses->result_array() as $dt) { ?>
													<option><?php echo $dt['PROSES']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 14px;">
							<div class="data-table m-3"></div>
						</div>

						<div class="card-footer">
							<table>
								<tr>
									<td width="150"><button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
								</tr>
							</table>
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

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
var id_edit = '';

// Load Dokumen
$(document).ready(function() {	
	$(".select").select2();
	$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
	filter();
});

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	var data_table = $('#data-table').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"info": false,
		"order": [1, "asc"],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'invisible excel',
			filename: 'Data Operator Mesin',
			title: ''
		}],
		"colReorder": true
	});

	setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
}

// Filter Data
function filter() {
	var desain = $('#f_desain').val();
	var proses = $('#f_proses').val();
	var data = [desain, proses];

	$('#btnProgress').click();
	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/produksi/setup_operator/filter" ?>',
		success: function(data) {
			$('.data-table').html(data);
			setTimeout(function() {
				$('#btnOk').click();
				pagination();
			}, 500);
		}
	});
}

// Kosong Isian
function kosong() {
	$('#proses').val('').change();
	$('#mesin').val('').change();
	$('#shift').val('').change();
	$('#operator').val('').change();
	id_edit = '';
}

// Isi Data Mesin
$('#proses').on('change', function() {
	var proses = document.getElementById('proses').value;

	$("#mesin").empty();
	$("#mesin").append('<option value="">Pilih..</option>');
	$('#mesin').val('').change();
	$.ajax({
		async: false,
		data: {data: proses},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/produksi/setup_operator/mesin" ?>',
		success: function(data) {
			data = JSON.parse(data);

			for (var i=0; i<data.length; i++) {
				$("#mesin").append('<option>'+data[i].NAMA_MESIN+'</option>');
			}
		}
	});	
});

// Tampilkan error isian
function error_isian(str) {
	$('#keterangan_isian').html(str);
	$('#btnIsian').click();
	throw new Error("Isian salah..");
}

// Simpan Data
function simpan() {
	var desain = $('#desain').val();
	var proses = $('#proses').val();
	var mesin = $('#mesin').val();
	var shift = $('#shift').val();
	var id_operator = $('#operator').val();
	var data = [id_edit, desain, proses, mesin, shift, id_operator];
	
	if (proses == '') {error_isian('Proses belum diisi..');}
	if (mesin == '') {error_isian('Nama Mesin belum diisi..');}
	if (shift == '') {error_isian('Shift belum diisi..');}
	if (id_operator == '') {error_isian('Operator belum diisi..');}

	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/setup_operator/simpan',
		data: {data: data},
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('#btnSukses').click();
				kosong();
				filter();
			}, 500);
		}
	});
}

// Edit Data
function edit(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	id_edit = data_table.rows[row].cells[0].innerHTML;

	$.ajax({
		async: false,
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/setup_operator/edit',
		data: {data: id_edit},
		success: function(data) {
			data = JSON.parse(data);

			$('#desain').val(data.DESAIN).change();
			$('#proses').val(data.PROSES).change();
			$('#shift').val(data.SHIFT).change();
			$('#operator').val(data.ID_OPERATOR).change();
			$('#mesin').val(data.NAMA_MESIN).change();
		}
	});
	$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
}

// Notifikasi Hapus Data
function hapus(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	var id = data_table.rows[row].cells[0].innerHTML;

	$('#btnHapus').click();
	$('#btnYa').on('click', function() {
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/setup_operator/batal',
			data: {data: id},
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					filter();
					id = '';
				}, 500);
			}
		});
	});

	$('#btnNo').on('click', function() {
		if (id == '') {return;}
		id = '';
	});
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
var info_2 = 0;
$('.info_2:eq(0)').on('click', function() {
	if (info_2 == 0) {
		$('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
		info_2 = 1;
	} else {
		$('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
		info_2 = 0;
	}
});

</script>