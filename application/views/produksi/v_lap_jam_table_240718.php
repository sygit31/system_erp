
<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" style="width:100%">
		<thead align="center">
			<tr>				
				<th style="width: 5%;">No.</th>
				<th style="width: 20%;">Jenis Downtime</th>
				<th style="width: 15%;">Total Jam</th>
				<th style="width: 15%;">Emboss</th>
				<th style="width: 15%;">Coating Sensitizing</th>
				<th style="width: 15%;">Coating Readible</th>
				<th style="width: 15%;">Belah</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut=0;
			foreach ($downtime->result_array() as $dt):
				$urut++;
				$jenis = $dt['KODE'] . ' - ' . $dt['KETERANGAN'];
				
				?>
				<tr>
					<td align="center"><?php echo $urut; ?></td>
					<td><?php echo $jenis; ?></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
					<td align="center"></td>
				</tr>
			<?php endforeach; ?>
			<th colspan="2" class="text-center">Total</th>
			<td hidden></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
			<td align="center"></td>
		</tbody>
	</table>
</div>

<script>

</script>