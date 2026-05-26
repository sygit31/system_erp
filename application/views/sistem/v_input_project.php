

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

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White"><div id="headerinput">Input Data Project</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="info_1 fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table width="100%">
                    <tr>
                        <th width="15%">No. Project</th>
                        <td width="3%">:</td>                        
                        <td width="25%"><input type="text" id="no_project" class="form-control" style="width: 60%;" readonly></td>
                        <th width="15%">Nama Project</th>
                        <td width="3%">:</td>
                        <td width="39%" rowspan="2" colspan="2"><textarea id="nama_project" class="form-control" style="width: 100%;" tabindex="1"></textarea></td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Tanggal</th>
                        <td>:</td>
                        <td><input type="text" id="tgl" class="form-control" style="width: 60%;" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" autocomplete="off" readonly></td>
                        <th>Nama Karyawan</th>
                        <td>:</td>
                        <td>
                            <select id="nama_kary" class="form-control select" style="width: 90%;">
                                <option value="">Pilih Nama..</option>
                                <?php foreach ($show_pic->result_array() as $pic): ?>
                                    <option value="<?php echo $pic['ID']; ?>"><?php echo ucwords(strtolower($pic['NAMA'])); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td><button type="button" class="btn btn-block btn-warning" onclick="preview()"><i class="fa fa-clipboard m-2"></i>Load Ide</button></td>
                    </tr>
                    <tr style="height: 20px;"></tr>
                    <tr>
                        <th>Level</th>
                        <td>:</td>
                        <td>
                            <select id="level" class="form-control select" style="width: 60%;">
                                <option value="">Pilih Level..</option>
                                <option>Sangat Tinggi</option>
                                <option>Tinggi</option>
                                <option>Sedang</option>
                            </select>
                        </td>
                        <th hidden>ID Ide</th>
                        <td hidden>:</td>
                        <td hidden>
                            <input type="text" id="id_ide" class="form-control" style="width: 60%;" readonly>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <table id="tabel_pic" class="table table-bordered">
                    <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                        <tr style="text-align: center;">
                            <td width="30%">PIC</td>
                            <td width="50%">Tugas</td>
                            <td width="20%">Deadline</td>
                            <td hidden></td>
                            <td hidden>Id Karyawan</td>
                            <td hidden>Id Project</td>
                        </tr>
                    </thead>
                </table>
            </div> 

            <div class="card-footer">
                <table width="50%">
                    <tr>
                        <td width="130">
                            <button type="button" class="btn btn-block btn-success" id="btnSimpan" onclick="tambah_pic()"><i class="fa fa-plus m-2"></i>Tambah PIC</button>
                        </td>
                        <td width="10"></td>
                        <td width="130">
                            <button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i>Simpan</button>
                        </td>
                        <td width="10"></td>
                        <td width="130">
                            <button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="batal()"><i class="fa fa-ban m-2"></i>Kosong</button>
                        </td>
                        <td width="10"></td>
                        <td width="130">
                            <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal_bobot"><i class="fa fa-book m-2"></i>Set Bobot</button>
                        </td>
                    </tr>
                </table>
            </div>           
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Monitoring Project Holografi</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="info_2 fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <table style="width: 50%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="60%" class="filter">Nama Project atau PIC</td>
                                        <td></td>
                                        <td width="20%" class="filter">Periode</td>
                                        <td></td>
                                        <td width="20%" class="filter">Status</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" id="cari" onkeyup="filter()" placeholder="Cari Nama Project atau PIC.." style="width: 100%;" autocomplete="off"></td>
                                        <td></td>
                                        <td>
                                            <select class="form-control select" id="fPeriode" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <option>2017</option>
                                                <option>2018</option>
                                                <option>2019</option>
                                                <option>2020</option>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="form-control select" id="fStatus" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All</option>
                                                <option selected>Open</option>
                                                <option>Close</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                                <div class="data-table m-3"></div>
                            </div>

                        </font>
                    </div>

                    <div class="card-footer">
                        <table>
                            <tr>
                                <td width="130">
                                    <button type="button" class="btn btn-block btn-success" onclick="edit()"><i class="fa fa-check-square-o m-2"></i>Edit</button>
                                </td>
                                <td width="10"></td>
                                <td width="130">
                                    <button type="button" class="btn btn-block btn-warning" onclick="rev_target()"><i class="fa fa-clipboard m-2 m-2"></i>Rev. Target</button>
                                    <button id="btnRevisi" data-toggle="modal" data-target="#modal_revisi" hidden></button>
                                </td>
                                <td width="10"></td>
                                <td width="130">
                                    <button type="button" class="btn btn-block btn-primary" onclick="finish_date()"><i class="fa fa-save m-2"></i>Finish</button>
                                    <button id="btnFinish" data-toggle="modal" data-target="#modal_finish" hidden></button>
                                </td>
                                <td width="10"></td>
                                <td width="130">
                                    <button type="button" class="btn btn-block btn-danger" onclick="hapus()"><i class="fa fa-ban m-2"></i>Hapus</button>
                                    <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
                                </td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>

        </div>

        <div style="overflow-x: auto;">
            <?php $this->load->view('sistem/v_input_project_modal'); ?>
        </div>

    </section>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var tabel_pic = document.getElementById('tabel_pic');
