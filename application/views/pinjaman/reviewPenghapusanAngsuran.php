<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Review Permintaan Hapus Angsuran</strong>
                    </div>
                    <?php
                    foreach ($aksi as $item) {
                    ?>
                        <div class="card-body card-block">
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-info-circle"></i><b> Jika anda ingin menghapus transaksi Angsuran ini maka: </b><br>
                                1. Angsuran yang diinputkan akan hilang. <br>
                                2. Penghapusan transaksi ini akan diverifikasi admin terlebih dahulu. <br>
                            </div>
                            <div class="row">
                                <!-- Kolom Kiri -->
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Anggota : </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Pegawai : </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_pegawai'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Jumlah Pinjaman : </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['total_pinjaman'] ?></label></div>
                                    </div>
                                    <div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Jumlah Angsuran : </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['angsuran_pembayaran'] ?></label></div>
                                    </div>
									<div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tanggal Transaksi : </label></div>
                                        <div class="col-12 col-md-6"><label><?= formatTanggal($item['tanggal_angsuran']) ?></label></div>
                                    </div>
                                </div>
                                <!-- Kolom Kanan -->
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Admin: </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_pegawai'] ?></label></div>
                                    </div>
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Status Permintaan :</label></div>
										<div class="col-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['status_aksi']) {
														case 'Sudah Diverifikasi':
															$status_class = 'badge-success';
															break;
														case 'Sedang Diverifikasi':
														case 'Sedang Diverifikasi':
															$status_class = 'badge-warning';
															break;
														default:
															$status_class = 'badge-secondary';
															break;
													}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['status_aksi'] ?></span>
											</label>
										</div>
									</div>
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Status Verifikasi :</label></div>
										<div class="col-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_verifikasi']) {
													case 'Diterima Admin':
														$status_class = 'badge-success';
														break;
													case 'Pending':
														$status_class = 'badge-warning';
														break;
													default:
														$status_class = 'badge-secondary';
														break;
												}
												?>
											<span class="badge <?= $status_class ?>"><?= $item['status_verifikasi'] ?></span>
											</label>
										</div>
									</div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Alasan : </label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['pesan_aksi'] ?></label></div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
								<div class="col-md-12 text-center">
									<div class="form-group">
										<a href="<?= base_url() ?>pinjaman/terimaAksiPenghapusanAngsuran/<?= $item['id_aksi'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Menghapus Angsuran Ini?')">
											<i class="fa fa-check-circle-o"></i> Terima
										</a>
										<a href="<?= base_url() ?>pinjaman/tolakAksiPenghapusanAngsuran/<?= $item['id_aksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin Menolak Request Penghapusan Angsuran ini?')">
											<i class="fa fa-times"></i> Tolak
										</a>
									</div>
								</div>
								<div class="col-md-12 text-center">	
									<a href="<?= base_url() ?>pinjaman/daftarAksiPenghapusanAngsuran" class="btn btn-primary btn-sm">
										<i class="fa fa-arrow-left"></i> Kembali
									</a>
								</div>
							</div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
