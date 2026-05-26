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

<!-- Custom CSS -->
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info" <?php if ($kd_akses == '2') {echo 'hidden';} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div><?php if ($kd_menu == 'tek_terima') {echo 'Input Penerimaan Spare Part';}else{echo 'Input Penerimaan Gudang';} ?></div></font></b>
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
								<th width="40%">Tipe</th>
								<td width="60%">
									<select class="select" id="tipe" onchange="ubah_tipe()" style="width: 100%;">
										<option value="1">SIP</option>						
										<option value="2">Non SIP</option>						
									</select>
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
								<th>Nomor Urut</th>
								<td>
									<input type="text" id="nmr" name="" class="form-control" style="width: 100%;" readonly>
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
									<select class="select" id="unit" onchange="auto_no();" style="width: 100%;" disabled>
										<?php foreach($unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($kd_unit == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor SP (Supplier)</th>
								<td>
									<input type="text" id="nmr_sp" class="form-control" style="width: 100%; text-transform: uppercase;" maxlength="15" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor Kendaraan</th>
								<td>
									<input type="text" id="no_kend" class="form-control" value="-" style="width: 100%; text-transform: uppercase;" maxlength="12" autocomplete="off">
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body card ml-4 mr-4" style="color: #FFFFFF;">
				<div class="table-responsive">
					<button type="button" id="data_sip" class="btn btn-info" style="width: 150px;" onclick="data_sip()" data-toggle="modal" data-target="#modal_sip" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus-square mr-2"></i><b>Data SIP</b></button>
					<button type="button" class="btn btn-info" style="width: 150px;" onclick="add_barang()" hidden><i class="fa fa-plus-square mr-2"></i><b>Data Barang</b></button>
					<div style="width: 1300px; margin-top: 15px;">
						<table id="tabel_input" class="table table-bordered">
							<thead style="background-color: #3FB4F7;">
								<tr style="text-align: center; font-size: 14px;">
									<th hidden>ID SIP Detail</th>
									<th width="5%">No.</th>
									<th width="15%">Nomor SIP</th>
									<th width="15%">Nomor PO</th>
									<th width="20%">Nama Barang</th>
									<th width="10%">Qty SIP</th>
									<th width="10%">Qty Datang</th>
									<th width="10%">Satuan</th>
									<th width="15%">Keterangan</th>
									<th>Buang</th>
									<th hidden>Detail</th>
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
					<b><font color="White" id="headerinput"><?php if ($kd_menu == 'tek_terima') {echo 'Laporan Penerimaan Spare Part';}else{echo 'Laporan Penerimaan Gudang';} ?></font></b>
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
							<table class="tbl_filter" style="width: 1300px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="20%" colspan="2" class="filter">Periode Tanggal</th>
										<th></th>
										<th width="12.5%" class="filter">Divisi</th>
										<th></th>
										<th width="12.5%" class="filter">Bagian</th>
										<th></th>
										<th width="12.5%" class="filter">Jenis Bahan</th>
										<th></th>
										<th width="17.5%" class="filter">Nomor SIP</th>
										<th></th>
										<th width="17.5%" class="filter">Nomor PO</th>
										<th></th>
										<th class="filter">Nama Bahan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('31-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fUnit" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<option value="12">HOLOGRAFI</option>		
												<option value="01">HOLO PERDANA</option>		
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fBagian" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($bagian->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KD_DEPT_SIMPG']; ?>"><?php echo $dt['NAMA']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fJenis" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($jenis->result_array() as $dt) { ?>
													<option><?php echo $dt['JENIS']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fSip" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_sip->result_array() as $dt) { ?>
													<option><?php echo $dt['NO_SIP']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fPo" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_po->result_array() as $dt) { ?>
													<option><?php echo $dt['NOMER']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Nama Barang.." style="width: 100%;"></td>
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
											<th>Divisi</th>
											<th>Bagian</th>
											<th>Tanggal</th>
											<th>Nomor Urut</th>
											<th>Nomor SIP</th>
											<th>Nomor SP (Supplier)</th>
											<th>Nomor PO (Pembelian)</th>
											<th>Nama Barang</th>
											<th>Satuan</th>
											<th>Qty Datang</th>
											<th>Keterangan</th>
											<th>Nomor Kendaraan</th>
											<th>Edit</th>
											<th>Hapus</th>
											<th>QR Code</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
						<button type="button" onclick="isi_cetak()" class="btn btn-secondary" title="Cetak QR Code" style="width: 150px;"><i class="fa fa-qrcode m-2"></i><b>QR Code</b></button>
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
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
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

<!-- Modal Data SIP -->
<div class="modal fade" id="modal_sip" style="z-index: 9999999;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
				<b><h4 class="text-white">Data SIP <?php if ($kd_menu == 'tek_terima'){echo 'Teknik';}else{echo 'Gudang';}; ?></h4></b>
			</div>
			<div class="card-body table-responsive ml-2 pb-2" style="font-size: 13px; overflow-y: hidden;">
				<table style="width: 500px;">
					<thead>
						<tr align="center" style="line-height: 30px;">
							<th width="40%" class="filter bg-info">Jenis Barang</th>
							<th></th>
							<th width="60%" class="filter bg-info">Nama Barang</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<select class="select" id="f_jenis" onchange="isi_f_barang()" style="width: 100%;">
									<?php foreach($jenis->result_array() as $dt) { ?>
										<option><?php echo $dt['JENIS']; ?></option>						
									<?php } ?>
								</select>
							</td>
							<td></td>
							<td>
								<select class="select" id="f_barang" onchange="data_sip()" style="width: 100%;"> 
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="card-body">
				<table id="tbl_sip" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
					<thead>
						<tr align="center">
							<th hidden>ID SIP Detail</th>
							<th>Pilih</th>
							<th>No</th>
							<th>Tanggal SIP</th>
							<th>Nomor SIP</th>
							<th>Nomor PO</th>
							<th>Nama Barang</th>
							<th>Satuan</th>
							<th>Qty SIP</th>
							<th>Outstanding</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="modal-footer rounded">
				<button style="width: 150px;" type="button" class="btn btn-warning" title="Refresh Data" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Kembali</b></button>
				<button style="width: 150px;" type="button" class="btn btn-success" title="Pilih Data" data-dismiss="modal" onclick="pilih_sip()"><i class="fa fa-check-square-o m-2"></i><b>Pilih</b></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Jumlah QR Code -->
<div class="modal fade" id="modal_qr" style="z-index: 9999999;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
				<b><h4 class="text-white">Jumlah Cetak QR Code</h4></b>
			</div>
			<div class="card-body card ml-3 mr-3" style="font-size: 13px; overflow-y: hidden;">
				<table width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
					<thead>
						<tr align="center" style="border-top-style: double; border-bottom-style: double; line-height: 30px;">
							<th width="10%">No</th>
							<th width="20%">Kode</th>
							<th>Nama Spare Part</th>
							<th width="15%">Qty Cetak</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="card-footer text-center rounded mr-2 ml-2">
				<button style="width: 150px;" type="button" class="btn btn-success rounded" onclick="cetak()" name="" title="Cetak Data" data-dismiss="modal"><i class="fa fa-print m-2"></i><b>Cetak</b></button>
				<button style="width: 150px;" type="button" class="btn btn-danger rounded" title="Batal Cetak" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
				<button data-toggle="modal" data-target="#modal_qr" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" class="row" style="overflow: hidden;">
	<div class="p_label" hidden>
		<div class="p-1 mb-2 ml-2" style="width: 280px; border: 1px solid black; text-align: center;">
			<div class="row">
				<div class="col-5 p-1" style="border-right: 1px solid #ccc;">
					<div class="p-1 qrcode"></div>
					<div class="p_kode" style="margin-top: -1mm;"></div>
				</div>
				<div class="col-7">
					<div class="d-flex align-items-center justify-content-center p_nama" style="border-bottom: 1px solid #ccc; font-weight: bold; height: 95px; font-size: 14px;">Nama Barang</div>
					<div class="d-flex align-items-center justify-content-center p_lokasi">Lokasi</div>
				</div>
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
<!-- QR Code -->
<script src="<?php echo base_url(); ?>assets/js/jquery.qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>	

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		auto_no();
		filter();
		isi_f_barang();
		resize();
	});

// Resize Event
	$(window).resize(function() {    
		resize();
	});

// Resize Page
	function resize() {
		if ($(this).width() < 700) {
			$('#modal_sip .modal-dialog').css({'max-width': '95%', 'margin': '20px'});
		}else{
			$('#modal_sip .modal-dialog').css({'max-width': '65%', 'margin': 'auto'});
		}
	}

// Auto Nomor
	function auto_no() {
		var id_edit = $('#nmr').attr('name');
		var tgl = $('#tgl').val();
		var kd_unit = $('#unit').val();
		var data = [id_edit, tgl, kd_unit];

		$.ajax({
			async: false,
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/gudang/Terima_bp/auto_no',
			success: function(data) {
				data = JSON.parse(data);
				$('#nmr').val(data);
			}
		});
	}

// Ubah Tipe Penerimaan
	function ubah_tipe() {
		var tipe = $('#tipe').val();

		$("#tabel_input").find("tr:gt(0)").remove();
		if (tipe == '1') {
			$('.btn-info:eq(0)').removeAttr('hidden','');
			$('.btn-info:eq(1)').attr('hidden','');
		}else{
			$('.btn-info:eq(0)').attr('hidden','');
			$('.btn-info:eq(1)').removeAttr('hidden','');
		}
	}

// Pagination
	function pagination() {	
		$('#tbl').DataTable().destroy();
		var data_table = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": [],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				filename: 'Laporan Barang Datang',
				title: ''
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Pagination Input
	function pagination_input() {
		$('#tbl_sip').DataTable().destroy();
		var tbl_sip = $('#tbl_sip').DataTable({
			"paging": false,
			"oLanguage": {"sSearch": "Cari :"},
			"searching": true,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {tbl_sip.columns.adjust().draw();}, 500);
	}

// Kosong Isian
	function kosong() {
		var now = <?php echo json_encode(date('d-M-Y')); ?>;

		$('#nmr').attr('name', '');
		$('#unit').val(<?php echo json_encode($kd_unit); ?>).change();
		$('#nmr_sp').val('').change();
		$('#no_kend').val('-').change();
		$('#detail_kode').val('0').change();
		$('#tgl').val(now).change();
		$("#tabel_input").find("tr:gt(0)").remove();
	}

// Filter Data
	function filter() {
		var tgl1 = $('#fTgl1').val();
		var tgl2 = $('#fTgl2').val();
		var unit = $('#fUnit').val();
		var jenis = $('#fJenis').val();
		var bagian = $('#fBagian').val();
		var sip = $('#fSip').val();
		var po = $('#fPo').val();
		var cari = $('#cari').val().toUpperCase();
		var kd_akses = <?php echo json_encode($kd_akses); ?>;
		var dt_bagian = <?php echo json_encode($dt_bagian); ?>;
		var kd_menu = <?php echo json_encode($kd_menu); ?>;
		var f_bagian = []; dt_bagian.forEach(function(dt) {f_bagian.push(dt.KD_DEPT_SIMPG);});
		var f_unit = []; dt_bagian.forEach(function(dt) {f_unit.push(dt.KD_UNIT);});
		var data = [tgl1, tgl2, unit, jenis, sip, cari, po, f_bagian, f_unit, kd_akses, bagian];

		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Terima_bp/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					nama = data[i].NAMA;
					spesifikasi = data[i].SPESIFIKASI == '-' || data[i].SPESIFIKASI == '' ? '' : ' ' + data[i].SPESIFIKASI;
					nmr_po = data[i].NMR_PO == null ? '-' : data[i].NMR_PO;
					barang = nama + spesifikasi;
					qty_sip = data[i].QTY_SIP == null ?  0 : data[i].QTY_SIP.replaceAll(',', '.');
					qty_datang = data[i].QTY_DATANG == null ?  0 : data[i].QTY_DATANG.replaceAll(',', '.');
					tipe = data[i].TIPE;

					$('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].UNIT+'</td><td>'+data[i].BAGIAN+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+(data[i].NO_SIP == null ? '-' : data[i].NO_SIP)+'</td><td>'+data[i].NMR_SP+'</td><td>'+nmr_po+'</td><td>'+barang+'</td><td align="center">'+data[i].SATUAN+'</td><td align="right">'+format_number(qty_datang)+'</td><td>'+(data[i].KETERANGAN == null ? '' : data[i].KETERANGAN)+'</td><td>'+(data[i].NO_KEND == null ? '-' : data[i].NO_KEND)+'</td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID_DETAIL+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td><td align="center"><input type="checkbox" name="'+data[i].ID_DETAIL+'" style="cursor: pointer;"></td></tr>');
					if (tipe == '2') {$('.btn-warning:eq('+i+')').hide();}

					tgl1 = format_date(data[i].TGL);
					tgl2 = <?php echo json_encode(date('d-M-Y')) ?>;
					qty_hari = (new Date(tgl2).getTime() - new Date(tgl1).getTime()) /  (1000 * 60 * 60 * 24);
					if (qty_hari > '14') {$('#tbl .btn-warning:eq('+i+'), #tbl .btn-danger:eq('+i+')').hide();}
				}

				// Hide Kolom sesuai Bagian
				if (kd_menu == 'tek_terima') {
					$('.tbl_filter').width('950px');
					$('.tbl_filter th:eq(2), .tbl_filter th:eq(3), .tbl_filter th:eq(4), .tbl_filter th:eq(5), .tbl_filter th:eq(6), .tbl_filter th:eq(7)').hide();
					$('.tbl_filter td:eq(2), .tbl_filter td:eq(3), .tbl_filter td:eq(4), .tbl_filter td:eq(5), .tbl_filter td:eq(6), .tbl_filter td:eq(7)').hide();
					$('.tbl_filter th:eq(0)').width('25%');
					$('.tbl_filter th:eq(8)').width('20%');
					$('.tbl_filter th:eq(10)').width('20%');

					$('#tbl th:nth-child(2), #tbl th:nth-child(3), #tbl td:nth-child(2), #tbl td:nth-child(3)').hide();
				}else if (kd_akses == '2') {
					$('.tbl_filter').width('1200px');
					$('.tbl_filter th:eq(6), .tbl_filter th:eq(7)').hide();
					$('.tbl_filter td:eq(6), .tbl_filter td:eq(7)').hide();
					
					$('#tbl th:nth-child(14), #tbl th:nth-child(15), #tbl th:nth-child(16), #tbl td:nth-child(14), #tbl td:nth-child(15), #tbl td:nth-child(16), .btn-secondary').hide();
				}else{
					$('.tbl_filter').width('1100px');
					$('.tbl_filter th:eq(2), .tbl_filter th:eq(3), .tbl_filter th:eq(4), .tbl_filter th:eq(5)').hide();
					$('.tbl_filter td:eq(2), .tbl_filter td:eq(3), .tbl_filter td:eq(4), .tbl_filter td:eq(5)').hide();
					$('.tbl_filter th:eq(0)').width('20%');
					$('.tbl_filter th:eq(6)').width('15%');

					$('#tbl th:nth-child(2), #tbl th:nth-child(3), #tbl th:nth-child(16), #tbl td:nth-child(2), #tbl td:nth-child(3), #tbl td:nth-child(16), .btn-secondary').hide();
				}

				setTimeout(function() {$('#btnOk').click(); pagination();}, 1000);
			}
		}); 
	}

