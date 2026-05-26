<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css?=1">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Chart -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chart.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartjs-plugin-annotation.min.js"></script>

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

        #pr_body td, #pr_body th {
            line-height: 20px;
            vertical-align: middle;
            padding-left: 5px;
            border: 1px solid #6C6C6C;
        }

        #pr_detail td, #pr_detail th {
            line-height: 17px;
            vertical-align: middle;
            padding-left: 5px;
            border: 1px solid #6C6C6C;
        }
    }

</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">

        <div class="card card-info" style="display: none;">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Input Master Reject</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-lg-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Bahan</th>
                                <td>
                                    <select class="select_min" id="bahan_r" name="" style="width: 100%;">
                                        <option value="1">Holo</option>               
                                        <option value="2">Kertas</option>           
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode</th>
                                <td>
                                    <input type="text" id="kode_r" class="form-control" style="text-transform: uppercase;" maxlength="3" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Reject</th>
                                <td>
                                    <input type="text" id="reject_r" class="form-control" style="text-transform: uppercase;" maxlength="15" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>
                                    <textarea id="deskripsi_r" class="form-control" rows="2" style="width: 100%;" maxlength="250" autocomplete="off"></textarea>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-lg-6">
                        <table width="100%">
                            <tr>
                                <th width="40%" style="vertical-align: top;">Foto</th>
                                <td>
                                    <div style="width: 100%;">
                                        <div class="card" style="height: auto; min-height: 150px;">
                                            <input type="image" src="<?php echo base_url() . 'assets/images/no_preview.jpg'; ?>" id="img_prev" alt="Preview" class="img-responsive img-thumbnail" style="object-fit: cover; height: 250px;">
                                        </div>
                                        <input type="file" id="file" onchange="open_file(this)" hidden>
                                        <div class="d-flex justify-content-center">
                                            <a href="javascript:$('#file').click();" class="text-info mr-3" title="Upload File"><h3><i class="fa fa-upload mr-2"></i></h3></a>
                                            <a href="javascript:del_file();" class="text-danger" title="Hapus File"><h3><i class="fa fa-trash mr-2"></i></h3></a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan_reject()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="master_out()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info" style="display: none;">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Master Kode Reject</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <div class="datatable m-3">
                                <table id="tbl_reject" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>Bahan</th>
                                            <th>Kode</th>
                                            <th>Reject</th>
                                            <th>Deskripsi</th>
                                            <th>Picture</th>
                                            <th width="5%">Edit</th>
                                            <th width="5%">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" onclick="(function(){ $('.excel_reject').click(); })();" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info" <?php if ($mn!='') {echo 'hidden';} ?>>
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Input QC Sortir</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-lg-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Nomor QC</th>
                                <td>
                                    <div class="d-flex">
                                        <input type="number" id="nmr" name="" class="form-control" value="000" maxlength="3" onfocusout="isi_nomor()" style="width: 60%;" autocomplete="off">
                                        <div style="width: 5%;"></div>
                                        <select class="select_min" id="grup" style="width: 35%;">
                                            <option>A</option>               
                                            <option>B</option>               
                                            <option>C</option>               
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Desain</th>
                                <td>
                                    <?php $years = range(date('Y', strtotime('+1 years')), date('Y', strtotime('-1 years'))); ?>
                                    <select class="select_min" id="desain" onchange="isi_label(); auto_no();" style="width: 100%;">
                                        <?php foreach ($years as $dt) { ?>
                                            <option <?php if ($dt == date("Y")) {echo "Selected";} ?>><?php echo $dt; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>
                                    <input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y') ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Jam Periksa</th>
                                <td>
                                    <div class="d-flex">
                                        <input type="time" class="form-control" id="mulai" value="07:00" style="width: 100%; text-align: center;">
                                        <div style="width: 10px;"></div>
                                        <input type="time" class="form-control" id="selesai" value="07:00" style="width: 100%; text-align: center;">
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Label Cutter</th>
                                <td>
                                    <select class="select" id="label" onchange="isi_mesin()" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Label Stamping</th>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Mesin</td>
                                <td>
                                    <input type="text" id="mesin" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Shift</td>
                                <td>
                                    <input type="text" id="shift" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">PP</td>
                                <td>
                                    <input type="text" id="pp" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Seri</td>
                                <td>
                                    <input type="text" id="seri" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Qty Baik</th>
                                <td>
                                    <input type="number" id="qty_baik" class="form-control" onfocus="clear_isi(this)" onfocusout="isi_null(this)" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pengawas Sortir</th>
                                <td>
                                    <select class="select_min" id="pengawas_sortir" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                        <?php foreach ($pengawas_sortir->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pengawas QC</th>
                                <td>
                                    <select class="select_min" id="pengawas_qc" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                        <?php foreach ($pengawas_qc->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kepala QC</th>
                                <td>
                                    <select class="select_min" id="kepala_qc" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                        <?php foreach ($approval_qc->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                        <?php } ?>
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
                                <th width="40%">Rusak Holo</th>
                                <td>
                                    <input type="text" id="rusak_holo" class="numbers text-left pl-3" onfocus="clear_isi(this)" onfocusout="isi_null(this)" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Rusak Kertas</th>
                                <td>
                                    <input type="text" id="rusak_kertas" class="numbers text-left pl-3" onfocus="clear_isi(this)" onfocusout="isi_null(this)" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Temuan QC</th>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">AQL</td>
                                <td>
                                    <input type="number" id="aql" class="form-control" onfocus="clear_isi(this)" onfocusout="isi_null(this)" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Lembar</td>
                                <td>
                                    <input type="number" id="lembar" class="form-control" onfocus="clear_isi(this)" onfocusout="isi_null(this)" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th></th>
                                <td>
                                    <div class="row text-center">
                                        <?php foreach($waste->result_array() as $dt) { ?>
                                            <?php if ($dt['BAHAN'] == '1') { ?>
                                                <div class="col-md-3 text-info rusak_holo mb-2"><?php echo $dt['KD_REJECT']; ?><input type="number" name="holo" class="form-control text-center <?php echo $dt['KD_REJECT']; ?>" onchange="isi_holo('holo')" onfocus="clear_isi(this)" onfocusout="isi_null(this)" autocomplete="off" value="0" title="<?php echo $dt['REJECT']; ?>"></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th></th>
                                <td>
                                    <div class="row text-center">
                                        <?php foreach($waste->result_array() as $dt) { ?>
                                            <?php if ($dt['BAHAN'] == '2') { ?>
                                                <div class="col-md-3 text-info rusak_kertas mb-2"><?php echo $dt['KD_REJECT']; ?><input type="number" name="kertas" class="form-control text-center <?php echo $dt['KD_REJECT']; ?>" title="<?php echo $dt['REJECT']; ?>" onchange="isi_kertas('kertas')" onfocus="clear_isi(this)" onfocusout="isi_null(this)" autocomplete="off" value="0"></div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Kode Sortir</td>
                                <td>
                                    <input type="text" id="kode_sortir" class="form-control text-uppercase" maxlength="50" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <td class="pl-4">Keterangan</td>
                                <td>
                                    <textarea id="keterangan" class="form-control" rows="1" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>  
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Remark</th>
                                <td>
                                    <textarea id="remark" class="form-control" rows="3" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>  
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
                <button type="button" id="btn_master" class="btn btn-success" onclick="master()" style="width: 150px;"><i class="fa fa-book m-2"></i><b>Master</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput"> <?php if ($mn=='') {echo 'Laporan QC Sortir';}else{echo 'Laporan Waste Sortir';} ?></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table class="tbl_filter" style="width: 800px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="15%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="15%" class="filter">Seri</th>
                                        <th></th>
                                        <th width="23%" class="filter">Nama Pemeriksa</th>
                                        <th></th>
                                        <th width="15%" class="filter">Tampilkan Waste</th>
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
                                            <select class="select_min" id="f_seri" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <option value="1">SERI I</option> 
                                                <option value="2">SERI II</option> 
                                                <option value="3">SERI III</option> 
                                                <option value="4">MMEA</option> 
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_pemeriksa" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($pengawas_qc->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_waste" onchange="filter()" style="width: 100%;" <?php if ($mn!='') {echo 'disabled';} ?>>
                                                <option>Tidak</option>
                                                <option <?php if ($mn!='') {echo 'selected';} ?>>Ya</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <div class="datatable m-3">
                                <?php $qty_kode = $waste->num_rows(); ?>
                                <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                    <thead>
                                        <tr align="center">
                                            <th rowspan="2">No.</th>
                                            <th rowspan="2">Nomor</th>
                                            <th rowspan="2">Desain</th>
                                            <th rowspan="2">Tanggal</th>
                                            <th rowspan="2">Jam</th>
                                            <th rowspan="2">Label Cutter</th>
                                            <th rowspan="2">Mesin Stamping</th>
                                            <th rowspan="2">Shift Stamping</th>
                                            <th rowspan="2">PP</th>
                                            <th rowspan="2">Seri</th>
                                            <th rowspan="2">Qty Baik</th>
                                            <th colspan="<?php echo $qty_kode; ?>">Temuan</th>
                                            <th colspan="2">Rusak Holo</th>
                                            <th colspan="2">Rusak Kertas</th>
                                            <th rowspan="2">Temuan AQL</th>
                                            <th rowspan="2">Temuan QC</th>
                                            <th rowspan="2">Keterangan</th>
                                            <th rowspan="2">Pengawas Sortir</th>
                                            <th rowspan="2">Pengawas QC</th>
                                            <th rowspan="2">Remark</th>
                                            <th rowspan="2">Cetak</th>
                                            <th rowspan="2">Edit</th>
                                            <th rowspan="2">Hapus</th>
                                        </tr>
                                        <tr>
                                            <?php foreach ($waste->result_array() as $dt) { ?>
                                                <th><?php echo $dt['KD_REJECT']; ?></th>
                                            <?php } ?>
                                            <th>Qty</th>
                                            <th>%</th>
                                            <th>Qty</th>
                                            <th style="border-right: 1px solid #D0D0D0;">%</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot class="text-center">
                                        <th colspan="10">Total</th><th class="text-right"></th><th class="text-right"></th>
                                        <?php foreach ($waste->result_array() as $dt) { ?>
                                            <th></th>
                                        <?php } ?>
                                        <th></th><th></th><th></th><th></th><th></th><th colspan="7"></th>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" id="btn_excel" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>

                    <div class="card-body">
                        <div class="card-footer text-center font-weight-bold mb-4"><h4>SUMMARY WASTE</h4></div>

                        <div class="table-responsive">
                            <div class="row" style="font-size: 13px;">
                                <div class="col-md-6 div_summary">
                                    <table class="table table-bordered table-striped tbl_summary text-center" style="width: 100%;">
                                        <thead>
                                            <tr align="center">
                                                <th rowspan="2">Tanggal</th>
                                                <th rowspan="2">Qty Baik</th>
                                                <th colspan="2">Rusak Holo</th>
                                                <th colspan="2">Rusak Kertas</th>
                                                <th colspan="2">Total</th>
                                            </tr>
                                            <tr>
                                                <th>Qty</th>
                                                <th>%</th>
                                                <th>Qty</th>
                                                <th>%</th>
                                                <th>Qty</th>
                                                <th>%</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div class="card-footer mb-2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-body">
                <div class="card-body">
                    <div class="card-footer text-center font-weight-bold mb-4"><h4>GRAFIK KUALITAS</h4></div>
                    <div class="card card-body myChart"></div>
                </div>

                <div class="card-footer input-group text-success font-weight-bold">
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" name="optradio" value="option1" style="cursor: pointer;" checked><label class="form-check-label">ALL</label>
                    </div>
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" name="optradio" value="option1" style="cursor: pointer;"><label class="form-check-label">SERI I</label>
                    </div>
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" name="optradio" value="option2" style="cursor: pointer;"><label class="form-check-label">SERI II</label>
                    </div>
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" name="optradio" value="option2" style="cursor: pointer;"><label class="form-check-label">SERI III</label>
                    </div>
                    <div class="form-check mr-5">
                        <input type="radio" class="form-check-input" name="optradio" value="option2" style="cursor: pointer;"><label class="form-check-label">MMEA</label>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card-footer text-center font-weight-bold mb-4"><h4>GRAFIK PROSENTASE WASTE</h4></div>
                    <div class="card card-body p_chart"></div>
                </div>
            </div>
        </div>
        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
    </div>
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
            <div class="modal-footer">
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Image -->
<div class="modal fade" id="modal_img">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <img id="img" class="img-thumbnails" src="" width="97%" height="100%">
                </div>
            </div>
            <div class="modal-footer">
                <button style="width: 150px;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-share mr-2"></i>Keluar</b></button>
                <button id="btn_img" data-toggle="modal" data-target="#modal_img" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit Sortir -->
<div class="modal fade" id="modal_sortir">
    <div class="modal-dialog" style="max-width: 700px;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Edit Waste</h4></b>
            </div>
            <div class="card-body card m-3">
                <table width="100%">
                    <tr>
                        <th width="40%">Desain</th>
                        <td>
                            <input type="text" id="desain_ed" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Label Cutter</th>
                        <td>
                            <input type="text" id="label_ed" class="form-control" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Rusak Holo</th>
                        <td>
                            <input type="text" id="rusak_holo_ed" class="form-control" value="0" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th></th>
                        <td>
                            <div class="row text-center">
                                <?php foreach($waste->result_array() as $dt) { ?>
                                    <?php if ($dt['BAHAN'] == '1') { ?>
                                        <div class="col-md-3 text-info rusak_holo_ed mb-2"><?php echo $dt['KD_REJECT']; ?><input type="number" name="holo_ed" class="form-control text-center <?php echo $dt['KD_REJECT']; ?>" onchange="isi_holo('holo_ed')" onfocus="clear_isi(this)" onfocusout="isi_null(this)" autocomplete="off" value="0" title="<?php echo $dt['REJECT']; ?>"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Rusak Kertas</th>
                        <td>
                            <input type="text" id="rusak_kertas_ed" class="form-control" value="0" readonly>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th></th>
                        <td>
                            <div class="row text-center">
                                <?php foreach($waste->result_array() as $dt) { ?>
                                    <?php if ($dt['BAHAN'] == '2') { ?>
                                        <div class="col-md-3 text-info rusak_kertas_ed mb-2"><?php echo $dt['KD_REJECT']; ?><input type="number" name="kertas_ed" class="form-control text-center <?php echo $dt['KD_REJECT']; ?>" title="<?php echo $dt['REJECT']; ?>" onchange="isi_kertas('kertas_ed')" onfocus="clear_isi(this)" onfocusout="isi_null(this)" autocomplete="off" value="0"></div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>
            <div class="card-footer rounded m-1 text-center">
                <button style="width: 150px;" type="button" class="btn btn-success" title="Simpan Data" onclick="simpan_ed()" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button style="width: 150px;" type="button" class="btn btn-secondary" title="Kembali" data-dismiss="modal"><i class="fa fa-ban m-2"></i><b>Kembali</b></button>
                <button id="btn_sortir" data-toggle="modal" data-target="#modal_sortir" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; overflow: hidden; font-size: 13px; margin-left: 27mm;">
    <div style="width: 200px;  margin-bottom: -15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
    </div>

    <h5 align="center" style="margin-top: -5mm;">LAPORAN PEMERIKSAAN MUTU & WASTE PRODUKSI DI BAGIAN FINISHING</h5>
    <h5 align="center" style="margin-top: -2mm;">No : 161 / PNP-HLG / QC.Finish - Sortir / A-B-C / 05 / VII / 2023</h5>
    <table id="pr_head" width="30%" style="line-height: 4mm;">
        <tr>
            <td width="3%">Jenis Produk</td>
            <td width="1%">:</td>
            <td width="12%">Kertas Banderol Berhologram TA 2022</td>
        </tr>
    </table>
    <table id="pr_body" class="mt-2" style="width: 100%; font-size: 14px;">
        <thead style="text-align: center;">
            <tr>
                <td rowspan="3">No.</td>
                <td rowspan="3" style="width: 100px;">Jam</td>
                <td rowspan="3" style="width: 50px;">Label Cutter</td>
                <td colspan="4" rowspan="2">Label Stamping</td>
                <td colspan="5">Jumlah</td>
                <td colspan="4" rowspan="2">Temuan Waste Oleh QC</td>
            </tr>
            <tr>
                <td>H. Baik</td>
                <td colspan="2">R. Holo</td>
                <td colspan="2">R. Kertas</td>
            </tr>
            <tr>
                <td style="width: 40px;">Ms</td>
                <td style="width: 40px;">Shift</td>
                <td style="width: 40px;">PP</td>
                <td style="width: 40px;">Seri</td>
                <td>Lbr</td>
                <td>Lbr</td>
                <td>%</td>
                <td>Lbr</td>
                <td>%</td>
                <td>AQL</td>
                <td>Lbr</td>
                <td style="width: 150px;">Kode Sortir</td>
                <td style="width: 200px;">Keterangan</td>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot class="text-center">
            <th colspan="7">Total</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="2"></th>
        </tfoot>
    </table>
    <table id="pr_detail" class="mt-2" width="100%" style="text-align: center;">
        <thead>
            <tr>
                <td>Rincian Waste</td>
            </tr>
            <tr>
                <td style="width: 40px;">No</td>
                <td style="width: 60px;">Label</td>
                <td style="width: 120px;">Remark</td>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot style="font-weight: bold;">
            <tr>
                <td colspan="2">Total</td>
                <td></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form" align="right" style="font-size: 12px; margin-bottom: 5px;">F-SMT-QC2-020 Rev. 05</div>

    <table id="pr_foot" class="table-borderless" width="85%">
        <tr>
            <td rowspan="4">Cc.<br>1. Yth. Bag. Finishing<br>2. File</td>
            <td>Mengetahui</td>
            <td>Memeriksa</td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td>1.</td>
            <td>2.</td>
        </tr>
        <tr style="height: 10mm; vertical-align: bottom;">
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>Kabag/ Kabid QC</td>
            <td>QC Finish - Sortir</td>
            <td>Pengawas Kelompok</td>
        </tr>
    </table>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<!-- QR Code -->
<script src="<?php echo base_url(); ?>assets/js/jquery.qrcode.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=1"></script>

<script>

// Define Variable
    var dir = <?php echo json_encode(base_url()); ?>;
    var no_img = dir + 'assets/images/no_preview.jpg';
    var mn = <?php echo json_encode($mn); ?>;

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() > 960) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        auto_no();
        isi_label();
        filter();
    });

// Auto Nomor Sortir
    function auto_no() {
        var id_edit =$('#nmr').attr('name');
        var desain = $('#desain').val();
        var data = [id_edit, desain];

        $.ajax({
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Sortir/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Isi Format Nomor 3 angka
    function isi_nomor() {
        var nmr = $('#nmr').val();
        var nmr = nmr.toString().padStart(3, "0");
        var nmr = nmr.substring(0,3);

        $('#nmr').val(nmr);
    }

// Isi Nomor Cutter
    function isi_label() {
        var desain = $('#desain').val();

        $('#label option:gt(0)').remove();
        $.ajax({
            async: false,
            data: {data: desain},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/isi_label" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('#label').append('<option>'+data[i].NOMOR_PP_CUTTER+'</option>');
                }
                $('#label').change();
            }
        }); 
    }

// Isi Mesin Stamping
    function isi_mesin() {
        var desain = $('#desain').val();
        var label = $('#label').val();
        var data = [desain, label];

        $('#mesin option:gt(0)').remove();

        if (desain == '' || label == '') {return;}

        $.ajax({
            async: false,
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/isi_mesin" ?>',
            success: function(data) {
                data = JSON.parse(data);
                seri = data[0].SERI == '1' ? 'SERI I' : (data[0].SERI == '2' ? 'SERI II' : (data[0].SERI == '3' ? 'SERI III' : (data[0].SERI == '4' ? 'MMEA' : '')));
                shift = '';

                for (var i=0; i<data.length; i++) {
                    shift = shift + data[i].SHIFT_STAMP;
                }

                $('#mesin').val(data[0].NOMESIN_STAMP);
                $('#pp').val(data[0].NOMOR_PP);
                $('#seri').val(seri);
                $('#shift').val(shift);
            }
        }); 
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

// Isi Qty Rusak Holo
    function isi_holo(str) {
        return; // Perubahan Pencatatan Jumlah Waste

        var rsk = str == 'holo' ? 'rusak_holo' : 'rusak_holo_ed';
        var qty_total = 0;
        var qty_rusak = $('[name="holo"]').length;

        for (var i=0; i<qty_rusak; i++) {
            qty_total = qty_total + Number($('[name="'+str+'"]:eq('+i+')').val());
        }

        $('#' + rsk).val(format_number(qty_total));
    }

// Isi Qty Rusak Kertas
    function isi_kertas(str) {
        return; // Perubahan Pencatatan Jumlah Waste

        var rsk = str == 'kertas' ? 'rusak_kertas' : 'rusak_kertas_ed';
        var qty_total = 0;
        var qty_rusak = $('[name="kertas"]').length;

        for (var i=0; i<qty_rusak; i++) {
            qty_total = qty_total + Number($('[name="'+str+'"]:eq('+i+')').val());
        }

        $('#' + rsk).val(format_number(qty_total));
    }

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var seri = $('#f_seri').val();
        var f_waste = $('#f_waste').val();
        var id_pemeriksa = $('#f_pemeriksa').val();
        var kd_reject = <?php echo json_encode($waste->result_array()); ?>;
        console.log(kd_reject);
        var hidden = f_waste == 'Tidak' ? 'hidden' : '';
        var data = [tgl1, tgl2, desain, seri, id_pemeriksa];

        $('#tbl').DataTable().destroy();
        $('#tbl th').show();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Sortir/filter" ?>',
                success: function(data) {

                    if (data == '') {setTimeout(function() {$('#btnOk').click(); pagination();}, 1000);}

                    dt = JSON.parse(data);
                    data = dt[0];
                    dt_tgl = dt[1];
                    dt_tgl_full = dt[2];

                    t_baik = 0, t_holo = 0, t_kertas = 0, t_aql = 0, t_temuan = 0;
                    for (var i=0; i<kd_reject.length; i++) {
                        qty_reject = 0, window['rej'+i] = 0;
                    }
                    for (var i=0; i<data.length; i++) {
                        seri = data[i].SERI == '4' ? 'MMEA' : 'SERI ' + (data[i].SERI == '1' ? 'I' : (data[i].SERI == '2' ? 'II' : 'III'));
                        waste = data[i].KD_REJECT == null ? '' : data[i].KD_REJECT.substring(0, data[i].KD_REJECT.length-1);
                        keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                        remark = data[i].REMARK == null ? '' : data[i].REMARK;
                        p_holo = (Number(data[i].R_HOLO) / Number(data[i].BAIK) * 100).toFixed(2);
                        p_kertas = (Number(data[i].R_KERTAS) / Number(data[i].BAIK) * 100).toFixed(2);

                        $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+data[i].NMR+'</td><td align="center">'+data[i].DESAIN+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+(data[i].JAM_MULAI + ' - ' + data[i].JAM_SELESAI)+'</td><td align="center">'+data[i].LABEL_CUTTER+'</td><td align="center">'+data[i].MS_STAMPING+'</td><td align="center">'+data[i].SHIFT_STAMPING+'</td><td align="center">'+data[i].PP+'</td><td align="center">'+seri+'</td><td align="right">'+format_number(data[i].BAIK)+'</td></td><td align="center">'+format_number(data[i].R_HOLO)+'</td><td align="center">'+format_number(p_holo)+'</td><td align="center">'+format_number(data[i].R_KERTAS)+'</td><td align="center">'+format_number(p_kertas)+'</td><td align="center">'+format_number(data[i].AQL)+'</td><td align="center">'+format_number(data[i].TEMUAN_LBR)+'</td><td>'+keterangan+'</td><td>'+proper(data[i].PENGAWAS_SORTIR)+'</td><td>'+proper(data[i].PENGAWAS_QC)+'</td><td>'+remark+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');

                        t_baik = t_baik + Number(data[i].BAIK);
                        t_holo = t_holo + Number(data[i].R_HOLO);
                        t_kertas = t_kertas + Number(data[i].R_KERTAS);
                        t_temuan = t_temuan + Number(data[i].TEMUAN_LBR);
                        t_aql = t_aql + Number(data[i].AQL);

                        for (var j=0; j<kd_reject.length; j++) {
                            qty_reject = 0;
                            if (waste.includes(kd_reject[j].KD_REJECT) == true) {
                                qty_reject = waste.split(kd_reject[j].KD_REJECT)[1].split(':')[1].split(',')[0];
                                window['rej'+j] = window['rej'+j] + Number(qty_reject);
                            }
                            $('#tbl tbody tr:eq('+i+') td:eq('+(10+j)+')').after('<td align="center" '+hidden+'>'+qty_reject+'</td>');
                        }
                    }

                    p_holo = t_holo == 0 ? 0 : (Number(t_holo) / Number(t_baik) * 100).toFixed(2);
                    p_kertas = t_kertas == 0 ? 0 : (Number(t_kertas) / Number(t_baik) * 100).toFixed(2);
                    $('#tbl tfoot th:eq(1)').html(format_number(t_baik));
                    for (var i=0; i<kd_reject.length; i++) {
                        $('#tbl tfoot th:eq('+(i+2)+')').html(format_number(window['rej'+i]));
                    }
                    $('#tbl tfoot th:eq('+(kd_reject.length+2)+')').html(format_number(t_holo));
                    $('#tbl tfoot th:eq('+(kd_reject.length+3)+')').html(format_number(p_holo));
                    $('#tbl tfoot th:eq('+(kd_reject.length+4)+')').html(format_number(t_kertas));
                    $('#tbl tfoot th:eq('+(kd_reject.length+5)+')').html(format_number(p_kertas));
                    $('#tbl tfoot th:eq('+(kd_reject.length+6)+')').html(format_number(t_aql));
                    $('#tbl tfoot th:eq('+(kd_reject.length+7)+')').html(format_number(t_temuan));

                    if (f_waste == 'Tidak') {
                        $('#tbl thead tr:eq(0) th:eq(11)').hide();
                        $('#tbl thead tr:eq(1) th:lt('+kd_reject.length+')').hide();
                        $('#tbl tfoot th:gt(1):lt('+kd_reject.length+')').hide();
                    }

                    if ($(window).width() < 1200) {
                        $('#tbl thead th:eq(19), #tbl tbody td:nth-child('+(kd_reject.length+21)+')').hide();
                        $('#btn_excel').hide();
                        $('#btn_master').hide();
                    }

                    if (mn != '') {
                        $('#tbl thead th:eq(20), #tbl thead th:eq(21), #tbl thead th:eq(22), #tbl tbody td:nth-child('+(kd_reject.length+22)+'), #tbl tbody td:nth-child('+(kd_reject.length+23)+'), #tbl tbody td:nth-child('+(kd_reject.length+24)+')').hide();
                    }

                    setTimeout(function() {$('#btnOk').click(); pagination();}, 1000);
                    isi_chart();
                    p_chart(dt_tgl, data);
                    isi_summary(dt_tgl_full, data);
                }
            }); 
        }, 1000); //
    } //

// Pagination
    function pagination() { 
        $('#tbl').DataTable().destroy();
        var datatable = $('#tbl').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "350px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel',
                filename: 'Laporan Data Sortir',
                title: ''
            }],
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Isi Summary Waste
    function isi_summary(dt_tgl, data) {
        var qty_tbl = 0, t_baik = 0, t_waste_h = 0, t_waste_k = 0, t_waste = 0;

        $('.div_summary:gt(0)').remove();
        $('.tbl_summary tbody tr').remove();
        for (var i=0; i<dt_tgl.length; i++) {
            qty_baik = 0, r_holo = 0, r_kertas = 0, waste = 0;
            tgl = dt_tgl[i];

            for (var j=0; j<data.length; j++) {
                t_tgl = format_date(data[j].TGL);

                if (t_tgl == tgl) {
                    qty_baik = qty_baik + Number(data[j].BAIK);
                    r_holo = r_holo + Number(data[j].R_HOLO);
                    r_kertas = r_kertas + Number(data[j].R_KERTAS);
                    waste = waste + Number(data[j].R_HOLO) + Number(data[j].R_KERTAS);
                }
            }

            p_r_holo = r_holo == 0 || qty_baik == 0 ? 0 : (r_holo/qty_baik*100).toFixed(2);
            p_r_kertas = r_kertas == 0 || qty_baik == 0 ? 0 : (r_kertas/qty_baik*100).toFixed(2);
            p_waste = waste == 0 || qty_baik == 0 ? 0 : (waste/qty_baik*100).toFixed(2);

            if (i % 10 == 0 && i > 0) {
                $('.div_summary:eq('+qty_tbl+')').clone().insertAfter('.div_summary:eq('+qty_tbl+')');
                qty_tbl++;
                $('.tbl_summary:eq('+qty_tbl+') tbody tr').remove();
            }

            $('.tbl_summary:eq('+qty_tbl+') tbody').append('<tr><td>'+dt_tgl[i]+'</td><td>'+format_number(qty_baik)+'</td><td>'+format_number(r_holo)+'</td><td>'+format_number(p_r_holo)+'</td><td>'+format_number(r_kertas)+'</td><td>'+format_number(p_r_kertas)+'</td><td>'+format_number(waste)+'</td><td>'+format_number(p_waste)+'</td></tr>');

            t_baik = t_baik + Number(qty_baik);
            t_waste_h = t_waste_h + Number(r_holo);
            t_waste_k = t_waste_k + Number(r_kertas);
            t_waste = t_waste + Number(waste);
        }

        p_holo = t_waste_h == 0 ? 0 : (t_waste_h / t_baik * 100).toFixed(2);
        p_kertas = t_waste_k == 0 ? 0 : (t_waste_k / t_baik * 100).toFixed(2);
        p_waste = t_baik == 0 ? 0 : (t_waste / t_baik * 100).toFixed(2);

        $('.tbl_summary:eq('+qty_tbl+') tbody').append('<tr class="font-weight-bold"><td>Total</td><td>'+format_number(t_baik)+'</td><td>'+format_number(t_waste_h)+'</td><td>'+format_number(p_holo)+'</td><td>'+format_number(t_waste_k)+'</td><td>'+format_number(p_kertas)+'</td><td>'+format_number(t_waste)+'</td><td>'+format_number(p_waste)+'</td></tr>');
    }

// Isi Chart Waste
    function isi_chart() {
        var tgl1 = $('#f_tgl1').val();
        var dt_bln = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
        var waste = <?php echo json_encode($waste->result_array()); ?>;
        var periode = tgl1.slice(-2) + format_text(dt_bln.indexOf(tgl1.split('-')[1])+1, 2);
        var xValues = [], yValues = [], barColors = ['#FE0202','#E7EE1F','#240EFA','#0C0000','#C0BABA','#FCB723','#42FA87','#CA08A3','#EDF665','#699B97','#CCDFED','#562929','#F88C8C','#76F44F','#BCF7F1','#545FF4','#B77C7C','#FAE7AD','#2C756A','#FF50E0', '#FF0012', '#FCFF00', '#1EF532'];
        var rand = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f' ];
        var w_holo = angka($('#tbl tfoot th:eq('+(waste.length+2)+')').html());
        var w_kertas = angka($('#tbl tfoot th:eq('+(waste.length+4)+')').html());
        var t_waste = w_holo + w_kertas;
        var temuan_lbr = angka($('#tbl tfoot th:eq('+(waste.length+7)+')').html());
        var total_defect = Number(periode) >= 2503 ? temuan_lbr : t_waste; 

        for (var i=0; i<waste.length; i++) {
            num = (angka($('#tbl tfoot th:eq('+(i+2)+')').html()) / total_defect * 100).toFixed(1);
            color = '#' + rand[Math.floor(Math.random() * waste.length)] + rand[Math.floor(Math.random() * waste.length)] + rand[Math.floor(Math.random() * waste.length)];

            if (num > 0) {
                xValues.push(waste[i].KD_REJECT);
                yValues.push(num);
            }
        }

        $('.myChart').html('');
        $('.myChart').append('<canvas id="myChart" style="max-height: 600px;"></canvas>');
        ctx = new Chart("myChart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 24,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 24,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                        }
                    }]
                }
            }
        });
    }

