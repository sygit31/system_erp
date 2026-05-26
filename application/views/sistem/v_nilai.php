<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Select Live Search -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Input Penilaian</div>
						</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Sistem - Manual Book Input Data Penilaian.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body" style="margin-bottom: -30px;">
				<div class="row">
					<div class="col-6">
						<table width="100%">
							<tr>
								<th width="15%">Tanggal</th>
								<td width="30%">
									<?php $date = date("d-M-Y"); ?>
									<?php $last_month = date("d-M-Y", strtotime("-12 month")); ?>
									<input type="text" class="form-control datepicker" id="periode" value="<?php echo $date; ?>" onchange="get_periode_nilai()" style="width: 30%; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Kategori</th>
								<td>
									<select class="select" id="kategori" onchange="get_periode_nilai()" style="width: 80%;">
										<option value="">Pilih kategori..</option>
									</select>
								</td>
							</tr>
							<tr style="height: 50px;"></tr>
						</table>
					</div>
					<div class="col-6">
						<table id="tbl_set" class="table table-bordered table-striped text-center">
							<tr class="h5">
								<td colspan="5">Range Nilai (Qty Karyawan : 0)</td>
							</tr>
							<tr class="h6">
								<td>4.41 - 5.00</td>
								<td>3.91 - 4.40</td>
								<td>3.31 - 3.90</td>
								<td>2.61 - 3.30</td>
								<td>< 2.60</td>
							</tr>
							<tr class="h6">
								<td>BS</td>
								<td>B</td>
								<td>C</td>
								<td>K</td>
								<td>KS</td>
							</tr>
							<tr class="h6">
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td class="text-right bg-secondary">Target</td>
							</tr>
							<tr class="h6 bg-danger">
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td>0</td>
								<td class="text-right bg-secondary">Realisasi</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<td width="50%"><button type="button" class="btn btn-block btn-warning tab" onclick="tab(this)">Nilai</button></td>
						<td width="50%"><button type="button" class="btn btn-block btn-default tab" onclick="tab(this)">Grafik</button></td>
					</tr>
				</table>
			</div>
			<div class="card-footer">
				<div class="nilai">
					<table style="width: 20%; margin-bottom: 10px;">
						<thead>
							<tr align="center" style="line-height: 30px;">
								<th width="50%" class="filter">Unit</th>
								<td></td>
								<th width="50%" class="filter">Status</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<select class="select" id="fUnit" onchange="get_periode_nilai()" style="width: 100%;">
										<option>All</option>
										<option>Holografi</option>
										<option>Holo Perdana</option>
									</select>
								</td>
								<td></td>
								<td>
									<select class="select" id="fStatus" onchange="get_periode_nilai()" style="width: 100%;">
										<option>All</option>
										<option>Karyawan</option>
										<option>OS</option>
									</select>
								</td>
							</tr>
						</tbody>
					</table>
					<table id="tabel_nilai" class="table table-bordered" width="100%">
						<thead style="background-color: #069CB7; font-weight: bold; color: #FFFFFF;">
							<tr style="text-align: center;">
								<td width="5%">No</td>
								<td width="10%">NIK</td>
								<td width="20%">Nama Karyawan</td>
								<td width="6.5">Motivasi Kerja</td>
								<td width="6.5">Komunikasi & Kerjasama</td>
								<td width="8%">Pemahaman & Penguasaan Pekerjaan</td>
								<td width="6.5%">Pengembangan Diri</td>
								<td width="8%">Hasil Kerja</td>
								<td width="6.5%">HR</td>
								<td width="6.5%">IS</td>
								<td width="6.5%">K3</td>
								<td width="8%">Total</td>
								<td width="6.5%">Kategori</td>
								<td hidden>id_sis_kategori</td>
								<td hidden>id_edit_nilai</td> <!-- Saat edit nilai -->
								<td hidden>nama_karyawan</td> <!-- Cari Nama Karyawan -->
								<td hidden>Kategori</td> <!-- Chart value by kategori -->
								<td hidden>Total Nilai</td> <!-- Chart value by kategori -->
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>
				<div class="grafik" style="display: none;">
					<canvas id="lineChart" style="max-width: 80%;"></canvas>
				</div>
			</div>
			<div class="card-footer">
				<table width="100%">
					<tr>
						<td width="10%"><button type="button" class="btn btn-block btn-primary" title="Simpan Data" id="btnSimpan" onclick="simpan()" <?php if (date('d') > '31' && $unlock != '1') {echo 'disabled';} ?>><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
						<td width="0.25%"></td>
						<td width="10%"><button type="button" class="btn btn-block btn-danger" title="Batal Isian" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
						<td width="0.25%"></td>
						<td width="10%"><button type="button" class="btn btn-block btn-warning" title="Ambil Data Previous" id="btnPrevious" onclick="previous()"><i class="fa fa-backward m-2"></i><b>Previous</b></button></td>
						<td width="0.25%"></td>
						<td width="10%"><button type="button" class="btn btn-block btn-success" title="Export ke Excel" id="btnExcel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
						<td width="28%"></td>
						<td width="30%" align="right"><button type="button" id="btn_kurva" class="btn btn-danger" title="Cek Kurva"><i class="fa fa-archive fa-2x mr-3"></i><b>Kurva Salah</b></button></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Hasil Penilaian</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<table style="width: 50%; margin-bottom: 10px;">
							<thead>
								<tr align="center" style="line-height: 30px;">
									<th width="20%" class="filter">Periode</th>
									<td></td>
									<th width="30%" class="filter">Kategori</th>
									<td></td>
									<td width="50%" class="filter">Nama Karyawan</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>
										<?php $dt_periode = array(); ?>
										<?php foreach ($tanggal->result_array() as $dt) { ?>
											<?php $dt_periode[] = $dt['TANGGAL']; ?>
										<?php } ?>
										<?php $fPeriode = array_unique($dt_periode); ?>
										<select class="select" id="fPeriode" onchange="filter()" style="width: 100%; cursor: pointer;">
											<option>All</option>
											<?php foreach ($fPeriode as $dt) { ?>
												<option selected><?php echo $dt; ?></option>
											<?php } ?>
										</select>
									</td>
									<td></td>
									<td>
										<select class="select" id="fKategori" style="width: 100%;" onchange="filter()">
											<option value="">Pilih kategori..</option>
										</select>
									</td>
									<td></td>
									<td>
										<input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama karyawan.." style="width: 100%;" autocomplete="off"></td>
									</td>
								</tr>
							</tbody>
						</table>

						<?php $this->load->view('sistem/v_nilai_table'); ?>

						<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

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

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
			<div class="modal-footer">
				<button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
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
				<button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){location.reload();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
				<button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Export Excel -->
<div id="excel" style="display: none;">
	<table id="tabel_excel" class="table table-bordered" width="100%">
		<thead style="background-color: #069CB7; font-weight: bold; color: #FFFFFF;">
			<tr style="text-align: center;">
				<td width="5%">No</td>
				<td width="10%">NIK</td>
				<td width="25%">Nama Karyawan</td>
				<td width="6.5">Motivasi Kerja</td>
				<td width="6.5">Komunikasi & Kerjasama</td>
				<td width="8%">Pemahaman & Penguasaan Pekerjaan</td>
				<td width="6.5%">Pengembangan Diri</td>
				<td width="6.5%">Hasil Kerja</td>
				<td width="6.5%">HR</td>
				<td width="6.5%">IS</td>
				<td width="6.5%">K3</td>
				<td width="6.5%">Total</td>
				<td width="6.5%">Kategori</td>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<!-- DataTables -->
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

<script>

// Define Variable
	var tabel = '', tabel_input = '', urut_kurva = '17';
	var tabel_nilai = document.getElementById('tabel_nilai');
	var tbl_set = document.getElementById('tbl_set');
	var arr_nilai = [];
var info_1 = 0, info_2 = 0; // Status Card Info

// Load Dokumen
$(document).ready(function() {
	var last_month = <?php echo json_encode($last_month); ?>;

	$(".select").select2();
	$(".datepicker").datepicker({
		dateFormat: 'dd-M-yy',
		minDate: new Date(last_month)
	});
	pagination();
	isi_list_kategori();

	$('.fa-bars:eq(0)').click();
});

// Hide Sidebar
$('#hide_sidebar').click(function() {
	if (tabel_input == '') {
		return;
	}
	setTimeout(function() {
		tabel_input.columns.adjust().draw();
	}, 500);
});

// Isi List Kategori
function isi_list_kategori() {
	<?php $kary = explode('|', $_SESSION['logERP']); ?>
	var id_kary = <?php echo json_encode($kary[0]); ?>;

	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/sistem/nilai/ambil_kategori',
		data: {
			data: id_kary
		},
		success: function(data) {
			data = JSON.parse(data);
			for (var i = 0; i < data.length; i++) {
				option = document.createElement("option");
				option.text = data[i]['KATEGORI'];

				opt = document.createElement("option");
				opt.text = data[i]['KATEGORI'];

				document.getElementById("fKategori").add(option);
				document.getElementById("kategori").add(opt);
			}
		}
	});
}

