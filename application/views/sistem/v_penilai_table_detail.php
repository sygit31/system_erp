<div class="data-table2">
	<table id="data-detail" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th>No.</th>
				<th>NIK</th>
				<th>Nama</th>
				<th>Bagian</th>
				<th>Jabatan</th>
				<th>Atasan Langsung</th>
				<th>Manajemen</th>
				<th>Kolega</th>
				<th>Kolega 1</th>
				<th>Kolega 2</th>
				<th>HR</th>
				<th>IS</th>
				<th>K3</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($karyawan->result_array() as $dt):
				$urut++;
				$nik=$dt['NIK'];
				$nama=$dt['NAMA'];
				$bagian=$dt['BAGIAN'];
				$jabatan=$dt['JABATAN'];
				$al=$dt['AL'];
				$mj=$dt['MJ'];
				$kl=$dt['KL'];
				$kl1=$dt['KL1'];
				$kl2=$dt['KL2'];
				$hr=$dt['HR'];
				$nis=$dt['NIS'];
				$k3=$dt['K3'];
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nik; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $bagian; ?></td>
					<td><?php echo $jabatan; ?></td>
					<td><?php echo $al; ?></td>
					<td><?php echo $mj; ?></td>
					<td><?php echo $kl; ?></td>
					<td><?php echo $kl1; ?></td>
					<td><?php echo $kl2; ?></td>
					<td><?php echo $hr; ?></td>
					<td><?php echo $nis; ?></td>
					<td><?php echo $k3; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>