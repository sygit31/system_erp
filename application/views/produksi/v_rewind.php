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
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} @media print { @page {size: landscape;} html, body {width: 320mm;height: 210mm;} #pr_body tbody td {height: 20px; vertical-align: middle; padding-right: 5px; padding-left: 5px;}}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div id="headerinput">Input Rewind PET</div></font></b></h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
					</button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
						<i class="fa fa-times"></i>
					</button>
				</div>
			</div>
			<div class="card card-body m-2">
				<div class="row">
					<div class="col-lg-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Nomor</th>
								<td width="60%">
									<input type="number" id="nmr" name="" class="form-control" value="000" maxlength="3" onfocusout="isi_nomor()" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Desain</th>
								<td>
									<select class="select" id="desain" name="" style="width: 100%;" onchange="auto_no(); isi_operator(); isi_kk()">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-1 days')) ?>" style="background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Shift</th>
								<td>
									<select class="select" id="shift" onchange="isi_operator()" style="width: 100%;">
										<option>A</option>
										<option>B</option>
										<option>C</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-lg-1"></div>
					<div class="col-lg-6">
						<table width="100%">
							<tr>
								<th width="40%">Proses</th>
								<td width="60%">
									<select class="select" id="proses" onchange="isi_operator(); isi_kode();" style="width: 100%;">
										<option>Rewind 1</option>
										<option>Rewind 2</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Operator</th>
								<td>
									<select class="form-control select" id="operator" multiple="multiple" style="width: 100%; cursor: pointer;">
										<?php foreach ($operator->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
										<?php } ?>
									</select>  
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor KK</th>
								<td>
									<select id="bahan" hidden>
										<option value="">Pilih..</option>
									</select>
									<select class="select" id="kk" onchange="isi_kode()" style="width: 100%; cursor: pointer;">
										<option value="">Pilih..</option>
									</select>  
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Seri</th>
								<td>
									<input type="text" id="seri" class="form-control" readonly>  
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card card-body m-2" style="font-weight: bold;">
				<div class="table-responsive">
					<button type="button" class="btn btn-info mb-2" style="width: 120px;" onclick="add_input()"><i class="fa fa-plus mr-2"></i><b>kode</b></button>
					<div style="width: 1200px;">
						<table id="tbl_input" class="table table-bordered" width="100%">
							<thead style="background-color: #3FB4F7; color: #fff;">
								<tr style="text-align: center;">
									<td width="7.5%">No.</td>
									<td width="25%">Kode</td>
									<td width="12.5%">Mulai</td>
									<td width="12.5%">Selesai</td>
									<td width="10%">Panjang</td>
									<td width="10%">Baik</td>
									<td width="10%">Reject</td>
									<td width="10%">Sisa</td>
									<td>Buang</td>
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
					<b>
						<font color="White">Laporan Rewind PET</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table style="width: 1050px; font-size: 13px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<th width="12.5%" class="filter">Desain</th>
										<td></td>
										<th width="20%" class="filter">KK</th>
										<td></td>
										<th width="15%" class="filter">Proses</th>
										<td></td>
										<th width="10%" class="filter">Seri</th>
										<td></td>
										<th width="17.5%" class="filter">Kode Roll</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_desain" onchange="isi_kk_f()" style="width: 100%; cursor: pointer;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>  
										</td>
										<td></td>
										<td>
											<div style="width: 210px;"><select class="select" id="f_kk" onchange="filter()" style="width: 100%; cursor: pointer;">
												<option value="All">All..</option>
											</select></div>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_proses" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach ($proses->result_array() as $dt) { ?>
													<option><?php echo $dt['PROSES']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_seri" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach ($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<div style="width: 180px;"><select class="select" id="f_kode" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>
												<?php foreach ($kode->result_array() as $dt) { ?>
													<option><?php echo $dt['KODE']; ?></option>
												<?php } ?>
											</select></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="table-responsive mt-3" style="font-size: 13px;">
							<table id="tbl" class="table table-bordered table-striped" width="100%">
								<thead>
									<tr style="text-align: center;">
										<th>No.</th>
										<th>Nomor</th>
										<th>Desain</th>
										<th>Tanggal</th>
										<th>Shift</th>
										<th>Proses</th>
										<th>KK</th>
										<th>Kode</th>
										<th>Mulai</th>
										<th>Selesai</th>
										<th>Panjang</th>
										<th>Hasil</th>
										<th>Reject</th>
										<th>Sisa</th>
										<th>Operator</th>
										<th>Cetak</th>
										<th>Edit</th>
										<th>Hapus</th>
									</tr>
								</thead>
								<tbody></tbody>
							</table>
						</div>

						<div class="card-footer">
							<button style="width: 150px;" type="button" class="btn btn-success" title="Export to Excel" onclick="(function(){ $('.excel').click(); })();"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
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

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
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

<div id="printable" style="display: none; overflow: hidden; font-size: 14px;">
	<div style="width: 200px;  margin-bottom: -5px;">
		<img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
	</div>

	<h5 align="center" style="margin-top: -1mm;">LAPORAN HARIAN MESIN SLITTER REWIND<br>PROSES REWIND 1 (Proses Rewind Sebelum Metalize)</h5>
	<table id="pr_head" width="100%" style="line-height: 4mm;">
		<tr>
			<td width="10%">Mesin / Shift</td>
			<td width="3%">:</td>
			<td width="55%"></td>
			<td width="10%">No</td>
			<td width="3%">:</td>
			<td width="19%"></td>
		</tr>
		<tr>
			<td>Seri / KK</td>
			<td>:</td>
			<td></td>
			<td>Tanggal</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td>Jenis Bahan</td>
			<td>:</td>
			<td></td>
			<td>Halaman</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td>Lebar / Gramature</td>
			<td>:</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
		</tr>
	</table>
	<table id="pr_body" class="table-bordered text-center mt-1" width="100%">
		<thead>
			<tr>
				<td width="5%" rowspan="2">NO</td>
				<td width="20%" colspan="2">BAHAN</td>
				<td width="35%" colspan="4">PROSES PRODUKSI (MTR)</td>
				<td width="15%" rowspan="2">JAM PROSES</td>
				<td rowspan="2">KETERANGAN PROSES</td>
			</tr>
			<tr>
				<td>KODE</td>
				<td>PANJANG</td>
				<td>HASIL</td>
				<td>MUTASI</td>
				<td>RUSAK</td>
				<td>SISA</td>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot>
			<tr class="text-center text-bold">
				<td colspan="2">Total</td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td colspan="3"></td>
			</tr>
		</tfoot>
	</table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-036 Rev. 00</div>
	<div class="input-group mt-1">
		<table id="pr_foot" class="table-bordered mt-1" width="35%">
			<tr align="center">
				<td>Operator</td>
				<td>Pengawas</td>
			</tr>
			<tr style="height: 20mm; vertical-align: bottom;">
				<td>
					<div style="height: 80px; vertical-align: bottom; ">
						<div class="opr pl-2" style="height: 60px;"></div>
						<div align="center" style="height: 10px;">( ...................... ) </div>
					</div>
				</td>
				<td>
					<div style="height: 80px; vertical-align: bottom; ">
						<div style="height: 60px;"></div>
						<div align="center" style="height: 10px;">( ...... KARTIKO ..... ) </div>
					</div>
				</td>
			</tr>
		</table>
		<table width="20%"></table>
		<table class="table-borderless ml-2" width="40%">
			<tr>
				<td colspan="2"><u>Kategori Jam Berhenti :</u></td>
			</tr>
			<tr>
				<td>A = Persiapan Mesin</td>
				<td>E = Tunggu Core</td>
			</tr>
			<tr>
				<td>B = Trouble Proses Produksi</td>
				<td>F = Ganti Silinder/ Seri</td>
			</tr>
			<tr>
				<td>C = Trouble Mesin</td>
				<td>G = Force Major/ Special Case</td>
			</tr>
			<tr>
				<td>D = Tunggu Bahan/ Medium</td>
				<td>H = Lain-Lain</td>
			</tr>
		</table>
	</div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Import Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Defined Variable
	var dt_kk = <?php echo json_encode($kk->result_array()); ?>;

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy', changeMonth: true});

		auto_no();
		isi_operator();
		isi_kk();
		isi_kk_f();
		filter();
	});

