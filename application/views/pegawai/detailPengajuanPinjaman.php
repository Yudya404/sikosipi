<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Detail Pengajuan Pinjaman</strong>
                    </div>
                    <?php foreach ($pinjaman as $item) { ?>
                        <div class="card-body card-block">
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Anggota :</label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Jumlah Pengajuan :</label></div>
                                        <div class="col-12 col-md-6"><label>Rp <?= number_format($item['total_pengajuan_pinjaman'], 0, ',', '.') ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Tanggal Pengajuan :</label></div>
                                        <div class="col-12 col-md-6"><label><?= formatTanggal($item['tanggal_pengajuan']) ?></label></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-6"><label class=" form-control-label">Lampiran Pendukung :</label></div>
                                        <div class="col-12 col-md-6"><label><a href="<?= base_url() ?>assets/datakoperasi/dokumen/<?= $item['lampiran_pendukung'] ?>" target="_blank"><i class="fa fa-external-link"></i> Tampilkan File Pendukung</a></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-4"><label for="textarea-input" class=" form-control-label">Alasan Pengajuan :</label></div>
                                        <div class="col-12 col-md-8"><label><?= $item['alasan_pinjaman'] ?></label></div>
                                    </div>
                                </div>
                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Status Pengajuan :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_pengajuan']) {
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
											<span class="badge <?= $status_class ?>"><?= $item['status_pengajuan'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Verifikasi Pegawai :</label></div>
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
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Verifikasi Admin :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['verifikasi_admin']) {
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
											<span class="badge <?= $status_class ?>"><?= $item['verifikasi_admin'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Pesan :</label></div>
                                        <div class="col-12 col-md-9"><span style="white-space: pre-line"><?= $item['pesan']; ?></span></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-12 text-center">
								<a href="<?= base_url() ?>pegawai/daftarPengajuanPinjaman" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
							</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>