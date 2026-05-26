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

<div id="non_printable" class="content-wrapper" style="display: block;">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div id="headerinput">Kartu Perintah</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/PPIC - Manual Book Kartu Perintah.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
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
								<th width="40%">No. KP</th>
								<td>
									<div class="input-group">
										<input type="text" id="no_kp" class="form-control mr-2 text-center" tabindex="1" value="000" maxlength="3" onfocusout="isi_nomor()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off">
										<label id="no_trans" style="width: 75%; margin-top: 5px;">-</label>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Karyawan</th>
								<td>
									<input type="text" class="form-control" value="<?php echo $karyawan['NAMA']; ?>" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Divisi</th>
								<td>
									<select id="unit" class="select" onchange="auto_no()" style="width: 100%;" <?php if ($karyawan['AKSES'] == '1') {echo 'enable';} ?>>
										<!-- <option value="">Pilih Divisi..</option> -->
										<option value="12" <?php if ($karyawan['KD_UNIT'] == '12') {echo 'selected';} ?>>Holografi Cukai</option>
										<option value="01" <?php if ($karyawan['KD_UNIT'] == '01') {echo 'selected';} ?>>Holografi Non Cukai</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input id="tanggal" type="text" style="cursor: pointer;" class="form-control datepicker bg-white" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="auto_no()" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Produk</th>
								<td>
									<select class="select" id="nama_produk" style="width: 100%;">
										<option value="">Pilih Produk..</option>
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
								<th width="40%">Jenis</th>
								<td>
									<select class="select" id="jenis" style="width: 100%;">
										<option value="1">1 Up</option>
										<option value="2">Turunan</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Desain</th>
								<td>
									<?php $years = range(2026, 2025); ?>
									<?php $desain = date("Y"); ?>
									<select class="select" id="desain" onchange="auto_no()" style="width: 100%;">
										<?php foreach ($years as $dt) { ?>
											<option><?php echo $dt; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tipe</th>
								<td>
									<select id="tipe" class="select" onchange="auto_no()" style="width: 100%;">
										<option selected>Produksi</option>
										<option>Proof</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Deadline</th>
								<td>
									<input type="text" class="form-control datepicker" id="deadline" style="background-color: white; cursor: pointer;" placeholder="Deadline" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Note</th>
								<td>
									<textarea class="form-control" id="keterangan" rows="2" maxlength="100"></textarea>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<table>
					<tr>
						<td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
						<td width="10"></td>
						<td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
					</tr>
				</table>
			</div>

			<div class="card-body">
				<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 16px;">
					<table class="table table-bordered" style="width: 1000px;">
						<thead style="text-align: center; background-color: #06D288; color: #FFFFFF; font-weight: bold;">
							<tr style="line-height: 40px; background: #868484; color: #ffffff; text-align: center;">
								<td width="20%"></td>
								<td width="20%">Silver</td>
								<td width="20%">Matrix</td>
								<td width="20%">Madle</td>
								<td width="20%">PCH</td>
							</tr>
							<tr style="line-height: 30px; background: #868484; color: #ffffff;">
								<td>Qty</td>
								<td align="center"><input type="text" id="qty_1" autocomplete="off" maxlength="3" style="text-align: center; width: 55%" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
								<td align="center"><input type="text" id="qty_2" autocomplete="off" maxlength="3" style="text-align: center; width: 55%" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
								<td align="center"><input type="text" id="qty_3" autocomplete="off" maxlength="3" style="text-align: center; width: 55%" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
								<td align="center"><input type="text" id="qty_4" autocomplete="off" maxlength="3" style="text-align: center; width: 55%" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
							</tr>
							<tr style="line-height: 30px; background: #868484; color: #ffffff;">
								<td>Keterangan</td>
								<td align="center"><textarea class="form-control" id="note_1" rows="2" maxlength="50"></textarea></td>
								<td align="center"><textarea class="form-control" id="note_2" rows="2" maxlength="50"></textarea></td>
								<td align="center"><textarea class="form-control" id="note_3" rows="2" maxlength="50"></textarea></td>
								<td align="center"><textarea class="form-control" id="note_4" rows="2" maxlength="50"></textarea></td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White">Laporan Kartu Perintah</font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 11px; overflow-y: hidden;">
								<table style="width: 1300px; margin-bottom: 10px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<td width="20%" colspan="2" class="filter">Filter Tanggal</td>
											<td></td>
											<td width="10%" class="filter">Divisi</td>
											<td></td>
											<td width="10%" class="filter">Desain</td>
											<td></td>
											<td width="10%" class="filter">Tipe</td>
											<td></td>
											<td width="10%" class="filter">Master/ Copy</td>
											<td></td>
											<td width="15%" class="filter">Nomor KP</td>
											<td></td>
											<td width="15%" class="filter">Nama Material</td>
											<td></td>
											<td width="10%" class="filter">Jenis</td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="fTgl1" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
											<td><input id="fTgl2" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" readonly></td>
											<td></td>
											<td>
												<!-- <select class="select" id="fUnit" onchange="filter()" style="width: 100%; cursor: pointer;" <?php //if ($karyawan['AKSES'] == '1') {echo 'disabled';} ?>> -->
												<select class="select" id="fUnit" onchange="filter()" style="width: 100%; cursor: pointer;" >
													<option value="">All</option>
													<option value="12" <?php if ($karyawan['KD_UNIT'] == '12') {echo 'selected';} ?>>Holografi</option>
													<option value="01" <?php if ($karyawan['KD_UNIT'] == '01') {echo 'selected';} ?>>Holo Perdana</option>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
													<option>All</option>
													<?php foreach ($dt_desain->result_array() as $dt) { ?>
														<option><?php echo $dt['DESAIN']; ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fTipe" onchange="filter()" style="width: 100%; cursor: pointer;">
													<option>All</option>
													<option>Produksi</option>
													<option>Proof</option>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fMaster" onchange="filter()" style="width: 100%; cursor: pointer;">
													<option>All</option>
													<option>PCH</option>
													<option>Silver</option>
													<option>Matrix</option>
													<option>Madle</option>
												</select>
											</td>
											<td></td>
											<td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari KP.." style="width: 100%;"></td>
											<td></td>
											<td><input type="text" class="cari" id="fNama" autocomplete="off" onchange="filter()" placeholder="Cari material.." style="width: 100%;"></td>
											<td></td>
											<td>
												<select class="select" id="fJenis" onchange="filter()" style="width: 100%; cursor: pointer;">
													<option value="All">All..</option>
													<option value="1">1 Up</option>
													<option value="2">Turunan</option>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="data-table"></div>

							<table class="mt-4">
								<tr>
									<td width="120"><button type="button" class="btn btn-block btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
								</tr>
							</table>

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

<div id="printable" style="display: none; margin-left: 1cm;">
	<div style="width: 200px;  margin-bottom: -50px;">
		<img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 15mm; width: auto;">
	</div>

	<div style="height: 6mm;"></div>
	<h4 class="text-center"><b><u>KARTU PERINTAH GALVANIK</u></b></h4>

	<div style="height: 4mm;"></div>
	<table id="p_header" width="100%">
		<tr>
			<td width="25%">No. Kartu Perintah</td>
			<td width="5%">:</td>
			<td width="70%">096/PNP-HLG/PPC/KP/X/2020</td>
		</tr>
		<tr>
			<td>Jenis</td>
			<td>:</td>
			<td>PCH Hologram Materai 10K Desain TA 2021 (Master Baru, Media Akrilic)</td>
		</tr>
		<tr style="height: 10px;"></tr>
		<tr>
			<td>Pemesan</td>
			<td>:</td>
			<td>Proof Produksi</td>
		</tr>
		<tr>
			<td>Macam Pesanan</td>
			<td>:</td>
			<td>PCH Hologram Materai 10K Desain TA 2021 (Master Baru, Media Akrilic)</td>
		</tr>
	</table>

	<div style="height: 4mm;"></div>
	<div id="p_body" class="card p-2">
		<table width="100%" style="border-top: 1px solid black;">
			<tr>
				<td></td>
				<td width="20%">Mesin</td>
				<td width="5%">:</td>
				<td width="75%">1 s/d 5</td>
			</tr>
			<tr>
				<td></td>
				<td>Kode</td>
				<td>:</td>
				<td></td>
			</tr>
			<tr>
				<td></td>
				<td>Ukuran</td>
				<td>:</td>
				<td>80 x 60 Cm</td>
			</tr>
			<tr>
				<td></td>
				<td>Qty</td>
				<td>:</td>
				<td>5 Lembar</td>
			</tr>
			<tr>
				<td></td>
				<td>Speck.</td>
				<td>:</td>
				<td>Sesuai Permintaan</td>
			</tr>
			<tr>
				<td></td>
				<td>Kondisi Mesin</td>
				<td>:</td>
				<td>Sesuai IK</td>
			</tr>
			<tr>
				<td></td>
				<td>Deltime</td>
				<td>:</td>
				<td>02-Nov-2020</td>
			</tr>
		</table>
	</div>

	<div id="no_form" style="text-align: right; font-size: 12px;">F-SMT-PPC2-003 Rev.01</div>
	<div class="p-5" style="margin-top: -50px;">
		<div id="p_tgl">Kudus, 27 Oktober 2020</div>
		<div>Hormat kami,</div>
		<div style="height: 15mm;"></div>
		<div class="font-weight-bold" id="p_approval" style="text-decoration: underline;">Argantara R.</div>
		<div id="p_title" <?php if ($karyawan['KD_UNIT'] == '01') {echo 'hidden';} ?>>Kabag PPIC & Kiriman</div>
		<div style="height: 4mm;"></div>
	</div>
	<div style="padding-left: 100px; margin-top: -50px;">
		<div>Cc :</div>
		<div>1. Yth. Bag. Internal Security</div>
		<div>2. Yth. Bag. QC</div>
		<div <?php if ($karyawan['KD_UNIT'] == '12') {echo 'hidden';} ?>>2. Yth. Bag. Gudang & Pengadaan</div>
		<div><?php if ($karyawan['KD_UNIT'] == '01') {echo '4';}else{echo '3';} ?>. File</div>
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
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
	var dt_id_produk = [];

// Load Dokumen
	$(document).ready(function() {
		// $('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
		auto_no();
		filter();
	});

// Format Tanggal DD-MMM-YYYY
	function format_date(date) {
		try {
			var tgl = date.substring(0, 2);
			var month = parseInt(date.substring(3, 5)) - 1;
			var thn = date.substring(6);

			var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
			var bln = bln[month];
			return tgl + '-' + bln + '-' + thn;
		} catch (err) {}
	}

// Kosong Isian
	function kosong() {
		$("#nama_produk").val("Pilih Produk..").change();
		document.getElementById("deadline").value = '';
		document.getElementById("qty_1").value = '';
		document.getElementById("qty_2").value = '';
		document.getElementById("qty_3").value = '';
		document.getElementById("qty_4").value = '';
		document.getElementById("keterangan").value = '';

		$('#note_1').val('');
		$('#note_2').val('');
		$('#note_3').val('');
		$('#note_4').val('');
		
		auto_no();
		dt_id_produk = [];
	}

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		var tbl = $('#data-table').DataTable({
			"paging": false,
			"ordering": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "350px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				title: 'LAPORAN KARTU PERINTAH'
			}],
			"colReorder": true
		});

		setTimeout(function() {tbl.columns.adjust().draw();}, 500);
	}

