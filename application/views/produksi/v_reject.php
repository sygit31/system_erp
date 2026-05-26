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
		<div class="card card-info" <?php if($akses=='2'){echo 'hidden';} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Input Retur Produksi PET</div>
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
			<div class="card-body card ml-4 mr-4 mt-4">
				<div class="row">
					<div class="col-lg-5">
						<table width="100%">
							<tr>
								<th width="30%">Nomor</th>
								<td>
									<input type="text" id="nmr" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Desain</th>
								<td>
									<select class="select_min" id="desain" onchange="auto_no()" style="width: 100%;">
										<?php foreach($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>               
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" onchange="auto_no()" style="background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-lg-1"></div>
					<div class="col-lg-6">
						<table width="100%">
							<tr>
								<th width="30%">Dibuat</th>
								<td>
									<select class="select" id="dibuat" style="width: 100%;">
										<option value="">Pilih Nama..</option>
										<?php foreach ($karyawan_produksi->result_array() as $dt) { ?>
											<option><?php echo strtoupper($dt['NAMA']); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Diputuskan</th>
								<td>
									<select class="select" id="disetujui" style="width: 100%;">
										<option value="">Pilih Nama..</option>
										<?php foreach ($karyawan_qc->result_array() as $dt) { ?>
											<option><?php echo strtoupper($dt['NAMA']); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Diterima</th>
								<td>
									<select class="select" id="diterima" style="width: 100%;">
										<option value="">Pilih Nama..</option>
										<?php foreach ($karyawan_gudang->result_array() as $dt) { ?>
											<option><?php echo strtoupper($dt['NAMA']); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body" style="font-weight: bold; color: #FFFFFF;">
				<button type="button" class="btn btn-block text-white text-bold" id="btn_add" style="width: 10%; margin-bottom: 10px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Data</b></button>
				<table id="tabel_input" class="table table-bordered" width="100%">
					<thead style="background-color: #3FB4F7;">
						<tr style="text-align: center;">
							<td hidden>ID Prod Pet Detail</td>
							<td width="10%">No.</td>
							<td width="30%">Nama Material</td>
							<td width="15%">Nomor KK</td>
							<td width="15%">Kode</td>
							<td width="15%">Qty Terima</td>
							<td width="15%">Qty Reject</td>
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
						<font color="White">Data Retur Produksi PET</font>
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
							<table style="width: 550px; margin-bottom: -20px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="45%" colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<td width="20%" class="filter">Desain</td>
										<td></td>
										<th width="35%" class="filter">Kode Roll</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_desain" onchange="filter()" style="width: 100%; cursor: pointer;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="f_cari" onkeyup="filter()" class="form-control" style="width: 100%;" placeholder="Cari kode roll.." autocomplete="off">
										</td>
									</tr>
								</tbody>
							</table>

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
<div class="modal fade" id="modal_reject">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header m-2 rounded" style="cursor: all-scroll;">
					<h3 class="card-title"><b><font color="White"><div id="headerinput"><h3>Data Reject Produksi</h3></div></font></b></h3>
				</div>
				<div class="card-body">
					<table id="tbl_reject" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
						<thead>
							<tr align="center">
								<th hidden>ID Prod PET Detail</th>
								<th>Pilih</th>
								<th>No</th>
								<th>Nama Material</th>
								<th>Nomor KK</th>
								<th>Kode</th>
								<th>Qty Terima</th>
								<th>Qty Reject</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="modal-footer rounded">
					<button id='btn_refresh' style="width: 150px;" type="button" class="btn btn-warning" title="Refresh Data"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
					<button id='btn_pilih' style="width: 150px;" type="button" class="btn btn-success" title="Pilih Barang" data-dismiss="modal"><i class="fa ion-android-share m-2"></i><b>Pilih</b></button>
					<button id='btn_reject' data-toggle="modal" data-target="#modal_reject" hidden></button>
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

<!-- Modal Confirm Approve -->
<div class="modal fade" id="modal_approve" style="z-index: 9997;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan Approve data? </div>
			<div class="modal-footer">
				<button id="no_approve" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="ya_approve" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnApprove" data-toggle="modal" data-target="#modal_approve" hidden></button>
			</div>
		</div>
	</div>
</div>

<style type="text/css">#tbl_print td, #tbl_print th {border: 1px solid #ddd;padding: 8px;}
</style>
<div id="printable" style="display: none; font-size: 14px;">
	<div style="height: 4mm;"></div>
	<div style="text-align: center; font-weight: bold; font-size: 18px;">PENANGANAN PRODUK FOIL TIDAK SESUAI</div>
	<div style="text-align: center; font-weight: bold;" id="p_nmr">NO : 003/PNP-HLG/EMB-COAT-SLITTER/I/2018</div>

	<div style="height: 5mm;"></div>
	<div style="display: flex; justify-content: space-between;">
		<div id="p_desain">DESAIN TA 2021</div>
		<div id="p_tgl">Tanggal : 9 Januari 2018</div>
	</div>

	<div style="height: 5mm;"></div>
	<table id="tbl_print" width="100%" style="border: 1px solid black;">
		<thead>
			<tr style="text-align: center; height: 35px;">
				<th width="5%">No.</th>
				<th width="10%">KK</th>
				<th width="10%">Kode Roll</th>
				<th width="5%">Seri</th>
				<th width="5%">Ukuran (Cm)</th>
				<th width="12.5%">Panjang (Mtr)</th>
				<th width="12.5%">Hasil (Mtr)</th>
				<th width="12.5%">S. Teller (Mtr)</th>
				<th width="12.5%">Reject (Mtr)</th>
				<th width="15%">Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php for ($i=0; $i<10; $i++) { ?>
				<tr style="height: 30px;">
					<td align="center"></td>
					<td></td>
					<td></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="right"></td>
					<td align="right"></td>
					<td align="right"></td>
					<td align="right"></td>
					<td></td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
	<div style="text-align: right; font-size: 14px;">F-SMT-P2-019 Rev. 00</div>

	<div style="height: 10mm;"></div>
	<table id="tbl_sign" width="100%" style="text-align: center;">
		<tbody>
			<tr>
				<td width="35%"><b>Yang menyerahkan,</b></td>
				<td width="35%"><b>Yang memutuskan,</b></td>
				<td width="30%"><b>Yang menerima,</b></td>
			</tr>
			<tr>
				<td>Bagian Produksi</td>
				<td>Bagian QC</td>
				<td>Bagian Gudang</td>
			</tr>
			<tr style="height: 80px;"></tr>
			<tr>
				<td style="font-weight: bold; text-decoration: underline;">Rita P.</td>
				<td style="font-weight: bold; text-decoration: underline;">Anies Pratiwi</td>
				<td style="font-weight: bold; text-decoration: underline;">Agus Susanto</td>
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
		$('.select_min').select2({minimumResultsForSearch: -1});
		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});

		auto_no();
		filter();
	});

// Drag Div Document
	$("#modal_reject").draggable({
		handle: ".card-header"
	});

// Get Romawi Bulan
	function romawi(str) {
		var dt_romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
		var dt_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		var indeks = dt_bln.indexOf(str);

		return dt_romawi[indeks];
	}

// Auto Nomor
	function auto_no() {
		var tgl = $('#tgl').val();
		var bln = tgl.substring(3,6);
		var tahun = $('#desain').val();
		var bln_romawi = romawi(bln);
		var data = [id_detail, tahun, bln_romawi];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/reject/auto_no" ?>',
			success: function(data) {
				$('#nmr').val(data);
			}
		});
	}

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		$('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
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
				title: 'Laporan Data Retur Produksi PET'
			}],
			"colReorder": true
		});
	}

