<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped">
		<thead>
			<tr align="center">
				<th width="10%">No.</th>
				<th width="20%">Nama Karyawan</th>
				<th width="20%">Bagian</th>
				<th width="30%">Jabatan</th>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($akses->result_array() as $dt):
				$urut++;
				$nama=$dt['NAMA'];
				$bagian=$dt['BAGIAN'];
				$jabatan=$dt['JABATAN'];
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $bagian; ?></td>
					<td><?php echo $jabatan; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>