<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<!-- Custom CSS -->
<style> body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #000 !important;} @media print { @page {size: landscape;} html, body {width: 330mm;height: 210mm;} #pr_body td {height: 20px; vertical-align: middle; padding-left: 5px;}}
</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div>Input Proses Sticker</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-lg-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Desain</th>
                                <td>
                                    <select class="select_min" id="desain" onchange="isi_kerja()" style="width: 100%;">
                                        <?php foreach($desain->result_array() as $dt) { ?>
                                            <option><?php echo $dt['DESAIN']; ?></option>               
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th width="40%">Nomor</th>
                                <td>
                                    <div class="d-flex">
                                        <input type="number" id="nmr" name="" class="form-control" value="000" maxlength="3" onfocusout="isi_nomor()" autocomplete="off">
                                    </div>
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
                                <th>Shift</th>
                                <td>
                                    <select class="select_min" id="shift" style="width: 100%;">
                                        <option>A</option>               
                                        <option>B</option>               
                                        <option>C</option>               
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Pengawas</th>
                                <td>
                                    <select class="select_min" id="pengawas" style="width: 100%;">
                                        <option value="">Pilih..</option>               
                                        <?php foreach ($pengawas->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>" <?php if ($dt['ID'] == $dt['LAST_PGWS']) {echo 'selected';} ?>><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Jam Produksi</th>
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
                                <th>Nomor PP</th>
                                <td>
                                    <select class="select" id="pp" style="width: 100%;">
                                        <option value="">Pilih..</option>
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
                                <th width="40%">Kode Kertas</th>
                                <td>
                                    <select class="select" id="no_roll" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Lebar</th>
                                <td>
                                    <input type="text" id="lebar" class="form-control" value="34" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Panjang</th>
                                <td>
                                    <input type="text" id="panjang" class="form-control num" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Hasil</th>
                                <td>
                                    <input type="text" id="hasil" class="form-control num" value="0" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Operator</th>
                                <td>
                                    <select class="form-control select" id="operator" multiple="multiple" style="width: 100%; cursor: pointer;">
                                        <?php foreach ($operator->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo ucwords(strtolower($dt['NAMA'])); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Keterangan</th>
                                <td>
                                    <textarea id="keterangan" class="form-control" rows="1" style="width: 100%;" maxlength="100" autocomplete="off"></textarea>  
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Panjang SRP</th>
                                <td>
                                    <input type="text" id="p_srp" class="form-control" value="0" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4">
                <div class="card-header bg-secondary">
                    <h3 class="card-title">
                        <b><font color="White"><div>Penggunaan SRP</div></font></b>
                    </h3>
                </div>
                <div class="card-body card_srp row">
                    <div class="col-lg-4 srp">
                        <div class="card p-2">
                            <table width="100%" class="tbl_srp">
                                <tr>
                                    <th width="40%">Kode SRP</th>
                                    <td>
                                        <input type="text" name="kode_srp" class="form-control" style="text-transform: uppercase;" maxlength="5" autocomplete="off">
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Lebar</th>
                                    <td>
                                        <input type="text" name="lebar" class="form-control" value="36" readonly>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Panjang</th>
                                    <td>
                                        <input type="text" name="panjang" class="form-control num" onchange="isi_sisa(this)" autocomplete="off">
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Hasil</th>
                                    <td>
                                        <input type="text" name="hasil" class="form-control num" onchange="isi_sisa(this)" autocomplete="off">
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Reject</th>
                                    <td>
                                        <input type="text" name="reject" class="form-control num" onchange="isi_sisa(this)" autocomplete="off">
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Sisa</th>
                                    <td>
                                        <input type="text" name="sisa" class="form-control" readonly>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                            </table>

                            <div class="card-footer text-center">
                                <button type="button" class="btn btn-secondary" onclick="hapus_srp(this)" style="width: 120px;"><i class="fa fa-trash mr-2"></i><b>Hapus</b></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="simpan()" style="width: 150px;"><i class="fa fa-save mr-2 mb-2 mt-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger" onclick="kosong()" style="width: 150px;"><i class="fa fa-ban mr-2 mb-2 mt-2"></i><b>Batal</b></button>
                <button type="button" class="btn btn-warning" onclick="add_srp()" style="width: 150px;"><i class="fa fa-plus mr-2 mb-2 mt-2"></i><b>SRP</b></button>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White" id="headerinput">Laporan Proses Sticker</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table class="tbl_filter" style="width: 450px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th class="filter" colspan="2">Periode</th>
                                        <th></th>
                                        <th width="20%" class="filter">Desain</th>
                                        <th></th>
                                        <th width="25%" class="filter">PP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td><input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="background-color: white; cursor: pointer;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_desain" onchange="isi_fkk()" style="width: 100%;">
                                                <?php foreach($desain->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['DESAIN']; ?></option>               
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="f_pp" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Nomor</th>
                                        <th>Desain</th>
                                        <th>Tanggal</th>
                                        <th>Shift</th>
                                        <th>PP</th>
                                        <th>Jam</th>
                                        <th>Kode Kertas</th>
                                        <th>Panjang</th>
                                        <th>Hasil</th>
                                        <th>Keterangan</th>
                                        <th>Pengawas</th>
                                        <th>Operator</th>
                                        <th>Kode SRP</th>
                                        <th>Cetak</th>
                                        <th>Edit</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot class="text-center">
                                    <th colspan="8">Total</th><th></th><th></th><th colspan="7"></th></th>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
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

<div id="printable" style="display: none; overflow: hidden; font-size: 14px;">
    <div style="width: 200px;  margin-bottom: -5px;">
        <img src="<?php echo base_url();?>assets/images/logo_pnp.png" style="height: 12mm; width: auto;">
    </div>

    <h5 align="center" style="margin-top: -1mm;">LAPORAN PRODUKSI LAMINASI STICKER MMEA</h5>
    <table width="100%" style="line-height: 4mm;">
        <tr>
            <td width="10%">Shift</td>
            <td width="3%">:</td>
            <td width="55%"></td>
            <td width="10%">No</td>
            <td width="3%">:</td>
            <td width="19%"></td>
        </tr>
        <tr>
            <td>PP</td>
            <td>:</td>
            <td></td>
            <td>Tanggal</td>
            <td>:</td>
            <td></td>
        </tr>
        <tr>
            <td>Mesin</td>
            <td>:</td>
            <td>MMEA / STICKER</td>
            <td>Halaman</td>
            <td>:</td>
            <td>1 dari 1</td>
        </tr>
    </table>
    <table id="pr_body" class="table-bordered mt-1" width="100%">
        <thead class="text-center">
            <tr>
                <td width="5%" rowspan="2">NO</td>
                <td width="20%" colspan="3">KERTAS</td>
                <td width="40%" colspan="6">SRP</td>
                <td width="10%">HASIL STICKER</td>
                <td width="10%" rowspan="2">JAM</td>
                <td rowspan="2">KETERANGAN</td>
            </tr>
            <tr>
                <td>KODE ROLL</td>
                <td>LEBAR (CM)</td>
                <td>PANJANG (MTR)</td>
                <td>KODE ROLL</td>
                <td>LEBAR (CM)</td>
                <td>PANJANG (MTR)</td>
                <td>SISA (MTR)</td>
                <td>HASIL (MTR)</td>
                <td>WASTE (MTR)</td>
                <td>PANJANG (MTR)</td>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr class="text-center text-bold">
                <td colspan="10">Total</td>
                <td></td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>
    <div id="nmr_form" align="right" style="font-size: 12px; margin-bottom: 10px;">F-SMT-P2-031 Rev. 00</div>
    <div class="input-group mt-1">
        <table class="table-bordered mt-1" width="35%">
            <tr align="center">
                <td width="60%">Operator</td>
                <td>Pengawas</td>
            </tr>
            <tr style="height: 20mm; vertical-align: bottom;">
                <td>
                    <div style="height: 80px; vertical-align: bottom; ">
                        <div class="opr pl-2" style="height: 60px;"></div>
                        <div align="center" style="height: 10px;">( ...................... ) </div>
                    </div>
                </td>
                <td class="text-center pgws"> ( ... KAMAL YAZID ATAU SARWO EDI ... ) </td>
            </tr>
        </table>
        <div style="width: 20px;"></div>
        <table class="table-bordered mt-1" width="15%">
            <tr align="center">
                <td colspan="2">Medium</td>
            </tr>
            <tr align="center">
                <td>Lem</td>
                <td>Toluol</td>
            </tr>
            <tr style="height: 20mm; vertical-align: bottom;">
                <td>
                    <div style="height: 80px; vertical-align: bottom; ">
                        <div style="height: 40px;"></div>
                        <div align="center"> ( ................... ) </div>
                        <div align="center"> Kg </div>
                    </div>
                </td>
                <td>
                    <div style="height: 80px; vertical-align: bottom; ">
                        <div style="height: 40px;"></div>
                        <div align="center"> ( ................... ) </div>
                        <div align="center"> Kg </div>
                    </div>
                </td>
            </tr>
        </table>
        <div style="width: 70px;"></div>
        <table class="table-borderless ml-2" width="40%">
            <tr>
                <td colspan="2"><b>Kategori Jam Berhenti :</b></td>
            </tr>
            <tr>
                <td>A = Persiapan Mesin</td>
                <td>E = Tunggu Core</td>
            </tr>
            <tr>
                <td>B = Trouble Proses Produksi</td>
                <td>F = Ganti Silinder/ Seri</td>
            </tr>
            <tr>
                <td>C = Trouble Mesin</td>
                <td>G = Force Major/ Special Case</td>
            </tr>
            <tr>
                <td>D = Tunggu Bahan/ Medium</td>
                <td>H = Lain-Lain</td>
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
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Defined Variable
    var dt_pp = <?php echo json_encode($pp->result_array()); ?>;
    var dt_roll = <?php echo json_encode($no_roll->result_array()); ?>;
    var do_filter = 1;

// Load Dokumen
    $(document).ready(function() {
        if ($(window).width() > 960) {$('.fa-bars:eq(0)').click();}

        $('.select').select2();
        $('.select_min').select2({minimumResultsForSearch: -1});
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        auto_no();
        last_opt();
        isi_kerja();
        isi_fkk();
        filter();
        onlynumeric();
    });

// Auto Nomor Sortir
    function auto_no() {
        var id_edit = $('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var data = [id_edit, tgl];

        $.ajax({
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/produksi/sticker/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }

// Isi Operator
    function last_opt() {
        $.ajax({
            async: false,
            type: 'POST',
            url: '<?php echo base_url()."index.php/produksi/sticker/last_opt" ?>',
            success: function(data) {
                data = JSON.parse(data).ID;
                id = data == null ? '' : data.substr(0, data.length-1).split(',');
                $('#operator').val(id).change();
            }
        });
    }

// Filter Data
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var desain = $('#f_desain').val();
        var pp = $('#f_pp').val();
        var data = [tgl1, tgl2, desain, pp];

        if (do_filter == 0) {return;}
        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();

        do_filter = 0;
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/produksi/sticker/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    t_panjang = 0, t_hasil = 0;
                    for (var i=0; i<data.length; i++) {
                        jam = data[i].MULAI + ' - ' + data[i].SELESAI;
                        operator = data[i].OPERATOR == null ? '' : data[i].OPERATOR.substring(0, data[i].OPERATOR.length - 1).replaceAll(',', '<br>');
                        srp = data[i].SRP == null ? '' : data[i].SRP.substring(0, data[i].SRP.length - 2);
                        keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;
                        t_panjang = Number(t_panjang) + Number(data[i].PANJANG);
                        t_hasil = Number(t_hasil) + Number(data[i].HASIL);

                        $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+data[i].NMR+'</td><td align="center">'+data[i].DESAIN+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+data[i].SHIFT+'</td><td align="center">'+data[i].PP+'</td><td align="center">'+jam+'</td><td align="center">'+data[i].KODE_KERTAS+'</td><td align="right">'+format_number(data[i].PANJANG)+'</td><td align="right">'+format_number(data[i].HASIL)+'</td><td>'+keterangan+'</td><td>'+data[i].PENGAWAS+'</td><td><div style="width: 50px;">'+operator+'</div></td><td><div style="width: 90px;">'+srp+'</div></td><td align="center"><button type="button" class="btn btn-block btn-info btn-sm" name="'+data[i].ID+'" style="width: 50px;" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" name="'+data[i].ID+'" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" name="'+data[i].ID+'" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa ion-trash-a"></i></button></td></tr>');
                    }
                    $('#tbl tfoot th:eq(1)').html(format_number(t_panjang));
                    $('#tbl tfoot th:eq(2)').html(format_number(t_hasil));

                    setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
                }
            }); 
            do_filter = 1;
        }, 500);
    }

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
                filename: 'Laporan Data Sticker',
                title: ''
            }],
            "colReorder": true
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Isi PP sesuai Desain
    function isi_kerja() {
        var desain = $('#desain').val();

        $('#pp option:gt(0)').remove();
        $('#no_roll option:gt(0)').remove();

        for (var i=0; i<dt_pp.length; i++) {
            if (desain == dt_pp[i].DESAIN) {
                $('#pp').append('<option>'+dt_pp[i].NOMOR_PP+'</option>');
            }
        }

        for (var i=0; i<dt_roll.length; i++) {
            if (desain == dt_roll[i].DESAIN) {
                $('#no_roll').append('<option>'+dt_roll[i].NO_ROLL+'</option>');
            }
        }

        $('#pp').change();
        $('#no_roll').change();
    }

