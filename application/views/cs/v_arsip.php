<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<style>body {padding-right: 0 !important}</style>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Custom CSS -->
<style>

	.select2-container--open {
		z-index: 9999999;
	}

	.btn-grad {
		position: relative;
		width: 100px;
		text-align: center;
		transition: 0.5s;
		background-size: 200% auto;
		color: white;            
		box-shadow: 0 0 20px #eee;
		border-radius: 10px;
		background-image: linear-gradient(to right, #c21500 0%, #ffc500  51%, #c21500  100%);
	}

	.btn-grad:hover {
		background-position: right center;
		color: #fff;
		text-decoration: none;
	}

	.more:hover {
		font-weight: bold;
	}

	.button-86 {
		all: unset;
		width: 100px;
		height: 30px;
		font-size: 16px;
		background: transparent;
		border: none;
		position: relative;
		color: #f0f0f0;
		cursor: pointer;
		z-index: 1;
		padding: 10px 20px;
		display: flex;
		align-items: center;
		justify-content: center;
		white-space: nowrap;
		user-select: none;
		-webkit-user-select: none;
		touch-action: manipulation;
	}

	.button-86::after,
	.button-86::before {
		content: '';
		position: absolute;
		bottom: 0;
		right: 0;
		z-index: -99999;
		transition: all .4s;
	}

	.button-86::before {
		transform: translate(0%, 0%);
		width: 100%;
		height: 100%;
		background: #28282d;
		border-radius: 10px;
	}

	.button-86::after {
		transform: translate(10px, 10px);
		width: 35px;
		height: 35px;
		background: #ffffff15;
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		border-radius: 50px;
	}

	.button-86:hover::before {
		transform: translate(5%, 20%);
		width: 110%;
		height: 110%;
	}

	.button-86:hover::after {
		border-radius: 10px;
		transform: translate(0, 0);
		width: 100%;
		height: 100%;
	}

	.button-86:active::after {
		transition: 0s;
		transform: translate(0, 5%);
	}
</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header bg-secondary">
				<h3 class="card-title text-center" style="font-size: 48px;"><b>Arsip Holografi</b></h3>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="row justify-content-center">
						<div class="col-md-5">
							<div class="card card-body m-3">
								<input type="text" id="f_cari" class="form-control p-4 pl-5 mb-2 cari" style="font-size: 22px;" placeholder="Ketik deskripsi isi.." autocomplete="off">
								<button type="button" onclick="filter()" class="btn btn-secondary" title="Mencari arsip.."><i class="fa fa-search m-2"></i><b>Cari</b></button>
								<font class="mt-2 more" style="cursor: pointer; color: #0000B9;" onclick="$('#btn_filter').click();">More..</font>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="datatable m-3"></div>
						</div>
					</div>
					<div class="card-footer d-flex">
						<button type="button" class="btn button-86 mr-4" onclick="(function(){ $('.excel').click(); })();" style="width: 150px;" title="Export to Excel" title="Ambil Arsip"><i class="fa fa-clipboard m-2"></i><b>Export..</b></button>
						<button type="button" class="btn button-86" onclick="isi_ambil()" style="width: 150px;" data-toggle="modal" data-target="#modal_ambil"><i class="fa fa-download m-2"></i><b>Ambil..</b></button>
					</div>
				</div>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header bg-secondary">
				<h3 class="card-title text-center" style="font-size: 48px;"><b>Alamat Arsip</b></h3>
			</div>
			<div class="card-body">
				<div class="text-center input-group mb-2 d-flex" style="font-family: Cursive;">
					<div class="bg-danger ml-auto mr-2" style="height: 30px; width: 100px; border: 1px solid #B0B0B0;">Isi</div>
					<div style="height: 30px; width: 100px; border: 1px solid #B0B0B0;">Kosong</div>
				</div>
				<div class="card card-body" style="background-color: #CCCCCC;"><div class="row daftar_rak"></div></div>
			</div>
		</div>

		<div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
	</section>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<h5><div class="modal-body text-info invisible" id="error_isian"></div></h5>
			<div class="modal-footer">
				<button id="btn_ok" style="width: 50%;" type="button" class="btn btn-grad" data-dismiss="modal"><i class="fa fa-ban mr-2" onclick="$('#error_isian').addClass('invisible')"></i><b>OK</b></button>
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
				<button style="width: 30%;" type="button" class="btn btn-grad" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan mengambil arsip? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-grad" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-grad" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Daftar Rak -->
<div class="modal fade" id="modal_lihat">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card-header bg-secondary rounded text-center m-2" style="cursor: all-scroll; height: 50px;">
				<b><h3 class="text-white lihat_bagian">Arsip Sistem</h3></b>
			</div>
			<div class="card-body table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
				<button type="button" class="btn btn-grad" style="width: 230px;"><i class="fa fa-book mr-2"></i><b class="lihat_rak"></b></button>
				<textarea class="form-control lihat_isi mt-3" rows="10" style="width: 100%; font-size: 16px;" readonly></textarea>  
			</div>
			<div class="modal-footer rounded">
				<button id="btn_lihat" data-toggle="modal" data-target="#modal_lihat" hidden></button>
				<button style="width: 150px;" type="button" class="btn button-86 mr-4" onclick="cetak('')" title="Cetak Label" data-dismiss="modal"><i class="fa fa-print m-2"></i><b>Cetak</b></button>
				<button style="width: 150px;" type="button" class="btn button-86" title="Tutup Detail" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Ambil Arsip -->
<div class="modal fade" id="modal_ambil">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card-header bg-secondary rounded text-center m-2" style="cursor: all-scroll; height: 50px;">
				<b><h3 class="text-white lihat_bagian">Daftar Ambil Arsip</h3></b>
			</div>
			<div class="card-body table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
				<table id="tbl_ambil" class="table table-bordered table-striped" style="width: 100%;">
					<thead>
						<tr align="center">
							<th width="5%">No.</th>
							<th width="10%">Pemilik Arsip</th>
							<th width="10%">Bagian</th>
							<th width="5%">Kode Rak</th>
							<th width="10%">Nomor Box</th>
							<th>Isi Box</th>
							<th width="10%">Tanggal Arsip</th>
							<th width="10%">Tanggal Ambil</th>
							<th width="5%">Nama Pengambil</th>
							<th>Cetak</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table> 
			</div>
			<div class="modal-footer rounded">
				<button style="width: 150px;" type="button" class="btn button-86" title="Tutup Detail" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Filter Rak -->
<div class="modal fade" id="modal_filter">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card-header bg-secondary rounded m-2 text-center" style="cursor: all-scroll; height: 50px;">
				<b><h4>More Filter</h4></b>
			</div>
			<div class="card-body table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
				<div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
					<table style="width: 650px; margin-left: auto; margin-right: auto;">
						<thead>
							<tr align="center" style="line-height: 30px;">
								<th width="40%" class="filter bg-secondary p-1">Bagian</th>
								<td></td>
								<th width="30%" class="filter bg-secondary p-1">Kode Rak</th>
								<td></td>
								<th width="30%" class="filter bg-secondary p-1">Nomor Rak</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="select" id="f_bagian" style="width: 100%;">
										<option value="All">All..</option>	
										<?php foreach($bagian->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>" <?php if (in_array($dt['ID'], $karyawan[2]) && $status_menu != '2') {echo 'selected';} ?>><?php echo $dt['BAGIAN']; ?></option>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="f_kode_rak" style="width: 100%;">
										<option value="All">All..</option>	
										<?php foreach($kode_rak->result_array() as $dt) { ?>
											<?php if ($dt['ISI'] == '0')  { ?>
												<option><?php echo $dt['KODE']; ?></option>						
											<?php } ?>
										<?php } ?>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="f_nomor_rak" style="width: 100%;">
										<option value="All">All..</option>	
										<?php foreach($nomor_rak->result_array() as $dt) { ?>
											<option><?php echo $dt['NOMOR_RAK']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
				</div> 
			</div>
			<div class="modal-footer rounded">
				<button id="btn_filter" data-toggle="modal" data-target="#modal_filter" hidden></button>
				<button style="width: 150px;" type="button" class="btn button-86 mr-4" onclick="filter()" data-dismiss="modal" title="Filter Detail"><i class="fa fa-search m-2"></i><b>Filter</b></button>
				<button style="width: 150px;" type="button" class="btn button-86" title="Tutup Detail" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tambah Arsip -->
<div class="modal fade" id="modal_arsip" style="margin: 10px; margin-top: 50px;">
	<div class="modal-dialog" style="max-width: 1000px; margin: auto;">
		<div class="modal-content">
			<div class="card-header bg-secondary rounded m-2 text-center" style="cursor: all-scroll; height: 50px;">
				<b><h4>Arsip Baru</h4></b>
			</div>
			<div class="card card-body m-3" style="font-size: 13px;">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Nama Karyawan</th>
								<td width="60%">
									<input type="text" id="kary" name="<?php echo $karyawan[0]; ?>" class="form-control" value="<?php echo $karyawan[1]; ?>" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th >Bagian</th>
								<td>
									<select class="select" id="bagian" onchange="urut_bagian()" style="width: 100%;">
										<?php foreach($bagian->result_array() as $dt) { ?>
											<?php if (in_array($dt['ID'], $karyawan[2])) { ?>
												<option value="<?php echo $dt['ID'] . '@' . $dt['KODE']; ?>" <?php if ($dt['ID'] == $karyawan[3]) {echo 'selected';} ?>><?php echo $dt['BAGIAN']; ?></option>
											<?php } ?>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Kode Rak</th>
								<td>
									<input type="text" id="kode_rak" class="form-control" name="" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor Box</th>
								<td>
									<div class="input-group">
										<input type="text" id="urut_box" class="num" style="width: 120px; text-align: center; font-size: 18px;" maxlength="3">
										<input type="text" id="kode_box" class="form-control" readonly>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<table width="100%">
							<tr>
								<th width="40%">Tanggal Arsip</th>
								<td width="60%">
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Isi Box</th>
								<td>
									<textarea id="isi" class="form-control" rows="4" style="width: 100%; font-size: 16px;" maxlength="500" autocomplete="off"></textarea>  
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Retensi <br> (Tahun)</th>
								<td>
									<input type="text" id="retensi" class="form-control num" maxlength="2" autocomplete="off">
								</td>
							</tr>
						</table>						
					</div>
				</div>
			</div>
			<div class="modal-footer rounded m-3">
				<button type="button" class="btn button-86 mr-4" style="width: 120px;" onclick="simpan()" data-dismiss="modal"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
				<button type="button" class="btn button-86" style="width: 120px;" onclick="kosong()" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
				<button id="btn_arsip" data-toggle="modal" data-target="#modal_arsip" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden;">
	<div style="min-height: 155mm; font-size: 24px; border: 1px solid #000; margin: 10mm;">
		<div class="row m-2" style="height: 27mm; border-bottom: 1px solid #000;">
			<div class="col-6">
				<img src="<?php echo base_url();?>assets/images/logo_pnp.png" class="mb-2" style="height: 25mm; width: auto;">
			</div>
			<div class="col-6">
				<p><h1>NO. BOX : </h1></p>
			</div>
		</div>
		<div class="p-2">
			<img src="<?php echo base_url();?>assets/images/profits-1.png" class="mb-2" style="width: 90mm; position: absolute; margin-left: 30%; opacity: 0.2;">
			<table width="100%">
				<tr>
					<th style="width: 50mm;">BAGIAN</th>
					<td style="width: 5mm;">:</td>
					<td></td>
				</tr>
				<tr style="height: 10px;"></tr>
				<tr class="align-text-top">
					<th>ISI</th>
					<td>:</td>
					<td style="display: inline-block; min-height: 75mm;"></td>
				</tr>
				<tr style="height: 10px;"></tr>
				<tr>
					<th>MASA RETENSI</th>
					<td>:</td>
					<td></td>
				</tr>
				<tr style="height: 10px;"></tr>
				<tr>
					<th>TGL. ARSIP</th>
					<td>:</td>
					<td></td>
				</tr>
			</table>
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

// Defined Variable
	var dt_kary = <?php echo json_encode($karyawan); ?>;

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
		daftar_rak();
		filter();

		$('#non_printable').removeClass('content-wrapper');
		$('.main-header:eq(0)').hide();
		$('.main-sidebar:eq(0)').hide();
		$('.content').css('margin-top','-20px');
	});

// Isi Daftar Ketersediaan Rak
	function daftar_rak() {
		var aktif_rak = '', aktif_baris = '', urut_rak = -1, urut_baris = -1;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/daftar_rak" ?>',
			success: function(data) {
				dt_rak = JSON.parse(data);

				$('.daftar_rak:eq(0)').empty();
				for (var i=0; i<dt_rak.length; i++) {
					rak = dt_rak[i].RAK;
					baris = dt_rak[i].BARIS;
					c_color = dt_rak[i].ISI != 0 ? 'bg-danger' : 'bg-white';
					title = dt_rak[i].ISI != 0 ? 'Klik untuk melihat..' : 'Klik untuk mengisi..';

					if (rak != aktif_rak) {
						$('.daftar_rak:eq(0)').append('<div class="col-md-6"><button type="button" class="btn button-86 mb-2" title="'+dt_rak[i].AREA+'" style="width: 150px;"><i class="fa fa-book mr-2"></i><b>Rak : '+dt_rak[i].RAK+'</b></button><table class="table table-bordered tbl_rak mb-3" style="background-color: #FFFFFF;"><tr><td align="center" class="'+c_color+'" onclick="lihat(this)" style="cursor: pointer;" title="'+title+'">'+dt_rak[i].KODE+'</td></tr></table></div>');
						urut_rak++;
						urut_baris = 0;
					}else{
						if (baris != aktif_baris) {
							$('.tbl_rak:eq('+urut_rak+')').append('<tr><td align="center" class="'+c_color+'" onclick="lihat(this)" style="cursor: pointer;" title="'+title+'">'+dt_rak[i].KODE+'</td></tr>');
							urut_baris++;
						}else{
							$('.tbl_rak:eq('+urut_rak+') tr:eq('+urut_baris+')').append('<td align="center" class="'+c_color+'" onclick="lihat(this)" style="cursor: pointer;" title="'+title+'">'+dt_rak[i].KODE+'</td>');
						}
					}
					aktif_rak = rak;
					aktif_baris = baris;
				}
			}
		});
	}

