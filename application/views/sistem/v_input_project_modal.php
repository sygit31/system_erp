
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

<!-- Modal Confirm Bobot -->
<div class="modal fade" id="modal_bobot">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <label style="font-size: 40px; color: #D00101; font-weight: bold;">Setting Bobot!</label>
            </div>

            <?php $this->load->view('sistem/v_bobot'); ?>                    

            <div class="modal-footer">
                <button id="simpan_bobot" style="width: 50%;" class="btn btn-primary" data-dismiss="modal">Simpan</button>
                <button id="btnTutup" style="width: 50%;" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Revisi Target -->
<div class="modal fade" id="modal_revisi">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <b><font color="White"><div id="headerinput">Revisi Target</div></font></b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn_rev_close" title="Close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%">
                        <tr>
                            <td width="40%" style="font-weight: bold;">Revisi 1</td>
                            <td width="60%"><input type="text" id="target2" class="form-control datepicker" placeholder="Revisi 1" style="width: 100%; background-color: #FFFFFF;" tabindex="1" readonly></td>
                        </tr>
                        <tr style="height: 10px;"></tr>
                        <tr>
                            <td style="font-weight: bold;">Revisi 2</td>
                            <td><input type="text" id="target3" class="form-control datepicker"  placeholder="Revisi 2" style="width: 100%; background-color: #FFFFFF;" tabindex="2" readonly></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <table width="100%">
                        <tr>
                            <td width="49.5%">
                                <button id="hapus_revisi" style="width: 100%;" type="button" class="btn btn-danger">Hapus</button>
                            </td>
                            <td width="1%"></td>
                            <td width="49.5%">
                                <button id="simpan_revisi" style="width: 100%;" class="btn btn-primary">Simpan</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Finish Date -->
<div class="modal fade" id="modal_finish" style="z-index: 9999;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        <b><font color="White"><div id="headerinput">Finish Date</div></font></b>
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool btn_rev_close" title="Close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table width="100%" id="tbl_header">
                        <tr>
                            <td width="20%" style="font-weight: bold;">Date</td>
                            <td width="25%"><input type="text" id="finish" class="form-control datepicker" placeholder="Finished Date" style="width: 100%; background-color: #FFFFFF; cursor: pointer;" tabindex="1" readonly></td>
                            <td width="50%" align="right"><h3><b style="color: #FF0000;">Format only picture !!</b></h3></td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <table width="100%">
                        <tr>
                            <td align="center">
                                <button id="add_file" style="width: 98%;" type="button" class="btn btn-success"><i class="fa fa-plus m-2"></i><b>Bukti</b></button>
                            </td>
                            <td align="center">
                                <button id="save_file" style="width: 98%;" class="btn btn-info"><i class="fa fa-save m-2"></i><b>Simpan</b></button>
                            </td>
                            <td align="center" data-dismiss="modal">
                                <button id="keluar" style="width: 98%;" class="btn btn-danger"><i class="fa fa-power-off m-2" data-dismiss="modal"></i><b>Tutup</b></button>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <table id="table_gambar" class="table table-bordered table-striped" width="100%"></table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Confirm Hapus -->
<div class="modal fade" id="modal_hapus">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" style="font-size: 40px; color: #D00101; font-weight: bold;"> Yakin akan menghapus data? </div>
            <div class="modal-footer">
                <button style="width: 50%;" type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban m-2 m-2"></i>Tutup</button>
                <button id="ya" style="width: 50%;" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-trash m-2 m-2"></i>Delete</button>
                <button id="failed" style="width: 50%;" class="btn btn-warning" data-dismiss="modal"><i class="fa fa-history m-2 m-2"></i>Failed</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Preview -->
