

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

<div id="non_printable" class="content-wrapper" style="display: block;">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Data Histori Akses Aplikasi</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<table style="width: 50%; margin-bottom: 10px;">
							<thead>
								<tr align="center" style="line-height: 30px;">
									<td width="50%" colspan="2" class="filter">Filter Tanggal</td>
									<td></td>
									<td width="50%" class="filter">Nama Karyawan</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input id="fTgl1" type="text" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
									<td><input id="fTgl2" type="text" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
									<td></td>
									<td><input type="text" class="cari" id="cari" autocomplete="off" onkeyup="filter()" placeholder="Cari nama karyawan.." style="width: 100%;"></td>
								</tr>
							</tbody>
						</table>

						<?php $this->load->view('administrator/v_log_table'); ?>

					</div>
				</div>
			</div>
			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
		</div>
	</section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
	$( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' }); // Date Picker
	pagination();
});

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	$('#data-table').DataTable( {
		"paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": false,
        "order": [[ 1, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Filter Tabel
function filter() {
	let tgl1 = document.getElementById('fTgl1').value;
	let tgl2 = document.getElementById('fTgl2').value;
	let cari = document.getElementById('cari').value;
	let arrData = [tgl1, tgl2, cari];

	$.ajax({
		data: {data: arrData},
		type: 'POST',
		url: '<?php echo base_url()."index.php/administrator/log/filter_log" ?>',
		success: function(data) {
			$('.data-table').html(data);
			pagination();
		}
	});
}

</script>