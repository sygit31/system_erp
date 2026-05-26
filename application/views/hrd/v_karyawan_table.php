<table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 12px;">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th>No.</th>
			<th>NIK</th>
			<th>Nama</th>
			<th>Bagian</th>
			<th>Jabatan</th>
			<th>Kode Status</th>
			<th>Unit</th>
			<th>Jenis Kelamin</th>
			<th hidden>Status Premi</th>
			<th>Tgl Masuk</th>
			<th>Nick Name</th>
			<th>+Jabatan</th>
			<th>Edit</th>
			<th>Keluar</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$id = $dt['ID_KARYAWAN'];
			$nik = $dt['NIK'];
			$nama = strtoupper($dt['NAMA']);
			$bagian = $dt['BAGIAN'];
			$jabatan = strtoupper($dt['JABATAN']);
			$status = $dt['KD_STATUS'];
			if ($status == 'BL') {$status = 'Bulanan';}
			if ($status == 'KT') {$status = 'Kontrak';}
			if ($status == 'OS') {$status = 'OS';}
			$unit = $dt['UNIT'];
			$jkel = $dt['JKEL'];
			$s_premi = $dt['STATUS_PREMI'];
			$tgl_masuk = date('d-M-Y', strtotime($dt['TGL_MASUK']));
			$nick_name = $dt['NICK_NAME'];
			if ($jkel == 'P') {$jkel = 'Pria';}else{$jkel = 'Wanita';}
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $nik; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $bagian; ?></td>
				<td><?php echo $jabatan; ?></td>
				<td><?php echo strtoupper($status); ?></td>
				<td><?php echo $unit; ?></td>
				<td><?php echo strtoupper($jkel); ?></td>
				<td hidden><?php echo $s_premi; ?></td>
				<td align="center"><?php echo $tgl_masuk; ?></td>
				<td><?php echo $nick_name; ?></td>
				<td align="center"><button type="button" onclick="rangkap_jabatan(this);" style="width: 50px;" class="btn btn-success btn-sm" name="<?php echo $id . '@@' . $dt['KD_UNIT']; ?>" data-toggle="modal" data-target="#mdl_jabatan" title="Multi Jabatan" data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i></button></td>
				<td align="center"><button type="button" style="width: 50px;" class="btn btn-warning btn-sm" name="<?php echo $id; ?>" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" style="width: 50px;" class="btn btn-danger btn-sm" name="<?php echo $id; ?>" onclick="keluar(this)" data-toggle="modal" data-target="#modal_keluar"><i class="fa fa-power-off"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>