
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
            <b><font color="White">Test Requirement</font></b>
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

          <div class="card">
          <!-- <div class="card-header">
            <h3 class="card-title">Data Table With Full Features</h3>
          </div> -->
          <!-- /.card-header -->
            <div class="card-body">
              <font size="2">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width="100">Kode</th>
                    <th width="100">Nama</th>
                    <th width="100">Satuan</th>
                    <th width="100">Kategori</th>
                    <th width="100">Jenis</th>
                    <th width="20"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php print_r($penerimaan_barang); ?> -->
                  <?php foreach($master_barang as $row){ ?>
                    <tr>
                      <td align="center"><?php echo $row->KODE; ?></td>
                      <td><?php echo $row->NAMA; ?></td>
                      <td align="center"><?php echo $row->SATUAN; ?></td>
                      <td><?php echo $row->KATEGORI; ?></td>
                      <td><?php echo $row->JENIS; ?></td>
                      <td><button type="button" class="btn btn-block btn-warning btn-sm" id="<?php echo $row->ID.'@'.$row->KODE.'@'.$row->NAMA.'@'.$row->JENIS; ?>" data-toggle="modal" data-target="#modal-detail">Detail Test</button></td>
                    </tr>
                  <?php } ?>


                </tbody>
                  <!--  <tfoot>
                    <tr>
                      <th>No</th>
                      <th>Browser</th>
                      <th>Platform(s)</th>
                      <th>Engine version</th>
                      <th>CSS grade</th>
                    </tr>
                  </tfoot> -->
              </table>
              </font>
            </div>
            <!-- /.card-body -->
          </div>
         
 


          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/qc/requirement/save');?>" onsubmit="return confirm('Yakin ingin menyimpan?')">
                    <input type="hidden" id="txtIdBarang" name="txtIdBarang">
                    <input type="hidden" id="txtIdGroupDelete" name="txtIdGroupDelete" = "">
                    <input type="hidden" id="txtNomorDetail" name="txtNomorDetail" value="0">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Kode</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtKode" name="txtKode" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Nama</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNama" name="txtNama" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Jenis</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtJenis" name="txtJenis" readonly></td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            <table>
                              <tr valign="center">
                                <td width="110"><label>&nbsp &nbsp &nbsp &nbsp Test</label></td>
                                <td width="10"></td>
                                <td width="350" colspan="2">
                                  <select class="form-control select2" style="width: 100%;" id="cmbTest">
                                    <option value=""></option>
                                  </select>
                                </td>
                              </tr>
                              <tr height="8" />
                              <tr>
                                <td />
                                <td />
                                <td />
                                <td>
                                   <input type="button" value="Tambah" onclick="tambahTest()" class="btn btn-warning pull-right">
                                </td>
                              </tr>
                            </table>
                            <br>
                            <table border="2" id="tblDetailTest">
                              <tr align="center">
                                <td width="200"><b>Kode</b></td>
                                <td width="200"><b>Description</b></td>
                                <td width="200"><b>Prioritas</b></td>
                                <td width="150"><b>Jenis</b></td>
                                <td width="30"></td>
                              </tr>
                            </table>
                            <table>
                              <tr>
                                <td width="300"><label id="lblMJumlah" name="lblMJumlah" /></td>
                                <td width="280" align="right"><label id="lblOutstanding" style="color:#8B0000;" /></td>
                              </tr>
                            </table>
                            
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-left">Simpan</button>
                        <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                      </div>
                    </div>
                    <!-- <div class="modal-footer"></div> -->
                  </form>
                  <br>
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