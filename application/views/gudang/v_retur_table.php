<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Surat Pengantar</th>
			<th>Supplier</th>
			<th>Nomor PO</th>
			<th>Nama Barang</th>
			<th>Spesifikasi</th>
			<th>Satuan</th>
			<th>Kode</th>
			<th>Qty Retur</th>
			<th>Penerima</th>
			<th>No. Kendaraan</th>
			<th>Print</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt):
			$id = $dt['ID'];
			$urut++;
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$nmr = $dt['NMR'];
			$supplier = $dt['SUPPLIER'];
			$po = $dt['PO'];
			$nama = $dt['NAMA'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$satuan = $dt['SATUAN'];
			$kode = $dt['KODE'];
			$qty = number_format($dt['QTY']);
			$penerima = $dt['PENERIMA'];
			$no_kend = $dt['NO_KEND'];
			$hidden = date('ymd', strtotime('+14 days', strtotime($dt['TGL']))) < date('ymd') ? 'hidden' : '';
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $supplier; ?></td>
				<td><?php echo $po; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="center"><?php echo $kode; ?></td>
				<td align="right"><?php echo $qty; ?></td>
				<td><?php echo $penerima; ?></td>
				<td><?php echo $no_kend; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)" <?php echo $hidden; ?>><i class="fa fa-check-square-o"></i></button></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php echo $hidden; ?>><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>