// Isi Format Nomor 5 angka
	function isi_nomor() {
		var no_kp = $('#no_kp').val();
		var no_kp = no_kp.toString().padStart(3, "0");

		$('#no_kp').val(no_kp);
	}

// Auto Nomor KP
	function auto_no() {
		var tgl = $('#tanggal').val();
		var bln = tgl.substring(3,6);
		var dt_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
		var indeks = dt_bln.indexOf(bln);
		var kd_bln = romawi(indeks+1);
		var desain = $('#desain').val();
		var unit = $('#unit').val();
		var tipe = $('#tipe').val();
		var kd_form = unit == '01' ? 'HOLO PERDANA' : 'HLG';
		var data = [desain, unit, tipe];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/ppic/kp/auto_no" ?>',
			success: function(data) {
				if (unit == '') {
					$('#no_kp').val('000');
					$('#no_trans').html('-');
				}else{
					$('#no_kp').val(data);
					// unit == '01' ? $('#no_trans').html('/PNP-' + kd_form + '/PPIC/KP-N/' + kd_bln + '/' + desain) : $('#no_trans').html('/PNP-HLG/PPIC/KP-C/' + kd_bln + '/' + desain);
					unit == '01' ? $('#no_trans').html('/PNP-HLG/PPIC/KP-N/' + kd_bln + '/' + desain) : $('#no_trans').html('/PNP-HLG/PPIC/KP-C/' + kd_bln + '/' + desain);
					isi_produk();
				}
			}
		});
	}

