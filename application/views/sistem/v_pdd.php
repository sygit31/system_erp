<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/topbar');
$this->load->view('dashboard/sidebar');
$this->load->view('dashboard/footer');
?>

<!-- Data Tables -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.css">

<!-- Datepicker -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/jquery-ui.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<!-- Combo Live Search -->
<link rel="stylesheet" href="<?php echo base_url() . 'assets/css/select2.min.css' ?>">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<style>body {padding-right: 0 !important} .select2-container--open {z-index: 9999999;} ul.select2-results__options li {font-size: 14px;}</style>

<div id="non_printable" class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">PDD (E-Document)</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool new_update" title="" data-toggle="modal" data-target="#modal_new" data-backdrop="static" data-keyboard="false"><i class="fa fa-inbox"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="table-responsive mt-2 mb-3 pb-2" style="font-size: 11px; overflow-y: hidden;">
                                <table style="width: 1100px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="15%" class="filter">Bagian</td>
                                            <td></td>
                                            <td width="12.5%" class="filter">Tipe</td>
                                            <td></td>
                                            <td width="15%" class="filter">Nomor</td>
                                            <td></td>
                                            <td width="10%" class="filter">Status</td>
                                            <td></td>
                                            <td width="12.5%" class="filter">Divisi</td>
                                            <td></td>
                                            <td width="15%" class="filter">Lingkup</td>
                                            <td></td>
                                            <td width="20%" class="filter">Judul</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="f_bagian" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($bagian->result_array() as $dt) { ?>
                                                        <?php if ($user[0] == $dt['KD_UNIT']) { ?>
                                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_tipe" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($tipe->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['KODE']; ?>" <?php if ($dt['KODE'] == 'B') {echo 'selected';} ?>><?php echo $dt['TIPE']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_nmr" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($nmr->result_array() as $dt) { ?>
                                                        <option><?php echo $dt['NMR']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_status" onchange="filter()" style="width: 100%; cursor: pointer;">
                                                    <option value="0">Kadaluarsa</option>
                                                    <option value="2" selected>Aktif</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_unit" onchange="isi_bagian(this, 'f_unit');" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($user[0] == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select" id="f_lingkup" onchange="filter()" style="width: 100%;">
                                                    <option value="All">All..</option>
                                                    <option value="1">PNP</option>
                                                    <option value="2">Konsorsium</option>
                                                    <option value="3">PNP-Konsorsium</option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" id="cari" class="form-control" onchange="filter()" placeholder="Ketikan judul.." style="width: 100%;" autocomplete="off">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="mt-2 table-responsive" style="width: 100%; font-size: 12px;">
                                <table id="tbl" class="table table-bordered table-striped" width="100%">
                                    <thead>
                                        <tr align="center">
                                            <th>No.</th>
                                            <th>Bagian</th>
                                            <th>Nomor Dokumen</th>
                                            <th>Tanggal Terbit</th>
                                            <th>Tipe Dokumen</th>
                                            <th>Nama Dokumen</th>
                                            <th>Revisi</th>
                                            <th>Pemilik</th>
                                            <th>Approval</th>
                                            <th>Sifat</th>
                                            <th>Keterangan</th>
                                            <th>View</th>
                                            <th>Edit</th>
                                            <th>Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </font>
                    </div>

                    <div class="card-footer">
                        <button type="button" id="btn_tambah" class="btn btn-info" onclick="hide_scroll(); page('tbl_lamp');" style="width: 120px;" title="Upload dokumen baru" data-toggle="modal" data-target="#modal_tambah" data-backdrop="static" data-keyboard="false" <?php if ($mn == '1') {echo 'hidden';} ?>><i class="fa fa-plus mr-2"></i><b>Baru</b></button>
                        <button type="button" class="btn btn-success" onclick="show_scroll()" style="width: 120px;" title="Export to Excel" onclick="$('.excel').click()" <?php if ($mn == '1') {echo 'hidden';} ?>><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
        </div>

        <div class="card card-info" <?php if ($mn == '1') {echo 'hidden';} ?>>
            <div class="card-header">
                <h3 class="card-title"><b><font color="White">Cetak DID dan DIF</font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="card-body">
                        <font size="2">
                            <div class="table-responsive mt-2 pb-2" style="font-size: 11px; overflow-y: hidden;">
                                <table style="width: 250px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="60%" class="filter">Divisi</td>
                                            <td></td>
                                            <td width="40%" class="filter">Tipe</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select_d" id="d_unit" onchange="filter_d()" style="width: 100%; cursor: pointer;">
                                                    <?php foreach ($unit->result_array() as $dt) { ?>
                                                        <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($user[0] == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <select class="select_d" id="d_tipe" onchange="filter_d()" style="width: 100%; cursor: pointer;">
                                                    <option>DID</option>
                                                    <option>DIF</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <div style="width: 1200px; font-size: 12px;">
                                    <table id="tbl_d" class="table table-bordered table-striped" width="100%">
                                        <thead>
                                            <tr align="center">
                                                <th width="6%">No.</th>
                                                <th width="12.5%">Nomor Dokumen</th>
                                                <th>Judul Dokumen</th>
                                                <th width="8%">Rev</th>
                                                <th width="12.5%">Pembuat Dokumen</th>
                                                <th width="12.5%">Disahkan</th>
                                                <th width="12.5%">Tgl. Berlaku</th>
                                                <th width="12.5%">Penerima Dokumen Soft Copy</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </font>
                    </div>

                    <div class="card-footer">
                        <button type="button" class="btn btn-success" style="width: 120px;" title="Export to Excel" onclick="$('.excel_d').click()"><i class="fa fa-clipboard mr-2"></i><b>Excel</b></button>
                    </div>
                </div>
            </div>

            <div class="card-footer"><font color="Green" size="2">ERP @2019</font></div>
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

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body confirm" style="font-size: 36px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button id="btnYa" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-exclamation mr-2"></i><b>YES</b></button>
                <button id="btnNo" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-share mr-2"></i>NO</b></button>
                <button id="btnHapus" data-toggle="modal" data-target="#modal_hapus" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data View SOP -->
<div class="modal fade" id="modal_view" style="z-index: 9999999;">
    <div class="modal-dialog" style="margin-left: 20px; max-width: 100%;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2 d-flex align-items-center" style="cursor: all-scroll; height: 80px;">
                <b><h4 class="text-white judul_sop">Prosedur Sistem</h4></b>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <div class="card mdb-color lighten-2 text-center z-depth-2 bg-dark mt-1 ml-2">
                        <div class="card-body">
                            <iframe id="file_pdf" style="width: 100%;"></iframe>
                            <!-- <div style="position: absolute; top: 0; left: 0; bottom: 0; right: 40px;"></div> -->
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card card-body file_pdf mt-1" style="overflow-y: scroll;">
                        <div class="mb-3">
                            <form>
                                <textarea id="teks" rows="4" maxlength="250" placeholder="Tulis sesuatu.." style="width: 100%; font-size: 10pt; font-family: aria-label"></textarea>
                                <button type="button" class="btn btn-block btn-success" id="post_komen"><i class="fa fa-share"></i><b> Post</b></button>
                            </form>
                        </div>
                        <div class="div_komen">
                            <div class="data_komen" hidden>
                                <div class="card p-2 bg-secondary">
                                    <div class="row ml-1 mt-1">
                                        <div class="col-md-1">
                                            <img class="img-circle" width="50" height="50">
                                        </div>
                                        <div class="col-md-10" align="right">
                                            <table style="text-align: right; font-family: aria-label;">
                                                <tr><th style="font-size: 13px;">Administrators</th></tr>
                                                <tr><td style="font-size: 12px">02-Nov-2022</td></tr>
                                                <tr><td style="font-size: 12px">14.00</td></tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="border-top: 2px solid #F2FDFB; width: 70%; margin: 10px; margin-left: 25%;"></div>
                                    <table>
                                        <tr><td class="table table-borderless text-justify p-1" style="font-size: 12px; text-align: left;">Komentar 1</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-footer rounded text-center m-3">
                <div class="input-group d-flex justify-content-center">
                    <button id="cetak_dist" name="" style="width: 120px;" type="button" class="btn btn-sm btn-success" onclick="cetak_dist(this)" title="Cetak Distribusi" data-dismiss="modal" <?php if ($mn == '1') {echo 'hidden';} ?>><i class="fa fa-print m-2"></i><b>Cetak Dist.</b></button>
                    <div style="width: 20px;"></div>
                    <button id="close_view" name="" style="width: 120px;" type="button" class="btn btn-sm btn-danger" onclick="show_scroll()" title="Tutup Dokumen" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Kembali</b></button>
                    <button id="btnView" data-toggle="modal" data-target="#modal_view" data-backdrop="static" data-keyboard="false" hidden></button>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card card-body m-3" style="height: 700px;">
                        <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                            <b><h4 class="text-white text-center">Daftar Lampiran</h4></b>
                        </div>
                        <table id="tbl_view_lamp" class="table table-bordered table-striped" style="width: 100%;">
                            <thead align="center">
                                <th width="15%">No.</th>
                                <th>Judul</th>
                                <th width="15%">Lihat</th>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card card-body m-3" style="height: 700px;">
                        <iframe id="prev_lamp_view" class='embed-responsive-item mr-4 mb-2 ml-4' style="height: 700px; width: auto;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah SOP -->
<div class="modal fade" id="modal_tambah" style="overflow-x: hidden; z-index: 9999999;">
    <div class="modal-dialog" style="max-width: 900px; margin: auto; margin-top: 30px; margin-bottom: 30px;">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center judul_sop">Upload E-Document</h4></b>
            </div>
            <div class="modal-body" style="font-size: 13px;">
                <div class="card-body card">
                    <div class="row input">
                        <div class="col-md-6">
                            <table width="100%">
                                <tr>
                                    <th width="40%">Tanggal</th>
                                    <td width="60%">
                                        <input type="text" id="tgl" class="form-control datepicker" value="<?php echo date('d-M-Y', strtotime('-0 days')) ?>" style="width: 90%; background-color: white; cursor: pointer;" readonly>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Nomor Dokumen</th>
                                    <td>
                                        <input type="text" id="nmr" class="form-control" name="" onfocusout="isi_revisi()" maxlength="50" style="width: 90%; text-transform: uppercase;" autocomplete="off">
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Divisi</th>
                                    <td>
                                        <select class="select" id="unit" onchange="isi_bagian(this, 'unit')" style="width: 90%;">
                                            <?php foreach($unit->result_array() as $dt) { ?>
                                                <option value="<?php echo $dt['KD_UNIT']; ?>" <?php if ($user[0] == $dt['KD_UNIT']) {echo "selected";} ?>><?php echo $dt['UNIT']; ?></option>                       
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th >Bagian</th>
                                    <td>
                                        <select class="select" id="bagian" style="width: 90%;">
                                            <option value="">Pilih..</option>
                                            <?php foreach ($bagian->result_array() as $dt) { ?>
                                                <?php if ($user[0] == $dt['KD_UNIT']) { ?>
                                                    <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['BAGIAN']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Tipe Dokumen</th>
                                    <td>
                                        <select class="select" id="tipe" style="width: 90%;">
                                            <option value="">Pilih..</option>
                                            <?php foreach ($tipe->result_array() as $dt) { ?>
                                                <option value="<?php echo $dt['KODE']; ?>"><?php echo $dt['TIPE']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Revisi</th>
                                    <td>
                                        <input type="text" id="revisi" class="form-control" value="0" style="width: 100%;" readonly>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                            </table>                            
                        </div>
                        <div class="col-md-6">
                            <table width="100%">
                                <tr>
                                    <th width="40%">Nama Dokumen</th>
                                    <td width="60%">
                                        <textarea class="form-control" id="nama" rows="2" style="width: 100%; font-size: 14px;" autocomplete="off"></textarea>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Pemilik Dokumen</th>
                                    <td>
                                        <select class="select" id="pemilik" style="width: 100%;">
                                            <option value="">Pilih..</option>
                                            <?php foreach ($pengesah->result_array() as $dt) { ?>
                                                <?php $nama = $dt['JABATAN'] == $dt['BAGIAN'] ? $dt['JABATAN'] : $dt['JABATAN'] . ' ' . $dt['BAGIAN']; ?>
                                                <option><?php echo $nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Approval</th>
                                    <td>
                                        <select class="select" id="pengesah" style="width: 100%;">
                                            <option value="">Pilih..</option>
                                            <?php foreach ($pengesah->result_array() as $dt) { ?>
                                                <?php $nama = $dt['JABATAN'] == $dt['BAGIAN'] ? $dt['JABATAN'] : $dt['JABATAN'] . ' ' . $dt['BAGIAN']; ?>
                                                <option><?php echo $nama; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Sifat Dokumen</th>
                                    <td>
                                        <select class="select" id="sifat" style="width: 100%;">
                                            <option value="1">Umum</option>
                                            <option value="2">Rahasia</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                                <tr>
                                    <th>Lingkup</th>
                                    <td>
                                        <select class="select" id="lingkup" style="width: 100%;">
                                            <option value="1">PNP</option>
                                            <option value="2">Konsorsium</option>
                                            <option value="3">PNP-Konsorsium</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr style="height: 10px;"></tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer rounded ml-3 mr-3 mb-3">
                <div class="row" style="width: 100%;">
                    <div class="col-md-5 font-weight-bold text-danger">
                        <font><h3 class="error_isian invisible">Error isian..</h3></font>
                    </div>
                    <div class="col-md-7 text-right">
                        <input type="file" id="file" onchange="open_file(this)" hidden>
                        <button style="width: 120px;" type="button" class="btn btn-sm btn-warning" onclick="$('#file').click();" title="Upload Dokumen"><i class="fa fa-upload m-2"></i><b>Browse</b></button>
                        <button style="width: 120px;" type="button" class="btn btn-sm btn-success" onclick="simpan()" title="Simpan Dokumen"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                        <button id="btn_tutup" style="width: 120px;" type="button" class="btn btn-sm btn-danger" title="Tutup Dokumen" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Tutup</b></button>
                    </div>
                </div>
            </div>
            <iframe id="prev_pdf" class='embed-responsive-item mr-4 mb-2 ml-4' style="height: 400px; width: auto;"></iframe>

            <div class="card card-body m-3" style="min-height: 700px;">
                <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                    <b><h4 class="text-white text-center">Daftar Lampiran</h4></b>
                </div>

                <input type="file" id="filelamp" onchange="open_lamp()" multiple hidden>
                <button style="width: 120px;" type="button" class="btn btn-sm btn-secondary m-2" onclick="$('#filelamp').click();" title="Upload Dokumen"><i class="fa fa-plus m-2"></i><b>Tambah</b></button>
                <table id="tbl_lamp" class="table table-bordered table-striped" width="95%">
                    <thead align="center">
                        <th width="15%">No.</th>
                        <th>Judul</th>
                        <th width="10%">Lihat</th>
                        <th width="10%">Buang</th>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal-content" style="display: none;">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white text-center judul_sop">Preview Lampiran</h4></b>
            </div>
            <iframe id="prev_lamp_add" class='embed-responsive-item mr-4 mb-2 ml-4' style="height: 700px; width: auto;"></iframe>
            <div class="modal-footer rounded ml-3 mr-3 mb-3">
                <div class="col-md-7 text-right">
                    <button type="button" style="width: 120px;" class="btn btn-sm btn-danger" onclick="close_view()" title="Tutup Dokumen"><i class="fa fa-refresh m-2"></i><b>Tutup</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data Distribusi -->
<div class="modal fade" id="modal_new">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header bg-info rounded m-2" style="cursor: all-scroll; height: 50px;">
                <b><h4 class="text-white">Daftar Dokumen Baru</h4></b>
            </div>
            <div class="card-body">
                <table id="tbl_new" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
                    <thead>
                        <tr align="center">
                            <th>No</th>
                            <th>Tanggal Terbit</th>
                            <th>Tipe</th>
                            <th>Nomor Dokumen</th>
                            <th>Nama</th>
                            <th>Revisi</th>
                            <th>Distribusi Oleh</th>
                            <th>View</th>
                            <th>Action</th>
                            <th>Batal</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer rounded">
                <button style="width: 150px;" type="button" class="btn btn-warning" title="Keluar Data" data-dismiss="modal"><i class="fa fa-refresh m-2"></i><b>Kembali</b></button>
            </div>
        </div>
    </div>
</div>

<div id="printable_d" style="display: none; overflow: hidden;">
    <table id="print_body" class="table table-bordered mt-2" style="line-height: 14px;">
        <thead>
            <tr style="border-bottom: hidden!important;">
                <td class="align-middle text-center" rowspan="3" colspan="3">
                    <img src="<?php echo base_url();?>assets/images/logo_pnp.png" class="img-responsive" style="width: 250px; height: 50px; border: none;">
                </td>
                <td class="align-middle text-center" rowspan="3" colspan="3" style="font-size: 24px;">LEMBAR DISTRIBUSI DAN TARIK</td>
                <td style="border-right: hidden!important;">Revisi</td>
                <td>:</td>
            </tr>
            <tr style="border-bottom: hidden!important;">
                <td style="border-right: hidden!important;">Halaman</td>
                <td>:</td>
            </tr>
            <tr>
                <td style="border-right: hidden!important;"></td>
                <td></td>
            </tr>
            <tr style="border-bottom: hidden!important;">
                <td colspan="2" style="border-right: hidden!important;">Nomor Dokumen</td>
                <td colspan="4" style="border-right: hidden!important;">:</td>
                <td style="border-right: hidden!important;">Revisi</td>
                <td>:</td>
            </tr>
            <tr>
                <td colspan="2" style="border-right: hidden!important;">Nama Dokumen</td>
                <td colspan="4" style="border-right: hidden!important;">:</td>
                <td style="border-right: hidden!important;">Tgl. Terbit</td>
                <td>:</td>
            </tr>
            <tr>
                <td width="5%" style="border-right: hidden!important;"></td>
                <td width="5%" style="border-right: hidden!important;"></td>
                <td width="12.5%" style="border-right: hidden!important;"></td>
                <td width="12.5%" style="border-right: hidden!important;"></td>
                <td width="15%" style="border-right: hidden!important;"></td>
                <td width="15%" style="border-right: hidden!important;"></td>
                <td width="15%" style="border-right: hidden!important;"></td>
                <td width="15%"></td>
            </tr>
            <tr align="center">
                <td>No.</td>
                <td colspan="3">Penerima</td>
                <td>Tanggal Distribusi</td>
                <td>Tanggal Terima</td>
                <td>Tanggal Tarik</td>
                <td>Ttd</td>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Data Tables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/script.js?=2"></script>

<script>

// Defined Variable
    var dt_upload = [[], []], dt_hapus_lamp = [];

// Load Dokumen
    $(document).ready(function() {
        $('.fa-bars:eq(0)').click();
        $(".select").select2();
        $(".select_d").select2({minimumResultsForSearch: -1});
        $('.selection').css({'font-size': '13px'});
        $(".datepicker").datepicker({dateFormat: 'dd-M-yy'});

        filter();
        filter_d();
        resize();
    });

// Resize Page
    $(window).resize(function(){
        resize();
    });

// Change Background
    function resize() {
        var screen_width = window.innerWidth;
        var screen_height = window.innerHeight;

        $('#file_pdf').css('height', screen_height + 'px');
        $('.file_pdf').css('max-height', screen_height + 'px');
        if (screen_width > 700) {
            $('.input table:eq(0) input, .input table:eq(0) .select2-container').css('width','90%');
        }else{
            $('.input input, .input .select2-container').css('width','100%');
        }
    }

// Error Isian
    function error_isian(str) {
        $('.error_isian').removeClass('invisible');
        $('.error_isian').html(str);
        $('#btnIsian').click();
        setTimeout(function() {$('.error_isian').addClass('invisible');}, 4000);
        throw new Error("Isian salah..");
    }

// Pilih File Foto
    function open_file(btn) {
        var allow_extension = ['PDF'];
        var reader = new FileReader();
        var file = $('#file').get(0).files[0];
        var filename = (file['name']).split('.');
        var extension = filename[filename.length-1];
        var size = file.size;

        if (size > 5000000) {del_file(); error_isian('Max. Ukuran File 5 Mb..');}
        if (allow_extension.indexOf(extension.toUpperCase()) != -1) {
            reader.onload = function(e) {
                $('#prev_pdf').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);
        }else{
            del_file();
            error_isian('Format harus PDF..');
        }
    }

// Hapus Preview Foto
    function del_file() {
        document.getElementById('file').value = '';
        $('#prev_pdf').attr('src', '');
    }
    function del_filelamp() {
        document.getElementById('filelamp').value = '';
    }

// Isi Data Revisi
    function isi_revisi() {
        var id_edit = $('#nmr').attr('name');
        var nmr = $('#nmr').val();
        var data = [id_edit, nmr];

        $.ajax({
            async: false,
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/pdd/isi_revisi" ?>',
            success: function(data) {
                data = JSON.parse(data);
                rev = data == null ? 0 : data.REV;
                revisi = id_edit == '' ? Number(rev) + 1 : Number(rev);

                if (data != null) {$('#unit').val(data.KD_UNIT).change();}
                $('#bagian').val(data == null ? '' : data.ID_BAGIAN).change();
                $('#tipe').val(data == null ? '' : data.KODE_TIPE).change();
                $('#revisi').val(data == null ? '0' : revisi).change();
                $('#nama').val(data == null ? '' : data.NAMA).change();
                $('#pemilik').val(data == null ? '' : data.PEMILIK).change();
                $('#pengesah').val(data == null ? '' : data.PENGESAH).change();
                $('#sifat').val(data == null ? '1' : data.SIFAT).change();
                $('#lingkup').val(data == null ? '1' : data.LINGKUP).change();
            }
        });
    }

// Pagination Data
    function pagination() {
        $('#tbl').DataTable().destroy();
        var tbl = $('#tbl').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true,
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'excel invisible',
                title: 'Data Laporan E-Document'
            }],
            "columnDefs": [{"orderable": false, "targets": "_all"}, {width: 80, targets: 3}],
            "order": []
        });

        setTimeout(function() {tbl.columns.adjust().draw();}, 500);
    }

// Isi Bagian Sesuai Unit
    function isi_bagian(btn, str) {
        var unit = $('#unit').val();
        var f_unit = $('#f_unit').val();
        var dt_bagian = <?php echo json_encode($bagian->result_array()); ?>;

        if (str == 'unit') {
            $('#bagian option:gt(0)').remove();

            dt_bagian.forEach(function(e) {
                if (unit == e.KD_UNIT) {
                    $('#bagian').append('<option value="'+e.ID+'">'+e.BAGIAN+'</option>');
                }
            });
            $('#bagian').change();
        }else{
            $('#f_bagian option:gt(0)').remove();

            dt_bagian.forEach(function(e) {
                if (f_unit == e.KD_UNIT) {
                    $('#f_bagian').append('<option value="'+e.ID+'">'+e.BAGIAN+'</option>');
                }
            });
            $('#f_bagian').change();
        }
    }

// Filter Data
    function filter() {
        var bagian = $('#f_bagian').val();
        var tipe = $('#f_tipe').val();
        var status = $('#f_status').val();
        var unit = $('#f_unit').val();
        var lingkup = $('#f_lingkup').val();
        var nmr = $('#f_nmr').val();
        var cari = $('#cari').val().toUpperCase();
        var id_kary = <?php echo json_encode($user[1]); ?>;
        var lev_kary = <?php echo json_encode($user[2]); ?>;
        var id_bagian_pic = <?php echo json_encode($user[3]); ?>;
        var menu = <?php echo json_encode($mn); ?>;
        var dist = <?php echo json_encode($dist); ?>;
        var data = [bagian, tipe, status, unit, id_kary, lev_kary, id_bagian_pic, lingkup, nmr, cari, menu];

        $('#tbl').DataTable().destroy();
        $('#tbl tbody tr').remove();
        $('#btnProgress').click();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url() . "index.php/sistem/pdd/filter" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    for (var i=0; i<data.length; i++) {
                        sifat = data[i].SIFAT == '1' ? 'Umum' : 'Rahasia';
                        status = data[i].STATUS;
                        $('#tbl tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].BAGIAN+'</td><td>'+data[i].NMR+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+data[i].TIPE+'</td><td>'+data[i].NAMA+'</td><td align="center">'+data[i].REV+'</td><td align="center">'+data[i].PEMILIK+'</td><td align="center">'+data[i].PENGESAH+'</td><td>'+sifat+'</td><td>'+data[i].KETERANGAN+'</td><td align="center"><button type="button" class="btn btn-block btn-info btn-sm del" title="View Dokumen" style="width: 50px;" onclick="view(this)" name="'+data[i].ID+'"><i class="fa fa-tv"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" style="width: 50px;" onclick="edit(this)" name="'+data[i].ID+'"><i class="fa fa-check-square-o"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm del" title="Hapus Data" style="width: 50px;" onclick="hapus(this)" name="'+data[i].ID+'"><i class="fa fa-trash"></i></button></td></tr>');
                        if (status == '0') {$('#tbl tbody tr:eq('+i+') button:gt(0)').hide();}
                    }
                    if (menu == '1') {$('#tbl th:gt(11), #tbl td:nth-child(13), #tbl td:nth-child(14)').hide();}

                    filter_new();
                    setTimeout(function() {$('#btnOk').click(); pagination();}, 500);
                }
            });
        }, 300);
    }

// View Dokumen
    function view(btn) {
        var aksi = $(btn).attr('class').split(' ')[4];
        var id_view = $(btn).attr('name');
        var dir = <?php echo json_encode(base_url()); ?> + 'assets/pdd/';

        $('#cetak_dist').attr('name', id_view);
        $('#close_view').attr('name', aksi);
        $('#btnView').click();
        $.ajax({
            async: false,
            data: {data: id_view},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/pdd/view" ?>',
            success: function(data) {
                data = JSON.parse(data);
                dt_master = data[0];
                dt_komen = data[1];
                dt_view = data[2];

                if (dt_master.QTY_DIST == 0) {$('#cetak_dist').hide();}else{$('#cetak_dist').show();}
                isi_komen(id_view, dt_komen);
                isi_lamp(dt_view);

                status = dt_master.STATUS == '0' ? 'bg-danger' : 'bg-info';
                filename = dir + id_view + '.pdf#toolbar=0';
                $('#file_pdf').attr('src', filename);
                $('#modal_view .card-header').removeClass('bg-info bg-danger').addClass(status);

                $('.judul_sop:eq(0)').html(dt_master.NMR + ' - ' + dt_master.NAMA);
                resize();
                hide_scroll();
            }
        });
    }

// Isi Daftar Lampiran
    function isi_lamp(dt_view) {
        $('#tbl_view_lamp').DataTable().destroy();
        $('#tbl_view_lamp tbody tr').remove();
        $('#prev_lamp_view').attr('src', '');

        for (var i=0; i<dt_view.length; i++) {
            $('#tbl_view_lamp tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+dt_view[i].JUDUL+'</td><td><button type="button" class="btn btn-block btn-warning" name="'+(dt_view[i].ID + '@_' + dt_view[i].EXT)+'" onclick="preview_lamp(this)" title="Preview" style="margin-top: 0; text-align: center;"><i class="fa fa-tv"></button></td></tr>');
        }

        page('tbl_view_lamp');
    }

// Tutup View & Open New Document
    $('#close_view').click(function() {
        var aksi = $('#close_view').attr('name');

        if (aksi == 'sub') {$('.new_update:eq(0)').click();}
    });

// Isi Komentar
    function isi_komen(id_view, dt_komen) {
        var dir = <?php echo json_encode(base_url() . "assets/pdd/"); ?>;

        $('#teks').attr('name', id_view);
        $(".data_komen:gt(0)").remove();
        for (var i=0; i<dt_komen.length; i++) {
            jkel = dt_komen[i].JKEL == 'P' ? 'people_p' : 'people_w';

            $(".data_komen:eq(0)").clone().appendTo(".div_komen");
            $('.data_komen:eq('+(i+1)+') table:eq(0) th:eq(0)').html(proper(dt_komen[i].NAMA));
            $('.data_komen:eq('+(i+1)+') table:eq(0) td:eq(0)').html(dt_komen[i].TGL);
            $('.data_komen:eq('+(i+1)+') table:eq(0) td:eq(1)').html(dt_komen[i].JAM);
            $('.data_komen:eq('+(i+1)+') table:eq(1) td:eq(0)').html(dt_komen[i].NOTE == null ? '' : dt_komen[i].NOTE.replaceAll('\n','<br>'));
            $('.data_komen:eq('+(i+1)+') img').attr('src', dir+jkel+'.jpg');
        }
        $(".data_komen:gt(0)").removeAttr('hidden');
    }

// Simpan Posting
    $('#post_komen').click(function() {
        var id_view = $('#teks').attr('name');
        var teks = $('#teks').val();
        var data = [id_view, teks];

        if (teks == '') {return;}

        $.ajax({
            data: {data: data},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/pdd/post_komen" ?>',
            success: function(data) {
                dt_komen = JSON.parse(data);
                isi_komen(id_view, dt_komen);
                $('#teks').val('');
            }
        });
    });

// Kosong Isian
    function kosong() {
        $('#bagian').val('').change();
        $('#tipe').val('').change();
        $('#nmr').val('').change();
        $('#nama').val('').change();
        $('#pemilik').val('').change();
        
        del_file();
    }
    function kosong_lamp() {
        $('#tbl_lamp').DataTable().destroy();
        $('#tbl_lamp tbody tr').remove();
        page('tbl_lamp'); del_filelamp();
        dt_hapus_lamp = [];
    }

// Simpan Dokumen
    function simpan() {
        var form_data = new FormData();
        var file = $('#file').get(0).files[0];
        var qty_lamp = !$('[name="nmr"]:eq(0)').length ? 0 : $('#tbl_lamp tbody tr').length;
        var urut_lamp = 0;

        var id_edit = $('#nmr').attr('name');
        var tgl = $('#tgl').val();
        var kd_unit = $('#unit').val();
        var id_bagian = $('#bagian').val();
        var tipe = $('#tipe').val();
        var nmr = $('#nmr').val().toUpperCase();
        var revisi = $('#revisi').val();
        var nama = $('#nama').val();
        var pemilik = $('#pemilik').val();
        var pengesah = $('#pengesah').val();
        var sifat = $('#sifat').val();
        var lingkup = $('#lingkup').val();
        var data = [id_edit, tgl, kd_unit, id_bagian, tipe, nmr, revisi, nama, pemilik, pengesah, sifat, lingkup, qty_lamp, dt_hapus_lamp];

        if (id_bagian == '') {error_isian('Bagian belum diisi..');}
        if (tipe == '') {error_isian('Tipe belum diisi..');}
        if (nmr == '') {error_isian('Nomor belum diisi..');}
        if (nama == '') {error_isian('Judul belum diisi..');}
        if (pemilik == '') {error_isian('Pemilik belum diisi..');}
        if (pengesah == '') {error_isian('Pengesah belum diisi..');}

        form_data.append('data', JSON.stringify(data));
        file == undefined ? form_data.append('file', '') : form_data.append('file', file);

        for (var i=0; i<qty_lamp; i++) {
            judul = document.getElementsByName('judul')[i].value;
            id_edit = $('#tbl_lamp .btn-info:eq('+i+')').attr('name').split('@_')[0];
            filelamp = id_edit == '' ? $('[name="filelamp"]:eq('+i+')')[0].files[0] : '';
            urut_lamp = id_edit == '' ? urut_lamp : urut_lamp++;

            form_data.append('filelamp_' + i, filelamp);
            form_data.append('filename_' + i, judul);
            form_data.append('edit_' + i, id_edit);

            if (judul == '') {error_isian('Judul Lampiran belum diisi..');}
        }

        $('#btn_tutup').click();
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/pdd/simpan" ?>',
            data: form_data,
            contentType: false,
            processData: false,
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk').click();
                    $('#btnSukses').click();
                    kosong();
                    kosong_lamp();
                    filter();
                    filter_new();
                }, 500);
            }
        });    
    }

