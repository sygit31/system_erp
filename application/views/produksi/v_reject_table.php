<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th>No.</th>
			<th>Nomor</th>
			<th>Tanggal</th>
			<th>KK</th>
			<th>Nama Material</th>
			<th>Spesifikasi</th>
			<th>Kode</th>
			<th>Qty Terima</th>
			<th>Qty Retur</th>
			<th>Satuan</th>
			<th <?php if($akses=='2'){echo 'hidden';} ?>>Print</th>
			<th <?php if($akses=='2'){echo 'hidden';} ?>>Edit</th>
			<th <?php if($akses=='2'){echo 'hidden';} ?>>Hapus</th>
			<th <?php if($akses=='1'){echo 'hidden';} ?>>Approve</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt):
			$id=$dt['ID'];
			$urut++;
			$nmr = $dt['NMR'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$kk = $dt['KK'];
			$nama = $dt['NAMA'];
			$spesifikasi = $dt['SPESIFIKASI'];
			$kode_roll = $dt['KODE_ROLL'];
			$qty_terima = number_format($dt['QTY_TERIMA']);
			$reject = number_format($dt['REJECT']);
			$satuan = $dt['SATUAN'];
			$status = $dt['STATUS'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $nmr; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $kk; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td align="center"><?php echo $kode_roll; ?></td>
				<td align="right"><?php echo $qty_terima; ?></td>
				<td align="right"><?php echo $reject; ?></td>
				<td align="center"><?php echo $satuan; ?></td>
				<td <?php if($akses=='2'){echo 'hidden';} ?>><button type="button" class="btn btn-block btn-success btn-sm" title="Cetak Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td <?php if($akses=='2'){echo 'hidden';} ?>><button type="button" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)" <?php if($status=='2'){echo "hidden";} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td <?php if($akses=='2'){echo 'hidden';} ?>><button type="button" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="batal(this)" <?php if($status=='2'){echo "hidden";} ?>><i class="fa ion-trash-a"></i></button></td>
				<td <?php if($akses=='1'){echo 'hidden';} ?>><button type="button" class="btn btn-block btn-success btn-sm" title="Approve Data" onclick="approve(this)" <?php if($status=='2'){echo "hidden";} ?>><i class="fa fa-send-o"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>