// Isi Chart
function isi_chart() {
	if ($('#kategori').val() == '') {
		var rows = 0;
	} else {
		var rows = tabel_input.rows().data().length;
	}

	var kategori = '',
	ks = 0,
	k = 0,
	c = 0,
	b = 0,
	bs = 0;

	if (rows > 1) {
		for (var i = 0; i < rows; i++) {
			try {
				kategori = arr_nilai[i];
				if (kategori == 'KS') {
					ks++;
				} else if (kategori == 'K') {
					k++;
				} else if (kategori == 'C') {
					c++;
				} else if (kategori == 'B') {
					b++;
				} else if (kategori == 'BS') {
					bs++;
				}
			} catch (e) {}
		}
	}

	chart(ks, k, c, b, bs);
}

// Chart
function chart(ks, k, c, b, bs) {
	var chrt = document.getElementById("lineChart").getContext('2d');
	var line = new Chart(chrt, {
		type: 'line',
		data: {
			labels: ["BS", "B", "C", "K", "KS"],
			datasets: [{
				label: "QTY",
				data: [bs, b, c, k, ks],
				backgroundColor: [
					'rgba(105, 0, 132, .2)',
					],
				borderColor: [
					'rgba(200, 99, 132, .7)',
					],
				borderWidth: 2
			}]
		},
		options: {
			responsive: true,
			elements: {
				point: {
					radius: 0
				}
			}
		}
	});
}