// Auto Nomor
	function auto_no() {
		var id_edit = $('#desain').attr('name');
		var desain = $('#desain').val();
		var data = [id_edit, desain];

		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/produksi/Rewind/auto_no',
			success: function(data) {
				data = JSON.parse(data);
				$('#nmr').val(data);
			}
		});
	}

// Isi Format Nomor 3 angka
	function isi_nomor() {
		var nmr = $('#nmr').val();
		var nmr = nmr.toString().padStart(3, "0");
		var nmr = nmr.substring(0,3);

		$('#nmr').val(nmr);
	}

// Isi Operator
	function isi_operator() {
		var desain = $('#desain').val();
		var shift = $('#shift').val();
		var proses = $('#proses').val();
		var data = [desain, shift, proses];

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/Rewind/isi_operator',
			data: {data: data},
			success: function(data) {

				data = JSON.parse(data).ID;
				id = data == null ? '' : data.substr(0, data.length-1).split(',');
				$('#operator').val(id).change();
			}
		});
	}

// Isi KK
	function isi_kk() {
		var desain = $('#desain').val();

		$('#kk option:gt(0)').remove();
		for (var i=0; i<dt_kk.length; i++) {
			if (desain == dt_kk[i].DESAIN) {
				$('#kk').append('<option value="'+dt_kk[i].ID+'">'+dt_kk[i].KK+'</option>');
			}
		}
		$('#kk').change();
	}

