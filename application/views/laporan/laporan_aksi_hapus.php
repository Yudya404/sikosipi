<p align="center">
    <b>LAPORAN HAPUS PEMBAYARAN SETORAN SIMPANAN WAJIB ANGGOTA</b>
</p>
<table>
    <tr>
		<th>No</th>
        <th>Nama Anggota</th>
        <th>Tanggal Permintaan</th>
		<th>Pegawai Yang Request</th>
		<th>Jumlah Sisa Simpanan Wajib Anggota</th>
		<th>Alasan Permintaan (By Pegawai)</th>
		<th>Status Permintaan</th>
		<th>Tanggal Diverifikasi</th>
		<th>Pesan</th>
    </tr>
    <?php
	$no = 1;
    $total_setor_tunai = 0;
    foreach ($setoran_detail as $item) {
    ?>
        <tr>
			<td><?= $no ?></td>
            <td><?= $item['nama_anggota'] ?></td>
			<td><?= formatTanggal($item['tanggal_aksi']) ?></td>			
			<td><?= $item['nama_pegawai'] ?></td>
			<td>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></td>
			<td><?= $item['pesan_aksi'] ?></td>
			<td>
				<?php
					$status_class = '';
					switch ($item['status_aksi']) {
					case 'Berhasil':
					$status_class = 'badge-success';
					break;
					case 'Ditolak':
					$status_class = 'badge-danger';
					break;
					default:
					$status_class = 'badge-warning';
					break;
				}
				?>
				<span class="badge <?= $status_class ?>"><?= $item['status_aksi'] ?></span>
			</td>
			<td><?= formatTanggal($item['tgl_acc']) ?></td>
			<td><?= $item['pesan_admin'] ?></td>
        </tr>
    <?php 
		$no++;
	} ?>
</table>