// Isi Chart Prosentase
    function p_chart(dt_tgl, data) {
        var xValues = [], yValues = [];

        for (var i=0; i<dt_tgl.length; i++) {
            qty_baik = 0, waste = 0;
            tgl = dt_tgl[i];

            for (var j=0; j<data.length; j++) {
                t_tgl = data[j].TGL.substring(0, 5).replace('/', '-');
                t_tgl = format_date(data[j].TGL).slice(0, -5);

                if (t_tgl == tgl) {
                    qty_baik = qty_baik + Number(data[j].BAIK);
                    waste = waste + Number(data[j].R_HOLO) + Number(data[j].R_KERTAS);
                }
            }

            xValues.push(tgl);
            yValues.push((waste/qty_baik*100).toFixed(2));
        }

        $('.p_chart').html('');
        $('.p_chart').append('<canvas id="p_chart" style="max-height: 600px;"></canvas>');
        ctx = new Chart("p_chart", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    data: yValues,
                    backgroundColor: '#D4FF3F'
                }]
            },
            options: {
                annotation: {
                    annotations: [
                        {
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 3,
                            borderColor: 'red',
                            borderWidth: 3,
                            borderDash: [5, 5],
                            label: {
                                content: "Max",
                                enabled: true,
                                position: "right",
                                backgroundColor: 'rgba(255, 0, 0, 0.7)',
                                font: {style: 'bold'}
                            }
                        }
                    ]
                },
                legend: {display: false},
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 20,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#ACE7FF'
                        },
                        ticks: {
                            fontSize: 20,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                            min: 0
                        }
                    }]
                }
            }
        });
    }    

