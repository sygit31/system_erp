
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-success">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Master Parameter QC</font></b>
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

           <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link" href="#master_parameter" data-toggle="tab">DATA MASTER PARAMETER QC</a></li>
                 
                  <li class="nav-item"><a class="nav-link active" href="#add_parameter" data-toggle="tab">TAMBAH MASTER PARAMETER QC</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="master_parameter">
                  <!-- /.isi tab activity -->
                  

                  </div>
                  <!-- /.tab-pane -->
                 

                  <div class="tab-pane" id="add_parameter">
                    <form class="form-horizontal">
                       <div class="card-body">
                                  <form role="form" action="<?php  echo site_url('qc/master_parameter/saveHeaderTestCodeOnSession'); ?>" method=POST>       
                                        <table>
                                          <tr valign="top">
                                          <?php //print_r($xxx); ?>
                                            
                                            <td width="100"><label>Kode Parameter</label></td>
                                            <td width="50"></td>
                                            <td width="600" colspan="2"><?php echo   $data['kode_param']; ?> </td>
                                         
                                          </tr>
                                          <tr height="10"></tr>
                                        
                                          <tr height="10"></tr>
                                          <tr valign="top">
                                            <td width="100"><label>Deskripsi Singkat</label></td>
                                            <td width="50"></td>
                                            <td width="600" colspan="2"><?php echo $data ['deskripsi']; ?></td>
                                          </tr>
                                          <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>  
                                          <tr height="10"></tr>
                                          <tr valign="top">
                                            <td width="100">&nbsp;</td>
                                            <td width="200">
                                              <label>
                                                 <button type="button" class="btn btn-info"></button> 
                                              </label>
                                            </td>
                                            <td width="200">
                                              <label>
                                                  <button type="button" class="btn btn-info"></button>
                                              </label>
                                            </td>
                                          </tr>
                                        </form>
                                        </table>
                                      </div> 
                        </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
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