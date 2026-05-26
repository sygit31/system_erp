<table id="data_rekap" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th hidden>ID LPB</th>
            <th>No.</th>
            <th>Nama Supplier</th>
            <th>Nomor LPB</th>
            <th>Tgl. LPB</th>
            <th>Tgl. Tempo</th>
            <th>Hutang</th>
            <th>Nilai DPP</th>
            <th>Nilai PPN</th>
            <th>Nilai PPH</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $urut = 0;
        $total = 0;
        $dpp = 0;
        $ppn = 0;
        $pph = 0;
        foreach ($filter_rekap->result_array() as $dt) :
            $urut = $urut + 1;
            $id_lpb = $dt['ID_LPB'];
            $supplier = $dt['SUPPLIER'];
            $nomer_lpb = $dt['NOMER_LPB'];
            $tgl_lpb = $dt['TGL_LPB'];
            $tgl_tempo = $dt['TGL_TEMPO'];

            $nilai_dpp = str_replace(',', '.', $dt['NILAI_DPP']);
            $nilai_ppn = str_replace(',', '.', $dt['NILAI_PPN']);
            $nilai_ppn = $nilai_dpp * $nilai_ppn/100;
            $hutang = $nilai_dpp + $nilai_ppn;
            $nilai_pph = 0;

            $dpp = $dpp + $nilai_dpp;
            $ppn = $ppn + $nilai_ppn;
            $total = $total + $hutang;
            $pph = $pph + $nilai_pph;
            ?>
            <tr>
                <td hidden><?php echo $id_lpb; ?></td>
                <td align="center"><?php echo $urut; ?></td>
                <td><?php echo $supplier; ?></td>
                <td><?php echo $nomer_lpb; ?></td>
                <td align="center"><?php echo $tgl_lpb; ?></td>
                <td align="center"><?php echo $tgl_tempo; ?></td>
                <td align="right"><?php echo number_format($hutang,2); ?></td>
                <td align="right"><?php echo number_format($nilai_dpp,2); ?></td>
                <td align="right"><?php echo number_format($nilai_ppn,2); ?></td>
                <td align="right"><?php echo number_format($nilai_pph,2); ?></td>
                <td align="center"><button type="button" class="btn btn-block btn-warning btn-sm rekap" title="Detail Data" onclick="detail_sp(this)"><i class="fa fa-book"></i></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="text-bold">
        <td colspan="5" align="center">Total</td>
        <td align="right"><?php echo number_format($total,2); ?></td>
        <td align="right"><?php echo number_format($dpp,2); ?></td>
        <td align="right"><?php echo number_format($ppn,2); ?></td>
        <td align="right"><?php echo number_format($pph,2); ?></td>
        <td></td>
    </tfoot>
</table>