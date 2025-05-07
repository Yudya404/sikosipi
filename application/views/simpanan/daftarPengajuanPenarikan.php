<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Pengajuan Penarikan</strong>
                    </div>
                    <div class="card-body">
						<?php
						if ($this->session->flashdata('message')) {
							echo $this->session->flashdata('message');
						} ?>
						<div class="d-flex justify-content-between">
							<div>
								<a href="<?= base_url() ?>simpanan/cetakTransaksiPenarikanSimpanan" target="_blank" class="btn btn-primary btn-sm">
									<i class="fa fa-print"></i> Cetak Data
								</a>
							</div>
							<div>
								<a href="<?= base_url() ?>simpanan/tambah_pengajuan" class="btn btn-success btn-sm">
									<i class="fa fa-plus"></i> Tambah Pengajuan
								</a><br><br>
							</div>
						</div>
						<br>
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Anggota</th>
									<th>Tanggal Pengajuan</th>
									<th>Total Dana Yang Ditarik</th>
									<th>Status Penarikan</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach ($simpanan as $item) { 
								?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $item['nama_anggota'] ?></td>
										<td><?= formatTanggal($item['tanggal_permintaan_penarikan']) ?></td>
										<td>Rp <?= number_format($item['nominal_total_penarikan'], 0, ',', '.') ?></td>
										<td>
											<?php
												$status_class = '';
												switch ($item['status_penarikan']) {
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
											<span class="badge <?= $status_class ?>"><?= $item['status_penarikan'] ?></span>
										</td>
										<td>
											<?php
											// Jika verifikasi pegawai sedang diproses, tampilkan link untuk verifikasi pengajuan penarikan oleh pegawai
											if ($item['verifikasi_pegawai'] == "Sedang Diproses") {
											?>
												<a href="<?= base_url() ?>simpanan/verifikasiPenarikanByPegawai/<?= $item['id_penarikan'] ?>" class="badge badge-success">
													<i class="fa fa-edit"></i> Verifikasi Pengajuan Penarikan
												</a>
											<?php
											}

											// Jika verifikasi admin masih pending, status penarikan sedang diverifikasi, user yang login adalah admin (kategori 1), dan verifikasi pegawai diterima, tampilkan link untuk verifikasi pengajuan oleh admin
											if ($item['verifikasi_pegawai'] == "Diterima" && $item['status_penarikan'] == "Sedang Diverifikasi" && $this->session->userdata('kategori') == "1" && $item['verifikasi_admin'] == "Pending") {
											?>
												<a href="<?= base_url() ?>simpanan/verifikasiPenarikanByAdmin/<?= $item['id_penarikan'] ?>" class="badge badge-success">
													<i class="fa fa-edit"></i> Verifikasi Pengajuan
												</a>
											<?php
											}
											?>
											<!-- Tampilkan link untuk melihat detail riwayat pengajuan penarikan -->
											<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_penarikan'] ?>" class="badge badge-info">
												<i class="fa fa-eye"></i> Detail
											</a>
										</td>
									</tr>
								<?php 
									$no++;
								} ?>
							</tbody>
						</table>
						
						<!-- Penempatan Modal di Sini -->
						<?php foreach ($simpanan as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_penarikan'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_penarikan'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_penarikan'] ?>">Detail Penarikan <?= $item['nama_anggota'] ?></h5>
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
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
																		<div class="col col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
																	</div>
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tanggal Keanggotaan :</label></div>
																		<div class="col-6"><label><?= formatTanggal($item['tanggal_keanggotaan']) ?></label></div>
																	</div>
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="file-input" class="form-control-label">Tanggal Pengajuan :</label></div>
																		<div class="col col-md-6"><label><?= formatTanggal($item['tanggal_permintaan_penarikan']) ?></label></div>
																	</div>
																	 <div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
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
																		<div class="col col-md-6"><label for="file-input" class="form-control-label">Verifikasi Admin : </label></div>
																		<div class="col-6">
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
																		<div class="col col-md-3"><label for="file-input" class="form-control-label">Pesan :</label></div>
																		<div class="col col-md-9"><span style="white-space: pre-line"><?= $item['pesan']; ?></span></div>
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
					</div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->