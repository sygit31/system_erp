

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
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Input Data Holo Reader</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">Tanggal</th>
                        <td width="40%">
                            <input type="text" id="tanggal" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" autocomplete="off" style="width: 40%; background-color: white; cursor: pointer;" tabindex="1" readonly>
                        </td>
                        <th width="15%">Kondisi</th>
                        <td width="30%">
                            <select class="select" id="kondisi" style="width: 40%; cursor: pointer;">
                                <option>Baik</option>
                                <option>Rusak</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <th>No. Surat</th>
                        <td>
                            <input class="form-control" type="text" id="no_surat" style="width: 70%; text-transform: uppercase;" tabindex="2" autocomplete="off" maxlength="30">
                        </td>
                        <th>Keterangan</th>
                        <td>
                            <input class="form-control" type="text" id="keterangan" style="width: 70%;" tabindex="3" autocomplete="off" maxlength="50">
                        </td>   
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <th>Jenis</th>
                        <td>
                            <select class="select" id="jenis" style="width: 40%; cursor: pointer;">
                                <option>Distribusi</option>
                                <option>Upgrade</option>
                                <option>Tukar</option>
                                <option>Kembali</option>
                                <option>Pinjam</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="distribusi">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Holo Reader</th>                        
                        <td width="50%">
                            <select class="select" id="hlreader_distribusi" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_distribusi = array(); ?>
                                <?php foreach ($hlreader_distribusi->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_distribusi, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Area</th>
                        <td>
                            <?php $id_location_distribusi = array(); ?>
                            <select class="select" id="location" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Lokasi..</option>
                                <?php foreach ($location_distribusi->result_array() as $dt): ?>
                                    <option><?php echo $dt['LOCATION']; ?></option>
                                    <?php array_push($id_location_distribusi, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="upgrade" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Holo Reader</th>                        
                        <td width="50%">
                            <select class="select" id="hlreader_upgrade" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_upgrade = array(); ?>
                                <?php $id_location_upgrade = array(); ?>
                                <?php foreach ($hlreader_upgrade->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_upgrade, $dt['ID']); ?>
                                    <?php array_push($id_location_upgrade, $dt['ID_LOCATION']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Tahun</th>
                        <td>           
                            <select class="select" id="tahun" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Tahun..</option>
                                <?php $years = range(date('Y')+1, date('Y')-5); ?>
                                <?php foreach($years as $dt) { ?>
                                    <option selected><?php echo $dt; ?></option>
                                <?php } ?>
                            </select>
                        </td>  
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="tukar" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Holo Reader Lama</th>                        
                        <td width="50%">
                            <select class="select" id="hlreader_tukar" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_tukar = array(); ?>
                                <?php $id_location_tukar = array(); ?>
                                <?php foreach ($hlreader_tukar->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_tukar, $dt['ID']); ?>
                                    <?php array_push($id_location_tukar, $dt['ID_LOCATION']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Area</th>                        
                        <td>
                            <input class="form-control" type="text" id="area_tukar" style="width: 50%;" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th>Holo Reader Baru</th>                        
                        <td>
                            <select class="select" id="hlreader_new" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_new = array(); ?>
                                <?php foreach ($hlreader_distribusi->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_new, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="kembali" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Holo Reader</th>                        
                        <td width="50%">
                            <select class="select" id="hlreader_kembali" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_kembali = array(); ?>
                                <?php $id_location_kembali = array(); ?>
                                <?php foreach ($hlreader_tukar->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_kembali, $dt['ID']); ?>
                                    <?php array_push($id_location_kembali, $dt['ID_LOCATION']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="20%">Area</th>                        
                        <td width="50%">
                            <input class="form-control" type="text" id="area_kembali" style="width: 50%;" readonly>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="pinjam" style="display: none;">
                <table class="table table-bordered">
                    <tr>
                        <th width="20%">Holo Reader</th>                        
                        <td width="50%">
                            <select class="select" id="hlreader_pinjam" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nomor Holo Reader..</option>
                                <?php $id_hlreader_pinjam = array(); ?>
                                <?php foreach ($hlreader_distribusi->result_array() as $dt): ?>
                                    <option><?php echo $dt['NO_REGISTER']; ?></option>
                                    <?php array_push($id_hlreader_pinjam, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>Nama Karyawan</th>                        
                        <td>
                            <select class="select" id="karyawan_pinjam" style="width: 50%; cursor: pointer;">
                                <option value="">Pilih Nama Karyawan..</option>
                                <?php $id_karyawan_pinjam = array(); ?>
                                <?php foreach ($karyawan->result_array() as $dt): ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                    <?php array_push($id_karyawan_pinjam, $dt['ID']); ?>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" tabindex="4"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" tabindex="5"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Data Holo Reader</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="table-responsive">
                                <table id="tbl_filter" style="width: 100%; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="10%" class="filter">Tahun</td>
                                            <td></td>
                                            <td width="10%" class="filter">Jenis</td>
                                            <td></td>
                                            <td width="15%" class="filter">Holo Reader</td>
                                            <td></td>
                                            <td width="15%" class="filter">Lokasi</td>
                                            <td></td>
                                            <td width="10%" class="filter">Kondisi</td>
                                            <td></td>
                                            <td width="40%"></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="fTahun" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($tahun->result_array() as $dt): ?>
                                                        <option><?php echo $dt['TAHUN']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="fJenis" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option>All</option>
                                                    <option>Distribusi</option>
                                                    <option>Upgrade</option>
                                                    <option>Tukar</option>
                                                    <option>Kembali</option>
                                                    <option>Pinjam</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="fHlreader" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">Pilih Nomor Holo Reader..</option>
                                                    <?php foreach ($hlreader->result_array() as $dt): ?>
                                                        <option><?php echo $dt['NO_REGISTER']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="fLocation" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">Cari lokasi..</option>
                                                    <?php foreach ($location->result_array() as $dt): ?>
                                                        <option><?php echo $dt['LOCATION']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="fKondisi" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option>All</option>
                                                    <option>Baik</option>
                                                    <option>Rusak</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td style="text-align: right;">
                                                <input type="checkbox" class="akses" id="recycled" onchange="filter()" style="cursor: pointer;"> <p><b>Recycled</b></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="data-table table-responsive"></div>

                            <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success ml-2" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                        </font>
                    </div>
                </div>
            </div>
            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
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
                <button id="btnOkSimpan" style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
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

<!-- Modal Hapus -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus Holo Reader? </div>
            <div class="modal-footer">
                <button id="ya_hapus" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="no_hapus" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
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

<script>

// Define Variable
    var row = '', info_1 = 0, info_2 = 0;

// Document load
    $(document).ready(function() {
        $(".select").select2();
        $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy', changeYear: true, changeMonth: true });
        $('#no_surat').focus();

        filter();
        resize();
    });

// Resize Dokumen
    $(window).on('resize', function() {
        resize();
        pagination();
    });

// Resize
    function resize() {
        if ($(this).width() < 700) {
            $('.data-table,.table-responsive').addClass('mt-3');
            $('#tbl_print').css('width','800px');
        }else{
            $('.data-table,.table-responsive').removeClass('mt-3');
            $('#tbl_print').css('width','100%');
        }
    }

// Filter Data
    function filter() {
        var jenis = document.getElementById("fJenis").value;
        var hlreader = document.getElementById("fHlreader").value;
        var location = document.getElementById("fLocation").value;
        var kondisi = document.getElementById("fKondisi").value;
        var recycled = document.getElementById("recycled").checked;
        var tahun = document.getElementById("fTahun").value;
        if (recycled == true) {recycled = '0';}else{recycled = '1';}
        var data = [jenis,hlreader,location,kondisi,recycled,tahun];

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader_mut/filter_mutasi',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    pagination();
                }, 500);
                $('.data-table').html(data);
            }
        });
    }

// Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var data_table = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "order": [1, "asc"],
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
                className: 'invisible excel',
                title: 'Laporan Mutasi Holo Reader'
            }],
            "colReorder": true
        });

        setTimeout(function() {
            data_table.columns.adjust().draw();
        }, 1000);
    }

