<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Review Penonaktifkan Anggota</strong>
                    </div>
                    <?php foreach ($aksi as $item) { ?>
                        <div class="card-body card-block">
                            <div class="alert alert-danger" role="alert">
                                <i class="fa fa-info-circle"></i><b> Jika anda menonaktifkan akun ini maka: </b><br>
                                1. Anggota tidak dapat melakukan transaksi apa-apa<br>
                                2. Penonaktifan akun akan diverifikasi admin terlebih dahulu.<br>
                            </div>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?= $item['nama_anggota'] ?>
												<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_anggota'] ?>">
													<i class="fa fa-external-link"></i> Detail Anggota
												</a>
											</label>
										</div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tanggal Permintaan :</label></div>
                                        <div class="col-12 col-md-6"><label><?= formatTanggal($item['tanggal_aksi']) ?></label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Pegawai Yang Request :</label></div>
                                        <div class="col-12 col-md-6"><label><?= $item['nama_pegawai'] ?></label></div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-3"><label for="file-input" class="form-control-label">Alasan :</label></div>
                                        <div class="col-12 col-md-9"><label style="white-space: pre-line;"><?= $item['pesan_aksi'] ?></label></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Admin Yang Memverifikasi :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
													$status_class = '';
													if ($item['nama_admin'] == 'Belum Diverifikasi') {
														$status_class = 'badge-secondary';
														echo '<span class="badge ' . $status_class . '">' . $item['nama_admin'] . '</span>';
													} else {
														echo $item['nama_admin'];
													}
												?>
											</label>
										</div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Status Permintaan :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_aksi']) {
													case 'Penonaktifan Diterima':
														$status_class = 'badge-success';
														break;
													case 'Penonaktifan Ditolak':
														$status_class = 'badge-danger';
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
                                    <div class="row">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Status Verifikasi :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_verifikasi']) {
													case 'Diterima Admin':
														$status_class = 'badge-success';
														break;
													case 'Ditolak Admin':
														$status_class = 'badge-danger';
														break;
													default:
														$status_class = 'badge-warning';
														break;
												}
												?>
												<span class="badge <?= $status_class ?>"><?= $item['status_verifikasi'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row">
                                        <div class="col col-md-6"><label for="file-input" class="form-control-label">Status Anggota Saat Ini :</label></div>
                                        <div class="col-12 col-md-6">
											<label>
												<?php
												$status_class = '';
												switch ($item['status_anggota']) {
													case 'Aktif':
														$status_class = 'badge-success';
														break;
													case 'Sedang Diverifikasi':
													case 'Sedang Diverifikasi (Menunggu Pembayaran Simpanan Pokok)':
														$status_class = 'badge-warning';
														break;
													default:
														$status_class = 'badge-secondary';
														break;
												}
												?>
												<span class="badge <?= $status_class ?>"><?= $item['status_anggota'] ?></span>
											</label>
										</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="<?= base_url() ?>pegawai/terimaAksiPenonaktifan/<?= $item['id_aksi'] ?>" class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Menonaktifkan Akun Ini?')"><i class="fa fa-check-circle-o"></i> Terima</a>
                                <a href="<?= base_url() ?>pegawai/tolakAksiPenonaktifan/<?= $item['id_aksi'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menolak request penonaktifan akun ini?')"><i class="fa fa-times"></i> Tolak</a><br><br>
                                <a href="<?= base_url() ?>pegawai/daftarAksiPenonaktifanAnggota" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

						<!-- Penempatan Modal di Sini -->
						<?php foreach ($aksi as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_anggota'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_anggota'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_anggota'] ?>"> Detail Anggota</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-header">
															<strong class="card-title">Detail</strong>
														</div>
														<div class="card-body card-block">
															<div class="row">
																<div class="col-md-6">
																	<!-- Kolom kiri -->
																	<div class="form-group row">
																		<label for="nik_anggota" class="col-md-4 form-control-label">NIK Anggota :</label>
																		<div class="col-md-8"><label><?= $item['nik_anggota'] ?></label></div>
																	</div>
																	<div class="form-group row">
																		<label for="nama_anggota" class="col-md-4 form-control-label">Nama Anggota :</label>
																		<div class="col-md-8"><label><?= $item['nama_anggota'] ?></label></div>
																	</div>
																	<div class="form-group row">
																		<label for="email" class="col-md-4 form-control-label">Email :</label>
																		<div class="col-md-8"><label><?= $item['email'] ?></label></div>
																	</div>
																	<div class="form-group row">
																		<label for="no_telp_anggota" class="col-md-4 form-control-label">No Telpon :</label>
																		<div class="col-md-8"><label><?= $item['no_telp_anggota'] ?></label></div>
																	</div>
																	<div class="form-group row">
																		<label for="alamat_anggota" class="col-md-4 form-control-label">Alamat Anggota :</label>
																		<div class="col-md-8"><label><?= $item['alamat_anggota'] ?></label></div>
																	</div>
																</div>
																<div class="col-md-6">
																	<!-- Kolom kanan -->
																	<div class="form-group row">
																		<label for="tanggal_keanggotaan" class="col-md-6 form-control-label">Tanggal Keanggotaan :</label>
																		<div class="col-md-6"><label><?= $item['tanggal_keanggotaan'] ?></label></div>
																	</div>
																	<div class="form-group row">
																		<label for="status_anggota" class="col-md-6 form-control-label">Status Anggota :</label>
																		<div class="col-md-6">
																			<?php
																			$status_class = '';
																			switch ($item['status_anggota']) {
																				case 'Aktif':
																					$status_class = 'badge badge-success';
																					break;
																				case 'Sedang Diverifikasi':
																				case 'Sedang Diverifikasi (Menunggu Pembayaran Simpanan Pokok)':
																					$status_class = 'badge badge-warning';
																					break;
																				default:
																					$status_class = 'badge badge-secondary';
																					break;
																			}
																			?>
																			<span class="<?= $status_class ?>"><?= $item['status_anggota'] ?></span>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="foto_ktp_anggota" class="col-md-4 form-control-label">Foto KTP :</label>
																		<div class="col-md-8">
																			<?php if ($item['foto_ktp_anggota'] == "Belum Diupload") {
																				echo "Belum Upload Foto KTP";
																			} else { ?>
																				<a href="#" data-toggle="modal" data-target="#ktpModal<?= $item['id_anggota'] ?>"><i class="fa fa-external-link"></i> Tampilkan Gambar KTP</a>
																			<?php } ?>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label for="foto_selfie_ktp_anggota" class="col-md-4 form-control-label">Foto KYC :</label>
																		<div class="col-md-8">
																			<?php if ($item['foto_selfie_ktp_anggota'] == "Belum Diupload") {
																				echo "Belum Upload Foto KYC";
																			} else { ?>
																				<a href="#" data-toggle="modal" data-target="#kycModal<?= $item['id_anggota'] ?>"><i class="fa fa-external-link"></i> Tampilkan Gambar KYC</a>
																			<?php } ?>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12 text-center">
																	<!-- TODO : Lanjut ini -->
																	<?php if ($item['status_anggota'] == "Sedang Diverifikasi" || $item['status_anggota'] == "Sedang Diverifikasi (Menunggu Pembayaran Simpanan Pokok)") { ?>
																		<a href="<?= base_url() ?>pegawai/verifikasiAnggota/<?= $item['id_anggota'] ?>" class="btn btn-success btn-sm">
																			<i class="fa fa-check"></i> Verifikasi
																		</a>
																	<?php } ?>
																	<a href="<?= base_url() ?>pegawai/ubahDataAnggota/<?= $item['id_anggota'] ?>" class="btn btn-warning btn-sm">
																		<i class="fa fa-edit"></i> Edit
																	</a>
																	<?php if ($item['status_anggota'] != "Dinonaktifkan") { ?>
																		<a href="<?= base_url() ?>pegawai/nonaktifkanAnggota/<?= $item['id_anggota'] ?>" class="btn btn-danger btn-sm">
																			<i class="fa fa-minus-circle"></i> Nonaktifkan
																		</a>
																	<?php } ?>
																</div>
															</div>
														</div>

														<!-- Modal for KTP Image -->
														<div class="modal fade" id="ktpModal<?= $item['id_anggota'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="ktpModalLabel<?= $item['id_anggota'] ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="ktpModalLabel<?= $item['id_anggota'] ?>">Foto KTP Anggota</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body text-center">
																		<img src="<?= base_url() ?>assets/datakoperasi/imganggota/ktp/<?= $item['foto_ktp_anggota'] ?>" class="img-fluid" alt="KTP Image">
																	</div>
																</div>
															</div>
														</div>

														<!-- Modal for KYC Image -->
														<div class="modal fade" id="kycModal<?= $item['id_anggota'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="kycModalLabel<?= $item['id_anggota'] ?>" aria-hidden="true">
															<div class="modal-dialog modal-lg" role="document">
																<div class="modal-content">
																	<div class="modal-header">
																		<h5 class="modal-title" id="kycModalLabel<?= $item['id_anggota'] ?>">Foto KYC Anggota</h5>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body text-center">
																		<img src="<?= base_url() ?>assets/datakoperasi/imganggota/kyc/<?= $item['foto_selfie_ktp_anggota'] ?>" class="img-fluid" alt="KYC Image" width="50%">
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
							</div>
						<?php } ?>