<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead style="text-align: center;">
		<tr align="center">
			<th hidden></th>
			<th>No.</th>
			<th>Unit</th>
			<th>Nama Admin</th>
			<th>Periode</th>
			<th>Kode Jurnal</th>
			<th>Nama Jurnal</th>
			<th>Jumlah</th>
			<th>Realisasi</th>
			<th>Sisa</th>
			<th>View</th>
			<th>Ubah</th>
			<th>Hapus</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		$total_budget = 0;
		$total_realisasi = 0;
		$total_sisa = 0;
		foreach ($budget->result_array() as $dt) :
			$urut++;
			$id = $dt['ID'];
			$unit = $dt['UNIT'];
			$karyawan = $dt['KARYAWAN'];
			$periode = date('M-Y', strtotime($dt['PERIODE']));
			$no_rekjurnal = $dt['NO_REKJURNAL'];
			$nama = $dt['NAMA'];

			$dt['REALISASI'] == null ? $realisasi = 0 : $realisasi = str_replace(",", ".", $dt['REALISASI']);
			$dt['BUDGET'] == null ? $budget = 0 : $budget = str_replace(",", ".", $dt['BUDGET']);
			$dt['ADENDUM'] == null ? $adendum = 0 : $adendum = str_replace(",", ".", $dt['ADENDUM']);

			$budget = str_replace(",", ".", $budget) + str_replace(",", ".", $adendum);
			$sisa = str_replace(",", ".", $budget) - str_replace(",", ".", $realisasi);
			$hidden = $dt['T_PERIODE'] != date('ym') || $sisa < 1 ? 'hidden' : '';
			?>

			<tr>
				<td hidden><?php echo $id; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo ucwords(strtolower($unit)); ?></td>
				<td><?php echo $karyawan; ?></td>
				<td align="center"><?php echo $periode; ?></td>
				<td><?php echo $no_rekjurnal; ?></td>
				<td><?php echo $nama; ?></td>
				<td align="right"><?php echo number_format($budget, 2); ?></td>
				<td align="right"><?php echo number_format($realisasi, 2); ?></td>
				<td align="right"><?php echo number_format($sisa, 2); ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-info" style="width: 50px;" title="View Data" name="<?php echo $id; ?>" onclick="view(this)" data-toggle="modal" data-target="#modal_view" data-backdrop="static" data-keyboard="false"><b><i class="fa fa-book"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning" style="width: 50px;" title="Ubah Budget" name="<?php echo $id; ?>" onclick="ubah(this)" <?php echo $hidden; ?>><b><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger" style="width: 50px;" title="Hapus Data" name="<?php echo $id; ?>" onclick="hapus(this)" <?php echo $hidden; ?> <?php if ($realisasi != 0) {echo "hidden";} ?>><b><i class="fa fa-trash"></i>
				</button></td>
			</tr>

			<?php $total_budget = $total_budget +  str_replace(",", ".", $budget);?>
			<?php $total_realisasi = $total_realisasi +  str_replace(",", ".", $realisasi);?>
			<?php $total_sisa = $total_sisa +  str_replace(",", ".", $sisa);?>

		<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr align="center">
			<th colspan="6">Total</th>
			<td align="right" class="text-bold"><?php echo number_format($total_budget, 2); ?></td>
			<td align="right" class="text-bold"><?php echo number_format($total_realisasi, 2); ?></td>
			<td align="right" class="text-bold"><?php echo number_format($total_sisa, 2); ?></td>
			<td colspan="3"></td>
		</tr>
	</tfoot>
</table>