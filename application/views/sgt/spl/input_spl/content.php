
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
            <b><font color="White">Input SPL</font></b>
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

          <form role="form" method="POST" action="<?php echo site_url('sgt/spl/input_spl/simpan');?>" autocomplete="off">
            <table>
            
              <tr valign="middle">
                  <td width="150">
                    <label><font size = "5">Mulai</font></label>
                  </td>
                  <td width="300">
                    <font size="2"></font>
                      <div data-tip="Tanggal Mulai">
                        <input type="text" class="form-control pull-right" id="tanggal_mulai" name = "tanggal_mulai" style="background: white;">
                      </div>
                    </font>
                  </td>
              </tr>

              <tr height="10">
              <tr valign="middle">
                  <td>
                    <label><font size = "5">Selesai</font></label>
                  </td>
                  <td>
                    <font size="2"></font>
                      <div data-tip="Tanggal Selesai">
                        <input type="text" class="form-control pull-right" id="tanggal_selesai" name = "tanggal_selesai" style="background: white;">
                      </div>
                    </font>
                  </td>
              </tr>

              <tr height="10">
              <tr valign="middle">
                  <td>
                    <label><font size = "5">Tujuan</font></label>
                  </td>
                  <td>
                    <font size="2"></font>
                      <div data-tip="Tujuan Lembur">
                        <textarea class="form-control" rows="3" id="txtTujuan" name="txtTujuan"></textarea>
                      </div>
                    </font>
                  </td>
              </tr>

              <tr height="10">
              <tr valign="middle">
                  <td>
                    <label><font size = "5">Bagian</font></label>
                  </td>
                  <td >
                    <div data-tip="Pilih Bagian">
                      <select class="form-control select2" id="cmbBagian" name="cmbBagian"  onChange="showKaryawan()" >
                        <option value=""></option>
                        <?php foreach($data_bagian as $row){ ?>
                          <option value='<?php echo $row->ID; ?>'><?php echo $row->NAMA ; ?></option>
                        <?php } ?> 
                      </select>
                    </div>
                    <input type="hidden" name="txtBagian" id="txtBagian" value="" />
                  </td>
              </tr>
            </table>
            <br />
            
              <font size="3">
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <!-- <th style="width: 10%;">Pilih</th> -->
                      <th style="width: 20%;">NIK</th>
                      <th style="width: 40%;">Nama</th>
                      <th style="width: 40%;">SPL Bulan ini</th>
                    </tr>
                  </thead>
                  <tbody>

                    <!-- <?php //foreach($data_karyawan as $row){ ?>
                      <tr>
                        <td align="center"><input type="checkbox" name="cbPilih[]" value="<?php //echo $row->ID;?>"></td>
                        <td align="center"><?php //echo $row->NIK; ?></td>
                        <td ><?php //echo $row->NAMA; ?></td>
                      </tr>
                    <?php //} ?> -->


                  </tbody>
                </table>
              </font>
            
            <br />
            <table>
            <tr>
                <td>
                  <button class="btn btn-success pull-left" type="submit">&nbsp; &nbsp; &nbsp; Simpan &nbsp; &nbsp; &nbsp;</button>
                </td>
                <td width="10" />
                <td>
                  <button class="btn btn-danger pull-left" type="reset">&nbsp; &nbsp; &nbsp;  &nbsp; Batal &nbsp; &nbsp; &nbsp; &nbsp;</button>
                </td>
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







      <br />
      <br />









      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Daftar Pengajuan SPL</font></b>
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

          
          <form role="form" method="POST" action="<?php echo site_url('sgt/spl/cetak_spl/cetak_ulang');?>" target="_blank">
          <font size="3">
            <table id="tblSPL" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <!-- <th style="width: 10%;">Pilih</th> -->
                  <th style="width: 15%;">BAGIAN</th>
                  <th style="width: 20%;">Nama</th>
                  <th style="width: 15%;">Mulai</th>
                  <th style="width: 15%;">Selesai</th>
                  <th style="width: 25%;">Tujuan</th>
                  <th style="width: 10%;">Status</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($dataSPL as $row){ ?>
                  <tr>
                    <td align="center">
                      <?php echo $row->BAGIAN; ?>
                      <input type="hidden" name="cbId[]" value="<?php echo $row->ID; ?>" />
                      <input type="hidden" name="cbPilih[]" value="F" />
                      <input type="hidden" name="cbBagian[]" value="<?php echo $row->BAGIAN; ?>" />
                    </td>
                    <td align="center">
                      <?php echo $row->KARYAWAN; ?>
                      <input type="hidden" name="cbNama[]" value="<?php echo $row->KARYAWAN; ?>" />
                    </td>
                    <td align="center">
                      <?php echo $row->MULAI; ?>
                      <input type="hidden" name="cbMulai[]" value="<?php echo $row->MULAI; ?>" />
                    </td>
                    <td align="center">
                      <?php echo $row->SELESAI; ?>
                      <input type="hidden" name="cbSelesai[]" value="<?php echo $row->SELESAI; ?>" />
                    </td>
                    <td>
                      <?php echo $row->TUJUAN; ?>
                      <input type="hidden" name="cbTujuan[]" value="<?php echo $row->TUJUAN; ?>" />
                    </td>
                    <td align="center">
                      <?php echo $row->STATUS; ?>
                      <input type="hidden" name="cbStatus[]" value="<?php echo $row->STATUS; ?>" />
                    </td>


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
            
            <br />
            <button class="btn btn-success pull-left" type="submit">&nbsp; &nbsp; &nbsp; Cetak Ulang &nbsp; &nbsp; &nbsp;</button>

          </font>
          </form>


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