// Isi Filter KK sesuai Desain
    function isi_fkk() {
        var desain = $('#f_desain').val();

        $('#f_pp option:gt(0)').remove();

        for (var i=0; i<dt_pp.length; i++) {
            if (desain == dt_pp[i].DESAIN) {
                $('#f_pp').append('<option>'+dt_pp[i].NOMOR_PP+'</option>');
            }
        }

        $('#f_pp option:gt(0)').change();
    }

// Isi Format Nomor 3 angka
    function isi_nomor() {
        var nmr = $('#nmr').val();
        var nmr = nmr.toString().padStart(3, "0");
        var nmr = nmr.substring(0,3);

        $('#nmr').val(nmr);
    }

// Tambah Bahan SRP
    function add_srp() {
        var srp = $('.srp:eq(0)').clone();
        var qty_srp = $('.srp').length;

        $('.card_srp:eq(0)').append(srp);
        $('[name="kode_srp"]:eq('+qty_srp+')').val('');
        $('[name="panjang"]:eq('+qty_srp+')').val('0');
        $('[name="hasil"]:eq('+qty_srp+')').val('0');
        $('[name="reject"]:eq('+qty_srp+')').val('0');
        $('[name="sisa"]:eq('+qty_srp+')').val('0');

        onlynumeric();
    }

