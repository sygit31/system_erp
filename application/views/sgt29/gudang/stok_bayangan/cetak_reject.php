<!DOCTYPE>
<html>
<head>
	<title>Cetak Surat Reject</title>
</head>
<body>
	<br />
	
	<table>
        <tr valign="center">
	        <td width="100"><label>Nomer</label></td>
	        <td width="20"></td>
	        <td width="300"><?php echo $reject[0]->NOMER; ?></td>
        </tr>
        <tr valign="center">
          	<td width="100"><label>Tanggal</label></td>
          	<td width="20"></td>
          	<td width="300"><?php echo $reject[0]->TANGGAL; ?></td>
        </tr>
        <tr valign="center">
          	<td width="100"><label>Nomer PO</label></td>
          	<td width="20"></td>
          	<td width="300"><?php echo $reject[0]->NOMER_PO; ?></td>
        </tr>
	</table>

	<br />

	<table border="1" id="tblDetailReject">
      	<tr align="center" height="30">
        	<td width="50"><b>No</b></td>
        	<td width="150"><b>Barcode</b></td>
        	<td width="150"><b>Nomer SP</b></td>
        	<td width="75"><b>Qty</b></td>
        	<td width="75"><b>Satuan</b></td>
        	<td width="150"><b>Nomer Test QC</b></td>
      	</tr>

      	<?php 
      	$xxx = 0;
      	foreach($reject as $row){ ?>
            <tr>
                <td align="center"><?php $xxx++; echo $xxx; ?></td>
                <td align="center"><?php echo $row->BARCODE; ?></td>
                <td align="center"><?php echo $row->NO_SP; ?></td>
                <td align="center"><?php echo $row->QTY_TERIMA; ?></td>
                <td align="center"><?php echo $row->SATUAN; ?></td>
                <td align="center"><?php echo $row->NOMER_QC; ?></td>
            </tr>
        <?php } ?>

    </table>

		<div style="text-align:center;page-break-before: always;">
		<br />
			
		<?php  
			// print_r($hasil_test[0]);
			foreach ($hasil_test as $key) {
				echo "<b><font size='4'>Nomer Test : ".$key[0]->NOMER_TEST. "</font></b><br />"; 

				// print_r($key);
				echo "<table border='1' align='center'>
						<tr>
							<th width=200>Test</th>
							<th width=100>Jenis</th>
							<th width=300>Hasil</th>
						</tr>";
				foreach ($key as $yyy) {
					// print_r($yyy->ID_DETAIL_TERIMA ." ".$yyy->TEST_DESCRIPTION." ---------- ".$yyy->JENIS." ---------- ".$yyy->HASIL."<br>");
					echo 	"<tr align='center'>
								<td>".$yyy->TEST_DESCRIPTION."</td>
								<td>".$yyy->JENIS."</td>
								<td>".$yyy->HASIL."</td>
							</tr>";
				}
				echo "</table><br /><br />";
			}
		?>
		</div>

	<script type="text/javascript">
        window.print();

  //       $("#btnExport").click(function(e) {
  // 			let file = new Blob([$('.divclass').html()], {type:"application/vnd.ms-excel"});
		// 	let url = URL.createObjectURL(file);
		// 	let a = $("<a />", {
  // 			href: url,
  // 			download: "filename.xls"}).appendTo("body").get(0).click();
  // 			e.preventDefault();
		// });
    </script>

</body>
</html>