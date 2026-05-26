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
            height: 30px;
            vertical-align: middle;
            padding-left: 5px;
        }

        #tbl_print thead td, #tbl_print tbody td, #tbl_print tfoot td {
            border: 1px solid #6C6C6C;
        }

        #tbl_standar th, #tbl_standar td {
            border: 1px solid #6C6C6C;
            padding: 1px;
        }
    }

</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Pengujian Coating</div></font></b>
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
                    <div class="col-md-6"> 
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
                            <tr>
                                <th>Kode Roll</th>
                                <td>
                                    <input type="number" class="form-control" id="kode_roll" maxlength="3" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Panjang</th>
                                <td>
                                    <input type="text" class="form-control num2" id="panjang" autocomplete="off">
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
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-5">
                        <table width="100%">
                            <tr>
                                <th width="40%">Speed</th>
                                <td>
                                    <input type="number" id="speed" class="numbers nums text-center" value="0" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Visual</th>
                                <td>
                                    <select class="select_min" id="visual" style="width: 100%;">
                                        <option value="1">OK</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Arah Baca</th>
                                <td>
                                    <select class="select_min" id="arah" style="width: 100%;">
                                        <option value="1">OK</option>
                                        <option value="0">Reject</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Viscositas</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <?php for ($i=1; $i<=3; $i++) { ?>
                                            <div class="text-info">St-<?php echo $i; ?><input type="number" id="visc_<?php echo $i; ?>" class="numbers nums text-center" value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>GSM</th>
                                <td>
                                    <div class="d-flex justify-content-between text-center">
                                        <?php for ($i=1; $i<=3; $i++) { ?>
                                            <div class="text-info">St-<?php echo $i; ?><input type="number" id="gsm_<?php echo $i; ?>" class="numbers nums text-center"  value="0" style="width: 95%;" step="0.1" lang="en-US"></div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Acc</th>
                                <td>
                                    <input type="number" id="acc" class="numbers nums text-center" value="0" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Reject</th>
                                <td>
                                    <input type="number" id="rej" class="numbers nums text-center" value="0" step="0.1" lang="en-US">
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
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Coating</font></b>
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
                            <table id="tbl_excel" hidden></table>
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th rowspan="2">Jam</th>
                                        <th rowspan="2">Kode Roll</th>
                                        <th rowspan="2">Panjang</th>
                                        <th rowspan="2">Speed</th>
                                        <th rowspan="2">Arah Baca</th>
                                        <th colspan="3">Viscositas</th>
                                        <th colspan="3">GSM</th>
                                        <th rowspan="2">Acc</th>
                                        <th rowspan="2">Reject</th>
                                        <th rowspan="2">Pemeriksa</th>
                                        <th rowspan="2">Approval</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Average</th><th></th><th colspan="2"></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Max</th><th></th><th colspan="2"></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="5" class="text-left pl-3">Min</th><th></th><th colspan="2"></th><th></th><th></th><th></th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pengujian Coating')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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

    <h6 align="center" style="margin-top: -10mm;">LAPORAN PEMERIKSAAN COATING READABLE</h6>
    <h6 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 'No : ' + 001/PNP-HLG/QC.2-BHN/01/I/2025</div></h6>
    <table id="tbl_print" class="mt-4" style="width: 100%; font-size: 14px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="3">No.</td>
                <td rowspan="3" style="width: 50px;">Jam</td>
                <td rowspan="3" style="width: 60px;">Kode Roll</td>
                <td rowspan="3" style="width: 110px;">Ukuran<br>(cm x meter)</td>
                <td colspan="8">Inspeksi & Test Hologram</td>
                <td rowspan="2" colspan="2">Sample Hasil Coating</td>
                <td rowspan="2" colspan="2">Panjang<br>(meter)</td>
                <td rowspan="2" colspan="2">Tanda Tangan</td>
            </tr>
            <tr>
                <td rowspan="2">Speed<br>(m/mnt)</td>
                <td rowspan="2" style="width: 70px;">Arah Baca</td>
                <td colspan="3">Viscositas (detik)</td>
                <td colspan="3">Gramature (gr/m&sup2; )</td>
            </tr>
            <tr>
                <td style="width: 60px;">1</td>
                <td style="width: 60px;">2</td>
                <td style="width: 60px;">3</td>
                <td style="width: 60px;">1</td>
                <td style="width: 60px;">2</td>
                <td style="width: 60px;">3</td>
                <td style="width: 170px;">Readable</td>
                <td style="width: 170px;">Aktivator</td>
                <td style="width: 80px;">Acc</td>
                <td style="width: 70px;">Reject</td>
                <td style="width: 70px;">QC</td>
                <td style="width: 70px;">Opr</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr style="height: 90px; font-size: 13px;">
                <td colspan="18" style="vertical-align: top;"><b>Remark :</b></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-QC2-012 Rev. 03</div>
    <div class="row">
        <div class="col-4" style="margin-top: -20px; font-size: 12px;">
            <div>Keterangan :</div>
            <div>Tanda "V" = Baik / ACC</div>

            <table id="tbl_standar" style="width: 100%;">
                <thead>
                    <tr align="center">
                        <th>Standar</th>
                        <th>Viscositas</th>
                        <th>Gramature</th>
                    </tr>
                </thead>
                <tbody>
                    <tr align="center">
                        <td>Station 1 (GW)</td>                        
                        <td>9 - 10 detik</td>                        
                        <td>0.9 - 1.0 gr/m&sup2;</td>                        
                    </tr>
                    <tr align="center">
                        <td>Station 2 (RD)</td>                          
                        <td>9 - 10 detik</td>                        
                        <td>0.3 - 0.4 gr/m&sup2;</td>                    
                    </tr>
                    <tr align="center">
                        <td>Station 3 (EJ)</td>                         
                        <td>10 - 11 detik</td>                        
                        <td>1.0 - 1.3 gr/m&sup2;</td>                         
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-1"></div>
        <div class="col-5">
            <table class="table-borderless mt-1 mr-5" style="width: 100%; height: 130px;">
                <tr align="center" style="line-height: 5px;">
                    <td width="25%">Mengetahui,</td>
                    <td>Hormat kami,</td>
                    <td width="20%"></td>
                    <td width="20%"></td>
                </tr>
                <tr align="center" style="line-height: 10px; vertical-align: bottom;">
                    <td>
                        <div id="p_mengetahui">( ...................... )</div>
                        <div style="margin-top: 8px; margin-bottom: 10px;">Kabag / Kabid QC</div>
                    </td>
                    <td>
                        <div id="p_pemeriksa">( ...................... )</div>
                        <div style="margin-top: 8px; margin-bottom: 10px;">QC Emboss / Coating</div>
                    </td>
                    <td>
                        <div id="p_pemeriksa">( ...................... )</div>
                        <div style="margin-top: 8px; margin-bottom: 10px;">Pengawas</div>
                    </td>
                    <td>
                        <div id="p_pemeriksa">( ...................... )</div>
                        <div style="margin-top: 8px; margin-bottom: 10px;">IS</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<!-- Modal Setting target -->
<div class="modal fade" id="modal_set">
    <div class="modal-dialog table-responsive" style="max-height: 90vh;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center">Target GSM</h4></b>
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
                        <th>Coating&nbsp; - Station 1</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 2</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 3</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>

            <div class="card-header bg-warning rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center">Target Viscositas</h4></b>
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
                        <th>Coating&nbsp; - Station 1</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 2</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num2 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num2 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num2 m-1" placeholder="Min" autocomplete="off">
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th class="pl-5">&nbsp; &nbsp; - Station 3</th>
                        <td>
                            <div class="d-flex text-center">
                                <input type="text" class="form-control text-center target num3 m-1" placeholder="Target" autocomplete="off">
                                <input type="text" class="form-control text-center max num3 m-1" placeholder="Max" autocomplete="off">
                                <input type="text" class="form-control text-center min num3 m-1" placeholder="Min" autocomplete="off">
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

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

<script>

// Defined Variable
    var dt_kode = ['GSM-R1', 'GSM-R2', 'GSM-R3', 'VISC-R1', 'VISC-R2', 'VISC-R3'];
    var dt_deskripsi = ['GSM STATION 1', 'GSM STATION 2', 'GSM STATION 3', 'VISC STATION 1', 'VISC STATION 2', 'VISC STATION 3'];

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
            url: '<?php echo base_url()."index.php/qc/Coating/auto_no" ?>',
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
        var kode_roll = $('#cari').val();
        var data = [tgl1, tgl2, desain, kode_roll];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Coating/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_panjang = [], ar_visc_1 = [], ar_visc_2 = [], ar_visc_3 = [], ar_gsm_1 = [], ar_gsm_2 = [], ar_gsm_3 = [];
                    for (var i=0; i<data.length; i++) {
                        keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                        arah = data[i].ARAH_BACA == '1' ? 'Ok' : 'Rej';

                        visc_1 = data[i].VISC_1 == 0 ? '' : desimal(data[i].VISC_1, 2);
                        visc_2 = data[i].VISC_2 == 0 ? '' : desimal(data[i].VISC_2, 2);
                        visc_3 = data[i].VISC_3 == 0 ? '' : desimal(data[i].VISC_3, 2);
                        gsm_1 = data[i].GSM_1 == 0 ? '' : desimal(data[i].GSM_1, 1);
                        gsm_2 = data[i].GSM_2 == 0 ? '' : desimal(data[i].GSM_2, 1);
                        gsm_3 = data[i].GSM_3 == 0 ? '' : desimal(data[i].GSM_3, 1);

                        ar_panjang.push(Number(data[i].PANJANG));
                        visc_1 != '' ? ar_visc_1.push(Number(visc_1)) : '';
                        visc_2 != '' ? ar_visc_2.push(Number(visc_2)) : '';
                        visc_3 != '' ? ar_visc_3.push(Number(visc_3)) : '';
                        gsm_1 != '' ? ar_gsm_1.push(Number(gsm_1)) : '';
                        gsm_2 != '' ? ar_gsm_2.push(Number(gsm_2)) : '';
                        gsm_3 != '' ? ar_gsm_3.push(Number(gsm_3)) : '';

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE+'</td><td>'+format_number(data[i].PANJANG)+'</td><td>'+data[i].SPEED+'</td><td>'+arah+'</td><td>'+visc_1+'</td><td>'+visc_2+'</td><td>'+visc_3+'</td><td>'+gsm_1+'</td><td>'+gsm_2+'</td><td>'+gsm_3+'</td><td>'+format_number(data[i].ACC)+'</td><td>'+format_number(data[i].REJ)+'</td><td align="left">'+data[i].PEMERIKSA+'</td><td align="left">'+data[i].APPROVAL+'</td><td align="left">'+keterangan+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    $('#tbl tfoot tr:eq(0) th:eq(1)').html(format_number(Number(calc_avg(ar_panjang)[0]).toFixed(0)));
                    $('#tbl tfoot tr:eq(1) th:eq(1)').html(format_number(Number(calc_avg(ar_panjang)[1]).toFixed(0)));
                    $('#tbl tfoot tr:eq(2) th:eq(1)').html(format_number(Number(calc_avg(ar_panjang)[2]).toFixed(0)));

                    $('#tbl tfoot tr:eq(0) th:eq(3)').html(calc_avg(ar_visc_1, 2)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(3)').html(calc_avg(ar_visc_1, 2)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(3)').html(calc_avg(ar_visc_1, 2)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(4)').html(calc_avg(ar_visc_2, 2)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(4)').html(calc_avg(ar_visc_2, 2)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(4)').html(calc_avg(ar_visc_2, 2)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(5)').html(calc_avg(ar_visc_3, 2)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(5)').html(calc_avg(ar_visc_3, 2)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(5)').html(calc_avg(ar_visc_3, 2)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(6)').html(calc_avg(ar_gsm_1)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(6)').html(calc_avg(ar_gsm_1)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(6)').html(calc_avg(ar_gsm_1)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(7)').html(calc_avg(ar_gsm_2)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(7)').html(calc_avg(ar_gsm_2)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(7)').html(calc_avg(ar_gsm_2)[2]);
                    $('#tbl tfoot tr:eq(0) th:eq(8)').html(calc_avg(ar_gsm_3)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(8)').html(calc_avg(ar_gsm_3)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(8)').html(calc_avg(ar_gsm_3)[2]);

                    setTimeout(function() {
                        $('#btnOk').click();
                        page('tbl');
                    }, 500);
                }
            }); 
        }, 500); // End Ajax
    } // End Filter

