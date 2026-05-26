<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>ID Proses</th>
				<th width="10%">No.</th>
				<th width="10%">Kode Produk</th>
				<th width="10%">Desain</th>
				<th width="30%">Nama Produk</th>
				<th width="20%">Deskripsi</th>
				<th width="10%">Ukuran</th>
				<th width="10%">Kode Flow Proses</th>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($proses->result_array() as $dt):
				$id=$dt['ID'];
				$urut++;
				$kode=$dt['KODE'];
				$desain=$dt['DESAIN'];
				$nama=$dt['NAMA'];
				$deskripsi=$dt['DESKRIPSI'];
				$ukuran=$dt['UKURAN'];
				$kode=$dt['KODE_STATION_FLOW'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $kode; ?></td>
					<td align="center"><?php echo $desain; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $deskripsi; ?></td>
					<td><?php echo $ukuran; ?></td>
					<td align="center"><?php echo $kode; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="preview(this)">Preview</button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>