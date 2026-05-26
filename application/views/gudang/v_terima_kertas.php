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
				<h3 class="card-title"><b><font color="White"><div id="headerinput">Penerimaan Kertas Banderoll</div></font></b></h3>
			</div>
			<div class="card-body" style="width: 100%; font-size: 13px;">
				<div class="table-responsive">
					<table style="width: 700px; margin-bottom: 10px;">
						<tr align="center" style="line-height: 30px;">
							<td colspan="2" width="35%" class="filter">Tanggal</td>
							<td></td>
							<td width="15%" class="filter">Desain</td>
							<td></td>
							<td width="20%" class="filter">No. Truk</td>
							<td></td>
							<td width="30%" class="filter">NPK - Roll</td>
						</tr>
						<tr>
							<td>
								<input id="fTgl1" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" readonly>
							</td>
							<td>
								<input id="fTgl2" type="text" style="cursor: pointer;" class="form-control datepicker text-center bg-white" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" readonly>
							</td>
							<td></td>	
							<td>
								<select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
									<?php foreach ($desain->result_array() as $dt) { ?>
										<option><?php echo $dt['DESAIN']; ?></option>
									<?php } ?>
								</select>
							</td>	
							<td></td>					
							<td>
								<input type="text" id="no_truk" class="form-control text-center" value="-" style="width: 100%; text-transform: uppercase;" autocomplete="off">
							</td>
							<td></td>						
							<td>
								<input type="text" id="cari" class="form-control text-center" onchange="filter()" value="" style="width: 100%; text-transform: uppercase;" autocomplete="off">
							</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<table>
						<tr>
							<td><button type="button" class="btn btn-block btn-success" onclick="filter()" style="margin: 0; width: 140px;"><i class="fa fa-send-o m-2"></i><b>View</b></button></td>
							<td width="10"></td>
							<td><button type="button" class="btn btn-block btn-primary" onclick="cetak()" style="margin: 0; width: 140px;"><i class="fa fa-print m-2"></i><b>Print</b></button></td>
							<td width="10"></td>
							<td><button type="button" class="btn btn-block btn-warning" onclick="tambah()" style="margin: 0; width: 140px;"><i class="fa fa-plus m-2"></i><b>Baru</b></button></td>
						</tr>
					</table>
				</div>	

				<font size="2">
					<div class="card mt-2 table-responsive" style="width: 100%;">
						<div class="datatable m-3"></div>
					</div>
				</font>
			</div>
		</div>
	</section>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="modal_edit">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info m-2">
				<div class="card-header" style="background-color: #0A86BF; cursor: all-scroll; height: 50px;">
					<h3 class="card-title font-weight-bold"><div id="ket_input">Edit Data Roll</div></h3>
				</div>
			</div>
			<div class="card card-body m-3">
				<div class="row">
					<div class="col-md-6">
						<table width="100%">
							<input type="text" id="e_id" hidden> 
							<tr>
								<th width="40%">Barcode</th>
								<td width="60%">
									<input type="text" id="e_barcode" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input id="e_tgl" type="text" style="cursor: pointer;" class="form-control datepicker bg-white" value="<?php echo date('d-M-Y'); ?>" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Desain</th>
								<td>
									<select class="select" id="e_desain" onchange="isi_bahan()" style="width: 100%; cursor: pointer;">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>       
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Kode Bahan</th>
								<td>
									<select class="select" id="e_bahan" style="width: 100%;" disabled>
										<option value="">Pilih..</option>
										<?php foreach($bahan->result_array() as $dt) { ?>
											<option><?php echo $dt['KODE_BAHAN']; ?></option>
										<?php } ?>
									</select>     
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor SPP</th>
								<td>
									<select class="select" id="e_spp" style="width: 100%; cursor: pointer;" disabled>
										<option value="">Pilih..</option>
										<?php foreach($spp->result_array() as $dt) { ?>
											<option><?php echo $dt['NO_SPP']; ?></option>
										<?php } ?>
									</select> 
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor NPK</th>
								<td>
									<input type="text" id="e_npk" class="form-control" onfocusout="cek_npk(); isi_barcode();" style="text-transform: uppercase;" maxlength="6" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-1"></div>
					<div class="col-md-5">
						<table width="100%">
							<tr>
								<th width="40%">Kode Roll</th>
								<td width="60%">
									<input type="text" id="e_kode" class="form-control" onkeyup="isi_berat()" onfocusout="cek_kode(); isi_barcode();" style="text-transform: uppercase;" maxlength="5" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Netto PDL</th>
								<td>
									<input type="text" id="e_pdl" class="form-control num2" onkeyup="isi_berat(); isi_barcode();" autocomplete="off">                 
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Netto PNP</th>
								<td>
									<input type="text" id="e_pnp" class="form-control num2" onkeyup="isi_berat()" autocomplete="off">                  
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Selisih</th>
								<td>
									<input type="text" id="e_selisih" class="form-control" readonly>               
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Toleransi</th>
								<td>
									<input type="text" id="e_toleransi" value="<?php echo $toleransi['toleransi']; ?>" name="<?php echo $toleransi['id_toleransi']; ?>" class="form-control" readonly>                 
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Netto Final</th>
								<td>
									<input type="text" id="e_netto" class="form-control" readonly>              
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="text-danger text-bold text-right mr-4 mb-2 invisible isian" style="font-size: 18px;">Isian belum lengkap..</div>
			<div class="modal-footer card-footer m-3">
				<button id="simpan" style="width: 130px;" type="button" class="btn btn-success"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
				<button id="tutup" onclick="kosong()" style="width: 130px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
				<button id="btnEdit" data-toggle="modal" data-target="#modal_edit" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable"	style="padding-left: 10px; padding-right: 10px; padding-bottom: 10px; display: none;">
	<table width="100%">
		<tr>
			<td colspan="3" align="center" style="font-size: 1.5em; line-height: 30px;">Bukti Pemeriksaan Dan Pengecekan Timbang Ulang <br> Kertas Banderol 60 Gsm Pada Saat Bongkar</td>
		</tr>			
		<tr>
			<td>Tanggal</td>
			<td>:</td>
			<td width="86.1%" id="print_tgl"></td>
		</tr>
		<tr>
			<td>No. Truk</td>
			<td>:</td>
			<td id="print_truk"></td>
		</tr>
	</table>
	<div class="content dataprint"></div>
	<p align="right" style="font-size: 12px;">F-SMT-G2-001 Rev.1</p>
	<table style="text-align: center; margin: auto;">
		<tr>
			<td>Ditimbang,</td>
			<td width="60%"></td>
			<td>Menyetujui,</td>
		</tr>
		<tr>
			<td style="height: 60px;"></td>
		</tr>
		<tr>
			<td>( Petugas PNP )</td>
			<td></td>
			<td>( Petugas PTKP )</td>
		</tr>
	</table>
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
		$('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

		filter();
	});

