<p align="center">
    <b>LAPORAN PENONAKTIFAN ANGGOTA</b>
</p>
<table>
    <tr>
        <th>No</th>
        <th>Nama Anggota</th>
        <th>Tanggal Permintaan</th>
        <th>Pegawai Yang Request</th>
        <th>Alasan Penonaktifan (By Pegawai)</th>
        <th>Admin Yang Memverifikasi</th>
        <th>Status Permintaan</th>
    </tr>
    <?php
    $no = 1;
    foreach ($anggota_detail as $item) {
        if ($item['status_anggota'] != 'Dinonaktifkan' || ($item['status_aksi'] != 'Berhasil' && $item['status_aksi'] != 'Ditolak')) {
            continue; // Skip if status_anggota is not 'Dinonaktifkan' or status_aksi is neither 'Berhasil' nor 'Ditolak'
        }
    ?>
        <tr>
            <td><?= $no ?></td>
            <td><?= $item['nama_anggota'] ?></td>
            <td><?= formatTanggal($item['tanggal_aksi']) ?></td>
            <td><?= $item['nama_pegawai'] ?></td>
            <td><?= $item['pesan_aksi'] ?></td>
            <td>
                <?php
                $status_class = '';
                if ($item['nama_admin'] == 'Sedang Diverifikasi') {
                    $status_class = 'badge-warning';
                    echo '<span class="badge ' . $status_class . '">' . $item['nama_admin'] . '</span>';
                } else {
                    echo $item['nama_admin'];
                }
                ?>
            </td>
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
        </tr>
    <?php
        $no++;
    } ?>
</table>