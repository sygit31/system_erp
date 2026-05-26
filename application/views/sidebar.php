
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 10px;">
	<!-- Brand Logo -->
	<a href="<?php echo base_url();?>index.php/dashboard" class="brand-link bg-info">
		<img src="<?php echo base_url();?>assets\images\profits-1.png"
		alt="adminlte Logo"
		class="brand-image img-circle elevation-3"
		style="opacity: .8">
		<span class="brand-text font-weight-light"><b>Profit's Holografi</b></span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<!-- <img src="<?php echo base_url();?>assets\images\icon1.png" class="img-circle elevation-2" alt="User Image"> -->
			</div>
			<div class="info">
				<!-- <a href="<?php echo base_url();?>index.php/dashboard" class="d-block"><h2>System ERP</h2></a> -->
			</div>
		</div>

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

				<!-- MENU GUDANG -->
				<li class="nav-item has-treeview" id="menu_gudang" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Gudang
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="menu_gudang_sub_penerimaan_barang" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/penerimaan_barang'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Penerimaan Barang</p>
							</a>
						</li>
						<li class="nav-item" id="menu_gudang_sub_stok_barang" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/stok_barang'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Stok Barang</p>
							</a>
						</li>
						<li class="nav-item" id="menu_gudang_sub_stok_reject" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/stok_bayangan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Reject</p>
							</a>
						</li>
						<li class="nav-item" id="menu_gudang_sub_pengeluaran_barang" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/pengeluaran_barang'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Pengeluaran Barang</p>
							</a>
						</li>
						<li class="nav-item has-treeview" id="menu_gudang_sub_laporan_gudang" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Laporan Gudang &nbsp &nbsp &nbsp &nbsp &nbsp</p>
								<i class="right fa fa-angle-left"></i>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_gudang_sub_laporan_gudang_sub_mutasi_pet" style="display:none;">
									<a href="<?php echo site_url('gudang/pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Mutasi PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="gdg_lap_stok" style="display:none;">
									<a href="<?php echo site_url('gudang/stok'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Stok Bahan</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="gdg_saldo" style="display:none;">
									<a href="<?php echo site_url('gudang/saldo_awal'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Saldo Awal</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<li class="nav-item has-treeview" id="gdg_kertas" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Kertas Banderoll
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="gdg_terima_kertas" style="display:none;">
							<a href="<?php echo site_url('gudang/kertas/terima_kertas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Penerimaan Kertas</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="gdg_ekspedisi_kertas" style="display:none;">
							<a href="<?php echo site_url('gudang/kertas/ekspedisi_kertas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Ekspedisi Kertas</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU PRODUKSI -->
				<li class="nav-item has-treeview" id="menu_produksi" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Produksi
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_submit" style="display:none;">
							<a href="<?php echo site_url('produksi/submit'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Submission</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_pet" style="display:none;">
							<a href="<?php echo site_url('produksi/pet'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>PET</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_downtime" style="display:none;">
							<a href="<?php echo site_url('produksi/downtime'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Downtime</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_reject" style="display:none;">
							<a href="<?php echo site_url('produksi/reject'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Reject</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_lap" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Laporan</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_kk" style="display:none;">
									<a href="<?php echo site_url('produksi/lap_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Monitoring KK</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_jam" style="display:none;">
									<a href="<?php echo site_url('produksi/lap_jam'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Downtime</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_mutasi" style="display:none;">
									<a href="<?php echo site_url('produksi/lap_mutasi'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Mutasi PET</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU PEMBELIAN -->
				<li class="nav-item has-treeview" id="menu_pembelian" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Pengadaan
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_rfq" style="display:none;">
							<a href="<?php echo site_url('pembelian/rfq'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Request for Quotation</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_price_comp" style="display:none;">
							<a href="<?php echo site_url('pembelian/price'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Price Comparison</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_po" style="display:none;">
							<a href="<?php echo site_url('pembelian/po'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Purchase Order</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_master" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Master &nbsp &nbsp &nbsp &nbsp &nbsp</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_material" style="display:none;">
									<a href="<?php echo site_url('pembelian/material'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Material</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_supplier" style="display:none;">
									<a href="<?php echo site_url('pembelian/supplier'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Supplier</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ppic_sip" style="display:none;">
							<a href="<?php echo site_url('ppic/sip/show_sip'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>SIP</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_sp" style="display:none;">
							<a href="<?php echo site_url('pembelian/sp'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Surat Pengantar</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_lpb" style="display:none;">
							<a href="<?php echo site_url('pembelian/lpb'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>LPB</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="pemb_lap" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Data Laporan</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_lap_sip" style="display:none;">
									<a href="<?php echo site_url('pembelian/lap_sip'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp SIP</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_lap_budget" style="display:none;">
									<a href="<?php echo site_url('pembelian/lap_budget'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Budget</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU QC -->
				<li class="nav-item has-treeview" id="menu_qc" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Quality Control
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item has-treeview" id="menu_qc_sub_master_qc" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Master QC &nbsp &nbsp &nbsp &nbsp &nbsp</p>
								<i class="right fa fa-angle-left"></i>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_qc_sub_master_qc_sub_parameter" style="display:none;">
									<a href="<?php echo site_url('sgt/qc/master_parameter'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Parameter</p>
									</a>
								</li>
								<li class="nav-item" id="menu_qc_sub_master_qc_sub_test_requirement" style="display:none;">
									<a href="<?php echo site_url('sgt/qc/requirement'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Test Requirement</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item" id="menu_qc_sub_check_qc" style="display:none;">
							<a href="<?php echo site_url('sgt/qc/cek_qc'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Check QC</p>
							</a>
						</li>
						<li class="nav-item" id="menu_qc_sub_check_qc_gagal" style="display:none;">
							<a href="<?php echo site_url('sgt/qc/cek_qc_gagal'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Validasi Check QC</p>
							</a>
						</li>
						<li class="nav-item" id="menu_qc_sub_cetak_label" style="display:none;">
							<a href="<?php echo site_url('sgt/qc/cetak_label'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Cetak Label</p>
							</a>
						</li>
						<li class="nav-item" id="menu_qc_sub_laporan_qc" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Laporan QC &nbsp &nbsp &nbsp &nbsp &nbsp</p>
								<i class="right fa fa-angle-left"></i>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_qc_sub_laporan_qc_sub_test" style="display:none;">
									<a href="<?php echo site_url('sgt/qc/laporan_qc'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Test QC</p>
									</a>
								</li>
								<li class="nav-item" id="menu_qc_sub_laporan_qc_sub_test_table" style="display:none;">
									<a href="<?php echo site_url('sgt/qc/laporan_qc_table'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Test QC Tabel</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU SISTEM -->
				<li class="nav-item has-treeview" id="menu_sistem" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Sistem
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_project" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>Project</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_input_project" style="display:none;">
									<a href="<?php echo site_url('sistem/project/input_project'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Input Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_summary_project" style="display:none;">
									<a href="<?php echo site_url('sistem/summary_project'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Summary Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_data_project" style="display:none;">
									<a href="<?php echo site_url('sistem/data_project'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_ide" style="display:none;">
									<a href="<?php echo site_url('sistem/ide/show_ide'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Gagasan</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_nilai" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>Penilaian</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_nilai_input" style="display:none;">
									<a href="<?php echo site_url('sistem/nilai/show_nilai'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Input Nilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_penilai" style="display:none;">
									<a href="<?php echo site_url('sistem/penilai/show_penilai'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Master Penilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_ploting" style="display:none;">
									<a href="<?php echo site_url('sistem/ploting/show_nilai'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Hasil Nilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_detail_nilai" style="display:none;">
									<a href="<?php echo site_url('sistem/ploting/detail_nilai'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Detail Penilaian</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_nilai_plus" style="display:none;">
									<a href="<?php echo site_url('sistem/adjust'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Nilai Khusus</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_bmi" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>BMI</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_bmi_input" style="display:none;">
									<a href="<?php echo site_url('sistem/bmi/show_bmi'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Input BMI</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_bmi_result" style="display:none;">
									<a href="<?php echo site_url('sistem/bmi/laporan_bmi'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Laporan BMI</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_arsip" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>Arsip</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_lap_arsip" style="display:none;">
									<a href="<?php echo site_url('sistem/arsip_lap'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Daftar Arsip</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU R&D -->
				<li class="nav-item has-treeview" id="menu_rnd" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							R&D
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="menu_rnd_mst" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Master</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_rnd_mst_produk" style="display:none;">
									<a href="<?php echo site_url('rnd/produk/show_produk'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Produk</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_rnd_mst_flow" style="display:none;">
									<a href="<?php echo site_url('rnd/flow/show_flow'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Flow Proses</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_rnd_mst_proses" style="display:none;">
									<a href="<?php echo site_url('rnd/proses/input_proses'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp BOM</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="rnd_hlreader" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Holo Reader</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="rnd_hlreader_loc" style="display:none;">
									<a href="<?php echo site_url('rnd/location/show_location'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Master Lokasi</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="rnd_hlreader_mst" style="display:none;">
									<a href="<?php echo site_url('rnd/hlreader/show_hlreader'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Holo Reader</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="rnd_hlreader_mut" style="display:none;">
									<a href="<?php echo site_url('rnd/hlreader_mut/input_hlreader'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Trans. Holo Reader</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU PPIC -->
				<li class="nav-item has-treeview" id="menu_ppc" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							PPIC
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ppc_kp" style="display:none;">
							<a href="<?php echo site_url('ppic/kp/show_kp'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Kartu Perintah</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ppic_budget" style="display:none;">
							<a href="<?php echo site_url('ppic/budget'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Budget Plan</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU CUSTOMER SERVICE -->
				<li class="nav-item has-treeview" id="menu_cs" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Customer Service
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cs_risalah" style="display:none;">
							<a href="<?php echo site_url('cs/risalah/show_risalah'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Risalah Rapat</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cs_revisi" style="display:none;">
							<a href="<?php echo site_url('cs/rev_risalah/show_risalah_rev'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Revisi Risalah</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cs_meeting" style="display:none;">
							<a href="<?php echo site_url('cs/meeting'); ?>" class="nav-link" target="_blank">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Meeting</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU TEKNISI -->
				<li class="nav-item has-treeview" id="menu_teknisi" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Engineering
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="tek_master" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Master &nbsp &nbsp &nbsp &nbsp &nbsp</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="tek_master_mesin" style="display:none;">
									<a href="<?php echo site_url('teknisi/teknisi/show_mesin'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Mesin</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU HRD -->
				<li class="nav-item has-treeview" id="menu_hrd" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							HRD
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="hrd_karyawan" style="display:none;">
							<a href="<?php echo site_url('hrd/karyawan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Data Karyawan</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="hrd_master" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Master &nbsp &nbsp &nbsp &nbsp &nbsp</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="hrd_master_bagian" style="display:none;">
									<a href="<?php echo site_url('hrd/bagian'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Bagian</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="hrd_master_jabatan" style="display:none;">
									<a href="<?php echo site_url('hrd/jabatan'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Jabatan</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU IT SUPPORT -->
				<li class="nav-item has-treeview" id="menu_it" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							IT Support
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="it_data" style="display:none;">
							<a href="<?php echo site_url('it/data/historis'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Data Historis</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU GALVANIK -->
				<li class="nav-item has-treeview" id="menu_galv" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Galvanik
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_kp" style="display:none;">
							<a href="<?php echo site_url('galvanik/kp/show_kp'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Monitoring KP</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_proses" style="display:none;">
							<a href="<?php echo site_url('galvanik/proses/show_proses'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Laporan Proses</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_master" style="display:none;">
							<a href="<?php echo site_url('galvanik/master'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Penggunaan Master</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_stok" style="display:none;">
							<a href="<?php echo site_url('galvanik/pch'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Stok PCH</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_ipb" style="display:none;">
							<a href="<?php echo site_url('galvanik/ipb?kode_menu=galv_ipb'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Bon PCH</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_reject" style="display:none;">
							<a href="<?php echo site_url('galvanik/reject?kode_menu=galv_reject'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Retur PCH</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="galv_musnah" style="display:none;">
							<a href="<?php echo site_url('galvanik/musnah'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Pemusnahan PCH</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU COST CONTROL -->
				<li class="nav-item has-treeview" id="menu_cc" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Cost Control
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cc_budget" style="display:none;">
							<a href="<?php echo site_url('cc/budget'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p> Budget</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cc_budget_app" style="display:none;">
							<a href="<?php echo site_url('cc/budget_app'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p> Budget Approval</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cc_rekening" style="display:none;">
							<a href="<?php echo site_url('cc/rekening'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Rekening</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cc_lap" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Laporan &nbsp &nbsp &nbsp &nbsp &nbsp</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="cc_invest" style="display:none;">
									<a href="<?php echo site_url('cc/invest'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Ijin Investasi</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="cc_lpb" style="display:none;">
									<a href="<?php echo site_url('cc/lpb'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp LPB</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU FINISHING -->
				<li class="nav-item has-treeview" id="menu_fn" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Finishing
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="fn_barcode" style="display:none;">
							<a href="<?php echo site_url('finishing/barcode'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Cetak Barcode</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU STAMPING -->
				<li class="nav-item has-treeview" id="menu_st" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Stamping
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="st_barcode" style="display:none;">
							<a href="<?php echo site_url('stamping/barcode'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Cetak Barcode</p>
							</a>
						</li>
					</ul>
				</li>
				
				<!-- MENU DASHBOARD -->
				<li class="nav-item has-treeview" id="menu_ds" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Dashboard
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ds_reminder" style="display:none;">
							<a href="<?php echo site_url('dash/reminder'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-primary"></i>
								<p>Notifikasi</p>
							</a>
						</li>
					</ul>
				</li>
				
				<!-- MENU ADMINISTRATOR -->
				<li class="nav-item has-treeview" id="menu_administrator" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Administrator
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="menu_administrator_sub_kelola_akun" style="display:none;">
							<!-- <a href="<?php echo site_url('administrator/kelola_akun'); ?>" class="nav-link"> -->
								<a href="<?php echo site_url('administrator/akun'); ?>" class="nav-link">
									<i class="nav-icon fa fa-circle-o text-info"></i>
									<p>Kelola Akun</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item" id="adm_menu" style="display:none;">
								<a href="<?php echo site_url('administrator/menu'); ?>" class="nav-link">
									<i class="nav-icon fa fa-circle-o text-info"></i>
									<p>Master Menu</p>
								</a>
							</li>
						</ul>
						<ul class="nav nav-treeview">
							<li class="nav-item" id="adm_log" style="display:none;">
								<a href="<?php echo site_url('administrator/log'); ?>" class="nav-link">
									<i class="nav-icon fa fa-circle-o text-info"></i>
									<p>Log User</p>
								</a>
							</li>
						</ul>
					</li>

				</ul>
			</nav>
		</div>
	</aside>