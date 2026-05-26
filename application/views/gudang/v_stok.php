<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Select Live Search -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Laporan Stok Barang</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 13px; overflow-y: hidden;">
                            <table id="tbl_filter" style="width: 750px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="32%" colspan="2" class="filter">Periode Tanggal</td>
                                        <td></td>
                                        <td width="30%" class="filter">Lokasi Bahan</td>
                                        <td></td>
                                        <td width="15%" class="filter">No. Lokasi</td>
                                        <td></td>
                                        <td class="filter">Nama Barang</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input id="f_tgl1" type="text" style="background-color: #FFFFFF; cursor: pointer; text-align: center;" class="form-control datepicker" value="<?php echo date('01-M-Y'); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                        <td><input id="f_tgl2" type="text" style="background-color: #FFFFFF; cursor: pointer; text-align: center;" class="form-control datepicker" value="<?php echo date('t-M-Y', strtotime('-0 days')); ?>" onchange="filter()" autocomplete="off" readonly></td>
                                        <td></td>
                                        <td><div style="width: 220px;">
                                            <select class="select_min" id="f_jenis" onchange="filter()" style="width: 100%;">
                                                <?php foreach ($jenis->result_array() as $dt) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['LOCATION']; ?></option>
                                                <?php } ?>
                                            </select></div>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select_min" id="f_lokasi" onchange="filter()" style="width: 100%;">
                                                <option value="All">All..</option>
                                                <?php foreach ($lokasi->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NO_LOKASI']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td><input type="text" class="cari" id="cari" autocomplete="off" onchange="filter()" placeholder="Cari Nama.." style="width: 100%;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="datatable" style="font-size: 14px;">
                            <table id="tbl" class="table table-bordered table-striped" width="100%">
                                <thead>
                                    <tr align="center">
                                        <th>No.</th>
                                        <th>Kode Lokasi</th>
                                        <th><?php if ($kd_menu == 'tek_stok') {echo 'Part No.';}else{echo 'Material No.';} ?></th>
                                        <th width="20%">Nama Barang</th>
                                        <th>Satuan</th>
                                        <th>Saldo Awal</th>
                                        <th>Qty Masuk</th>
                                        <th>Qty Keluar</th>
                                        <th>Stok</th>
                                        <th>Min. Stok</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-footer">
            <font color="Green" size="2">ERP @2019</font>
        </div>
    </section>
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

<!-- Data Tables -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Defined Variable
    var kd_menu = <?php echo json_encode($kd_menu); ?>;

// Load Dokumen
    $(document).ready(function() {
        $('.select_min').select2({minimumResultsForSearch: -1});
        $(".datepicker").datepicker({dateFormat: 'dd-M-yy',minDate: new Date('<?php echo date('Y-m-d', strtotime('10/01/2022')); ?>')});
        
        filter();
    });

// Pagination
    function pagination() {
        $('#tbl').DataTable().destroy();
        var datatable = $('#tbl').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "order": false,
            "columnDefs": [{'orderable': false, 'targets': '_all'}],
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'excel invisible',
                title: 'Laporan Stok Barang'
            }]
        });

        setTimeout(function() {datatable.columns.adjust().draw();}, 500);
    }

// Filter Data Table
    function filter() {
        var tgl1 = $('#f_tgl1').val();
        var tgl2 = $('#f_tgl2').val();
        var id_location = $('#f_jenis').val();
        var no_lokasi = $('#f_lokasi').val();
        var cari = $('#cari').val().toUpperCase();
        var data = [tgl1, tgl2, id_location, cari, no_lokasi];

        $('#btnProgress').click();
        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/gudang/stok/filter',
            data: {data: data},
            success: function(data) {
                // data = console.log(data);
                data = JSON.parse(data);

                for (var i=0; i<data.length; i++) {
                    spesifikasi = data[i].SPESIFIKASI.length < 3 ? '' : ' - ' + data[i].SPESIFIKASI;
                    kode = kd_menu == 'tek_stok' ? data[i].KODE : (data[i].KODE_SIMPG == null ? '' : data[i].KODE_SIMPG);
                    nama = data[i].NAMA + spesifikasi;
                    min_stok = Number(data[i].MIN_STOK.replace(',', '.'));
                    masuk = Number(data[i].MASUK.replace(',', '.'));
                    keluar = Number(data[i].KELUAR.replace(',', '.'));
                    s_awal = Number(data[i].S_AWAL.replace(',', '.'));
                    masuk_awal = Number(data[i].MASUK_AWAL.replace(',', '.'));
                    keluar_awal = Number(data[i].KELUAR_AWAL.replace(',', '.'));
                    s_awal = s_awal + masuk_awal - keluar_awal;
                    s_akhir = s_awal + masuk - keluar;
                    color = s_akhir == 0 ? '#FDB1B1' : (s_akhir < min_stok ? '#F8F644' : '#96FF96');

                    $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+data[i].NO_LOKASI+'</td><td align="center">'+kode+'</td><td>'+nama+'</td><td align="center">'+data[i].SATUAN+'</td><td align="right">'+format_number(s_awal.toFixed(2))+'</td><td align="right">'+format_number(masuk.toFixed(2))+'</td><td align="right">'+format_number(keluar.toFixed(2))+'</td><td align="right" style="background-color: '+color+'; font-size: 16px; font-weight: bold;">'+format_number(s_akhir.toFixed(2))+'</td><td align="right">'+data[i].MIN_STOK+'</td></tr>');
                }

                if (kd_menu != 'tek_stok') {
                    $('#tbl th:nth-child(2), #tbl td:nth-child(2)').hide();
                    $('#tbl_filter tr:eq(0) td:nth-child(5), #tbl_filter tr:eq(0) td:nth-child(6), #tbl_filter tr:eq(1) td:nth-child(5), #tbl_filter tr:eq(1) td:nth-child(6)').hide();
                }

                setTimeout(function() {$('#btnOk').click(); pagination();}, 300);
            }
        });
    }

</script>