// Isi Data Barang SIP
	function isi_f_barang() {
		var dt_barang = <?php echo json_encode($dt_barang->result_array()); ?>;
		var f_jenis = $('#f_jenis').val();

		$('#f_barang').empty();
		$('#f_barang').append('<option value="All">All..</option>');
		$('#f_barang').val('All').change();
		dt_barang.forEach(function(item,i) {
			if (item.JENIS == f_jenis) {
				$('#f_barang').append('<option value="'+item.ID+'">'+item.NAMA+'</option>');
			}
		});
	}

// Isi Data SIP
	function data_sip() {
		var id_barang = $('#f_barang').val();
		var f_jenis = $('#f_jenis').val();
		var urut = 0;
		var kd_menu = <?php echo json_encode($kd_unit); ?>;
		var data = [id_barang, f_jenis, kd_menu];

		$('#tbl_sip').DataTable().destroy();
		$('#tbl_sip tbody tr').remove();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Terima_bp/data_sip" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					id = data[i].ID_SIP_DETAIL;
					tgl = format_date(data[i].TGL);
					no_sip = data[i].NO_SIP;
					nama = data[i].NAMA;
					spesifikasi = data[i].SPESIFIKASI == '' || data[i].SPESIFIKASI == '-' ? '' : data[i].SPESIFIKASI;
					kode = kd_menu == 'tek_terima' ? ' (' + data[i].KODE + ')' : '';
					barang = nama + ' ' + spesifikasi + kode;
					satuan = data[i].SATUAN;
					satuan_konv = data[i].SATUAN_KONV;
					qty_sip = desimal(data[i].QTY_SIP);
					outs = qty_sip - desimal(data[i].QTY_DATANG);
					nmr_po = data[i].NMR_PO == null ? '-' : data[i].NMR_PO;

					if (outs > 0) {
						urut++;
						$('#tbl_sip tbody').append('<tr><td hidden>'+id+'@'+satuan_konv+'</td><td align="center"><input type="checkbox" name="pilih" style="cursor: pointer;"></td><td align="center">'+urut+'</td><td align="center">'+tgl+'</td><td>'+no_sip+'</td><td>'+nmr_po+'</td><td>'+barang+'</td><td align="center">'+satuan+'</td><td align="right">'+format_number(Number(qty_sip).toFixed(2))+'</td><td align="right">'+format_number(Number(outs).toFixed(2))+'</td></tr>');
					}
				}
				pagination_input();
			}
		});
	}