var table_gambar = document.getElementById('table_gambar');
var arrPic = [], id_hapus = [], gambar_hapus = [];
var row_select = '';
var jml_file = 0;

// Load Dokumen
$(document).ready(function() {

    $('.info_1')[0].click();
    // $('#hide_sidebar').click();
    $('#nama_project').focus();

    $(".select").select2();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    $('#tabel_pic').width('80%');

    filter();
    auto_no();
});

// Kosongkan Isian
function kosong() {
    $('#tgl').val(<?php echo json_encode(date('d-M-Y', strtotime('-0 days'))); ?>);
    $('#nama_project').val('');
    $('#id_ide').val('');
    $('#level').val('').change();
    $('#nama_kary').val('').change();

    $("#tabel_pic").find("tr:gt(0)").remove();
    $('#nama_project').removeAttr('disabled');
    $('#nama_kary').removeAttr('disabled');
    $('.action').prop('checked',false);
    $('#nama_project').focus();

    row_select = ''; id_hapus = [];
} 

// Pagination
function pagination() { 
    $('#data-table').DataTable().destroy();
    var data_table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "info": false,
        "columnDefs": [{"orderable": false, "targets": "_all"}],
        "order": [],
        "autoWidth": true,
        "scrollX": true,
        "scrollY": "400px",
        "dom": 'frtipB',
        "buttons": [{
            text: 'Export Excel',
            extend: 'excel',
            exportOptions: {columns: ':visible'},
            className: 'invisible excel',
            filename: 'Laporan Data IPB - Gudang',
            title: ''
        }],
        "colReorder": true
    });

    setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
}

// Auto No.
function auto_no() {
    var year = ($('#tgl').val()).substr(-2);

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url()."index.php/sistem/project/auto_no" ?>',
        data: {data: year},
        success: function(data) {
            document.getElementById('no_project').value = data;
        }
    });
}

