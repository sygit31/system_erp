

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<!-- Select Live Search -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Input Data Master Saldo Awal Gudang</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool info_1" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus info_1"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5">
                        <table width="90%">
                            <tr>
                                <th width="40%">Nama Material</th>
                                <td width="60%">
                                    <div class="mobile_width">
                                        <select class="select" id="produk" onchange="isi_satuan()" style="width: 100%; cursor: pointer;">
                                            <option value="">Pilih..</option>
                                            <?php foreach ($produk->result_array() as $dt): ?>
                                                <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA'] . ' - ' . $dt['SPESIFIKASI']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr height="10"></tr>
                            <tr>
                                <th>Satuan</th>
                                <td>
                                    <input type="text" class="form-control" id="satuan" style="width: 100%;" readonly>
                                </td>
                            </tr>
                            <tr height="10"></tr>
                            <tr>
                                <th>Saldo Awal</th>
                                <td>
                                    <input type="text" class="form-control num" id="saldo" autocomplete="off" onkeyup="isi_total()" style="width: 100%;" tabindex="1" maxlength="9" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </td>
                            </tr>
                            <tr height="10"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6">
                        <table width="90%">
                            <tr>
                                <th width="35%">Harga</th>
                                <td width="65%">
                                    <input type="text" class="form-control num" id="harga" autocomplete="off" onkeyup="isi_total()" style="width: 100%;" tabindex="2" maxlength="9" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                </td>
                            </tr>
                            <tr height="10"></tr>
                            <tr>
                                <th>Total Nilai</th>
                                <td>
                                    <input type="text" class="form-control" id="total" value="0" style="width: 100%;" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Saldo Awal Gudang</font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool info_2" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus info_2"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body table-responsive">
                        <div style="width: 400px;">
                            <table style="width: 100%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <th width="30%" class="filter">Tahun</th>
                                        <td></td>
                                        <td width="70%" class="filter">Nama Barang</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fTahun" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option>All..</option>
                                                <?php foreach ($tahun->result_array() as $dt) { ?>
                                                    <option selected=><?php echo $dt['TAHUN']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama Barang.." style="width: 100%;" autocomplete="off">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card mt-2 table-responsive" style="width: 100%; font-size: 13px;">
                            <div class="data-table m-3"></div>
                        </div>
                    </div>

                    <div class="card-footer ol-2 m-4">
                        <button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel" style="width: 150px;"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
    </section>
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

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
            <div class="modal-footer" hidden>
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button id="btnProgress" data-toggle="modal" data-target="#modal_progress"data-backdrop="static" data-keyboard="false"></button>
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

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Define Variable
var id_produk = '';

// Load Dokumen
$(document).ready(function() {
    $(".select").select2();
    filter();
    resize();
});

// Resize Dokumen
$(window).on('resize', function(){
    resize();
});
function resize() {
    var lebar = $(window).width();
    var select_width = lebar > 700 ? '350px' : '270px';

    $('.mobile_width').css('width', select_width); 
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
            exportOptions: {columns: ':visible'},
            className: 'invisible excel',
            filename: 'Laporan Saldo Awal gudang',
            title: ''
        }],
        "colReorder": true
    });

    setTimeout(function() {
        data_table.columns.adjust().draw();
    }, 1000);
}

// Kosong Isian
function kosong() {
    $('#produk').val('').change();
    $('#saldo').val('');
    $('#harga').val('');
    $('#saldo').focus();
    id_produk = '';
}

// Isi Total Harga
function isi_total() {
    var saldo = $('#saldo').val();
    var harga = $('#harga').val();
    var total = angka(saldo) * angka(harga);

    $('#total').val(format_number(total));
}

// Isi Satuan
function isi_satuan() {
    var dt_produk = <?php echo json_encode($produk->result_array()); ?>;
    var index = document.getElementById('produk').selectedIndex-1;
    var satuan = index == -1 ? '' : dt_produk[index].SATUAN;

    $('#satuan').val(satuan);
}

// Filter Data Table
function filter() {
    var tahun = $('#fTahun').val();
    var cari = $('#cari').val();
    var data = [tahun,cari];

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/gudang/saldo_awal/filter',
        data: {data: data},
        success: function(data) {
            $('.data-table').html(data);
            setTimeout(function() {
                $('#btnOk').click();
                pagination();
            }, 500);
        }
    });
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
    var saldo = angka($('#saldo').val());
    var harga = angka($('#harga').val());
    var id_produk = $('#produk').val();
    var data = [id_produk, saldo, harga];

    if (id_produk == '') {error_isian('Nama Material belum diisi..');}
    if (saldo == '') {error_isian('Saldo Awal belum diisi..');}
    if (harga == '') {error_isian('Harga belum diisi..');}

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/gudang/saldo_awal/simpan',
        data: {data: data},
        success: function(data) {
            console.log(data);
            setTimeout(function() {
                $('#btnOk').click();
                $('#btnSukses').click();
                kosong();
                filter();
            }, 500);
        }
    });
}   

// Expands & Collapse Card Info
var info_1 = 0;
$('.info_1:eq(0)').on('click', function() {
    if (info_1 == 0) {
        $('.info_1:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_1 = 1;
    }else{
        $('.info_1:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_1 = 0;
    }
});
var info_2 = 0;
$('.info_2:eq(0)').on('click', function() {
    if (info_2 == 0) {
        $('.info_2:eq(1)').removeClass('fa fa-minus').addClass('fa fa-plus');
        info_2 = 1;
    }else{
        $('.info_2:eq(1)').removeClass('fa fa-plus').addClass('fa fa-minus');
        info_2 = 0;
    }
});

</script>