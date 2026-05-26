<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="20%">
		<thead>
			<tr align="center">
				<th hidden>ID Station</th>
				<th width="10%">No.</th>
				<th width="10%">Station</th>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($station->result_array() as $dt):
				$id=$dt['ID'];
				$urut++;
				$nama=$dt['NAMA'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="edit(this)" title="Edit Data"> <i class="fa ion-edit m-2"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>