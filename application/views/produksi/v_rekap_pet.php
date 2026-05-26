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

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Rekap IPB PET</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="card-body">
								<table style="width: 150px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<th class="filter bg-info">Desain</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<select class="select" id="f_desain" onchange="filter()" style="width: 100%;">
													<option>2021</option>
													<option>2022</option>
													<option>2023</option>
													<option>2024</option>
													<option selected>2025</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="card-body data_table">
								<table id="data_table" class="table table-bordered table-striped" style="width: 100%;">
									<thead align="center">
										<tr>
											<th rowspan="2">No.</th>
											<th rowspan="2">Bulan</th>
											<th colspan="4">Seri</th>
											<th rowspan="2">Jumlah</th>
										</tr>
										<tr>
											<th>I</th>
											<th>II</th>
											<th>III</th>
											<th>MMEA</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<tr>
											<td align="center" colspan="2"><b>Total</b></td>
											<td class="text-right font-weight-bold"></td>
											<td class="text-right font-weight-bold"></td>
											<td class="text-right font-weight-bold"></td>
											<td class="text-right font-weight-bold"></td>
											<td class="text-right font-weight-bold"></td>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button id="btn_excel" style="width: 120px;" type="button" class="btn btn-success ml-1" title="Export to Excel"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
						<button style="width: 120px;" type="button" onclick="cetak()" class="btn btn-danger" title="Export to Excel"><i class="fa fa-print mr-2"></i><b>Print</b></button>
					</div>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none;">
	<h4 id="judul" class="text-center mb-4">REKAPAN IPB PET TA 2022</h4>
	<div class="data_table" style="font-size: 18px;"></div>

	<div style="height: 5mm;"></div>
	<div style="font-size: 18px;">Kudus, <?php echo date('d F Y'); ?></div>
	<table style="width: 600px; font-size: 18px;" id="p_foot">
		<tr style="height: 10mm;">
			<td width="25%">Hormat kami,</td>
			<td width="21%"></td>
			<td width="19%">Mengetahui,</td>
		</tr>
		<tr style="height: 15mm;"></tr>
		<tr>
			<td style="text-decoration: underline; font-weight: bold;">Rita Purwati</td>
			<td></td>
			<td style="text-decoration: underline; font-weight: bold;">Sugito</td>
		</tr>
	</table>
</div>

<style>
	@media print {
		body {font-size: 14px; padding-top: 5mm; height: 100%;}
	}

	.data-print td,
	.data-print th {border: 1px solid #408080; padding-right: 8px; line-height:  12px;}
</style>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
	$(".select").select2();
	$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
	filter();
});

// Pagination
function pagination() {	
	$('#data_table').DataTable().destroy();
	var data_table = $('#data_table').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"info": false,
		"order": [0, "asc"],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "350px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'invisible excel',
			filename: 'Rekap IPB PET',
			title: ''
		}],
		"colReorder": true,
		"order": [],
		"columnDefs": [{"orderable": false, "targets": "_all"},{width: 50, targets: 0},{width: 100, targets: 1},{width: 100, targets: 2},{width: 100, targets: 3},{width: 100, targets: 4},{width: 100, targets: 5},{width: 100, targets: 6}]
	});

	setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
}

// Export To Excel
function XLExport(tableId) {
	var tab_text = "<table border='1px'><tr>";
	var tab = document.getElementById(tableId);
	for (j=0; j<tab.rows.length; j++) {
		tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
	}

	tab_text = tab_text + "</table>";
	tab_text = tab_text.replace("#E3E3E3", "#000000");
	sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
	return (sa);
}
$('#btn_excel').click(function() {
	$('#data_table').DataTable().destroy();
	XLExport('data_table');
	pagination();
});

// Filter Data
function filter() {
	var desain = $('#f_desain').val();

	$('#data_table').DataTable().destroy();
	$("#data_table tbody").find("tr").remove();
	$('#btnProgress').click();
	$.ajax({
		data: {data: desain},
		type: 'POST',
		url: '<?php echo base_url()."index.php/produksi/rekap_pet/filter" ?>',
		success: function(data) {
			data = JSON.parse(data);
			periode = data[0];
			data = data[1];
			t_p1 = 0, t_p2 = 0, t_p3 = 0, t_p4 = 0, t_tot = 0;

			for (var i=0; i<periode.length; i++) {
				urut = i+1;
				bln = periode[i].PERIODE;
				p_seri1 = 0, p_seri2 = 0, p_seri3 = 0, p_seri4 = 0;

				for (var j=0; j<4; j++) {
					seri = $('#data_table thead tr:eq(1) th:eq('+j+')').html();
					seri = j == 3 ? seri : 'SERI ' + seri;

					for (var k=0; k<data.length; k++) {
						t_bln = data[k].BLN;
						t_seri = data[k].SERI;
						t_panjang = Number(data[k].QTY);

						if (bln == t_bln && seri == t_seri) {
							if (j == 0) {p_seri1 = p_seri1 + t_panjang; t_p1 = t_p1 + p_seri1;}
							if (j == 1) {p_seri2 = p_seri2 + t_panjang; t_p2 = t_p2 + p_seri2;}
							if (j == 2) {p_seri3 = p_seri3 + t_panjang; t_p3 = t_p3 + p_seri3;}
							if (j == 3) {p_seri4 = p_seri4 + t_panjang; t_p4 = t_p4 + p_seri4;}
						}
					}

				}

				total = p_seri1 + p_seri2 + p_seri3 + p_seri4;
				t_tot = t_tot + total;
				$('#data_table tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+bln+'</td><td align="right">'+format_number(p_seri1)+'</td><td align="right">'+format_number(p_seri2)+'</td><td align="right">'+format_number(p_seri3)+'</td><td align="right">'+format_number(p_seri4)+'</td><td align="right"><b>'+format_number(total)+'</b></td></tr>');
			}
			$('#data_table tfoot tr:eq(0) td:eq(1)').html(format_number(t_p1));
			$('#data_table tfoot tr:eq(0) td:eq(2)').html(format_number(t_p2));
			$('#data_table tfoot tr:eq(0) td:eq(3)').html(format_number(t_p3));
			$('#data_table tfoot tr:eq(0) td:eq(4)').html(format_number(t_p4));
			$('#data_table tfoot tr:eq(0) td:eq(5)').html(format_number(t_tot));

			setTimeout(function() {
				$('#btnOk').click();
				pagination();
			}, 500);
		}
	});
}

// Cetak Laporan
function cetak() {
	var printable = document.getElementById('printable');
	var non_printable = document.getElementById('non_printable');
	var data_header = document.getElementById('data_header');
	var desain = $('#f_desain').val();

	$('#judul').html('REKAPAN IPB PET TA ' + desain);
	$('#data_table').DataTable().destroy();
	$('#data_table').removeClass('table-bordered table-striped').addClass('data-print');
	$('.data_table')[1].innerHTML = $('.data_table')[0].innerHTML;

	printable.style.display = "";
	non_printable.style.display = "none";
	window.print();

	$('#data_table').removeClass('data-print').addClass('table table-bordered table-striped');
	pagination();

	printable.style.display = "none";
	non_printable.style.display = "";
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