// Isi Produk Sesuai Unit
	function isi_produk() {
		var dt_produk = <?php echo json_encode($produk->result_array()); ?>;
		var desain = $('#desain').val();
		var unit = $('#unit').val();
		var nama_produk = document.getElementById('nama_produk');
		var option = document.createElement('option');

		dt_id_produk = [];
		$("#nama_produk").empty();
		$('#nama_produk').append(new Option('Pilih Produk..'));
		$('#nama_produk').val('Pilih Produk..').change();

		unit == '12' ? kd = 'C' : kd = 'N';
		for (var i=0; i<dt_produk.length; i++) {
			kode = dt_produk[i].KODE.substring(0,1);
			desain = unit == '01' ? dt_produk[i].TAHUN : desain;

			if (kd == kode && desain == dt_produk[i].TAHUN) {
				barang = dt_produk[i].NAMA + (unit == '12' ? '' : ' (' + dt_produk[i].UKURAN + ')');
				nama_produk.options[nama_produk.options.length] = new Option(barang);
				dt_id_produk.push(dt_produk[i].ID);
			}

			// if (desain == dt_produk[i].TAHUN) {
			// 	barang = dt_produk[i].NAMA + (unit == '12' ? '' : ' (' + dt_produk[i].UKURAN + ')');
			// 	nama_produk.options[nama_produk.options.length] = new Option(barang);
			// 	dt_id_produk.push(dt_produk[i].ID);
			// }
		}
	}

