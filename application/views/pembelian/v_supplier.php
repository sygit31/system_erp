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
<style>.select2-container--open {z-index: 9999999;}</style>

<div class="content-wrapper">
    <section class="content-header"></section>
    <section class="content">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"><b><font color="White"><div id="headerinput">Master Data Supplier</div></font></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" onclick="window.open('http://192.168.17.42/profits/assets/help/Pengadaan - Manual Book Master Supplier.pdf')"><i class="fa fa-binoculars" title="Help"></i></button>
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Kode Transaksi PO</th>
                                <td width="60%">
                                    <input type="text" class="form-control" id="kode" value="-" style="width: 200px; text-transform: uppercase;" maxlength="3" autocomplete="off" readonly>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Nama Supplier</th>
                                <td>
                                    <input type="text" class="form-control" id="nama_supplier" style="width: 100%; text-transform: uppercase;" maxlength="50" autocomplete="off">
                                    <select id="material_plus" hidden>
                                        <option value="">Pilih..</option>
                                        <?php foreach ($material->result_array() as $dt) : ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['NAMA'] . ' ' . $dt['SPESIFIKASI']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                        </table>
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-6"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Kode Keuangan</th>
                                <td width="60%">
                                    <div class="row">
                                        <div class="col-8">
                                            <input type="text" class="form-control" id="kode_keuangan" style="width: 100%; text-transform: uppercase;" readonly>
                                        </div>
                                        <div class="col-3">
                                            <button type="button" class="btn btn-success" onclick="pagination_supplier_sakti()" data-toggle="modal" data-target="#modal_supplier"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Tipe</th>
                                <td>
                                    <input type="text" class="form-control" id="tipe" style="width: 100%;" value="Baru" readonly>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <button type="button" class="btn btn-block btn-info" id="btnProfil">Profiling Company</button>
                        </td>
                        <td width="50%">
                            <button type="button" class="btn btn-block btn-default" id="btnMaterial">Material Supply</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-footer" id="profil">
                <div class="row">
                    <div class="col-md-5"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Alamat</th>
                                <td width="60%">
                                    <input type="text" class="form-control" id="alamat" style="width: 100%; text-transform: uppercase;" maxlength="50" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kota</th>
                                <td>
                                    <input type="text" class="form-control" id="kota" style="width: 100%; text-transform: uppercase;" maxlength="30" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Negara</th>
                                <td>
                                    <select class="select" id="negara" style="width: 100%; cursor: pointer;">
                                        <option value="">Pilih Negara..</option>
                                    </select>
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kode Pos</th>
                                <td>
                                    <input type="text" class="form-control" id="kode_pos" style="width: 100%;" autocomplete="off" maxlength="15" oninput="this.value = this.value.replace(/[^0-9,-]/g, '').replace(/(\..*)\./g, '$1');">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Phone</th>
                                <td>
                                    <input type="text" class="form-control" id="phone" maxlength="30" style="width: 100%; text-transform: uppercase;" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Fax</th>
                                <td>
                                    <input type="text" class="form-control" id="fax" maxlength="30" style="width: 100%; text-transform: uppercase;" autocomplete="off">
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-1"> 
                    </div>
                    <div class="col-md-6"> 
                        <table width="100%">
                            <tr>
                                <th width="40%">Rekening</th>
                                <td width="60%">
                                    <input type="text" class="form-control" id="rekening" style="width: 100%; text-transform: uppercase;" autocomplete="off" maxlength="50">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Email</th>
                                <td>
                                    <input type="email" class="form-control" id="email" style="width: 100%; text-transform: lowercase;" maxlength="30" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kontak Person</th>
                                <td>
                                    <input type="text" class="form-control" id="kontak" style="width: 100%; text-transform: uppercase;" maxlength="50" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Kontak Title</th>
                                <td>
                                    <input type="text" class="form-control" id="title" style="width: 100%; text-transform: uppercase;" maxlength="30" autocomplete="off">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>NPWP</th>
                                <td>
                                    <input type="text" class="form-control" id="npwp" style="width: 100%;" autocomplete="off" maxlength="15" oninput="this.value = this.value.replace(/[^0-9,-]/g, '').replace(/(\..*)\./g, '$1');">
                                </td>
                            </tr>
                            <tr style="height: 10px;"></tr>
                            <tr>
                                <th>Jenis Supplier</th>
                                <td>
                                    <select class="select" id="jenis" style="width: 100%;">
                                        <option value="">Pilih Jenis..</option>
                                        <?php foreach ($jenis->result_array() as $dt) : ?>
                                            <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['JENIS']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer" id="material" hidden>
                <div class="table-responsive">
                    <button type="button" class="btn btn-block text-white text-bold" id="addMaterial" style="width: 150px; margin-bottom: 10px; background-color: #3FB4F7;"><i class="fa fa-plus-square m-2"></i><b>Material</b></button>
                    <table id="tabel_material"  class="table table-bordered" style="width: 1500px;">
                        <thead style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
                            <tr style="text-align: center;">
                                <td width="5%">No</td>
                                <td width="8%">No. Part</td>
                                <td width="30%">Nama Material</td>
                                <td width="5%">Satuan</td>
                                <td width="10%">Lead Time (Hari)</td>
                                <td width="10%">Harga</td>
                                <td width="7%">Mata Uang</td>
                                <td width="10%">MOQ</td>
                                <td width="10%">Capacity<br>(per-hari)</td>
                                <td width="5%" style="background-color: #f7f7f7; border: 1px solid #f7f7f7;"></td>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div class="card-body">
                <table>
                    <tr>
                        <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnSimpan" onclick="simpan()" style="font-weight: bold;"><i class="fa fa-save m-2"></i><b>Simpan</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-warning" onclick="kosong()" title="Ambil Data Previous" data-toggle="modal" data-target="#modal-simpg"><i class="fa fa-backward m-2"></i><b>Load SIMPG</b></button></td>
                        <td width="10"></td>
                        <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnBatal" onclick="kosong()" style="font-weight: bold;"><i class="fa fa-ban m-2"></i><b>Batal</b></button></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">
                    <b>
                        <font color="White">Laporan Data Supplier</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn_collapse" onclick="collapse(this)" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <font size="2">
                    <div class="card">
                        <div class="card-body mb-2">
                            <div class="table-responsive">
                                <table style="width: 400px; margin-bottom: 10px;">
                                    <thead>
                                        <tr align="center" style="line-height: 30px;">
                                            <td width="40%" class="filter">Jenis Supplier</td>
                                            <td></td>
                                            <td width="60%" class="filter">Nama Supplier</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="select" id="fJenis" onchange="filter()" style="width: 100%;">
                                                    <option value="All">All..</option>
                                                    <?php foreach ($jenis->result_array() as $dt) : ?>
                                                        <option value="<?php echo $dt['ID']; ?>"><?php echo $dt['JENIS']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td>
                                                <input type="text" class="cari" id="cari" onkeyup="filter()" placeholder="Cari nama supplier.." style="width: 100%;" autocomplete="off">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="data-table"></div>
                    </div>
                </font>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table width="600">
                        <tr>
                            <td width="150"><button type="button" onclick="(function(){ $('.excel').click(); })();" class="btn btn-block btn-success" title="Export to Excel"><i class="fa fa-clipboard m-2"></i><b>Excel</b></button></td>
                            <td width="10"></td>
                            <td width="150"><button type="button" class="btn btn-block btn-primary" id="btnPreview" style="font-weight: bold;" title="Informasi Lebih"><i class="fa ion-clipboard m-2"></i><b>More Info</b></button></td>
                            <td width="10"></td>
                            <td width="150"><button type="button" class="btn btn-block btn-warning" id="btnAddMaterial" style="font-weight: bold;" title="Add Material" data-toggle="modal" data-target="#modal_add"><i class="fa fa-plus m-2"></i><b>Material</b></button></td>
                            <td width="10"></td>
                            <td width="150"><button type="button" class="btn btn-block btn-danger" id="btnHapus" style="font-weight: bold;" title="Hapus Data"><i class="fa ion-trash-a m-2"></i><b>Hapus</b></button></td>
                        </tr>
                    </table>
                </div>
            </div>
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
                <button id="btnOk_progress" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
                <button id="btnProgress" data-toggle="modal" data-target="#modal_progress" data-backdrop="static" data-keyboard="false"></button>
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
                <button id="btnOk" style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal" onclick="(function(){location.reload();})();"><i class="fa ion-android-checkmark-circle fa-lg mr-2"></i><b>OK</b></button>
                <button id="btnSukses" data-toggle="modal" data-target="#modal_sukses" data-backdrop="static" data-keyboard="false" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share fa-lg mr-2"></i><b>NO</b></button>
                <button id="ya" style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa ion-alert fa-lg mr-2"></i><b>YES</b></button>
                <button id="confirmHapus" data-toggle="modal" data-target="#modal_hapus" hidden></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="modal-preview" style="z-index: 9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
                <h3 class="card-title">
                    <b>
                        <font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;">More Information</font>
                    </b>
                </h3>
                <div class="card-tools">
                    <button id="btnClose" type="button" class="close" title="Close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table width="100%">
                    <tr>
                        <td width="50%">
                            <button type="button" class="btn btn-block btn-info" id="btnProfilPreview">Profiling Company</button>
                        </td>
                        <td width="50%">
                            <button type="button" class="btn btn-block btn-default" id="btnMaterialPreview">Material Supply</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="modal-body">
                <div class="tab1" style="overflow-y: scroll; height: 400px;">
                    <table id="tabel_profil_preview" class="table table-bordered" width="100%">
                        <tr>
                            <th width="30%">Nama Supplier</th>
                            <td width="70%"></td>
                        </tr>
                        <tr>
                            <th>Kode</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Fax</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kode Pos</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Negara</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kontak Person</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kontak Title</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kode Keuangan</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>No. Rekening</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Jenis Supplier</th>
                            <td></td>
                        </tr>
                    </table>
                </div>
                <div class="tab2 pb-4" style="display: none; overflow-x: scroll; font-size: 12px;">
                    <table id="tabel_material_preview" class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th width="10%" style="text-align: center;">No</th>
                                <th width="20%" style="text-align: center;">Nama Material</th>
                                <th width="10%" style="text-align: center;">Satuan</th>
                                <th width="15%" style="text-align: center;">Lead Time (Hari)</th>
                                <th width="10%" style="text-align: center;">Harga</th>
                                <th width="10%" style="text-align: center;">Mata Uang</th>
                                <th width="10%" style="text-align: center;">MOQ</th>
                                <th width="10%" style="text-align: center;">Capacity</th>
                                <th width="5%" hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button style="width: 30%;" class="btn btn-success" data-dismiss="modal" id="btnEdit" title="Edit Informasi"><i class="fa fa-check-square-o m-2"></i><b>Update</b></button>
                    <button id="btnTutup" style="width: 30%;" class="btn btn-danger" data-dismiss="modal" title="Tutup Informasi"><i class="fa fa-ban m-2"></i><b>Tutup</b></button>
                    <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Supplier SIMPG -->
