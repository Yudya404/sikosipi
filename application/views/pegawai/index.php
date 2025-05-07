<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="container bootstrap snippet">
                <div class="row">
					<!-- Box for Simpanan -->
					<div class="col-lg-<?php echo ($this->session->userdata('kategori') == "1") ? '3' : '4'; ?> col-sm-6">
						<div class="circle-tile ">
							<a href="#">
								<div class="circle-tile-heading blue"><i class="fa fa-book fa-fw fa-3x"></i></div>
							</a>
							<div class="circle-tile-content blue">
								<div class="circle-tile-description text-faded">Simpanan</div>
								<div class="circle-tile-number text-faded ">
									Rp. <?= isset($total_simpanan) ? number_format($total_simpanan, 0, ',', '.') : 'Belum Ada Simpanan' ?>
								</div>
								<a class="circle-tile-footer" href="<?= base_url() ?>simpanan/dataSimpanan">Detail <i class="fa fa-chevron-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- Box for Pinjaman -->
					<div class="col-lg-<?php echo ($this->session->userdata('kategori') == "1") ? '3' : '4'; ?> col-sm-6">
						<div class="circle-tile ">
							<a href="#">
								<div class="circle-tile-heading green"><i class="fa fa-money fa-fw fa-3x"></i></div>
							</a>
							<div class="circle-tile-content green">
								<div class="circle-tile-description text-faded">Pinjaman</div>
								<div class="circle-tile-number text-faded ">
									<?= isset($jumlah_anggota_pinjaman) ? $jumlah_anggota_pinjaman : 'Belum Ada Pinjaman' ?> Anggota
								</div>
								<a class="circle-tile-footer" href="<?= base_url() ?>pegawai/daftarPinjaman">Detail <i class="fa fa-chevron-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- Box for Anggota -->
					<div class="col-lg-<?php echo ($this->session->userdata('kategori') == "1") ? '3' : '4'; ?> col-sm-6">
						<div class="circle-tile">
							<a href="#">
								<div class="circle-tile-heading dark-blue"><i class="fa fa-users fa-fw fa-3x"></i></div>
							</a>
							<div class="circle-tile-content dark-blue">
								<div class="circle-tile-description text-faded">Anggota</div>
								<div class="circle-tile-number text-faded">
									<?= isset($jumlah_anggota) ? $jumlah_anggota : 'Belum Ada Data ANggota' ?>
								</div>
								<a class="circle-tile-footer" href="<?= base_url() ?>pegawai/daftarAnggota">Detail <i class="fa fa-chevron-circle-right"></i></a>
							</div>
						</div>
					</div>
					<?php if ($this->session->userdata('kategori') == "1") { ?>
					<!-- Box for Pegawai -->
					<div class="col-lg-3 col-sm-6">
						<div class="circle-tile ">
							<a href="#">
								<div class="circle-tile-heading red"><i class="fa fa-user fa-fw fa-3x"></i></div>
							</a>
							<div class="circle-tile-content red">
								<div class="circle-tile-description text-faded">Pegawai</div>
								<div class="circle-tile-number text-faded ">
									<?= isset($jumlah_pegawai) ? $jumlah_pegawai : 'Belum Ada Data Pegawai' ?>
								</div>
								<a class="circle-tile-footer" href="<?= base_url() ?>pegawai/daftarPegawai">Detail <i class="fa fa-chevron-circle-right"></i></a>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
                <!-- Row for Tables -->
                <div class="row">
                    <!-- Table 1 -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <b> Pengajuan Pinjaman </b>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Anggota</th>
											<th>Tanggal Pengajuan</th>
											<th>Jumlah Pengajuan</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($pinjaman)) : ?>
											<?php $no = 1 ; ?>
											<?php foreach ($pinjaman as $item) : ?>
												<tr>
													<td><?= $no++ ?></td>
													<td><?= $item['nama_anggota'] ?></td>
													<td><?= formatTanggal($item['tanggal_pengajuan']) ?></td>
													<td>Rp <?= number_format($item['total_pengajuan_pinjaman'], 0, ',', '.') ?></td>
													<td>
														<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_pengajuan'] ?>" class="badge badge-info">
															<i class="fa fa-eye"></i> Detail
														</a>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="5">Tidak ada pengajuan pinjaman yang perlu diverifikasi.</td>
											</tr>
										<?php endif; ?>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

						<!-- Penempatan Modal di Sini -->
						<?php foreach ($pinjaman as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_pengajuan'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_pengajuan'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_pengajuan'] ?>">Detail Pengajuan Pinjaman <?= $item['nama_anggota'] ?></h5>
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
																<!-- Kolom Kiri -->
																<div class="col-md-6">
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Anggota :</label></div>
																		<div class="col-12 col-md-6"><label><?= $item['nama_anggota'] ?></label></div>
																	</div>
																	<div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
																		<div class="col col-md-6"><label for="file-input" class=" form-control-label">Jumlah Pengajuan :</label></div>
																		<div class="col-12 col-md-6"><label>Rp <?= number_format($item['total_pengajuan_pinjaman'], 0, ',', '.') ?></label></div>
																	</div>
																	<div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
																		<div class="col col-md-6"><label for="file-input" class=" form-control-label">Jumlah Angsuran :</label></div>
																		<div class="col-12 col-md-6"><label><?= $item['jml_angsuran_perbulan'] ?></label></div>
																	</div>
																	<div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
																		<div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tempo Pembayaran :</label></div>
																		<div class="col-12 col-md-6"><label><?= $item['jml_tempo_angsuran'] ?> /Bulan</label></div>
																	</div>
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="file-input" class=" form-control-label">Tanggal Pengajuan :</label></div>
																		<div class="col-12 col-md-6"><label><?= formatTanggal($item['tanggal_pengajuan']) ?></label></div>
																	</div>
																</div>
																<!-- Kolom Kanan -->
																<div class="col-md-6">
																	<div class="row form-group">
																		<div class="col col-md-4"><label for="textarea-input" class=" form-control-label">Alasan Pengajuan :</label></div>
																		<div class="col-12 col-md-8"><label><?= $item['alasan_pinjaman'] ?></label></div>
																	</div>
																	<div class="row form-group">
																		<div class="col col-md-6"><label for="file-input" class=" form-control-label">Status Pengajuan :</label></div>
																		<div class="col-12 col-md-6">
																			<label>
																				<?php
																				$status_class = '';
																				switch ($item['status_pengajuan']) {
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
																		<div class="col-12 col-md-9"><?= !empty($item['pesan']) ? $item['pesan'] : 'Belum ada pesan'; ?></div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-12 text-center">
																	<!-- TODO : Lanjut ini -->
																	<?php
																	if ($item['verifikasi_pegawai'] == "Sedang Diverifikasi") {
																	?>
																		<a href="<?= base_url() ?>pegawai/verifikasiPengajuanPinjaman/<?= $item['id_pengajuan'] ?>" class="btn btn-success btn-sm">
																			<i class="fa fa-check"></i> Verifikasi
																		</a>
																	<?php
																	}
																	if ($item['status_pengajuan'] == "Berhasil" && $item['pesan'] != "Pinjaman anda telah terdaftar") {
																	?>
																		<a href="<?= base_url() ?>pegawai/tambahPinjaman/<?= $item['id_pengajuan'] ?>" class="btn btn-primary btn-sm">
																			<i class="fa fa-plus"></i> Tambahkan ke daftar pinjaman
																		</a>
																	<?php
																	}
																	if ($item['verifikasi_admin'] == "Pending" && $item['status_pengajuan'] == "Sedang Diverifikasi" && $this->session->userdata('kategori') == "1" && $item['verifikasi_pegawai'] == "Diterima") {
																	?>
																		<a href="<?= base_url() ?>pegawai/verifikasiPengajuanPinjamanByAdmin/<?= $item['id_pengajuan'] ?>" class="btn btn-success btn-sm">
																			<i class="fa fa-check"></i> Verifikasi
																		</a>
																	<?php
																	}
																	?>
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