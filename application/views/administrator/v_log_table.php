<div class="data-table" id="data_proj">
    <table id="data-table" class="table table-bordered table-striped" width="100%">
        <thead style="text-align: center;">
            <tr>
                <th hidden>ID Log</th>
                <th width="5%">No.</th>
                <th width="25%">Nama Karyawan</th>
                <th width="15%">Bagian</th>
                <th width="15%">Jabatan</th>
                <th width="20%">Tgl. Login</th>
                <th width="20%">IP Pengguna</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $urut = 0;
            foreach ($log->result_array() as $dt):
                $urut++;
                $id_log=$dt['ID_LOG'];
                $nama=$dt['NAMA'];
                $bagian=$dt['BAGIAN'];
                $jabatan=$dt['JABATAN'];
                $tgl=$dt['TGL'];
                $ip_comp=$dt['IP_COMP'];
                ?>
                <tr>
                    <td hidden><?php echo $id_log; ?></td>
                    <td align="center"><?php echo $urut; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $bagian; ?></td>
                    <td><?php echo $jabatan; ?></td>
                    <td align="center"><?php echo $tgl; ?></td>
                    <td align="center"><?php echo $ip_comp; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>