// Kosong Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#mulai').val('07:00').change();
        $('#selesai').val('07:00').change();
        $('#label').val('').change();
        $('#mesin').val('').change();
        $('#pp').val('').change();
        $('#seri').val('').change();
        $('#shift').val('').change();
        $('#qty_baik').val('0').change();
        $('#rusak_holo').val('0').change();
        $('#rusak_kertas').val('0').change();
        $('[name="holo"]').val('0');
        $('[name="kertas"]').val('0');
        $('#aql').val('0').change();
        $('#lembar').val('0').change();
        $('#kode_sortir').val('').change();
        $('#keterangan').val('').change();
        $('#remark').val('').change();
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
        var grup = $("#grup").val();
        var desain = $("#desain").val();
        var tgl = $("#tgl").val();
        var jam_mulai = $("#mulai").val();
        var jam_selesai = $("#selesai").val();
        var label_cutter = $('#label').val();
        var ms_stamping = $('#mesin').val();
        var shift_stamping = $('#shift').val();
        var pp = $('#pp').val();
        var seri = $('#seri').val();
        var baik = angka($('#qty_baik').val());
        var r_holo = angka($('#rusak_holo').val());
        var r_kertas = angka($('#rusak_kertas').val());
        var aql = angka($('#aql').val());
        var temuan_lbr = angka($('#lembar').val());
        var kode_sortir = $('#kode_sortir').val().toUpperCase();
        var keterangan = huruf($('#keterangan').val());
        var id_pemeriksa = $('#pengawas_qc').val();
        var id_pengawas = $('#pengawas_sortir').val();
        var id_approval = $('#kepala_qc').val();
        var remark = huruf($('#remark').val());
        var qty_holo = [], qty_kertas = [];

        if (jam_mulai == '') {error_isian('Jam Mulai belum diisi..');}
        if (jam_selesai == '') {error_isian('Jam Selesai belum diisi..');}
        if (label_cutter == '') {error_isian('Label Cutter belum diisi..');}
        if (ms_stamping == '') {error_isian('Mesin Stamping belum diisi..');}
        if (shift_stamping == '') {error_isian('Shift Stamping belum diisi..');}
        if (pp == '') {error_isian('Nomor PP belum diisi..');}
        if (seri == '') {error_isian('Seri belum diisi..');}
        if (baik == '0') {error_isian('Qty Baik belum diisi..');}
        if (id_pengawas == '') {error_isian('Pengawas Sortir belum diisi..');}
        if (id_pemeriksa == '') {error_isian('Pengawas QC belum diisi..');}
        if (kode_sortir == '' && temuan_lbr != '') {error_isian('Kode Sortir belum diisi..');}
        if (id_approval == '') {error_isian('Nama Kepala QC belum diisi..');}

        for (var i=0; i<$('[name="holo"]').length; i++) {
            t1 = angka($('[name="holo"]:eq('+i+')').val());
            k1 = $('.rusak_holo:eq('+i+')').html().split('<')[0];
            qty_holo.push(t1 + '@' + k1);
        }

        for (var i=0; i<$('[name="kertas"]').length; i++) {
            t1 = angka($('[name="kertas"]:eq('+i+')').val());
            k1 = $('.rusak_kertas:eq('+i+')').html().split('<')[0];
            qty_kertas.push(t1 + '@' + k1);
        }

        seri = seri == 'SERI I' ? '1' : (seri == 'SERI II' ? '2' : (seri == 'SERI III' ? '3' : '4'));

        var data = [id_edit, nmr, grup, desain, tgl, jam_mulai, jam_selesai, label_cutter, ms_stamping, shift_stamping, pp, seri, baik, r_holo, r_kertas, temuan_lbr, kode_sortir, keterangan, id_pemeriksa, id_pengawas, id_approval, remark, qty_holo, qty_kertas, aql];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/simpan" ?>',
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

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;
        var kd_reject = <?php echo json_encode($waste->result_array()); ?>;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/edit" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);

                if (mn != '') {
                    $('#desain_ed').attr('name', id_edit);
                    $('#desain_ed').val(data[0].DESAIN);
                    $('#label_ed').val(data[0].LABEL_CUTTER);
                    $('#rusak_holo_ed').val(data[0].R_HOLO).change();
                    $('#rusak_kertas_ed').val(data[0].R_KERTAS).change();

                    for (var i=0; i<kd_reject.length; i++) {
                        $('.' + kd_reject[i].KD_REJECT + ':eq(1)').val('0');

                        for (var j=0; j<data.length; j++) {
                            if (kd_reject[i].KD_REJECT == data[j].KD_REJECT) {
                                $('.' + kd_reject[i].KD_REJECT + ':eq(1)').val(data[j].LBR);
                            }
                        }
                    }
                    $('#btn_sortir').click();
                }else{
                    lbr = data[0].TEMUAN_LBR == null ? '0' : data[0].TEMUAN_LBR;
                    $('#nmr').val(data[0].NMR).change();
                    $('#grup').val(data[0].GRUP).change();
                    $('#nmr').attr('name', id_edit);
                    $('#desain').val(data[0].DESAIN).change();
                    $('#tgl').val(format_date(data[0].TGL)).change();
                    $('#mulai').val(data[0].JAM_MULAI).change();
                    $('#selesai').val(data[0].JAM_SELESAI).change();
                    $('#label').val(data[0].LABEL_CUTTER).change();
                    $('#qty_baik').val(data[0].BAIK).change();
                    $('#rusak_holo').val(data[0].R_HOLO).change();
                    $('#rusak_kertas').val(data[0].R_KERTAS).change();
                    $('#aql').val(data[0].AQL).change();
                    $('#lembar').val(lbr).change();
                    $('#kode_sortir').val(data[0].KODE_SORTIR).change();
                    $('#keterangan').val(data[0].KETERANGAN).change();
                    $('#pengawas_qc').val(data[0].ID_PEMERIKSA).change();
                    $('#pengawas_sortir').val(data[0].ID_PENGAWAS).change();
                    $('#kepala_qc').val(data[0].ID_APPROVAL).change();
                    $('#remark').val(data[0].REMARK).change();

                    for (var i=0; i<kd_reject.length; i++) {
                        $('.' + kd_reject[i].KD_REJECT + ':eq(0)').val('0');

                        for (var j=0; j<data.length; j++) {
                            if (kd_reject[i].KD_REJECT == data[j].KD_REJECT) {
                                $('.' + kd_reject[i].KD_REJECT + ':eq(0)').val(data[j].LBR);
                            }
                        }
                    }

                    $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
                }
            }
        });
    }

