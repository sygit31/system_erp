<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
?>

<!-- DataTables -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/datatables_multi_select/select.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.dataTables.min.css">

<!-- SEMANTIC UI -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/SemanticUI-2.2.13/semantic.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/css/dataTables.semanticui.min.css ">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/css/buttons.semanticui.min.css">

<!-- Select2 -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/select2/select2.min.css">

<!-- Zebra Datepicker -->
<link href="<?php echo base_url();?>assets/Zebra_Datepicker/dist/css/bootstrap/zebra_datepicker.min.css" rel="stylesheet" type="text/css">

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Laporan Stok Produksi</font></b></h3>
            </div>

            <div class="card-body">
                <form method="POST" action="<?php echo site_url('sgt/produksi/lap_stok/filter');?>">
                    <div class="card card-info">
                        <div class="card-body">
                            <table>
                                <tr>
                                    <td>Tanggal</td>
                                    <td width="50" align="center">:</td>
                                    <td width="170">
                                        <font size="2"></font>
                                        <input type="text" class="form-control pull-right" id="tanggalAwal" name="tanggalAwal" value="<?php echo isset($tanggalAwal) ? htmlspecialchars($tanggalAwal) : ''; ?>" placeholder="Batas Awal" required>
                                        </font>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">&nbsp Filter &nbsp</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card mt-3">
                <div class="card-body" style="background-color: #F5F5DC;">
                    <h5 class="mb-3"><b>Laporan Stok PET Tanggal: <?php echo isset($tanggalAwal) && $tanggalAwal !== '' ? htmlspecialchars($tanggalAwal) : '-'; ?></b></h5>
                    <font size="2">
                        <table id="lap_stok_table" class="table table-bordered table-striped" style="background-color: #ffffff;">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Bagian</th>
                                    <th>Satuan</th>
                                    <th>Seri I</th>
                                    <th>Seri II</th>
                                    <th>Seri III</th>
                                    <th>Seri MMEA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($records)) { $no=1; foreach ($records as $dt) { ?>
                                    <tr align="center">
                                        <td><?php echo $no++; ?></td>
                                        <td align="left"><?php echo $dt['BAGIAN']; ?></td>
                                        <td><?php echo $dt['SATUAN']; ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_I'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_II'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_III'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_MMEA'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['TOTAL'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="8" align="center">Tidak ada data untuk tanggal yang dipilih.</td>
                                    </tr>
                                <?php } ?>
                                <?php if (!empty($records)) { ?>
                                    <tr align="center">
                                        <td colspan="3" align="center"><b>TOTAL</b></td>
                                        <td align="right"><b><?php echo number_format($total_stok['seri_i'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_stok['seri_ii'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_stok['seri_iii'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_stok['seri_mmea'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_stok['total'], 0, ',', '.'); ?></b></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </font>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body" style="background-color: #FFEBCD;">
                    <h5 class="mb-3"><b>Laporan Stok Pelekatan Tanggal: <?php echo isset($tanggalAwal) && $tanggalAwal !== '' ? htmlspecialchars($tanggalAwal) : '-'; ?></b></h5>
                    <font size="2">
                        <table id="lap_stok_pelekatan" class="table table-bordered table-striped" style="background-color: #ffffff;">
                            <thead>
                                <tr align="center">
                                    <th>No</th>
                                    <th>Bagian</th>
                                    <th>Satuan</th>
                                    <th>Seri I</th>
                                    <th>Seri II</th>
                                    <th>Seri III</th>
                                    <th>Seri MMEA</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($records_pelekatan)) { $no=1; foreach ($records_pelekatan as $dt) { ?>
                                    <tr align="center">
                                        <td><?php echo $no++; ?></td>
                                        <td align="left"><?php echo $dt['BAGIAN']; ?></td>
                                        <td><?php echo $dt['SATUAN']; ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_I'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_II'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_III'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['SERI_MMEA'], 0, ',', '.'); ?></td>
                                        <td align="right"><?php echo number_format($dt['TOTAL'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php } } else { ?>
                                    <tr>
                                        <td colspan="8" align="center">Tidak ada data untuk tanggal yang dipilih.</td>
                                    </tr>
                                <?php } ?>
                                <?php if (!empty($records_pelekatan)) { ?>
                                    <tr align="center">
                                        <td colspan="3" align="center"><b>TOTAL</b></td>
                                        <td align="right"><b><?php echo number_format($total_pelekatan['seri_i'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_pelekatan['seri_ii'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_pelekatan['seri_iii'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_pelekatan['seri_mmea'], 0, ',', '.'); ?></b></td>
                                        <td align="right"><b><?php echo number_format($total_pelekatan['total'], 0, ',', '.'); ?></b></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </font>
                </div>
            </div>



            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>

<script src="<?php echo base_url();?>assets/datatables/jQuery-3.3.1/jquery-3.3.1.js"></script>
<script src="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.colVis.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Select-1.3.0/js/dataTables.select.min.js"></script>

<!-- SEMANTIC UI -->
<script src="<?php echo base_url();?>assets/datatables/DataTables-1.10.18/js/dataTables.semanticui.min.js"></script>
<script src="<?php echo base_url();?>assets/datatables/Buttons-1.5.6/js/buttons.semanticui.min.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/select2/select2.full.min.js"></script>

<!-- Zebra Datetimepicker -->
<script src="<?php echo base_url();?>assets/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>

<script>
    $('#tanggalAwal').Zebra_DatePicker({
        direction: 0,
        // pair: $('#tanggalAkhir'),
        format: 'd-m-Y'
    });

    $('#lap_stok_table').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            {text: 'copy', extend: 'copy', exportOptions: {columns: ':visible'}},
            {text: 'Print', extend: 'print', exportOptions: {columns: ':visible'}},
            {text: 'Visibility', extend: 'colvis'},
            {text: 'Export', extend: 'collection', buttons: [
                {text: 'Excel', extend: 'excel', exportOptions: {columns: ':visible'}},
                {text: 'CSV', extend: 'csv', exportOptions: {columns: ':visible'}},
                {text: 'PDF', extend: 'pdf', exportOptions: {columns: ':visible'}}
            ]}
        ]
    });

    $('#lap_stok_pelekatan').DataTable({
        ordering: false,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [
            'pageLength',
            {text: 'copy', extend: 'copy', exportOptions: {columns: ':visible'}},
            {text: 'Print', extend: 'print', exportOptions: {columns: ':visible'}},
            {text: 'Visibility', extend: 'colvis'},
            {text: 'Export', extend: 'collection', buttons: [
                {text: 'Excel', extend: 'excel', exportOptions: {columns: ':visible'}},
                {text: 'CSV', extend: 'csv', exportOptions: {columns: ':visible'}},
                {text: 'PDF', extend: 'pdf', exportOptions: {columns: ':visible'}}
            ]}
        ]
    });


</script>

<?php $this->load->view('dashboard/footer'); ?>
