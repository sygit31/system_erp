<div class="data-table" id="data_proj">
    <table id="data-table" class="table table-bordered table-striped data-table" style="font-size: 14px; width: 99%; margin: 5px;">
        <thead style="text-align: center;">
            <tr>
                <td width="1%">No.</td>
                <td hidden>ID Kary</td>
                <td width="4%">No. Project</td>
                <td width="7%">Tanggal</td>
                <td width="15%">Nama Project</td>
                <td width="17%">Tugas</td>
                <td width="7%">Deadline</td>
                <td width="7%">Finish</td>
                <td width="4%">Nilai</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $urut = 1;
            $nmr_project = "";
            foreach ($pic_proj->result_array() as $dt):
                $nmr = $urut++;
                $id_kary = $dt['ID_KARY'];
                $no_project = $dt['NMR'];
                $tgl = date('d-M-Y',strtotime($dt['TGL']));
                $nama_project=$dt['NAMA'];
                $tugas=$dt['TUGAS'];
                $deadline = date('d-M-Y',strtotime($dt['DEADLINE']));
                $target2 = date('d-M-Y',strtotime($dt['TARGET2'])); if ($dt['TARGET2'] == '') {$target2 = '';}
                $target3 = date('d-M-Y',strtotime($dt['TARGET3'])); if ($dt['TARGET3'] == '') {$target3 = '';}
                $finish = date('d-M-Y',strtotime($dt['FINISH'])); if ($dt['FINISH'] == '') {$finish = '';}

                // Penilaian Bobot
                $now = date('Ymd');
                $date1 = date('Ymd',strtotime($deadline));
                $date2 = date('Ymd',strtotime($target2));
                $date3 = date('Ymd',strtotime($target3));
                $date_finish = date('Ymd',strtotime($finish));

                if ($finish == '') {
                    $nilai = 'N/A';
                }else{    
                    if (($date_finish - $date3) <= ($date3 - $date2)) {$nilai = $dt['NILAI4'];}else{$nilai = $dt['NILAI5'];}   
                    if ($date_finish <= $date3) {$nilai = $dt['NILAI3'];}        
                    if ($date_finish <= $date2) {$nilai = $dt['NILAI2'];}  
                    if ($date_finish <= $date1) {$nilai = $dt['NILAI1'];}   
                }
                ?>

                <!-- Isi Tabel -->
                <tr>
                    <td><?php echo $nmr; ?></td>
                    <td hidden><?php echo $id_kary; ?></td>
                    <td><?php echo $no_project; ?></td>
                    <td><?php echo $tgl; ?></td>
                    <td><?php echo $nama_project; ?></td>
                    <td><?php echo $tugas; ?></td>
                    <td><?php echo $deadline; ?></td>
                    <td><?php echo $finish; ?></td>
                    <td><?php echo $nilai; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>