// Pilih transaksi
    $('#jenis').on('change',function() {
        var jenis = $('#jenis').val();

        $('#distribusi').hide();
        $('#upgrade').hide();
        $('#tukar').hide();
        $('#kembali').hide();
        $('#pinjam').hide();
        hapus_combo();

        switch(jenis) {
        case "Distribusi":
            $('#distribusi').show();
            break;

        case "Upgrade":
            $('#upgrade').show();
            break;

        case "Tukar":
            $('#tukar').show();
            break;

        case "Kembali":
            $('#kembali').show();
            break;

        case "Pinjam":
            $('#pinjam').show();
            break;        
        }
    })

// Kosong Isian
    function kosong() {
        $('#no_surat').val('').change();
        $('#kondisi').val('Baik').change();
        $('#jenis').val('Distribusi').change();
        $('#keterangan').val('').change();

        hapus_combo();
        row = '';
        $('#no_surat').focus();

    }

// Hapus isi pilihan combo box
    function hapus_combo() {
        $('#hlreader_distribusi').val('').change();
        $('#location').val('').change();

        $('#hlreader_upgrade').val('').change();
        $('#tahun').val('').change();

        $('#hlreader_tukar').val('').change();
        $('#hlreader_new').val('').change();

        $('#hlreader_kembali').val('').change();
        $('#area_kembali').val('').change();

        $('#hlreader_pinjam').val('').change();
        $('#karyawan_pinjam').val('').change();
    }

