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
                    <b><font color="White"><div>Pemeriksaan Packing</div></font></b>
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
                                        <input type="time" class="form-control" id="jam" value="07:30" style="width: 70%;">
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Mesin - Produk</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <select class="select_min" id="mesin" style="width: 100%;">
                                            <option value="1">Hitung 1</option>
                                            <option value="2">Hitung 2</option>
                                            <option value="3">Hitung 3</option>
                                            <option value="4">Hitung 4</option>
                                            <option value="-">Manual</option>
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
                                <th>Label Cutter</th>
                                <td><input type="text" id="cutter" class="form-control text-uppercase" autocomplete="off" style="width: 95%;"></td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Sortir<input type="text" id="sortir" class="form-control text-center text-uppercase" autocomplete="off" style="width: 95%;"></div>
                                        <div class="text-info">QC<input type="text" id="qc" class="form-control text-center text-uppercase" autocomplete="off" style="width: 95%;"></div>
                                        <div class="text-info">Packing<input type="text" id="packing" class="form-control text-center text-uppercase" autocomplete="off" style="width: 95%;"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pemeriksa</th>
                                <td>
                                    <select class="select_min" id="pemeriksa" style="width: 100%;">
                                        <?php foreach ($pemeriksa->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
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
                                <th>Pengawas</th>
                                <td>
                                    <select class="select_min" id="pengawas" style="width: 100%;">
                                        <?php foreach ($pengawas->result_array() as $dt) { ?>
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
                                <th width="40%">Jumlah</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Hasil Baik<input type="number" id="hasil_baik" class="numbers nums text-center" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                        <div class="text-info">Waste<input type="number" id="total" class="form-control text-center" value="0" style="width: 95%;" disabled></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Rim</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Total<input type="number" id="rim" class="numbers nums text-center" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                        <div class="text-info">Sampling<input type="number" id="sampling" class="numbers nums text-center" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Hitungan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">Plus (+)<input type="number" id="plus" class="numbers nums text-center" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                        <div class="text-info">Minus (-)<input type="number" id="minus" class="numbers nums text-center" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Temuan</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <div class="text-info">KU<input type="number" id="ku" class="numbers nums text-center" onchange="isi_total()" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                        <div class="text-info">Holo<input type="number" id="holo" class="numbers nums text-center" onchange="isi_total()" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
                                        <div class="text-info">Kertas<input type="number" id="kts" class="numbers nums text-center" onchange="isi_total()" value="0" style="width: 95%;" lang="en-US" autocomplete="off"></div>
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
            <div class="card-footer text-center">
                <button type="button" id="rework" class="btn btn-warning" onclick="s_filter()" style="width: 150px;" data-toggle="modal" data-target="#modal_su" data-backdrop="static" data-keyboard="false"><i class="fa fa-binoculars m-2"></i><b>Sortir Ulang</b></button>
                <button type="button" id="simpan" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Packing</font></b>
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
                                        <th width="16%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="21%" class="filter">Mesin</th>
                                        <th></th>
                                        <th width="27%" class="filter">Produk</th>
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
                                                <option value="1">Hitung 1</option>
                                                <option value="2">Hitung 2</option>
                                                <option value="3">Hitung 3</option>
                                                <option value="4">Hitung 4</option>
                                                <option value="-">Manual</option>
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
                                        <th rowspan="3">Jam</th>
                                        <th rowspan="3">Nomor Urut</th>
                                        <th rowspan="3">Mesin Hitung</th>
                                        <th colspan="5">Label Sortir</th>
                                        <th colspan="4">Pemeriksaan Sampling QC</th>
                                        <th rowspan="2" colspan="4">Keterangan Reject</th>
                                        <th rowspan="3">Pengawas<br>Packing</th>
                                        <th rowspan="3">Remark</th>
                                        <th rowspan="3">Cetak</th>
                                        <th rowspan="3">Edit</th>
                                        <th rowspan="3">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Seri</th>
                                        <th rowspan="2">Nomor Cutter</th>
                                        <th colspan="3">Kode</th>
                                        <th colspan="2">Hasil Baik</th>
                                        <th colspan="2">Hitungan</th>
                                    </tr>
                                    <tr>
                                        <th>Sortir</th>
                                        <th>QC</th>
                                        <th>Packing</th>
                                        <th>Lbr</th>
                                        <th>Rim</th>
                                        <th>+</th>
                                        <th>-</th>
                                        <th>KU</th>
                                        <th>Holo</th>
                                        <th>Kts</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr style="font-weight: bold; text-align: center;">
                                        <td colspan="11">Total</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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

                    <div class="card-footer text-center btn_excel">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pemeriksaan Packing')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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

<!-- Modal SU -->
<div class="modal fade" id="modal_su" style="margin-right: 10px; margin-left: 10px;">
    <div class="modal-dialog" style="max-width: 600px; margin: auto;">
        <div class="modal-content">
            <div class="card-header bg-warning rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center">Sortir Ulang</h4></b>
            </div>
            <div class="card card-body m-2 pb-2" style="font-size: 16px; overflow: hidden;">
                <table width="100%">
                    <tr>
                        <th width="45%">Tanggal - Desain</th>
                        <td>
                            <div class="d-flex justify-content-between text-center">
                                <input id="s_tgl" type="text" class="form-control text-center datepicker" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                <div class="m-2"></div>
                                <select class="select_min" id="s_desain" style="width: 60%;">
                                    <?php foreach ($years as $dt) { ?>
                                        <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Produk - Total Bahan</th>
                        <td>
                            <div class="d-flex justify-content-between text-center">
                                <select class="select_min" id="s_produk" name="" style="width: 100%;">
                                    <option value="1">Seri 1</option>
                                    <option value="2">Seri 2</option>
                                    <option value="3">Seri 3</option>
                                    <option value="4">MMEA</option>
                                    <option value="M">Meterai</option>
                                </select>
                                <div class="m-2"></div>
                                <input type="number" id="s_bahan" class="numbers nums" value="0" style="width: 100%;" lang="en-US" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Qty Baik - Temuan</th>
                        <td>
                            <div class="d-flex justify-content-between text-center">
                                <input type="number" id="s_baik" class="numbers nums" value="0" style="width: 100%;" lang="en-US" autocomplete="off">
                                <div class="m-2"></div>
                                <input type="number" id="s_temuan" class="numbers nums" value="0" style="width: 100%;" lang="en-US" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Keterangan</th>
                        <td>
                            <textarea id="s_remark" class="form-control" rows="2" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-success" onclick="s_simpan()" style="width: 150px;" data-dismiss="modal"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger btn_close" data-dismiss="modal" style="width: 150px;"><i class="fa fa-close mr-2"></i><b>Keluar</b></button>
            </div>
            <div class="card p-1 m-2">
                <div class="table-responsive" style="width: 100%; font-size: 13px;">
                    <table class="tbl_filter" style="width: 550px;">
                        <thead>
                            <tr align="center" style="line-height: 30px;">
                                <th class="bg-warning" colspan="2">Periode</th>
                                <th></th>
                                <th width="20%" class="bg-warning">Desain</th>
                                <th></th>
                                <th width="35%" class="bg-warning">Produk</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input id="fs_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="s_filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                <td><input id="fs_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="s_filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                <td></td>
                                <td>
                                    <select class="select_min" id="fs_desain" onchange="s_filter()" style="width: 100%;">
                                        <option value="All">All..</option>
                                        <?php foreach($desain->result_array() as $dt) { ?>
                                            <option selected><?php echo $dt['DESAIN']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td></td>
                                <td>
                                    <select class="select_min" id="fs_produk" onchange="s_filter()" style="width: 100%;">
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
            </div>

            <div class="card m-2 pt-2">
                <div class="table-responsive" style="width: 100%; font-size: 13px;">
                    <table id="s_tbl" class="table table-bordered table-striped" style="width: 1000px;">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Desain</th>
                                <th>Tanggal</th>
                                <th>Urut</th>
                                <th>Produk</th>
                                <th>Qty Bahan</th>
                                <th>Baik</th>
                                <th>Temuan</th>
                                <th>Keterangan</th>
                                <th width="5%">Edit</th>
                                <th width="5%">Hapus</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                        <tfoot>
                            <tr style="font-weight: bold; text-align: center;">
                                <td colspan="5">Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td colspan="3"></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 13px; margin-left: 27mm;">
    <div style="width: 200px;  margin-bottom: 15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 10mm; width: auto;">
    </div>

    <h6 align="center" style="margin-top: -13mm;">LAPORAN PEMERIKSAAN MUTU PRODUK DI BAGIAN PACKING</h6>
    <h6 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 207/PNP-HLG/QC.2-PACKING/04/VIII/2025</div></h6>
    <table id="tbl_print" class="mt-2" style="width: 100%; font-size: 12px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="3">No.</td>
                <td rowspan="3">Jam</td>
                <td colspan="5">LABEL BANTU SORTIR</td>
                <td colspan="6">PEMERIKSAAN SAMPLING QC</td>
                <td colspan="3" rowspan="2">KETERANGAN WASTE</td>
            </tr>
            <tr>
                <td rowspan="2">No. Label Cutter</td>
                <td rowspan="2">Seri<br>/ Up</td>
                <td colspan="3">Kode</td>
                <td colspan="3">Hasil Baik</td>
                <td colspan="2">Hitungan</td>
                <td>Waste</td>
            </tr>
            <tr>
                <td width="7%">Sortir</td>
                <td>QC</td>
                <td>Packing</td>
                <td>Lbr</td>
                <td colspan="2">Rim</td>
                <td>(+)</td>
                <td>(-)</td>
                <td>Lbr</td>
                <td>KU</td>
                <td>Holo</td>
                <td>Kts</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot align="center">
            <tr>
                <td colspan="16"></td>
            </tr>
            <tr>
                <td>No.</td>
                <td>Control Waste</td>
                <td>Seri</td>
                <td>Bahan (Lbr)</td>
                <td>Waste (Lbr)</td>
                <td rowspan="4" colspan="11" style="vertical-align: top; text-align: left;">Remark</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 10px; margin-bottom: 10px;">F-SMT-QC2-038 Rev. 04</div>
    <div class="row">
        <div class="col-4" style="margin-top: -20px; font-size: 10px;">
            <div>Keterangan :</div>
            <div>1. Standar hitungan per ream = Seri I,II,III : 500 lbr, MMEA & Meterai : 250 lbr</div>
            <div>2. Temuan Hitungan : (-) : hitungan kurang, (+) : hitungan lebih</div>
            <div>3. Waste : ku (kurang ukur), ktr (kertas)</div>
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
                        <div>QC Packing</div>
                    </td>
                    <td>
                        <div id="p_pengawas">( ...................... )</div>
                        <div>Pengawas Packing</div>
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
            url: '<?php echo base_url()."index.php/qc/Packing/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Isi Total Waste
    function isi_total() {
        var ku = Number($('#ku').val());
        var holo = Number($('#holo').val());
        var kts = Number($('#kts').val());
        var total = ku + holo + kts;

        $('#total').val(total);
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
                url: '<?php echo base_url()."index.php/qc/Packing/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    t_bahan = 0, t_rim = 0, t_sampling = 0, t_plus = 0, t_mins = 0, t_ku = 0, t_holo = 0, t_kts = 0, t_total = 0; 
                    for (var i=0; i<data.length; i++) {
                        rim = data[i].RIM_BAIK + ' | ' + data[i].RIM_SAMPLING;
                        seri = data[i].PRODUK == '1' ? 'SERI I' : (data[i].PRODUK == '2' ? 'SERI II' : (data[i].PRODUK == '3' ? 'SERI III' : (data[i].PRODUK == '4' ? 'MMEA' : 'Meterai')));
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;
                        mesin = data[i].MESIN_HITUNG == '-' ? 'Manual' : 'Hitung ' + data[i].MESIN_HITUNG;

                        t_bahan = t_bahan + Number(data[i].HASIL_BAIK);
                        t_rim = t_rim + Number(data[i].RIM_BAIK);
                        t_sampling = t_sampling + Number(data[i].RIM_SAMPLING);
                        t_plus = t_plus + Number(data[i].PLUS);
                        t_mins = t_mins + Number(data[i].MINS);
                        t_ku = t_ku + Number(data[i].KU);
                        t_holo = t_holo + Number(data[i].HOLO);
                        t_kts = t_kts + Number(data[i].KTS);
                        t_total = t_total + Number(data[i].TOTAL);

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].JAM+'</td><td>'+data[i].NMR+'</td><td align="left">'+mesin+'</td><td>'+seri+'</td><td>'+data[i].CUTTER+'</td><td>'+data[i].KODE_SORTIR+'</td><td>'+data[i].KODE_QC+'</td><td>'+data[i].KODE_PACKING+'</td><td>'+format_number(data[i].HASIL_BAIK)+'</td><td><div style="width: 50px;">'+rim+'</div></td><td>'+data[i].PLUS+'</td><td>'+data[i].MINS+'</td><td>'+data[i].KU+'</td><td>'+data[i].HOLO+'</td><td>'+data[i].KTS+'</td><td>'+data[i].TOTAL+'</td><td align="left">'+data[i].PENGAWAS+'</td><td align="left">'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }
                    $('#tbl tfoot td:eq(1)').html(format_number(t_bahan));
                    $('#tbl tfoot td:eq(2)').html(format_number(t_rim + ' | ' + t_sampling));
                    $('#tbl tfoot td:eq(3)').html(format_number(t_plus));
                    $('#tbl tfoot td:eq(4)').html(format_number(t_mins));
                    $('#tbl tfoot td:eq(5)').html(format_number(t_ku));
                    $('#tbl tfoot td:eq(6)').html(format_number(t_holo));
                    $('#tbl tfoot td:eq(7)').html(format_number(t_kts));
                    $('#tbl tfoot td:eq(8)').html(format_number(t_total));

                    if ($(window).width() < 1200) {
                        $('#tbl thead th:eq(11), #tbl tbody td:nth-child(22)').hide();
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
        $('#cutter').val('');
        $('#sortir').val('');
        $('#qc').val('');
        $('#packing').val('');
        $('#hasil_baik').val('0');
        $('#total').val('0');
        $('#rim').val('0');
        $('#sampling').val('0');
        $('#plus').val('0');
        $('#minus').val('0');
        $('#ku').val('0');
        $('#holo').val('0');
        $('#kts').val('0');
        $('#remark').val('');

        auto_no();
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
        var cutter = huruf($("#cutter").val().toUpperCase());
        var sortir = huruf($("#sortir").val().toUpperCase());
        var qc = huruf($("#qc").val().toUpperCase());
        var packing = huruf($("#packing").val().toUpperCase());
        var id_pemeriksa = $("#pemeriksa").val();
        var id_approval = $("#approval").val();
        var id_pengawas = $("#pengawas").val();
        var hasil_baik = angka($("#hasil_baik").val());
        var total = angka($("#total").val());
        var rim = angka($("#rim").val());
        var sampling = angka($("#sampling").val());
        var plus = angka($("#plus").val());
        var minus = angka($("#minus").val());
        var ku = angka($("#ku").val());
        var holo = angka($("#holo").val());
        var kts = angka($("#kts").val());
        var remark = huruf($("#remark").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (jam == '') {error_isian('Jam belum diisi..');}
        if (cutter == '') {error_isian('Label Cutter belum diisi..');}
        if (sortir == '') {error_isian('Kode Sortir belum diisi..');}
        if (qc == '') {error_isian('Kode QC belum diisi..');}
        if (packing == '') {error_isian('Kode Packing belum diisi..');}
        if (hasil_baik == '0') {error_isian('Hasil Baik belum diisi..');}
        if (rim == '0') {error_isian('Qty Rim belum diisi..');}
        if (sampling == '0') {error_isian('Qty Sampling belum diisi..');}

        var data = [id_edit, nmr, desain, tgl, jam, mesin, produk, cutter, sortir, qc, packing, id_pemeriksa, id_approval, id_pengawas, hasil_baik, total, rim, sampling, plus, minus, ku, holo, kts, remark, tipe];

        $('#btnProgress').click();   
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Packing/simpan" ?>',
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
                url: '<?php echo base_url()."index.php/qc/Packing/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR);
                    $('#desain').val(data.DESAIN).change().change();
                    $("#tgl").val(format_date(data.TGL));
                    $('#jam').val(data.JAM).change();
                    $('#mesin').val(data.MESIN_HITUNG).change();
                    $('#produk').val(data.PRODUK).change();
                    $('#cutter').val(data.CUTTER).change();
                    $('#sortir').val(data.KODE_SORTIR).change();
                    $('#qc').val(data.KODE_QC).change();
                    $('#packing').val(data.KODE_PACKING).change();
                    $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                    $('#approval').val(data.ID_APPROVAL).change();
                    $('#pengawas').val(data.ID_PENGAWAS).change();
                    $('#hasil_baik').val(data.HASIL_BAIK).change();
                    $('#total').val(data.TOTAL).change();
                    $('#rim').val(data.RIM_BAIK).change();
                    $('#sampling').val(data.RIM_SAMPLING).change();
                    $('#plus').val(data.PLUS).change();
                    $('#minus').val(data.MINS).change();
                    $('#ku').val(data.KU).change();
                    $('#holo').val(data.HOLO).change();
                    $('#kts').val(data.KTS).change();
                    $('#remark').val(data.REMARK).change().focus();

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
                url: '<?php echo base_url()."index.php/qc/Packing/hapus" ?>',
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
            url: '<?php echo base_url()."index.php/qc/Packing/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                dt_cetak = JSON.parse(data);
                data = dt_cetak[0];
                data_su = dt_cetak[1];

                tipe = data[0].PRODUK == 'M' ? 'N/' : '';
                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC2-PACKING/' + tipe + tgl + '/' + bln + '/' + thn;
                ket = '<b>Remark :</b><br>';

                $('#nmr_print').html('No : ' + nmr);
                $('#p_approval').html('<b><u>' + data[data.length-1].APPROVAL + '</u></b>');
                $('#p_pemeriksa').html('<b><u>' + data[data.length-1].PEMERIKSA + '</u></b>');
                $('#p_pengawas').html('<b><u>' + data[data.length-1].PENGAWAS.replaceAll(',', ', ') + '</u></b>');
                $('#tbl_print tbody tr').remove();

                t_produk = '', urut = 0, t_bahan = 0, t_rim = 0, t_sampling = 0, t_plus = 0, t_mins = 0, t_total = 0, t_ku = 0, t_holo = 0, t_kts = 0; 
                for (var i=0; i<data.length; i++) {
                    t_ket = data[i].REMARK == null ? '' : data[i].REMARK + '; ';
                    ket = ket + t_ket;
                    seri = data[i].PRODUK == '1' ? 'I' : (data[i].PRODUK == '2' ? 'II' : (data[i].PRODUK == '3' ? 'III' : (data[i].PRODUK == '4' ? 'MMEA' : 'Meterai')));

                    if (t_produk != data[i].PRODUK && t_produk != '') {
                        isi_total_seri(t_bahan, t_rim, t_sampling, t_plus, t_mins, t_total, t_ku, t_holo, t_kts);
                        urut = 0, t_bahan = 0, t_rim = 0, t_sampling = 0, t_plus = 0, t_mins = 0, t_total = 0, t_ku = 0, t_holo = 0, t_kts = 0;
                    }

                    t_bahan = t_bahan + Number(data[i].HASIL_BAIK);
                    t_rim = t_rim + Number(data[i].RIM_BAIK);
                    t_sampling = t_sampling + Number(data[i].RIM_SAMPLING);
                    t_plus = t_plus + Number(data[i].PLUS);
                    t_mins = t_mins + Number(data[i].MINS);
                    t_total = t_total + Number(data[i].TOTAL);
                    t_ku = t_ku + Number(data[i].KU);
                    t_holo = t_holo + Number(data[i].HOLO);
                    t_kts = t_kts + Number(data[i].KTS);
                    t_produk = data[i].PRODUK;

                    $('#tbl_print tbody').append('<tr align="center"><td>'+(i+1)+'</td><td width="6%">'+data[i].JAM+'</td><td align="left">'+data[i].CUTTER+'</td><td width="6%">'+seri+'</td><td width="6%">'+data[i].KODE_SORTIR+'</td><td width="6%">'+data[i].KODE_QC+'</td><td width="6%">'+data[i].KODE_PACKING+'</td><td>'+format_number(data[i].HASIL_BAIK)+'</td><td>'+data[i].RIM_BAIK+'</td><td>'+data[i].RIM_SAMPLING+'</td><td>'+data[i].PLUS+'</td><td>'+data[i].MINS+'</td><td>'+data[i].TOTAL+'</td><td>'+data[i].KU+'</td><td>'+data[i].HOLO+'</td><td>'+data[i].KTS+'</td></tr>');
                }
                isi_total_seri(t_bahan, t_rim, t_sampling, t_plus, t_mins, t_total, t_ku, t_holo, t_kts);
                $('#tbl_print tfoot td:eq(6)').html(ket);

                isi_su(data_su, data[0].S_REMARK);

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

// Isi Cetak SU
    function isi_su(data, s_remark) {
        var pack_remark = $('#tbl_print tfoot td:eq(6)').html();
        var remark = s_remark == null ? pack_remark : pack_remark + (s_remark.replaceAll(',', '; ').replaceAll('@_', ','));

        $('#tbl_print tfoot td:eq(6)').html(remark);
        for (var i=0; i<data.length; i++) {
            produk = data[i].PRODUK;
            bahan = data[i].BAHAN;
            baik = data[i].BAIK;
            temuan = data[i].TEMUAN;

            $('#tbl_print tfoot tr:eq('+(i+2)+') td:eq(0)').html(i+1);
            $('#tbl_print tfoot tr:eq('+(i+2)+') td:eq(1)').html(format_number(bahan));
            $('#tbl_print tfoot tr:eq('+(i+2)+') td:eq(2)').html(produk);
            $('#tbl_print tfoot tr:eq('+(i+2)+') td:eq(3)').html(format_number(baik));
            $('#tbl_print tfoot tr:eq('+(i+2)+') td:eq(4)').html(format_number(temuan));
        }
    }

// Isi Total Per-Seri
    function isi_total_seri(t_bahan, t_rim, t_sampling, t_plus, t_mins, t_total, t_ku, t_holo, t_kts) {
        $('#tbl_print tbody').append('<tr style="font-weight: bold; text-align: center;"><td colspan="7">Total</td><td>'+format_number(t_bahan)+'</td><td>'+t_rim+'</td><td>'+t_sampling+'</td><td>'+t_plus+'</td><td>'+t_mins+'</td><td>'+t_total+'</td><td>'+t_ku+'</td><td>'+t_holo+'</td><td>'+t_kts+'</td></tr>');
    }

// Filter Data SU
    function s_filter() {
        var tgl1 = $('#fs_tgl1').val();
        var tgl2 = $('#fs_tgl2').val();
        var desain = $('#fs_desain').val();
        var produk = $('#fs_produk').val();
        var data = [tgl1, tgl2, desain, produk];

        $('#s_tbl').DataTable().destroy();
        $('#s_tbl').hide();
        $('#s_tbl tbody tr').remove();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Packing/s_filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    t_bahan = 0, t_baik = 0, t_temuan = 0; 
                    for (var i=0; i<data.length; i++) {
                        seri = data[i].PRODUK == '1' ? 'SERI I' : (data[i].PRODUK == '2' ? 'SERI II' : (data[i].PRODUK == '3' ? 'SERI III' : (data[i].PRODUK == '4' ? 'MMEA' : 'Meterai')));
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;

                        t_bahan = t_bahan + Number(data[i].BAHAN);
                        t_baik = t_baik + Number(data[i].BAIK);
                        t_temuan = t_temuan + Number(data[i].TEMUAN);

                        $('#s_tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+seri+'</td><td>'+format_number(data[i].BAHAN)+'</td><td>'+format_number(data[i].BAIK)+'</td><td>'+format_number(data[i].TEMUAN)+'</td><td align="left">'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="s_edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="s_hapus(this)" data-dismiss="modal"><i class="fa fa-trash"></i></button></td></tr>');
                    }
                    $('#s_tbl tfoot td:eq(1)').html(format_number(t_bahan));
                    $('#s_tbl tfoot td:eq(2)').html(format_number(t_baik));
                    $('#s_tbl tfoot td:eq(3)').html(format_number(t_temuan));

                    setTimeout(function() {
                        $('#s_tbl').show();
                        page('s_tbl');
                    }, 500);
                }
            }); 
        }, 500);
    }

// Kosongkan Isian SU
    function s_kosong() {
        $('#s_produk').attr('name', '');
        $('#s_bahan').val('0');
        $('#s_baik').val('0');
        $('#s_temuan').val('0');
        $('#s_remark').val('');
    }

// Simpan Data Rework
    function s_simpan() {
        var id_edit = $('#s_produk').attr('name');
        var desain = $('#s_desain').val();
        var tgl = $('#s_tgl').val();
        var produk = $('#s_produk').val();
        var bahan = angka($("#s_bahan").val());
        var baik = angka($("#s_baik").val());
        var temuan = angka($("#s_temuan").val());
        var remark = huruf($("#s_remark").val());

        if (bahan == '') {error_isian('Jumlah Bahan belum diisi..');}
        if (baik == 0 && temuan == 0) {error_isian('Jumlah Baik atau Temuan belum diisi..');}

        var data = [id_edit, desain, tgl, produk, bahan, baik, temuan, remark];

        $('#btnProgress').click();   
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Packing/s_simpan" ?>',
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        s_kosong();
                    }, 500);
                }
            });
        }, 500);
    }

// Edit Data SU
    function s_edit(btn) {
        var id_edit = btn.name;

        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Packing/s_edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#s_produk').attr('name', id_edit);
                    $('#s_desain').val(data.DESAIN).change().change();
                    $("#s_tgl").val(format_date(data.TGL));
                    $('#s_produk').val(data.PRODUK).change();
                    $('#s_bahan').val(data.BAHAN).change();
                    $('#s_baik').val(data.BAIK).change();
                    $('#s_temuan').val(data.TEMUAN).change();
                    $('#s_remark').val(data.REMARK).change().focus();

                    setTimeout(function() {$('#btnOk').click();}, 500);
                }
            });
        }, 500);
    }

// Hapus Data
    function s_hapus(btn) {
        var id_hapus = btn.name;

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Packing/s_hapus" ?>',
                data: {data: id_hapus},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();

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

</script>