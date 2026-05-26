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
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White">Monitoring Stok PCH (HPD)</font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body" style="font-size: 13px;">
						<div class="table-responsive">
							<table style="width: 250px; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<td width="50%" colspan="2" class="filter bg-danger">Periode</td>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" autocomplete="off" readonly></td>
										<td><input id="f_tgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y'); ?>" onchange="filter()" autocomplete="off" readonly></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="table-responsive">
							<table id="tbl" class="table table-bordered table-striped" width="100%">
								<thead>
									<tr align="center">
										<th>No</th>
										<th>Nama Barang</th>
										<th>Kode Master</th>
										<th>Saldo Awal</th>
										<th>Masuk</th>
										<th>Keluar</th>
										<th>Saldo Akhir</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
						<table>
							<tr>
								<td width="150"><button type="button" id="btn_excel" class="btn btn-block btn-success" title="Export to Excel"><i class="fa fa-clipboard m-1"></i><b>Excel</b></button></td>
							</tr>
						</table>
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
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;">
				<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
				<font style="position: relative; top: -30px;"><b>Menghitung..</b></font>
			</div>
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

<script>

// Load Dokumen
	$(document).ready(function() {
		var minDate = <?php echo json_encode(date('Y-m-d', strtotime('12/01/2022'))); ?>;

		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy', minDate: new Date(minDate)});
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		filter();
	});

// Pagination
	function pagination() {
		$('#tbl').DataTable().destroy();
		var data_table = $('#tbl').DataTable({
			"paging": false,
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
				exportOptions: {
					columns: ':visible'
				},
				className: 'excel invisible',
				title: 'Rekapitulasi Plat Cetak Hologram'
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 500);
	}

// Filter Data
	function filter() {
		var tgl1 = document.getElementById('f_tgl1').value;
		var tgl2 = document.getElementById('f_tgl2').value;
		var kd_unit = <?php echo json_encode($kd_unit); ?>;
		var data = [tgl1, tgl2, kd_unit];

		$('#btnProgress').click();
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/galvanik/pch/filter_hpd" ?>',
			success: function(data) {
				data = JSON.parse(data);

				urut = 0;
				for (var i=0; i<data.length; i++) {
					saldo_awal = Number(data[i].MASUK_AWAL) - Number(data[i].KELUAR_AWAL) + Number(data[i].ADDENDUM_AWAL);
					saldo_akhir = saldo_awal + Number(data[i].MASUK) - Number(data[i].KELUAR) + Number(data[i].ADDENDUM);
					if (saldo_akhir > 0) {
						urut++;
						$('#tbl tbody').append('<tr><td align="center">'+urut+'</td><td>'+data[i].NAMA.toUpperCase()+'</td><td align="center">'+data[i].KODE+'</td><td align="center">'+saldo_awal+'</td><td align="center">'+data[i].MASUK+'</td><td align="center">'+data[i].KELUAR+'</td><td align="center">'+saldo_akhir+'</td></tr>');
					}
				}

				setTimeout(function() {pagination(); $('#btnOk').click();}, 500);
			}
		});
	}

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
		$('#tbl').DataTable().destroy();
		XLExport('tbl');
		pagination();
	});

</script>