// Isi Area Saat Pengembalian Holo Reader
    $('#hlreader_kembali').on('change', function() {
        var hlreader_kembali = $('#hlreader_kembali').val();

        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader_mut/area_kembali',
            data: {data: hlreader_kembali},
            success: function(data) {
                $('#area_kembali').val(data);
            }
        });
    });

// Isi Area Saat Tukar Holo Reader
    $('#hlreader_tukar').on('change', function() {
        var hlreader_tukar = $('#hlreader_tukar').val();

        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader_mut/area_tukar',
            data: {data: hlreader_tukar},
            success: function(data) {
                $('#area_tukar').val(data);
            }
        });
    });

// Tampilkan error isian
    function error_isian(str) {
        $('#keterangan_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        <?php $kary = explode('|',$_SESSION['logERP']); ?>
        var id_karyawan = <?php echo json_encode($kary[0]); ?>;
        var tanggal = $('#tanggal').val();
        var no_surat = $('#no_surat').val().toUpperCase();
        var jenis = $('#jenis').val();
        var kondisi = $('#kondisi').val();
        var keterangan = $('#keterangan').val();
        var id_hlreader = '', id_hlreader_new = '', id_location = '', id_karyawan_pinjam = '';

    // Distribusi
        var id_hlreader_distribusi = <?php echo json_encode($id_hlreader_distribusi); ?>;
        var indeks = document.getElementById('hlreader_distribusi').selectedIndex-1;
        id_hlreader_distribusi = indeks == -1 ? '' : id_hlreader_distribusi[indeks];
        var id_location_distribusi = <?php echo json_encode($id_location_distribusi); ?>;
        var indeks = document.getElementById('location').selectedIndex-1;
        id_location_distribusi = indeks == -1 ? '' : id_location_distribusi[indeks];

    // Upgrade
        var id_hlreader_upgrade = <?php echo json_encode($id_hlreader_upgrade); ?>;
        var indeks = document.getElementById('hlreader_upgrade').selectedIndex-1;
        id_hlreader_upgrade = indeks == -1 ? '' : id_hlreader_upgrade[indeks];
        var id_location_upgrade = <?php echo json_encode($id_location_upgrade); ?>;
        id_location_upgrade = indeks == -1 ? '' : id_location_upgrade[indeks];
        var tahun = $('#tahun').val();

    // Tukar
        var id_hlreader_tukar = <?php echo json_encode($id_hlreader_tukar); ?>;
        var indeks = document.getElementById('hlreader_tukar').selectedIndex-1;
        id_hlreader_tukar = indeks == -1 ? '' : id_hlreader_tukar[indeks];
        var id_location_tukar = <?php echo json_encode($id_location_tukar); ?>;
        id_location_tukar = indeks == -1 ? '' : id_location_tukar[indeks];
        var id_hlreader_new = <?php echo json_encode($id_hlreader_new); ?>;
        var indeks = document.getElementById('hlreader_new').selectedIndex-1;
        id_hlreader_new = indeks == -1 ? '' : id_hlreader_new[indeks];

    // Kembali
        var id_hlreader_kembali = <?php echo json_encode($id_hlreader_kembali); ?>;
        var indeks = document.getElementById('hlreader_kembali').selectedIndex-1;
        id_hlreader_kembali = indeks == -1 ? '' : id_hlreader_kembali[indeks];
        var id_location_kembali = <?php echo json_encode($id_location_kembali); ?>;
        id_location_kembali = indeks == -1 ? '' : id_location_kembali[indeks];

    // Pinjam
        var id_hlreader_pinjam = <?php echo json_encode($id_hlreader_pinjam); ?>;
        var indeks = document.getElementById('hlreader_pinjam').selectedIndex-1;
        id_hlreader_pinjam = indeks == -1 ? '' : id_hlreader_pinjam[indeks];
        var id_karyawan_pinjam = <?php echo json_encode($id_karyawan_pinjam); ?>;
        var indeks = document.getElementById('karyawan_pinjam').selectedIndex-1;
        id_karyawan_pinjam = indeks == -1 ? '' : id_karyawan_pinjam[indeks];

        if (jenis == 'Distribusi') {id_hlreader = id_hlreader_distribusi; id_location = id_location_distribusi;}
        if (jenis == 'Upgrade') {id_hlreader = id_hlreader_upgrade; id_location = id_location_upgrade;}
        if (jenis == 'Tukar') {id_hlreader = id_hlreader_tukar; id_location = id_location_tukar; id_hlreader_new = id_hlreader_new;}
        if (jenis == 'Kembali') {id_hlreader = id_hlreader_kembali; id_location = id_location_kembali;}
        if (jenis == 'Pinjam') {id_hlreader = id_hlreader_pinjam;}

        if (no_surat == '') {error_isian('Nomor Surat belum diisi..');}
        if ((jenis == 'Distribusi') && (id_hlreader_distribusi == '' || id_location_distribusi == '')) {error_isian('Holo Reader/Lokasi belum dipilih..');}
        if ((jenis == 'Upgrade') && (id_hlreader_upgrade == '' || tahun == '')) {error_isian('Holo Reader/Tahun belum dipilih..');}
        if ((jenis == 'Tukar') && (id_hlreader_tukar == '' || id_hlreader_new == '')) {error_isian('Holo Reader Lama/Baru belum dipilih..');}
        if ((jenis == 'Kembali') && (id_hlreader_kembali == '')) {error_isian('Holo Reader belum dipilih..');}
        if ((jenis == 'Pinjam') && (id_hlreader_pinjam == '' || id_karyawan_pinjam == '')) {error_isian('Holo Reader/Nama Karyawan belum dipilih..');}

        var data = [id_hlreader,id_hlreader_new,id_karyawan,jenis,no_surat,tanggal,id_location,tahun,kondisi,keterangan,id_karyawan_pinjam];

        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader_mut/simpan_mutasi',
            data: {data: data},
            success: function(data) {
                $('#btnSukses').click();
            }
        });
    }