// Tutup Dokumen
    $('#btn_tutup').click(function() {
        if ($('#nmr').attr('name') != '') {
            $('#nmr').attr('name', '');
            $('#tgl').val(<?php echo json_encode(date('d-M-Y')); ?>).change();
            $('#unit').val(<?php echo json_encode($user[0]); ?>).change();
            $('#bagian').val('').change();
            $('#tipe').val('').change();
            $('#nmr').val('').change();
            $('#revisi').val('0').change();
            $('#nama').val('').change();
            $('#pemilik').val('').change();
            $('#sifat').val('1').change();
            $('#lingkup').val('1').change();
            del_file();
            kosong_lamp();
        }
        show_scroll();
    });

// Edit Data Dokumen
    function edit(btn) {
        var id_edit = $(btn).attr('name');
        var path = <?php echo json_encode(base_url() . 'assets/pdd/'); ?>;
        var rand = '?='  + Date.now();

        $('#nmr').attr('name', id_edit);
        $('#btn_tambah').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() . "index.php/sistem/pdd/edit" ?>',
            data: {data: id_edit},
            success: function(data) {
                data = JSON.parse(data);
                dt_master = data[0];
                dt_lamp = data[1];
                pdf = path + id_edit + '.pdf';

                $('#tgl').val(format_date(dt_master.TGL)).change();
                $('#unit').val(dt_master.KD_UNIT).change();
                $('#bagian').val(dt_master.ID_BAGIAN).change();
                $('#tipe').val(dt_master.KODE_TIPE).change();
                $('#nmr').val(dt_master.NMR).change();
                $('#revisi').val(dt_master.REV).change();
                $('#nama').val(dt_master.NAMA).change();
                $('#pemilik').val(dt_master.PEMILIK).change();
                $('#pengesah').val(dt_master.PENGESAH).change();
                $('#sifat').val(dt_master.SIFAT).change();
                $('#lingkup').val(dt_master.LINGKUP).change();
                $('#prev_pdf')[0].setAttribute('src', pdf + rand);

                for (var i=0; i<dt_lamp.length; i++) {
                    $('#tbl_lamp').DataTable().destroy();
                    add_lamp('', dt_lamp[i].JUDUL, dt_lamp[i].ID, dt_lamp[i].EXT);
                    nomor();
                    page('tbl_lamp');
                }
            }
        });
    }

