<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Permintaan Hapus Setoran </strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
						<div class="d-flex justify-content-between">
							<div>
								<a href="<?= base_url() ?>simpanan/cetakTransaksiHapusSetoran" target="_blank" class="btn btn-primary btn-sm">
									<i class="fa fa-print"></i> Cetak Data
								</a>
							</div>
						</div>
						<br>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
									<th>No</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Pegawai Yang Request</th>
                                    <th>Nama Anggota</th>
                                    <th>Jumlah</th>
                                    <th>Status Permintaan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$no = 1;
								
                                foreach ($aksi as $item) { ?>
                                    <tr>
										<td><?= $no ?></td>
                                        <td><?= formatTanggal($item['tanggal_aksi']) ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td>Rp <?= number_format($item['jumlah_setor_tunai'], 0, ',', '.') ?></td>
                                        <td>
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
										</td>
                                        <td>
											<?php
											if ($item['status_verifikasi'] == "Pending") {
												if ($this->session->userdata('kategori') == "1") {
											?>
													<a href="<?= base_url() ?>simpanan/reviewPenghapusanSetoran/<?= $item['id_aksi'] ?>" class="badge badge-info"><i class="fa fa-eye"></i> Review</a>
											<?php
												} else {
													echo '<span class="badge badge-danger"><i class="fa fa-times"></i> Anda Bukan Admin</span>';
												}
											} elseif ($item['status_verifikasi'] == "Ditolak") {
												?>
												<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_aksi'] ?>" class="badge badge-primary">
													<i class="fa fa-eye"></i> Detail
												</a>
											<?php
											} else {
												echo '<span class="badge badge-success"><i class="fa fa-check"></i> Sudah Diverifikasi Admin</span>';
											}
											?>
										</td>
                                    </tr>
                                <?php
									$no++;
                                } ?>
                            </tbody>
                        </table>
						
						<!-- Penempatan Modal di Sini -->
						<?php foreach ($aksi as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_aksi'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_aksi'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_aksi'] ?>">Detail Hapus Pembayaran Setoran <?= $item['nama_anggota'] ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-header">
															<strong class="card-title">Detail Hapus Pembayaran Simpanan Wajib</strong>
														</div>
														<div class="card-body">
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
						<?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->