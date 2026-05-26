

<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/footer'); 
$this->load->view('dash/v_reminder_sidebar'); 
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<?php 
$waktu = array();
foreach ($isi_box->result_array() as $dt) {
    $waktu[] = $dt['WAKTU'];
}
?>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="small-box bg-dark">
            <div class="inner text-white text-center">
                <h4>HOLOGRAFI DASHBOARD</h4>
            </div>
            <div class="inner bg-light">
                <div class="div_scroll" id="box_0" style="overflow: hidden;">
                    <img src="<?php echo base_url(); ?>assets/images/dashboard.jpg" width="100%">
                </div>
                <div class="div_scroll" id="box_1" style="display: none;">
                    <?php $this->load->view('dash/v_reminder_produksi'); ?>
                </div>
                <div class="div_scroll" id="box_2" style="display: none; overflow: hidden;">
                    <table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
                        <thead>
                            <tr align="center">
                                <th colspan="8"><h3>DATA IDE DAN GAGASAN</h3></th>
                            </tr>
                        </thead>
                    </table>
                    <?php $this->load->view('sistem/v_ide_table'); ?>
                    <table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
                        <thead>
                            <tr align="center">
                                <th colspan="8"><h3>DATA PROJECT</h3></th>
                            </tr>
                        </thead>
                    </table>
                    <?php $this->load->view('sistem/v_project_table'); ?>
                </div>
                <div class="div_scroll" id="box_3" style="display: none; overflow: hidden;">
                    <?php $this->load->view('dash/v_reminder_pengumuman'); ?>
                </div>
                <div class="div_scroll" id="box_4" style="display: none; overflow: hidden;">
                    <video autoplay id="video" style="position: fixed; right: 0; bottom: 0; min-width: 100%;  min-height: 100%;" controls></video>
                </div>
                <div class="div_scroll" id="box_5" style="display: none; overflow: hidden;">
                    <table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
                        <thead>
                            <tr align="center">
                                <th colspan="8"><h3>DATA PENILAIAN HOLOGRAFI</h3></th>
                            </tr>
                        </thead>
                    </table>
                    <?php $this->load->view('dash/v_reminder_nilai'); ?>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var id_kecil, id_besar, div_scroll, scroll, interval_scroll;
var waktu = <?php echo json_encode($waktu); ?>;

// Resize Document
$(window).resize(function() {
    auto_size();
});

// Load Dokumen
$(document).ready(function() {
    auto_size();

    id_kecil = 0;
    id_besar = 0;
    div_scroll = $('#box_0')[0];;

    $('.content-wrapper:eq(0)').removeClass('content-wrapper');
    $('.content').css('margin-top','-20px');
    $('.content').addClass('ml-2 mr-2');

    auto_scroll();
});

// Auto Size
function auto_size() {
    var screen = $(window).height() - 105;

    for (var i=0; i<$('.div_scroll').length; i++) {
        $('.div_scroll').css('height',screen);
    }
}

// Scroll Otomatis
function auto_scroll() {
    interval_scroll = setInterval(function() {
        if (div_scroll.scrollTop + div_scroll.clientHeight >= div_scroll.scrollHeight) {
            setTimeout(function() {div_scroll.scrollTop = 0; clearInterval(interval_scroll); auto_scroll();},2000);
        }else{
            div_scroll.scrollTop = div_scroll.scrollTop + 1.3;
        }
    },60);
}

// Action Box Kecil
function box(btn) {
    var str = btn.id; id_kecil = str.substring(str.length-1);
    var int_waktu = [waktu[0],waktu[1],waktu[2],waktu[3],waktu[4]];
    var interval = 0;
    
    $('.sidebar:eq(0)').hide(); // Sembunyikan sidebar
    ganti_box(id_kecil); // Ganti content

    setInterval(function() {
        interval++;
        if (interval == int_waktu[id_kecil-1]) {
            id_kecil++;
            if (id_kecil == 6) {id_kecil = 1;}
            interval = 0;
            ganti_box(id_kecil);
        }
    }, 1000);
}

function ganti_box(id_kecil) {
    var box_kecil = document.getElementById('box' + id_kecil);
    var box_besar = $('.small-box:eq(5)');
    var class_kecil = box_kecil.className.split(' ')[1];
    var class_besar = box_besar[0].className.split(' ')[1];

    // Ganti Judul dan Warna
    box_besar.removeClass(class_besar);
    box_besar.addClass(class_kecil);
    box_besar[0].getElementsByTagName('h4')[0].innerText = box_kecil.getElementsByTagName('h5')[0].innerText;

    // Ganti Content
    $('#box_' + id_besar).css('display','none');
    $('#box_' + id_kecil).css('display','block');
    id_besar = id_kecil;

    // Play Video
    var video = document.getElementById("video");
    clearInterval(interval_scroll);
    if (id_kecil == 4) {
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/dash/reminder/video',
            success: function(data) {
                video.src = <?php echo json_encode(base_url()); ?> + "assets/videos/" + data;
            }
        });
        $('.thumbnails:eq(0)').css('display','none');
    }else if (id_kecil == 5) {
        get_nilai();
    }else if (id_kecil == 2) {        
        div_scroll = $('#box_2')[0];
    }else if (id_kecil == 3) {        
        div_scroll = $('#box_3')[0];
    }else{
        chart_scroll();        
    }

    auto_scroll();
}

</script>