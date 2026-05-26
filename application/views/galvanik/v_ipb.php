<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<style>body {padding-right: 0 !important}</style>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important;} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #6D6C6C !important;}</style>

<div id="non_printable" class="content-wrapper" style="display: block;">
	<section class="content-header"></section>
	<section class="content">
		<div class="card <?php if ($kd_unit == '12') {echo "card-info";}else{echo 'card-danger';} ?>" <?php if ($status_menu == '2') {echo "hidden";} ?>>
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div id="headerinput">Input Pengebonan PCH <?php if ($kd_unit == '12') {echo "";}else{echo ' (HPD)';} ?></div></font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body row">
				<div class="col-md-5">
					<table width="100%">
						<tr>
							<th width="45%">Tanggal</th>
							<td width="55%">
								<input type="text" id="tgl" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="cursor: pointer; background-color: #FFFFFF;" readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>No. IPB</th>
							<td>
								<div class="input-group">
									<input type="text" id="nmr" value="000" class="form-control num text-center mr-2" tabindex="2" maxlength="3" autocomplete="off">
									<label id="kode_trans" style="width: 70%; margin-top: 5px;">-</label>
								</div>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Tipe</th>
							<td>
								<select class="select" id="tipe" style="width: 100%;" onchange="isi_barang(); auto_no();">
									<option selected>Produksi</option>
									<option>Proof</option>
								</select>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>No. KK</th>
							<td>
								<div style="width: 400px;">
									<select class="select" id="kk" style="width: 100%;" onchange="isi_barang();">
										<option value="">Pilih KK..</option>
										<?php foreach ($kk->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID'] . '@_@' . $dt['KK'] . '@_@' . $dt['SERI'] . '@_@' . $dt['DESAIN']; ?>"><?php echo $dt['KK']; ?></option>
										<?php } ?>
									</select>
									<input type="text" id="kk_manual" class="form-control" style="display: none;">
								</div>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
					</table>					
				</div>
				<div class="col-md-2"></div>
				<div class="col-md-5">
					<table width="100%">
						<tr <?php if ($kd_unit == '01') {echo "hidden";} ?>>
							<th width="45%">Desain</th>
							<td width="55%">
								<input type="text" id="desain" class="form-control" readonly>
							</td>
						</tr>
						<tr style="height: 10px;" <?php if ($kd_unit == '01') {echo "hidden";} ?>></tr>
						<tr <?php if ($kd_unit == '01') {echo "hidden";} ?>>
							<th>Seri</th>
							<td>
								<input type="text" id="seri" class="form-control" readonly>
							</td>
						</tr>
						<tr style="height: 10px;" <?php if ($kd_unit == '01') {echo "hidden";} ?>></tr>
						<tr>
							<th width="45%">Nama Barang</th>
							<td width="55%">
								<div style="width: 400px;">
									<select class="select" id="nama" style="width: 100%;" onchange="isi_pch()">
										<option value="">Pilih Barang..</option>
									</select>
								</div>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Qty KK</th>
							<td>
								<input type="text" id="qty_kk" class="form-control" readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Qty IPB</th>
							<td>
								<input type="text" id="qty_ipb" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onchange="isi_pch()" autocomplete="off" <?php if ($kd_unit == '01') {echo 'hidden';} ?>>
								<input type="text" id="qty_bon" class="form-control" <?php if ($kd_unit == '12') {echo 'hidden';} ?> readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
					</table>
				</div>
			</div>
			<div class="card card-body m-4">
				<div class="table-responsive">
					<div style="width: 1000px; font-size: 14px;">
						<table id="tabel_roll" class="table table-bordered table-striped" width="100%">
							<thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
								<tr style="text-align: center;">
									<td width="10%">No.</td>
									<td width="40%">Jenis PCH</td>
									<td width="20%">Ukuran</td>
									<td width="30%">No. Register</td>
									<td>Pilih</td>
								</tr>
							</thead>
							<tbody>
							</tbody>
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

		<div class="card card-info <?php if ($kd_unit == '12') {echo "card-info";}else{echo 'card-danger';} ?>">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White">Data Pengebonan PCH <?php if ($kd_unit == '12') {echo "";}else{echo ' (HPD)';} ?></font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<div class="table-responsive">
								<div style="width: 500px">
									<table id="tbl_filter" style="width: 500px; margin-bottom: 10px;">
										<thead>
											<tr align="center" style="line-height: 30px;">
												<td width="50%" colspan="2" class="filter">Periode</td>
												<td></td>
												<td width="50%" class="filter">Nama Produk</td>
												<td></td>
												<td width="25%" class="filter">Desain</td>
												<td></td>
												<td width="25%" class="filter">Seri</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td><input id="fTgl1" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
												<td><input id="fTgl2" type="text" style="background-color: #FFFFFF; text-align: center; cursor: pointer;" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
												<td></td>
												<td>
													<input type="text" id="cari" class="form-control" onchange="filter()" placeholder="Ketikan nama.." style="width: 100%;" autocomplete="off">
												</td>
												<td></td>
												<td>
													<select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
														<?php foreach ($desain->result_array() as $dt) { ?>
															<option><?php echo $dt['DESAIN']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td></td>
												<td>
													<select class="select" id="fSeri" onchange="filter()" style="width: 100%; cursor: pointer;">
														<option>All..</option>
														<?php foreach ($seri->result_array() as $dt) { ?>
															<option><?php echo $dt['SERI']; ?></option>
														<?php } ?>
													</select>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="data-table mt-3"></div>
							<div class="card-footer">
								<button type="button" class="btn btn-success mt-3" style="width: 150px;" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
							</div>
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

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" type="button" data-dismiss="modal" hidden></button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false" hidden></button>
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
				<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check-square-o mr-2"></i><b>OK</b></button>
				<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body confirm" style="font-size: 36px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Confirm Approve -->
<div class="modal fade" id="modal_approve" style="z-index: 9997;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan Approve data? </div>
			<div class="modal-footer">
				<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="ya_approve" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnApprove" data-toggle="modal" data-target="#modal_approve" hidden></button>
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

<!-- Modal Isi Nama Pengawas & IS -->
<div class="modal fade" id="modal_nama">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">
						<b>
							<font color="White">
								<div id="headerinput">
									<h3>Isi Nama Pengawas</h3>
								</div>
							</font>
						</b>
					</h3>
				</div>
				<div class="card-body">
					<table width="100%">
						<tr>
							<td width="35%" style="font-weight: bold;">Nama Pengawas</td>
							<td width="65%">
								<select class="form-control select_min" style="width: 100%;" id="nama_pengawas">
									<option value="">Pilih Karyawan..</option>
									<?php foreach ($nama_pengawas->result_array() as $dt) : ?>
										<option><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<td style="font-weight: bold;">Nama IS</td>
							<td>
								<select class="form-control select_min" style="width: 100%;" id="nama_is">
									<option value="">Pilih Karyawan..</option>
									<?php foreach ($nama_is->result_array() as $dt) : ?>
										<option><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
									<?php endforeach; ?>
								</select>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button id='btnLanjut' style="width: 50%;" class="btn btn-primary"><i class="fa ion-android-share fa-lg mr-2"></i><b>Lanjut</b></button>
					<button id='btnTutup' style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>Batal</b></button>
					<button id="btnNama" data-toggle="modal" data-target="#modal_nama" hidden></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden;">
	<h2 align="center">PENGEBONAN PCH</h2>
	<h4 id="nmr_ipb" align="center" class="mb-4">XXX/XX/XX-XX/XXX</h4>

	<table id="print_header" class="table table-borderless" width="100%" style="line-height: 5px;">
		<tr>
			<td width="10%">Tanggal</td>
			<td width="5%">:</td>
			<td width="50%"></td>
			<td width="10%">Qty</td>
			<td width="5%">:</td>
			<td width="20%"></td>
		</tr>
		<tr>
			<td>No. KK</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>

	<table id="print_body" class="table table-bordered" style="line-height: 10px;">
		<thead>
			<tr align="center">
				<td width="10%">No.</td>
				<td width="40%">Jenis PCH</td>
				<td width="20%">Ukuran</td>
				<td width="30%">Register</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div id="no_form" align="right" style="font-size: 14px; margin-top: -10px; margin-bottom: 10px;">F-SMT-P2-001 Rev. 01</div>

	<table id="print_footer" width="100%" style="line-height: 10px;">
		<tr>
			<td width="100/7%" align="center">Bagian Emboss</td>
			<td width="100/7%"></td>
			<td width="100/7%" align="center">Kabid Proses Prod.</td>
			<td width="100/7%"></td>
			<td width="100/7%" align="center">Security Internal</td>
			<td width="100/7%"></td>
			<td width="100/7%" align="center">Bagian Galvanik</td>
		</tr>
		<tr style="height: 70px;"></tr>
		<tr>
			<td align="center">( Kamal Y. )</td>
			<td></td>
			<td align="center">( Imam S. )</td>
			<td></td>
			<td align="center">( Agus S. )</td>
			<td></td>
			<td align="center">( Ruly H. )</td>
		</tr>
	</table>
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
	var row_pilih = '';

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		auto_no();
		filter();
	});

