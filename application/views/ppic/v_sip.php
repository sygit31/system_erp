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
<style>.select2-container--open {z-index: 9999999;}</style>

<div id="non_printable" class="content-wrapper" style="display: block;">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Surat Ijin Pembelian</div>
						</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Pengadaan - Manual Book SIP.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
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
								<th width="35%">Tanggal</th>
								<td width="65%">
									<input type="text" id="tanggal" class="form-control datepicker" value="<?php echo date("d-M-Y"); ?>" onchange="auto_no()" style="background-color: #FFFFFF; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Karyawan</th>
								<td>
									<input type="text" class="form-control" id="nama" value="<?php echo $karyawan[0]; ?>" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Bagian</th>
								<td>
									<select class="select" id="bagian" onchange="auto_no()" style="width: 100%;" disabled>
										<?php foreach ($bagian->result_array() as $dt) { ?>
											<option <?php if ($dt['NAMA'] == $karyawan[1]) {echo "selected";} ?>><?php echo $dt['NAMA']; ?></option>
										<?php } ?>
									</select>
									<input type="checkbox" id="auto" style="cursor: pointer;" checked><b>&nbsp Auto</b>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6"> 
						<table width="100%">
							<tr>
								<th width="35%">No. SIP</th>
								<td width="65%">
									<input type="text" id="no_sip" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Sifat</th>
								<td>
									<select class="select" id="sifat" style="width: 100%;">
										<option selected>Reguler</option>
										<option>Urgent</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Unit</th>
								<td>
									<select class="select" id="unit" onchange="auto_no()" style="width: 100%;">
										<?php foreach ($unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT'] . '@' . $dt['KODE_TRANSAKSI']; ?>" <?php if ($karyawan[5] == $dt['KD_UNIT']) {echo 'selected';} ?>><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
										<?php } ?>
									</select>

									<select id="material" hidden>
										<option value="">Pilih..</option>
										<?php foreach ($material->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID_MATERIAL']; ?>"><?php echo '['. $dt['NO_REKJURNAL'] .'] '.$dt['NAMA'] . ' ' . $dt['SPESIFIKASI']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Jenis Persediaan</th>
								<td>
									<select class="select" id="persediaan" style="width: 100%;">
										<option>Persediaan</option>
										<option>Non Persediaan</option>
									</select>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<div class="table-responsive">
					<div style="width: 1550px; font-size: 13px;">
						<button type="button" class="btn btn-block" id="btn_material" style="width: 150px; margin-bottom: 10px; color: #FFFFFF; background-color: #3FB4F7;"><i class="fa fa-plus-square mr-2"></i><b>Material</b></button>
						<table id="tabel_material" class="table table-bordered">
							<thead style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
								<tr style="text-align: center;">
									<td width="5%">No</td>
									<td width="7.5%">Jenis</td>
									<td>Nama Material</td>
									<td width="7.5%">Satuan</td>
									<td width="7.5%">Stock Gudang</td>
									<td width="7.5%">Qty Budget</td>
									<td width="10%">Qty SIP</td>
									<td width="10%">Deadline</td>
									<td width="15%">Keterangan</td>
									<td width="10%">Kategori</td>
									<td>Hapus</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<table>
					<tr>
						<td width="150" title="Simpan Data"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
						<td width="10"></td>
						<td width="150" title="Kosongkan Isian"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
					</tr>
				</table>
			</div>
		</div>
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Surat Ijin Pembelian</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body" style="font-size: 13px;">
						<div class="table-responsive mb-3">
							<table style="width: 1100px; margin-bottom: 10px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="22.5%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<th width="20%" class="filter">Nomor SIP</th>
										<td></td>
										<th class="filter">Nama Material</th>
										<td></td>
										<th width="12.5%" class="filter">Unit</th>
										<td></td>
										<th width="10%" class="filter">Status</th>
										<td></td>
										<th width="15%" class="filter">Kategori</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input type="text" id="fTgl1" class="form-control datepicker" value="<?php echo date('01-M-Y', strtotime('0 days')); ?>" onchange="filter()" style="width: 100%; background-color: #FFFFFF; cursor: pointer; text-align: center;" readonly></td>
										<td><input type="text" id="fTgl2" class="form-control datepicker" value="<?php echo date("t-M-Y"); ?>" onchange="filter()" style="width: 100%; background-color: #FFFFFF; cursor: pointer; text-align: center;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_no_sip" onchange="filter()" style="width: 100%;">
												<option>All</option>
												<?php foreach ($no_sip->result_array() as $dt) { ?>
													<option><?php echo $dt['NO_SIP']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td><input type="text" class="cari" id="cari" autocomplete="off" onkeyup="filter()" placeholder="Cari Nama Material.." style="width: 100%;"></td>
										<td></td>
										<td>
											<select class="select" id="f_unit" onchange="filter()" style="width: 100%;">
												<?php foreach ($unit->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="status" onchange="filter()" style="width: 100%;">
												<option>All</option>
												<option>Open</option>
												<option>Close</option>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_kategori" onchange="filter()" style="width: 100%;">
												<option>All</option>
												<?php foreach ($kd_kategori->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KODE']; ?>"><?php echo ucwords(strtolower($dt['KATEGORI'])); ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="data-table m-3"></div>
						</div>

						<div class="card-footer">
							<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
							<button style="width: 150px;" type="button" onclick="upload_simpg()" class="btn btn-danger" title="Upload to SIMPG"><i class="fa fa-upload m-2"></i><b>SIMPG</b></button>	
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

<!-- Modal Batal SIP -->
<div class="modal fade" id="modal_batal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membatalkan SIP? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
			</div>
		</div>
	</div>
</div>

<style type="text/css">
	@media print {
		@page {
			size: landscape;
		}
	}
</style>
<div id="printable" style="display: none; font-family: Geneva; vertical-align: middle; text-align: left; margin: 0cm; font-size: 11px;">
	<div class="row">
		<div id="page1" class="col">
			<div>PT. PURA NUSAPERSADA</div>
			<div>KUDUS</div>
			<h3>SURAT IJIN PEMBELIAN</h3>

			<table id="tabel_sip" width="100%">
				<tr style="height: 10px;">
					<th width="20%">BAGIAN</th>
					<th width="2%">:</th>
					<td width="33%"></td>
					<th width="15%">UNIT</th>
					<th width="5%">:</th>
					<td width="25%"></td>
				</tr>
				<tr>
					<th>TANGGAL DIPERLUKAN</th>
					<th>:</th>
					<td><i>Terlampir</i></td>
					<th>NO. SIP</th>
					<th>:</th>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<td></td>
					<th>TANGGAL</th>
					<th>:</th>
					<td></td>
				</tr>
			</table>
			<div id="no_doc">F-SMT-PEMB-001 Rev. 1</div>
			<div class="table-responsive">
				<table id="tabel_sip_detail" class="table-responsive-sm table-bordered" width="100%">
					<thead>
						<tr style="line-height: 30px;">
							<th width="10%" style="text-align: center;">NO</th>
							<th width="40%" style="text-align: center;">SPESIFIKASI BARANG</th>
							<th width="10%" style="text-align: center;">KUANTITAS</th>
							<th width="12%" style="text-align: center;">DEADLINE</th>
							<th width="28%" style="text-align: center;">KETERANGAN</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<table width="100%">
				<thead>
					<tr>
						<td>TANGGAL :</td>
						<td></td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="25%" style="text-align: center;">DITERIMA,</td>
						<td width="25%" style="text-align: center;">MENGETAHUI,</td>
						<td width="25%" style="text-align: center;">MENYETUJUI,</td>
						<td width="25%" style="text-align: center;">DIBUAT,</td>
					</tr>
					<tr style="height: 50px;"></tr>
					<tr>
						<td style="text-align: center;">( ....................... )</td>
						<td style="text-align: center;">( ....................... )</td>
						<td style="text-align: center;">( ....................... )</td>
						<td style="text-align: center;">( ....................... )</td>
					</tr>
					<tr>
						<td style="text-align: center;">PEMBELIAN</td>
						<td style="text-align: center;">MGR FA/COST CONTROL</td>
						<td style="text-align: center;">KABAG/KABID YBS</td>
						<td style="text-align: center;">PEMOHON</td>
					</tr>
				</tbody>
			</table>
			<table id="tabel_sip_sign" class="table table-bordered">
				<tr>
					<td colspan="4" style="text-align: center;">DIISI OLEH BAGIAN PEMBELIAN</td>
				</tr>
				<tr>
					<td width="5%" style="text-align: center;">NO</td>
					<td width="40%" style="text-align: center;">PEMASOK (YANG LALU)</td>
					<td width="40%" style="text-align: center;">HARGA PER-SATUAN (YLL)</td>
					<td width="15%" style="text-align: center;">NO. SPP</td>
				</tr>
				<tr style="height: 50px;">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
		<div style="margin: 20px;"></div>
		<div id="page2" class="col"></div>
		<div style="margin-left: 10px;"></div>
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
	var id_edit = '';

// Load Dokumen
	$(document).ready(function() {
		// $('.fa-bars:eq(0)').click();

		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});

		isi_unit();
		auto_no();
	});

// Pagination
	function pagination() {
		var tbl_data = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [[2, "asc"]],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {
					columns: ':visible'
				},
				className: 'invisible excel',
				title: 'Laporan Data SIP'
			}],
			"colReorder": true
		});

		setTimeout(function() {tbl_data.columns.adjust().draw();}, 2000);
	}

	function filter() {
		var kd_unit = document.getElementById('f_unit').value;
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var cari = document.getElementById('cari').value;
		var status = document.getElementById('status').value;
		var no_sip = document.getElementById('f_no_sip').value;
		var kategori = document.getElementById('f_kategori').value;
		var data = [tgl1, tgl2, cari, status, kd_unit, no_sip, kategori];

		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/ppic/sip/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);

				if (kd_unit == '12') {
					$('#data-table td:nth-child(18), #data-table th:nth-child(18)').hide();
				}else{
					$('#data-table td:nth-child(18), #data-table th:nth-child(18)').show();
				}

				pagination();
			}
		});
	}

