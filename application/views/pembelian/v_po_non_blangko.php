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
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper" id="non_printable">
	<section class="content-header"></section>
	<section class="content">

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title"><b><font color="White"><div id="headerinput">Input Purchase Order</div></font></b></h3>
				<div class="card-tools">
					<button type="button" id="minimize" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-5"> 
						<table width="100%">
							<tr>
								<th width="40%">No. SPP</th>
								<td width="60%">
									<div class="input-group">
										<input type="text" id="nmr_po" class="form-control mr-2" tabindex="2" value="000000" maxlength="6" onfocusout="isi_nomor()" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" style="width: 30%;" autocomplete="off">
										<label id="nomer_transaksi" style="margin-top: 5px; width: 65%;">-</label>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Tanggal</th>
								<td>
									<input type="text" id="tanggal" class="form-control datepicker" value="<?php echo date("d-M-Y"); ?>" onchange="auto_no()" style="background-color: #FFFFFF; cursor: pointer;" readonly tabindex="1">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Divisi</th>
								<td>
									<select class="select" id="unit" style="width: 100%;" onchange="auto_no()">
										<option value="">Pilih..</option>
										<?php foreach ($unit->result_array() as $dt) { ?>
											<option value="<?php echo $dt['KD_UNIT'] . '@_@' . $dt['KODE_TRANSAKSI']; ?>"><?php echo $dt['UNIT']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Supplier</th>
								<td>
									<div class="mobile_width">
										<select class="select" id="supplier" onchange="auto_no()" style="width: 100%;">
											<option value="">Pilih Supplier..</option>
											<?php foreach ($supplier->result_array() as $dt) { ?>
												<option value="<?php echo $dt['ID'] . '-' . $dt['KODE_KEUANGAN'] . '-' . $dt['KODE_JENIS']; ?>"><?php echo $dt['NAMA']; ?></option>
											<?php } ?>
										</select>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Deltime</th>
								<td>
									<input id="deltime" type="text" class="form-control datepicker bg-white" value="<?php echo date('d-M-Y'); ?>" style="cursor: pointer;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr class="kurs" style="display: none;">
								<th>Kurs Kalkulasi</th>
								<td>
									<input id="kurs" type="text" value="1" class="form-control num" autocomplete="off">
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-6"> 
						<table width="100%">
							<tr>
								<th width="40%">Cara Bayar</th>
								<td width="60%">
									<select class="select" id="cara_bayar" style="width: 100%;">
										<?php foreach ($bayar->result_array() as $dt) { ?>
											<option value="<?php echo $dt['ID']; ?>" <?php if (trim($dt['KETERANGAN']) == 'KREDIT') {echo 'selected';}; ?>><?php echo $dt['KETERANGAN']; ?></option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Discount</th>
								<td>
									<div class="input-group">
										<input type="number" style="width: 60%;" id="discount" class="form-control" value="0">
										<label class="ml-3" style="width: 30%;">%</label>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Top</th>
								<td>
									<div class="input-group">
										<input type="number" style="width: 60%;" id="top" class="form-control" value="30">
										<label class="ml-3" style="width: 30%;">Hari</label>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>No. Investasi</th>
								<td>
									<div class="mobile_width">
										<select class="select" id="investasi" onchange="open_investasi()" style="width: 60%;">
											<option value="">Pilih..</option>
										</select>
										<button type="button" class="btn btn-success ml-3" onclick="open_investasi()" style="width: 40px;"><i class="fa fa-plus"></i></button>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Total Harga</th>
								<td>
									<input type="text" id="total_harga" class="form-control" style="text-align: right; width: 175px;" readonly>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
							<tr>
								<th>Ppn</th>
								<td>
									<div class="input-group">
										<input type="number" style="width: 60%;" id="ppn" class="form-control" value="0" maxlength="2">
										<label class="ml-3" style="width: 30%;">%</label>
									</div>
								</td>
							</tr>
							<tr style="height: 10px;"></tr>
						</table>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<div style="width: 1400px; font-size: 13px;">
						<button type="button" class="btn btn-block" id="btn_material" style="width:150px; margin-bottom: 10px; color: #FFFFFF; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Material</b></button>
						<table id="tabel_material" class="table table-bordered" width="100%">
							<thead style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
								<tr style="text-align: center;">
									<td width="5%">No</td>
									<td width="10%">No. SIP</td>
									<td width="25%">Nama Material</td>
									<td width="10%">Satuan</td>
									<td width="10%">Qty SIP</td>
									<td width="10%">Qty Order</td>
									<td width="10%">Harga</td>
									<td width="10%">Mata Uang</td>
									<td width="10%">Total</td>
									<td hidden>Del. Time</td>
									<td hidden></td>
									<td hidden>Id Material Supply</td>
									<td hidden>Id SIP Detail</td>
									<td hidden>Id PO Detail</td>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer">
				<table>
					<tr>
						<td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
						<td width="10"></td>
						<td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Purchase Order</font>
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
						<font size="2">
							<div class="table-responsive mb-3">
								<table style="width: 1600px; margin-bottom: 10px; font-size: 12px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<th width="17.5%" colspan="2" class="filter">Periode PO</th>
											<td></td>
											<th width="12.5%" class="filter">Nama Barang</th>
											<td></td>
											<th width="12.5%" class="filter">Supplier</th>
											<td></td>
											<th width="12.5%" class="filter">Nomor PO</th>
											<td></td>
											<th width="10%" class="filter">Divisi</th>
											<td></td>
											<th width="10%" class="filter">Jenis Supplier</th>
											<td></td>
											<th width="12.5%" class="filter">Kategori</th>
											<td></td>
											<th width="12.5%" class="filter">Jenis Bahan</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="f_tgl1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y'); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
											<td><input id="f_tgl2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="f_bahan" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($bahan->result_array() as $dt) { ?>
														<option value="<?php echo $dt['ID_BARANG']; ?>"><?php echo $dt['NAMA'] . ' ' . $dt['SPESIFIKASI']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="f_supplier" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($supplier->result_array() as $dt) { ?>
														<option><?php echo $dt['NAMA']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<div style="width: 220px;"><select class="select" id="f_nomer" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($no_po->result_array() as $dt) { ?>
														<option><?php echo $dt['NOMER']; ?></option>
													<?php } ?>
												</select></div>
											</td>
											<td></td>
											<td>
												<select class="select" id="f_unit" onchange="filter()" style="width: 100%;">
													<?php foreach ($unit->result_array() as $dt) { ?>
														<option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="f_jenis" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($jenis->result_array() as $dt) : ?>
														<option><?php echo $dt['JENIS']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="f_kategori_hpd" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($kategori->result_array() as $dt) : ?>
														<option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['KATEGORI']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="f_kategori" onchange="filter()" style="width: 100%;">
													<option>All..</option>
													<?php foreach ($jenis_bahan->result_array() as $dt) : ?>
														<option><?php echo $dt['KATEGORI']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
										</tr>
									</tbody>
								</table>
							</div>

							<div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
								<div class="data-table m-3"></div>
							</div>
						</font>
					</div>

					<div class="card-footer">
						<table>
							<tr>
								<td width="150"> <button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
								<td></td>
								<td width="150"><button type="button" onclick="upload_simpg()" class="btn btn-block btn-danger" title="Upload to SIMPG" style="width: 150px;"><i class="fa fa-upload m-2"></i><b>SIMPG</b></button></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">
					<b>
						<font color="White">Laporan Proyeksi Beli</font>
					</b>
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-tool info_3" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_3"></i></button>
					<button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="card-body">
				<div class="card">
					<div class="card-body">
						<font size="2">
							<div class="table-responsive">
								<table style="width: 1400px; margin-bottom: 30px;">
									<thead>
										<tr align="center" style="line-height: 30px;">
											<th width="17.5%" colspan="2" class="filter">Periode Delivery</th>
											<td></td>
											<th width="15%" class="filter">Supplier</th>
											<td></td>
											<th width="17.5%" class="filter">Nomor PO</th>
											<td></td>
											<th width="10%" class="filter">Divisi</th>
											<td></td>
											<th width="10%" class="filter">Jenis Supplier</th>
											<td></td>
											<th width="15%" class="filter">Jenis Bahan</th>
											<td></td>
											<th width="15%" class="filter">Cari</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input id="fd_tgl1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y'); ?>" style="cursor: pointer;" onchange="filter_deadline()" readonly></td>
											<td><input id="fd_tgl2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter_deadline()" readonly></td>
											<td></td>
											<td>
												<select class="select" id="fd_supplier" onchange="filter_deadline()" style="width: 100%;">
													<option>All</option>
													<?php foreach ($supplier->result_array() as $dt) { ?>
														<option><?php echo $dt['NAMA']; ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fd_nomer" onchange="filter_deadline()" style="width: 100%;">
													<option>All</option>
													<?php foreach ($no_po->result_array() as $dt) { ?>
														<option><?php echo $dt['NOMER']; ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fd_unit" onchange="filter_deadline()" style="width: 100%;">
													<option>All</option>
													<?php foreach ($unit->result_array() as $dt) { ?>
														<option><?php echo $dt['UNIT']; ?></option>
													<?php } ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fd_jenis" onchange="filter_deadline()" style="width: 100%;">
													<option>All</option>
													<?php foreach ($jenis->result_array() as $dt) : ?>
														<option><?php echo $dt['JENIS']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td></td>
											<td>
												<select class="select" id="fd_kategori" onchange="filter_deadline()" style="width: 100%;">
													<option>All</option>
													<?php foreach ($jenis_bahan->result_array() as $dt) : ?>
														<option><?php echo $dt['KATEGORI']; ?></option>
													<?php endforeach; ?>
												</select>
											</td>
											<td></td>
											<td><input type="text" class="cari" id="fd_cari" autocomplete="off" onkeyup="filter_deadline()" placeholder="Nama Material.." style="width: 100%;"></td>
										</tr>
									</tbody>
								</table>
							</div>

							<?php $this->load->view('pembelian/v_po_deadline_table'); ?>
						</font>
					</div>

					<button style="width: 150px;" type="button" onclick="(function(){ $('.excel2').click(); })();" class="btn btn-success m-3" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
				</div>
			</div>
		</div>

		<div class="card-footer">
			<font color="Green" size="2">ERP @2019</font>
		</div>
	</section>
</div>

<!-- Modal Batal PO -->
<div class="modal fade" id="modal_batal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membatalkan PO? </div>
			<div class="modal-footer">
				<button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
				<button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
				<button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
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

<!-- Modal Investasi -->
<div class="modal fade" id="modal_investasi">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header m-2 rounded" style="cursor: all-scroll;">
					<h3 class="card-title">
						<b>
							<font color="White">
								<div id="headerinput">
									<h3>Data Investasi</h3>
								</div>
							</font>
						</b>
					</h3>
				</div>
				<div class="card-body">
					<table width="100%">
						<tr>
							<th width="45%">Nomor Investasi</th>
							<td width="55%">
								<input type="text" id="e_investasi" class="form-control" style="width: 100%;" readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Total Budget</th>
							<td>
								<input type="text" id="e_budget" class="form-control text-right" style="width: 100%;" readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Total Realisasi</th>
							<td>
								<input type="text" id="e_realisasi" class="form-control text-right" style="width: 100%;" readonly>
							</td>
						</tr>
						<tr style="height: 10px;"></tr>
						<tr>
							<th>Sisa</th>
							<td>
								<input type="text" id="e_sisa" class="form-control text-right" style="width: 100%;" readonly>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer rounded">
					<button id='btnTutup' style="width: 150px;" type="button" class="btn btn-success" data-dismiss="modal" title="Tutup Informasi"><i class="fa ion-android-share m-2"></i><b>Tutup</b></button>
					<button id="btn_investasi" data-toggle="modal" data-target="#modal_investasi" hidden></button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Data -->
<div class="modal fade" id="modal_sip">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="card card-info">
				<div class="card-header m-2 rounded" style="cursor: all-scroll;">
					<h3 class="card-title">
						<b>
							<font color="White">
								<div id="headerinput">
									<h3>Data SIP</h3>
								</div>
							</font>
						</b>
					</h3>
				</div>
				<div class="card-body">
					<table id="tbl_sip" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
						<thead>
							<tr align="center">
								<th>Pilih</th>
								<th width="5%">No</th>
								<th width="15%">Nomor SIP</th>
								<th width="25%">Nama Barang</th>
								<th width="15%">Nama Pemesan</th>
								<th width="15%">Bagian</th>
								<th width="15%">Qty SIP</th>
								<th width="10%">Satuan</th>
								<th hidden></th>
								<th hidden></th>
							</tr>
						</thead>
						<tbody id="body_sip">
						</tbody>
					</table>
				</div>
				<div class="modal-footer rounded">
					<button style="width: 150px;" type="button" class="btn btn-warning" onclick="$('#btn_material').click()" title="Refresh Data"><i class="fa fa-archive m-2"></i><b>Refresh</b></button>
					<button id='btn_pilih' style="width: 150px;" type="button" class="btn btn-success" title="Pilih Barang" data-dismiss="modal"><i class="fa ion-android-share m-2"></i><b>Pilih</b></button>
					<button id="btn_sip" data-toggle="modal" data-target="#modal_sip" hidden></button>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="printable" style="display: none; color: #000; font-size: 18.7px; font-family: sans-serif; margin-left: 3mm; margin-right: 5mm;">
<div style="height: 3mm;"></div>
<div id="e_kop1" style="margin-left: 10mm; text-align: left; font-size: 22px; text-transform: uppercase;font-weight:bold;">  PT PURA NUSAPERSADA </div>
<div id="e_kop2" style="margin-left: 10mm; text-align: left;  margin-top: -1.7mm; font-size: 22px; text-transform: uppercase;font-weight:bold;">  KUDUS </div>   
<div style="height: 3mm;"></div>
<div id="e_judul1" style="margin-left: 10mm; text-align: center;   text-transform: uppercase;font-weight:bold;text-decoration:underline; text-underline-position: under; font-size: 22px;">  SURAT PESANAN LUAR </div>
<div id="e_judul2" style="margin-left: 10mm; text-align: center;  margin-top: -1mm; font-size: 12px; text-transform: uppercase;">  F-SMT-PEMB-002 </div>   

   <div style="height: 5mm;"></div>
	<div id="e_tgl" style="margin-right: 38mm; text-align: right; text-transform: uppercase;font-size: 17px;">  18-Mei-2020</div>

	<div style="height: 4mm;"></div>
	<div id="e_nomor_spp" style="margin-left: 10mm; font-size: 18px;">20000005724 (001OFF/PNP-HLG/R)</div>
	<div id="e_lokal" style="margin-left: 10mm; margin-top: -1.7mm;font-size: 18px;">(LKL)</div>
	<div id="e_alamat_faktur" style="margin-left: 10mm; margin-top: -1.7mm;font-size: 18px;">Alamat Faktur Pajak : Jl. Raya Kudus - Pati Km. 12 Terban Jekulo-Kudus  </div> 
    

	<div style="margin-left: 180mm; margin-top: -4mm; height: 10mm;">
	    <div id="e_terhormat" style="margin-bottom: 5px;font-size: 16px;">Kepada Yang Terhormat :</div>		
		<div id="e_supplier" style="margin-bottom: 5px;font-size: 17px;">PT. ULTIMA SOLUSI PAPERINDO</div>
		<div id="e_alamat" style="margin-bottom: 5px;font-size: 17px;">SENTRA PRIMA TEKNO PARK B-7</div>
		<!--<div id="e_kota" style="margin-bottom: 5px;font-size: 17px;">TANGERANG</div> !-->
	</div>

	<div style="height: 22mm;"></div>
	<table id="tbl_header" width="97%" style="font-size: 17.5px;" >
	<tr style="height: 4.89mm;">
					<td width="3%"  style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">NO</td>
					<td width="13%" style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">KUANTITAS</td>
					<td width="48%" style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">MACAM BARANG</td>
					<td width="15%" style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">HARGA @</td>
					<td width="17%"  style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">JUMLAH</td>
				</tr>
   </table>
	<div style="height: 143mm;">
		<table id="tbl_print" width="97%" style="font-size: 17.5px;" >
		   
					<?php for ($i = 0; $i < 20; $i++) { ?>
				<tr style="height: 4.89mm;">
					<td width="3%" style="border-left: solid 1px #000;border-right: solid 1px #000;" align="right"></td>
					<td width="13%" style="border-left: solid 1px #000;border-right: solid 1px #000;" align="right"></td>
					<td width="48%" style="padding-left: 5mm;border-left: solid 1px #000;border-right: solid 1px #000;"></td>
					<td width="15%" style="border-left: solid 1px #000;border-right: solid 1px #000;" align="right"></td>
					<td width="17%" style="border-left: solid 1px #000;border-right: solid 1px #000;" align="right"></td>
				</tr>
			<?php } ?>
		</table>

		<table id="tbl_footer" width="97%" style="font-size: 17.5px;" >
	            <tr style="height: 4.89mm;">			
					<td  width="82.3%" colspan=3 width="15%" style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="center">Dasar Pengenaan Pajak (DPP)</td>
					<td width="17.7%"  id="e_total" style="border-left: solid 1px #000;border-top: solid 1px #000;border-bottom: solid 1px #000;border-right: solid 1px #000;" align="right">JUMLAH</td>
				</tr>
   </table>	
	</div>

   
	<div style="line-height: 5.5mm;">
		<div><b>PT. PURA NUSAPERSADA Sudah menerapkan SMK3 / SMP / SNI ISO 28000: 2009</b></div>
		<div>Ketentuan :</div>
		<div>Barang Chemical/ Barang Beracun & Berbahaya (B3) harus disertakan MSDS (Materials</div>
		<div>Safety Data Sheet), sesuai peraturan & standart K3 yang berlaku, kecuali repeat order</div>
	</div>

	<div style="height: 3mm;"></div>
	<table width="98.5%" >
		<tr style="height: 8mm;">
			<td width="26%"></td>
			<td width="17%">REGULAR</td>
			<td width="32%"></td>
			
			<!--<td width="25%" id="e_total" align="right">Total</td> !-->
		</tr>
		<tr>
			<td>Del time &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp :</td>
			<td id="e_del_time">del_time</td>
			<td></td>

			<!--dihilangkan sejak 27/12/2024
			<td id="e_ppn" align="right">ppn</td>-->
		</tr>
		<tr>
			<td>Jatuh Tempo Pembayaran :</td>
			<td id="e_top">30 HARI</td>
			<td></td>
			<!--dihilangkan sejak 27/12/2024 <td id="e_sub_total" align="right" style="font-weight: bold;">Sub Total</td>!-->
		</tr>
	</table>

	<table style="margin-left: -10px; width: 550px;">
		<tr style="height: 8mm;">
			<td width="42%">Alamat Kirim</td>
			<td width="4%">:</td>
			<td id="alamat_kirim">Jl. AKBP R. Agil Kusumadya Km 2 (Sebelah DPRD Kudus)</td>
		</tr>
	</table>

	<div style="height: 3mm;"></div>
	<table width="98.5%" >
		
		<tr>
			<td>Yang menerima pesanan :</td>
			<td ></td>
			<td>Mengetahui :</td>	
			<td  align="right">Pemesan:</td>
		</tr>	
	</table>


	<div style="height: 33mm;"></div>
	<table width="100%" style="font-size: 17.5px; font-weight: bold; color: #424242;">
		<tr style="height: 10mm;">
			<td width="25%"align="center" id="e_kosong" style="border-bottom: 1px solid black;"></td>
			<td width="15%" align="center" id="e_gm" style="border-bottom: 1px solid black;">xxx</td>
			<td width="21%" align="center" id="e_pimpinan" style="border-bottom: 1px solid black;">xxx</td>
			<td width="19%" align="center" id="e_akuntan" style="border-bottom: 1px solid black;">xxx</td>
			<td width="20%" align="center" id="e_pembelian" style="border-bottom: 1px solid black;">xxx</td>
		</tr>
		<tr style="margin-top: -120px;">
			<td  align="center">Pemasok</td>
			<td align="center">Direktur</td>
			<td align="center">Pimpinan</td>
			<td align="center">Cost Control</td>
			<td align="center">Pembelian</td>
		</tr>
	</table>

	<div style="height: 7mm;"></div>
	<div style="font-size: 17px; line-height: 6mm;">
		<div>Penting :</div>
		<div>1. Surat pesanan luar/ SPL dianggap sah apabila lengkap otorisasinya</div>
		<div>2. Untuk keperluan administrasi pembayaran harus dilengkapi :</div>
		<div>&nbsp &nbsp - Surat pesanan luar/ SPL yang lengkap otorisasinya</div>
		<div>&nbsp &nbsp - Surat jalan/ surat pengantar saudara</div>
		<div>&nbsp &nbsp - Faktur komersial dengan menyebutkan/ menunjuk no. SPL</div>
		<div>&nbsp &nbsp - Faktur Pajak bagi yang mempunyai NPWP</div>
	</div>

	<!-- Setting Margin Browser : 0.4"   0.4"   0.39"   1.29" -->
	<!-- Setting Margin Browser : 10.2 mm 	10.2 mm 	10.2 mm 	33 mm -->
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
	var info_1 = 0, info_2 = 0, info_3 = 0;
	var data_sip = [], data_investasi = [];
	var id_edit = '', id_detail = '', harga_edit = 0;

// Load Dokumen
	$(document).ready(function() {
		// $('.fa-bars:eq(0)').click();
		$(".select").select2();
		$(".datepicker").datepicker({dateFormat: 'dd-M-yy'});
		filter();
		pagination_deadline();	
		resize();
	});
	$(window).on('resize', function(){
		resize();
	});
	function resize() {
		var lebar = $(window).width();
		var select_width = $('#unit').width() - 160;

		if (lebar > 700) {
			$(".mobile_width").css('width','100%');		
		}else{
			$(".mobile_width").css('width',select_width+'px');	
		}
	}

// Pagination
	function pagination() {
		$('#data-table').DataTable().destroy();
		$('#data-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {
				"sSearch": "Cari :"
			},
			"order": [[2, "asc"]],
			"info": false,
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
				className: 'excel invisible',
				title: 'Data Surat Pembelian Luar (SPL)'
			}]
		});
	}

// Pagination Deadline
	function pagination_deadline() {
		$('#data-deadline-table').DataTable().destroy();
		$('#data-deadline-table').DataTable({
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"order": [[2, "asc"]],
			"info": false,
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
				className: 'excel2 invisible',
				title: 'Data Surat Pembelian Luar (SPL)'
			}]
		});
	}

