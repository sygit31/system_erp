<?php $this->load->view('dashboard/header'); ?>

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
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/chartjs-plugin-annotation.min.js"></script>

<style>

    .fade-in {
        position: absolute;
        width: 100%;
        object-fit: cover;
        opacity: 0;
        transition: opacity 0.6s ease;
        max-height: 0;
        overflow: hidden;
    }

    .fade-in.show {
        max-height: 100vh;
        opacity: 1;
    }

    .floating-div {
        position: fixed;
        top: 15px;
        right: 15px;
        z-index: 9999;
        background-color: rgba(0, 123, 255, 0.3);
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 1px 1px 1px rgba(233, 240, 50, 1);
        width: 240px;
        height: 60px;
        cursor: move;
    }

    .select2-container--open {
        z-index: 9999999;
    }

</style>

<div class="card fade-in show" style="height: 100vh; overflow-y: auto; overflow-x: hidden;">
    <div class="card-body">
        <div class="card-footer bg-warning text-center font-weight-bold mb-2"><h2>GRAFIK KUALITAS</h2></div>
        <div class="card card-body chart_kualitas"></div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="optradio" onclick="filter_k()" style="cursor: pointer;" checked><label class="form-check-label">ALL</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="optradio" onclick="filter_k()" style="cursor: pointer;"><label class="form-check-label">SERI I</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="optradio" onclick="filter_k()" style="cursor: pointer;"><label class="form-check-label">SERI II</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="optradio" onclick="filter_k()" style="cursor: pointer;"><label class="form-check-label">SERI III</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="optradio" onclick="filter_k()" style="cursor: pointer;"><label class="form-check-label">MMEA</label>
            </div>
        </div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <input id="f_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter_k()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
            <div style="width: 10px;"></div>
            <input id="f_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_k()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
        </div>
    </div>
</div>

<div class="card fade-in" style="height: 100vh; overflow-y: auto; overflow-x: hidden;">
    <div class="card-body">
        <div class="card-footer bg-warning text-center font-weight-bold mb-2"><h2>MONITORING GSM MEDIUM</h2></div>
        <div class="card card-body chart_medium"></div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="m_optradio" onclick="filter_m()" style="cursor: pointer;" checked><label class="form-check-label">ALL</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="m_optradio" onclick="filter_m()" style="cursor: pointer;"><label class="form-check-label">Station 1</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="m_optradio" onclick="filter_m()" style="cursor: pointer;"><label class="form-check-label">Station 2</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="m_optradio" onclick="filter_m()" style="cursor: pointer;"><label class="form-check-label">Station 3</label>
            </div>
        </div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <input id="m_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-10 days')); ?>" onchange="filter_m()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
            <div style="width: 10px;"></div>
            <input id="m_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_m()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
        </div>
    </div>
</div>

<div class="card fade-in" style="height: 100vh; overflow-y: auto; overflow-x: hidden;">
    <div class="card-body">
        <div class="card-footer bg-warning text-center font-weight-bold mb-2"><h2>MONITORING RH KERTAS</h2></div>
        <div class="card card-body chart_rh"></div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio" onclick="filter_r()" style="cursor: pointer;" checked><label class="form-check-label">ALL</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio" onclick="filter_r()" style="cursor: pointer;"><label class="form-check-label">Uk. 73</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio" onclick="filter_r()" style="cursor: pointer;"><label class="form-check-label">Uk. 52,5</label>
            </div>
        </div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio_posisi" onclick="filter_r()" style="cursor: pointer;" checked><label class="form-check-label">ALL</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio_posisi" onclick="filter_r()" style="cursor: pointer;"><label class="form-check-label">Awal</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio_posisi" onclick="filter_r()" style="cursor: pointer;"><label class="form-check-label">Tengah</label>
            </div>
            <div class="form-check mr-5">
                <input type="radio" class="form-check-input" name="k_optradio_posisi" onclick="filter_r()" style="cursor: pointer;"><label class="form-check-label">Akhir</label>
            </div>
        </div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <input id="k_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-15 days')); ?>" onchange="filter_r()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
            <div style="width: 10px;"></div>
            <input id="k_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_r()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
        </div>
    </div>
