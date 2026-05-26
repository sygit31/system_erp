

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<style type="text/css">
    .modal-body {
        max-width: 100%;
        overflow-x: auto;
    }
    .scoll-tree {
        width: 1500px;
    }
</style>

<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Submission</font></b>
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
                            <table style="width: 15%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="100%" class="filter">Jenis</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select id="tipe" class="select" style="width: 100%;">
                                                <option value="">Pilih Tipe..</option>
                                                <option>Budget Submission</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div style="overflow-x: scroll;">
                                <table id="data-table" class="table table-bordered table-striped" width="100%">
                                    <thead style="text-align: center; background-color: #FFFFFF;">
                                        <tr align="center">
                                            <th width="10%" rowspan="2">No.</th>
                                            <th width="10%" rowspan="2">Tipe Pengajuan</th>
                                            <th width="10%" rowspan="2">Nomor</th>
                                            <th width="20%" rowspan="2">Nama Karyawan</th>
                                            <th width="15%" rowspan="2">Bagian</th>
                                            <th width="10%" rowspan="2">Tanggal Pengajuan</th>
                                            <th width="15%" rowspan="2">Total</th>
                                            <th colspan="2">Result</th>
                                            <th rowspan="2"></th>
                                            <th rowspan="2"></th>
                                            <th rowspan="2"></th>
                                        </tr>
                                        <tr>
                                            <th width="10%">Status</th>
                                            <th width="10%" style="border-right: 2px solid #E7E7EA;">Tanggal</th>
                                            <td hidden>ID Budget</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </font>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>

        <!-- Modal Sukses Approve -->
        <div class="modal fade" id="modal_sukses">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body judul" style="font-size: 40px; color: #D00101; font-weight: bold;"> Pengajuan Disetujui.. </div>
                    <div class="modal-footer">
                        <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" hidden></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Preview -->
        <div class="modal fade" id="modal-preview" style="z-index: 9999;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content"><div class="card-header" style="background-color: #0A86BF;">
                    <h3 class="card-title">
                        <b><font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;"><p id="judul">Detail Pengajuan</p></font></b>
                    </h3>
                    <div class="card-tools">
                        <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body" style="margin-left: 10px; margin-right: 20px;">
                    <div class="scoll-tree">
                        <table id="preview_pengajuan" class="table table-bordered table-striped" width="100%">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Nama Barang</th>
                                    <th style="text-align: center;">Satuan</th>
                                    <th style="text-align: center;">Kebutuhan</th>
                                    <th style="text-align: center;">Safety Stock</th>
                                    <th style="text-align: center;">Saldo</th>
                                    <th style="text-align: center;">Min Order</th>
                                    <th style="text-align: center;">Outstanding</th>
                                    <th style="text-align: center;">Budget Beli</th>
                                    <th style="text-align: center;">Harga</th>
                                    <th style="text-align: center;">Mata Uang</th>
                                    <th style="text-align: center;">Total</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button style="width: 30%;" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
                </div>
            </div>
        </div>
        
    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Load Dokumen
$(document).ready(function() {
    get_data();
    $(".select").select2();
});

// Ambil data sesuai periode
function get_data() {

    $.ajax({
        type: 'POST',
        url: '<?php echo base_url()."index.php/produksi/submit/show_submit" ?>',
        success: function(data) {
            data = JSON.parse(data);
            isi_data(data);
            pagination();
        }
    }); 
}

