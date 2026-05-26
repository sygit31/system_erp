<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th hidden></th>
			<th>No.</th>
			<th>Desain</th>
			<th>Tipe</th>
			<th>Unit</th>
			<th>Tanggal</th>
			<th>Deadline</th>
			<th>No. KP</th>
			<th>Nama Produk</th>
			<th>Spesifikasi</th>
			<th>Jenis</th>
			<th>Ukuran</th>
			<th>Master</th>
			<th>Qty</th>
			<th>Qty Baik</th>
			<th>Qty Reject</th>
			<th>Keterangan</th>
			<th>Status</th>
			<th>Print</th>
			<th>Batal</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$no_kp = '';
		foreach ($kp->result_array() as $dt):

			if ($no_kp == $dt['NMR']) {
				$desain = '';
				$tipe = '';
				$unit = '';					
				$tanggal = '';
				$deadline = '';
				$nmr = '';
				$nama = '';
				$spesifikasi = '';
				$jenis = '';
				$ukuran = '';
			}else{
				$urut = $urut+1;
				$desain = $dt['DESAIN'];
				$tipe = $dt['TIPE'];
				$unit = $dt['KD_UNIT'] == '01' ? 'Perdana' : 'Holografi';				
				$tanggal = date('d-M-Y',strtotime($dt['TANGGAL']));
				$deadline = date('d-M-Y',strtotime($dt['DEADLINE']));
				$nmr = $dt['NMR'];
				$nama = $dt['NAMA'];
				$spesifikasi = $dt['SPESIFIKASI'];
				$jenis = $dt['JENIS'] == '' ? '' : ($dt['JENIS'] == '1' ? '1 Up' : 'Turunan');
				$ukuran = $dt['UKURAN'];
			}			
			
			$id_kp_detail = $dt['ID_KP_DETAIL'];
			$no_kp = $dt['NMR'];
			$master = $dt['MASTER'];
			$qty = $dt['QTY'];
			$qty_baik = $dt['QTY_BAIK'];
			$qty_reject = $dt['QTY_REJECT'];
			$keterangan = $dt['KETERANGAN'] . ' ' . $dt['NOTE'];
			$updated_status = $dt['UPDATED_STATUS'];
			if (($qty_baik + $qty_reject) < $qty) {$status = 'On Progress';}else{$status = 'Done';}
			if ($dt['STATUS'] == '2') {$status = 'Batal';}
			?>
			<tr>
				<td hidden><?php echo $id_kp_detail; ?></td>
				<td align="center"><?php if($unit == "") {echo "";}else{echo $urut;} ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td><?php echo $tipe; ?></td>
				<td><?php echo $unit; ?></td>
				<td align="center"><?php echo $tanggal; ?></td>
				<td align="center"><?php echo $deadline; ?></td>
				<td align="center"><?php echo $nmr; ?></td>
				<td><?php echo $nama; ?></td>
				<td><?php echo $spesifikasi; ?></td>
				<td><?php echo $jenis; ?></td>
				<td><?php echo $ukuran; ?></td>
				<td><?php echo $master; ?></td>
				<td align="center"><?php echo $qty; ?></td>
				<td align="center"><?php echo $qty_baik; ?></td>
				<td align="center"><?php echo $qty_reject; ?></td>
				<td><?php echo $keterangan; ?></td>
				<td style="font-weight: bold; color: <?php if($status == 'On Progress') {echo "#FB5F5F";} ?>;"><?php echo $status; ?></td>
				<td><button type="button" class="btn btn-block btn-success btn-sm" title="Print Data" onclick="cetak(this)"><i class="fa fa-print"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="hapus(this)" <?php if ($updated_status == '0' || $qty_baik + $qty_reject != 0) {echo 'hidden';} ?>><i class="fa fa-trash"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>