// Isi KK Filter
	function isi_kk_f() {
		var desain = $('#f_desain').val();

		$('#f_kk option:gt(0)').remove();
		for (var i=0; i<dt_kk.length; i++) {
			if (desain == dt_kk[i].DESAIN) {
				$('#f_kk').append('<option value="'+dt_kk[i].ID+'">'+dt_kk[i].KK+'</option>');
			}
		}
		$('#f_kk').change();
	}

// Filter Data Rewind
	function filter() {
		var tgl1 = $('#f_tgl1').val();
		var tgl2 = $('#f_tgl2').val();
		var desain = $('#f_desain').val();
		var kk = $('#f_kk').val();
		var proses = $('#f_proses').val();
		var seri = $('#f_seri').val();
		var kode = $('#f_kode').val();
		var data = [tgl1, tgl2, desain, kk, proses, seri, kode];

		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/produksi/Rewind/filter',
				data: {data: data},
				success: function(data) {
					data = JSON.parse(data);

					for (var i=0; i<data.length; i++) {
						urut = i+1;
						id = data[i].ID;
						nmr = data[i].NMR;
						desain = data[i].DESAIN;
						tgl = data[i].TGL;
						shift = data[i].SHIFT;
						proses = data[i].PROSES;
						kk = data[i].KK + ' (' + data[i].SERI + ')';
						kode = data[i].KODE;
						mulai = data[i].MULAI;
						selesai = data[i].SELESAI;
						panjang = angka(data[i].PANJANG);
						hasil = angka(data[i].HASIL);
						reject = angka(data[i].REJECT);
						sisa = angka(data[i].SISA);
						operator = proper(data[i].OPERATOR).substr(0, data[i].OPERATOR.length-2);
						qty_next = data[i].QTY_NEXT;

						$('#tbl tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+nmr+'</td><td align="center">'+desain+'</td><td align="center">'+format_date(tgl)+'</td><td align="center">'+shift+'</td><td align="center">'+proses+'</td><td align="center">'+kk+'</td><td align="center">'+kode+'</td><td align="center">'+mulai+'</td><td align="center">'+selesai+'</td><td align="center">'+format_number(panjang)+'</td><td align="center">'+format_number(hasil)+'</td><td align="center">'+format_number(reject)+'</td><td align="center">'+format_number(sisa)+'</td><td>'+operator+'</td><td align="center"><button type="button" class="btn btn-block btn-info btn-sm" name="'+id+'" style="width: 50px;" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" name="'+id+'" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" name="'+id+'" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></tr>');

						if (qty_next != 0) {$('#tbl tbody tr:eq('+i+') .btn:gt(0)').hide();}
					}

					setTimeout(function() {$('#btnOk').click();}, 500);
					pagination();
				}
			});
		}, 500);
	}

// Pagination
	function pagination() {
		$('#tbl').DataTable().destroy();
		var datatable = $('#tbl').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [0, "asc"],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				title: 'Laporan Data Rewind PET'
			}],
			"colReorder": true
		});
	}

