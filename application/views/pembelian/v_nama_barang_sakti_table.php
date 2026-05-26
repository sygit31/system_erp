<table id="tbl_nama_sakti" width="100%" class="table table-bordered table-striped" style="font-size: 13px;">
	<thead>
		<tr align="center">
			<th>Pilih</th>
			<th>No</th>
			<th>Kode Barang Sakti</th>
            <th>Jenis  Barang</th>
			<th>Nama Barang Sakti</th>
		
		</tr>
	</thead>
	<tbody>
		<?php
		$urut = 0;
		foreach ($nama_barang_sakti_baru->result_array() as $ds) :
			$urut++;
			$kode = $ds['KODE'];
            $jenis = $ds['JENIS'];
			$barang = $ds['NAMA'];
			
			?>
			<tr>
				<td align="center"><button onclick="pilih_nama_sakti(this)" type="button" class="btn btn-block btn-warning btn-sm" title="Pilih Nama Barang"><i class="fa fa-check-square-o"></i></button></td>
				<td align="center"><?php echo $urut; ?></td>
				<td><?php echo $kode; ?></td>
                <td><?php echo $jenis; ?></td>
				<td><?php echo $barang; ?></td>
				
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>