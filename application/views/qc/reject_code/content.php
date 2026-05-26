
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
            <b><font color="White">Reject Code QC</font></b>
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
            
            <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#master_parameter" data-toggle="tab">DATA REJECT CODE QC</a></li>
                 
                  <li class="nav-item"><a class="nav-link" href="#add_parameter" data-toggle="tab">TAMBAH REJECT CODE QC</a></li>
                </ul>
              </div>
            </div>

            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="master_parameter">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr align="center">
                        <th width="50">ID</th>
                        <th width="50">Test Code</th>
                        <th width="200">Test Description</th>
                        <th width="50">Reject Code</th>
                        <th width="200">Reject Description</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php foreach ($reject_code->result_array() as $dt) : ?>
                        <tr>
                          <td><?php echo $dt['ID_REJECT_CODE']; ?></td>
                          <td><?php echo $dt['TEST_CODE']; ?></td>
                          <td><?php echo $dt['TEST_DESCRIPTION']; ?></td>
                          <td><?php echo $dt['REJECT_CODE']; ?></td>
                          <td><?php echo $dt['REJECT_DESCRIPTION']; ?></td>
                        </tr>
                      <?php endforeach; ?> 

                    </tbody>
                  </table>
                </div>

                <div class="tab-pane" id="add_parameter">                  
                  <form class="form-horizontal" method="POST" action="<?php echo site_url('qc/Reject_code/add') ?>" onsubmit="return validasi()">
                    <div class="card-body">
                      <table>
                        <tr valign="top">                                           
                          <th width="200">NO. REJECT</th>
                          <td colspan="3"><input class="form-control" type="text" name="id_reject" value=<?php echo $NoReject['NO_URUT']; ?> readonly=""></td>
                        </tr>
                        <tr valign="top">                                           
                          <th width="200">TEST CODE</th>
                          <td colspan="3">

                          <select onclick="myFunction()" class="form-control" style="width: 500px" name="cmbTestCode">
                            <option value=""></option>
                          <?php foreach ($TestCode as $tCode){ ?>
                            <option onclick="myselect()" value='<?php echo $tCode->ID_DETAIL_TEST_CODE ?>'><?php echo $tCode->TEST_CODE.' ('.$tCode->TEST_DESCRIPTION.')'; ?></option>
                          <?php } ?>
                          </select>





<!--                               <select onclick="myFunction()" class="form-control" style="width: 500px" id="cmbRejectCode"></select>
                              <div id="myDropdown" class="dropdown-content">
                                <input type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                <?php foreach ($TestCode as $tCode){ ?>
                                  <option onclick="myselect()" id="pilih"><?php echo $tCode->TEST_CODE.' ('.$tCode->TEST_DESCRIPTION.')'; ?></option>
                                <?php } ?>
                              </div> -->


                          </td>
                        </tr>
                        <tr valign="top">                                           
                          <th width="200">REJECT CODE</th>
                          <td colspan="3"><input class="form-control" type="text" name="txtRejectCode"></td>
                        </tr>
                        <tr valign="top">                                           
                          <th width="200">REJECT DESCRIPTION</th>
                          <td colspan="3"><input class="form-control" type="text" name="txtRejectDescription"></td>      
                        </tr>
                        <tr height="20"></tr>
                        <tr>
                          <td></td>                          
                          <td width="80"><input class="btn btn-block btn-warning" type="submit" name="simpan" value="Simpan"></td>
                          <td width="80"><input class="btn btn-block btn-warning" type="reset" name="reset" value="Reset"></td>
                          <td width="300"></td>
                        </tr>
                      </table>
                    </div> 
                  </form>
                </div>

            </div>
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