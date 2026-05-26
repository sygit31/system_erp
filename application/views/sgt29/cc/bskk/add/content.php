
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Tambah BSKK</font></b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          

          <!-- ==================================ISI KONTEN================================== -->

          <form role="form" method="POST" action="<?php echo site_url('sgt/cc/bskk/simpan');?>" onsubmit="return validasi()" autocomplete="off">

          <table style="background-color: #EFECE9; filter: alpha(opacity=40); opacity: 0.95;border:3px #B8B7B6 solid;">

            <tr valign="top" height="210">
              <td width="10" />
              <td>
                <table >
                  <tr height="10" />
                  <tr valign="middle">
                    <td width="150"><label><font size = "4">Nomer BPKK</font></label></td>
                    <td width="300" colspan="3">
                      <div data-tip="Nomer BPKK">
                        <input class="form-control" type="text" id="txtNomerBPKK" name="txtNomerBPKK">
                      </div>
                    </td>
                  </tr>
                  <tr height="10" />
                  <tr valign="top">
                    <td><label><font size = "4">Tanggal</font></label></td>
                    <td colspan="3">
                      <div data-tip="Tanggal">
                        <input class="form-control" type="text" id="txtTanggal" name="txtTanggal">
                      </div>
                    </td>
                  </tr>
                  <tr height="10" />
                  <tr valign="middle">
                    <td width="150"><label><font size = "4">Nomer Invest</font></label></td>
                    <td width="300" colspan="3">
                      <div data-tip="Pilih Invest">
                        <select name="cmbInvest"  id="cmbInvest"  class="form-control select2">
                          <option value=''></option>
                          <?php foreach($data_invest as $row){ ?>
                            <!-- <option value='<?php// echo $row->KODE_INVEST; ?>'><?php //echo $row->KODE_INVEST." (".$row->JENIS_INVEST.")" ; ?></option> -->
                            <option value='<?php echo $row->KODE_INVEST; ?>'><?php echo $row->KODE_INVEST ; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr height="10" />
                  <tr valign="top">
                    <td><label><font size = "4">Kode Rekening</font></label></td>
                    <td colspan="3">
                      <div data-tip="Kode Rekening">
                        <input class="form-control" type="text" id="TxtKodeRekening" name="TxtKodeRekening">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="20" />
              <td>
                <table >
                  <tr height="10" />
                  <tr valign="middle">
                    <td width="150"><label><font size = "4">Unit</font></label></td>
                    <td width="300" colspan="3">
                      <div data-tip="Pilih Unit">
                        <select name="cmbUnit"  id="cmbUnit"  class="form-control select2" onchange="showDepartement()">
                          <option value=''></option>
                          <?php foreach($data_unit as $row){ ?>
                            <!-- <option value='<?php //echo $row->UNIT.'@'. $row->ALOKASI; ?>'><?php// echo $row->UNIT ; ?></option> -->
                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                          <?php } ?> 
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr height="10" />
                  <tr valign="middle">
                    <td width="150"><label><font size = "4">Departement</font></label></td>
                    <td width="300" colspan="3">
                      <div data-tip="Pilih Departemen">
                        <select name="cmbDepartement"  id="cmbDepartement"  class="form-control select2">
                          <option value=''></option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <!-- <tr height="10" />
                  <tr valign="top">
                    <td><label><font size = "4">Alokasi Biaya</font></label></td>
                    <td colspan="3">
                      <div data-tip="Alokasi Biaya">
                        <input class="form-control" type="text" id="txtBiaya" name="txtBiaya">
                      </div>
                    </td> -->
                  </tr>
                  <tr height="10" />
                  <tr valign="top">
                    <td><label><font size = "4">Keterangan</font></label></td>
                    <td colspan="3">
                      <div data-tip="Keterangan Penggunaan">
                        <input class="form-control" type="text" id="txtKeterangan" name="txtKeterangan">
                      </div>
                    </td>
                  </tr>
                  <tr height="10" />
                  <tr valign="top">
                    <td><label><font size = "4">Debet</font></label></td>
                    <td colspan="3">
                      <div data-tip="Debet">
                        <input class="form-control" type="text" id="txtDebet" name="txtDebet">
                      </div>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="10" />
            </tr>
          </table>
          

          <table>
            <tr height="5"></tr>
            <tr>
              <td />
              <td width="150"><button type="button" class="btn btn-block btn-info" id="btnSimpan" onclick="tambahBSKK()" style="background-color: #0C1A7D;">Tambah</button></td>
              <td colspan="2"/>
            </tr>
          </table>

          <br />
          
          <font size="2">
            <table id="tblBSKK" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <th style="width: 10%;">No. BPKK</th>
                  <th style="width: 10%;">Tanggal</th>
                  <th style="width: 10%;">No. Invest</th>
                  <th style="width: 10%;">Rekening</th>
                  <th style="width: 10%;">Unit</th>
                  <th style="width: 10%;">Departemen</th>
                  <th style="width: 10%;">Keterangan</th>
                  <th style="width: 10%;">Debet</th>
                  <th style="width: 10%;"></th>
                </tr>
              </thead>
              <tbody>
                <!-- isi -->
              </tbody>
            </table>
          </font>
            

          <br />                  
          <table>
            <tr>
              <td width="150"><button type="submit" class="btn btn-block btn-success" id="btnSimpan" >Simpan</button></td>
              <td width="10" />
              <td width="150"><button type="reset" class="btn btn-block btn-danger" id="btnBatal" onclick="batalkan()">Batal</button></td>
            </tr>
          </table>

          </form>


          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <!-- /.card-body -->
        <!-- <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div> -->
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->




























  
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Data BSKK</font></b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          

          <!-- ==================================ISI KONTEN================================== -->

          
          <font size="3">
            <table id="tblData" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <!-- <th style="width: 15%;">No. BPKK</th>
                  <th style="width: 25%;">Tanggal</th>
                  <th style="width: 15%;">No. Invest</th>
                  <th style="width: 15%;">Rekening</th>
                  <th style="width: 25%;">Unit</th>
                  <th style="width: 25%;">Bagian</th>
                  <th style="width: 25%;">Keterangan</th>
                  <th style="width: 25%;">Debet</th> -->

                  <!-- <th style="width: 10% !important;">No. BPKK</th>
                  <th style="width: 10% !important;">Tanggal</th>
                  <th style="width: 10% !important;">No. Invest</th>
                  <th style="width: 10% !important;">Rekening</th>
                  <th style="width: 10% !important;">Unit</th>
                  <th style="width: 10% !important;">Bagian</th>
                  <th style="width: 10% !important;">Keterangan</th>
                  <th style="width: 15% !important;">Debet</th> -->

                  <!-- <th width="100">No. BPKK</th>
                  <th width="100">Tanggal</th>
                  <th width="100">No. Invest</th>
                  <th width="100">Rekening</th>
                  <th width="100">Unit</th>
                  <th width="100">Bagian</th>
                  <th width="500">Keterangan</th>
                  <th width="100">Debet</th> -->

                  <th style="width: 50px !important;"></th>
                  <th style="width: 100px !important;">No. BPKK</th>
                  <th style="width: 100px !important;">Tanggal</th>
                  <th style="width: 100px !important;">No. Invest</th>
                  <th style="width: 100px !important;">Rekening</th>
                  <th style="width: 100px !important;">Unit</th>
                  <th style="width: 100px !important;">Bagian</th>
                  <th style="width: 600px !important;">Keterangan</th>
                  <th style="width: 100px !important;">Debet</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($data_last as $row){ ?>
                  <tr>
                    <td align="center">
                      <button type="button" class="btn btn-block btn-warning btn-sm" 
                      id=<?php echo $row->id_bskk; ?> 
                      data-toggle='modal' data-target='#modal-detail' >
                        Ubah
                      </button>
                    </td>
                    <td align="center"><?php echo $row->no_bpkk; ?></td>
                    <td align="center"><?php echo $row->tanggal_format; ?></td>
                    <td align="center"><?php echo $row->invest; ?></td>
                    <td align="center"><?php echo $row->kode_rekening; ?></td>
                    <td align="center"><?php echo $row->alokasi; ?></td>
                    <td align="center"><?php echo $row->kode_departement; ?></td>
                    <td align="center"><?php echo $row->keterangan; ?></td>
                    <td align="center"><?php echo $row->debet; ?></td>

                    <!-- <td align="center">
                      <button type="button" class="btn btn-block btn-warning btn-sm" 
                      id=<?php //echo $row->ID; ?> 
                      data-toggle='modal' data-target='#modal-detail' >
                        Ubah
                      </button>
                    </td> -->
                  </tr>
                <?php } ?>


              </tbody>
            </table>
          </font>











          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/cc/bskk/ubahBSKK');?>" autocomplete="off">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <div class="modal-title"><h5><b>Ubah BSKK</b></h5></div>
                      <input class="form-control" type="hidden" id="txtId_Bskk" name="txtId_Bskk">
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            

                          <table style="background-color: #EFECE9; filter: alpha(opacity=40); opacity: 0.95;border:3px #B8B7B6 solid;">
                            <tr valign="top" height="210">
                              <td width="10" />
                              <td>
                                <table >
                                  <tr height="10" />
                                  <tr valign="middle">
                                    <td width="150"><label><font size = "4">Nomer BPKK</font></label></td>
                                    <td width="300" colspan="3">
                                      <div data-tip="Nomer BPKK">
                                        <input class="form-control" type="text" id="txtNomerBPKKE" name="txtNomerBPKKE">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr height="10" />
                                  <tr valign="top">
                                    <td><label><font size = "4">Tanggal</font></label></td>
                                    <td colspan="3">
                                      <div data-tip="Tanggal">
                                        <input class="form-control" type="text" id="txtTanggalE" name="txtTanggalE">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr height="10" />
                                  <tr valign="middle">
                                    <td width="150"><label><font size = "4">Nomer Invest</font></label></td>
                                    <td width="300" colspan="3">
                                      <div data-tip="Pilih Invest">
                                        <select name="cmbInvestE"  id="cmbInvestE"  class="form-control select2">
                                          <option value=''></option>
                                          <?php foreach($data_invest as $row){ ?>
                                            <!-- <option value='<?php// echo $row->KODE_INVEST; ?>'><?php //echo $row->KODE_INVEST." (".$row->JENIS_INVEST.")" ; ?></option> -->
                                            <option value='<?php echo $row->KODE_INVEST; ?>'><?php echo $row->KODE_INVEST ; ?></option>
                                          <?php } ?> 
                                        </select>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr height="10" />
                                  <tr valign="top">
                                    <td><label><font size = "4">Kode Rekening</font></label></td>
                                    <td colspan="3">
                                      <div data-tip="Kode Rekening">
                                        <input class="form-control" type="text" id="TxtKodeRekeningE" name="TxtKodeRekeningE">
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td width="20" />
                              <td>
                                <table >
                                  <tr height="10" />
                                  <tr valign="middle">
                                    <td width="150"><label><font size = "4">Unit</font></label></td>
                                    <td width="300" colspan="3">
                                      <div data-tip="Pilih Unit">
                                        <select name="cmbUnitE"  id="cmbUnitE"  class="form-control select2" onchange="showDepartementE()">
                                          <option value=''></option>
                                          <?php foreach($data_unit as $row){ ?>
                                            <option value='<?php echo $row->UNIT; ?>'><?php echo $row->UNIT ; ?></option>
                                          <?php } ?> 
                                        </select>
                                      </div>
                                    </td>
                                  </tr>
                                  <tr height="10" />
                                  <tr valign="middle">
                                    <td width="150"><label><font size = "4">Departement</font></label></td>
                                    <td width="300" colspan="3">
                                      <div data-tip="Pilih Departemen">
                                        <select name="cmbDepartementE"  id="cmbDepartementE"  class="form-control select2">
                                          <option value=''></option>
                                        </select>
                                      </div>
                                    </td>
                                  </tr>
                                  
                                  <tr height="10" />
                                  <tr valign="top">
                                    <td><label><font size = "4">Keterangan</font></label></td>
                                    <td colspan="3">
                                      <div data-tip="Keterangan Penggunaan">
                                        <input class="form-control" type="text" id="txtKeteranganE" name="txtKeteranganE">
                                      </div>
                                    </td>
                                  </tr>
                                  <tr height="10" />
                                  <tr valign="top">
                                    <td><label><font size = "4">Debet</font></label></td>
                                    <td colspan="3">
                                      <div data-tip="Debet">
                                        <input class="form-control" type="text" id="txtDebetE" name="txtDebetE">
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                              <td width="10" />
                            </tr>
                          </table>
                          
                          
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                    <div class="modal-footer">
                      <table>
                        <tr>
                          <td width="800">
                            <button class="btn btn-success pull-left" type="submit">Simpan</button>
                            <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                          </td>
                        </tr>
                      </table>
                                            

                    </div>
                  </form>
                  <!-- <br> -->
                </div>
                      <!-- /.modal-content -->
            </div>
                    <!-- /.modal-dialog -->
          </div>










          <!-- ==================================ISI KONTEN================================== -->
                  
        </div>
        <!-- /.card-body -->
        <div class="card-footer"><font color="Green" size="2">
            ERP @2019
        </font></div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->