</div>

<div class="card fade-in" style="height: 100vh; overflow-y: auto; overflow-x: hidden;">
    <div class="card-body">
        <div class="card-footer bg-warning text-center font-weight-bold mb-2"><h2>MONITORING WASTE FINISHING</h2></div>
        <div class="card card-body chart_waste"></div>

        <div class="card-footer text-success font-weight-bold d-flex justify-content-center">
            <input id="s_tgl1" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-10 days')); ?>" onchange="filter_s()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
            <div style="width: 10px;"></div>
            <input id="s_tgl2" type="text" class="form-control datepicker text-center" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter_s()" style="max-width: 150px; background-color: white; cursor: pointer;" readonly>
        </div>
    </div>
</div>

<div class="card fade-in">
    <div class="card-body">
        <div class="card-footer bg-warning text-center font-weight-bold mb-2"><h2>QUALITY AWARENESS</h2></div>

        <div id="demo" class="carousel slide" data-ride="carousel">

            <ul class="carousel-indicators">
                <?php for ($i=0; $i<count($komplain); $i++) { ?>
                    <li data-target="#demo" data-slide-to="<?php echo $i; ?>" class="<?php if ($i == 0) {echo 'active';} ?>"></li>
                <?php } ?>
            </ul>

            <div class="carousel-inner">
                <?php for ($i=0; $i<count($komplain); $i++) { ?>
                    <div class="carousel-item <?php if ($i == 0) {echo 'active';} ?>">
                        <div class="row">
                            <div class="col-md-7 mb-3 text-center">
                                <img src="<?php echo base_url() . 'assets\images\qc\awareness\\' . $komplain[$i]['ID'] . ".jpg"; ?>" class="img-thumbnail" style="height: 83vh; max-height: 85vh; width: 100%;">
                            </div>
                            <div class="card bg-secondary col-md-5 p-3" style="height: 83vh; font-size: 22px; overflow-y: scroll;">
                                <h4>Problem</h4>
                                <div class="container">
                                    <ul class="fa-ul">
                                        <li><span class="fa-li"><i class="fa fa-check-circle"></i></span><?php echo $komplain[$i]['PROBLEM']; ?></li>
                                    </ul>
                                </div>

                                <hr class="border border-white mr-3">

                                <h4>Root Cause</h4>
                                <div class="container">
                                    <ul class="fa-ul">
                                        <?php $dt_root = explode("\n", $komplain[$i]['ROOT_CAUSE']); ?>
                                        <?php foreach ($dt_root as $dt) { ?>
                                            <li><span class="fa-li"><i class="fa fa-check-circle"></i></span><?php echo $dt; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>

                                <hr class="border border-white mr-3">

                                <h4>Preventive Action</h4>
                                <div class="container">
                                    <ul class="fa-ul">
                                        <?php $dt_prevent = explode("\n", $komplain[$i]['PREVENTIVE']); ?>
                                        <?php foreach ($dt_prevent as $dt) { ?>
                                            <li><span class="fa-li"><i class="fa fa-check-circle"></i></span><?php echo $dt; ?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <a class="carousel-control-prev" href="#demo" data-slide="prev" style="left: -100px;">
                <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next" style="right: -100px;">
                <span class="carousel-control-next-icon"></span>
            </a>
        </div>
    </div>
</div>

<div class="main-floating">
    <div class="floating-div text-center">
        <button id="play-btn" class="btn btn-secondary btn-sm" onclick="auto_no(); filter_komplain();" title="Update Komplain" data-toggle="modal" data-target="#modal_komplain" data-backdrop="static" data-keyboard="false"><i class="fa fa-users"></i></button>
        <button id="play-btn" class="btn btn-secondary btn-sm" onclick="openFullscreen()" title="Fullscreen"><i class="fa fa-columns"></i></button>
        <button id="play-btn" class="btn btn-secondary btn-sm" onclick="nextInterval('prev')" title="Previous Screen"><i class="fa fa-arrow-left"></i></button>
        <button id="play-btn" class="btn btn-secondary btn-sm" onclick="nextInterval('next')" title="Next Screen"><i class="fa fa-arrow-right"></i></button>
        <button id="play-btn" class="btn btn-secondary btn-sm" onclick="startInterval('play')" title="Play Screen"><i class="fa fa-play"></i></button>
        <button id="stop-btn" class="btn btn-secondary btn-sm" onclick="startInterval('stop')" title="Stop Screen"><i class="fa fa-pause"></i></button>
    </div>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress" style="top: 30%;">
    <div class="modal-dialog modal-lg text-center" style="font-size: 40px; color: #FFF; font-weight: bold;">
        <div><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i></div>
        <div class="modal-footer" hidden>
            <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
            <button id="btnProgress" data-toggle="modal" data-target="#modal_progress"></button>
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

<!-- Modal Komplain -->
<div class="modal fade" id="modal_komplain">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="card-header bg-warning rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center">Update Komplain</h4></b>
            </div>
            <div class="card card-body mr-2 ml-2" style="font-size: 16px; overflow-x: hidden;">
                <table width="100%">
                    <tr>
                        <th width="35%">Desain</th>
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
                        <th>Nomor</th>
                        <td>
                            <input type="number" id="nmr" name="" class="form-control" value="000" maxlength="3" onfocusout="isi_nomor(this, 3)" autocomplete="off">
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
                        <th>Problem</th>
                        <td>
                            <textarea id="problem" class="form-control" rows="4" style="width: 100%;" maxlength="1000" autocomplete="off"></textarea>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Root Cause</th>
                        <td>
                            <textarea id="root_cause" class="form-control" rows="4" style="width: 100%;" maxlength="1000" autocomplete="off"></textarea>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Preventive</th>
                        <td>
                            <textarea id="preventive" class="form-control" rows="4" style="width: 100%;" maxlength="1000" autocomplete="off"></textarea>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Foto</th>
                        <td>
                            <div style="max-width: 450px; text-align: center;">
                                <input type="image" src="<?php echo base_url() . 'images/no_preview.jpg'; ?>" id="img" alt="Preview" class="img-responsive img-thumbnail" style="object-fit: cover; height: 200px;">
                                <div class="d-flex justify-content-center">
                                    <input type="file" id="file" onchange="open_file(this)" hidden>
                                    <a href="javascript:$('#file').click();" title="Upload File"><h3 class="text-secondary mr-3"><i class="fa fa-upload mr-2"></i></h3></a>
                                    <a href="javascript:del_file();" title="Hapus File"><h3 class="text-secondary"><i class="fa fa-trash mr-2"></i></h3></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                </table>
            </div>
            <div class="card-footer text-center">
                <button type="button" class="btn btn-success" onclick="simpan()" data-dismiss="modal" style="width: 150px;"><i class="fa fa-save mr-2"></i><b>Simpan</b></button>
                <button type="button" class="btn btn-danger btn_close" data-dismiss="modal" style="width: 150px;"><i class="fa fa-close mr-2"></i><b>Keluar</b></button>
            </div>
            <div class="card card-body mr-2 ml-2" style="font-size: 16px; overflow-x: hidden;">
                <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                    <table class="tbl_filter" style="width: 150px;">
                        <thead>
                            <tr align="center" style="line-height: 30px;">
                                <th class="bg-warning">Desain</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="select_min" id="f_desain" onchange="filter_komplain()" style="width: 100%;">
                                        <?php foreach ($desain as $dt) { ?>
                                            <option><?php echo $dt['DESAIN']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tbl mt-2" style="width: 100%; font-size: 13px;">
                    <table id="tbl" class="table table-bordered table-striped" style="width: 100%;">
                        <thead class="text-center">
                            <tr>
                                <th>No.</th>
                                <th>Desain</th>
                                <th>Nomor Urut</th>
                                <th>Tanggal</th>
                                <th>Problem</th>
                                <th>Root Cause</th>
                                <th>Preventive</th>
                                <th>Edit</th>
                                <th>Hapus</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=3"></script>

<script>

// Defined Variable
    var dir = <?php echo json_encode(base_url()); ?>;
    var no_img = dir + 'images/no_preview.jpg';
    var run_interval;
    var interval_dashboard = 600000, interval_komplain = 120000;

// Load Dokumen
    $(document).ready(function() {
        $('.datepicker').datepicker({dateFormat: 'dd-M-yy'});

        filter_k();
        startInterval('play');
        $('#demo').attr('data-interval', interval_komplain);
    });

// Play Interval Slide
    function startInterval(str) {
        if (str == 'play') {
            run_interval = setInterval(() => {
                nextInterval('next');

                const now = new Date();
                const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                const day = String(now.getDate()).padStart(2, '0');
                const month = monthNames[now.getMonth()]; 
                const year = now.getFullYear();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');
                const formattedCurrentTime = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;

                console.log(formattedCurrentTime);
            }, interval_dashboard);
        }else{
            clearInterval(run_interval);
        }
    }

// Change Slide
    function nextInterval(str) {
        var qty_slide = $('.fade-in').length;
        
        for (var i=0; i<qty_slide; i++) {
            slideShow = $('.fade-in:eq('+i+')').hasClass('show');

            if (slideShow == true) {
                activeSlide = i;
            }
        }

        if (str == 'next') {
            nextSlide = activeSlide == qty_slide - 1 ? 0 : activeSlide + 1;
        }else{
            nextSlide = activeSlide == 0 ? qty_slide - 1 : activeSlide - 1;              
        }

        if (nextSlide == '0') {filter_k();}
        if (nextSlide == '1') {filter_m();}
        if (nextSlide == '2') {filter_r();}
        if (nextSlide == '3') {filter_s();}

        $('.fade-in:eq('+activeSlide+')').removeClass('show');
        $('.fade-in:eq('+nextSlide+')').addClass('show');
    }

// Filter Data
    function filter_k() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var seri = $('input[name="optradio"]:checked').index('.form-check-input');
        var data = [tgl1, tgl2, seri];

        $('.card').animate({ scrollTop: 0 }, 500);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/filter_k" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    setTimeout(function() {
                        $('#btnOk').click();
                        chart_k(data);
                    }, 500);
                }
            }); 
        }, 500);
    }