// Pilih Data SIP
	function pilih_sip() {
		$('#tbl_sip').DataTable().destroy();

		var tbl_sip = document.getElementById('tbl_sip');
		var tabel_input = document.getElementById('tabel_input');
		var qty_data = tbl_sip.rows.length;

		if (tbl_sip.rows[1].cells[2].innerHTML != '1') {return;}
		for (var i=0; i<qty_data-1; i++) {
			var status = document.getElementsByName('pilih')[i].checked;

			if (status == true) {
				id = tbl_sip.rows[i+1].cells[0].innerHTML;
				id_sip_detail = id.split('@')[0];
				satuan_konv = id.split('@')[1];
				nmr_sip = tbl_sip.rows[i+1].cells[4].innerHTML;
				nmr_po = tbl_sip.rows[i+1].cells[5].innerHTML;
				barang = tbl_sip.rows[i+1].cells[6].innerHTML;
				satuan = tbl_sip.rows[i+1].cells[7].innerHTML;
				qty_sip = tbl_sip.rows[i+1].cells[8].innerHTML;
				tambah = true;

				for (var j=0; j<tabel_input.rows.length-1; j++) {
					t_id = tabel_input.rows[j+1].cells[0].innerHTML;
					if (id_sip_detail == t_id) {tambah = false;} 
				}

				if (tambah == true) {
					qty_datang = '0';
					deskripsi = '';
					isi_barang(id_sip_detail, nmr_sip, nmr_po, barang, satuan, satuan_konv, qty_sip, qty_datang, deskripsi);
				}
			}
		}
	}

