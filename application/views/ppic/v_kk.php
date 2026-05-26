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
					<b><font color="White"><div>Input Kartu Kerja (KK)</div></font></b>
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
			<div class="card-body card ml-4 mr-4 mt-4">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Desain</th>
								<td width="60%">
									<select class="select" id="desain" onchange="auto_no()" style="width: 100%;">
										<option>2026</option>	
										<option>2025</option>	
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y') ?>" onchange="auto_no()" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor KK</th>
								<td>
									<!-- <input type="text" id="nmr" name="" class="form-control" style="width: 100%;" readonly> -->
									<input type="text" id="nmr" name="" class="form-control" style="width: 100%;">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<table width="100%">
							<tr>
								<th width="40%">Seri</th>
								<td width="60%">
									<select class="select" id="seri" onchange="auto_no()" style="width: 100%;">
										<option>SERI I</option>						
										<option>SERI II</option>						
										<option>SERI III</option>						
										<option>MMEA</option>						
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Deadline</th>
								<td>
									<input type="text" id="deadline" class="form-control datepicker" value="<?php echo date('d-M-Y') ?>" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body card ml-4 mr-4" style="font-weight: bold; color: #FFFFFF;">
				<div class="table-responsive">
					<button type="button" class="btn btn-info" style="width: 150px;" onclick="add_barang()" hidden><i class="fa fa-plus mr-2"></i><b>Bahan</b></button>
					<div style="width: 950px; margin-top: 15px;">
						<select id="bahan" hidden>
							<option value="">Pilih..</option>
							<?php foreach ($barang->result_array() as $dt) { ?>
								<option value="<?php echo $dt['ID'] . '@' . $dt['SATUAN']; ?>"><?php echo substr($dt['NAMA'] . ' ' . $dt['SPESIFIKASI'], 0, 70); ?></option>
							<?php } ?>
						</select>
						<table id="tbl_input" class="table table-bordered">
							<thead style="background-color: #3FB4F7;">
								<tr style="text-align: center;">
									<td width="10%">No.</td>
									<td width="60%">Nama Bahan</td>
									<td width="10%">Satuan</td>
									<td width="20%">Qty</td>
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
					<b><font color="White" id="headerinput">Laporan Kartu Kerja (KK)</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 1050px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<th width="12.5%" class="filter">Desain</th>
										<td></td>
										<th width="12.5%" class="filter">Seri</th>
										<td></td>
										<th width="25%" class="filter">Nomor KK</th>
										<td></td>
										<th width="25%" class="filter">Nama Bahan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" onchange="filter()" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" onchange="filter()" value="<?php echo date('31-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_desain" onchange="filter()" style="width: 100%;">			
												<option>2026</option>		
												<option>2025</option>		
												<!-- <option>2024</option>	 -->
												
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_seri" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<option>SERI I</option>						
												<option>SERI II</option>						
												<option>SERI III</option>						
												<option>MMEA</option>						
											</select>
										</td>
										<td></td>
										<td>
											<div style="width: 270px;"><select class="select" id="f_nmr" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($kk->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NOMER']; ?></option>
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<div style="width: 270px;"><select class="select" id="f_bahan" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($barang->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
												<?php } ?>
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
			<div id="salah_isian" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
			<div class="modal-footer">
				<button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
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
			<div class="modal-body confirm" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
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

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		filter();
		auto_no();
		add_barang();
	});

	function filter() {
		var tgl1 = document.getElementById('f_tgl1').value;
		var tgl2 = document.getElementById('f_tgl2').value;
		var desain = document.getElementById('f_desain').value;
		var seri = document.getElementById('f_seri').value;
		var nmr = document.getElementById('f_nmr').value;
		var id_bahan = document.getElementById('f_bahan').value;
		var data = [tgl1, tgl2, desain, seri, nmr, id_bahan];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/Kk/filter',
			success: function(data) {
				$('.data-table').html(data);

				setTimeout(function() {
					$('#btnOk').click();
					pagination();
				}, 500);
			}
		});
	}

