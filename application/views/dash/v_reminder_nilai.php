<table id="tbl_nilai" class="table table-bordered table-striped" width="100%">
    <thead>
        <tr align="center">
            <th>No.</th>
            <th>NIK</th>
            <th>Nama Karyawan</th>
            <th hidden>Jabatan</th>
            <th>Bagian</th>
            <th>Nilai</th>
            <th>Reward</th>
            <th>Total</th>
            <th>Kategori Skor</th>
            <th>Kategori Kurva</th>
            <th>HR</th>
            <th>IS</th>
            <th>K3</th>
            <th>Atasan Langsung</th>
            <th>Manaj.</th>
            <th>Kolega</th>
            <th>Kolega I</th>
            <th>Kolega II</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<?php $date = date('my'); ?>

<script>

// Resize Dokumen
$(window).resize(function() {
    pagination_nilai();
});

// Pagination
function pagination_nilai() {
    $('#tbl_nilai').DataTable().destroy();
    var screen = $(window).height() * 65/100;
    var tbl_nilai = $('#tbl_nilai').DataTable( {
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "order": [[ 0, "asc" ]],
        "info": false,
        "autoWidth": true,
        "scrollX": true,
        "scrollY": screen
    });

    var scroll_body = $('.dataTables_scrollBody')[0];
    setTimeout(function() {
        tbl_nilai.columns.adjust().draw();
        setInterval(function() {
            if (scroll_body.scrollTop + scroll_body.clientHeight >= scroll_body.scrollHeight) {
                setTimeout(function() {scroll_body.scrollTop = 0;}, 2000);
            }else{
                scroll_body.scrollTop = scroll_body.scrollTop + 2;
            }
        },50);
    }, 100);
}

// Penilaian
function format_date() {
    var periode = <?php echo json_encode($date); ?>;
    var month = periode.substring(0,2)-2;
    var year = periode.substring(2,4);
    var dt_month = ["Jan", "Peb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agt", "Sep", "Okt", "Nop", "Des"];
    var month = dt_month[month];

    return month + '-' + year;
}

// Get Data
function get_nilai() {
    var periode = format_date();

    $.ajax({
        type: 'POST',
        url:'<?php echo base_url(); ?>index.php/sistem/ploting/get_data',
        data: {data: periode},
        success: function(data) {
            data = JSON.parse(data);
            isi_nilai(data);
            pagination_nilai();
        }
    });
}