// Filter Data
	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var status_menu = <?php echo json_encode($status_menu); ?>;
		var kd_unit = <?php echo json_encode($kd_unit) ?>;
		var desain = document.getElementById('fDesain').value;
		var seri = document.getElementById('fSeri').value;
		var cari = document.getElementById('cari').value;
		var data = [tgl1, tgl2, status_menu, kd_unit, desain, seri, cari];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/galvanik/ipb/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);

				if (kd_unit == '01') {
					$('#data-table th:nth-child(4), #data-table td:nth-child(4)').hide();
					$('#tbl_filter').width('500px');
					$('#tbl_filter thead td:gt(2), #tbl_filter tbody td:gt(3)').hide();
				}else{
					$('#tbl_filter thead td:eq(2), #tbl_filter thead td:eq(3), #tbl_filter tbody td:eq(2), #tbl_filter tbody td:eq(3)').hide();				
				}
				pagination();
			}
		});
	}

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		var table = $('#data-table').DataTable({
			"paging": false,
			"ordering": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": '350px',
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				title: 'DATA PENGEBONAN PCH (IPB)'
			}],
			"colReorder": true
		});

		setTimeout(function() {table.columns.adjust().draw();}, 500);
	}

// Isi Seri
	$('#kk').change(function() {
		var kk = $('#kk').val().split('@_@');
		var seri = kk[2];
		var desain = kk[3];

		$('#seri').val(seri);
		$('#desain').val(desain);
		auto_no();
	});

