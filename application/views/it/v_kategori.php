<?php
$this->load->view('dashboard/header');
// $this->load->view('dashboard/topbar');
// $this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer');
?>

<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<?php $this->load->view('it/v_historis_topbar'); ?>

<section class="content-header"></section>
<section class="content">
    <div class="card card-info">
        <div class="card-header" style="background-color: #A2A09D;">
            <h3 class="card-title">
                <b>
                    <font color="White">
                        <div id="headerinput">Input Data Kategori</div>
                    </font>
                </b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <table width="50%">
                <tr>
                    <th width="30%">Kategori File</th>
                    <td width="10%">:</td>
                    <td width="60%"><input type="text" class="form-control" id="kategori" autocomplete="off" style="width: 100%; text-transform: uppercase;" maxlength="50" tabindex="1"></td>
                </tr>
            </table>
        </div>
        <div class="card-footer">
            <table>
                <tr>
                    <td width="150">
                        <button type="button" class="btn btn-block btn-warning text-white" id="btnTambah"><i class="fa fa-plus-square m-2"></i><b>Sub Kategori</b></button>
                    </td>
                    <td width="10"></td>
                    <td width="150">
                        <button type="button" class="btn btn-block btn-primary" id="btnSimpan"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                    </td>
                    <td width="10"></td>
                    <td width="150">
                        <button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <table id="tabel_kategori" class="table table-bordered">
                <thead style="background-color: #06D288; color: #FFFFFF; font-weight: bold;">
                    <tr style="text-align: center;">
                        <td width="100%">Sub Kategori</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <div class="card card-info">
        <div class="card-header" style="background-color: #A2A09D;">
            <h3 class="card-title">
                <b>
                    <font color="White">Laporan Data Kategori</font>
                </b>
            </h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">
                    <font size="2">
                        <table style="width: 30%; margin-bottom: 10px;">
                            <thead>
                                <tr align="center" style="line-height: 30px;">
                                    <td width="70%" class="filter">Cari Kategori</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="text" id="cari" placeholder="Cari Kategori.." onkeyup="filter()" style="width: 100%;" autocomplete="off">
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <?php $this->load->view('it/v_kategori_table'); ?>

                    </font>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <font color="Green" size="2">ERP @2019</font>
        </div>
    </div>

    <!-- Modal Confirm Hapus -->
    <div class="modal fade" id="modal_hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
                <div class="modal-footer">
                    <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
                    <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">YES</button>
                    <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
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
                    <button style="width: 30%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){location.reload();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                    <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
                </div>
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
    var tabel_kategori = document.getElementById('tabel_kategori');
    var jml_kategori = 0,
        id_kategori = '',
        id_kategori_detail = 0;

    // Load Page
    $(document).ready(function() {
        tabel_kategori.style.width = '40%';
        document.getElementById('data-table').style.width = '100%';

        pagination();
        $('#kategori').focus();

        // Change Title
        $('title')[0].innerText = 'Data Historis';

        // Change Icon
        $("link[rel*='icon']").attr("href", "<?php echo base_url(); ?>assets/images/historis.jpg");
    });

    // Pagination
    function pagination() {
        data_table = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {
                "sSearch": "Cari  :"
            },
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true
        });

        setTimeout(function() {
            data_table.columns.adjust().draw();
        }, 100);
    }

    // Block Special Character on Input
    $('#kategori').on('keypress', function(e) {
        var chr = String.fromCharCode(e.which);
        if ('`~!@#$%^&*()-_=+|{}[]",./<>?'.indexOf(chr) >= 0)
            return false;
    });

    // Tambah Sub Kategori
    $('#btnTambah').on('click', function() {
        jml_kategori += 1;
        $('#tabel_kategori').append(
            '<tr>' +
            '<td><input type="text" class="form-control teks" autocomplete="off" name="sub_kategori" maxlength="50" style="width: 95%; text-transform: uppercase;"></td>' +
            '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Sub Kategori" onclick="hapus_kategori(this)" style="margin-top: 0; text-align: center;"><i class="fa fa-close"></button></td>' +
            '<td hidden></td>' +
            '</tr>')
        $('.teks').on('keypress', function(e) {
            var chr = String.fromCharCode(e.which);
            if ('`~!@#$%^&*()-_=+|{}[]",./<>?'.indexOf(chr) >= 0)
                return false;
        });
    });

    // Kosongkan isian
    function kosong() {
        document.getElementById("kategori").value = "";
        $("#tabel_kategori").find("tr:gt(0)").remove();
        $('#kategori').focus();
        id_kategori = '';
        jml_kategori = 0;
    }

    // Hapus sub kategori
    function hapus_kategori(btn) {
        row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    };

    // Simpan Data
    $('#btnSimpan').on('click', function() {
        var kategori = document.getElementById('kategori').value;
        var id_kategori_detail = [],
            sub_kategori = [];

        // Validasi isian
        if (kategori == '' || tabel_kategori.rows.length == "1") {
            $('#btnIsian').click();
            return;
        }
        for (var i = 0; i < tabel_kategori.rows.length - 1; i++) {

            x = document.getElementsByName('sub_kategori')[i].value;
            if (x == '') {
                $('#btnIsian').click();
                return;
            }

            sub_kategori.push(x.trim());
            id_kategori_detail.push(tabel_kategori.rows[i + 1].cells[2].innerHTML);
        }

        var data = [id_kategori, kategori.trim(), id_kategori_detail, sub_kategori];

        $('#btnProgress').click();
        $.ajax({
            data: {
                data: data
            },
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/simpan_kategori',
            success: function(data) {
                console.log(data);
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    });

    // Edit Data
    function edit(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;

        id_kategori = data_table.rows[row].cells[5].innerHTML;
        $("#tabel_kategori").find("tr:gt(0)").remove();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/it/data/edit_kategori',
            data: {
                data: id_kategori
            },
            success: function(data) {
                var data = JSON.parse(data);
                $('#kategori').val(data[0]['KATEGORI']);
                $('#kategori').focus();
                isi_data(data);
            }
        });
    }

    function isi_data(data) {
        for (var i = 0; i < data.length; i++) {
            sub_kategori = data[i]['SUB_KATEGORI'];
            id_kategori_detail = data[i]['ID_KATEGORI_DETAIL'];

            $('#tabel_kategori').append(
                '<tr>' +
                '<td><input type="text" class="form-control" autocomplete="off" name="sub_kategori" value="' + sub_kategori + '" style="width: 95%; text-transform: uppercase;"></td>' +
                '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Sub Kategori" onclick="hapus_kategori(this)" style="margin-top: 0; text-align: center;">X</button></td>' +
                '<td hidden>' + id_kategori_detail + '</td>' +
                '</tr>')
        }
    }

    // Filter Tabel
    function filter() {
        var cari = document.getElementById('cari').value;

        $.ajax({
            data: {
                data: cari
            },
            type: 'POST',
            url: '<?php echo base_url() . "index.php/it/data/filter_kategori" ?>',
            success: function(data) {
                $('.data-table').html(data);
                pagination();
            }
        });
    }

    // Hapus Data
    function hapus(btn) {
        var data_table = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        id_kategori_detail = data_table.rows[row].cells[6].innerHTML;

        $('#btnHapus').click();
    }
    $('#ya').on('click', function() {
        $('#btnProgress').click();
        $.ajax({
            data: {
                data: id_kategori_detail
            },
            type: 'POST',
            url: '<?php echo base_url() . "index.php/it/data/hapus_kategori" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    });
</script>