// Pagination
function pagination() {
    $('#data-table').DataTable().destroy();
    $('#data-table').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "searching": false,
        "order": [[ 0, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Pagination Preview
function pagination_preview() {
    $('#preview_pengajuan').DataTable().destroy();
    $('#preview_pengajuan').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "order": [[ 0, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Isi data ke dalam tabel
function isi_data(data) {
    for (var i=0; i<data['budget'].length; i++) {
        nmr = data['budget'][i]['NMR'];
        nama = data['budget'][i]['NAMA'];
        bagian = data['budget'][i]['BAGIAN'];
        total = Number(data['budget'][i]['TOTAL']);
        tgl_submit = format_date(data['budget'][i]['TGL_SUBMIT']);
        id_budget = data['budget'][i]['ID_BUDGET'];
        status = data['budget'][i]['APPROVAL_STATUS'];
        if(status == '1') {
            status = 'Approved';
        }else if(status == '0') {
            status = 'Tolak';
        }
        if (status == 'null') {
            tgl_approved = '';
            status = '';
        }else{
            tgl_approved = format_date(data['budget'][i]['TGL_APPROVAL']);
        }
        $('#data-table').find('tbody').append(
            '<tr><td align="center">' + (i+1) + '</td><td align="center">' + "Budget" + '</td><td align="center">' + nmr + '</td><td>' + nama + '</td><td>' + bagian + '</td><td align="center">' + tgl_submit + '</td><td align="right">' + format(total.toFixed(0)) + '</td><td align="center">' + status + '</td><td>' + tgl_approved + '</td><td width="5%"><button type="button" class="btn btn-block btn-info" title="Lihat Detail" onclick="preview(this)">Preview</button></td><td width="5%"><button type="button" class="btn btn-block btn-success" title="Approve Pengajuan" onclick="approve(this)">Approve</button></td><td width="5%"><button type="button" class="btn btn-block btn-danger" title="Tolak Pengajuan" onclick="tolak(this)">Tolak</button></td><td hidden>' + id_budget + '</td></tr>')
    }
}

// Format Date :
function format_date(num) {
    var date = num.substring(0, 2);
    var dt_month = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    var month = dt_month[parseInt(num.substring(3, 5))-1];
    var year = num.substring(6, 10);
    return date + '-' + month + '-' + year;
}

// Preview Detail
function preview(btn) {
    $('#modal_preview').click();

    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_budget = tabel.rows[row+1].cells[12].innerText;
    
    $('#preview_pengajuan').DataTable().destroy();
    $("#preview_pengajuan").find("tr:gt(0)").remove();

    $.ajax({
        data: {data: id_budget},
        type: 'POST',
        url: '<?php echo base_url()."index.php/produksi/submit/show_budget" ?>',
        success: function(data) {
            data = JSON.parse(data);
            isi_preview(data);
            pagination_preview();
        }
    });
}

// Isi data ke dalam tabel
function isi_preview(data) {
    var grand_total = 0;

    for (var i=0; i<data.length; i++) {

        nama_material = data[i]['NAMA_MATERIAL'];
        satuan = data[i]['SATUAN'];
        kebutuhan = format(data[i]['KEBUTUHAN']);
        safety_stock = format(data[i]['SAFETY_STOCK']);
        saldo = format(data[i]['SALDO']);
        moq = format(data[i]['MOQ']);
        outstanding = format(data[i]['OUTSTANDING']);
        budget_beli = format(data[i]['BUDGET_BELI']);
        harga = format(data[i]['HARGA']);
        mata_uang = format(data[i]['MATA_UANG']);
        total = format(angka(budget_beli) * data[i]['HARGA']);
        grand_total = grand_total + angka(total);

        $('#preview_pengajuan').find('tbody').append(
            '<tr><td align="center">' + (i+1) + '</td><td>' + nama_material + '</td><td align="center">' + satuan + '</td><td align="right">' + kebutuhan + '</td><td align="right">' + safety_stock + '</td><td align="right">' + saldo + '</td><td align="right">' + moq + '</td><td align="right">' + outstanding + '</td><td align="right">' + budget_beli + '</td><td align="right">' + harga + '</td><td align="center">' + mata_uang + '</td><td align="right">' + total + '</td></tr>')
    }
    $('#preview_pengajuan').find('tbody').append(
        '<tr><td colspan="11" align="center"><b>Total</b></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><th style="text-align: right;">' + format(grand_total.toFixed(0)) + '</td></tr>')

}

// Format Angka
function format(num) {
    return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function angka(num) {
    return Number(num.replace(/,/g,''));
}

// Approval Submission
function approve(btn) {
    $('.judul')[0].innerText = 'Pengajuan Disetujui...';

    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_budget = tabel.rows[row+1].cells[12].innerText;
    var status = tabel.rows[row+1].cells[7].innerText;
    var data = [id_budget,'1'];

    if (status != '') {return;}

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url()."index.php/produksi/submit/simpan_approval" ?>',
        success: function(data) {
            tabel.rows[row+1].cells[7].innerText = "Approved";
            tabel.rows[row+1].cells[8].innerText = data;
            $('#btnSukses').click();
        }
    });
}

// Tolak Submission
function tolak(btn) {
    $('.judul')[0].innerText = 'Pengajuan Ditolak...';

    var tabel = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;
    var id_budget = tabel.rows[row+1].cells[12].innerText;
    var status = tabel.rows[row+1].cells[7].innerText;
    var data = [id_budget,'0'];

    if (status != '') {return;}

    $.ajax({
        data: {data: data},
        type: 'POST',
        url: '<?php echo base_url()."index.php/produksi/submit/simpan_approval" ?>',
        success: function(data) {
            tabel.rows[row+1].cells[7].innerText = "Tolak";
            tabel.rows[row+1].cells[8].innerText = data;
            $('#btnSukses').click();
        }
    });
}

</script>