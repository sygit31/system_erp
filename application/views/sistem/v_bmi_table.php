<table id="data-table" class="table table-bordered table-striped" width="100%">
	<thead>
		<tr align="center" style="font-weight: bold;">
			<td hidden>Id Karyawan</td>
			<td hidden>Id BMI</td>
			<td width="5%">No.</td>
			<td width="8.5%">Periode</td>
			<td width="18.5%">Nama Karyawan</td>
			<td width="8.5%">Bagian</td>
			<td width="8.5%">Jenis Kelamin</td>
			<td width="8.5%">Tinggi Badan</td>
			<td width="8.5%">Berat Badan</td>
			<td width="8.5%">BMI</td>
			<td width="10%">Kategori</td>
			<td width="7%">Point</td>
			<td width="8.5%">Action</td>
		</tr>
	</thead>
	<tbody>
		<?php
		$urut=0;
		$dt_kategori = array('Sangat Terlalu Kurus','Terlalu Kurus Level 3','Terlalu Kurus Level 2','Terlalu Kurus Level 1','Agak Terlalu Kurus Level 3','Agak Terlalu Kurus Level 2','Agak Terlalu Kurus Level 1','Ideal Slim Level 3','Ideal Slim Level 2','Ideal Slim','Ideal Super','Ideal Jumbo','Ideal Jumbo Level 2','Ideal Jumbo Level 3','Kelebihan Berat Level 1','Kelebihan Berat Level 2','Kelebihan Berat Level 3','Kegemukan Berlebih Level 1','Kegemukan Berlebih Level 2','Kegemukan Berlebih Level 3','Sangat Kegemukan Berlebih Level 1','Sangat Kegemukan Berlebih Level 2','Sangat Kegemukan Berlebih Level 3');
		$dt_point = array('-7','-6','-5','-4','-3','-2','0','2','3','4','5','4','3','2','0','-1','-2','-3','-4','-5','-6','-7','-8');

		foreach ($bmi->result_array() as $dt):
			$id_karyawan = $dt['ID_KARYAWAN'];
			$id_bmi = $dt['ID_BMI'];
			$urut++;
			$tgl = date("M-Y");
			$nama = strtoupper($dt['NAMA_KARYAWAN']);
			$bagian = $dt['BAGIAN'];
			$jekel = $dt['JKEL'];
			if ($jekel == 'P') {$jekel = 'Pria';}else{$jekel = 'Wanita';}
			$tinggi = $dt['TINGGI'];
			$berat = $dt['BERAT'];
			$bmi = '';				
			$kategori = '';
			$point = '';

			if ($berat != '') {

				$bmi = $tinggi == 0 ? 0 : number_format(($berat - 0.7)/($tinggi * $tinggi),2);

				if ($bmi <= 16) {
					$kategori = 'Sangat Terlalu Kurus';
				}elseif($bmi <= 16.33) {
					$kategori = 'Terlalu Kurus Level 3';
				}elseif($bmi <= 16.67) {
					$kategori = 'Terlalu Kurus Level 2';
				}elseif($bmi <= 16.99) {
					$kategori = 'Terlalu Kurus Level 1';
				}elseif($bmi <= 17.55) {
					$kategori = 'Agak Terlalu Kurus Level 3';
				}elseif($bmi <= 18.01) {
					$kategori = 'Agak Terlalu Kurus Level 2';
				}elseif($bmi <= 18.5) {
					$kategori = 'Agak Terlalu Kurus Level 1';
				}elseif($bmi <= 19.34) {
					$kategori = 'Ideal Slim Level 3';
				}elseif($bmi <= 20.17) {
					$kategori = 'Ideal Slim Level 2';
				}elseif($bmi <= 21) {
					$kategori = 'Ideal Slim';
				}elseif($bmi <= 22.43) {
					$kategori = 'Ideal Super';
				}elseif($bmi <= 23.7) {
					$kategori = 'Ideal Jumbo';
				}elseif($bmi <= 24.07) {
					$kategori = 'Ideal Jumbo Level 2';
				}elseif($bmi <= 24.99) {
					$kategori = 'Ideal Jumbo Level 3';
				}elseif($bmi <= 26.66) {
					$kategori = 'Kelebihan Berat Level 1';
				}elseif($bmi <= 28.3) {
					$kategori = 'Kelebihan Berat Level 2';
				}elseif($bmi <= 29.99) {
					$kategori = 'Kelebihan Berat Level 3';
				}elseif($bmi <= 31.66) {
					$kategori = 'Kegemukan Berlebih Level 1';
				}elseif($bmi <= 33.3) {
					$kategori = 'Kegemukan Berlebih Level 2';
				}elseif($bmi <= 34.99) {
					$kategori = 'Kegemukan Berlebih Level 3';
				}elseif($bmi <= 36.66) {
					$kategori = 'Sangat Kegemukan Berlebih Level 1';
				}elseif($bmi <= 38.3) {
					$kategori = 'Sangat Kegemukan Berlebih Level 2';
				}elseif($bmi <= 40) {
					$kategori = 'Sangat Kegemukan Berlebih Level 3';
				}

				$tinggi = number_format($dt['TINGGI'],2);
				$berat = number_format($dt['BERAT'],2);

				$point = $dt_point[array_search($kategori, $dt_kategori)];
			}
			?>
			<tr>
				<td hidden><?php echo $id_karyawan; ?></td>
				<td hidden><?php echo $id_bmi; ?></td>
				<td align="center"><?php echo $urut; ?></td>
				<td align="center"><?php echo $tgl; ?></td>
				<td><?php echo ucwords(strtolower($nama)); ?></td>
				<td><?php echo ucwords(strtolower($bagian)); ?></td>
				<td align="center"><?php echo $jekel; ?></td>
				<td align="center">
					<input type="text" style="text-align: center;" class="form-control" name="tinggi" value="<?php echo $tinggi; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="4" autocomplete='off' <?php if($berat!=''){echo 'readonly';} ?>>
				</td>
				<td align="center">
					<input type="text" style="text-align: center;" class="form-control" name="berat" value="<?php echo $berat; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="6" autocomplete='off' <?php if($berat!=''){echo 'readonly';} ?>>
				</td>
				<td align="center"><?php echo $bmi; ?></td>
				<td align="center"><?php echo $kategori; ?></td>
				<td align="center"><?php echo $point; ?></td>
				<td>
					<input type="button" class="btn btn-block btn-success" name="submit" value="Submit" onclick="submit(this)" <?php if($berat!=''){echo 'hidden';} ?>>
					<input type="button" class="btn btn-block btn-warning" name="edit" value="Edit" onclick="edit(this)" <?php if($berat==''){echo 'hidden';} ?>>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>
