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
					<b>
						<font color="White">Daftar Arsip Holografi</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<table style="width: 20%;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="100%" class="filter">Bagian</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select class="select" id="f_bagian" onchange="filter()" style="width: 100%;">
												<option value="All">Pilih Bagian..</option>
												<?php foreach ($bagian->result_array() as $dt) { ?>
													<option><?php echo $dt['BAGIAN']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="data-table table-responsive"></div>

							<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success mt-4" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

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

// Load Dokumen
$(document).ready(function() {
	$(".select").select2();
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
		"order": [0, "asc"],
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
			title: 'Laporan Daftar Arsip Holografi'
		}],
		"colReorder": true
	});

	setTimeout(function() {
		data_table.columns.adjust().draw();
	}, 1000);
}

// Filter Data
function filter() {
	var bagian = $('#f_bagian').val();

	$('#btnProgress').click();
	$.ajax({
		data: {data: bagian},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/sistem/arsip_lap/filter" ?>',
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('.data-table').html(data);
				pagination();
			}, 500);
		}
	});
}

</script>