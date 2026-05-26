<table id="data-table" class="table table-bordered table-striped" width="100%" style="font-size: 13px;">
	<thead>
		<tr align="center">
			<th hidden>ID Galv Proses</th>
			<th width="5%">No.</th>
			<th width="5%">Tipe</th>
			<th width="5%">Desain</th>
			<th width="10%">Tanggal Proses</th>
			<th width="15%">No. KP</th>
			<th width="5%">Master</th>
			<th width="20%">Nama Produk</th>
			<th width="15%">No. Register</th>
			<th width="10%">Bon Galvanik</th>
			<th width="10%">Kembali</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($data->result_array() as $dt):
			$urut=$urut+1;	
			$id_galv_proses=$dt['ID_GALV_PROSES'];				
			$tipe=$dt['TIPE'];				
			$desain=$dt['DESAIN'];				
			$tgl_proses=date('d-M-Y',strtotime($dt['TGL_PROSES']));
			$no_kp=$dt['NO_KP'];
			$master=$dt['MASTER'];
			$nama_produk=$dt['NAMA_PRODUK'];
			$no_reg=$dt['NO_REG'];
			$tgl_bon=$dt['TGL_BON'];
			$tgl_kembali=$dt['TGL_KEMBALI'];
			$result=$dt['RESULT'];
			?>
			<tr>
				<td hidden><?php echo $id_galv_proses; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tipe; ?></td>
				<td align="center"><?php echo $desain; ?></td>
				<td align="center"><?php echo $tgl_proses; ?></td>
				<td align="center"><?php echo $no_kp; ?></td>
				<td align="center"><?php echo $master; ?></td>
				<td><?php echo $nama_produk; ?></td>
				<td align="center"><?php echo $no_reg; ?></td>
				<td align="center"><?php if ($tgl_bon != null) {echo date('d-M-Y',strtotime($tgl_bon));} ?><button type="button" class="btn btn-block btn-success btn-sm" onclick="bon(this)" <?php if ($tgl_bon != null || $result == 'Reject') {echo 'hidden';} ?>><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><?php if ($tgl_kembali != null) {echo date('d-M-Y',strtotime($tgl_kembali));} ?><button type="button" class="btn btn-block btn-danger btn-sm" onclick="kembali(this)" <?php if ($tgl_bon == null || $tgl_kembali != null) {echo 'hidden';} ?>><i class="fa fa-share"></i></button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>