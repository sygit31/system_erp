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
<style>
	.select2-container--open {
		z-index: 9999999;
	}
</style>

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Input Retur Supplier</div>
						</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Produksi - Manual Book Retur Produksi PET.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="15%">Nomor</th>
						<td width="35%">
							<div class="input-group">
								<input type="text" id="nmr" class="form-control mr-2 text-center" value="000" maxlength="3" onfocusout="isi_nomor()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
								<label id="nmr_trans" style="width: 80%; margin-top: 5px;">-</label>
							</div>
						</td>
						<th width="15%">No. Kendaraan</th>
						<td width="35%">
							<input type="text" id="no_kend" class="form-control" style="width: 80%; text-transform: uppercase;" maxlength="10" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Tanggal</th>
						<td>
							<input type="text" id="tgl" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="background-color: white; cursor: pointer; width: 40%;" readonly>
						</td>
						<th>Penerima</th>
						<td>
							<input type="text" id="penerima" class="form-control" style="width: 80%; text-transform: uppercase;" maxlength="30" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Supplier</th>
						<td>
							<select class="select" id="supplier" style="width: 80%;">
								<option value="">Pilih Supplier..</option>
								<?php foreach ($supplier->result_array() as $dt) { ?>
									<option><?php echo strtoupper($dt['NAMA']); ?></option>
								<?php } ?>
							</select>
						</td>
						<th></th>
						<td></td>
					</tr>
				</table>
			</div>
			<div class="card-body" style="font-weight: bold; color: #FFFFFF;">

				<button type="button" class="btn btn-block text-white text-bold" id="btn_add" style="width: 10%; margin-bottom: 10px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Data</b></button>

				<table id="tabel_input" class="table table-bordered" width="100%">
					<thead style="background-color: #3FB4F7;">
						<tr style="text-align: center;">
							<td hidden>ID Prod Retur Detail</td>
							<td hidden>ID Barang</td>
							<td hidden>ID PO Detail</td>
							<td width="10%">No.</td>
							<td width="30%">Nama Material</td>
							<td width="15%">Spesifikasi</td>
							<td width="15%">Kode</td>
							<td width="15%">Satuan</td>
							<td width="15%">Qty</td>
						</tr>
					</thead>
				</table>
			</div>
			<div class="card-footer">
				<button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
				<button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Data Retur Supplier</font>
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
							<div class="table-responsive ml-2 mb-2">
								<table style="width: 650px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<th width="40%" colspan="2" class="filter">Periode Tanggal</th>
											<td></td>
											<th width="35%" class="filter">Supplier</th>
											<td></td>
											<th width="25%" class="filter">Nomor SP</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
											<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
											<td></td>
											<td>
												<select class="select" id="f_supplier" onchange="filter()" style="width: 100%;">
													<option value="">All..</option>
													<?php foreach ($supplier->result_array() as $dt) { ?>
														<option><?php echo strtoupper($dt['NAMA']); ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<input type="text" id="f_cari" onkeyup="filter()" class="form-control" style="width: 100%;" placeholder="Cari Nomor SP.." autocomplete="off">
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="datatable"></div>

							<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

						</font>
					</div>
				</div>
			</div>
		</div>
		<div class="card-footer">
			<font color="Green" size="2">ERP @2019</font>
		</div>
	</section>
</div>

<!-- Modal Data -->
<div class="modal fade" id="modal_retur">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header m-2 rounded" style="cursor: all-scroll;">
					<h3 class="card-title"><b><font color="White"><div id="headerinput"><h3>Data retur Produksi</h3></div></font></b></h3>
				</div>
				<div class="card-body">
					<table id="tbl_retur" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
						<thead>
							<tr align="center">
								<th hidden>ID Prod Retur Detail</th>
								<th hidden>ID Barang</th>
								<th hidden>ID PO Detail</th>
								<th>Pilih</th>
								<th>No</th>
								<th>BASTB</th>
								<th>Nama Material</th>
								<th>Spesifikasi</th>
								<th>Kode</th>
								<th>Satuan</th>
								<th>Qty</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="modal-footer rounded">
					<button id='btn_refresh' style="width: 150px;" type="button" class="btn btn-warning" title="Refresh Data"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
					<button id='btn_pilih' style="width: 150px;" type="button" class="btn btn-success" title="Pilih Barang" data-dismiss="modal"><i class="fa ion-android-share m-2"></i><b>Pilih</b></button>
					<button id='btn_retur' data-toggle="modal" data-target="#modal_retur" hidden></button>
				</div>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
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
<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="no_hapus" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="ya_hapus" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
			</div>
		</div>
	</div>
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

<div id="printable" style="display: none; font-size: 18px; margin-left: -10mm; margin-top: -5mm;">
	<div style="height: 4mm;"></div>
	<div style="margin-left: 220mm;" id="p_tgl">20-Juli-2019</div>

	<div style="height: 10mm;"></div>
	<div style="margin-left: 185mm; font-weight: bold;" id="p_supplier">PT. PURA BARUTAMA</div>
	<div style="margin-left: 185mm;" id="p_alamat">UNIT - PST</div>
	<div style="margin-left: 185mm;" id="p_penerima">UP. IBU DYAH IRAWATI</div>
	<div style="margin-left: 115mm; margin-top: -15px;" id="p_nmr">149/PNP-HLG/GD2/VII/2019</div>
	<div style="margin-left: 115mm;" id="p_no_kend">K 5545 UB</div>

	<div style="height: 21mm;"></div>
	<table id="tbl_print" width="100%">
		<tbody>
			<?php for ($i=0; $i<9; $i++) { ?>
				<tr style="height: 30px;">
					<td width="10%" align="center"></td>
					<td width="10%" align="center"></td>
					<td width="10%" align="center"></td>
					<td width="10%"></td>
					<td width="40%"></td>
					<td width="20%" class="pr-2"></td>
				</tr>
			<?php } ?>
			<tr style="height: 40px;">
				<td></td>
				<td></td>
				<td></td>
				<td style="font-weight: bold;">125 PCS</td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>

	<div style="height: 10mm;"></div>
	<table id="tbl_sign" width="100%" style="margin-left: 90px; text-align: center;">
		<tbody>
			<tr>
				<td width="25%"><b>SATPAM PNP,</b></td>
				<td width="25%"><b>IS,</b></td>
				<td width="25%"></td>
				<td width="25%"></td>
			</tr>
			<tr style="height: 80px;"></tr>
			<tr>
				<td style="font-weight: bold; text-decoration: underline;">____________</td>
				<td style="font-weight: bold; text-decoration: underline;">____________</td>
				<td></td>
				<td></td>
			</tr>
		</tbody>
	</table>
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

// Define Variable
var id_detail = '';

// Load Dokumen
$(document).ready(function() {
	$(".select").select2();
	$(".datepicker").datepicker({
		dateFormat: 'dd-M-yy'
	});

	auto_no();
	filter();
});

// Drag Div Document
$("#modal_retur").draggable({
	handle: ".card-header"
});

// Isi Format Nomor 3 angka
function isi_nomor() {
	var nmr = $('#nmr').val();
	var nmr = nmr.toString().padStart(3, "0");

	$('#nmr').val(nmr);
}

// Auto Nomor
function auto_no() {
	var tgl = $('#tgl').val();
	var data = [id_detail, tgl];

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/gudang/retur/auto_no" ?>',
		success: function(data) {
			$('#nmr').val(data.substring(0,3));
			$('#nmr_trans').html(data.substring(3,data.length));
		}
	});
}

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	$('#data-table').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"info": false,
		"order": [1, "asc"],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": '350px',
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {columns: ':visible'},
			className: 'invisible excel',
			title: 'Laporan Data Retur Gudang'
		}],
		"colReorder": true
	});
}

