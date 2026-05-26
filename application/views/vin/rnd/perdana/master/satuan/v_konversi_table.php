<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="70%">
		<thead>
			<tr align="center">
				<th hidden>ID Satuan</th>
				<th width="10%">No.</th>
				<th width="50%">NAMA KONVERSI</th>
				<th width="50%">SATUAN AWAL</th>
				<th width="50%">SATUAN AKHIR</th>
				<th width="50%">NILAI</th>
				<th hidden>ID Satuan Akhir</th>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($konversi as $dt):
				$id=$dt->ID;
				$id_satuan_akhir=$dt->ID_SATUAN_AKHIR;
				$urut++;
				$nama=$dt->NAMA;
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $dt->NAMA_SATUAN_AWAL; ?></td>
					<td><?php echo $dt->NAMA_SATUAN_AKHIR; ?></td>
					<td><?php echo $dt->KONVERSI; ?></td>
					<td hidden><?php echo $id_satuan_akhir; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="edit(this)" title="Edit Data"> <i class="fa ion-edit m-2"></i></button></td>		
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
