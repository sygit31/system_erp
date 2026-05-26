<table id="tabel_operator" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Proses</th>
			<th>Nama Mesin</th>
			<th>Shift</th>
			<th>Nama Operator</th>
			<th></th>
			<th hidden></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($data_operator->result_array() as $dt):
			$urut++;
			$proses = $dt['PROSES'];
			$mesin = $dt['NAMA_MESIN'];
			$shift = $dt['SHIFT'];
			$operator = $dt['NAMA'];
			$id = $dt['ID_PROD_PROSES_DETAIL'];
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $proses; ?></td>
				<td><?php echo $mesin; ?></td>
				<td align="center"><?php echo $shift; ?></td>
				<td><?php echo $operator; ?></td>
				<td><button type="button" class="btn btn-block btn-danger" title="Hapus Operator" onclick="hapus_operator(this)" style="margin-top: 0;"><i class="fa ion-trash-a"></i></button></td>
				<td hidden><?php echo $id; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>