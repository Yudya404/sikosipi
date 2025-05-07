<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Review Permintaan</strong>
                    </div>
                    <?php foreach ($aksi as $item) { ?>
                        <div class="card-body card-block">
                                <div class="alert alert-danger" role="alert">
                                    <i class="fa fa-info-circle"></i><b> Jika anda ingin menghapus transaksi setoran ini maka: </b><br>
                                    1. Saldo pada simpanan wajib anggota akan berkurang sesuai dengan transaksi yang dihapus. <br>
                                    2. Penghapusan transaksi ini akan diverifikasi admin terlebih dahulu. <br>
                                </div>
								<form method="POST" action="<?= base_url() ?>simpanan/prosesVerifikasiHapusSetoran">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
                                            <div class="col-6"><label><?= $item['nama_anggota'] ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Jumlah Simpanan Wajib :</label></div>
                                            <div class="col-6"><label>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Jumlah Simpanan Pokok :</label></div>
                                            <div class="col-6"><label>Rp <?= number_format($item['jumlah_simpanan_pokok'], 0, ',', '.') ?></label></div>
                                        </div>
                                        <div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Jumlah setoran :</label></div>
                                            <div class="col-6"><label>Rp <?= number_format($item['jumlah_setor_tunai'], 0, ',', '.') ?></label></div>
                                        </div>
                                        <div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tanggal Transaksi :</label></div>
                                            <div class="col-6"><label><?= formatTanggal($item['tanggal_setor_tunai']) ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Pegawai Yang Request :</label></div>
                                            <div class="col-6"><label><?= $item['nama_pegawai'] ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tanggal Permintaan :</label></div>
                                            <div class="col-6"><label><?= formatTanggal($item['tanggal_aksi']) ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Alasan :</label></div>
                                            <div class="col-6"><label><?= $item['pesan_aksi'] ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Status Permintaan :</label></div>
                                            <div class="col-6">
                                                <label>
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
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-4"><label for="file-input" class="form-control-label">Verifikasi Admin :</label></div>
                                            <div class="col-8">
                                                <input type="hidden" name="id_aksi" value="<?= $item['id_aksi'] ?>">
                                                <select class="form-control" name="status_verifikasi" id="status_verifikasi" required onchange="togglePesanAdminHapusSetoran()">
                                                    <option value="<?= $item['status_verifikasi'] ?>" disabled selected><?= $item['status_verifikasi'] ?></option>
                                                    <option value="Diterima">Diterima</option>
                                                    <option value="Ditolak"><b style="color:red">Ditolak</b></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group" id="pesan-container" style="display: none;">
                                            <div class="col col-md-4"><label for="file-input" class="form-control-label">Pesan :</label></div>
                                            <div class="col-8">
                                                <textarea name="pesan_admin" id="textarea-input" rows="3" placeholder="Pesan (wajib diisi jika ditolak)" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="<?= base_url() ?>simpanan/daftarAksiPenghapusanSetoran" class="btn btn-primary btn-sm">
                                            <i class="fa fa-arrow-left"></i> Kembali
                                        </a>
                                        <button class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Memverifikasi Permintaan Hapus Simpanan Wajib ?')">
                                            <i class="fa fa-check"></i> Verifikasi
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