// Pagination Modal Data Reject
	function pagination_input() {
		var datatable = $('#tbl_reject').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [2, "asc"],
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
		var cari = document.getElementById('f_cari').value;
		var desain = document.getElementById('f_desain').value;
		var data = [tgl1, tgl2, cari, desain];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/reject/filter" ?>',
			success: function(data) {
				$('.datatable').html(data);
				pagination();
			}
		});
	}

// Kosong Isian
	function kosong() {
		$('#dibuat').val('').change();
		$('#disetujui').val('').change();
		$('#diterima').val('').change();
		$("#tabel_input tbody").find("tr").remove();
		id_detail = '';
		auto_no();
	}

// Refresh Data Reject
	$('#btn_refresh').click(function() {
		$('#btn_add').click();
	});

// Ambil Data Reject
	$('#btn_add').click(function() {
		var desain = $('#desain').val();

		$('#btn_reject').click();
		$.ajax({
			data: {data: desain},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/reject/data_reject" ?>',
			success: function(data) {
				data_reject = JSON.parse(data);

				isi_data_reject(data_reject);
				pagination_input();
			}
		});
	});

// Isi Data Material
	function isi_data_reject(data_reject) {
		$('#tbl_reject').DataTable().destroy();
		$("#tbl_reject tbody").find("tr").remove();

		var urut = 0;
		for (var i = 0; i < data_reject.length; i++) {
			id = data_reject[i].ID;
			nama = data_reject[i].NAMA;
			kk = data_reject[i].KK;
			kode = data_reject[i].KODE;
			panjang = data_reject[i].PANJANG;
			reject = data_reject[i].REJECT;

			urut++;
			$('#tbl_reject').append('<tr><td hidden>' + id + '</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;"></td><td align="center">' + urut + '</td><td>' + nama + '</td><td>' + kk + '</td><td>' + kode + '</td><td align="right">' + format_number(panjang) + '</td><td align="right">' + format_number(reject) + '</td></tr>');
		}
	}