// Isi Chart Waste
    function chart_k(data) {
        var xValues = [], yValues = [], barColors = ['#FE0202','#E7EE1F','#240EFA','#0C0000','#C0BABA','#FCB723','#42FA87','#CA08A3','#EDF665','#699B97','#CCDFED','#562929','#F88C8C','#76F44F','#BCF7F1','#545FF4','#B77C7C','#FAE7AD','#2C756A','#FF50E0', '#FF0012', '#FCFF00', '#1EF532'];

        data.forEach(function(dt) {
            t_waste = dt.TOTAL_QTY;
            waste = (Number(dt.QTY) / Number(t_waste) * 100).toFixed(1);

            xValues.push(dt.KD_REJECT);
            yValues.push(waste);
        });

        max_y = Math.ceil((Number(calc_avg(yValues)[1]) + 0.0001)/10) * 10;

        $('.chart_kualitas').html('');
        $('.chart_kualitas').append('<canvas id="chart_kualitas" style="max-height: 600px;"></canvas>');
        ctx = new Chart("chart_kualitas", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {display: false},
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 30,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 24,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                            min: 0,
                            max: max_y,
                            stepSize: 10,
                            callback: function (value, index, ticks) {
                                return value + '%';
                            }
                        }
                    }]
                }
            }
        });
    }

