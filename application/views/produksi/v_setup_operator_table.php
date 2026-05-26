<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th hidden>ID Prod Proses</th>
			<th width="5%">No.</th>
			<th width="15%">Desain</th>
			<th width="20%">Proses</th>
			<th width="25%">Nama Mesin</th>
			<th width="10%">Shift</th>
			<th width="25%">Nama Operator</th>
			<th>Edit</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id = $dt['ID'];
			$desain = $dt['DESAIN'];
			$proses = $dt['PROSES'];
			$mesin = $dt['NAMA_MESIN'];
			$shift = $dt['SHIFT'];
			$operator = $dt['OPERATOR'];
			$qty = $dt['QTY_PROSES'] + $dt['QTY_DOWNTIME'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td><?php echo $proses; ?></td>
				<td><?php echo $mesin; ?></td>
				<td align="center"><?php echo $shift; ?></td>
				<td><?php echo $operator; ?></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" title="Edit Data" onclick="edit(this)" <?php if ($qty != 0) {echo "hidden";} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>