<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<style>body {padding-right: 0 !important}</style>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper" id="non_printable">
    <section class="content-header"></section>
    <section class="content">

        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title"><b>Create LPB</b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body" style="margin-bottom: -50px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6"> 
                                <table width="100%">
                                    <tr>
                                        <th width="40%">Tanggal LPB</th>
                                        <td width="60%">
                                            <input type="text" id="tanggal" class="form-control datepicker" value="<?php echo date("d-M-Y"); ?>" style="width: 150px; background-color: #FFFFFF; cursor: pointer;" onchange="isi_kode_transaksi()" readonly tabindex="1">
                                        </td>
                                    </tr>
                                    <tr style="height: 10px;"></tr>
                                    <tr>
                                        <th>Nomor LPB</th>
                                        <td>
                                            <div class="input-group">
                                                <div style="width: 100px; margin-right: 15px;"><input type="text" id="nomer_lpb" class="form-control" tabindex="2" value="000000" maxlength="6" onfocusout="isi_nomor()"></div>
                                                <label id="nomer_transaksi" style="width: 200px; margin-top: 5px;">-</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="font-size: 13px;">
                        <div class="table-responsive pb-2 mb-2">
                            <table style="width: 700px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="40%" colspan="2" class="filter bg-danger">Periode SP</th>
                                        <td></td>
                                        <th width="30%" class="filter bg-danger">Divisi</th>
                                        <td></td>
                                        <th width="30%" class="filter bg-danger">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_Tgl1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                        <td><input id="f_Tgl2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter()" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_Unit" onchange="filter()" style="width: 100%;">
                                                <?php foreach ($unit->result_array() as $dt) : ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_Polos" onchange="filter()" style="width: 100%;">
                                                <option value="All">All</option>
                                                <option value="R">Resmi</option>
                                                <option value="P">Polos</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table"></div>
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"><button type="button" class="btn btn-block btn-success" title="Export To Excel" onclick="$('.excel').click()"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                                <td></td>
                                <td width="150"><button type="button" class="btn btn-block btn-warning" title="Buat LPB Baru" onclick="buat_lpb()"><i class="fa fa-save m-2"></i><b>Buat LPB</b></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font>Laporan Penerimaan Barang (LPB)</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="font-size: 13px;">
                        <div class="table-responsive pb-2 mb-2">
                            <table style="width: 1100px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="25%" colspan="2" class="filter">Periode LPB</th>
                                        <td></td>
                                        <th width="12.5%" class="filter">Divisi</th>
                                        <td></td>
                                        <th class="filter">Nomor LPB</th>
                                        <td></td>
                                        <th width="12.5%" class="filter">Jenis Supplier</th>
                                        <td></td>
                                        <th width="17.5%" class="filter">Jenis Barang</th>
                                        <td></td>
                                        <th width="15%" class="filter">Kategori Barang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="tgl_detail1" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter_detail()" readonly></td>
                                        <td><input id="tgl_detail2" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter_detail()" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="unit_detail" onchange="filter_detail()" style="width: 100%;">
                                                <?php foreach ($unit->result_array() as $dt) : ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div style="width: 230px;"><select class="select" id="nmr_detail" onchange="filter_detail()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($nmr->result_array() as $dt) : ?>
                                                    <option><?php echo $dt['NMR']; ?></option>
                                                <?php endforeach; ?>
                                            </select></div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="resmi_detail" onchange="filter_detail()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="R">Resmi</option>
                                                <option value="P">Polos</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <div style="width: 190px;"><select class="select" id="jenis_detail" onchange="filter_detail()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($jenis->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['JENIS']; ?></option>
                                                <?php } ?>
                                            </select></div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="kategori_detail" onchange="filter_detail()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($kategori->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['KATEGORI']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="data_detail"></div> 
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"><button type="button" onclick="(function(){ $('.excel_detail').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Rekapitulasi LPB</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_3" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_3"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body" style="font-size: 13px;">
                        <div class="table-responsive pb-2 mb-2">
                            <table style="width: 600px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="50%" colspan="2" class="filter bg-success">Periode LPB</th>
                                        <td></td>
                                        <th width="25%" class="filter bg-success">Divisi</th>
                                        <td></td>
                                        <th width="25%" class="filter bg-success">Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_Tgl1_rekap" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter_rekap()" readonly></td>
                                        <td><input id="f_Tgl2_rekap" type="text" class="form-control datepicker text-center bg-white" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" style="cursor: pointer;" onchange="filter_rekap()" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_unit_rekap" onchange="filter_rekap()" style="width: 100%;">
                                                <?php foreach ($unit->result_array() as $dt) : ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo ucwords(strtolower($dt['UNIT'])); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_resmi_rekap" onchange="filter_rekap()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="R">Resmi</option>
                                                <option value="P">Polos</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="data_rekap"></div> 
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="150"> <button type="button" onclick="(function(){ $('.excel-rekap').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                                <td></td>
                                <td width="150"><button type="button" class="btn btn-block btn-warning" title="Cetak Data LPB" onclick="cetak_rekap()"><i class="fa fa-print m-2"></i><b>Cetak</b></button></td>
                                <td></td>
                                <td width="150"><button type="button" onclick="upload_simpg()" class="btn btn-block btn-danger" title="Upload to SIMPG" style="width: 150px;" hidden><i class="fa fa-upload m-2"></i><b>SIMPG</b></button></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

            <div id="ket_nomor" class="card-body invisible" style="margin-top: -20px;">
                <div class="card">
                    <div class="modal-body" id="nomor_lpb_simpan" style="font-size: 24px; color: #1F02CE; font-weight: bold;"> Nomor LPB : </div>
                </div>
            </div>

            <div class="modal-footer">
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Batal -->
<div class="modal fade" id="modal_batal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan membatalkan LPB? </div>
            <div class="modal-footer">
                <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="no_hapus" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_batal" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail SP -->
<div class="modal fade" id="modal_sp">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header m-2 rounded" style="cursor: all-scroll;">
                    <h3 class="card-title">
                        <b>
                            <font color="White">
                                <div id="headerinput">
                                    <h3>Data Surat Pengantar</h3>
                                </div>
                            </font>
                        </b>
                    </h3>
                </div>
                <div class="card-body">
                    <table width="100%" id="tbl_modal_sp" class="table table-bordered table-striped" style="font-size: 13px;" width="100%">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nomor SJ</th>
                                <th>No. PO</th>
                                <th>Nama Barang</th>
                                <th>Spesifikasi</th>
                                <th>Qty PO</th>
                                <th>Qty Datang</th>
                                <th>Harga</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <th colspan="8">Total</th>
                            <th style="text-align: right;">Rp.0,-</th>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer rounded">
                    <button id='btnTutup' style="width: 150px;" type="button" class="btn btn-danger" data-dismiss="modal" title="Tutup Informasi"><i class="fa fa-refresh m-2"></i><b>Tutup</b></button>
                    <button id="btn_sp" data-toggle="modal" data-target="#modal_sp" hidden></button>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; color: black;">
    <div style="height: 5mm;"></div>
    <div style="text-align: center; font-size: 22px; text-decoration:underline; text-underline-position: under;">LAPORAN PENERIMAAN BARANG (LPB)</div>
    <div id="unit" style="text-align: center; font-size: 18px;">HOLO PERDANA</div>
    <div style="text-align: center; font-size: 12px;">F-SMT-PEMB-010</div>
    <div id="supplier" style="font-size: 16px;">KOPERASI PURA GROUP</div>
    <div id="alamat" style="font-size: 16px;">JL. GANG KRESNA JATI WETAN KUDUS</div>

    <div style="height: 2mm;"></div>
    <table width="100%" style="font-size: 16px; line-height: 15px;">
        <tr>
            <td width="15%" align="right">No. SJ Extern &nbsp : &nbsp</td>
            <td id="sj_extern" width="45%">ABC1, ABC2</td>
            <td width="15%" align="right">No. LPB &nbsp : &nbsp</td>
            <td id="nomor_lpb_urut" width="25%">200000007579</td>
        </tr>
        <tr>
            <td align="right">Tgl. SJ Extern &nbsp : &nbsp</td>
            <td id="tgl_sj">24/11/2020</td>
            <td align="right">Tgl. LPB &nbsp : &nbsp</td>
            <td id="tgl_lpb">24/11/2020</td>
        </tr>
        <tr>
            <td align="right">No. SJ Intern &nbsp : &nbsp</td>
            <td id="sj_intern">SJ01000000001</td>
            <td align="right">Syarat Bayar &nbsp : &nbsp</td>
            <td id="syarat_bayar">30</td>
        </tr>
        <tr>
            <td align="right">No. SPP &nbsp : &nbsp</td>
            <td id="nomer_spp">000002</td>
            <td align="right">Mata Uang &nbsp : &nbsp</td>
            <td id="mata_uang">IDR</td>
        </tr>
        <tr>
            <td align="right">REG &nbsp : &nbsp</td>
            <td id="sip">&nbsp 0001</td>
            <td align="right">Kurs &nbsp : &nbsp</td>
            <td id="kurs">1</td>
        </tr>
    </table>

    <div style="height: 2mm;"></div>
    <div style="font-size: 14px; margin-bottom: 1mm;">RINCIAN BARANG :</div>
    <table width="100%" style="line-height: 6mm; font-size: 16px;">
        <thead>
            <tr align="center" style="border-bottom: 1px solid black; border-top: 1px solid black;">
                <td width="5%">No</td>
                <td width="10%">Rek.</td>
                <td width="30%">Nama Barang</td>
                <td width="10%">Kuantitas</td>
                <td width="5%">Sat</td>
                <td width="15%">Harga (Rp)</td>
                <td width="10%">(Valas)</td>
                <td width="15%">Jumlah Rp.</td>
            </tr>
        </thead>
        <tbody id="isi_tabel">
        </tbody>
        <tbody>
            <tr style="border-top: 1px solid black;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="total" align="right" class="pr-3">613,700.00</td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="ppn" align="center" colspan="2">PPN &nbsp : &nbsp 10.00%</td> 
                <td id="nilai_ppn" align="right" class="pr-3">61,3700.00</td>
            </tr>
        </tbody>
        <tbody>
            <tr style="border-top: 1px solid black;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="sub_total" align="right" class="pr-3">675,070.00</td>  
            </tr>
        </tbody>
    </table>
    <div style="height: 3mm;"></div>
    <table width="100%" style="font-size: 16px;">
        <tr>
            <td width="35%" align="center"></td>
            <td width="30%" align="center"></td>
            <td width="35%" align="center">Dibuat Oleh :</td>
        </tr>
        <tr style="height: 15mm;">
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td align="center"><span style="border-bottom: 1px solid #4A4A4A; padding-bottom: 3px;">&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp HERY DJ. &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp</span></td>
            <td align="center">____________________</td>
            <td align="center">____________________</td>
        </tr>
        <tr>
            <td align="center">PENGADAAN</td>
            <td align="center">PEMESAN</td>
            <td align="center">GUDANG</td>
        </tr>
    </table>
</div>

<style>
    #print_rekap td,
    #print_rekap th {
        border: 1px solid #ddd;
        padding: 2px;
        padding-left: 5px;
        font-size: 12px;
    }
</style>
<div id="printable_rekap" style="display: none;">
    <div style="font-size: 18px;">PT. PURA NUSA PERSADA</div>
    <div style="font-size: 18px;" id="p_unit">UNIT HOLOGRAFI</div>

    <div align="center">
        <h4><b>LAPORAN PENERIMAAN BARANG (LPB) TERBIT</b></h4>
    </div>
    <div id="p_periode" align="center">Periode</div>

    <div>Area : Gabungan</div>
    <div id="p_jenis">Jenis :</div>

    <div style="height: 5mm;"></div>
    <table width="100%" id="print_rekap">
        <thead>
            <tr align="center">
                <th>No.</th>
                <th>Nama Supplier</th>
                <th>Nomor LPB</th>
                <th>Tgl. LPB</th>
                <th>Tgl. Tempo</th>
                <th>Hutang</th>
            </tr>
        </thead>
        <tbody id="body_print">
        </tbody>
        <tbody>
            <tr>
                <th class="text-right pr-3" colspan="5">Total</th>
                <th id="p_total" class="text-right pr-2">0.00</th>
            </tr>
            <tr>
                <th class="text-right pr-3" colspan="5">Nilai DPP</th>
                <th id="p_dpp" class="text-right pr-2">0.00</th>
            </tr>
            <tr>
                <th class="text-right pr-3" colspan="5">Nila PPN</th>
                <th id="p_ppn" class="text-right pr-2">0.00</th>
            </tr>
            <tr>
                <th class="text-right pr-3" colspan="5">Nilai PPH</th>
                <th id="p_pph" class="text-right pr-2">0.00</th>
            </tr>
        </tbody>
    </table>

    <div id="p_oleh">Dicetak Oleh : Administrasi Pembelian</div>
    <div id="p_pada">Pada : 04-Dec-2020</div>
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

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

        filter();
        filter_detail();
        filter_rekap();
    });

