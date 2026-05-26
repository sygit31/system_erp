<!DOCTYPE>
<html>
<head>
	<title>Cetak Label</title>
	<style type="text/css">
		@media print{
			@page {
				size: portrait;
				margin: 15cm;
				};
			}

		/* style sheet for "A4" printing */
		/* @media print and (width: 21cm) and (height: 29.7cm) {
			@page {
				margin: 3cm;
			}
		} */

		/* style sheet for "letter" printing */
		/* @media print and (width: 8.5in) and (height: 11in) {
			@page {
				margin: 1in;
			}
		} */

		/* A4 Landscape*/
		/* @page {
			size: A4 landscape;
			margin: 10%;
		} */


	</style>

	<!-- <style type="text/css" media="print">
	    .page
	    {
	     -webkit-transform: rotate(-90deg); 
	     -moz-transform:rotate(-90deg);
	     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
	    }
	</style> -->

		<!-- <style type="text/css" media="print">
		    @page { 
		        size: portrait;
		    }
		    body { 
		        writing-mode: tb-rl;
		    }
		</style> -->
</head>
<body>
<font size="2px">
	<label>PT. PURA NUSAPERSADA</label><br />
	<label>KUDUS</label>
</font>

	<p />
<font size="2px">
	<p style="font-weight: bold;text-align: center;">SURAT IJIN PEMBELIAN</p>
</font>

	<table style="font-size:12px;">
		<tr>
			<td width=150>Bagian</td>
			<td width=10>:</td>
			<td width=240>Umum</td>
			<td width=150>Unit</td>
			<td width=10>:</td>
			<td width=240>Holografi</td>
		</tr>
		<tr>
			<td>Tanggal Diperlukan</td>
			<td>:</td>
			<td>......................</td>
			<td>No. SIP</td>
			<td>:</td>
			<td><?php //echo $detailSIP[0]->NO_SIP ?></td>
		</tr>
		<tr>
			<td />
			<td />
			<td />
			<td>Tanggal</td>
			<td>:</td>
			<td><?php //echo $detailSIP[0]->TANGGAL ?></td>
		</tr>
	</table>

	<p />


	<table id="tblDetailSIP" border="1" style="font-size:12px;">
		<tr align="center">
			<th width="30">No.</th>
			<th width="230">Barang</th>
			<th width="70">Jumlah</th>
			<th width="70">Satuan</th>
			<th width="400">Keterangan</th>                              
		</tr>
		<?php $no = 1; ?>
		<?php foreach($detailSIP as $row){ ?>
			<tr align="center">
				<td><?php echo $no++; ?></td>
				<td><?php echo $row['BARANG']." ".$row['SPESIFIKASI']; ?></td>
				<td><?php echo $row['JUMLAH']; ?></td>
				<td><?php echo $row['SATUAN']; ?></td>
				<td><?php echo $row['KETERANGAN']; ?></td>
			</tr> 
		<?php } ?>
	</table>

		
	<p />

	<table style="font-size:12px;">
		<tr>
			<td colspan="4"/>
				Tanggal : ......................
			</td>
		</tr>
		<tr align="center">
			<td width="200">
				Diterima
			</td>
			<td width="200">
				Mengetahui
			</td>
			<td width="200">
				Disetujui
			</td>
			<td width="200">
				Dibuat
			</td>
		</tr>
		<tr height="70">
			<td colspan="4"/>
		</tr>
		<tr align="center">
			<td>
				(..............................)
			</td>
			<td>
				(..............................)
			</td>
			<td>
				(..............................)
			</td>
			<td>
				(..............................)
			</td>
		</tr>
		<tr align="center">
			<td>
				Pembelian
			</td>
			<td>
				Mng. F&A/Cost Control
			</td>
			<td>
				Kabag Ybs
			</td>
			<td>
				Pemohon
			</td>
		</tr>
	</table>
	
	<p />

	<table border="1" style="font-size:12px;">
		<tr align="center">
			<td colspan="4"> Diisi oleh bagian pembelian</td>
		</tr>
		<tr align="center">
			<td width="30">No.</td>
			<td width="320">Pemasok(Yang Lalu)</td>
			<td width="240">Harga Persatuan</td>
			<td width="200">No. SPP</td>
		</tr>
		<tr height="100">
			<td />
			<td />
			<td />
			<td />
		</tr>
	</table>

	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>