<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Detail Pengajuan Penarikan Simpanan</strong>
                    </div>
                    <?php foreach ($simpanan as $item) { ?>
                        <div class="card-body card-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
                                        <div class="col col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tanggal Keanggotaan :</label></div>
                                        <div class="col-6"><label><?= $item['tanggal_keanggotaan'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Tanggal Pengajuan :</label></div>
                                        <div class="col col-md-6"><label><?= date("d-m-Y", strtotime($item['tanggal_permintaan_penarikan'])) ?></label></div>
                                    </div>
									 <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Jumlah Penarikan :</label></div>
                                        <div class="col col-md-6"><label>Rp <?= number_format($item['nominal_total_penarikan'], 0, ',', '.') ?></label></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Status Penarikan :</label></div>
                                        <div class="col col-md-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['status_penarikan']) {
														case 'Sudah Diverifikasi':
															$status_class = 'badge-success';
															break;
														case 'Sedang Diverifikasi':
															$status_class = 'badge-warning';
															break;
														default:
															$status_class = 'badge-secondary';
															break;
													}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['status_penarikan'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Verifikasi Pegawai :</label></div>
                                        <div class="col col-md-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['verifikasi_pegawai']) {
														case 'Verifikasi Diterima':
															$status_class = 'badge-success';
															break;
														case 'Verifikasi Ditolak':
															$status_class = 'badge-danger';
															break;
														default:
															$status_class = 'badge-secondary';
															break;
													}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['verifikasi_pegawai'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Verifikasi Admin : </label></div>
                                        <div class="col-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['verifikasi_admin']) {
														case 'Verifikasi Diterima':
															$status_class = 'badge-success';
															break;
														case 'Verifikasi Ditolak':
															$status_class = 'badge-danger';
															break;
														default:
															$status_class = 'badge-secondary';
															break;
													}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['verifikasi_admin'] ?></span>
											</label>
										</div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-3"><label for="file-input" class="form-control-label">Pesan :</label></div>
                                        <div class="col col-md-9"><span style="white-space: pre-line"><?= $item['pesan']; ?></span></div>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-12 text-center">
								<a href="<?= base_url() ?>simpanan/dataAksiPenarikan" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
							</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>