// Pagination
	function pagination() {	
		$('#data-table').DataTable().destroy();
		var data_table = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [1, "asc"],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Kartu Kerja (KK)',
				title: ''
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Auto Nomor KK
	function auto_no() {
		var id_edit = $('#nmr').attr('name');
		var tgl = $('#tgl').val();
		var bln_romawi = get_romawi($('#tgl').val());
		var desain = $('#desain').val();
		var data = [id_edit, tgl, bln_romawi, desain];

		$.ajax({
			async: false,
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/ppic/Kk/auto_no',
			success: function(data) {
				data = JSON.parse(data);

				$('#nmr').val(data);
			}
		});
	}

// Tambah Bahan di KK
	function add_barang() {
		var opt_bahan = $("#bahan").html();
		var qty_input = $('#tbl_input tr').length-1;

		$('#tbl_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><div style="width: 520px;"><select class="form-control select" style="width: 100%;" name="bahan" onchange="isi_satuan(this)"></select></div></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="satuan" disabled>' +
			'<option value="">Pilih..</option>' +
			'<?php foreach ($satuan->result_array() as $dt) : ?>' +
			'<option><?php echo $dt['SATUAN']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></td>' +
			'<td><input type="text" class="form-control num" name="qty" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td style="width: 75px;" hidden><button type="button" class="btn btn-block btn-danger" title="Hapus Bahan" onclick="hapus_bahan(this)" style="margin-top: 0; width: 50px;" disabled><i class="fa ion-trash-a"></button></td>' +
			'</tr>');

		$('[name="bahan"]:eq('+qty_input+')').html(opt_bahan);
		$(".select").select2();

		urut_bahan();
		onlynumeric();
	}

// Isi Kode Material
	function isi_satuan(btn) {
		var tbl_input = document.getElementById('tbl_input');
		var row = $(btn).closest("tr").index();
		var satuan = $('[name="bahan"]:eq('+row+')').val().split('@')[1];

		$('[name="satuan"]:eq('+row+')').val(satuan).change();
	}

// Isi Nomor Urut Bahan
	function urut_bahan() {
		var tbl_input = document.getElementById('tbl_input');

		for (var i=0; i<tbl_input.rows.length-1; i++) {
			document.getElementsByName('nmr')[i].value = i+1;
		}
	}

// Hapus List Bahan
	function hapus_bahan(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		urut_bahan();
	};

// Kosong Isian
	function kosong() {
		$('#nmr').attr('name','');
		$("#tbl_input").find("tr:gt(0)").remove();
		auto_no();
		add_barang();
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var tbl_input = document.getElementById('tbl_input');
		var id_edit = $('#nmr').attr('name');
		var desain = $('#desain').val();
		var tgl = $('#tgl').val();
		var nmr = $('#nmr').val();
		var seri = $('#seri').val();
		var deadline = $('#deadline').val();
		var id_bahan = [], satuan = [], qty = [];

		if (tbl_input.rows.length == 1) {error_isian('Belum ada Bahan yang dipilih..');}

		for (var i=0; i<tbl_input.rows.length-1; i++) {
			t_id_bahan = document.getElementsByName('bahan')[i].value.split('@')[0];
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_qty = document.getElementsByName('qty')[i].value;

			if (t_qty == '' || t_satuan == '' || t_id_bahan == '') {error_isian('Isian Bahan belum lengkap..');}

			id_bahan.push(t_id_bahan);
			satuan.push(t_satuan);
			qty.push(angka(t_qty));

		// Cek duplikasi material
			for (var j=0; j<tbl_input.rows.length-1; j++) {
				j_material = document.getElementsByName('bahan')[j].value.split('@')[0];
				if (j_material == t_id_bahan && j != i) {
					error_isian('Material tidak boleh ganda..');
				}
			}
		}

		var bahan = [id_bahan, satuan, qty];
		var data = [id_edit, desain, tgl, nmr, seri, deadline, bahan];

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/Kk/simpan',
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

// Cek Transaksi KK yang sudah ada
	function cek_transaksi(id_kk_detail) {
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/Kk/cek_transaksi',
			data: {data: id_kk_detail},
			success: function(data) {
				if (data != 0) {error_isian('Data KK sudah digunakan untuk transaksi produksi, tidak bisa diubah. Hubungi Administrator..');}
			}
		});
	}

// Notifikasi Hapus Data
	function hapus(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_hapus = data_table.rows[row].cells[0].innerHTML;
		var aksi = btn.className.includes("btn-danger");

		if (aksi == true) {
			cek_transaksi(id_hapus);
			$('.confirm:eq(0)').html('Yakin akan menghapus data?');
			aksi = 'hapus';
		}else{
			$('.confirm:eq(0)').html('Yakin sudah menyelesaikan KK?');	
			aksi = 'close';	
		}

		var data = [aksi, id_hapus];

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (data == []) {return;}
			
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/ppic/Kk/hapus',
				data: {data: data},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						filter();
						data = [];
					}, 500);
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (data == []) {return;}
			data = [];
		});
	}

// Edit Data
	function edit(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_edit = data_table.rows[row].cells[0].innerHTML;
		
		cek_transaksi(id_edit);
		$('#nmr').attr('name', id_edit);
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/Kk/edit',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);

				$('#desain').val(data[0].DESAIN).change();
				$('#tgl').val(format_date(data[0].TGL)).change();
				$('#nmr').val(data[0].NMR).change();
				$('#seri').val(data[0].SERI).change();
				$('#deadline').val(format_date(data[0].DEADLINE)).change();

				for (var i=0; i<data.length; i++) {
					bahan = data[i].ID_BAHAN_BAKU + '@' + data[i].SATUAN;

					$('[name="bahan"]:eq('+i+')').val(bahan).change();
					$('[name="qty"]:eq('+i+')').val(format_number(data[i].QTY)).change();
				}
			}
		});

		$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
	}

</script>