// Notifikasi Hapus Data
    function hapus(btn) {
        var aksi = $(btn).attr('class').split(' ')[4];
        var mn = <?php echo json_encode($mn); ?>;
        var id_hapus = $(btn).attr('name');
        var id_input = <?php echo json_encode($user[5]); ?>;
        var kd_unit = <?php echo json_encode($user[0]); ?>;
        var id_bagian = <?php echo json_encode($user[3]); ?>;
        var confirm = aksi == 'del' || aksi == 'sub_del' ? 'Yakin akan menghapus dokumen?' : (mn == '1' ? 'Yakin menerima dokumen?' : 'Yakin akan distribusi dokumen?');
        var data = [id_hapus, aksi, id_input, kd_unit, mn, id_bagian];

        $('.confirm:eq(0)').html(confirm);
        $('#close_view').attr('name', aksi);
        $('#btnHapus').click();
        $('#btnYa').on('click', function() {
            if (id_hapus == '') {return;}

            $('#btnProgress').click();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "index.php/sistem/pdd/hapus" ?>',
                data: {data: data},
                success: function(data) {
                    setTimeout(function() {
                        $('#btnOk').click();
                        $('#btnSukses').click();
                        id_hapus = '';

                        filter();
                    }, 500);
                }
            });
        });

        $('#btnNo').on('click', function() {
            if (id_hapus == '') {return;}
            if (aksi == 'sub' || aksi == 'sub_del') {$('.new_update:eq(0)').click();}
            id_hapus = '';
        });
    }

