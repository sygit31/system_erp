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
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Surat Ijin Pembelian</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body" style="font-size: 13px;">
						<div class="card card-body">
							<div class="table-responsive mb-3">
								<table style="width: 1550px; margin-bottom: 10px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<th width="27.5%" colspan="2" class="filter">Filter Tanggal</th>
											<td></td>
											<th width="10%" class="filter">Divisi</th>
											<td></td>
											<th width="10%" class="filter">Nomor SIP</th>
											<td></td>
											<th width="12.5%" class="filter">Nama Bahan</th>
											<td></td>
											<th width="10%" class="filter">Pemesan</th>
											<td></td>
											<th width="10%" class="filter">Nama Bagian</th>
											<td></td>
											<th width="10%" class="filter">Status</th>
											<td></td>
											<th width="10%" class="filter">Kategori</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="fTgl1" type="text" class="form-control datepicker" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="text-align: center; background-color: #FFFFFF; cursor: pointer;" readonly></td>
											<td><input id="fTgl2" type="text" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="text-align: center; background-color: #FFFFFF; cursor: pointer;" readonly></td>
											<td></td>
											<td>
												<select class="select" id="f_unit" onchange="filter()" style="width: 100%;">
													<?php foreach ($unit->result_array() as $dt) { ?>
														<option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="f_nmr" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<?php foreach ($nmr->result_array() as $dt) { ?>
														<option><?php echo $dt['NO_SIP']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="f_bahan" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<?php foreach ($bahan->result_array() as $dt) { ?>
														<option value="<?php echo $dt['ID_BARANG']; ?>"><?php echo $dt['NAMA'] . ' ' . $dt['SPESIFIKASI']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="nama" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<?php foreach ($karyawan->result_array() as $dt) { ?>
														<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="bagian" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<?php foreach ($bagian->result_array() as $dt) { ?>
														<option value="<?php echo $dt['KD_DEPT_SIMPG']; ?>"><?php echo $dt['BAGIAN']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<select class="select" id="status" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<option>Open</option>
													<option>Close</option>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 150px;"><select class="select" id="f_kategori" onchange="filter()" style="width: 100%;">
													<option value="All">All..</option>
													<?php foreach ($kd_kategori->result_array() as $dt) { ?>
														<option value="<?php echo $dt['KODE']; ?>"><?php echo ucwords(strtolower($dt['KATEGORI'])); ?></option>
													<?php } ?>
												</select></div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="data-table card card-body"></div>

						<div class="card-footer">
							<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
							<button style="width: 150px;" type="button" onclick="upload_simpg()" class="btn btn-danger" title="Upload to SIMPG" hidden><i class="fa fa-upload m-2"></i><b>SIMPG</b></button>	
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

<!-- Modal Final SIP -->
<div class="modal fade" id="modal_final">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 32px; color: #D00101; font-weight: bold;"> Yakin akan mengubah status SIP menjadi Final? </div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="50%">Tanggal Beli</th>
						<td width="50%">
							<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="width: 100%; cursor: pointer; background-color: #FFFFFF;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Nomor Bon/BSKK/Kwitansi</th>
						<td>
							<input type="text" class="form-control" id="nmr" autocomplete="off" style="width: 100%; text-transform: uppercase;" maxlength="30">
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button id="ya_final" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="no_final" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnFinal" data-toggle="modal" data-target="#modal_final" hidden></button>
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
<div class="modal fade" id="modal_sukses">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
			<div class="modal-footer">
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
			<div class="modal-footer">
				<button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
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

// Define Variable
	var id_sip_detail = '', info_1 = 0;

// Load Dokumen
	$(document).ready(function() {
		$('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
		filter();
	});

// Pagination
	function pagination() {
		var tbl_data = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [[4, "asc"]],
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
				title: 'Laporan Data SIP'
			}],
			"colReorder": true
		});

		setTimeout(function() {tbl_data.columns.adjust().draw();}, 2000);
	}

	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var nmr = document.getElementById('f_nmr').value;
		var bagian = document.getElementById('bagian').value;
		var id_kary = document.getElementById('nama').value;
		var status = document.getElementById('status').value;
		var unit = document.getElementById('f_unit').value;
		var kategori = document.getElementById('f_kategori').value;
		var id_barang = document.getElementById('f_bahan').value;
		var data = [tgl1, tgl2, nmr, bagian, id_kary, status, unit, kategori, id_barang];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/lap_sip/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);
				pagination();
			}
		});
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
	}

// Notifikasi Final SIP
	function final(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_sip_detail = data_table.rows[row].cells[1].innerHTML;

		$('#btnFinal').click();
	}

// Final SIP
	$('#ya_final').on('click', function() {
		var tgl = $('#tgl').val();
		var nmr = $('#nmr').val();
		var data = [id_sip_detail, tgl, nmr];

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/pembelian/lap_sip/finals',
			data: {data: data},
			success: function(data) {
				setTimeout(function() {
					data == '0' ? error_isian('Nomor belum diisi..') : $('#btnSukses').click();
					$('#btnOk').click();
				}, 500);

				$('#nmr').val('');
				id_sip_detail = '';
				filter();
			}
		});
	});

// Reload Page
	$('#no_final').click(function() {
		id_sip_detail = '';
	});

// Upload Ke SIMPG
	function upload_simpg() {
		var datatable = $('#data-table tbody')[0];
		var qty_data = datatable.rows.length;
		var kd_unit = $('#f_unit').val();
		var dt_po = [];

		if (datatable.rows[0].cells[0].innerHTML == 'No data available in table') {error_isian('Tidak ada SIP yang terupload ke SIMPG..');}
		for (var i=0; i<qty_data; i++) {
			nmr_po = datatable.rows[i].cells[6].innerHTML;
			dt_po.push(nmr_po);
		}

		var data = [kd_unit, [...new Set(dt_po)]];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/pembelian/lap_sip/upload_manual_simpg',
			success: function(data) {
				console.log(data);
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
				}, 500);
			}
		});
	}

// Expands & Collapse Card Info
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