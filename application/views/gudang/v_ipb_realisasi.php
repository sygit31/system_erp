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
<style>.select2-container--open {z-index: 9999999;}</style>

<style>body {padding-right: 0 !important}</style> <!-- Body Fix -->

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Input Penggunaan Bahan</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Nomor</th>
								<td>
									<input type="text" id="nmr" class="form-control" name="" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" onchange="auto_no()" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th >Bagian</th>
								<td>
									<select class="select_min" id="bagian" onchange="hapus_tabel(); isi_mesin()" style="width: 100%;">
										<?php $dt_bagian = array(); ?>
										<?php foreach($bagian->result_array() as $dt) { ?>
											<?php array_push($dt_bagian, $dt['ID']); ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<table width="100%">
							<tr>
								<th width="40%">KK</th>
								<td>
									<select class="select" id="kk" style="width: 100%;">
										<option value="0">Tanpa KK..</option>		
										<?php foreach($kk->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NOMER']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Mesin</th>
								<td>
									<select id="dt_barang" hidden>
										<option value="">Pilih..</option>
									</select>
									<select class="select_min" id="mesin" style="width: 100%;">
										<option value="0">Tanpa Mesin..</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>						
					</div>
				</div>
			</div>
			<div class="card-body card ml-3 mr-3" style="font-weight: bold; color: #FFFFFF;">
				<div class="table-responsive">
					<button type="button" class="btn btn-block" id="btn_add" style="width:130px; margin-bottom: 10px; color: #FFFFFF; font-size: 16px; background-color: #D42929;"><i class="fa fa-plus-square m-2"></i><b>Bahan</b></button>
					<div style="width: 900px;">
						<table id="tbl_input" class="table table-bordered">
							<thead style="background-color: #D42929;">
								<tr style="text-align: center;">
									<td width="10%">No.</td>
									<td>Nama Bahan</td>
									<td width="15%">Satuan</td>
									<td width="13%">Qty</td>
									<td width="13%">Stok</td>
									<td width="5%">Buang</td>
								</tr>
							</thead>
							<tbody></tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<table>
					<tr>
						<td width="150"><button type="button" class="btn btn-block btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
						<td width="10"></td>
						<td width="150"><button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div>Data Penggunaan Bahan</div></font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 1250px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="20%" colspan="2" class="filter bg-danger">Periode Tanggal</th>
										<td></td>
										<th width="12%" class="filter bg-danger">Bagian</th>
										<td></td>
										<th width="14%" class="filter bg-danger">Nomor KK</th>
										<td></td>
										<th width="14%" class="filter bg-danger">Mesin</th>
										<td></td>
										<th width="15%" class="filter bg-danger">Jenis Bahan</th>
										<td></td>
										<th class="filter bg-danger">Nama Bahan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<div style="width: 180px;"><select class="select_min" id="f_bagian" onchange="filter()" style="width: 100%;">
												<?php foreach($bagian->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div style="width: 200px;"><select class="select" id="f_kk" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($kk->result_array() as $dt) { ?>
													<option><?php echo $dt['NOMER']; ?></option>
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div style="width: 200px;"><select class="select_min" id="f_mesin" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($mesin->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA_MESIN']; ?></option>
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div style="width: 200px;"><select class="select_min" id="f_jenis" onchange="filter()" style="width: 100%;">
												<?php foreach($jenis->result_array() as $dt) { ?>
													<option><?php echo $dt['JENIS']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Nama Bahan.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
								<thead>
									<tr align="center">
										<th>No.</th>
										<th>Tanggal</th>
										<th>KK</th>
										<th>Mesin</th>
										<th>Nama Bahan</th>
										<th>Satuan</th>
										<th>Qty</th>
										<th width="4%">Edit</th>
										<th width="4%">Hapus</th>
									</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
									<tr class="text-center font-weight-bold">
										<td colspan="6">Total</td>
										<td></td>
										<td colspan="2"></td>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>

					<div class="card-footer">
						<button type="button" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();" style="width: 150px; height: 50px;"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
					</div>
				</div>
			</div>
		</div>

		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div>Data Stok Bahan</div></font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 850px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="30%" colspan="2" class="filter bg-danger">Periode Tanggal</th>
										<td></td>
										<th width="15%" class="filter bg-danger">Bagian</th>
										<td></td>
										<th width="15%" class="filter bg-danger">Jenis Bahan</th>
										<td></td>
										<th class="filter bg-danger">Nama Bahan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="s_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="s_filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="s_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="s_filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<div style="width: 180px;"><select class="select_min" id="s_bagian" onchange="s_filter()" style="width: 100%;">
												<?php foreach($bagian->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div style="width: 200px;"><select class="select_min" id="s_jenis" onchange="s_filter()" style="width: 100%;">
												<?php foreach($jenis->result_array() as $dt) { ?>
													<option><?php echo $dt['JENIS']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="s_cari" autocomplete="off" onchange="s_filter()" placeholder="Nama Bahan.." style="width: 100%;"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<table id="tbl_stok" class="table table-bordered table-striped" style="width: 100%;">
								<thead>
									<tr align="center">
										<th>No.</th>
										<th>Jenis</th>
										<th>Nama Bahan</th>
										<th>Satuan</th>
										<th>Saldo Awal</th>
										<th>Terima</th>
										<th>Keluar</th>
										<th>Stok</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>
					</div>

					<div class="card-footer">
						<button type="button" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();" style="width: 150px; height: 50px;"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
					</div>
				</div>
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

<!-- Modal Hapus Data -->
<div class="modal fade" id="modal_batal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
			</div>
		</div>
	</div>
</div>

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
		$('.select').select2();
		$('.select_min').select2({minimumResultsForSearch: -1});
		$('.datepicker').datepicker({dateFormat: 'dd-M-yy', changeMonth: true, changeYear: true, minDate: new Date('01-Jan-2022'), maxDate: new Date('<?php echo date('d-M-Y', strtotime('+1 year')); ?>')});

		auto_no();
		isi_mesin();
		filter();
		s_filter();

		$('#btn_add').click();
		$('.fa-bars:eq(0)').click();
		$('.main-header').removeClass('bg-info').addClass('bg-danger');
		$('.brand-link').removeClass('bg-info').addClass('bg-danger');

		// $('.btn_collapse:lt(2)').click();
	});

// Auto Nomor IPB
	function auto_no() {
		var id_edit = $('#nmr').attr('name');
		var tgl = $('#tgl').val();
		var data = [id_edit, tgl];

		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/auto_no" ?>',
			success: function(data) {
				data = JSON.parse(data);
				$('#nmr').val(data);
			}
		});
	}

// Isi Mesin Sesuai Proses
	function isi_mesin() {
		var id_bagian = $('#bagian').val().toLowerCase();
		
		$('#mesin option:gt(0)').remove();
		$('#dt_barang option:gt(0)').remove();
		$.ajax({
			async: false,
			data: {data: id_bagian},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/isi_mesin" ?>',
			success: function(data) {
				data = JSON.parse(data);
				dt_mesin = data[0];
				dt_barang = data[1];

				for (var i=0; i<dt_mesin.length; i++) {
					$('#mesin').append('<option value="'+dt_mesin[i].ID+'">'+dt_mesin[i].NAMA_MESIN+'</option>');
				}
				for (var i=0; i<dt_barang.length; i++) {
					$('#dt_barang').append('<option value="'+dt_barang[i].ID_BARANG+'@'+dt_barang[i].SATUAN+'">'+dt_barang[i].NAMA+'</option>');
				}
				$('#mesin').change();
				$('#dt_barang').change();
			}
		});
	}

// Filter Data
	function filter() {
		var tgl1 = $('#f_tgl1').val();
		var tgl2 = $('#f_tgl2').val();
		var id_bagian = $('#f_bagian').val();
		var kk = $('#f_kk').val();
		var id_mesin = $('#f_mesin').val();
		var jenis = $('#f_jenis').val();
		var cari = $('#cari').val().toUpperCase();
		var data = [tgl1, tgl2, id_bagian, kk, id_mesin, jenis, cari];

		$('#btnProgress').click();
		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/filter" ?>',
				success: function(data) {
					data = JSON.parse(data);

					total = 0;
					for (var i=0; i<data.length; i++) {
						qty = Number(data[i].QTY.replace(',','.')).toFixed(2);
						kk = data[i].KK == null ? '-' : data[i].KK;
						mesin = data[i].NAMA_MESIN == null ? '-' : data[i].NAMA_MESIN;
						$('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+kk+'</td><td>'+mesin+'</td><td>'+data[i].BAHAN+'</td><td align="center">'+data[i].SATUAN+'</td><td align="center">'+format_number(qty)+'</td><td align="center"><button type="button" style="width: 40px;" class="btn btn-warning btn-sm" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" style="width: 40px;" class="btn btn-danger btn-sm" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
						total = total + Number(qty);
					}
					$('#tbl tfoot td:eq(1)').html(format_number(total.toFixed(1)));

					setTimeout(function() {
						$('#btnOk').click();
						pagination();
					}, 500);
				}
			});
		}, 500);
	}

// Pagination
	function pagination() {	
		$('#tbl').DataTable().destroy();
		var table = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": '400px',
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Data Penggunaan Bahan',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {table.columns.adjust().draw();}, 500);
	}

// Tambah Barang
	$('#btn_add').click(function() {
		var tbl_input = document.getElementById('tbl_input');
		var qty_input = $('#tbl_input tbody tr').length;
		var option = $('#dt_barang').html();

		$('#tbl_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td align="center"><div style="max-width: 340px;"><select class="form-control select" name="bahan" onchange="isi_satuan(this)" style="width: 95%;"></select></div></td>' +
			'<td><select class="form-control select_min" name="satuan" style="width: 95%;">' +
			'<option value="">Pilih..</option></select></td>' +
			'<td><input type="text" class="form-control" name="qty" style="width: 100%; text-align: right;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><input type="text" class="form-control" name="stok" style="width: 100%; text-align: right;" readonly></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Data" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		$('[name=bahan]:eq('+qty_input+')').html(option);
		$('.select').select2();
		$('.select_min').select2({minimumResultsForSearch: -1});
		isi_urut();
		onlynumeric();
	});

// Isi Nomor Urut Roll
	function isi_urut() {
		var qty_input = $('#tbl_input tbody tr').length;

		for (var i=0; i<qty_input; i++) {
			document.getElementsByName('nmr')[i].value = i+1;
		}
	}

// Isi Satuan Barang
	function isi_satuan(btn) {
		var id_barang = btn.value.split('@')[0];
		var satuan = btn.value.split('@')[1];
		var row = $(btn).closest('tr').index();

		$('[name=satuan]:eq('+row+')').empty();
		$('[name=satuan]:eq('+row+')').append('<option>'+satuan+'</option>');
		$('[name=satuan]:eq('+row+')').val(satuan).change();

		isi_stok(row, id_barang);
	}

// Isi Satuan Barang
	function isi_stok(row, id_barang) {
		var id_bagian = $('#bagian').val();
		var data = [id_bagian, id_barang];

		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/isi_stok" ?>',
			success: function(data) {
				data = JSON.parse(data);

				s_awal = data.SALDO_AWAL == null ? 0 : data.SALDO_AWAL.replace(',', '.');
				qty_bon = data.QTY_BON == null ? 0 : data.QTY_BON.replace(',', '.');
				qty_pakai = data.QTY_PAKAI == null ? 0 : data.QTY_PAKAI.replace(',', '.');
				s_akhir = Number(s_awal) + Number(qty_bon) - Number(qty_pakai);

				$('[name=stok]:eq('+row+')').val(format_number(s_akhir.toFixed(1)));
			}
		});
	}