// Filter Data Medium
    function filter_m() {
        var tgl1 = $('#m_tgl1').val();
        var tgl2 = $('#m_tgl2').val();
        var station = $('input[name="m_optradio"]:checked').index('[name="m_optradio"]');
        var data = [tgl1, tgl2, station];

        $('.card').animate({ scrollTop: 0 }, 500);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/filter_m" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    setTimeout(function() {
                        $('#btnOk').click();
                        chart_m(data, station);
                    }, 500);
                }
            }); 
        }, 500);
    }

// Isi Chart Medium
    function chart_m(data, station) {
        var xValues = [], yValues_qc = [], yValues_pr = [];

        dt_gsm_prod = [[], [], [], []];
        data.forEach(function(dt) {
            gsm_bahan = dt.METER_SIMPG == null || dt.KG_BAHAN == null ? 0 : ((dt.KG_BAHAN.replaceAll(',', '.') * 1000) * 35 / 100) / (dt.METER_SIMPG * 0.75);
            gsm_gw = dt.METER_SIMPG == null || dt.KG_GW == null ? 0 : ((dt.KG_GW.replaceAll(',', '.') * 1000) * 35 / 100) / (dt.METER_SIMPG * 0.75);
            gsm_ej = dt.METER_SIMPG == null || dt.KG_EJ == null ? 0 : ((dt.KG_EJ.replaceAll(',', '.') * 1000) * 35 / 100) / (dt.METER_SIMPG * 0.75);
            gsm_rd = dt.METER_SIMPG == null || dt.KG_RD == null ? 0 : ((dt.KG_RD.replaceAll(',', '.') * 1000) * 35 / 100) / (dt.METER_SIMPG * 0.75);

            gsm_qc = dt.GSM_QC == null ? 0 : dt.GSM_QC.replaceAll(',', '.');
            gsm_1 = dt.GSM_1 == null ? 0 : dt.GSM_1.replaceAll(',', '.');
            gsm_2 = dt.GSM_2 == null ? 0 : dt.GSM_2.replaceAll(',', '.');
            gsm_3 = dt.GSM_3 == null ? 0 : dt.GSM_3.replaceAll(',', '.');

            gsm_prod = station == 0 ? gsm_bahan : (station == 1 ? gsm_gw : (station == 2 ? gsm_rd : gsm_ej));
            gsm_qc = station == 0 ? gsm_qc : (station == 1 ? gsm_1 : (station == 2 ? gsm_2 : gsm_3));

            dt_gsm_prod[0].push(Number(gsm_bahan) + 0.1);
            dt_gsm_prod[1].push(Number(gsm_gw) + 0.1);
            dt_gsm_prod[3].push(Number(gsm_ej) + 0.1);
            dt_gsm_prod[2].push(Number(gsm_rd) + 0.1);

            xValues.push(format_tgl(dt.TGL));
            yValues_qc.push(Number(gsm_qc).toFixed(2));
            yValues_pr.push(Number(gsm_prod).toFixed(2));
        });

        v_min = station == 0 ? 2.0 : (station == 1 ? 0.6 : (station == 2 ? 0.1 : 0.8));
        v_max = station == 0 ? 2.8 : (station == 1 ? 1.3 : (station == 2 ? 0.5 : 1.5));
        v_max = station == 0 ? Number(calc_avg(dt_gsm_prod[0])[1]) : (station == 1 ? Number(calc_avg(dt_gsm_prod[1])[1]) : (station == 2 ? Number(calc_avg(dt_gsm_prod[2])[1]) : Number(calc_avg(dt_gsm_prod[3])[1])));

        v_target_max = station == 0 ? 2.7 : (station == 1 ? 1 : (station == 2 ? 0.4 : 1.3));
        v_target_min = station == 0 ? 2.2 : (station == 1 ? 0.9 : (station == 2 ? 0.3 : 1.0));

        v_max = v_max + 0.2;

        $('.chart_medium').html('');
        $('.chart_medium').append('<canvas id="chart_medium" style="max-height: 600px;"></canvas>');
        ctx = new Chart("chart_medium", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [
                    {
                        backgroundColor: "#0FCF00",
                        data: yValues_qc,
                        label: "Data QC"
                    },
                    {
                        backgroundColor: "#FF0101",
                        data: yValues_pr,
                        label: "Data Produksi"
                    },
                ]
            },
            options: {
                annotation: {
                    annotations: [
                        {
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: v_target_max,
                            borderColor: 'red',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            label: {
                                content: "Max",
                                enabled: true,
                                position: "right",
                                backgroundColor: 'rgba(255, 0, 0, 0.7)',
                                font: {style: 'bold'}
                            }
                        },
                        {
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: v_target_min,
                            borderColor: 'red',
                            borderWidth: 2,
                            borderDash: [5, 5],
                            label: {
                                content: "Min",
                                enabled: true,
                                position: "right",
                                backgroundColor: 'rgba(255, 0, 0, 0.7)',
                                font: {style: 'bold'}
                            }
                        },
                    ]
                },
                legend: {
                    display: true,
                    labels: {
                        padding: 10,
                        fontSize: 24,
                        fontFamily: 'Arial',
                        fontStyle: 'bold'
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 24,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 22,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                            min: v_min,
                            max: v_max,
                            stepSize: 0.1,
                            callback: function(value, index, values) {
                                return value.toFixed(1);
                            }
                        }
                    }]
                },
                layout: {
                    padding: {
                        bottom: 5,
                    }
                },
            }
        });
    }

