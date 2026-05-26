<table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 13px;">
	<thead>
		<tr align="center">
			<th>No.</th>
			<th>Desain</th>
			<th>Tipe</th>
			<th>Jenis</th>
			<th>Tanggal</th>
			<th>Deadline</th>
			<th>No. KP</th>
			<th>Nama Produk</th>
			<th>Master</th>
			<th>Qty</th>
			<th>Qty Baik</th>
			<th>Qty Reject</th>
			<th>Keterangan</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$no_kp = '';
		foreach ($filter->result_array() as $dt):

			if ($no_kp == $dt['NMR']) {
				$desain='';
				$tipe='';
				$jenis='';					
				$tanggal='';
				$deadline='';
				$nmr='';
				$nama='';
			}else{
				$urut=$urut+1;
				$desain=$dt['DESAIN'];
				$tipe=$dt['TIPE'];
				$kode=$dt['KODE']; (substr($kode,0,1) == 'C') ? $jenis = 'Cukai' : $jenis = 'Non Cukai';				
				$tanggal=date('d-M-Y',strtotime($dt['TANGGAL']));
				$deadline=date('d-M-Y',strtotime($dt['DEADLINE']));
				$nmr=$dt['NMR'];
				$nama=$dt['NAMA'];
			}			
			
			$no_kp=$dt['NMR'];
			$master=$dt['MASTER'];
			$qty=$dt['QTY'];
			$qty_baik=$dt['QTY_BAIK'];
			$qty_reject=$dt['QTY_REJECT'];
			$keterangan=$dt['KETERANGAN'] . ' ' . $dt['NOTE'];
			if (($qty_baik + $qty_reject) < $qty) {$status = 'On Progress';}else{$status = 'Done';}
			if ($dt['STATUS'] == '2') {$status = 'Batal';}
			?>
			<tr>
				<td align="center"><?php if($jenis == "") {echo "";}else{echo $urut;} ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td><?php echo $tipe; ?></td>
				<td><?php echo $jenis; ?></td>
				<td align="center"><?php echo $tanggal; ?></td>
				<td align="center"><?php echo $deadline; ?></td>
				<td align="center"><?php echo $nmr; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $master; ?></td>
				<td align="center"><?php echo $qty; ?></td>
				<td align="center"><?php echo $qty_baik; ?></td>
				<td align="center"><?php echo $qty_reject; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td style="font-weight: bold; color: <?php if($status == 'On Progress') {echo "#FB5F5F";} ?>;"><?php echo $status; ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>