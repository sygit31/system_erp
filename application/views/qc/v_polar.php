<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>

<!-- Custom CSS -->
<style>

    body {
        padding-right: 0 !important;
    }

    .select2-container--open {
        z-index: 9999999;
    }

    @media print {
        @page {
            size: landscape;
        }

        #tbl_print td {
            height: 20px;
            vertical-align: middle;
            padding-left: 5px;
        }

        #tbl_print thead td, #tbl_print tbody td, #tbl_print tfoot td {
            border: 1px solid #6C6C6C;
        }
    }

</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Pengujian Polar</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-6"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Nomor</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <input type="number" id="nmr" name="" class="form-control" value="0000" maxlength="4" onfocusout="isi_nomor(this, 4)" autocomplete="off">
                                        <div class="m-2"></div>
                                        <?php $years = range(date('Y', strtotime('-1 years')), date('Y', strtotime('+1 years'))); ?>
                                        <select class="select_min" id="desain" onchange="auto_no()" style="width: 100%;">
                                            <?php foreach ($years as $dt) { ?>
                                                <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <input id="tgl" type="text" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                        <div class="m-2"></div>
                                        <input type="time" class="form-control" id="jam" value="07:00" style="width: 70%;">
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Mesin - Produk</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <select class="select_min" id="mesin" style="width: 100%;">
                                            <option value="1">Polar 1</option>
                                            <option value="2">Polar 2</option>
                                        </select>
                                        <div class="m-2"></div>
                                        <select class="select_min" id="produk" onchange="auto_no()" style="width: 100%;">
                                            <option value="1">Seri 1</option>
                                            <option value="2">Seri 2</option>
                                            <option value="3">Seri 3</option>
                                            <option value="4">MMEA</option>
                                            <option value="M">Meterai</option>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Ruang</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">RH<input type="number" id="rh_ruang" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Suhu<input type="number" id="sh_ruang" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pemeriksa</th>
                                <td>
                                    <select class="select_min" id="pemeriksa" style="width: 100%;">
                                        <?php foreach ($pemeriksa->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>" <?php if ($dt['ID'] == '293') {echo 'selected';} ?>><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Approval</th>
                                <td>
                                    <select class="select_min" id="approval" style="width: 100%;">
                                        <?php foreach ($approval->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Operator</th>
                                <td>
                                    <select class="select_min" id="operator" style="width: 100%;">
                                        <?php foreach ($operator->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <table width="100%">
                            <tr>
                                <th width="40%">Kode</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Cutter<input type="text" class="form-control text-uppercase text-center" id="label_cutter" autocomplete="off"></div>
                                        <div class="text-info ml-2 mr-2">Sortir<input type="text" class="form-control text-uppercase text-center" id="kode_sortir" autocomplete="off"></div>
                                        <div class="text-info">QC<input type="text" class="form-control text-uppercase text-center" id="kode_qc" autocomplete="off"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Qty</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Bahan<input type="number" id="qty_bahan" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Sampling<input type="number" id="qty_sampling" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Sisipan<input type="number" id="qty_sisipan" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Visual</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Siku<select class="select_min" id="siku" style="width: 100%;">
                                            <option value="1">Acc</option>
                                            <option value="0">Rej</option>
                                        </select></div>
                                        <div class="m-2"></div>
                                        <div class="text-info">Mis Reg.<select class="select_min" id="miss_reg" style="width: 100%;">
                                            <option value="1">Acc</option>
                                            <option value="0">Rej</option>
                                        </select></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Temuan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">KU<input type="number" id="ku" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Holo<input type="number" id="holo" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <div class="text-info">Kertas<input type="number" id="kertas" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Remark</th>
                                <td>
                                    <textarea id="remark" class="form-control" rows="2" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" id="simpan" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Polar</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table class="tbl_filter" style="width: 700px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="18%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="21%" class="filter">Mesin</th>
                                        <th></th>
                                        <th width="24%" class="filter">Produk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_desain" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option selected><?php echo $dt['DESAIN']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_mesin" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="1">Polar 1</option>
                                                <option value="2">Polar 2</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_produk" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="1">Seri 1</option>
                                                <option value="2">Seri 2</option>
                                                <option value="3">Seri 3</option>
                                                <option value="4">MMEA</option>
                                                <option value="M">Meterai</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <table id="tbl_excel" hidden></table>
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="3">No.</th>
                                        <th rowspan="3">Desain</th>
                                        <th rowspan="3">Tanggal</th>
                                        <th rowspan="3">Nomor Urut</th>
                                        <th rowspan="3">Mesin</th>
                                        <th rowspan="3">Jam</th>
                                        <th rowspan="2" colspan="2">RH Ruang</th>
                                        <th colspan="5">Label Sortir</th>
                                        <th colspan="6">Control Hasil Potongan</th>
                                        <th colspan="3">Keterangan Reject</th>
                                        <th rowspan="3">Operator</th>
                                        <th rowspan="3">Remark</th>
                                        <th rowspan="3">Cetak</th>
                                        <th rowspan="3">Edit</th>
                                        <th rowspan="3">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Seri</th>
                                        <th rowspan="2">Nomor Cutter</th>
                                        <th colspan="2">Kode</th>
                                        <th>Bahan</th>
                                        <th>Ctrl</th>
                                        <th>Sisipan</th>
                                        <th rowspan="2">Kesikuan</th>
                                        <th rowspan="2">Mis Reg.</th>
                                        <th>Qty Acc</th>
                                        <th>Qty Rej</th>
                                        <th rowspan="2">KU</th>
                                        <th rowspan="2">Holo</th>
                                        <th rowspan="2">Kertas</th>
                                    </tr>
                                    <tr>
                                        <th>%</th>
                                        <th>°C</th>
                                        <th>Sortir</th>
                                        <th>QC</th>
                                        <th>Lembar</th>
                                        <th>Kali</th>
                                        <th>Lbr</th>
                                        <th>Lbr</th>
                                        <th>Lbr</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr style="font-weight: bold; text-align: center;">
                                        <td colspan="12">Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="2"></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td colspan="5"></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer btn_excel">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pengujian Polar')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="card-footer text-right">
                <button type="button" id="btnYa" class="btn btn-danger" data-dismiss="modal" style="width: 150px;"><i class="fa fa-exclamation mr-2"></i><b>Yes</b></button>
                <button type="button" id="btnNo" class="btn btn-primary" data-dismiss="modal" style="width: 150px;"><i class="fa fa-share mr-2"></i><b>No</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 13px; margin-left: 27mm;">
    <div style="width: 200px;  margin-bottom: 15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 10mm; width: auto;">
    </div>

    <h6 align="center" style="margin-top: -13mm;">LAPORAN PEMERIKSAAN MUTU PRODUK DALAM PROSES MESIN POTONG</h6>
    <h6 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 076/PNP-HLG/QC.2-POLAR/MSN.1/18/II/2025</div></h6>
    <table id="tbl_print" class="mt-2" style="width: 100%; font-size: 12px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="3">No.</td>
                <td rowspan="3">Mesin</td>
                <td rowspan="3">Jam</td>
                <td rowspan="2" colspan="2">RH Ruang</td>
                <td colspan="5">Label Sortir</td>
                <td colspan="6">Control Hasil Potongan</td>
                <td colspan="3">Keterangan Reject</td>
            </tr>
            <tr>
                <td rowspan="2">Seri</td>
                <td rowspan="2">Nomor<br>Cutter</td>
                <td colspan="2">Kode</td>
                <td>Bahan</td>
                <td>Ctrl</td>
                <td>Sisipan</td>
                <td rowspan="2">Kesikuan</td>
                <td rowspan="2">Mis Reg.</td>
                <td>Qty Acc</td>
                <td>Qty Rej</td>
                <td rowspan="2">KU</td>
                <td rowspan="2">Holo</td>
                <td rowspan="2">Kertas</td>
            </tr>
            <tr>
                <td>%</td>
                <td>°C</td>
                <td>Sortir</td>
                <td>QC</td>
                <td>Lembar</td>
                <td>Kali</td>
                <td>Lbr</td>
                <td>Lbr</td>
                <td>Lbr</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr style="font-weight: bold; text-align: center;">
                <td colspan="9">Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr style="height: 25px; font-size: 12px;">
                <td colspan="22" style="vertical-align: top;"><b>Remark :</b></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 10px; margin-bottom: 10px;">F-SMT-QC2-022 Rev. 05</div>
    <div class="row">
        <div class="col-4" style="margin-top: -20px; font-size: 10px;">
            <div>Keterangan :</div>
            <div>Tanda "V" = Baik / Sesuai Standar</div>
            <div class="mt-2">CC :</div>
            <div>1. Yth. Bag. Finishing</div>
            <div>2. File</div>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <table class="table-borderless mt-1 mr-5" style="width: 100%; height: 90px;">
                <tr style="line-height: 5px;">
                    <td>Mengetahui,</td>
                    <td width="30%">Pemeriksa,</td>
                    <td width="30%"></td>
                </tr>
                <tr>
                    <td></td>
                    <td>1.</td>
                    <td>2.</td>
                </tr>
                <tr style="vertical-align: bottom;">
                    <td>
                        <div id="p_approval">( ...................... )</div>
                        <div>Kabag / Kabid QC</div>
                    </td>
                    <td>
                        <div id="p_pemeriksa">( ...................... )</div>
                        <div>QC Finish - Polar</div>
                    </td>
                    <td>
                        <div id="p_operator">( ...................... )</div>
                        <div>Operator Polar</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=3"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() < 1200) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        auto_no();
        filter();
    });

// Auto Nomor
    function auto_no() {
        var id_edit =$('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var desain = $('#desain').val();
        var tipe = $('#produk').val() == 'M' ? 'N' : 'C';
        var data = [id_edit, tgl, desain, tipe];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/polar/auto_no" ?>',
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
        var desain = $('#f_desain').val();
        var produk = $('#f_produk').val();
        var mesin = $('#f_mesin').val();
        var data = [tgl1, tgl2, desain, produk, mesin];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/polar/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    t_bahan = 0, t_sampling = 0, t_sisipan = 0, t_acc = 0, t_rej = 0, t_ku = 0, t_holo = 0, t_kertas = 0; 
                    for (var i=0; i<data.length; i++) {
                        siku = data[i].SIKU == '1' ? 'OK' : 'NO';           
                        miss_reg = data[i].MISS_REG == '1' ? 'OK' : 'NO';
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;

                        t_bahan = t_bahan + Number(data[i].QTY_BAHAN);
                        t_sampling = t_sampling + Number(data[i].QTY_SAMPLING);
                        t_sisipan = t_sisipan + Number(data[i].QTY_SISIPAN);
                        t_acc = t_acc + Number(data[i].QTY_ACC);
                        t_rej = t_rej + Number(data[i].QTY_REJ);
                        t_ku = t_ku + Number(data[i].KU);
                        t_holo = t_holo + Number(data[i].HOLO);
                        t_kertas = t_kertas + Number(data[i].KERTAS);

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>Polar '+data[i].MESIN+'</td><td>'+data[i].JAM+'</td><td>'+format_number(data[i].RH_RUANG)+'</td><td>'+format_number(data[i].SH_RUANG)+'</td><td>'+data[i].PRODUK+'</td><td>'+data[i].LABEL_CUTTER+'</td><td>'+data[i].KODE_SORTIR+'</td><td>'+data[i].KODE_QC+'</td><td>'+format_number(data[i].QTY_BAHAN)+'</td><td>'+format_number(data[i].QTY_SAMPLING)+'</td><td>'+format_number(data[i].QTY_SISIPAN)+'</td><td>'+siku+'</td><td>'+miss_reg+'</td><td>'+format_number(data[i].QTY_ACC)+'</td><td>'+format_number(data[i].QTY_REJ)+'</td><td>'+format_number(data[i].KU)+'</td><td>'+format_number(data[i].HOLO)+'</td><td>'+format_number(data[i].KERTAS)+'</td><td align="left">'+data[i].OPERATOR+'</td><td align="left">'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }
                    $('#tbl tfoot td:eq(1)').html(format_number(t_bahan));
                    $('#tbl tfoot td:eq(2)').html(format_number(t_sampling));
                    $('#tbl tfoot td:eq(3)').html(format_number(t_sisipan));
                    $('#tbl tfoot td:eq(5)').html(format_number(t_acc));
                    $('#tbl tfoot td:eq(6)').html(format_number(t_rej));
                    $('#tbl tfoot td:eq(7)').html(format_number(t_ku));
                    $('#tbl tfoot td:eq(8)').html(format_number(t_holo));
                    $('#tbl tfoot td:eq(9)').html(format_number(t_kertas));

                    if ($(window).width() < 1200) {
                        $('#tbl thead th:eq(12), #tbl tbody td:nth-child(25)').hide();
                        $('.btn_excel').hide();
                    }

                    setTimeout(function() {
                        $('#btnOk').click();
                        page('tbl');
                    }, 500);
                }
            }); 
        }, 500);
    }

