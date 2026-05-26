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

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">IPB WIP Belah - Gudang WIP</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<table style="width: 700px; margin-bottom: -20px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="35%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<td width="15%" class="filter">Desain</td>
										<td></td>
										<th width="35%" class="filter">KK</th>
										<td></td>
										<th width="15%" class="filter">Seri</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
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
											<select class="select" id="fKk" onchange="filter()" style="width: 100%;">
												<option>All..</option>
												<?php foreach ($kk->result_array() as $dt) { ?>
													<option><?php echo $dt['KK']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fSeri" onchange="filter()" style="width: 100%;">
												<?php foreach ($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>
												<?php } ?>
											</select>
										</td>
									</tr>
								</tbody>
							</table>

							<div class="data-table table-responsive mt-5"></div>

							<div class="card-footer">
								<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
							</div>
						</font>
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
				<button id="btnOk_sukses" style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
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

<!-- Modal Mutasi WIP -->
<div class="modal fade" id="modal_ipb">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card-body">
				<table width="100%">
					<tr>
						<th width="50%">Nomor Mutasi</th>
						<td width="50%">
							<input type="text" class="form-control" id="nmr_mutasi" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Nomor IPB</th>
						<td>
							<input type="text" class="form-control" id="nmr_ipb" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Tanggal</th>
						<td>
							<input type="text" class="form-control" id="tgl_ipb" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Gudang</th>
						<td>
							<select class="select" id="gudang_ipb" style="width: 100%;">
								<?php foreach ($pengawas_gudang->result_array() as $dt) { ?>
									<option selected><?php echo $dt['NAMA']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Produksi</th>
						<td>
							<select class="select" id="produksi_ipb" style="width: 100%;">
								<?php foreach ($pengawas_produksi->result_array() as $dt) { ?>
									<option selected><?php echo $dt['NAMA']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Approval</th>
						<td>
							<select class="select" id="approval" style="width: 100%;">
								<?php foreach ($approval->result_array() as $dt) { ?>
									<option selected><?php echo $dt['NAMA']; ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
				</table>
			</div>
			<div class="modal-footer">
				<button id="simpan_ipb" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
				<button id="batal_ipb" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close mr-2"></i><b>Batal</b></button>
				<button id="btnMutasi" data-toggle="modal" data-target="#modal_ipb" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 16px;">
	<div style="width: 300px;">
		<h6 align="center">PT. PURA NUSAPERSADA</h6>
		<h6 align="center">KUDUS</h6>
	</div>

	<h4 align="center">IJIN PENGELUARAN BARANG (FOIL)</h4>
	<h5 id="p_nmr" align="center">XXX/XX/XX-XX/XXX</h5>

	<table id="p_header" style="line-height: 20px; width: 400px;">
		<tr>
			<td width="25%">Tanggal</td>
			<td width="5%">:</td>
			<td width="70%"></td>
		</tr>
		<tr>
			<td>Seri</td>
			<td>:</td>
			<td></td>
		</tr>
		<tr>
			<td>KK</td>
			<td>:</td>
			<td></td>
		</tr>
	</table>

	<div style="height: 15px;"></div>
	<table id="p_body" class="table table-bordered" style="line-height: 10px;">
		<thead>
			<tr align="center">
				<td width="10%">No.</td>
				<td width="50%">Nama Barang</td>
				<td width="20%">Kode Roll</td>
				<td width="20%">Panjang (Meter)</td>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<div align="right" style="font-size: 14px; margin-top: -10px; margin-bottom: 10px;">F-SMT-G2-011 Rev. 01</div>

	<table id="p_footer" width="100%" style="line-height: 10px;">
		<tr>
			<td width="20/7%" align="center">Yang Meminta</td>
			<td width="20/7%"></td>
			<td width="20/7%" align="center">Yang Memberi</td>
			<td width="20/7%"></td>
			<td width="20/7%" align="center">Mengetahui</td>
			<td width="20/7%"></td>
			<td width="20/7%" align="center"></td>
		</tr>
		<tr style="height: 10px;"></tr>
		<tr>
			<td align="center">Bag. Slitter</td>
			<td></td>
			<td align="center">Bag. Gudang</td>
			<td></td>
			<td align="center"></td>
			<td></td>
			<td align="center">Verifikasi</td>
		</tr>
		<tr style="height: 70px;"></tr>
		<tr>
			<td align="center" style="font-weight: bold;"></td>
			<td></td>
			<td align="center" style="font-weight: bold;"></td>
			<td></td>
			<td align="center" style="font-weight: bold;"></td>
			<td></td>
			<td align="center" style="font-weight: bold;">( Bag. Produksi )</td>
		</tr>
		<tr style="height: 70px;"></tr>
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
	var id_prod_mutasi = '', data_table;

// Load Dokumen
	$(document).ready(function() {
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
		filter();
	});

// Filter Data
	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var seri = document.getElementById('fSeri').value;
		var kk = document.getElementById('fKk').value;
		var desain = document.getElementById('fDesain').value;
		var data = [tgl1, tgl2, seri, kk, desain];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/wip_pet/filter" ?>',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					pagination();
				}, 1000);
				
				$('.data-table').html(data);
			}
		});
	}

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		data_table = $('#data-table').DataTable({
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
				exportOptions: {
					columns: ':visible'
				},
				className: 'invisible excel',
				title: 'Laporan Data Produksi PET'
			}],
			"colReorder": true
		});

		setTimeout(function() {
			data_table.columns.adjust().draw();
		}, 1000);
	}

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

