<?php $this->load->view('dashboard/header'); ?>
<?php $this->load->view('dashboard/footer'); ?>

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
<style type="text/css"> .barcode-container{transform: rotate(270deg);}</style>
<script src="<?php echo base_url(); ?>assets/js/JsBarcode.all.min.js"></script>

<style>body {padding-right: 0 !important;} .select2-container--open {z-index: 9999999;} .select2-selection__choice {color: #6D6C6C !important;}</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b><font color="White">Data Proses Stamping</font></b>
                </h3>
            </div>

            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 14px; overflow-y: hidden;">
                            <table style="width: 1000px; margin-bottom: 10px;">
                                <thead>
                                    <tr align="center" style="line-height: 30px;">
                                        <td width="25%" colspan="2" class="filter">Filter Tanggal</td>
                                        <td></td>
                                        <td width="20%" class="filter">Operator</td>
                                        <td></td>
                                        <td width="20%" class="filter">QC</td>
                                        <td></td>
                                        <td width="20%" class="filter">Pengawas</td>
                                        <td></td>
                                        <td width="15%" class="filter">Seri</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" id="fTgl1" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-1 days')); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                        <td><input type="text" id="fTgl2" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')); ?>" onchange="filter()" style="cursor: pointer; background-color: #FFFFFF; text-align: center;" readonly></td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="opr" style="width: 100%;" onchange="filter()">
                                                <option>All</option>
                                                <?php foreach ($nm_operator->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="qc" style="width: 100%;" onchange="filter()">
                                                <option>All</option>
                                                <?php foreach ($nm_qc->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="pengawas" style="width: 100%;" onchange="filter()">
                                                <option>All</option>
                                                <?php foreach ($nm_pengawas->result_array() as $dt) { ?>
                                                    <option><?php echo $dt['NAMA']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </td>
                                        <td></td>
                                        <td>
                                            <select class="select" id="seri" style="width: 100%;" onchange="filter()">
                                                <option>All</option>
                                                <option value="1">Seri I</option>
                                                <option value="2">Seri II</option>
                                                <option value="3">Seri III</option>
                                                <option value="4">MMEA</option>
                                            </select>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="data-table" style="overflow-x: auto;"></div>
                        <button style="width: 150px;" type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-success mt-4" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button>

                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>

        </div>
    </div>

</section>
</div>

<!-- Modal Progress -->
<div class="modal fade" id="modal_progress">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"><i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><b>Loading..</b></div>
            <div class="modal-footer" hidden>
                <button id="btnOk" type="button" data-dismiss="modal" hidden></button>
                <button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false" hidden></button>
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
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-check-square-o mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Isian Barcode -->
<div class="modal fade" id="modal_barcode">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-body">
                <table width="100%" class="mt-2">
                    <tr>
                        <th width="40%">Tanggal/ Shift</th>
                        <td width="60%">
                            <input type="text" id="tgl" class="form-control" autocomplete="off" readonly>                 
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Mesin/ PP</th>
                        <td>
                            <input type="text" id="mesin" class="form-control" autocomplete="off" readonly>    
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Kode Roll</th>
                        <td>
                            <input type="text" id="kode_roll" class="form-control" autocomplete="off" readonly>    
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Seri</th>
                        <td>
                            <input type="text" id="t_seri" class="form-control" autocomplete="off" readonly>    
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Ukuran</th>
                        <td>
                            <input type="text" id="ukuran" class="form-control" autocomplete="off" readonly>       
                        </td>
                    </tr>
                    <tr style='height: 10px;'></tr>
                    <tr>
                        <th>Panjang</th>
                        <td>
                            <input type="text" id="panjang" class="form-control" autocomplete="off" readonly>
                        </td>
                    </tr>
                    <tr style='height: 10px;'></tr>
                    <tr>
                        <th>Nama Operator</th>
                        <td>                            
                            <select class="select" id="nm_operator" style="width: 100%;">
                                <option value="">Pilih Nama..</option>
                                <?php foreach ($nm_operator->result_array() as $dt) { ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select>                
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Nama QC</th>
                        <td>                       
                            <select class="select" id="nm_qc" style="width: 100%;">
                                <option value="">Pilih Nama..</option>
                                <?php foreach ($nm_qc->result_array() as $dt) { ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select>   
                        </td>
                    </tr>
                    <tr style="height: 10px;"></tr>
                    <tr>
                        <th>Nama Pengawas</th>
                        <td>
                            <select class="select" id="nm_pengawas" style="width: 100%;">
                                <option value="">Pilih Nama..</option>
                                <?php foreach ($nm_pengawas->result_array() as $dt) { ?>
                                    <option><?php echo $dt['NAMA']; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <tr style='height: 10px;'></tr>
                    <tr>
                        <th>Urut PP</th>
                        <td>
                            <input type="text" id="urut_pp" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" autocomplete="off" maxlength="4">
                        </td>
                    </tr>
                </table>
            </div>
            <div class="text-danger text-right mr-4 mb-2 invisible isian"><b>Isian salah..</b></div>
            <div class="modal-footer">
                <button onclick="simpan()" style="width: 50%;" type="button" class="btn btn-success"><i class="fa fa-save mr-2"></i><b>Cetak</b></button>
                <button id="tutup" style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
                <button id="btnBarcode" class="invisible" data-toggle="modal" data-target="#modal_barcode"></button>
            </div>
        </div>
    </div>
</div>

<div id="printable" style="display: none; color: black; important!">
    <div class="barcode-container" style="position: absolute; right: -80px; top: 40px;">
        <svg id="barcode" style="width: 70%;"></svg>
    </div>
    <div>
        <!-- <table id="tbl_header" class="table table-borderless" style="line-height: 20px; font-size: 22px; font-weight: bold;"> -->
        <table id="tbl_header" border="1" style="line-height: 20px; font-size: 22px; font-weight: bold;">
            <tr style="height: 70px;">
                <td></td>
            </tr>
            <tr>
                <td width="20%">Tanggal</td>
                <td width="30%"></td>
                <td width="15%">SERI</td>
                <td width="35%"></td>
            </tr>
            <tr>
                <td>SHIFT</td>
                <td></td>
                <td>UKURAN</td>
                <td></td>
            </tr>
            <tr>
                <td>MESIN / PP</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>KODE ROLL</td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>KETERANGAN</td>
                <td style="font-size: 40px; padding: 20px;"></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        <div style="height: 42mm;"></div>
        <table id="tbl_footer" class="table table-borderless" style="line-height: 10px; font-size: 22px; font-weight: bold; margin-left: 3mm;">
            <tr>
                <td align="center" width="23%"></td>
                <td align="center" width="42%"></td>
                <td align="center" width="35%"></td>
            </tr>
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

// Define Variable
    var data_print = [];

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $( ".datepicker" ).datepicker({ dateFormat: 'dd-M-yy' });

        filter();

        $('#non_printable').removeClass('content-wrapper');
        $('.content').css('margin-top','-20px');
        $('.content').addClass('ml-2');
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
                title: 'Laporan Data Proses Stamping'
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
        var opr = $('#opr').val();
        var qc = $('#qc').val();
        var pengawas = $('#pengawas').val();
        var seri = $('#seri').val();
        var data = [tgl1, tgl2, opr, qc, pengawas, seri];

        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/stamping/barcode/filter" ?>',
            success: function(data) {
                $('.data-table').html(data);
                pagination();
            }
        }); 
    }

// Cetak Form
    function cetak(btn) {
        var tbl_data = document.getElementById('data-table');
        var tbl_header = document.getElementById('tbl_header');
        var row = $(btn).closest("tr").index() + 1;
        var tgl = tbl_data.rows[row].cells[2].innerHTML;
        var shift = tbl_data.rows[row].cells[3].innerHTML;
        var mesin = tbl_data.rows[row].cells[4].innerHTML;
        var pp = tbl_data.rows[row].cells[5].innerHTML;
        var kode_roll = tbl_data.rows[row].cells[6].innerHTML;
        var seri = tbl_data.rows[row].cells[7].innerHTML;
        var ukuran = tbl_data.rows[row].cells[8].innerHTML;
        var panjang = tbl_data.rows[row].cells[9].innerHTML;
        var nm_operator = tbl_data.rows[row].cells[11].innerHTML;
        var nm_qc = tbl_data.rows[row].cells[12].innerHTML;
        var nm_pengawas = tbl_data.rows[row].cells[13].innerHTML;
        var urut_pp = tbl_data.rows[row].cells[14].innerHTML;
        data_print = [tgl, shift, mesin, pp, kode_roll, seri, ukuran, panjang, nm_operator, nm_qc, nm_pengawas, urut_pp];

        $('#tgl').val(tgl + ' / ' + shift);
        $('#mesin').val(mesin + ' / ' + pp);
        $('#kode_roll').val(kode_roll);
        $('#t_seri').val(seri);
        $('#ukuran').val(ukuran);
        $('#panjang').val(panjang);
        $('#nm_operator').val(nm_operator).change();
        $('#nm_qc').val(nm_qc).change();
        $('#nm_pengawas').val(nm_pengawas).change();
        $('#urut_pp').val(urut_pp).change();
        $('#btnBarcode').click();
    }

// Cetak Form
    function simpan() {
        var i_operator = document.getElementById('nm_operator').selectedIndex - 1;
        var i_qc = document.getElementById('nm_qc').selectedIndex - 1;
        var i_pengawas = document.getElementById('nm_pengawas').selectedIndex - 1;
        var nm_operator = <?php echo json_encode($nm_operator->result_array()); ?>;
        var nm_qc = <?php echo json_encode($nm_qc->result_array()); ?>;
        var nm_pengawas = <?php echo json_encode($nm_pengawas->result_array()); ?>;
        var id_operator = i_operator == -1 ? '' : nm_operator[i_operator].ID;
        var id_qc = i_qc == -1 ? '' : nm_qc[i_qc].ID;
        var id_pengawas = i_pengawas == -1 ? '' : nm_pengawas[i_pengawas].ID;
        var urut_pp = $('#urut_pp').val();
        var kode_roll = data_print[4];
        var ukuran = data_print[6];
        var data = [kode_roll, id_operator, id_qc, urut_pp, ukuran, id_pengawas];

        if (id_operator == '' || id_qc == '' || id_pengawas == '' || urut_pp == '') {
            $('.isian:eq(0)').removeClass('invisible');
            setTimeout(function() {
                $('.isian:eq(0)').addClass('invisible');
            }, 2000);
            return;
        }

        $('#tutup').click();
        $.ajax({
            async: false,
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url()."index.php/stamping/barcode/simpan" ?>',
            success: function(data) {
                filter();
            }
        }); 

        tbl_header.rows[1].cells[1].innerHTML = data_print[0];
        tbl_header.rows[2].cells[1].innerHTML = data_print[1];
        tbl_header.rows[3].cells[1].innerHTML = data_print[2] + '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp' + data_print[3];
        tbl_header.rows[4].cells[1].innerHTML = kode_roll;

        tbl_header.rows[1].cells[3].innerHTML = data_print[5];
        tbl_header.rows[2].cells[3].innerHTML = ukuran;
        tbl_header.rows[3].cells[3].innerHTML = data_print[7];
        tbl_header.rows[4].cells[3].innerHTML = $('#nm_operator').val().substring(0,8) + '&nbsp &nbsp &nbsp &nbsp' + $('#nm_qc').val().substring(0,8);
        tbl_header.rows[5].cells[1].innerHTML = urut_pp;

        tbl_footer.rows[0].cells[0].innerHTML = $('#nm_operator').val();
        tbl_footer.rows[0].cells[1].innerHTML = $('#nm_pengawas').val();

    // Cetak Data
        setTimeout(function() {
            var printable = document.getElementById('printable');
            var non_printable = document.getElementById('non_printable');
            JsBarcode("#barcode",kode_roll, {
                fontSize: 32
            });

            printable.style.display = "";
            non_printable.style.display = "none";

            window.print();

            printable.style.display = "none";
            non_printable.style.display = "";
        },500);
    }

// Kosong Isian
    function kosong() {
        $('#kode').val('');
        $('#kategori').val('');
        $('#ket_input').html('Tambah Kategori');
        id_kategori = '';
    }

</script>