// Filter Data RH
    function filter_r() {
        var tgl1 = $('#k_tgl1').val();
        var tgl2 = $('#k_tgl2').val();
        var seri = $('input[name="k_optradio"]:checked').index('[name="k_optradio"]');
        var ukuran = seri == 0 ? 'All' : (seri == 1 ? 'A' : 'B');
        var data = [tgl1, tgl2, ukuran];

        $('.card').animate({ scrollTop: 0 }, 500);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/filter_r" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    setTimeout(function() {
                        $('#btnOk').click();
                        chart_r(data);
                    }, 500);
                }
            }); 
        }, 500);
    }

// Isi Chart RH
    function chart_r(data) {
        var posisi = $('input[name="k_optradio_posisi"]:checked').index('[name="k_optradio_posisi"]');
        var xValues = [], yValues = [], yValues_min = [], yValues_max = [];

        data.forEach(function(dt) {
            qty_target = posisi == 0 ? Number(dt.QTY_A1) + Number(dt.QTY_T1) + Number(dt.QTY_R1) : (posisi == 1 ? Number(dt.QTY_A1) : (posisi == 2 ? Number(dt.QTY_T1) : Number(dt.QTY_R1)));
            qty_min = posisi == 0 ? Number(dt.QTY_A2) + Number(dt.QTY_T2) + Number(dt.QTY_R2) : (posisi == 1 ? Number(dt.QTY_A2) : (posisi == 2 ? Number(dt.QTY_T2) : Number(dt.QTY_R2)));
            qty_max = posisi == 0 ? Number(dt.QTY_A3) + Number(dt.QTY_T3) + Number(dt.QTY_R3) : (posisi == 1 ? Number(dt.QTY_A3) : (posisi == 2 ? Number(dt.QTY_T3) : Number(dt.QTY_R3)));
            qty_rh = qty_target + qty_min + qty_max;

            xValues.push(format_tgl(dt.TGL));
            yValues.push((qty_target / qty_rh * 100).toFixed(2));
            yValues_min.push((qty_min / qty_rh * 100).toFixed(2));
            yValues_max.push((qty_max / qty_rh * 100).toFixed(2));
        });

        v_min = 0;
        v_max = 100;

        $('.chart_rh').html('');
        $('.chart_rh').append('<canvas id="chart_rh" style="max-height: 600px;"></canvas>');
        ctx = new Chart("chart_rh", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [
                    {
                        backgroundColor: "#0FCF00",
                        data: yValues,
                        label: "RH 40-58%"
                    },
                    {
                        backgroundColor: "#FF0101",
                        data: yValues_min,
                        label: "RH <40%"
                    },
                    {
                        backgroundColor: "#617EFB",
                        data: yValues_max,
                        label: "RH >58%"
                    },
                ]
            },
            options: {
                legend: {
                    display: true,
                    labels: {
                        padding: 10,
                        fontSize: 24,
                        fontFamily: 'Arial',
                        fontStyle: 'bold'
                    }
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 24,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            fontSize: 22,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                            min: v_min,
                            max: v_max,
                            stepSize: 10,
                            callback: function(value, index, values) {
                                return value.toFixed(0) + '%';
                            }
                        }
                    }]
                },
                layout: {
                    padding: {
                        top: 5
                    }
                },
            }
        });
    }

