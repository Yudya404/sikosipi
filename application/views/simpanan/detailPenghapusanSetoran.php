<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Detail Verifikasi Permintaan Hapus Simpanan Wajib</strong>
                    </div>
                    <?php foreach ($aksi as $item) { ?>
                        <div class="card-body card-block">
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-info-circle"></i><b> Jika Pengajuan Ini Bersatus Ditolak: </b><br>
                                1. Periksa Pesan Dari Admin. <br>
                                2. Ajukan Ulang Permintaan Penghapusan. <br>
                            </div>
							<form method="POST" action="<?= base_url() ?>simpanan/prosesHapusSetoran">
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
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tanggal Verifikasi :</label></div>
                                            <div class="col-6"><label><?= formatTanggal($item['tgl_acc']) ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Pesan Admin :</label></div>
                                            <div class="col-6"><label><?= $item['pesan_admin'] ?></label></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <a href="<?= base_url() ?>simpanan/daftarAksiPenghapusanSetoran" class="btn btn-primary btn-sm">
                                            <i class="fa fa-arrow-left"></i> Kembali
                                        </a>
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