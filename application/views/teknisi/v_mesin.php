

<?php
$this->load->view('dashboard/header'); 
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar'); 
$this->load->view('dashboard/footer'); 
?>

<link rel="stylesheet" href="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">
<link rel="stylesheet" href="<?php echo base_url().'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

<div class="content-wrapper">
	<section class="content-header"></section>
	<section class="content">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">
					<b><font color="White"><div id="headerinput">Master Data Mesin</div></font></b>
				</h3>
				<div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.112/help_eng')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Close"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td width="15%"><label><font size = "3">Nomor Mesin</font></label></td>
                        <td width="35%">
                            <input type="text" class="form-control" id="nomor" style="width: 50%;" autocomplete="off" tabindex="1">
                        </td>
                        <td width="15%"><label><font size = "3">Kapasitas</font></label></td>
                        <td width="15%">
                            <input type="text" class="form-control" id="kapasitas" autocomplete="off" tabindex="4">
                        </td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>
                        <td><label><font size = "3">Nama Mesin</font></label></td>
                        <td>
                            <input type="text" class="form-control" id="nama_mesin" autocomplete="off" style="width: 90%;" tabindex="2">
                        </td>
                        <td><label><font size = "3">Tahun Pengadaan</font></label></td>
                        <td><input type="text" class="form-control" id="tahun" autocomplete="off" tabindex="5" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"></td>
                    </tr>
                    <tr height="10"></tr>
                    <tr>                        
                        <td><label><font size = "3">Deskripsi</font></label></td>
                        <td>
                            <input type="text" class="form-control" id="deskripsi" autocomplete="off" style="width: 90%;" tabindex="3">
                        </td>  
                        <td><label><font size = "3">Status</font></label></td>
                        <td>
                            <select class="select" id="status" style="width: 100%;" tabindex="6">
                                <option value="">Status..</option>
                                <option>Aktif</option>
                                <option>Non Aktif</option>
                            </select></td> 
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <table>
                        <tr>
                            <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                            <td width="10"></td>
                            <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td>
                                <button type="button" class="btn btn-block btn-info" id="btnUtama">Spare Part Utama</button>                            
                            </td>
                            <td>
                                <button type="button" class="btn btn-block btn-default" id="btnPendukung">Spare Part Pendukung</button>
                            </td>
                        </tr>
                    </table>             
                </div>
                <div id="utama">
                    <?php $this->load->view('teknisi/v_sp_utama'); ?>
                </div>
                <div id="pendukung" style="display: none;">
                    <?php $this->load->view('teknisi/v_sp_pendukung'); ?>
                </div>
            </div>

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <b><font color="White">Laporan Data Mesin</font></b>
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
                                <table style="width: 400px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="35%" class="filter">Tahun</td>
                                            <td></td>
                                            <td width="65%" class="filter">Nama Mesin</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <?php $dt_tahun = array(); ?>
                                            <?php foreach ($mesin->result_array() as $dt): ?>
                                                <?php $dt_tahun[] = $dt['TAHUN']; ?>
                                            <?php endforeach; ?>
                                            <?php $tahun = array_unique($dt_tahun); ?>
                                            <td>
                                                <select class="select" id="ftahun" onchange="filter()" style="width: 100%;">
                                                    <option>All</option>
                                                    <?php foreach ($tahun as $dt) { ?>
                                                        <option><?php echo $dt; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" id="cari" onkeyup="filter()" placeholder="Cari nama mesin.." style="width: 100%;" autocomplete="off">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php $this->load->view('teknisi/v_mesin_table'); ?>

                            </font>
                        </div>
                    </div>
                </div>

                <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
            </div>

            <!-- Modal Part Name -->
            <div class="modal fade" id="modal_part">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <table style="font-weight: bold;">
                                <tr><td style="font-size: 30px; color: #0C02D3;">Nama Mesin :</td></tr>
                                <tr><td id="judul_modal_part" style="font-size: 30px; color: #D10316;"></td></tr>
                            </table>
                            <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="tabel_part" class="table table-bordered table-striped" width="100%">
                                <tr style="font-weight: bold;">
                                    <td width="10%">No.</td>
                                    <td width="45%" colspan="2" align="center">Part Utama</td>
                                    <td width="45%" colspan="2" align="center">Part Pendukung</td>
                                </tr>
                            </table>
                        </div>                    
                        <div class="modal-footer">
                            <button id="btnEdit" style="width: 50%;" class="btn btn-info">Edit</button>
                            <button style="width: 50%;" class="btn btn-danger" data-dismiss="modal" onclick="tutup_part()">Tutup</button>
                            <button id="modal-part" data-toggle="modal" data-target="#modal_part" hidden></button>
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
        var qty_utama = 0, qty_pendukung = 0, qty_row = 0, id_mesin = 0;
        var arr_id_utama = [], arr_kode_utama = [], arr_id_pendukung = [], arr_kode_pendukung = [];
        var tabel_utama = document.getElementById('tabel_utama');
        var tabel_pendukung = document.getElementById('tabel_pendukung');
        var tabel_part = document.getElementById('tabel_part');

    // Load Dokumen
        $(document).ready(function() {
        $(".select").select2(); // Combo Live Search
        kosong();
        pagination();
    });

    // Kosong Isian
        function kosong() {
            document.getElementById("nomor").value = '';
            document.getElementById("nama_mesin").value = '';
            document.getElementById("deskripsi").value = '';
            document.getElementById("tahun").value = '';
            document.getElementById("kapasitas").value = '';
            $('#status').val('').change();
            $("#tabel_utama").find("tr:gt(0)").remove();
            $("#tabel_pendukung").find("tr:gt(0)").remove();
            document.getElementById("nomor").focus();

            qty_utama = 0;
            qty_pendukung = 0;
            id_mesin = 0;
        }

    // Pagination
        function pagination() {
            $('#data-table').DataTable().destroy();
            var datatabel = $('#data-table').DataTable({
                "paging": false,
                "columnDefs": [{"orderable": false, "targets": "_all"}],
                "order": [],
                "searching": false,
                "lengthChange": false,
                "info": false,
                "autoWidth": true,
                "scrollX": true,
                "scrollY": "400px",
                "dom": 'frtipB',
                "buttons": [{
                    text: 'Export Excel',
                    extend: 'excel',
                    exportOptions: {columns: ':visible'},
                    className: 'invisible excel',
                    title: 'LAPORAN DATA MESIN'
                }],
                "colReorder": true
            });
            setTimeout(function() {datatabel.columns.adjust().draw();}, 500);
        }

        function simpan() {  
            var nama_mesin = document.getElementById("nama_mesin").value;
            var deskripsi = document.getElementById("deskripsi").value;
            var tahun = document.getElementById("tahun").value;
            var status = document.getElementById("status").value;
            var nomor = document.getElementById("nomor").value;
            var kapasitas = document.getElementById("kapasitas").value;
            var id_part_utama = [], id_part_pendukung = [], id_utama = [], id_pendukung = [], lingkup_utama = [], lingkup_pendukung = [];

            for (var i=0; i<tabel_utama.rows.length-1; i++) {
                if (tabel_utama.rows[i+1].cells[5].innerHTML == '') {return;}
                id_utama.push(tabel_utama.rows[i+1].cells[5].innerHTML);

                lingkup = document.getElementsByName('lingkup_utama')[i].value;
                if (lingkup == '') {return;}
                lingkup_utama.push(lingkup);

                id_part_utama.push(tabel_utama.rows[i+1].cells[6].innerHTML);
            }
            for (var i=0; i<tabel_pendukung.rows.length-1; i++) {
                if (tabel_pendukung.rows[i+1].cells[5].innerHTML == '') {return;}
                id_pendukung.push(tabel_pendukung.rows[i+1].cells[5].innerHTML);

                lingkup = document.getElementsByName('lingkup_pendukung')[i].value;
                if (lingkup == '') {return;}
                lingkup_pendukung.push(lingkup);

                id_part_pendukung.push(tabel_pendukung.rows[i+1].cells[6].innerHTML);
            }

            var data = [nama_mesin, deskripsi, tahun, status, nomor, kapasitas, id_mesin, id_part_utama, id_part_pendukung, id_utama, id_pendukung, lingkup_utama, lingkup_pendukung];

            if (nama_mesin == '' || deskripsi == '' || tahun == '' || status == '' || nomor == '' || kapasitas == '') {return;}

            kosong();
            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/teknisi/mesin/simpan_mesin',
                data: {data: data},
                success: function(data) {
                    filter();
                    $('#btnUtama').click();
                }
            });
        }

    // Filter Data
        function filter() {
            var tahun = document.getElementById("ftahun").value;
            var cari = document.getElementById("cari").value;
            var data = [tahun, cari];

            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/teknisi/mesin/filter_mesin',
                data: {data: data},
                success: function(data) {
                    $('.data-table').html(data);
                    pagination();
                }
            });
        }

    // Tab Selection
        $('#btnUtama').on('click', function() {
            $('#utama').attr("style","display:block");
            $('#pendukung').attr("style","display:none");

            $('#btnUtama').attr('class','btn btn-block btn-info');
            $('#btnPendukung').attr('class','btn btn-block btn-default');
        });
        $('#btnPendukung').on('click', function() {
            $('#utama').attr("style","display:none");
            $('#pendukung').attr("style","display:block");

            $('#btnUtama').attr('class','btn btn-block btn-default');
            $('#btnPendukung').attr('class','btn btn-block btn-info');
        });

    // Tambah Part Utama
        $('#PartUtama').on('click', function() {
            qty_utama += 1;

            $('#tabel_utama').append(
                '<tr>' +
                '<td><input type="text" class="form-control" name="nomor_utama" style="width: 95%; text-align:center;" readonly></td>' +
                '<td><input type="text" class="form-control" name="kode_utama" style="width: 95%;" readonly></td>' +
                '<td><select class="form-control select" style="width: 95%;" onchange="utama(this)">' +
                '<option value="">Pilih Part..</option> ' +
                '<?php foreach ($material->result_array() as $dt): ?>' +
                '<option><?php echo $dt['NAMA'] . " -- " . $dt['SPESIFIKASI']; ?></option>' +
                arr_id_utama.push(<?php echo json_encode($dt['ID']); ?>) +
                arr_kode_utama.push(<?php echo json_encode($dt['KODE']); ?>) +
                '<?php endforeach; ?>' +
                '</select></td>' +
                '<td><select class="form-control select" style="width: 95%;" name="lingkup_utama">' +
                '<option value="">Pilih Lingkup..</option> ' +
                '<option>Mekanik</option>' +
                '<option>Listrik</option>' +
                '<option>Instrumen</option>' +
                '</select></td>' +
                '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_utama(this)" style="margin-top: 0;">X</button></td>' +
                '<td hidden></td>' +
                '<td hidden></td>' +
                '</tr>')

            $(".select").select2();
            isi_nomor_utama();
        });

    // Hapus Part Utama
        function hapus_utama(btn) {
            row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            isi_nomor_utama();
        };

    // Isi Nomor Utama
        function isi_nomor_utama() {
            for (var i=0; i<tabel_utama.rows.length-1; i++) {
                document.getElementsByName('nomor_utama')[i].value = i+1;
            }
        }

    // Isi Tabel Sementara (data yang akan disimpan)
        function utama(btn) {
            row = $(btn).closest("tr").index();
            index = btn.selectedIndex - 1;
            id = arr_id_utama[index];
            kode = arr_kode_utama[index];

            document.getElementsByName('kode_utama')[row-1].value = kode;
            tabel_utama.rows[row].cells[5].innerHTML = id;
        }    

    // Tambah Part Pendukung
        $('#PartPendukung').on('click', function() {
            qty_pendukung += 1;

            $('#tabel_pendukung').append(
                '<tr>' +
                '<td><input type="text" class="form-control" name="nomor_pendukung" style="width: 95%; text-align:center;" readonly></td>' +
                '<td><input type="text" class="form-control" name="kode_pendukung" style="width: 95%;" readonly></td>' +
                '<td><select class="form-control select" style="width: 95%;" onchange="pendukung(this)">' +
                '<option value="">Pilih Part..</option> ' +
                '<?php foreach ($material->result_array() as $dt): ?>' +
                '<option><?php echo $dt['NAMA'] . " -- " . $dt['SPESIFIKASI']; ?></option>' +
                arr_id_pendukung.push(<?php echo json_encode($dt['ID']); ?>) +
                arr_kode_pendukung.push(<?php echo json_encode($dt['KODE']); ?>) +
                '<?php endforeach; ?>' +
                '</select></td>' +
                '<td><select class="form-control select" style="width: 95%;" name="lingkup_pendukung">' +
                '<option value="">Pilih Lingkup..</option> ' +
                '<option>Mekanik</option>' +
                '<option>Listrik</option>' +
                '<option>Instrumen</option>' +
                '</select></td>' +
                '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_pendukung(this)" style="margin-top: 0;">X</button></td>' +
                '<td hidden></td>' +
                '<td hidden></td>' +
                '</tr>')

            $(".select").select2();
            isi_nomor_pendukung();
        });

    // Hapus Part Pendukung
        function hapus_pendukung(btn) {
            row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);

            isi_nomor_pendukung();
        };

    // Isi Nomor Pendukung
        function isi_nomor_pendukung() {
            for (var i=0; i<tabel_pendukung.rows.length-1; i++) {
                document.getElementsByName('nomor_pendukung')[i].value = i+1;
            }
        }

    // Isi Tabel Sementara (data yang akan disimpan)
        function pendukung(btn) {
            row = $(btn).closest("tr").index();
            index = btn.selectedIndex - 1;
            id = arr_id_pendukung[index];
            kode = arr_kode_pendukung[index];

            document.getElementsByName('kode_pendukung')[row-1].value = kode;
            tabel_pendukung.rows[row].cells[5].innerHTML = id;
        }

    // Tampil Part
        function show_part(btn) {
            var tabel_data = document.getElementById('data-table');

            $("#tabel_part").find("tr:gt(0)").remove();
            row = $(btn).closest("tr").index()+1;
            id_mesin = tabel_data.rows[row].cells[1].innerHTML;
            nama = tabel_data.rows[row].cells[4].innerHTML;

            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/teknisi/mesin/show_part',
                data: {data: id_mesin},
                success: function(data) {
                    var data = JSON.parse(data);
                    if (data.length > 0) {tampil_modal_part(data);}
                }
            });
            document.getElementById('judul_modal_part').innerHTML = nama;
            $('#modal-part').click();
        }
        function tampil_modal_part(data) {
            qty_utama = data[0]['QTY_UTAMA'];
            qty_pendukung = data[0]['QTY_PENDUKUNG'];

            if (qty_utama > qty_pendukung) {
                qty_row = qty_utama;
            }else{
                qty_row = qty_pendukung;
            }

            if(qty_row == 0) {return;}
            for (var i=0; i<qty_row; i++) {
                $('#tabel_part').append(
                    '<tr>' +
                    '<td align="center" width="5%">' + (i+1) + '</td>' +
                    '<td width="30%"></td>' +
                    '<td width="17.5%"></td>' +
                    '<td width="30%"></td>' +
                    '<td width="17.5%"></td>' +
                    '</tr>')
            }
            baris_utama = 0; baris_pendukung = 0;
            for (var i=0; i<data.length; i++) {
                if (data[i]['KOMPONEN'] == 'Utama') {
                    baris_utama++;
                    tabel_part.rows[baris_utama].cells[1].innerHTML = data[i]['NAMA'] + ' -- ' + data[i]['SPESIFIKASI'];
                    tabel_part.rows[baris_utama].cells[2].innerHTML = data[i]['LINGKUP'];   
                }else{
                    baris_pendukung++;
                    tabel_part.rows[baris_pendukung].cells[3].innerHTML = data[i]['NAMA'] + ' -- ' + data[i]['SPESIFIKASI'];
                    tabel_part.rows[baris_pendukung].cells[4].innerHTML = data[i]['LINGKUP'];   
                }
            }

        }

    // Edit Part
        $('#btnEdit').on('click',function() {
            $('#btnClose').click();        
            $("#tabel_utama").find("tr:gt(0)").remove();
            $("#tabel_pendukung").find("tr:gt(0)").remove();

            $.ajax({
                type: 'POST',
                url:'<?php echo base_url(); ?>index.php/teknisi/mesin/show_part',
                data: {data: id_mesin},
                success: function(data) {
                    var data = JSON.parse(data);

                // Isi Form
                    document.getElementById('nomor').value = data[0]['NOMOR'];
                    document.getElementById('nama_mesin').value = data[0]['NAMA_MESIN'];
                    document.getElementById('deskripsi').value = data[0]['DESKRIPSI'];
                    document.getElementById('kapasitas').value = data[0]['KAPASITAS'];
                    document.getElementById('tahun').value = data[0]['TAHUN'];
                    $('#status').val(data[0]['STATUS']).change();
                    document.getElementById('nomor').focus();

                    if (qty_row > 0) {isi_part(data);}
                }
            });
        });
        function isi_part(data) {
            for (var i=0; i<qty_utama; i++) {
                $('#tabel_utama').append(
                    '<tr>' +
                    '<td><input type="text" class="form-control" name="nomor_utama" style="width: 95%; text-align:center;" readonly></td>' +
                    '<td><input type="text" class="form-control" name="kode_utama" style="width: 95%;" readonly></td>' +
                    '<td><select class="form-control select" style="width: 95%;" name="nama_utama" onchange="utama(this)">' +
                    '<option value="">Pilih Part..</option> ' +
                    '<?php foreach ($material->result_array() as $dt): ?>' +
                    '<option><?php echo $dt['NAMA'] . " -- " . $dt['SPESIFIKASI']; ?></option>' +
                    arr_id_utama.push(<?php echo json_encode($dt['ID']); ?>) +
                    arr_kode_utama.push(<?php echo json_encode($dt['KODE']); ?>) +
                    '<?php endforeach; ?>' +
                    '</select></td>' +
                    '<td><select class="form-control select" style="width: 95%;" name="lingkup_utama">' +
                    '<option value="">Pilih Lingkup..</option> ' +
                    '<option>Mekanik</option>' +
                    '<option>Listrik</option>' +
                    '<option>Instrumen</option>' +
                    '</select></td>' +
                    '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_utama(this)" style="margin-top: 0;">X</button></td>' +
                    '<td hidden></td>' +
                    '<td hidden></td>' +
                    '</tr>')
            }
            for (var i=0; i<qty_pendukung; i++) {
                $('#tabel_pendukung').append(
                    '<tr>' +
                    '<td><input type="text" class="form-control" name="nomor_pendukung" style="width: 95%; text-align:center;" readonly></td>' +
                    '<td><input type="text" class="form-control" name="kode_pendukung" style="width: 95%;" readonly></td>' +
                    '<td><select class="form-control select" style="width: 95%;" name="nama_pendukung" onchange="pendukung(this)">' +
                    '<option value="">Pilih Part..</option> ' +
                    '<?php foreach ($material->result_array() as $dt): ?>' +
                    '<option><?php echo $dt['NAMA'] . " -- " . $dt['SPESIFIKASI']; ?></option>' +
                    arr_id_pendukung.push(<?php echo json_encode($dt['ID']); ?>) +
                    arr_kode_pendukung.push(<?php echo json_encode($dt['KODE']); ?>) +
                    '<?php endforeach; ?>' +
                    '</select></td>' +
                    '<td><select class="form-control select" style="width: 95%;" name="lingkup_pendukung">' +
                    '<option value="">Pilih Lingkup..</option> ' +
                    '<option>Mekanik</option>' +
                    '<option>Listrik</option>' +
                    '<option>Instrumen</option>' +
                    '</select></td>' +
                    '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_pendukung(this)" style="margin-top: 0;">X</button></td>' +
                    '<td hidden></td>' +
                    '<td hidden></td>' +
                    '</tr>')
            }
            baris_utama = 0; baris_pendukung = 0;
            for (var i=0; i<data.length; i++) {
                if (data[i]['KOMPONEN'] == 'Utama') {
                    document.getElementsByName('kode_utama')[baris_utama].value = data[i]['KODE'];   
                    document.getElementsByName('nama_utama')[baris_utama].value = data[i]['NAMA'] + ' -- ' + data[i]['SPESIFIKASI'];
                    document.getElementsByName('lingkup_utama')[baris_utama].value = data[i]['LINGKUP'];
                    baris_utama++;
                    tabel_utama.rows[baris_utama].cells[5].innerHTML = data[i]['ID_PART'];   
                    tabel_utama.rows[baris_utama].cells[6].innerHTML = data[i]['ID_TEK_PART'];   
                }else{
                    document.getElementsByName('kode_pendukung')[baris_pendukung].value = data[i]['KODE'];  
                    document.getElementsByName('nama_pendukung')[baris_pendukung].value = data[i]['NAMA'] + ' -- ' + data[i]['SPESIFIKASI'];
                    document.getElementsByName('lingkup_pendukung')[baris_pendukung].value = data[i]['LINGKUP'];
                    baris_pendukung++;
                    tabel_pendukung.rows[baris_pendukung].cells[5].innerHTML = data[i]['ID_PART'];   
                    tabel_pendukung.rows[baris_pendukung].cells[6].innerHTML = data[i]['ID_TEK_PART']; 
                }
            }

            isi_nomor_pendukung();
            isi_nomor_utama();
            $(".select").select2();
        }

    // Kosongkan Id Mesin
        function tutup_part() {
            id_mesin = 0;
        }

    </script>