// Kosongkan Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#jam').val('07:00');
        $('#rh_ruang').val('0');
        $('#sh_ruang').val('0');
        $('#label_cutter').val('');
        $('#kode_sortir').val('');
        $('#kode_qc').val('');
        $('#qty_bahan').val('0');
        $('#qty_sampling').val('0');
        $('#qty_sisipan').val('0');
        $('#siku').val('1').change();
        $('#miss_reg').val('1').change();
        $('#ku').val('0');
        $('#holo').val('0');
        $('#kertas').val('0');
        $('#remark').val('');
    }

// Error Isian
    function error_isian(str) {
        $('#btnOk').click();
        $('#error_isian').removeClass('invisible');
        $('#error_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        var id_edit = $('#nmr').attr('name');
        var nmr = $('#nmr').val();
        var desain = $("#desain").val();
        var tgl = $("#tgl").val();
        var jam = $("#jam").val();
        var mesin = $("#mesin").val();
        var produk = $("#produk").val();
        var tipe = produk == 'M' ? 'N' : 'C';
        var rh_ruang = angka($("#rh_ruang").val());
        var sh_ruang = angka($("#sh_ruang").val());
        var id_pemeriksa = $("#pemeriksa").val();
        var id_approval = $("#approval").val();
        var id_operator = $("#operator").val();
        var label_cutter = huruf($("#label_cutter").val().toUpperCase());
        var kode_sortir = huruf($("#kode_sortir").val().toUpperCase());
        var kode_qc = huruf($("#kode_qc").val().toUpperCase());
        var qty_bahan = angka($("#qty_bahan").val());
        var qty_sampling = angka($("#qty_sampling").val());
        var qty_sisipan = angka($("#qty_sisipan").val());
        var siku = $("#siku").val();
        var miss_reg = $("#miss_reg").val();
        var ku = angka($("#ku").val());
        var holo = angka($("#holo").val());
        var kertas = angka($("#kertas").val());
        var qty_rej = ku + holo + kertas;
        var qty_acc = qty_bahan - qty_rej;
        var remark = huruf($("#remark").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (jam == '') {error_isian('Jam belum diisi..');}
        if (rh_ruang == '0') {error_isian('RH Ruang belum diisi..');}
        if (sh_ruang == '0') {error_isian('Suhu Ruang belum diisi..');}
        if (label_cutter == '') {error_isian('Label Cutter belum diisi..');}
        if (kode_sortir == '') {error_isian('Kode Sortir belum diisi..');}
        if (kode_qc == '') {error_isian('Kode QC belum diisi..');}
        if (qty_bahan == '') {error_isian('Qty Bahan belum diisi..');}
        if (qty_sampling == '') {error_isian('Qty Sampling belum diisi..');}
        if (qty_sisipan == '') {error_isian('Qty Sisipan belum diisi..');}
        if (qty_acc == '0' && qty_rej == '0') {error_isian('Qty Reject/Acc belum diisi..');}

        var data = [id_edit, nmr, desain, tgl, jam, mesin, produk, rh_ruang, sh_ruang, id_pemeriksa, id_approval, id_operator, label_cutter, kode_sortir, kode_qc, qty_bahan, qty_sampling, qty_sisipan, siku, miss_reg, qty_acc, qty_rej, ku, holo, kertas, remark, tipe];

        $('#btnProgress').click();   
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/polar/simpan" ?>',
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        kosong();
                        filter();
                    }, 500);
                }
            });
        }, 500);
    }

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/polar/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR);
                    $("#tgl").val(format_date(data.TGL));
                    $('#desain').val(data.DESAIN).change().change();
                    $('#jam').val(data.JAM).change();
                    $('#mesin').val(data.MESIN).change();
                    $('#produk').val(data.PRODUK).change();
                    $('#rh_ruang').val(data.RH_RUANG.replace(',', '.')).change();
                    $('#sh_ruang').val(data.SH_RUANG.replace(',', '.')).change();
                    $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                    $('#approval').val(data.ID_APPROVAL).change();
                    $('#operator').val(data.ID_OPERATOR).change();
                    $('#label_cutter').val(data.LABEL_CUTTER).change();
                    $('#kode_sortir').val(data.KODE_SORTIR).change();
                    $('#kode_qc').val(data.KODE_QC).change();
                    $('#qty_bahan').val(data.QTY_BAHAN).change().focus();
                    $('#qty_sampling').val(data.QTY_SAMPLING).change();
                    $('#qty_sisipan').val(data.QTY_SISIPAN).change();
                    $('#siku').val(data.SIKU).change();
                    $('#miss_reg').val(data.MISS_REG).change();
                    $('#ku').val(data.KU).change();
                    $('#holo').val(data.HOLO).change();
                    $('#kertas').val(data.KERTAS).change();
                    $('#remark').val(data.REMARK).change().focus();
                    $('#simpan').focus();

                    setTimeout(function() {$('#btnOk').click();}, 500);
                }
            });
        }, 500);
        $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 500);
    }

