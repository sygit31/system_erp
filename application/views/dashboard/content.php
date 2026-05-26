<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style type="text/css">#modal_view.modal.fade .modal-dialog {transition: transform 1.5s ease-out;}

</style>
<div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
        <div class="card card-success">
            <table>
                <tr>
                    <td>
                        <img src="<?php echo base_url();?>assets/images/login5-1.png" class="btn btn-block">
                    </td>
                </tr>
            </table>
            <div class="card-footer"><font color="Green" size="2">ERP Project of Holografi @2019</font></div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="card card-info">
                    <div class="card-header" style="background-color: #45433F;">
                        <h3 class="card-title">
                            <b>
                                <font color="White">Body Mass Index (BMI)</font>
                            </b>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div style="width: 600px; margin: auto;" align="center">
                            <table id="tbl_input" class="table table-bordered table-striped">
                                <tbody style="font-weight: bold;">
                                    <tr>
                                        <td width="40%">Nama Anda</td>
                                        <td width="60%"></td>
                                    </tr>
                                    <tr>
                                        <td>Tinggi Badan</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Berat Badan</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>BMI</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Result</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Target BMI</td>
                                        <td>
                                            <div style="width: 350px;">
                                                <select class="select" id="f_target" onchange="isi_bmi()" style="width: 100%;">
                                                    <?php foreach($tbl_bmi->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['RESULT']; ?>" <?php if ($dt['POIN'] == $dt['MAX_POIN']) {echo "selected";} ?>><?php echo $dt['RESULT']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Target Berat</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Lebih / Kurang</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-left">
                            <button style="width: 120px;" type="button" class="btn btn-info" title="History BMI" onclick="bmi_history('history')"><i class="fa fa-user mr-2"></i><b>History</b></button>
                            <button style="width: 120px;" type="button" class="btn btn-warning" title="Table BMI" onclick="bmi_history('table')"><i class="fa fa-archive mr-2"></i><b>Table</b></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7" hidden>
                <div class="card card-info">
                    <div class="card-header" style="background-color: #45433F;">
                        <h3 class="card-title">
                            <b>
                                <font color="White">Kalender Holografi</font>
                            </b>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                                <i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div style="width: 600px; height: 450px; margin: auto;" align="center">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tabel BMI -->
<div class="modal fade" id="modal_bmi">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body table_bmi">
                <img src="<?php echo base_url();?>assets/images/table_bmi.png" class="img-thumbnail img-responsive" alt="Table BMI">
            </div>
            <div class="modal-body history">
                <table id="tbl_history" class="table table-bordered table-striped" width="100%">
                    <thead>
                        <tr style="text-align: center;">
                            <th align="5%">No.</th>
                            <th align="15%">Tanggal</th>
                            <th align="15%">Tinggi</th>
                            <th align="15%">Berat</th>
                            <th align="15%">BMI</th>
                            <th align="35%">Result</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button style="width: 150px;" type="button" class="btn btn-danger" title="Close the table.." data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Tutup</b></button>
                <button id="btn_bmi" data-toggle="modal" data-target="#modal_bmi" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data View Slogan -->
<div class="modal fade" id="modal_view" style="z-index: 9999999;">
    <div class="modal-dialog" data-dismiss="modal" style="margin: auto; margin-top: 30px; margin-bottom: 30px;">
        <div class="modal-content">
            <img style="width: auto;">
            <div class="modal-footer rounded">
                <button id="close_view" onclick="show_scroll(); resize();" style="width: 50px; border-radius: 40px;" type="button" class="btn btn-sm btn-danger" title="Tutup" data-dismiss="modal"><i class="fa fa-power-off m-1"></i><font class="second">5</font></button>
                <button id="btnView" data-toggle="modal" data-target="#modal_view" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Defined Variable
    var info = '';

// Load Dokumen
    $(document).ready(function() {
        isi_bmi();
        $('.select').select2();

        hide_scroll();
        buka_slogan();
        resize();

        var second = 5;
        var x = setInterval(function() {
            $('.second:eq(0)').html(second);

            if (second == 0) {
                clearInterval(x);
                $('.fa-power-off:eq(0) font').html('');
                if (info == '') {$('#close_view').click();}
            }
            second--;
        }, 1000);
    });

    // Buka Slogan
    function buka_slogan() {
        var items = [1,2,3,4,5];
        var item = items[Math.floor(Math.random()*items.length)];
        var dir = <?php echo json_encode(base_url()); ?> + 'assets/images/slogan (';
        var rand = <?php echo time(); ?>;
        var filename = dir + item + ').jpg?='+rand;

        info = item == '5' ? '1' : '';
        $('#modal_view img').attr('src', filename);
        $('#btnView').click();
    }

// Resize Page
    $(window).resize(function() {
        resize();
    });

// Change Background
    function resize() {
        var screen_width = window.innerWidth;
        var screen_height = window.innerHeight;

        if (screen_width > 700) {
            setTimeout(function() {$('.fa-bars:eq(0)').click();}, 500);
            $('#modal_view .modal-dialog').css('max-width','60%');
        }else{
            $('#modal_view .modal-dialog').css('max-width','98%');
        }
    }

// Show Scroll Body
    function show_scroll() {
        $('html, body').css('overflow', '');
    }

// Hide Scroll Body
    function hide_scroll() {
        $('html, body').css('overflow', 'hidden');
    }

// Buka Modal BMI
    function bmi_history(str) {
        var dt_kary = <?php echo json_encode($kary); ?>;
        var tbl_bmi = <?php echo json_encode($tbl_bmi->result_array()); ?>;
        if (dt_kary == null) {return;}

        $('#tbl_history').DataTable().destroy();
        $('#tbl_history tbody tr').remove();
        for (var i=0; i<dt_kary.length; i++) {
            tgl = format_date(dt_kary[i].TANGGAL);
            tinggi = Number(dt_kary[i].TINGGI).toFixed(2);
            berat = Number(dt_kary[i].BERAT).toFixed(2);
            bmi = ((berat - 0.7) / (tinggi * tinggi)).toFixed(2);
            result = '';

            tbl_bmi.forEach(function(item) {
                if (Number(bmi) >= Number(item.MIN) && Number(bmi) <= Number(item.MAX)) {
                    result = item.RESULT;
                }
                result_end = item.RESULT;
            });
            if (result == '') {result = result_end;}

            $('#tbl_history tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+tgl+'</td><td align="center">'+tinggi+'</td><td align="center">'+berat+'</td><td align="center">'+bmi+'</td><td>'+result+'</td></tr>')
        }

        if (str == 'history') {
            $('.history').show();
            $('.table_bmi').hide();
        }else{
            $('.history').hide();
            $('.table_bmi').show();        
        }

        $('#btn_bmi').click();
        pagination();
    }

// Pagination
    function pagination() { 
        $('#tbl_history').DataTable().destroy();
        var data_table = $('#tbl_history').DataTable({
            "paging": false,
            "lengthChange": false,
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true,
            "columnDefs": [{"orderable": false,"targets": "_all"}],
            "order": []
        });

        setTimeout(function() {data_table.columns.adjust().draw();}, 1000);
    }

// Isi Data BMI
    function isi_bmi() {
        var f_target = $('#f_target').val();
        var tbl_input = document.getElementById('tbl_input');
        var dt_kary = <?php echo json_encode($kary); ?>;
        var tbl_bmi = <?php echo json_encode($tbl_bmi->result_array()); ?>;

        if (dt_kary == null || dt_kary.length == 0) {return;}

        var tanggal = dt_kary[0].TANGGAL;
        var nama = dt_kary[0].NAMA;
        var tinggi = dt_kary[0].TINGGI;
        var berat = Number(dt_kary[0].BERAT).toFixed(2);
        var bmi = ((berat - 0.7) / (tinggi * tinggi)).toFixed(2);
        var result = '', t_max = 0, t_min = 0, t_target = 0;

        tbl_bmi.forEach(function(item) {
            if (Number(bmi) >= Number(item.MIN) && Number(bmi) <= Number(item.MAX)) {
                result = item.RESULT;
            }
            result_end = item.RESULT;

            if (f_target == item.RESULT) {
                t_max = item.MAX;
                t_min = item.MIN;
                t_target = bmi >= t_max ? t_max : t_min;
            }
        });
        if (result == '') {result = result_end;}

        target_berat = ((t_target * (tinggi * tinggi)) + 0.7).toFixed(2);
        kurang_lebih = target_berat >= berat ? target_berat - berat : berat - target_berat;
        t_kurang_lebih = target_berat >= berat ? "Kurang" : "Kelebihan";

        tbl_input.rows[0].cells[1].innerHTML = nama;
        tbl_input.rows[1].cells[1].innerHTML = tinggi * 100 + ' Cm';
        tbl_input.rows[2].cells[1].innerHTML = berat + ' Kg';
        tbl_input.rows[3].cells[1].innerHTML = bmi;
        tbl_input.rows[4].cells[1].innerHTML = result;
        tbl_input.rows[6].cells[1].innerHTML = result == f_target ? '-' : target_berat + ' Kg';
        tbl_input.rows[7].cells[0].innerHTML = t_kurang_lebih;
        tbl_input.rows[7].cells[1].innerHTML = result == f_target ? '0' : kurang_lebih.toFixed(2) + ' Kg';
    }

</script>