// New Dokumen
    $('.new_update').click(function() {
        pagination_new();
    });

// Filter Data
    function filter_new() {
        var mn = <?php echo json_encode($mn); ?>;
        var nama = <?php echo json_encode($user[4]); ?>;
        var id_bagian = <?php echo json_encode($user[3]); ?>;
        var data = [mn, id_bagian];

        $('#tbl_new').DataTable().destroy();
        $('#tbl_new tbody tr').remove();
        setTimeout(function() {
            $.ajax({
                data: {data: data},
                type: 'POST',
                url: '<?php echo base_url() . "index.php/sistem/pdd/filter_new" ?>',
                success: function(data) {
                    data = JSON.parse(data);

                    font = mn == '1' ? 'fa-check-square-o' : 'fa-send';
                    submit = mn == '1' ? 'Receive' : 'Distribusi';
                    for (var i=0; i<data.length; i++) {
                        sifat = data[i].SIFAT == '1' ? 'Umum' : 'Rahasia';
                        status = data[i].STATUS;
                        $('#tbl_new tbody').append('<tr><td align="center">'+(i+1)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+data[i].TIPE+'</td><td>'+data[i].NMR+'</td><td>'+data[i].NAMA+'</td><td align="center">'+data[i].REV+'</td><td>'+proper(nama)+'</td><td align="center"><button type="button" class="btn btn-block btn-info btn-sm sub" title="View Dokumen" style="width: 50px;" onclick="view(this)" name="'+data[i].ID+'" data-dismiss="modal"><i class="fa fa-tv"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-warning btn-sm sub" title="'+submit+'" style="width: 50px;" onclick="hapus(this)" name="'+data[i].ID+'" data-dismiss="modal"><i class="fa '+font+'"></i></button></td><td align="center"><button type="button" class="btn btn-block btn-danger btn-sm sub_del" title="Batal Data" style="width: 50px;" onclick="hapus(this)" name="'+data[i].ID+'" data-dismiss="modal"><i class="fa fa-trash"></i></button></td></tr>');
                    }
                    $('.fa-inbox:eq(0)').removeClass('text-warning').addClass(data.length > 0 ? 'text-warning' : '');
                    $('.fa-inbox:eq(0)').html(data.length > 0 ? ' ' + data.length : '');
                    $('.new_update:eq(0)').attr('title', data.length > 0 ? 'Ada ' + data.length + ' dokumen baru' : 'Tidak ada dokumen baru');
                    $('#tbl_new th:eq(6)').html(mn == '1' ? 'Diterima oleh' : 'Dist. oleh');
                    $('#tbl_new th:eq(8)').html(mn == '1' ? 'Terima' : 'Distribusi');
                    if (mn == '1') {$('#tbl_new th:eq(9), #tbl_new td:nth-child(10)').hide();}

                    setTimeout(function() {pagination_new();}, 500);
                }
            });
        }, 300);
    }