// Lihat Isi Rak
	function lihat(btn) {
		var rak = btn.innerHTML;
		var warna = btn.className;

		if (warna != 'bg-danger') {
			$('#btn_arsip').click();
			$('#kode_rak').val(rak);
			$('#kary').val(dt_kary[1]).attr('name', dt_kary[0]);
			urut_bagian();
			$('#bagian').val(dt_kary[3] + '@' + dt_kary[4]).change();
			return;
		}

		$('#btn_lihat').attr('name', rak);
		$('#btn_lihat').click();
		$.ajax({
			data: {data: rak},
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/lihat" ?>',
			success: function(data) {
				data = JSON.parse(data);

				$('.lihat_bagian:eq(0)').html('ARSIP ' + data.BAGIAN);
				$('.lihat_rak:eq(0)').html('LOC. ' + data.KODE_RAK + ' : ' + data.KODE_BOX + '-' + data.URUT_BOX);
				$('.lihat_isi:eq(0)').html('Daftar Isi : \n' + data.ISI);
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
				filename: 'Laporan Arsip Holografi',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{width: 550, targets: 8}]
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Format Urut Box
	$('#urut_box').focusout(function() {
		var urut_box = format_text($('#urut_box').val(), 3);
		$('#urut_box').val(urut_box);
	});
	$('#urut_box').focus(function() {
		var urut_box = angka($('#urut_box').val());
		$('#urut_box').val(urut_box);
	});

// Kosong Isian
	function kosong() {
		$('#kode_rak').attr('name', '');
		$('#kode_rak').val('').change();
		$('#isi').val('').change();
		$('#retensi').val('').change();
		urut_bagian();
	}

// Isi Nomor Urut Bagian
	function urut_bagian() {
		var id_bagian = $('#bagian').val().split('@')[0];
		var kode_bagian = $('#bagian').val().split('@')[1];
		var kode_rak = $('#kode_rak').val();
		var id_edit = $('#kode_rak').attr('name');

		$.ajax({
			data: {data: id_bagian},
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/urut_bagian" ?>',
			success: function(data) {
				urut_box = id_edit == '' ? data : $('#urut_box').val();
				$('#urut_box').val(urut_box);
				isi_kode();
			}
		}); 
	}

// Isi Kode
	function isi_kode() {
		var kode_bagian = $('#bagian').val().split('@')[1];
		var	kode_box = kode_bagian == '' || kode_rak == '' ? '' : kode_bagian;

		$('#kode_box').val(kode_box);
	}

// Filter Data
	function filter() {
		var status_menu = <?php echo $status_menu; ?>;
		var dt_bagian = <?php echo json_encode($karyawan[2]); ?>;
		var id_bagian = $('#f_bagian').val();
		var kode_rak = $('#f_kode_rak').val();
		var nomor_rak = $('#f_nomor_rak').val();
		var cari = $('#f_cari').val().toLowerCase();
		var data = [id_bagian, kode_rak, nomor_rak, cari];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/filter" ?>',
			success: function(data) {
				$('.datatable').html(data);

				if (dt_bagian.includes(id_bagian) == false && status_menu != '2') {
					$('#data-table th:nth-child(11), #data-table td:nth-child(11)').hide();
					$('#data-table th:nth-child(12), #data-table td:nth-child(12)').hide();
				}
				setTimeout(function() {
					$('#btnOk').click();
					pagination();
				}, 500);
			}
		}); 
	}

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Buka Modal Arsip Baru
	$('#btn_ok').click(function() {
		var modal_name = $('#btnIsian').attr('name');

		if (modal_name == 'simpan') {$('#btn_arsip').click();}
		$('#btnIsian').attr('name', '');
	});

// Cek Nomor Urut Box per Bagian
	function cek_box(id_edit, id_bagian, urut_box, kode_rak) {
		var data = [id_bagian, urut_box, id_edit, kode_rak];

		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/cek_box" ?>',
			success: function(data) {
				data = JSON.parse(data);

				if (data[0] != 0) {error_isian('Nomor Urut Box sudah dipakai..');}
				if (data[1] != 0) {error_isian('Kode Rak sudah dipakai..');}
			}
		});
	}

