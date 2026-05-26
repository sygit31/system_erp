<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url().'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<style>.select2-container--open {z-index: 9999999;}</style>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Data Karyawan Holografi</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/HRD - Manual Book Input Data Karyawan.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body card ml-4 mr-4 mt-4">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">NIK</th>
                                <td width="60%">
                                    <input type="text" class="form-control" id="nik" name="" style="width: 100%; text-transform: uppercase;" autocomplete="off" maxlength="9">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nama</th>
                                <td>
                                    <input type="text" class="form-control" id="nama" autocomplete="off" style="width: 100%; text-transform: uppercase;" maxlength="50">
                                </td> 
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>                          
                                <th>Jenis Kelamin</th>
                                <td>
                                    <select class="select" id="jkel" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                        <option value="P">PRIA</option>
                                        <option value="W">WANITA</option>
                                    </select>
                                </td>  
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>             
                                <th>Status</th>
                                <td>
                                    <select class="select" id="status" name="" style="width: 100%;">
                                        <option value="">Pilih..</option>
                                        <option value="BL">BULANAN</option>
                                        <option value="KT">KONTRAK</option>
                                        <option value="OS">OS</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>                     
                                <th>Tanggal Masuk</th>
                                <td><input type="text" id="tgl_masuk" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="width: 100%; cursor: pointer; background-color: #FFFFFF;" readonly></td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="100%">
                            <tr>                
                                <th width="40%">Bagian</th>
                                <td width="60%">
                                    <select class="select" id="bagian" style="width: 100%;">
                                        <option value="">Pilih Bagian..</option>
                                        <?php foreach ($bagian->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID'] . '@@' . $dt['NAMA']; ?>" name="<?php echo $dt['NAMA']; ?>"><?php echo $dt['NAMA']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>                    
                                <th>Jabatan</th>
                                <td>
                                    <select class="select" id="jabatan" style="width: 100%;">
                                        <option value="">Pilih Jabatan..</option>
                                        <?php foreach ($jabatan->result_array() as $dt) { ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo strtoupper($dt['NAMA']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>               
                                <th>Unit</th>
                                <td>
                                    <select class="select" id="unit" style="width: 100%;">
                                        <?php foreach ($unit->result_array() as $dt) { ?>
                                            <option <?php if ($dt['KD_UNIT'] == $kd_unit) {echo 'selected';} ?> value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>                        
                                <th>Status Premi</th>
                                <td>
                                    <select class="select" id="status_premi" style="width: 100%;">
                                        <option value="1">YA</option>
                                        <option value="0">TIDAK</option>
                                    </select>
                                </td>    
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>                     
                                <th>Nick Name</th>
                                <td><input type="text" class="form-control" id="nick_name" autocomplete="off" style="width: 100%; text-transform: uppercase;" maxlength="12"></td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Data Karyawan</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table style="width: 1100px; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="25%" class="filter">Cari Nama</td>
                                        <td></td>
                                        <td width="20%" class="filter">Bagian</td>
                                        <td></td>
                                        <td width="20%" class="filter">Jabatan</td>
                                        <td></td>
                                        <td width="10%" class="filter">Status</td>
                                        <td></td>
                                        <td width="15%" class="filter">Unit</td>
                                        <td></td>
                                        <td width="10%" class="filter">Jenis Kelamin</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" id="cari" onchange="filter()" placeholder="Cari nama Karyawan.." style="width: 100%;" autocomplete="off">
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fBagian" style="width: 100%;" onchange="filter()">
                                                <option value="All">All..</option>
                                                <?php foreach ($bagian->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>                                            
                                            <select class="select" id="fJabatan" style="width: 100%;" onchange="filter()">
                                                <option value="All">All..</option>
                                                <?php foreach ($jabatan->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo strtoupper($dt['NAMA']); ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fStatus" style="width: 100%;" onchange="filter()">
                                                <option value="All">All..</option>
                                                <option value="BL">BULANAN</option>
                                                <option value="KT">KONTRAK</option>
                                                <option value="OS">OS</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fUnit" style="width: 100%;" onchange="filter()">
                                                <?php foreach ($unit->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($dt['KD_UNIT'] == $kd_unit) {echo 'selected';} ?> value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="fJkel" style="width: 100%;" onchange="filter()">
                                                <option value="All">All..</option>
                                                <option>PRIA</option>
                                                <option>WANITA</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table"></div>
                    </div>

                    <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success m-3" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                </div>
            </div>
        </div>

        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
    </section>
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

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="salah_isian" class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <div id="keterangan_isian" class="modal-body" style="font-size: 20px; color: #0c1ac5; font-weight: bold;"></div>
            <div class="modal-footer">
                <button onclick="$('#keterangan_isian').html('');" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus Rangkap Jabatan -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button id="ya_hapus" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="no_hapus" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Karyawan Keluar -->
<div class="modal fade" id="modal_keluar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <b><font color="White"><div id="headerinput">Karyawan Keluar</div></font></b>
                    </h3>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td width="50%" style="font-weight: bold;">Tanggal Keluar</td>
                            <td width="50%"><input type="text" id="tgl_keluar" class="form-control datepicker" value="<?php echo date('d-M-Y'); ?>" style="width: 100%; background-color: #FFFFFF; cursor: pointer;" readonly></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <button id="simpan_keluar" style="width: 98%;" class="btn btn-info" name="" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            </td>
                            <td align="center" data-dismiss="modal">
                                <button id="tutup" style="width: 98%;" class="btn btn-danger"><i class="fa fa-ban m-2" data-dismiss="modal"></i><b>Tutup</b></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Karyawan Bulanan -->
<div class="modal fade" id="e_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <b><font color="White"><div id="headerinput">Karyawan Bulanan</div></font></b>
                    </h3>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td width="50%" style="font-weight: bold;">Nama Karyawan</td>
                            <td width="50%"><input type="text" id="e_nama" class="form-control" style="width: 100%;" readonly></td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <td style="font-weight: bold;">Bagian</td>
                            <td><input type="text" id="e_bagian" class="form-control" style="width: 100%;" readonly></td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <td style="font-weight: bold;">Tanggal Penetapan</td>
                            <td><input type="text" id="e_tgl" class="form-control datepicker" value="" style="width: 100%; background-color: #FFFFFF; cursor: pointer;" readonly></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <button id="e_simpan" style="width: 98%;" class="btn btn-info" data-dismiss="modal"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            </td>
                            <td align="center" data-dismiss="modal">
                                <button id="e_tutup" style="width: 98%;" class="btn btn-danger"><i class="fa fa-power-off m-2" data-dismiss="modal"></i><b>Tutup</b></button>
                                <button id="e_" type="button" data-toggle="modal" data-target="#e_modal" hidden></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Rangkap Jabatan -->
<div class="modal fade" id="mdl_jabatan" style="z-index: 9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info p-2">
                <div class="card-header rounded" style="cursor: all-scroll;">
                    <h3 class="card-title"><b><font color="White">
                        <div id="headerinput">
                            <h3>Data Rangkap Jabatan</h3>
                        </div>
                    </font></b></h3>
                </div>
                <div class="card-body card">
                    <table width="100%" style="font-size: 14px;">
                        <tr>
                            <th width="40%">Jabatan Baru</th>
                            <td width="60%">
                                <select class="select" id="r_jabatan" style="width: 100%;">
                                    <option value="">Pilih..</option>
                                    <?php foreach ($jabatan->result_array() as $dt) { ?>
                                        <option value="<?php echo $dt['ID']; ?>"><?php echo strtoupper($dt['NAMA']); ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Bagian Baru</th>
                            <td>
                                <select class="select" id="r_bagian" style="width: 100%;">
                                    <option value="">Pilih..</option>
                                    <?php foreach ($bagian->result_array() as $dt) { ?>
                                        <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Unit Baru</th>
                            <td>
                                <select class="select" id="r_unit" style="width: 100%;">
                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                        <option value="<?php echo $dt['KD_UNIT']; ?>"><?php echo $dt['UNIT']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body card">
                    <table id="table_jabatan" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
                        <thead>
                            <tr align="center">
                                <th hidden>Id</th>
                                <th>No.</th>
                                <th>Unit</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Bagian</th>
                                <th>Jabatan</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>                    
                </div>
                <div class="card-footer">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <button id="r_simpan" style="width: 98%;" class="btn btn-info" name=""><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            </td>
                            <td align="center" data-dismiss="modal">
                                <button id="r_tutup" style="width: 98%;" class="btn btn-danger"><i class="fa fa-power-off m-2" data-dismiss="modal"></i><b>Tutup</b></button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/js/script.js"></script>

<script>

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $( ".datepicker" ).datepicker({dateFormat: 'dd-M-yy', yearRange: '1965:2030', changeMonth: true, changeYear: true});

        filter();
    });

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var tabel = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'excel invisible',
                title: 'Data Karyawan'
            }],
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": []
        });

        setTimeout(function() {tabel.columns.adjust().draw();}, 500);
    }

// Kosong Isian
    function kosong() {
        $('#status').attr('name', '');
        $('#nik').attr('name', '');

        $('#r_bagian').val('').change();
        $('#r_jabatan').val('').change();

        $('#nik').val('');
        $('#nama').val('');
        $('#bagian').val('').change();
        $('#jabatan').val('').change();
        $('#status').val('').change();
        $('#nick_name').val('').change();
        $('#status_premi').val('1').change();
        $('#tgl_masuk').val(<?php echo json_encode(date('d-M-Y')); ?>).change();
        $('#tgl_keluar').val(<?php echo json_encode(date('d-M-Y')); ?>).change();

        $('#e_nama').val('').change();
        $('#e_bagian').val('').change();
        $('#e_tgl').val('').change();
    }

// Filter Data Table
    function filter() {
        var cari = $('#cari').val();
        var jkel = $('#fJkel').val();
        var status = $('#fStatus').val();
        var id_bagian = $('#fBagian').val();
        var id_jabatan = $('#fJabatan').val();
        var kd_unit = $('#fUnit').val();
        var data = [cari, id_bagian, id_jabatan, status, kd_unit, jkel];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/filter',
            data: {data: data},
            success: function(data) {
                $('.data-table').html(data);
                setTimeout(function() { $('#btnOk').click(); pagination();}, 700);
            }
        });
    }