// Isi Kode Bahan
	function isi_kode() {
		var proses = $('#proses').val();
		var id_gudang_order = $('#kk').val();
		var data = [proses, id_gudang_order];

		$("#tbl_input").find("tr:gt(0)").remove();
		$('#bahan option:gt(0)').remove();

		if (id_gudang_order == '') {return;}
		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/Rewind/isi_kode',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);
				dt_roll = data[0];
				seri = data[1];

				$('#seri').val(seri.SERI);
				for (var i=0; i<dt_roll.length; i++) {
					$('#bahan').append('<option value="'+(dt_roll[i].KODE+'@'+dt_roll[i].QTY)+'">'+dt_roll[i].KODE+'</option>');
				}
			}
		});
	}

// Tambah Bahan di KK
	function add_input() {
		var opt_bahan = $("#bahan").html();
		var qty_input = $('#tbl_input tr').length-1;

		$('#tbl_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><div style="width: 280px;"><select class="form-control select" style="width: 100%;" name="kode" onchange="isi_panjang(this)"></select></div></td>' +
			'<td><input type="time" class="form-control" name="mulai" value="07:00" placeholder="Isikan jam.." style="text-align: center;"></td>' +
			'<td><input type="time" class="form-control" name="selesai" value="07:00" placeholder="Isikan jam.." style="text-align: center;"></td>' +
			'<td><input type="text" class="form-control" name="panjang" style="text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control num" name="baik" onchange="isi_sisa(this)" style="text-align: center;" autocomplete="off"></td>' +
			'<td><input type="text" class="form-control num" name="reject" onchange="isi_sisa(this)" style="text-align: center;" autocomplete="off"></td>' +
			'<td><input type="text" class="form-control" name="sisa" value="0" style="text-align: center;" readonly></td>' +
			'<td style="width: 75px;"><button type="button" class="btn btn-block btn-danger" title="Hapus Bahan" onclick="hapus_bahan(this)" style="margin-top: 0; width: 50px;"><i class="fa ion-trash-a"></button></td>' +
			'</tr>');

		$('[name="kode"]:eq('+qty_input+')').html(opt_bahan);
		$(".select").select2();

		urut_bahan();
		onlynumeric();
	}

// Isi Panjang Bahan
	function isi_panjang(btn) {
		var tbl_input = document.getElementById('tbl_input');
		var row = $(btn).closest("tr").index();
		var panjang = $('[name="kode"]:eq('+row+')').val().split('@')[1];

		$('[name="panjang"]:eq('+row+')').val(format_number(panjang)).change();
		$('[name="baik"]:eq('+row+')').val(format_number(panjang)).change();
	}