// Pagination Modal Data retur
function pagination_input() {
	var datatable = $('#tbl_retur').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"info": false,
		"order": [4, "asc"],
		"autoWidth": true,
		"scrollX": true,
		"scrollY": '350px',
		"colReorder": true
	});

	setTimeout(function() {
		datatable.columns.adjust().draw();
	}, 500);
}

// Filter Data
function filter() {
	var tgl1 = document.getElementById('f_tgl1').value;
	var tgl2 = document.getElementById('f_tgl2').value;
	var supplier = document.getElementById('f_supplier').value;
	var cari = document.getElementById('f_cari').value;
	var data = [tgl1, tgl2, supplier, cari];

	$.ajax({
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/gudang/retur/filter" ?>',
		success: function(data) {
			$('.datatable').html(data);
			pagination();
		}
	});
}

// Kosong Isian
function kosong() {
	$('#nmr').val('000').change();
	$('#nmr_trans').val('-').change();
	$('#supplier').val('').change();
	$('#no_kend').val('').change();
	$('#penerima').val('').change();
	$("#tabel_input tbody").find("tr").remove();

	id_detail = '';
	auto_no();
}

// Refresh Data retur
$('#btn_refresh').click(function() {
	$('#btn_add').click();
});

// Ambil Data retur
$('#btn_add').click(function() {
	$('#btn_retur').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url() . "index.php/gudang/retur/data_retur" ?>',
		success: function(data) {
			data_retur = JSON.parse(data);
			isi_data_retur(data_retur);
			pagination_input();
		}
	});
});