// Isi Nama Barang
	function isi_barang() {
		var kd_unit = <?php echo json_encode($kd_unit) ?>;
		var nama = document.getElementById("nama");
		var tipe = $('#tipe').val();
		var desain = $('#desain').val();
		var kk = $('#kk').val();
		var kk_manual = $('#kk_manual').val();
		var data = [kd_unit, tipe, desain];

		$('#nama option:gt(0)').remove();
		$('#nama').val('').change();

		if (tipe == 'Produksi' && kk == '') {return;}
		if (tipe == 'Proof' && kk_manual == '') {return;}
		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/galvanik/ipb/isi_barang',
			success: function(data) {
				data = JSON.parse(data);

				for (var i = 0; i < data.length; i++) {
					$('#nama').append('<option value="'+data[i].ID+'">'+data[i].NAMA.toUpperCase()+'</option>');
				}
			}
		});

		isi_kk();
	}

// Isi KK Produksi dan Proof
	function isi_kk() {
		var tipe = $('#tipe').val();

		if (tipe == 'Produksi') {
			$('#kk').select2().next().show();
			$('#kk_manual').css('display','none');
		}else{
			$('#kk').select2().next().hide();
			$('#kk_manual').css('display','block');
		}
	}

// Format Nomor 000
	$('#nmr').focusout(function() {
		var nmr = '000'+$('#nmr').val();
		nmr = nmr.substring(nmr.length-3,nmr.length);

		$('#nmr').val(nmr);
	});

// Auto Nomor IPB
	function auto_no() {
		var desain = $('#desain').val();
		var tgl = $('#tgl').val();
		var kd_unit = <?php echo json_encode($kd_unit) ?>;
		var tipe = $('#tipe').val();
		var no_kk = tipe == 'Produksi' ? $('#kk').val() : $('#kk_manual').val();
		var data = [desain, tgl, kd_unit, tipe];

		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/galvanik/ipb/auto_no',
			success: function(data) {
				data = JSON.parse(data);

				urut = no_kk == '' ? '000' : data[0];
				kode = no_kk == '' ? '-' : data[1];

				$('#nmr').val(urut);
				$('#kode_trans').html(kode);
			}
		});
	}