// Hapus List Downtime
	function hapus_list(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		isi_urut();
	};

// Hapus Tabel Input
	function hapus_tabel() {
		$('#tbl_input tbody tr').remove();
	}

// Kosong Isian
	function kosong() {
		$('#nmr').attr('name', '');
		auto_no();
		hapus_tabel();
		$('#btn_add').click();
	}

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var id_barang = [], satuan = [], qty = [];
		var id_edit = $('#nmr').attr('name');
		var nmr = $('#nmr').val();
		var tgl = $('#tgl').val();
		var id_bagian = $('#bagian').val();
		var id_kk = $('#kk').val();
		var id_mesin = $('#mesin').val();
		var qty_input = $('#tbl_input tbody tr').length;

		if (qty_input == 0) {error_isian('Table Bahan belum diisi..');}

		for (var i=0; i<qty_input; i++) {
			t_id_barang = document.getElementsByName('bahan')[i].value.split('@')[0];
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_qty = document.getElementsByName('qty')[i].value;
			t_stok = document.getElementsByName('stok')[i].value;
			
			if (t_id_barang == '') {error_isian('Nama Bahan No. '+(i+1)+' belum diisi..');}
			if (id_barang.includes(t_id_barang) == true) {error_isian('Nama Bahan No. '+(i+1)+' sudah ada..');}
			if (t_satuan == '') {error_isian('Satuan No. '+(i+1)+' belum diisi..');}
			if (t_qty == '' || t_qty == 0) {error_isian('Qty No. '+(i+1)+' belum diisi..');}
			if (Number(t_qty) > Number(t_stok)) {error_isian('Stok No. '+(i+1)+' tidak mencukupi..');}

			id_barang.push(t_id_barang);
			satuan.push(t_satuan);
			qty.push(t_qty);
		}

		var isi_tabel = [id_barang, satuan, qty];
		var data = [id_edit, nmr, tgl, id_bagian, id_kk, id_mesin, isi_tabel];

		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/simpan" ?>',
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();

						kosong();
						if ($('#f_bagian').val() == id_bagian) {filter();}
						if ($('#s_bagian').val() == id_bagian) {s_filter();}
					}, 500);
				}
			});
		}, 500);
	}