// Pagination Data New
    function pagination_new() {
        $('#tbl_new').DataTable().destroy();
        var tbl = $('#tbl_new').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true,
            "columnDefs": [{"orderable": false, "targets": "_all"}, {width: 80, targets: 4}],
            "order": []
        });

        setTimeout(function() {tbl.columns.adjust().draw();}, 500);
    }

// Cetak Distribusi
    function cetak_dist(btn) {
        var id_cetak = btn.name;

        $('#print_body tbody tr').remove();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "index.php/sistem/pdd/cetak_dist" ?>',
                data: {data: id_cetak},
                success: function(data) {
                    data = JSON.parse(data);

                    $('#print_body thead tr:eq(0) td:eq(1)').html('LEMBAR DISTRIBUSI DAN TARIK <br><br>' + data[0].NMR);
                    $('#print_body thead tr:eq(0) td:eq(3)').html(': &nbsp &nbsp' + format_text(data[0].REV, 2));
                    $('#print_body thead tr:eq(3) td:eq(1)').html(': &nbsp &nbsp' + data[0].NMR);
                    $('#print_body thead tr:eq(4) td:eq(1)').html(': &nbsp &nbsp' + data[0].NAMA);
                    $('#print_body thead tr:eq(3) td:eq(3)').html(': &nbsp &nbsp' + format_text(data[0].REV, 2));
                    $('#print_body thead tr:eq(4) td:eq(3)').html(': &nbsp &nbsp' + format_date(data[0].TGL));

                    for (var i=0; i<data.length; i++) {
                        $('#print_body tbody').append('<tr><td align="center">'+(i+1)+'</td><td colspan="3">'+proper(data[i].PIC)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td align="center"></td></tr>');
                    }

                    // Print Area Table
                    var printable = document.getElementById('printable_d');
                    var non_printable = document.getElementById('non_printable');

                    printable.style.display = "";
                    non_printable.style.display = "none";
                    window.print();

                    printable.style.display = "none";
                    non_printable.style.display = "";
                }
            });
        }, 500);
        show_scroll();
    }