// Simpan Data
	function simpan() {
		var id_edit = $('#kode_rak').attr('name');
		var id_kary = $('#kary')[0].name;
		var id_bagian = $('#bagian').val().split('@')[0];
		var kode_rak = $("#kode_rak").val();
		var urut_box = $("#urut_box").val();
		var kode_box = $("#kode_box").val();
		var isi = $("#isi").val();
		var retensi = $('#retensi').val();
		var tgl = $('#tgl').val();
		var data = [id_edit, id_kary, id_bagian, kode_rak, urut_box, kode_box, isi, retensi, tgl];

		$('#btnIsian').attr('name', 'simpan');
		if (id_kary == '') {error_isian('Nama Karyawan belum diisi..');}
		if (id_bagian == '') {error_isian('Bagian belum diisi..');}
		if (kode_rak == '') {error_isian('Kode Rak belum diisi..');}
		if (urut_box == '000') {error_isian('Urut Box belum diisi..');}
		if (kode_box == '') {error_isian('Nomor Box belum diisi..');}
		if (isi == '') {error_isian('Isi Box belum diisi..');}
		if (retensi == '') {error_isian('Masa Retensi belum diisi..');}

		cek_box(id_edit, id_bagian, urut_box, kode_rak);

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/simpan" ?>',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					kosong();
					filter();
					daftar_rak();
				}, 500);
			}
		});
	}

