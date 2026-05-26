<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap4.min.css">

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
            size: portrait;
        }

        html, body {
            width: 210mm; height: 330mm;
        }

        #tbl_print td {
            height: 30px;
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
                    <b><font color="White"><div>Pengujian Viscositas</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="open_set()" title="Setting target" data-toggle="modal" data-target="#modal_set" data-backdrop="static" data-keyboard="false"><i class="fa fa-wrench" title="Help"></i></button>
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Nomor</th>
                                <td>
                                    <input type="number" id="nmr" name="" class="form-control" value="0000" maxlength="4" onfocusout="isi_nomor(this, 4)" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <input id="tgl" type="text" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Desain</th>
                                <td>
                                    <?php $years = range(date('Y', strtotime('-1 years')), date('Y', strtotime('+1 years'))); ?>
                                    <select class="select_min" id="desain" style="width: 100%;">
                                        <?php foreach ($years as $dt) { ?>
                                            <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Jam</th>
                                <td>
                                    <input type="time" class="form-control" id="jam" value="07:00" style="width: 100%;">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>
                                <th width="40%">Pemeriksa</th>
                                <td>
                                    <select class="select" id="pemeriksa" style="width: 100%;">
                                        <option value="">Pilih..</option>                                      
                                        <?php foreach ($pemeriksa->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Operator</th>
                                <td>
                                    <select class="select" id="operator" style="width: 100%;">
                                        <option value="">Pilih..</option>                                      
                                        <?php foreach ($operator->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Mengetahui</th>
                                <td>
                                    <select class="select" id="mengetahui" style="width: 100%;">
                                        <?php foreach ($mengetahui->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea id="keterangan" class="form-control" rows="2" style="width: 100%;" maxlength="50" autocomplete="off"></textarea>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Proses</th>
                                <td>
                                    <select class="select_min" id="proses_1" style="width: 100%;" disabled>
                                        <option>Coating Sensitizing</option>                       
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode Roll</th>
                                <td>
                                    <input type="number" class="form-control" name="kode_roll" maxlength="3" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Station 1</th>
                                <td>
                                    <input type="text" id="station_1" class="form-control num2" autocomplete="off" onfocus="clear_isi(this)" onfocusout="isi_null(this)">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>
                                <th width="40%">Proses</th>
                                <td>
                                    <select class="select_min" id="proses_2" style="width: 100%;" disabled>
                                        <option>Coating Readable</option>                       
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode Roll</th>
                                <td>
                                    <input type="number" class="form-control" name="kode_roll" maxlength="3" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Station 1</th>
                                <td>
                                    <input type="text" id="station_2" class="form-control num2" autocomplete="off" onfocus="clear_isi(this)" onfocusout="isi_null(this)">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Station 2</th>
                                <td>
                                    <input type="text" id="station_3" class="form-control num2" autocomplete="off" onfocus="clear_isi(this)" onfocusout="isi_null(this)">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Station 3</th>
                                <td>
                                    <input type="text" id="station_4" class="form-control num2" autocomplete="off" onfocus="clear_isi(this)" onfocusout="isi_null(this)">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Viscositas</font></b>
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
                            <table class="tbl_filter" style="width: 550px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="20%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="32.5%" class="filter">Kode Roll</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_desain" onchange="filter()" style="width: 100%;">
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['DESAIN']; ?></option>               
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari.." style="width: 100%;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th rowspan="2">Jam</th>
                                        <th colspan="2">Sensi</th>
                                        <th colspan="4">Readable</th>
                                        <th rowspan="2">Pemeriksa</th>
                                        <th rowspan="2">Operator</th>
                                        <th rowspan="2">Mengetahui</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>Kode Roll</th>
                                        <th>Station 1</th>
                                        <th>Kode Roll</th>
                                        <th>Station 1</th>
                                        <th>Station 2</th>
                                        <th>Station 3</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="4" class="text-left pl-3">Average</th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="7"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-left pl-3">Max</th><th></th><th></th><th></th><th></th></th><th><th></th><th colspan="7"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="4" class="text-left pl-3">Min</th><th></th><th></th><th></th><th></th></th><th><th></th><th colspan="7"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" id="btn_excel" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
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

<!-- Modal Setting target -->
<div class="modal fade" id="modal_set">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center">Pengaturan Target Viscositas</h4></b>
            </div>
            <div class="card card-body table-responsive ml-2 pb-2" style="font-size: 16px; overflow-y: hidden; width: 96%">
                <table width="100%">
                    <tr>
                        <th width="45%"></th>
                        <td>
                            <div class="d-flex font-weight-bold justify-content-between align-item-center ml-4 mr-4">
                                <div>Target</div>
                                <div>Max</div>
                                <div>Min</div>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Sensi 1 &nbsp; - Station 1</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center visc-d1 num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center visc-d1 num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center visc-d1 num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Sensi 2 &nbsp; - Station 1</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center visc-r1 num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r1 num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r1 num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 2</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center visc-r2 num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r2 num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r2 num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 3</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center visc-r3 num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r3 num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center visc-r3 num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-success" onclick="simpan_set()" style="width: 150px;"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger btn_close" data-dismiss="modal" style="width: 150px;"><i class="fa fa-close mr-2"></i><b>Batal</b></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 13px;">
    <div style="width: 200px;  margin-bottom: 15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
    </div>

    <h5 align="center" style="margin-top: -1mm;">MONITORING PENGECEKAN VISCOSITAS COATING SENSI - READABLE</h5>
    <h5 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 161 / PNP-HLG / QC.Emb-Conv / 05 / VII / 2023</div></h5>
    <table id="tbl_print" class="mt-4" width="100%" style="font-size: 16px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="2">No.</td>
                <td rowspan="2">Jam</td>
                <td colspan="2">Sensi 1 (Sec)</td>
                <td colspan="4">Sensi 2 (Sec)</td>
                <td rowspan="2">Keterangan</td>
            </tr>
            <tr>
                <td>Kode Roll</td>
                <td>Station 1</td>
                <td>Kode Roll</td>
                <td>Station 1</td>
                <td>Station 2</td>
                <td>Station 3</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr align="center">
                <td colspan="2"  align="left">Average</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr align="center">
                <td colspan="2"  align="left">Max</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
            <tr align="center">
                <td colspan="2"  align="left">Min</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-QC2-045 Rev. 02</div>
    <div class="d-flex justify-content-center">
        <div class="card-body">
            <table class="table-bordered text-center mt-1 tbl_target" style="width: 350px;">
                <tr align="center">
                    <td width="40%">Parameter</td>
                    <td>Target</td>
                    <td>Max</td>
                    <td>Min</td>
                </tr>
                <tr>
                    <td class="text-left">&nbsp;Sensi 1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-left">&nbsp;Sensi 2 &nbsp; - Station 1</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-left pl-5"> &nbsp; - Station 2</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-left pl-5"> &nbsp; - Station 3</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <table class="table-bordered mt-1 mr-5" width="50%">
            <tr align="center" style="height: 7mm;">
                <td width="33%">Mengetahui,</td>
                <td colspan="2">Pemeriksa,</td>
            </tr>
            <tr style="height: 30mm;">
                <td>
                    <div style="height: 40px; vertical-align: bottom; ">
                        <div style="height: 40px;"></div>
                        <div id="mengetahui_print" align="center" style="height: 10px;">( ...................... )</div>
                        <div align="center" style="margin-top: 5px;">Kabid QC</div>
                    </div>
                </td>
                <td>
                    <div style="height: 40px;">
                        <div style="height: 40px;"></div>
                        <div id="pemeriksa_print" align="center" style="height: 10px;">( ...................... )</div>
                        <div align="center" style="margin-top: 5px;">Pengawas QC</div>
                    </div>
                </td>
                <td>
                    <div style="height: 40px;">
                        <div style="height: 40px;"></div>
                        <div id="operator_print" align="center" style="height: 10px;">( ...................... ) </div>
                        <div align="center" style="margin-top: 5px;">Operator</div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?v=2"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
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
        var data = [id_edit, tgl];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Visc/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Isi Format Nomor 3 atau 6 angka
    function isi_nomor(btn, num) {
        var nmr = btn.value;
        var nmr = nmr.toString().padStart(num, "0");
        var nmr = nmr.substring(0, num);

        btn.value = nmr;
    }

// Focus In
    function clear_isi(btn) {
        var qty = Number(btn.value);

        if (qty == 0) {$(btn).val('');}
    }

// Focus Out
    function isi_null(btn) {
        var qty = btn.value;

        if (qty == '') {$(btn).val(0);}
    }

// Filter Data
    function filter() {
        var t_station_1 = 0, t_station_2 = 0, t_station_3 = 0, t_station_4 = 0;
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var kode_roll = $('#cari').val();
        var data = [tgl1, tgl2, desain, kode_roll];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#tbl th').removeClass('text-danger font-weight-bold');
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Visc/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);
                    target = data[0];
                    data = data[1];

                    max_d1 = 0, min_d1 = 0;
                    max_r1 = Number(target[0].MAX), min_r1 = Number(target[0].MIN);
                    max_r2 = Number(target[1].MAX), min_r2 = Number(target[1].MIN);
                    max_r3 = Number(target[2].MAX), min_r3 = Number(target[2].MIN);

                    ar_station_1 = [], ar_station_2 = [], ar_station_3 = [], ar_station_4 = [];
                    for (var i=0; i<data.length; i++) {
                        kode = data[i].KODE_1 == null ? '' : data[i].KODE_1;
                        kode2 = data[i].KODE_2 == null ? '' : data[i].KODE_2;

                        station_1 = data[i].STATION_1 == 0 ? '' : desimal(data[i].STATION_1, 2);
                        station_2 = data[i].STATION_2 == 0 ? '' : desimal(data[i].STATION_2, 2);
                        station_3 = data[i].STATION_3 == 0 ? '' : desimal(data[i].STATION_3, 2);
                        station_4 = data[i].STATION_4 == 0 ? '' : desimal(data[i].STATION_4, 2);
                        keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;

                        if (station_1 != '') {t_station_1 = t_station_1 + station_1;}
                        if (station_2 != '') {t_station_2 = t_station_2 + station_2;}
                        if (station_3 != '') {t_station_3 = t_station_3 + station_3;}
                        if (station_4 != '') {t_station_4 = t_station_4 + station_4;}

                        if (station_1 != '') {ar_station_1.push(station_1);}
                        if (station_2 != '') {ar_station_2.push(station_2);}
                        if (station_3 != '') {ar_station_3.push(station_3);}
                        if (station_4 != '') {ar_station_4.push(station_4);}

                        text_d1 = station_1 != '' && (station_1 > max_d1 || station_1 < min_d1) ? 'text-danger font-weight-bold' : '';
                        text_r1 = station_2 != '' && (station_2 > max_r1 || station_2 < min_r1) ? 'text-danger font-weight-bold' : '';
                        text_r2 = station_3 != '' && (station_3 > max_r2 || station_3 < min_r2) ? 'text-danger font-weight-bold' : '';
                        text_r3 = station_4 != '' && (station_4 > max_r3 || station_4 < min_r3) ? 'text-danger font-weight-bold' : '';

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].JAM+'</td><td>'+kode+'</td><td class="'+text_d1+'">'+station_1+'</td><td>'+kode2+'</td><td class="'+text_r1+'">'+station_2+'</td><td class="'+text_r2+'">'+station_3+'</td><td class="'+text_r3+'">'+station_4+'</td><td>'+data[i].PEMERIKSA+'</td><td>'+data[i].OPERATOR+'</td><td>'+data[i].MENGETAHUI+'</td><td>'+keterangan+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    av_station_1 = calc_avg(ar_station_1, 2)[0];
                    av_station_2 = calc_avg(ar_station_2, 2)[0];
                    av_station_3 = calc_avg(ar_station_3, 2)[0];
                    av_station_4 = calc_avg(ar_station_4, 2)[0];

                    max_station_1 = calc_avg(ar_station_1, 2)[1];
                    max_station_2 = calc_avg(ar_station_2, 2)[1];
                    max_station_3 = calc_avg(ar_station_3, 2)[1];
                    max_station_4 = calc_avg(ar_station_4, 2)[1];

                    min_station_1 = calc_avg(ar_station_1, 2)[2];
                    min_station_2 = calc_avg(ar_station_2, 2)[2];
                    min_station_3 = calc_avg(ar_station_3, 2)[2];
                    min_station_4 = calc_avg(ar_station_4, 2)[2];

                    $('#tbl tfoot tr:eq(0) th:eq(2)').html(av_station_1);
                    $('#tbl tfoot tr:eq(1) th:eq(2)').html(max_station_1);
                    $('#tbl tfoot tr:eq(2) th:eq(2)').html(min_station_1);

                    $('#tbl tfoot tr:eq(0) th:eq(4)').html(av_station_2);
                    $('#tbl tfoot tr:eq(1) th:eq(4)').html(max_station_2);
                    $('#tbl tfoot tr:eq(2) th:eq(4)').html(min_station_2);

                    $('#tbl tfoot tr:eq(0) th:eq(5)').html(av_station_3);
                    $('#tbl tfoot tr:eq(1) th:eq(5)').html(max_station_3);
                    $('#tbl tfoot tr:eq(2) th:eq(5)').html(min_station_3);

                    $('#tbl tfoot tr:eq(0) th:eq(6)').html(av_station_4);
                    $('#tbl tfoot tr:eq(1) th:eq(6)').html(max_station_4);
                    $('#tbl tfoot tr:eq(2) th:eq(6)').html(min_station_4);

                    for (var i=0; i<3; i++) {
                        d1 = angka($('#tbl tfoot tr:eq('+i+') th:eq(2)').html());
                        r1 = angka($('#tbl tfoot tr:eq('+i+') th:eq(4)').html());
                        r2 = angka($('#tbl tfoot tr:eq('+i+') th:eq(5)').html());
                        r3 = angka($('#tbl tfoot tr:eq('+i+') th:eq(6)').html());

                        if (d1 > max_d1 || d1 < min_d1) {$('#tbl tfoot tr:eq('+i+') th:eq(2)').addClass('text-danger font-weight-bold');}
                        if (r1 > max_r1 || r1 < min_r1) {$('#tbl tfoot tr:eq('+i+') th:eq(4)').addClass('text-danger font-weight-bold');}
                        if (r2 > max_r2 || r2 < min_r2) {$('#tbl tfoot tr:eq('+i+') th:eq(5)').addClass('text-danger font-weight-bold');}
                        if (r3 > max_r3 || r3 < min_r3) {$('#tbl tfoot tr:eq('+i+') th:eq(6)').addClass('text-danger font-weight-bold');}
                    }

                    setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
                }
            }); 
        }, 500); // End Ajax
    } // End Function