// Hapus Data
    function hapus(btn) {
        var id_hapus = btn.name;

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/polar/hapus" ?>',
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

// Cetak Data
    function cetak(btn) {
        var id_cetak = btn.name;
        var numbers_1 = [], numbers_2 = [], numbers_3 = [], numbers_4 = [];

        $('#tbl_print tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/polar/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                tipe = data[0].PRODUK == 'M' ? 'N/' : '';
                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC2-Polar/' + tipe + tgl + '/' + bln + '/' + thn;
                ket = '<b>Remark :</b><br>';

                $('#nmr_print').html('No : ' + nmr);
                $('#p_approval').html('<b><u>' + data[data.length-1].APPROVAL + '</u></b>');
                $('#p_pemeriksa').html('<b><u>' + data[data.length-1].PEMERIKSA + '</u></b>');
                $('#p_operator').html('<b><u>' + data[data.length-1].OPERATOR.replaceAll(',', ', ') + '</u></b>');
                $('#tbl_print tbody tr').remove();

                t_mesin = '', urut = 0, t_bahan = 0, t_sampling = 0, t_sisipan = 0, t_acc = 0, t_rej = 0, t_ku = 0, t_holo = 0, t_kertas = 0; 
                for (var i=0; i<data.length; i++) {
                    t_ket = data[i].REMARK == null ? '' : data[i].REMARK + '; ';
                    ket = ket + t_ket;
                    siku = data[i].SIKU == '1' ? '&#10003;' : 'X';
                    miss_reg = data[i].MISS_REG == '1' ? '&#10003;' : 'X';
                    seri = data[i].PRODUK == '1' ? 'I' : (data[i].PRODUK == '2' ? 'II' : (data[i].PRODUK == '3' ? 'III' : (data[i].PRODUK == '4' ? 'MMEA' : 'Meterai')));

                    if (t_mesin != data[i].MESIN && t_mesin != '') {
                        $('#tbl_print tbody').append('<tr style="font-weight: bold; text-align: center;"><td colspan="9">Total</td><td>'+format_number(t_bahan)+'</td><td>'+format_number(t_sampling)+'</td><td>'+format_number(t_sisipan)+'</td><td colspan="2"></td><td>'+format_number(t_acc)+'</td><td>'+format_number(t_rej)+'</td><td>'+format_number(t_ku)+'</td><td>'+format_number(t_holo)+'</td><td>'+format_number(t_kertas)+'</td></tr>');

                        urut = 0, t_bahan = 0, t_sampling = 0, t_sisipan = 0, t_acc = 0, t_rej = 0, t_ku = 0, t_holo = 0, t_kertas = 0;
                    }

                    urut = urut + 1;
                    t_bahan = t_bahan + Number(data[i].QTY_BAHAN);
                    t_sampling = t_sampling + Number(data[i].QTY_SAMPLING);
                    t_sisipan = t_sisipan + Number(data[i].QTY_SISIPAN);
                    t_acc = t_acc + Number(data[i].QTY_ACC);
                    t_rej = t_rej + Number(data[i].QTY_REJ);
                    t_ku = t_ku + Number(data[i].KU);
                    t_holo = t_holo + Number(data[i].HOLO);
                    t_kertas = t_kertas + Number(data[i].KERTAS);
                    t_mesin = data[i].MESIN

                    $('#tbl_print tbody').append('<tr align="center"><td>'+urut+'</td><td>Polar '+data[i].MESIN+'</td><td>'+data[i].JAM+'</td><td>'+data[i].RH_RUANG+'</td><td>'+data[i].SH_RUANG+'</td><td>'+seri+'</td><td>'+data[i].LABEL_CUTTER+'</td><td>'+data[i].KODE_SORTIR+'</td><td>'+data[i].KODE_QC+'</td><td>'+format_number(data[i].QTY_BAHAN)+'</td><td>'+data[i].QTY_SAMPLING+'</td><td>'+data[i].QTY_SISIPAN+'</td><td>'+siku+'</td><td>'+miss_reg+'</td><td>'+format_number(data[i].QTY_ACC)+'</td><td>'+format_number(data[i].QTY_REJ)+'</td><td>'+data[i].KU+'</td><td>'+data[i].HOLO+'</td><td>'+data[i].KERTAS+'</td></tr>');
                }
                $('#tbl_print tfoot tr:eq(0) td:eq(1)').html(format_number(t_bahan));
                $('#tbl_print tfoot tr:eq(0) td:eq(2)').html(format_number(t_sampling));
                $('#tbl_print tfoot tr:eq(0) td:eq(3)').html(format_number(t_sisipan));
                $('#tbl_print tfoot tr:eq(0) td:eq(5)').html(format_number(t_acc));
                $('#tbl_print tfoot tr:eq(0) td:eq(6)').html(format_number(t_rej));
                $('#tbl_print tfoot tr:eq(0) td:eq(7)').html(format_number(t_ku));
                $('#tbl_print tfoot tr:eq(0) td:eq(8)').html(format_number(t_holo));
                $('#tbl_print tfoot tr:eq(0) td:eq(9)').html(format_number(t_kertas));

                $('#tbl_print tfoot tr:eq(1) td:eq(0)').html(ket);

                var printable = document.getElementById('printable');
                var non_printable = document.getElementById('non_printable');

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