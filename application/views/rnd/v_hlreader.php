
<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Data Holo Reader</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">Tahun</th>
                        <td width="30%">
                            <select class="select" id="tahun" style="width: 40%; cursor: pointer;">
                                <?php $years = range(date('Y')+1, date('Y')-5); ?>
                                <?php foreach($years as $dt) { ?>
                                    <option><?php echo $dt; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                        <th>Kondisi</th>
                        <td>
                            <select class="select" id="kondisi" style="width: 40%; cursor: pointer;">
                                <option>Baik</option>
                                <option>Rusak</option>
                            </select>
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <th>No. Register</th>
                        <td>
                            <input class="form-control" type="text" id="no_register" style="width: 70%;" tabindex="1" autocomplete="off" maxlength="20">
                        </td>
                        <th>Keterangan</th>
                        <td>
                            <input class="form-control" type="text" id="keterangan" style="width: 70%;" tabindex="3" autocomplete="off" maxlength="50">
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
                                <table class="ml-2" style="width: 800px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="15%" class="filter">Tahun</td>
                                            <td></td>
                                            <td width="25%" class="filter">Holo Reader</td>
                                            <td></td>
                                            <td width="30%" class="filter">Lokasi</td>
                                            <td></td>
                                            <td width="15%" class="filter">Upgrade</td>
                                            <td></td>
                                            <td width="15%" class="filter">Kondisi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="fTahun" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($tahun->result_array() as $dt): ?>
                                                        <option <?php if (date('Y') == $dt['TAHUN']) {echo 'selected';} ?>><?php echo $dt['TAHUN']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>                            
                                                <select class="select" id="fHlreader" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">Pilih Holo Reader..</option>
                                                    <?php foreach ($hlreader->result_array() as $dt): ?>
                                                        <option><?php echo $dt['NO_REGISTER']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>                            
                                                <select class="select" id="fCari" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">Pilih Lokasi..</option>
                                                    <option value="">PNP Holografi Kudus</option>
                                                    <?php foreach ($location->result_array() as $dt): ?>
                                                        <option><?php echo $dt['LOCATION']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>                            
                                                <select class="select" id="fUpgrade" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">Pilih Tahun..</option>
                                                    <?php foreach ($tahun->result_array() as $dt): ?>
                                                        <option><?php echo $dt['TAHUN']; ?></option>
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
                <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" onclick="filter()" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
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
    var id_edit = '', info_1 = 0, info_2 = 0;

// Document load
    $(document).ready(function() {
        $(".select").select2();
        $('#no_register').focus();
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
        }else{
            $('.data-table,.table-responsive').removeClass('mt-3');
        }
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
                title: 'Laporan Data Holo Reader'
            }],
            "colReorder": true
        });

        setTimeout(function() {
            data_table.columns.adjust().draw();
        }, 1000);
    }

// Kosong Isian
    function kosong() {
        $('#no_register').val('');
        $('#kondisi').val('Baik').change();
        $('#keterangan').val('');

        $('#no_register').focus();
        id_edit = '';
    }

// Tampilkan error isian
    function error_isian(str) {
        $('#keterangan_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Simpan Data
    function simpan() {
        var tahun = $('#tahun').val();
        var no_register = $('#no_register').val();
        var kondisi = $('#kondisi').val();
        var keterangan = $('#keterangan').val();
        var data = [id_edit, tahun, no_register, kondisi, keterangan];

        if (no_register == '') {error_isian('Nomor Register belum diisi..');}

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader/simpan',
            data: {data: data},
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    kosong();
                }, 500);
            }
        });
    }

// Filter Data
    function filter() {
        var tahun = document.getElementById("fTahun").value;
        var hlreader = document.getElementById("fHlreader").value;
        var cari = document.getElementById("fCari").value;
        var kondisi = document.getElementById("fKondisi").value;
        var upgrade = document.getElementById("fUpgrade").value;
        var data = [tahun,cari,kondisi,upgrade,hlreader];

        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/rnd/hlreader/filter',
                data: {data: data},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('.data-table').html(data);
                        pagination();
                    }, 500);
                }
            });
        }, 300);
    }

// Edit Data
    function edit(btn) { 
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;

        id_edit = table.rows[row].cells[0].innerHTML;
        $('#tahun').val(table.rows[row].cells[3].innerHTML).change();
        $('#no_register').val(table.rows[row].cells[4].innerHTML);
        $('#kondisi').val(table.rows[row].cells[7].innerHTML).change();
        $('#keterangan').val(table.rows[row].cells[8].innerHTML);

        $('html, body').animate({scrollTop: $(".sidebar-mini").offset().top}, 1000);
        $('#no_register').focus();
    }

// Notifikasi Hapus
    function hapus(btn) {
        var table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;

        id_edit = table.rows[row].cells[0].innerHTML;
        $('#btnHapus').click();
    }

// Hapus Data
    $('#ya_hapus').on('click', function() {
        $.ajax({
            type: 'POST',
            url:'<?php echo base_url(); ?>index.php/rnd/hlreader/hapus',
            data: {data: id_edit},
            success: function(data) {
                setTimeout(function() {
                    id_edit = '';
                }, 500);
                filter();
            }
        });
    });

// Batal Hapus Data
    $('#no_hapus').on('click', function() {
        id_edit = '';
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