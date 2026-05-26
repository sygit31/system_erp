<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important;} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #6D6C6C !important;}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info" <?php if ($mn == '1') {echo 'hidden';} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Nama Lokasi Gudang</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Nama Gudang</th>
								<td width="60%">
									<input type="text" id="nama" name="" class="form-control" style="width: 100%; text-transform: uppercase;" autocomplete="off" maxlength="30">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th >Jenis Bahan</th>
								<td>
									<select class="select_min" id="jenis" style="width: 100%;">
										<option value="">Pilih..</option>
										<option>ATK</option>
										<option>BAHAN BAKU</option>
										<option>BAHAN CHEMICAL</option>
										<option>BAHAN NON CHEMICAL</option>
										<option>FINISHED GOODS</option>
										<option>IT</option>
										<option>LAIN-LAIN</option>
										<option>SPARE PART</option>
										<option>UMUM</option>
										<option>WIP</option>
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
									<select class="select_min" id="divisi" style="width: 100%;">
										<?php foreach($unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Stock Keeper</th>
								<td>
									<select id="pic" multiple="multiple" class="form-control select" style="width: 100%;">
										<?php foreach($pic->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
										<?php } ?>
									'</select>
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
					<b><font color="White" id="headerinput">Data Lokasi Gudang</font></b>
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
							<table style="width: 600px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" class="filter">Divisi</th>
										<td></td>
										<th width="35%" class="filter">Nama Gudang</th>
										<td></td>
										<th width="40%" class="filter">Nama PIC Gudang</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<select class="select_min" id="f_divisi" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach($unit->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="f_nama" onchange="filter()" class="form-control" style="width: 100%;" placeholder="Cari gudang.." autocomplete="off">
										</td>
										<td></td>
										<td>
											<input type="text" id="f_pic" onchange="filter()" class="form-control" style="width: 100%;" placeholder="Cari PIC.." autocomplete="off">
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
											<th width="10%">No.</th>
											<th width="15%">Divisi</th>
											<th width="25%">Nama Gudang</th>
											<th width="20%">Jenis Bahan</th>
											<th width="30%">Nama PIC</th>
											<th>Barang</th>
											<th>Edit</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody></tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="card-footer m-4">
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
<div class="modal fade" id="modal_sukses">
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
				<button id="btnNo" style="width: 50%;" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnHapus" name="" data-toggle="modal" data-target="#modal_hapus" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal View Material -->
<div class="modal fade" id="modal_view" style="position: absolute;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header rounded m-2" style="background-color: #0A86BF; cursor: all-scroll; height: 60px;">
					<h3 class="card-title"><b><font color="White"><div id="ket_input"></div></font></b></h3>
				</div>
			</div>
			<div class="card-body card ml-2 mr-2" style="font-size: 12px;">
				<div class="row">
					<div class="col-md-6"> 
						<table width="100%">
							<tr>
								<th width="40%">Part No.</th>
								<td> 
									<input type="text" id="kode_p" name="" class="form-control" readonly>    
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Material</th>
								<td> 
									<div style="max-width: 230px;"><select class="select" id="nama_p" onchange="isi_kode()" style="width: 100%; cursor: pointer;">
										<option value="">Pilih..</option>
										<?php foreach ($material->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID'] . '@@' . $dt['KODE'] . '@@' . $dt['MIN_STOK']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>
										<?php } ?>
									</select></div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Lokasi</th>
								<td> 
									<input type="text" id="lokasi_p" class="form-control" value="-" style="text-transform: uppercase;" maxlength="8"> 
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Tipe</th>
								<td> 
									<div style="max-width: 230px;"><select class="select_min" id="tipe_p" style="width: 100%; cursor: pointer;">
										<option value="1">Persedian</option>
										<option value="0">Non Persedian</option>
									</select></div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Status</th>
								<td> 
									<select class="select_min" id="status_p" style="width: 100%; cursor: pointer;">
										<option value="1">Aktif</option>
										<option value="0">Non Aktif</option>
									</select>   
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Min. Stok</th>
								<td> 
									<input type="number" id="min_stok" class="form-control" value="0" autocomplete="off">  
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="text-danger text-right mr-4 font-weight-bold invisible isian" style="font-size: 20px; margin-top: -15px;">Isian belum lengkap..</div>
			<div class="modal-footer card-footer ml-2 mr-2">
				<button id="simpan_p" onclick="simpan_p()" name="" style="width: 120px;" type="button" class="btn btn-warning"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
				<button type="button" class="btn btn-success" onclick="$('.excel_p').click();" style="width: 120px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
				<button id="tutup_p" onclick="kosong_p(); $('html').css({'overflow-y': 'scroll'}); $('#modal_view').css({'overflow-y': 'hidden'});" style="width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Keluar</b></button>
				<button id="btn_info" data-toggle="modal" onclick="resize_view()" data-target="#modal_view" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
			<div class="card card-body mr-2 ml-2 mt-2" style="font-size: 12px;">
				<div class="table-responsive ml-2" style="overflow-y: hidden;">
					<table style="width: 500px;">
						<thead>
							<tr align="center" style="line-height: 30px;">
								<th width="25%" class="dt_filter bg-secondary">Tipe</th>
								<td></td>
								<th width="20%" class="dt_filter bg-secondary">Lokasi</th>
								<td></td>
								<th width="35%" class="dt_filter bg-secondary">Nama Material</th>
								<td></td>
								<th width="20%" class="dt_filter bg-secondary">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="select_min" id="f_tipe" onchange="filter_p()" style="width: 100%; cursor: pointer;">
										<option value="All">All..</option>
										<option value="1">Persediaan</option>
										<option value="0">Non Persediaan</option>
									</select>  
								</td>
								<td></td>
								<td>
									<select class="select" id="f_lokasi" onchange="filter_p()" style="width: 100%; cursor: pointer;">
										<option value="All">All..</option>
										<?php foreach($lokasi->result_array() as $dt) { ?>
											<option><?php echo $dt['NO_LOKASI']; ?></option>
										<?php } ?>
									</select>  
								</td>
								<td></td>
								<td>
									<input type="text" id="f_brg" onchange="filter_p()" class="form-control" style="width: 100%;" placeholder="Cari nama.." autocomplete="off">
								</td>
								<td></td>
								<td>
									<select class="select_min" id="f_status" onchange="filter_p()" style="width: 100%; cursor: pointer;">
										<option value="1">Aktif</option>
										<option value="0">Non Aktif</option>
									</select>  
								</td>
							</tr>
						</tbody>
					</table>                  
				</div>
				<div class="tbl_brg">
					<table id="tbl_brg" class="table table-bordered table-striped" width="100%">
						<thead style="background-color: #969696; font-weight: bold; color: #FFFFFF;">
							<tr align="center">
								<th width="10%">No.</th>
								<th width="12.5%">Tipe</th>
								<th width="12.5%">Lokasi</th>
								<th width="15%">Part No.</th>
								<th>Nama Material</th>
								<th width="12.5%">Min. Stok</th>
								<th width="12.5%">Status</th>
								<th width="4%">Edit</th>
								<th width="4%">Buang</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
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
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
	$(document).ready(function() {
		$('.select').select2();
		filter();
	});

// Filter Data
	function filter() {
		var kd_menu = <?php echo json_encode($mn); ?>;
		var id_kary = '@' + <?php echo json_encode($id_kary); ?> + '@';
		var kd_unit = $('#f_divisi').val();
		var nama = $('#f_nama').val();
		var pic = $('#f_pic').val();
		var data = [kd_unit, nama, pic];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/location/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);
				str = 'lokasi';
				urut = 0;

				$('#tbl').DataTable().destroy();
				$('#tbl tbody tr').remove();
				for (var i=0; i<data.length; i++) {
					hidden = kd_menu == '1' ? 'hidden' : '';
					div = data[i].KD_UNIT == '12' ? 'HOLOGRAFI' : 'HOLO PERDANA';
					pic = data[i].PIC == 'null, ' ? '' : data[i].PIC.substring(0, data[i].PIC.length-2);

					if ((kd_menu == '1' && data[i].ID_KARY.includes(id_kary) == true) || kd_menu == '2') {
						urut++;
						$('#tbl tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+div+'</td><td>'+data[i].LOCATION+'</td><td>'+data[i].JENIS+'</td><td>'+pic.toUpperCase()+'</td><td align="center"><button type="button" class="btn btn-block btn-info btn-sm" name="'+data[i].ID+'" style="width: 50px;" title="Info Barang" onclick="info(this)" data-toggle="modal" data-target="#modal_view" data-backdrop="static" data-keyboard="false"><i class="fa fa-book"></i></button></td><td align="center" '+hidden+'><button type="button" class="btn btn-block btn-warning btn-sm" name="'+data[i].ID+'" value="'+str+'" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center" '+hidden+'><button type="button" class="btn btn-block btn-danger btn-sm" name="'+data[i].ID+'" value="'+str+'" style="width: 50px;" title="Hapus Data" onclick="batal(this)"><i class="fa ion-trash-a"></i></button></td></tr>');
						if (data[i].QTY_SO != 0 || data[i].QTY_BRG != 0) {$('#tbl tbody .btn-danger:eq('+i+')').hide();}
					}
				}
				if (kd_menu == '1') {$('#tbl th:gt(5)').hide();}

				setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
			}
		}); 
	}

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
				filename: 'Data Lokasi Gudang',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 500);
	}

