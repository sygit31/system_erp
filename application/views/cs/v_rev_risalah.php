

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
                    <b><font color="White"><div id="headerinput">Revisi Risalah Rapat</div></font></b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
            </div>

            <div class="card-body">
                <table width="100%">
                    <tr>

                        <?php $qty_data = 0; ?>
                        <?php foreach ($risalah->result_array() as $dt): ?>
                            <?php $dt_risalah['desain'][] = $dt['DESAIN']; ?>
                            <?php $dt_risalah['no_risalah'][] = $dt['NMR']; ?>
                            <?php $dt_risalah['nama_produk'][] = $dt['NAMA']; ?>
                            <?php $dt_risalah['id_detail'][] = $dt['ID_DETAIL']; ?>
                            <?php $dt_risalah['collect'][] = $dt['DESAIN'] . $dt['NMR'] . $dt['NAMA']; ?>
                        <?php endforeach; ?>
                        <?php if (isset($dt_risalah)) {
                            $qty_data = count($dt_risalah['desain']);
                        }?>

                        <td width="15%">Desain</td>
                        <td width="3%">:</td>
                        <td width="30%">
                            <select id="desain" class="select" onchange="isi_no_risalah()" style="width: 50%;" tabindex="1">
                                <option value="">Pilih Desain..</option>
                                <?php $desain = array_unique($dt_risalah['desain']); ?>
                                <?php foreach ($desain as $dt) { ?>
                                    <option><?php echo $dt; ?></option>
                                <?php } ?>
                            </select>
                        </td>    
                        <td width="15%">No. Revisi</td>
                        <td width="3%">:</td>
                        <td width="20%"><input type="text" class="form-control" id="no_revisi" autocomplete="off" maxlength="20" style="width: 80%;" tabindex="4"></td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td>No. Risalah</td>
                        <td>:</td>
                        <td>
                            <select id="nomor_risalah" class="select" onchange="isi_produk()" style="width: 70%;" tabindex="2">
                                <option>Pilih Nomor..</option>
                            </select>
                        </td>                    
                        <td>Tanggal Revisi</td>
                        <td>:</td>
                        <td><input type="text" id="tanggal" class="form-control datepicker" autocomplete="off" style="width: 80%; background-color: #FFFFFF;" tabindex="5" readonly></td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td>Nama Produk</td>
                        <td>:</td>
                        <td>
                            <select id="nama_produk" class="select" style="width: 90%;" tabindex="3">
                                <option value="">Pilih Produk..</option>
                            </select>
                        </td>
                        <td>Qty Adjust</td>
                        <td>:</td>
                        <td><input type="text" class="form-control" id="qty" autocomplete="off" style="width: 80%;" tabindex="6" oninput="this.value = this.value.replace(/[^0-9-]/g, '').replace(/(\..*)\./g, '$1');"></td>
                    </tr>
                </table>
            </div>

            <div class="card-footer">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()">Simpan</button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()">Batal</button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Laporan Risalah Rapat</font></b>
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
                            <table style="width: 70%; margin-bottom: 10px;">
                                <thead>
                                  <tr align="center" style="line-height: 30px;">
                                    <td width="40%" colspan="2" class="filter">Filter Tanggal</td>
                                    <td></td>
                                    <td width="20%" class="filter">Desain</td>
                                    <td></td>
                                    <td width="40%" class="filter">Nomor Risalah</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="text" id="fTgl1" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-30 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                    <td><input type="text" id="fTgl2" style="background-color: #FFFFFF;" class="form-control pull-right datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                    <td></td>
                                    <td>
                                      <select class="select" id="fDesain" onchange="filter()" style="width: 100%; cursor: pointer;">
                                        <option>All</option>
                                        <option>2018</option>
                                        <option>2019</option>
                                        <option>2020</option>
                                        <option>2021</option>
                                    </select>
                                </td>
                                <td></td>
                                <td><input type="text" class="cari" id="cari" onkeyup="filter()" placeholder="Cari nomor Risalah.." autocomplete="off" style="width: 100%;"></td>
                            </tr>
                        </tbody>
                    </table>

                    <?php $this->load->view('cs/v_rev_risalah_table'); ?>

                </font>
            </div>
        </div>

        <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>

        <!-- Modal Sukses Simpan -->
        <div class="modal fade" id="modal_sukses">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
                    <div class="modal-footer">
                        <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                        <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>

// Define Variable
var id_detail, jml_produk, tabel_produk;
var arrId_Produk = new Array();

// Load Dokumen
$(document).ready(function() {
    $(".select").select2(); // Combo Live Search
    $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });
    pagination();

    id_detail = 0;
});

