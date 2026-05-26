<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead style="text-align: center;">
			<tr align="center">
				<th width="5%">No.</th>
				<th width="10%">Nomor</th>
				<th width="10%">Periode</th>
				<th width="10%">Tipe Pengajuan</th>
				<th width="25%">Nama Karyawan</th>
				<th width="10%">Bagian</th>
				<th width="10%">Tanggal Pengajuan</th>
				<th width="10%">Total</th>
				<th width="10%">Status</th>
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
				$nmr = $dt['NMR'];
				$total = number_format($dt['TOTAL']);
				$nama = $dt['NAMA'];
				$periode = $dt['PERIODE'];
				$bagian = $dt['BAGIAN'];
				if ($dt['REJECT_STATUS'] > 0) {
					$status = 'Reject';
				}else if($dt['STATUS'] == $dt['QTY_STATUS']) {
					$status = 'Approved';
				}else{
					$status = '';
				}
				$tgl_submit=date('d-M-Y',strtotime($dt['TGL_INPUT']));
				?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $nmr; ?></td>
				<td align="center"><?php echo $periode; ?></td>
				<td>Budget</td>
				<td><?php echo $nama; ?></td>
				<td align="center"><?php echo $bagian; ?></td>
				<td align="center"><?php echo $tgl_submit; ?></td>
				<td align="center"><?php echo $total; ?></td>
				<td align="center"><?php echo $status; ?></td>
				<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="preview(this)">Preview</button></td>
				<td hidden><?php echo $id_budget; ?></td>
			</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
</div>