// Filter Data Waste
    function filter_s() {
        var tgl1 = $('#s_tgl1').val();
        var tgl2 = $('#s_tgl2').val();
        var data = [tgl1, tgl2];

        $('.card').animate({ scrollTop: 0 }, 500);
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/filter_s" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    setTimeout(function() {
                        $('#btnOk').click();
                        chart_w(data);
                    }, 500);
                }
            }); 
        }, 500);
    }

// Isi Chart Medium
    function chart_w(data) {
        var xValues = [], yValues = [];

        data.forEach(function(dt) {
            p_waste = (dt.RUSAK/dt.BAIK*100);

            xValues.push(format_tgl(dt.TGL));
            yValues.push(p_waste.toFixed(2));
        });

        $('.chart_waste').html('');
        $('.chart_waste').append('<canvas id="chart_waste" style="max-height: 600px;"></canvas>');
        ctx = new Chart("chart_waste", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    data: yValues,
                    backgroundColor: '#D4FF3F'
                }]
            },
            options: {
                annotation: {
                    annotations: [
                        {
                            type: 'line',
                            mode: 'horizontal',
                            scaleID: 'y-axis-0',
                            value: 3,
                            borderColor: 'red',
                            borderWidth: 3,
                            borderDash: [5, 5],
                            label: {
                                content: "Max",
                                enabled: true,
                                position: "right",
                                backgroundColor: 'rgba(255, 0, 0, 0.7)',
                                font: {style: 'bold'}
                            }
                        }
                    ]
                },
                legend: {display: false},
                scales: {
                    xAxes: [{
                        ticks: {
                            fontSize: 20,
                            fontFamily: 'Arial',
                            fontStyle: 'bold'
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: '#ACE7FF'
                        },
                        ticks: {
                            fontSize: 20,
                            fontFamily: 'Arial',
                            fontStyle: 'bold',
                            min: 0,
                            callback: function (value, index, ticks) {
                                return value + '%';
                            }
                        }
                    }]
                }
            }
        });
    }