// Kosong Isian
    function kosong() {
        $('#nomer_lpb').val('000000');
        $('#nomer_transaksi').html('-');
    }

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var datatable = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "order": [[2, "asc"]],
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "300px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'excel invisible',
                title: 'Data Laporan Penerimaan Barang'
            }]
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 1000);
    }

// Filter Data SP
    function filter() {
        var tgl1 = document.getElementById('f_Tgl1').value;
        var tgl2 = document.getElementById('f_Tgl2').value;
        var kd_unit = document.getElementById("f_Unit").value;
        var jenis = $('#f_Polos').val();
        var data = [tgl1, tgl2, kd_unit, jenis];

        $('#nomer_transaksi').html('-');
        $('#nomer_lpb').val('000000'); 
        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/pembelian/lpb/filter" ?>',
            success: function(data) {
                $('.data-table').html(data);
                setTimeout(function() {
                    $('#btnOk').click();
                    pagination();
                }, 500);
            }
        });
    }

// Pagination Modal SP
    function pagination_modal_sp() {
        tbl_modal_sp = $('#tbl_modal_sp').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true
        });

        setTimeout(function() {tbl_modal_sp.columns.adjust().draw();}, 500);
    }

// Data Detail SP
    function detail_sp(btn) {
        var dt_rekap = btn.className;
        var rekap = dt_rekap.includes('rekap');
        var data_table = document.getElementById('data-table');
        var data_rekap = document.getElementById('data_rekap');
        var row = $(btn).closest("tr").index() + 1;
    var id_detail = rekap == false ? data_table.rows[row].cells[0].innerHTML : data_rekap.rows[row].cells[0].innerHTML; // (ID SP atau ID LPB)
    var data = [id_detail, rekap];

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/detail_sp" ?>',
        success: function(data) {
            data = JSON.parse(data);
            isi_modal_sp(data);

            setTimeout(function() {pagination_modal_sp();}, 700);
        }
    });

    $('#btn_sp').click();
}

