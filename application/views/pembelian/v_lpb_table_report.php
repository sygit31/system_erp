<table id="data_detail" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th>No.</th>
            <th>Supplier</th>
            <th>Tanggal LPB</th>
            <th>No. SP</th>
            <th>No. LPB</th>
            <th>Kategori</th>
            <th>Jenis Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Satuan</th>
            <th>Qty Datang</th>
            <th>Harga</th>
            <th>Total</th>
            <th>Nomor Urut Sakti</th>
            <th>Cetak</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $urut = 0;
        $t_total = 0;
        foreach ($filter_detail->result_array() as $dt) :
            $urut = $urut + 1;
            $supplier = $dt['SUPPLIER'];
            $tgl = date('d-M-Y', strtotime($dt['TGL']));
            $nmr_sp = $dt['NMR_SP'];
            $nmr_lpb = $dt['NMR_LPB'];
            $kategori = $dt['KATEGORI'];
            $jenis = $dt['JENIS'];
            $barang = $dt['BARANG'];
            $spesifikasi = $dt['SPESIFIKASI'];
            $satuan = $dt['SATUAN'];
            $qty_datang = str_replace(',', '.', $dt['QTY_DATANG']);
            $harga = str_replace(',', '.', $dt['HARGA']);
            $total = str_replace(',', '.', $dt['QTY_DATANG']) * str_replace(',', '.', $dt['HARGA']);
            $t_total = $t_total + $total;
            $urut_sakti = $dt['LPB_URUT'];
            $verifikator = $dt['VERIFIKATOR'];
            ?>
            <tr>
                <td align="center"><?php echo $urut; ?></td>
                <td><?php echo $supplier; ?></td>
                <td align="center"><?php echo $tgl; ?></td>
                <td><?php echo $nmr_sp; ?></td>
                <td><?php echo $nmr_lpb; ?></td>
                <td><?php echo $kategori; ?></td>
                <td><?php echo $jenis; ?></td>
                <td><?php echo $barang; ?></td>
                <td><?php echo $spesifikasi; ?></td>
                <td align="center"><?php echo $satuan; ?></td>
                <td align="right"><?php echo number_format($qty_datang, 2); ?></td>
                <td align="right"><?php echo number_format($harga, 2); ?></td>
                <td align="right"><?php echo number_format($total, 2); ?></td>
                <td align="center"><?php echo $urut_sakti; ?><button type="button" class="btn btn-block btn-warning btn-sm" title="Upload Sakti" onclick="upload_sakti(this)" <?php if ($urut_sakti != '') {echo 'hidden';} ?>><i class="fa fa-upload"></i></button></td>
                <td><button type="button" class="btn btn-block btn-success btn-sm" title="Print Data" onclick="cetak(this)" <?php if ($urut_sakti == '') {echo 'hidden';} ?>><i class="fa fa-print"></i></button></td>
                <td><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php if ($verifikator != '') {echo 'hidden';} ?>><i class="fa fa-trash"></i></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    <tfoot class="text-bold">
        <td colspan="11" align="center">Total</td>
        <td></td>
        <td align="right"><?php echo number_format($t_total, 2); ?></td>
        <td colspan="3"></td>
    </tfoot>
</table>