// Kosong Isian
	function kosong() {
		$('#nama').attr('name', '');
		$('#nama').val('').change();
		$('#jenis').val('').change();
		$('#pic').val('').change();
	}

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		setTimeout(function() {$('#btnOk').click(); $('#btnIsian').click()}, 500);
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var id_edit = $('#nama').attr('name');
		var nama = $('#nama').val().toUpperCase();
		var jenis = $('#jenis').val().toUpperCase();
		var kd_unit = $("#divisi").val();
		var pic = $("#pic").val();
		var data = [id_edit, nama, jenis, kd_unit, pic];

		if (nama == '') {error_isian('Nama Gudang belum diisi..');}
		if (jenis == '') {error_isian('Jenis Bahan belum diisi..');}
		if (pic == '') {error_isian('Nama PIC Gudang belum diisi..');}

		$('#btnProgress').click();
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/location/simpan" ?>',
			success: function(data) {
				if (data == 1) {error_isian('Nama Gudang sudah ada..');}

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
		var id_edit = btn.name;
		var str = btn.value;
		var data = [id_edit, str];

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/gudang/location/edit',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);

				if (str == 'barang') {
					$('#kode_p').attr('name', id_edit);
					$('#kode_p').val(data.KODE).change();
					$('#nama_p').val(data.ID + '@@' + data.KODE + '@@' + data.MIN_STOK).change();
					$('#lokasi_p').val(data.NO_LOKASI).change();
					$('#tipe_p').val(data.TIPE).change();
					$('#status_p').val(data.STATUS).change();
					$('#min_stok').val(data.MIN_STOK).change();
				}else{
					pic = data.PIC == 'null, ' ? '' : data.PIC.substring(0, data.PIC.length-2).split(', ');

					$('#nama').attr('name', id_edit);
					$('#nama').val(data.LOCATION).change();
					$('#jenis').val(data.JENIS).change();
					$('#divisi').val(data.KD_UNIT).change();
					$('#pic').val(pic).change();

					$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 500);
				}
			}
		});
	}

