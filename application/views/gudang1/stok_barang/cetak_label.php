<!DOCTYPE>
<html>
<head>
	<title>Cetak Label</title>
	<style type="text/css">
		@media print{@page {size: portrait};}
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
	<br />
	<br />
	<br />
	
	<table border="1">
		<tr><td>

			<table border="1">
				<tr valign="center">
			        <td width="550" align="center" 
			        <?php
			        	if ($cetak[7] == '1') {print_r("style='background-color: green;color: white;'");}
			        	if ($cetak[7] == '2') {print_r("style='background-color: gold;'");}
			        	if ($cetak[7] == '3') {print_r("style='background-color: red;'");}
			        ?>
			        ><font size="11"><b><?php echo $cetak[0]; ?></b></font></td>
		        </tr>
			</table>

			<br />

			<font size="8">
				<table> 
			        <tr valign="center">
			          	<td width="100">&nbsp &nbsp &nbsp &nbsp &nbsp Tanggal</td>
			          	<td width="20" align="center">:</td>
			          	<td width="410"><?php echo "(IN) ".$cetak[1]." / (QC) ".$cetak[2]; ?></td>
			        </tr>
			        <tr valign="center">
			          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Nama</td>
			          	<td align="center">:</td>
			          	<td><?php echo $cetak[3]; ?></td>
			        </tr>
			        <tr valign="center">
			          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Tahun</td>
			          	<td align="center">:</td>
			          	<td><?php echo $cetak[4]; ?></td>
			        </tr>
			        <tr>
			          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Panjang</td>
			          	<td align="center">:</td>
			          	<td><?php echo $cetak[5]; ?> Meter</td>
			        </tr>
			        <tr>
			          	<td>&nbsp &nbsp &nbsp &nbsp &nbsp Barcode</td>
			          	<td align="center">:</td>
			          	<td><?php echo $cetak[6]; ?></td>
			        </tr>
				</table>
			</font>

			<br />
		</td></tr>
	</table>
		
	<!-- <br /> -->

	


	<script type="text/javascript">
        window.print();
    </script>

</body>
</html>