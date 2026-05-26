<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped">
		<thead>
			<tr align="center">
				<th hidden>Id</th>
				<th hidden>Id</th>
				<th width="10%">No.</th>
				<th width="20%">Judul Modul</th>
				<th width="20%">Kode Menu</th>
				<th width="40%">Nama Menu</th>
				<th width="10%">Level</th>
				<td></td>
				<td></td>
			</tr>
		</thead>

		<tbody>
			<?php
			$urut = 0;
			foreach ($menu->result_array() as $dt):
				$id=$dt['ID_MENU'];
				$id_detail=$dt['ID_DETAIL'];
				$urut++;
				$judul_menu=$dt['JUDUL_MENU'];
				$kode_menu=$dt['KODE_MENU'];
				$nama_menu=$dt['NAMA_MENU'];
				$level_menu=$dt['LEVEL_MENU'];
				if ($level_menu == '1') {
					$position = '1%';
				}elseif ($level_menu == '2') {
					$position = '6%';
				}else{
					$position = '11%';
				}
				?>
				<tr>
					<td hidden><?php echo $id; ?></td>
					<td hidden><?php echo $id_detail; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $judul_menu; ?></td>
					<td><?php echo $kode_menu; ?></td>
					<td style="padding-left: <?php echo $position; ?>"><?php echo $nama_menu; ?></td>
					<td align="center"><?php echo $level_menu; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="edit(this)" title="Edit Data"><i class="fa ion-edit m-2"></i></button></td>
					<td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="hapus(this)" title="Hapus Data"><i class="fa ion-trash-a m-2"></i></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>