
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
            <b><font color="White">Approval Tugas</font></b>
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
          <form id="frmData" role="form" method="POST" action="<?php echo site_url('sgt/mk/approval/simpan');?>">
          <table>
            <tr>
              <td width="150">
                <button type="submit" class="btn-lg btn-block btn-success" id="btnSimpan">Simpan</button>
              </td>
              <td width="20" />
              <td width="150">
                <button type="reset" class="btn-lg btn-block btn-danger" id="btnBatal">Batal</button>
              </td>
            </tr>
            <tr height="10" />
          </table>


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
                    <th width="80">Nama</th>
                    <th width="80">PIC</th>
                    <th width="210">Project</th>
                    <th width="80">Tugas</th>
                    <th width="40">Target</th>
                    <th width="40">Nilai</th>
                    <th width="40">Approval</th>
                  </tr>
                </thead>
                <tbody>

                  <!-- <?php //print_r($penerimaan_barang); ?> -->
                  <?php foreach($DataUsulan as $row){ ?>
                    <tr>
                      <td><?php echo $row->BAGIAN; ?></td>
                      <td><?php echo $row->KARYAWAN; ?></td>
                      <td><?php echo $row->PIC; ?></td>
                      <td><?php echo $row->PROJECT; ?></td>
                      <td><?php echo $row->TUGAS; ?></td>
                      <td align="center"><?php echo $row->TARGET; ?></td>
                      <td align="center"><?php echo $row->NILAI; ?></td>
                      <td>
                        <input type="hidden" name="txtId[]" value=<?php echo $row->ID; ?>>
                        <input class="form-control" type="text" name="txtApproval[]" onkeydown="justNumber(event);" style="height: 30px;">
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