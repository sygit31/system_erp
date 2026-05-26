
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
            <b><font color="White">Tarik Data ke Excel</font></b>
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

            <form role="form" method="POST" action="<?php echo site_url('sgt/cc/bskk/export');?>" onsubmit="return validasi()" autocomplete="off">
            <table>
                
                <tr>
                    <td width="100">
                        <label><font size = "4">Periode</font></label></td>
                    </td>
                    <td colspan="2" width="300">
                        <div data-tip="Periode">
                            <input class="form-control" type="text" id="txtTanggal" name="txtTanggal">
                        </div>
                    </td>
                </tr>
                
                <tr height="10" />
                <tr>
                    <td />
                    <td width='150'>
                        <button type="submit" class="btn btn-block btn-info" id="btnSimpan" style="background-color: #0C1A7D;">Export ke Excel</button>
                    </td>
                    <td />
                </tr>
            </table>
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