// Isi Data
function isi_nilai(data) {

    // Hapus data sementara
    $("#tbl_nilai tbody").find("tr").remove();

    // Ambil data dari database dan simpan sementara ke array
    var id_karyawan = '', baris = 0;
    var arr_id = [], arr_nik = [], arr_nama = [], arr_jabatan = [], arr_bagian = [], arr_gaji = [], arr_reward = [];
    var arr_data = [];

    for (var i=0; i<data.length; i++) {        
        if (id_karyawan != data[i]['ID_KARYAWAN']) {
            arr_id[baris] = data[i]['ID_KARYAWAN'];
            arr_nik[baris] = data[i]['NIK'];
            arr_nama[baris] = data[i]['NAMA'];
            arr_jabatan[baris] = data[i]['JABATAN'];
            arr_bagian[baris] = data[i]['BAGIAN'];
            arr_gaji[baris] = data[i]['GAJI'];
            arr_reward[baris] = Number(data[i]['REWARD']) + Number(data[i]['N_JABATAN']) + Number(data[i]['N_PLUS']);

            baris = baris + 1;
        }
        id_karyawan = data[i]['ID_KARYAWAN'];
    }

    // Isi table dengan data dari array sementara
    for (var i=0; i<baris; i++) {
        n_hr = 0, n_is = 0, n_k3 = 0, n_al = 0, n_mj = 0, n_kl = 0, n_kl1 = 0, n_kl2 = 0;
        for (var j=0; j<data.length; j++) {  
            if (data[j]['ID_KARYAWAN'] == arr_id[i]) {       
                if (data[j]['KATEGORI'] == 'HR') {
                    n_hr = (Number(n_hr) + Number(data[j]['NILAI'])).toFixed(2);
                }           
                if (data[j]['KATEGORI'] == 'IS') {
                    n_is = (Number(n_is) + Number(data[j]['NILAI'])).toFixed(2);
                }           
                if (data[j]['KATEGORI'] == 'K3') {
                    n_k3 = (Number(n_k3) + Number(data[j]['NILAI'])).toFixed(2);
                }         
                if (data[j]['KATEGORI'] == 'Atasan Langsung') {
                    n_al = (Number(n_al) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Manajemen') {
                    n_mj = (Number(n_mj) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega') {
                    n_kl = (Number(n_kl) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega 1') {
                    n_kl1 = (Number(n_kl1) + Number(data[j]['NILAI'])).toFixed(2);
                }
                if (data[j]['KATEGORI'] == 'Kolega 2') {
                    n_kl2 = (Number(n_kl2) + Number(data[j]['NILAI'])).toFixed(2);
                }
            }
        }
        if (n_hr == 0) {n_hr = '';}
        if (n_is == 0) {n_is = '';}
        if (n_k3 == 0) {n_k3 = '';}
        if (n_al == 0) {n_al = '';}
        if (n_mj == 0) {n_mj = '';}
        if (n_kl == 0) {n_kl = '';}
        if (n_kl1 == 0) {n_kl1 = '';}
        if (n_kl2 == 0) {n_kl2 = '';}

        kategori = isi_kategori(n_hr,n_is,n_k3,n_al,n_mj,n_kl,n_kl1,n_kl2,arr_reward[i]);

        arr_data.push([Number(kategori[3]),arr_nik[i],arr_nama[i],arr_jabatan[i],arr_bagian[i],n_hr,n_is,n_k3,n_al,n_mj,n_kl,n_kl1,n_kl2,kategori[1],arr_gaji[i],kategori[2],kategori[0]]);
    }

    arr_data.sort(function(a,b) {
        return b[0] - a[0];
    });

    // Isi kategori kurva normal
    var ks = Math.round(10/100 * baris);
    var k = Math.round(20/100 * baris);
    var b = Math.round(20/100 * baris);
    var bs = Math.round(10/100 * baris);
    var c = baris - ks - k - b - bs;
    var qty_potong_premi = Math.round(2.5/100 * baris);
    var i=0;

    arr_data.forEach(function(e) {
        i=i+1;

        if ((i)<=bs) {
            kurva = 'BS';
        }else if ((i)<=(bs+b)) {
            kurva = 'B';
        }else if ((i)<=(bs+b+c)) {
            kurva = 'C';
        }else if ((i)<=(bs+b+c+k)) {
            kurva = 'K';
        }else if ((i)<=(bs+b+c+k+ks)) {
            kurva = 'KS';
        }

        color_potong_premi = '';
        if (i>(baris-qty_potong_premi)) {
            color_potong_premi = "#FFB2B2";
        }

        color_belum_lengkap = '';
        qty_nilai = [e[5],e[6],e[7],e[8],e[9],e[10],e[11],e[12]];
        empties = qty_nilai.length - qty_nilai.filter(String).length;
        if (empties>2) {color_belum_lengkap = "#F80404";}
        
        nik = e[1];
        nama = e[2];
        jabatan = e[3];
        bagian = e[4];
        hr = e[5];
        nis = e[6];
        k3 = e[7];
        al = e[8];
        mg = e[9];
        kl = e[10];
        kl1 = e[11];
        kl2 = e[12];
        nilai = e[16];
        reward = e[15];
        total = e[0].toFixed(2);
        kategori = e[13];
        gaji = formatNumber(e[14]);

        $('#tbl_nilai').append('<tr style="background-color:' + color_potong_premi + ';"><td align="center">' + i + '</td><td align="center">' + nik + '</td><td style="color:' + color_belum_lengkap + ';">' + nama + '</td><td hidden>' + jabatan + '</td><td>' + bagian + '</td><td align="center">' + nilai + '</td><td align="center">' + reward + '</td><td align="center" style="font-weight: bold;">' + total + '</td><td align="center">' + kategori + '</td><td align="center">' + kurva + '</td><td align="center">' + hr + '</td><td align="center">' + nis + '</td><td align="center">' + k3 + '</td><td align="center">' + al + '</td><td align="center">' + mg + '</td><td align="center">' + kl + '</td><td align="center">' + kl1 + '</td><td align="center">' + kl2 + '</td></tr>')
    });

    function formatNumber(num) {
        if (num == null) {
            return '';
        }else{
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        }
    }
}

// Kategori Nilai
function isi_kategori(n_hr,n_is,n_k3,n_al,n_mj,n_kl,n_kl1,n_kl2,n_reward) {
    pal = ((100/75)*40)/100;
    pmj = ((100/75)*20)/100;
    pkl = ((100/75)*15)/100;
    pkl1 = ((100/75)*20)/100;
    pkl2 = ((100/75)*15)/100;

    hrisk3 = ((Number(n_hr)+Number(n_is)+Number(n_k3))/3).toFixed(2);
    nilai_total = Number(n_al*pal) + Number(n_mj*pmj) + Number(n_kl*pkl) + Number(n_kl1*pkl1) + Number(n_kl2*pkl2);
    nilai = ((hrisk3*25/100)+(nilai_total*75/100)).toFixed(2);
    if (n_reward == null || n_reward == 0) {
        nilai_rew = '';
        n_total = Number(nilai).toFixed(2);
    }else{
        nilai_rew = Number(n_reward).toFixed(2);
        n_total = (Number(nilai) + Number(n_reward)).toFixed(2);
        if (n_total > 5) {n_total = 5;}
    }

    // Kategori Nilai
    if (n_total <= 2.6) {
        kategori = 'KS';
    }else if(n_total <= 3.3) {
        kategori = 'K';
    }else if(n_total <= 3.9) {
        kategori = 'C';
    }else if(n_total <= 4.4) {
        kategori = 'B';
    }else if(n_total > 4.4) {
        kategori = 'BS';
    }else{
        kategori = '';
    }

    return [nilai,kategori,nilai_rew,n_total];
}

</script>