// Pagination Input
	function pagination_input() {
		var datatable_sip = $('#tbl_sip').DataTable({
			"paging": false,
			"lengthChange": false,
			"oLanguage": {"sSearch": "Cari :"},
			"order": [[1, "asc"]],
			"info": false,
			"autoWidth": true,
			"scrollX": true,
			"scrollY": "400px"
		});

		setTimeout(function() {datatable_sip.columns.adjust().draw();}, 500);
	}

// Filter Data
	function filter() {
		var tgl1 = document.getElementById('f_tgl1').value;
		var tgl2 = document.getElementById('f_tgl2').value;
		var supplier = document.getElementById('f_supplier').value;
		var nomer = document.getElementById('f_nomer').value;
		var kd_unit = document.getElementById('f_unit').value;
		var jenis = document.getElementById('f_jenis').value;
		var kategori_hpd = document.getElementById('f_kategori_hpd').value;
		var kategori = document.getElementById('f_kategori').value;
		var id_barang = $('#f_bahan').val();
		var data = [tgl1, tgl2, supplier, nomer, kd_unit, jenis, kategori_hpd, kategori, id_barang];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/filter" ?>',
			success: function(data) {
				$('.data-table').html(data);

				if (kd_unit == '12') {
					$('#data-table th:nth-child(7), #data-table td:nth-child(7)').hide();
				}else{
					$('#data-table th:nth-child(7), #data-table td:nth-child(7)').show();
				}

				pagination();
			}
		});
	}