// Isi data Modal SP
function isi_modal_sp(data) {
    var t_total = 0;

    $('#tbl_modal_sp').DataTable().destroy();
    $("#tbl_modal_sp tbody").find("tr").remove();

    for (var i=0; i<data.length; i++) {
        nomor_sj = data[i].NOMOR_SJ;
        no_po = data[i].NOMER;
        nama = data[i].NAMA;
        spesifikasi = data[i].SPESIFIKASI;
        qty_po = format_number(desimal(data[i].QTY_PO));
        qty_datang = format_number(desimal(data[i].QTY_DATANG));
        harga = format_number(desimal(data[i].HARGA));
        total = desimal(data[i].TOTAL);
        $('#tbl_modal_sp tbody').append('<tr><td align="center">' + (i + 1) + '</td><td>' + nomor_sj + '</td><td>' + no_po + '</td><td>' + nama + '</td><td>' + spesifikasi + '</td><td align="right">' + qty_po + '</td><td align="right">' + qty_datang + '</td><td align="right">' + harga + '</td><td align="right">' + format_number(total) + '</td></tr>');
        t_total = t_total + total;
    }

    $('#tbl_modal_sp tfoot')[0].rows[0].cells[1].innerHTML = '<b>' + format_number(t_total) + '</b>';
}

