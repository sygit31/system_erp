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
		<div class="card card-info" <?php if ($menu == 'app') {echo 'hidden';} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div>Input IPB - Gudang</div></font></b>
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
			<div class="card-body">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">Lokasi Barang</th>
								<td width="60%">
									<select class="select" id="unit" style="width: 100%;">
										<?php foreach($unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($cek_user[0] == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>						
										<?php } ?>
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
								<th >Jenis Bahan</th>
								<td>
									<select id="dt_bahan" hidden><option value="">Pilih..</option></select>
									<select class="select" id="jenis" onchange="ambil_barang()" style="width: 100%;">
										<?php foreach($jenis->result_array() as $dt) { ?>
											<option><?php echo $dt['JENIS']; ?></option>						
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nomor</th>
								<td>
									<input type="text" id="nmr" class="form-control" style="width: 100%;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6">
						<table width="100%">
							<tr>
								<th width="40%">Bagian Pemesan</th>
								<td width="60%">
									<select class="select" id="bagian" onchange="isi_nama(); auto_no();"  style="width: 100%;">
										<?php foreach($dt_bagian->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Pemesan</th>
								<td>
									<select class="select" id="order" style="width: 100%;">
										<option value="">Pilih..</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Aprroval</th>
								<td>
									<select class="select" id="approve" style="width: 100%;">
										<option value="">Pilih..</option>
									</select>
								</td>
							</tr>
						</table>						
					</div>
				</div>
			</div>
			<div class="card-body card ml-3 mr-3" style="font-weight: bold; color: #FFFFFF;">
				<div class="table-responsive">
					<button type="button" class="btn btn-block" id="btn_add" style="width:130px; margin-bottom: 10px; color: #FFFFFF; font-size: 16px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Bahan</b></button>
					<div style="width: 1200px;">
						<table id="tabel_input" class="table table-bordered">
							<thead style="background-color: #3FB4F7;">
								<tr style="text-align: center;">
									<td width="10%">No.</td>
									<td width="30%">Nama Bahan</td>
									<td width="15%">Satuan</td>
									<td width="12.5%">Stok</td>
									<td width="12.5%">Qty IPB</td>
									<td width="20%">Keterangan</td>
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
					<b><font color="White" id="headerinput">Laporan IPB - Gudang</font></b>
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
							<table style="width: 1000px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="25%" colspan="2" class="filter">Periode Tanggal</th>
										<td></td>
										<th width="15%" class="filter">Divisi</th>
										<td></td>
										<th width="17.5%" class="filter">Bagian</th>
										<td></td>
										<th width="20%" class="filter">Jenis Bahan</th>
										<td></td>
										<th width="22.5%" class="filter">Nama Bahan</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="f_unit" onchange="filter()" style="width: 100%;" <?php if ($kd_status == '1' && $menu == 'cre') {echo 'disabled';} ?>>
												<option value="All">All..</option>	
												<?php foreach($unit->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($cek_user[0] == $dt['KD_UNIT'] && $menu == 'cre') {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_bagian" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_bagian->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="f_jenis" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($jenis->result_array() as $dt) { ?>
													<option><?php echo $dt['JENIS']; ?></option>						
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<div style="width: 220px;"><select class="select" id="f_bahan" onchange="filter()" style="width: 100%;">
												<option value="All">All..</option>		
												<?php foreach($dt_barang->result_array() as $dt) { ?>
													<option value="<?php echo $dt['ID_BARANG']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>						
												<?php } ?>
											</select></div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
							<div class="data-table m-3"></div>
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

<!-- Modal Confirm -->
<div class="modal fade" id="modal_confirm">
	<div class="modal-dialog">
		<div class="modal-content">
			<div id="keterangan" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> </div>
			<div class="modal-footer receive">
				<table width="100%">
					<tr>
						<td width="35%" style="font-weight: bold;">Bagian Gudang</td>
						<td width="65%">
							<select class="select" id="receive" style="width: 100%;">
								<option value="">Pilih..</option>
								<?php foreach($receive->result_array() as $dt) { ?>
									<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
				<button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
				<button id="btnConfirm" data-toggle="modal" data-target="#modal_confirm" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden;">
	<div style="width: 200px;">
		<h5 align="center">PT. Pura Nusapersada</h5>
		<h5 align="center">Kudus</h5>
	</div>

	<h4 id="judul" align="center">IJIN PENGELUARAN BAHAN GUDANG</h4>
	<h4 id="nmr_ipb" align="center">XXX/XX/XX-XX/XXX</h4>

	<table id="print_body" class="table table-bordered mt-4" style="line-height: 14px;">
		<thead>
			<tr align="center">
				<td width="5%" rowspan="2">NO.</td>
				<td width="35%" rowspan="2">NAMA BARANG / BAHAN</td>
				<td width="15%" colspan="2">KATEGORI</td>
				<td width="15%" rowspan="2">SATUAN</td>
				<td width="15%" rowspan="2">BANYAKNYA</td>
				<td width="30%" rowspan="2">KETERANGAN</td>
			</tr>
			<tr align="center">
				<td>BB</td>
				<td>BP</td>
			</tr>
		</thead>
		<tbody></tbody>
		<tfoot>
			<tr style="height: 100px;">
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td align="center">
					Diterima,<br>
					<br/><br/><br/><br/><br/>
					( ............... )
				</td>
			</tr>
		</tfoot>
	</table>
	<div id="nmr_form" align="right" style="font-size: 12px; margin-top: -10px; margin-bottom: 10px;">F-SMT-G2-012 Rev. 00</div>

	<div id="tgl_order" style="margin-left: 35px; font-size: 15px; margin-bottom: 10px;">Kudus,</div>

	<table id="print_footer" width="100%" style="line-height: 10px;">
		<tr>
			<td width="20%" align="center">Yang meminta :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Yang memberi :</td>
			<td width="20%"></td>
			<td width="20%" align="center">Mengetahui :</td>
		</tr>
		<tr style="height: 10px;"></tr>
		<tr>
			<td align="center">Bag. </td>
			<td></td>
			<td align="center">Bag. Gudang</td>
			<td></td>
			<td align="center">Bag. </td>
		</tr>
		<tr style="height: 70px;"></tr>
		<tr style="height: 20px; font-weight: bold;">
			<td align="center"></td>
			<td></td>
			<td align="center">(&nbsp;&nbsp;Andre AW&nbsp;&nbsp;)</td>
			<td></td>
			<td align="center"></td>
		</tr>
	</table>
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

// Define Variable
	var id_edit = '', dt_barang = [];

// Load Dokumen
	$(document).ready(function() {
		var menu = <?php echo json_encode($menu); ?>;

		if (menu == 'cre') {$('#f_bagian option:eq(0)').remove();}
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

		isi_nama();
		ambil_barang();
		filter();
	});

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
				filename: 'Laporan Data IPB - Gudang',
				title: ''
			}],
			"colReorder": true
		});

		setTimeout(function() {
			data_table.columns.adjust().draw();
		}, 1000);
	}

// Kosong Isian
	function kosong() {
		id_edit = '';
		auto_no();
		$("#tabel_input").find("tr:gt(0)").remove();
	}

// Isi Nama Berdasarkan Bagian
	function isi_nama() {
		var id_bagian = $('#bagian').val();

		$('#order option:gt(0), #approve option:gt(0)').remove();
		$.ajax({
			type: 'POST',
			data: {data: id_bagian},
			url: '<?php echo base_url(); ?>index.php/gudang/ipb_bp/isi_nama',
			success: function(data) {
				data = JSON.parse(data);
				dt_nama = data[0];
				dt_app = data[1];

				for (var i=0; i<dt_nama.length; i++) {
					$('#order').append('<option value="'+dt_nama[i].ID+'">'+proper(dt_nama[i].NAMA)+'</option>');
				}

				for (var i=0; i<dt_app.length; i++) {
					$('#approve').append('<option value="'+dt_app[i].ID+'">'+proper(dt_app[i].NAMA)+'</option>');
				}
				$('#order, #approve').change();
			}
		});
	}

// Auto Nomor IPB
	function auto_no() {
		var tgl = $('#tgl').val();
		var kd_unit = $('#unit').val();
		var jenis = $('#jenis').val();
		var bagian = $('#bagian').val();
		var data = [id_edit, tgl, kd_unit, jenis, bagian];

		$.ajax({
			type: 'POST',
			data: {data: data},
			url: '<?php echo base_url(); ?>index.php/gudang/ipb_bp/auto_no',
			success: function(data) {
				data = JSON.parse(data);
				$('#nmr').val(data);
			}
		});
	}

// Filter Data
	function filter() {
		var tgl1 = $('#f_tgl1').val();
		var tgl2 = $('#f_tgl2').val();
		var unit = $('#f_unit').val();
		var id_bagian = $('#f_bagian').val();
		var jenis = $('#f_jenis').val();
		var bahan = $('#f_bahan').val();
		var menu = <?php echo json_encode($menu); ?>;
		var data = [tgl1, tgl2, unit, id_bagian, jenis, bahan];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/ipb_bp/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);
				setTimeout(function() {
					$('#btnOk').click();
					pagination();
				}, 500);

				if (menu == 'app') {
					$('#headerinput').html('Approval IPB - Gudang');
					$('#data-table th:nth-child(13), #data-table td:nth-child(13)').hide();
					$('#data-table th:nth-child(14), #data-table td:nth-child(14)').hide();
				}else{
					$('#headerinput').html('Laporan IPB - Gudang');
					$('#data-table th:nth-child(15), #data-table td:nth-child(15)').hide();
				}
			}
		}); 
	}

