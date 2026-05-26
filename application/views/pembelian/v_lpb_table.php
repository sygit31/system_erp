<table id="data-table" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th hidden>ID SP</th>
            <th>Pilih</th>
            <th>No.</th>
            <th>Divisi</th>
            <th>Supplier</th>
            <th>Tanggal SP</th>
            <th>No. Surat Pengantar</th>
            <th>No. Kendaraan</th>
            <th>No. PO</th>
            <th>Nilai DPP</th>
            <th>Nilai PPN</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $t_dpp = 0;
        $t_ppn = 0;
        $urut = 0;
        foreach ($filter->result_array() as $dt) :
            $urut = $urut + 1;
            $id_sp = $dt['ID_SP'];
            $supplier = $dt['SUPPLIER'];
            $tgl = date('d-M-Y', strtotime($dt['TGL_SP']));
            $nmr = $dt['NMR'];
            $unit = $dt['KD_UNIT'] . ' - ' . $dt['UNIT'];
            $no_po = $dt['NO_PO'];
            $kend = $dt['KEND'];
            $dpp = str_replace(',', '.', $dt['DPP']);
            $kode_jenis = $dt['KODE_JENIS'];
            $ppn = (10 / 100) * str_replace(',', '.', $dt['DPP']);
            if ($kode_jenis == '1') {$ppn = 0;}

            $t_dpp = $t_dpp + $dpp;
            $t_ppn = $t_ppn + $ppn;
            ?>
            <tr>
                <td hidden><?php echo $id_sp; ?></td>
                <td align="center"><input type="checkbox" name="lpb" style="cursor: pointer;" onclick="get_nomer_lpb()"></td>
                <td align="center"><?php echo $urut; ?></td>
                <td><?php echo $unit; ?></td>
                <td><?php echo $supplier; ?></td>
                <td align="center"><?php echo $tgl; ?></td>
                <td><?php echo $nmr; ?></td>
                <td><?php echo $kend; ?></td>
                <td><?php echo $no_po; ?></td>
                <td align="right"><?php echo number_format($dpp, 2); ?></td>
                <td align="right"><?php echo number_format($ppn, 2); ?></td>
                <td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" title="Detail Data" onclick="detail_sp(this)"><i class="fa fa-book"></i></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="text-bold">
        <td></td>
        <td colspan="7" align="center">Total</td>
        <td align="right"><?php echo number_format($t_dpp,2); ?></td>
        <td align="right"><?php echo number_format($t_ppn,2); ?></td>
        <td></td>
    </tfoot>
</table>