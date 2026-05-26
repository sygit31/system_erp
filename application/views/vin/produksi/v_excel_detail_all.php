<?php


header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=detail_all_mutasi.xls");//ganti nama sesuai keperluan
header("Pragma: no-cache");
header("Expires: 0");
?>
<h4>PT PURA NUSAPERSADA Unit Holografi</h4><br>
<center><h3>Data PET Excel  </h3></center><br>
<?php
if( $data_mutasi[0]->TANDA == 'NON SEMUA')
{
?>
<h5><center><?php echo $data_mutasi[0]->DARI.' ke '.$data_mutasi[0]->KE; ?></center></h5>
<?php
}
else
{
?>
<h5><center>SEMUA PROSES</center></h5>
<?php
}
?>


<table width="100%" border="1" cellpadding="5" cellspacing="0">
                        <thead>
                            <tr>
                               <th>No</th>
							   <th>Seri</th>
				               <th>Tanggal Mutasi</th>
				               <th>Nomor Mutasi</th>
							   <th>KK</th>
							   <th>Dari</th>
							   <th>Ke</th>
							   <th>Nama</th>
							   <th>Kode Roll</th>
				               <th>Shift</th>
							   <th>Panjang Meter</th>
                            </tr>
                        </thead>
                        
						<?php
						$no=1; 
						$i=0;
						$tes=0;
						foreach($data_mutasi as $row)
				       { 
						echo '<tr>
						<td>'.$no.'</td>';
						echo '<td>'.$row->SERI.'</td>';
					    echo '<td>'.$row->TGL.'</td>';
						echo '<td>'.$row->NMR.'</td>';
						echo '<td>'.$row->KK.'</td>';
                        echo '<td>'.$row->DARI.'</td>';
                        echo '<td>'.$row->KE.'</td>';
						echo '<td>'.$row->NAMA.'</td>';
                        echo '<td>'.$row->KODE.'</td>';
                        echo '<td>'.$row->SHIFT.'</td>';
                        echo '<td>'.$row->HASIL.'</td>';
						echo '</tr>';
					    $no++;	
						$tes +=$row->HASIL;
						$i++;
					   }
					  
				       ?>	
                       	<tr>
                            <td colspan='10'>Total</td>
                            <td><center><?php echo $tes; ?></center></td>
						</tr>

                    </table>
                 