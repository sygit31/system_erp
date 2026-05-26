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
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} @media print { @page {size: landscape;} html, body {width: 330mm;height: 210mm;} #pr_body tbody td {height: 20px; vertical-align: middle; padding-right: 5px;}}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info" <?php if ($menu == 'app') {echo 'hidden';} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Input Pemakaian Foil Stamping</div></font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i>
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
								<th width="40%">Desain</th>
								<td>
									<select class="select" id="desain" name="" onchange="isi_kode_foil(); isi_kode_kertas();" style="width: 100%;">
										<?php foreach($dt_desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<table width="100%">
							<tr>
								<th width="40%">Seri</th>
								<td>
									<select class="select" id="seri" onchange="isi_kode_foil(); isi_kode_kertas()" style="width: 100%;">
										<?php foreach($dt_seri->result_array() as $dt) { ?>
											<option selected><?php echo $dt['SERI']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Delivery</th>
								<td>
									<input type="text" id="delivery" class="form-control datepicker" value="<?php echo date('t-M-Y') ?>" style="width: 100%; background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Pengawas Stamping</th>
								<td>
									<select class="select" id="stamping" style="width: 100%;">
										<option value="">Pilih..</option>		
										<?php foreach($dt_pengawas->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body" style="font-weight: bold;">
				<div class="card card-body">
					<div class="table-responsive">
						<div style="width: 1900px;">
							<div class="row">
								<div class="col-md-9">
									<button type="button" class="btn btn-block" id="btn_add" style="width:130px; margin-bottom: 10px; color: #FFFFFF; font-size: 16px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Roll</b></button>
								</div>
								<div class="col-md-1">
									<font>Filter Mesin</font>
								</div>
								<div class="col-md-1">
									<select class="select" id="mesin" onchange="filter_input()" style="width: 200px;">
										<option value="">All..</option>	
										<option>Stamping 1</option>	
										<option>Stamping 2</option>	
										<option>Stamping 3</option>	
										<option>Stamping 4</option>	
										<option>Stamping 5</option>	
									</select>
								</div>
							</div>

							<select id="dt_roll_kertas" hidden><option value="">Pilih..</option></select>
							<select id="dt_roll_foil" hidden><option value="">Pilih..</option></select>

							<table id="tabel_input" class="table table-bordered">
								<thead style="background-color: #3FB4F7; text-align: center; color: #FFFFFF;">
									<tr style="">
										<th>No.</th>
										<th>Shift</th>
										<th width="9%">Nomor Mesin</th>
										<th>Nomor PP</th>
										<th>Kode Kertas</th>
										<th>Panjang Kertas (Mtr)</th>
										<th>Kode Foil</th>
										<th>Panjang Foil (Mtr)</th>
										<th>Qty Roll</th>
										<th>Total (Mtr)</th>
										<th>Hasil Baik (Mtr)</th>
										<th>Waste (Mtr)</th>
										<th>Sisa (Mtr)</th>
										<th>Keterangan</th>
										<th>Buang</th>
									</tr>
								</thead>
								<tbody></tbody>
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

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White" id="headerinput">Laporan Pemakaian Foil Stamping</font></b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive m-2 pb-2" style="font-size: 13px; overflow-y: hidden;">
							<table style="width: 1350px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<th width="9%" class="filter">Desain</th>
										<td></td>
										<th width="9%" class="filter">Nomor KK</th>
										<td></td>
										<th width="9%" class="filter">Nomor PP</th>
										<td></td>
										<th width="9%" class="filter">Seri</th>
										<td></td>
										<th width="9%" class="filter">Shift</th>
										<td></td>
										<th width="10%" class="filter">Mesin</th>
										<td></td>
										<th width="12%" class="filter">Pengawas</th>
										<td></td>
										<th width="14%" class="filter">Kode Roll</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
												<?php foreach($dt_desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKk" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_kk->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo explode('/', $dt['KETERANGAN_PENGGUNAAN'])[0]; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fPp" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_pp->result_array() as $dt) { ?>
													<option><?php echo $dt['NMR_PP']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fSeri" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fShift" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<option>A</option>		
												<option>B</option>		
												<option>C</option>	
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fMesin" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>	
												<option>Stamping 1</option>	
												<option>Stamping 2</option>	
												<option>Stamping 3</option>	
												<option>Stamping 4</option>	
												<option>Stamping 5</option>	
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fPengawas" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_pengawas->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="fKode" onchange="filter()" class="form-control" style="width: 100%;" placeholder="Cari kode roll.." autocomplete="off">
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="datatable" style="width: 2000px;">
								<table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
									<thead>
										<tr align="center">
											<th>No.</th>
											<th>Desain</th>
											<th>Tanggal</th>
											<th>Delivery</th>
											<th>Seri</th>
											<th>Shift</th>
											<th>Nomor Mesin</th>
											<th>Nomor PP</th>
											<th>Kode Kertas</th>
											<th width="6%">Panjang Kertas (Mtr)</th>
											<th>Nomor KK</th>
											<th>Kode Foil</th>
											<th width="6%">Panjang Foil (Mtr)</th>
											<th>Qty Roll</th>
											<th>Total (Mtr)</th>
											<th>Hasil Baik (Mtr)</th>
											<th>Waste (Mtr)</th>
											<th>Sisa (Mtr)</th>
											<th>Nama Pengawas</th>
											<th>Keterangan</th>
											<th>Print</th>
											<th>Edit</th>
											<th>Hapus</th>
										</tr>
									</thead>
									<tbody></tbody>
									<tfoot>
										<td colspan="9" align="center"><b>Total</b></td>
										<td align="right" class="font-weight-bold"></td>
										<td colspan="3"></td>
										<td align="right" class="font-weight-bold"></td>
										<td></td>
										<td align="right" class="font-weight-bold"></td>
										<td align="right" class="font-weight-bold"></td>
										<td colspan="6"></td>
									</tfoot>
								</table>
							</div>
						</div>
					</div>

					<div class="col-2 m-4">
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
<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 12px;">
	<div style="width: 200px;  margin-bottom: -5px;">
		<img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
	</div>
	<h4 align="center" style="margin-top: -1mm;">LAPORAN PEMAKAIAN FOIL BAGIAN STAMPING</h4>
	<table id="pr_head" width="100%" style="line-height: 4mm;">
		<tr>
			<td width="10%">Tanggal</td>
			<td width="3%">:</td>
			<td width="55%"></td>
			<td width="10%">Desain</td>
			<td width="3%">:</td>
			<td width="19%"></td>
		</tr>
		<tr>
			<td>Seri</td>
			<td>:</td>
			<td></td>
			<td>Delivery</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>
	<table id="pr_body" class="table-bordered text-center mt-1" width="100%">
		<thead>
			<tr>
				<td width="7%" rowspan="3">PP</td>
				<td width="5%" rowspan="3">SHIFT</td>
				<td width="9%" rowspan="3">MESIN</td>
				<td width="15%" colspan="2">HASIL STAMPING<br>(KERTAS)</td>
				<td colspan="7">PROSES APLIKASI STAMPING</td>
			</tr>
			<tr>
				<td rowspan="2">KODE ROLL</td>
				<td rowspan="2">PANJANG<br>(MTR)</td>
				<td colspan="4">BAHAN FOIL</td>
				<td colspan="3">FOIL PELEKATAN STAMPING</td>
			</tr>
			<tr>
				<td>KODE ROLL</td>
				<td>PANJANG (MTR)</td>
				<td>JUMLAH ROLL</td>
				<td>TOTAL (MTR)</td>
				<td>HASIL BAIK<br>STP (MTR)</td>
				<td>WASTE STP (MTR)</td>
				<td>SISA BAIK (MTR)</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-025 Rev. 00</div>
	<div class="input-group mt-1">
		<table id="pr_foot" class="table-borderless mt-1" width="100%">
			<tr>
				<td width="40%">Hormat Kami,</td>
				<td width="30%"></td>
				<td width="30%">Mengetahui,</td>
			</tr>
			<tr>
				<td>Adm Slitter-Stamping</td>
				<td>Pengawas Stamping</td>
				<td>Kabid Monitoring  Produksi</td>
			</tr>
			<tr style="height: 20mm; vertical-align: bottom;">
				<td> ( .... <b>Afrida N.A</b> .... ) </td>
				<td> ( ... KUSWANDI ATAU SHOLIKUL HADI ... ) </td>
				<td> ( ....... <b>Indah Oct.</b> ....... ) </td>
			</tr>
		</table>
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
	var t_isi_foil = 1;

// Load Dokumen
	$(document).ready(function() {
		$('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		isi_kode_foil();
		isi_kode_kertas();
		filter();

		setTimeout(function() {$('#btn_add').click();}, 500);
	});

// Isi Format Nomor 5 angka
	function isi_nomor(btn) {
		var nmr = $(btn).val();
		var nmr = nmr.toString().padStart(3, "0");

		$(btn).val(nmr);
	}

// Isi Kode Roll Kertas
	function isi_kode_kertas() {
		var desain = $('#desain').val();
		var seri = $('#seri').val();
		var data = [desain, seri];

		$("#tabel_input").find("tr:gt(0)").remove();
		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/produksi/Foil_stamping/isi_kode_kertas',
			success: function(data) {
				data = JSON.parse(data);

				$('#dt_roll_kertas option:gt(0)').remove();
				for (var i=0; i<data.length; i++) {
					$('#dt_roll_kertas').append('<option value="'+ data[i].NO_ROLL + '@' + data[i].PANJANG +'">'+ data[i].NO_ROLL +'</option>');
				}
			}
		});
	}

// Isi Kode Roll Foil
	function isi_kode_foil() {
		var desain = $('#desain').val();
		var seri = $('#seri').val();
		var data = [desain, seri];

		$("#tabel_input").find("tr:gt(0)").remove();
		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/produksi/Foil_stamping/isi_kode_foil',
			success: function(data) {
				data = JSON.parse(data);

				$('#dt_roll_foil option:gt(0)').remove();
				for (var i=0; i<data.length; i++) {
					$('#dt_roll_foil').append('<option value="'+ data[i].ID + '@' + data[i].ID_GUDANG_ORDER + '@' + data[i].KODE + '@' + data[i].KODE_ASAL +'">'+ data[i].KODE +'</option>');
				}
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
				filename: 'Laporan Pemakaian Foil Bagian Stamping',
				title: ''
			}],
			"colReorder": true,
			"columnDefs": [{"orderable": false, "targets": "_all"}],
			"order": []
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 500);
	}

// Filter Data
	function filter() {
		var tgl1 = $('#fTgl1').val();
		var tgl2 = $('#fTgl2').val();
		var desain = $('#fDesain').val();
		var kk = $('#fKk').val();
		var pp = $('#fPp').val();
		var seri = $('#fSeri').val();
		var shift = $('#fShift').val();
		var pengawas = $('#fPengawas').val();
		var mesin = $('#fMesin').val();
		var kode = $('#fKode').val();
		var menu = <?php echo json_encode($menu); ?>;
		var data = [tgl1, tgl2, desain, kk, pp, seri, shift, pengawas, mesin, kode];

		$('#tbl').DataTable().destroy();
		$('#tbl tbody tr').remove();
		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/Foil_stamping/filter" ?>',
			success: function(data) {
				data = JSON.parse(data);

				urut = '', no_urut = 0, t_foil = 0, add_kertas = true, t_panjang_kertas = 0, t_baik = 0, t_waste = 0;
				for (var i=0; i<data.length; i++) {
					seri = data[i].SERI.split(' ')[1] == undefined ? data[i].SERI : data[i].SERI.split(' ')[1];
					panjang = Number(data[i].PANJANG.replace(',', '.'));
					total = (panjang * data[i].QTY_ROLL).toFixed(0);
					kk = data[i].KK.split('/')[0];
					t_baik = t_baik + angka(data[i].HASIL);
					t_waste = t_waste + angka(data[i].WASTE);
					t_foil = t_foil + angka(data[i].QTY_ROLL);
					keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;

					for (var j=0; j<i; j++) {
						if (data[j].KODE_KERTAS != data[i].KODE_KERTAS) {
							add_kertas = true;
						}else{
							add_kertas = false;							
						}
					}
					if (add_kertas == true) {
						t_panjang_kertas = t_panjang_kertas + angka(data[i].PANJANG_KERTAS);
						no_urut++;
						urut = no_urut;
						desain = data[i].DESAIN;
						tgl = format_date(data[i].TGL);
						delivery = format_date(data[i].DELIVERY);
						shift = data[i].SHIFT;
						mesin = data[i].MESIN;
						nmr_pp = data[i].NMR_PP;
						kode_kertas = data[i].KODE_KERTAS;
						panjang_kertas = format_number(data[i].PANJANG_KERTAS);
					}else{
						urut = '', desain = '', tgl = '', delivery = '', seri = '', shift = '', mesin = '', nmr_pp = '', kode_kertas = '', panjang_kertas = '';
					}

					edit_mutasi = data[i].ID_DETAIL < data[i].EDIT_MUTASI ? 'hidden' : '';
					$('#tbl tbody').append('<tr><td align="center">'+urut+'</td><td align="center">'+desain+'</td><td align="center">'+tgl+'</td><td align="center">'+delivery+'</td><td align="center">'+seri+'</td><td align="center">'+shift+'</td>' +
						'<td align="center">'+mesin+'</td><td align="center">'+nmr_pp+'</td><td align="center">'+kode_kertas+'</td><td align="right">'+panjang_kertas+'</td><td align="center">'+kk+'</td><td align="center">'+data[i].KODE_FOIL+'</td><td align="right">'+format_number(panjang)+'</td><td align="center">'+data[i].QTY_ROLL+'</td><td align="right">'+format_number(total)+'</td><td align="right">'+format_number(data[i].HASIL)+'</td><td align="right">'+format_number(data[i].WASTE)+'</td><td align="right">'+format_number(data[i].SISA)+'</td><td>'+proper(data[i].PENGAWAS)+'</td><td>'+keterangan+'</td>' +'<td align="center"><button type="button" class="btn btn-block btn-info btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>' +
						'<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Edit Data" onclick="edit(this)" '+edit_mutasi+'><i class="fa fa-check-square-o"></i></button></td>' +
						'<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" name="'+data[i].ID_DETAIL+'" style="width: 50px;" title="Hapus Data" onclick="batal(this)"><i class="fa ion-trash-a"></i></button></td></tr>');
				}
				$('#tbl tfoot td:eq(1)').html(format_number(t_panjang_kertas));
				$('#tbl tfoot td:eq(3)').html(format_number(t_foil));
				$('#tbl tfoot td:eq(5)').html(format_number(t_baik));
				$('#tbl tfoot td:eq(6)').html(format_number(t_waste));

				setTimeout(function() {$('#btnOk').click(); pagination(); }, 500);
			}
		}); 
	}

