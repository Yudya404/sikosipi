<?php
function tanggalIndonesia($tanggal) {
    $bulanIndo = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    
    $tanggalArray = explode('-', $tanggal);
    $tahun = $tanggalArray[0];
    $bulan = $bulanIndo[(int)$tanggalArray[1]];
    $hari = $tanggalArray[2];

    return $hari . ' ' . $bulan . ' ' . $tahun;
}

$tanggal = date('Y-m-d');
?>

<table class="table table-borderless" style="margin-top: 50px;">
    <tbody>
        <tr>
            <td style="text-align: right;">
                Bojonegoro, <?= tanggalIndonesia($tanggal) ?>
            </td>
            <td></td>
        </tr>
        <tr style="background-color: #fff;">
            <td style="text-align: right;">
                Kepala Bagian Keuangan
            </td>
            <td></td>
        </tr>
        <tr>
            <td style="text-align: right;">
                <img src="<?= base_url() ?>assets/dashboard/images/gambar/stempel.png" width="20%">
            </td>
            <td></td>
        </tr>
        <tr style="background-color: #fff;">
            <td style="text-align: right;">
                Zainal Malik
            </td>
            <td></td>
        </tr>
    </tbody>
</table>

</body>
</html>