<div class="data-table">
  <table id="data-table" class="table table-bordered table-striped" style="font-size: 14px; width: 100%;">
    <thead>
      <tr style="text-align: center;">
        <th width="1%">No.</th>
        <th width="4%">No. Project</th>
        <th width="7%">Tanggal</th>
        <th width="15%">Nama Project</th>
        <th width="15%">Koordinator</th>
        <th width="13%">Nama PIC</th>
        <th width="17%">Tugas</th>
        <th width="7%">Target 1</th>
        <th width="7%">Finish</th>
        <th width="4%">Status</th>
        <th width="7%">Target 2</th>
        <th width="7%">Target 3</th>
        <th hidden>Level</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $urut = 0;
      foreach ($project->result_array() as $dt):

        $urut++;
        $no_project = $dt['NMR'];
        $tgl = date('d-M-Y',strtotime($dt['TGL']));
        $nama_project = $dt['NAMA'];
        $nama_koordinator = $dt['KOORDINATOR'];
        $nama=$dt['NAMA_KARY'];
        $tugas=$dt['TUGAS'];
        $deadline = date('d-M-Y',strtotime($dt['DEADLINE']));
        $target2 = date('d-M-Y',strtotime($dt['TARGET2'])); if ($dt['TARGET2'] == '') {$target2 = '';}
        $target3 = date('d-M-Y',strtotime($dt['TARGET3'])); if ($dt['TARGET3'] == '') {$target3 = '';}
        $level = $dt['LEV'];

        if($dt['FINISH'] != "") {
          $finish = date('d-M-Y',strtotime($dt['FINISH']));
          $status = "Close";
        }else{
          $finish = '';
          $status = "Open";
        }
        ?>

        <!-- Isi Tabel -->
        <tr>
          <td align="center"><?php echo $urut; ?></td>
          <td align="center"><?php echo $no_project; ?></td>
          <td align="center"><?php echo $tgl; ?></td>
          <td><?php echo $nama_project; ?></td>
          <td><?php echo $nama_koordinator; ?></td>
          <td><?php echo $nama; ?></td>
          <td><?php echo $tugas; ?></td>
          <td align="center"><?php echo $deadline; ?></td>

          <?php if ($finish == '') { ?>
            <td align="center"><button type="button" class="btn btn-block btn-info btn-sm" style="width: 50px;" title="Print Data" onclick="isi_table(this)"><i class="fa fa-print"></i></button></td>
          <?php }else{ ?>
            <td align="center"><?php echo $finish; ?></td>
          <?php } ?>
          <td align="center"><?php echo $status; ?></td>
          <td align="center"><?php echo $target2; ?></td>
          <td align="center"><?php echo $target3; ?></td>
          <td hidden><?php echo $level; ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<input type="text" id="now" value="<?php echo date('d-M-Y'); ?>" hidden>