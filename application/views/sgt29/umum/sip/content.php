
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
            <b><font color="White">SIP</font></b>
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
              <font size="4">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width="100">Tanggal</th>
                    <th width="100">Barang</th>
                    <th width="50"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($data_sip_last as $row){ ?>
                    <tr align="center">
                      <td><?php echo $row->TANGGAL; ?></td>
                      <td><?php echo $row->NO_SIP; ?></td>
                      <td><?php
                      
                        print_r("<button type='button' class='btn btn-block btn-warning' id='".$row->ID."' data-toggle='modal' data-target='#modal-detail'>Detail</button>");
                      ?></td>
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
                  <form role="form" method="POST" action="<?php echo site_url('sgt/umum/sip/cetak_sip');?>" autocomplete="off" target="_blank">
                    <input type="hidden" id="txtIdSIP" name="txtIdSIP">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr>
                          <td width='100'>
                            <label>Tanggal</label>
                          </td>
                          <td>
                            <label>:</label>
                          </td>
                          <td>
                            <label id="lblTglSIP">12/12/1212</label>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            <label>No. SIP</label>
                          </td>
                          <td>
                            <label id="lblNoSIP">:</label>
                          </td>
                          <td>
                            <label>xxxxxxxxxxxxxx</label>
                          </td>
                        </tr>
                      </table>
                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                            <table id="tblDetailSIP" border="1">
                              <tr align="center">
                                <th width="50">No.</th>
                                <th width="100">Bagian</th>
                                <th width="150">Barang</th>
                                <th width="70">Jumlah</th>
                                <th width="70">Satuan</th>
                                <th width="280">Keterangan</th>                              
                                <th width="80" />                              
                              </tr>
                            </table>

                            <br />
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <!-- <br /> -->
                        <table>
                          <tr>
                            <td >
                              <button class="btn btn-warning pull-left">&nbsp &nbsp Cetak &nbsp &nbsp </button>
                              &nbsp &nbsp
                              <button class="btn btn-danger" data-dismiss="modal">&nbsp &nbsp Tutup &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table>
                        
                      </div>
                    </div>
                    <!-- <div class="modal-footer"></div> -->
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



