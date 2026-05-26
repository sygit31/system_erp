<div class="data-table">
	<table id="data-table" class="table table-bordered table-striped" width="100%">
		<thead style="text-align: center;">
			<tr align="center">
				<th hidden></th>
				<th width="5%">No.</th>
				<th width="15%">Nomor</th>
				<th width="15%">Tipe Pengajuan</th>
				<th width="10%">Periode</th>
				<th width="15%">Nama Karyawan</th>
				<th width="10%">Bagian</th>
				<th width="10%">Tanggal Pengajuan</th>
				<th width="10%">Total</th>
				<th width="10%">Status</th>
				<th></th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$urut = 0;
			foreach ($budget->result_array() as $dt):
				$urut++;
				$nmr = $dt['NMR'];
				$karyawan = $dt['KARYAWAN'];
				$bagian = $dt['BAGIAN'];
				$tipe = 'BUDGET - NON PRODUKSI';
				if ($bagian == 'PPIC') {$tipe = 'BUDGET - PRODUKSI';}
				$periode = $dt['PERIODE'];
				$tgl = date('d-M-Y',strtotime($dt['TGL_INPUT']));
				$id_budget = $dt['ID'];
				$total = $dt['TOTAL'];
				$status = $dt['APPROVAL_STATUS'];
				if ($status == '0') {
					$status = 'Reject';
				}elseif ($status == '1') {
					$status = 'Approved';
				}else{
					$status = '';
				}
			?>
				<tr>
					<td hidden><?php echo $id_budget; ?></td>
					<td align="center"><?php echo $urut; ?></td>
					<td align="center"><?php echo $nmr; ?></td>
					<td align="center"><?php echo $tipe; ?></td>
					<td align="center"><?php echo $periode; ?></td>
					<td><?php echo $karyawan; ?></td>
					<td align="center"><?php echo $bagian; ?></td>
					<td align="center"><?php echo $tgl; ?></td>
					<td align="right"><?php echo number_format($total); ?></td>
					<td align="center"><?php echo $status; ?></td>
					<td><button type="button" class="btn btn-block btn-warning btn-sm" onclick="preview(this)">Preview</button></td>
					<td><button type="button" class="btn btn-block btn-success btn-sm" onclick="status(this)">Approve</button></td>
					<td><button type="button" class="btn btn-block btn-danger btn-sm" onclick="status(this)">Reject</button></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>