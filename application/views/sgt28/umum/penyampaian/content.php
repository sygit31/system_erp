
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
            <b><font color="White">Penyampaian</font></b>
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

          
        
          <div class="card" style="width: 50%;">
            <!-- <div class="card-header">
              <h3 class="card-title">Data Table With Full Features</h3>
            </div> -->
            <!-- /.card-header -->
            <div class="card-body">
              <font size="2">
              <table id="tblBagian" class="table table-bordered table-striped">
                <thead>
                  <tr align="center">
                    <th width="470"><h3><b>Bagian</b></h3></th>
                    <th width="30"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($data_permintaan); ?> -->
                  <?php foreach($data_bagian as $row){ ?>
                    <tr align="center">
                      <td ><font color='#DC3545'><h5><b><?php echo $row->BAGIAN; ?></b></h5></font></td>
                      <td ><button type="button" class="btn btn-block btn-danger btn-sm" 
                          id=<?php echo $row->ID_BAGIAN.'@'.$row->BAGIAN; ?> data-toggle='modal' data-target='#modal-detail'>Detail</button></td>
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
                  <form role="form" method="POST" action="<?php echo site_url('sgt/umum/penyampaian/simpan');?>" onsubmit="return validasi(this)" autocomplete="off">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td>
                            <label id='lblBagian' style="font-size: 50px;color: blue;"/>
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
                            

                          <font size=3>
                          <table id="tblPermintaan" class="table table-bordered table-striped">
                            <thead>
                              <tr align="center">
                                <th width="150">Tanggal</th>
                                <th width="350">Barang</th>
                                <th width="75">Satuan</th>
                                <th width="75">Jumlah</th>
                                <th width="75">Outstanding</th>
                                <th width="75">Pemenuhan</th>
                              </tr>
                            </thead>
                            <tbody>

                              <?php //foreach($data_permintaan_per_bagian as $asd){ 
                                  
                                    // if ($asd->ID_BAGIAN === '6') {
                                    //   print_r('<tr align="center">');
                                    //   print_r('<td >'.$asd->TANGGAL.'</td>');
                                    //   print_r('<td >'.$asd->BARANG.'</td>');
                                    //   print_r('<td >'.$asd->SATUAN.'</td>');
                                    //   print_r('<td ><font color="blue">'.$asd->JUMLAH.'</font></td>');
                                    //   print_r('<td ><font color="red">'.$asd->KEKURANGAN.'</font></td>');
                                    //   print_r('<td >
                                    //   <input class="form-control" type="hidden" id="txtIdSIPDetail[]" name="txtIdSIPDetail[]" value="'.$asd->ID.'">
                                    //   <input class="form-control" type="hidden" id="txtOutstanding[]" name="txtOutstanding[]" value="'.$asd->KEKURANGAN.'">
                                    //   <input class="form-control" type="text" id="txtJumlah[]" name="txtJumlah[]" onkeydown="justNumber(event);">
                                    //   </td>');
                                    //   print_r('</tr>');
                                    // }
                                  
                              //} ?>


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