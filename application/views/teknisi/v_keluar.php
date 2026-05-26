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
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Input Spare Part Keluar</div></font></b>
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
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Nomor</th>
								<td width="60%">
									<input type="text" id="nmr" name="" class="form-control" style="width: 100%;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" onchange="auto_no()" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Karyawan</th>
								<td>
									<select class="select" id="nama" style="width: 100%;">
										<option value="">Pilih..</option>
										<?php foreach($karyawan->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
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
								<th width="40%">Divisi</th>
								<td width="60%">
									<select class="select" id="unit" style="width: 100%;" disabled>
										<?php foreach($dt_unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($kd_unit == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Jenis</th>
								<td>
									<select id="dt_bahan" hidden><option value="">Pilih..</option></select>
									<input type="text" id="jenis" class="form-control" value="<?php echo $jenis; ?>" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>						
					</div>
				</div>
				<div class="card card-body mt-2" style="font-weight: bold; color: #FFFFFF;">
					<div class="card-tools table-responsive">
						<div style="width: 270px;" class="mb-2">
							<button type="button" class="btn btn-tool" id="btn_add" style="width:130px; color: #FFFFFF; font-size: 16px; background-color: #D3030D;"><i class="fa fa-plus-square m-2"></i><b>Material</b></button>
							<button type="button" class="btn btn-tool" id="btn_qr" style="width:130px; color: #FFFFFF; font-size: 16px; background-color: #797DD0;" data-toggle="modal" data-target="#modal_scan" data-backdrop="static" data-keyboard="false"><i class="fa fa-qrcode m-2"></i><b>Scan</b></button>
						</div>
					</div>
					<div class="table-responsive">
						<div style="width: 1300px;">
							<table id="tabel_input" class="table table-bordered">
								<thead style="background-color: #D3030D;">
									<tr style="text-align: center;">
										<td width="7.5%">No.</td>
										<td width="10%">Part No.</td>
										<td>Nama</td>
										<td width="12%">Satuan</td>
										<td width="12%">Stok</td>
										<td width="12%">Qty Keluar</td>
										<td width="15%">Keterangan</td>
										<td width="3%">Buang</td>
									</tr>
								</thead>
							</table>
						</div>
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
				<h3 class="card-title">
					<b><font color="White" id="headerinput">Laporan Spare Part Keluar</font></b>
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
							<table style="width: 850px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="35%" colspan="2" class="filter bg-danger">Periode Tanggal</th>
										<td></td>
										<th width="15%" class="filter bg-danger">Divisi</th>
										<td></td>
										<th width="25%" class="filter bg-danger">Nama Material</th>
										<td></td>
										<th width="25%" class="filter bg-danger">Nama Karyawan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_unit" onchange="filter()" style="width: 100%;" disabled>
												<option value="All">All..</option>		
												<?php foreach($dt_unit->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($kd_unit == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<div style="width: 220px;"><select class="select" id="f_bahan" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_bahan as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_nama" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach($karyawan->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="datatable m-3">
								<table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
									<thead>
										<tr align="center">
											<th>No.</th>
											<th>Tanggal</th>
											<th>Nomor Urut</th>
											<th>Nama Karyawan</th>
											<th>Jenis</th>
											<th>Kode</th>
											<th>Nama Material</th>
											<th>Satuan</th>
											<th>Qty</th>
											<th>Keterangan</th>
											<th>Cetak</th>
											<th>Edit</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card-footer">
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

<!-- Modal Confirm Scan -->
<div class="modal fade" id="modal_scan">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;">
				<div style="width: 100%; height: auto;" id="reader"></div>
			</div>
			<div class="modal-footer row">
				<div class="col">
					<a href="#" id="btn_request" class="text-info text-left"><u>Get permission?</u></a>
				</div>
				<div class="col text-right">
					<button id="btn_stop" style="width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-stop mr-2"></i>Stop</b></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden;">
	<div style="width: 300px;">
		<h5 align="center">PT. PURA NUSAPERSADA</h5>
		<h5 align="center">KUDUS</h5>
		<hr style="border-top: 3px solid black; margin-top: 3mm;">
	</div>

	<h4 id="judul" align="center">IJIN PENGELUARAN SPARE PART</h4>
	<h4 id="nmr_ipb" align="center">XXX/XX/XX-XX/XXX</h4>

	<table id="print_body" class="table table-bordered mt-4" style="line-height: 14px;">
		<thead>
			<tr align="center">
				<td width="5%">NO.</td>
				<td width="10%">KODE</td>
				<td>NAMA MATERIAL</td>
				<td width="12.5%">SATUAN</td>
				<td width="12.5%">BANYAKNYA</td>
				<td width="25%">KETERANGAN</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-top: -10px; margin-bottom: 10px;">F-SMT-TEK-014 Rev. 00</div>

	<div align="center" id="tgl_order" style="font-size: 15px; margin-bottom: 10px;">Kudus,</div>

	<table id="print_footer" width="100%" style="line-height: 10px;">
		<tr>
			<td width="20%" align="center">Yang memberi :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Yang meminta :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Mengetahui :</td>
		</tr>
		<tr style="height: 10px;"></tr>
		<tr>
			<td align="center">Bag. Gudang Teknik</td>
			<td></td>
			<td align="center">Bag. Teknik</td>
			<td></td>
			<td></td>
		</tr>
		<tr style="height: 70px;"></tr>
		<tr style="height: 20px; font-weight: bold; text-decoration: underline;">
			<td align="center">WIWIN E.</td>
			<td></td>
			<td align="center">SAMSUL HADI</td>
			<td></td>
			<td align="center">M. RAMIJAN</td>
		</tr>
	</table>
</div>
<!-- print for hpd -->
<div id="printable_hpd" style="display: none; overflow: hidden;">
	<div style="width: 300px;">
		<h5 align="center">PT. PURA NUSAPERSADA</h5>
		<h5 align="center">KUDUS</h5>
		<hr style="border-top: 3px solid black; margin-top: 3mm;">
	</div>

	<h4 id="judul" align="center">IJIN PENGELUARAN SPARE PART</h4>
	<h4 id="nmr_ipb2" align="center">XXX/XX/XX-XX/XXX</h4>

	<table id="print_body" class="table table-bordered mt-4" style="line-height: 14px;">
		<thead>
			<tr align="center">
				<td width="5%">NO.</td>
				<td width="10%">KODE</td>
				<td>NAMA MATERIAL</td>
				<td width="12.5%">SATUAN</td>
				<td width="12.5%">BANYAKNYA</td>
				<td width="25%">KETERANGAN</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-top: -10px; margin-bottom: 10px;">F-SMT-TEK1-012 Rev 2 </div>

	<div align="center" id="tgl_order2" style="font-size: 15px; margin-bottom: 10px;">Kudus,</div>

	<table id="print_footer" width="100%" style="line-height: 10px;">
		<tr>
			<td width="20%" align="center">Yang memberi :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Yang meminta :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Mengetahui :</td>
		</tr>
		<tr style="height: 10px;"></tr>
		<tr>
			<td align="center">Bag. Gudang Teknik</td>
			<td></td>
			<td align="center">Bag. Teknik</td>
			<td></td>
			<td></td>
		</tr>
		<tr style="height: 70px;"></tr>
		<tr style="height: 20px; font-weight: bold; text-decoration: underline;">
			<td align="center">MILA UMDATUN NISFAH</td>
			<td></td>
			<td align="center">HAFID F./AFIF</td>
			<td></td>
			<td align="center">HARSONO</td>
		</tr>
	</table>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/html5-qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		auto_no();
		filter();
	});

// Pagination
	function pagination() {	
		$('#tbl').DataTable().destroy();
		var data_table = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Spare Part Keluar',
				title: ''
			}],
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 500);
	}