// Hapus Data
	function batal(btn) {
		var id_hapus = $(btn).attr('name');
		var str = btn.value;
		var id_location = str == 'lokasi' ? '' : $('#simpan_p').attr('name').split('@@')[0];
		var data = [id_hapus, str, id_location];

		$('#tutup_p').click();
		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			if (str == 'lokasi') {$('#btnProgress').click();}
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/gudang/location/hapus',
				data: {data: data},
				success: function(data) {

					if (str == 'barang') {
						$('#btn_info').click();
						filter_p();
					}else{
						setTimeout(function() {
							$('#btnOk').click();
							$('#btnSukses').click();
							filter();
						}, 500);
					}

					id_hapus = '';
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (id_hapus == '') {return;}
			if (str == 'barang') {$('#btn_info').click();}
			id_hapus = '';
		});
	}

// Isi Kode Material
	function isi_kode() {
		var kode = $('#nama_p').val().split('@@')[1];
		var min_stok = $('#nama_p').val().split('@@')[2];

		$('#kode_p').val(kode);
		$('#min_stok').val(min_stok);
	}

// Resize View Material
	function resize_view() {
		$('.select').select2({dropdownParent: $('#modal_view')});
	}

// View Material
	function info(btn) {
		var id_location = btn.name;		
		var tbl = document.getElementById('tbl');
		var row = $(btn).closest("tr").index() + 1;
		var divisi = tbl.rows[row].cells[1].innerHTML;
		var lokasi = tbl.rows[row].cells[2].innerHTML;

		$('#simpan_p').attr('name', id_location + '@@' + divisi + '@@' + lokasi);
		$('#btn_info').click();
		filter_p();
	}

