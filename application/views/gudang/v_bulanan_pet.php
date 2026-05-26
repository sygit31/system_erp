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

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White">Laporan Bulanan PET</font></b>
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
							<div class="table-responsive">
								<table style="width: 150px; margin-bottom: 10px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<td width="30%" class="filter">Desain</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<select class="select" id="f_desain" onchange="filter()" style="width: 100%;">
													<?php foreach ($desain->result_array() as $dt) { ?>
														<option><?php echo $dt['DESAIN']; ?></option>
													<?php } ?>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="tbl mb-4">
								<table id="tbl" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr align="center">
											<th rowspan="2">No.</th>
											<th rowspan="2" width="10%">Bulan</th>
											<th rowspan="2">Saldo Awal</th>
											<th colspan="2">Penerimaan</th>
											<th colspan="5">Pengeluaran</th>
											<th colspan="2">Reject</th>
											<th rowspan="2">Saldo Akhir</th>
										</tr>
										<tr align="center">
											<th>LPB</th>
											<th>Retur Prod.</th>
											<th>Proof</th>
											<th>Seri I</th>
											<th>Seri II</th>
											<th>Seri III</th>
											<th>MMEA</th>
											<th>Ex. Bahan</th>
											<th style="border-right: 1px solid #D8D7D7;">Ex. Produksi</th>
										</tr>
									</thead>
									<tbody align="right"></tbody>
									<tfoot>
										<tr style="font-weight: bold; text-align: center;">
											<td colspan="3">Total</td>
										</tr>
									</tfoot>
								</table>
							</div>

							<div class="table-responsive card card-footer p-4">
								<div style="width: 300px;">
									<button id="btn_excel" style="width: 130px;" type="button" class="btn btn-success mr-1" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
									<button style="width: 130px;" type="button" onclick="cetak()" class="btn btn-danger" title="Export to Excel"><i class="fa fa-print m-2"></i><b>Print</b></button>
								</div>
							</div>
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
			<div class="modal-body" style="font-size: 36px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Menghitung..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none;">
	<div style="width: 200px;">
		<h6 align="center">PT. Pura Nusapersada</h6>
		<h6 align="center">Kudus</h6>
	</div>

	<h6 id="judul" align="center">KARTU STOCK BULANAN FOIL (TA 2022)</h6>
	<h6 id="periode" align="center">PERIODE : OKT-21 S/D OKT-22</h6>

	<table id="tbl_print" class="data-print mt-4" width="100%"></table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-top: -10px; margin-bottom: 10px;"></div>

	<div style="height: 10mm;"></div>
	<table id="tbl_sign" width="100%" style="margin-left: 50px; text-align: center;">
		<tbody>
			<tr>
				<td width="50%"><b>Admin Gudang,</b></td>
				<td width="50%"><b>Kabid Gudang,</b></td>
			</tr>
			<tr style="height: 50px;"></tr>
			<tr>
				<td style="font-weight: bold; text-decoration: underline;">Jasmini</td>
				<td style="font-weight: bold; text-decoration: underline;">M. Taufiq</td>
			</tr>
		</tbody>
	</table>
</div>

<style>
	@media print {
		@page {
			size: legal landscape;
		}

		html, body {
			width: 330mm;
			height: 210mm;
		}
	}

	.data-print td,
	.data-print th {
		border: 1px solid #408080;
		line-height:  20px;
		padding: 5px;
	}
</style>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		filter();
	});