// Hapus Data
    function hapus(btn) {
        var id_hapus = btn.name;
        var title = btn.title;
        var str = title.includes("Reject");
        var data = [id_hapus, str];

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Sortir/hapus" ?>',
                data: {data: data},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();

                        if (str == true) {master();}else{filter();}
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
        var kd_reject = <?php echo json_encode($waste->result_array()); ?>;
        var t_baik = 0, t_holo = 0, t_kertas = 0, t_aql = 0, t_temuan = 0;

        $('#pr_body tbody tr').remove();
        $('#pr_detail tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                dt_cetak = JSON.parse(data);
                data = dt_cetak[0];
                kd_reject = dt_cetak[1];

                for (var i=0; i<kd_reject.length; i++) {
                    qty_reject = 0, window['rej'+i] = 0;
                }

                nmr = 'No : ' + data[0].NMR + '/PNP-HLG/QC.Finish-Sortir/' + data[0].GRUP + '/'  + data[0].TGL;
                desain = 'Kertas Banderol Berhologram TA ' + data[0].DESAIN;
                $('#printable h5:eq(1)').html(nmr);
                $('#pr_head td:eq(2)').html(desain);

                $('.col_waste').remove();
                for (var i=0; i<kd_reject.length; i++) {
                    $('#pr_detail thead tr:eq(1) td:eq('+(i+1)+')').after('<td align="center" class="col_waste">'+kd_reject[i].KD_REJECT+'</td>');
                    $('#pr_detail tfoot tr:eq(0) td:eq(0)').after('<td align="center" class="col_waste">0</td>');
                }

                for (var i=0; i<data.length; i++) {
                    jam = data[i].JAM_MULAI + ' - ' + data[i].JAM_SELESAI;
                    p_holo = (Number(data[i].R_HOLO) / Number(data[i].BAIK) * 100).toFixed(2);
                    p_kertas = (Number(data[i].R_KERTAS) / Number(data[i].BAIK) * 100).toFixed(2);
                    waste = data[i].KD_REJECT == null ? '' : data[i].KD_REJECT.substring(0, data[i].KD_REJECT.length-1);
                    seri = data[i].SERI == '1' ? 'I' : (data[i].SERI == '2' ? 'II' : (data[i].SERI == '3' ? 'III' : 'MMEA'));
                    kode_sortir = data[i].KODE_SORTIR == null ? '' : data[i].KODE_SORTIR;
                    keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                    remark = data[i].REMARK == null ? '' : data[i].REMARK;

                    $('#pr_body tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+jam+'</td><td align="center">'+data[i].LABEL_CUTTER+'</td><td align="center">'+data[i].MS_STAMPING+'</td><td align="center">'+data[i].SHIFT_STAMPING+'</td><td align="center">'+data[i].PP+'</td><td align="center">'+seri+'</td><td align="center">'+format_number(data[i].BAIK)+'</td><td align="center">'+data[i].R_HOLO+'</td><td align="center">'+p_holo+'</td><td align="center">'+data[i].R_KERTAS+'</td><td align="center">'+p_kertas+'</td><td align="center">'+data[i].AQL+'</td><td align="center">'+data[i].TEMUAN_LBR+'</td><td>'+kode_sortir+'</td><td>'+keterangan+'</td></tr>');

                    t_baik = t_baik + Number(data[i].BAIK);
                    t_holo = t_holo + Number(data[i].R_HOLO);
                    t_kertas = t_kertas + Number(data[i].R_KERTAS);
                    t_temuan = t_temuan + Number(data[i].TEMUAN_LBR);
                    t_aql = t_aql + Number(data[i].AQL);

                    $('#pr_detail tbody').append('<tr><td>'+(i+1)+'</td><td align="center">'+data[i].LABEL_CUTTER+'</td></tr>');
                    for (var j=0; j<kd_reject.length; j++) {
                        qty_reject = 0;
                        if (waste.includes(kd_reject[j].KD_REJECT) == true) {
                            qty_reject = waste.split(kd_reject[j].KD_REJECT)[1].split(':')[1].split(',')[0];
                            window['rej'+j] = window['rej'+j] + Number(qty_reject);
                        }
                        warna = Number(qty_reject) / Number(data[i].BAIK) * 100 > 3.5 ? 'text-danger' : '';
                        $('#pr_detail tbody tr:eq('+i+') td:eq('+(1+j)+')').after('<td align="center" class="'+warna+'">'+qty_reject+'</td>');
                    }
                    $('#pr_detail tbody tr:eq('+i+') td:eq('+(1+j)+')').after('<td class="text-left pl-1">'+remark+'</td>');
                }

                $('#pr_detail').css('width', kd_reject.length * 80 + 180 + 'px');
                $('#pr_detail td:eq(0)').attr('colspan', kd_reject.length+3);

                p_holo = (Number(t_holo) / Number(t_baik) * 100).toFixed(2);
                p_kertas = (Number(t_kertas) / Number(t_baik) * 100).toFixed(2);

                $('#pr_body tfoot th:eq(1)').html(format_number(t_baik));
                $('#pr_body tfoot th:eq(2)').html(format_number(t_holo));
                $('#pr_body tfoot th:eq(3)').html(format_number(p_holo));
                $('#pr_body tfoot th:eq(4)').html(format_number(t_kertas));
                $('#pr_body tfoot th:eq(5)').html(format_number(p_kertas));
                $('#pr_body tfoot th:eq(6)').html(format_number(t_aql));
                $('#pr_body tfoot th:eq(7)').html(format_number(t_temuan));

                for (var i=0; i<kd_reject.length; i++) {
                    $('#pr_detail tfoot td:eq('+(i+1)+')').html(window['rej'+i]);
                }

                $('#pr_foot tr:eq(2) td:eq(0)').html('( .. <b>' + proper(data[0].APPROVAL) + '</b> .. )');
                $('#pr_foot tr:eq(2) td:eq(1)').html('( .. <b>' + proper(data[0].PEMERIKSA) + '</b> .. )');
                $('#pr_foot tr:eq(2) td:eq(2)').html('( .. <b>' + proper(data[0].PENGAWAS) + '</b> .. )');

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
    } // End Cetak


// Pilih Seri Chart
    $('.form-check-input').click(function() {
        var indeks = $('.form-check-input').index(this) == 0 ? 'All' : $('.form-check-input').index(this);

        $('#f_seri').val(indeks).change();
    });

// Buka Master Reject
    function master() {
        var rand = new Date();

        $('.card-info:gt(1)').fadeOut();
        $('.card-info:lt(2)').fadeIn();

        $('.datatable:eq(0)').hide();
        $('#tbl_reject').DataTable().destroy();
        $('#tbl_reject tbody tr').remove();
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/master" ?>',
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    bahan = data[i].BAHAN == '1' ? 'Holo' : 'Kertas';
                    deskripsi = data[i].DESKRIPSI == null ? '' : data[i].DESKRIPSI;
                    img_preview = dir + 'assets/images/qc/reject/' + data[i].ID + '.jpg?=' + rand;

                    $('#tbl_reject tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+bahan+'</td><td align="center">'+data[i].KD_REJECT+'</td><td>'+data[i].REJECT+'</td><td>'+deskripsi+'</td><td align="center"><img src="'+img_preview+'" class="img-thumbnail pointer" name="'+data[i].ID+'.jpg" onclick="preview(this)" style="min-width: 100px; max-width: 100px;" alt=""></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data Reject" onclick="edit_r(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data Reject" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');

                    $('#tbl_reject tbody img').on('error', function() {
                        $(this).on('error', null);
                        $(this).attr('src', no_img);
                    });
                }

                setTimeout(function() {$('#btnOk').click(); pagination_reject();}, 500);
                setTimeout(function() {$('.datatable:eq(0)').show();}, 1000);
            }
        }); 
    }

