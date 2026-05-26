
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
            <b><font color="White">Pengajuan SPL</font></b>
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

        <form role="form" method="POST" action="<?php echo site_url('sgt/spl/pengajuan_spl/simpan');?>" autocomplete="off">
          <button class="btn btn-info pull-left" type="button" id="btnAll" style="background-color:#8E44AD">Select All</button>
          <br />
          <br />
          
              <font size="3">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <!-- <th style="width: 10%;">Pilih</th> -->
                      <th style="width: 15%;">BAGIAN</th>
                      <th style="width: 25%;">Nama</th>
                      <th style="width: 15%;">Mulai</th>
                      <th style="width: 15%;">Selesai</th>
                      <th style="width: 25%;">Tujuan</th>
                      <th style="width: 5%;"></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach($data_spl as $row){ ?>
                      <tr>
                        <td align="center">
                          <?php echo $row->BAGIAN; ?>
                          <input type="hidden" name="cbId[]" value="<?php echo $row->ID; ?>" />
                          <input type="hidden" name="cbPilih[]" value="F" />
                        </td>
                        <td align="center"><?php echo $row->KARYAWAN; ?></td>
                        <td align="center"><?php echo $row->MULAI; ?></td>
                        <td align="center"><?php echo $row->SELESAI; ?></td>
                        <td><?php echo $row->TUJUAN; ?></td>
                        <td align="center">
                          <button type="button" class="btn btn-block btn-warning btn-sm" 
                          id=<?php echo $row->ID; ?> 
                          data-toggle='modal' data-target='#modal-detail' >
                            Ubah
                          </button>
                        </td>
                      </tr>
                    <?php } ?>


                  </tbody>
                </table>
              </font>


          <br />
          <input type="hidden" name="txtAksi" value="" id="txtAksi" />
          <table>
            <tr>
                <td>
                  <button class="btn btn-success pull-left" type="submit" id="btnSetuju">&nbsp; &nbsp; &nbsp; SETUJU &nbsp; &nbsp; &nbsp;</button>
                </td>
                <td width="10" />
                <td>
                  <button class="btn btn-danger pull-left" type="submit" id="btnTolak">&nbsp; &nbsp; &nbsp;  &nbsp; TOLAK &nbsp; &nbsp; &nbsp; &nbsp;</button>
                </td>
            </tr>
          </table>
        </form>






        
        <div class="modal fade bd-example-modal-lg" id="modal-detail">
            <!-- <div class="modal-dialog modal-lg"> -->
            <div class="modal-dialog">
                <div class="modal-content">
                  <form role="form" method="POST" action="<?php echo site_url('sgt/spl/pengajuan_spl/ubah');?>" autocomplete="off">
                    <div class="modal-header" style="background-color: #E6E6E6;">
                      <!-- <div class="modal-title"><h5><b>Barang Masuk</b></h5></div> -->
                      <table>
                        <tr valign="center">
                          <td>
                            <label id='lblTitle' style="font-size: 30px;color: #006400;">
                              Perubahan SPL
                            </label>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div class="modal-body">
                      <div class="box box-info">
                        <div class="box-body">
                          <!-- ISI -->
                          <input type="hidden" name="Uid" id="Uid" />

                          <table >
                            <tr>
                                <td width=150>
                                  <label><font size = "5">Bagian</font></label>
                                </td>
                                <td width=350>
                                  <label id='lblUBagian' style="font-size: 20px;" />
                                </td>
                            </tr>

                            <tr height="10">
                            <tr>
                                <td>
                                    <label><font size = "5">Nama</font></label>
                                </td>
                                <td>
                                  <label id='lblUNama' style="font-size: 20px;" />
                                </td>
                            </tr>

                            <tr height="10">
                            <tr>
                              <td>
                                <label><font size = "5">Mulai</font></label>
                              </td>
                              <td>
                                <input type="text" class="form-control pull-right" id="Utanggal_mulai" name = "Utanggal_mulai" style="color:red;" />
                              </td>
                            </tr>

                            <tr height="10">
                            <tr>
                              <td>
                                <label><font size = "5">Selesai</font></label>
                              </td>
                              <td>
                                <input type="text" class="form-control pull-right" id="Utanggal_selesai" name = "Utanggal_selesai" style="color:red;" />
                              </td>
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