// Kosong Isian
function kosong() {
    $('#desain').val('').change();
    $('#no_risalah').val('').change();
    document.getElementById("no_revisi").value = '';
    document.getElementById("tanggal").value = '';
    document.getElementById("qty").value = '';
}

// Pagination
function pagination() {
    if ( $.fn.dataTable.isDataTable('#data-table') ) {
        table = $('#data-table').DataTable( {
            "destroy": true,
            "paging": true,
            "lengthChange": false,
            "pageLength": 5,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true
        });
    }else{
        table = $('#data-table').DataTable( {
            "paging": true,
            "lengthChange": false,
            "pageLength": 5,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true
        });
    }
}

function isi_no_risalah() {
    var nomor_risalah = document.getElementById("nomor_risalah");
    var option = document.createElement("option");
    var desain = document.getElementById("desain").value;
    var isi_nomor = [];

    // Kosongkan option select
    $("#nomor_risalah").empty();
    <?php $no_risalah = array(); ?>

    <?php for ($i=0; $i<$qty_data; $i++) { ?>
        dt_desain = <?php echo json_encode($dt_risalah['desain'][$i]); ?>;
        dt_nmr = <?php echo json_encode($dt_risalah['no_risalah'][$i]); ?>;
        if (dt_desain == desain) {
            isi_nomor.push(dt_nmr);
        }
    <?php } ?>

    // Isi option select
    var dt_nmr = isi_nomor.filter( onlyUnique );
    nomor_risalah.options[nomor_risalah.options.length] = new Option("Pilih Nomor..");
    $("#nomor_risalah").val("Pilih Nomor..").change();
    for (var i=0; i<dt_nmr.length; i++) {
        nomor_risalah.options[nomor_risalah.options.length] = new Option(dt_nmr[i]);
    }

}

function isi_produk() {
    var nama_produk = document.getElementById("nama_produk");
    var option = document.createElement("option");
    var desain = document.getElementById("desain").value;
    var nmr = document.getElementById("nomor_risalah").value;
    var isi_nama = [];

    // Kosongkan option select
    $("#nama_produk").empty();
    <?php $nama_produk = array(); ?>

    <?php for ($i=0; $i<$qty_data; $i++) { ?>
        dt_desain = <?php echo json_encode($dt_risalah['desain'][$i]); ?>;
        dt_nmr = <?php echo json_encode($dt_risalah['no_risalah'][$i]); ?>;
        dt_nama = <?php echo json_encode($dt_risalah['nama_produk'][$i]); ?>;            
        if (dt_desain == desain && dt_nmr == nmr) {
            isi_nama.push(dt_nama);
        }
    <?php } ?>

    // Isi option select
    var dt_nama = isi_nama.filter( onlyUnique );
    nama_produk.options[nama_produk.options.length] = new Option("Pilih Produk..");
    $("#nama_produk").val("Pilih Produk..").change();
    for (var i=0; i<dt_nama.length; i++) {
        nama_produk.options[nama_produk.options.length] = new Option(dt_nama[i]);
    }
}

function isi_id_risalah() {
    var nama_produk = document.getElementById("nama_produk").value;
    var desain = document.getElementById("desain").value;
    var nmr = document.getElementById("nomor_risalah").value;
    var collect = desain + nmr + nama_produk;

    id_detail = 0;
    <?php for ($i=0; $i<$qty_data; $i++) { ?>
        dt_collect = <?php echo json_encode($dt_risalah['collect'][$i]); ?>;
        dt_detail = <?php echo json_encode($dt_risalah['id_detail'][$i]); ?>;
        if (dt_collect == collect) {
            id_detail = dt_detail;
        }
    <?php } ?>
}

function onlyUnique(value, index, self) { 
    return self.indexOf(value) === index;
}

function simpan() {
    isi_id_risalah();
    var no_revisi = document.getElementById("no_revisi").value;
    var tgl = document.getElementById("tanggal").value;
    var qty = document.getElementById("qty").value;
    var data = [id_detail, no_revisi, tgl, qty];   

    if (no_revisi == '' || tgl == '' || qty == '' || id_detail == '0') {return;}
    kosong();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/cs/rev_risalah/simpan_revisi',
        data: {data: data},
        success: function(data) {
            $('#btnSukses').click();
        }
    });

}

// Reload Page
$('#btnOk').click(function() {
    location.reload();
});

function filter() {
    var tgl1 = document.getElementById('fTgl1').value;
    var tgl2 = document.getElementById('fTgl2').value;
    var desain = document.getElementById('fDesain').value;
    var cari = document.getElementById('cari').value;
    var arrData = [tgl1, tgl2, desain, cari];

    $.ajax({
        data: {data: arrData},
        type: 'POST',
        url: '<?php echo base_url()."index.php/cs/rev_risalah/filter_risalah_rev" ?>',
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    }); 
}

</script>