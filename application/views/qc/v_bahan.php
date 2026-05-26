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
                    <b><font color="White"><div>Pengujian Chemical</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
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
                                <th>Tanggal PBT</th>
                                <td>
                                    <input id="tgl_pbt" type="text" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tanggal Terima</th>
                                <td>
                                    <input id="tgl" type="text" class="form-control datepicker" onchange="auto_no()" value="<?php echo date('d-M-Y'); ?>" style="background-color: white; cursor: pointer;" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nama Barang</th>
                                <td>
                                    <select class="select" id="barang" style="width: 100%;">
                                        <option value="@">Pilih..</option>                                      
                                        <?php foreach ($barang->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID'] . '@' . $dt['SATUAN']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Qty</th>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <input type="number" id="qty" class="numbers text-center" value="0" step="0.1" lang="en-US">
                                        <div class="m-1"></div>
                                        <input type="text" id="satuan" class="form-control" style="width: 100px;" readonly>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pemeriksa</th>
                                <td>
                                    <select class="select_min" id="pemeriksa" style="width: 100%;">
                                        <?php foreach ($pemeriksa->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>" <?php if ($dt['ID'] == '587') {echo 'selected';} ?>><?php echo $dt['NAMA']; ?></option>
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
                                <th width="40%">Solid Content</th>
                                <td>
                                    <input type="number" id="solid" class="numbers text-center" value="0" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Viscositas</th>
                                <td>
                                    <input type="number" id="visc" class="numbers text-center" value="0" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Densitas</th>
                                <td>
                                    <input type="number" id="densitas" class="numbers text-center" value="0" step="0.1" lang="en-US">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Visual</th>
                                <td>
                                    <select class="select_min" id="visual" style="width: 100%;">
                                        <option value="1">Acc</option>                                      
                                        <option value="0">Rej</option>                                      
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Acc</th>
                                <td>
                                    <select class="select_min" id="acc" style="width: 100%;">
                                        <option value="1">Acc</option>                                      
                                        <option value="0">Rej</option>                                      
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
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Pengujian Chemical</font></b>
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
                            <table class="tbl_filter" style="width: 500px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="50%" class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th class="filter">Nama Bahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('01-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_barang" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>                                      
                                                <?php foreach ($barang->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
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
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Nomor Urut</th>
                                        <th colspan="2">Tanggal</th>
                                        <th rowspan="2">Nama Barang</th>
                                        <th rowspan="2">Qty</th>
                                        <th rowspan="2">Satuan</th>
                                        <th rowspan="2">Solid Content</th>
                                        <th rowspan="2">Viscositas</th>
                                        <th rowspan="2">Densitas</th>
                                        <th rowspan="2">Visual</th>
                                        <th rowspan="2">Acc</th>
                                        <th rowspan="2">Pemeriksa</th>
                                        <th rowspan="2">Approval</th>
                                        <th rowspan="2">Keterangan</th>
                                        <th rowspan="2">Cetak</th>
                                        <th rowspan="2">Edit</th>
                                        <th rowspan="2">Hapus</th>
                                    </tr>
                                    <tr>
                                        <th>Terima</th>
                                        <th>PBT</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Average</th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Max</th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="7" class="text-left pl-3">Min</th><th></th><th></th><th></th><th colspan="8"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-success" onclick="excel('tbl', 'Laporan Pengujian Chemical')" style="width: 110px;"><i class="fa fa-folder mr-2"></i><b>Excel</b></button>
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

<div id="printable" style="display: none; overflow: hidden; font-size: 13px;">
    <div style="width: 200px;  margin-bottom: 15px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
    </div>

    <h5 align="center" style="margin-top: -1mm;">LAPORAN PEMERIKSAAN PIGMEN, HEAT SEAL DAN TOLUOL</h5>
    <h5 align="center" style="margin-top: -2mm;"><div id="nmr_print">No : 001/PNP-HLG/QC.2-BHN/01/I/2025</div></h5>
    <table id="tbl_print" class="mt-4" width="100%" style="font-size: 16px;">
        <thead style="text-align: center; font-weight: bold;">
            <tr>
                <td rowspan="2">No.</td>
                <td colspan="2">Tanggal</td>
                <td rowspan="2">Jenis Bahan</td>
                <td rowspan="2">Berat Neto<br>( Kg )</td>
                <td rowspan="2">Solid Content<br>( % )</td>
                <td rowspan="2">Viscositas<br>( detik )</td>
                <td rowspan="2">Densitas<br>( gr/ml )</td>
                <td rowspan="2">Visual</td>
                <td colspan="2">Keterangan</td>
            </tr>
            <tr>
                <td>Terima</td>
                <td>Prod. PBT</td>
                <td>Acc</td>
                <td>Reject</td>
            </tr>
        </thead>
        <tbody align="center"></tbody>
        <tfoot>
            <tr style="height: 90px; font-size: 13px;">
                <td colspan="11" style="vertical-align: top;"><b>Remark :</b></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form_m" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-QC2-008 Rev. 02</div>
    <div class="d-flex justify-content-between" style="font-size: 14px;">
        <table>
            <tr><td>Keterangan : tanda (V) : sesuai / baik, tanda (X) : tidak sesuai</td></tr>
            <tr><td>1. Standar solid content heatseal & readable : &ge; 35%</td></tr>
            <tr><td>2. Viscositas heatseal & readable : min. 15 detik</td></tr>
            <tr><td>3. Standar toluol :</td></tr>
            <tr><td class="pl-2">- viscositas : 6 detik</td></tr>
            <tr><td class="pl-2">- densitas pada suhu 27&deg;C : 0,856 - 0,860 gr/ml</td></tr>
            <tr><td class="pl-2">- visual jernih ( tidak keruh )</td></tr>
            <tr style="height: 20px;"><td></td></tr>
            <tr><td>CC : 1. Yth. Bag. Gudang</td></tr>
            <tr><td style="padding-left: 26px;">2. File</td></tr>
        </table>
        <div style="width: 50px;"></div>
        <table class="table-bordered mt-1 mr-5" width="35%" style="height: 150px;">
            <tr align="center" style="line-height: 5px;">
                <td width="50%">Mengetahui,</td>
                <td>Hormat kami,</td>
            </tr>
            <tr align="center" style="line-height: 10px; vertical-align: bottom;">
                <td>
                    <div id="p_mengetahui">( ...................... )</div>
                    <div style="margin-top: 5px; margin-bottom: 10px;">Kabag / Kabid QC</div>
                </td>
                <td>
                    <div id="p_pemeriksa">( ...................... )</div>
                    <div style="margin-top: 5px; margin-bottom: 10px;">QC Bahan</div>
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
<script src="<?php echo base_url(); ?>assets/js/script.js?=4"></script>

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
            url: '<?php echo base_url()."index.php/qc/Bahan/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Isi Satuan Barang
    $('#barang').change(function() {
        var satuan = $('#barang').val().split('@')[1];

        $('#satuan').val(satuan);
    });

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var id_barang = $('#f_barang').val();
        var data = [tgl1, tgl2, id_barang];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Bahan/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    ar_solid = [], ar_visc = [], ar_densitas = [];
                    for (var i=0; i<data.length; i++) {
                        keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                        acc = data[i].ACC == '1' ? 'OK' : 'Rej';
                        visual = data[i].VISUAL == '1' ? 'OK' : 'Rej';
                        
                        qty = desimal(data[i].QTY, 1);
                        solid = desimal(data[i].SOLID, 1);
                        visc = desimal(data[i].VISC, 0);
                        densitas = desimal(data[i].DENSITAS, 3);

                        ar_solid.push(solid);
                        ar_visc.push(visc);
                        ar_densitas.push(densitas);

                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].NMR+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+format_date(data[i].TGL_PBT)+'</td><td align="left">'+data[i].BARANG+'</td><td>'+qty+'</td><td>'+data[i].SATUAN+'</td><td>'+solid+'</td><td>'+visc+'</td><td>'+densitas+'</td><td>'+visual+'</td><td>'+acc+'</td><td align="left">'+data[i].PEMERIKSA+'</td><td align="left">'+data[i].APPROVAL+'</td><td align="left">'+keterangan+'</td><td align="center"><button type="button" class="btn btn-block btn-success btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    $('#tbl tfoot tr:eq(0) th:eq(1)').html(calc_avg(ar_solid)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(1)').html(calc_avg(ar_solid)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(1)').html(calc_avg(ar_solid)[2]);

                    $('#tbl tfoot tr:eq(0) th:eq(2)').html(calc_avg(ar_visc)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(2)').html(calc_avg(ar_visc)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(2)').html(calc_avg(ar_visc)[2]);

                    $('#tbl tfoot tr:eq(0) th:eq(3)').html(calc_avg(ar_densitas, 3)[0]);
                    $('#tbl tfoot tr:eq(1) th:eq(3)').html(calc_avg(ar_densitas, 3)[1]);
                    $('#tbl tfoot tr:eq(2) th:eq(3)').html(calc_avg(ar_densitas, 3)[2]);

                    setTimeout(function() {$('#btnOk').click(); page('tbl');}, 500);
                }
            }); 
        }, 500);
    }