<div class="modal fade" id="modal-simpg" style="z-index: 9999;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card-header bg-info m-2" style="cursor: all-scroll; border-radius: 8px;">
                <div style="font-size: 28px; color: #ffffff; font-weight: bold;"> Pilih Supplier dari SIMPG? </div>
            </div>
            <div class="modal-body">
                <div>
                    <table id="tbl_simpg" class="table table-bordered" width="100%">
                        <tr>
                            <th width="30%">Nama Supplier</th>
                            <td width="70%">
                                <?php $dt_supplier_simpg = array(); ?>
                                <select class="select" id="supplier_simpg" style="width: 100%; cursor: pointer;">
                                    <option value="">Pilih Nama..</option>
                                    <?php foreach ($supplier_simpg->result_array() as $dt) : ?>
                                        <option><?php echo $dt['NAMA']; ?></option>
                                        <?php array_push($dt_supplier_simpg, array($dt['KODE'], $dt['ALAMAT1'], $dt['KOTA'], $dt['TELPON'], $dt['CONTACT_PERSON'], $dt['KODE_KEUANGAN'])) ?>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kota</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kontak Person</th>
                            <td></td>
                        </tr>
                        <tr>
                            <th>Kode Keuangan</th>
                            <td></td>
                        </tr>
                        <tr hidden>
                            <th>Kode</th>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="modal-footer m-2">
                <button style="width: 50%;" id="pilih_simpg" class="btn btn-primary" data-dismiss="modal"><i class="fa ion-android-share mr-2"></i><b>Pilih</b></button>
                <button style="width: 50%;" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban mr-2"></i><b>Batal</b></button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Data Supplier -->