// Isi Nomor LPB
function get_nomer_lpb() {
    auto_no();
    isi_kode_transaksi();
}

// Auto No
function auto_no() {
    var data_lpb = get_data_lpb();
    $('#nomer_lpb').val('000000');

    if (data_lpb == '') {return;}
    var kode_unit = data_lpb[0];
    var resmi_polos = data_lpb[1];
    var data = [kode_unit,resmi_polos];

    $.ajax({
        data: {data: data},
        type: 'POST',
        async: false,
        url: '<?php echo base_url() . "index.php/pembelian/lpb/auto_no" ?>',
        success: function(data) {
            $('#nomer_lpb').val(data);    
        }
    });
}

// Isi Kode Transaksi
function isi_kode_transaksi() {
    var data_lpb = get_data_lpb();
    $('#nomer_transaksi').html('-');

    if (data_lpb == '') {return;}
    var nomer_transaksi = data_lpb[2];

    $('#nomer_transaksi').html(nomer_transaksi);
}

// Get Nomer LPB
function get_data_lpb() {
    var data_table = document.getElementById('data-table');
    var qty_data = data_table.rows.length;
    var tgl = $('#tanggal').val();
    var thn = tgl.slice(-4);
    var bln = huruf_tanggal(tgl);
    var tgl = tgl.substring(0,2);
    var first_row = data_table.rows[1].cells[0].innerHTML;

    if (first_row == 'No data available in table') {return '';}
    for (var i=0; i<qty_data-2; i++) {
        var status = document.getElementsByName('lpb')[i].checked;

        if (status == true) {
            unit = data_table.rows[i+1].cells[3].innerHTML;
            no_po = data_table.rows[i+1].cells[8].innerHTML;
            kode_unit = unit.substring(0,2);
            resmi_polos = no_po.substring(15, 16);
            kode_unit == '01' ? kode_trans = '/PNP-HPD/' : kode_trans = '/PNP-HLG/';
            nomer_transaksi= '/' + resmi_polos + kode_trans + tgl + '/' + bln + '/' + thn;

            return [kode_unit,resmi_polos,nomer_transaksi];
        }
    }
    return '';
}

