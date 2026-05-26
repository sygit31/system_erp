<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead align="center" style="background-color: #3FB4F7; font-weight: bold; color: #FFFFFF;">
		<tr>
			<th hidden></th>
			<th>No.</th>
			<th>KK</th>
			<th>Seri</th>
			<th>Tanggal</th>
			<th>No. IPB</th>
			<th>Jenis PCH</th>
			<th>Ukuran</th>
			<th>No. Register</th>
			<th>Kembali</th>
			<th><?php if ($status_menu == '2') {echo "Approve";} else {echo "Cetak";} ?></th>
			<th>Batal</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($ipb->result_array() as $dt) :
			$urut = $urut + 1;
			$id = $dt['ID'];
			$kk = $dt['NO_KK'];
			$seri = $dt['SERI'];
			$tgl = date('d-M-Y', strtotime($dt['TGL']));
			$nmr = $dt['NMR'];
			$jenis = $dt['NAMA'];
			$ukuran = $dt['UKURAN'];
			$no_reg = $dt['NO_REG'];
			$aktif = $dt['AKTIF'];
			$qty_kembali = $dt['QTY_KEMBALI'];

			$status = '';
			$tgl_ipb = strtotime($dt['TGL']);
			if (date('ymd') > date('ymd', strtotime('+14 days',$tgl_ipb))) {$status = 'Tempo';}
			if ($qty_kembali == 0) {$kembali = 'Belum';} else{$kembali = 'Sudah';}

			?>
			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $kk; ?></td>
				<td><?php echo $seri; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo $nmr; ?></td>
				<td><?php echo $jenis; ?></td>
				<td align="center"><?php echo $ukuran; ?></td>
				<td><?php echo $no_reg; ?></td>
				<td class="<?php if($status=='Tempo' && $kembali=='Belum'){echo 'text-bold text-danger';} ?>"><?php echo $kembali; ?></td>
				<td align="center">
					<button type="button" class="btn btn-block btn-success btn-sm" title="Print" style="width: 40px;" onclick="cetak(this)" <?php if ($aktif != '2') {echo "hidden";} ?>><i class="fa fa-print"></i></button>
					<button type="button" class="btn btn-block btn-success btn-sm" title="Approve" style="width: 40px;" onclick="approve(this)" <?php if ($aktif == '2' || $status_menu != '2') {echo "hidden";} ?>><i class="fa fa-send-o"></i></button>
				</td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm mt-2" title="Batal IPB" style="width: 40px;" onclick="hapus(this)" <?php if ($aktif != '1') {echo "hidden";} ?>><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>

	</tbody>
</table>