// Filter Data
	function filter() {
		var jenis = <?php echo json_encode($jenis); ?>;
		var tgl1 = $('#f_tgl1').val();
		var tgl2 = $('#f_tgl2').val();
		var kd_unit = $('#f_unit').val();
		var id_bahan = $('#f_bahan').val();
		var id_kary = $('#f_nama').val();
		var data = [jenis, tgl1, tgl2, kd_unit, id_bahan, id_kary];

		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/teknisi/keluar/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					nama = data[i].NAMA + ' ' + data[i].SPESIFIKASI;
					keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
					$('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+data[i].NMR+'</td><td>'+data[i].KARY+'</td><td>'+data[i].JENIS+'</td><td>'+data[i].KODE+'</td><td>'+nama+'</td><td align="center">'+data[i].SATUAN+'</td><td align="center">'+data[i].QTY+'</td><td>'+keterangan+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa ion-trash-a"></i></button></td></tr>');

					tgl1 = format_date(data[i].TGL);
					tgl2 = <?php echo json_encode(date('d-M-Y')) ?>;
					qty_hari = (new Date(tgl2).getTime() - new Date(tgl1).getTime()) /  (1000 * 60 * 60 * 24);
					if (qty_hari > '14') {$('#tbl .btn-warning:eq('+i+'), #tbl .btn-danger:eq('+i+')').hide();}
				}
				setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
			}
		}); 
	}