// Pilih Data Reject
	$('#btn_pilih').click(function() {
		$('#tbl_reject').DataTable().destroy();

		var tabel_input = document.getElementById('tabel_input');
		var tbl_reject = document.getElementById('tbl_reject');
		var qty_data = tbl_reject.rows.length;

		if (tbl_reject.rows[1].cells[2].innerHTML != '1') {
			return;
		}

		for (var i=0; i<qty_data-1; i++) {
			var status = document.getElementsByName('pilih')[i].checked;

			ganda = 0;
			if (status == true) {
				id_prod_pet_detail = tbl_reject.rows[i + 1].cells[0].innerHTML;
				nama = tbl_reject.rows[i + 1].cells[3].innerHTML;
				kk = tbl_reject.rows[i + 1].cells[4].innerHTML;
				kode = tbl_reject.rows[i + 1].cells[5].innerHTML;
				panjang = tbl_reject.rows[i + 1].cells[6].innerHTML;
				reject = tbl_reject.rows[i + 1].cells[7].innerHTML;

            // Cegah material ganda
				for (var j=0; j<tabel_input.rows.length-1; j++) {
					t_id_prod_pet_detail = tabel_input.rows[j + 1].cells[0].innerHTML;
					if (t_id_prod_pet_detail == id_prod_pet_detail) {ganda++;}
				}

				if (ganda == 0) {	
					isi_tabel_input(id_prod_pet_detail, nama, kk, kode, panjang, reject);
				}
			}
		}
	});

// Isi Data Tabel Input
	function isi_tabel_input(id_prod_pet_detail, nama, kk, kode, panjang, reject) {
		var row = $('#tabel_input tr').length-1;

		$('#tabel_input').append(
			'<tr>' +
			'<td hidden>' + id_prod_pet_detail + '</td>' +
			'<td><input type="text" class="form-control" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + nama + '" title="' + nama + '" style="width: 100%;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + kk + '" title="' + kk + '" style="width: 100%;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + kode + '" title="' + kode + '" style="width: 100%;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + format_number(panjang) + '" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + format_number(reject) + '" style="width: 100%; text-align: center;" readonly></td>' +
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

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
	}

// Simpan Data
	function simpan() {
		var desain = $('#desain').val();
		var tabel_input = document.getElementById('tabel_input');
		var qty_data = tabel_input.rows.length-1;
		var tgl = $('#tgl').val();
		var nmr = $('#nmr').val();
		var karyawan = <?php echo json_encode($karyawan_produksi->result_array()); ?>;
		var index = document.getElementById('dibuat').selectedIndex - 1;
		var id_dibuat = index == -1 ? '' : karyawan[index].ID;
		var karyawan = <?php echo json_encode($karyawan_qc->result_array()); ?>;
		var index = document.getElementById('disetujui').selectedIndex - 1;
		var id_disetujui = index == -1 ? '' : karyawan[index].ID;
		var karyawan = <?php echo json_encode($karyawan_gudang->result_array()); ?>;
		var index = document.getElementById('diterima').selectedIndex - 1;
		var id_diterima = index == -1 ? '' : karyawan[index].ID;
		var id_prod_pet_detail = [];
		
		if (id_dibuat == '') {error_isian('Dibuat oleh : belum diisi..'); return;}
		if (id_disetujui == '') {error_isian('Disetujui oleh : belum diisi..'); return;}
		if (id_diterima == '') {error_isian('Diterima oleh : belum diisi..'); return;}
		if (qty_data == 0) {error_isian('Belum ada data yang dipilih..'); return;}

		for (var i=0; i<qty_data; i++) {
			t_id_prod_pet_detail = tabel_input.rows[i+1].cells[0].innerText;
			id_prod_pet_detail.push(t_id_prod_pet_detail);
		}

		var data = [id_detail, tgl, nmr, id_dibuat, id_disetujui, id_diterima, id_prod_pet_detail, desain];

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/reject/simpan',
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
			url: '<?php echo base_url(); ?>index.php/produksi/reject/edit',
			data: {data: id_detail},
			success: function(data) {
				data = JSON.parse(data);

			// Isi Data Edit
				$('#nmr').val(data[0].NMR).change();
				$('#desain').val(data[0].DESAIN).change();
				$('#tgl').val(format_date(data[0].TGL)).change();
				$('#dibuat').val(data[0].DIBUAT).change();
				$('#disetujui').val(data[0].DISETUJUI).change();
				$('#diterima').val(data[0].DITERIMA).change();

				for (var i=0; i<data.length; i++) {
					id_prod_pet_detail = data[i].ID_PROD_PET_DETAIL;
					nama = data[i].NAMA;
					kk = data[i].KK;
					kode = data[i].KODE;
					panjang = data[i].PANJANG;
					reject = data[i].REJECT;

					isi_tabel_input(id_prod_pet_detail, nama, kk, kode, panjang, reject);
				}
			}
		});
	}