// Notifikasi Mutasi PET
	function ipb(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var tgl = data_table.rows[row].cells[3].innerHTML;
		var nmr_mutasi = data_table.rows[row].cells[6].innerHTML;
		var nmr_ipb = nmr_mutasi.replace("MHB-Slit Belah", "SLT");

		$('#nmr_mutasi').val(nmr_mutasi);
		$('#nmr_ipb').val(nmr_ipb);
		$('#tgl_ipb').val(tgl);

		$('#btnMutasi').click();
	}

// Simpan IPB
	$('#simpan_ipb').on('click', function() {
		$('#btnProgress').click();

		var tabel_input = document.getElementById('data-table');
		var i_produksi = document.getElementById('produksi_ipb').selectedIndex;
		var i_gudang = document.getElementById('gudang_ipb').selectedIndex;
		var i_approval = document.getElementById('approval').selectedIndex;
		var pengawas_produksi = <?php echo json_encode($pengawas_produksi->result_array()); ?>;
		var pengawas_gudang = <?php echo json_encode($pengawas_gudang->result_array()); ?>;
		var approval = <?php echo json_encode($approval->result_array()); ?>;
		var id_pengawas_produksi = pengawas_produksi[i_produksi].ID;
		var id_pengawas_gudang = pengawas_gudang[i_gudang].ID;
		var id_approval = approval[i_approval].ID;
		var nmr_mutasi = $('#nmr_mutasi').val();
		var nmr_ipb = $('#nmr_ipb').val();
		var tgl = $('#tgl_ipb').val();

		if (id_pengawas_produksi == '') {error_isian('Nama Pengawas Produksi belum diisi..'); return;}
		if (id_pengawas_gudang == '') {error_isian('Nama Pengawas Gudang belum diisi..'); return;}
		if (id_approval == '') {error_isian('Nama Pengawas Produksi belum diisi..'); return;}

		var data = [nmr_mutasi, nmr_ipb, tgl, id_pengawas_produksi, id_pengawas_gudang, id_approval];

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/wip_pet/simpan_ipb" ?>',
			data: {data: data},
			success: function(data) {
				filter();
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
				}, 500);
			}
		});
	});

// Reload Page
	$('#batal_ipb').click(function() {
		id_prod_mutasi = '';
	});

// Cetak IPB
	function cetak(btn) {
		$("#p_body tbody").find("tr").remove();

		var printable = document.getElementById('printable');
		var non_printable = document.getElementById('non_printable');
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var kk = data_table.rows[row].cells[4].innerHTML;
		var ipb = data_table.rows[row].cells[7].innerHTML;
		var data = [kk, ipb];
		var p_header = document.getElementById('p_header');
		var p_body = document.getElementById('p_body');
		var p_footer = document.getElementById('p_footer');
		var total = 0;

		$.ajax({
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/wip_pet/cetak" ?>',
			data: {data: data},
			success: function(data) {
				data = JSON.parse(data);

				$('#p_nmr').html(data[0].NMR_IPB);
				p_header.rows[0].cells[2].innerHTML = data[0].TGL;
				p_header.rows[1].cells[2].innerHTML = data[0].SERI;
				p_header.rows[2].cells[2].innerHTML = data[0].KK;

				for (var i=0; i<data.length; i++) {
					$('#p_body tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].NAMA_BARANG+'</td><td align="center">'+data[i].KODE+'</td><td align="right">'+format_number(data[i].QTY)+'</td></tr>');
					total = total + Number(data[i].QTY);
				}
				$('#p_body tbody').append('<tr><td align="right" class="pr-2" colspan="3">Total</td><td align="right">'+format_number(total)+'</td></tr>');

				p_footer.rows[4].cells[0].innerHTML = '( ' + data[0].PENGAWAS_PRODUKSI + ' )';
				p_footer.rows[4].cells[2].innerHTML = '( ' + data[0].PENGAWAS_GUDANG + ' )';
				p_footer.rows[4].cells[4].innerHTML = '( ' + data[0].APPROVAL + ' )';

				printable.style.display = "";
				non_printable.style.display = "none";
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

</script>