// Isi Tabel PCH
	function isi_pch() {
		var kd_unit = <?php echo json_encode($kd_unit) ?>;
		var qty_ipb = kd_unit == '01' ? 100 : $('#qty_ipb').val();
		var id_barang = $('#nama').val();
		var data = [qty_ipb, id_barang];

		if (id_barang == '') {$("#tabel_roll tbody").find("tr").remove();}
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/galvanik/ipb/isi_pch',
			success: function(data) {
				data = JSON.parse(data);
				isi_tabel(data);

				if (kd_unit == '01') {isi_qty_bon();}
				if (qty_ipb > data.length) {$('#qty_ipb').val(data.length);}
			}
		});
	}

// Isi Qty Bon Perdana
	function isi_qty_bon() {
		var qty_data = $('#tabel_roll tbody tr').length;
		var qty_bon = 0;

		for (var i=0; i<qty_data; i++) {
			if ($('#tabel_roll .pilih:eq('+i+')').is(':checked') == true) {qty_bon++;}
		}
		$('#qty_bon').val(qty_bon);
	}


// Isi Tabel PCH
	function isi_tabel(data) {
		$("#tabel_roll tbody").find("tr").remove();
		for (var i = 0; i < data.length; i++) {
			id = data[i].ID;
			jenis = data[i].NAMA + ' - ' + data[i].DESKRIPSI;
			ukuran = data[i].UKURAN;
			no_reg = data[i].NO_REG;

			$("#tabel_roll tbody").append('<tr><td align="center">' + (i + 1) + '</td><td>' + jenis + '</td><td><input type="text" class="form-control" name="ukuran" style="width: 100%;" maxlength="20" value="42 x 76.5 cm"></td><td>' + no_reg + '</td><td align="center"><input type="checkbox" class="pilih" name="'+id+'" onclick="isi_qty_bon()" style="cursor: pointer;" checked></td></tr>');
		}
	}

// Kosong Isian
	function kosong() {
		$('#kk').val('').change();
		$('#kk_manual').val('').change();
		$('#seri').val('').change();
		$('#qty_kk').val('').change();
		$('#qty_ipb').val('').change();
		$('#nama').val('').change();

		id_barang = '';
	}

// Cek duplikat nomor
	function cek_nomor(nmr) {
		var desain = $('#desain').val();
		var kd_unit = <?php echo json_encode($kd_unit) ?>;
		var tipe = $('#tipe').val();
		var duplikat = 0;
		var data = [nmr, desain, tipe, kd_unit];

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/galvanik/ipb/cek_nomor',
			data: {data: data},
			success: function(data) {
				duplikat = data;
			}
		});
		return duplikat;
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Error isian!");
	}

// Simpan Data
	function simpan() {
		var kd_unit = <?php echo json_encode($kd_unit); ?>;
		var tabel_roll = document.getElementById('tabel_roll');
		var status_menu = <?php echo json_encode($status_menu) ?>;
		var tgl = $('#tgl').val();
		var tipe = $('#tipe').val();
		var urut = $('#nmr').val();
		var kode_trans = $('#kode_trans').html();
		var nmr = urut + kode_trans;
		var dt_kk = tipe == 'Produksi' ? $('#kk').val() : $('#kk_manual').val();
		var no_kk = tipe == 'Produksi' ? dt_kk.split('@_@')[1] : dt_kk; 
		var nama = $('#nama').val();
		var qty_ipb = $('#qty_ipb').val();
		var duplikat = cek_nomor(nmr);
		var id_galv_proses = [], ukuran = [];

		if (tabel_roll.rows.length == 1) {error_isian('Tidak ada PCH yang dipilih..');}
		if (qty_ipb == '' || qty_ipb == '0') {error_isian('Qty IPB salah..');}
		if (nama == 'Pilih Barang..' || nama == '') {error_isian('Nama Barang masih kosong..');}
		if (dt_kk == '') {error_isian('No. KK masih kosong..');}
		if (duplikat != 0) {error_isian('Nomor IPB sudah terpakai..');}
		if (urut == '000' || kode_trans == '-') {error_isian('Nomor IPB salah..');}

		for (var i=0; i<tabel_roll.rows.length-1; i++) {
			if ($('#tabel_roll .pilih:eq('+i+')').is(':checked') == true) {
				t_id_galv_proses = $('#tabel_roll .pilih:eq('+i+')').attr('name');
				t_ukuran = document.getElementsByName('ukuran')[i].value;

				id_galv_proses.push(t_id_galv_proses);
				ukuran.push(t_ukuran);
			}
		}
		if (id_galv_proses.length == 0) {error_isian('Tidak ada PCH yang dipilih..');}

		var data = [tgl, nmr, id_galv_proses, no_kk, ukuran, tipe, kd_unit];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/galvanik/ipb/simpan',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
				}, 500);

				kosong();
				filter();
				auto_no();
			}
		});
	}

