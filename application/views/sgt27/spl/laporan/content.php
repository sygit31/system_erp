
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
            <b><font color="White">Laporan SPL</font></b>
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
                <table id="example2" class="table table-bordered table-striped">
                  <thead>
                    <tr align="center">
                      <!-- <th style="width: 10%;">Pilih</th> -->
                      <th style="width: 15%;">NIK</th>
                      <th style="width: 25%;">Nama</th>
                      <th style="width: 25%;">Bagian</th>
                      <th style="width: 15%;">Total Lembur</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach($dataLembur as $row){ ?>
                      <tr style='background-color:
                        <? echo $row->TOTAL_LEMBUR / 60 > 24 ? "#F1948A" : "white" ?>'
                      >
                        <td align="center">
                          <?php echo $row->NIK; ?>
                          <!-- <input type="hidden" name="cbId[]" value="<?php //echo $row->ID; ?>" /> -->
                          <!-- <input type="hidden" name="cbPilih[]" value="F" /> -->
                        </td>
                        <td align="center"><?php echo $row->KARYAWAN; ?></td>
                        <td align="center"><?php echo $row->BAGIAN; ?></td>
                        <?php
                          $total_lembur = intval($row->TOTAL_LEMBUR / 60) . " Jam " . $row->TOTAL_LEMBUR % 60 . " Menit";

                        ?>

                        <td align="center"><?php echo $total_lembur; ?></td>
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