// Isi Sisa Bahan
	function isi_sisa(btn) {
		var tbl_input = document.getElementById('tbl_input');
		var row = $(btn).closest("tr").index();
		var panjang = angka($('[name="panjang"]:eq('+row+')').val());
		var baik = angka($('[name="baik"]:eq('+row+')').val());
		var reject = angka($('[name="reject"]:eq('+row+')').val());
		var sisa = panjang - baik - reject;

		$('[name="sisa"]:eq('+row+')').val(format_number(sisa)).change();
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
		$('#kk').val('').change();
		$('#seri').val('').change();
		auto_no();
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#desain').attr('name','');
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var tbl_input = document.getElementById('tbl_input');
		var id_edit = $('#desain').attr('name');
		var nmr = $('#nmr').val();
		var desain = $('#desain').val();
		var tgl = $('#tgl').val();
		var shift = $('#shift').val();
		var proses = $('#proses').val();
		var operator = $('#operator').val();
		var id_gudang_order = $('#kk').val();
		var kode = [], mulai = [], selesai = [], panjang = [], baik = [], reject = [], sisa = [];

		if (operator == null) {error_isian('Nama Operator belum diisi..');}
		if (id_gudang_order == '') {error_isian('Nomor KK belum diisi..');}
		if (tbl_input.rows.length == 1) {error_isian('Belum ada Kode Roll yang dipilih..');}

		for (var i=0; i<tbl_input.rows.length-1; i++) {
			t_kode = document.getElementsByName('kode')[i].value.split('@')[0];
			t_mulai = document.getElementsByName('mulai')[i].value;
			t_selesai = document.getElementsByName('selesai')[i].value;
			t_panjang = angka(document.getElementsByName('panjang')[i].value);
			t_baik = angka(document.getElementsByName('baik')[i].value);
			t_reject = angka(document.getElementsByName('reject')[i].value);
			t_sisa = angka(document.getElementsByName('sisa')[i].value);

			if (t_kode == '' || t_mulai == '' || t_selesai == '' || t_selesai == '' || t_panjang == '' || t_baik == '') {error_isian('Isian Kode Roll belum lengkap..');}
			if (t_sisa < 0) {error_isian('Sisa Roll salah..');}
			if (t_baik+t_reject > t_panjang) {error_isian('Panjang Roll salah..');}

			start = cek_jam(tgl, t_mulai);
			end = cek_jam(tgl, t_selesai);
			if (start >= end) {error_isian('Waktu mulai tidak boleh sama/ melebihi selesai..');}

			kode.push(t_kode);
			mulai.push(t_mulai);
			selesai.push(t_selesai);
			panjang.push(t_panjang);
			baik.push(t_baik);
			reject.push(t_reject);
			sisa.push(t_sisa);

			for (var j=0; j<tbl_input.rows.length-1; j++) {
				if ($('[name="kode"]:eq('+i+')').val() == $('[name="kode"]:eq('+j+')').val() && j != i) {
					error_isian('Kode Bahan tidak boleh ganda..');
				}
			}
		}

		var bahan = [kode, mulai, selesai, panjang, baik, reject, sisa];
		var data = [id_edit, desain, tgl, shift, proses, operator, id_gudang_order, bahan, nmr];

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/Rewind/simpan',
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

// Cek Format Tanggal dan Jam
	function cek_jam(tanggal, jam) {
		var year = tanggal.substring(9, 11);
		var date = tanggal.substring(0, 2);
		var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
		var month = dt_month.indexOf(tanggal.substring(3, 6)) + 1;
		month = ("0" + month).slice(-2);

		var hour = jam.substring(0, 2);
		var minute = jam.substring(3, 5);

		if (Number(hour) + minute < 630) {
			date++;
		}

		return year + month + date + hour + minute;
	}

// Cetak Data
	function cetak(btn) {
		var id_cetak = $(btn)[0].name;
		var panjang = 0, hasil = 0, reject = 0;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/Rewind/cetak',
			data: {data: id_cetak},
			success: function(data) {
				data = JSON.parse(data);
				dt_rewind = data[0];
				dt_opt = data[1];
				dt_downtime = data[2];

				proses = dt_rewind[0].PROSES.toUpperCase() == 'REWIND 1' ? 'PROSES REWIND 1 (Proses Rewind Sebelum Metalize)' : 'PROSES REWIND 2 (Proses Rewind Setelah Metalize)';
				seri = dt_rewind[0].SERI == 'MMEA' ?' MMEA' : dt_rewind[0].SERI.split(' ')[1];
				tgl = format_date(dt_rewind[0].TGL);
				bln = get_romawi(tgl);

				$('h5:eq(0)').html('LAPORAN HARIAN MESIN SLITTER REWIND<br>' + proses);
				$('#pr_head tr:eq(0) td:eq(2)').html(dt_rewind[0].PROSES + ' / ' + dt_rewind[0].SHIFT);
				$('#pr_head tr:eq(1) td:eq(2)').html(seri + ' / ' + dt_rewind[0].KK.substr(0, 3));
				$('#pr_head tr:eq(2) td:eq(2)').html(dt_rewind[0].NAMA);
				$('#pr_head tr:eq(3) td:eq(2)').html(dt_rewind[0].UKURAN + ' / 12 micron');

				$('#pr_head tr:eq(0) td:eq(5)').html(dt_rewind[0].NMR + '/PNP-HLG/SLT/' + bln + '/' + dt_rewind[0].DESAIN);
				$('#pr_head tr:eq(1) td:eq(5)').html(tgl);
				$('#pr_head tr:eq(2) td:eq(5)').html('1 dari 1');

				$('#pr_body tbody tr').remove();
				for (var i=0; i<dt_rewind.length; i++) {
					jam = dt_rewind[i].MULAI + ' - ' + dt_rewind[i].SELESAI;
					keterangan = dt_rewind[i].KETERANGAN == null ? '' : dt_rewind[i].KETERANGAN;
					panjang = panjang + Number(dt_rewind[i].PANJANG);
					hasil = hasil + Number(dt_rewind[i].HASIL);
					reject = reject + Number(dt_rewind[i].REJECT);

					$('#pr_body tbody').append('<tr><td>'+(i+1)+'</td><td>'+dt_rewind[i].KODE.split('-')[0]+'</td><td>'+format_number(dt_rewind[i].PANJANG)+'</td><td>'+format_number(dt_rewind[i].HASIL)+'</td><td>'+format_number(dt_rewind[i].HASIL)+'</td><td>'+format_number(dt_rewind[i].REJECT)+'</td><td>'+format_number(dt_rewind[i].SISA)+'</td><td>'+jam+'</td><td align="left">'+keterangan+'</td></tr>');
				}
				$('#pr_body tfoot td:eq(1)').html(format_number(panjang));
				$('#pr_body tfoot td:eq(2)').html(format_number(hasil));
				$('#pr_body tfoot td:eq(3)').html(format_number(hasil));
				$('#pr_body tfoot td:eq(4)').html(format_number(reject));

				// Isi Nama Operator
				var dt_operator = dt_opt.OPERATOR.split(','), sh = '';
				for (var i=0; i<dt_operator.length; i++) {
					sh = sh + (i+1) + '. ' + dt_operator[i] + '<br><br>';
				}
				$('.opr:eq(0)').html(sh);

				// Isi Downtime
				var downtime = '';
				for (var i=0; i<dt_downtime.length; i++) {
					downtime = downtime + dt_downtime[i].DOWNTIME + '<br>';
				}
				$('#pr_body tbody tr:eq(0) td:eq(8)').html(downtime);

				// Print Area Table
				var printable = document.getElementById('printable');
				var non_printable = document.getElementById('non_printable');

				printable.style.display = "";
				non_printable.style.display = "none";
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

// Edit Data
	function edit(btn) {
		var id_edit = $(btn)[0].name;

		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/produksi/Rewind/edit',
				data: {data: id_edit},
				success: function(data) {
					data = JSON.parse(data);

					desain = data[0].DESAIN;
					tgl = format_date(data[0].TGL);
					shift = data[0].SHIFT;
					proses = data[0].PROSES;
					id_gudang_order = data[0].ID_GUDANG_ORDER;
					id_operator = data == null ? '' : data[0].ID_OPERATOR.substr(0, data[0].ID_OPERATOR.length-1).split(',');

					$('#desain').attr('name', id_edit);
					$('#desain').val(desain).change();
					$('#tgl').val(tgl).change();
					$('#shift').val(shift).change();
					$('#proses').val(proses).change();
					$('#kk').val(id_gudang_order).change();
					$('#operator').val(id_operator).change();

					isi_kode();
					opt_bahan = $("#bahan").html();
					for (var i=0; i<data.length; i++) {
						kode = data[i].KODE;
						mulai = data[i].MULAI;
						selesai = data[i].SELESAI;
						panjang = format_number(data[i].PANJANG);
						hasil = format_number(data[i].HASIL);
						reject = format_number(data[i].REJECT);

						add_input();
						$('[name="kode"]:eq('+i+')').html(opt_bahan);
						$('[name="kode"]:eq('+i+')').append('<option value="'+kode+'@'+panjang+'">'+kode+'</option>');
						$('[name="kode"]:eq('+i+')').val(kode+'@'+panjang).change();
						$('[name="mulai"]:eq('+i+')').val(mulai).change();
						$('[name="selesai"]:eq('+i+')').val(selesai).change();
						$('[name="panjang"]:eq('+i+')').val(panjang).change();
						$('[name="baik"]:eq('+i+')').val(hasil).change();
						$('[name="reject"]:eq('+i+')').val(reject).change();
					}

					setTimeout(function() {$('#btnOk').click();}, 500);
				}
			});
		}, 500);

		$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 500);
	}

// Notifikasi Hapus Data
	function hapus(btn) {
		var id_hapus = $(btn)[0].name;

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/produksi/Rewind/hapus',
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

</script>