// Edit Data
	function edit(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_edit = data_table.rows[row].cells[0].innerHTML;

		$('#kode_rak').attr('name', id_edit);
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/cs/Arsip/edit',
			data: {data: id_edit},
			success: function(data) {
				data = JSON.parse(data);


				$('#bagian option[value="'+data.ID_BAGIAN + '@' + data.KODE+'"]').remove();
				$('#kary').val(data.NAMA).change();
				$('#kary')[0].name = data.ID_KARYAWAN;
				$('#bagian').append('<option value="'+data.ID_BAGIAN + '@' + data.KODE+'">'+data.BAGIAN+'</option>');
				$('#bagian').val(data.ID_BAGIAN + '@' + data.KODE).change();
				$("#kode_rak").append('<option>'+data.KODE_RAK+'</option>');
				$('#kode_rak').val(data.KODE_RAK).change();
				$('#urut_box').val(data.URUT_BOX).change();
				$('#kode_box').val(data.KODE_BOX).change();
				$('#tgl').val(format_date(data.TGL)).change();
				$('#isi').val(data.ISI).change();
				$('#retensi').val(data.RETENSI).change();
			}
		});
		$('#btn_arsip').click();
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
				url: '<?php echo base_url(); ?>index.php/cs/Arsip/hapus',
				data: {data: id_hapus},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						filter();
						daftar_rak();
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

