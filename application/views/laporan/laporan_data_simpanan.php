<p align="center">
    <b>LAPORAN DATA SIMPANAN ANGGOTA</b>
</p>
<table>
    <tr>
		<th>No</th>
        <th>Nama Anggota</th>
        <th>Tanggal Transaksi</th>
		<th>Nama Teller</th>
		<th>Jumlah Simpanan Pokok</th>
		<th>Jumlah Simpanan Wajib</th>
		<th>Total Simpanan (Pokok + Wajib)</th>
		<th>Status</th>
    </tr>
    <?php
    $no = 1;
	$total_pokok = 0;
	$total_wajib = 0;
    foreach ($data_simpanan as $item) {
       $total_pokok += $item['jumlah_simpanan_pokok'];
	   $total_wajib += $item['jumlah_simpanan_wajib'];
	   $total_simpanan = $item['jumlah_simpanan_pokok'] + $item['jumlah_simpanan_wajib'];
    ?>
        <tr>
			<td><?= $no ?></td>
			<td><?= $item['nama_anggota'] ?></td>
			<td><?= formatTanggal($item['tgl_transaksi_sp']) ?></td>
			<td><?= $item['nama_pegawai'] ?></td>
			<td>Rp <?= number_format($item['jumlah_simpanan_pokok'], 0, ',', '.') ?></td>
			<td>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></td>
			<td>Rp <?= number_format($total_simpanan, 0, ',', '.') ?></td>
			<td>
				<?php
					$status_class = '';
					switch ($item['status_simpanan']) {
					case 'Sudah Ditarik':
					$status_class = 'badge-success';
					break;
					case 'Menunggu Penarikan':
					$status_class = 'badge-warning';
					break;
					default:
					$status_class = 'badge-primary';
					break;
					}
				?>
				<span class="badge <?= $status_class ?>"><?= $item['status_simpanan'] ?></span>
			</td>
		</tr>
    <?php
		$no++;
	} ?>
    <tr>
		<th colspan="4">Total Simpanan :</th>
		<th>Rp <?= number_format($total_pokok, 0, ',', '.') ?></th>
		<th>Rp <?= number_format($total_wajib, 0, ',', '.') ?></th>
		<th>Rp <?= number_format($total_pokok + $total_wajib, 0, ',', '.') ?></th>
		<th colspan="2"></th>
	</tr>
</table>
