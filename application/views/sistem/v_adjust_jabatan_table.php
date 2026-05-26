<table id="data-table-jabatan" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>Id</th>
			<th width="5%">No.</th>
			<th width="15%">Tanggal Berlaku</th>
			<th width="25%">Nama Karyawan</th>
			<th width="15%">Bagian</th>
			<th width="10%">Jabatan</th>
			<th width="10%">Nilai</th>
			<th width="20%">Keterangan</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$id = $dt['ID'];
			$urut++;
			$tgl = date('d-M-Y',strtotime($dt['TGL']));
			$nama = strtoupper($dt['NAMA']);
			$bagian = $dt['BAGIAN'];
			$jabatan = $dt['JABATAN'];
			$nilai = number_format($dt['NILAI'],3);
			$keterangan = $dt['KETERANGAN'];
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nama; ?></td>
				<td align="center"><?php echo $bagian; ?></td>
				<td align="center"><?php echo $jabatan; ?></td>
				<td align="center"><?php echo $nilai; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td align="center"><button type="button" class="btn btn-danger btn-sm" onclick="hapus(this)"><i class="fa fa-trash"></button></button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