// Tambah Barang
	$('#btn_add').click(function() {
		var tabel_input = document.getElementById('tabel_input');
		var qty_input = tabel_input.rows.length - 1;
		var option = document.createElement('option');
		var mesin = $('#mesin').val();

		$('#tabel_input tbody').append(
			'<tr name="">' +
			'<td><input type="text" class="form-control" name="nmr" style="text-align:center;" readonly></td>' +
			'<td><select class="form-control select" name="shift" style="width: 100%;">' +
			'<option value="">Pilih..</option>' +
			'<option>A</option><option>B</option><option>C</option>' +
			'</select></td>' +
			'<td><select class="form-control select" name="mesin" style="width: 100%;">' +
			'<option value="">Pilih..</option>' +
			'<option>Stamping 1</option><option>Stamping 2</option><option>Stamping 3</option><option>Stamping 4</option><option>Stamping 5</option>' +
			'</select></td>' +
			'<td><input type="text" class="form-control num" name="nmr_pp" onfocusout="isi_nomor(this)" style="text-align: center;" autocomplete="off" maxlength="3"></td>' +
			'<td><div style="width: 150px;"><select name="kode_kertas" class="form-control select" onchange="isi_kertas(this)" style="width: 100%;">' +
			'</select></div></td>' +
			'<td align="center"><input type="text" class="form-control" name="panjang_kertas" style="text-align: center;" readonly></td>' +
			'<td><div style="width: 240px;"><select name="kode_foil" class="form-control select" onchange="isi_foil(this)" style="width: 100%;">' +
			'</select></div></td>' +
			'<td align="center"><input type="text" class="form-control" name="panjang_foil" style="text-align: center;" readonly></td>' +
			'<td align="center"><input type="text" class="form-control num" name="qty_roll" onchange="isi_total()" style="text-align: center;" autocomplete="off"></td>' +
			'<td align="center"><input type="text" class="form-control" name="total_foil" style="text-align: center;" readonly></td>' +
			'<td align="center"><input type="text" class="form-control num" name="hasil" onchange="isi_sisa()" style="text-align: center;" autocomplete="off"></td>' +
			'<td align="center"><input type="text" class="form-control num" name="waste" onchange="isi_sisa()" style="text-align: center;" autocomplete="off"></td>' +
			'<td align="center"><input type="text" class="form-control" name="sisa" style="text-align: center;" readonly></td>' +
			'<td><textarea class="form-control" rows="2" name="keterangan" style="width: 100%; font-size: 14px;" maxlength="50" autocomplete="off"></textarea></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Downtime" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		$('[name=mesin]:eq('+qty_input+')').val(mesin).change();
		$('[name=kode_foil]:eq('+qty_input+')').html($('#dt_roll_foil').html());
		$('[name=kode_kertas]:eq('+qty_input+')').html($('#dt_roll_kertas').html());

		$(".select").select2();
		filter_input();
		onlynumeric();
	});	

// Filter Input Mesin
	function filter_input() {
		var qty_input = $('#tabel_input tbody tr').length;
		var mesin = $('#mesin').val();
		var urut = 0;

		for (var i=0; i<qty_input; i++) {
			t_mesin = $('[name=mesin]:eq('+i+')').val();

			if (mesin != t_mesin && mesin != '') {
				$('#tabel_input tbody tr:eq('+i+')').hide();
			}else{
				urut++;
				$('#tabel_input tbody tr:eq('+i+')').show();
				$('[name=nmr]:eq('+i+')').val(urut);
			}
		}
	}

// Isi Data Kode Roll
	function isi_foil(btn) {
		var row = $(btn).closest("tr").index();
		var id_mutasi = $(btn).val() == '' ? '' : $(btn).val().split('@')[0];
		var kode_asal = $(btn).val() == '' ? '' : $(btn).val().split('@')[3].split('__')[0];
		var id_asal = $(btn).val() == '' ? '' : $(btn).val().split('@')[3].split('__')[1];
		var id_detail = $('#tabel_input tbody tr:eq('+row+')').attr('name');
		var data = [id_mutasi, id_detail, kode_asal, id_asal];

		if ($(btn).val() == '') {
			$('[name="panjang_foil"]:eq('+row+')').val('');
			$('[name="qty_roll"]:eq('+row+')').val('');
			$('[name="total_foil"]:eq('+row+')').val('');
			$('[name="sisa"]:eq('+row+')').val('');
			return;
		}
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/Foil_stamping/isi_foil" ?>',
			success: function(data) {
				data = JSON.parse(data);

				if (t_isi_foil == 1) {
					qty_edit = data.QTY_EDIT == null ? 0 : data.QTY_EDIT;
					qty_roll = Number(data.QTY_ROLL) + Number(qty_edit);
					panjang = data.PANJANG.includes(",") ? desimal(data.PANJANG).toFixed(0) : angka(data.PANJANG);

					$('[name="panjang_foil"]:eq('+row+')').val(format_number(panjang));
					$('[name="qty_roll"]:eq('+row+')').val(data.QTY_ROLL);

					for (var i=0; i<$('#tabel_input tbody tr').length-1; i++) {
						t_id_mutasi = $('[name="kode_foil"]:eq('+i+')').val().split('@')[0];
						t_qty_roll = $('[name="qty_roll"]:eq('+i+')').val();

						if (id_mutasi == t_id_mutasi && i != row) {
							qty_roll = qty_roll - t_qty_roll;
						}
					}

					$('[name="qty_roll"]:eq('+row+')').val(qty_roll);
				}
			}
		});

		isi_total();
	}