// Kosong Isian
	function kosong() {
		var toleransi = <?php echo json_encode($toleransi['toleransi']); ?>;
		var id_toleransi = <?php echo json_encode($toleransi['id_toleransi']); ?>;

		$('#e_id').val('').change();
		$('#e_barcode').val('').change();
		$('#e_pdl').val('').change();
		$('#e_pnp').val('').change();
		$('#e_selisih').val('').change();
		$('#e_netto').val('').change();

		$('#e_toleransi').val(toleransi);
		$('#e_toleransi').attr('name', id_toleransi);
		$('#e_pnp').attr('name','');
	}

// Print Tabel
	function cetak() {
		$('#data-table').DataTable().destroy();

		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data = $('.datatable').html();

		$('.dataprint').html(data);
		$('.datatable').html(data);
		$('.table-bordered:eq(1)').removeClass('table');
		$('.table-bordered:eq(1) tbody tr').css('height', '25px');
		$('.table-bordered:eq(1) tbody tr td').css('padding', '3px'); 

		$('.table-bordered:eq(1) thead tr:eq(0) th:gt(8)').hide();
		$('.table-bordered:eq(1) tbody').find('td:nth-child(12), td:nth-child(13)').hide();

		$('.table-bordered:eq(1) thead tr:eq(0)').find('th:eq(6), th:eq(8)').css('width', '40px');
		pagination();

		printable.style.display = "";
		non_printable.style.display = "none";
		window.print();

		printable.style.display = "none";
		non_printable.style.display = "";
	}