<div class="modal fade" id="modal_supplier">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header m-2 rounded" style="cursor: all-scroll;">
                    <h3 class="card-title">
                        <b>
                            <font color="White">
                                <div id="headerinput">
                                    <h3>Data Supplier Sakti</h3>
                                </div>
                            </font>
                        </b>
                    </h3>
                </div>
                <div class="card-body">
                    <?php $this->load->view('pembelian/v_supplier_sakti_table'); ?>
                </div>
                <div class="modal-footer rounded">
                    <button id='btnTutupSupplier' style="width: 150px;" type="button" class="btn btn-success" data-dismiss="modal" title="Tutup Informasi"><i class="fa ion-android-share m-2"></i><b>Tutup</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Material -->
<div class="modal fade" id="modal_add">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header m-2 rounded" style="cursor: all-scroll;">
                    <h3 class="card-title"><b><font color="White"><h3 id="nama_supplier_plus">Data Tambah Material Supply</h3></font></b></h3>
                </div>
                <div class="card-body table-responsive">
                    <div class="table-responsive pb-4">
                        <div style="width: 1450px;">
                            <table id="tbl_plus" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
                                <thead style="box-shadow: 0 0 0 5px #BFBFC8;">
                                    <tr align="center">
                                        <th width="7.5%">No</th>
                                        <th width="10%">Jenis</th>
                                        <th width="10%">Kode</th>
                                        <th width="20%">Nama Material</th>
                                        <th width="10%">Satuan</th>
                                        <th width="7.5%">Lead Time</th>
                                        <th width="10%">Harga</th>
                                        <th width="10%">Mata Uang</th>
                                        <th width="7.5%">MOQ</th>
                                        <th width="7.5%">Capacity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer rounded">
                    <button id='btnPlus' style="width: 150px;" type="button" class="btn btn-warning" title="Tambah Material"><i class="fa fa-plus m-2"></i><b>Tambah</b></button>
                    <button id='btnSimpanMaterial' style="width: 150px;" type="button" class="btn btn-success" data-dismiss="modal" title="Simpan Material Supply"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                    <button style="width: 150px;" type="button" class="btn btn-danger" data-dismiss="modal" title="Tutup Menu Tambah Material"><i class="fa ion-android-share m-2"></i><b>Tutup</b></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url(); ?>assets/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>

<!-- Export Excel -->
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.flash.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/JSZip-2.5.0/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/datatables/Buttons-1.5.6/js/buttons.print.min.js"></script>

<!-- Custom Script -->
<script src="<?php echo base_url(); ?>assets/js/script.js"></script>

<script>

// Defined Variable
    var row_select = '';
    var tbl_supplier, id_supplier = '', dt_material = [];

// Load Dokumen
    $(document).ready(function() {
        $(".select").select2();
        $('.fa-bars:eq(0)').click();
        $('#nama_supplier').focus();

        load_country();
        filter();
    });

// Load Country
    function load_country() {
        <?php
        $json = base_url() . "assets/js/countries.json";
        $data = file_get_contents($json);
        $country = json_decode($data, true);
        ?>
        var country = <?php echo json_encode($country); ?>;
        var negara = document.getElementById("negara");

        for (var i = 0; i < country.length; i++) {
            var option = document.createElement("option");
            option.text = country[i]['name'];
            negara.add(option);
        }
        $('#negara').val('Indonesia').change();
    }

// Isi Kode Transaksi
    $('#jenis').change(function() {
        var id_jenis = $('#jenis').val();

        if (id_jenis == '3') {
            kode = '-';
            $('#kode').removeAttr('readonly');
        }else if (id_jenis == '4') {
            kode = 'IMP';
            $('#kode').attr('readonly','');
        }else{
            kode = '-';
            $('#kode').attr('readonly','');
        }

        $('#kode').val(kode).change();
    });

// Pagination
    function pagination() {
        var data_table = $('#data-table').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "order": [[1, "asc"]],
            "autoWidth": true,
            "scrollX": true,
            "scrollY": '400px',
            "dom": 'frtipB',
            "buttons": [{
                text: 'Export Excel',
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                },
                className: 'invisible excel',
                title: 'Laporan Data Material'
            }],
            "colReorder": true
        });

        setTimeout(function() {data_table.columns.adjust().draw();}, 100);
    }

// Pagination Supplier Sakti
    function pagination_supplier_sakti() {
        $('#tbl_supplier').DataTable().destroy();
        var tbl_supplier = $('#tbl_supplier').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "info": false,
            "ordering": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px",
            "colReorder": true
        });

        setTimeout(function() {tbl_supplier.columns.adjust().draw();}, 500);
    }

// Pagination Preview
    function pagination_preview() {
        $('#tabel_material_preview').DataTable().destroy();
        $('#tabel_material_preview').DataTable({
            "paging": false,
            "lengthChange": false,
            "oLanguage": {"sSearch": "Cari :"},
            "order": [[0, "asc"]],
            "info": false,
            "autoWidth": true,
            "scrollX": true,
            "scrollY": "400px"
        });
    }