// Cetak IPB
	function cetak(btn) {
		var data_table = document.getElementById('data-table');
		row_pilih = $(btn).closest("tr").index() + 1;

		$('#btnNama').click();
	}

	$('#btnLanjut').click(function() {
		$('#btnTutup').click();

		setTimeout(function() {
			$("#print_body tbody").find("tr").remove();

			var data_table = document.getElementById('data-table');
			var tabel_header = document.getElementById('print_header');

			var kd_unit = <?php echo json_encode($kd_unit); ?>;
			var kk = kd_unit == '01' ? '-' : data_table.rows[row_pilih].cells[2].innerHTML;
			var tgl = data_table.rows[row_pilih].cells[4].innerHTML;
			var nmr = data_table.rows[row_pilih].cells[5].innerHTML;
			var nama_pengawas = $('#nama_pengawas').val();
			var nama_is = $('#nama_is').val();

			if (kd_unit == '12') {
				var nama_kabid = 'Imam Suroso';
				var nama_admin = 'Rita P.';
				var no_form = 'F-SMT-P2-001 Rev. 01';
				var jabatan_kabid = 'Kabid Proses Produksi';
				var jabatan_admin = 'Adm. Proses Produksi';
			}else{
				var nama_kabid = 'Fendy Panji C.';
				var nama_admin = 'Mia Pratiwi';
				var no_form = 'F-SMT-P1-009 Rev. 01';
				var jabatan_kabid = 'Kabid Pengadaan & Gudang';
				var jabatan_admin = 'Adm. Proses Persiapan';
			}

			$('#no_form').html(no_form);
			if (nama_pengawas == '') {error_isian('Nama Pengawas belum diisi..');}
			if (nama_is == '') {error_isian('Nama IS belum diisi..');}

		// Isi Tabel Body
			var urut = 0;
			for (var i=0; i<data_table.rows.length; i++) {
				nmr_print = data_table.rows[i].cells[5].innerHTML;
				jenis = data_table.rows[i].cells[6].innerHTML;
				ukuran = data_table.rows[i].cells[7].innerHTML;
				no_reg = data_table.rows[i].cells[8].innerHTML;

				if (nmr_print == nmr) {
					urut++;
					$("#print_body tbody").append('<tr><td align="center">' + urut + '</td><td>' + jenis + '</td><td>' + ukuran + '</td><td>' + no_reg + '</td></tr>');
				}
			}

		// Isi Tabel Header
			document.getElementById('nmr_ipb').innerHTML = nmr;
			tabel_header.rows[0].cells[2].innerHTML = tgl;
			tabel_header.rows[1].cells[2].innerHTML = kk;
			tabel_header.rows[0].cells[5].innerHTML = urut;

		// Isi Tabel Footer
			$('#print_footer tr:eq(2) td:eq(0)').html('( ' + nama_pengawas + ' )');
			$('#print_footer tr:eq(2) td:eq(2)').html('( ' + nama_kabid + ' )');
			$('#print_footer tr:eq(2) td:eq(4)').html('( ' + nama_is + ' )');

		// Print Area Table
			var printable = document.getElementById('printable');
			var non_printable = document.getElementById('non_printable');

			printable.style.display = "";
			non_printable.style.display = "none";
			window.print();

			printable.style.display = "none";
			non_printable.style.display = "";

			btn = '';

		}, 500);
	});

// Notifikasi Hapus Data
	function hapus(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id = data_table.rows[row].cells[0].innerHTML;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/galvanik/ipb/hapus',
				data: {data: id},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						filter();
						id = '';
					}, 500);
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (id == '') {return;}
			id = '';
		});
	}

// Approve IPB
	function approve(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var nmr = data_table.rows[row].cells[5].innerHTML;

		$('#btnApprove').click();
		$('#ya_approve').on('click', function() {
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/galvanik/ipb/approve',
				data: {data: nmr},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
					}, 500);

					filter();
				}
			});
			return;
		});
	}

</script>