// Filter DID dan DIF
    function filter_d() {
        var kd_unit = $('#d_unit').val();
        var tipe = $('#d_tipe').val();
        var dist = tipe == 'DID' ? 'Semua Bagian' : 'Bagian Terkait';
        var data = [kd_unit, tipe];

        $('#btnProgress').click();
        $('#tbl_d').DataTable().destroy();
        $('#tbl_d tbody tr').remove();
        setTimeout(function() {
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url() . "index.php/sistem/pdd/filter_d" ?>',
                data: {data: data},
                success: function(data) {
                    data = JSON.parse(data);

                    for (var i=0; i<data.length; i++) {
                        $('#tbl_d tbody').append('<tr><td align="center">'+(i+1)+'</td><td>'+data[i].NMR+'</td><td>'+data[i].NAMA+'</td><td align="center">'+data[i].REV+'</td><td align="center">'+data[i].PEMILIK+'</td><td align="center">'+data[i].PENGESAH+'</td><td align="center">'+format_date(data[i].TGL)+'</td><td>'+dist+'</td></tr>');
                    }
                    if (tipe == 'DIF') {
                        $('#tbl_d th:eq(7)').html('Pengguna');
                        $('#tbl_d th:nth-child(5), #tbl_d th:nth-child(6), #tbl_d td:nth-child(5), #tbl_d td:nth-child(6)').hide();
                    }else{
                        $('#tbl_d th:eq(7)').html('Penerima Dokumen Soft Copy');
                        $('#tbl_d th, #tbl_d td').show();
                    }
                    setTimeout(function() {$('#btnOk').click(); pagination_d();}, 500);
                }
            });
        }, 500);
    }

