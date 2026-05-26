
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
            <b><font color="White">Stok Bayangan</font></b>
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


          
          
          <!-- <form id="frm_input" method="POST" action="<?php //echo site_url('sgt/gudang/stok_bayangan/reject');?>" target="_blank"> -->
          <!-- <form id="frm_input" method="POST" action="<?php //echo site_url('sgt/gudang/stok_bayangan/reject');?>" onsubmit="return validasi()"> -->

            <div class="card">
              <!-- <div class="card-header">
                <h3 class="card-title">Data Table With Full Features</h3>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <font size="2">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <!-- <th width="5">Pilih</th> -->
                      <th width="100">PO</th>
                      <th width="150">Nama</th>
                      <th width="100">Barcode</th>
                      <th width="50">Tgl Diterima</th>
                      <th width="50">Qty</th>
                      <!-- <th width="50">Satuan</th> -->
                      <th width="50"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php //print_r($dOutstanding); ?> -->
                    <?php foreach($stok as $row){ ?>
                      <tr>
                        <!-- <td align="center"><input type="checkbox" name="cbReject[]" value="<?php echo $row->ID_DETAIL_TERIMA;?>"></td> -->
                        <td align="center"><?php echo $row->NOMER; ?></td>
                        <td><?php echo $row->NAMA; ?></td>
                        <td align="center"><?php echo $row->BARCODE; ?></td>
                        <td align="center"><?php echo $row->TGL_TERIMA; ?></td>
                        <?php
                          $jml = "";
                          if (isset($row->QTY)) {
                            $jml = $row->QTY;
                          }else{
                            $jml = $row->QTY_TERIMA;
                          }
                        ?>
                        <td align="right"><?php echo $jml."  ". $row->SATUAN; ?></td>
                        <!-- <td><?php //echo $row->SATUAN; ?></td> -->
                        <td><button type="button" class="btn btn-block btn-warning btn-sm" id="<?php echo $row->ID_DETAIL_TERIMA."@".$row->BARCODE."@".$row->NAMA."@".$row->NOMER."@".$row->ID_BARANG."@".$row->STATUS_QC."@".$jml; ?>" data-toggle="modal" data-target="#modal-detail">Action</button></td>
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
          <!-- </form> -->



          <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <table>
                        <tr valign="center">
                          <td width="100"><label>Nomer PO</label></td>
                          <td width="20"></td>
                          <td width="300"><input class="form-control" type="text" id="txtNoPo" name="txtNoPo" readonly></td>
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
                            <table border="1" id="tblDetailTest">
                              <tr align="center">
                                <td width="150"><b>Test</b></td>
                                <td width="100"><b>Prioritas</b></td>
                                <td width="250"><b>Hasil</b></td>
                              </tr>
                            </table>
                            <br />
                            <div style="text-align: center;">
                              <form id="frm_input" method="POST" action="<?php echo site_url('sgt/qc/cek_qc_gagal/validasi');?>">
                                <input type="hidden" name="txtIdD" id="txtIdD" value="">
                                <input type="hidden" name="txtStatusQc" id="txtStatusQc" value="">
                                <input type="hidden" name="txtJml" id="txtJml" value="">
                                <input type="hidden" name="txtAksi" id="txtAksi" value="">
                                <table style="margin-left:auto;margin-right:auto;">
                                  <tbody>
                                  <tr>
                                    <td colspan="3" align="center">
                                      <!-- <input class="form-control" type="text" id="txtNote" name="txtNote" placeholder="Catatan . . ." style="" height="500"> -->
                                      <textarea class="form-control" id="txtNote" name="txtNote" name="textarea" style="width:460px;height:60px;"></textarea>
                                    </td>
                                  </tr>
                                  <tr height="10"></tr>
                                  <tr>
                                    <td width="100">
                                      <button type="submit" class="btn btn-info" id="btnSimpan" name="btnSimpan" value="terima" onclick="btnTerima()">Baik</button>
                                    </td>
                                    <td width="300"></td>
                                    <td width="100">
                                      <button type="submit" class="btn btn-danger" id="btnSimpan" name="btnSimpan" value="tolak" onclick="btnTolak()">Jelek</button>
                                    </td>
                                  </tr>
                                  </tbody>
                                </table>
                              </form>
                            </div>
                            <br />
                            <br />
                            <div id="syarat" style="text-align: center;"></div>
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                    </div>
                    <!-- <div class="modal-footer"></div> -->
                  <br>
                </div>
                      <!-- /.modal-content -->
            </div>
                    <!-- /.modal-dialog -->
          </div>


          



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
  </div>
  <!-- /.content-wrapper -->