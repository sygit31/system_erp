<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>ID Produk</th>
				<th>No.</th>
				<th>Nama Barang</th>
				<th>Tahun</th>
				<th>No. Register</th>
				<th>Upgrade</th>
				<th>Lokasi</th>
				<th>Kondisi</th>
				<th>Keterangan</th>
				<th>Edit</th>
				<th>Hapus</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($hlreader->result_array() as $dt):
				$id = $dt['ID'];
				$urut++;
				$nama = 'Holo Reader';
				$tahun = $dt['TAHUN'];
				$no_register = $dt['NO_REGISTER'];
				$upgrade = $dt['UPGRADE'];
				$lokasi = $dt['LOCATION'];
				if ($lokasi == null) {$lokasi = 'PNP Holografi Kudus';}
				$kondisi = $dt['KONDISI'];
				if ($dt['TGL'] == null) {$tgl='';}else{$tgl = date('d-M-Y',strtotime($dt['TGL']));}
				$note = $dt['NOTE'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $tahun; ?></td>
					<td align="center"><?php echo $no_register; ?></td>
					<td align="center"><?php echo $upgrade; ?></td>
					<td><?php echo $lokasi; ?></td>
					<td align="center"><?php echo $kondisi; ?></td>
					<td><?php echo $note; ?></td>
					<td><button type="button" style="width: 50px;" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
					<td><button type="button" style="width: 50px;" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="hapus(this)" <?php if ($dt['LOCATION'] != null) {echo 'hidden';} ?>><i class="fa ion-trash-a"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>