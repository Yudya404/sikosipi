<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Ubah Status Pinjaman</strong>
                    </div>
                    <?php foreach ($pinjaman as $item) { ?>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
                                        <div class="col col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Tanggal Peminjaman :</label></div>
                                        <div class="col col-md-6"><label><?= formatTanggal($item['tanggal_meminjam']) ?></label></div>
                                    </div>
                                    <div class="row form-group">
										<div class="col col-md-6">
											<label for="file-input" class="form-control-label">Tanggal Pelunasan :</label>
										</div>
										<div class="col col-md-6">
											<label>
												<?= $item['tanggal_pelunasan'] == '0000-00-00' ? '-' : formatTanggal($item['tanggal_pelunasan']) ?>
											</label>
										</div>
									</div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Total Pinjaman :</label></div>
                                        <div class="col col-md-6"><label>Rp <?= number_format($item['total_pinjaman'], 0, ',', '.') ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Angsuran Bulanan :</label></div>
                                        <div class="col col-md-6"><label>Rp <?= number_format($item['angsuran_bulanan'], 0, ',', '.') ?></label></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Status Pinjaman Saat Ini :</label></div>
                                        <div class="col col-md-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['status_pinjaman']) {
														case 'Sudah Lunas':
															$status_class = 'badge-success';
															break;
														default:
															$status_class = 'badge-danger';
															break;
												}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['status_pinjaman'] ?></span>
											</label>
										</div>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="<?= base_url() ?>pegawai/prosesUbahPinjaman">
                                <?php foreach ($pinjaman as $i) { ?>
                                    <input type="hidden" name="id_pinjaman" value="<?= $i['id_pinjaman'] ?>">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label class="form-control-label">Verifikasi Pengajuan Pinjaman :</label></div>
                                        <div class="col-12 col-md-9">
                                            <select class="form-control" name="status_pinjaman" required>
                                                <option value="<?= $i['status_pinjaman'] ?>" disabled selected><?= $i['status_pinjaman'] ?></option>
                                                <option value="Sudah Lunas">Sudah Lunas</option>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
								<div class="col-md-12 text-center">
									<a href="<?= base_url() ?>pegawai/daftarPinjaman" class="btn btn-primary btn-sm">
										<i class="fa fa-arrow-left"></i> Kembali
									</a>
									<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin Mengubah Status Pinjaman ?')">
										<i class="fa fa-edit"></i> Ubah Status
									</button>
								</div>
                            </form>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