// Pilih Supplier Sakti
    function pilih_supplier_sakti(btn) {
        var tbl_supplier_sakti = document.getElementById('tbl_supplier');
        var row = $(btn).closest("tr").index() + 1;
        var kode = tbl_supplier_sakti.rows[row].cells[2].innerHTML;
        var nama = tbl_supplier_sakti.rows[row].cells[3].innerHTML;
        var alamat = tbl_supplier_sakti.rows[row].cells[9].innerHTML;
        var kota = tbl_supplier_sakti.rows[row].cells[10].innerHTML;
        var negara = tbl_supplier_sakti.rows[row].cells[11].innerHTML;
        var kode_pos = tbl_supplier_sakti.rows[row].cells[12].innerHTML;
        var phone = tbl_supplier_sakti.rows[row].cells[4].innerHTML;
        var fax = tbl_supplier_sakti.rows[row].cells[6].innerHTML;
        var email = tbl_supplier_sakti.rows[row].cells[5].innerHTML;
        var kontak = tbl_supplier_sakti.rows[row].cells[7].innerHTML;
        var npwp = tbl_supplier_sakti.rows[row].cells[8].innerHTML;

        $('#nama_supplier').val(nama).change();
        $('#kode_keuangan').val(kode).change();
        $('#alamat').val(alamat).change();
        $('#kota').val(kota).change();
        $('#negara').val(negara == '' ? 'Indonesia' : negara).change();
        $('#kode_pos').val(kode_pos).change();
        $('#phone').val(phone).change();
        $('#fax').val(fax).change();
        $('#rekening').val('').change();
        $('#email').val(email).change();
        $('#kontak').val(kontak).change();
        $('#title').val('').change();
        $('#npwp').val(npwp.substring(0, 15)).change();

        $('#btnTutupSupplier').click();
    }

// Tambah Produk
    $('#addMaterial').on('click', function() {
        $('#btnProgress').click();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>index.php/pembelian/supplier/ambil_material',
            data: {data: id_supplier},
            success: function(data) {
                data = JSON.parse(data);

                setTimeout(function() {
                    $('#btnOk_progress').click();
                    tambah_material(data);
                }, 500);
            }
        });

        function tambah_material(data) {
            var option = document.createElement('option');

            $('#tabel_material tbody').append(
                '<tr>' +
                '<td><input type="text" class="form-control" name="nmr_material" style="width: 100%; text-align:center;" readonly></td>' +
                '<td><input type="text" class="form-control" name="kode_material" style="width: 100%; text-align: center;" readonly></td>' +
                '<td><select class="form-control select" style="width: 100%;" name="nama_material" onchange="isi_kode_material(this)">' +
                '<option value="">Pilih Material..</option> ' +
                '</select></td>' +
                '<td><input type="text" class="form-control" name="satuan" style="width: 100%; text-align: center;" readonly></td>' +
                '<td><input type="number" class="form-control" name="lead_time" value="0" style="width: 100%; text-align: center;"></td>' +
                '<td><input type="number" class="form-control" name="harga" value="0" style="width: 100%; text-align: center;"></td>' +
                '<td><select class="form-control select" style="width: 100%;" name="mata_uang">' +
                '<option>AUD</option>' +
                '<option>CNY</option>' +
                '<option selected>IDR</option>' +
                '<option>JPY</option>' +
                '<option>KRW</option>' +
                '<option>MYR</option>' +
                '<option>SGD</option>' +
                '<option>USD</option>' +
                '</select></td>' +
                '<td><input type="number" class="form-control" name="moq" value="0" maxlength="9" style="width: 100%; text-align: center;"></td>' +
                '<td><input type="number" class="form-control" name="capacity" value="0" maxlength="9" style="width: 100%; text-align: center;"></td>' +
                '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_material(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></button></td>' +
                '<td hidden></td>' +
                '<td hidden></td>' +
                '</tr>');
            $(".select").select2();
            urut_material();

            dt_material = data;
            data.forEach(function(item, index) {
                rows = $('#tabel_material tbody tr').length - 1;
                nama = document.getElementsByName('nama_material')[rows];
                nama.options[nama.options.length] = new Option(item.NAMA);
            });
        }
    });

// Isi Nomor Material
    function urut_material() {
        var tabel_material = document.getElementById('tabel_material');

        for (var i=0; i<tabel_material.rows.length-1; i++) {
            document.getElementsByName('nmr_material')[i].value = i + 1;
        }
    }

// Isi Kode Material
    function isi_kode_material(btn) {
        var tabel_material = document.getElementById('tabel_material');
        var row = $(btn).closest("tr").index();
        var index = btn.selectedIndex - 1;

        if (index == -1) {
            document.getElementsByName('kode_material')[row].value = '';
            document.getElementsByName('satuan')[row].value = '';
            tabel_material.rows[row+1].cells[10].innerHTML = '';
        } else {
            document.getElementsByName('kode_material')[row].value = dt_material[index].KODE;
            document.getElementsByName('satuan')[row].value = dt_material[index].SATUAN;
            tabel_material.rows[row+1].cells[10].innerHTML = dt_material[index].ID;
        }
    }

// Hapus Material
    function hapus_material(btn) {
        row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
        urut_material();
    };

// Kosong Isian
    function kosong() {
        document.getElementById("kode").value = '';
        document.getElementById("nama_supplier").value = '';
        document.getElementById("alamat").value = '';
        document.getElementById("kota").value = '';
        $('#negara').val('Indonesia').change();
        $('#kode_pos').val('');
        document.getElementById("phone").value = '';
        document.getElementById("fax").value = '';
        document.getElementById("email").value = '';
        document.getElementById("kontak").value = '';
        document.getElementById("title").value = '';
        document.getElementById("npwp").value = '';
        $('#kode_keuangan').val('').change();
        $('#jenis').val('').change();
        $('#rekening').val('').change();
        $('#tipe').val('Baru').change();

        $("#material").find("tr:gt(0)").remove();
    $("input[type=radio]").prop("checked", false); // Tidak ada data Supplier yang dipilih
    $('#supplier_simpg').val('').change();
    document.getElementById("nama_supplier").focus();
    $('#btnProfil').click();

    id_supplier = '', row_select = '';
}

