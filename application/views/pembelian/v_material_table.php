<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden></th>
			<th>No.</th>
			<th>No. Material</th>
			<th>No. Rek Jurnal</th>
			<th>Nama Material</th>
			<th>Spesifikasi</th>
			<th <?php if ($approved == '1') {echo "hidden";} ?>>User</th>
			<th>Supplier</th>
			<th>Satuan</th>
			<th>Min. Stok</th>
			<th>Kategori</th>
			<th>Jenis</th>
			<th>Tahun</th>
			<th>QC Test</th>
			<th>Deskripsi</th>
			<th hidden>Kode SAKTI</th>
			<th>Nama Barang SAKTI</th>
			<th <?php if ($approved == '1' && $status == '1') {echo "hidden";} ?>>Edit</th>
			<th <?php if ($approved == '1') {echo "hidden";} ?>>Hapus</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($material->result_array() as $dt):
			$urut++;
			$qty = $dt['QTY'];
			$id = $dt['ID'];
			$no_rekjurnal = trim($dt['NO_REKJURNAL'] . ' ' . $dt['REKENING']);
			$kode = $dt['KODE'];
			$nama = $dt['NAMA'];
			$user = $dt['PENGGUNA'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$satuan = $dt['SATUAN'];
			$min_stok = $dt['MIN_STOK'];
			$kategori = $dt['KATEGORI'];
			$jenis = $dt['JENIS'];
			$tahun = $dt['TAHUN'];
			$qc_test = $dt['QC_TEST'];
			$deskripsi = $dt['DESKRIPSI'];
			$kode_sakti = $dt['KODE_SAKTI'];
			$nama_barang_sakti = $dt['NAMA_BARANG_SAKTI'];
			$dt['SUPPLIER'] == null ? $supplier = '' : $supplier = $dt['SUPPLIER'];
			if ($qc_test != '0') {$qc_test = 'Ya';}else{$qc_test = 'Tidak';}
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $kode; ?></td>
				<td><?php echo $no_rekjurnal; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td <?php if ($approved == '1') {echo "hidden";} ?>><?php echo $user; ?></td>
				<td><?php echo $supplier; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td align="center"><?php echo $min_stok; ?></td>
				<td><?php echo $kategori; ?></td>
				<td><?php echo $jenis; ?></td>
				<td align="center"><?php echo $tahun; ?></td>
				<td align="center"><?php echo $qc_test; ?></td>
				<td><?php echo $deskripsi; ?></td>
				<td hidden><?php echo $kode_sakti; ?></td>
				<td><?php echo $nama_barang_sakti; ?></td>
				<td <?php if ($approved == '1' && $status == '1') {echo "hidden";} ?>><button type="button" class="btn btn-block btn-success btn-sm" title="Edit Data" data-toggle="modal" data-target="#modal-jurnal" onclick="approve(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td <?php if ($approved == '1') {echo "hidden";} ?>><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="hapus(this)"><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>