// Pagination
function pagination() {
	$('#data-table').DataTable().destroy();
	tabel = $('#data-table').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {"sSearch": "Cari :"},
		"autoWidth": true,
		"scrollX": true,
		"scrollY": "400px",
		"order": [[0, "asc"]],
		"info": false,
		"autoWidth": true,
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {
				columns: ':visible'
			},
			className: 'invisible excel',
			filename: 'Laporan Data Nilai',
			title: ''
		}],
		"colReorder": true
	});


	var kategori = $('#fKategori').val();
	if (kategori == 'Atasan Langsung' || kategori == 'Manajemen' || kategori == 'Kolega' || kategori == 'Kolega 1' || kategori == 'Kolega 2') {
		for (var i = 10; i <= 12; i++) {
			tabel.column(i).visible(false);
		}
	} else if (kategori == '') {
		for (var i = 5; i <= 12; i++) {
			tabel.column(i).visible(true);
		}
	} else {
		for (var i = 5; i <= 9; i++) {
			tabel.column(i).visible(false);
		}
	}

	setTimeout(function() {tabel.columns.adjust().draw();},1000);
}

// Autosort Table
function autosort() {
	var table, rows, switching, i, x, y, shouldSwitch;
	table = document.getElementById("tabel_nilai");
	switching = true;

	urut_kurva == '17' ? urut_kurva = '15' : urut_kurva = '17'
	while (switching) {
		switching = false;
		rows = table.rows;
		for (i = 1; i < (rows.length - 1); i++) {
			shouldSwitch = false;
			x = rows[i].getElementsByTagName("TD")[urut_kurva];
			y = rows[i + 1].getElementsByTagName("TD")[urut_kurva];

			if (urut_kurva == '15') {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			} else {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
					shouldSwitch = true;
					break;
				}
			}

		}
		if (shouldSwitch) {
			rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
			switching = true;
		}
	}

	for (var i = 1; i < table.rows.length; i++) {
		tabel_nilai.rows[i].cells[0].innerHTML = i;
	}
}

// Pagination
function pagination_input() {
	var kategori = $('#kategori').val();
	var qty_data = $('#tabel_nilai tr').length;

	autosort();

	// Hide Column depend Kategori
	for (var i = 0; i < qty_data; i++) {
		for (var j = 3; j < 11; j++) {
			tabel_nilai.rows[i].cells[j].removeAttribute('hidden', '');
		}
		switch (true) {
		case ((kategori == 'Atasan Langsung') || (kategori == 'Manajemen') || (kategori == 'Kolega') || (kategori == 'Kolega 1') || (kategori == 'Kolega 2')):
			for (var j = 8; j < 11; j++) {
				tabel_nilai.rows[i].cells[j].setAttribute('hidden', '');
			}

			break;
		case (kategori == 'HR' || kategori == 'IS' || kategori == 'K3'):
			for (var j = 3; j < 8; j++) {
				tabel_nilai.rows[i].cells[j].setAttribute('hidden', '');
			}
			break;
		}
	}

	// Datatable
	if (qty_data == 1) {
		height = "100px";
	} else if (qty_data > 5) {
		height = "400px";
	} else {
		height = ((qty_data - 1) * 100) + "px";
	}

	tabel_input = $('#tabel_nilai').DataTable({
		"paging": false,
		"lengthChange": false,
		"oLanguage": {
			"sSearch": "Cari Nama Karyawan  :"
		},
		"info": false,
		"autoWidth": true,
		"scrollX": true,
		"scrollY": height,
		"columnDefs": [{
			"orderable": false,
			"targets": "_all"
		}],
		"order": []
	});

	setTimeout(function() {
		tabel_input.columns.adjust().draw();
	}, 500);
}

