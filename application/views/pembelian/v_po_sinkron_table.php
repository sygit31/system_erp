<div class="data-table">
	<table id="data-table2" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th>No.</th>
				<th>No. PO</th>
				<th>Nama Barang</th>
				<th>Qty</th>
				<th>Satuan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($update->result_array() as $dt):
				$urut = $urut+1;
				$nomer_spp = $dt['NOMER_SPP'];
				$kode_barang = $dt['KODE_BARANG'];
				$nama_barang = $dt['NAMA_BARANG'];
				$satuan = $dt['SATUAN'];
				$qty = number_format($dt['QTY']);
			?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nomer_spp; ?></td>
					<td><?php echo $nama_barang; ?></td>
					<td><?php echo $satuan; ?></td>
					<td><?php echo $qty; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>