// Preview Image
    function preview(btn) {
        var rand = new Date();
        var img = dir + 'assets/images/qc/reject/' + btn.name + '?=' + rand;

        $('#img').attr('src', img);
        $('#btn_img').click();

        $('#img').on('error', function() {
            $('#img').on('error', null);
            $('#img').attr('src', no_img);
        });
    }

// Pagination
    function pagination_reject() { 
        $('#tbl_reject').DataTable().destroy();
        var datatable = $('#tbl_reject').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "autoWidth": false,
            "scrollX": true,
            "scrollY": "350px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'invisible excel_reject',
                filename: 'Master Data Reject',
                title: ''
            }],
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Tutup Master
    function master_out() {
        $('.card-info:gt(1)').fadeIn();
        $('.card-info:lt(2)').fadeOut();    
        kosong_r();
        filter(); 
    }

// Kosong Reject
    function kosong_r() {
        $('#bahan_r').attr('name', '');
        $('#kode_r').val('').change();
        $('#reject_r').val('').change();
        $('#deskripsi_r').val('').change();
        del_file();
    }

// Cek Kode Reject
    function cek_kode_r(kode, reject) {
        var id_edit = $('#bahan_r').attr('name');
        var data = [id_edit, kode, reject];

        $.ajax({
            async: false,
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/cek_kode_r" ?>',
            success: function(data) {
                if (data > 0) {error_isian('Kode atau Jenis Reject sudah ada..');}
            }
        });
    }