// Ambil Data Barang
	function ambil_barang() {
		var jenis = $('#jenis').val();
		var kd_unit = $('#unit').val();
		var qty_input = $('#tabel_input tr:gt(0)').length;
		var id_barang = [], data = [jenis, kd_unit];

		$('#dt_bahan option:gt(0)').remove();
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/teknisi/keluar/bahan" ?>',
			success: function(data) {
				data = JSON.parse(data);

				// Cek Barang yg sudah dipilih
				for (var i=0; i<qty_input; i++) {
					id_barang.push($('[name="bahan"]:eq('+i+')').val());
				}

				// Ambil Barang
				for (var i=0; i<data.length; i++) {
					if (id_barang.includes(data[i].ID) == false) {
						bahan = data[i].SPESIFIKASI.length < 3 ? data[i].NAMA : data[i].NAMA + ' ' + data[i].SPESIFIKASI;
						$('#dt_bahan').append('<option value="'+data[i].ID+'" name="'+data[i].SALDO_AWAL + '@' + data[i].MASUK + '@' + data[i].KELUAR + '@' + data[i].SATUAN + '@' + data[i].KODE +'">'+ bahan +'</option>');
					}
				}
			}
		});
	}

// Auto Nomor Keluar
	function auto_no() {
		var id_edit = $('#nmr').attr('name');
		var tgl = $('#tgl').val();
		var kd_unit = $('#unit').val();
		var jenis = $('#jenis').val();
		var data = [id_edit, tgl, kd_unit, jenis];

		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/teknisi/keluar/auto_no',
			success: function(data) {
				data = JSON.parse(data);
				$('#nmr').val(data);
			}
		});
	}

// Tambah Barang
	$('#btn_add').click(function() {
		ambil_barang();

		var tabel_input = document.getElementById('tabel_input');
		var qty_input = tabel_input.rows.length - 1;
		var option = $('#dt_bahan').html();

		$('#tabel_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control" name="kode" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><div style="max-width: 340px;"><select class="form-control select" name="bahan" onchange="isi_satuan(this)" style="width: 95%;"></select></div></td>' +
			'<td><select class="form-control select text-center" name="satuan" style="width: 95%;">' +
			'</select></td>' +
			'<td><input type="text" class="form-control text-center" name="stok" style="width: 100%; text-align: right;" readonly></td>' +
			'<td><input type="text" class="form-control text-center" name="qty" style="width: 100%; text-align: right;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><input type="text" class="form-control" name="keterangan" style="width: 100%;" autocomplete="off"></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Downtime" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		$('[name=bahan]:eq('+qty_input+')').html(option);
		$(".select").select2();
		isi_urut();
		onlynumeric();
	});	

// Isi Nomor Urut
	function isi_urut() {
		var tabel_input = document.getElementById('tabel_input');

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			document.getElementsByName('nmr')[i].value = i+1;
		}
	}

