<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
						<strong class="card-title">Daftar Riwayat Angsuran</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal Angsuran</th>
                                    <th>Jumlah Angsuran</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pinjaman as $item) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($item['tanggal_angsuran'])) ?></td>
                                        <td>Rp <?= number_format($item['angsuran_pembayaran'], 0, ',', '.') ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>pinjaman/hapusAngsuran/<?= $item['id_angsuran_detail'] ?>" class="badge badge-danger"><i class="fa fa-print"></i>Hapus</a>
                                            <a href="<?= base_url() ?>pinjaman/cetakAngsuran/<?= $item['id_angsuran_detail'] ?>" target="_blank" class="badge badge-warning"><i class="fa fa-print"></i>Cetak</a>
                                        </td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                        <a href="<?= base_url() ?>pegawai/daftarPinjaman" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->