// Filter Data
	function filter_deadline() {
		var tgl1 = document.getElementById('fd_tgl1').value;
		var tgl2 = document.getElementById('fd_tgl2').value;
		var supplier = document.getElementById('fd_supplier').value;
		var nomer = document.getElementById('fd_nomer').value;
		var unit = document.getElementById('fd_unit').value;
		var jenis = document.getElementById('fd_jenis').value;
		var kategori = document.getElementById('fd_kategori').value;
		var cari = document.getElementById('fd_cari').value;
		var data = [tgl1, tgl2, supplier, nomer, unit, jenis, cari, kategori];

		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/filter_deadline" ?>',
			success: function(data) {
				$('.data-deadline-table').html(data);
				pagination_deadline();
			}
		});
	}

// Clear Data
	$('#supplier').change(function() {
		$("#tabel_material").find("tr:gt(0)").remove();
	});
	$('#unit').change(function() {
		$("#tabel_material").find("tr:gt(0)").remove();
	});

// Kosong Isian
	function kosong() {
		$('#unit').val('').change();
		$('#supplier').val('').change();
		$('#tanggal').val(<?php echo json_encode(date("d-M-Y")); ?>).change();
		$('#cara_bayar').val('13').change();
		$('#discount').val('0').change();
		$('#top').val('30').change();
		$('#investasi').val('').change();
		$('#total_harga').val('').change();
		$('#nmr_po').val('000000').change();
		$('#nomer_transaksi').html('-');
		$('#kurs').val('1');
		$('.kurs').hide();

		$("#tabel_material").find("tr:gt(0)").remove();
		id_edit = '', id_detail = '', harga_edit = 0;
	}

