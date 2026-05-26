<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<style type="text/css" media="print">
    @media print {
        @page {
            size: legal;
            size: landscape;

        }
    }
    
</style>
<style type="text/css">
    .modal-body {
        max-width: 100%;
        overflow-x: auto;
    }

    .scoll-tree {
        width: 1500px;
    }
</style>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">

            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Laporan Data Pengajuan Budget</font>
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
                            <table style="width: 15%; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="15%" class="filter">Periode</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <select class="select" id="fPeriode" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                <option value="All">Pilih Periode..</option>
                                                <?php foreach ($periode->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['PERIODE']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php $this->load->view('pembelian/v_lap_budget_table'); ?>

                        </font>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Sukses Simpan -->
        <div class="modal fade" id="modal_sukses">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Data Tersimpan.. </div>
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
                <div class="modal-content">
                    <div class="card-header" style="background-color: #0A86BF;">
                        <h3 class="card-title">
                            <b>
                                <font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">
                                    <p id="judul">Detail Pengajuan</p>
                                </font>
                            </b>
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

<div id="printable" style="display: none;">
    <p>BUDGET PLAN</p>
    <p id="ppic_periode">Bagian PPIC Periode : </p>

    <table id="content_print" width="100%" border="1" cellpadding="2" style="font-size: 14px;"></table>

    <table style="margin-top: 50px;">
        <tr>
            <td>Dibuat,</td>
            <td width="30%"></td>
            <td>Disetujui,</td>
            <td width="30%"></td>
        </tr>
        <tr>
            <td style="height: 60px;"></td>
        </tr>
        <tr>
            <td>( Bagian PPIC )</td>
            <td></td>
            <td>( Manager Produksi )</td>
            <td></td>
            <td>( Bagian Cost Control )</td>
        </tr>
    </table>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<script>
    // Load Dokumen
    $(document).ready(function() {
        $('#minimize').click();
        $(".select").select2();
        pagination_table();
    });

    // Pagination
    function pagination() {
        $('#table_budget').DataTable().destroy();
        $('#table_budget').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": false
        });
    }

    // Pagination Laporan
    function pagination_table() {
        $('#data-table').DataTable().destroy();
        $('#data-table').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 10,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": true
        });
    }

    // Pagination Preview
    function pagination_preview() {
        $('#preview_pengajuan').DataTable().destroy();
        $('#preview_pengajuan').DataTable({
            "paging": true,
            "lengthChange": false,
            "pageLength": 10,
            "searching": false,
            "order": [
                [0, "asc"]
            ],
            "info": false,
            "autoWidth": true
        });
    }

    // Format Angka
    function format(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function angka(num) {
        return Number(num.replace(/,/g, ''));
    }

    // Preview Detail
    function preview(btn) {
        $('#modal_preview').click();

        var tabel = document.getElementById('data-table');
        var row = $(btn).closest("tr").index() + 1;
        var id_budget = tabel.rows[row].cells[8].innerText;

        $('#preview_pengajuan').DataTable().destroy();
        $("#preview_pengajuan").find("tr:gt(0)").remove();

        $.ajax({
            data: {
                data: id_budget
            },
            type: 'POST',
            url: '<?php echo base_url() . "index.php/produksi/submit/show_budget" ?>',
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

        for (var i = 0; i < data.length; i++) {

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
                '<tr><td align="center">' + (i + 1) + '</td><td>' + nama_material + '</td><td align="center">' + satuan + '</td><td align="right">' + kebutuhan + '</td><td align="right">' + safety_stock + '</td><td align="right">' + saldo + '</td><td align="right">' + moq + '</td><td align="right">' + outstanding + '</td><td align="right">' + budget_beli + '</td><td align="right">' + harga + '</td><td align="center">' + mata_uang + '</td><td align="right">' + total + '</td></tr>')
        }
        $('#preview_pengajuan').find('tbody').append(
            '<tr><td colspan="11" align="center"><b>Total</b></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td style="display: none;"></td><td align="right">' + format(grand_total.toFixed(0)) + '</td></tr>')

    }

    // Filter Data Table
    function filter() {
        var periode = $('#fPeriode').val();

        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/pembelian/lap_budget/filter_budget',
            data: {
                data: periode
            },
            success: function(data) {
                $('.data-table').html(data);
                pagination_table();
            }
        });
    }
</script>