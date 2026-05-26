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
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Rekonsiliasi Panjang PET</div></font></b>
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
				<div class="table-responsive" style="font-size: 13px; overflow: hidden;">
					<table style="width: 650px;">
						<thead>
							<tr align="center" style="line-height: 30px;">
								<th width="35%" colspan="2" class="filter bg-secondary">Periode Tanggal</th>
								<td></td>
								<th width="15%" class="filter bg-secondary">Desain</th>
								<td></td>
								<th width="25%" class="filter bg-secondary">Status</th>
								<td></td>
								<th width="25%" class="filter bg-secondary">Cari Kode</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
								<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
								<td></td>
								<td>
									<select class="select" id="f_desain" style="width: 100%;" onchange="filter()">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="f_status" onchange="filter()" style="width: 100%;">
										<option value="All">All..</option>	
										<option value="P" selected>IPB Emboss</option>	
										<option value="PR">Proses Emboss</option>	
										<option value="2" <?php if ($menu == 'gdg_rekon') {echo 'selected';} ?>>Selisih >25</option>	
										<option value="1">Selisih <=25</option>	
										<option value="0">Selisih 0</option>	
									</select>
								</td>
								<td></td>
								<td>
									<input type="text" id="f_kode" onchange="filter()" class="form-control" style="width: 100%;" placeholder="Kode roll.." autocomplete="off">
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="card-body">
				<div class="card card-body table-responsive">
					<div class="tbl" style="width: 100%; font-size: 13px;">
						<table id="tbl_excel" hidden><thead></thead></table>
						<table id="tbl" class="table table-bordered table-striped" width="100%">
							<thead class="bg-secondary">
								<tr style="text-align: center;">
									<th>No.</th>
									<th>Nama Bahan</th>
									<th>Tanggal <br> Terima</th>
									<th>Nomor SP</th>
									<th>Nomor PO</th>
									<th>Barcode <br> Awal</th>
									<th>Kode Roll</th>
									<th>Panjang Awal<br> (Indostamping)</th>
									<th>Panjang <br> (PNP)</th>
									<th>Selisih</th>
									<th>Panjang <br> (Dipakai)</th>
									<th hidden>Keterangan</th>
									<th>Barcode <br> (Dipakai)</th>
								</tr>
							</thead>
							<tbody></tbody>
							<tfoot style="font-weight: bold;">
								<td colspan="7"><input type="text" class="form-control text-center font-weight-bold" value="Total" readonly></td>
								<td><input type="text" class="form-control text-right font-weight-bold" readonly></td>
								<td><input type="text" class="form-control text-right font-weight-bold" readonly></td>
								<td><input type="text" class="form-control text-right font-weight-bold" readonly></td>
								<td><input type="text" class="form-control text-right font-weight-bold" readonly></td>
								<td hidden></td>
								<td></td>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer" <?php if ($menu != 'prod_rekon') {echo 'hidden';} ?>>
				<button id="btn_simpan" style="width: 120px;" type="button" class="btn btn-info ml-1 mt-2" title="Simpan Data"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
				<button id="btn_excel" style="width: 120px;" type="button" class="btn btn-warning ml-1 mt-2" title="Export Excel"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
				<button id="btn_print" style="width: 120px;" type="button" class="btn btn-success ml-1 mt-2" title="Cetak Data"><i class="fa fa-print mr-2"></i><b>Print</b></button>
				<button id="btn_edit" style="width: 120px;" type="button" class="btn btn-secondary ml-1 mt-2" title="Edit Data"><i class="fa fa-check-square-o mr-2"></i><b>Edit</b></button>
				<button onclick="kosong()" style="width: 120px;" type="button" class="btn btn-danger ml-1 mt-2" title="Batal Isian"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
			</div>
		</div>
	</section>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<h5><div class="modal-body text-info invisible" id="error_isian"></div></h5>
			<div class="modal-footer">
				<button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2" onclick="$('#error_isian').addClass('invisible')"></i><b>OK</b></button>
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