// Tambah Material
	function isi_barang(id_sip_detail, nmr_sip, nmr_po, barang, satuan, satuan_konv, qty_sip, qty_datang, deskripsi) {
		var qty_row = $('#tabel_input tr').length - 1;
		var detail = $('#detail_kode').val();

		if (detail == '1' && qty_row > 0) {return;} 
		$('#tabel_input').append(
			'<tr>' +
			'<td hidden>' + id_sip_detail + '</td>' +
			'<td><input type="text" class="form-control text-sm" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><textarea class="form-control" rows="2" style="width: 100%; font-size: 14px;" readonly>' + nmr_sip + '</textarea></td>' +
			'<td><textarea class="form-control" rows="2" style="width: 100%; font-size: 14px;" readonly>' + nmr_po + '</textarea></td>' +
			'<td><textarea class="form-control" rows="2" style="width: 100%; font-size: 14px;" readonly>' + barang + '</textarea></td>' +
			'<td><input type="text" class="form-control text-sm" value="' + qty_sip + ' ' + satuan + '" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control text-sm num" value="' + qty_datang + '" name="qty_datang" style="width: 100%; text-align: right;" autocomplete="off"></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="satuan"></select></td>' +
			'<td><textarea class="form-control" name="deskripsi" rows="2" style="width: 100%; font-size: 14px;" maxlength="150" autocomplete="off">' + deskripsi + '</textarea></td>' +
			'<td align="center"><button type="button" class="btn btn-block btn-danger" title="Hapus Barang" onclick="hapus_barang(this)" style="width: 40px; height: 35px;"><i class="fa fa-trash"></button></td>' +
			'<td align="center" hidden><button type="button" class="btn btn-block btn-info" name="' + id_sip_detail + '@@' + satuan + '" title="Detail Barang" onclick="detail(this)" style="width: 40px; height: 35px;"><i class="fa fa-book"></button></td>' +
			'</tr>');

		satuan_konv = satuan_konv.split(',');
		satuan_konv.forEach(function(e) {$('[name="satuan"]:eq('+qty_row+')').append('<option>'+e+'</option>');});
		$('[name="satuan"]:eq('+qty_row+')').val(satuan).change();
		$(".select").select2();

		urut_no();
		numeric();
	} 