// Isi Total Panjang Foil
	function isi_total() {
		for (var i=0; i<$('#tabel_input tbody tr').length; i++) {
			panjang_foil = angka($('[name="panjang_foil"]:eq('+i+')').val());
			qty_roll = $('[name="qty_roll"]:eq('+i+')').val();
			total = Math.ceil(panjang_foil * qty_roll);

			$('[name="total_foil"]:eq('+i+')').val(format_number(total));
		}
		isi_sisa();
	}

// Isi Sisa Roll Foil
	function isi_sisa() {
		for (var i=0; i<$('#tabel_input tbody tr').length; i++) {
			total_foil = angka($('[name="total_foil"]:eq('+i+')').val());
			t_hasil = angka($('[name="hasil"]:eq('+i+')').val());
			t_waste = angka($('[name="waste"]:eq('+i+')').val());
			sisa = total_foil - t_hasil - t_waste;

			$('[name="sisa"]:eq('+i+')').val(format_number(sisa));
		}
	}

// Isi Data Kode Roll
	function isi_kertas(btn) {
		var row = $(btn).closest("tr").index();
		var panjang = angka($(btn).val().split('@')[1]);

		$('[name="panjang_kertas"]:eq('+row+')').val(format_number(panjang));
	}

// Hapus List Downtime
	function hapus_list(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		filter_input();
	};

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Kosong Isian
	function kosong() {
		$('#desain').attr('name', '');
		$('#tabel_input tbody tr').remove();
		isi_kode_foil();

		setTimeout(function() {$('#btn_add').click();}, 500);
	}