// Collect Data
    function simpan() {
        var status = $('#status').val();
        var status_edit = $('#status').attr('name');
        var bagian = $('#bagian').val().split('@@')[1];

        if (status_edit != status && status == 'BL') {
            $('#e_nama').val($('#nama').val().toUpperCase());
            $('#e_bagian').val(bagian);
            $('#e_tgl').val(<?php echo json_encode(date('d-M-Y')); ?>);

            $('#e_').click();
        }else{
            $('#e_tgl').val('');
            $('#e_simpan').click();
        }
    }

// Tampilkan error isian
    function error_isian(str) {
        $('#keterangan_isian').html(str);
        $('#btnIsian').click();
    }

// Simpan Data
    $('#e_simpan').click(function() {
        var id_edit = $('#nik').attr('name');
        var id_bagian = $('#bagian').val().split('@@')[0];
        var id_jabatan = $('#jabatan').val();
        var kd_unit = $('#unit').val();
        var nik = $('#nik').val().toUpperCase();
        var nama = $('#nama').val().toUpperCase();
        var jkel = $('#jkel').val();
        var s_premi = $('#status_premi').val();
        var tgl_masuk = $('#tgl_masuk').val();
        var e_tgl = $('#e_tgl').val();
        var status = $('#status').val();
        var nick_name = $('#nick_name').val().toUpperCase();
        var data = [id_edit, nik, nama, id_bagian, id_jabatan, status, kd_unit, jkel, s_premi, tgl_masuk, e_tgl, nick_name];

        if (nik == '') {error_isian('NIK belum diisi..');return;}
        if (nama == '') {error_isian('Nama belum diisi..');return;}
        if (jkel == '') {error_isian('Jenis Kelamin belum diisi..');return;}
        if (status == '') {error_isian('Status belum diisi..');return;}
        if (id_bagian == '') {error_isian('Bagian belum diisi..');return;}
        if (id_jabatan == '') {error_isian('Jabatan belum diisi..');return;}

        $('#e_tutup').click();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/hrd/karyawan/simpan',
                data: {data: data},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        filter();
                        kosong();
                    }, 500);
                }
            });
        }, 500);

    });

