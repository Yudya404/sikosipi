<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Verifikasi Pengajuan Pinjaman</strong>
                    </div>
                    <?php foreach ($pinjaman as $item) { ?>
                        <div class="card-body card-block">
                            <form method="POST" action="<?= base_url() ?>pinjaman/prosesVerifikasiPinjamanByAdmin">
                                <div class="row">
                                    <!-- Kolom Kiri -->
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
                                            <div class="col-12 col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Jumlah Pengajuan :</label></div>
                                            <div class="col-12 col-md-6">
												<input type="text" id="total_pengajuan_pinjaman" name="total_pengajuan_pinjaman" value="Rp <?= number_format($item['total_pengajuan_pinjaman'], 0, ',', '.') ?>" class="form-control" readonly>
											</div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Jumlah Angsuran :</label></div>
                                            <div class="col-12 col-md-6">
												<input type="text" id="jml_angsuran_perbulan" name="jml_angsuran_perbulan" value="<?= $item['jml_angsuran_perbulan'] ?>" class="form-control" readonly>
											</div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tempo Pembayaran :</label></div>
                                            <div class="col-12 col-md-6"><label><?= $item['jml_tempo_angsuran'] ?> /Bulan</label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Tanggal Pengajuan :</label></div>
                                            <div class="col-12 col-md-6"><label><?= formatTanggal($item['tanggal_pengajuan']) ?></label></div>
                                        </div>
                                    </div>
                                    <!-- Kolom Kanan -->
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-4"><label for="textarea-input" class="form-control-label">Alasan Pengajuan :</label></div>
                                            <div class="col-12 col-md-8"><label><?= $item['alasan_pinjaman'] ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Status Pengajuan :</label></div>
                                            <div class="col-12 col-md-6">
                                                <label>
                                                    <?php
                                                    $status_class = '';
                                                    switch ($item['status_pengajuan']) {
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
                                                    <span class="badge <?= $status_class ?>"><?= $item['status_pengajuan'] ?></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Verifikasi Pegawai :</label></div>
                                            <div class="col-12 col-md-6">
                                                <label>
                                                    <?php
                                                    $status_class = '';
                                                    switch ($item['verifikasi_pegawai']) {
                                                        case 'Diterima':
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
                                                    <span class="badge <?= $status_class ?>"><?= $item['verifikasi_pegawai'] ?></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="file-input" class="form-control-label">Verifikasi Admin :</label></div>
                                            <div class="col-12 col-md-6">
                                                <input type="hidden" name="id_pengajuan" value="<?= $item['id_pengajuan'] ?>">
                                                <input type="hidden" name="id_anggota" value="<?= $item['id_anggota'] ?>">
                                                <select class="form-control" name="verifikasi_admin" id="verifikasi_admin" required onchange="togglePesanAdmin()">
                                                    <option value="<?= $item['verifikasi_admin'] ?>" disabled selected><?= $item['verifikasi_admin'] ?></option>
                                                    <option value="Diterima">Diterima</option>
                                                    <option value="Ditolak">Ditolak</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="pesan-container" style="display: none;">
                                            <div class="col col-md-3"><label for="file-input" class="form-control-label">Pesan :</label></div>
                                            <div class="col-12 col-md-9">
                                                <textarea name="pesan" id="textarea-input" rows="2" placeholder="Pesan (wajib diisi jika ditolak)" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="<?= base_url() ?>pegawai/daftarPengajuanPinjaman" class="btn btn-primary btn-sm">
                                            <i class="fa fa-arrow-left"></i> Kembali
                                        </a>
                                        <button class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Verifikasi Pengajuan ?')">
                                            <i class="fa fa-edit"></i> Verifikasi
                                        </button>                        
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>