<p align="center">
    <b>NOTA PEMBAYARAN SETORAN SIMPANAN WAJIB</b>
</p>
<table>
    <tr>
        <th>Nama Anggota</th>
        <th>Nama Teller</th>
        <th>Jumlah Setoran</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php
    $total_setor_tunai = 0;
    foreach ($simpanan_detail as $item) {
        $total_setor_tunai += $item['jumlah_setor_tunai'];
    ?>
        <tr>
            <td><?= $item['nama_anggota'] ?></td>
            <td><?= $item['nama_pegawai'] ?></td>
            <td>Rp. <?= number_format($item['jumlah_setor_tunai'], 0, ',', '.') ?></td>
            <td><?= formatTanggal($item['tanggal_setor_tunai']) ?></td>
        </tr>
    <?php } ?>
    <tr>
        <th colspan="2">Total Setoran :</th>
        <th>Rp. <?= number_format($total_setor_tunai, 0, ',', '.') ?></th>
        <th></th>
    </tr>
</table>