// Edit Data
    function edit(btn) {
        var id_kary = $(btn).attr('name');

        $('#nik').attr('name', id_kary);
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/edit',
            data: {data: id_kary},
            success: function(data) {
                data = JSON.parse(data);

                $('#nik').val(data.NIK);
                $('#nama').val(data.NAMA);
                $("#bagian").val(data.ID_BAGIAN + '@@' + data.BAGIAN).change();
                $("#jabatan").val(data.ID_JABATAN.toUpperCase()).change();
                $("#status").val(data.KD_STATUS).change();
                $("#status").attr('name', data.KD_STATUS).change();
                $("#unit").val(data.KD_UNIT).change();
                $("#jkel").val(data.JKEL).change();
                $("#status_premi").val(data.STATUS_PREMI).change();
                $("#nick_name").val(data.NICK_NAME).change();
                $("#tgl_masuk").val(format_date(data.TGL_MASUK)).change();

                $('html, body').animate({scrollTop: $(".sidebar-mini").offset().top}, 500);
            }
        });
    }

// Ambil Id Karyawan Saat Proses Keluar
    function keluar(btn) {
        var id_edit = $(btn).attr('name');

        $('#simpan_keluar').attr('name', id_edit);
    }

// Simpan Keluar
    $('#simpan_keluar').click(function() {
        var id_edit = $('#simpan_keluar').attr('name');
        var tgl_keluar = $('#tgl_keluar').val();
        var data = [id_edit, tgl_keluar];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/keluar',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    filter();
                }, 500);
            }
        });
    });

