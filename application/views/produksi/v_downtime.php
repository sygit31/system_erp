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
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} @media print { @page {size: landscape;} html, body {width: 320mm;height: 210mm;} #pr_body td, #pr_bahan td, #pr_downtime td {height: 20px; vertical-align: middle; padding-left: 5px;}}</style>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Input Downtime</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Produksi - Manual Book Downtime Mesin.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
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
					<div class="col-xl-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Tanggal</th>
								<td>
									<input type="text" id="tanggal" class="form-control datepicker" name="" value="<?php echo date('d-M-Y', strtotime('-1 days')) ?>" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Proses</th>
								<td>
									<select class="select_min" id="proses" style="width: 100%;" onchange="isi_operator()">
										<option value="">Pilih..</option>
										<?php foreach($proses->result_array() as $dt) { ?>
											<option><?php echo $dt['PROSES']; ?></option>							
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>KK</th>
								<td>
									<div style="width: 100%;"><select class="select" id="kk" style="width: 100%;">
										<option value="">- Tanpa KK -</option>
										<?php foreach($dt_kk->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID'] . '-' . $dt['DESAIN']; ?>"><?php echo $dt['KK']; ?></option>	
										<?php } ?>
									</select></div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>PP</th>
								<td>
									<input type="text" id="pp" class="form-control num" placeholder="&nbsp; - Tanpa PP - &nbsp;" maxlength="3" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-xl-1"></div>
					<div class="col-xl-6"> 
						<table width="100%">
							<tr>
								<th width="40%">Desain</th>
								<td>
									<select class="select_min" id="desain" style="width: 100%;" onchange="isi_operator()">
										<?php foreach($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Mesin</th>
								<td>
									<div style="width: 100%;"><select class="select_min" id="nama_mesin" style="width: 100%;" onchange="isi_operator()">
										<option value="">Pilih..</option>
									</select></div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Shift</th>
								<td>
									<select class="select_min" id="shift" style="width: 100%;" onchange="isi_operator()">
										<option value="">Pilih..</option>
										<option>A</option>
										<option>B</option>
										<option>C</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Operator</th>
								<td>
									<select class="form-control select" id="operator" multiple="multiple" style="width: 100%; cursor: pointer;">
										<?php foreach ($operator->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body" style="font-weight: bold; color: #FFFFFF;">
				<div class="table-responsive">
					<button type="button" class="btn btn-block" id="btn_add" style="width:130px; margin-bottom: 10px; color: #FFFFFF; font-size: 16px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Data</b></button>
					<div style="width: 1000px;">
						<table id="tabel_input" class="table table-bordered">
							<thead style="background-color: #3FB4F7;">
								<tr style="text-align: center;">
									<td width="10%">No.</td>
									<td width="15%">Mulai</td>
									<td width="15%">Selesai</td>
									<td width="35%">Jenis Downtime</td>
									<td width="30%">Keterangan</td>
									<td hidden></td>
								</tr>
							</thead>
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

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White">Laporan Downtime</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 1000px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<th width="10%" class="filter">Desain</th>
										<td></td>
										<th width="10%" class="filter">Seri</th>
										<td></td>
										<th width="20%" class="filter">KK</th>
										<td></td>
										<th width="15%" class="filter">Proses</th>
										<td></td>
										<th class="filter">Nama Mesin</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('31-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select_min" id="fDesain" onchange="filter()" style="width: 100%;">
												<?php foreach($desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select_min" id="fSeri" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>	
												<?php foreach($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<div class="div_select" style="width: 220px;"><select class="select" id="f_kk" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach($dt_kk->result_array() as $dt) { ?>
													<option><?php echo $dt['KK']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div class="div_select" style="width: 150px;"><select class="select_min" id="fProses" onchange="isi_mesin(); filter();" style="width: 100%;">
												<?php foreach($proses->result_array() as $dt) { ?>
													<option><?php echo $dt['PROSES']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div class="div_select" style="width: 180px;"><select class="select_min" id="fNama_mesin" onchange="filter()" style="width: 100%;">
											</select></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="data-table m-3"></div>
						</div>
					</div>

					<div class="col-2 m-4">
						<button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
					</div>
				</div>
			</div>
			<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
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

// Define Variable
	var get_filter = 1;
	var dt_mesin = <?php echo json_encode($nama_mesin->result_array()); ?>;

// Load Dokumen
	$(document).ready(function() {
		$('.select').select2();
		$('.select_min').select2({minimumResultsForSearch: -1});
		$('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

		isi_mesin();
		filter();
		resize();
	});

// Resize Page
	$(window).resize(function(){
		resize();
	});

// Change Background
	function resize() {
		var screen_width = window.innerWidth;

		if (screen_width < 1200) {
			$('.div_select').addClass('w-100');
		}else{
			$('.div_select').removeClass('w-100');
		}
	}

// Pagination
	function pagination(mesin) {	
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
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Data Downtime',
				title: 'LAPORAN FLOW PRODUKSI MESIN ' + mesin
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Kosong Isian
	function kosong() {
		$('#tanggal').attr('name', '');
		$('#proses').val('').change();
		$('#pp').val('').change();
		$('#kk').val('').change();
		$('#nama_mesin').val('').change();
		$('#shift').val('').change();
		$('#operator').val('').change();
		$("#tabel_input").find("tr:gt(0)").remove();
	}

// Filter Data
	function filter() {
		var tgl1 = $('#fTgl1').val();
		var tgl2 = $('#fTgl2').val();
		var proses = $('#fProses').val();
		var desain = $('#fDesain').val();
		var f_kk = $('#f_kk').val();
		var seri = $('#fSeri').val();
		var nama_mesin = document.getElementById('fNama_mesin').value;
		var data = [tgl1, tgl2, proses, nama_mesin, desain, f_kk, seri];

		if (get_filter == 0) {return;}
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/downtime/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);
				setTimeout(function() {
					$('#btnOk').click();
					pagination(nama_mesin.toUpperCase());
				}, 500);
			}
		}); 
	}

// Isi Mesin Berdasarkan Proses
	function isi_mesin() {
		var proses = $('#fProses').val();

		get_filter = 0;
		$("#fNama_mesin").empty();
		for (var i=0; i<dt_mesin.length; i++) {
			t_proses = dt_mesin[i].PROSES;

			if (t_proses == proses) {
				$("#fNama_mesin").append('<option>'+dt_mesin[i].NAMA_MESIN+'</option>');
				$('#fNama_mesin').val(dt_mesin[i].NAMA_MESIN).change();
			}
		}

		var nama_mesin = $("#fNama_mesin").val();
		if (nama_mesin == null) {$("#fNama_mesin").val('').change();}
		get_filter = 1;
	}

// Isi Nama Operator
	function isi_operator() {
		var proses = $('#proses').val();
		var desain = $('#desain').val();
		var nama_mesin = $('#nama_mesin').val();
		var shift = $('#shift').val();
		var data = [proses, desain, nama_mesin, shift];

		$('#operator').val('');
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/downtime/isi_operator" ?>',
			success: function(data) {
				id = data == null ? '' : data.substr(0, data.length-1).split(',');
				$('#operator').val(id).change();
			}
		}); 
	}

// Isi Data Mesin
	$('#proses').on('change', function() {
		var proses = document.getElementById('proses').value;

		$("#nama_mesin").empty();
		$("#nama_mesin").append('<option value="">Pilih..</option>');
		$('#nama_mesin').val('').change();

		for (var i=0; i<dt_mesin.length; i++) {
			if (proses == dt_mesin[i].PROSES) {
				$("#nama_mesin").append('<option>'+dt_mesin[i].NAMA_MESIN+'</option>');
			}		
		}
	});

// Isi Data Desain
	$('#kk').on('change', function() {
		var desain = $('#kk').val() == '' ? '' : $('#kk').val().split('-')[1];

		if (desain != '') {
			$('#desain').attr('disabled','');
			$('#desain').val(desain).change();
		}else{
			$('#desain').removeAttr('disabled');
		}
	});

// Tambah Data Downtime
	$('#btn_add').click(function() {
		var option = document.createElement('option');

		$('#tabel_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="time" class="form-control" name="mulai" value="06:30" placeholder="Isikan jam.." style="width: 100%; text-align: center;"></td>' +
			'<td><input type="time" class="form-control" name="selesai" value="06:30" placeholder="Isikan jam.." style="width: 100%; text-align: center;"></td>' +
			'<td><select class="form-control select" name="jenis" style="width: 95%;">' +
			'<option value="">Pilih..</option> ' +
			'<?php foreach ($jenis_downtime->result_array() as $dt): ?>' +
			'<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['KODE'] . ' - ' . $dt['KETERANGAN']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></td>' +
			'<td><input type="text" class="form-control" name="keterangan" style="width: 100%;" autocomplete="off"></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Downtime" onclick="hapus_downtime(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		$(".select").select2();
		urut();
	});

// Isi Nomor Urut Roll
	function urut() {
		for (var i=0; i<tabel_input.rows.length-1; i++) {
			document.getElementsByName('nmr')[i].value = i+1;
		}
	}

// Hapus List Downtime
	function hapus_downtime(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		urut();
	};

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var mulai = [], selesai = [], id_jenis = [], keterangan = [];
		var id_edit = $('#tanggal').attr('name');
		var tabel_input = document.getElementById('tabel_input');
		var tanggal = $('#tanggal').val();
		var proses = $('#proses').val();
		var desain = $('#desain').val();
		var id_kk = $("#kk").val() == '' ? 0 : $("#kk").val().split('-')[0];
		var nama_mesin = $('#nama_mesin').val();
		var shift = $('#shift').val();
		var operator = $('#operator').val();
		var pp = $('#pp').val();

		if (proses == '') {error_isian('Proses belum diisi..');}
		if (nama_mesin == '') {error_isian('Nama mesin belum diisi..');}
		if (shift == '') {error_isian('Shift belum diisi..');}
		if (operator == '') {error_isian('Nama Operator belum diset..');}
		if (tabel_input.rows.length == 1) {error_isian('Table belum diisi..');}

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			if (document.getElementsByName('mulai')[i].value == '') {error_isian('Jam Mulai belum diisi..');}
			if (document.getElementsByName('selesai')[i].value == '') {error_isian('Jam Selesai belum diisi..');}
			if (document.getElementsByName('jenis')[i].value == '') {error_isian('Jenis Downtime belum diisi..');}

			mulai.push(document.getElementsByName('mulai')[i].value);
			selesai.push(document.getElementsByName('selesai')[i].value);
			id_jenis.push((document.getElementsByName('jenis')[i].value));
			keterangan.push(document.getElementsByName('keterangan')[i].value);

			var start = cek_jam(tanggal,document.getElementsByName('mulai')[i].value)
			var end = cek_jam(tanggal,document.getElementsByName('selesai')[i].value)
			
			if (start >= end) {error_isian('Jam Selesai harus lebih besar dari Jam Mulai..');}
		}

		var isi_tabel = [id_jenis, mulai, selesai, keterangan];
		var data = [id_edit, tanggal, proses, id_kk, nama_mesin, shift, isi_tabel, desain, pp, operator];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/downtime/simpan" ?>',
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

// Cek Format Tanggal dan Jam
	function cek_jam(tanggal,jam) {
		var year = tanggal.substring(9,11);
		var date = tanggal.substring(0,2);
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var month = dt_month.indexOf(tanggal.substring(3,6)) + 1;
		month = ("0" + month).slice(-2);

		var hour = jam.substring(0,2);
		var minute = jam.substring(3,5);

		if (Number(hour) + minute < 630) {date++;}

		return year + month + date + hour + minute;
	}

// Edit Data
	function edit(btn) {
		var id_edit = btn.name;

		$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
		setTimeout(function() {
			$.ajax({
				async: false,
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/produksi/downtime/edit',
				data: {data: id_edit},
				success: function(data) {
					data = JSON.parse(data);

					kk = data.ID_KK == 0 ? '' : data.ID_KK + '-' + data.DESAIN;
					id_operator = data.OPERATOR == null ? '' : data.OPERATOR.substr(0, data.OPERATOR.length-1).split(',');

					$('#tanggal').val(format_date(data.TGL)).change();
					$('#tanggal').attr('name', id_edit);
					$('#proses').val(data.PROSES).change();
					$('#kk').val(kk).change();
					$('#pp').val(data.PP).change();
					$('#desain').val(data.DESAIN).change();
					$('#nama_mesin').val(data.NAMA_MESIN).change();
					$('#shift').val(data.SHIFT).change();
					$('#operator').val(id_operator).change();

					$("#tabel_input").find("tr:gt(0)").remove();
					$('#btn_add').click();

					document.getElementsByName('mulai')[0].value = data.MULAI;
					document.getElementsByName('selesai')[0].value = data.SELESAI;
					$('[name=jenis]').val(data.ID_MST_DOWNTIME).change();
					document.getElementsByName('keterangan')[0].value = data.KETERANGAN;
				}
			});
		}, 500);
	}

// Notifikasi Hapus Data
	function hapus(btn) {
		var id_hapus = btn.name;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/produksi/downtime/hapus" ?>',
				data: {data: id_hapus},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();

						filter();
						id_hapus = '';
					}, 500);
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (id_hapus == '') {return;}
			id_hapus = '';
		});
	}

</script>