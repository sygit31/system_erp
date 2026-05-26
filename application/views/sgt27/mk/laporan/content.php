
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
            <b><font color="White">Laporan Tugas</font></b>
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
                    <th width="60">Bagian</th>
                    <th width="100">Nama</th>
                    <th width="100">PIC</th>
                    <th width="170">Project</th>
                    <th width="100">Tugas</th>
                    <th width="40">Target (%)</th>
                    <th width="40">Nilai</th>
                    <th width="20">Pilih</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($DataTugas as $row){ ?>
                    <tr>
                      <td align="center"><?php echo $row->BAGIAN; ?></td>
                      <td><?php echo $row->KARYAWAN; ?></td>
                      <td><?php echo $row->PIC; ?></td>
                      <td><?php echo $row->PROJECT; ?></td>
                      <td><?php echo $row->TUGAS; ?></td>
                      <td align="center"><?php echo $row->TARGET; ?></td>
                      <td align="center"><?php echo $row->NILAI; ?></td>
                      <td align="center">
                        <button type="button" class="btn btn-block btn-warning" 
                        id="<?php echo 
                        $row->ID."@".$row->BAGIAN."@".$row->KARYAWAN."@".$row->PIC."@".$row->PROJECT."@".
                        $row->TUGAS."@".$row->TARGET."@".$row->NILAI;?>" 
                         data-toggle="modal" data-target="#modal-detail">Lihat</button>
                      </td>
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
                  <form role="form" method="POST" action="<?php echo site_url('sgt/mk/monitoring/simpan');?>" onsubmit="validasi(this,event)" autocomplete="off">
                    <input type="hidden" id="txtIdTugas" name="txtIdTugas"/>
                    <input type="hidden" id="txtStatus" name="txtStatus" value="open"/>
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="top">
                          <td width="110"><label>&nbsp Bagian</label></td>
                          <td width="10"></td>
                          <td width="350"><input class="form-control" type="text" id="txtBagian" name="txtBagian" readonly></td>
                        </tr>
                        <tr height="10"/>
                        <tr valign="top">
                          <td><label>&nbsp Nama</label></td>
                          <td></td>
                          <td><input class="form-control" type="text" id="txtNama" name="txtNama" readonly></td>
                        </tr>
                        <tr height="10"/>
                        <tr valign="top">
                          <td><label>&nbsp PIC</label></td>
                          <td></td>
                          <td><input class="form-control" type="text" id="txtPIC" name="txtPIC" readonly></td>
                        </tr>
                        <tr height="10"/>
                        <tr valign="top">
                          <td><label>&nbsp Project</label></td>
                          <td></td>
                          <td><input class="form-control" type="text" id="txtProject" name="txtProject" readonly></td>
                        </tr>
                        <tr height="10"/>
                        <tr valign="top">
                          <td><label>&nbsp Tugas</label></td>
                          <td></td>
                          <td><input class="form-control" type="text" id="txtTugas" name="txtTugas" readonly></td>
                        </tr>
                        
                      </table>


                      <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button> -->
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body" id="dataTugas">
                          <!-- ISI -->
                            <!-- <table>
                              <tr valign="top">
                                <td width="110"><label>&nbsp Bagian</label></td>
                                <td width="10"></td>
                                <td width="350"><input class="form-control" type="text" id="txtBagian" name="txtBagian" readonly></td>
                              </tr>
                              <tr height="10"/>
                              <tr valign="top">
                                <td><label>&nbsp Nama</label></td>
                                <td></td>
                                <td><input class="form-control" type="text" id="txtNama" name="txtNama" readonly></td>
                              </tr>
                              <tr height="10"/>
                              <tr valign="top">
                                <td><label>&nbsp PIC</label></td>
                                <td></td>
                                <td><input class="form-control" type="text" id="txtPIC" name="txtPIC" readonly></td>
                              </tr>
                              <tr height="10"/>
                              <tr valign="top">
                                <td><label>&nbsp Project</label></td>
                                <td></td>
                                <td><input class="form-control" type="text" id="txtProject" name="txtProject" readonly></td>
                              </tr>
                              <tr height="10"/>
                              <tr valign="top">
                                <td><label>&nbsp Tugas</label></td>
                                <td></td>
                                <td><input class="form-control" type="text" id="txtTugas" name="txtTugas" readonly></td>
                              </tr>
                             
                            </table> -->





                            <!-- <br />
                            <table border="2" id="tblProgres">
                              <thead>
                                <tr align="center">
                                  <td width="400"><b>Parameter</b></td>
                                  <td width="100"><b>Progres (%)</b></td>
                                  <td width="300"><b>Catatan</b></td>
                                </tr>  
                              </thead>    
                            </table>
                            <br /> -->
                          <!-- ISI -->
                        </div>
                      </div><!-- /.box-body -->
                      <div class="box-footer">
                        <!-- <br /> -->
                        <!-- <table>
                          <tr>
                            <td width="180">
                              <button class="btn btn-success pull-left">Simpan</button>
                              <button class="btn btn-danger pull-right" data-dismiss="modal">&nbsp &nbsp Batal &nbsp &nbsp</button>
                            </td>
                          </tr>
                        </table> -->
                        
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