<div id="printable" style="display: none; overflow-y: hidden;">
	<div><img src="<?php echo base_url();?>assets/images/logo_pnp.png" class="img-responsive img-thumbnail" style="width: 150px; position: absolute; border: none;"></div>

	<div style="font-size: 20px; text-align: center;">Laporan Penerimaan PET dan Hasil Emboss</div>
	<div style="font-size: 14px; text-align: center;" id="periode">Periode</div>

	<div class="float-right">Toleransi +/- 25 meter</div>
	<table id="tbl_print" class="data-print mt-2 mb-2" width="100%"></table>

	<table width="70%" style="line-height: 10px;" hidden>
		<tr>
			<td width="20%" align="center">Kudus, <?php echo date('d-M-Y'); ?></td>
		</tr>
		<tr style="height: 5px;"></tr>
		<tr>
			<td align="center" colspan="5">Mengetahui,</td>
			<td></td>
			<td align="center">Menyetujui,</td>
		</tr>
		<tr style="height: 50px;"></tr>
		<tr>
			<td align="center"><b>Gudang</b></td>
			<td></td>
			<td align="center"><b>QC</b></td>
			<td></td>
			<td align="center"><b>Produksi</b></td>
			<td></td>
			<td align="center"><b>Indostamping</b></td>
		</tr>
	</table>
</div>

<style>
	@media print {
		@page {
			size: landscape
		}

		body {
			font-size: 12px;
			padding-top: 5mm;
			height: 100%;
			margin-left: 2.5cm;
			margin-right: 0.5cm;
		}
	}

	.data-print td,
	.data-print th {
		border: 1px solid #408080;
		padding-left: 8px;
		padding-right: 8px;
		white-space: nowrap;
	}
</style>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
	if ($(window).width() > 960) {$('.fa-bars:eq(0)').click();}
	$(".select").select2();
	$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
	filter();
	resize();
});

// Resize Page
$(window).resize(function(){
	resize();
});
function resize() {
	$('.tbl').css('width', window.innerWidth > 768 ? '100%' : '1400px');
}
$('body').on('mouseover', function() {
	if ($('#modal_progress').hasClass('show') == true) {$('#btnOk').click();}
});

// Pagination
function pagination() {	
	$('#tbl').DataTable().destroy();
	var tabel = $('#tbl').DataTable({
		"paging": false,
		"lengthChange": false,
		"info": false,
		"searching": false,
		"columnDefs": [{"orderable": false, "targets": "_all"}],
		"order": [],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "350px",
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'invisible excel',
			filename: 'Laporan Rekonsiliasi Panjang PET',
			title: ''
		}],
		"colReorder": true
	});

	setTimeout(function() {tabel.columns.adjust().draw();}, 500);
}

// Filter Data
function filter() {
	var tgl1 = $('#f_tgl1').val();
	var tgl2 = $('#f_tgl2').val();
	var status = $('#f_status').val();
	var kode = $('#f_kode').val();
	var desain = $('#f_desain').val();
	var data = [tgl1, tgl2, status, kode, desain];

	$('#btnProgress').click();
	$('#tbl').DataTable().destroy();
	$('#tbl tbody tr, #tbl_excel tr').remove();
	setTimeout(function() {
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/pet_emboss/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					qty_terima = data[i].QTY_TERIMA == null ? data[i].QTY_TERIMA_FIX : data[i].QTY_TERIMA;
					qty_terima_fix = data[i].QTY_TERIMA == null ? '' : format_number(data[i].QTY_TERIMA_FIX);
					panjang = data[i].PANJANG == null ? '' : format_number(data[i].PANJANG);
					selisih = panjang == '' ? '' : angka(panjang) - angka(qty_terima);
					keterangan = Math.abs(selisih) > 25 ? 'S. Teller' : '';
					barcode_awal = data[i].BARCODE_AWAL == null ? data[i].BARCODE : data[i].BARCODE_AWAL;
					barcode = data[i].BARCODE_AWAL == null ? '' : data[i].BARCODE;

					$('#tbl tbody').append('<tr>' +
						'<td style="width: 50px;"><input type="text" class="form-control text-center" value="'+(i+1)+'" readonly></td>' +
						'<td style="width: 300px;"><input type="text" class="form-control" value="'+data[i].NAMA+'" readonly></td>' +
						'<td style="width: 110px;"><input type="text" class="form-control text-center" value="'+format_date(data[i].TGL)+'" readonly></td>' + 
						'<td style="width: 80px;"><input type="text" class="form-control text-center" value="'+data[i].NO_SP+'" readonly></td>' +
						'<td style="width: 80px;"><input type="text" class="form-control text-center" value="'+data[i].NO_PO.substr(0,6)+'" readonly></td>' +
						'<td style="width: 170px;"><input type="text" class="form-control" name="'+data[i].ID_DETAIL_TERIMA+'" value="'+barcode_awal+'" title="'+barcode_awal+'" readonly></td>' +
						'<td style="width: 170px;"><input type="text" class="form-control" name="'+data[i].ID+'" value="'+data[i].KODE_ROLL+'" readonly></td>' +
						'<td style="width: 80px;"><input type="text" class="form-control text-right" name="qty_terima" value="'+format_number(qty_terima)+'" readonly></td>' +
						'<td style="width: 80px;"><input type="text" class="form-control text-right num" name="panjang" onkeyup="isi(this)" value="'+panjang+'" autocomplete="off" readonly></td>' +
						'<td style="width: 80px;"><input type="text" class="form-control text-right" value="'+format_number(selisih)+'" readonly></td>' +
						'<td style="width: 80px;"><input type="text" class="form-control text-right" value="'+qty_terima_fix+'" readonly></td>' +
						'<td style="width: 80px;" hidden><input type="text" class="form-control" value="'+keterangan+'" readonly></td>' +
						'<td style="width: 170px;"><input type="text" class="form-control" value="'+barcode+'" title="'+barcode+'" readonly></td>' +
						'</tr>');
					if (panjang == '') {$('[name="panjang"]:eq('+i+')').removeAttr('readonly');}

					$('#tbl_excel').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].NAMA+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+data[i].NO_SP+'</td><td>'+data[i].NO_PO.substr(0,6)+'</td><td>\''+barcode_awal+'</td><td>'+data[i].KODE_ROLL+'</td><td align="right" style="width: 20px;">'+format_number(qty_terima)+'</td><td align="right">'+panjang+'</td><td align="right">'+format_number(selisih)+'</td><td align="right">'+qty_terima_fix+'</td><td hidden>'+keterangan+'</td><td>\''+barcode+'</td></tr>');
				}

				$('#tbl_excel thead').html($('#tbl thead').html());
				$('#tbl_excel').append('<tr><td colspan="7" align="center">Total</td><td align="right"></td><td align="right"></td><td align="right"></td><td align="right"></td><td hidden></td><td></td></tr>');
				$('.form-control').css('font-size', '13.5px');

				onlynumeric();
				setTimeout(function() {$('#btnOk').click(); pagination(); isi_total();}, 500);
			}
		}); 
	}, 500);
}

