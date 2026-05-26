
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
            <b><font color="White"><div id="headerinput">Master Parameter QC</div></font></b>
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
          
          <form  role="form" method="POST" action="<?php echo site_url('qc/master_parameter/save_testcode');?>" onsubmit="return validasi()">
          <input type="hidden" id="txtJumlahDetail" name="txtJumlahDetail">
          <input type="hidden" id="txtFlagEdit" name="txtFlagEdit" value="no">
          <input type="hidden" id="txtIdTestCode" name="txtIdTestCode" value="0">
          <input type="hidden" id="txtIdDetailDelete" name="txtIdDetailDelete" value="">
          <div class="card card-primary" id="bodyinput">
            <div class="card-body">
                <table>
                  <!-- <tr valign="top">
                    <td width="200"><label>Kode Parameter</label></td>
                    <td width="400" colspan="2"><input class="form-control" type="text" id="txtKodeParam" name="txtKodeParam" value=<?php echo $xxx['NO_URUT']; ?> readonly>
                      <input type="hidden" id=txtnoUrut name="txtnoUrut" value=<?php echo $xxx['NOMOR']; ?>
                    </td>
                  </tr> 
                  <tr height="10"></tr> -->
                  
                  <tr valign="top">
                    <td width="200"><label><font size = "5">Stage</font></label></td>
                    <td width="400" colspan="2">
                      <select name="cmbStage"  id="cmbStage"  class="form-control select2" style="width: 100%;" required>
                        <option value=''></option>
                        <?php foreach($stage as $row){ ?>
                          <option value='<?php echo $row->ID_STAGE; ?>'><?php echo $row->STAGE_NAME ; ?></option>
                        <?php } ?>
                      </select>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Nama</font></label></td>
                    <td><input class="form-control" type="text" id="txtDeskripsi" name="txtDeskripsi" required></td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Prioritas</font></label></td>
                    <td>
                      <select name="cmbPrioritas"  id="cmbPrioritas"  class="form-control select2" style="width: 100%;" required>
                        <option value=''></option>
                        <option value='critical'>Critical</option>
                        <option value='optional'>Optional</option>
                      </select>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                  <tr valign="top">
                    <td><label><font size = "5">Jenis</font></label></td>
                    <td>
                      <select name="cmbJenis"  id="cmbJenis"  class="form-control select2" style="width: 100%;" onchange="pilihTest(this)" required>
                        <option value=''></option>
                        <option value='measure'>Measure Test</option>
                        <option value='visibility'>Visibility Test</option>
                      </select>
                    </td>
                  </tr>
                  <tr height="10"></tr>
                </table>
              
                <table>
                  <tr>
                    <td width="200"></td>
                    <td id="DetailInfo"></td>
                  </tr>
                </table>
                <!-- <font size="2">
                  <div id="DetailInfo"></div>
                </font> -->
                
            </div>
            <div class="card-footer">
              <table>
                <tr>
                  <td width="150"><button type="submit" class="btn btn-block btn-primary" id="btnSimpan" )">Simpan</button></td>
                  <td width="10"></td>
                  <td width="150"><a href="<?php echo site_url('qc/master_parameter'); ?>" class="btn btn-block btn-danger">Batal</a></td>
                </tr>
              </table>
            </div>
          </div>
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



      <!-- ==============================================LAPORAN=========================================== -->

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Data Parameter Test QC</font></b>
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
          <?php /*
          <form  method="POST" action="<?php echo site_url('gudang/penerimaan_barang/tampil');?>">
            <div class="card card-info">
              <div class="card-body">

                <table>
                  <tr>
                    <td>Date Range</td>
                    <td width="50" align="center">:</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAwal" name = "tanggalAwal" placeholder="Batas Awal" required>
                      </font>
                    </td>
                    <td width="50" align="center">to</td>
                    <td width="170">
                      <font size="2"></font>
                        <input type="text" class="form-control pull-right" id="tanggalAkhir" name = "tanggalAkhir" placeholder="Batas Akhir" required>
                      </font>
                    </td>
                  </tr>
                </table>
                           
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-info">&nbsp Filter &nbsp</button>
                <input type="button" value="View All" class="btn btn-warning pull-right" onclick="window.location.href='<?php echo site_url('gudang/penerimaan_barang');?>'" />
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          </form>
          */ ?>

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
                    <th width="70">Kode</th>
                    <th width="100">Description</th>
                    <th width="50">Stage</th>
                    <th width="50">Jenis</th>
                    <th width="50">Prioritas</th>
                    <th width="30">Range</th>
                    <th width="30">Max</th>
                    <th width="30">Min</th>
                    <th width="50">Hasil</th>
                    <th width="10"></th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php print_r($penerimaan_barang); ?> -->
                  <?php foreach($all_data as $row){ ?>
                    <tr>
                      <td><?php echo $row->TEST_CODE; ?></td>
                      <td><?php echo $row->TEST_DESCRIPTION; ?></td>
                      <td><?php echo $row->STAGE_NAME; ?></td>
                      <td><?php echo $row->JENIS; ?></td>
                      <td><?php echo $row->PRIORITAS; ?></td>
                      <td><?php echo $row->RANGE; ?></td>
                      <td><?php echo $row->MAX; ?></td>
                      <td><?php echo $row->MIN; ?></td>
                      <td><?php echo $row->HASIL; ?></td>
                      <td>
                        <form method="POST" action="<?php echo site_url('qc/master_parameter/edit');?>">
                          <button type="submit" class="btn btn-block btn-warning btn-sm" value="<?php echo $row->ID_TEST_CODE; ?>" name="id">Edit</button>
                        </form>
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