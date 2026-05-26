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
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Stok PET</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Gudang - Manual Book Persediaan PET.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool" onclose="isi_produk()" data-toggle="modal" data-target="#modal_produk"><i class="fa fa-wrench" title="Nama Produk"></i></button>
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<div class="table-responsive">
								<table style="width: 400px; margin-bottom: 10px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<td width="65%" colspan="2" class="filter">Periode</td>
											<td></td>
											<td width="35%" class="filter">Desain</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="fTgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" autocompvare="off" readonly></td>
											<td><input id="fTgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y'); ?>" onchange="filter()" autocompvare="off" readonly></td>
											<td></td>
											<td>
												<select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
													<?php foreach ($desain->result_array() as $dt) { ?>
														<option><?php echo $dt['DESAIN']; ?></option>
													<?php } ?>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="data-table mb-4">
								<table id="data-table" class="table table-bordered table-striped" width="100%">
									<thead>
										<tr align="center">
											<th rowspan="3" hidden></th>
											<th rowspan="3" width="100/14%">Tanggal</th>
											<th rowspan="3" width="100/14%">Saldo Awal</th>
											<th colspan="4">Penerimaan</th>
											<th colspan="7">Pengeluaran</th>
											<th rowspan="3" width="100/14%">Saldo Akhir</th>
										</tr>
										<tr align="center">
											<th colspan="2">Supplier</th>
											<th colspan="2">Produksi</th>
											<th colspan="5">Produksi</th>
											<th colspan="2">Reject</th>
										</tr>
										<tr align="center">
											<th width="100/14%">SP</th>
											<th width="100/14%">Meter</th>
											<th width="100/14%">BA</th>
											<th width="100/14%">Meter</th>
											<th width="100/14%">IPB</th>
											<th width="100/14%">Seri I</th>
											<th width="100/14%">Seri II</th>
											<th width="100/14%">Seri III</th>
											<th width="100/14%">MMEA</th>
											<th width="100/14%">SP</th>
											<th width="100/14%">Meter</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>

							<button id="btn_excel" style="width: 120px;" type="button" class="btn btn-success ml-1" title="Export to Excel"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
							<button style="width: 120px;" type="button" onclick="cetak()" class="btn btn-danger" title="Export to Excel"><i class="fa fa-print mr-2"></i><b>Print</b></button>

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

<!-- Modal Produk di Laporan PET -->
<div class="modal fade" id="modal_produk">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="mb-2"><b>Daftar Material</b></div>
				<select class="form-control select" id="operator" multiple="multiple" style="width: 100%; cursor: pointer;">
					<?php foreach ($material->result_array() as $dt) { ?>
						<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="modal-footer rounded">
				<button style="width: 150px;" type="button" class="btn btn-info" title="Simpan Data" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
				<button style="width: 150px;" type="button" class="btn btn-danger" title="Keluar" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Kembali</b></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none;">
	<div><b>KARTU PERSEDIAN BARANG</b></div>
	<table id="data_header" width="100%">
		<tr>
			<td width="5%">Desain</td>
			<td width="2%">:</td>
			<td width="50%"></td>
		</tr>
		<tr>
			<td>Periode</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>

	<div class="data-table"></div>

	<div style="height: 5mm;"></div>
	<table id="tbl_sign" width="100%" style="margin-left: 50px; text-align: center;">
		<tbody>
			<tr>
				<td width="50%"><b>Hormat kami,</b></td>
				<td width="50%"><b>Mengetahui,</b></td>
			</tr>
			<tr style="height: 30px;"></tr>
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
			size: legal landscape
		}

		body {
			font-size: 14px;
			padding-top: 5mm;
			height: 100%;
		}
	}

	.data-print td,
	.data-print th {
		border: 1px solid #408080;
		padding-right: 8px;
		line-height:  12px;
	}
</style>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
	var data_table;

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
		$('#data-table').DataTable().destroy();
		XLExport('data-table');
		pagination();
	});

