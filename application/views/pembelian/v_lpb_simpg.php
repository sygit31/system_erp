<table id="data_simpg" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th>No.</th>
            <th>Nama Supplier</th>
            <th>Nomor LPB</th>
            <th>TGL. LPB</th>
            <th>TGL. Tempo</th>
            <th>Hutang</th>
            <th>Nilai DPP</th>
            <th>Nilai PPN</th>
            <th>Nilai PPH</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $urut = 0;
        $total = 0;
        $dpp = 0;
        $ppn = 0;
        $pph = 0;
        foreach ($lpb_simpg->result_array() as $dt) :
            $urut = $urut + 1;
            $supplier = $dt['SUPPLIER'];
            $nomer_lpb = $dt['NOMER_LPB'];
            $tgl_lpb = $dt['TGL_LPB'];
            $tgl_tempo = $dt['TGL_TEMPO'];

            $hutang = str_replace(',', '.', $dt['HUTANG']);
            $nilai_dpp = str_replace(',', '.', $dt['NILAI_DPP']);
            $nilai_ppn = str_replace(',', '.', $dt['NILAI_PPN']);
            $nilai_pph = str_replace(',', '.', $dt['NILAI_PPH']);

            $dpp = $dpp + $nilai_dpp;
            $ppn = $ppn + $nilai_ppn;
            $total = $total + $hutang;
            $pph = $pph + $nilai_pph;
            ?>
            <tr>
                <td align="center"><?php echo $urut; ?></td>
                <td><?php echo $supplier; ?></td>
                <td><?php echo $nomer_lpb; ?></td>
                <td align="center"><?php echo $tgl_lpb; ?></td>
                <td align="center"><?php echo $tgl_tempo; ?></td>
                <td align="right"><?php echo number_format($hutang,2); ?></td>
                <td align="right"><?php echo number_format($nilai_dpp,2); ?></td>
                <td align="right"><?php echo number_format($nilai_ppn,2); ?></td>
                <td align="right"><?php echo number_format($nilai_pph,2); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="text-bold">
        <td colspan="5" align="center">Total</td>
        <td align="right"><?php echo number_format($total,2); ?></td>
        <td align="right"><?php echo number_format($dpp,2); ?></td>
        <td align="right"><?php echo number_format($ppn,2); ?></td>
        <td align="right"><?php echo number_format($pph,2); ?></td>
    </tfoot>
</table>