// Isi Nomor Urut Barang
	function urut_no() {
		var tabel_input = document.getElementById('tabel_input');
		for (var i=0; i<tabel_input.rows.length-1; i++) {
			document.getElementsByName('urut')[i].value = i+1;
		}
	}

// Hapus List Barang
	function hapus_barang(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		urut_no();
	};

// Isi Barang Non PO
	function add_barang() {
		$('#tabel_input').append(
			'<tr>' +
			'<td hidden></td>' +
			'<td><input type="text" class="form-control text-sm" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control text-sm" value="-" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control text-sm" value="-" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><div style="width: 240px;"><select class="form-control select" style="width: 100%;" name="barang" onchange="isi_satuan(this)">' +
			'<option value="">Pilih..</option> ' +
			'<?php foreach ($barang_non_tunai->result_array() as $dt) : ?>' +
			'<option value="<?php echo $dt['ID'] . '-' . $dt['SATUAN']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></div></td>' +
			'<td><input type="text" class="form-control text-sm" value="-" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control text-sm num" name="qty_datang" style="width: 100%; text-align: right;" autocomplete="off"></td>' +
			'<td><input type="text" class="form-control text-sm" name="satuan" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><textarea class="form-control" name="deskripsi" rows="2" style="width: 100%; font-size: 14px;" maxlength="150" autocomplete="off"></textarea></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Barang" onclick="hapus_barang(this)" style="width: 40px; height: 35px;"><i class="fa fa-trash"></button></td>' +
			'</tr>');

		$(".select").select2();
		urut_no();
		numeric();
	}