// Isi Unit otomatis
	function isi_unit() {
		var kd_unit = <?php echo json_encode($karyawan[5]); ?>;
		$('#f_unit').val(kd_unit).change();
	}

// Enable Change Bagian
	$('#auto').click(function() {	
		var auto = document.getElementById('auto').checked;

		if (auto == true) {
			$('#bagian').attr('disabled','');
		}else{
			$('#bagian').removeAttr('disabled');
		}
	});

// Isi Auto No
	function auto_no() {
		var kd_unit = $('#unit').val().split('@')[0];
		var trans = $('#unit').val().split('@')[1];
		var tgl = $('#tanggal').val();
		var i_bagian = document.getElementById("bagian").selectedIndex;
		var dt_bagian = <?php echo json_encode($bagian->result_array()); ?>;
		var kode_dept = dt_bagian[i_bagian].KD_DEPT_SIMPG;
		var data = [tgl, kd_unit, id_edit, kode_dept];

		$('#no_sip').val('');
		$.ajax({
			type: 'POST',
			async: false,
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/ppic/sip/auto_no',
			success: function(data) {
				data = JSON.parse(data);
				urut = data[0];
				kode_dept = data[1];
				bulan = data[2];
				tahun = data[3];

				$('#no_sip').val(urut + trans + kode_dept + '/' + bulan + '-' + tahun);
			}
		});

		hide_kategori(kd_unit);
	}

	function hide_kategori(kd_unit) {
		if (kd_unit == '12') {
			$('#tabel_material td:nth-child(10)').hide();
		}else{
			$('#tabel_material td:nth-child(10)').show();
		}
	}

