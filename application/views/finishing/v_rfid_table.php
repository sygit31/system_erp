<table id="data-table" class="table table-bordered table-striped" style="width: 100%;">
	<thead>
		<tr align="center">
			<th width="10%">No.</th>
			<th width="15%">Seri</th>
			<th width="25%">Kode Rim</th>
			<th width="20%">Tanggal</th>
			<th width="30%">Nomor Kode</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		foreach ($filter->result_array() as $dt):
			$urut++;
			$seri = substr($dt['KODE_BAHAN'],-1);
			$seri = $seri == '4' ? 'MMEA' : $seri;
			$kode_rim = $dt['KODE_RIM'];

			$tanggal = tgl_indo($dt['TANGGAL']);
			// $tanggal = date('d F Y',strtotime($dt['TANGGAL'])); // English Format

			$bln = date('M',strtotime($dt['JATUH_TEMPO']));
			$tgl = date('d',strtotime($dt['JATUH_TEMPO']));
			$kode_pengawas = $pengawas;
			$nomesin_stamp = $dt['NOMESIN_STAMP'];

			$nomor_kode = $dt['NOMOR_SOP'] . $bln . '-' . $tgl . $nomesin_stamp . $dt['SHIFT_STAMP'] . $dt['SHIFT_CUTTER'] . $kode_pengawas . $dt['KELOMPOK_PACKING'] . $dt['NO_MESIN_HITUNG'];
			?>
			<tr>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $seri; ?></td>
				<td align="center"><?php echo $kode_rim; ?></td>
				<td align="center"><?php echo $tanggal; ?></td>
				<td align="center"><?php echo $nomor_kode; ?></td>
			</tr>
		<?php endforeach; ?>

		<?php 
		function tgl_indo($tanggal){
			$bulan = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
			$str = explode('-', $tanggal);			
			return $str[0] . ' ' . $bulan[(int)$str[1]-1] . ' ' . $str[2];
		}
		?>
	</tbody>
</table>
