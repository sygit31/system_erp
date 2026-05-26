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
<style>body {padding-right: 0 !important;} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #6D6C6C !important;}</style>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info" <?php if ($status != 1) {echo "hidden";} ?>>
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Master Data Material</div>
						</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Pengadaan - Manual Book Master Material.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" id="minimize" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<table width="95%">
					<tr>
						<th width="15%">Kode Material</th>
						<td width="45%">
							<input type="text" class="form-control" id="kode" style="width: 40%;" readonly>
						</td>
						<th width="15%">Kategori</th>
						<td width="25%">
							<select class="select" id="kategori" onchange="isi_jenis()" style="width: 100%;">
								<option value="">Pilih Kategori..</option>
								<option>PRODUKSI</option>
								<option>NON PRODUKSI</option>
								<option>PROOF</option>
							</select>
						</td>
					</tr>
					<tr height="10"></tr>
					<tr>
						<th>Nama Material</th>
						<td>
							<input type="text" class="form-control" id="nama_material" style="width: 80%; text-transform: uppercase;" tabindex="1" maxlength="50" autocomplete="off">
						</td>
						<th>Jenis</th>
						<td>
							<select class="select" id="jenis" style="width: 100%;">
								<option>Pilih Jenis..</option>
							</select>
						</td>
					</tr>
					
					<tr height="10"></tr>
					<tr>
						<th>Spesifikasi</th>
						<td>
							<input type="text" class="form-control" id="spesifikasi" value="-" style="width: 80%; text-transform: uppercase;" maxlength="50" tabindex="2" autocomplete="off">
						</td>
						
						<th>Kode Barang SAKTI</th>
						<td width="60%">
							<div class="row">
								<div class="col-8">
									<input type="text" class="form-control" id="kode_barang_sakti" style="width: 100%; text-transform: uppercase;" readonly>
								</div>
								<div class="col-3">
									<button type="button" id="btn_tambah" class="btn btn-success" onclick="pagination_kode_barang_sakti()" data-toggle="modal" data-target="#modal_kode_sakti"><i class="fa fa-plus"></i></button>
								</div>
							</div>
						</td>
					</tr>
					
					<tr height="10"></tr>
					<tr>
						<th>Satuan</th>
						<td>
							<select class="select" id="satuan" style="width: 40%;">
								<option value="">Pilih..</option>
								<?php foreach ($satuan->result_array() as $dt) : ?>
									<option><?php echo $dt['SATUAN']; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
						<th>QC Test</th>
						<td>
							<select class="select" id="qc_test" style="width: 40%;">
								<option>Tidak</option>
								<option>Ya</option>
							</select>
						</td>
					</tr>
					<tr height="10"></tr>
					<tr>
						<th>Min. Stok</th>
						<td>
							<input type="text" class="form-control" id="min_stok" value="0" style="width: 40%;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" tabindex="3" autocomplete="off">
						</td>
						<th>Deskripsi</th>
						<td>
							<textarea class="form-control" id="deskripsi" rows="2" tabindex="4" maxlength="55"></textarea>
						</td>
					</tr>
					<tr height="10"></tr>
					<tr>
						<th>Tahun</th>
						<td>
							<?php $years = range(2030, 2019); ?>
							<?php $tahun = date("Y"); ?>
							<select class="select" id="tahun" style="width: 40%;" tabindex="6">
								<?php foreach ($years as $dt) { ?>
									<option <?php if ($dt == $tahun) {
										echo "Selected";
									} ?>><?php echo $dt; ?></option>
								<?php } ?>
							</select>
						</td>		
					</tr>
				</table>
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

		<!-- Modal Data Kode Sakti -->
		<div class="modal fade" id="modal_kode_sakti">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="card card-info">
						<div class="card-header m-2 rounded" style="cursor: all-scroll;">
							<h3 class="card-title">
								<b>
									<font color="White">
										<div id="headerinput">
											<h3>Data Nama Barang Sakti sudah approve</h3>
										</div>
									</font>
								</b>
							</h3>
						</div>
						<div class="card-body">
							<?php $this->load->view('pembelian/v_nama_barang_sakti_table'); ?>
						</div>
						<div class="modal-footer rounded">
							<button id='btnTutupNamaSakti' style="width: 150px;" type="button" class="btn btn-success" data-dismiss="modal" title="Tutup Informasi"><i class="fa ion-android-share m-2"></i><b>Tutup</b></button>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Data material</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Pengadaan - Manual Book Master Material.pdf')" <?php if ($status == 1) {
						echo "hidden";
					} ?>><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<div class="row">
								<div class="col-10">
									<table style="width: 70%; margin-bottom: 10px;">
										<thead>
											<tr align="center" style="line-height: 30px;">
												<td width="20%" class="filter">Kategori</td>
												<td></td>
												<td width="25%" class="filter">Jenis</td>
												<td></td>
												<td width="20%" class="filter">User</td>
												<td></td>
												<td width="35%" class="filter">Nama material</td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<select class="select" id="fkategori" onchange="filter()" style="width: 100%;">
														<option>All</option>
														<?php foreach ($fKategori->result_array() as $dt) { ?>
															<option><?php echo $dt['KATEGORI']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td></td>
												<td>
													<select class="select" id="fjenis" onchange="filter()" style="width: 100%;">
														<option>All</option>
														<?php foreach ($jenis->result_array() as $dt) { ?>
															<option><?php echo $dt['JENIS']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td></td>
												<td>
													<select class="select" id="fUser" onchange="filter()" style="width: 100%;">
														<option>All</option>
														<?php foreach ($karyawan->result_array() as $dt) { ?>
															<option><?php echo $dt['NAMA']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td></td>
												<td>
													<input type="text" id="cari" onchange="filter()" placeholder="Cari nama material.." style="width: 100%;" autocomplete="off" tabindex="4">
												</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-2 text-right">
									<input type="checkbox" id="fApproved" onchange="filter()" style="cursor: pointer;" checked><b>&nbsp New Request</b>
								</div>
							</div>

							<div class="data-table table-responsive mt-3"></div>

							<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

						</font>
					</div>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<font color="Green" size="2">ERP @2019</font>
		</div>

	</section>
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

<!-- Modal Notifikasi Tambah Material -->
<div class="modal fade" id="modal_notif">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body row">
				<div class="col-4 text-danger" style="font-size: 36px;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
				<div class="col-8 text-danger" style="font-size: 22px;"><b>Sebelum menambahkan material, silakan cek dulu apakah material sudah ada atau belum..</b></div>
			</div>
			<div class="modal-footer">
				<button style="width: 150px;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-thumbs-o-up m-2"></i><b>OK</b></button>
				<button id="btnNotif" data-toggle="modal" data-target="#modal_notif" data-backdrop="static" data-keyboard="false" hidden></button>
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
				<button id="btnOk_progress" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
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
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
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
				<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add Kode Jurnal -->
<div class="modal fade" id="modal-jurnal" style="position: absolute;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
				<h3 class="card-title">
					<b>
						<font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">Update Material</font>
					</b>
				</h3>
			</div>

			<div class="card card-body m-4">
				<table width="100%">
					<tr>
						<th width="30%">Nama Material</th>
						<td width="70%">
							<input type="text" class="form-control" id="e_nama" style="width: 100%; text-transform: uppercase;" maxlength="50" autocomplete="off" <?php if ($status != 1) {
								echo "readonly";
							} ?>>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Spesifikasi</th>
						<td>
							<input type="text" class="form-control" id="e_spesifikasi" maxlength="50" autocomplete="off" style="width: 100%; text-transform: uppercase;" <?php if ($status != 1) {
								echo "readonly";
							} ?>>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>						
						<th>Satuan</th>
						<td>
							<select class="select" id="e_satuan" style="width: 40%;" <?php if($status != '1') {echo "disabled";} ?>>
								<option value="">Pilih..</option>
								<?php foreach ($satuan->result_array() as $dt) : ?>
									<option><?php echo $dt['SATUAN']; ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Kategori</th>
						<td>
							<input type="text" class="form-control" id="e_kategori" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Jenis</th>
						<td>
							<input type="text" class="form-control" id="e_jenis" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Min. Stok</th>
						<td>
							<input type="text" class="form-control" id="e_minstok" style="width: 100%;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Deskripsi</th>
						<td>
							<textarea class="form-control" id="e_deskripsi" rows="2" maxlength="60" readonly></textarea>
						</td>
					</tr>
					<tr class="row_rekjurnal" style="height: 10px;"></tr>
					<tr class="row_rekjurnal">
						<th>Rekening Jurnal</th>
						<td>
							<select class="select" id="e_jurnal" style="width: 100%;">
								<option value="">Pilih Rekening..</option>
								<?php $dt_rekjurnal = array(); ?>
								<?php foreach ($rekjurnal->result_array() as $dt) : ?>
									<option><?php echo $dt['NO_REKJURNAL'] . ' ' . $dt['NAMA']; ?></option>
									<?php array_push($dt_rekjurnal, $dt['NO_REKJURNAL']) ?>
								<?php endforeach ?>
							</select>
						</td>
					</tr>
					<tr class="row_nama_sakti" style="height: 10px;"></tr>
					<tr class="row_nama_sakti">
						<th>Nama Barang SAKTI</th>
						<td>
							<select class="select" id="id_barang_sakti" style="width: 100%;">
								<option value="">Pilih Nama Barang SAKTI..</option>
								<?php $dt_barang_sakti = array(); ?>
								<?php foreach ($nama_barang_sakti->result_array() as $dt) : ?>
									<option><?php echo $dt['KODE'] . ' ' . $dt['NAMA']; ?></option>
									<?php array_push($dt_barang_sakti, $dt['KODE']) ?>
								<?php endforeach ?>
							</select>
						</td>
					</td>
				</tr>
				<tr class="row_simpg" style="height: 10px; display: none;"></tr>
				<tr class="row_simpg" style="display: none;">
					<th>Data SIMPG</th>
					<td width="100%">
						<select class="select" id="e_simpg" style="width: 100%;">
							<option value="">Pilih Barang SIMPG..</option>
							<?php $dt_kode_simpg = array(); ?>
							<?php foreach ($simpg->result_array() as $dt) : ?>
								<option><?php echo $dt['NAMA_BARANG']; ?></option>
								<?php array_push($dt_kode_simpg, $dt['KODE_BARANG']); ?>
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr class="row_check" style="height: 15px;"></tr>
				<tr class="row_check">
					<th></th>
					<td class="text-right text-link">
						<input type="checkbox" id="load_checked" style="cursor: pointer;">
						<p class="text-muted">Load from Simpg</p>
					</td>
				</tr>
			</table>
			<table class="mt-4">
				<tr>
					<td width="150"><button type="button" class="btn btn-block btn-primary" data-dismiss="modal" onclick="simpan_update()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
					<td width="10"></td>
					<td width="150"><button type="button" class="btn btn-block btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
				</tr>
			</table>
		</div>

	</div>
</div>
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
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
	var info_1 = 0,	info_2 = 0;
	var id_edit = '', data_table;

// Load Dokumen
	$(document).ready(function() {
		var status = <?php echo json_encode($status); ?>;

		$(".select").select2();
		$('.fa-bars:eq(0)').click();
		$("#nama_material").attr('disabled','disabled');
		$("#spesifikasi").attr('disabled','disabled');
		$("#tahun").attr('disabled','disabled');
		$("#jenis").attr('disabled','disabled');
		$("#satuan").attr('disabled','disabled');
		$("#qc_test").attr('disabled','disabled');
		$("#min_stok").attr('disabled','disabled');
		$("#deskripsi").attr('disabled','disabled');
		$("#btn_tambah").hide();
		
		filter();
		if (status == '1') {setTimeout(function() {$('#btnNotif').click();}, 1000);}
	});

// Isi Jenis Berdasarkan Kategori
	function isi_jenis() {
		var kategori = document.getElementById("kategori").value;
		var jenis = document.getElementById("jenis");
		var option = document.createElement("option");

		$("#jenis").empty();
		$('#jenis').append(new Option('Pilih Jenis..'));
		$('#jenis').val('Pilih Jenis..').change();

		if (kategori == 'PRODUKSI' || kategori == 'PROOF') {
			jenis.options[jenis.options.length] = new Option('BB - BAHAN BAKU');
			jenis.options[jenis.options.length] = new Option('BP - BAHAN PEMBANTU');
			jenis.options[jenis.options.length] = new Option('LL - OTHER');
			jenis.options[jenis.options.length] = new Option('WIP - BAHAN WIP');
		} else if (kategori == 'NON PRODUKSI') {
			jenis.options[jenis.options.length] = new Option('SP - SPARE PART');
			jenis.options[jenis.options.length] = new Option('GA - GENERAL AFFAIR');
			jenis.options[jenis.options.length] = new Option('JS - JASA');
			jenis.options[jenis.options.length] = new Option('IT - TEKNOLOGI INFORMASI');
			jenis.options[jenis.options.length] = new Option('BN - BAHAN BANGUNAN');
			jenis.options[jenis.options.length] = new Option('LL - OTHER');
		}
	}

	$('#kategori').on('change', function() {
		$("#jenis").removeAttr('disabled');
	});

// Pilih Jenis dan Isi Kode Material
	$('#jenis').on('change', function() {
		var kategori = $('#kategori').val();
		var jenis = $('#jenis').val();
		var kd_jenis = (jenis.substring(0, 3)).trim();
		if((kd_jenis!='BB') && jenis != 'Pilih Jenis..')
		{
			$("#nama_material").removeAttr('disabled');
			$("#spesifikasi").removeAttr('disabled');
			$("#tahun").removeAttr('disabled');
			$("#satuan").removeAttr('disabled');
			$("#qc_test").removeAttr('disabled');
			$("#min_stok").removeAttr('disabled');
			$("#deskripsi").removeAttr('disabled');
			$("#btn_tambah").hide(); 
		}
		else if ((kd_jenis =='BB') && jenis != 'Pilih Jenis..')
		{
			$("#nama_material").attr('disabled','disabled');
			
			$("#spesifikasi").removeAttr('disabled');
			$("#tahun").removeAttr('disabled');
			$("#satuan").removeAttr('disabled');
			$("#qc_test").removeAttr('disabled');
			$("#min_stok").removeAttr('disabled');
			$("#deskripsi").removeAttr('disabled');
			$("#btn_tambah").show(); 
		}

		if (kategori == '' || jenis == 'Pilih Jenis..') {
			$('#kode').val('');
			return;
		}
		$.ajax({
			data: {data: kd_jenis},
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/pembelian/material/auto_no',
			success: function(data) {
				document.getElementById('kode').value = kd_jenis + data;
			}
		});
	});

	// Pilih Nama Barang
	function pilih_nama_sakti(btn) {
		var tbl_sakti = document.getElementById('tbl_nama_sakti');
		var row = $(btn).closest("tr").index() + 1;
		var kode = tbl_sakti.rows[row].cells[2].innerHTML;
		var jenis = tbl_sakti.rows[row].cells[3].innerHTML;
		var nama = tbl_sakti.rows[row].cells[4].innerHTML;
		

		$('#nama_material').val(nama).change();
		$('#kode_barang_sakti').val(kode).change();
		

		$('#btnTutupNamaSakti').click();
	}

// Pagination
	function pagination() {
		data_table = $('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"order": [[1, "asc"]],
			"autoWidth": true,
			"scrollX": true,
			"scrollY": '400px',
			"dom": 'frtipB',
			"buttons": [{
				text: 'Export Excel',
				extend: 'excel',
				exportOptions: {columns: ':visible'},
				className: 'invisible excel',
				title: 'Laporan Data Material'
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

	// Pagination Kode Barang Sakti
	function pagination_kode_barang_sakti() {
		$('#tbl_nama_sakti').DataTable().destroy();
		var tbl_nama_sakti = $('#tbl_nama_sakti').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"info": false,
			"ordering": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px",
			"colReorder": true
		});

		setTimeout(function() {tbl_nama_sakti.columns.adjust().draw();}, 500);
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

// Tampilkan error isian
	function error_isian(str) {
		$('#keterangan_isian').html(str);
		$('#btnIsian').click();
		throw new Error("Isian salah..");
	}

// Cek Dobel Nama
	function cek_barang(nama, spesifikasi) {
		var data = [nama, spesifikasi];

		$.ajax({
			async: false,
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/pembelian/material/cek_barang',
			data: {data: data},
			success: function(data) {
				if (data != 0) {error_isian('Nama Material sudah ada..');}
			}
		});
	}

// Simpan Data
	function simpan() {
		var kode = document.getElementById("kode").value;
		var nama_material = document.getElementById("nama_material").value;
		var spesifikasi = document.getElementById("spesifikasi").value;
		var satuan = document.getElementById("satuan").value;
		var min_stok = document.getElementById("min_stok").value;
		var kategori = document.getElementById("kategori").value;
		var jenis = document.getElementById("jenis").value;
		var tahun = document.getElementById("tahun").value;
		var qc_test = document.getElementById("qc_test").value;
		var deskripsi = document.getElementById("deskripsi").value;
		var kode_barang_sakti = document.getElementById("kode_barang_sakti").value;
		var data = [kode, nama_material, spesifikasi, satuan, min_stok, kategori, jenis, tahun, qc_test, deskripsi,kode_barang_sakti];

		if (kode == '') {error_isian('Kode Material belum diisi..');}
		if (nama_material == '') {error_isian('Nama Material belum diisi..');}
		if (spesifikasi == '') {error_isian('Spesifikasi belum diisi..');}
		if (satuan == '') {error_isian('Satuan belum diisi..');}
		if (min_stok == '') {error_isian('Minimal Stok belum diisi..');}
		if (kategori == '') {error_isian('Kategori belum diisi..');}
		if (jenis == 'Pilih Jenis..' || jenis == '') {error_isian('Jenis belum diisi..');}

		cek_barang(nama_material, spesifikasi);
		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/pembelian/material/simpan',
			data: {data: data},
			success: function(data) {
				setTimeout(function() {
					$('#btnOk_progress').click(); 
					$('#btnSukses').click();
				}, 500);
				kosong();
				filter();
			}
		});
	}

// Kosong Isian
	function kosong() {
		document.getElementById("kode").value = '';
		document.getElementById("nama_material").value = '';
		document.getElementById("spesifikasi").value = '';
		$('#satuan').val('').change();
		document.getElementById("min_stok").value = '0';
		$("#kategori").val('').change();
		$("#deskripsi").val('').change();
		$("#kode_barang_sakti").val('').change();
		$("#btn_tambah").hide(); 
		document.getElementById("tahun").value = new Date().getFullYear();
		$("#qc_test").val('Tidak').change();

		document.getElementById("nama_material").focus();

		id_edit = '';
	}

// Filter Data
	function filter() {
		var status = <?php echo json_encode($status); ?>;
		var kategori = document.getElementById("fkategori").value;
		var jenis = document.getElementById("fjenis").value;
		var cari = document.getElementById("cari").value;
		var approved = document.getElementById('fApproved').checked;
		var i_user = document.getElementById("fUser").selectedIndex - 1;
		var karyawan = <?php echo json_encode($karyawan->result_array()); ?>;
		i_user == -1 ? id_user = 'All' : id_user = karyawan[i_user].ID;
		var data = [kategori, jenis, cari, approved, id_user, status];
		
		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				async: false,
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/pembelian/material/filter',
				data: {data: data},
				success: function(data) {
					setTimeout(function() {$('#btnOk_progress').click();}, 500);

					$('.data-table').html(data);
					pagination();
				}
			});
		}, 500);
	}