// Error Isian
function error_isian(str) {
    $('#error_isian').removeClass('invisible');
    $('#error_isian').html(str);
    $('#btnIsian').click();
    throw new Error("Isian salah..");
}

// Buat LPB
function buat_lpb() {
    var data_table = document.getElementById('data-table');
    var qty_data = data_table.rows.length;
    var tgl = $('#tanggal').val();
    var nomer_lpb = $('#nomer_lpb').val()
    var nomer_transaksi = $('#nomer_transaksi').html();
    var unit = '', no_po = '';
    var dt_sp = [], dt_no_sp = [], dt_po = [];

    for (var i=0; i<qty_data-2; i++) {
        var status = document.getElementsByName('lpb')[i].checked;

        if (status == true) {
            id_sp = data_table.rows[i+1].cells[0].innerHTML;
            unit = data_table.rows[i+1].cells[3].innerHTML;
            no_sp = data_table.rows[i+1].cells[6].innerHTML;
            no_po = data_table.rows[i+1].cells[8].innerHTML;

            dt_sp.push(id_sp);
            dt_no_sp.push(no_sp);
            dt_po.push(no_po);
        }
    }

    kd_unit = unit.substring(0, 2);
    kode_trans = no_po.substring(7, 14);
    resmi_polos = no_po.substring(15, 16);

    qty_nomer = cek_nomer(kd_unit, nomer_lpb, resmi_polos, dt_no_sp);

    dt_po = [...new Set(dt_po)];

    if (dt_sp.length == 0) {error_isian('Tidak ada SP yang dipilih..');}
    if (dt_po.length != 1) {error_isian('Nomor PO harus sama..');}

    var data = [dt_sp, kd_unit, tgl, nomer_lpb, nomer_transaksi];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/simpan" ?>',
        success: function(data) {
            $('#nomor_lpb_simpan').text('Nomor LPB : ' + data); 
            $('#ket_nomor').removeClass('invisible');
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
                filter();
                filter_detail();
                filter_rekap();
            }, 500);
        }
    });
}

// Cek Duplikasi Nomor
function cek_nomer(kd_unit, nomer_lpb, resmi_polos, dt_no_sp) {
    var data = [kd_unit, nomer_lpb, resmi_polos, dt_no_sp];

    $.ajax({
        data: {data: data},
        type: 'POST',
        async: false,
        url: '<?php echo base_url() . "index.php/pembelian/lpb/cek_nomer" ?>',
        success: function(data) {
            data = JSON.parse(data);
            qty_lpb = data[0];
            qty_sp = data[1];

            if (qty_lpb != 0) {error_isian('Nomor LPB sudah terpakai..');}
            if (qty_sp != 0) {error_isian('Nomor SP sudah terpakai..');}
        }
    });
}