<div class="modal fade" id="modal-preview" style="z-index: 9998;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"><div class="card-header" style="background-color: #0A86BF; cursor: all-scroll;">
            <h3 class="card-title">
                <b><font color="White" style="font-weight: bold; font-size: 28px; line-height: 50px;"><p id="judul">Detail Pengajuan</p></font></b>
            </h3>
        </div>
        <div class="modal-body" style="margin-left: 10px; margin-right: 20px;">
            <div class="scoll-tree">
                <table id="preview_pengajuan" class="table table-bordered table-striped" width="100%">
                    <thead style="text-align: center;">
                        <tr>
                            <th hidden>Id</th>
                            <th width="5%">No.</th>
                            <th width="10%">Tanggal</th>
                            <th width="20%">Nama Karyawan</th>
                            <th width="45%">Deskripsi Gagasan</th>
                            <th width="10%">Status</th>
                            <th width="5%"></th>
                            <th width="5%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $urut=0;
                        foreach ($ide->result_array() as $dt):
                            $id=$dt['ID_IDE'];
                            $urut++;
                            $tgl=date('d-M-Y',strtotime($dt['TGL']));
                            $nama=$dt['NAMA'];
                            $ide=$dt['IDE'];
                            $status=$dt['STATUS'];
                            ?>
                            <tr>
                                <td hidden><?php echo $id; ?></td>
                                <td align="center"><?php echo $urut; ?></td>
                                <td align="center"><?php echo $tgl; ?></td>
                                <td><?php echo $nama; ?></td>
                                <td><?php echo $ide; ?></td>
                                <td align="center"><?php echo $status; ?></td>
                                <td><button type="button" class="btn btn-success" onclick="project(this)">Project</button></td>
                                <td><button type="button" class="btn btn-danger" onclick="abort(this)">Abort</button></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button id="modal_tutup" style="width: 30%;" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button id="modal_preview" data-toggle="modal" data-target="#modal-preview" hidden></button>
        </div>
    </div>
</div>

<script>
    $("#modal-preview").draggable({
        handle: ".card-header"
    });
// Pagination Ide
function pagination_ide() {
    $('#preview_pengajuan').DataTable().destroy();
    $('#preview_pengajuan').DataTable( {
        "paging": true,
        "lengthChange": false,
        "pageLength": 10,
        "scrollX": true,
        "oLanguage": {"sSearch": "Cari :"},
        "order": [[ 1, "asc" ]],
        "info": false,
        "autoWidth": true
    });
}

// Dilanjutkan ke Project
function project(btn) {
    var table = document.getElementById('preview_pengajuan');
    var row = $(btn).closest("tr").index() + 1;
    var nama = table.rows[row].cells[3].innerHTML;
    var ide = table.rows[row].cells[4].innerHTML;
    var id_ide = table.rows[row].cells[0].innerHTML;

    get_project(nama,ide,id_ide);
    $('#modal_tutup').click();
}

// Isi Project Dari Ide
function get_project(nama,ide,id_ide) {
    $('#nama_project').val(ide).change();
    $('#nama_kary').val(nama).change();
    $('#id_ide').val(id_ide);

    $('#nama_project').attr('disabled','disabled');
    $('#nama_kary').attr('disabled','disabled');
}

// Batalkan Project
function abort(btn) {
    var table = document.getElementById('preview_pengajuan');
    var row = $(btn).closest("tr").index() + 1;
    var id_ide = table.rows[row].cells[0].innerHTML;

    $.ajax({
        data: {data: id_ide},
        type: 'POST',
        url: '<?php echo base_url(); ?>index.php/sistem/project/batal_ide',
        success: function(data) {
            $('#modal_tutup').click();
            $('#btnSukses').click();

            filter_ide(id_ide);
        }
    });
}

// Filter Ide
function filter_ide(id_ide) {
    $('#preview_pengajuan').DataTable().destroy();

    var tabel = document.getElementById('preview_pengajuan');
    var status = $('#fStatus_ide').val();
    var qty_row = $('#preview_pengajuan').find('tr').length;
    var urut = 1;

    for (var i=0; i<qty_row; i++) {
        value = tabel.rows[i].cells[0].innerHTML;
        if (value == id_ide) {
            $("#preview_pengajuan").find("tr")[i-1].remove();
        }
    }
    pagination_ide();
}

</script>