// Rangkap Jabatan
    function rangkap_jabatan(btn) {
        var id_edit = $(btn).attr('name').split('@@')[0];
        var kd_unit = $(btn).attr('name').split('@@')[1];

        $('#r_unit').val(kd_unit).change();
        $('#r_simpan').attr('name', id_edit);
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/r_jabatan',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);
                isi_r_jabatan(data);
                pagination_r();
            }
        });
    }

// Isi Data Rangkap Jabatan
    function isi_r_jabatan(data) {    
        $('#table_jabatan').DataTable().destroy();
        $("#table_jabatan tbody tr").remove();

        for (var i=0; i<data.length; i++) {
            urut = i+1;
            id = data[i].ID;
            unit = data[i].UNIT;
            nik = data[i].NIK;
            nama = data[i].NAMA;
            bagian = data[i].BAGIAN;
            jabatan = data[i].JABATAN;

            $('#table_jabatan tbody').append('<tr><td hidden>'+id+'</td><td align="center">'+urut+'</td><td>'+unit+'</td><td>'+nik+'</td><td>'+nama+'</td><td>'+bagian+'</td><td>'+jabatan+'</td><td align="center"><button type="button" style="width: 50px;" class="btn btn-danger btn-sm" onclick="hapus_r_jabatan(this)"><i class="fa fa-trash"></i></button></td></tr>');
        }
    }

// Pagination Rangkap Jabatan
    function pagination_r() {
        $('#table_jabatan').DataTable().destroy();
        var tabel = $('#table_jabatan').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "250px"
        });

        setTimeout(function() {tabel.columns.adjust().draw();}, 500);
    }

// Simpan Rangkap Jabatan
    $('#r_simpan').click(function() {
        var id_karyawan = $('#r_simpan').attr('name');
        var id_bagian = $('#r_bagian').val();
        var id_jabatan = $('#r_jabatan').val();
        var kd_unit = $('#r_unit').val();
        var data = [id_karyawan, id_bagian, id_jabatan, kd_unit];

        $('#r_tutup').click();
        if (id_jabatan == '') {error_isian('Jabatan belum diisi..');return;}
        if (id_bagian == '') {error_isian('Bagian belum diisi..');return;}

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/r_simpan',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 1000);

                $('#r_bagian').val('').change();
                $('#r_jabatan').val('').change();
            }
        });
    });

// Notifikasi Hapus Rangkap Jabatan
    function hapus_r_jabatan(btn) {
        $('#r_tutup').click();

        var table_jabatan = document.getElementById('table_jabatan');
        var row = $(btn).closest("tr").index() + 1;
        id_edit = table_jabatan.rows[row].cells[0].innerHTML;

        $('#btnHapus').click();
    }

// Hapus Rangkap Jabatan
    $('#ya_hapus').on('click', function() {
        $('#btnProgress').click();
        $.ajax({
            data: {data: id_edit},
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/hrd/karyawan/r_hapus',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 500);
                id_edit = '';
            }
        });
    });

// Batal Hapus Rangkap Jabatan
    $('#no_hapus').on('click', function() {
        id_edit = '';
    });

// Drag Div Document
    $("#r_jabatan").draggable({handle: ".card-header"});
    $("#mdl_jabatan").draggable({handle: ".card-header"});

// Expands & Collapse Card Info
    var info_1 = 0
    $('.info_1:eq(0)').on('click', function() {
        if (info_1 == 0) {
            $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
            info_1 = 1;
        } else {
            $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
            info_1 = 0;
        }
    });
    var info_2 = 0;
    $('.info_2:eq(0)').on('click', function() {
        if (info_2 == 0) {
            $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
            info_2 = 1;
        } else {
            $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
            info_2 = 0;
        }
    });

</script>