// Hapus Bahan SRP
    function hapus_srp(btn) {
        var index = $(btn).index('.btn-secondary');
        var qty_srp = $('.srp').length;

        if (qty_srp == 1) {error_isian('Minimal 1 bahan SRP..');}
        $('.srp:eq('+index+')').remove();
    }

// Isi Sisa SRP
    function isi_sisa(btn) {
        var index = $(btn).parent().parent().parent().parent().index('.tbl_srp');
        var panjang = angka($('[name="panjang"]:eq('+index+')').val());
        var hasil = angka($('[name="hasil"]:eq('+index+')').val());
        var reject = angka($('[name="reject"]:eq('+index+')').val());
        var sisa = format_number(panjang - hasil - reject);

        $('[name="sisa"]:eq('+index+')').val(sisa)

        t_hasil = 0;
        for (var i=0; i<$('[name="hasil"]').length; i++) {
            hasil = $('[name="hasil"]:eq('+i+')').val();  
            t_hasil = t_hasil + angka(hasil);     
        }
        $('#p_srp').val(format_number(t_hasil));
    }

// Kosong Isian
    function kosong() {
        var qty_srp = $('.srp').length;

        add_srp();
        $('.srp:lt('+qty_srp+')').remove();
        $('#no_roll').val('').change();
        $('#panjang').val('0');
        $('#hasil').val('0');
        $('#p_srp').val('0');
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
        var desain = $('#desain').val();
        var nmr = $('#nmr').val();
        var tgl = $('#tgl').val();
        var shift = $('#shift').val();
        var id_pengawas = $('#pengawas').val();
        var mulai = $('#mulai').val();
        var selesai = $('#selesai').val();
        var start = cek_jam(tgl, mulai);
        var end = cek_jam(tgl, selesai);
        var pp = $('#pp').val();
        var no_roll = $('#no_roll').val();
        var lebar = $('#lebar').val();
        var panjang = angka($('#panjang').val());
        var hasil = angka($('#hasil').val());
        var operator = $('#operator').val();
        var keterangan = $('#keterangan').val();
        var qty_srp = $('.srp').length;

        if (id_pengawas == '') {error_isian('Nama Pengawas belum diisi..');}
        if (mulai == '') {error_isian('Jam Mulai salah..');}
        if (selesai == '') {error_isian('Jam Selesai salah..');}
        if (start >= end) {error_isian('Waktu mulai tidak boleh sama/ melebihi selesai..');}
        if (pp == '') {error_isian('Nomor PP belum diisi..');}
        if (no_roll == '') {error_isian('Kode Kertas Banderoll belum diisi..');}
        if (panjang < 1) {error_isian('Panjang Kertas belum diisi..');}
        if (hasil < 1) {error_isian('Hasil Kertas belum diisi..');}
        if (operator == null) {error_isian('Operator belum diisi..');}

        t_srp = 0, srp = [];
        for (var i=0; i<qty_srp; i++) {
            t_kode = document.getElementsByName('kode_srp')[i].value.toUpperCase();
            t_lebar = document.getElementsByName('lebar')[i].value;
            t_panjang = angka(document.getElementsByName('panjang')[i].value);
            t_hasil = angka(document.getElementsByName('hasil')[i].value);
            t_reject = angka(document.getElementsByName('reject')[i].value);
            t_sisa = angka(document.getElementsByName('sisa')[i].value);

            if (t_kode == '') {error_isian('Kode SRP nomor '+(i+1)+' belum diisi..');}
            if (t_panjang < 1) {error_isian('Panjang SRP nomor '+(i+1)+' belum diisi..');}
            if (t_hasil < 1) {error_isian('Hasil SRP nomor '+(i+1)+' belum diisi..');}
            if (t_sisa < 0) {error_isian('Sisa SRP nomor '+(i+1)+' salah..');}

            t_srp = t_srp + t_hasil;

            srp.push(t_kode + '@@' + t_lebar + '@@' + t_panjang + '@@' + t_hasil + '@@' + t_reject + '@@' + t_sisa);
        }

        if (panjang != t_srp) {error_isian('Panjang Bahan Kertas dan SRP tidak sama..');}

        var data = [id_edit, desain, nmr, tgl, shift, id_pengawas, mulai, selesai, pp, no_roll, lebar, panjang, hasil, operator, keterangan, srp];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/produksi/sticker/simpan" ?>',
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
    }

