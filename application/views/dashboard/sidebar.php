
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

				<!-- MENU MONITORING KINERJA -->
				<li class="nav-item has-treeview" id="menu_mk" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Monitoring Kinerja
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="mk_tugas" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/tugas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Tugas</p>
							</a>
						</li>
						<li class="nav-item" id="mk_cetak_tugas" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/cetak_tugas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Cetak Tugas</p>
							</a>
						</li>
						<li class="nav-item" id="mk_approval" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/approval'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Approval</p>
							</a>
						</li>
						<li class="nav-item" id="mk_cetak_monitoring" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/cetak_monitoring'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Cetak Monitoring</p>
							</a>
						</li>
						<li class="nav-item" id="mk_monitoring" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/monitoring'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Monitoring</p>
							</a>
						</li>
						<li class="nav-item" id="mk_laporan" style="display:none;">
							<a href="<?php echo site_url('sgt/mk/laporan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Laporan</p>
							</a>
						</li>
					</ul>
				</li>

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
						<li class="nav-item has-treeview" id="gdg_terima" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Penerimaan
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_gudang_sub_penerimaan_barang" style="display:none;">
									<a href="<?php echo site_url('sgt/gudang/penerimaan_barang?kd_menu=menu_gudang_sub_penerimaan_barang'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp PET</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_terima_bp" style="display:none;">
									<a href="<?php echo site_url('gudang/terima_bp?kd_menu=gdg_terima_bp'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Bahan Pembantu</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_rekon" style="display:none;">
									<a href="<?php echo site_url('produksi/Pet_emboss?mn=gdg_rekon'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Rekonsil PET</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_perdana" style="display: none;">
									<a href="<?php echo site_url('gudang/terima_bp?kd_menu=gdg_perdana'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Holo Perdana</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item" id="gdg_sj" style="display:none;">
							<a href="<?php echo site_url('gudang/sj'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Surat Jalan</p>
							</a>
						</li>
						<li class="nav-item" id="menu_gudang_sub_stok_barang" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/stok_barang'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Stok Barang</p>
							</a>
						</li>
						<li class="nav-item" id="gdg_reject" style="display:none;">
							<a href="<?php echo site_url('gudang/retur'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Reject Supplier</p>
							</a>
						</li>
						<li class="nav-item" id="menu_gudang_sub_ipb" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/ipb'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>IPB PET</p>
							</a>
						</li>
						<li class="nav-item has-treeview" id="gdg_ipb_pembantu" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>IPB Pembantu
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="gdg_ipb_pembantu_create" style="display:none;">
									<a href="<?php echo site_url('gudang/ipb_bp?stat=cre&kd_menu=gdg_ipb_pembantu_create'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Create IPB</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_ipb_pembantu_approve" style="display:none;">
									<a href="<?php echo site_url('gudang/ipb_bp?stat=app&kd_menu=gdg_ipb_pembantu_approve'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Approve IPB</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_ipb_resmi" style="display:none;">
									<a href="<?php echo site_url('gudang/ipb_realisasi?mn=gdg_ipb_resmi'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Realisasi IPB</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item" id="menu_gudang_sub_pengeluaran_barang" style="display:none;">
							<a href="<?php echo site_url('sgt/gudang/pengeluaran_barang'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Pengeluaran Barang</p>
							</a>
						</li>
						<li class="nav-item has-treeview" id="menu_gudang_sub_holo_perdana" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Holo Perdana
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_gudang_sub_holo_perdana_master_gudang" style="display:none;">
									<a href="<?php echo site_url('vin/gudang/perdana_master_gudang'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Lokasi Gudang</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview" id="menu_gudang_sub_laporan_gudang" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Laporan Gudang
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="gdg_lap_kertas" style="display:none;">
									<a href="<?php echo site_url('gudang/stok_kertas'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Stok Kertas</p>
									</a>
								</li>
								<li class="nav-item" id="menu_gudang_sub_laporan_gudang_sub_mutasi_pet" style="display:none;">
									<a href="<?php echo site_url('gudang/pet'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Stok PET</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_lap_stok" style="display:none;">
									<a href="<?php echo site_url('gudang/stok?kd_menu=gdg_lap_stok'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Stok Pembantu</p>
									</a>
								</li>                                
								<li class="nav-item" id="gdg_saldo" style="display:none;">
									<a href="<?php echo site_url('gudang/saldo_awal'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Saldo Awal</p>
									</a>
								</li>
								<li class="nav-item" id="gdg_bulanan" style="display: none;">
									<a href="<?php echo site_url('gudang/bulanan_pet'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Bulanan PET</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item" id="gdg_location" style="display: none;">
							<a href="<?php echo site_url('gudang/location?mn=gdg_location'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Lokasi Gudang</p>
							</a>
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
							<a href="<?php echo site_url('gudang/kertas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Penerimaan Kertas</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="gdg_ekspedisi_kertas" style="display:none;">
							<a href="<?php echo site_url('gudang/kertas/ekspedisi_kertas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Pengeluaran Kertas</p>
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
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>PET
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_input_pet_mobile" style="display:none;">
									<a href="<?php echo site_url('sgt/produksi/input_pet_mobile'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Input Mobile</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_input_pet" style="display:none;">
									<a href="<?php echo site_url('produksi/pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Input Hasil PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_mutasi_pet" style="display:none;">
									<a href="<?php echo site_url('vin/produksi/mutasi_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Mutasi PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_wip_pet" style="display:none;">
									<a href="<?php echo site_url('produksi/wip_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  WIP PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_foil_stamping" style="display:none;">
									<a href="<?php echo site_url('produksi/foil_stamping?stat=cre'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Foil Stamping</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_rewind" style="display:none;">
									<a href="<?php echo site_url('produksi/rewind'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Rewind PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_rekon" style="display:none;">
									<a href="<?php echo site_url('produksi/Pet_emboss?mn=prod_rekon'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Rekonsil PET</p>
									</a>
								</li>
							</ul>
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
								<p>Retur Gudang</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_sticker" style="display: none;">
							<a href="<?php echo site_url('produksi/sticker'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Stiker</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_sticker" style="display: none;">
							<a href="<?php echo site_url('produksi/sticker'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Stiker</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item has-treeview" id="menu_produksi_sub_holo_perdana" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Holo Perdana
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_produksi_sub_holo_perdana_master_mesin" style="display:none;">
									<a href="<?php echo site_url('vin/produksi/perdana_master_mesin'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Mesin</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_produksi_sub_holo_perdana_master_operator_mesin" style="display:none;">
									<a href="<?php echo site_url('vin/produksi/perdana_master_operator_mesin'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Operator Mesin</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_produksi_sub_holo_perdana_master_proses_produksi" style="display:none;">
									<a href="<?php echo site_url('vin/produksi/perdana_master_proses_produksi'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Proses Produksi </p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_produksi_sub_holo_perdana_master_waste_produksi" style="display:none;">
									<a href="<?php echo site_url('vin/produksi/perdana_master_waste_produksi'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Waste Produksi </p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_lap" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Laporan
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_kk" style="display:none;">
									<a href="<?php echo site_url('produksi/lap_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Monitoring KK</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_rekap_pet" style="display:none;">
									<a href="<?php echo site_url('produksi/rekap_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Rekap IPB PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_mutasi" style="display:none;">
									<a href="<?php echo site_url('produksi/lap_mutasi_pet'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp  Lap. Mutasi PET</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="prod_lap_neraca" style="display:none;">
									<a href="<?php echo site_url('produksi/neraca_wip'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Neraca WIP</p>
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
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="prod_proses" style="display:none;">
							<a href="<?php echo site_url('produksi/setup_operator'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Setup Operator</p>
							</a>
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
								<p>Master
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_material" style="display:none;">
									<a href="<?php echo site_url('pembelian/material?mn=pemb_material'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Material</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_supplier" style="display:none;">
									<a href="<?php echo site_url('pembelian/supplier'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Supplier</p>
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
								<p>Data Laporan
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_lap_sip" style="display:none;">
									<a href="<?php echo site_url('pembelian/lap_sip'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp SIP</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="pemb_lap_budget" style="display:none;">
									<a href="<?php echo site_url('pembelian/lap_budget'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Budget</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>

				<!-- MENU SPL -->
				<li class="nav-item has-treeview" id="menu_spl" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Surat Lembur
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="spl_input" style="display:none;">
							<a href="<?php echo site_url('sgt/spl/input_spl'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Input SPL</p>
							</a>
						</li>
						<li class="nav-item" id="spl_pengajuan" style="display:none;">
							<a href="<?php echo site_url('sgt/spl/pengajuan_spl'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Pengajuan SPL</p>
							</a>
						</li>
						<li class="nav-item" id="spl_laporan" style="display:none;">
							<a href="<?php echo site_url('sgt/spl/laporan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Laporan</p>
							</a>
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
						<li class="nav-item" id="qc_bahan" style="display: none;">
							<a href="<?php echo site_url('qc/Bahan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Incoming Chemical</p>
							</a>
						</li>
						<li class="nav-item" id="qc_sticker" style="display: none;">
							<a href="<?php echo site_url('qc/Sticker'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>QC Sticker</p>
							</a>
						</li>
						<li class="nav-item" id="qc_visc" style="display: none;">
							<a href="<?php echo site_url('qc/Visc'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Viscositas</p>
							</a>
						</li>
						<li class="nav-item" id="qc_coating" style="display: none;">
							<a href="<?php echo site_url('qc/Coating'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>QC Coating</p>
							</a>
						</li>
						<li class="nav-item" id="qc_pita" style="display: none;">
							<a href="<?php echo site_url('qc/Pita'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>QC Pita</p>
							</a>
						</li>
						<li class="nav-item" id="qc_kertas" style="display: none;">
							<a href="<?php echo site_url('qc/Kertas'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>RH Kertas</p>
							</a>
						</li>
						<li class="nav-item" id="qc_sortir" style="display: none;">
							<a href="<?php echo site_url('qc/Sortir'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>QC Sortir</p>
							</a>
						</li>
						<li class="nav-item" id="qc_polar" style="display: none;">
							<a href="<?php echo site_url('qc/Polar'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Polar</p>
							</a>
						</li>
						<li class="nav-item" id="qc_packing" style="display: none;">
							<a href="<?php echo site_url('qc/Packing'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Packing</p>
							</a>
						</li>
						<li class="nav-item" id="qc_rh_fin" style="display: none;">
							<a href="<?php echo site_url('qc/Rh_fin'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>RH Kiriman</p>
							</a>
						</li>
						<li class="nav-item" id="qc_board" style="display: none;">
							<a href="<?php echo site_url('qc/Dashboard'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item has-treeview" id="qc_hpd" style="display: none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Holo Perdana
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="qc_rh_met" style="display: none;">
									<a href="<?php echo site_url('qc/Rh_met'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp RH Meterai</p>
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
								<p>Project
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_input_project" style="display:none;">
									<a href="<?php echo site_url('sistem/project/input_project'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Input Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_summary_project" style="display:none;">
									<a href="<?php echo site_url('sistem/summary_project'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Summary Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_data_project" style="display:none;">
									<a href="<?php echo site_url('sistem/data_project'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Data Project</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_ide" style="display:none;">
									<a href="<?php echo site_url('sistem/ide/show_ide'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Data Gagasan</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_nilai" style="display:none;">
							<a href="#" class="nav-link">

								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>Penilaian
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_nilai_input" style="display:none;">
									<a href="<?php echo site_url('sistem/nilai/show_nilai'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Input Nilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_penilai" style="display:none;">
									<a href="<?php echo site_url('sistem/penilai/show_penilai'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Master Penilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_ploting" style="display:none;">
									<a href="<?php echo site_url('sistem/ploting/show_nilai'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Hasil Nilai</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_detail_nilai" style="display:none;">
									<a href="<?php echo site_url('sistem/ploting/detail_nilai'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Detail Penilaian</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_nilai_plus" style="display:none;">
									<a href="<?php echo site_url('sistem/adjust'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Nilai Khusus</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_bmi" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>BMI
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_bmi_input" style="display:none;">
									<a href="<?php echo site_url('sistem/bmi/show_bmi'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Input BMI</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_bmi_result" style="display:none;">
									<a href="<?php echo site_url('sistem/bmi/laporan_bmi'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Laporan BMI</p>
									</a>
								</li>
							</ul>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="sis_pdd" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-info"></i>
								<p>PDD
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_pdd_sop" style="display: none;">
									<a href="<?php echo site_url('sistem/pdd?mn=sis_pdd_sop'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp E-document</p>
									</a>
								</li>
							</ul>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="sis_pdd_tipe" style="display:none;">
									<a href="<?php echo site_url('sistem/tipe'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Tipe Dokumen</p>
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
								<li class="nav-item" id="menu_rnd_mst_proses" style="display:none;">
									<a href="<?php echo site_url('rnd/proses/input_proses'); ?>" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp BOM</p>
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
						</li>
					</ul>

					<ul class="nav nav-treeview">
						<li class="nav-item" id="menu_rnd_prd" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Perdana</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_rnd_prd_master" style="display:none;">
									<a href="#" class="nav-link">
										<p>&nbsp &nbsp &nbsp &nbsp ~ &nbsp Master</p>
									</a>
									<ul class="nav nav-treeview">
										<li class="nav-item" id="menu_rnd_prd_master_produk" style="display:none;">
											<a href="<?php echo site_url('vin/rnd/perdana/master/produk/produk/show_produk'); ?>" class="nav-link">
												<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Produk Perdana</p>
											</a>
										</li>
									</ul>
									<ul class="nav nav-treeview">
										<li class="nav-item" id="menu_rnd_prd_master_proses" style="display:none;">
											<a href="<?php echo site_url('rnd/proses/input_proses'); ?>" class="nav-link">
												<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Formula</p>
											</a>
										</li>
									</ul>
									<ul class="nav nav-treeview">
										<li class="nav-item" id="menu_rnd_prd_master_station" style="display:none;">
											<a href="<?php echo site_url('vin/rnd/perdana/master/station/station/show_station'); ?>" class="nav-link">
												<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Station</p>
											</a>
										</li>
									</ul>
									<ul class="nav nav-treeview">
										<li class="nav-item" id="menu_rnd_prd_master_proses" style="display:none;">
											<a href="<?php echo site_url('rnd/proses/input_proses'); ?>" class="nav-link">
												<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Proses</p>
											</a>
										</li>
									</ul>
									<ul class="nav nav-treeview">
										<li class="nav-item" id="menu_rnd_prd_master_satuan" style="display:none;">
											<a href="<?php echo site_url('vin/rnd/perdana/master/satuan/satuan/show_satuan'); ?>" class="nav-link">
												<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Satuan</p>
											</a>
										</li>
									</ul>
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
									<a href="<?php echo site_url('rnd/hlreader'); ?>" class="nav-link">
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
						<li class="nav-item" id="ppc_produk" style="display:none;">
							<a href="<?php echo site_url('rnd/produk/show_produk'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Data Produk</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ppc_kp" style="display:none;">
							<a href="<?php echo site_url('ppic/kp/show_kp?mn=ppc_kp'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Kartu Perintah</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="ppc_kk" style="display:none;">
							<a href="<?php echo site_url('ppic/kk'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-warning"></i>
								<p>Kartu Kerja</p>
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
					<ul class="nav nav-treeview">
						<li class="nav-item" id="cs_arsip" style="display:none;">
							<a href="<?php echo site_url('cs/arsip?mn=cs_arsip'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Arsip</p>
							</a>
						</li>
					</ul>
				</li>

				<!-- MENU TEKNISI -->
				<li class="nav-item has-treeview" id="menu_teknisi" style="display: none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Teknisi
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="tek_terima" style="display: none;">
							<a href="<?php echo site_url('gudang/terima_bp?kd_menu=tek_terima'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Spare Part Masuk</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="tek_keluar" style="display: none;">
							<a href="<?php echo site_url('teknisi/keluar?kd_menu=tek_keluar'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Spare Part Keluar</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="tek_stok" style="display: none;">
							<a href="<?php echo site_url('gudang/stok?kd_menu=tek_stok'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Stok Spare Part</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="tek_master" style="display: none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Master
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="tek_master_mesin" style="display: none;">
									<a href="<?php echo site_url('teknisi/mesin/show_mesin'); ?>" class="nav-link">
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
				<li class="nav-item has-treeview" id="menu_galv" style="display: none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Galvanik
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item has-treeview" id="galv_hlg" style="display: none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Holografi
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="galv_kp" style="display: none;">
									<a href="<?php echo site_url('galvanik/kp?kd_unit=12'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Monitoring KP</p>
									</a>
								</li>
								<li class="nav-item" id="galv_proses" style="display: none;">
									<a href="<?php echo site_url('galvanik/proses/show_proses?kd_unit=12'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Laporan Proses</p>
									</a>
								</li>
								<li class="nav-item" id="galv_master" style="display: none;">
									<a href="<?php echo site_url('galvanik/master'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Penggunaan Master</p>
									</a>
								</li>
								<li class="nav-item" id="galv_stok" style="display: none;">
									<a href="<?php echo site_url('galvanik/pch?kd=hlg'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Stok PCH</p>
									</a>
								</li>
								<li class="nav-item" id="galv_ipb" style="display: none;">
									<a href="<?php echo site_url('galvanik/ipb?kode_menu=galv_ipb&div=hlg'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Bon PCH</p>
									</a>
								</li>
								<li class="nav-item" id="galv_reject" style="display: none;">
									<a href="<?php echo site_url('galvanik/reject?kode_menu=galv_reject'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Retur PCH</p>
									</a>
								</li>
								<li class="nav-item" id="galv_musnah" style="display: none;">
									<a href="<?php echo site_url('galvanik/musnah'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Pemusnahan PCH</p>
									</a>
								</li>
							</ul>
						</li>
						<li class="nav-item has-treeview" id="galv_hpd" style="display: none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-success"></i>
								<p>Holo Perdana
									<i class="right fa fa-angle-left"></i>
								</p>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="galv_kp_php" style="display: none;">
									<a href="<?php echo site_url('galvanik/kp?kd_unit=01'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Monitoring KP</p>
									</a>
								</li>
								<li class="nav-item" id="galv_proses_php" style="display: none;">
									<a href="<?php echo site_url('galvanik/proses/show_proses?kd_unit=01'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Laporan Proses</p>
									</a>
								</li>
								<li class="nav-item" id="galv_ipb_php" style="display: none;">
									<a href="<?php echo site_url('galvanik/ipb?kode_menu=galv_ipb&div=hpd'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Bon PCH</p>
									</a>
								</li>
								<li class="nav-item" id="galv_stok_php" style="display: none;">
									<a href="<?php echo site_url('galvanik/pch?kd=php'); ?>" class="nav-link">
										<p class="ml-4">~ &nbsp Stok PCH</p>
									</a>
								</li>
							</ul>
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
							<a href="<?php echo site_url('cc/budget?mn=cc_budget'); ?>" class="nav-link">
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

						<li class="nav-item has-treeview" id="menu_cc_sub_bskk" style="display:none;">
							<a href="#" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>BSKK &nbsp &nbsp &nbsp &nbsp &nbsp</p>
								<i class="right fa fa-angle-left"></i>
							</a>
							<ul class="nav nav-treeview">
								<li class="nav-item" id="menu_cc_sub_bskk_sub_add" style="display:none;">
									<a href="<?php echo site_url('sgt/cc/bskk/add'); ?>" class="nav-link">
										<!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
										<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Tambah</p>
									</a>
								</li>
								<li class="nav-item" id="menu_cc_sub_bskk_sub_terima" style="display:none;">
									<a href="<?php echo site_url('sgt/cc/bskk/terima'); ?>" class="nav-link">
										<!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
										<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Terima</p>
									</a>
								</li>
								<li class="nav-item" id="menu_cc_sub_bskk_sub_saldo" style="display:none;">
									<a href="<?php echo site_url('sgt/cc/bskk/saldo'); ?>" class="nav-link">
										<!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
										<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Saldo Akhir</p>
									</a>
								</li>
								<li class="nav-item" id="menu_cc_sub_bskk_sub_keluar" style="display:none;">
									<a href="<?php echo site_url('sgt/cc/bskk/keluar'); ?>" class="nav-link">
										<!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
										<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Keluar</p>
									</a>
								</li>
								<li class="nav-item" id="menu_cc_sub_bskk_sub_tarik" style="display:none;">
									<a href="<?php echo site_url('sgt/cc/bskk/tarik'); ?>" class="nav-link">
										<!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
										<p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Tarik Data</p>
									</a>
								</li>
							</ul>
						</li>

						<li class="nav-item" id="menu_cc_sub_ijininvest" style="display:none;">
							<a href="<?php echo site_url('sgt/cc/ijin_invest'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Ijin Invest</p>
							</a>
						</li>
						<li class="nav-item" id="menu_cc_sub_lpblpj_lpb" style="display:none;">
							<a href="<?php echo site_url('sgt/cc/lpblpj/lpb'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>LPB</p>
							</a>
						</li>
						<li class="nav-item" id="menu_cc_sub_lpblpj_lpj" style="display:none;">
							<a href="<?php echo site_url('sgt/cc/lpblpj/lpj'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>LPJ</p>
							</a>
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
					<ul class="nav nav-treeview">
						<li class="nav-item" id="fn_rfid" style="display:none;">
							<a href="<?php echo site_url('finishing/Rfid'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>RFID</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="fn_sortir" style="display: none;">
							<a href="<?php echo site_url('qc/Sortir?mn=fn'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Hasil Sortir</p>
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


				<!-- MENU UMUM -->
				<li class="nav-item has-treeview" id="menu_umum" style="display:none;">
					<a href="#" class="nav-link">
						<i class="nav-icon fa fa-dashboard"></i>
						<p>
							Umum
							<i class="right fa fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_validasi_waste" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/validasi_waste'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Validasi Waste</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_kirim_waste" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/kirim_waste'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Kirim Waste Tidak Standar</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_permintaan" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/permintaan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Permintaan Barang</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_cek_permintaan" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/cek_permintaan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Buat SIP</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_sip" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/sip'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Revisi SIP</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_penyampaian" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/penyampaian'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Penyampaian</p>
							</a>
						</li>
					</ul>
					<ul class="nav nav-treeview">
						<li class="nav-item" id="umum_laporan_permintaan" style="display:none;">
							<a href="<?php echo site_url('sgt/umum/laporan_permintaan'); ?>" class="nav-link">
								<i class="nav-icon fa fa-circle-o text-danger"></i>
								<p>Laporan Permintaan</p>
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