<div class="data-table-akun">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead>
			<tr align="center">
				<th width="10%">No.</th>
				<th width="20%">Nama Karyawan</th>
				<th width="20%">Bagian</th>
				<th width="30%">Jabatan</th>
				<td></td>
				<td hidden></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($akun->result_array() as $dt):
				$urut++;
				$nama=$dt['NAMA'];
				$bagian=$dt['BAGIAN'];
				$jabatan=$dt['JABATAN'];
				$id_akun=$dt['ID_AKUN'];
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $nama; ?></td>
					<td><?php echo $bagian; ?></td>
					<td><?php echo $jabatan; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="akses(this)"><i class="fa ion-gear-b fa-lg m-2"></i><b>Hak Akses</b></button></td>
					<td hidden><?php echo $id_akun; ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>