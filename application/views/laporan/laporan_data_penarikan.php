<p align="center">
    <b>LAPORAN PENARIKAN DANA SIMPANAN ANGGOTA</b>
</p>
<table>
    <tr>
		<th>No</th>
		<th>Nama Anggota</th>
		<th>Tanggal Pengajuan</th>
		<th>Total Dana Yang Ditarik</th>
		<th>Status Penarikan</th>
	</tr>
    <?php
    $no = 1;
    foreach ($data_penarikan as $item) {
    ?>
        <tr>
			<td><?= $no ?></td>
            <td><?= $item['nama_anggota'] ?></td>
			<td><?= formatTanggal($item['tanggal_permintaan_penarikan']) ?></td>
			<td>Rp <?= number_format($item['nominal_total_penarikan'], 0, ',', '.') ?></td>
			<td>
				<?php
					$status_class = '';
					switch ($item['status_penarikan']) {
					case 'Berhasil':
					$status_class = 'badge-success';
					break;
					case 'Ditolak':
					$status_class = 'badge-danger';
					break;
					default:
					$status_class = 'badge-secondary';
					break;
				}
				?>
				<span class="badge <?= $status_class ?>"><?= $item['status_penarikan'] ?></span>
			</td>
		</tr>
    <?php
		$no++;
	} ?>
</table>