// Pagination Detail
function pagination_detail() {
    $('#data_detail').DataTable().destroy();
    var datatable = $('#data_detail').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [[0, "asc"]],
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "500px",
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {
                columns: ':visible'
            },
            className: 'excel_detail invisible',
            title: 'Data Laporan Penerimaan Barang'
        }]
    });

    setTimeout(function() {datatable.columns.adjust().draw();}, 500);
}

// Filter Data Detail LPB
function filter_detail() {
    var tgl1 = document.getElementById('tgl_detail1').value;
    var tgl2 = document.getElementById('tgl_detail2').value;
    var kd_unit = document.getElementById('unit_detail').value;
    var resmi = document.getElementById('resmi_detail').value;
    var jenis = document.getElementById('jenis_detail').value;
    var kategori = document.getElementById('kategori_detail').value;
    var nmr = document.getElementById('nmr_detail').value;
    var data = [tgl1, tgl2, kd_unit, resmi, jenis, kategori, nmr];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/filter_detail" ?>',
        success: function(data) {
            $('.data_detail').html(data);
            setTimeout(function() {
                $('#btnOk').click();
                pagination_detail();
            }, 500);

            if (kd_unit == '12') {
                $('#data_detail thead th:nth-child(6), #data_detail tbody td:nth-child(6), #data_detail tfoot td:nth-child(2)').hide();
            }else{
                $('#data_detail thead th:nth-child(6), #data_detail tbody td:nth-child(6), #data_detail tfoot td:nth-child(2)').show();
            }
        }
    });
}

// Notifikasi Hapus Data
function batal(btn) {
    var data_detail = document.getElementById('data_detail');
    var row = $(btn).closest("tr").index() + 1;
    var nmr_lpb = data_detail.rows[row].cells[4].innerHTML;

    $('#btnHapus').click();
    $('#ya').on('click', function() {
        if (nmr_lpb == '') {return;}

        $('#btnProgress').click();
        $.ajax({
            data: {data: nmr_lpb},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/pembelian/lpb/batal" ?>',
            success: function(data) {
                $('#ket_nomor').addClass('invisible'); 

                nmr_lpb = '';
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    kosong();
                    filter();
                    filter_detail();
                    filter_rekap();
                }, 500);
            }
        });
    });
    $('#no_hapus').on('click', function() {
        nmr_lpb = '';
    });
}