// Isi Format Nomor 5 angka
	function isi_nomor() {
		var nmr_po = $('#nmr_po').val();
		var length = $('#nmr_po').attr('maxlength');
		var nmr_po = nmr_po.toString().padStart(length, "0");

		$('#nmr_po').val(nmr_po);
	}

// Auto No SPP
	function auto_no() {
		var tanggal = $('#tanggal').val();
		var id_supplier = $('#supplier').val().split('-')[0];
		var jenis = $('#supplier').val().split('-')[2];
		var kd_unit = $('#unit').val().split('@_@')[0];
		var kd_transaksi = $('#unit').val().split('@_@')[1];
		var kd_jenis = jenis == '1' ? kd_jenis = 'P' : (jenis == '4' ? kd_jenis = 'I' : 'R');
		var data = [id_edit, tanggal, jenis, id_supplier, kd_unit, kd_transaksi, kd_jenis];

		if (id_supplier == '' || kd_unit == '') {
			$('#nmr_po').val('000000');
			$('#nomer_transaksi').val('-');
			return;
		}

		if (jenis != '4') {$('.kurs').hide();}else{$('.kurs').show();}
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/auto_no" ?>',
			success: function(data) {
				data = JSON.parse(data);

				nmr_po = data[0].substring(0,6);
				nomer_transaksi = data[0].substring(6,22);

				urut = nmr_po.replace(/\D/g,'');
				kode = nmr_po.replace(/[0-9]/g,'');

				$('#nmr_po').attr('maxlength', urut.length);			
				$('#nmr_po').val(urut);
				$('#nomer_transaksi').html(kode+nomer_transaksi);

				data_investasi = data[1];
				isi_data_investasi();
			}
		});

		if (kd_jenis == 'R') {
			$('#ppn').val('11');
		}else{
			$('#ppn').val('0');
		}
	}

