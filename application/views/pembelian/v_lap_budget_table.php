<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead style="text-align: center;">
			<tr align="center">
				<th width="10%">No.</th>
				<th width="15%">Tipe Pengajuan</th>
				<th width="10%">Nomor</th>
				<th width="20%">Nama Karyawan</th>
				<th width="15%">Tanggal Pengajuan</th>
				<th width="10%">Status</th>
				<th width="15%">Total</th>
				<th></th>
				<th hidden></th>
			</tr>
		</thead>
		<tbody>

			<?php
			$urut = 0;
			foreach ($budget->result_array() as $dt):
				$urut = $urut+1;
				$id_budget = $dt['ID_BUDGET'];
				$nama = $dt['NAMA'];
				$nmr = $dt['NMR'];
				if ($dt['REJECT_STATUS'] > 0) {
					$status = 'Reject';
				}else if($dt['STATUS'] == $dt['QTY_STATUS']) {
					$status = 'Approved';
				}else{
					$status = '';
				}
				$tgl_submit=date('d-M-Y',strtotime($dt['TGL_SUBMIT']));
				$total = number_format($dt['TOTAL']);
				?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td>Budget</td>
				<td align="center"><?php echo $nmr; ?></td>
				<td><?php echo $nama; ?></td>
				<td align="center"><?php echo $tgl_submit; ?></td>
				<td align="center"><?php echo $status; ?></td>
				<td align="center"><?php echo $total; ?></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="preview(this)">Preview</button></td>
				<td hidden><?php echo $id_budget; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>