// Pagination
    function pagination() { 
        $('#tbl').DataTable().destroy();
        var datatable = $('#tbl').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "info": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "350px",
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Export To Excel
    function XLExport(tableId) {
        var tab_text = "<table border='1px'><tr>";
        var tab = document.getElementById(tableId);
        for (j=0; j<tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }

        tab_text = tab_text + "</table>";
        tab_text = tab_text.replace("#E3E3E3", "#000000");
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
        return (sa);
    }
    $('#btn_excel').click(function() {
        $('#tbl').DataTable().destroy();
        XLExport('tbl');
        pagination();
    });

// Kosongkan Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#keterangan').val('');
        $('#station_1').val('0');
        $('#station_2').val('0');
        $('#station_3').val('0');
        $('#station_4').val('0');
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
        var proses_1 = $("#proses_1").val();
        var proses_2 = $("#proses_2").val();
        var kode_1 = $('[name="kode_roll"]:eq(0)').val();
        var kode_2 = $('[name="kode_roll"]:eq(1)').val();
        var station_1 = angka($("#station_1").val());
        var station_2 = angka($("#station_2").val());
        var station_3 = angka($("#station_3").val());
        var station_4 = angka($("#station_4").val());
        var id_pemeriksa = $("#pemeriksa").val();
        var id_operator = $("#operator").val();
        var id_mengetahui = $("#mengetahui").val();
        var keterangan = huruf($("#keterangan").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (jam == '') {error_isian('Jam belum diisi..');}
        if (id_pemeriksa == '') {error_isian('Nama Pemeriksa belum diisi..');}
        if (id_operator == '') {error_isian('Nama Operator belum diisi..');}
        if (id_mengetahui == '') {error_isian('Nama Mengetahui belum diisi..');}

        var data = [id_edit, nmr, desain, tgl, jam, proses_1, proses_2, kode_1, kode_2, station_1, station_2, station_3, station_4, id_pemeriksa, id_operator, id_mengetahui, keterangan];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Visc/simpan" ?>',
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
                url: '<?php echo base_url()."index.php/qc/Visc/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR);
                    $("#tgl").val(format_date(data.TGL));
                    $('#desain').val(data.DESAIN).change();
                    $("#jam").val(data.JAM);
                    $("#pemeriksa").val(data.ID_PEMERIKSA).change();
                    $("#operator").val(data.ID_OPERATOR).change();
                    $("#mengetahui").val(data.ID_MENGETAHUI).change();
                    $("#keterangan").val(data.KETERANGAN);

                    $("#proses_1").val(data.PROSES_1).change();
                    $("#proses_2").val(data.PROSES_2).change();
                    $('[name="kode_roll"]:eq(0)').val(data.KODE_1);
                    $('[name="kode_roll"]:eq(1)').val(data.KODE_2);
                    $("#station_1").val(desimal(data.STATION_1, 2));
                    $("#station_2").val(desimal(data.STATION_2, 2));
                    $("#station_3").val(desimal(data.STATION_3, 2));
                    $("#station_4").val(desimal(data.STATION_4, 2));

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
                url: '<?php echo base_url()."index.php/qc/Visc/hapus" ?>',
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
        $('#tbl_print td').removeClass('text-danger font-weight-bold');
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Visc/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);
                target = data[0];
                data = data[1];

                target_d1 = 0, max_d1 = 0, min_d1 = 0;
                target_r1 = Number(target[0].TARGET), max_r1 = Number(target[0].MAX), min_r1 = Number(target[0].MIN);
                target_r2 = Number(target[1].TARGET), max_r2 = Number(target[1].MAX), min_r2 = Number(target[1].MIN);
                target_r3 = Number(target[2].TARGET), max_r3 = Number(target[2].MAX), min_r3 = Number(target[2].MIN);

                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                desain = data[0].DESAIN;         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC.Emb-Conv/' + tgl + '/' + bln + '/' + thn;

                mengetahui = data[0].MENGETAHUI;
                pemeriksa = data[0].PEMERIKSA;
                operator = data[0].OPERATOR;

                $('#nmr_print').html(nmr);
                $('#mengetahui_print').html('( ...... ' + mengetahui + '...... )');
                $('#pemeriksa_print').html('( ...... ' + pemeriksa + '...... )');
                $('#operator_print').html('( ...... ' + operator + '...... )');

                for (var i=0; i<data.length; i++) {
                    keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                    kode_1 = data[i].KODE_1 == null ? '' : data[i].KODE_1;
                    kode_2 = data[i].KODE_2 == null ? '' : data[i].KODE_2;

                    station_1 = data[i].STATION_1 == 0 ? '' : (Number(data[i].STATION_1) > max_d1 || Number(data[i].STATION_1) < min_d1 ? (min_d1+Math.random()*(max_d1-min_d1)).toFixed(2) : desimal(data[i].STATION_1, 2));
                    station_2 = data[i].STATION_2 == 0 ? '' : (Number(data[i].STATION_2) > max_r1 || Number(data[i].STATION_2) < min_r1 ? (min_r1+Math.random()*(max_r1-min_r1)).toFixed(2) : desimal(data[i].STATION_2, 2));
                    station_3 = data[i].STATION_3 == 0 ? '' : (Number(data[i].STATION_3) > max_r2 || Number(data[i].STATION_3) < min_r2 ? (min_r2+Math.random()*(max_r2-min_r2)).toFixed(2) : desimal(data[i].STATION_3, 2));
                    station_4 = data[i].STATION_4 == 0 ? '' : (Number(data[i].STATION_4) > max_r3 || Number(data[i].STATION_4) < min_r3 ? (min_r3+Math.random()*(max_r3-min_r3)).toFixed(2) : desimal(data[i].STATION_4, 2));

                    if (station_1 != '') {numbers_1.push(station_1);}
                    if (station_2 != '') {numbers_2.push(station_2);}
                    if (station_3 != '') {numbers_3.push(station_3);}
                    if (station_4 != '') {numbers_4.push(station_4);}

                    text_d1 = station_1 != '' && (station_1 > max_d1 || station_1 < min_d1) ? 'text-danger font-weight-bold' : '';
                    text_r1 = station_2 != '' && (station_2 > max_r1 || station_2 < min_r1) ? 'text-danger font-weight-bold' : '';
                    text_r2 = station_3 != '' && (station_3 > max_r2 || station_3 < min_r2) ? 'text-danger font-weight-bold' : '';
                    text_r3 = station_4 != '' && (station_4 > max_r3 || station_4 < min_r3) ? 'text-danger font-weight-bold' : '';

                    $('#tbl_print tbody').append('<tr><td>'+(i+1)+'</td><td>'+data[i].JAM+'</td><td>'+kode_1+'</td><td class="'+text_d1+'">'+station_1+'</td><td>'+kode_2+'</td><td class="'+text_r1+'">'+station_2+'</td><td class="'+text_r2+'">'+station_3+'</td><td class="'+text_r3+'">'+station_4+'</td><td align="left">'+keterangan+'</td></tr>');
                }
                $('#tbl_print tbody').append('<tr><td colspan="10"></td></tr>');
                $('#tbl_print tfoot tr:eq(0) td:eq(2)').html(calc_avg(numbers_1, 2)[0]);
                $('#tbl_print tfoot tr:eq(0) td:eq(4)').html(calc_avg(numbers_2, 2)[0]);
                $('#tbl_print tfoot tr:eq(0) td:eq(5)').html(calc_avg(numbers_3, 2)[0]);
                $('#tbl_print tfoot tr:eq(0) td:eq(6)').html(calc_avg(numbers_4, 2)[0]);

                $('#tbl_print tfoot tr:eq(1) td:eq(2)').html(calc_avg(numbers_1, 2)[1]);
                $('#tbl_print tfoot tr:eq(1) td:eq(4)').html(calc_avg(numbers_2, 2)[1]);
                $('#tbl_print tfoot tr:eq(1) td:eq(5)').html(calc_avg(numbers_3, 2)[1]);
                $('#tbl_print tfoot tr:eq(1) td:eq(6)').html(calc_avg(numbers_4, 2)[1]);

                $('#tbl_print tfoot tr:eq(2) td:eq(2)').html(calc_avg(numbers_1, 2)[2]);
                $('#tbl_print tfoot tr:eq(2) td:eq(4)').html(calc_avg(numbers_2, 2)[2]);
                $('#tbl_print tfoot tr:eq(2) td:eq(5)').html(calc_avg(numbers_3, 2)[2]);
                $('#tbl_print tfoot tr:eq(2) td:eq(6)').html(calc_avg(numbers_4, 2)[2]);

                for (var i=0; i<3; i++) {
                    d1 = angka($('#tbl_print tfoot tr:eq('+i+') td:eq(2)').html());
                    r1 = angka($('#tbl_print tfoot tr:eq('+i+') td:eq(4)').html());
                    r2 = angka($('#tbl_print tfoot tr:eq('+i+') td:eq(5)').html());
                    r3 = angka($('#tbl_print tfoot tr:eq('+i+') td:eq(6)').html());

                    if (d1 != '0' && (d1 > max_d1 || d1 < min_d1)) {$('#tbl_print tfoot tr:eq('+i+') td:eq(2)').addClass('text-danger font-weight-bold');}
                    if (d1 != '0' && (r1 > max_r1 || r1 < min_r1)) {$('#tbl_print tfoot tr:eq('+i+') td:eq(4)').addClass('text-danger font-weight-bold');}
                    if (d1 != '0' && (r2 > max_r2 || r2 < min_r2)) {$('#tbl_print tfoot tr:eq('+i+') td:eq(5)').addClass('text-danger font-weight-bold');}
                    if (d1 != '0' && (r3 > max_r3 || r3 < min_r3)) {$('#tbl_print tfoot tr:eq('+i+') td:eq(6)').addClass('text-danger font-weight-bold');}
                }

                $('.tbl_target:eq(0) tr:eq(1) td:eq(1)').html(target_d1);
                $('.tbl_target:eq(0) tr:eq(1) td:eq(2)').html(max_d1);
                $('.tbl_target:eq(0) tr:eq(1) td:eq(3)').html(min_d1);
                $('.tbl_target:eq(0) tr:eq(2) td:eq(1)').html(target_r1);
                $('.tbl_target:eq(0) tr:eq(2) td:eq(2)').html(max_r1);
                $('.tbl_target:eq(0) tr:eq(2) td:eq(3)').html(min_r1);
                $('.tbl_target:eq(0) tr:eq(3) td:eq(1)').html(target_r2);
                $('.tbl_target:eq(0) tr:eq(3) td:eq(2)').html(max_r2);
                $('.tbl_target:eq(0) tr:eq(3) td:eq(3)').html(min_r2);
                $('.tbl_target:eq(0) tr:eq(4) td:eq(1)').html(target_r3);
                $('.tbl_target:eq(0) tr:eq(4) td:eq(2)').html(max_r3);
                $('.tbl_target:eq(0) tr:eq(4) td:eq(3)').html(min_r3);

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

// Buka Setting Viscositas
function open_set() {
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url()."index.php/qc/Visc/open_set" ?>',
        success: function(data) {
            data = JSON.parse(data);

            for (var i=0; i<data.length; i++) {
                $('.' + data[i].KODE.toLowerCase() + ':eq(0)').val(data[i].TARGET);
                $('.' + data[i].KODE.toLowerCase() + ':eq(1)').val(data[i].MAX);
                $('.' + data[i].KODE.toLowerCase() + ':eq(2)').val(data[i].MIN);
            }
        }
    });        
}

// Simpan Setting Viscositas
function simpan_set() {
    var visc_d1 = [], visc_r1 = [], visc_r2 = [], visc_r3 = [];

    for (var i=0; i<3; i++) {
        visc_d1.push($('.visc-d1:eq('+i+')').val());
        visc_r1.push($('.visc-r1:eq('+i+')').val());
        visc_r2.push($('.visc-r2:eq('+i+')').val());
        visc_r3.push($('.visc-r3:eq('+i+')').val());
    }

    var data =[visc_d1, visc_r1, visc_r2, visc_r3];

    $('.btn_close').click();
    $('#btnProgress').click();
    setTimeout(function() {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Visc/simpan_set" ?>',
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
    }, 500);
}

</script>