// Simpan Reject
    function simpan_reject() {
        var form_data = new FormData();
        var img = $('#img_prev')[0].src;
        var img = img.split("/")[6];
        var file = $('#file').get(0).files[0];

        var id_edit = $('#bahan_r').attr('name');
        var bahan = $('#bahan_r').val();
        var kode = $('#kode_r').val().toUpperCase();
        var reject = $("#reject_r").val().toUpperCase();
        var deskripsi = $("#deskripsi_r").val();
        var data = [id_edit, bahan, kode, reject, deskripsi, img];

        if (kode == '') {error_isian('Kode belum diisi..');}
        if (kode.length < 2) {error_isian('Kode berisi 2-3 huruf..');}
        if (reject == '') {error_isian('Jenis Reject belum diisi..');}

        form_data.append('data', JSON.stringify(data));
        file == undefined ? form_data.append('file', '') : form_data.append('file', file);

        cek_kode_r(kode, reject);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                async: false,
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Sortir/simpan_reject" ?>',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        kosong_r();
                        master();
                    }, 500);
                }
            });
        }, 500);
    }

// Edit Data Reject
    function edit_r(btn) {
        var rand = new Date();
        var id_edit = btn.name;

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/edit_r" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);

                $('#bahan_r').attr('name', id_edit);
                $('#bahan_r').val(data.BAHAN).change();
                $('#kode_r').val(data.KD_REJECT).change();
                $('#reject_r').val(data.REJECT).change();
                $('#deskripsi_r').val(data.DESKRIPSI).change();
                $('#img_prev')[0].setAttribute('src', dir+'assets/images/qc/reject/'+data.ID+'.jpg?=' + rand);

                $('#img_prev').on('error', function() {
                    $(this).on('error', null);
                    $(this).attr('src', no_img);
                });
            }
        });
        $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
    }