// Export Excel Penilai
$('#btnExcel').on('click', function() {
	var rows = tabel_input.rows().data().length;

	$('#excel').css("display", "block");

	$('#tabel_excel').DataTable().destroy();
	$("#tabel_excel").find("tbody tr").remove();
	for (var i = 0; i < rows; i++) {
		nik = ((tabel_input.rows(i).data()[0][1]).split("\"")[7]).trim();
		nama = ((tabel_input.rows(i).data()[0][2]).split("\"")[7]).trim();
		n1 = document.getElementsByName('n1')[i].value;
		n2 = document.getElementsByName('n2')[i].value;
		n3 = document.getElementsByName('n3')[i].value;
		n4 = document.getElementsByName('n4')[i].value;
		n5 = document.getElementsByName('n5')[i].value;
		n6 = document.getElementsByName('n6')[i].value;
		n7 = document.getElementsByName('n7')[i].value;
		n8 = document.getElementsByName('n8')[i].value;
		total = document.getElementsByName('total')[i].value;
		kategori = document.getElementsByName('kategori')[i].value;

		$('#tabel_excel tbody').append('<tr><td align="center">' + (i + 1) + '</td><td align="center">' + nik + '</td><td>' + nama + '</td><td>' + n1 + '</td><td>' + n2 + '</td><td>' + n3 + '</td><td>' + n4 + '</td><td>' + n5 + '</td><td>' + n6 + '</td><td>' + n7 + '</td><td>' + n8 + '</td><td>' + total + '</td><td>' + kategori + '</td></tr>')
	}

	var tabel_excel = $('#tabel_excel').DataTable({
		"paging": false,
		"lengthChange": false,
		"searching": false,
		"scrollX": true,
		"ordering": false,
		"info": false,
		"autoWidth": true,
		"dom": 'frtipB',
		"buttons": [{
			text: 'Export Excel',
			extend: 'excel',
			exportOptions: {
				columns: ':visible'
			},
			className: 'btn btn-success btnExcel',
			title: 'Cetak Master Nilai'
		}]
	});
	tabel_excel.buttons('.btnExcel').nodes().css("display", "none");

	$('.btnExcel')[0].click();

	setTimeout(function() {
		$('#excel').css("display", "none");
	}, 2000);
});

// Tab Selection
function tab(e) {
	$('.tab').removeClass("btn-info").addClass("btn-default");
	e.classList.remove("btn-default");
	e.classList.add("btn-warning");

	if ((e.innerText).trim() == 'Nilai') {
		$('.nilai').css('display', 'block');
		$('.grafik').css('display', 'none');
	} else {
		$('.nilai').css('display', 'none');
		$('.grafik').css('display', 'block');
		isi_chart();
	}
}

// Kategori Selected
function get_periode_nilai() {
	var previous = '0';

	$('.tab')[0].click();
	if ($('#kategori').val() == '') {
		kosong_isian();
		return;
	}

	isi_data(previous);
}

// Previous Nilai
function previous() {
	var previous = '1';

	isi_data(previous);
}