// Simpan Data
	function simpan() {
		var id_edit = $('#desain').attr('name');
		var desain = $('#desain').val();
		var tgl = $('#tgl').val();
		var delivery = $("#delivery").val();
		var id_pengawas_stamping = $("#stamping").val();
		var qty_input = $('#tabel_input tbody tr').length;
		var shift = [], mesin = [], nmr_pp = [], kode_kertas = [], panjang_kertas = [], id_mutasi = [], id_gudang_order = [], kode_foil = [], panjang_foil = [], qty_roll = [], hasil = [], waste = [], sisa = [], keterangan = [], kode_asal = [], id_asal = [];

		if (id_pengawas_stamping == '') {error_isian('Pengawas Stamping belum diisi..');}
		if (qty_input == 0) {error_isian('Table isian belum diisi..');}

		$('#mesin').val('').change();
		for (var i=0; i<qty_input; i++) {
			id_detail = $('#tabel_input tbody tr:eq('+i+')').attr('name');
			t_shift = $('[name="shift"]:eq('+i+')').val();
			t_mesin = $('[name="mesin"]:eq('+i+')').val();
			t_nmr_pp = $('[name="nmr_pp"]:eq('+i+')').val();
			t_kertas = $('[name="kode_kertas"]:eq('+i+')').val().split('@');
			t_kode_kertas = t_kertas[0];
			t_panjang_kertas = $('[name="panjang_kertas"]:eq('+i+')').val();

			t_roll = $('[name="kode_foil"]:eq('+i+')').val().split('@');
			t_id_mutasi = t_roll[0];
			t_id_gudang_order = t_roll[1];
			t_kode_foil = t_roll[2];
			t_kode_asal = t_roll[3].split('__')[0];
			t_id_asal = t_roll[3].split('__')[1];

			t_panjang_foil = $('[name="panjang_foil"]:eq('+i+')').val();
			t_qty_roll = $('[name="qty_roll"]:eq('+i+')').val();
			t_hasil = $('[name="hasil"]:eq('+i+')').val();
			t_waste = $('[name="waste"]:eq('+i+')').val();
			t_sisa = $('[name="sisa"]:eq('+i+')').val();
			t_keterangan = $('[name="keterangan"]:eq('+i+')').val();

			if (t_shift == '') {error_isian('Shift urut '+(i+1)+' belum diisi..');}
			if (t_mesin == '') {error_isian('Mesin urut '+(i+1)+' belum diisi..');}
			if (t_nmr_pp == '') {error_isian('Nomor PP urut '+(i+1)+' belum diisi..');}
			if (t_kertas == '') {error_isian('Nomor Roll Kertas urut '+(i+1)+' belum diisi..');}
			if (t_panjang_kertas == '') {error_isian('Panjang Kertas urut '+(i+1)+' belum diisi..');}
			if (t_roll == '') {error_isian('Kode Foil urut '+(i+1)+' belum diisi..');}
			if (t_qty_roll == '' || t_qty_roll == 0) {error_isian('Qty Roll urut '+(i+1)+' belum diisi..');}
			if (t_hasil == '') {error_isian('Hasil urut '+(i+1)+' belum diisi..');}
			if (angka(t_sisa) < 0) {error_isian('Sisa urut '+(i+1)+' salah..');}

			shift.push(t_shift);
			mesin.push(t_mesin);
			nmr_pp.push(t_nmr_pp);
			kode_kertas.push(t_kode_kertas);
			panjang_kertas.push(angka(t_panjang_kertas));
			id_mutasi.push(t_id_mutasi);
			id_gudang_order.push(t_id_gudang_order);
			kode_foil.push(t_kode_foil);
			panjang_foil.push(angka(t_panjang_foil));
			qty_roll.push(t_qty_roll);
			hasil.push(angka(t_hasil));
			waste.push(angka(t_waste));
			sisa.push(angka(t_sisa));
			keterangan.push(t_keterangan);
			kode_asal.push(t_kode_asal);
			id_asal.push(t_id_asal);

			cek_foil(t_id_mutasi, t_qty_roll, id_detail, i, t_kode_asal, t_id_asal);
		}

		var isi_tabel = [shift, mesin, nmr_pp, kode_kertas, panjang_kertas, id_mutasi, id_gudang_order, kode_foil, panjang_foil, qty_roll, hasil, waste, sisa, keterangan, kode_asal, id_asal];
		var data = [id_edit, desain, tgl, delivery, id_pengawas_stamping, isi_tabel];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/Foil_stamping/simpan" ?>',
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

// Cek ketersediaan Foil
	function cek_foil(id_mutasi, qty_roll, id_detail, urut, t_kode_asal, t_id_asal) {
		var data = [id_mutasi, id_detail, t_kode_asal, t_id_asal];

		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/produksi/Foil_stamping/isi_foil" ?>',
			success: function(data) {
				data = JSON.parse(data);

				if (qty_roll > Number(data.QTY_ROLL) + Number(data.QTY_EDIT)) {error_isian('Qty Roll urut '+(urut+1)+' tidak mencukupi..');}
			}
		});
	}