// Kosong Modal SIMPG
function kosong_simpg() {
    var tbl_simpg = document.getElementById('tbl_simpg');

    for (var i = 1; i < 7; i++) {
        tbl_simpg.rows[i].cells[1].innerHTML = '';
    }
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
    var tabel_material = document.getElementById('tabel_material');
    var tbl_simpg = document.getElementById('tbl_simpg');
    var id_material = [], id_material_supply = [], lead_time = [], harga = [], mata_uang = [], moq = [], capacity = [];
    var kode = $('#kode').val();
    var nama_supplier = ($('#nama_supplier').val()).replace("'"," ");
    var alamat = ($('#alamat').val()).replace("'"," ");
    var kota = $('#kota').val();
    var negara = $('#negara').val();
    var kode_pos = $('#kode_pos').val();
    var phone = $('#phone').val();
    var fax = $('#fax').val();
    var email = $('#email').val();
    var kontak = $('#kontak').val();
    var title = $('#title').val();
    var npwp = $('#npwp').val();
    <?php $id_kary = explode('|', $_SESSION['logERP']); ?>
    <?php $id_kary = $id_kary[0]; ?>
    var id_kary = <?php echo json_encode($id_kary); ?>;
    var rekening = $('#rekening').val();
    var kode_keuangan = $('#kode_keuangan').val();
    var i_jenis = document.getElementById('jenis').selectedIndex-1;
    var dt_jenis = <?php echo json_encode($jenis->result_array()); ?>;
    i_jenis == -1 ? id_jenis = '' : id_jenis = dt_jenis[i_jenis].ID;
    var kode_simpg = tbl_simpg.rows[6].cells[1].innerHTML;

    var qty_material = tabel_material.rows.length-1;
    for (var i=0; i<qty_material; i++) {
        t_lead_time = document.getElementsByName('lead_time')[i].value;
        t_harga = document.getElementsByName('harga')[i].value;
        t_moq = document.getElementsByName('moq')[i].value;
        t_capacity = document.getElementsByName('capacity')[i].value;
        t_id_material = tabel_material.rows[i+1].cells[10].innerHTML;
        t_id_material_supply = tabel_material.rows[i+1].cells[11].innerHTML;
        t_mata_uang = document.getElementsByName('mata_uang')[i].value;

        if (t_lead_time == '' || t_harga == '') {
            $('#btnIsian').click();
            return;
        }

        id_material.push(t_id_material);
        id_material_supply.push(t_id_material_supply);
        lead_time.push(t_lead_time);
        harga.push(t_harga);
        mata_uang.push(t_mata_uang);
        moq.push(t_moq);
        capacity.push(t_capacity);
    }
    
    var material = [qty_material, lead_time, harga, mata_uang, id_material, id_material_supply, moq, capacity];
    var data = [kode, nama_supplier, alamat, kota, negara, kode_pos, phone, fax, email, kontak, title, npwp, id_kary, rekening, kode_keuangan, id_jenis, id_supplier, kode_simpg, material];

    if (kode == '' || nama_supplier == '' || alamat == '' || kota == '' || negara == '' || kode_pos == '' || phone == '' || fax == '' || email == '' || kontak == '' || title == '' || rekening == '' || i_jenis == -1) {
        $('#btnIsian').click();
        return;
    }

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/pembelian/supplier/simpan_supplier',
        data: {data: data},
        success: function(data) {
            setTimeout(function() {
                $('#btnOk_progress').click();
                $('#btnSukses').click();
            }, 500);
        }
    });
}

// Filter Data
function filter() {
    var cari = document.getElementById("cari").value;
    var jenis = document.getElementById("fJenis").value;
    var data = [cari, jenis];
    
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/pembelian/supplier/filter',
        data: {data: data},
        success: function(data) {
            $('.data-table').html(data);
            pagination();
        }
    });
}

// Get Id from table
function get_action(btn) {
    var data_table = document.getElementById('data-table');
    var row = $(btn).closest("tr").index() + 1;

    row_select = row;
    id_supplier = data_table.rows[row].cells[0].innerHTML;
}