// Tambah Produk
	$('#btn_material').on('click', function() {
		var kd_unit = $('#unit').val().split('@')[0];
		var options_material = $("#material").html();
		var qty_input = $('#tabel_material tr').length - 1;

		$('#tabel_material').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control" name="jenis" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><div style="width: 400px;"><select class="form-control select" style="width: 100%;" name="nama" onchange="isi_nama(this)"></select></div></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="satuan">' +
			'<option value="">Pilih..</option> ' +
			'<?php foreach ($satuan->result_array() as $dt) : ?>' +
			'<option><?php echo $dt['SATUAN']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></td>' +
			'<td><input type="text" class="form-control" name="stok" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control" name="quota" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control" name="qty" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><input type="text" class="form-control datepicker" name="deadline" value="<?php echo date('d-M-Y'); ?>" style="width: 100%; text-align: center; background-color: #FFFFFF; cursor: pointer;" readonly></td>' +
			'<td><input type="text" class="form-control" name="keterangan" style="width: 100%;" autocomplete="off" maxlength="50"></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="kd_kategori">' +
			'<option value="">Pilih..</option> ' +
			'<?php foreach ($kd_kategori->result_array() as $dt) : ?>' +
			'<option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['KATEGORI']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></td>' +
			'<td style="width: 75px;"><button type="button" class="btn btn-block btn-danger" title="Hapus Material" onclick="hapus_material(this)" style="margin-top: 0; width: 50px;"><i class="fa ion-trash-a"></button></td>' +
			'</tr>');

		$('[name="nama"]:eq('+qty_input+')').html(options_material);
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		urut_material();
		onlynumeric();
		hide_kategori(kd_unit);
	});