// Pagination View
	function pagination_p() {	
		$('#tbl_brg').DataTable().destroy();
		var data_table = $('#tbl_brg').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "350px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel_p',
				filename: 'Laporan Data Lokasi Barang',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": [],
		});

		setTimeout(function() {$('.tbl_brg').show(); data_table.columns.adjust().draw();}, 500);
	}

// Filter Data
	function filter_p() {
		var id_location = $('#simpan_p').attr('name').split('@@')[0];
		var divisi = $('#simpan_p').attr('name').split('@@')[1];
		var lokasi = $('#simpan_p').attr('name').split('@@')[2];
		var tipe = $('#f_tipe').val();
		var nama = $('#f_brg').val();
		var status = $('#f_status').val();
		var no_lokasi = $('#f_lokasi').val();
		var data = [id_location, tipe, nama, status, no_lokasi];

		$('#tbl_brg').DataTable().destroy();
		$('#tbl_brg tbody tr').remove();
		$('#ket_input').html(lokasi + ' DIVISI ' + divisi);
		$('.tbl_brg').hide();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/gudang/location/info',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);
				str = 'barang'

				for (var i=0; i<data.length; i++) {
					tipe = data[i].TIPE == '1' ? 'Persediaan' : 'Non Persediaan';
					nama = data[i].NAMA + ' - ' + data[i].SPESIFIKASI;
					status = data[i].STATUS == '1' ? 'Aktif' : 'Non Aktif';
					min_stok = data[i].MIN_STOK;
					$('#tbl_brg tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+tipe+'</td><td align="center">'+data[i].NO_LOKASI+'</td><td>'+data[i].KODE+'</td><td>'+nama+'</td><td align="center">'+min_stok+'</td><td>'+status+'</td><td><button type="button" class="btn btn-block btn-warning btn-sm" name="'+data[i].ID+'" value="'+str+'" title="Edit Data" value="'+str+'" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td><button type="button" class="btn btn-block btn-danger btn-sm" name="'+data[i].ID+'" value="'+str+'" title="Hapus Data" onclick="batal(this)"><i class="fa fa-trash"></i></button></td></tr>');
				}
				pagination_p();
			}
		});
	}

// Error Isian SP
	function err(str) {
		$('.isian:eq(0)').html(str);
		$('.isian:eq(0)').removeClass('invisible');
		setTimeout(function() {$('.isian:eq(0)').addClass('invisible');}, 2000);
		throw new Error("Isian salah..");
	}

// Simpan Material
	function simpan_p() {
		var id_edit = $('#kode_p').attr('name');
		var id_location = $('#simpan_p').attr('name').split('@@')[0];
		var tipe = $('#tipe_p').val();
		var id_barang = $('#nama_p').val().split('@@')[0];
		var status = $('#status_p').val();
		var min_stok = $('#min_stok').val();
		var no_lokasi = $('#lokasi_p').val().toUpperCase();
		var data = [id_edit, id_location, tipe, id_barang, status, no_lokasi, min_stok];

		if (id_barang == '') {err('Nama Material belum diisi..');}
		if (no_lokasi == '') {err('Lokasi Material belum diisi..');}
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/gudang/location/simpan_p',
			data: {data: data},
			success: function(data) {
				kosong_p();
				filter_p();
			}
		});
	}

// Kosong isian SP
	function kosong_p() {
		$('#nama_p').val('').change();
		$('#min_stok').val('0').change();
		$('#kode_p').attr('name', '');
	}

</script>