// Show Profil
$('#btnPreview').on('click', function() {
    if (id_supplier == '') {return;}
    $('#modal_preview').click();

    $.ajax({
        data: {data: id_supplier},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/supplier/get_supplier" ?>',
        success: function(data) {
            data = JSON.parse(data);
            show_preview(data);
        }
    });

    function show_preview(data) {
        $('#btnProfilPreview').click();
        tabel_profil_preview.rows[0].cells[1].innerHTML = data[0]['NAMA_SUPPLIER'];
        tabel_profil_preview.rows[1].cells[1].innerHTML = data[0]['KODE'];
        tabel_profil_preview.rows[2].cells[1].innerHTML = data[0]['ALAMAT'];
        tabel_profil_preview.rows[3].cells[1].innerHTML = data[0]['PHONE'];
        tabel_profil_preview.rows[4].cells[1].innerHTML = data[0]['FAX'];
        tabel_profil_preview.rows[5].cells[1].innerHTML = data[0]['KOTA'];
        tabel_profil_preview.rows[6].cells[1].innerHTML = data[0]['KODE_POS'];
        tabel_profil_preview.rows[7].cells[1].innerHTML = data[0]['COUNTRY'];
        tabel_profil_preview.rows[8].cells[1].innerHTML = data[0]['CONTACT'];
        tabel_profil_preview.rows[9].cells[1].innerHTML = data[0]['CONTACT_TITLE'];
        tabel_profil_preview.rows[10].cells[1].innerHTML = data[0]['EMAIL'];
        tabel_profil_preview.rows[11].cells[1].innerHTML = data[0]['KODE_KEUANGAN'];
        tabel_profil_preview.rows[12].cells[1].innerHTML = data[0]['REKENING'];
        tabel_profil_preview.rows[13].cells[1].innerHTML = data[0]['JENIS'];

        $('#tabel_material_preview').DataTable().destroy();
        $("#tabel_material_preview tbody").find("tr").remove();
        for (var i = 0; i < data.length; i++) {
            if (data[i]['NAMA_BARANG'] != null) {
                $('#tabel_material_preview tbody').append('<tr><td align="center"></td><td></td><td align="center"></td><td align="center"></td><td align="right"></td><td align="center"></td><td align="center"></td><td align="center"></td><td hidden></td><td hidden><button type="button" class="btn btn-block btn-danger" title="Hapus Part" onclick="hapus_supply(this)" style="margin-top: 0;">X</button></td></tr>')
                tabel_material_preview.rows[i + 1].cells[0].innerHTML = i + 1;
                tabel_material_preview.rows[i + 1].cells[1].innerHTML = data[i]['NAMA_BARANG'];
                tabel_material_preview.rows[i + 1].cells[2].innerHTML = data[i]['SATUAN'];
                tabel_material_preview.rows[i + 1].cells[3].innerHTML = data[i]['LEAD_TIME'];
                tabel_material_preview.rows[i + 1].cells[4].innerHTML = format_number(data[i]['HARGA']);
                tabel_material_preview.rows[i + 1].cells[5].innerHTML = data[i]['MATA_UANG'];
                tabel_material_preview.rows[i + 1].cells[6].innerHTML = data[i]['MOQ'];
                tabel_material_preview.rows[i + 1].cells[7].innerHTML = data[i]['CAPACITY'];
                tabel_material_preview.rows[i + 1].cells[8].innerHTML = data[i]['ID_MATERIAL_SUPPLY'];
            }
        }
    }
});

// Drag Div Document
$("#modal-preview").draggable({
    handle: ".card-header"
});
$("#modal-simpg").draggable({
    handle: ".card-header"
});

// Edit Data
$('#btnEdit').on('click', function() {
    if (id_supplier == '') {return;}
    $('#btnProfil').click();

    $.ajax({
        data: {data: id_supplier},
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/supplier/get_supplier" ?>',
        success: function(data) {
            data = JSON.parse(data);
            show_supplier(data);
            show_material(data);
        }
    });

    function show_supplier(data) {
        $('#kode').val(data[0]['KODE']);
        $('#nama_supplier').val(data[0]['NAMA_SUPPLIER']);
        $('#kode_keuangan').val(data[0]['KODE_KEUANGAN']);

        $('#alamat').val(data[0]['ALAMAT']);
        $('#kota').val(data[0]['KOTA']);
        $('#negara').val(data[0]['COUNTRY']).change();
        $('#kode_pos').val(data[0]['KODE_POS']);
        $('#phone').val(data[0]['PHONE']);
        $('#fax').val(data[0]['FAX']);
        $('#email').val(data[0]['EMAIL']);
        $('#kontak').val(data[0]['CONTACT']);
        $('#title').val(data[0]['CONTACT_TITLE']);
        $('#npwp').val(data[0]['NO_NPWP']);
        $('#rekening').val(data[0]['REKENING']);
        $('#jenis').val(data[0]['KODE_JENIS']).change();

        $('#nama_supplier').focus();
    }

    function show_material(data) {
        $("#tabel_material").find("tbody tr").remove();
        for (var i = 0; i < data.length; i++) {
            var no_part = data[i]['KODE_BARANG'];
            var id_material = data[i]['ID_MATERIAL'];
            var nama = data[i]['NAMA_BARANG'].trim();
            var spesifikasi = data[i]['SPESIFIKASI'].trim();
            var nama_material = ((nama + ' ' + spesifikasi).substring(0, 50)).trim();
            var satuan = data[i]['SATUAN'];
            var lead_time = data[i]['LEAD_TIME'];
            var harga = (data[i]['HARGA']).replace(",", ".");
            var mata_uang = data[i]['MATA_UANG'];
            var moq = data[i]['MOQ'];
            var capacity = data[i]['CAPACITY'];
            var id_material_supply = data[i]['ID_MATERIAL_SUPPLY'];

            if (nama != null) {
                $('#tabel_material tbody').append(
                    '<tr>' +
                    '<td width="5%"><input type="text" class="form-control" name="nmr_material" style="width: 100%; text-align:center;" readonly></td>' +
                    '<td width="8%"><input type="text" class="form-control" name="kode_material" value="' + no_part + '" style="width: 100%; text-align: center;" readonly></td>' +
                    '<td width="30%"><input type="text" class="form-control" name="nama_material" value="' + nama_material.replace('  ', ' ') + '" style="width: 100%;" readonly></td>' +
                    '<td width="5%"><input type="text" class="form-control" name="satuan" value="' + satuan + '" style="width: 100%; text-align: center;" readonly></td>' +
                    '<td width="10%"><input type="number" class="form-control" name="lead_time" value="' + lead_time + '" style="width: 100%; text-align: center;"></td>' +
                    '<td width="10%"><input type="number" class="form-control" name="harga" value="' + harga + '" style="width: 100%; text-align: center;"></td>' +
                    '<td width="7%"><select class="form-control select" style="width: 100%;" name="mata_uang">' +
                    '<option>AUD</option>' +
                    '<option>CNY</option>' +
                    '<option selected>IDR</option>' +
                    '<option>JPY</option>' +
                    '<option>KRW</option>' +
                    '<option>MYR</option>' +
                    '<option>SGD</option>' +
                    '<option>USD</option>' +
                    '</select></td>' +
                    '<td width="10%"><input type="number" class="form-control" name="moq" maxlength="9" value="' + moq + '" style="width: 100%; text-align: center;"></td>' +
                    '<td width="10%"><input type="number" class="form-control" name="capacity" maxlength="9" value="' + capacity + '" style="width: 100%; text-align: center;"></td>' +
                    '<td width="5%" style="background-color: #f7f7f7; border: 1px solid #f7f7f7;"></td>' +
                    '<td hidden>' + id_material + '</td>' +
                    '<td hidden>' + id_material_supply + '</td>' +
                    '</tr>')
                document.getElementsByName('mata_uang')[i].value = mata_uang;
            }
        }
        $(".select").select2();
        urut_material();
    }
});