// Isi Nomor Urut material
	function urut_material() {
		var tabel_material = document.getElementById('tabel_material');

		for (var i=0; i<tabel_material.rows.length-1; i++) {
			document.getElementsByName('nmr')[i].value = i + 1;
		}
	}

// Isi Kode Material
	function isi_nama(btn) {
		var tabel_material = document.getElementById('tabel_material');
		var material = <?php echo json_encode($material->result_array()); ?>;
		var row = $(btn).closest("tr").index();
		var index = btn.selectedIndex - 1;
		var nama = index == -1 ? '' : material[index].NAMA + ' ' + material[index].SPESIFIKASI;
		var jenis = index == -1 ? '' : material[index].JENIS;
		var satuan = index == -1 ? '' : material[index].SATUAN;

		document.getElementsByName('jenis')[row].value = jenis;
		document.getElementsByName('jenis')[row].title = jenis;
		document.getElementsByName('satuan')[row].value = satuan;
		document.getElementsByName('satuan')[row].title = nama;
		document.getElementsByName('stok')[row].value = '-';
		document.getElementsByName('quota')[row].value = '-';
		$(".select").select2();
	}

// Hapus List Material
	function hapus_material(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		urut_material();
	};

// Kosong Isian
	function kosong() {
		$('#tanggal').val(<?php echo json_encode(date("d-M-Y")); ?>).change();
		$('#sifat').val('Reguler');
		$("#tabel_material").find("tr:gt(0)").remove();

		id_edit = '';
		auto_no();
	}

// Cek Duplikasi Nomor
	function ck_nmr(no_sip) {
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/sip/ck_nmr',
			data: {data: no_sip},
			success: function(data) {
				data = JSON.parse(data);

				if (data[0] != 0 && id_edit == '') {error_isian('Nomor sudah dipakai..');}
				if (data[1] != 0) {error_isian('Sudah ada PO..');}
			}
		});
	}