// Isi Modal Investasi
	function isi_data_investasi() {
		var option = document.createElement('option');
		var nama = document.getElementById('investasi');

		$('#investasi').empty();
		nama.options[0] = new Option("Pilih..");
		$('#investasi').val("Pilih..").change();
		data_investasi.forEach(function(item, index) {
			nama.options[nama.options.length] = new Option(item.NOMOR_INVESTASI);
		});
	}

// Tambah Investasi
	function open_investasi() {
		var indeks = document.getElementById('investasi').selectedIndex - 1;

		if (indeks >= 0) {
			var e_investasi = data_investasi[indeks].NOMOR_INVESTASI;
			var e_budget = (data_investasi[indeks].TOTAL_BUDGET).replace(',','.');
			var e_realisasi = (data_investasi[indeks].TERPAKAI).replace(',','.');
			var e_sisa = angka(e_budget) - angka(e_realisasi);

			$('#btn_investasi').click();

			$('#e_investasi').val(e_investasi);
			$('#e_budget').val(format_number(Number(e_budget).toFixed(2)));
			$('#e_realisasi').val(format_number(Number(e_realisasi).toFixed(2)));
			$('#e_sisa').val(format_number(Number(e_sisa).toFixed(2)));
		}
	}

// Tambah Material SIP
	$('#btn_material').on('click', function() {
		var id_supplier = $('#supplier').val().split('-')[0];
		var kd_unit = $('#unit').val().split('@_@')[0];
		var data = [id_supplier, kd_unit];

		if (id_supplier == '' || kd_unit == '') {return;}
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/data_sip" ?>',
			success: function(data) {
				data_sip = JSON.parse(data);

				isi_data_sip(data_sip);
				pagination_input();
				$('#btn_sip').click();
			}
		});
	});

// Isi Data Material
	function isi_data_sip(data_sip) {
		$('#tbl_sip').DataTable().destroy();
		$("#body_sip").find("tr").remove();

		var urut = 0;
		for (var i = 0; i < data_sip.length; i++) {
			no_sip = data_sip[i].NO_SIP;
			nomor_sakti = data_sip[i].NOMOR_SAKTI;
			nama_barang = data_sip[i].NAMA + ' ' + data_sip[i].SPESIFIKASI + ' (' + data_sip[i].NO_REKJURNAL + ')';
			pemesan = data_sip[i].PEMESAN;
			bagian = data_sip[i].BAGIAN;
			qty_sip = (angka(data_sip[i].QTY_SIP) - data_sip[i].QTY_PO).toFixed(0);
			satuan = data_sip[i].SATUAN;
			id_material_supply = data_sip[i].ID_MATERIAL_SUPPLY;
			id_sip_detail = data_sip[i].ID_SIP_DETAIL;

			if (qty_sip > 0 && nomor_sakti != null) {
				urut++;
				$('#body_sip').append('<tr><td align="center"><input type="checkbox" name="pilih_barang" style="cursor: pointer;"></td><td align="center">' + urut + '</td><td>' + no_sip + '</td><td>' + nama_barang + '</td><td>' + pemesan + '</td><td>' + bagian + '</td><td align="right">' + format_number(qty_sip) + '</td><td align="center">' + satuan + '</td><td hidden>' + id_material_supply + '</td><td hidden>' + id_sip_detail + '</td></tr>');
			}
		}
	}

