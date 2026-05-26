
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header"></section>

    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Setting &nbsp Akun</font></b>
          </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          


          <form role="form" method="POST" action="<?php echo site_url('sgt/akun/update');?>" onsubmit="return validasi(this)">



            <div class="card">
              <div class="card-header">
                <?php $CRE = explode('|',$_SESSION['logERP']); ?>
                <h3 class="card-title"><?php echo $CRE[1];?></h3>
                <input type="hidden" class="form-control" id="txtIDkaryawan" name="txtIDkaryawan" value="<?php echo $CRE[0];?>">
              </div>
              <!-- /.card-header -->
              <div class="card-body">




                <div class="card card-danger">
                  <div class="card-header">
                    <class="card-title"><b>Ganti &nbsp Username</b></class="card-title">
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table>
                      <tr>
                        <td width="200">Username Baru</td>
                        <td width="30">:</td>
                        <td width="300">
                            <input class="form-control" id="txtUserBaru" name="txtUserBaru" maxlength="10">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>



                <div class="card card-danger">
                  <div class="card-header">
                    <class="card-title"><b>Ganti &nbsp Password</b></class="card-title">
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fa fa-minus"></i></button>
                      <button type="button" class="btn btn-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
                        <i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table>
                      <tr>
                        <td width="200">Password Baru</td>
                        <td width="30">:</td>
                        <td width="300">
                          <input type="password" class="form-control" id="txtPassBaru1" name="txtPassBaru1">
                        </td>
                      </tr>
                    </table>
                    <br>
                    <table>
                      <tr>
                        <td width="200">Konfirmasi Password Baru</td>
                        <td width="30">:</td>
                        <td width="300">
                          <input type="password" class="form-control" id="txtPassBaru2" name="txtPassBaru2">
                        </td>
                      </tr>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>





              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <table>
                      <tr>
                        <td width="150">Password saat ini</td>
                        <td width="30">:</td>
                        <td width="200">
                          <input type="password" class="form-control" id="txtPass" name="txtPass">
                        </td>
                        <td width="20"></td>
                        <td width="100">
                          <button type="Submit" class="btn btn-block btn-success" onclick="return confirm('yakin ingin merubah akun anda?')">Simpan</button>
                        </td>
                        <td width="10"></td>
                        <td width="100">
                          <button type="reset" class="btn btn-block btn-danger">Batal</button>
                        </td>
                      </tr>
                    </table>
              </div>
            </div>



          </form>
          

        </div>
        <!-- /.card-body -->
        <div class="card-footer"><font color="Green" size="2">
            IPB @2018
        </font></div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->