// cek termasuk id material yg diblock ato tidak
	function ck_block(t_id_material) {
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/sip/ck_block',
			data: {data: t_id_material},
			success: function(data) {
				
				data = JSON.parse(data);
				console.log(data);
				if ( data.length  > 0 ) {error_isian('Data Barang di program SAKTI belum ada, silahkan hapus item terlebih dahulu dan daftarkan lewat SAKTI<br><br>'+ data[0].NAMA);}
				
			}
		});
	}	

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var tabel_material = document.getElementById('tabel_material');
		var kd_unit = $('#unit').val().split('@')[0];
		var tanggal = document.getElementById("tanggal").value;
		var no_sip = document.getElementById("no_sip").value;
		var sifat = document.getElementById("sifat").value;
		var persediaan = document.getElementById("persediaan").value;
		var cek_nmr = ck_nmr(no_sip);
		var id_material = [], qty = [], deadline = [], keterangan = [], satuan = [], kd_kategori = [];

		if (no_sip == '' || tabel_material.rows.length == 1) {error_isian('Belum ada barang yang dipilih..');}

	// Array Material
		for (var i=0; i<tabel_material.rows.length-1; i++) {
			t_jenis = document.getElementsByName('jenis')[i].value;
			t_id_material = document.getElementsByName('nama')[i].value;
			t_qty = document.getElementsByName('qty')[i].value;
			t_deadline = document.getElementsByName('deadline')[i].value;
			t_keterangan = document.getElementsByName('keterangan')[i].value;
			t_quota = document.getElementsByName('quota')[i].value;
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_kd_kategori = kd_unit == '12' ? '' : document.getElementsByName('kd_kategori')[i].value;
			
			var cek_block_id_barang = ck_block(t_id_material);

			if (t_qty == '' || t_deadline == '' || t_id_material == '') {error_isian('Isian barang belum lengkap..');}

			id_material.push(t_id_material);
			qty.push(angka(t_qty));
			deadline.push(t_deadline);
			keterangan.push(t_keterangan);
			satuan.push(t_satuan);
			kd_kategori.push(t_kd_kategori);

		// Cek duplikasi material
			for (var j=0; j<tabel_material.rows.length-1; j++) {
				j_material = document.getElementsByName('nama')[j].value;
				if (j_material == t_id_material && j != i) {
					error_isian('Material ganda..');
				}
			}

			
		}

		var material = [id_material, qty, deadline, keterangan, satuan, kd_kategori];
		var data = [tanggal, no_sip, sifat, kd_unit, material, id_edit, persediaan];
		console.log(data);
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/ppic/sip/simpan',
			data: {data: data},
			success: function(data) {
				console.log(data);
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
					kosong();
					filter();
				}, 500);
			}
		});
	}

// Edit Data SIP
	function edit(btn) {
		var tabel_material = document.getElementById('tabel_material');
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_sip_detail = data_table.rows[row].cells[0].innerHTML;

		$('#btnProgress').click();
		$("#tabel_material").find("tr:gt(0)").remove();
		setTimeout(function() {
			$.ajax({
				data: {data: id_sip_detail},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/ppic/sip/edit" ?>',
				success: function(data) {
					data = JSON.parse(data);

					id_edit = data[0].ID_SIP;
					$('#tanggal').val(format_date(data[0].TANGGAL)).change();
					$('#sifat').val(data[0].SIFAT).change();
					$('#unit').val(data[0].KD_UNIT + '@' + data[0].KODE_TRANSAKSI).change();
					$('#no_sip').val(data[0].NO_SIP).change();
					$('#persediaan').val(data[0].PERSEDIAAN).change();
					$('#bagian').val(data[0].BAGIAN).change();

					for (var i = 0; i < data.length; i++) {
						$('#btn_material').click();
						document.getElementsByName('jenis')[i].value = data[i].JENIS;
						document.getElementsByName('nama')[i].value = data[i].ID_BARANG;
						document.getElementsByName('satuan')[i].value = data[i].SATUAN;
						document.getElementsByName('stok')[i].value = '0';
						document.getElementsByName('quota')[i].value = '0';
						document.getElementsByName('qty')[i].value = format_number(desimal(data[i].QTY));
						document.getElementsByName('deadline')[i].value = format_date(data[i].DEADLINE);
						document.getElementsByName('keterangan')[i].value = data[i].KETERANGAN;
						$('[name=kd_kategori]:eq('+i+')').val(data[i].KD_KATEGORI).change();

						document.getElementsByName('jenis')[i].title = data[i].JENIS;
						document.getElementsByName('satuan')[i].title = (data[i].NAMA + ' ' + data[i].SPESIFIKASI).substring(0, 50).trim();
					}
					$(".select").select2();

					setTimeout(function() {$('#btnOk').click();}, 500);
				}
			});
		}, 1000);
		$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
	}

// Format Tanggal DD-MMM-YYYY
	function format_date(date) {
		try {
			var tgl = date.substring(0, 2);
			var month = parseInt(date.substring(3, 5)) - 1;
			var thn = date.substring(6);

			var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sept", "Oct", "Nov", "Dec"];
			var bln = bln[month];
			return tgl + '-' + bln + '-' + thn;
		} catch (err) {}
	}

