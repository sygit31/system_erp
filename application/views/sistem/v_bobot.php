
<?php $brs=0; ?>
<?php foreach ($show_bobot->result_array() as $dt):
    $brs++;
    ${'lev' . $brs . '1'} = $dt['NILAI1'];
    ${'lev' . $brs . '2'} = $dt['NILAI2'];
    ${'lev' . $brs . '3'} = $dt['NILAI3'];
    ${'lev' . $brs . '4'} = $dt['NILAI4'];
endforeach; ?>
<table id="table-bobot" class="table table-dark" style="width: 98%; margin-left: 5px;">
    <thead align="center">
    <tr>
        <td width="19%"></td>
        <td width="27%">Sangat Tinggi</td>
        <td width="27%">Tinggi</td>
        <td width="27%">Sedang</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Target 1</td>
        <td><input type="text" id="st1" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev11; ?>" style="width: 100%; text-align: center;" tabindex="1"></td>
        <td><input type="text" id="t1" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev21; ?>" style="width: 100%; text-align: center;" tabindex="2"></td>
        <td><input type="text" id="s1" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev31; ?>" style="width: 100%; text-align: center;" tabindex="3"></td>
    </tr>
    <tr>
        <td>Target 2</td>
        <td><input type="text" id="st2" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev12; ?>" style="width: 100%; text-align: center;" tabindex="4"></td>
        <td><input type="text" id="t2" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev22; ?>" style="width: 100%; text-align: center;" tabindex="5"></td>
        <td><input type="text" id="s2" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev32; ?>" style="width: 100%; text-align: center;" tabindex="6"></td>
    </tr>
    <tr>
        <td>Target 3</td>
        <td><input type="text" id="st3" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev13; ?>" style="width: 100%; text-align: center;" tabindex="7"></td>
        <td><input type="text" id="t3" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev23; ?>" style="width: 100%; text-align: center;" tabindex="8"></td>
        <td><input type="text" id="s3" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev33; ?>" style="width: 100%; text-align: center;" tabindex="9"></td>
    </tr>
    <tr>
        <td>Failed</td>
        <td><input type="text" id="st4" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev14; ?>" style="width: 100%; text-align: center;" tabindex="10"></td>
        <td><input type="text" id="t4" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev24; ?>" style="width: 100%; text-align: center;" tabindex="11"></td>
        <td><input type="text" id="s4" class="form-control" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.-]/g, '');" value="<?php echo $lev34; ?>" style="width: 100%; text-align: center;" tabindex="12"></td>
    </tr>
    </tbody>
</table>