
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
            <b><font color="White">Pengecekan QC</font></b>
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
                    <th width="75">Tanggal</th>
                    <th width="50">Nomer PO</th>
                    <!-- <th width="100">Nomer SP</th> -->
                    <th width="100">Supplier</th>
                    <th width="150">Material</th>
                    <th width="75">Barcode</th>
                    <th width="50">Quantity</th>
                    <!-- <th width="50">Satuan</th> -->
                    <th width="20"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($barang_masuk as $row){ ?>
                    <tr>
                      <td align="center"><?php echo $row->TGL_TERIMA; ?></td>
                      <td align="center"><?php echo $row->NOMER; ?></td>
                      <!-- <td><?php //echo $row->NO_SP; ?></td> -->
                      <td align="center"><?php echo $row->NAMA_SUPPLIER; ?></td>
                      <td align="center"><?php echo $row->NAMA_BARANG; ?></td>
                      <td align="center"><?php echo $row->BARCODE; ?></td>
                      <td align="center"><?php echo $row->QTY_TERIMA."  ".$row->SATUAN; ?></td>
                      <!-- <td><?php //echo $row->SATUAN; ?></td> -->
                      <td><button type="button" class="btn btn-block btn-warning btn-sm" id="<?php echo $row->ID_DETAIL_TERIMA."@".$row->NO_SP."@".$row->BARCODE."@".$row->NAMA_BARANG; ?>" data-toggle="modal" data-target="#modal-detail">Check</button></td>
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
                  <!-- <form role="form" method="POST" action="<?php //echo site_url('qc/cek_qc/save');?>" onsubmit="return simpan(this)"> -->
                  <form id="frm_input" method="POST" action="<?php echo site_url('qc/cek_qc/save');?>">
                    <!-- <input type="hidden" id="txtIdBarang" name="txtIdBarang">
                    <input type="hidden" id="txtIdGroupDelete" name="txtIdGroupDelete" = ""> -->
                    <input type="hidden" id="txtIdDetailTerima" name="txtIdDetailTerima" value="0"> 
                    <input type="hidden" id="txtNomorDetail" name="txtNomorDetail" value="0"> 
                    <input type="hidden" id="txtGrade" name="txtGrade" value="0"> 
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Nomer SP</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNoSp" name="txtNoSp" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Barcode</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtBarcode" name="txtBarcode" readonly></td>
                        </tr>
                        <tr valign="center">
                          <td width="100"><label>Material</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtMaterial" name="txtMaterial" readonly></td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            <table border="2" id="tblDetailTest">
                              <tr align="center">
                                <td width="200"><b>Test</b></td>
                                <td width="150"><b>Prioritas</b></td>
                                <td width="150"><b>Hasil</b></td>
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
                        <table>
                          <tr>
                            <td width="60">Status :</td>
                            <td width="140">
                              <select class="form-control select" style="width: 90%;" id="cmbStatus" name ="cmbStatus" disabled="true";>
                                <option value='OPEN' selected="selected">OPEN</option>
                                <option value='CLOSE'>CLOSE</option>
                              </select>
                            </td>
                            <td width="300">
                              <button type="submit" class="btn btn-success pull-left" id="btnSimpan">Simpan</button>
                              <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table>
                        <!-- <button type="submit" class="btn btn-success pull-left" id="btnSimpan">Simpan</button> -->
                        <!-- <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button> -->
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