// Isi Selisih Panjang
function isi(btn) {
	var limit = 25;
	var panjang = $(btn).val();
	var index = $(btn).parent().parent().index('#tbl tbody tr');
	var terima = angka($('#tbl tbody tr:eq('+index+') td:eq(7) input').val());
	var selisih = panjang == '' ? '' : panjang - terima;
	var final = panjang == '' ? '' : (Math.abs(selisih) <= limit ? terima : panjang);
	var keterangan = panjang == '' || Math.abs(selisih) <= limit ? '' :  'S. Teller';
	var barcode_awal = panjang == '' ? '' : $('#tbl tbody tr:eq('+index+') td:eq(5) input').val().substr(0, 12) + final;

	$('#tbl tbody tr:eq('+index+') td:eq(9) input').val(format_number(selisih));
	$('#tbl tbody tr:eq('+index+') td:eq(10) input').val(format_number(final));
	$('#tbl tbody tr:eq('+index+') td:eq(11) input').val(keterangan);
	$('#tbl tbody tr:eq('+index+') td:eq(12) input').val(barcode_awal);
	isi_total();
}

// Isi Total
function isi_total() {
	var qty_data = $('#tbl tbody tr').length;
	var t_terima = 0; t_panjang = 0; t_selisih = 0; t_final = 0;
	var first_row = $('#tbl tbody tr:eq(0) td:eq(0)').html();

	for (var i=0; i<qty_data; i++) {
		if (first_row != 'No data available in table') {
			terima = angka($('#tbl tbody tr:eq('+i+') td:eq(7) input').val());
			panjang = angka($('#tbl tbody tr:eq('+i+') td:eq(8) input').val());
			selisih = angka($('#tbl tbody tr:eq('+i+') td:eq(9) input').val());
			final = angka($('#tbl tbody tr:eq('+i+') td:eq(10) input').val());

			t_terima = t_terima + Number(terima);
			t_panjang = t_panjang + Number(panjang);
			t_selisih = t_selisih + Number(selisih);
			t_final = t_final + Number(final);
		}
	}	

	$('.dataTables_scrollFoot table tfoot td:eq(1) input').val(format_number(t_terima));
	$('.dataTables_scrollFoot table tfoot td:eq(2) input').val(format_number(t_panjang));
	$('.dataTables_scrollFoot table tfoot td:eq(3) input').val(format_number(t_selisih));
	$('.dataTables_scrollFoot table tfoot td:eq(4) input').val(format_number(t_final));

	$('#tbl_excel tr:eq('+(qty_data+1)+') td:eq(1)').html(format_number(t_terima));
	$('#tbl_excel tr:eq('+(qty_data+1)+') td:eq(2)').html(format_number(t_panjang));
	$('#tbl_excel tr:eq('+(qty_data+1)+') td:eq(3)').html(format_number(t_selisih));
	$('#tbl_excel tr:eq('+(qty_data+1)+') td:eq(4)').html(format_number(t_final));
}

