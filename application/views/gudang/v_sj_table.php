<table id="data-table" class="table table-bordered table-striped" width="120%">
    <thead>
        <tr align="center">
            <th hidden>ID SP Detail</th>
            <th>No.</th>
            <th>Supplier</th>
            <th>Tanggal</th>
			<th>No. SIP</th>
            <th>No. Surat Pengantar</th>
            <th>No. LPB</th>
            <th>Kategori</th>
            <th>Jenis Barang</th>
            <th>Nama Barang</th>
            <th>Spesifikasi</th>
            <th>Satuan</th>
            <th>Qty Datang</th>
            <th hidden>Harga</th>
            <th hidden>Total</th>
            <th>No. PO</th>
            <th>Qty PO</th>
            <th>Input by</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $urut = 0;
        foreach ($data->result_array() as $dt) :
            $id_detail_sp = $dt['ID_DETAIL_SP'];
            $urut = $urut + 1;
            $supplier = $dt['SUPPLIER'];
            $tgl = date('d-M-Y', strtotime($dt['TGL']));
            $nmr = $dt['NMR'];
			$no_sip = $dt['NO_SIP'];
            $no_lpb = $dt['NO_LPB'];
            $kategori = $dt['KATEGORI'];
            $jenis = $dt['JENIS'];
            $nama_barang = $dt['NAMA_BARANG'];
            $spesifikasi = $dt['SPESIFIKASI'];
            $satuan = $dt['SATUAN'];
            $qty_sp = number_format(str_replace(',', '.', $dt['QTY_SP']), 2);
            $nomer = $dt['NOMER'];
            $qty_data = $dt['QTY_DATA'];
            $kary = $dt['KARY'];
            $qty_po = number_format(str_replace(',', '.', $dt['QTY_PO']), 2);
            $harga = number_format(str_replace(',', '.', $dt['HARGA']), 2);
            $total = number_format(str_replace(',', '.', $dt['QTY_SP']) * str_replace(',', '.', $dt['HARGA']), 2);
            ?>
            <tr>
                <td hidden><?php echo $id_detail_sp; ?></td>
                <td align="center"><?php echo $urut; ?></td>
                <td><?php echo $supplier; ?></td>
                <td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $no_sip; ?></td>
                <td><?php echo $nmr; ?></td>
                <td><?php echo $no_lpb; ?></td>
                <td><?php echo $kategori; ?></td>
                <td><?php echo $jenis; ?></td>
                <td><?php echo $nama_barang; ?></td>
                <td><?php echo $spesifikasi; ?></td>
                <td align="center"><?php echo $satuan; ?></td>
                <td align="right"><?php echo $qty_sp; ?></td>
                <td hidden align="right"><?php echo $harga; ?></td>
                <td hidden align="right"><?php echo $total; ?></td>
                <td><?php echo $nomer; ?></td>
                <td align="right"><?php echo $qty_po; ?></td>
                <td><?php echo $kary; ?></td>
                <td><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)" <?php if ($qty_data != 0) {echo "hidden";} ?>><b><i class="fa fa-check-square-o"></i></b></button></td>
                <td><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php if ($qty_data != 0) {echo "hidden";} ?>><b><i class="fa fa-trash"></i></b></button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