// Isi Data Material
function isi_data_retur(data_retur) {
	$('#tbl_retur').DataTable().destroy();
	$("#tbl_retur tbody").find("tr").remove();

	var urut = 0;
	for (var i = 0; i < data_retur.length; i++) {
		id_prod_retur_detail = data_retur[i].ID_PROD_RETUR_DETAIL;
		id_barang = data_retur[i].ID_BARANG;
		id_po_detail = data_retur[i].ID_PO_DETAIL;
		nama = data_retur[i].NAMA;
		spesifikasi = data_retur[i].SPESIFIKASI;
		kode = data_retur[i].KODE;
		satuan = data_retur[i].SATUAN;
		reject = data_retur[i].REJECT;
		ba = data_retur[i].BA;

		urut++;
		$('#tbl_retur').append('<tr><td hidden>' + id_prod_retur_detail + '</td><td hidden>' + id_barang + '</td><td hidden>' + id_po_detail + '</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;"></td><td align="center">' + urut + '</td><td>' + ba + '</td><td>' + nama + '</td><td>' + spesifikasi + '</td><td>' + kode + '</td><td align="center">' + satuan + '</td><td align="right">' + format_number(reject) + '</td></tr>');
	}
}

// Pilih Data retur
$('#btn_pilih').click(function() {
	$('#tbl_retur').DataTable().destroy();

	var tabel_input = document.getElementById('tabel_input');
	var tbl_retur = document.getElementById('tbl_retur');
	var qty_data = tbl_retur.rows.length;

	if (tbl_retur.rows[1].cells[4].innerHTML != '1') {return;}

	for (var i=0; i<qty_data-1; i++) {
		var status = document.getElementsByName('pilih')[i].checked;

		ganda = 0;
		if (status == true) {
			id_prod_retur_detail = tbl_retur.rows[i + 1].cells[0].innerHTML;
			id_barang = tbl_retur.rows[i + 1].cells[1].innerHTML;
			id_po_detail = tbl_retur.rows[i + 1].cells[2].innerHTML;
			nama = tbl_retur.rows[i + 1].cells[6].innerHTML;
			spesifikasi = tbl_retur.rows[i + 1].cells[7].innerHTML;
			kode = tbl_retur.rows[i + 1].cells[8].innerHTML;
			satuan = tbl_retur.rows[i + 1].cells[9].innerHTML;
			qty = tbl_retur.rows[i + 1].cells[10].innerHTML;

            // Cegah material ganda
            for (var j=0; j<tabel_input.rows.length-1; j++) {
            	t_id_prod_retur_detail = tabel_input.rows[j + 1].cells[0].innerHTML;
            	if (t_id_prod_retur_detail == id_prod_retur_detail) {ganda++;}
            }

            if (ganda == 0) {	
            	isi_tabel_input(id_prod_retur_detail, id_barang, id_po_detail, nama, spesifikasi, kode, satuan, qty);
            }
        }
    }
});