// Filter Data KP
	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var kd_unit = document.getElementById('fUnit').value;
		var cari = document.getElementById('cari').value;
		var desain = document.getElementById('fDesain').value;
		var tipe = document.getElementById('fTipe').value;
		var master = document.getElementById('fMaster').value;
		var nama = document.getElementById('fNama').value;
		var jenis = document.getElementById('fJenis').value;
		var data = [tgl1, tgl2, kd_unit, cari, desain, tipe, master, nama, jenis];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/ppic/kp/filter_kp" ?>',
			success: function(data) {
				$('.data-table').html(data);
				setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
			}
		});
	}

// Cek Duplikasi Nomor
	function cek_nomor(urut,unit,desain) {
		var dobel = 0;
		var data = [urut,unit,desain];

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/kp/cek_nomor',
			data: {data: data},
			success: function(data) {
				dobel = data;
			}
		});
		return dobel;
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}
	$('#modal_sukses button:eq(0)').click(function() {
		$('#modal_sukses .modal-body:eq(0)').html('Data Tersimpan..');
	});

	function simpan() {
		var urut = $('#no_kp').val();
		var trans = $('#no_trans').html();
		var no_kp = urut + trans;
		var unit = document.getElementById("unit").value;
		var tanggal = document.getElementById("tanggal").value;
		var tipe = document.getElementById("tipe").value;
		var deadline = document.getElementById("deadline").value;
		var desain = document.getElementById("desain").value;
		var keterangan = document.getElementById("keterangan").value;
		var cek_nmr = cek_nomor(urut,unit,desain);
		var i_produk = document.getElementById('nama_produk').selectedIndex - 1;
		var id_produk = i_produk == -1 ? '' : dt_id_produk[i_produk];
		var jenis = $('#jenis').val();
		var qty_jenis = 0;

		for (var i=1; i<=4; i++) {
			window['qty_' + i] = document.getElementById("qty_" + i).value;
			window['note_' + i] = document.getElementById("note_" + i).value;
			if (window['qty_' + i] > 0) {qty_jenis++;}
		}

		var data = [tanggal, no_kp, tipe, id_produk, deadline, desain, qty_1, qty_2, qty_3, qty_4, unit, keterangan, jenis, note_1, note_2, note_3, note_4];

		if (unit == '') {error_isian('Divisi belum diisi..');}
		if (no_kp == '000' || trans == '-') {error_isian('Nomor KP salah..');}
		if (cek_nmr != 0) {error_isian('Nomor sudah terpakai..');}
		if (id_produk == '') {error_isian('Nama Produk belum diisi..');}
		if (deadline == '') {error_isian('Deadline belum diisi..');}
		if (qty_1 < '1' && qty_2 < '1' && qty_3 < '1' && qty_4 < '1') {error_isian('Qty belum diisi..');}
		if (qty_jenis > 1 && unit == '12') {error_isian('Permintaan Master harus dipisah..');}

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/kp/simpan_kp',
			data: {data: data},
			success: function() {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					kosong();
					filter();
				}, 500);
			}
		});
	}