// Edit Data
	function edit(btn) {
		var id_edit = $(btn).attr('name');

		$('#desain').attr('name', id_edit);
		$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
		setTimeout(function() {
			$.ajax({
				async: false,
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/produksi/Foil_stamping/edit',
				data: {data: id_edit},
				success: function(data) {
					data = JSON.parse(data);
					t_isi_foil = 0;

					$('#desain').val(data[0].DESAIN).change();
					$('#tgl').val(format_date(data[0].TGL)).change();
					$('#seri').val(data[0].SERI).change();
					$('#delivery').val(format_date(data[0].DELIVERY)).change();
					$('#stamping').val(data[0].ID_PENGAWAS_STAMPING).change();

					$('#tabel_input').find('tr:gt(0)').remove();
					for (var i=0; i<data.length; i++) {
						if ($("#dt_roll_foil option[value='" + data[i].ID_MUTASI + '@' + data[i].ID_GUDANG_ORDER + '@' + data[i].KODE_FOIL + '@' + data[i].KODE_ASAL + "']").val() === undefined) {
							$('#dt_roll_foil').append('<option value="'+data[i].ID_MUTASI + '@' + data[i].ID_GUDANG_ORDER + '@' + data[i].KODE_FOIL + '@' + data[i].KODE_ASAL+'">'+data[i].KODE_FOIL+'</option>');
						}
					}

					for (var i=0; i<data.length; i++) {
						$('#btn_add').click();

						panjang = Number(data[i].PANJANG.replace(',', '.'));
						kode_kertas = data[i].KODE_KERTAS + '@' + data[i].PANJANG_KERTAS;
						total_foil = panjang * data[i].QTY_ROLL;
						$('[name=shift]:eq('+i+')').val(data[i].SHIFT).change();
						$('[name=mesin]:eq('+i+')').val(data[i].MESIN).change();
						$('[name=nmr_pp]:eq('+i+')').val(data[i].NMR_PP).change();
						$('[name=kode_kertas]:eq('+i+')').val(kode_kertas).change();
						$('[name=panjang_kertas]:eq('+i+')').val(format_number(data[i].PANJANG_KERTAS)).change();
						$('[name=kode_foil]:eq('+i+')').val(data[i].ID_MUTASI + '@' + data[i].ID_GUDANG_ORDER + '@' + data[i].KODE_FOIL + '@' + data[i].KODE_ASAL).change();
						$('[name=panjang_foil]:eq('+i+')').val(format_number(panjang)).change();
						$('[name=qty_roll]:eq('+i+')').val(data[i].QTY_ROLL).change();
						$('[name=total_foil]:eq('+i+')').val(format_number(total_foil)).change();
						$('[name=hasil]:eq('+i+')').val(format_number(data[i].HASIL)).change();
						$('[name=waste]:eq('+i+')').val(format_number(data[i].WASTE)).change();
						$('[name=sisa]:eq('+i+')').val(format_number(data[i].SISA)).change();
						$('[name=keterangan]:eq('+i+')').val(data[i].KETERANGAN).change();
						$('#tabel_input tbody tr:eq('+i+')').attr('name', data[i].ID_DETAIL);
					}
					$(".select").select2();

					setTimeout(function() {$('#btnOk').click(); t_isi_foil = 1;}, 300);
				}
			});
		}, 1000);
	}