// Isi data yang dipilih
function isi_data(previous) {
	var periode = $('#periode').val();
	var unit = $('#fUnit').val();
	var status = $('#fStatus').val();
	<?php $kary = explode('|', $_SESSION['logERP']); ?>
	var id_kary = <?php echo json_encode($kary[0]); ?>;
	var kategori = $('#kategori').val();
	if (kategori == '') {
		return;
	}
	var data = [id_kary, kategori, periode, previous, unit, status];
	var qty_kary = 0, arr_nilai = [], urut = 0;

	$('#tabel_nilai').DataTable().destroy();
	$("#tabel_nilai").find("tbody").show();
	$("#tabel_nilai").find("tbody tr").remove();

	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/sistem/nilai/preview_penilai',
		data: {data: data},
		success: function(data) {
			data = JSON.parse(data);
			qty_kary = data.length;
			if (qty_kary == 0) {
				setTimeout(function() {
					$('#btnOk').click();
					return;
				},500);
			}

			setTimeout(function() {
				for (var i = 0; i < qty_kary; i++) {
					qty_nilai = 0;
					nik = data[i]['NIK'];
					nama = data[i]['NAMA'].toUpperCase();
					id_sis_kategori = data[i]['ID_SIS_KATEGORI'];
					id_sis_nilai = data[i]['ID_SIS_NILAI'];
					if (id_sis_nilai == null) {
						id_sis_nilai = '';
					}

					n1 = data[i]['N1'];
					if (n1 == null) {
						n1 = '';
					} else {
						qty_nilai++;
					}
					n2 = data[i]['N2'];
					if (n2 == null) {
						n2 = '';
					} else {
						qty_nilai++;
					}
					n3 = data[i]['N3'];
					if (n3 == null) {
						n3 = '';
					} else {
						qty_nilai++;
					}
					n4 = data[i]['N4'];
					if (n4 == null) {
						n4 = '';
					} else {
						qty_nilai++;
					}
					n5 = data[i]['N5'];
					if (n5 == null) {
						n5 = '';
					} else {
						qty_nilai++;
					}
					n6 = data[i]['N6'];
					if (n6 == null) {
						n6 = '';
					} else {
						qty_nilai++;
					}
					n7 = data[i]['N7'];
					if (n7 == null) {
						n7 = '';
					} else {
						qty_nilai++;
					}
					n8 = data[i]['N8'];
					if (n8 == null) {
						n8 = '';
					} else {
						qty_nilai++;
					}
					total_nilai = ((Number(n1) + Number(n2) + Number(n3) + Number(n4) + Number(n5) + Number(n6) + Number(n7) + Number(n8)) / qty_nilai).toFixed(2);
					if (qty_nilai == 0) {
						total_nilai = '';
						kategori = '';
					} else {
						kategori = isi_kategori(total_nilai);
					}
					arr_nilai[i] = kategori;

					qty_prev = data[i]['QTY_PREV'];
					if (qty_prev == 0) {
						$('#tabel_nilai tbody').append(
							'<tr>' +
							'<td align="center">' + (urut + 1) + '</td>' +
							'<td align="center"><input type="text" class="form-control" name="nik" value=" ' + nik + ' " style="width: 100%; text-align: center;" readonly></td>' +
							'<td><input type="text" class="form-control" name="nama" value=" ' + nama + ' " style="width: 100%;" readonly></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n1 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n1" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n2 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n2" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n3 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n3" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n4 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n4" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n5 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n5" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n6 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n6" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n7 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n7" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control nilai" value="' + n8 + '" onkeyup="isi_total(this)" onkeydown="tab_index(this)" onfocusout="cek_isian(this)" name="n8" maxlength="4" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
							'<td><input type="text" class="form-control" name="total" value="' + total_nilai + '" style="width: 100%; text-align: center;" readonly></td>' +
							'<td><input type="text" class="form-control" name="kategori" value="' + kategori + '" style="width: 100%; text-align: center;" readonly></td>' +
							'<td hidden>' + id_sis_kategori + '</td>' +
							'<td hidden>' + id_sis_nilai + '</td>' +
							'<td hidden>' + nama + '</td>' +
							'<td hidden>' + kategori + '</td>' +
							'<td hidden>' + total_nilai + '</td>' +
							'</tr>')
						document.getElementsByName('nik')[urut].setAttribute('title', nik);
						document.getElementsByName('nama')[urut].setAttribute('title', nama);
						urut++;
					}
				}

				cek_kategori(urut);
				pagination_input();
				isi_chart();
				cek_kurva();

				$('#btnOk').click();
			}, 500);
			} // End Success
		}); // End Ajax
}

