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
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} @media print { @page {size: landscape;} html, body {width: 320mm;height: 210mm;} #pr_body td, #pr_bahan td, #pr_downtime td {height: 20px; vertical-align: middle; padding-left: 5px;}}</style>

<div id="non_printable" class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">
							<div id="headerinput">Input Proses Produksi PET</div>
						</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Produksi - Manual Book Produksi PET.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
					<button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus info_1"></i>
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
								<th width="40%">Desain</th>
								<td>
									<select class="select" id="desain" style="width: 100%;" onchange="$('#nama_mesin').change()">
										<?php foreach ($desain->result_array() as $dt) { ?>
											<option><?php echo $dt['DESAIN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Bahan</th>
								<td>
									<select class="select" id="kode_flow" name="" style="width: 100%;" onchange="isi_proses()">
										<?php foreach ($kode_flow->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['DESKRIPSI']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tanggal" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-1 days')) ?>" style="background-color: white; cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Proses</th>
								<td>
									<select class="select" id="proses" name="" onchange="isi_next_proses()" style="width: 100%;">
										<option value="">Pilih..</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Next Proses</th>
								<td>
									<input type="text" id="next_proses" name="" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Nama Mesin</th>
								<td>
									<select class="select" id="nama_mesin" style="width: 100%;">
										<option value="">Pilih..</option>
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
								<th width="40%">Seri</th>
								<td width="60%">
									<input type="text" id="seri" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Shift</th>
								<td>
									<select class="select" id="shift" style="width: 100%;" onchange="pilih_operator()">
										<option value="">Pilih..</option>
										<option>A</option>
										<option>B</option>
										<option>C</option>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Pengawas</th>
								<td>
									<select class="form-control select" id="pengawas" style="width: 100%; cursor: pointer;">
										<option value="">Pilih..</option>
										<?php foreach ($pengawas->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
										<?php } ?>
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
								<th>Keterangan</th>
								<td>
									<input type="text" id="keterangan" class="form-control" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th class="kode_belah" hidden>Kode Gabung</th>
								<td class="kode_belah" hidden>
									<input type="text" id="kode_belah" class="form-control" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card card-body m-2" style="font-weight: bold;">
				<div class="row">
					<div class="col-8">
						<button type="button" class="btn btn-block text-white text-bold" id="btn_add" style="width: 120px; margin-bottom: 10px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Data</b></button>
					</div>
					<div class="col-4 text-right ops_gabung" hidden>
						<input type="checkbox" id="gabung" style="cursor: pointer;"><b>&nbsp Gabung Roll &nbsp &nbsp</b>
						<input type="checkbox" id="pecah" style="cursor: pointer;" hidden><b hidden>&nbsp Pecah Roll</b>
					</div>
				</div>
				<div class="table-responsive">
					<div style="width: 1400px;">
						<table id="tabel_roll" class="table table-bordered" width="100%">
							<thead style="background-color: #3FB4F7; color: #fff;">
								<tr style="text-align: center;">
									<td hidden>ID Detail Terima</td>
									<td width="5%">No.</td>
									<td width="7.5%">Nomor KK</td>
									<td width="10%">Mulai</td>
									<td width="10%">Selesai</td>
									<td width="10%">Kode Roll</td>
									<td width="10%">Panjang</td>
									<td width="10%">Hasil</td>
									<td width="7.5%">Reject</td>
									<td width="10%">Sisa</td>
									<td width="7.5%">Qty Roll</td>
									<td width="7.5%">Total</td>
									<td width="7.5%">Alu Wire<br>(Gr)</td>
									<td>Hapus</td>
								</tr>
							</thead>
							<tbody></tbody>
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
						<font color="White">Data Produksi PET</font>
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
						<div class="table-responsive">
							<table style="width: 1300px; font-size: 13px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="20%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<th width="7.5%" class="filter">Desain</th>
										<td></td>
										<th width="20%" class="filter">KK</th>
										<td></td>
										<th width="12.5%" class="filter">Proses</th>
										<td></td>
										<th width="10%" class="filter">Seri</th>
										<td></td>
										<th width="12.5%" class="filter">Flow</th>
										<td></td>
										<th width="17.5%" class="filter">Kode Roll</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fDesain" onchange="filter()" style="width: 100%;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKk" onchange="filter()" style="width: 100%;">
												<option value="All">Pilih KK..</option>
												<?php foreach ($kk->result_array() as $dt) { ?>
													<option><?php echo $dt['KK']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fProses" onchange="filter()" style="width: 100%;">
												<?php foreach ($proses->result_array() as $dt) { ?>
													<?php if ($dt['NEXT_PROSES'] != null) { ?>
														<option><?php echo $dt['PROSES']; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fSeri" onchange="filter()" style="width: 100%;">
												<option>All..</option>
												<?php foreach ($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKode_flow" style="width: 100%;" onchange="filter()">
												<?php foreach ($kode_flow->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['DESKRIPSI']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="f_kode_roll" onchange="filter()" class="form-control" style="width: 100%;" placeholder="Cari kode roll.." autocomplete="off">
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="data-table table-responsive mt-3" style="font-size: 13px;"></div>

						<button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

					</div>
				</div>
			</div>
			<!-- <div class="card-footer">
				<font color="Green" size="2">ERP @2019</font>
			</div> -->
		</div>

		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Data Produksi PET Pita</font>
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
						<div class="table-responsive">
							<table style="width: 1300px; font-size: 13px;">
								<thead>
									<tr align="center" style="line-height: 30px;">
										<th width="20%" colspan="2" class="filter">Filter Tanggal</th>
										<td></td>
										<th width="7.5%" class="filter">Desain</th>
										<td></td>
										<th width="20%" class="filter">KK</th>
										<td></td>
										<th width="12.5%" class="filter">Proses</th>
										<td></td>
										<th width="10%" class="filter">Seri</th>
										<td></td>
										<th width="12.5%" class="filter">Flow</th>
										<td></td>
										<th width="17.5%" class="filter">Kode Roll</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><input id="fTgl1_pita" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter2()" style="background-color: white; cursor: pointer;" readonly></td>
										<td><input id="fTgl2_pita" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter2()" style="background-color: white; cursor: pointer;" readonly></td>
										<td></td>
										<td>
											<select class="select" id="fDesain_pita" onchange="filter2()" style="width: 100%;">
												<?php foreach ($desain->result_array() as $dt) { ?>
													<option><?php echo $dt['DESAIN']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKk_pita" onchange="filter2()" style="width: 100%;">
												<option value="All">Pilih KK..</option>
												<?php foreach ($kk->result_array() as $dt) { ?>
													<option><?php echo $dt['KK']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fProses_pita" onchange="filter2()" style="width: 100%;">
												<?php foreach ($proses_pita->result_array() as $dt) { ?>
													<?php if ($dt['NEXT_PROSES'] != null) { ?>
														<option><?php echo $dt['PROSES']; ?></option>
													<?php } ?>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fSeri_pita" onchange="filter2()" style="width: 100%;">
												<option>All..</option>
												<?php foreach ($seri->result_array() as $dt) { ?>
													<option><?php echo $dt['SERI']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<select class="select" id="fKode_flow_pita" style="width: 100%;" onchange="filter2()">
												<?php foreach ($kode_flow->result_array() as $dt) { ?>
													<option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['DESKRIPSI']; ?></option>
												<?php } ?>
											</select>
										</td>
										<td></td>
										<td>
											<input type="text" id="f_kode_roll_pita" onchange="filter2()" class="form-control" style="width: 100%;" placeholder="Cari kode roll.." autocomplete="off">
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<div class="data-table2 table-responsive mt-3" style="font-size: 13px;"></div>

						<button style="width: 150px;" type="button" onclick="(function(){ $('.excel2').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

					</div>
				</div>
			</div>
			<div class="card-footer">
				<font color="Green" size="2">ERP @2019</font>
			</div>
		</div>

		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->
		<!-- Add Produksi Pita -->
	</section>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
			<div class="modal-footer" hidden>
				<button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
				<button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
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

<!-- Modal Pecah Roll -->
<div class="modal fade" id="modal_pecah">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header pt-3" style="background-color: #0A86BF; cursor: all-scroll; height: 65px;">
					<h3 class="card-title"><b><font color="White">Detail Roll</font></b></h3>
				</div>
			</div>
			<div class="card-body">
				<table id="tbl_input" class="table table-bordered" width="100%">
					<thead>
						<tr align="center">
							<th>No</th>
							<th>Kode Roll</th>
							<th>Panjang</th>
							<th>Hasil</th>
							<th>Waste</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button style="width: 120px;" type="button" class="btn btn-info" data-dismiss="modal"><i class="fa fa-save mr-2"></i><b style="font-size: 12px">Submit</b></button>
				<button id="tutup" style="width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b style="font-size: 12px">Keluar</b></button>
				<button id="btn_pecah" data-toggle="modal" data-target="#modal_pecah" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="modal_edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-info rounded m-2 text-center">
				<div class="card-header pt-3" style="background-color: #0A86BF; cursor: all-scroll; height: 65px; font-size: 24px;"><b>Edit Data Roll</b></div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr> 
						<th width="35%">Proses</th>
						<td>
							<input type="text" id="e_proses" class="form-control" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr> 
						<th>Kode Roll</th>
						<td>
							<input type="text" id="e_kode" name="" class="form-control" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Desain</th>
						<td>
							<input type="text" id="e_desain" class="form-control" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Tanggal</th>
						<td>
							<input type="text" id="e_tgl" class="form-control datepicker" style="background-color: white; cursor: pointer;" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Mesin</th>
						<td>
							<select class="select" id="e_mesin" onchange="isi_e_operator()" style="width: 100%;"></select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Shift</th>
						<td>
							<select class="select" id="e_shift" onchange="isi_e_operator()" style="width: 100%;">
								<option>A</option>
								<option>B</option>
								<option>C</option>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Pengawas</th>
						<td>
							<select class="form-control select" id="e_pengawas" style="width: 100%; cursor: pointer;">
								<option value="">Pilih..</option>
								<?php foreach ($pengawas->result_array() as $dt) { ?>
									<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Operator</th>
						<td>
							<select class="form-control select" id="e_operator" multiple="multiple" style="width: 100%; cursor: pointer;">
								<?php foreach ($operator->result_array() as $dt) { ?>
									<option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Mulai</th>
						<td>
							<input type="time" class="form-control" id="e_mulai">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Selesai</th>
						<td>
							<input type="time" class="form-control" id="e_selesai">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Panjang</th>
						<td>
							<input type="text" class="form-control" id="e_panjang" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Hasil</th>
						<td>
							<input type="text" class="form-control num" id="e_hasil" onkeyup="e_sisa()" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Reject</th>
						<td>
							<input type="text" class="form-control num" id="e_reject" onkeyup="e_sisa()" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Sisa</th>
						<td>
							<input type="text" id="e_sisa" class="form-control" readonly>
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
					<tr>
						<th>Alu Wire (Gr)</th>
						<td>
							<input type="text" class="form-control num" id="e_bahan" autocomplete="off">
						</td>
					</tr>
					<tr style="height: 10px;"></tr>
				</table>
			</div>
			<div class="modal-footer">
				<button style="width: 120px;" type="button" class="btn btn-info" onclick="simpan_edit()" data-dismiss="modal"><i class="fa fa-save mr-2"></i><b style="font-size: 12px">Simpan</b></button>
				<button id="tutup" style="width: 120px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b style="font-size: 12px">Keluar</b></button>
				<button id="btn_edit" data-toggle="modal" data-target="#modal_edit" data-backdrop="static" data-keyboard="false" hidden></button>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 12px;">
	<div style="width: 200px;  margin-bottom: -25px;">
		<img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 15mm; width: auto;">
	</div>

	<div id="emboss" class="div_print" hidden>
		<h4 id="judul" align="center" style="margin-top: -5mm;">LAPORAN PRODUKSI MESIN XXX</h4>
		<table id="pr_head" width="100%" style="line-height: 4mm;">
			<tr>
				<td width="10%">Mesin</td>
				<td width="3%">:</td>
				<td width="55%"></td>
				<td width="10%">No</td>
				<td width="3%">:</td>
				<td width="19%"></td>
			</tr>
			<tr>
				<td width="10%">Jenis</td>
				<td width="3%">:</td>
				<td width="50%"></td>
				<td width="10%">Tanggal</td>
				<td width="3%">:</td>
				<td width="24%"></td>
			</tr>
			<tr>
				<td width="10%">Seri/ KK</td>
				<td width="3%">:</td>
				<td width="50%"></td>
				<td width="10%">Hal</td>
				<td width="3%">:</td>
				<td width="24%">______ dari ______</td>
			</tr>
		</table>
		<table id="pr_body" class="table-bordered mt-1">
			<thead>
				<tr align="center">
					<td width="5%" rowspan="2">SHIFT</td>
					<td width="4%" rowspan="2">NO.</td>
					<td width="35%" colspan="4">BAHAN</td>
					<td width="10%">HASIL</td>
					<td width="15%" colspan="2">SISA</td>
					<td width="7.5%" rowspan="2">JAM PROSES PRODUKSI</td>
					<td rowspan="2">KETERANGAN DOWNTIME</td>
				</tr>
				<tr align="center">
					<td>KODE ROLL</td>
					<td>LEBAR (CM)</td>
					<td>TEBAL (MICRON)</td>
					<td>PANJANG (METER)</td>
					<td>HS. SHIFT (METER)</td>
					<td>BAIK (METER)</td>
					<td>RUSAK (METER)</td>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<tr class="text-center text-bold">
					<td colspan="6">Total</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</tfoot>
		</table>
		<div id="nmr_form" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-011 Rev. 01</div>
		<div class="input-group mt-1">
			<table id="pr_foot" class="table-bordered mt-1" width="45%">
				<tr align="center">
					<td width="100/3%" colspan="2">Shift A</td>
					<td width="100/3%" colspan="2">Shift B</td>
					<td width="100/3%" colspan="2">Shift C</td>
				</tr>
				<tr align="center">
					<td>Operator</td>
					<td>Pengawas</td>
					<td>Operator</td>
					<td>Pengawas</td>
					<td>Operator</td>
					<td>Pengawas</td>
				</tr>
				<tr align="center" style="height: 20mm; vertical-align: bottom;">
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
					<td> <div style="margin-bottom: -25px;"></div><br> ( ...................... ) </td>
				</tr>
			</table>
			<table id="pr_bahan" class="table-bordered ml-2" width="23%">
				<tr align="center">
					<td colspan="2">Penggunaan Bahan Medium</td>
				</tr>
				<tr>
					<td width="70%"></td>
					<td width="30%" align="center">______</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">______</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">______</td>
				</tr>
				<tr>
					<td></td>
					<td align="center">______</td>
				</tr>
			</table>
			<table id="pr_downtime" class="table-bordered ml-2" width="28%">
				<tr align="center">
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

	<div id="metalize" class="div_print" hidden>
		<h4 id="judul_m" align="center" style="margin-top: -5mm;">LAPORAN PRODUKSI MESIN XXX</h4>
		<table id="pr_head_m" width="100%" style="line-height: 4mm;">
			<tr>
				<td width="10%">Seri/ KK</td>
				<td width="3%">:</td>
				<td width="55%"></td>
				<td width="10%">No</td>
				<td width="3%">:</td>
				<td></td>
			</tr>
			<tr>
				<td width="10%">Jenis Bahan</td>
				<td width="3%">:</td>
				<td width="50%"></td>
				<td width="10%">Hari/ Tanggal</td>
				<td width="3%">:</td>
				<td></td>
			</tr>
			<tr>
				<td width="10%">Lebar/ Gramature</td>
				<td width="3%">:</td>
				<td width="50%"></td>
				<td width="10%">Halaman</td>
				<td width="3%">:</td>
				<td>______ dari ______</td>
			</tr>
		</table>
		<table id="pr_body_m" class="table-bordered mt-1" width="100%">
			<thead>
				<tr align="center">
					<td width="5%" rowspan="2">SHIFT</td>
					<td width="4%" rowspan="2">NO.</td>
					<td width="18%" colspan="2">BAHAN (MTR)</td>
					<td width="27.5%" colspan="3">PROSES PRODUKSI (MTR)</td>
					<td width="7.5%" rowspan="2">OD<br>REAL</td>
					<td width="7.5%" rowspan="2">ALUWIRE<br>(Gr)</td>
					<td rowspan="2" width="8%">JAM PROSES PRODUKSI</td>
					<td rowspan="2">KETERANGAN DOWNTIME</td>
				</tr>
				<tr align="center">
					<td>KODE</td>
					<td>PANJANG</td>
					<td>HASIL</td>
					<td>RUSAK</td>
					<td>SISA</td>
				</tr>
			</thead>
			<tbody></tbody>
			<tfoot>
				<tr class="text-center text-bold">
					<td colspan="4">Total</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="2"></td>
				</tr>
			</tfoot>
		</table>
		<div id="nmr_form_m" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-011 Rev. 01</div>
		<div class="input-group mt-1">
			<table id="pr_foot_m" class="table-bordered mt-1 mr-5" width="50%">
				<tr align="center">
					<td width="40%" colspan="2">Shift A</td>
					<td width="40%" colspan="2">Shift B</td>
					<td rowspan="2">Verifikasi</td>
				</tr>
				<tr align="center">
					<td>Operator</td>
					<td>Pengawas</td>
					<td>Operator</td>
					<td>Pengawas</td>
				</tr>
				<tr style="height: 20mm;">
					<td>
						<div style="height: 80px; vertical-align: bottom; ">
							<div class="opr" style="height: 60px;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
					<td>
						<div style="height: 80px;">
							<div class="pengawas_A" style="height: 60px; padding-top: 50px; text-align: center;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
					<td>
						<div style="height: 80px;">
							<div class="opr" style="height: 60px;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
					<td>
						<div style="height: 80px;">
							<div class="pengawas_B" style="height: 60px; padding-top: 50px; text-align: center;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
					<td style="vertical-align: bottom;"> <div style="margin-bottom: -25px;"></div><br> ( .....Ulil Albab A..... ) </td>
				</tr>
			</table>
			<table id="pr_downtime_m" class="table-bordered ml-2" width="30%">
				<tr align="center">
					<td colspan="2"><u>Kategori Jam Berhenti :</u></td>
				</tr>
				<tr>
					<td>A = Persiapan Mesin</td>
					<td>F = Ganti Silinder/ Seri</td>
				</tr>
				<tr>
					<td>B = Trouble Proses Produksi</td>
					<td>G = Force Major/ Special Case</td>
				</tr>
				<tr>
					<td>C = Trouble Mesin</td>
					<td>H = Lain-Lain</td>
				</tr>
				<tr>
					<td>D = Tunggu Bahan/ Medium</td>
					<td>I = Proses Vacuum</td>
				</tr>
				<tr>
					<td>E = Tunggu Core</td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>

	<div id="belah" class="div_print" hidden>
		<h4 align="center" style="margin-top: -5mm;">LAPORAN PRODUKSI MESIN SLITTER</h4>
		<h4 id="judul_b" align="center" style="margin-top: -3mm;">PROSES RAJANG PITA</h4>
		<table id="pr_head_b" width="100%" style="line-height: 4mm;">
			<tr>
				<td width="10%">Mesin / Shift</td>
				<td width="3%">:</td>
				<td width="55%"></td>
				<td width="10%">No</td>
				<td width="3%">:</td>
				<td></td>
			</tr>
			<tr>
				<td width="10%">Foil BCRI TA</td>
				<td width="3%">:</td>
				<td width="50%"></td>
				<td width="10%">Tanggal</td>
				<td width="3%">:</td>
				<td></td>
			</tr>
		</table>
		<table id="pr_body_b" class="table-bordered mt-1" width="100%">
			<thead>
				<tr align="center">
					<td rowspan="2">NO.</td>
					<td colspan="6">BAHAN</td>
					<td colspan="3">HASIL</td>
					<td rowspan="2">TOTAL UK.<br>PITA</td>
					<td colspan="2">SISA</td>
					<td rowspan="2">JAM PROSES PRODUKSI</td>
					<td rowspan="2">KETERANGAN DOWNTIME</td>
				</tr>
				<tr align="center">
					<td>KODE ROLL</td>
					<td>LEBAR (CM)</td>
					<td>SERI</td>
					<td>KJ</td>
					<td>KK</td>
					<td>PANJANG<br>(METER)</td>
					<td>PANJANG<br>(METER)</td>
					<td>LEBAR<br>(CM)</td>
					<td>JUMLAH<br>(ROLL)</td>
					<td>BAIK<br>(METER)</td>
					<td>WASTE<br>(METER)</td>
				</tr>
			</thead>
			<tbody class="tbl_isi"></tbody>
			<tfoot>
				<tr class="text-center text-bold">
					<td colspan="7">Total</td>
					<td></td>
					<td colspan="2"></td>
					<td></td>
					<td></td>
					<td></td>
					<td colspan="2"></td>
				</tr>
			</tfoot>
		</table>
		<div id="nmr_form_b" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-014 Rev. 00</div>
		<div class="input-group mt-1">
			<table id="pr_foot_b" class="table-bordered mt-1 mr-5" width="20%">
				<tr align="center">
					<td width="50%">Operator</td>
					<td width="50%">Pengawas</td>
				</tr>

				<tr style="height: 20mm;">
					<td>
						<div style="height: 80px;">
							<div class="opr" style="height: 60px;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
					<td>
						<div style="height: 80px;">
							<div class="pengawas" style="height: 60px; padding-top: 50px; text-align: center;"></div>
							<div align="center" style="height: 10px;">( ...................... ) </div>
						</div>
					</td>
				</tr>
			</table>
			<table class="table-bordered tbl_isi" width="30%">
				<tr align="center">
					<td colspan="3"><u>Kategori Jenis (KJ)</u></td>
				</tr>
				<tr>
					<td>RW</td>
					<td>:</td>
					<td>Rewind</td>
				</tr>
				<tr>
					<td>HSF</td>
					<td>:</td>
					<td>Hot Stamping Foil (Belah)</td>
				</tr>
				<tr>
					<td>HSF.1</td>
					<td>:</td>
					<td>Hot Stamping Foil Seri 1 (Pita)</td>
				</tr>
				<tr>
					<td>HSF.3</td>
					<td>:</td>
					<td>Hot Stamping Foil Seri 3 & 2 (Pita)</td>
				</tr>
				<tr>
					<td>HSF.M</td>
					<td>:</td>
					<td>Hot Stamping MMEA (Pita)</td>
				</tr>
			</table>
			<table id="pr_downtime_b" class="table-bordered tbl_isi" width="30%">
				<tr align="center">
					<td colspan="2"><u>Kategori Jam Berhenti</u></td>
				</tr>
				<tr>
					<td>A = Persiapan Mesin</td>
					<td>F = Ganti Silinder/ Seri</td>
				</tr>
				<tr>
					<td>B = Trouble Proses Produksi</td>
					<td>G = Force Major/ Special Case</td>
				</tr>
				<tr>
					<td>C = Trouble Mesin</td>
					<td>H = Lain-Lain</td>
				</tr>
				<tr>
					<td>D = Tunggu Bahan/ Medium</td>
					<td>I = Proses Vacuum</td>
				</tr>
				<tr>
					<td>E = Tunggu Core</td>
					<td></td>
				</tr>
			</table>
		</div>
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

// Load Dokumen
	$(document).ready(function() {
		if ($(window).width() > 960) {$('.fa-bars:eq(0)').click();}

		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy', changeMonth: true});

		isi_proses();
		filter();
	});

// Isi Proses Berdasarkan Flow
	function isi_proses() {
		var kode_flow = $('#kode_flow').val();
		var list_proses = [];

		$("#proses").empty();
		$("#proses").append('<option value="">Pilih..</option>');
		$('#proses').val('').change();
		$('#next_proses').val('').change();

		if (kode_flow == '') {return;}
		$.ajax({
			async: false,
			data: {data: kode_flow},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/pet/isi_proses" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					if (data[i].NEXT_PROSES != null) {$("#proses").append('<option>'+data[i].PROSES+'</option>');}
					list_proses.push(data[i].PROSES);
				}
				$('#next_proses').attr('name', list_proses);
			}
		});
	}

// Isi Next Proses Berdasarkan Proses
	function isi_next_proses() {
		var proses = $('#proses').val();
		var list_proses = proses != '' ? $('#next_proses').attr('name').split(',') : [];

		for (var i=0; i<list_proses.length; i++) {
			if (proses == list_proses[i]) {$('#next_proses').val(list_proses[i+1]).change();}
		}

		if (proses == 'Belah' || proses == 'Pita') {
			$('.ops_gabung').removeAttr('hidden');
		}else{
			$('.ops_gabung').attr('hidden', '');
		}
	}

// Pilih Gabung Kode Roll
	$('#gabung').click(function() {
		var gabung = document.getElementById('gabung').checked;

		if (gabung == true) {
			$('.kode_belah').removeAttr('hidden');
		}else{
			$('.kode_belah').attr('hidden', '');
		}

		isi_kode_belah();
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
				title: 'Laporan Data Produksi PET'
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
	}

	function pagination2() {
		$('#data-table2').DataTable().destroy();
		var data_table = $('#data-table2').DataTable({
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
				className: 'invisible excel2',
				title: 'Laporan Data Produksi PET Pita'
			}],
			"colReorder": true
		});

		setTimeout(function() {data_table.columns.adjust().draw();}, 1500);
	}

// Filter Data
	function filter() {
		var tgl1 = document.getElementById('fTgl1').value;
		var tgl2 = document.getElementById('fTgl2').value;
		var proses = document.getElementById('fProses').value;
		var kode_roll = document.getElementById('f_kode_roll').value;
		var kk = $('#fKk').val();
		var desain = $('#fDesain').val();
		var seri = $('#fSeri').val();
		var kode_flow = $('#fKode_flow').val();
		var data = [tgl1, tgl2, proses, kode_roll, kk, desain, seri, kode_flow];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/pet/filter" ?>',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					pagination();
				}, 500);

				$('.data-table').html(data);
				if (proses != 'Metalize' && proses != 'Emboss') {
					$('#data-table thead th:eq(17), #data-table td:nth-child(18), #data-table tfoot td:eq(4)').hide();
				}else{
					if (proses == 'Emboss') {$('#data-table thead th:eq(17)').html('PCH');					}
					$('#data-table thead th:eq(17), #data-table td:nth-child(18), #data-table tfoot td:eq(4)').show();
				}
			}
		});
	}

	function filter2() {
		var tgl1 = document.getElementById('fTgl1_pita').value;
		var tgl2 = document.getElementById('fTgl2_pita').value;
		var proses = document.getElementById('fProses_pita').value;
		var kode_roll = document.getElementById('f_kode_roll_pita').value;
		var kk = $('#fKk_pita').val();
		var desain = $('#fDesain_pita').val();
		var seri = $('#fSeri_pita').val();
		var kode_flow = $('#fKode_flow_pita').val();
		var data = [tgl1, tgl2, proses, kode_roll, kk, desain, seri, kode_flow];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/pet/filter2" ?>',
			success: function(data) {
				setTimeout(function() {
					$('#btnOk').click();
					pagination2();
				}, 500);

				$('.data-table2').html(data);
				if (proses != 'Metalize') {
					$('#data-table2 thead th:eq(17), #data-table td:nth-child(18), #data-table tfoot td:eq(4)').hide();
				}else{
					$('#data-table2 thead th:eq(17), #data-table td:nth-child(18), #data-table tfoot td:eq(4)').show();					
				}
			}
		});
	}

// Kosong Isian
	function kosong() {
		$('#kode_flow').attr('name', '');
		$('#proses').val('').change();
		$('#proses').attr('name', '');
		$('#shift').val('').change();
		$('#keterangan').val('').change();
		$('#gabung').prop('checked', false);
		$('.kode_belah').attr('hidden', '');

		kosong_isian();
	}

// Kosongkan Tabel Isian
	function kosong_isian() {
		$('#seri').val('');
		$('#operator').val('').change();
		$('#kode_belah').val('');
		$('#tabel_roll tbody tr').remove();
		$('#tabel_roll td:nth-child(11), #tabel_roll td:nth-child(12), #tabel_roll td:nth-child(13)').show();
	}

// Get Mesin
	$('#proses').on('change', function() {
		var proses = document.getElementById('proses').value;
		var nama_mesin = document.getElementById('nama_mesin');
		var dt_mesin = <?php echo json_encode($mesin->result_array()); ?>;

		$("#nama_mesin").empty();
		$("#nama_mesin").append('<option value="">Pilih Mesin..</option>');
		$('#nama_mesin').val('').change();

		for (var i = 0; i < dt_mesin.length; i++) {
			if (proses == dt_mesin[i].PROSES) {
				$("#nama_mesin").append('<option>'+dt_mesin[i].NAMA_MESIN+'</option>');
			}
		}
	});

// Get Operator
	function pilih_operator() {
		var proses = $('#proses').val();
		var nama_mesin = $('#nama_mesin').val();
		var shift = $('#shift').val();
		var operator = [];
		var data = [proses, nama_mesin, shift];

		$('#operator').val('').change();
		if (proses == '' || nama_mesin == '' || shift == '') {return;}

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/produksi/pet/get_operator" ?>',
			success: function(data) {
				data = JSON.parse(data);

				for (var i=0; i<data.length; i++) {
					operator.push(data[i].ID_OPERATOR);
				}
				$('#operator').val(operator).change();
			}
		});
	}

// Ambil Data Roll
	$('#nama_mesin').change(function() {
		var desain = $('#desain').val();
		var proses = $('#proses').val();
		var nama_mesin = $('#nama_mesin').val();
		var kode_flow = $('#kode_flow').val();
		var data = [proses, kode_flow, desain];

		kosong_isian();
		pilih_operator();
		if (nama_mesin != '') {
			$('#btnProgress').click();
			$.ajax({
				data: {data: data},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/produksi/pet/get_roll" ?>',
				success: function(data) {
					console.log(JSON.parse(data));
					$('#kode_flow').attr('name', data);
					setTimeout(function() {$('#btnOk').click();}, 500);
				}
			});
		}
	});

// Tambah Data Roll
	$('#btn_add').on('click', function() {
		var tabel_roll = document.getElementById('tabel_roll');
		var data_roll = $('#kode_flow').attr('name') == '' ? [] : JSON.parse($('#kode_flow').attr('name'));
		var proses = $('#proses').val();
		var nama_mesin = $('#nama_mesin').val();
		var gabung = document.getElementById('gabung').checked;

		if (proses == '') {error_isian('Nama Proses belum diisi..'); return;}
		if (nama_mesin == '') {error_isian('Nama Mesin belum diisi..'); return;}
		if (data_roll.length == 0) {error_isian('Data Mutasi tidak ada..'); return;}

		// Roll Gabungan maksimal 4 roll
		if (gabung == true && tabel_roll.rows.length > 4) {error_isian('Gabungan maksimal 4 roll..'); return;}

		// Isi Tabel Roll
		$('#tabel_roll tbody').append(
			'<tr>' +
			'<td hidden></td>' +
			'<td><input type="text" class="form-control" name="nmr" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control" name="kk" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="time" class="form-control" name="mulai" value="07:00" placeholder="Isikan jam.." style="width: 100%; text-align: center;"></td>' +
			'<td><input type="time" class="form-control" name="selesai" value="07:00" placeholder="Isikan jam.." style="width: 100%; text-align: center;"></td>' +
			'<td><div style="width: 240px;"><select class="form-control select" style="width: 100%;" name="kode_roll" onchange="isi_kk(this)">' +
			'<option value="">Pilih..</option> ' +
			'</select></div></td>' +
			'<td><input type="text" class="form-control" name="panjang" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control num" name="hasil" onkeyup="isi_sisa(this)" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
			'<td style="color: #000000;"><input type="text" class="form-control" name="reject" onkeyup="isi_sisa(this)" style="width: 100%; text-align: center;" autocomplete="off"><input class="teller" type="checkbox" name="teller" style="cursor: pointer;"><label class="teller">&nbsp teller</label></td>' +
			'<td><input type="text" class="form-control" name="sisa" style="width: 100%; text-align: center;" readonly><select class="form-control" style="width: 100%;" name="sisa_pita"><option value="0">Tidak</option><option value="1">Ya</option></select></td>' +
			'<td><input type="text" class="form-control num" name="qty_roll" onkeyup="isi_sisa(this)" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
			'<td><input type="text" class="form-control num" name="total" style="width: 100%; text-align: center;" autocomplete="off" readonly></td>' +
			'<td><input type="text" class="form-control num" name="bahan" style="width: 100%; text-align: center;" autocomplete="off"></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Roll" onclick="hapus_roll(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
			'</tr>');

		// Selisih Teller hanya di Emboss
		if (proses != 'Emboss') {
			$(".teller").attr('hidden', '');
		}
		if (proses == 'Pita') {
			$('[name="sisa"]').attr('hidden', '');
			$('[name="sisa_pita"]').removeAttr('hidden');
			$('[name="sisa_pita"]').select2({minimumResultsForSearch: -1});
		}else{
			$('[name="sisa_pita"]').attr('hidden', '');
			$('[name="sisa"]').removeAttr('hidden');
		}

		// Isi List Kode Roll
		data_roll.forEach(function(item, index) {
			rows = $('#tabel_roll tbody tr').length - 1;
			$('[name="kode_roll"]:eq('+rows+')').append('<option>'+item.KODE_ROLL+'</option>');
		});

		// Show or hide kolom yang dibutuhkan
		if (proses != 'Pita' && proses != 'Unwind') {
			$('#tabel_roll td:nth-child(11), #tabel_roll td:nth-child(12)').hide(); // Hide qty roll & total

			document.getElementsByName('qty_roll')[tabel_roll.rows.length-2].value = 1;
		}
		if (proses != 'Metalize' && proses != 'Emboss') {
			$('#tabel_roll td:nth-child(13)').hide(); // Hide Alu Wire
		}else{
			if (proses == 'Emboss') {$('#tabel_roll td:eq(12)').html('PCH');}
		}

		$('#tabel_roll td:nth-child(14)').css('width','3%'); // Lebar kolom hapus
		$('.select').select2();
		urut_roll();
		onlynumeric();
	});

// Isi Nomor Urut Roll
function urut_roll() {
	var qty_data = $('#tabel_roll tbody tr').length;

	for (var i=0; i<qty_data; i++) {
		document.getElementsByName('nmr')[i].value = i+1;
	}
}

// Hapus List Material
function hapus_roll(btn) {
	row = btn.parentNode.parentNode;
	row.parentNode.removeChild(row);
	urut_roll();
	isi_kode_belah();
};

// Isi Data Roll
function isi_kk(btn) {
	var data_roll = JSON.parse($('#kode_flow').attr('name'));
	var row = $(btn).closest("tr").index();	
	var index = btn.selectedIndex - 1;
	var kk = '', panjang = '', id_detail_terima = '', id_gudang_order = '', seri = '';

	if (index != -1) {
		id_gudang_order = data_roll[index].ID_GUDANG_ORDER;
		kk = data_roll[index].KK + ' - ' + data_roll[index].DESAIN + ' - ' + data_roll[index].SERI;
		panjang = desimal(data_roll[index].PANJANG);
		id_detail_terima = data_roll[index].ID_DETAIL_TERIMA;
	}

	$('#tabel_roll tbody tr:eq('+row+')').attr('name', id_gudang_order);
	$('#tabel_roll tbody tr:eq('+row+') td:eq(0)').html(id_detail_terima);
	document.getElementsByName('kk')[row].value = kk;
	document.getElementsByName('panjang')[row].value = format_number(panjang.toFixed(0));
	isi_sisa(btn);
	isi_seri();
}

// Isi Sisa Roll
function isi_sisa(btn) {
	var row = $(btn).closest("tr").index();
	var panjang = angka(document.getElementsByName('panjang')[row].value);
	var hasil = angka(document.getElementsByName('hasil')[row].value);
	var reject = angka(document.getElementsByName('reject')[row].value);
	var qty_roll = angka(document.getElementsByName('qty_roll')[row].value);

	document.getElementsByName('sisa')[row].value = format_number(panjang - hasil - reject);
	document.getElementsByName('total')[row].value = format_number(hasil * qty_roll);
	isi_kode_belah();
}

// Isi Seri berdasarkan Roll Pertama
function isi_seri() {
	var seri = $('[name="kk"]:eq(0)').val().split(' - ')[2];

	$('#seri').val(seri);
}

// Isi Kode Belah
function isi_kode_belah() {
	var desain = $('[name="kk"]:eq(0)').val().split(' - ')[1].substring(2, 4);
	var data_roll = JSON.parse($('#kode_flow').attr('name'));
	var kode = '', kode_roll_gabung = [];
	var hasil_belah = 0;
	var qty_data = $('#tabel_roll tbody tr').length;

	if (qty_data <= 0) {
		$('#seri').val('');
		$('#kode_belah').val('');
		return;
	}

	for (var i=0; i<qty_data; i++) {
		roll = document.getElementsByName('kode_roll')[i].value;
		hasil = angka(document.getElementsByName('hasil')[i].value);
		digit_roll = roll.split('-');
		qty_digit_roll = digit_roll[0].length;

		if (roll != '') {
			for (var j=0; j<qty_digit_roll; j++) {
				if (digit_roll[j] != '000' && digit_roll[j].length >= 3) {
					str = digit_roll[j];
					kode_roll_gabung.push(str.substring(str.length-3,str.length));
				}
			}
		}

		hasil_belah = hasil_belah + Number(hasil);
	}
	kode_roll_gabung = [...new Set(kode_roll_gabung)];
	for (var i=0; i<kode_roll_gabung.length; i++) {
		if (kode_roll_gabung.length < 4) {kode_roll_gabung.push('000');}
		t_kode = kode_roll_gabung[i];
		kode = kode + t_kode + '-';
	}

	$('#kode_belah').val(kode + desain + ' (' + Number(hasil_belah) + ')');
}

// Tampilkan error isian
function error_isian(str) {
	$('#keterangan_isian').html(str);
	$('#btnIsian').click();
	throw new Error("Isian salah..");
}

// Simpan Data
function simpan() {
	var desain = $('[name="kk"]:eq(0)').val().split(' - ')[1];
	var qty_data = $('#tabel_roll tbody tr').length;
	var gabung = document.getElementById('gabung').checked;
	var pecah = document.getElementById('pecah').checked;
	var proses = $('#proses').val();
	var next_proses = $('#next_proses').val();
	var nama_mesin = $('#nama_mesin').val();
	var shift = $('#shift').val();
	var pengawas = $('#pengawas').val();
	var operator = $('#operator').val();
	var tanggal = $('#tanggal').val();
	var keterangan = $('#keterangan').val();
	var kode_flow = $('#kode_flow').val();
	var kk = [], kode = [], mulai = [], selesai = [], panjang = [], hasil = [], reject = [], sisa = [], sisa_pita = [], teller = [], id_detail_terima = [], qty_roll = [], bahan = [];
	var kode_belah = ($('#kode_belah').val()).split(' ')[0];
	var id_gudang_order = $('#tabel_roll tbody tr:eq(0)').attr('name');
	var seri = $('#seri').val();
	var panjang_total = 0;

	if (proses == '') {error_isian('Proses belum diisi..');}
	if (nama_mesin == '') {error_isian('Nama Mesin belum diisi..');}
	if (shift == '') {error_isian('Shift belum diisi..');}
	if (pengawas == '') {error_isian('Pengawas belum diisi..');}
	if (operator == null) {error_isian('Operator belum diisi..');}
	if (qty_data == 0) {error_isian('Belum ada data roll yang dipilih..');}
	if ((qty_data < 2 && gabung == true) || (qty_data > 4 && gabung == true)) {error_isian('Fitur Gabung Roll hanya bisa untuk 2 sd 4 kode..');}

	for (var i=0; i<qty_data; i++) {
		t_kk = document.getElementsByName('kk')[i].value;
		t_kode = document.getElementsByName('kode_roll')[i].value;
		t_mulai = document.getElementsByName('mulai')[i].value;
		t_selesai = document.getElementsByName('selesai')[i].value;
		t_panjang = document.getElementsByName('panjang')[i].value;
		t_hasil = document.getElementsByName('hasil')[i].value;
		t_reject = document.getElementsByName('reject')[i].value;
		t_sisa = document.getElementsByName('sisa')[i].value;
		t_sisa_pita = document.getElementsByName('sisa_pita')[i].value;
		t_teller = document.getElementsByName('teller')[i].checked;
		t_qty_roll = document.getElementsByName('qty_roll')[i].value;
		t_bahan = document.getElementsByName('bahan')[i].value;
		t_id_detail_terima = $('#tabel_roll tbody tr:eq('+i+') td:eq(0)').html();
		start = cek_jam(proses, tanggal, t_mulai);
		end = cek_jam(proses, tanggal, t_selesai);
		panjang_total = panjang_total + Number(angka(t_hasil));

		if (seri == 'SERI I') {
			qty_pita = '50';
		}else if (seri == 'MMEA') {
			qty_pita = '58';
		}else{
			qty_pita ='70';
		}

		if (t_qty_roll == qty_pita && t_panjang == t_hasil) {t_sisa_pita = '0';}
		if (start >= end) {error_isian('Waktu mulai tidak boleh sama/ melebihi selesai..');}
		if (t_kode == '') {error_isian('Kode Roll belum diisi..');}
		if (t_panjang < 1) {error_isian('Panjang Roll salah..');}
		if (t_hasil == '') {error_isian('Hasil belum diisi..');}
		if (t_sisa < 0) {error_isian('Sisa Roll salah..');}
		if (t_qty_roll == '' || t_qty_roll == '0') {error_isian('Qty Roll salah..');}
		if (proses == 'Metalize' && t_bahan == '') {error_isian('Penggunaan Alu Wire belum diisi..');}

		kk.push(t_kk);
		mulai.push(t_mulai);
		selesai.push(t_selesai);
		panjang.push(angka(t_panjang));
		hasil.push(angka(t_hasil));
		reject.push(angka(t_reject));
		sisa.push(angka(t_sisa));
		sisa_pita.push(t_sisa_pita);
		teller.push(t_teller);
		kode.push(t_kode);
		qty_roll.push(t_qty_roll);
		bahan.push(t_bahan);
		id_detail_terima.push(t_id_detail_terima);
	}

	// KK harus sama
	kk = [...new Set(kk)];
	if (kk.length > 1) {error_isian('Nomor KK harus sama..');}

	// Cegah pilih roll ganda
	var row_ganda = [];
	for (var i=0; i<qty_data; i++) {
		row_ganda.push(document.getElementsByName('kode_roll')[i].value);
	}
	row_ganda = [...new Set(row_ganda)];
	if (row_ganda.length != qty_data) {error_isian('Kode Roll tidak boleh ganda..');}

	// Jika Pecah Roll, opsi masukin panjang per roll
	if (pecah == true) {
		if (qty_data > 1) {error_isian('Proses pecah roll hanya memperbolehkan 1 jumbo roll..');}
		pecah_roll(id_detail_terima);
	}

	var material = [kode, mulai, selesai, panjang, hasil, reject, sisa, teller, id_detail_terima, qty_roll, bahan, sisa_pita];
	var data = [tanggal, keterangan, proses, next_proses, kode_belah, panjang_total, gabung, id_gudang_order, kode_flow, material, desain, proses, nama_mesin, shift, operator, pengawas];

	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/pet/simpan',
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

// Isi Pecah Roll
function pecah_roll(id_prod_mutasi) {
	var qty_roll = $('[name="qty_roll"]:eq(0)').val();
	var id = id_prod_mutasi[0];

	$.ajax({
		async: false,
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/pet/ambil_roll_awal',
		data: {data: id},
		success: function(data) {
			data = JSON.parse(data);

			if (qty_roll != data.length) {error_isian('Qty roll tidak sesuai dengan qty awal..');}
			for (var i=0; i<data.length; i++) {
				kode = data[i].KODE_ROLL;
				panjang = data[i].QTY_TERIMA;

				$('#tbl_input tbody').append('<tr><td><input type="text" class="form-control" value="'+(i+1)+'" style="width: 100%; text-align:center;" readonly></td><td><input type="text" class="form-control" value="'+kode+'" style="width: 100%; text-align:center;" readonly></td><td><input type="text" class="form-control num" name="panjang" value="'+panjang+'" style="width: 100%; text-align: center;" readonly></td><td><input type="text" class="form-control num" name="hasil" value="'+panjang+'" onkeyup="isi_waste(this)" style="width: 100%; text-align: center;" autocomplete="off"></td><td><input type="text" class="form-control num" name="waste" value="0" style="width: 100%; text-align: center;" readonly></td></tr>');
			}

		}
	});

	$('#btn_pecah').click();
}

// Cek Format Tanggal dan Jam
function cek_jam(proses, tanggal, jam) {
	var year = tanggal.substring(9, 11);
	var date = tanggal.substring(0, 2);
	var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	var month = dt_month.indexOf(tanggal.substring(3, 6)) + 1;
	month = ("0" + month).slice(-2);

	var hour = jam.substring(0, 2);
	var minute = jam.substring(3, 5);
	var batas_shift = proses == 'Metalize' ? 530 : 630;

	if (Number(hour) + minute < batas_shift) {
		date++;
	}

	return year + month + date + hour + minute;
}

// Cetak Data
function cetak(btn) {
	var id_cetak = btn.name.split('@')[0];
	var proses = btn.name.split('@')[1];
	var data = [id_cetak, proses];

	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/pet/cetak',
		data: {data: data},
		success: function(data) {
			data = JSON.parse(data);

			$('.div_print').attr('hidden', '');
			if (proses == 'Metalize') {
				$('#metalize').removeAttr('hidden');
				cetak_metalize(data);
			}else if (proses == 'Belah' || proses == 'Pita') {
				$('#belah').removeAttr('hidden');
				cetak_belah(data);	
			}else{
				$('#emboss').removeAttr('hidden');
				cetak_emboss(data);	
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

// Kirim Cetak Metalize
function cetak_metalize(data) {
	dt_proses = data[0];
	dt_bahan = data[1];
	dt_pch = data[2];
	dt_downtime = data[3];
	dt_kk = data[4];
	query_log = data[5];
	dt_operator = data[7].OPERATOR == null ? '' : (data[7].OPERATOR).substring(0, (data[7].OPERATOR).length - 2).split(', ');

	if (dt_downtime.length == 0) {error_isian('Downtime Produksi belum diisi..');}

		// Isi Urut Log
	for (var i=0; i<query_log.length; i++) {
		if (query_log[i].TANGGAL == dt_proses[0].TANGGAL && query_log[i].NAMA_MESIN == dt_proses[0].NAMA_MESIN) {
			urut = i+1;
		}
	}

		// Isi Halaman
	page = 0; urut_kk = [];
	dt_kk.forEach(function(dt) {
		urut_kk.push(dt.ID_GUDANG_ORDER);
	});
	urut_kk = [...new Set(urut_kk)];
	urut_kk.forEach(function(dt) {
		page++;
		if (dt_proses[0].ID_GUDANG_ORDER == dt) {
			$('#pr_head_m tr:eq(2) td:eq(5)').html('__' + page + '__  of  __' + urut_kk.length + '__'); 
		}
	});

	proses = dt_proses[0].PROSES;
	kd_proses = 'MET';
	frm = 'F-SMT-METZ-001 Rev. 01';
	judul_bahan = 'Penggunaan Bahan Medium';
	bln = get_romawi(format_date(dt_proses[0].TANGGAL));
	hari = dt_proses[0].HARI;
	ukuran = dt_proses[0].UKURAN;

	$('#judul_m').html('LAPORAN HARIAN PRODUKSI METALIZE');
	$('#nmr_form_m').html(frm);
	$('#pr_head_m tr:eq(0) td:eq(2)').html(dt_proses[0].SERI + ' / ' + dt_proses[0].KETERANGAN_PENGGUNAAN);
	$('#pr_head_m tr:eq(1) td:eq(2)').html(dt_proses[0].NAMA + ' - ' + dt_proses[0].SPESIFIKASI);
	$('#pr_head_m tr:eq(2) td:eq(2)').html('__'+ukuran+' cm__/__12 micron__');
	$('#pr_head_m tr:eq(0) td:eq(5)').html(format_text(urut, 3) + '/PNP-HLG/' + kd_proses + '/' + bln + '/' + dt_proses[0].THN);
	$('#pr_head_m tr:eq(1) td:eq(5)').html(hari + ' / ' + format_date(dt_proses[0].TANGGAL).toUpperCase());

	$('#pr_body_m tbody tr').remove();
	t_hasil = 0, t_mutasi = 0, t_sisa = 0, t_rusak = 0, t_bahan = 0;
	for (var i=0; i<dt_proses.length; i++) {
		odo = '1.6 - 1.7';
		bahan = format_number(dt_proses[i].BAHAN.replace(',', '.'));

		$('#pr_body_m tbody').append('<tr><td align="center">'+dt_proses[i].SHIFT+'</td><td align="center">'+(i+1)+'</td><td align="center">'+dt_proses[i].KODE+'</td><td align="center">'+format_number(dt_proses[i].PANJANG)+'</td><td align="center">'+format_number(dt_proses[i].HASIL)+'</td><td align="center">'+dt_proses[i].REJECT+'</td><td align="center">'+format_number(dt_proses[i].SISA)+'</td><td align="center">'+odo+'</td><td align="center">'+bahan+'</td><td align="center">'+dt_proses[i].MULAI + ' - ' + dt_proses[i].SELESAI+'</td></tr>');

		t_hasil = t_hasil + Number(dt_proses[i].HASIL);
		t_sisa = t_sisa + Number(dt_proses[i].SISA);
		t_rusak = t_rusak + Number(dt_proses[i].REJECT);
		t_bahan = t_bahan + Number(dt_proses[i].BAHAN.replace(',', '.'));
	}
	$('#pr_body_m tfoot tr:eq(0) td:eq(1)').html(format_number(t_hasil));
	$('#pr_body_m tfoot tr:eq(0) td:eq(2)').html(format_number(t_rusak));
	$('#pr_body_m tfoot tr:eq(0) td:eq(3)').html(format_number(t_sisa));
	$('#pr_body_m tfoot tr:eq(0) td:eq(5)').html(format_number(t_bahan));

		// Isi Penggunaan Bahan
	$('#pr_bahan_m tr:gt(4)').remove();
	$('#pr_bahan_m tr:eq(0) td:eq(0)').html(judul_bahan);
	for (var i=0; i<4; i++) {
		$('#pr_bahan_m tr:eq('+(i+1)+') td:eq(0)').html('');
		$('#pr_bahan_m tr:eq('+(i+1)+') td:eq(1)').html('______');
	}
	for (var i=0; i<dt_bahan.length; i++) {
		bahan = dt_bahan[i].NAMA;
		qty = desimal(dt_bahan[i].QTY.replace(',','.')) + ' ' + dt_bahan[i].SATUAN;

		if (i < 4) {
			$('#pr_bahan_m tr:eq('+(i+1)+') td:eq(0)').html(bahan);
			$('#pr_bahan_m tr:eq('+(i+1)+') td:eq(1)').html(format_number(qty));
		}else{
			$('#pr_bahan_m').append('<tr><td>'+bahan+'</td><td align="center">'+qty+'</td></tr>');
		}
	}

		// Isi Jam Downtime
	down = '';
	for (var i=0; i<dt_downtime.length; i++) {
		ket = dt_downtime[i].KETERANGAN == null ? '' : ' (' + dt_downtime[i].KETERANGAN + ')';
		down = down + dt_downtime[i].MULAI + ' - ' + dt_downtime[i].SELESAI + ' ' + dt_downtime[i].DOWNTIME + ket.toUpperCase() + '<br>';
	}
	$('#pr_body_m tbody tr:eq(0)').append('<td rowspan="'+dt_proses.length+'"></td>');
	$('#pr_body_m tbody tr:eq(0) td:eq(10)').html(down);

		// Isi Nama Operator
	var sh_A = '', sh_B = '', ur_A = 0, ur_B = 0;
	for (var i=0; i<dt_operator.length; i++) {
		nm = dt_operator[i].split('@')[0];
		sh = dt_operator[i].split('@')[1];

		ur_A = sh == 'A' ? ur_A+1 : ur_A;
		ur_B = sh == 'B' ? ur_B+1 : ur_B;

		sh_A = sh == 'A' ? sh_A + ur_A + '. ' + proper(nm.substring(0, 15)) + '<br><br>' : sh_A;
		sh_B = sh == 'B' ? sh_B + ur_B + '. ' + proper(nm.substring(0, 15)) + '<br><br>' : sh_B;
	}
	$('#pr_foot_m .opr:eq(0)').html(proper(sh_A));
	$('#pr_foot_m .opr:eq(1)').html(proper(sh_B));

		// Isi Nama Pengawas
	var sh_A = '', sh_B = '';
	for (var i=0; i<dt_proses.length; i++) {
		if (dt_proses[i].SHIFT == 'A') {sh_A = dt_proses[i].PENGAWAS;}
		if (dt_proses[i].SHIFT == 'B') {sh_B = dt_proses[i].PENGAWAS;}
	}

	$('.pengawas_A:eq(0)').html(proper(sh_A));
	$('.pengawas_B:eq(0)').html(proper(sh_B));
}

// Kirim Cetak Emboss
function cetak_emboss(data) {
	dt_proses = data[0];
	dt_bahan = data[1];
	dt_pch = data[2];
	dt_downtime = data[3];
	dt_kk = data[4];
	query_log = data[5];
	dt_operator = data[7].OPERATOR == null ? '' : (data[7].OPERATOR).substring(0, (data[7].OPERATOR).length - 2).split(', ');

	if (dt_downtime.length == 0) {error_isian('Downtime produksi belum diisi..');}
	if (dt_bahan.length == 0 && dt_proses[0].PROSES != 'Emboss') {error_isian('Penggunaan Medium belum diisi..');}

		// Isi Urut Log
	for (var i=0; i<query_log.length; i++) {
		if (query_log[i].TANGGAL == dt_proses[0].TANGGAL && query_log[i].NAMA_MESIN == dt_proses[0].NAMA_MESIN) {
			urut = i+1;
		}
	}

		// Isi Halaman
	page = 0; urut_kk = [];
	dt_kk.forEach(function(dt) {
		urut_kk.push(dt.ID_GUDANG_ORDER);
	});
	urut_kk = [...new Set(urut_kk)];
	urut_kk.forEach(function(dt) {
		page++;
		if (dt_proses[0].ID_GUDANG_ORDER == dt) {
			$('#pr_head tr:eq(2) td:eq(5)').html('__' + page + '__  of  __' + urut_kk.length + '__'); 
		}
	});

	proses = dt_proses[0].PROSES;
	if (proses == 'Emboss') {kd_proses = 'EMB'; frm = 'F-SMT-P2-005 Rev. 01'}
	if (proses == 'Coating Sensitizing') {kd_proses = 'COAT-SENSI'; frm = 'F-SMT-P2-011 Rev. 01'}
	if (proses == 'Coating Readable') {kd_proses = 'READABLE'; frm = 'F-SMT-P2-012 Rev. 01'}
	judul_bahan = proses == 'Emboss' ? 'Pemakaian PCH' : 'Penggunaan Bahan Medium';
	bln = get_romawi(format_date(dt_proses[0].TANGGAL));

	$('#judul').html('LAPORAN PRODUKSI MESIN ' + proses.toUpperCase());
	$('#nmr_form').html(frm);
	$('#pr_head tr:eq(0) td:eq(2)').html(dt_proses[0].NAMA_MESIN.toUpperCase());
	$('#pr_head tr:eq(1) td:eq(2)').html(dt_proses[0].NAMA + ' - ' + dt_proses[0].SPESIFIKASI);
	$('#pr_head tr:eq(2) td:eq(2)').html(dt_proses[0].SERI + ' / ' + dt_proses[0].KETERANGAN_PENGGUNAAN);
	$('#pr_head tr:eq(0) td:eq(5)').html(format_text(urut, 3) + '/PNP-HLG/' + kd_proses + '/' + bln + '/' + dt_proses[0].THN);
	$('#pr_head tr:eq(1) td:eq(5)').html(format_date(dt_proses[0].TANGGAL));

	$('#pr_body tbody tr').remove();
	t_hasil = 0, t_mutasi = 0, t_rusak = 0;
	for (var i=0; i<dt_proses.length; i++) {
		$('#pr_body tbody').append('<tr><td align="center">'+dt_proses[i].SHIFT+'</td><td align="center">'+(i+1)+'</td><td align="center">'+dt_proses[i].KODE+'</td><td align="center">'+dt_proses[i].UKURAN+'</td><td align="center">12</td><td align="center">'+format_number(dt_proses[i].PANJANG)+'</td><td align="center">'+format_number(dt_proses[i].HASIL)+'</td><td align="center">'+format_number(dt_proses[i].SISA)+'</td><td align="center">'+dt_proses[i].REJECT+'</td><td align="center">'+dt_proses[i].MULAI + ' - ' + dt_proses[i].SELESAI+'</td></tr>');

		t_hasil = t_hasil + Number(dt_proses[i].HASIL);
		t_rusak = t_rusak + Number(dt_proses[i].REJECT);
	}
	$('#pr_body tfoot tr:eq(0) td:eq(1)').html(format_number(t_hasil));
	$('#pr_body tfoot tr:eq(0) td:eq(3)').html(format_number(t_rusak));

		// Isi Penggunaan Bahan
	$('#pr_bahan tr:gt(4)').remove();
	$('#pr_bahan tr:eq(0) td:eq(0)').html(judul_bahan);
	for (var i=0; i<4; i++) {
		$('#pr_bahan tr:eq('+(i+1)+') td:eq(0)').html('');
		$('#pr_bahan tr:eq('+(i+1)+') td:eq(1)').html('______');
	}
	if (proses == 'Emboss') {
		qty = 0;
		dt_proses.forEach(function(e) {qty = qty + Number(e.BAHAN);});
		bahan = qty == 0 ? '' : 'PCH';
		qty = qty == 0 ? '______' : qty;
		$('#pr_bahan tr:eq('+1+') td:eq(0)').html(bahan);
		$('#pr_bahan tr:eq('+1+') td:eq(1)').html(qty);
	}else{
		for (var i=0; i<dt_bahan.length; i++) {
			bahan = dt_bahan[i].NAMA;
			qty = desimal(dt_bahan[i].QTY.replace(',','.')) + ' ' + dt_bahan[i].SATUAN;

			if (i < 4) {
				$('#pr_bahan tr:eq('+(i+1)+') td:eq(0)').html(bahan);
				$('#pr_bahan tr:eq('+(i+1)+') td:eq(1)').html(format_number(qty));
			}else{
				$('#pr_bahan').append('<tr><td>'+bahan+'</td><td align="center">'+qty+'</td></tr>');
			}
		}
	}

		// Isi Jam Downtime
	down = '';
	for (var i=0; i<dt_downtime.length; i++) {
		ket = dt_downtime[i].KETERANGAN == null ? '' : ' (' + dt_downtime[i].KETERANGAN + ')';
		down = down + dt_downtime[i].MULAI + ' - ' + dt_downtime[i].SELESAI + ' ' + dt_downtime[i].DOWNTIME + ket.toUpperCase() + '<br>';
	}
	$('#pr_body tbody tr:eq(0)').append('<td rowspan="'+dt_proses.length+'"></td>');
	$('#pr_body tbody tr:eq(0) td:eq(10)').html(down);

		// Isi Nama Operator
	var sh_A = '', sh_B = '', sh_C = '';
	for (var i=0; i<dt_operator.length; i++) {
		nm = dt_operator[i].split('@')[0];
		sh = dt_operator[i].split('@')[1];

		sh_A = sh == 'A' ? proper(nm.substring(0, 15)) : sh_A;
		sh_B = sh == 'B' ? proper(nm.substring(0, 15)) : sh_B;
		sh_C = sh == 'C' ? proper(nm.substring(0, 15)) : sh_C;
	}

	$('#pr_foot div:eq(0)').html(proper(sh_A));
	$('#pr_foot div:eq(2)').html(proper(sh_B));
	$('#pr_foot div:eq(4)').html(proper(sh_C));

		// Isi Nama Pengawas
	var sh_A = '', sh_B = '', sh_C = '';
	for (var i=0; i<dt_proses.length; i++) {
		if (dt_proses[i].SHIFT == 'A') {sh_A = dt_proses[i].PENGAWAS;}
		if (dt_proses[i].SHIFT == 'B') {sh_B = dt_proses[i].PENGAWAS;}
		if (dt_proses[i].SHIFT == 'C') {sh_C = dt_proses[i].PENGAWAS;}
	}

	$('#pr_foot div:eq(1)').html(proper(sh_A));
	$('#pr_foot div:eq(3)').html(proper(sh_B));
	$('#pr_foot div:eq(5)').html(proper(sh_C));
}

// Kirim Cetak Belah
function cetak_belah(data) {
	dt_proses = data[0];
	dt_bahan = data[1];
	dt_pch = data[2];
	dt_downtime = data[3];
	dt_kk = data[4];
	query_log = data[6];
	dt_operator = data[7].OPERATOR == null ? '' : (data[7].OPERATOR).substring(0, (data[7].OPERATOR).length - 2).split(', ');

	if (dt_downtime.length == 0) {error_isian('Downtime produksi belum diisi..');}

		// Isi Urut Log
	for (var i=0; i<query_log.length; i++) {
		if (query_log[i].TANGGAL == dt_proses[0].TANGGAL && query_log[i].NAMA_MESIN == dt_proses[0].NAMA_MESIN && query_log[i].SHIFT == dt_proses[0].SHIFT) {
			urut = i+1;
		}
	}

	kd_proses = 'SLT';
	bln = get_romawi(format_date(dt_proses[0].TANGGAL));
	$('#pr_head_b tr:eq(0) td:eq(2)').html(dt_proses[0].NAMA_MESIN + ' / ' + dt_proses[0].SHIFT);
	$('#pr_head_b tr:eq(1) td:eq(2)').html(dt_proses[0].DESAIN);
	$('#pr_head_b tr:eq(0) td:eq(5)').html(format_text(urut, 3) + '/PNP-HLG/' + kd_proses + '/' + bln + '/' + dt_proses[0].THN);
	$('#pr_head_b tr:eq(1) td:eq(5)').html(format_date(dt_proses[0].TANGGAL).toUpperCase());

	$('#pr_body_b tbody tr').remove();
	lebar = '37.5', t_hasil = 0, t_pita = 0, t_rusak = 0;
	for (var i=0; i<dt_proses.length; i++) {
		kk = dt_proses[i].KETERANGAN_PENGGUNAAN.split('/')[0];
		if (dt_proses[i].PROSES == 'Belah') {
			judul_b = 'PROSES BELAH', kj = 'HSF', qty_roll = '2';
			lebar_bahan = '75', lebar = '37.5';
		}else{
			judul_b = 'PROSES RAJANG PITA';
			lebar_bahan = '37,5';

			if (dt_proses[i].SERI == 'SERI I') {
				kj = 'HSF.1', lebar = '0.7';
			}else if (dt_proses[i].SERI == 'SERI II' || dt_proses[i].SERI == 'SERI III') {
				kj = 'HSF.3', lebar = '0.5';
			}else{
				kj = 'HSF.M', lebar = '0.6';
			}
			qty_roll = dt_proses[i].QTY_ROLL;
		}
		
		seri = dt_proses[i].SERI != 'MMEA' ? dt_proses[i].SERI.split(' ')[1] : dt_proses[i].SERI;
		tot_pita = Number(dt_proses[i].HASIL.replace(',','.')) * qty_roll;

		$('#judul_b').html(judul_b);
		$('#pr_body_b tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+dt_proses[i].KODE+'</td><td align="center">'+lebar_bahan+'</td><td align="center">'+seri+'</td><td align="center">'+kj+'</td><td align="center">'+kk+'</td><td align="center">'+format_number(dt_proses[i].PANJANG)+'</td><td align="center">'+format_number(dt_proses[i].HASIL.replace(',','.'))+'</td><td align="center">'+lebar+'</td><td align="center">'+qty_roll+'</td><td align="center">'+format_number(tot_pita)+'</td><td align="center">'+format_number(dt_proses[i].SISA)+'</td><td align="center">'+format_number(dt_proses[i].REJECT.replace(',','.'))+'</td><td align="center">'+dt_proses[i].MULAI + ' - ' + dt_proses[i].SELESAI+'</td></tr>');

		t_hasil = t_hasil + Number(dt_proses[i].HASIL.replace(',','.'));
		t_pita = t_pita + tot_pita;
		t_rusak = t_rusak + Number(dt_proses[i].REJECT.replace(',','.'));
	}
	$('#pr_body_b tfoot td:eq(1)').html(format_number(t_hasil));
	$('#pr_body_b tfoot td:eq(3)').html(format_number(t_pita));
	$('#pr_body_b tfoot td:eq(5)').html(format_number(t_rusak));

	if (dt_proses[0].PROSES == 'Belah') {
		$('#pr_body_b thead td:eq(3), #pr_body_b tbody td:nth-child(11), #pr_body_b tfoot td:eq(3)').hide();
	}else{
		$('#pr_body_b thead td:eq(3), #pr_body_b tbody td:nth-child(11), #pr_body_b tfoot td:eq(3)').show();
	}

		// Isi Jam Downtime
	down = '';
	for (var i=0; i<dt_downtime.length; i++) {
		ket = dt_downtime[i].KETERANGAN == null ? '' : ' (' + dt_downtime[i].KETERANGAN + ')';
		down = down + dt_downtime[i].MULAI + ' - ' + dt_downtime[i].SELESAI + ' ' + dt_downtime[i].DOWNTIME + ket.toUpperCase() + '<br>';
	}
	$('#pr_body_b tbody tr:eq(0)').append('<td rowspan="'+dt_proses.length+'"></td>');
	$('#pr_body_b tbody tr:eq(0) td:eq(14)').html(down);
	$('.tbl_isi td').removeClass('pl-2 pr-2').addClass('pl-2 pr-2');

		// Isi Nama Operator
	var sh = '', operator = [];
	for (var i=0; i<dt_operator.length; i++) {
		operator.push(dt_operator[i].split('@')[0]);
	}
	operator = [...new Set(operator)].join('<br><br>');
	$('#pr_foot_b .opr:eq(0)').html(proper(operator));
	if (dt_operator.length == 1) {
		$('#pr_foot_b .opr:eq(0)').css({'padding-top': '50px', 'text-align': 'center'});
	}else{
		$('#pr_foot_b .opr:eq(0)').css({'padding-top': '', 'text-align': ''});			
	}

		// Isi Nama Pengawas
	var pengawas = dt_proses[0].PENGAWAS == null ? '' : dt_proses[0].PENGAWAS;
	$('.pengawas:eq(0)').html(proper(pengawas));
}

// Isi Sisa Edit
function e_sisa() {
	var panjang = $('#e_panjang').val();
	var hasil = $('#e_hasil').val();
	var reject = $('#e_reject').val();
	var sisa = Number(panjang) - Number(hasil) - Number(reject);

	$('#e_sisa').val(sisa).change();
}

// Isi Edit Operator
function isi_e_operator() {
	var proses = $('#e_proses').val();
	var nama_mesin = $('#e_mesin').val();
	var shift = $('#e_shift').val();
	var operator = [];
	var data = [proses, nama_mesin, shift];

	if (proses == '' || nama_mesin == '' || shift == '') {return;}

	$('#e_operator').val('').change();
	$.ajax({
		async: false,
		data: {data: data},
		type: 'POST',
		url: '<?php echo base_url() . "index.php/produksi/pet/get_operator" ?>',
		success: function(data) {
			data = JSON.parse(data);

			for (var i=0; i<data.length; i++) {
				operator.push(data[i].ID_OPERATOR);
			}
			$('#e_operator').val(operator).change();
		}
	});
}

// Edit Data
function edit(btn) {
	var data_table = document.getElementById('data-table');
	var row = $(btn).closest("tr").index();	
	var proses = data_table.rows[row+1].cells[4].innerText;
	var nama_mesin = data_table.rows[row+1].cells[5].innerText;
	var id_edit = btn.name;
	var bahan = proses == 'Metalize' ? 'Alu Wire (Gr)' : 'PCH';
	var data = [id_edit, proses];

	$('#modal_edit table tr:gt(22)').show();
	$('#modal_edit table tr:gt(27) th:eq(0)').html(bahan);

	if (proses != 'Metalize' && proses != 'Emboss') {
		$('#modal_edit table tr:gt(22)').hide();
	}

	$('#btn_edit').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/pet/edit',
		data: {data: data},
		success: function(data) {
			data = JSON.parse(data);
			dt_roll = data[0];
			dt_mesin = data[1];

			$('#e_mesin option').remove();
			dt_mesin.forEach(function(dt) {
				selected = dt.NAMA_MESIN == nama_mesin ? 'selected' : '';
				$('#e_mesin').append('<option '+selected+'>'+dt.NAMA_MESIN+'</option>');
			});
			operator = dt_roll.ID_OPERATOR == null ? '' : dt_roll.ID_OPERATOR.split(',')
			bahan = dt_roll.BAHAN == null ? 0 : dt_roll.BAHAN.replace(',', '.');
			
			$('#e_mesin').change();
			$('#e_proses').val(dt_roll.PROSES).change();
			$('#e_desain').val(dt_roll.DESAIN).change();
			$('#e_tgl').val(format_date(dt_roll.TANGGAL)).change();
			$('#e_shift').val(dt_roll.SHIFT).change();
			$('#e_operator').val(operator).change();
			$('#e_pengawas').val(dt_roll.ID_PENGAWAS).change();
			$('#e_mulai').val(dt_roll.MULAI).change();
			$('#e_selesai').val(dt_roll.SELESAI).change();
			$('#e_kode').val(dt_roll.KODE).change();
			$('#e_kode').attr('name', id_edit);
			$('#e_panjang').val(dt_roll.PANJANG).change();
			$('#e_hasil').val(dt_roll.HASIL).change();
			$('#e_reject').val(dt_roll.REJECT).change();
			$('#e_sisa').val(dt_roll.SISA).change();
			$('#e_bahan').val(format_number(bahan)).change();

			if (dt_roll.QTY_NEXT != 0) {$('#modal_edit .num:not(#e_bahan)').attr('readonly', '');}else{$('#modal_edit .num').removeAttr('readonly');}
		}
	});
}

// Simpan Edit
function simpan_edit() {
	var id_edit = $('#e_kode').attr('name');
	var proses = $('#e_proses').val();
	var tgl = $('#e_tgl').val();
	var mesin = $('#e_mesin').val();
	var shift = $('#e_shift').val();
	var mulai = $('#e_mulai').val();
	var selesai = $('#e_selesai').val();
	var operator = $('#e_operator').val();
	var pengawas = $('#e_pengawas').val();
	var hasil = angka($('#e_hasil').val());
	var reject = angka($('#e_reject').val());
	var sisa = angka($('#e_sisa').val());
	var bahan = angka($('#e_bahan').val());
	var start = cek_jam(proses, tgl, mulai);
	var end = cek_jam(proses, tgl, selesai);
	var data = [id_edit, tgl, shift, mulai, selesai, hasil, reject, sisa, bahan, mesin, operator, pengawas, proses];

	if (pengawas == '') {error_isian('Pengawas belum diisi..');}
	if (operator == null) {error_isian('Operator belum diisi..');}
	if (start >= end) {error_isian('Waktu mulai tidak boleh sama/ melebihi selesai..');}
	if (hasil == '') {error_isian('Hasil belum diisi..');}
	if (sisa < 0) {error_isian('Isian panjang salah..');}
	if (proses == 'Metalize' && bahan == '') {error_isian('Penggunaan Alu Wire belum diisi..');}

	$('#btnProgress').click();
	$.ajax({
		type: 'POST',
		url: '<?php echo base_url(); ?>index.php/produksi/pet/simpan_edit',
		data: {data: data},
		success: function(data) {
			setTimeout(function() {
				$('#btnOk').click();
				$('#btnSukses').click();
				filter();
			}, 500);
		}
	});
}

// Notifikasi Hapus Data
function hapus(btn) {
	var id_hapus = btn.name;

	$('#btnHapus').click();
	$('#btnYa').on('click', function() {
		if (id_hapus == '') {return;}

		$('#btnProgress').click();
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url(); ?>index.php/produksi/pet/hapus',
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

// Drag Div Document
$("#modal_pecah").draggable({handle: ".card-header"});

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