// Cetak IPB
	function cetak(btn) {
		var kode_rak = btn.name == undefined ? $('#btn_lihat').attr('name') : btn.name;
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');

		setTimeout(function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/cs/Arsip/cetak" ?>',
				data: {data: kode_rak},
				success: function(data) {
					data = JSON.parse(data);

					isi = data.ISI.replaceAll('\n', '<br>').toUpperCase();
					isi = split_isi(isi);
					$('#printable h1').html('NO. BOX : ' + data.KODE_RAK + '-' + data.KODE + data.URUT_BOX);
					$('#printable table tr:eq(0) td:eq(1)').html(data.BAGIAN);
					$('#printable table tr:eq(2) td:eq(1)').html(isi);

					$('#printable table tr:eq(4) td:eq(1)').html(data.RETENSI + ' TAHUN');
					$('#printable table tr:eq(6) th:eq(0)').html(btn == '' ? 'TGL. ARSIP' : 'TGL. AMBIL');
					$('#printable table tr:eq(6) td:eq(1)').html(btn == '' ? format_date(data.TGL).toUpperCase() : format_date(data.TGL_AMBIL).toUpperCase());

					printable.style.display = "";
					non_printable.style.display = "none";
					window.print();

					printable.style.display = "none";
					non_printable.style.display = "";

					$('html, body').animate({scrollTop: $(".card-info:eq(1)").offset().top}, 100);
				}
			});
		}, 300);
	}

	function split_isi(isi) {
		var qty_row = isi.split('<BR>');

		if (qty_row.length > 17) {
			isi = '<div class="d-flex"><div>' + qty_row.myJoin("<br>", 0, 8) + '</div><div>' + qty_row.myJoin("<br>", 9, 16) + '</div><div>' + qty_row.myJoin("<br>", 17, qty_row.length) + '</div></div>';
		}else if (qty_row.length > 8){
			isi = '<div class="d-flex"><div style="margin-right: 50px;">' + qty_row.myJoin("<br>", 0, 8) + '</div><div>' + qty_row.myJoin("<br>", 9, qty_row.length) + '</div></div>';
		}else{
			return isi;
		}
		return isi;
	}
	Array.prototype.myJoin = function(seperator,start,end){
		if(!start) start = 0;
		if(!end) end = this.length - 1;
		end++;
		return this.slice(start,end).join(seperator);
	};

// Pagination
	function pagination_ambil() {	
		$('#tbl_ambil').DataTable().destroy();
		var data_table = $('#tbl_ambil').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": [],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px"
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Ambil Arsip
	function isi_ambil() {
		$('#tbl_ambil').DataTable().destroy();
		$('#tbl_ambil tbody tr').remove();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/cs/Arsip/isi_ambil" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					$('#tbl_ambil tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].NAMA+'</td><td>'+data[i].BAGIAN+'</td><td>'+data[i].KODE_RAK+'</td><td>'+data[i].KODE_BOX+data[i].URUT_BOX+'</td><td>'+data[i].ISI+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+format_date(data[i].TGL_AMBIL)+'</td><td>'+data[i].NAMA_AMBIL+'</td><td><button type="button" class="btn btn-block btn-grad btn-sm" name="'+data[i].KODE_RAK+'" style="width: 50px;" title="Cetak Label" onclick="cetak(this)" data-dismiss="modal"><i class="fa fa-print"></i></button></td></tr>');
				}

				pagination_ambil();
			}
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

</script>