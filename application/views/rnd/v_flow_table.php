<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th hidden>ID Flow</th>
				<th>No.</th>
				<th>Kode Flow</th>
				<th>Nama Station</th>
				<th>Urutan</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($flow->result_array() as $dt):
				$id=$dt['ID'];
				$urut++;
				$kode=$dt['KODE'];
				$nama=$dt['NAMA'];
				$urutan=$dt['URUT'];
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $kode; ?></td>
					<td><?php echo $nama; ?></td>
					<td align="center"><?php echo $urutan; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>