// Hapus Data
	function hapus(btn) {
		var table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var id_hapus = table.rows[row].cells[0].innerHTML;

		$('#btnHapus').click();
		$('#ya').on('click', function() {
			$('#btnProgress').click();
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/pembelian/material/hapus',
				data: {data: id_hapus},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk_progress').click();
						$('#btnSukses').click();
					}, 500);

					kosong();
					filter();
					return;
				}
			});
		});
	}

// Drag Div Document
	$("#modal-jurnal").draggable({
		handle: ".card-header"
	});

	$("#modal_kode_sakti").draggable({
		handle: ".card-header"
	});

// Edit Data
	function approve(btn) {
		var table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var nama = table.rows[row].cells[4].innerHTML;
		var spesifikasi = table.rows[row].cells[5].innerHTML;
		var satuan = table.rows[row].cells[8].innerHTML;
		var kategori = table.rows[row].cells[10].innerHTML;
		var jenis = table.rows[row].cells[11].innerHTML;
		var rek_jurnal = table.rows[row].cells[3].innerHTML.replace('&amp;','&');
		var minstok = table.rows[row].cells[9].innerHTML;
		var deskripsi = table.rows[row].cells[14].innerHTML;
		var kode_sakti = table.rows[row].cells[16].innerHTML.replace('&amp;','&');
		var status = <?php echo json_encode($status); ?>;

		id_edit = table.rows[row].cells[0].innerHTML;
		$('#e_nama').val(nama).change();
		$('#e_spesifikasi').val(spesifikasi).change();
		$('#e_satuan').val(satuan).change();
		$('#e_kategori').val(kategori).change();
		$('#e_jenis').val(jenis).change();
		$('#e_minstok').val(minstok).change();
		$('#e_jurnal').val(rek_jurnal).change();
		$('#id_barang_sakti').val(kode_sakti).change();
		$('#e_simpg').val('').change();
		$('#e_deskripsi').val(deskripsi).change();

		$('#load_checked').prop("checked", false);
		$('.row_simpg').hide();

		if (rek_jurnal == '') {
			$('.row_check').show();
		} else {
			$('.row_check').hide();
		}

		if (status == '1') {
			$('.row_rekjurnal').hide();
			$('.row_check').hide();
			$('.row_simpg').hide();
		}
	}

	$('#load_checked').click(function() {
		var value = $('#load_checked').is(":checked");

		if (value == true) {
			$('.row_simpg').show();
		} else {
			$('.row_simpg').hide();
		}

	})