// Hapus Data
$('#btnHapus').on('click', function() {
    if (id_supplier == '') {return;}
    $('#confirmHapus').click();

    $('#ya').on('click', function() {
        $('#btnProgress').click();
        $.ajax({
            data: {data: id_supplier},
            type: 'POST',
            url: '<?php echo base_url() . "index.php/pembelian/supplier/hapus_supplier" ?>',
            success: function(data) {
                setTimeout(function() {
                    $('#btnOk_progress').click();
                    $('#btnSukses').click();
                }, 500);
            }
        });
    });
});

// Tambah Material Supply
$('#btnAddMaterial').click(function() {
    if (row_select == '') {location.reload();}
    var data_table = document.getElementById('data-table');
    var nama_supplier = data_table.rows[row_select].cells[4].innerHTML;

    $('#nama_supplier_plus').html('Tambah Material Supplier ' + nama_supplier);
    $('#tbl_plus tbody tr').remove();
    $('#btnPlus').click();
});

// Tampilkan Material
$('#btnPlus').on('click', function() {
    var row = $('#tbl_plus tbody tr').length;
    
    $('#tbl_plus').append('<tr><td><input type="text" class="form-control" name="nmr_plus" style="width: 100%; text-align:center;" readonly></td><td><input type="text" class="form-control" name="jenis_plus" style="width: 100%;" readonly></td><td><input type="text" class="form-control" name="kode_plus" style="width: 100%; text-align:center;" readonly></td>' +
        '<td><select class="select" name="material_plus" onchange="isi_detail(this)" style="width: 100%;"></select></td>' +
        '<td><select class="form-control select" name="satuan_plus" style="width: 100%;"><option value="">Pilih..</option>' +
        '</select></td>' +
        '<td><input type="text" class="form-control num" value="0" name="lead_plus" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
        '<td><input type="text" class="form-control num" value="0" name="harga_plus" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
        '<td><select class="select" name="uang_plus" style="width: 100%;">' +
        '<?php foreach ($mata_uang->result_array() as $dt) : ?>' +
        '<option><?php echo $dt['MATA_UANG']; ?></option>' +
        '<?php endforeach; ?>' +
        '</select></td>' +
        '<td><input type="text" class="form-control num" value="0" name="moq_plus" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
        '<td><input type="text" class="form-control num" value="0" name="capacity_plus" style="width: 100%; text-align: center;" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, \'\')"></td>' +
        '<td><button type="button" class="btn btn-block btn-danger" title="Hapus Downtime" onclick="hapus_list(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>' +
        '</tr>');
    $('[name="material_plus"]:eq('+row+')').html($('#material_plus').html());
    
    $(".select").select2();
    onlynumeric();
    isi_urut();
});

// Isi Nomor Urut Roll
function isi_urut() {
    var tbl_plus = document.getElementById('tbl_plus');

    for (var i=0; i<tbl_plus.rows.length-1; i++) {
        document.getElementsByName('nmr_plus')[i].value = i+1;
    }
}

// Isi Satuan Berdasarkan Barang
function isi_detail(btn) {
    var tbl_plus = document.getElementById('tbl_plus');
    var row = $(btn).closest("tr").index();
    var id_bahan = document.getElementsByName('material_plus')[row].value;
    var dt_material = <?php echo json_encode($material->result_array()); ?>;

    $('[name=satuan_plus]:eq('+row+')').empty();
    dt_material.forEach(function(item) {
        if (item.ID == id_bahan) {
            $('[name=satuan_plus]:eq('+row+')').append('<option>'+item.SATUAN+'</option>');
            $('[name=satuan_plus]:eq('+row+')').val(item.SATUAN).change();
            $('[name=jenis_plus]:eq('+row+')').val(item.JENIS);
            $('[name=kode_plus]:eq('+row+')').val(item.KODE);
            return;
        }
    });
}

// Hapus List Downtime
function hapus_list(btn) {
    row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    isi_urut();
};

// Simpan Material Supply
$('#btnSimpanMaterial').click(function() {
    var data_table = document.getElementById('data-table');
    var tabel_material = document.getElementById('data-table');
    var tbl_plus = document.getElementById('tbl_plus');
    var id_barang = [], satuan = [], lead_time = [], harga = [], mata_uang = [], moq = [], capacity = [];
    id_supplier = data_table.rows[row_select].cells[0].innerHTML;

    for (var i=0; i<tbl_plus.rows.length-1; i++) {
        t_id_barang = $('[name=material_plus]:eq('+i+')').val();
        t_satuan = $('[name=satuan_plus]:eq('+i+')').val();
        t_lead_time = $('[name=lead_plus]:eq('+i+')').val();
        t_harga = $('[name=harga_plus]:eq('+i+')').val();
        t_mata_uang = $('[name=uang_plus]:eq('+i+')').val();
        t_moq = $('[name=moq_plus]:eq('+i+')').val();
        t_capacity = $('[name=capacity_plus]:eq('+i+')').val();

        if (t_id_barang == '') {error_isian('Nama Material belum diisi..');}
        if (t_satuan == '') {error_isian('Satuan belum diisi..');}
        if (t_lead_time == '') {error_isian('Lead Time belum diisi..');}
        if (t_harga == '') {error_isian('Harga belum diisi..');}
        if (t_mata_uang == '') {error_isian('Mata Uang belum diisi..');}
        if (t_moq == '') {error_isian('MOQ belum diisi..');}
        if (t_capacity == '') {error_isian('Capacity belum diisi..');}

        id_barang.push(t_id_barang);
        satuan.push(t_satuan);
        lead_time.push(t_lead_time);
        harga.push(t_harga);
        mata_uang.push(t_mata_uang);
        moq.push(t_moq);
        capacity.push(t_capacity);
    }

    var barang = [id_barang, satuan, lead_time, harga, mata_uang, moq, capacity];
    var data = [id_supplier, barang];

    $('#btnProgress').click();
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/pembelian/supplier/simpan_material',
        data: {data: data},
        success: function(data) {
            setTimeout(function() {
                $('#btnOk_progress').click();
                $('#btnSukses').click();
            }, 500);
        }
    });
});