// Load Dokumen
	$(document).ready(function() {
		$('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy',minDate: new Date('<?php echo date('Y-m-d', strtotime('01/01/2020')); ?>')});

		setTimeout(function() {filter();}, 500);
	});

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		data_table = $('#data-table').DataTable({
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
	$('.fa-bars:eq(0)').click(function() {
		if (data_table != undefined) {
			setTimeout(function() {data_table.columns.adjust().draw();}, 700);
		}
	});

	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var desain = document.getElementById("fDesain").value;
		var data = [tgl1, tgl2, desain];

		$('#btnProgress').click();
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/gudang/pet/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				setTimeout(function() {
					tgl = data[0];
					saldo_awal = data[1];
					saldo_masuk = data[2];
					saldo_keluar = data[3];
					masuk = data[4];
					keluar = data[5];
					retur_produksi = data[6];
					retur_suppplier = data[7];

					isi_tgl(tgl);
					isi_saldo_awal(saldo_awal,saldo_masuk,saldo_keluar);
					isi_masuk(masuk);
					isi_keluar(keluar);
					isi_saldo_akhir();
					isi_retur_produksi(retur_produksi);
					isi_retur_suppplier(retur_suppplier);
					isi_total();
					pagination();

					$('#btnOk').click();
				}, 500);
			}
		});
	}

	function isi_tgl(tgl) {
		$('#data-table').DataTable().destroy();
		$("#data-table tbody").find("tr").remove();
		for (var i=0; i<tgl.length; i++) {
			$('#data-table tbody').append('<tr><td hidden>' + format_bln(tgl[i]) + '</td><td align="center">' + tgl[i] + '</td><td align="right"></td><td align="center"></td><td align="right"></td><td align="center"></td><td align="right"></td><td align="center"></td><td align="right"></td><td align="right"></td><td align="right"></td><td align="right"></td><td align="center"></td><td align="right"></td><td align="right"></td></tr>');
		}
	}

	function isi_saldo_awal(saldo_awal,saldo_masuk,saldo_keluar) {
		var data_table = document.getElementById('data-table');
		var qty_roll = saldo_awal[1] + saldo_masuk[1] - saldo_keluar[1];
		var qty_meter = saldo_awal[0] + saldo_masuk[0] - saldo_keluar[0];

		data_table.rows[3].cells[2].innerText = format_number(qty_meter);
	}

	function isi_masuk(masuk) {
		var data_table = document.getElementById('data-table');

		for (var i=3; i<data_table.rows.length; i++) {
			tgl = data_table.rows[i].cells[0].innerText;
			qty = 0, meter = 0, no_sp = '';

			for (var j=0; j<masuk.length; j++) {
				t_tgl = masuk[j].TGL_TERIMA;
				t_meter = masuk[j].QTY_TERIMA;

				if (t_tgl == tgl) {
					meter = meter + Number(t_meter);
					no_sp = masuk[j].SP == null ? '' : (masuk[j].SP).substr(0,(masuk[j].SP).length-2);
				}
			}

			data_table.rows[i].cells[3].innerText = no_sp;
			data_table.rows[i].cells[4].innerText = format_number(meter);
		}
	}

	function isi_keluar(keluar) {
		var data_table = document.getElementById('data-table');
		var seri_1 = data_table.rows[2].cells[5].innerText.toUpperCase();
		var seri_2 = data_table.rows[2].cells[6].innerText.toUpperCase();
		var seri_3 = data_table.rows[2].cells[7].innerText.toUpperCase();
		var seri_4 = data_table.rows[2].cells[8].innerText.toUpperCase();

		for (var i=3; i<data_table.rows.length; i++) {
			tgl = data_table.rows[i].cells[0].innerText;
			meter_1 = 0, meter_2 = 0, meter_3 = 0, meter_4 = 0;
			ipb = '';

			for (var j=0; j<keluar.length; j++) {
				t_seri = keluar[j].SERI;
				qty = keluar[j].QTY_TERIMA;
				t_tgl = keluar[j].TGL_KELUAR;

				if (t_tgl == tgl && t_seri == seri_1) {meter_1 = meter_1 + Number(qty); ipb = keluar[j].IPB;}
				if (t_tgl == tgl && t_seri == seri_2) {meter_2 = meter_2 + Number(qty); ipb = keluar[j].IPB;}
				if (t_tgl == tgl && t_seri == seri_3) {meter_3 = meter_3 + Number(qty); ipb = keluar[j].IPB;}
				if (t_tgl == tgl && t_seri == seri_4) {meter_4 = meter_4 + Number(qty); ipb = keluar[j].IPB;}
			}

			data_table.rows[i].cells[7].innerText = ipb == null ? '' : ipb.substring(0, ipb.length-2);
			data_table.rows[i].cells[8].innerText = format_number(meter_1);
			data_table.rows[i].cells[9].innerText = format_number(meter_2);
			data_table.rows[i].cells[10].innerText = format_number(meter_3);
			data_table.rows[i].cells[11].innerText = format_number(meter_4);
		}
	}

	function isi_saldo_akhir() {
		var data_table = document.getElementById('data-table');

		for (var i=3; i<data_table.rows.length; i++) {
			saldo_awal = data_table.rows[i].cells[2].innerText;
			masuk = data_table.rows[i].cells[4].innerText;
			keluar_1 = data_table.rows[i].cells[8].innerText;
			keluar_2 = data_table.rows[i].cells[9].innerText;
			keluar_3 = data_table.rows[i].cells[10].innerText;
			keluar_4 = data_table.rows[i].cells[11].innerText;
			saldo_akhir = angka(saldo_awal) + angka(masuk) - angka(keluar_1) - angka(keluar_2) - angka(keluar_3) - angka(keluar_4);
			data_table.rows[i].cells[14].innerText = format_number(saldo_akhir);

			if (i+1 < data_table.rows.length) {data_table.rows[i+1].cells[2].innerText = format_number(saldo_akhir);}
		}
	}

	function isi_retur_produksi(retur_produksi) {
		var data_table = document.getElementById('data-table');

		for (var i=3; i<data_table.rows.length; i++) {
			tgl = data_table.rows[i].cells[0].innerText;
			meter = 0, t_ba = '';

			for (var j=0; j<retur_produksi.length; j++) {
				t_tgl = retur_produksi[j].TGL;
				t_meter = retur_produksi[j].REJECT;

				if (t_tgl == tgl) {
					meter = meter + Number(t_meter);
					t_ba = (retur_produksi[j].NMR).substring(0, 3);
				}
			}

			data_table.rows[i].cells[5].innerText = t_ba;
			data_table.rows[i].cells[6].innerText = format_number(meter);
		}
	}

	function isi_retur_suppplier(retur_suppplier) {
		var data_table = document.getElementById('data-table');

		for (var i=3; i<data_table.rows.length; i++) {
			tgl = data_table.rows[i].cells[0].innerText;
			meter = 0, sp = '';

			for (var j=0; j<retur_suppplier.length; j++) {
				t_tgl = retur_suppplier[j].TGL;
				t_meter = retur_suppplier[j].QTY;

				if (t_tgl == tgl) {
					meter = meter + Number(t_meter);
					sp = retur_suppplier[j].NMR
				}
			}

			data_table.rows[i].cells[12].innerText = sp;
			data_table.rows[i].cells[13].innerText = format_number(meter);
		}
	}

	function isi_total() {
		var data_table = document.getElementById('data-table');
		var meter_masuk = 0, meter_retur = 0, meter_seri_1 = 0, meter_seri_2 = 0, meter_seri_3 = 0, meter_seri_4 = 0, meter_reject = 0;

		for (var i=3; i<data_table.rows.length; i++) {
			t_meter = angka(data_table.rows[i].cells[4].innerText);
			meter_masuk = meter_masuk + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[6].innerText);
			meter_retur = meter_retur + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[8].innerText);
			meter_seri_1 = meter_seri_1 + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[9].innerText);
			meter_seri_2 = meter_seri_2 + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[10].innerText);
			meter_seri_3 = meter_seri_3 + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[11].innerText);
			meter_seri_4 = meter_seri_4 + Number(t_meter);

			t_meter = angka(data_table.rows[i].cells[13].innerText);
			meter_reject = meter_reject + Number(t_meter);
		}

		$('#data-table tbody').append('<tr><td hidden></td><td align="center"></td><td align="right"></td><td align="right"></td><td align="right"><b>'+format_number(meter_masuk)+'</b></td><td></td><td align="right"><b>'+format_number(meter_retur)+'</b></td><td></td><td align="right"><b>'+format_number(meter_seri_1)+'</b></td><td align="right"><b>'+format_number(meter_seri_2)+'</b></td><td align="right"><b>'+format_number(meter_seri_3)+'</b><td align="right"><b>'+format_number(meter_seri_4)+'</b></td><td></td><td align="right"><b>'+format_number(meter_reject)+'</b></td><td></td></tr>');
	}

	function format_bln(num) {
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var tgl = num.substring(0,2);
		var bln = num.substring(3,6);
		var bln = format_text(dt_month.indexOf(bln) + 1, 2);
		var thn = num.substring(9,11);

		return thn + bln + tgl;
	}

// Cetak Laporan
	function cetak() {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data_header = document.getElementById('data_header');

		data_header.rows[0].cells[2].innerHTML = '<b>' + $('#fDesain').val() + '</b>';
		data_header.rows[1].cells[2].innerHTML = '<b>' + $('#fTgl1').val() + '</b>' + ' sd ' + '<b>' + $('#fTgl2').val() + '</b>';

		$('#data-table').DataTable().destroy();

		$('#data-table').removeClass('table table-bordered table-striped').addClass('data-print');
		$('.data-table')[1].innerHTML = $('.data-table')[0].innerHTML;

		printable.style.display = "";
		non_printable.style.display = "none";
		window.print();

		$('#data-table').removeClass('data-print').addClass('table table-bordered table-striped');
		pagination();

		printable.style.display = "none";
		non_printable.style.display = "";
	}
</script>