// Kosongkan Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#barang').val('@').change();
        $('#qty').val('0');
        $('#satuan').val('');
        $('#solid').val('0');
        $('#visc').val('0');
        $('#densitas').val('0');
        $('#visual').val('1');
        $('#acc').val('1');
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
        var tgl_pbt = $("#tgl_pbt").val();
        var tgl = $("#tgl").val();
        var id_barang = $("#barang").val().split('@')[0];
        var qty = $("#qty").val();
        var satuan = $("#satuan").val();
        var id_pemeriksa = $("#pemeriksa").val();
        var id_approval = $("#approval").val();
        var solid = angka($("#solid").val());
        var visc = angka($("#visc").val());
        var densitas = angka($("#densitas").val());
        var visual = $("#visual").val();
        var acc = $("#acc").val();
        var keterangan = huruf($("#keterangan").val());

        if (nmr == '0000') {error_isian('Nomor Urut belum diisi..');}
        if (id_barang == '') {error_isian('Nama Barang belum diisi..');}
        if (qty == '0') {error_isian('Qty belum diisi..');}
        if (id_pemeriksa == '') {error_isian('Nama Pemeriksa belum diisi..');}
        if (id_approval == '') {error_isian('Nama Approval belum diisi..');}

        var data = [id_edit, nmr, tgl_pbt, tgl, id_barang, qty, satuan, solid, visc, densitas, visual, acc, id_pemeriksa, id_approval, keterangan];

        console.log(data);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Bahan/simpan" ?>',
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
        }, 500);
    }

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Bahan/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#nmr').val(data.NMR);
                    $("#tgl_pbt").val(format_date(data.TGL_PBT));
                    $("#tgl").val(format_date(data.TGL));
                    $('#barang').val(data.BARANG).change();
                    $("#qty").val(desimal(data.QTY, 1));
                    $("#satuan").val(data.SATUAN);
                    $("#pemeriksa").val(data.ID_PEMERIKSA).change();
                    $("#approval").val(data.ID_APPROVAL).change();
                    $("#solid").val(desimal(data.SOLID, 1));
                    $("#visc").val(desimal(data.VISC, 0));
                    $("#densitas").val(desimal(data.DENSITAS, 3));
                    $("#visual").val(data.VISUAL);
                    $("#acc").val(data.ACC);
                    $("#keterangan").val(data.KETERANGAN);

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
                url: '<?php echo base_url()."index.php/qc/Bahan/hapus" ?>',
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
            url: '<?php echo base_url()."index.php/qc/Bahan/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                tgl = data[0].TGL.split('-')[0];         
                thn = data[0].TGL.split('-')[2];         
                bln = get_romawi(format_date(data[0].TGL));
                nmr = data[0].NMR + '/PNP-HLG/QC2-BHN/' + tgl + '/' + bln + '/' + thn;
                ket = '<b>Remark :</b>';

                $('#nmr_print').html(nmr);
                $('#p_mengetahui').html('<b><u>' + data[0].MENGETAHUI + '</u></b>');
                $('#p_pemeriksa').html('<b><u>' + data[0].PEMERIKSA + '</u></b>');
                $('#tbl_print tbody tr').remove();
                for (var i=0; i<data.length; i++) {
                    solid = data[i].SOLID == 0 ? '' : desimal(data[i].SOLID, 1);
                    visc = data[i].VISC == 0 ? '' : desimal(data[i].VISC, 0);
                    densitas = data[i].DENSITAS == 0 ? '' : desimal(data[i].DENSITAS, 3);
                    visual = data[i].VISUAL == '1' ? 'V' : 'X';
                    acc = data[i].ACC == '1' ? 'V' : '';
                    rej = data[i].ACC == '1' ? '' : 'V';
                    t_ket = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                    ket = ket + '<br>' + t_ket;

                    $('#tbl_print tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+format_date(data[i].TGL)+'</td><td>'+format_date(data[i].TGL_PBT)+'</td><td align="left">'+data[i].BARANG+'</td><td>'+desimal(data[i].QTY, 1)+'</td><td>'+solid+'</td><td>'+visc+'</td><td>'+densitas+'</td><td>'+visual+'</td><td>'+acc+'</td><td>'+rej+'</td></tr>');
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

</script>