//Tambah PIC
function tambah_pic() {
    $('#tabel_pic').append(
        '<tr>' +
        '<td><select class="form-control select" name="nama_pic" style="width: 95%;" onchange="pic(this)">' +
        '<option value="">Pilih PIC..</option> ' +

        '<?php foreach ($show_pic->result_array() as $pic): ?>' +
        '<option><?php echo ucwords(strtolower($pic['NAMA'])); ?></option>' +
        arrPic.push(<?php echo $pic['ID']; ?>) +
        '<?php endforeach; ?>' +

        '</select></td>' +
        '<td><input type="text" class="form-control" autocomplete="off" name="tugas" style="width: 95%;"></td>' +
        '<td><input type="text" class="form-control datepicker" name="deadline" style="width: 95%; text-align: center; background-color: #FFFFFF; cursor: pointer;" value="<?php echo date('d-M-y'); ?>" readonly></td>' +

        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus PIC" onclick="hapus_pic(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
        '<td hidden></td>' +
        '<td hidden></td>' +
        '</tr>')

    $(".select").select2();
    $(".datepicker").datepicker({ dateFormat: 'dd-M-yy' });
}

// Isi Tabel Sementara (data yang akan disimpan)
function pic(btn) {
    var row = $(btn).closest("tr").index()+1;
    var index_pic = btn.selectedIndex;
    var id_pic = arrPic[index_pic - 1];

    tabel_pic.rows[row].cells[4].innerHTML = id_pic;
}

// Hapus PIC
function hapus_pic(btn) {
    var row = $(btn).closest("tr").index()+1;
    var id_edit = tabel_pic.rows[row].cells[5].innerHTML;
    id_hapus.push(id_edit);

    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
};

// Batal Isian
function batal() {
    kosong();
    auto_no();
}

// Error Isian
function error_isian(str) {
    $('#error_isian').removeClass('invisible');
    $('#error_isian').html(str);
    $('#btnIsian').click();
    throw new Error("Isian salah..");
}

// Simpan Data
function simpan() {
    var no_project = $('#no_project').val();
    var id_ide = $('#id_ide').val();
    var level = $('#level option:selected').index();
    var tgl = $('#tgl').val();
    var nama_project = $('#nama_project').val();
    var id_koordinator = document.getElementById('nama_kary').value;

    if (level == '0') {error_isian('Level Project belum diisi..');}
    if (nama_project == '') {error_isian('Nama Project belum diisi..');}
    if (id_koordinator == '') {error_isian('Nama Karyawan belum diisi..');}
    if (tabel_pic.rows.length == 1) {error_isian('Tabel PIC belum diisi..');}

    // Tampung data dari tabel PIC
    var id_pic = [], tugas = [], deadline = [], id_edit = [];
    for(var i=0; i<(tabel_pic.rows.length-1); i++) {
        if (document.getElementsByName('nama_pic')[i].value == '') {error_isian('Nama PIC belum diisi..');}
        if (document.getElementsByName('tugas')[i].value == '') {error_isian('Tugas belum diisi..');}
        if (document.getElementsByName('deadline')[i].value == '') {error_isian('Deadline belum diisi..');}

        id_pic.push(tabel_pic.rows[i+1].cells[4].innerHTML);
        id_edit.push(tabel_pic.rows[i+1].cells[5].innerHTML);
        tugas.push(document.getElementsByName('tugas')[i].value);
        deadline.push(document.getElementsByName('deadline')[i].value);
    }

    var data = [no_project, tgl, nama_project, id_pic, tugas, deadline, level, id_edit, id_ide, id_koordinator, id_hapus];

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/simpan_project',
        success: function(data) {
            auto_no();
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
                filter();
            }, 500);
        }
    });
}

// Filter Tabel
function filter() {
    var cari = document.getElementById('cari').value;
    var periode = document.getElementById('fPeriode').value;
    var status = document.getElementById('fStatus').value;
    var data = [cari, periode, status];
    row_select = '';

    $('#btnProgress').click();
    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url()."index.php/sistem/project/filter_project" ?>',
        success: function(data) {
            $('.data-table').html(data);
            setTimeout(function() {
                $('#btnOk').click();
                pagination();
            }, 500);
        }
    }); 
}

// Preview Ide
function preview() {
    $('#modal_preview').click();
    setTimeout(function() {
        pagination_ide();
    },200);
}

// Setting Bobot Nilai
$('#simpan_bobot').on("click", function() {
    var st1 = $('#st1').val();
    var st2 = $('#st2').val();
    var st3 = $('#st3').val();
    var st4 = $('#st4').val();
    var t1 = $('#t1').val();
    var t2 = $('#t2').val();
    var t3 = $('#t3').val();
    var t4 = $('#t4').val();
    var s1 = $('#s1').val();
    var s2 = $('#s2').val();
    var s3 = $('#s3').val();
    var s4 = $('#s4').val();
    var data = [[st1,st2,st3,st4],[t1,t2,t3,t4],[s1,s2,s3,s4]];

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/simpan_bobot',
        success: function() {
            $('#btnSukses').click();
        }
    });
});

// Ambil ID untuk action
function get_action(btn) {
    table_data = document.getElementById('data-table');
    row_select = $(btn).closest("tr").index() + 1;
}

// Edit Data Project
function edit() {
    if (row_select == ''|| table_data.rows[row_select].cells[14].innerHTML == 'Close') {
        return;
    }else{
        var id_project = table_data.rows[row_select].cells[15].innerHTML;
    }

    $.ajax({
        data: {data: id_project},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/ambil_project',
        success: function(data) {
            if (data == '') {return;}

            var info = $('.info_1:eq(1)')[0].classList[2];
            if (info == 'fa-plus') {$('.info_1:eq(0)').click();} // Expand Info

            kosong();
            var data = JSON.parse(data);

            $('#tgl').val(format_date((data[0].TGL)));
            $('#nama_project').val(data[0].NAMA);
            $('#no_project').val(data[0].NMR).change();
            $('#nama_kary').val(data[0].ID_KARY).change();
            $('#id_ide').val(data[0].ID_IDE).change();
            document.getElementById("level").selectedIndex = data[0].LEV;

            if (data[0].ID_IDE != null) {
                $('#nama_project').attr('disabled','disabled');
                $('#nama_kary').attr('disabled','disabled');
            }

            for (var i=0; i<=data.length; i++) {
                tambah_pic();
                if (i == data.length) {$('#tabel_pic tr:eq('+ (i+1) + ')').remove(); return;}

                document.getElementsByName('nama_pic')[i].value = data[i].NAMA_KARY;
                document.getElementsByName('tugas')[i].value = data[i].TUGAS;
                document.getElementsByName('deadline')[i].value = format_date(data[i].DEADLINE);                

                tabel_pic.rows[i+1].cells[4].innerHTML = data[i].ID_KARY;
                tabel_pic.rows[i+1].cells[5].innerHTML = data[i].ID;
            }
            $('#nama_pic').focus();
        }
    });        
}