// Format Tanggal DD-MMM
    function format_tgl(date) {
        try {
            var tgl = date.substring(0, 2);
            var month = parseInt(date.substring(3, 5)) - 1;

            var bln = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var bln = bln[month];
            return tgl + '-' + bln;
        } catch (err) {}
    }

// Drag Div Play
    $(".floating-div").draggable();

// Isi Daftar Komplain
    function filter_komplain() {
        var desain = $('#f_desain').val();

        $('.tbl').hide();
        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        setTimeout(function() {
            $.ajax({
                async: false,
                type: 'POST',
                data: {data: desain},
                url: '<?php echo base_url()."index.php/qc/Dashboard/filter_komplain" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    for (var i=0; i<data.length; i++) {
                        $('#tbl tbody').append('<tr align="center"><td>'+(i+1)+'</td><td>'+data[i].DESAIN+'</td><td>'+data[i].NMR+'</td><td>'+format_date(data[i].TGL)+'</td><td align="left"><div style="width: 80px;">'+data[i].PROBLEM+'</div></td><td align="left"><div style="width: 250px;">- '+data[i].ROOT_CAUSE.replaceAll('\n', '<br>- ')+'</div></td><td align="left"><div style="width: 250px;">- '+data[i].PREVENTIVE.replaceAll('\n', '<br>- ')+'</div></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" name="'+data[i].ID+'" title="Hapus Data" onclick="hapus(this)" data-dismiss="modal"><i class="fa fa-trash"></i></button></td></tr>');
                    }

                    setTimeout(function() {page('tbl'); $('.tbl').show();}, 500);
                }
            }); 
        }, 500);
    }