// Isi Data Tabel Input
function isi_tabel_input(id_prod_retur_detail, id_barang, id_po_detail, nama, spesifikasi, kode, satuan, qty) {
	var row = $('#tabel_input tr').length-1;

	$('#tabel_input').append(
		'<tr>' +
		'<td hidden>' + id_prod_retur_detail + '</td>' +
		'<td hidden>' + id_barang + '</td>' +
		'<td hidden>' + id_po_detail + '</td>' +
		'<td><input type="text" class="form-control" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + nama + '" title="' + nama + '" style="width: 100%;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + spesifikasi + '" title="' + spesifikasi + '" style="width: 100%;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + kode + '" title="' + kode + '" name="kode" style="width: 100%;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + satuan + '" title="' + satuan + '" name="satuan" style="width: 100%; text-align: center;" readonly></td>' +
		'<td><input type="text" class="form-control" value="' + format_number(qty) + '" name="qty" style="width: 100%; text-align: center;" readonly></td>' +
		'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Data" onclick="hapus_data(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
		'</tr>');

	nomor_urut();
}

// Isi Nomor Urut Input
function nomor_urut() {
	var tabel_input = document.getElementById('tabel_input');

	for (var i=0; i<tabel_input.rows.length-1; i++) {
		document.getElementsByName('urut')[i].value = i + 1;
	}
}

// Hapus List Input
function hapus_data(btn) {
	row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
	nomor_urut();
};

// Cek Duplikasi Nomor
function cek_nmr(urut,tgl) {
	var qty = 0;
	var data = [id_detail,urut,tgl];

	$.ajax({
		async: false,
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/gudang/retur/cek_nmr" ?>',
		success: function(data) {
			qty = data;
		}
	});

	return qty;
}

// Tampilkan error isian
function error_isian(str) {
	$('#keterangan_isian').html(str);
	$('#btnIsian').click();
}

// Simpan Data
function simpan() {
	var tabel_input = document.getElementById('tabel_input');
	var qty_data = tabel_input.rows.length-1;
	var tgl = $('#tgl').val();
	var urut = $('#nmr').val();
	var nmr = urut + $('#nmr_trans').html();
	var ck_nmr = cek_nmr(urut,tgl);
	var supplier = <?php echo json_encode($supplier->result_array()); ?>;
	var index = document.getElementById('supplier').selectedIndex - 1;
	var id_supplier = index == -1 ? '' : supplier[index].ID;
	var no_kend = $('#no_kend').val().toUpperCase();
	var penerima = $('#penerima').val().toUpperCase();
	var id_prod_retur_detail = [], id_barang = [], id_po_detail = [], kode = [], qty = [], satuan = [];
	
	if (id_supplier == '') {error_isian('Supplier belum diisi..'); return;}
	if (no_kend == '') {error_isian('Nomor kendaraan belum diisi..'); return;}
	if (penerima == '') {error_isian('Penerima belum diisi..'); return;}
	if (qty_data == 0) {error_isian('Belum ada data yang dipilih..'); return;}
	if (ck_nmr == 1) {error_isian('Nomor sudah digunakan..'); return;}

	for (var i=0; i<qty_data; i++) {
		t_id_prod_retur_detail = tabel_input.rows[i+1].cells[0].innerText;
		t_id_barang = tabel_input.rows[i+1].cells[1].innerText;
		t_id_po_detail = tabel_input.rows[i+1].cells[2].innerText;
		t_kode = document.getElementsByName('kode')[i].value;
		t_qty = angka(document.getElementsByName('qty')[i].value);
		t_satuan = document.getElementsByName('satuan')[i].value;

		id_prod_retur_detail.push(t_id_prod_retur_detail);
		id_barang.push(t_id_barang);
		id_po_detail.push(t_id_po_detail);
		kode.push(t_kode);
		qty.push(t_qty);
		satuan.push(t_satuan);
	}

	var material = [id_prod_retur_detail, id_barang, id_po_detail, kode, qty, satuan];
	var data = [id_detail, tgl, nmr, id_supplier, no_kend, penerima, material];

	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/gudang/retur/simpan',
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
	id_detail = data_table.rows[row].cells[0].innerHTML;

	$("#tabel_input tbody").find("tr").remove();
	$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/gudang/retur/edit',
		data: {data: id_detail},
		success: function(data) {
			data = JSON.parse(data);

			// Isi Data Edit
			$('#nmr').val(data[0].NMR).change();
			$('#nmr_trans').html(data[0].NMR_TRANS);
			$('#tgl').val(format_date(data[0].TGL)).change();
			$('#supplier').val(data[0].SUPPLIER).change();
			$('#no_kend').val(data[0].NO_KEND).change();
			$('#penerima').val(data[0].PENERIMA).change();

			for (var i=0; i<data.length; i++) {
				id_prod_retur_detail = data[i].ID_PROD_RETUR_DETAIL;
				id_barang = data[i].ID_BARANG;
				id_po_detail = data[i].ID_PO_DETAIL;
				nama = data[i].NAMA;
				spesifikasi = data[i].SPESIFIKASI;
				kode = data[i].KODE;
				satuan = data[i].SATUAN;
				qty = data[i].QTY;

				isi_tabel_input(id_prod_retur_detail, id_barang, id_po_detail, nama, spesifikasi, kode, satuan, qty);
			}
		}
	});
}