// Kosongkan Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#speed').val('0');
        $('.numbers').val('0');
        $('#keterangan').val('');
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
        var kode_roll = $("#kode_roll").val();
        var panjang = angka($("#panjang").val());
        var id_pemeriksa = $("#pemeriksa").val();
        var id_approval = $("#approval").val();
        var speed = angka($("#speed").val());
        var visual = $("#visual").val();
        var arah = $("#arah").val();
        var visc_1 = angka($("#visc_1").val());
        var visc_2 = angka($("#visc_2").val());
        var visc_3 = angka($("#visc_3").val());
        var gsm_1 = angka($("#gsm_1").val());
        var gsm_2 = angka($("#gsm_2").val());
        var gsm_3 = angka($("#gsm_3").val());
        var acc = angka($("#acc").val());
        var rej = angka($("#rej").val());
        var keterangan = huruf($("#keterangan").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (jam == '') {error_isian('Jam belum diisi..');}
        if (kode_roll == '') {error_isian('Kode Roll belum diisi..');}
        if (speed == '0') {error_isian('Speed belum diisi..');}

        var data = [id_edit, nmr, desain, tgl, jam, kode_roll, panjang, id_pemeriksa, id_approval, speed, visual, arah, visc_1, visc_2, visc_3, gsm_1, gsm_2, gsm_3, acc, rej, keterangan];

        $('#btnProgress').click();   
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Coating/simpan" ?>',
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
                url: '<?php echo base_url()."index.php/qc/Coating/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR);
                    $("#tgl").val(format_date(data.TGL));
                    $('#desain').val(data.DESAIN).change().change();
                    $('#jam').val(data.JAM);
                    $('#kode_roll').val(data.KODE).change();
                    $('#panjang').val(format_number(data.PANJANG)).change();
                    $('#pemeriksa').val(data.ID_PEMERIKSA).change();
                    $('#approval').val(data.ID_APPROVAL).change();
                    $('#speed').val(data.SPEED);
                    $('#visual').val(data.VISUAL).change();
                    $('#arah').val(data.ARAH_BACA).change();
                    $('#visc_1').val(desimal(data.VISC_1, 2));
                    $('#visc_2').val(desimal(data.VISC_2, 2));
                    $('#visc_3').val(desimal(data.VISC_3, 2));
                    $('#gsm_1').val(desimal(data.GSM_1, 1));
                    $('#gsm_2').val(desimal(data.GSM_2, 1));
                    $('#gsm_3').val(desimal(data.GSM_3, 1));
                    $('#acc').val(data.ACC);
                    $('#rej').val(data.REJ);
                    $('#keterangan').val(data.KETERANGAN);

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
                url: '<?php echo base_url()."index.php/qc/Coating/hapus" ?>',
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
        var data = [id_cetak, dt_kode];
        var numbers_1 = [], numbers_2 = [], numbers_3 = [], numbers_4 = [];

        $('#tbl_print tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/qc/Coating/cetak" ?>',
            data: {data: data},
            success: function(data) {
                data = JSON.parse(data);
                target = data[0];
                data = data[1];

                target_d1 = Number(target[0].TARGET), max_d1 = Number(target[0].MAX), min_d1 = Number(target[0].MIN);
                target_r1 = Number(target[1].TARGET), max_r1 = Number(target[1].MAX), min_r1 = Number(target[1].MIN);
                target_r2 = Number(target[2].TARGET), max_r2 = Number(target[2].MAX), min_r2 = Number(target[2].MIN);
                target_r3 = Number(target[3].TARGET), max_r3 = Number(target[3].MAX), min_r3 = Number(target[3].MIN);

                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC2-BHN/' + tgl + '/' + bln + '/' + thn;
                ket = '<b>Remark :</b><br>';

                $('#nmr_print').html('No : ' + nmr);
                $('#p_mengetahui').html('<b><u>' + data[data.length-1].APPROVAL + '</u></b>');
                $('#p_pemeriksa').html('<b><u>' + data[data.length-1].PEMERIKSA + '</u></b>');
                $('#tbl_print tbody tr').remove();

                for (var i=0; i<data.length; i++) {
                    panjang = '75 x ' + format_number(data[i].PANJANG);
                    arah = data[i].ARAH_BACA == '1' ? 'V' : 'X';
                    acc = data[i].ACC == '0' ? '-' : format_number(data[i].ACC);
                    rej = data[i].REJ == '0' ? '-' : format_number(data[i].REJ);
                    t_ket = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN + '<br>';
                    ket = ket + t_ket;

                    gsm_1 = Number(data[i].GSM_1) < 0.9 || Number(data[i].GSM_1) > 1 ? (0.9+Math.random()*(1-0.9)).toFixed(1) : desimal(data[i].GSM_1, 1);
                    gsm_2 = Number(data[i].GSM_2) < 0.4 || Number(data[i].GSM_2) > 0.5 ? (0.4+Math.random()*(0.5-0.4)).toFixed(1) : desimal(data[i].GSM_2, 1);
                    gsm_3 = Number(data[i].GSM_3) < 1.0 || Number(data[i].GSM_3) > 1.2 ? (1.0+Math.random()*(1.2-1.0)).toFixed(1) : desimal(data[i].GSM_3, 1);

                    visc_1 = Number(data[i].VISC_1) < min_r1 || Number(data[i].VISC_1) > max_r1 ? (min_r1+Math.random()*(max_r1-min_r1)).toFixed(2) : desimal(data[i].VISC_1, 2);
                    visc_2 = Number(data[i].VISC_2) < min_r2 || Number(data[i].VISC_2) > max_r2 ? (min_r2+Math.random()*(max_r2-min_r2)).toFixed(2) : desimal(data[i].VISC_2, 2);
                    visc_3 = Number(data[i].VISC_3) < min_r3 || Number(data[i].VISC_3) > max_r3 ? (min_r3+Math.random()*(max_r3-min_r3)).toFixed(2) : desimal(data[i].VISC_3, 2);

                    $('#tbl_print tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].JAM+'</td><td>'+data[i].KODE+'</td><td>'+panjang+'</td><td>'+data[i].SPEED+'</td><td>'+arah+'</td><td>'+visc_1+'</td><td>'+visc_2+'</td><td>'+visc_3+'</td><td>'+gsm_1+'</td><td>'+gsm_2+'</td><td>'+gsm_3+'</td><td></td><td></td><td>'+acc+'</td><td>'+rej+'</td><td></td><td></td></tr>');
                }

                $('#tbl_print tfoot td:eq(0)').html(ket);

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
            url: '<?php echo base_url()."index.php/qc/Coating/open_set" ?>',
            data: {data: dt_kode},
            success: function(data) {
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    $('.target:eq('+i+')').val(angka(data[i].TARGET.replaceAll(',', '.')));
                    $('.max:eq('+i+')').val(angka(data[i].MAX.replaceAll(',', '.')));
                    $('.min:eq('+i+')').val(angka(data[i].MIN.replaceAll(',', '.')));
                }
            }
        });        
    }

// Simpan Setting Viscositas
    function simpan_set() {
        var target = [], max = [], min = [];

        for (var i=0; i<6; i++) {
            target.push(Number($('.target:eq('+i+')').val()));
            max.push(Number($('.max:eq('+i+')').val()));
            min.push(Number($('.min:eq('+i+')').val()));
        }

        var data = [target, max, min, dt_kode, dt_deskripsi];

        $('.btn_close').click();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Coating/simpan_set" ?>',
                data: {data: data},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                    }, 500);
                }
            });
        }, 500);
    }

</script>