// Penggunaan Arrow Tab
function tab_index(e) {
	var event = window.event ? window.event : e;
	var nilai = document.getElementsByName(e.name);
	var arr = Array.prototype.slice.call(nilai);
	var indeks = arr.indexOf(e);

	switch (e.name) {
	case "n1":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n1')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n1')[indeks - 1].focus()
					};
				} else if (event.keyCode == 37) { // Kiri
					if (indeks > 0) {
						document.getElementsByName('n5')[indeks - 1].focus()
					};
				} else if (event.keyCode == 39) { // Kanan
					document.getElementsByName('n2')[indeks].focus();
				}
				break;
			case "n2":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n2')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n2')[indeks - 1].focus()
					};
				} else if (event.keyCode == 37) { // Kiri
					document.getElementsByName('n1')[indeks].focus();
				} else if (event.keyCode == 39) { // Kanan
					document.getElementsByName('n3')[indeks].focus();
				}
				break;
			case "n3":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n3')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n3')[indeks - 1].focus()
					};
				} else if (event.keyCode == 37) { // Kiri
					document.getElementsByName('n2')[indeks].focus();
				} else if (event.keyCode == 39) { // Kanan
					document.getElementsByName('n4')[indeks].focus();
				}
				break;
			case "n4":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n4')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n4')[indeks - 1].focus()
					};
				} else if (event.keyCode == 37) { // Kiri
					document.getElementsByName('n3')[indeks].focus();
				} else if (event.keyCode == 39) { // Kanan
					document.getElementsByName('n5')[indeks].focus();
				}
				break;
			case "n5":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n5')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n5')[indeks - 1].focus()
					};
				} else if (event.keyCode == 37) { // Kiri
					document.getElementsByName('n4')[indeks].focus();
				} else if (event.keyCode == 39) { // Kanan
					if (indeks < arr.length - 1) {
						document.getElementsByName('n1')[indeks + 1].focus();
					}
				}
				break;
			case "n6":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n6')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n6')[indeks - 1].focus()
					};
				}
				break;
			case "n7":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n7')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n7')[indeks - 1].focus()
					};
				}
				break;
			case "n8":
				if (event.keyCode == 40) { // Bawah
					if (indeks < arr.length - 1) {
						document.getElementsByName('n8')[indeks + 1].focus()
					};
				} else if (event.keyCode == 38) { // Atas
					if (indeks > 0) {
						document.getElementsByName('n8')[indeks - 1].focus()
					};
				}
				break;
			}
		}

// Cek isian selain format number
		function cek_isian(btn) {
			var isian = btn.value;
			if (isNaN(isian) || isian > 5) {
				$('#btnIsian').click();
				btn.focus();
			}
		}

// Isi Kategori Nilai
		function isi_kategori(total_nilai) {
			if (total_nilai <= 2.6) {
				return 'KS';
			} else if (total_nilai <= 3.3) {
				return 'K';
			} else if (total_nilai <= 3.9) {
				return 'C';
			} else if (total_nilai <= 4.4) {
				return 'B';
			} else if (total_nilai > 4.4) {
				return 'BS';
			}
		}

// Cek kategori
		function cek_kategori(qty_kary) {
			var kategori = $('#kategori').val();
			for (var i = 0; i < qty_kary; i++) {
				for (var j = 1; j < 9; j++) {
					document.getElementsByName('n' + j)[i].removeAttribute('readonly', '');
				}
				switch (true) {
				case ((kategori == 'Atasan Langsung') || (kategori == 'Manajemen') || (kategori == 'Kolega') || (kategori == 'Kolega 1') || (kategori == 'Kolega 2')):
					document.getElementsByName('n' + '6')[i].setAttribute('readonly', '');
					document.getElementsByName('n' + '7')[i].setAttribute('readonly', '');
					document.getElementsByName('n' + '8')[i].setAttribute('readonly', '');
					break;
				case (kategori == 'HR'):
					for (var k = 1; k < 9; k++) {
						document.getElementsByName('n' + k)[i].setAttribute('readonly', '');
					}
					document.getElementsByName('n6')[i].removeAttribute('readonly', '');
					break;
				case (kategori == 'IS'):
					for (var k = 1; k < 9; k++) {
						document.getElementsByName('n' + k)[i].setAttribute('readonly', '');
					}
					document.getElementsByName('n7')[i].removeAttribute('readonly', '');
					break;
				case (kategori == 'K3'):
					for (var k = 1; k < 9; k++) {
						document.getElementsByName('n' + k)[i].setAttribute('readonly', '');
					}
					document.getElementsByName('n8')[i].removeAttribute('readonly', '');
					break;
				}
			}
		}

