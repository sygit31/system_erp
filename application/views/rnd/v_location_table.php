<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID Location</th>
			<th width="10%">No.</th>
			<th width="25%">Lokasi</th>
			<th width="25%">Nama PIC</th>
			<th width="20%">Telp/ HP</th>
			<th width="20%">Keterangan</th>
			<th>Edit</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($location->result_array() as $dt):
			$id=$dt['ID'];
			$urut++;
			$lokasi=$dt['LOCATION'];
			$pic=$dt['PIC'];
			$telp=$dt['TELP'];
			$note=$dt['NOTE'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $lokasi; ?></td>
				<td><?php echo $pic; ?></td>
				<td><?php echo $telp; ?></td>
				<td><?php echo $note; ?></td>
				<td><button type="button" style="width: 50px;" class="btn btn-block btn-warning btn-sm" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>