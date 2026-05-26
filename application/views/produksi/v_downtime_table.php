<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Tanggal Produksi</th>
			<th>Nomor KK</th>
			<th>Nomor PP</th>
			<th>Proses</th>
			<th>Nama Mesin</th>
			<th>Shift</th>
			<th>Operator</th>
			<th>Jenis Downtime</th>
			<th>Durasi (Menit)</th>
			<th>Mulai</th>
			<th>Selesai</th>
			<th>Keterangan</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($downtime->result_array() as $dt):
			$urut++;
			$id = $dt['ID'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$kk = $dt['KK'] == '' ? '-' : $dt['KK'] . ' (' . $dt['SERI'] . ')';
			$pp = $dt['PP'] == '' ? '-' : $dt['PP'];
			$proses = $dt['PROSES'];
			$nama_mesin = $dt['NAMA_MESIN'];
			$shift = $dt['SHIFT'];
			$operator = substr(ucwords(strtolower($dt['OPERATOR'])), 0,  strlen($dt['OPERATOR'])-2);
			$jenis = $dt['JENIS'];
			$mulai = $dt['MULAI'];
			$selesai = $dt['SELESAI'];
			$keterangan = $dt['KETERANGAN'];

			// Hitung Durasi				
			$start = strtotime($dt['MULAI']);
			$end = strtotime($dt['SELESAI']);
			if ($end < $start) {$end = strtotime($dt['SELESAI'] . '+1 days');}
			$durasi = ($end - $start)/60;
			// End Hitung Durasi

			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $kk; ?></td>
				<td><?php echo $pp; ?></td>
				<td><?php echo $proses; ?></td>
				<td><?php echo $nama_mesin; ?></td>
				<td align="center"><?php echo $shift; ?></td>
				<td><?php echo $operator; ?></td>
				<td><?php echo $jenis; ?></td>
				<td align="center"><?php echo $durasi; ?></td>
				<td align="center"><?php echo $mulai; ?></td>
				<td align="center"><?php echo $selesai; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" name="<?php echo $id; ?>" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" name="<?php echo $id; ?>" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