// Isi Satuan Non PO
	function isi_satuan(btn) {
		var tabel_input = document.getElementById('tabel_input');
		var row = $(btn).closest("tr").index();
		var satuan = $('[name="barang"]:eq('+row+')').val().split('-');

		tabel_input.rows[row+1].cells[0].innerHTML = satuan[0];
		$('[name="satuan"]:eq('+row+')').val(satuan[1]);
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
		var id_edit = $('#nmr').attr('name');
		var tabel_input = document.getElementById('tabel_input');
		var tipe = $('#tipe').val();
		var nmr = $('#nmr').val();
		var tgl = $('#tgl').val();
		var kd_unit = $('#unit').val();
		var nmr_sp = $('#nmr_sp').val().toUpperCase();
		var no_kend = $('#no_kend').val().toUpperCase();
		var qty_detail = $('#tbl_detail tbody tr').length;
		var id_sip_detail = [], qty_datang = [], satuan = [], deskripsi = [];

		if (nmr_sp == '') {error_isian('Nomor SP Supplier Belum diisi..');}
		if (tabel_input.rows.length == '1') {error_isian('Tidak ada barang yang dipilih..');}

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			t_qty_datang = document.getElementsByName('qty_datang')[i].value;
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_deskripsi = document.getElementsByName('deskripsi')[i].value;
			t_id_sip_detail = tabel_input.rows[i+1].cells[0].innerHTML;

			if (t_qty_datang == '' || t_qty_datang == 0) {error_isian('Qty Datang belum diisi..');}
			if (t_satuan == '') {error_isian('Satuan belum diisi..');}

			id_sip_detail.push(t_id_sip_detail);
			qty_datang.push(Number(angka(t_qty_datang)));
			satuan.push(t_satuan);
			deskripsi.push(t_deskripsi);
		}

		var barang = [id_sip_detail, qty_datang, satuan, deskripsi];
		var data = [id_edit, nmr, tgl, kd_unit, nmr_sp, barang, no_kend, tipe];

		$('#btnProgress').click();
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Terima_bp/simpan" ?>',
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

// Notifikasi Hapus Data
	function hapus(btn) {
		var id_hapus = btn.name;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/Terima_bp/hapus" ?>',
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

// Edit Data
	function edit(btn) {
		var id_edit = btn.name;

		$('#nmr').attr('name', id_edit);
		$("#tabel_input").find("tr:gt(0)").remove();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Terima_bp/edit" ?>',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);
				isi_data(data);
			}
		});
	}