// Simpan Update
	function simpan_update() {
		var index = $("#e_jurnal")[0].selectedIndex - 1;
		var rekjurnal = (<?php echo json_encode($dt_rekjurnal); ?>)[index];
		var index = $("#e_simpg")[0].selectedIndex - 1;
		var kode_simpg = <?php echo json_encode($dt_kode_simpg); ?>[index];
		var index = $("#id_barang_sakti")[0].selectedIndex - 1;
		var id_barang_sakti = (<?php echo json_encode($dt_barang_sakti); ?>)[index];
		var status = <?php echo json_encode($status); ?>;
		var value = $('#load_checked').is(":checked");
		var new_data = $('#fApproved').is(":checked");
		var jenis = $('#e_jenis').val();
		var satuan = $('#e_satuan').val();
		var nama = $('#e_nama').val();
		var spesifikasi = $('#e_spesifikasi').val();
		var min_stok = $('#e_minstok').val();
		var deskripsi = $('#e_deskripsi').val();


		if (rekjurnal == undefined) {rekjurnal = '';}
		if (id_barang_sakti == undefined) {id_barang_sakti = '';}
		if (value == false) {kode_simpg = '';}
		if(jenis == 'BB - BAHAN BAKU')
		{
			if (id_barang_sakti == '') {error_isian('Harap isi nama barang sakti..');}
		}
		if (status != 1) {
			if (rekjurnal == '') {error_isian('Data belum lengkap..');}
		}else{
			if (nama == '' || spesifikasi == '') {error_isian('Data belum lengkap..');}
		}

		var data = [id_edit, rekjurnal.trim(), jenis, satuan, nama, spesifikasi, kode_simpg, min_stok, status, deskripsi, new_data,id_barang_sakti];

		$('#btnProgress').click();
		setTimeout(function() {
			$.ajax({
				type: 'POST',
				url: '<?php echo base_url(); ?>index.php/pembelian/material/simpan_update',
				data: {data: data},
				success: function(data) {
					setTimeout(function() {
						$('#btnOk_progress').click(); 
						$('#btnSukses').click();
						filter();
					}, 500);

					$('#load_checked').prop("checked", false);
					$('#e_simpg').val('Pilih Barang SIMPG..').change();
					kosong();
				},
				error: function(e) {
					setTimeout(function() {
						$('#btnOk_progress').click();
						error_isian(e.responseText);
					}, 500);
				}
			});
		}, 500);
	}

</script>