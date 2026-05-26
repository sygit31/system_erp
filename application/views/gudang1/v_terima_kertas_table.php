<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped">
		<thead>
			<tr>
				<td rowspan="2">No.</td>
				<td rowspan="2">Tgl. NPK</td>
				<td rowspan="2">No. NPK</td>
				<td rowspan="2">No. Roll</td>
				<td colspan="2">Netto</td>
				<td rowspan="2">Toleransi</td>
				<td colspan="2">Selisih</td>
				<td rowspan="2">Netto Final</td>
			</tr>
			<tr>
				<td>PDL</td>
				<td>PNP</td>
				<td>+</td>
				<td>-</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$urut=0; $total_pdl=0; $total_pnp=0; $total=0; $plus = 0; $minus = 0; $final = 0; $total_selisih = 0; $total_final = 0;
			foreach ($terima_kertas->result_array() as $dt):
				$nmr=$urut++;
				$tgl_npk=date('d-M-Y',strtotime($dt['tgl_npk']));
				$npk=$dt['no_npk'];
				$roll=$dt['no_roll'];
				$berat=$dt['berat'];
				$berat_pnp=$dt['berat_pnp'];
				$toleransi=number_format($dt['toleransi'],2);
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
				$total_selisih = $total_selisih + $plus + $minus;
				$total_final = $total_final + $final;

				?>
				<tr>
					<td><?php echo $urut; ?></td>
					<td><?php echo $tgl_npk; ?></td>
					<td><?php echo $npk; ?></td>
					<td><?php echo $roll; ?></td>
					<td align="right"><?php echo number_format($berat,2); ?></td>
					<td align="right"><?php echo $berat_pnp; ?></td>
					<td align="right"><?php echo $toleransi; ?></td>
					<td align="right" style="color: <?php if($plus>0.2){echo "red";} ?> ;"><?php echo $plus; ?></td>
					<td align="right" style="color: <?php if($minus<-0.2){echo "red";} ?> ;"><?php echo $minus; ?></td>
					<td align="right"><?php echo $final; ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="4" align="center"><strong>Total</strong></td>
				<td align="right"><strong><?php echo number_format($total_pdl,2); ?></strong></td>
				<td align="right"><strong><?php echo number_format($total_pnp,2); ?></strong></td>
				<td></td>
				<td colspan="2" align="right"><strong><?php echo number_format($total_selisih,2); ?></strong></td>
				<td align="right"><strong><?php echo number_format($total_final,2); ?></strong></td>
			</tr>
		</tbody>
	</table>
</div>