<table id="data-table" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th width="2%">Pilih</th>
            <th>No.</th>
            <th width="5%">No. Project</th>
            <th width="6%">Nama Karyawan</th>
            <th width="6%">Tanggal</th>
            <th width="6%">Level Proj.</th>
            <th width="15%">Nama Project</th>
            <th width="6%">Nilai</th>
            <th width="15%">Nama PIC</th>
            <th width="15%">Tugas</th>
            <th width="6%">Target 1</th>
            <th width="6%">Target 2</th>
            <th width="6%">Target 3</th>
            <th width="6%">Finish</th>
            <th width="6%">Status</th>
            <th hidden>ID Project</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $urut = 1;
        $nmr_project = "";
        foreach ($project->result_array() as $dt):

            // Hide cells with same project_name
            if($nmr_project == $dt['NMR'] && $urut != 1) {
                $koordinator = '';
                $nmr = "";
                $no_project = "";
                $tgl = "";
                $nama_project = "";
                $nilai = '';  
                $qty = '';  
                $level = '';
            }else{
                $nmr = $urut++;
                $koordinator = ucwords(strtolower($dt['KOORDINATOR']));
                $no_project = $dt['NMR'];
                $tgl = date('d-M-Y',strtotime($dt['TGL']));
                $nama_project = $dt['NAMA'];
                $qty = $dt['QTY'];
                if ($dt['NILAI'] == '' || $qty > 0) {$nilai = '';}else{$nilai = number_format($dt['NILAI'],2);}
                $level = $dt['LEV']; 
            }

            $nmr_project = $dt['NMR'];
            $id = $dt['ID'];
            $nama = ucwords(strtolower($dt['NAMA_KARY']));
            $tugas = $dt['TUGAS'];
            $deadline = date('d-M-Y',strtotime($dt['DEADLINE'])); if ($dt['DEADLINE'] == '') {$deadline = '';}
            $target2 = date('d-M-Y',strtotime($dt['TARGET2'])); if ($dt['TARGET2'] == '') {$target2 = '';}
            $target3 = date('d-M-Y',strtotime($dt['TARGET3'])); if ($dt['TARGET3'] == '') {$target3 = '';}
            $finish = date('d-M-Y',strtotime($dt['FINISH'])); if ($dt['FINISH'] == '') {$finish = '';}
            $aktif = $dt['AKTIF'];             
            if ($level == 1) {$level = 'Sangat Tinggi';}
            if ($level == 2) {$level = 'Tinggi';}
            if ($level == 3) {$level = 'Sedang';}                
            if ($dt['FINISH'] != '' || $aktif == '2') {
                $status = 'Close';
                $font = '#030000';
            }else{
                $status = 'Open';
                $font = '#EC0505';
            }

                // Cek Deltime Tanggal vs Sekarang
            $warna1 = ''; $warna2 = ''; $warna3 = '';
            $date_now = date("ymd");
            $date1 = date('ymd',strtotime($dt['DEADLINE']));
            $date2 = date('ymd',strtotime($dt['TARGET2']));
            $date3 = date('ymd',strtotime($dt['TARGET3']));

            if ($dt['TARGET3'] != '' && $status == 'Open') {
                if ($date_now > $date3) {
                    $warna3 = '#F58B8B';
                }elseif ($date_now+8 > $date3) {
                    $warna3 = '#FAF48D';
                }
            }elseif ($dt['TARGET2'] != '' && $status == 'Open') {
                if ($date_now > $date2) {
                    $warna2 = '#F58B8B';
                }elseif ($date_now+8 > $date2) {
                    $warna2 = '#FAF48D';
                }
            }elseif ($dt['DEADLINE'] != '' && $status == 'Open') {
                if ($date_now > $date1) {
                    $warna1 = '#F58B8B';
                }elseif ($date_now+8 > $date1) {
                    $warna1 = '#FAF48D';
                }
            }

            ?>

            <!-- Isi Tabel -->
            <tr>
                <td align="center"><input type="radio" class="action" name="action" onclick="get_action(this)" style="cursor: pointer;" <?php if ($status == 'Close') {echo 'hidden';} ?>></td>
                <td align="center"><?php echo $nmr; ?></td>
                <td align="center"><?php echo $no_project; ?></td>
                <td><?php echo $koordinator; ?></td>
                <td align="center"><?php echo $tgl; ?></td>
                <td align="center"><?php echo $level; ?></td>
                <td><?php echo $nama_project; ?></td>
                <td align="center"><?php if ($nilai == '') {echo '';}else{echo $nilai;} ?></td>
                <td bgcolor="<?php if ($aktif == '2') {echo '#F58B8B';} ?>"><?php echo $nama; ?></td>
                <td bgcolor="<?php if ($aktif == '2') {echo '#F58B8B';} ?>"><?php echo $tugas; ?></td>
                <td align="center" bgcolor="<?php if (isset($warna1)) {echo $warna1;} ?>"><?php echo $deadline; ?></td>
                <td align="center" bgcolor="<?php if (isset($warna2)) {echo $warna2;} ?>"><?php echo $target2; ?></td>
                <td align="center" bgcolor="<?php if (isset($warna3)) {echo $warna3;} ?>"><?php echo $target3; ?></td>
                <td align="center"><?php echo $finish; ?></td>
                <td align="center" style="color: <?php echo $font; ?>"><?php echo $status; ?></td>
                <td hidden><?php echo $id; ?></td>
            </tr>
        <?php endforeach; ?>

    </tbody>
</table>