// Pilih Material SIP
	$('#btn_pilih').click(function() {
		$('#tbl_sip').DataTable().destroy();

		var tabel_material = document.getElementById('tabel_material');
		var tbl_sip = document.getElementById('tbl_sip');
		var qty_data = tbl_sip.rows.length;

		if (tbl_sip.rows[1].cells[1].innerHTML != '1') {
			return;
		}

		for (var i = 0; i < qty_data - 1; i++) {
			var status = document.getElementsByName('pilih_barang')[i].checked;

			ganda = 0;
			if (status == true) {
				no_sip = tbl_sip.rows[i + 1].cells[2].innerHTML;
				nama_material = tbl_sip.rows[i + 1].cells[3].innerHTML;
				satuan = tbl_sip.rows[i + 1].cells[7].innerHTML;
				qty_sip = tbl_sip.rows[i + 1].cells[6].innerHTML + ' ' + satuan;
				id_material_supply = tbl_sip.rows[i + 1].cells[8].innerHTML;
				id_sip_detail = tbl_sip.rows[i + 1].cells[9].innerHTML;
				qty_po = '', harga = '', mata_uang = 'IDR', id_po_detail = '', deadline = '';

            // Cegah material ganda
				for (var j = 0; j < tabel_material.rows.length - 1; j++) {
					t_id_sip_detail = tabel_material.rows[j + 1].cells[12].innerHTML;
					if (t_id_sip_detail == id_sip_detail) {ganda++;}
				}

				if (ganda == 0) {			
					isi_material(no_sip, nama_material, satuan, qty_sip, id_material_supply, id_sip_detail, qty_po, harga, id_po_detail, deadline, mata_uang);
				}
			}
		}
	});

// Isi Data Material
	function isi_material(no_sip, nama_material, satuan, qty_sip, id_material_supply, id_sip_detail, qty_po, harga, id_po_detail, deadline, mata_uang) {
		var option = document.createElement('option');
		var row = $('#tabel_material tr').length-1;

		if (deadline == '') {deadline = <?php echo json_encode(date("d-M-Y")); ?>;}
		$('#tabel_material').append(
			'<tr>' +
			'<td><input type="text" class="form-control" name="urut" style="width: 100%; text-align:center;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + no_sip + '" title="' + no_sip + '" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control" value="' + nama_material + '" title="' + nama_material + '" style="width: 100%;" readonly></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="satuan">' +
			'<option value="">Pilih..</option> ' +
			'<?php foreach ($satuan->result_array() as $dt) : ?>' +
			'<option><?php echo $dt['SATUAN']; ?></option>' +
			'<?php endforeach; ?>' +
			'</select></td>' +
			'<td><input type="text" class="form-control" value="' + format_number(qty_sip) + '" style="width: 100%; text-align: center;" readonly></td>' +
			'<td><input type="text" class="form-control num" value="' + qty_po + '"  name="qty_spp" style="width: 100%; text-align: center;" autocomplete="off" onkeyup="isi_total()" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><input type="text" class="form-control num" value="' + harga + '"  name="harga" style="width: 100%; text-align: right;" autocomplete="off" onkeyup="isi_total()" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
			'<td><select class="form-control select" style="width: 100%;" name="mata_uang">' +
			'<option selected>IDR</option>' +
			'<option>USD</option>' +
			'<option>CNY</option>' +
			'<option>RMB</option>' +
			'<option>EURO</option>' +
			'</select></td>' +
			'<td><input type="text" class="form-control" name="total" style="width: 100%; text-align: right;" readonly></td>' +
			'<td hidden><input type="text" class="form-control datepicker" value="' + deadline + '" name="deadline" value="<?php echo date('d-M-y'); ?>" style="width: 100%; text-align: center; background-color: #FFFFFF; cursor: pointer;" readonly></td>' +
			'<td><button type="button" class="btn btn-block btn-danger" title="Hapus Material" onclick="hapus_material(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
			'<td hidden>' + id_material_supply + '</td>' +
			'<td hidden>' + id_sip_detail + '</td>' +
			'<td hidden>' + id_po_detail + '</td>' +
			'</tr>')
		$(".select").select2();
		$(".datepicker").datepicker({
			dateFormat: 'dd-M-yy'
		});

		document.getElementsByName('satuan')[row].value = satuan;
		document.getElementsByName('mata_uang')[row].value = mata_uang;
		nomor_urut();
		onlynumeric();
		$(".select").select2();
	}

// Isi Sisa Roll
	function isi_total() {
		var qty_data = $('#tabel_material tr').length;
		var sub_total = 0;

		for (var i=0; i<qty_data-1; i++) {
			total = 0;
			qty_spp = document.getElementsByName('qty_spp')[i].value;
			harga = document.getElementsByName('harga')[i].value;

			if (qty_spp == '' || harga == '') {
				total = '';
			} else {
				total = angka(qty_spp) * angka(harga);
			}

			document.getElementsByName('qty_spp')[i].value = format_number(qty_spp);
			document.getElementsByName('harga')[i].value = format_number(harga);
			document.getElementsByName('total')[i].value = format_number(Number(total).toFixed(2));
			sub_total = sub_total + Number(total);
		}
		$('#total_harga').val(format_number(sub_total.toFixed(2)));
	}

// Isi Nomor Urut Material
	function nomor_urut() {
		var tabel_material = document.getElementById('tabel_material');

		for (var i = 0; i < tabel_material.rows.length - 1; i++) {
			document.getElementsByName('urut')[i].value = i + 1;
		}
	}

// Hapus List Material
	function hapus_material(btn) {
		row = btn.parentNode.parentNode;
		row.parentNode.removeChild(row);
		nomor_urut();
	};

// Cek Budget Bulanan
	function cek_budget(kode_unit, tanggal, id_material_supply, total_harga, id_edit) {
		var data = [kode_unit, tanggal, id_material_supply, total_harga, id_edit];
		var status_budget = '';

		$.ajax({
			data: {data: data},
			type: 'POST',
			async: false,
			url: '<?php echo base_url() . "index.php/pembelian/po/cek_budget" ?>',
			success: function(data) {
				status_budget = data;
			}
		});

		return status_budget;
	}