// Sukses simpan
    $('#btnOkSimpan').on('click', function() {
        location.reload();
    });

// Hapus Data
    function hapus(btn) {
        row = $(btn).closest("tr").index() + 1;
        $('#btnHapus').click();
    }
    $('#ya_hapus').on('click', function() {
        var table = document.getElementById('data-table');
        var id_mutasi = table.rows[row].cells[0].innerHTML;
        var jenis = table.rows[row].cells[3].innerHTML;
        var id_hlreader = table.rows[row].cells[12].innerHTML;
        var kondisi = table.rows[row].cells[9].innerHTML;
        var hlreader_new = table.rows[row].cells[14].innerHTML;
        var id_location = table.rows[row].cells[13].innerHTML;
        var data = [id_mutasi,jenis,id_hlreader,kondisi,hlreader_new,id_location];

        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader_mut/hapus_mutasi',
            data: {data: data},
            success: function(data) {
                $('#btnSukses').click();
            }
        });
    });

// Batal Hapus Data
    $('#no_hapus').on('click', function() {
        row = '';
    });

// Expands & Collapse Card Info
    $('.info_1:eq(0)').on('click', function() {
        if (info_1 == 0) {
            $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
            info_1 = 1;
        } else {
            $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
            info_1 = 0;
        }

        setTimeout(function() {
            pagination();
        }, 500);
    });
    $('.info_2:eq(0)').on('click', function() {
        if (info_2 == 0) {
            $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
            info_2 = 1;
        } else {
            $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
            info_2 = 0;
        }

        setTimeout(function() {
            pagination();
        }, 500);
    });

</script>