// Simpan Data
    function simpan_ed() {
        var id_edit = $('#desain_ed').attr('name');
        var r_holo = angka($('#rusak_holo_ed').val());
        var r_kertas = angka($('#rusak_kertas_ed').val());
        var qty_holo = [], qty_kertas = [];

        for (var i=0; i<$('[name="holo_ed"]').length; i++) {
            t1 = angka($('[name="holo_ed"]:eq('+i+')').val());
            k1 = $('.rusak_holo_ed:eq('+i+')').html().split('<')[0];
            qty_holo.push(t1 + '@' + k1);
        }

        for (var i=0; i<$('[name="kertas_ed"]').length; i++) {
            t1 = angka($('[name="kertas_ed"]:eq('+i+')').val());
            k1 = $('.rusak_kertas_ed:eq('+i+')').html().split('<')[0];
            qty_kertas.push(t1 + '@' + k1);
        }

        var data = [id_edit, r_holo, r_kertas, qty_holo, qty_kertas];

        $('#btnProgress').click();
        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Sortir/simpan_ed" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    filter();
                }, 500);
            }
        });
    }

// Pilih File Foto
    function open_file(btn) {
        var allow_extension = ['JPG','JPEG','PNG'];
        var reader = new FileReader();
        var file = $('#file').get(0).files[0];
        var filename = (file['name']).split('.');
        var extension = filename[filename.length-1];
        var size = file.size;

        if (size > 5000000) {del_file(); error_isian('Max. Ukuran File 5 Mb..');}
        if (allow_extension.indexOf(extension.toUpperCase()) != -1) {
            reader.onload = function(e) {
                gambar = $('#img_prev')[0];
                gambar.setAttribute('src',e.target.result);
            }
            reader.readAsDataURL(file);
        }else{
            del_file();
            error_isian('Format gambar JPG, JPEG, PNG..');
        }
    }

// Hapus Preview Foto
    function del_file() {
        document.getElementById('file').value = '';
        $('#img_prev')[0].setAttribute('src','<?php echo base_url() . 'assets/images/no_preview.jpg'; ?>');
    }

</script>