// Data Detail SP
function cetak(btn) {
    var data_detail = document.getElementById('data_detail');
    var row = $(btn).closest("tr").index() + 1;
    var nmr_lpb = data_detail.rows[row].cells[4].innerHTML;
    var total = 0, ppn = 0, nilai_ppn = 0, sub_total = 0;

    $.ajax({
        async: false,
        data: {data: nmr_lpb},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/cetak" ?>',
        success: function(data) {
            data = JSON.parse(data);

            unit = data[0].UNIT;
            supplier = data[0].SUPPLIER + ' (' + data[0].KODE_KEUANGAN + ')';
            alamat = data[0].ALAMAT;
            kota = data[0].KOTA;

            sj_extern = data[0].SJ_EXTERN.substring(0,data[0].SJ_EXTERN.length-2);
            tgl_sj = data[0].TGL_SJ;
            sj_intern = data[0].SJ_INTERN.substring(0,data[0].SJ_INTERN.length-2);
            nomer_spp = data[0].NOMER_SPP;
            nomor_lpb_urut = data[0].NOMOR_LPB_URUT + ' / ' + nmr_lpb.substring(0,7);
            tgl_lpb = data[0].TGL_LPB;
            syarat_bayar = data[0].TOP;
            mata_uang = data[0].MATA_UANG;
            kurs = data[0].KURS;
            sip = (data[0].SIP).slice(0, -2);

            thn = nmr_lpb.substring(24,26);
            bln = nmr_lpb.substring(19,21);
            periode = thn + bln;
            ppn = periode >= 2204 && data[0].PPN == 10 ? 11 : data[0].PPN;

            $('#unit').html(unit);
            $('#supplier').html(supplier);
            $('#alamat').html(alamat + ' ' + kota);

            $('#sj_extern').html(sj_extern);
            $('#tgl_sj').html(tgl_sj);
            $('#sj_intern').html(sj_intern);
            $('#nomer_spp').html(nomer_spp);
            $('#nomor_lpb_urut').html(nomor_lpb_urut);
            $('#tgl_lpb').html(tgl_lpb);
            $('#syarat_bayar').html(syarat_bayar);
            $('#mata_uang').html(mata_uang);
            $('#kurs').html(kurs);
            $('#sip').html(sip);

            $("#isi_tabel").find("tr").remove();
            for (var i = 0; i < data.length; i++) {
                rek = data[i].NOMER_REKJURNAL;
                spesifikasi = data[i].SPESIFIKASI == '-' ? '' : ' - ' + data[i].SPESIFIKASI;
                nama_barang = data[i].NAMA_BARANG + spesifikasi;
                qty_datang = desimal(data[i].QTY_DATANG);
                kode_satuan = data[i].KODE_SATUAN;
                harga = desimal(data[i].HARGA);
                nilaibeli = desimal(data[i].NILAI_BELI);
                $('#isi_tabel').append('<tr><td align="center">' + (i + 1) + '</td><td align="center">' + rek + '</td><td>' + nama_barang + '</td><td align="right" class="pr-2">' + format_number(qty_datang) + '</td><td align="center">' + kode_satuan + '</td><td align="right" class="pr-2">' + format_number(harga) + '</td><td></td><td align="right" class="pr-3">' + format_number(nilaibeli.toFixed(2)) + '</td></tr>');

                total = Number(total) + Number(nilaibeli);
            }
            nilai_ppn = Number(total) * Number(ppn) / 100;
            sub_total = Number(total) + Number(nilai_ppn);
            //ppn = 'PPN &nbsp : &nbsp '+ppn+'%'; tidak dipakai per 27/12/2024
            ppn = 'PPN &nbsp : &nbsp ';

            $('#total').html(format_number(total.toFixed(2)));
            $('#ppn').html(ppn);
            $('#nilai_ppn').html(format_number(nilai_ppn.toFixed(2)));
            $('#sub_total').html(format_number(sub_total.toFixed(2)));

            // Cetak Data
            var printable = document.getElementById('printable');
            var non_printable = document.getElementById('non_printable');

            printable.style.display = "";
            non_printable.style.display = "none";
            window.print();

            printable.style.display = "none";
            non_printable.style.display = "";

            $('html, body').animate({scrollTop: $(".card-info:eq(0)").offset().top}, 100);
        }
    });
}

// Pagination LPB Rekap
function pagination_lpb_rekap() {
    $('#data_rekap').DataTable().destroy();
    var datatable = $('#data_rekap').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "columnDefs": [{"orderable": false, "targets": "_all"}],
        "order": [],
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
            className: 'excel-rekap invisible',
            title: 'Data Rekap Penerimaan Barang'
        }]
    });

    setTimeout(function() {datatable.columns.adjust().draw();}, 1000);
}

// Filter Data SP
function filter_rekap() {
    var tgl1 = document.getElementById('f_Tgl1_rekap').value;
    var tgl2 = document.getElementById('f_Tgl2_rekap').value;
    var kd_unit = document.getElementById('f_unit_rekap').value;
    var resmi = document.getElementById('f_resmi_rekap').value;
    var data = [tgl1, tgl2, kd_unit, resmi];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/filter_rekap" ?>',
        success: function(data) {
            $('.data_rekap').html(data);
            setTimeout(function() {
                $('#btnOk').click();
                pagination_lpb_rekap();
            }, 500);
        }
    });
}