// Isi Data Edit
	function isi_data(data) {
		$('#tgl').val(format_date(data[0].TGL)).change();
		$('#nmr').val(data[0].NMR).change();
		$('#unit').val(data[0].KD_UNIT).change();
		$('#nmr_sp').val(data[0].NMR_SP).change();
		$('#no_kend').val(data[0].NO_KEND).change();
		for (var i=0; i<data.length; i++) {
			id_sip_detail = data[i].ID_SIP_DETAIL;
			nmr_sip = data[i].NMR_SIP;
			nmr_po = data[i].NMR_PO == null ? '-' : data[i].NMR_PO.substring(0, data[i].NMR_PO.length-2);
			nama = data[i].NAMA;
			spesifikasi = data[i].SPESIFIKASI == '' || data[i].SPESIFIKASI == '-' ? '' : data[i].SPESIFIKASI;
			barang = nama + spesifikasi;
			satuan = data[i].SATUAN;
			satuan_konv = data[i].SATUAN_KONV;
			qty_sip = format_number(data[i].QTY_SIP);
			qty_datang = desimal(data[i].QTY_DATANG);
			deskripsi = data[i].DESKRIPSI == null ? '' : data[i].DESKRIPSI;

			isi_barang(id_sip_detail, nmr_sip, nmr_po, barang, satuan, satuan_konv, qty_sip, qty_datang, deskripsi);
		}

		$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
	}

// Cetak QR Code
	function isi_cetak() {
		var qty_data = $('#tbl tbody tr').length;
		var dt_cetak = [];

		for (var i=0; i<qty_data; i++) {
			status = $('#tbl input:eq('+i+')').is(':checked');
			id_cetak = $('#tbl input:eq('+i+')').attr('name');

			if (status == 'true') {
				dt_cetak.push(id_cetak);
			}
		}
       //  alert(dt_cetak);
		if (dt_cetak.length == 0) {error_isian('Tidak ada data yang dipilih..');}
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/Terima_bp/cetak" ?>',
			data: {data: dt_cetak},
			success: function(dt) {
				data = JSON.parse(dt);

				$('#modal_qr button:eq(0)').attr('name', dt);
				$('#modal_qr table:eq(0) tbody tr').remove();
				$('#modal_qr button:eq(2)').click();
				for (var i=0; i<data.length; i++) {
					$('#modal_qr table:eq(0)').append('<tr><td><input type="text" name="urut" class="form-control text-center" value="'+(i+1)+'" readonly></td><td><input type="text" name="kode" class="form-control text-center" value="'+data[i].KODE+'" readonly></td><td><input type="text" name="nama" class="form-control" value="'+data[i].NAMA + ' ' + data[i].SPESIFIKASI+'" readonly></td><td><input type="text" name="qty" class="form-control num text-center" value="'+data[i].QTY+'" autocomplete="off"></td></tr>');
				}
			}
		});
	}

// Kirim ke Printer sesuai Qty
	function cetak() {
		var data = JSON.parse($('#modal_qr button:eq(0)').attr('name'));
		var urut = 0;

		$('.p_label:gt(0)').remove();
		for (var i=0; i<data.length; i++) {
			qty_cetak = $('[name="qty"]:eq('+i+')').val();
			nama = (data[i].NAMA + ' ' + data[i].SPESIFIKASI).substring(0, 60);
			lokasi = data[i].NO_LOKASI;
			kode = data[i].KODE;
			kode_qr = (data[i].NAMA + ' ' + data[i].SPESIFIKASI).substring(0, 25) + ' (id.' + data[i].ID + ')';

			for (var j=0; j<qty_cetak; j++) {
				$(".p_label:eq(0)").clone().appendTo("#printable");
				$('.p_nama:eq('+(urut+1)+')').html(nama);
				$('.p_lokasi:eq('+(urut+1)+')').html('Lokasi : <b style="padding-left: 10px;">' + lokasi + '</b>');
				$('.p_kode:eq('+(urut+1)+')').html(kode);
				$('.qrcode:eq('+(urut+1)+')').html('').qrcode({
					text:  kode_qr,
					width: 80,
					height: 80
				});
				urut++;
			}
		}
		$('.p_label:gt(0)').removeAttr('hidden');	
		
		setTimeout(function() {
			var printable = document.getElementById('printable');
			var non_printable = document.getElementById('non_printable');

			printable.style.display = "";
			non_printable.style.display = "none";
			window.print();

			printable.style.display = "none";
			non_printable.style.display = "";
		}, 500);
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

// Drag Div Document
	$("#modal_sip").draggable({handle: ".card-header"});

</script>