// Pagination DID
    function pagination_d() {
        $('#tbl_d').DataTable().destroy();
        var tbl = $('#tbl_d').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true,
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {columns: ':visible'},
                className: 'excel_d invisible',
                title: 'Data Laporan DID'
            }],
            "columnDefs": [{"orderable": false, "targets": "_all"}],
            "order": []
        });

        setTimeout(function() {tbl.columns.adjust().draw();}, 500);
    }

    // Pilih File Lampiran
    function open_lamp() {
        var allow_extension = ['PDF', 'JPG', 'JPEG', 'PNG'];
        var qty_file = $('#filelamp').get(0).files.length;
        var add_data = qty_file == 0 ? '1' : $('#filelamp').get(0).files.length;

        $('#tbl_lamp').DataTable().destroy();
        for (var i=0; i<add_data; i++) {
            filename = qty_file == 0 ? '' : $('#filelamp').get(0).files[i].name;
            size = qty_file == 0 ? '' : $('#filelamp').get(0).files[i].size;
            extension = filename.split('.').pop().toUpperCase();

            if (size < 1000000000 && allow_extension.indexOf(extension.toUpperCase()) != -1) {
                data_file = $('#filelamp').get(0).files[i];
                judul = '', id_master = '', extension = '';

                add_lamp(data_file, judul, id_master, extension);
                nomor();
            }else{
                error_isian('Gagal mengambil file..');
            }
        }

        setTimeout(function() {page('tbl_lamp');}, 500);
    }