// Cek Format Tanggal dan Jam
    function cek_jam(tgl, jam) {
        var year = tgl.substring(9, 11);
        var date = tgl.substring(0, 2);
        var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var month = dt_month.indexOf(tgl.substring(3, 6)) + 1;
        month = ("0" + month).slice(-2);

        var hour = jam.substring(0, 2);
        var minute = jam.substring(3, 5);

        if (Number(hour) + minute < 630) {
            date++;
        }

        return year + month + date + hour + minute;
    }

// Edit Data
    function edit(btn) {
        var id_edit = btn.name;
        
        $('#nmr').attr('name', id_edit);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/produksi/sticker/edit" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);
                id_operator = data.ID_OPERATOR.substr(0, data.ID_OPERATOR.length-1).split(',');
                srp = data.SRP.split('@@');

                $('#desain').val(data.DESAIN).change();
                $('#nmr').val(data.NMR).change();
                $('#tgl').val(format_date(data.TGL)).change();
                $('#shift').val(data.SHIFT).change();
                $('#pengawas').val(data.ID_PENGAWAS).change();
                $('#mulai').val(data.MULAI).change();
                $('#selesai').val(data.SELESAI).change();
                $('#pp').val(data.PP).change();
                $('#no_roll').val(data.KODE_KERTAS).change();
                $('#lebar').val(format_number(data.LEBAR)).change();
                $('#panjang').val(format_number(data.PANJANG)).change();
                $('#hasil').val(format_number(data.HASIL)).change();
                $('#operator').val(id_operator).change();
                $('#keterangan').val(data.KETERANGAN).change();

                $('.srp:gt(0)').remove();
                for (var i=0; i<srp.length - 1; i++) {
                    kode_srp = srp[i].split('@')[0];
                    lebar = srp[i].split('@')[1];
                    panjang = format_number(srp[i].split('@')[2]);
                    hasil = format_number(srp[i].split('@')[3]);
                    reject = format_number(srp[i].split('@')[4]);
                    sisa = format_number(srp[i].split('@')[5]);
                    if (i !=0 ) {add_srp();}

                    $('[name="kode_srp"]:eq('+i+')').val(kode_srp).change();
                    $('[name="lebar"]:eq('+i+')').val(lebar).change();
                    $('[name="panjang"]:eq('+i+')').val(panjang).change();
                    $('[name="hasil"]:eq('+i+')').val(hasil).change();
                    $('[name="reject"]:eq('+i+')').val(reject).change();
                    $('[name="sisa"]:eq('+i+')').val(sisa).change();
                }
            }
        });
        $('html, body').animate({scrollTop: $(".content-wrapper:eq(0)").offset().top}, 1000);
    }