// Menu Cetak
	function cetak(btn) {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data_table = document.getElementById('data-table');
		var p_header = document.getElementById('p_header');
		var p_body = document.getElementById('p_body');
		var row = $(btn).closest("tr").index() + 1;
		var id_kp_detail = data_table.rows[row].cells[0].innerHTML;

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/kp/cetak',
			data: {data: id_kp_detail},
			success: function(data) {
				data = JSON.parse(data);

				nmr = data[0].NMR;
				jenis = data[0].JENIS;
				tipe = data[0].TIPE;
				nama = data[0].NAMA;
				spesifikasi = data[0].SPESIFIKASI;
				ukuran = data[0].UKURAN;
				deadline = data[0].DEADLINE;
				tgl = data[0].TGL;
				p_approval = jenis == 'Cukai' ? proper(data[0].PIC.split('@')[0]) : '......................';
				p_title = data[0].PIC.split('@')[1];
				no_form = jenis == 'Cukai' ? 'F-SMT-PPC2-003 Rev.01' : 'F-SMT-PPIC1-010 Rev. 00';
				qty_master = data[0].QTY_MASTER;

				p_header.rows[0].cells[2].innerHTML = nmr;
				p_header.rows[1].cells[2].innerHTML = jenis;
				p_header.rows[3].cells[2].innerHTML = tipe;
				p_header.rows[4].cells[2].innerHTML = nama + ' ' + spesifikasi;

				$("#p_body table:gt(0)").remove();
				for (var i=0; i<qty_master; i++) {
					master = data[i].MASTER;
					qty = data[i].QTY;

					if (i != 0) {$("#p_body table:eq(0)").clone().appendTo("#p_body");}
					$('#p_body table:eq('+i+') tr:eq(1) td:eq(3)').html(master);
					$('#p_body table:eq('+i+') tr:eq(2) td:eq(3)').html(ukuran);
					$('#p_body table:eq('+i+') tr:eq(3) td:eq(3)').html(qty + ' Lembar');
					$('#p_body table:eq('+i+') tr:eq(6) td:eq(3)').html(deadline);
				}

				$('#p_tgl').html('Kudus, ' + tgl);
				$('#p_approval').html(p_approval);
				$('#p_title').html(p_title);
				$('#no_form').html(no_form);
				$('#p_body table:eq('+(qty_master-1)+')').css('border-bottom', '1px solid black');

				printable.style.display = "";
				non_printable.style.display = "none";
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

// Get Romawi Bulan
	function romawi(str) {
		var dt_romawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];

		return dt_romawi[str-1];
	}

// Notifikasi Hapus Data
	function hapus(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_hapus = data_table.rows[row].cells[0].innerHTML;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}
			
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/ppic/kp/hapus',
				data: {data: id_hapus},
				success: function(data) {
					if (data != '') {$('#modal_sukses .modal-body:eq(0)').html('Data sudah tervalidasi Galvanik..');}

					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						filter();
						id_hapus == '';
					}, 500);
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (id_hapus == '') {return;}
			id_hapus == '';
		});
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