// Isi Satuan Berdasarkan Barang
	function isi_satuan(btn) {
		var row = $(btn).closest("tr").index();
		var dt_barang = $(btn).find('option:selected').attr('name');
		var saldo_awal = dt_barang == undefined ? '' : dt_barang.split('@')[0];
		var masuk = dt_barang == undefined ? '' : dt_barang.split('@')[1];
		var keluar = dt_barang == undefined ? '' : dt_barang.split('@')[2];
		var satuan = dt_barang == undefined ? '' : dt_barang.split('@')[3];
		var kode = dt_barang == undefined ? '' : dt_barang.split('@')[4];
		var stok = dt_barang == undefined ? '' : Number(saldo_awal) + Number(masuk) - Number(keluar);

		$('[name=kode]:eq('+row+')').val(kode);
		$('[name=satuan]:eq('+row+')').append('<option>'+satuan+'</option>');
		$('[name=satuan]:eq('+row+')').val(satuan).change();
		$('[name=stok]:eq('+row+')').val(format_number(stok < 0 ? 0 : stok)).change();
	}

// Hapus List Downtime
	function hapus_list(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		isi_urut();
	};

// Kosong Isian
	function kosong() {
		$('#nmr').attr('name', '');
		$("#nama").val('').change();
		$("#tabel_input").find("tr:gt(0)").remove();
		auto_no();
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
		var id_barang = [], satuan = [], qty = [], keterangan = [];
		var tabel_input = document.getElementById('tabel_input');
		var id_edit = $('#nmr').attr('name');
		var kd_unit = $('#unit').val();
		var tgl = $('#tgl').val();
		var nmr = $("#nmr").val();
		var jenis = $('#jenis').val();
		var id_kary = $("#nama").val();

		if (id_kary == '') {error_isian('Nama Karyawan belum diisi..');}
		if (tabel_input.rows.length == 1) {error_isian('Table Material belum diisi..');}

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			t_id_barang = document.getElementsByName('bahan')[i].value;
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_qty = document.getElementsByName('qty')[i].value;
			t_stok = document.getElementsByName('stok')[i].value;
			t_keterangan = document.getElementsByName('keterangan')[i].value;


			if (t_id_barang == '') {error_isian('Nama Material No. '+(i+1)+' belum diisi..');}
			if (t_satuan == '') {error_isian('Satuan No. '+(i+1)+' belum diisi..');}
			if (t_qty == '' || t_qty == 0) {error_isian('Qty No. '+(i+1)+' belum diisi..');}
			if (Number(t_qty) > Number(t_stok)) {error_isian('Stok No. '+(i+1)+' tidak mencukupi..');}

			id_barang.push(t_id_barang);
			satuan.push(t_satuan);
			qty.push(t_qty);
			keterangan.push(t_keterangan);
		}

		var isi_tabel = [id_barang, satuan, qty, keterangan];
		var data = [id_edit, kd_unit, tgl, nmr, id_kary, jenis, isi_tabel];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/teknisi/keluar/simpan',
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

// Approve Data
	function hapus(btn) {
		var id_hapus = btn.name;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/teknisi/keluar/hapus" ?>',
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

		$('#btnNo').click(function() {
			if (id_hapus == '') {return;}
			id_hapus = '';
		});
	}

// Edit Data
	function edit(btn) {
		var id_edit = btn.name;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/teknisi/keluar/edit" ?>',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);

				$('#nmr').val(data[0].NMR).change();
				$('#nmr').attr('name', id_edit);
				$('#tgl').val(format_date(data[0].TGL)).change();
				$('#nama').val(data[0].ID_ORDER).change();

				$("#tabel_input").find("tr:gt(0)").remove();
				for (var i=0; i<data.length; i++) {
					$('#btn_add').click();

					$('[name=bahan]:eq('+i+')').val(data[i].ID_BARANG).change();
					document.getElementsByName('qty')[i].value = data[i].QTY;
					document.getElementsByName('stok')[i].value = angka(document.getElementsByName('stok')[i].value) + angka(data[i].QTY)	;
					document.getElementsByName('keterangan')[i].value = data[i].KETERANGAN;
				}
			}
		});
		$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
	}