// Pagination
	function pagination() {
		$('#tbl').DataTable().destroy();
		data_table = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"colReorder": true,
			"columnDefs": [{"orderable": false,"targets": "_all"}],
			"order": []
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 500);
	}

	function filter() {
		var desain = $("#f_desain").val();

		$('#btnProgress').click();
		$('#tbl').DataTable().destroy();
		$("#tbl tbody").find("tr").remove();
		setTimeout(function() {
			$.ajax({
				async: false,
				data: {data: desain},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/gudang/Bulanan_pet/filter" ?>',
				success: function(data) {
					data = JSON.parse(data);

					s_awal = 0, t_masuk = 0, t_retur = 0, t_0 = 0, t_1 = 0, t_2 = 0, t_3 = 0, t_4 = 0, t_bahan = 0, t_reject = 0;
					for (var i=0; i<data.length; i++) {
						masuk_awal = data[i].MASUK_AWAL == null ? 0 : data[i].MASUK_AWAL;
						keluar_awal = data[i].KELUAR_AWAL == null ? 0 : data[i].KELUAR_AWAL;
						retur_awal = data[i].RETUR_AWAL == null ? 0 : data[i].RETUR_AWAL;
						reject_awal = data[i].REJECT_AWAL == null ? 0 : data[i].REJECT_AWAL;
						masuk = data[i].MASUK == null ? 0 : data[i].MASUK;
						keluar1 = data[i].KELUAR1 == null ? 0 : data[i].KELUAR1;
						keluar2 = data[i].KELUAR2 == null ? 0 : data[i].KELUAR2;
						keluar3 = data[i].KELUAR3 == null ? 0 : data[i].KELUAR3;
						keluar4 = data[i].KELUAR4 == null ? 0 : data[i].KELUAR4;
						keluar0 = 0;
						ex_bahan = 0;
						retur = data[i].RETUR == null ? 0 : data[i].RETUR;
						reject = data[i].REJECT == null ? 0 : data[i].REJECT;

						if (i == 0 ) {s_awal = Number(masuk_awal) - Number(keluar_awal) + Number(retur_awal) - Number(reject_awal);}

						s_akhir = s_awal + Number(masuk) - Number(keluar1) - Number(keluar2) - Number(keluar3) - Number(keluar4) + Number(retur) - Number(reject);

						t_masuk = t_masuk + Number(masuk);
						t_retur = t_retur + Number(retur);
						t_0 = t_0 + Number(keluar0);
						t_1 = t_1 + Number(keluar1);
						t_2 = t_2 + Number(keluar2);
						t_3 = t_3 + Number(keluar3);
						t_4 = t_4 + Number(keluar4);
						t_bahan = t_bahan + Number(ex_bahan);
						t_reject = t_reject + Number(reject);

						$('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+data[i].BULAN+'</td><td>'+format_number(s_awal)+'</td><td>'+format_number(masuk)+'</td><td>'+format_number(retur)+'</td><td>'+format_number(keluar0)+'</td><td>'+format_number(keluar1)+'</td><td>'+format_number(keluar2)+'</td><td>'+format_number(keluar3)+'</td><td>'+format_number(keluar4)+'</td><td>'+format_number(ex_bahan)+'</td><td>'+format_number(reject)+'</td><td>'+format_number(s_akhir)+'</td></tr>');
						s_awal = s_akhir;
					}
					$('#tbl tfoot td:gt(0)').remove();
					$('#tbl tfoot tr:eq(0)').append('<td>'+format_number(t_masuk)+'</td><td>'+format_number(t_retur)+'</td><td>'+format_number(t_0)+'</td><td>'+format_number(t_1)+'</td><td>'+format_number(t_2)+'</td><td>'+format_number(t_3)+'</td><td>'+format_number(t_4)+'</td><td>'+format_number(t_bahan)+'</td><td>'+format_number(t_reject)+'</td><td></td>');

					setTimeout(function() {
						pagination();
						$('#btnOk').click();
					}, 500);
				}
			});
		}, 500);
	}

// Cetak Laporan
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data_header = document.getElementById('data_header');
		var desain = $('#f_desain').val();
		var qty_data = $('#tbl tbody tr').length + 2;
		var per_1 = $('#tbl tr:eq(3) td:eq(1)').html().toUpperCase();
		var per_2 = $('#tbl tr:eq('+qty_data+') td:eq(1)').html().toUpperCase();

		$('#judul').html('KARTU STOCK BULANAN FOIL (TA ' + desain + ')');
		$('#periode').html('PERIODE : ' + per_1 + ' S/D ' + per_2);

		$('#tbl').DataTable().destroy();
		$('#tbl_print').html($('#tbl').html());

		printable.style.display = "";
		non_printable.style.display = "none";
		pagination();
		window.print();

		printable.style.display = "none";
		non_printable.style.display = "";
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
		$('#tbl').DataTable().destroy();
		XLExport('tbl');
		pagination();
	});

</script>