// Print Dokumen
function cetak_rekap() {
    var data_rekap = document.getElementById('data_rekap');
    var qty_data = data_rekap.rows.length;
    var tgl1 = document.getElementById('f_Tgl1_rekap').value;
    var tgl2 = document.getElementById('f_Tgl2_rekap').value;
    var f_unit = document.getElementById('f_unit_rekap').value;
    var f_resmi = document.getElementById('f_resmi_rekap').value;
    var total = 0, dpp = 0, ppn = 0, pph = 0;

    f_unit = f_unit == '01' ? 'HOLO PERDANA' : 'HOLOGRAFI';
    $('#p_unit').html('DIVISI ' + f_unit);
    $('#p_periode').html('Periode ' + tgl1 + ' s/d ' + tgl2);
    $('#p_jenis').html('Jenis : ' + f_resmi);

    $("#body_print").find("tr").remove();
    for (var i = 0; i < qty_data - 2; i++) {
        suppplier = data_rekap.rows[i + 1].cells[2].innerHTML;
        nomer_lpb = data_rekap.rows[i + 1].cells[3].innerHTML;
        tgl_lpb = data_rekap.rows[i + 1].cells[4].innerHTML;
        tgl_tempo = data_rekap.rows[i + 1].cells[5].innerHTML;
        hutang = data_rekap.rows[i + 1].cells[6].innerHTML;
        nilai_dpp = data_rekap.rows[i + 1].cells[7].innerHTML;
        nilai_ppn = data_rekap.rows[i + 1].cells[8].innerHTML;
        nilai_pph = data_rekap.rows[i + 1].cells[9].innerHTML;

        $('#body_print').append('<tr style="height: 10px;"><td align="center">' + (i + 1) + '</td><td>' + suppplier + '</td><td>' + nomer_lpb + '</td><td align="center">' + tgl_lpb + '</td><td align="center">' + tgl_tempo + '</td><td align="right">' + hutang + '</td></tr>');

        total = total + Number(angka(hutang));
        dpp = dpp + Number(angka(nilai_dpp));
        ppn = ppn + Number(angka(nilai_ppn));
        pph = pph + Number(angka(nilai_pph));
    }
    $('#p_total').html(format_number(total.toFixed(2)));
    $('#p_dpp').html(format_number(dpp.toFixed(2)));
    $('#p_ppn').html(format_number(ppn.toFixed(2)));
    $('#p_pph').html(format_number(pph.toFixed(2)));
    $('#p_pada').html('Pada : ' + <?php echo json_encode(date('d-M-Y')); ?>);

    setTimeout(function() {
        var printable = document.getElementById('printable_rekap');
        var non_printable = document.getElementById('non_printable');

        printable.style.display = "";
        non_printable.style.display = "none";
        window.print();

        printable.style.display = "none";
        non_printable.style.display = "";

        $('html, body').animate({scrollTop: $(".card-success:eq(0)").offset().top}, 100);
    }, 1000);
}

// Upload Ke SIMPG
function upload_sakti(btn) {
    var data_detail = document.getElementById('data_detail');
    var row = $(btn).closest("tr").index() + 1;
    var nmr_lpb = data_detail.rows[row].cells[4].innerHTML;

    $('#btnProgress').click();
    $.ajax({
        data: {data: nmr_lpb},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/f_upload_sakti" ?>',
        success: function(data) {
            $('#nomor_lpb_simpan').text('Nomor LPB : ' + nmr_lpb); 
            $('#ket_nomor').removeClass('invisible');
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                filter_detail();
            }, 500);
        }
    });
}

// Upload Ke SIMPG
function upload_simpg() {
    var data_rekap = $('#data_rekap tbody')[0];
    var qty_data = data_rekap.rows.length;
    var unit = $('#f_unit_rekap').val();
    var dt_lpb = [];

    if (data_rekap.rows[0].cells[0].innerHTML == 'No data available in table') {error_isian('Tidak ada LPB yang terupload ke SIMPG..');}
    for (var i=0; i<qty_data; i++) {
        nomor_lpb = data_rekap.rows[i].cells[3].innerHTML;
        dt_lpb.push(nomor_lpb);
    }

    var data = [unit, dt_lpb];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/lpb/upload_simpg" ?>',
        success: function(data) {
            $('#ket_nomor').addClass('invisible'); 

            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
            }, 500);
        }
    });
}

// Isi Format Nomor 5 angka
function isi_nomor() {
    var nomer_lpb = $('#nomer_lpb').val();
    var format = '000000' + nomer_lpb;
    $('#nomer_lpb').val(format.slice(-6));
}

// Format Huruf pada Tanggal
function huruf_tanggal(string) {
    bulan = string.substring(3,6);
    dt_bulan = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    bulan = (dt_bulan.indexOf(bulan)+1).toString();
    return ('0' + bulan).slice(-2);
}

// Drag Div Document
$("#modal_sp").draggable({
    handle: ".card-header"
});

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

    setTimeout(function() {pagination();}, 500);
});

</script>