// Notifikasi Hapus Data
	function batal(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_sip_detail = data_table.rows[row].cells[0].innerHTML;
		var id_sip = data_table.rows[row].cells[1].innerHTML;
		var no_sip = data_table.rows[row].cells[4].innerHTML;
		var data = [id_sip_detail, id_sip, no_sip];

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_sip_detail == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/ppic/sip/batal',
				data: {data: data},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
						filter();
						auto_no();

						id_sip_detail = '';
					}, 500);
				}
			});
		});

		$('#btnNo').on('click', function() {
			if (id_sip_detail == '') {return;}
			id_sip_detail = '';
		});
	}

// Print Data
	function cetak(btn) {
		var data_table = document.getElementById('data-table');
		var tabel_sip = document.getElementById('tabel_sip');
		var row = $(btn).closest("tr").index() + 1;
		var id_detail_sip = data_table.rows[row].cells[0].innerHTML;
		
		$("#tabel_sip_detail").find("tr:gt(0)").remove();
		$.ajax({
			async: false,
			data: {data: id_detail_sip},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/ppic/sip/cetak" ?>',
			success: function(data) {
				data = JSON.parse(data);

				jenis = (data[0].JENIS).split(' - ');
				tabel_sip.rows[0].cells[2].innerHTML = data[0].BAGIAN + ' (' + data[0].PERSEDIAAN + ')';
				tabel_sip.rows[0].cells[5].innerHTML = data[0].UNIT;
				tabel_sip.rows[1].cells[5].innerHTML = data[0].NO_SIP;
				tabel_sip.rows[2].cells[5].innerHTML = data[0].TGL;

				data[0].SIFAT == 'Reguler' ? $('#no_doc').text('F-SMT-PEMB-001 Rev. 1') : $('#no_doc').text('F-SMT-PEMB-001U Rev. 1');

				for (var i = 0; i < data.length; i++) {
					keterangan = data[i].KETERANGAN;
					kd_kategori = data[i].KD_KATEGORI == null ? '' : ' (Kat. : ' + data[i].KD_KATEGORI + ')';
					rek_jurnal = ' <b>('+ data[i].NO_REKJURNAL +')</b>';
					$('#tabel_sip_detail tbody').append('<tr><td align="center">' + (i + 1) + '</td><td class="pl-2">' + data[i].NAMA + ' - ' + data[i].SPESIFIKASI + rek_jurnal + '</td><td align="right">' + format_number(desimal(data[i].QTY)) + ' ' + data[i].SATUAN + '</td><td align="center">' + data[i].DEADLINE + '</td><td class="pl-2">' + keterangan + kd_kategori + '</td></tr>')
				}
			}
		});

		setTimeout(function() {
			var printable = document.getElementById('printable');
			var non_printable = document.getElementById('non_printable');
			var page1 = document.getElementById('page1');
			var page2 = document.getElementById('page2');
			page2.innerHTML = page1.innerHTML;

			printable.style.display = "";
			non_printable.style.display = "none";

			window.scrollTo({top: 0,left: 0});
			window.print();

			printable.style.display = "none";
			non_printable.style.display = "";
		}, 700);
	}

// Upload Ke SIMPG
	function upload_simpg() {
		var datatable = $('#data-table tbody')[0];
		var qty_data = datatable.rows.length;
		var kd_unit = $('#f_unit').val();
		var dt_po = [];

		if (datatable.rows[0].cells[0].innerHTML == 'No data available in table') {error_isian('Tidak ada SIP yang terupload ke SIMPG..');}
		for (var i=0; i<qty_data; i++) {
			nmr_po = datatable.rows[i].cells[4].innerHTML;
			dt_po.push(nmr_po);
		}

		var data = [kd_unit, [...new Set(dt_po)]];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/ppic/sip/upload_manual_simpg" ?>',
			success: function(data) {
				console.log(data);
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
				}, 500);
			}
		});
	}

</script>