// Notifikasi Hapus Data
    function hapus(btn) {
        var id_hapus = btn.name;

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url()."index.php/produksi/sticker/hapus" ?>',
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

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url()."index.php/produksi/sticker/cetak" ?>',
            data: {data: id_cetak},
            success: function(data) {
                data = JSON.parse(data);

                tgl = format_date(data[0].TGL);
                bln = get_romawi(tgl);
                $('#printable table:eq(0) tr:eq(0) td:eq(2)').html(data[0].SHIFT);
                $('#printable table:eq(0) tr:eq(1) td:eq(2)').html(data[0].PP);
                $('#printable table:eq(0) tr:eq(0) td:eq(5)').html(data[0].NMR + '/PNP-HLG/STIKER/' + bln + '/' + data[0].DESAIN);
                $('#printable table:eq(0) tr:eq(1) td:eq(5)').html(tgl);

                t_panjang = 0;
                $('#pr_body tbody tr').remove();
                for (var i=0; i<data.length; i++) {
                    srp = data[i].SRP.substring(0, data[i].SRP.length - 1).split('@@@');
                    kode_srp = srp[0].replaceAll('@', '<br>');
                    lebar = srp[1].replaceAll('@', '<br>');
                    panjang = srp[2].replaceAll('@', '<br>');
                    sisa = srp[3].replaceAll('@', '<br>');
                    hasil = srp[4].replaceAll('@', '<br>');
                    reject = srp[5].replaceAll('@', '<br>');
                    keterangan = data[i].KETERANGAN == null ? '' : data[i].KETERANGAN;

                    $('#pr_body tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].KODE_KERTAS+'</td><td align="center">'+data[i].LEBAR+'</td><td align="center">'+format_number(data[i].PANJANG)+'</td><td align="center">'+kode_srp+'</td><td align="center">'+lebar+'</td><td align="center">'+format_number(panjang)+'</td><td align="center">'+format_number(sisa)+'</td><td align="center">'+format_number(hasil)+'</td><td align="center">'+format_number(reject)+'</td><td align="center">'+format_number(data[i].PANJANG)+'</td><td align="center">'+data[i].MULAI + ' - ' + data[i].SELESAI +'</td></tr>');
                    t_panjang = t_panjang + Number(data[i].PANJANG);
                }
                $('#pr_body tfoot td:eq(1)').html(format_number(t_panjang));

                // Isi Data Downtime
                var downtime = data[0].DOWNTIME.replaceAll('@', '<br>');
                $('#pr_body tbody tr:eq(0)').append('<td rowspan="'+data.length+'"></td>');
                $('#pr_body tbody tr:eq(0) td:eq(12)').html(downtime);

                // Isi Nama Operator
                var dt_operator = data[0].OPERATOR.substring(0, data[0].OPERATOR.length - 1).split(','), sh = '';
                for (var i=0; i<dt_operator.length; i++) {
                    sh = sh + (i+1) + '. ' + dt_operator[i] + '<br><br>';
                }
                $('.opr:eq(0)').html(sh);
                $('.pgws:eq(0)').html('( ... ' + proper(data[0].PENGAWAS) + ' ... )');

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
    }

</script>