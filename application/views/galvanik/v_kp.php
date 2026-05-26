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

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Monitoring Kartu Perintah</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body" style="font-size: 14px;">
						<div class="table-responsive ml-2">
							<table style="width: 850px; margin-bottom: 10px; font-size: 13px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<td width="30%" colspan="2" class="filter">Filter Tanggal</td>
										<td></td>
										<td width="15%" class="filter">Desain</td>
										<td></td>
										<td width="15%" class="filter">Tipe</td>
										<td></td>
										<td width="15%" class="filter">Tahap</td>
										<td></td>
										<td width="25%" class="filter">Nomor KP</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
										<td><input id="fTgl2" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
												<?php foreach ($tahun->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fTipe" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>All</option>
												<option>Produksi</option>
												<option>Proof</option>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fMaster" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option>All</option>
												<option>PCH</option>
												<option>Silver</option>
												<option>Matrix</option>
												<option>Madle</option>
											</select>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari nomor KP.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="data-table"></div>

						<div class="card-footer">
							<button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success ml-2" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
						</div>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
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

<script>

// Load Dokumen
$(document).ready(function() {
	$(".select").select2(); // Combo Live Search
	$(".datepicker").datepicker({
		dateFormat: 'dd-M-yy'
	});
	filter();
});

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	var data_table = $('#data-table').DataTable({
		"paging": false,
		"ordering": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'invisible excel',
			title: 'Laporan Kartu Perintah'
		}],
		"colReorder": true
	});

	setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
}

function filter() {
	var kd_unit = <?php echo json_encode($kd_unit); ?>;
	var tgl1 = document.getElementById('fTgl1').value;
	var tgl2 = document.getElementById('fTgl2').value;
	var cari = document.getElementById('cari').value;
	var desain = document.getElementById('fDesain').value;
	var tipe = document.getElementById('fTipe').value;
	var master = document.getElementById('fMaster').value;
	var data = [tgl1, tgl2, kd_unit, cari, desain, tipe, master];

	$('#btnProgress').click();
	setTimeout(function() {
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/galvanik/kp/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);

				setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
			}
		});
	}, 300);
}

</script>