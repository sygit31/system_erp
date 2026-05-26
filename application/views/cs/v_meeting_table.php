<table id="data-table" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr style="text-align: center; font-weight: bold;">
            <td hidden></td>
            <td>No.</td>
            <td>Nomor</td>
            <td>Hari</td>
            <td>Tanggal</td>
            <td>Waktu</td>
            <td>Ruang</td>
            <td>Jumlah Personil</td>
            <td>Agenda Meeting</td>
            <td>Level</td>
            <td>Nama PIC</td>
            <td>Bagian</td>
            <td>Status</td>
            <td>Fasilitas</td>
            <td <?php if ($status_menu == '1') {echo 'hidden';} ?>>Edit</td>
            <td <?php if ($status_menu == '1') {echo 'hidden';} ?>>Batal</td>
            <td <?php if ($status_menu == '1') {echo 'hidden';} ?>>Close</td>
        </tr>
    </thead>
    <tbody>
        <?php
        $urut = 0;
        foreach ($meeting->result_array() as $dt) :
            $urut = $urut + 1;
            $id = $dt['ID'];
            $nmr = $dt['NMR'];
            $hari = $dt['HARI'];
            $tgl = date('d-M-Y', strtotime($dt['TGL']));
            $jam = $dt['JAM'];
            $ruang = $dt['RUANG'];
            $qty_person = $dt['QTY_PERSON'];
            $agenda = $dt['AGENDA'];
            $lev = $dt['LEV'];
            $nama = $dt['NAMA'];
            $bagian = $dt['BAGIAN'];
            $keterangan = $dt['NOTE'];
            if ($dt['STATUS'] == '1') {
                $status = 'Open';
                $warna = '#52FA95';
            } else if ($dt['STATUS'] == '0') {
                $status = 'Batal';
                $warna = '#F3C923';
            } else {
                $status = 'Close';
                $warna = '#FEC8C8';
            }

            ?>
            <tr style="background-color: <?php echo $warna; ?>;">
                <td hidden><?php echo $id; ?></td>
                <td align="center"><?php echo $urut; ?></td>
                <td align="center"><?php echo $nmr; ?></td>
                <td align="center"><?php echo $hari; ?></td>
                <td align="center"><?php echo $tgl; ?></td>
                <td align="center"><?php echo $jam; ?></td>
                <td><?php echo $ruang; ?></td>
                <td align="center"><?php echo $qty_person; ?></td>
                <td><?php echo $agenda; ?></td>
                <td align="center"><?php echo $lev; ?></td>
                <td><?php echo $nama; ?></td>
                <td align="center"><?php echo $bagian; ?></td>
                <td align="center"><b><?php echo $status; ?></b></td>
                <td align="center"><?php echo $keterangan; ?></td>
                <td <?php if ($status_menu == '1') {echo 'hidden';} ?>><button type="button" class="btn btn-block btn-info btn-sm" title="Edit Data" onclick="edit(this)" <?php if ($status != 'Open') {echo 'hidden';} ?>><b><i class="fa fa-check-square-o"></i></button></td>
                    <td <?php if ($status_menu == '1') {echo 'hidden';} ?>><button type="button" class="btn btn-block btn-danger btn-sm" title="Batal Data" onclick="batal(this)" <?php if ($status != 'Open') {echo 'hidden';} ?>><b><i class="fa ion-trash-a"></i></button></td>
                        <td <?php if ($status_menu == '1') {echo 'hidden';} ?>><button type="button" class="btn btn-block btn-success btn-sm" title="Close Data" onclick="selesai(this)" <?php if ($status != 'Open') {echo 'hidden';} ?>><b><i class="fa fa-save"></i></button></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>