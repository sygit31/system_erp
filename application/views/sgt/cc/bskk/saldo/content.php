
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
            <b><font color="White">Saldo Akhir</font></b>
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

            <form role="form" method="POST" action="<?php echo site_url('sgt/cc/bskk/simpanSaldo');?>" onsubmit="return validasi()" autocomplete="off">
            <table>
                <tr>
                    <td width="150">
                        <label><font size = "4">Periode</font></label></td>
                    </td>
                    <td width="300" colspan="3">
                        <div data-tip="Periode Saldo">
                            <input class="form-control" type="text" id="txtTanggal" name="txtTanggal" onchange=xxxxx()>
                        </div>
                    </td>
                </tr>
                <tr height="10" />
                <tr>
                    <td>
                        <label><font size = "4">Jumlah</font></label></td>
                    </td>
                    <td colspan="3">
                        <div data-tip="Jumlah Saldo">
                            <input class="form-control" type="text" id="txtJumlah" name="txtJumlah">
                        </div>
                    </td>
                </tr>
                <tr height="10" />
                <tr>
                    <td />
                    <td width="100">
                        <button type="submit" class="btn btn-block btn-info" id="btnSimpan" style="background-color: #0C1A7D;">Simpan</button>
                    </td>
                    <td width="100" />
                    <td width="100">
                        <button type="reset" class="btn btn-block btn-danger" id="btnBatal" >Batal</button>
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

    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->





























  
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card card-info">
        <div class="card-header">
          <h3 class="card-title">
            <b><font color="White">Data Saldo Akhir</font></b>
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

           
              
          <font size="3">
            <table id="tblData" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <th style="width: 15%;">Periode</th>
                  <th style="width: 15%;">Saldo</th>
                </tr>
              </thead>
              <tbody>

                <?php foreach($data_last as $row){ ?>
                  <tr>
                    <td align="center"><?php echo $row->bulan . ' ' . $row->tahun; ?></td>
                    <td align="center"><?php echo $row->saldo; ?></td>
                   

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
          </font>


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