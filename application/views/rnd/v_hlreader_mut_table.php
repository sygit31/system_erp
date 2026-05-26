<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden>ID Mutasi</th>
			<th>No.</th>
			<th>Tanggal</th>
			<th>Jenis</th>
			<th>Nomor Dokumen</th>
			<th>Holo Reader</th>
			<th>Lokasi</th>
			<th>PIC</th>
			<th>Upgrade</th>
			<th>Kondisi</th>
			<th>Keterangan</th>
			<th>Hapus</th>
			<th hidden>ID Hlreader</th>
			<th hidden>ID Location</th>
			<th hidden>ID Hlreader New</th>
		</tr>
	</thead>

	<tbody>
		<?php
		$urut = 0;
		foreach ($mutasi->result_array() as $dt):
			$id=$dt['ID'];
			$urut++;
			$tgl=date('d-M-Y',strtotime($dt['TGL']));
			$mutasi=$dt['MUTASI'];
			$nomor=$dt['NOMOR'];
			$no_register=$dt['NO_REGISTER'];
			$no_register2=$dt['NO_REGISTER2'];
			$location=$dt['LOCATION'];
			$pic=$dt['PIC'];
			$nama=$dt['NAMA'];
			if ($location == '') {$location = '-'; $pic = $nama;}
			$upgrade=$dt['UPGRADE'];
			$kondisi=$dt['KONDISI'];
			$note=$dt['NOTE'];
			$id_location=$dt['ID_LOCATION'];
			$id_hlreader=$dt['ID_HLREADER'];
			$id_hlreader_new=$dt['ID_HLREADER_NEW'];
			$aktif=$dt['AKTIF'];
			if ($mutasi == 'Tukar') {$tukar = '  (tukar)  ';}else{$tukar = '';}
			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $mutasi; ?></td>
				<td><?php echo $nomor; ?></td>
				<td align="center"><?php echo $no_register . $tukar . $no_register2; ?></td>
				<td><?php echo $location; ?></td>
				<td><?php echo $pic; ?></td>
				<td><?php echo $upgrade; ?></td>
				<td><?php echo $kondisi; ?></td>
				<td><?php echo $note; ?></td>
				<td><button type="button" style="width: 50px;" class="btn btn-block btn-danger btn-sm" title="Hapus Data" onclick="hapus(this)" <?php if($aktif=='0' || $dt['QTY_DATA']>0){echo "hidden";} ?>><i class="fa ion-trash-a"></i></button></td>
				<td hidden><?php echo $id_hlreader; ?></td>
				<td hidden><?php echo $id_location; ?></td>
				<td hidden><?php echo $id_hlreader_new; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