// Tambah Baris Lampiran
    function add_lamp(data_file, judul, id_master, extension) {
        var urut = $('#tbl_lamp tbody tr').length;
        var dataTransfer = new DataTransfer();

        $('#tbl_lamp tbody').append(
            '<tr">' +
            '<td><input type="text" class="form-control" name="nmr" style="text-align: center;" readonly><input type="file" name="filelamp" hidden></td>' +
            '<td><input type="text" class="form-control" name="judul" value="'+judul+'" autocomplete="off" maxlength="170"></td>' +
            '<td><button type="button" class="btn btn-block btn-info" name="'+(id_master + '@_' + extension)+'" onclick="preview_file(this)" title="Preview" style="margin-top: 0; text-align: center;"><i class="fa fa-tv"></button></td>' +
            '<td><button type="button" class="btn btn-block btn-danger" name="'+(id_master + '@_' + extension)+'" title="Hapus File" onclick="hapus_file(this)" style="margin-top: 0; text-align: center;" title="Hapus"><i class="fa fa-close"></button></td>' +
            '</tr>');

        if (data_file != '') {
            dataTransfer.items.add(data_file);
            $('[name="filelamp"]:eq('+urut+')')[0].files = dataTransfer.files;
        }
    }

// Update Nomor
    function nomor() {
        var qty_data = $('#tbl_lamp tbody tr').length;

        for (var i=0; i<qty_data; i++) {
            document.getElementsByName('nmr')[i].value = i+1;
        }
    }

// Preview Lampiran
    function preview_file(btn) {
        var id_master = btn.name.split('@_')[0];
        var ext = btn.name.split('@_')[1];
        var dir = <?php echo json_encode(base_url()); ?> + 'assets/pdd/lampiran/';
        var url = dir + id_master + '.' + ext;
        var index = $(btn).index('#tbl_lamp .btn-info');
        var filelamp = $('[name="filelamp"]:eq('+index+')')[0].files[0];

        if (btn.name != '@_') {
            $('#prev_lamp_add').attr('src', url).show();
        }else{
            var reader = new FileReader();
            var file = $('[name="filelamp"]:eq('+index+')')[0].files[0];

            reader.onload = function(e) {
                $('#prev_lamp_add').attr('src', e.target.result);
            }
            reader.readAsDataURL(file);

        }

        $("#modal_tambah .modal-content:eq(0)").fadeOut(300, function() {});
        $("#modal_tambah .modal-content:eq(1)").fadeIn(300, function() {});
    }

// Preview Lampiran Saat View
    function preview_lamp(btn) {
        var id_master = btn.name.split('@_')[0];
        var ext = btn.name.split('@_')[1];
        var dir = <?php echo json_encode(base_url()); ?> + 'assets/pdd/lampiran/';
        var url = dir + id_master + '.' + ext;

        $('#prev_lamp_view').attr('src', url);
    }

// Close Preview Lampiran
    function close_view() {
        $("#modal_tambah .modal-content:eq(1)").fadeOut(500, function() {});
        $("#modal_tambah .modal-content:eq(0)").fadeIn(500, function() {});
    }

// Hapus Lampiran
    function hapus_file(btn) {
        dt_hapus_lamp.push(btn.name);
        $('#tbl_lamp').DataTable().destroy();
        row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        nomor();
        page('tbl_lamp');
    };

// Drag Div Document
    $("#modal_view, #modal_tambah").draggable({handle: ".card-header"});

// Hide & Show Scroll Body
    function show_scroll() {$('html, body').css('overflow', '');}
    function hide_scroll() {$('html, body').css('overflow', 'hidden');}

</script>