// Notifikasi Batal retur
function batal(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	id_detail = data_table.rows[row].cells[0].innerHTML;

	$('#btnHapus').click();
}

// Batal Data retur
$('#ya_hapus').on('click', function() {
	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/gudang/retur/batal',
		data: {data: id_detail},
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('#btnSukses').click();
				kosong();
				filter();
			}, 500);
		}
	});
});

// No Batal
$('#no_hapus').on('click', function() {
	id_detail = '';
});

// Menu Cetak
function cetak(btn) {
	var tbl_print = document.getElementById('tbl_print');
	var tbl_sign = document.getElementById('tbl_sign');
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index() + 1;
	var id_detail = data_table.rows[row].cells[0].innerHTML;
	var total = 0;

	$.ajax({
		async: false,
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/gudang/retur/edit',
		data: {data: id_detail},
		success: function(data) {
			data = JSON.parse(data);

			$('#p_tgl').html(format_date(data[0].TGL).toUpperCase());
			$('#p_nmr').html(data[0].NMR + data[0].NMR_TRANS);
			$('#p_no_kend').html(data[0].NO_KEND);
			$('#p_supplier').html(data[0].SUPPLIER);
			$('#p_alamat').html(data[0].ALAMAT);
			$('#p_penerima').html('UP. BP/IBU ' + data[0].PENERIMA);

			for (var i=0; i<data.length; i++) {
				tbl_print.rows[i].cells[0].innerText = i+1;
				tbl_print.rows[i].cells[1].innerText = '-';
				tbl_print.rows[i].cells[2].innerText = '-';
				tbl_print.rows[i].cells[3].innerText = format_number(data[i].QTY) + ' ' + data[i].SATUAN;
				tbl_print.rows[i].cells[4].innerText = data[i].NAMA;
				tbl_print.rows[i].cells[5].innerText = data[i].KODE;

				total = total + Number(data[i].QTY);
			}

			tbl_print.rows[9].cells[3].innerText = format_number(total) + ' ' + data[0].SATUAN;
		}
	});

	var printable = document.getElementById('printable');
	var non_printable = document.getElementById('non_printable');

	printable.style.display = "";
	non_printable.style.display = "none";
	window.print();

	printable.style.display = "none";
	non_printable.style.display = "";
}

</script>