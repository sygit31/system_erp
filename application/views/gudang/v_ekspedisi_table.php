<div class="table_non_print">
	<table class="table table-bordered table-striped">
		<thead>
			<tr>
				<td>No.</td>
				<td>Tgl. NPK</td>
				<td>No. NPK</td>
				<td>Ukuran</td>
				<td>No. Roll</td>
				<td>Netto</td>
				<td>Rencana</td>
				<td>No. PP</td>
				<td>Pakai</td>
				<td>Rusak</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$urut = 0;
			$total_netto = 0;
			$total_pakai = 0;
			$total_rusak = 0;
			foreach ($ekspedisi_kertas->result_array() as $dt):
				$urut++;
				$tgl_npk=date('d-M-Y',strtotime($dt['TGL_NPK']));
				$no_npk=$dt['NO_NPK'];
				$ukuran=$dt['LEBAR_CM'];
				$no_roll=substr($dt['NO_ROLL'],0,5);
				$netto=str_replace(',','.',$dt['NETTO_KG']);
				$rencana=date('d-M-Y',strtotime($dt['TGL_RENCANA']));
				$no_pp=$dt['NOMOR_PP'];
				$pakai=str_replace(',','.',$dt['PAKAI_KG']);
				$rusak=str_replace(',','.',$dt['RUSAK_KG']);

				$total_netto = $total_netto + $netto;
				$total_pakai = $total_pakai + $pakai;
				$total_rusak = $total_rusak + $rusak;
				?>
				<tr>
					<td><?php echo $urut; ?></td>
					<td><?php echo $tgl_npk; ?></td>
					<td><?php echo $no_npk; ?></td>
					<td><?php echo $ukuran; ?></td>
					<td><?php echo $no_roll; ?></td>
					<td><?php echo number_format($netto,2); ?></td>
					<td><?php echo $rencana; ?></td>
					<td><?php echo $no_pp; ?></td>
					<td><?php echo number_format($pakai,2); ?></td>
					<td><?php echo number_format($rusak,2); ?></td>
				</tr>
			<?php endforeach; ?>
			<tr>
				<td colspan="5" align="center"><strong>Total</strong></td>
				<td><strong><?php echo number_format($total_netto,2); ?></strong></td>
				<td></td>
				<td></td>
				<td><strong><?php echo number_format($total_pakai,2); ?></strong></td>
				<td><strong><?php echo number_format($total_rusak,2); ?></strong></td>
			</tr>
		</tbody>
	</table>
</div>

<div class="table_print" style="display: none;">
	<?php for ($tbl=1; $tbl<=4; $tbl++) { ?>
		<table id="<?php echo "tabel_". $tbl ?>" width="24%" style="float: left; margin-left: 5px;">
			<tr>
				<th>No.</th>
				<th>No. Roll</th>
				<th>Netto</th>
			</tr>
			<?php for ($i=1; $i<=25; $i++) { ?>
				<tr>			
					<td></td>
					<td></td>
					<td></td>			
				</tr>
			<?php } ?>
		</table>
	<?php } ?>
</div>

<script>

	// Isi Tabel
	$(document).ready(function() {
		var urut = 0;
		var brs = 0;

		'<?php foreach ($ekspedisi_kertas->result_array() as $dt): ?>'
		if (urut % 25 == 0) {brs = 0;}	
		brs++;
		urut++;
		no_roll = '<?php echo substr($dt['NO_ROLL'],0,5) ?>';
		netto = '<?php echo $dt['NETTO_KG'] ?>';

		if (urut<=25) {
			var tabel = document.getElementById('tabel_1');
		}else if(urut<=50) {
			var tabel = document.getElementById('tabel_2');
		}else if(urut<=75) {
			var tabel = document.getElementById('tabel_3');
		}else if(urut<=100) {
			var tabel = document.getElementById('tabel_4');
		}


		tabel.rows[brs].cells[0].innerHTML = urut;
		tabel.rows[brs].cells[1].innerHTML = no_roll;
		tabel.rows[brs].cells[2].innerHTML = Number(netto.replace(/,/g,".")).toFixed(2);
		
		'<?php endforeach; ?>'
	});
</script>