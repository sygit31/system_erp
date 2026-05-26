<div class="data-table-akses">
    <table id="data-table-akses" class="table table-bordered table-striped" width="100%">
        <thead>
            <tr align="center">
                <th width="40%">Modul</th>
                <th width="60%">Nama Menu</th>
                <td></td>
                <td hidden>ID Menu Detail</td>
                <td hidden>ID Adm Akses</td>
                <th hidden>Akses</th>
                <th hidden>Level</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $urut = 0;
            $judul = '';
            foreach ($akses->result_array() as $dt) :
                $modul = $dt['JUDUL_MENU'];
                if ($judul == $dt['JUDUL_MENU']) {
                    $modul = '';
                }

                $judul = $dt['JUDUL_MENU'];
                $nama = $dt['NAMA_MENU'];
                $level = $dt['LEVEL_MENU'];
                $id_menu_detail = $dt['ID_MENU_DETAIL'];
                $id_adm_akses = $dt['ID_ADM_AKSES'];
                $status = $dt['STATUS'];
                if ($level == '1') {
                    $position = '5%';
                } elseif ($level == '2') {
                    $position = '15%';
                } else {
                    $position = '25%';
                }
            ?>
                <tr>
                    <td><?php echo $modul; ?></td>
                    <td style="padding-left: <?php echo $position; ?>;"><?php echo $nama; ?></td>
                    <td align="center"><input type="checkbox" class="akses" name="akses" style="cursor: pointer;" onclick="ubah_akses(this)" <?php if ($status != '0' && $status != '') {echo 'checked';} ?>></td>
                    <td hidden><?php echo $id_menu_detail; ?></td>
                    <td hidden><?php echo $id_adm_akses; ?></td>
                    <td align="center" hidden><input type="text" style="text-align: center; width: 40px;" class="form-control" name="status" value="<?php echo $status; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" maxlength="1" autocomplete='off' <?php if ($status == '0' || $status == '') {echo 'hidden';} ?>></td>
                    <td hidden><?php echo $level; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>