// Auto Nomor
    function auto_no() {
        var id_edit =$('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var data = [id_edit, tgl];

        $.ajax({
            async: false,
            type: 'POST',
            data: {data: data},
            url: '<?php echo base_url()."index.php/qc/Dashboard/auto_no" ?>',
            success: function(data) {
                data = JSON.parse(data);
                $('#nmr').val(data);
            }
        });
    }   

// Isi Format Nomor 3 atau 6 angka
    function isi_nomor(btn, num) {
        var nmr = btn.value;
        var nmr = nmr.toString().padStart(num, "0");
        var nmr = nmr.substring(0, num);

        btn.value = nmr;
    }

// Pilih File Foto
    function open_file(btn) {
        var allow_extension = ['JPG','JPEG','PNG'];
        var reader = new FileReader();
        var file = $('#file').get(0).files[0];
        var filename = (file['name']).split('.');
        var extension = filename[filename.length-1];
        var size = file.size;

        if (size > 5000000) {del_file(); error_isian('Max. Ukuran File 5 Mb..');}
        if (allow_extension.indexOf(extension.toUpperCase()) != -1) {
            reader.onload = function(e) {
                gambar = $('#img')[0];
                gambar.setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }else{
            del_file();
            error_isian('Format gambar harus JPG, JPEG, PNG..');
        }
    }

// Hapus Preview Foto
    function del_file() {
        document.getElementById('file').value = '';
        $('#img')[0].setAttribute('src', no_img);
    }

// Error Isian
    function error_isian(str) {
        $('#btnOk').click();
        $('#error_isian').removeClass('invisible');
        $('#error_isian').html(str);
        $('#btnIsian').click();
        throw new Error("Isian salah..");
    }

// Batal Isian
    function kosong() {
        $('#nmr').attr('name', '');
        $('#problem').val('');
        $('#root_cause').val('');
        $('#preventive').val('');

        del_file();
        auto_no();
    }

// Simpan Data
    function simpan() {
        var form_data = new FormData();
        var img = $('#img')[0].src;
        var img = img.includes('no_preview') == true ? 'no_preview' : '';
        var file = $('#file').get(0).files[0];

        var id_edit = $('#nmr').attr('name');
        var desain = $('#desain').val();
        var nmr = $('#nmr').val();
        var tgl = $('#tgl').val();
        var problem = huruf($('#problem').val());
        var root_cause = huruf($('#root_cause').val());
        var preventive = huruf($('#preventive').val());
        var data = [id_edit, desain, nmr, tgl, problem, root_cause, preventive, img];

        if (nmr == '000') {error_isian('Nomor urut belum diisi..');}
        if (problem == '') {error_isian('Problem belum diisi..');}
        if (root_cause == '') {error_isian('Root Cause belum diisi..');}
        if (preventive == '') {error_isian('Preventive belum diisi..');}
        if (img == 'no_preview') {error_isian('Foto belum diisi..');}

        form_data.append('data', JSON.stringify(data));
        file == undefined ? form_data.append('file','') : form_data.append('file',file);

        $('#btn_progress').click();
        setTimeout(function() {
            $.ajax({
                async: false,
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/simpan" ?>',
                data: form_data,
                contentType: false,
                processData: false,
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        kosong();
                    }, 500);
                }
            });
        }, 500);
    }

// Proses Edit Data
    function edit(btn) {
        var path = dir + 'assets/images/qc/awareness/';
        var rand = new Date();
        var id_edit = btn.name;

        $('#btn_progress').click();
        setTimeout(function() {
            $.ajax({
                async: false,
                type: 'POST',
                url: '<?php echo base_url()."index.php/qc/Dashboard/edit" ?>',
                data: {data: id_edit},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#nmr').attr('name', id_edit);
                    $('#desain').val(data.DESAIN);
                    $('#nmr').val(data.NMR);
                    $('#tgl').val(format_date(data.TGL));
                    $('#problem').val(data.PROBLEM.replaceAll('\n', '<br>'));
                    $('#root_cause').val(data.ROOT_CAUSE.replaceAll('\n', '<br>'));
                    $('#preventive').val(data.PREVENTIVE.replaceAll('\n', '<br>'));

                    $('#img')[0].setAttribute('src', path + id_edit + '.jpg?=' + rand);
                    $('#img').on('error', function() {
                        $(this).on('error', null);
                        $(this).attr('src', no_img);
                    });

                    $('html, body').animate({scrollTop: 0}, 500);
                    setTimeout(function() {$('#btnOk').click();}, 500);
                }
            });
        }, 500);
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
                url: '<?php echo base_url()."index.php/qc/Dashboard/hapus" ?>',
                data: {data: id_hapus},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
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

</script>