// Rumus Nilai
		function isi_total(btn) {
			row = $(btn).closest("tr").index();

			var kategori = $('#kategori').val()
			if (kategori == 'Atasan Langsung' || kategori == 'Manajemen' || kategori == 'Kolega' || kategori == 'Kolega 1' || kategori == 'Kolega 2') {
				var n1 = document.getElementsByName('n1')[row].value;
				var n2 = document.getElementsByName('n2')[row].value;
				var n3 = document.getElementsByName('n3')[row].value;
				var n4 = document.getElementsByName('n4')[row].value;
				var n5 = document.getElementsByName('n5')[row].value;
				var arrTotal = [n1, n2, n3, n4, n5];
			} else {
				var n6 = document.getElementsByName('n6')[row].value;
				var n7 = document.getElementsByName('n7')[row].value;
				var n8 = document.getElementsByName('n8')[row].value;
				var arrTotal = [n6, n7, n8];
			}

			var total = 0;
			var qty = 0;
			var kategori = '';
			var baris = tabel_nilai.rows[row + 1].cells[0].innerHTML;

	// Isi Total
			for (var i = 0; i < arrTotal.length; i++) {
				if (arrTotal[i] != '') {
					qty++;
					total = total + Number(arrTotal[i]);
				}
			}

			document.getElementsByName('total')[row].value = (total / qty).toFixed(2);
			tabel_nilai.rows[row + 1].cells[17].innerHTML = (total / qty).toFixed(2);

			kategori = isi_kategori(total / qty);

			document.getElementsByName('kategori')[row].value = kategori;
			arr_nilai[baris - 1] = kategori;

	// Kosongkan Total dan Kategori jika N/A
			if (document.getElementsByName('total')[row].value == 'NaN') {
				document.getElementsByName('total')[row].value = '';
				document.getElementsByName('kategori')[row].value = '';
				tabel_nilai.rows[row + 1].cells[17].innerHTML = '';
			}

			cek_kurva();
		}

// Simpan Data
		function simpan() {
			var periode = $('#periode').val();
			var id_sis_kategori = [], id_edit_nilai = [], n1 = [], n2 = [], n3 = [], n4 = [], n5 = [], total = [];

			$('#tabel_nilai').DataTable().destroy();
			$("#tabel_nilai").find("tbody").hide();

			if (tabel_nilai.rows.length == 1) {
				$('#btnIsian').click();
				return;
			}

	// Array Karyawan
			for (var i = 0; i < tabel_nilai.rows.length - 1; i++) {
				if (document.getElementsByName('total')[i].value != '') {
					id_sis_kategori.push(tabel_nilai.rows[i + 1].cells[13].innerHTML);
					id_edit_nilai.push(tabel_nilai.rows[i + 1].cells[14].innerHTML);
					n1.push(document.getElementsByName('n1')[i].value);
					n2.push(document.getElementsByName('n2')[i].value);
					n3.push(document.getElementsByName('n3')[i].value);
					n4.push(document.getElementsByName('n4')[i].value);
					n5.push(document.getElementsByName('n5')[i].value);
					total.push(document.getElementsByName('total')[i].value);
				}
			}

			var data = [id_sis_kategori, id_edit_nilai, periode, n1, n2, n3, n4, n5, total];
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/sistem/nilai/simpan_nilai',
				data: {data: data},
				success: function(data) {
					console.log(data);
					setTimeout(function() {
						$('#btnOk').click();
						$('#btnSukses').click();
					}, 500);
				}
			});
		}

// Kosong Isian
		function kosong() {
			$('#kategori').val('').change();
			kosong_isian();
		}

		function kosong_isian() {
			$('#tabel_nilai').DataTable().destroy();
			$("#tabel_nilai").find("tbody").show();
			$("#tabel_nilai").find("tbody tr").remove();

			cek_kurva();
		}

// Filter Data
		function filter() {
			<?php $kary = explode('|', $_SESSION['logERP']); ?>
			var id_kary = <?php echo json_encode($kary[0]); ?>;
			var periode = $('#fPeriode').val();
			var kategori = $('#fKategori').val();
			var cari = $('#cari').val();
			var data = [id_kary, periode, kategori, cari];

			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/sistem/nilai/filter_nilai',
				data: {
					data: data
				},
				success: function(data) {
					$('.data-table').html(data);
					pagination();
				}
			});
		}

