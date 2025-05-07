<p align="center">
   <b>LAPORAN PEMBAYARAN ANGSURAN PINJAMAN ANGGOTA</b>
</p>
<table>
    <tr>
		<th>No</th>
        <th>Nama Anggota</th>
        <th>Nama Teller</th>
        <th>Jumlah Angsuran</th>
        <th>Tanggal Transaksi</th>
    </tr>
    <?php
	$no = 1;
	$total_pembayaran_angsuran = 0;
    foreach ($angsuran_detail as $item) {
		// Membersihkan data dan mengubah format
		$angsuran_pembayaran_cleaned = str_replace(['Rp', ','], '', $item['angsuran_pembayaran']);
		// Konversi ke tipe data numerik (float)
		$angsuran_pembayaran_numeric = floatval($angsuran_pembayaran_cleaned);
		// Tambahkan nilai yang sudah dikonversi ke total
		$total_pembayaran_angsuran += $angsuran_pembayaran_numeric;
    ?>
        <tr>
			<td><?= $no ?></td>
            <td><?= $item['nama_anggota'] ?></td>
            <td><?= $item['nama_pegawai'] ?></td>
            <td><?= $item['angsuran_pembayaran'] ?></td>
            <td><?= formatTanggal($item['tanggal_angsuran']) ?></td>
        </tr>
    <?php 
		$no++;
	} ?>
	<tr>
		<th colspan="3">Total Pembayaran Angsuran Pinjaman :</th>
		<th>Rp. <?= number_format($total_pembayaran_angsuran, 0, ',', '.') ?></th>
		<th></th>
	</tr>
</table>