// Ambil Data Barang
	function ambil_barang() {
		var jenis = $('#jenis').val();

		auto_no();
		$('#dt_bahan option:gt(0)').remove();
		$("#tabel_input").find("tr:gt(0)").remove();
		$.ajax({
			async: false,
			data: {data: jenis},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/ipb_bp/bahan" ?>',
			success: function(data) {
				dt_barang = JSON.parse(data);

				for (var i=0; i<dt_barang.length; i++) {
					bahan = dt_barang[i].SPESIFIKASI.length < 3 ? dt_barang[i].NAMA : dt_barang[i].NAMA + ' ' + dt_barang[i].SPESIFIKASI;

					$('#dt_bahan').append('<option value="'+dt_barang[i].ID+'">'+ bahan +'</option>');
				}
			}
		});
	}

// Tambah Barang
	$('#btn_add').click(function() {
		var tabel_input = document.getElementById('tabel_input');
		var qty_input = tabel_input.rows.length - 1;
		var option = $('#dt_bahan').html();

		$('#tabel_input').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td align="center"><div style="max-width: 340px;"><select class="form-control select" name="bahan" onchange="isi_satuan(this)" style="width: 95%;"></select></div></td>' +
			'<td><select class="form-control select" name="satuan" style="width: 95%;">' +
			'</select></td>' +
			'<td><input type="text" class="form-control" name="stok" style="width: 100%; text-align: right;" readonly></td>' +
			'<td><input type="text" class="form-control" name="qty" style="width: 100%; text-align: right;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><input type="text" class="form-control" name="keterangan" style="width: 100%;" autocomplete="off"></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Downtime" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		$('[name=bahan]:eq('+qty_input+')').html(option);
		$(".select").select2();
		isi_urut();
		onlynumeric();
	});	

