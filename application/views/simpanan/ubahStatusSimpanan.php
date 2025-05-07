<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Ubah Status Simpanan</strong>
                    </div>
                    <div class="card-body card-block">
                        <div class="row">
                            <!-- Kolom Kiri -->
                            <div class="col-md-6">
                                <?php foreach ($simpanan as $item) { ?>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Penyetor :</label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Jumlah Simpanan Pokok :</label></div>
                                        <div class="col-12 col-md-6"><label>Rp <?= number_format($item['jumlah_simpanan_pokok'], 0, ',', '.') ?></label></div>
                                    </div>
									 <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tanggal Transaksi :</label></div>
                                        <div class="col-12 col-md-6"><label><?= formatTanggal($item['tgl_transaksi_sp']) ?></label></div>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- Kolom Kanan -->
                            <div class="col-md-6">
                                <?php foreach ($simpanan as $item) { ?>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Jumlah Simpanan Wajib :</label></div>
                                        <div class="col-12 col-md-6"><label>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Status Simpanan Saat Ini :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_simpanan']) {
													case 'Sudah Ditarik':
														$status_class = 'badge-success';
														break;
													case 'Menunggu Penarikan':
														$status_class = 'badge-warning';
														break;
													default:
														$status_class = 'badge-secondary';
														break;
												}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['status_simpanan'] ?></span>
											</label>
										</div>
                                    </div>
                                <?php } ?>
                            </div>
							<div class="col-md-12">
								<div class="row form-group">
									<div class="col col-md-3"><label class=" form-control-label">Ubah Status :</label></div>
									<div class="col-12 col-md-9">
										<form method="POST" action="<?= base_url() ?>simpanan/prosesUbahStatusSimpanan">
											<?php foreach ($simpanan as $i) { ?>
												<input type="hidden" name="id_anggota" value="<?= $i['id_anggota'] ?>">
												<input type="hidden" name="id_simpanan" value="<?= $i['id_simpanan'] ?>">
												<select class="form-control" name="status_simpanan" required>
													<option value="<?= $i['status_simpanan'] ?>" disabled selected><?= $i['status_simpanan'] ?></option>
											<?php } ?>
													<option value="Belum Ditarik">Belum Ditarik</option>
													<option value="Menunggu Penarikan">Menunggu Penarikan</option>
													<option value="Sudah Ditarik">Sudah Ditarik</option>
												</select>
											<br>
											<div class="row form-group">
												<div class="col-md-12 text-center">
													<a href="<?= base_url() ?>simpanan/dataSimpanan" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali </a>
													<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin Mengubah Status Simpanan ?')"><i class="fa fa-edit"></i> Ubah Status</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>