<?php


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=data_mutasi_pet.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<h4>PT PURA NUSAPERSADA Unit Holografi</h4><br>
<center><h3>Data Mutasi PET  </h3></center><br>

<h5><center><?php echo $data_mutasi[0]->DARI.' ke '.$data_mutasi[0]->KE; ?></center></h5>


<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tbody>
                        <tr>                        
						  <td width='20%'></td>
						   <td width='10%'></td>
						  <td width='70%'> &nbsp; </td>
					  </tr>
                         <tr>
                          
                            <td width='20%'>No. Mutasi</td>
							 <td width='10%'>:</td>
                            <td width='70%'><?php echo $data_mutasi[0]->NOMOR_MUTASI; ?></td>
                        </tr>
                        <tr>
                            <td width='20%'>Tanggal</td>
                            <td width='10%'>:</td>
							<td width='70%'><?php echo $data_mutasi[0]->TGL; ?></td>
                        </tr>
                        <tr>
                            <td width='20%'>Seri</td>
                            <td width='10%'>:</td>
							<td width='70%'><?php echo $data_mutasi[0]->SERI;?></td>
                        </tr>
                        <tr>
                            <td width='20%'>KK</td>
                            <td width='10%'>:</td>
							<td width='70%'><?php echo $data_mutasi[0]->KK; ?></td>
                        </tr>
						<tr>
                            <td width='20%'>&nbsp;</td>
                            <td width='10%'>&nbsp;</td>
							<td width='70%'>&nbsp;</td>
                        </tr>
						
</tbody>
</table>

<table width="100%" border="1" cellpadding="5" cellspacing="0">
                        <thead>
                            <tr>
                               <th>No</th>
				               <th>Shift</th>
				               <th>Kode Roll</th>
				               <th>Panjang(MTR)</th>
                            </tr>
                        </thead>
                        
						<?php
						$no=1; 
						$i=0;
						$hasil=0;
						foreach($data_mutasi as $row)
				       { 
						echo '<tr>
						<td>'.$no.'</td>';
						echo '<td>'.$row->SHIFT.'</td>';
					    echo '<td>'.$row->KODE.'</td>';
						echo '<td>'.$row->HASIL.'</td></tr>';
					    $no++;	
						$hasil +=$row->HASIL;
						$i++;
					   }
				       ?>	
                       	<tr>
                            <td colspan='3'>Total</td>
                            <td><center><?php echo $hasil; ?></center></td>
						</tr>

                    </table>
                 