// Pilih Supplier SIMPG
$('#supplier_simpg').on('change', function() {
    var tbl_simpg = document.getElementById('tbl_simpg');
    var dt_supplier_simpg = <?php echo json_encode($dt_supplier_simpg); ?>;
    var index = $("#supplier_simpg")[0].selectedIndex - 1;
    if (index == -1) {
        kosong_simpg();
        return;
    }
    var kode = dt_supplier_simpg[index][0];
    var alamat = dt_supplier_simpg[index][1];
    var kota = dt_supplier_simpg[index][2];
    var phone = dt_supplier_simpg[index][3];
    var kontak = dt_supplier_simpg[index][4];
    var kode_keuangan = dt_supplier_simpg[index][5];

    tbl_simpg.rows[1].cells[1].innerHTML = alamat;
    tbl_simpg.rows[2].cells[1].innerHTML = kota;
    tbl_simpg.rows[3].cells[1].innerHTML = phone;
    tbl_simpg.rows[4].cells[1].innerHTML = kontak;
    tbl_simpg.rows[5].cells[1].innerHTML = kode_keuangan;
    tbl_simpg.rows[6].cells[1].innerHTML = kode;
});

// Pilih Data SIMPG
$('#pilih_simpg').on('click', function() {
    var tbl_simpg = document.getElementById('tbl_simpg');
    var index = $("#supplier_simpg")[0].selectedIndex - 1;
    if (index == -1) {
        kosong();
        return;
    }

    kode = tbl_simpg.rows[6].cells[1].innerHTML;
    $.ajax({
        data: {
            data: kode
        },
        type: 'POST',
        url: '<?php echo base_url() . "index.php/pembelian/supplier/ambil_simpg" ?>',
        success: function(data) {
            var data = JSON.parse(data);

            data.NAMA == null ? nama = '' : nama = data.NAMA.trim();
            data.ALAMAT1 == null ? alamat = '' : alamat = data.ALAMAT1.trim();
            data.TELPON == null ? telpon = '-' : telpon = data.TELPON.trim();
            data.KOTA == null ? kota = '-' : kota = data.KOTA.trim();
            data.NEGARA == null ? negara = 'Indonesia' : negara = proper(data.NEGARA.trim());
            data.FAX == null ? fax = '-' : fax = data.FAX.trim();
            data.EMAIL_ADDRESS == null ? email = '-' : email = data.EMAIL_ADDRESS.trim();
            data.CONTACT_PERSON == null ? kontak = '-' : kontak = data.CONTACT_PERSON.trim();
            data.NPWP == null ? npwp = '-' : npwp = data.NPWP.trim();

            $('#nama_supplier').val(nama).change();
            $('#kode_keuangan').val(data.KODE_KEUANGAN).change();
            $('#tipe').val('Lama (SIMPG)').change();
            $('#alamat').val(alamat).change();
            $('#kota').val(kota).change();
            $('#negara').val(negara).change();
            $('#kode_pos').val('-').change();
            $('#phone').val(telpon).change();
            $('#fax').val(fax).change();
            $('#rekening').val('-').change();
            $('#email').val(email).change();
            $('#kontak').val(kontak).change();
            $('#title').val('-').change();
            $('#npwp').val(npwp).change();
            $('#jenis').val('').change();
        }
    });
});

// Proper Case
function proper(string) {
    var sentence = string.toLowerCase().split(" ");
    for(var i = 0; i< sentence.length; i++) {
        sentence[i] = sentence[i][0].toUpperCase() + sentence[i].slice(1);
    }
    return sentence;
}

// Tab Selection
$('#btnProfil').on('click', function() {
    $('#profil').removeAttr('hidden');
    $('#material').attr('hidden', '');

    $('#btnProfil').attr('class', 'btn btn-block btn-info');
    $('#btnMaterial').attr('class', 'btn btn-block btn-default');
});
$('#btnMaterial').on('click', function() {
    $('#profil').attr('hidden', '');
    $('#material').removeAttr('hidden');

    $('#btnProfil').attr('class', 'btn btn-block btn-default');
    $('#btnMaterial').attr('class', 'btn btn-block btn-info');
});

// Tab Preview Selection
$('#btnProfilPreview').on('click', function() {
    document.querySelector('.tab1').style.display = 'block'
    document.querySelector('.tab2').style.display = 'none'

    $('#btnProfilPreview').attr('class', 'btn btn-block btn-info');
    $('#btnMaterialPreview').attr('class', 'btn btn-block btn-default');
});
$('#btnMaterialPreview').on('click', function() {
    document.querySelector('.tab1').style.display = 'none'
    document.querySelector('.tab2').style.display = 'block'

    $('#btnProfilPreview').attr('class', 'btn btn-block btn-default');
    $('#btnMaterialPreview').attr('class', 'btn btn-block btn-info');

    pagination_preview();
});

// Drag Div Document
$("#modal_supplier").draggable({handle: ".card-header"});
$("#modal_add").draggable({handle: ".card-header"});

</script>