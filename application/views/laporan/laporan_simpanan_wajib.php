<p align="center">
    <b>LAPORAN PEMBAYARAN SETORAN SIMPANAN WAJIB ANGGOTA</b>
</p>
<table>
    <tr>
        <th>No</th>
        <th>Nama Anggota</th>
        <th>Nama Teller</th>
        <th>Jumlah Transaksi</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php
    $no = 1;
    $total_setor_tunai = 0;
    foreach ($simpanan_detail as $item) {
        if ($item['jumlah_setor_tunai'] == 0) {
            continue; // Skip if jumlah_setor_tunai is 0
        }
        $total_setor_tunai += $item['jumlah_setor_tunai'];
    ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['nama_anggota'] ?></td>
            <td><?= $item['nama_pegawai'] ?></td>
            <td>Rp. <?= number_format($item['jumlah_setor_tunai'], 0, ',', '.') ?></td>
            <td><?= formatTanggal($item['tanggal_setor_tunai']) ?></td>
        </tr>
    <?php
        $no++;
    } ?>
    <tr>
        <th colspan="3">Total Simpanan Wajib :</th>
        <th>Rp. <?= number_format($total_setor_tunai, 0, ',', '.') ?></th>
        <th></th>
    </tr>
</table>