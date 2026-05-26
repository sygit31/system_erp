

<?php
$this->load->view('dashboard/header'); 
// $this->load->view('dashboard/topbar');
// $this->load->view('dashboard/sidebar'); 
// $this->load->view('dashboard/footer'); 
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

<!-- Barcode Creator -->
<script src="<?php echo base_url(); ?>assets/js/JsBarcode.all.min.js"></script>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Proses Sheet Cutter</font></b>
                </h3>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 14px; overflow-y: hidden;">
                            <table style="width: 250px; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td colspan="2" class="filter">Filter Tanggal</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" id="fTgl1" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                        <td><input type="text" id="fTgl2" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                    </tbody>
                                </table>

                                <div class="data-table" style="overflow-x: auto;"></div>

                                <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>

            </div>
        </div>

    </section>
</div>

<div id="printable" style="display: none;">
    <div class="pl-5" style="position: absolute;"><svg id="barcode" style="width: 70%; margin-top: -50px;"></svg></div>
    <div id="pp_cutter" style="position: absolute; left: 45%; top: 8%;"></div>
    <div style="padding-top: 15px; padding-right: 60px; padding-left: 100px; font-weight: bold;">
        <table id="tbl_header" class="table table-borderless" style="line-height: 10px; font-size: 24px;">
            <tr style="height: 40px;">
                <td></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="5%"></td>
                <td width="40%"></td>
                <td width="10%"></td>
                <td width="5%"></td>
                <td width="25%"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>104 x 72</td>
                <td></td>
                <td></td>
                <td align="right"></td>
            </tr>
        </table>
        <table id="tbl_body" class="table table-borderless">
            <tr class="text-center text-white">
                <td colspan="2" width="20%"></td>
                <td rowspan="2" width="15%"></td>
                <td rowspan="2" width="15%"></td>
                <td rowspan="2" width="20%"></td>
                <td rowspan="2" width="15%"></td>
                <td rowspan="2" width="15%"></td>
            </tr>
            <tr class="text-center">
                <td></td>
                <td></td>
            </tr>
            <?php for($i=0; $i<4; $i++) { ?>
                <tr class="text-center" style="line-height: 20px; min-height: 20px; height: 20px; font-size: 24px;">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });

    filter();

    $('#non_printable').removeClass('content-wrapper');
    $('.content').css('margin-top','-20px');
    $('.content').addClass('ml-2 mr-2');
});

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    var data_table = $('#data-table').DataTable({
        "paging": false,
        "lengthChange": false,
        "oLanguage": {"sSearch": "Cari :"},
        "info": false,
        "order": [0, "asc"],
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
            title: 'Data Proses Sheet Cutter'
        }],
        "colReorder": true
    });

    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 1000);
}

// Filter Data Table
function filter() {
    var tgl1 = document.getElementById('fTgl1').value;
    var tgl2 = document.getElementById('fTgl2').value;
    var data = [tgl1, tgl2];

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url()."index.php/finishing/barcode/filter" ?>',
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    }); 
}

// Cetak Form
function cetak(btn) {

    // Ambil Data
    var tbl_data = document.getElementById('data-table');
    var tbl_header = document.getElementById('tbl_header');
    var tbl_body = document.getElementById('tbl_body');
    var row = $(btn).closest("tr").index() + 1;
    var pp_cutter = tbl_data.rows[row].cells[1].innerHTML;
    var desain = tbl_data.rows[row].cells[12].innerHTML;
    var pp = tbl_data.rows[row].cells[5].innerHTML;
    var seri = tbl_data.rows[row].cells[6].innerHTML;
    var tgl = tbl_data.rows[row].cells[2].innerHTML;
    var shift = tbl_data.rows[row].cells[3].innerHTML;
    var data = [pp_cutter,desain];

    $('#pp_cutter').html(`<h1><b>${pp_cutter}</b></h1>`);
    tbl_header.rows[1].cells[2].innerHTML = pp;
    tbl_header.rows[2].cells[2].innerHTML = seri;
    tbl_header.rows[1].cells[5].innerHTML = tgl;
    tbl_header.rows[2].cells[5].innerHTML = shift;
    tbl_header.rows[3].cells[5].innerHTML = desain;

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url()."index.php/finishing/barcode/cutter" ?>',
        success: function(data) {
            data = JSON.parse(data);

            for (var i=0; i<data.length; i++) {
                if (i == 0) {tbl_body.rows[2].cells[0].innerHTML = '1';}
                tbl_body.rows[i+2].cells[1].innerHTML = i+1;

                tbl_body.rows[i+2].cells[2].innerHTML = data[i]['NO_ROLL'];
                tbl_body.rows[i+2].cells[3].innerHTML = data[i]['BAIK_SHT'];
                tbl_body.rows[i+2].cells[4].innerHTML = data[i]['BAIK_CUTTER'] + ' - ' + data[i]['BAIK_SHT_TEORI'];
                tbl_body.rows[i+2].cells[5].innerHTML = data[i]['PAKAI_KG'];
            }        
        }
    }); 

    // Cetak Data
    setTimeout(function() {
        var printable = document.getElementById('printable');
        var non_printable = document.getElementById('non_printable');
        JsBarcode("#barcode",pp_cutter+desain, {
            fontSize: 28,
            height:80
        });

        printable.style.display = "";
        non_printable.style.display = "none";

        window.print();

        printable.style.display = "none";
        non_printable.style.display = "";
    },500);
}

</script>