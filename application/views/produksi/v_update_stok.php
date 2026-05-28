<?php
$this->load->view('dashboard/header');
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
<?php
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
?>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Update Stok Produksi</font></b></h3>
            </div>

            <div class="card-body">
                <form method="post" action="<?php echo base_url(); ?>index.php/produksi/update_stok/simpan" id="formUpdateStok">
                    <input type="hidden" name="id" id="id" value="">
                    <input type="hidden" name="flag" id="flag" value="simpan">
                    <div class="row">
                        <div class="col-md-2">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                        <div class="col-md-2">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control" step="1" min="0" required>
                        </div>
                        <div class="col-md-2">
                            <label>Satuan</label>
                            <select name="satuan" id="satuan" class="form-control" required>
                                <option value="">-- Pilih Satuan --</option>
                                <option value="LBR">Lembar</option>
                                <option value="MTR">Meter</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Seri</label>
                            <select name="seri" id="seri" class="form-control" required>
                                <option value="">-- Pilih Seri --</option>
                                <option value="I">I</option>
                                <option value="II">II</option>
                                <option value="III">III</option>
                                <option value="MMEA">MMEA</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Bagian</label>
                            <select name="id_bagian" id="id_bagian" class="form-control" required>
                                <option value="">-- Pilih Bagian --</option>
                                <?php foreach ($bagian as $dt) { ?>
                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-1 d-flex align-items-end">
                            <button type="submit" id="btnSubmit" class="btn btn-primary btn-block">Simpan</button>
                        </div>
                    </div>
                </form>

                <div class="card mt-3">
                    <div class="card-body">
                        <font size="2">
                            <table id="example2" class="table table-bordered table-striped">
                                <thead>
                                    <tr align="center">
                                        <th>ID</th>
                                        <th>Tanggal</th>
                                        <th>Jumlah</th>
                                        <th>Satuan</th>
                                        <th>Seri</th>
                                        <th>Bagian</th>
                                        <th>Edit</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($records)) { foreach ($records as $row) { ?>
                                        <tr align="center">
                                            <td><?php echo $row['ID']; ?></td>
                                            <td><?php echo $row['TANGGAL']; ?></td>
                                            <td><?php echo $row['JUMLAH']; ?></td>
                                            <td><?php echo $row['SATUAN']; ?></td>
                                            <td><?php echo $row['SERI']; ?></td>
                                            <td><?php echo $row['NAMA_BAGIAN']; ?></td>
                                            <td>
                                                <button type="button"
                                                    class="btn btn-block btn-warning btn-sm btn-edit"
                                                    data-id="<?php echo $row['ID']; ?>"
                                                    data-tanggal="<?php echo $row['TANGGAL']; ?>"
                                                    data-jumlah="<?php echo $row['JUMLAH']; ?>"
                                                    data-satuan="<?php echo $row['SATUAN']; ?>"
                                                    data-seri="<?php echo $row['SERI']; ?>"
                                                    data-id-bagian="<?php echo $row['ID_BAGIAN']; ?>">Edit</button>
                                            </td>
                                            <td>
                                                <form method="post" action="<?php echo base_url(); ?>index.php/produksi/update_stok/hapus" onsubmit="return confirm('Anda yakin akan menghapus data tersebut?');">
                                                    <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                                                    <button type="submit" class="btn btn-block btn-danger btn-sm">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php } } ?>
                                </tbody>
                            </table>
                        </font>
                    </div>
                </div>
            </div>
            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>
    </section>
</div>

<?php $this->load->view('dashboard/footer'); ?>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables_multi_select/dataTables.select.min.js"></script>
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#example2').DataTable({
            ordering: false,
            dom: 'Bfrtip',
            columnDefs: [
                {
                    targets: 0,
                    visible: false,
                    searchable: false
                }
            ],
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

        $('#example2').on('click', '.btn-edit', function() {
            $('#id').val(this.dataset.id);
            $('#flag').val('edit');
            $('#tanggal').val(this.dataset.tanggal);
            $('#jumlah').val(this.dataset.jumlah);
            $('#satuan').val(this.dataset.satuan);
            $('#seri').val(this.dataset.seri);
            $('#id_bagian').val(this.dataset.idBagian);
            $('#btnSubmit').text('Update');
        });
    });
</script>