// Isi Satuan Berdasarkan Barang
	function isi_satuan(btn) {
		var tabel_input = document.getElementById('tabel_input');
		var row = $(btn).closest("tr").index();
		var id_bahan = document.getElementsByName('bahan')[row].value;
		var satuan = '', stok = 0;

		$('[name=satuan]:eq('+row+')').empty();
		dt_barang.forEach(function(item) {
			if (item.ID == id_bahan) {
				satuan = item.SATUAN;
				saldo_awal = item.SALDO_AWAL == null ? 0 : desimal(item.SALDO_AWAL);
				masuk = item.MASUK == null ? 0 : desimal(item.MASUK);
				keluar = item.KELUAR == null ? 0 : desimal(item.KELUAR);
				
				stok = (Number(saldo_awal) + Number(masuk) - Number(keluar)).toFixed(2);
				return;
			}
		});

		if (satuan != '') {
			$('[name=satuan]:eq('+row+')').append('<option>'+satuan+'</option>');
		}
		$('[name=satuan]:eq('+row+')').val(satuan).change();
		$('[name=stok]:eq('+row+')').val(format_number(stok < 0 ? 0 : stok)).change();
	}

// Isi Nomor Urut Roll
	function isi_urut() {
		var tabel_input = document.getElementById('tabel_input');

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			document.getElementsByName('nmr')[i].value = i+1;
		}
	}