// Notifikasi Hapus
	function hapus(btn) {
		var id_hapus = btn.name;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/hapus" ?>',
				data: {data: id_hapus},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						
						filter();
						if ($('#s_bagian').val() == $('#f_bagian').val()) {s_filter();}
						id_hapus = '';
					}, 500);
				}
			});
		});

		$('#btnNo').click(function() {
			if (id_hapus == '') {return;}
			id_hapus = '';
		});
	}

// Edit Data
	function edit(btn) {
		var id_edit = btn.name;

		$('#tbl_input tr:eq(1)').remove();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/edit" ?>',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);

				$('#nmr').val(data[0].NMR).change();
				$('#tgl').val(format_date(data[0].TGL)).change();
				$('#bagian').val(data[0].ID_BAGIAN).change();
				$('#kk').val(data[0].ID_KK).change();
				$('#mesin').val(data[0].ID_MESIN).change();
				$('#nmr').attr('name', id_edit);
				
				for (var i=0; i<data.length; i++) {
					$('#btn_add').click();

					$('[name="bahan"]:eq('+i+')').val(data[i].ID_BARANG + '@' + data[i].SATUAN).change();
					$('[name="satuan"]:eq('+i+')').val(data[i].SATUAN).change();
					$('[name="qty"]:eq('+i+')').val(desimal(data[i].QTY)).change();
				}				
			}
		});
		$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
	}