// Cek Duplikasi Nomor
	function cek_nomor(nmr_po, kode_unit, investasi, tgl, kode_keuangan) {
		var id_supplier = $('#supplier').val().split('-')[0];
		var cek_nmr = [];
		var data = [nmr_po, kode_unit, id_edit, id_supplier, investasi, tgl, kode_keuangan];

		if (kode_keuangan == undefined) {error_isian('Nama Supplier belum dipilih..');}
		$.ajax({
			async: false,
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/cek_nomor" ?>',
			success: function(data) {
				data = JSON.parse(data);
				
				cek_nmr = data;
			}
		});

		return cek_nmr;
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
		var id_supplier = $('#supplier').val().split('-')[0];
		var kode_keuangan = $('#supplier').val().split('-')[1];
		var jenis = $('#supplier').val().split('-')[2];
		var lokal = jenis == '4' ? 'I' : 'L';
		var kurs = jenis == '4' ? angka($('#kurs').val()) : 1;
		var urut_po = $('#nmr_po').val();
		var kode_transaksi = $('#nomer_transaksi').html();
		var nmr_po = urut_po + kode_transaksi;
		var tanggal = $('#tanggal').val();
		var deltime = $('#deltime').val();
		var discount = $('#discount').val();
		var top = $('#top').val();
		var ppn = $('#ppn').val();
		var investasi = $('#investasi').val();
		var kode_unit = $('#unit').val().split('@_@')[0];
		var id_bayar = $('#cara_bayar').val();
		var total = 0;
		var qty_spp = [], satuan = [], harga = [], mata_uang = [], deadline = [], id_material_supply = [], id_sip_detail = [], id_po_detail = [], total_harga = [], satuan = [];
		var cek_nmr = cek_nomor(nmr_po, kode_unit, investasi, tanggal, kode_keuangan);

		if (cek_nmr[0] != '0') {error_isian('Nomor sudah terpakai..');}
		if (urut_po == '000000' || kode_transaksi == '-') {error_isian('Nomor salah..');}
		if (kode_unit == '') {error_isian('Unit belum diisi..');}
		if (tabel_material.rows.length == 1) {error_isian('Belum ada barang yang dipilih');}
		if (cek_nmr[1] != '0') {error_isian('PO sudah divalidasi Keuangan..');}
		if (cek_nmr[2] != '1') {error_isian('Jenis Supplier NPWP/ non NPWP salah..');}
		if ((nmr_po.substring(15,16) != 'R' && ppn != '0') || (nmr_po.substring(15,16) == 'R' && ppn < 10) || ppn < 0) {error_isian('PPN salah..');}
		if (discount == '' || top == '' || nmr_po == '') {error_isian('Isian salah..');}
		if (cek_nmr[3] == 0 && investasi != '' && investasi != 'Pilih..') {error_isian('Ijin Investasi sudah close..');}
		if (cek_nmr[4] != 'ok') {error_isian('Jenis Supplier Keuangan tidak sesuai..');}
		if (lokal == 'I' && kurs < 2) {error_isian('Kurs Kalkulasi untuk produk Import salah..');}

		for (var i = 0; i < tabel_material.rows.length - 1; i++) {
			t_qty_spp = angka(document.getElementsByName('qty_spp')[i].value);
			t_satuan = document.getElementsByName('satuan')[i].value;
			t_harga = angka(document.getElementsByName('harga')[i].value);
			t_mata_uang = document.getElementsByName('mata_uang')[i].value;
			t_deadline = document.getElementsByName('deadline')[i].value;
			t_total = document.getElementsByName('total')[i].value;
			t_id_material_supply = tabel_material.rows[i + 1].cells[11].innerHTML;
			t_id_sip_detail = tabel_material.rows[i + 1].cells[12].innerHTML;
			t_id_po_detail = tabel_material.rows[i + 1].cells[13].innerHTML;

			if (t_qty_spp == '' || t_harga == '' || t_deadline == '') {error_isian('Isian salah..');}

			qty_spp.push(t_qty_spp);
			satuan.push(t_satuan);
			harga.push(t_harga);
			mata_uang.push(t_mata_uang);
			deadline.push(deltime);
			id_material_supply.push(t_id_material_supply);
			id_sip_detail.push(t_id_sip_detail);
			id_po_detail.push(t_id_po_detail);

			t_total = angka(t_total);
			total = Number(total) + Number(t_total);

			total_harga.push(t_total);
		}

	// Cek Budget Investasi
		var budget = angka($('#e_sisa').val());
		var sisa = Number(budget) - total + Number(harga_edit) + (Number(budget) * 10/100);
		
		if (investasi == 'Pilih..') {investasi = '';}
		if (sisa < 0 && investasi != '') {error_isian('Melebihi budget investasi..');}

	// Cek Budget Pembelian
		var budget = cek_budget(kode_unit, tanggal, id_material_supply, total_harga, id_edit);
		if (budget != '') {
			budget = JSON.parse(budget);
			error_isian('Budget Pembelian ' + budget[0] + ' tidak mencukupi, kurang Rp.' + format_number(Math.abs(budget[1]).toFixed(2)));
		}

		var material = [id_material_supply, qty_spp, harga, mata_uang, deadline, satuan, id_sip_detail, id_po_detail];
		var data = [material, nmr_po, tanggal, id_bayar, investasi, kode_unit, top, discount, ppn, id_edit, id_supplier, lokal, kurs];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/simpan" ?>',
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

// Print Data
	function cetak(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		var nomer_spp = data_table.rows[row].cells[5].innerHTML;
		var total = 0;

		$.ajax({
			async: false,
			data: {data: nomer_spp},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/cetak" ?>',
			success: function(data) {
				data = JSON.parse(data);

				lokal = data[0].NOMER.substring(15, 16) == 'I' ? 'IMP' : 'LKL';
				$('#e_tgl').html('Kudus,'+data[0].TGL);
				$('#e_nomor_spp').html('No SPL &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp : '+data[0].NOMOR_SPP + '&nbsp &nbsp (' + data[0].NOMER.substring(0, 16) + ')');
				$('#e_lokal').html('No NPWP &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  : 0.1.462.748.3 - 511.000 &nbsp &nbsp &nbsp &nbsp (' + lokal + ')');
				$('#e_supplier').html(data[0].SUPPLIER);
				$('#e_alamat').html(data[0].ALAMAT+'&nbsp ,&nbsp'+data[0].KOTA);
				//$('#e_kota').html(data[0].KOTA);
				$('#e_del_time').html(data[0].DEL_TIME);
				$('#e_gm').html('( ' + data[0].GM.toUpperCase() + ' )');
				$('#e_pimpinan').html('( ' +data[0].PIMPINAN.toUpperCase() + ' )');
				$('#e_akuntan').html('( ' +data[0].AKUNTAN.toUpperCase() + ' )');
				$('#e_pembelian').html('( ' +data[0].PEMBELIAN.toUpperCase() + ' )');
				$('#alamat_kirim').html(data[0].ALAMAT_KIRIM);
                

				    
				for (var i=0; i<20; i++) {
					tbl_print.rows[i].cells[0].innerHTML = '';
					tbl_print.rows[i].cells[1].innerHTML = '';
					tbl_print.rows[i].cells[2].innerHTML = '';
					tbl_print.rows[i].cells[3].innerHTML = '';
					tbl_print.rows[i].cells[4].innerHTML = '';
				}

				   

				for (var i = 0; i < data.length; i++) {
					t_total = data[i].QTY.replaceAll(',', '.') * data[i].HARGA.replaceAll(',', '.');
					tbl_print.rows[i].cells[0].innerHTML = i + 1;
					tbl_print.rows[i].cells[1].innerHTML = format_number(Number(data[i].QTY.replaceAll(',', '.'))) + ' ' + data[i].SATUAN;
					tbl_print.rows[i].cells[2].innerHTML = data[i].NAMA + ' ' + data[i].SPESIFIKASI;
					tbl_print.rows[i].cells[3].innerHTML = format_number(Number(data[i].HARGA.replaceAll(',', '.')).toFixed(2));
					tbl_print.rows[i].cells[4].innerHTML = format_number(Number(t_total).toFixed(2));
					total = total + Number(t_total);
				}

				ppn = data[0].PPN == null ? 0 : Number(data[0].PPN) * total / 100;
				sub_total = total + ppn;

				$('#e_top').html(data[0].TOP + ' HARI');
				$('#e_total').html(format_number(total.toFixed(2)));
				$('#e_ppn').html(format_number(ppn.toFixed(2)));
				$('#e_sub_total').html(format_number(sub_total.toFixed(2)));

            	// Cetak Data
				var printable = document.getElementById('printable');
				var non_printable = document.getElementById('non_printable');

				printable.style.display = "";
				non_printable.style.display = "none";
				
				$('html, body').animate({scrollTop: $("#printable").offset().top}, 0);
				window.print();

				printable.style.display = "none";
				non_printable.style.display = "";
			}
		});
	}

// Edit Data
	function edit(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_edit = data_table.rows[row].cells[1].innerHTML; 
		
		$('html, body').animate({scrollTop: $("#non_printable").offset().top}, 1000);
		$.ajax({
			async: false,
			data: {data: id_edit},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/edit" ?>',
			success: function(data) {
				data = JSON.parse(data);

				$('#tanggal').val(format_date(data[0].TGL)).change();
				$('#deltime').val(format_date(data[0].DEL_TIME)).change();
				$('#unit').val(data[0].KD_UNIT + '@_@' + data[0].KODE_TRANSAKSI).change();
				$('#supplier').val(data[0].ID_SUPPLIER + '-' + data[0].KODE_KEUANGAN + '-' + data[0].KODE_JENIS).change();
				$('#cara_bayar').val(data[0].ID_CARA_BAYAR).change();
				$('#discount').val(data[0].DISCOUNT).change();
				$('#top').val(data[0].TOP).change();
				$('#kurs').val(desimal(data[0].KURS)).change();
				$('#investasi').val('Pilih..').change();
				$("#tabel_material").find("tr:gt(0)").remove();

				var urut = 0;
				for (var i = 0; i < data.length; i++) {
					no_sip = data[i].NO_SIP;
					nama_material = data[i].BARANG + ' ' + data[i].SPESIFIKASI + ' (' + data[i].NO_REKJURNAL + ')';
					satuan = data[i].SATUAN;
					qty_sip = data[i].QTY_SIP + ' ' + data[i].SATUAN_SIP;
					id_material_supply = data[i].ID_MATERIAL_SUPPLY;
					id_sip_detail = data[i].ID_SIP_DETAIL;
					qty_po = desimal(data[i].QTY);
					mata_uang = data[i].MATA_UANG;
					harga = desimal(data[i].HARGA);
					id_po_detail = data[i].ID_DETAIL;
					deadline = format_date(data[i].DEL_TIME);
					harga_edit = harga_edit + (harga*qty_po);
					
					isi_material(no_sip, nama_material, satuan, qty_sip, id_material_supply, id_sip_detail, qty_po, harga, id_po_detail, deadline, mata_uang);
				}

				setTimeout(function() {
					if (data[0].NO_INVESTASI != null) {
						$('#investasi').val(data[0].NO_INVESTASI.trim()).change();
					}
				}, 1000);
			}
		});
		setTimeout(function() {isi_total();}, 1000);
	}

// Notifikasi Hapus Data
	function batal(btn) {
		var data_table = document.getElementById('data-table');
		var row = $(btn).closest("tr").index() + 1;
		id_detail = data_table.rows[row].cells[0].innerHTML;
		id_edit = data_table.rows[row].cells[1].innerHTML;
		nmr_po = data_table.rows[row].cells[5].innerHTML;

		$('#btnHapus').click();
		$('#ya').on('click', function() {
			$('#btnProgress').click();
			$.ajax({
				data: {data: [id_detail, id_edit, nmr_po]},
				type: 'POST',
				url: '<?php echo base_url() . "index.php/pembelian/po/batal" ?>',
				success: function(data) {
					console.log(data);

					setTimeout(function() {
						$('#btnOk').click();

						if (data == '1') {
							error_isian('PO sudah divalidasi Keuangan..'); return;
						}

						$('#btnSukses').click();
						filter();
						id_detail = '', id_edit = '', nmr_po = ''; 
					}, 500);
				}
			});
		});
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

// Upload Ke SIMPG
	function upload_simpg() {
		var datatable = $('#data-table tbody')[0];
		var qty_data = datatable.rows.length;
		var kd_unit = $('#f_unit').val();
		var dt_po = [];

		if (datatable.rows[0].cells[0].innerHTML == 'No data available in table') {error_isian('Tidak ada PO yang terupload ke SIMPG..');}
		for (var i=0; i<qty_data; i++) {
			nmr_po = datatable.rows[i].cells[5].innerHTML;
			dt_po.push(nmr_po);
		}

		var data = [kd_unit, [...new Set(dt_po)]];

		$('#btnProgress').click();
		$.ajax({
			data: {data: data},
			type: 'POST',
			url: '<?php echo base_url() . "index.php/pembelian/po/upload_manual_simpg" ?>',
			success: function(data) {
				console.log(data);
				setTimeout(function() {
					$('#btnOk').click();
					$('#btnSukses').click();
				}, 500);
			}
		});
	}

// Drag Div Document
	$("#modal_investasi").draggable({
		handle: ".card-header"
	});
	$("#modal_sip").draggable({
		handle: ".card-header"
	});

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
	$('.info_3:eq(0)').on('click', function() {
		if (info_3 == 0) {
			$('.info_3:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
			info_3 = 1;
		} else {
			$('.info_3:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
			info_3 = 0;
		}
	});

</script>