// Notifikasi Batal Reject
	function batal(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_detail = data_table.rows[row].cells[0].innerHTML;

		$('#btnHapus').click();
	}

// Batal Data Reject
	$('#ya_hapus').on('click', function() {
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/reject/batal',
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
		var total_panjang = 0, total_hasil = 0, total_reject = 0;

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/reject/edit',
			data: {data: id_detail},
			success: function(data) {
				data = JSON.parse(data);

				if (data.length > 10) {error_isian('Maksimal pengembalian 10 Roll..'); return;}
				$('#p_desain').html('Desain : ' + data[0].DESAIN);
				$('#p_tgl').html('Tanggal : ' + format_date(data[0].TGL));
				$('#p_nmr').html(data[0].NMR);

				for (var i=0; i<data.length; i++) {
					tbl_print.rows[i+1].cells[0].innerText = i+1;
					tbl_print.rows[i+1].cells[1].innerText = data[i].KK;
					tbl_print.rows[i+1].cells[2].innerText = data[i].KODE;
					tbl_print.rows[i+1].cells[3].innerText = data[i].SERI;
					tbl_print.rows[i+1].cells[4].innerText = '73';
					tbl_print.rows[i+1].cells[5].innerText = format_number(data[i].PANJANG);
					tbl_print.rows[i+1].cells[6].innerText = format_number(data[i].HASIL);
					tbl_print.rows[i+1].cells[7].innerText = '-';
					tbl_print.rows[i+1].cells[8].innerText = format_number(data[i].REJECT);
					tbl_print.rows[i+1].cells[9].innerText = '-';

					total_panjang = total_panjang + Number(data[i].PANJANG);
					total_hasil = total_hasil + Number(data[i].HASIL);
					total_reject = total_reject + Number(data[i].REJECT);
				}

				tbl_print.rows[10].cells[5].innerText = format_number(total_panjang);
				tbl_print.rows[10].cells[6].innerText = format_number(total_hasil);
				tbl_print.rows[10].cells[8].innerText = format_number(total_reject);

				tbl_sign.rows[3].cells[0].innerText = data[0].DIBUAT;
				tbl_sign.rows[3].cells[1].innerText = data[0].DISETUJUI;
				tbl_sign.rows[3].cells[2].innerText = data[0].DITERIMA;

			// Print Data
				var printable = document.getElementById('printable');
				var non_printable = document.getElementById('non_printable');

				printable.style.display = "";
				non_printable.style.display = "none";
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

// Notifikasi Approve Reject
	function approve(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_detail = data_table.rows[row].cells[0].innerHTML;

		$('#btnApprove').click();
	}

// Approve Data Reject
	$('#ya_approve').on('click', function() {
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/reject/approve',
			data: {data: id_detail},
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					filter();
				}, 500);
			}
		});
	});

// No Approve
	$('#no_approve').on('click', function() {
		id_detail = '';
	});

</script>