// Filter Data Stok
	function s_filter() {
		var tgl1 = $('#s_tgl1').val();
		var tgl2 = $('#s_tgl2').val();
		var id_bagian = $('#s_bagian').val();
		var jenis = $('#s_jenis').val();
		var cari = $('#s_cari').val().toUpperCase();
		var data = [tgl1, tgl2, id_bagian, jenis, cari];

		$('#btnProgress').click();
		$('#tbl_stok').DataTable().destroy();
		$('#tbl_stok tbody tr').remove();
		setTimeout(function() {
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/Ipb_realisasi/s_filter" ?>',
				success: function(data) {
					data = JSON.parse(data);

					for (var i=0; i<data.length; i++) {
						s_opname = data[i].S_OPNAME == null ? 0 : desimal(data[i].S_OPNAME);
						s_awal = (s_opname + desimal(data[i].AWAL_BON) - desimal(data[i].AWAL_PRODUKSI)).toFixed(1);
						qty_bon = desimal(data[i].QTY_BON).toFixed(1);
						qty_produksi = desimal(data[i].QTY_PRODUKSI).toFixed(1);
						s_akhir = (Number(s_awal) + Number(qty_bon) - Number(qty_produksi)).toFixed(1);

						$('#tbl_stok tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].JENIS+'</td><td>'+data[i].NAMA+'</td><td align="center">'+data[i].SATUAN+'</td><td align="center">'+format_number(s_awal)+'</td><td align="center">'+format_number(qty_bon)+'</td><td align="center">'+format_number(qty_produksi)+'</td><td align="center">'+format_number(s_akhir)+'</td></tr>');
					}

					setTimeout(function() {
						$('#btnOk').click();
						s_pagination();
					}, 500);
				}
			});
		}, 500);
	}

// Pagination
	function s_pagination() {	
		$('#tbl_stok').DataTable().destroy();
		var table = $('#tbl_stok').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": '400px',
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Data Penggunaan Bahan',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {table.columns.adjust().draw();}, 500);
	}

</script>