// Expands & Collapse Card Info
		$('.info_1:eq(0)').on('click', function() {
			if (info_1 == 0) {
				$('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
				info_1 = 1;
			} else {
				$('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
				info_1 = 0;
			}
		});
		$('.info_2:eq(0)').on('click', function() {
			if (info_2 == 0) {
				$('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
				info_2 = 1;
			} else {
				$('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
				info_2 = 0;
			}
		});

// Cek Kurva Normal
		function cek_kurva() {
			if ($('#kategori').val() == '') {
				tbl_set.rows[3].cells[0].innerHTML = 0;
				tbl_set.rows[3].cells[1].innerHTML = 0;
				tbl_set.rows[3].cells[3].innerHTML = 0;
				tbl_set.rows[3].cells[4].innerHTML = 0;
				tbl_set.rows[3].cells[2].innerHTML = 0;

				tbl_set.rows[4].cells[0].innerHTML = 0;
				tbl_set.rows[4].cells[1].innerHTML = 0;
				tbl_set.rows[4].cells[2].innerHTML = 0;
				tbl_set.rows[4].cells[3].innerHTML = 0;
				tbl_set.rows[4].cells[4].innerHTML = 0;
				return;
			}

			var qty_kary = tabel_input.rows().data().length;
			var BS = 0,
			B = 0,
			C = 0,
			K = 0,
			KS = 0;
			var kategori = '',
			kurva = 0;

			if (qty_kary == 0) {
				kurva = '1';
			}
			for (var i = 0; i < qty_kary; i++) {
				kategori = document.getElementsByName('kategori')[i].value;
				if (kategori == 'BS') {
					BS++;
				}
				if (kategori == 'B') {
					B++;
				}
				if (kategori == 'C') {
					C++;
				}
				if (kategori == 'K') {
					K++;
				}
				if (kategori == 'KS') {
					KS++;
				}
			}

	// Ketentuan Kurva
			n_BS = Math.round(10 / 100 * qty_kary);
			n_B = Math.round(20 / 100 * qty_kary);
			n_K = Math.round(20 / 100 * qty_kary);
			n_KS = Math.round(10 / 100 * qty_kary);

			if (qty_kary == 2) {
				n_B = 1;
				n_K = 1;
			}

			n_C = qty_kary - n_BS - n_B - n_K - n_KS;

			if (qty_kary == 1) {
				if (BS + B + C + K + KS == 1) {
					kurva = '1';
				}
			} else if (qty_kary <= 5) {
				if ((BS + B + C == C + K + KS) && (BS + B > 0) && (K + KS > 0)) {
					kurva = '1';
				}
			} else if (qty_kary <= 9) {
				if (((BS + B + C == C + K + KS) || (BS + B + C + 1 == C + K + KS) || (BS + B + C == C + K + KS + 1)) && BS > 0 && B > 0 && C > 0 && K > 0 && KS > 0) {
					kurva = '1';
				}
			} else if (qty_kary > 9) {
				if (BS >= n_BS && B >= n_B && C >= n_C && K >= n_K && KS >= n_KS) {
					kurva = '1';
				}
			} else {
				kurva = 0;
			};

			if (BS + B + C + K + KS == 0 || BS + B + C + K + KS != qty_kary) {
				kurva = '0';
			}

			if (kurva == 0) {
				$('#btn_kurva').addClass("btn-danger");
				$('#btn_kurva').removeClass("btn-success");
				$('#btn_kurva b').text("Kurva Salah");

				$('#tbl_set tr:eq(4)').removeClass("bg-success");
				$('#tbl_set tr:eq(4)').addClass("bg-danger");
			} else {
				$('#btn_kurva').removeClass("btn-danger");
				$('#btn_kurva').addClass("btn-success");
				$('#btn_kurva b').text('Kurva Benar');

				$('#tbl_set tr:eq(4)').removeClass("bg-danger");
				$('#tbl_set tr:eq(4)').addClass("bg-success");
			}

	// Isi Tbl Setting
			tbl_set.rows[0].cells[0].innerHTML = "Range Nilai (Qty Karyawan : " + qty_kary + ")";

			tbl_set.rows[3].cells[0].innerHTML = n_BS;
			tbl_set.rows[3].cells[1].innerHTML = n_B;
			tbl_set.rows[3].cells[3].innerHTML = n_K;
			tbl_set.rows[3].cells[4].innerHTML = n_KS;
			tbl_set.rows[3].cells[2].innerHTML = n_C;

			tbl_set.rows[4].cells[0].innerHTML = BS;
			tbl_set.rows[4].cells[1].innerHTML = B;
			tbl_set.rows[4].cells[2].innerHTML = C;
			tbl_set.rows[4].cells[3].innerHTML = K;
			tbl_set.rows[4].cells[4].innerHTML = KS;
		}

// Auto Kurva
		$('#btn_kurva').click(function() {
			if (tabel_nilai.rows.length == 1) {
				return;
			}

			$('#btnProgress').click();
			$('#tabel_nilai').DataTable().destroy();

			setTimeout(function() {
				$('#btnOk').click();
				pagination_input();
			}, 500);
		});

	</script>