// Format Tanggal DD-MMM-YYYY
function format_date(date) {
    try {
        var tgl = date.substring(0,2);
        var month = parseInt(date.substring(3,5))-1;
        var thn = date.substring(6);

        var bln = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sept","Oct","Nov","Dec"];
        var bln = bln[month];
        return tgl + '-' + bln + '-' + thn;
    }catch(err){}
}

// Expands & Collapse Card Info
$('.info_1:eq(0)').on('click', function() {
    var info = $('.info_1:eq(1)')[0].classList[2];

    if (info == 'fa-minus') {
        $('.info_1:eq(1)').removeClass('fa-minus').addClass('fa-plus');
    }else{
        $('.info_1:eq(1)').removeClass('fa-plus').addClass('fa-minus');
    }
});
$('.info_2:eq(0)').on('click', function() {
    var info = $('.info_2:eq(1)')[0].classList[2];

    if (info == 'fa-minus') {
        $('.info_2:eq(1)').removeClass('fa-minus').addClass('fa-plus');
    }else{
        $('.info_2:eq(1)').removeClass('fa-plus').addClass('fa-minus');
    }
});

// Revisi Target
function rev_target() {
    if (row_select != '' && table_data.rows[row_select].cells[14].innerHTML == 'Open') {
        $("#btnRevisi").click();

        document.getElementById('target2').value = table_data.rows[row_select].cells[11].innerHTML;
        document.getElementById('target3').value = table_data.rows[row_select].cells[12].innerHTML;
    }
}
$('#simpan_revisi').on("click", function() {
    var target1 = table_data.rows[row_select].cells[10].innerHTML;
    var target2 = document.getElementById('target2').value;
    var target3 = document.getElementById('target3').value;
    var id_project = table_data.rows[row_select].cells[15].innerHTML;

    data = [id_project, target2, target3];
    if ((new Date(target2) >= new Date(target3) && target3 != "") || target2 == "" || (target3 != '' && target2 == '') || new Date(target1) >= new Date(target2)) {return;}

    $('#btnProgress').click();
    $.ajax({
        url: '<?php echo base_url(); ?>index.php/sistem/project/simpan_revisi',
        type: 'POST',
        data: {data: data},
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                filter();
            }, 500);
            
            $('.btn_rev_close:eq(0)').click();
        }
    });
});
$('#hapus_revisi').on("click", function() {
    var id_project = table_data.rows[row_select].cells[15].innerHTML;

    $.ajax({
        url: '<?php echo base_url(); ?>index.php/sistem/project/hapus_revisi',
        type: 'POST',
        data: {data: id_project},
        success: function(data) {
            filter();
            $('.btn_rev_close:eq(0)').click();
            $('#btnSukses').click();
        }
    });
});

// Modal Finish
function finish_date() {
    if (row_select == '') {return;}

    var id_project = table_data.rows[row_select].cells[15].innerHTML;

    $.ajax({
        url: '<?php echo base_url(); ?>index.php/sistem/project/ambil_gambar',
        type: 'POST',
        data: {data: id_project},
        success: function(data) {
            data = JSON.parse(data);

            gambar_hapus = [];
            $('#finish').val("");
            $("#table_gambar").find("tr").remove();
            $("#btnFinish").click();

            jml_file = 0;
            if (data[0].FINISH == null) {return;}
            ambil_gambar(data);
        }
    });
}