// Approve Data
	function batal(btn) {
		var id_hapus = $(btn).attr('name');

		$('#btnHapus').click();
		$('#btnYa').on('click', function() {
			if (id_hapus == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/produksi/Foil_stamping/hapus" ?>',
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

// Cetak Log
	function cetak(btn) {
		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var id_detail = $(btn).attr('name');
		var t_hasil = 0, t_waste = 0, t_waste_sub = 0, t_hasil_sub = 0;
		var c_mesin = '', c_kode = '';

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/Foil_stamping/cetak',
			data: {data: id_detail},
			success: function(data) {
				data = JSON.parse(data);

				seri = data[0].SERI.split(' ').length == 1 ? data[0].SERI : data[0].SERI.split(' ')[1];
				$('#pr_head tr:eq(0) td:eq(2)').html(format_date(data[0].TGL));
				$('#pr_head tr:eq(1) td:eq(2)').html(seri);
				$('#pr_head tr:eq(0) td:eq(5)').html(data[0].DESAIN);
				$('#pr_head tr:eq(1) td:eq(5)').html(format_date(data[0].DELIVERY));

				$('#pr_body tbody tr').remove();
				for (var i=0; i<data.length; i++) {
					nmr_pp = c_kode == data[i].KODE_KERTAS ? '' : data[i].NMR_PP;
					shift = c_kode == data[i].KODE_KERTAS ? '' : data[i].SHIFT;
					mesin = c_kode == data[i].KODE_KERTAS ? '' : data[i].MESIN;
					kode_kertas = c_kode == data[i].KODE_KERTAS ? '' : data[i].KODE_KERTAS;
					panjang_kertas = c_kode == data[i].KODE_KERTAS ? '' : format_number(data[i].PANJANG_KERTAS);
					total = Number(data[i].PANJANG) * Number(data[i].QTY_ROLL);

					t_hasil = t_hasil + angka(data[i].HASIL);
					t_waste = t_waste + angka(data[i].WASTE);
					t_hasil_sub = t_hasil_sub + angka(data[i].HASIL);
					t_waste_sub = t_waste_sub + angka(data[i].WASTE);

					c_mesin = i+1 == data.length ? '' : data[i+1].MESIN;
					c_kode = data[i].KODE_KERTAS;

					$('#pr_body tbody').append('<tr align="right"><td align="center">'+nmr_pp+'</td><td align="center">'+shift+'</td><td align="center">'+mesin+'</td><td align="center">'+kode_kertas+'</td><td>'+panjang_kertas+'</td><td align="center">'+data[i].KODE_FOIL+'</td><td>'+format_number(data[i].PANJANG)+'</td><td align="center">'+data[i].QTY_ROLL+'</td><td>'+format_number(total)+'</td><td>'+format_number(data[i].HASIL)+'</td><td>'+format_number(data[i].WASTE)+'</td><td>'+format_number(data[i].SISA)+'</td></tr>');

					if (data[i].MESIN != c_mesin) {
						$('#pr_body tbody').append('<tr align="right"><td colspan="9" align="center">PP '+data[i].NMR_PP+' / '+data[i].MESIN+'</td><td align="center">'+format_number(t_hasil_sub)+'</td><td align="center">'+format_number(t_waste_sub)+'</td><td></td></tr>');
						t_waste_sub = 0, t_hasil_sub = 0;
					}
				}

				$('#pr_body tbody').append('<tr class="text-center text-bold"><td colspan="5">Total</td><td colspan="4"></td><td>'+format_number(t_hasil)+'</td><td>'+format_number(t_waste)+'</td><td></td></tr>');

				$('#pr_foot tr:eq(2) td:eq(1)').html('( ... <b>' + proper(data[0].PENGAWAS) + '</b> ... )');

				printable.style.display = "";
				non_printable.style.display = "none";

				window.scrollTo({top: 0,left: 0});
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

</script>