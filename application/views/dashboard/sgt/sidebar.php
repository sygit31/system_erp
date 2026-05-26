
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
                        <li class="nav-item" id="menu_gudang_sub_stok_barang_umum" style="display:none;">
                            <a href="<?php echo site_url('sgt/gudang/stok_barang_umum'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Stok Barang Umum</p>
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
                                    <a href="<?php echo site_url('sgt/gudang/laporan_gudang'); ?>" class="nav-link">
                                        <!-- <i class="nav-icon fa fa-circle-o text-success"></i> -->
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Mutasi PET</p>
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
                            <a href="<?php echo site_url('gudang/gudang/terima_kertas'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Penerimaan Kertas</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="gdg_ekspedisi_kertas" style="display:none;">
                            <a href="<?php echo site_url('gudang/gudang/ekspedisi_kertas'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Ekspedisi Kertas</p>
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
                        <li class="nav-item" id="menu_pembelian_sub_outstanding_order" style="display:none;">
                            <a href="<?php echo site_url('pembelian/outstanding'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>Outstanding Order</p>
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
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Material</p>
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
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Parameter</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="menu_qc_sub_master_qc_sub_test_requirement" style="display:none;">
                                    <a href="<?php echo site_url('sgt/qc/requirement'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Test Requirement</p>
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
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Test QC</p>
                                    </a>
                                </li>
                                <li class="nav-item" id="menu_qc_sub_laporan_qc_sub_test_table" style="display:none;">
                                    <a href="<?php echo site_url('sgt/qc/laporan_qc_table'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Test QC Tabel</p>
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
                        <li class="nav-item" id="sis_input_project" style="display:none;">
                            <a href="<?php echo site_url('sistem/sistem/input_project'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-info"></i>
                                <p>Input Project</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="sis_summary_project" style="display:none;">
                            <a href="<?php echo site_url('sistem/sistem/summary_project'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-info"></i>
                                <p>Summary Project</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="sis_project" style="display:none;">
                            <a href="<?php echo site_url('sistem/sistem/show_project'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-info"></i>
                                <p>Data Project</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="sis_ide" style="display:none;">
                            <a href="<?php echo site_url('sistem/ide/show_ide'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-info"></i>
                                <p>Data Gagasan</p>
                            </a>
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
                        <li class="nav-item" id="menu_rnd_sub_setting" style="display:none;">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Setting &nbsp &nbsp &nbsp &nbsp &nbsp</p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="menu_rnd_sub_mesin" style="display:none;">
                                    <a href="<?php echo site_url('rnd/rnd/show_mesin'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Setting Mesin</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="menu_rnd_sub_formula" style="display:none;">
                                    <a href="<?php echo site_url('rnd/rnd/show_formula'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Setting Formula</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item" id="menu_rnd_setting" style="display:none;">
                            <a href="<?php echo site_url('rnd/rnd/show_setting'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Preview Setting</p>
                            </a>
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
                            <a href="<?php echo site_url('ppic/ppic/show_kp'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>Kartu Perintah</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="ppc_kk" style="display:none;">
                            <a href="<?php echo site_url('sgt/ppic/kk'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>Kartu Kerja</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="ppc_kk_kecil" style="display:none;">
                            <a href="<?php echo site_url('sgt/ppic/kk_kecil'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>Kartu Kerja Kecil</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="ppc_produk" style="display:none;">
                            <a href="<?php echo site_url('ppic/ppic/show_produk'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-warning"></i>
                                <p>Data Produk</p>
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
                            <a href="<?php echo site_url('cs/cs/show_risalah'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-success"></i>
                                <p>Risalah Rapat</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="cs_revisi" style="display:none;">
                            <a href="<?php echo site_url('cs/cs/show_risalah_rev'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-success"></i>
                                <p>Revisi Risalah</p>
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
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Mesin</p>
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
                                    <a href="<?php echo site_url('hrd/karyawan/show_bagian'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Bagian</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item" id="hrd_master_jabatan" style="display:none;">
                                    <a href="<?php echo site_url('hrd/karyawan/show_jabatan'); ?>" class="nav-link">
                                        <p>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp ~ &nbsp Data Jabatan</p>
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
                            <a href="<?php echo site_url('it/data/show_data'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>Bank Data</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="it_file" style="display:none;">
                            <a href="<?php echo site_url('it/data/input_data'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>File Data</p>
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
                                <p>Cek Permintaan</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item" id="umum_sip" style="display:none;">
                            <a href="<?php echo site_url('sgt/umum/sip'); ?>" class="nav-link">
                                <i class="nav-icon fa fa-circle-o text-danger"></i>
                                <p>SIP</p>
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
                    </li>

                </ul>
            </nav>
        </div>
    </aside>