// Ambil Gambar Finish
function ambil_gambar(data) {
    $('#finish').val(format_date(data[0].FINISH));
    for (var i=0; i<data.length; i++) {
        gambar = data[i].GAMBAR;
        id_gambar = data[i].ID_GAMBAR;
        $('#table_gambar').append(
            '<tr>' +
            '<td align="center"><input type="image" src="<?php echo base_url();?>images/project/' + gambar + '" width="300" height="300" name="img_preview" onerror="this.src=\'<?php echo base_url();?>images/no_preview.jpg\'" alt="Preview" style="text-align: center;line-height:200px;"></td>' +
            '<td><button style="width: 100%;" class="btn btn-danger" onclick="remove_file(this)"><i class="fa fa-trash m-2"></i><b>Remove</b></button></td>' +
            '<td hidden><input type="file" name="my_file" onchange="img_preview(this)"></td>' +
            '<td hidden>' + gambar + '</td>' +
            '</tr>')
        jml_file++;
    }
}

// Add File
$('#add_file').on('click', function() {
    $('#table_gambar').append(
        '<tr>' +
        '<td align="center"><input type="image" src="<?php echo base_url();?>images/plus.png" width="300" height="300" name="img_preview" alt="Preview" style="text-align: center;line-height:200px;"></td>' +
        '<td><button style="width: 100%;" class="btn btn-danger" onclick="remove_file(this)"><i class="fa fa-trash m-2"></i><b>Remove</b></button></td>' +
        '<td hidden><input type="file" name="my_file" onchange="img_preview(this)"></td>' +
        '<td hidden></td>' +
        '</tr>')
    $("input[name='my_file']")[jml_file].click();
    jml_file++;
});

// Tampilkan preview gambar
function img_preview(img) {
    var tbl_header = document.getElementById('tbl_header');
    var index = $(img).closest("tr").index();
    var gambar = $("input[name='img_preview']")[index];
    var file = img.files;    
    var reader = new FileReader();
    var filename = (file[0]['name']).split('.');
    var extension = filename[filename.length-1];
    var allow_extension = ['JPG','JPEG','PNG'];

    if (allow_extension.indexOf(extension.toUpperCase()) == -1) {
        row = img.parentNode.parentNode;
        row.parentNode.removeChild(row);
        jml_file--;
        return;
    }

    reader.onload = function(e) {
        gambar.setAttribute('src',e.target.result);
    }
    reader.readAsDataURL(file[0]);
    table_gambar.rows[index].cells[3].innerHTML = file[0]['name'];
}

// Hapus preview gambar
function remove_file(btn) {
    var row = $(btn).closest("tr").index();

    gambar_hapus.push(table_gambar.rows[row].cells[3].innerHTML);

    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    jml_file--;
};

// Simpan Finish
$('#save_file').on('click', function() {
    var form_data = new FormData();
    var finish = document.getElementById('finish').value;
    var id_project = table_data.rows[row_select].cells[15].innerHTML;
    var target_1 = table_data.rows[row_select].cells[10].innerHTML;
    var target_2 = table_data.rows[row_select].cells[11].innerHTML;
    var target_3 = table_data.rows[row_select].cells[12].innerHTML;

    if (target_3 != '') {
        target = target_3;
    }else if(target_2 != '') {
        target = target_2;
    }else{
        target = target_1;
    }

    if (table_gambar.rows.length == 0 || finish == '' || new Date(finish) > new Date(target)) {return;}

    form_data.append('id_project',id_project);
    form_data.append('finish',finish);
    form_data.append('gambar_hapus',gambar_hapus);
    for (var i=0; i<table_gambar.rows.length; i++) {
        file = $("input[name='my_file']")[i].files[0];
        form_data.append('img[]',file);
        if (table_gambar.rows[i].cells[3].innerHTML == '') {return;}
    }

    $('#keluar').click();
    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/simpan_finish',
        data: form_data,
        contentType: false, 
        processData: false,
        success: function(data) {
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                filter();
            }, 500);
        }
    });
});

// Hapus Data
function hapus() {
    if (row_select == '') {return;}
    finish = table_data.rows[row_select].cells[13].innerHTML;
    if (finish == '') {$("#btnHapus").click();}
}
$('#ya').on("click", function() {
    var id_project = table_data.rows[row_select].cells[15].innerHTML;

    $('#btnProgress').click();
    $.ajax({
        data: {data: id_project},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/hapus_project',
        success: function() {
            auto_no();
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
                filter();
            }, 500);
        }
    });
});
$('#failed').on("click", function() {
    var id_project = table_data.rows[row_select].cells[15].innerHTML;

    $.ajax({
        data: {data: id_project},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/failed_project',
        success: function(data) {
            filter();
            auto_no();
            $('#btnSukses').click();
        }
    });
});

</script>