// Kosong Isian
function kosong() {
	var qty_data = $('#tbl tbody tr').length;

	for (var i=0; i<qty_data; i++) {
		panjang = angka($('#tbl tbody tr:eq('+i+') td:eq(8) input').val());
		id_pet_emboss = $('#tbl tbody tr:eq('+i+') td:eq(6) input').attr('name');

		if (panjang > 0 && id_pet_emboss == 'null') {
			$('#tbl tbody tr:eq('+i+') td:gt(7) input').val('');
		}
	}	
}

// Error Isian
function error_isian(str) {
	$('#error_isian').removeClass('invisible');
	$('#error_isian').html(str);
	$('#btnIsian').click();
	throw new Error("Isian salah..");
}

// Simpan Data
$('#btn_simpan').click(function() {
	var qty_data = $('#tbl tbody tr').length;
	var t_id_pet_emboss = [], t_id_detail_terima = [], t_panjang_awal = [], t_panjang_pnp = [], t_teller = [], t_barcode_awal = [], t_panjang_final = [], t_barcode_final = [];

	for (var i=0; i<qty_data; i++) {
		status = $('#tbl tbody tr:eq('+i+') td:eq(8) input').attr('readonly');
		barcode_awal = $('#tbl tbody tr:eq('+i+') td:eq(5) input').val();
		id_detail_terima = $('#tbl tbody tr:eq('+i+') td:eq(5) input').attr('name');
		id_pet_emboss = $('#tbl tbody tr:eq('+i+') td:eq(6) input').attr('name');
		panjang_awal = angka($('#tbl tbody tr:eq('+i+') td:eq(7) input').val());
		panjang_pnp = angka($('#tbl tbody tr:eq('+i+') td:eq(8) input').val());
		teller = Math.abs(angka($('#tbl tbody tr:eq('+i+') td:eq(9) input').val()));
		panjang_final = angka($('#tbl tbody tr:eq('+i+') td:eq(10) input').val());
		barcode_final = $('#tbl tbody tr:eq('+i+') td:eq(12) input').val();

		if (status != 'readonly' && panjang_pnp > 0) {
			t_id_pet_emboss.push(id_pet_emboss);
			t_id_detail_terima.push(id_detail_terima);
			t_panjang_awal.push(panjang_awal);
			t_panjang_pnp.push(panjang_pnp);
			t_teller.push(teller);
			t_barcode_awal.push(barcode_awal);
			t_panjang_final.push(panjang_final);
			t_barcode_final.push(barcode_final);
		}
	}
	if (t_id_detail_terima.length == 0) {error_isian('Tidak ada data tersimpan..');}

	var data = [t_id_pet_emboss, t_id_detail_terima, t_panjang_awal, t_panjang_pnp, t_teller, t_barcode_awal, t_panjang_final, t_barcode_final];

	$('#btnProgress').click();
	$.ajax({
		async: false,
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url()."index.php/produksi/pet_emboss/simpan" ?>',
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('#btnSukses').click();

				filter();
				kosong()
			}, 500);
		}
	}); 
});

// Edit Data
$('#btn_edit').click(function() {
	var qty_data = $('#tbl tbody tr').length;

	for (var i=0; i<qty_data; i++) {
		$('#tbl tbody tr:eq('+i+') td:eq(8) input').removeAttr('readonly');
	}
});

// Export To Excel
$('#btn_excel').click(function() {
	var tab_text = "<table border='1px'><tr>";
	var tab = document.getElementById('tbl_excel');
	for (j=0; j<tab.rows.length; j++) {
		tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
	}

	tab_text = tab_text.replaceAll(',','') + "</table>";
	sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
	return (sa);
});

// Cetak Laporan
$('#btn_print').click(function() {
	var printable = document.getElementById('printable');
	var non_printable = document.getElementById('non_printable');
	var tgl1 = $('#f_tgl1').val();
	var tgl2 = $('#f_tgl2').val();

	$('#periode').html('Periode : ' + tgl1 + ' s/d ' + tgl2);
	$('#tbl_print').html($('#tbl_excel').html());

	printable.style.display = "";
	non_printable.style.display = "none";
	window.print();

	printable.style.display = "none";
	non_printable.style.display = "";
});

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