// Cetak IPB
	function cetak(btn) {
		var id_cetak = btn.name;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/teknisi/keluar/edit" ?>',
			data: {data: id_cetak},
			success: function(data) {
				data = JSON.parse(data);

				urut = data[0].NMR.substring(0, 4);
				kode_transaksi = data[0].KODE_TRANSAKSI;
				if (kode_transaksi==  '/PNP-HPD/')
				{
					kode_transaksi1='/PNP-HOLO PERDANA';
					bagian='TEK1';
				}	
				else
				{
					kode_transaksi1=kode_transaksi;
					bagian = data[0].NMR.substring(5, 8);
				}
				
				bln = get_romawi(format_date(data[0].TGL));
				thn = data[0].THN;
				if (kode_transaksi==  '/PNP-HPD/')
				{
					nmr = urut + kode_transaksi1 +'/'+bagian + '/' + bln + '/' + thn;
				}
				else
				{
					nmr = urut + kode_transaksi1 + bagian + '/' + bln + '/' + thn;
				}		
				
				//alert (nmr);
				$('#nmr_ipb').html('NO. : ' + nmr);

				$('#tgl_order').html('Kudus, ' + format_date(data[0].TGL));
				

				$("#print_body tbody tr").remove();
				for (var i=0; i<data.length; i++) {
					urut = i+1;
					spesifikasi = data[i].SPESIFIKASI;
					bahan = spesifikasi.length > 3 ? data[i].NAMA + ' - ' + spesifikasi : data[i].NAMA;

					$("#print_body tbody").append('<tr><td align="center">'+urut+'</td><td>'+data[i].KODE+'</td><td>'+bahan+'</td><td align="center">'+data[i].SATUAN+'</td><td align="right">'+format_number(data[i].QTY)+'</td><td>'+data[i].KETERANGAN+'</td></tr>');
				}

				// Print Area Table
				if (kode_transaksi==  '/PNP-HPD/')
				{
					var printable = document.getElementById('printable_hpd');
					$('#nmr_ipb2').html('NO. : ' + nmr);
					$('#tgl_order2').html('Kudus, ' + format_date(data[0].TGL));
				}
				else
				{
					var printable = document.getElementById('printable');	
				}
				var non_printable = document.getElementById('non_printable');

				printable.style.display = "";
				non_printable.style.display = "none";
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

// QR Scanner
	$('#btn_qr').click(function() {
		var html5QrcodeScanner = new Html5QrcodeScanner(
			"reader", { fps: 10, qrbox: 130, facingMode: "environment" });
		html5QrcodeScanner.render(onScanSuccess);

		$('#reader').show();
		$('#reader div:eq(0), #reader__dashboard').css('display', 'none');
		$('#html5-qrcode-anchor-scan-type-change').css('display', 'none');
		setTimeout(function() {
			$('#html5-qrcode-button-camera-permission').click();
			$('#html5-qrcode-button-camera-start').click();
		});
	});
	$('#btn_stop').click(function() {
		$('#html5-qrcode-button-camera-stop').click();
	});
	$('#btn_request').click(function() {
		$('#html5-qrcode-button-camera-permission').click();
	});
	function onScanSuccess(decodedText, decodedResult) {
		var qty_data = $('#tabel_input tr').length - 1;
		var id_barang = decodedText.split('id.')[1].replace(')', '');

		$('#btn_stop').click();
		for (var i=0; i<qty_data; i++) {
			t_id = $('[name="bahan"]:eq('+i+')').val();
			t_qty = Number($('[name="qty"]:eq('+i+')').val());

			if (t_id == id_barang) {
				$('[name="qty"]:eq('+i+')').val(t_qty + 1).change();
				return;
			}
		}

		$('#btn_add').click();
		$('[name="bahan"]:eq('+qty_data+')').val(id_barang).change();
		$('[name="qty"]:eq('+qty_data+')').val('1').change();
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
	var info_2 = 0;
	$('.info_2:eq(0)').on('click', function() {
		if (info_2 == 0) {
			$('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
			info_2 = 1;
		} else {
			$('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
			info_2 = 0;
		}
	});

</script>