// Hapus List Downtime
	function hapus_list(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		isi_urut();
	};

// Error Isian
	function error_isian(str) {
		$('#error_isian').removeClass('invisible');
		$('#error_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Simpan Data
	function simpan() {
		var id_barang = [], satuan = [], qty = [], keterangan = [];
		var tabel_input = document.getElementById('tabel_input');
		var kd_unit = $('#unit').val();
		var tgl = $('#tgl').val();
		var nmr = $("#nmr").val();
		var id_order = $("#order").val();
		var id_approve = $("#approve").val();
		var jenis = $('#jenis').val();
		var id_bagian = $('#bagian').val();

		if (id_order == '') {error_isian('Nama Pemesan belum diisi..');}
		if (id_approve == '') {error_isian('Nama Approval belum diisi..');}
		if (tabel_input.rows.length == 1) {error_isian('Table Bahan belum diisi..');}

		for (var i=0; i<tabel_input.rows.length-1; i++) {
			t_id_barang = document.getElementsByName('bahan')[i].value;
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_qty = document.getElementsByName('qty')[i].value;
			t_stok = document.getElementsByName('stok')[i].value;
			t_keterangan = document.getElementsByName('keterangan')[i].value;

			
			if (t_id_barang == '') {error_isian('Nama Bahan No. '+(i+1)+' belum diisi..');}
			if (t_satuan == '') {error_isian('Satuan No. '+(i+1)+' belum diisi..');}
			if (t_qty == '' || t_qty == 0) {error_isian('Qty No. '+(i+1)+' belum diisi..');}
			if (Number(t_qty) > Number(t_stok)) {error_isian('Stok No. '+(i+1)+' tidak mencukupi..');}

			id_barang.push(t_id_barang);
			satuan.push(t_satuan);
			qty.push(t_qty);
			keterangan.push(t_keterangan);
		}

		var isi_tabel = [id_barang, satuan, qty, keterangan];
		var data = [id_edit, kd_unit, tgl, nmr, id_order, id_approve, isi_tabel, jenis, id_bagian];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/ipb_bp/simpan" ?>',
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

// Edit Data
	function edit(btn) {
		var action = btn.name;
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_edit = data_table.rows[row].cells[0].innerHTML;

		var data = [action, id_edit];
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/gudang/ipb_bp/edit',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);

				$('#tgl').val(format_date(data[0].TGL)).change();
				$('#nmr').val(data[0].NMR).change();
				$('#unit').val(data[0].KD_UNIT).change();
				$('#order').val(data[0].ID_ORDER).change();
				$('#approve').val(data[0].ID_APPROVE).change();
				$('#jenis').val(data[0].JENIS).change();

				ambil_barang();
				$("#tabel_input").find("tr:gt(0)").remove();
				for (var i=0; i<data.length; i++) {
					$('#btn_add').click();

					$('[name=bahan]:eq('+i+')').val(data[i].ID_BARANG).change();
					document.getElementsByName('qty')[i].value = format_number(desimal(data[i].QTY));
					document.getElementsByName('stok')[i].value = angka(document.getElementsByName('stok')[i].value) + angka(data[i].QTY)	;
					document.getElementsByName('keterangan')[i].value = data[i].KETERANGAN;
				}

				return;
			}
		});
		$('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
	}

// Approve Data
	function app(btn) {
		var action = btn.name;
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id = data_table.rows[row].cells[0].innerHTML;

		if (action == 'app') {
			status = '2';
			keterangan = 'Yakin akan menyetujui IPB?';
			$('.modal-footer.receive').show();
		}else if (action == 'rej') {
			status = '0';
			keterangan = 'Yakin akan membatalkan IPB?';
			$('.modal-footer.receive').hide();
		}

		$('#keterangan').html(keterangan)
		$('#btnConfirm').click();

		$('#btnYa').on('click', function() {
			var id_receive = $('#receive').val();
			var data = [id, status, id_receive];

			if (id_receive == '' && action == 'app') {
				setTimeout(function() {
					error_isian('Nama Karyawan Gudang belum diisi..');
				}, 1000);
				return;
			}

			if (id == '') {return;}

			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url()."index.php/gudang/ipb_bp/app" ?>',
				data: {data: data},
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

		$('#btnNo').click(function() {
			if (id == '') {return;}
			id = '';
		});
	}

// Cetak IPB
	function cetak(btn) {
		var action = btn.name;
		var data_table = document.getElementById('data-table');
		var print_footer = document.getElementById('print_footer');
		var row = $(btn).closest("tr").index() + 1;
		var id = data_table.rows[row].cells[0].innerHTML;
		var data = [action, id];

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url()."index.php/gudang/ipb_bp/edit" ?>',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);

				$('#judul').html('IJIN PENGELUARAN BARANG (' + data[0].JENIS + ')');
				$('#nmr_form').html(data[0].JENIS == 'BAHAN CHEMICAL' ? 'F-SMT-G2-012 Rev. 01' : 'F-SMT-G2-004 Rev. 00');
				$('#nmr_ipb').html(data[0].NMR);
				$('#tgl_order').html('Kudus, ' + format_date(data[0].TGL));

				print_footer.rows[4].cells[0].innerHTML = '(&nbsp;&nbsp;' + proper(data[0].NAMA_ORDER) + '&nbsp;&nbsp;)';
				// print_footer.rows[4].cells[2].innerHTML = '(&nbsp;&nbsp;' + proper(data[0].NAMA_RECEIVE) + '&nbsp;&nbsp;)';
				print_footer.rows[4].cells[4].innerHTML = '(&nbsp;&nbsp;' + proper(data[0].NAMA_APPROVE) + '&nbsp;&nbsp;)';

				print_footer.rows[2].cells[0].innerHTML = 'Bag. ' + proper(data[0].BAGIAN_ORDER);
				print_footer.rows[2].cells[4].innerHTML = 'Bag. ' + proper(data[0].BAGIAN_ORDER);

				$("#print_body tbody tr").remove();
				for (var i=0; i<data.length; i++) {
					urut = i+1;
					spesifikasi = data[i].SPESIFIKASI;
					bahan = spesifikasi.length > 3 ? data[i].BAHAN + ' - ' + spesifikasi : data[i].BAHAN;
					satuan = data[i].SATUAN;
					qty = format_number(desimal(data[i].QTY));
					keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;

					$("#print_body tbody").append('<tr><td align="center">'+urut+'</td><td>'+bahan+'</td><td align="center"></td><td align="center"></td><td align="center">'+satuan+'</td><td align="right">'+qty+'</td><td>'+keterangan+'</td></tr>');
				}

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