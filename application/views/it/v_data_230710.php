<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/footer');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<?php $this->load->view('it/v_historis_topbar'); ?>

<section class="content-header"></section>
<section class="content">
    <div class="card card-info" <?php if($_SESSION['akses'] == '1') {echo 'hidden';} ?>>
        <div class="card-header" style="background-color: #A2A09D;">
            <h3 class="card-title">
                <b>
                    <font color="White">
                        <div id="headerinput">Upload</div>
                    </font>
                </b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_1"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body card m-4">
            <?php $dt_sub_kategori = array(); ?>
            <?php foreach ($all_kategori->result_array() as $dt) { ?>
                <?php $dt_kategori[] = $dt['KATEGORI']; ?>
                <?php $dt_sub_kategori[] = $dt['SUB_KATEGORI']; ?>
                <?php $dt_id_kategori_detail[] = $dt['ID_KATEGORI_DETAIL']; ?>
                <?php $kategori = array_unique($dt_kategori); ?>
            <?php } ?>

            <div class="row">
                <div class="col-md-5">
                    <table width="100%">
                        <tr>
                            <th width="40%">Pemilik Dokumen</th>
                            <td>
                                <select class="select" id="pemilik" style="width: 100%; cursor: pointer;">
                                    <option value="">Pilih Nama..</option>
                                    <?php foreach ($pemilik->result_array() as $dt) { ?>
                                        <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Jenis</th>
                            <td>
                                <select class="select" id="jenis" style="width: 100%; cursor: pointer;">
                                    <option value="">Pilih Jenis..</option>
                                    <option>Umum</option>
                                    <option>Rahasia</option>
                                </select>
                            </td>                         
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Tahun</th>
                            <td>
                                <?php $years = range(2025, 1990); ?>
                                <select class="select" id="tahun" style="width: 100%;">
                                    <option value="">Tahun..</option>
                                    <?php foreach ($years as $dt) { ?>
                                        <option <?php if ($dt == date("Y")) {
                                            echo "Selected";
                                        } ?>><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                    </table>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-6">
                    <table width="100%">
                        <tr>
                            <th width="40%">Kategori</th>
                            <td>
                                <select class="select" id="kategori" style="width: 100%; cursor: pointer;">
                                    <option value="">Pilih Kategori..</option>
                                    <?php foreach ($kategori as $dt) { ?>
                                        <option><?php echo $dt; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <th>Sub Kategori</th>
                            <td>
                                <select class="select" id="sub_kategori" style="width: 100%; cursor: pointer;">
                                    <option value="">Pilih Sub Kategori..</option>
                                </select>
                            </td>
                        </tr>
                    </table>                     
                </div>
            </div>
        </div>
        <div class="card-footer">
            <table>
                <tr>
                    <td width="150"><button type="button" class="btn btn-block btn-warning" id="btnBrowse"><i class="fa fa-camera-retro m-2"></i><b>Browse</b></button></td>
                    <input type="file" id="my_file" onchange="selected_file()" multiple hidden>
                    <td width="10"></td>
                    <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                    <td width="10"></td>
                    <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                </tr>
            </table>
        </div>
        <div class="card-body card m-4">
            <table id="tabel_file" class="table table-bordered">
                <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                    <tr style="text-align: center;">
                        <td width="10%">No.</td>
                        <td width="20%">Target File</td>
                        <td>Judul</td>
                        <td width="35%">Kriteria</td>
                        <td width="5%">Lihat</td>
                        <td width="5%">Buang</td>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

            <b>
                <p class="text-center mt-4 text-danger">Maks. 1 Gb</p>
            </b>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-header" style="background-color: #A2A09D;">
            <h3 class="card-title">
                <b>
                    <font color="White">Laporan</font>
                </b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 12px; overflow-y: hidden;">
                        <table style="width: 1000px; margin-bottom: 10px;">
                            <thead>
                                <tr align="center" style="line-height: 30px;">
                                    <td width="20%" class="filter">Kategori</td>
                                    <td></td>
                                    <td width="20%" class="filter">Sub Kategori</td>
                                    <td></td>
                                    <td width="10%" class="filter">Tahun</td>
                                    <td></td>
                                    <td width="20%" class="filter">Pemilik Dokumen</td>
                                    <td></td>
                                    <td width="12%" class="filter">Jenis</td>
                                    <td></td>
                                    <td class="filter">Pencarian</td>
                                    <td></td>
                                    <td class="filter" hidden>View</td>
                                    <td hidden></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <select class="select" id="fKategori" onchange="filter();isi_sub();" style="width: 100%;">
                                            <option>All</option>
                                            <?php foreach ($kategori as $dt) { ?>
                                                <option><?php echo $dt; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fSubKategori" onchange="filter()" style="width: 100%;">
                                            <option>All</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fTahun" onchange="filter()" style="width: 100%;">
                                            <option>All</option>
                                            <?php foreach ($tahun->result_array() as $dt) { ?>
                                                <option selected><?php echo $dt['TAHUN']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fKaryawan" onchange="filter()" style="width: 100%;">
                                            <option>All</option>
                                            <?php foreach ($karyawan->result_array() as $dt) { ?>
                                                <option><?php echo $dt['NAMA']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <select class="select" id="fJenis" onchange="filter()" style="width: 100%;">
                                            <option>All</option>
                                            <option>Umum</option>
                                            <option>Rahasia</option>
                                        </select>
                                    </td>
                                    <td></td>
                                    <td>
                                        <input type="text" id="cari" onkeyup="filter()" placeholder="Cari.." style="width: 100%;" autocomplete="off">
                                    </td>
                                    <td></td>
                                    <td hidden>
                                        <select class="select" id="fView" onchange="filter()" style="width: 100%;">
                                            <option selected>Detail</option>
                                            <option>Album</option>
                                        </select>
                                    </td>
                                    <td style="text-align: right;" <?php if ($_SESSION['akses'] == '1') {
                                        echo 'hidden';} ?> hidden>
                                        <input type="checkbox" id="fApproved" onchange="filter()" style="cursor: pointer;" checked>
                                        <p><b>Approved</b></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pb-4" style="overflow-x: scroll; font-size: 12px;">
                        <div class="data-table"></div>
                        <div id="view_album" style="display: none;"></div>
                    </div>
                </font>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <font color="Green" size="2">ERP @2019</font>
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
<div class="modal fade" id="modal_hapus" style="z-index: 9998;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Approve -->
<div class="modal fade" id="modal_approve">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin Approve Dokumen? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                <button id="ya_approved" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
                <button id="btnApproved" data-toggle="modal" data-target="#modal_approve" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview Image -->
<div class="modal fade" id="modal_image">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <img id="img_preview" class="img-responsive img-thumbnail" style="margin: 20px; width: 95%; max-height: 500px;">
            <iframe id="pdf_preview" width="750" height="600" style="margin: 20px;"></iframe>
        </div>
    </div>
</div>

<!-- Modal Error Isian -->
<div class="modal fade" id="modal_isian">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body isian_salah" style="font-size: 40px; color: #D00101; font-weight: bold;"> Isian salah.. </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert ion-android-cancel fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnIsian" data-toggle="modal" data-target="#modal_isian" hidden></button>
            </div>
        </div>
    </div>
</div>

</section>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

    // Define Variable
    var tabel_file = document.getElementById('tabel_file');
    var dt_id_kategori_detail = new Array(), data_hapus = new Array();
    var info_1 = 0, info_2 = 0; // Status Card Info
    var file = [];

    // Load Dokumen
    $(document).ready(function() {
        $(".select").select2(); // Combo Live Search
        filter();

        // Change Title
        $('title')[0].innerText = 'Data Historis';

        // Change Icon
        $("link[rel*='icon']").attr("href", "<?php echo base_url(); ?>assets/images/historis.jpg");
    });

    // Pagination
    function pagination() {
        $('#data-table').DataTable().destroy();
        var table = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": [],
            "colReorder": true
        });

        setTimeout(function() {table.columns.adjust().draw();}, 500);
    }

    // Pilih Sub Kategori
    $('#kategori').on('change', function() {
        var kategori = document.getElementById("kategori").value;
        var sub_kategori = document.getElementById("sub_kategori");
        dt_id_kategori_detail = new Array();

        $("#sub_kategori").empty();
        $('#sub_kategori').append(new Option('Pilih Sub Kategori..'));
        $('#sub_kategori').val('Pilih Sub Kategori..').change();

        <?php $jml = count($dt_sub_kategori);
        for ($i = 0; $i < $jml; $i++) { ?>
            var option = document.createElement("option");

            <?php $dt = $dt_sub_kategori[$i]; ?>
            dt_kategori = <?php echo json_encode($dt_kategori[$i]); ?>;
            if (dt_kategori == kategori) {
                option.text = <?php echo json_encode($dt_sub_kategori[$i]); ?>;
                sub_kategori.add(option);

                dt = <?php echo json_encode($dt_id_kategori_detail[$i]); ?>;
                dt_id_kategori_detail.push(dt);
            }
        <?php } ?>
    });

    //Tambah File
    $('#btnBrowse').on('click', function() {
        $('#my_file').click();
    });

    // Preview File
    function preview_file(btn) {
        var dir = <?php echo json_encode(base_url()); ?> + "images/bank_data/";
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index();
        var filename = file[row];
        var berkas = filename == 'edit' ? dir + btn.name : window.URL.createObjectURL(filename);
        var nama = file[row].name;
        var ext = filename == 'edit' ? btn.name.split('.')[1] : (nama.substr(nama.lastIndexOf('.') + 1)).toLowerCase();

        $('#img_preview').attr("hidden", "");
        $('#pdf_preview').attr("hidden", "");

        if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
            $('#img_preview').attr('src', berkas);
            $('#img_preview').removeAttr('hidden');
        } else if (ext == 'pdf' || ext == 'mp4' || ext == 'mpeg' || ext == 'mp3' || ext == '3gp' || ext == 'avi' || ext == 'wmp') {
            $('#pdf_preview').attr('src', berkas);
            $('#pdf_preview').removeAttr('hidden');
        } else {
            $('#img_preview').attr('src', <?php echo json_encode(base_url()); ?> + "images/no_preview.jpg");
            $('#img_preview').removeAttr('hidden');
        }

    }

    // Preview File
    function preview_tabel(btn) {
        var filename = btn.name;
        var ext = btn.name.split('.')[1];

        $('#img_preview').attr("hidden", "");
        $('#pdf_preview').attr("hidden", "");

        if (ext == 'jpg' || ext == 'jpeg' || ext == 'png') {
            $('#img_preview').attr('src', filename);
            $('#img_preview').removeAttr('hidden');
        } else if (ext == 'pdf' || ext == 'mp4' || ext == 'mpeg' || ext == 'mp3' || ext == '3gp' || ext == 'avi' || ext == 'wmp') {
            $('#pdf_preview').attr('src', filename);
            $('#pdf_preview').removeAttr('hidden');
        } else {
            $('#img_preview').attr('src', <?php echo json_encode(base_url()); ?> + "images/no_preview.jpg");
            $('#img_preview').removeAttr('hidden');
        }

    }

    // Hapus File
    function hapus_file(btn) {
        row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        nomor();

        file.splice(0, 1);

        if (tabel_file.rows.length == 1) {
            document.getElementById("my_file").value = "";
        }
    };

    // Pilih File
    function selected_file() {
        var qty_file = $('#my_file').get(0).files.length;
        var add_data = qty_file == 0 ? '1' : $('#my_file').get(0).files.length;

        for (var i=0; i<add_data; i++) {
            filename = qty_file == 0 ? '' : $('#my_file').get(0).files[i].name;
            size = qty_file == 0 ? '' : $('#my_file').get(0).files[i].size;

            if (size < 1000000000) {
                data_file = qty_file == 0 ? 'edit' : $('#my_file').get(0).files[i];
                file.push(data_file);

                $('#tabel_file tbody').append(
                    '<tr>' +
                    '<td><input type="text" class="form-control" name="nmr" style="text-align: center; width: 95%;" readonly></td>' +
                    '<td><input type="text" class="form-control" name="target_file" style="width: 95%;" readonly></td>' +
                    '<td><input type="text" class="form-control" autocomplete="off" name="nama_file" maxlength="170" style="width: 95%;""></td>' +
                    '<td><input type="text" class="form-control" autocomplete="off" name="tag" maxlength="80" style="width: 95%;"></td>' +
                    '<td><button type="button" class="btn btn-block btn-info" onclick="preview_file(this)" title="Preview" data-toggle="modal" data-target="#modal_image" style="margin-top: 0; text-align: center;" name=""><i class="fa fa-tv"></button></td>' +
                    '<td><button type="button" class="btn btn-block btn-danger" title="Hapus File" onclick="hapus_file(this)" style="margin-top: 0; text-align: center;" title="Hapus"><i class="fa fa-close"></button></td>' +
                    '</tr>');

                document.getElementsByName('target_file')[file.length - 1].value = filename;
                nomor();
            }
        }
    }

    // Update Nomor
    function nomor() {
        var qty_data = $('#tabel_file tbody tr').length;

        for (var i=0; i<qty_data; i++) {
            document.getElementsByName('nmr')[i].value = i+1;
        }
    }

    // Kosongkan isian
    function kosong() {
        $('#pemilik').val('').change();
        $('#jenis').val('').change();
        $('#tahun').val(<?php echo date('Y'); ?>).change();
        $('#kategori').val('').change();
        $('#sub_kategori').val('Pilih Sub Kategori..').change();
        $("#tabel_file tbody tr").remove();
        file = [];
    }

    // Simpan Data
    $('#btnSimpan').on('click', function() {
        var form_data = new FormData();
        var id_pemilik = $('#pemilik').val();
        var jenis = $('#jenis').val();
        var tahun = $('#tahun').val();
        var kategori = $('#kategori').val();
        var sub_kategori = $('#sub_kategori').val();
        var indeks = document.getElementById("sub_kategori").selectedIndex;
        var id_kategori_detail = dt_id_kategori_detail[indeks - 1];
        var qty_data = $('#tabel_file tbody tr').length;
        var data = [id_pemilik, jenis, tahun, id_kategori_detail, kategori, sub_kategori, qty_data];

        if (id_pemilik == '') {salah_isian('Pemilik');}
        if (jenis == '') {salah_isian('Jenis Dokumen');}
        if (tahun == '') {salah_isian('Tahun');}
        if (kategori == '') {salah_isian('Kategori');}
        if (sub_kategori == 'Pilih Sub Kategori..') {salah_isian('Sub Kategori');}
        if (qty_data == 0) {salah_isian('File');}

        form_data.append('data', data);
        for (var i=0; i<qty_data; i++) {
            filename = document.getElementsByName('nama_file')[i].value;
            tag = document.getElementsByName('tag')[i].value;
            id_edit = $('[name="target_file"]:eq('+i+')').attr('class');

            if (filename == '') {salah_isian('Judul');}
            form_data.append('file_' + i, file[i]);
            form_data.append('filename_' + i, filename);
            form_data.append('tag_' + i, tag);
            form_data.append('id_edit_' + i, id_edit);
        }

        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/simpan_file',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    kosong();
                    filter();
                }, 500);
            }
        });
    });

    // Salah Isian
    function salah_isian(data) {
        $('.isian_salah')[0].innerText = data + ' belum diisi..';
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

    function isi_sub() {
        var option = document.createElement('option');
        var fKategori = document.getElementById('fKategori').value;
        var fSubKategori = document.getElementById('fSubKategori');
        var dt_kategori = <?php echo json_encode($dt_kategori); ?>;
        var dt_sub_kategori = <?php echo json_encode($dt_sub_kategori); ?>;

        $('#fSubKategori').empty();
        fSubKategori.options[0] = new Option("All");
        $('#fSubKategori').val("All").change();
        dt_sub_kategori.forEach(function(item, index) {
            if (dt_kategori[index] == fKategori) {
                fSubKategori.options[fSubKategori.options.length] = new Option(item);
            }
        });
    }
    // Filter Tabel
    function filter() {
        var jenis = document.getElementById('fJenis').value;
        var tahun = document.getElementById('fTahun').value;
        var kategori = document.getElementById('fKategori').value;
        var fSubKategori = document.getElementById('fSubKategori').value;
        var cari = document.getElementById('cari').value;
        var view = document.getElementById('fView').value;
        var karyawan = document.getElementById('fKaryawan').value;
        var approved = document.getElementById('fApproved').checked;
        if (approved == true) {
            approved = '2';
        } else {
            approved = '1';
        }

        var arrData = [jenis, tahun, kategori, cari, view, karyawan, approved, fSubKategori];
        $.ajax({
            data: {data: arrData},
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/filter_file',
            success: function(data) {
                $('.data-table').html(data);
                pagination();
                id_project = 0;
            }
        });
    }

    // Ambil File
    function ambil_file(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var file = data_table.rows[row].cells[13].innerHTML;
        var id = data_table.rows[row].cells[8].innerHTML;
        return [file, id];
    }

    // Melihat File
    function preview(btn) {
        var file = ambil_file(btn);
        var id_album = file[1];
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var id_offline = data_table.rows[row].cells[8].innerHTML;
        var ext = data_table.rows[row].cells[14].innerHTML;
        var target_file = id_offline + '.' + ext;
        var source_file = data_table.rows[row].cells[13].innerHTML;

        $.ajax({
            data: {data: id_album},
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/cek_file',
            success: function(data) {
                if (data == '0') {
                    location.reload();
                } else {
                    window.open('<?php echo base_url() . "index.php/it/data/show_preview?id=" ?>' + id_album, '_blank');
                }
            }
        });
    }

    // Buka File Offline
    function buka_offline(target_file, source_file) {
        $.ajax({
            data: {data: [target_file, source_file]},
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/buka_offline',
            success: function(data) {
                console.log(data);
            }
        });
    }

    // Mendownload File
    function download(btn) {
        var file = ambil_file(btn);

        document.getElementById('my_download').href = file[0];
        document.getElementById('my_download').click();
    }

    // Hapus Data
    function hapus(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var id_data = data_table.rows[row].cells[8].innerHTML;
        var ext = data_table.rows[row].cells[14].innerHTML;
        var file = 'images/bank_data/' + id_data + '.' + ext;
        var arrData = [id_data, file];

        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_data == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                data: {data: arrData},
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/it/data/delete_file',
                success: function(data) {
                    console.log(data);
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        kosong();
                        filter();
                        id_data = '';
                    }, 500);
                }
            });
        });

        $('#btnNo').on('click', function() {
            if (id_data == '') {return;}
            id_data = '';
        });
    }

    // Approve Data
    function approve(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;

        id_data = data_table.rows[row].cells[8].innerHTML;
        $('#btnApproved').click();
        $('#ya_approved').on('click', function() {
            $.ajax({
                data: {
                    data: id_data
                },
                type: 'POST',
                url: '<?php echo base_url(); ?>index.php/it/data/approve',
                success: function(data) {
                    filter();
                }
            });
        });
    }

    // Edit Data
    function edit(btn) {
        var id_data = btn.name;

        $.ajax({
            data: {data: id_data},
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/edit',
            success: function(data) {
                data = JSON.parse(data);

                kosong();
                selected_file();
                $('#tabel_file .btn-info:eq(0)').attr('name', id_data + '.' + data.EXT);
                $('#pemilik').val(data.ID_KARYAWAN).change();
                $('#jenis').val(data.JENIS).change();
                $('#tahun').val(data.TAHUN).change();
                $('#kategori').val(data.KATEGORI).change();
                $('#sub_kategori').val(data.SUB_KATEGORI).change();
                $('[name="target_file"]:eq(0)').val('Edit Dokumen').change();
                $('[name="target_file"]:eq(0)').addClass(id_data);
                $('[name="nama_file"]:eq(0)').val(data.NAMA_FILE).change();
                $('[name="tag"]:eq(0)').val(data.TAG).change();
                $('html, body').animate({scrollTop: $(".content-header:eq(0)").offset().top}, 1000);
            }
        });
    }

    // Lihat Album
    function view_album(btn) {
        var index = $('img').index(btn) - 1;
        var id_album = document.getElementsByName('id_album')[index].value;
        var win = window.open('<?php echo base_url() . "index.php/it/data/show_preview?id=" ?>' + id_album, '_blank');
    }

    // Expands & Collapse Card Info
    $('.info_1:eq(0)').on('click', function() {
        if (info_1 == 0) {
            $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
            info_1 = 1;
        } else {
            $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
            info_1 = 0;
        }
    });
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