// Filter Tabel
	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var cari = document.getElementById('cari').value;
		var no_truk = $('#no_truk').val().toUpperCase();
		var desain = $('#fDesain').val().toUpperCase();
		var data = [tgl1, tgl2, cari, desain];

		$('.datatable').hide();
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/kertas/filter" ?>',
			success: function(data) {
				$('.datatable').show();
				setTimeout(function() {
					$('.datatable').html(data);
					$('#btnOk').click();
					pagination();
				}, 500);
			}
		});

	// Isi Header Print 
		document.getElementById('print_tgl').innerHTML = tgl2;
		document.getElementById('print_truk').innerHTML = no_truk;
	}

// Pagination
	function pagination() {	
		$('#data-table').DataTable().destroy();
		$('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"order": [],
			"columnDefs": [{"orderable": false, "targets": "_all"}],
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
				filename: 'Laporan Data IPB - Gudang',
				title: ''
			}],
			"colReorder": true
		});
	}

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	$('#simpan').click(function() {
		var id_edit = $('#e_id').val();
		var barcode = $('#e_barcode').val();
		var tgl = $('#e_tgl').val();
		var desain = $('#e_desain').val();
		var bahan = $('#e_bahan').val();
		var spp = $('#e_spp').val();
		var no_npk = $('#e_npk').val().toUpperCase();
		var kode_roll = $('#e_kode').val().toUpperCase();
		var kode = kode_roll.substring(4,5);
		var berat_pdl = $('#e_pdl').val();
		var berat_pnp = $('#e_pnp').val();
		var netto = $('#e_netto').val();
		var id_toleransi = $('#e_toleransi')[0].name;
		var id_timbang_ulang = $('#e_pnp')[0].name;
		var data = [id_edit, barcode, tgl, desain, bahan, spp, no_npk, kode_roll, berat_pdl, berat_pnp, netto, id_toleransi, id_timbang_ulang];

		if (no_npk.length != 6 || (no_npk.substring(4,6) != '/A' && no_npk.substring(4,6) != '/B') || Number(no_npk.substring(0,4)) == 'NaN') {error_isian('Format NPK salah..');}
		if (kode_roll.length != 5 || (kode != 'A' && kode != 'B') || Number(kode_roll.substring(0,4)) == 'NaN') {error_isian('Format Kode Roll salah..');}
		if (berat_pdl == '') {error_isian('Berat PDL belum diisi..');}
		if (bahan == '') {error_isian('Kode Bahan salah..');}
		if (barcode.length != 20) {error_isian('Barcode salah..');}

		$('#tutup').click();
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/kertas/simpan" ?>',
			data: {data: data},
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					filter();
					kosong();
				}, 500);
			}
		});
	});

// Error Format
	function error_format(str) {
		$('.isian:eq(0)').removeClass('invisible');
		$('.isian:eq(0)').html(str);
		setTimeout(function() {$('.isian:eq(0)').addClass('invisible');}, 3000);
	}

// Isi bahan
	function isi_bahan() {
		var kode_roll = $('#e_kode').val().toUpperCase();
		var kode = kode_roll.substring(4,5);
		var desain = $('#e_desain').val();
		var lebar = kode == 'A' ? '73' : '52,5';
		var data = [desain, lebar, kode_roll];

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/kertas/isi_bahan" ?>',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);
				$('#e_bahan').val(data[0]).change();
				$('#e_spp').val(data[1]).change();
			}
		});
	}

// Cek Kode Roll
	function cek_kode() {
		var kode_roll = $('#e_kode').val().toUpperCase();
		var kode = kode_roll.substring(4,5);

		if (kode_roll.length != 5 || (kode != 'A' && kode != 'B') || Number(kode_roll.substring(0,4)) == 'NaN') {
			error_format('Format Kode Roll salah..');
		}else{
			isi_bahan();
		}
	}

