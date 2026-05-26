<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center">
			<th rowspan="2" hidden>Id</th>
			<th rowspan="2">No.</th>
			<th rowspan="2">Tgl. NPK</th>
			<th rowspan="2">No. NPK</th>
			<th rowspan="2">No. Roll</th>
			<th colspan="2">Netto</th>
			<th rowspan="2">Toleransi</th>
			<th colspan="2">Selisih</th>
			<th rowspan="2">Netto Final</th>
			<th rowspan="2">Edit</th>
			<th rowspan="2">Hapus</th>
		</tr>
		<tr align="center">
			<th>PDL</th>
			<th>PNP</th>
			<th>+</th>
			<th>-</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$urut=0; $total_pdl=0; $total_pnp=0; $total=0; $plus = 0; $minus = 0; $final = 0; $total_selisih = 0; $total_final = 0;
		foreach ($terima_kertas->result_array() as $dt):
			$nmr=$urut++;
			$id_masuk = $dt['id_masuk'];
			$tgl_npk = date('d-M-Y',strtotime($dt['tgl_npk']));
			$npk = $dt['no_npk'];
			$roll = $dt['no_roll'];
			$berat = $dt['berat'];
			$berat_pnp = $dt['berat_pnp'];
			$toleransi = number_format($dt['toleransi'],2);
			$selisih = $berat_pnp - $berat;

			if ($selisih > 0) {
				$plus = number_format($selisih,2);
				$minus = "";
			}else{
				$plus = "";
				$minus = number_format($selisih,2); 
			}

			if ($selisih <= 0.24 && $selisih >= -0.24) {
				$final = number_format($berat,2);
			}else{
				$final = number_format($berat_pnp,2);
			}

			if ($berat_pnp == '') {$toleransi = ''; $plus = ''; $minus = ''; $final ='';}else{$berat_pnp = number_format($berat_pnp,2);}

			$total_pdl = $total_pdl + $berat;
			$total_pnp = $total_pnp + $berat_pnp;
			$total_selisih = floatval($total_selisih) + floatval($plus) + floatval($minus);
			$total_final = floatval($total_final) + floatval($final);

			?>
			<tr>
				<td align="center" hidden><?php echo $id_masuk; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl_npk; ?></td>
				<td align="center"><?php echo $npk; ?></td>
				<td align="center"><?php echo $roll; ?></td>
				<td align="center"><?php echo number_format($berat,2); ?></td>
				<td align="center"><?php echo $berat_pnp; ?></td>
				<td align="center"><?php echo $toleransi; ?></td>
				<td align="center" style="color: <?php if($plus>0.2){echo "red";} ?> ;"><?php echo $plus; ?></td>
				<td align="center" style="color: <?php if($minus<-0.2){echo "red";} ?> ;"><?php echo $minus; ?></td>
				<td align="center"><?php echo $final; ?></td>
				<td align="center"><button type="button" class="btn btn-block btn-warning btn-sm" style="width: 50px;" title="Edit Data" onclick="edit(this)"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><button type="button" class="btn btn-block btn-danger btn-sm" style="width: 50px;" title="Hapus Data" onclick="hapus(this)"><i class="fa ion-trash-a"></i></button></td>
			</tr>
		<?php endforeach; ?>

		<tr>
			<td hidden></td>
			<td colspan="4" align="center"><strong>Total</strong></td>
			<td hidden></td>
			<td hidden></td>
			<td hidden></td>
			<td align="center"><strong><?php echo number_format($total_pdl,2); ?></strong></td>
			<td align="center"><strong><?php echo number_format($total_pnp,2); ?></strong></td>
			<td></td>
			<td colspan="2" align="center"><strong><?php echo number_format($total_selisih,2); ?></strong></td>
			<td hidden></td>
			<td align="center"><strong><?php echo number_format($total_final,2); ?></strong></td>	
			<td></td>
			<td></td>
		</tr>
	</tbody>
</table>