<p align="center">
    <b>LAPORAN HAPUS PEMBAYARAN ANGSURAN PINJAMAN ANGGOTA</b>
</p>
<table>
    <tr>
		<th>No</th>
        <th>Tanggal Permintaan</th>
		<th>Nama Pegawai</th>
		<th>Nama Anggota</th>
		<th>Jumlah Angsuran</th>
    </tr>
    <?php
	$no = 1;
	$total_angsuran = 0;
    foreach ($angsuran_detail as $item) {
		// Membersihkan data dan mengubah format
		$angsuran_pembayaran_cleaned = str_replace(['Rp', ','], '', $item['angsuran_pembayaran']);
		// Konversi ke tipe data numerik (float)
		$angsuran_pembayaran_numeric = floatval($angsuran_pembayaran_cleaned);
		// Tambahkan nilai yang sudah dikonversi ke total
		$total_angsuran += $angsuran_pembayaran_numeric;
    ?>
        <tr>
			<td><?= $no ?></td>
            <td><?= formatTanggal($item['tanggal_aksi']) ?></td>
			<td><?= $item['nama_pegawai'] ?></td>
			<td><?= $item['nama_anggota'] ?></td>
			<td><?= $item['angsuran_pembayaran'] ?></td>
		</tr>
    <?php
		$no++;
	} ?>
	<tr>
		<th colspan="4">Total Pembayaran Angsuran :</th>
		<th>Rp <?= number_format($total_angsuran, 0, ',', '.') ?></th>
	</tr>
</table>