// Cek Selisih Berat
	function isi_berat() {
		var toleransi = $('#e_toleransi').val();
		var pdl = $('#e_pdl').val();
		var pnp = $('#e_pnp').val();
		$('#e_selisih').val('');
		$('#e_netto').val('');

		if (pdl != '' && pnp != '') {
			selisih = angka(pnp) - angka(pdl);
			netto = Math.abs(selisih.toFixed(2)) > 0.2 ? pnp : pdl;

			$('#e_selisih').val(Number(selisih).toFixed(2));
			$('#e_netto').val(Number(netto).toFixed(2));
		}
	}

// Isi Barcode
	function isi_barcode() {
		var desain = $('#e_desain').val();
		var no_npk = $('#e_npk').val().toUpperCase();
		var kode_roll = $('#e_kode').val().toUpperCase();
		var berat_pdl = $('#e_pdl').val() == '' ? 0 : angka($('#e_pdl').val());
		var barcode = desain.substring(2,4) + '.' + no_npk.replace('/','') + '.' + kode_roll + '.' + berat_pdl.toFixed(2).replace('.','');

		$('#e_barcode').val(barcode);
	}

// Cek Nomor NPK
	function cek_npk() {
		var npk = $('#e_npk').val().toUpperCase();

		if (npk.length != 6 || (npk.substring(4,6) != '/A' && npk.substring(4,6) != '/B') || Number(npk.substring(0,4)) == 'NaN') {
			error_format('Format NPK salah..');
		}
	}

// Tambah Baru
	function tambah() {
		$('#ket_input').html('Tambah Data Roll');
		$('#btnEdit').click();
	}

// Edit Data
	function edit(btn) {
		var data_table = $('#data-table tbody')[0];
		var row = $(btn).closest("tr").index();
		var id_edit = data_table.rows[row].cells[0].innerHTML;
		var e_toleransi = angka($('#e_toleransi').val());
		var e_id_toleransi = $('#e_toleransi')[0].name;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/kertas/edit" ?>',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);

				tgl = data.tgl;
				desain = data.desain;
				spp = data.spp;
				no_npk = data.no_npk;
				kode_roll = data.kode_roll;
				berat_pdl = angka(data.berat);
				berat_pnp = data.berat_pnp == null ? berat_pdl : angka(data.berat_pnp);
				toleransi = data.toleransi == null ? e_toleransi : angka(data.toleransi);
				id_toleransi = data.id_toleransi;
				id_timbang_ulang = data.id_timbang_ulang;

				selisih = berat_pnp == '' ? '' : berat_pnp - berat_pdl;
				netto = berat_pnp == '' ? '' : Math.abs(selisih.toFixed(2)) > 0.2 ? berat_pnp : berat_pdl;
				barcode = desain.substring(2,4) + '.' + no_npk.replace('/','') + '.' + kode_roll + '.' + berat_pdl.toFixed(2).replace('.','');

				$('#e_id').val(id_edit).change();
				$('#e_barcode').val(barcode).change();
				$('#e_tgl').val(tgl).change();
				$('#e_spp').val(spp).change();
				$('#e_npk').val(no_npk).change();
				$('#e_kode').val(kode_roll).change();
				$('#e_desain').val(desain).change();
				$('#e_pdl').val(berat_pdl.toFixed(2)).change();
				$('#e_pnp').val(berat_pnp == '' ? '' : berat_pnp.toFixed(2)).change();
				$('#e_selisih').val(selisih == '' ? '' : selisih.toFixed(2)).change();
				$('#e_netto').val(netto == '' ? '' : netto.toFixed(2)).change();
				$('#e_toleransi').val(toleransi == '' ? e_toleransi : toleransi.toFixed(2)).change();

				$('#e_toleransi').attr('name', toleransi == '' ? e_id_toleransi : id_toleransi);
				$('#e_pnp').attr('name', berat_pnp == '' ? '' : id_timbang_ulang);
			}
		});
		$('#ket_input').html('Edit Data Roll');
		$('#btnEdit').click();
	}

// Hapus Data
	function hapus(btn) {
		var data_table = $('#data-table tbody')[0];
		var row = $(btn).closest("tr").index();
		var id_hapus = data_table.rows[row].cells[0].innerHTML;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/kertas/hapus" ?>',
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

// Drag Div Document
	$("#modal_edit").draggable({handle: ".card-header"});

</script>