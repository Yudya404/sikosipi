<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Anggota</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
						<div class="text-right">
							<div>
								<a href="<?= base_url() ?>pegawai/tambahDataAnggota" class="btn btn-success btn-sm">
									<i class="fa fa-plus"></i> Tambah Anggota
								</a><br><br>
							</div>
						</div>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
							<thead>
								<tr>
									<th>No</th>
									<th>NIK</th>
									<th>Nama</th>
									<th>Alamat</th>
									<th>Status</th>
									<th>No Telfon</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$no = 1;
								foreach ($anggota as $item) { 
								?>
									<?php if ($item['status_anggota'] != 'Dinonaktifkan') { ?>
										<tr>
											<td><?= $no ?></td>
											<td><?= $item['nik_anggota'] ?></td>
											<td><?= $item['nama_anggota'] ?></td>
											<td><?= $item['alamat_anggota'] ?></td>
											<td>
												<?php
												$status_class = '';
												switch ($item['status_anggota']) {
													case 'Aktif':
														$status_class = 'badge-success';
														break;
													case 'Dinonaktifkan':
														$status_class = 'badge-danger';
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
											</td>
											<td><?= $item['no_telp_anggota'] ?></td>
											<td>
												<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_anggota'] ?>" class="badge badge-info">
													<i class="fa fa-eye"></i> Detail
												</a>
												<a href="<?= base_url() ?>pegawai/ubahDataAnggota/<?= $item['id_anggota'] ?>" class="badge badge-success">
													<i class="fa fa-edit"></i> Edit
												</a>
												<?php if ($item['status_anggota'] != "Dinonaktifkan") { ?>
													<a href="<?= base_url() ?>pegawai/nonaktifkanAnggota/<?= $item['id_anggota'] ?>" class="badge badge-danger">
														<i class="fa fa-minus-circle"></i> Nonaktifkan
													</a>
												<?php } ?>
											</td>
										</tr>
									<?php } ?>
								<?php 
									$no++;
								} ?>
							</tbody>
						</table>
						
						<!-- Penempatan Modal di Sini -->
						<?php foreach ($anggota as $item) { ?>
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
																	<?php
																	// Periksa apakah status adalah 'Sedang Diverifikasi' atau tanggal keanggotaan adalah '0000-00-00'
																	if ($item['status_anggota'] === 'Sedang Diverifikasi') {
																		$tanggal_keanggotaan = 'Belum Menjadi Anggota';
																	} else {
																		$tanggal_keanggotaan = $item['tanggal_keanggotaan'] === '0000-00-00' ? '-' : formatTanggal($item['tanggal_keanggotaan']);
																	}
																	?>

																	<div class="form-group row">
																		<label for="tanggal_keanggotaan" class="col-md-6 form-control-label">Tanggal Keanggotaan :</label>
																		<div class="col-md-6"><label><?= $tanggal_keanggotaan ?></label></div>
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
																				case 'Dinonaktifkan':
																					$status_class = 'badge-danger';
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
																	<!--<?php if ($item['status_anggota'] == "Sedang Diverifikasi" || $item['status_anggota'] == "Sedang Diverifikasi (Menunggu Pembayaran Simpanan Pokok)") { ?>
																		<a href="<?= base_url() ?>pegawai/verifikasiAnggota/<?= $item['id_anggota'] ?>" class="btn btn-success btn-sm">
																			<i class="fa fa-check"></i> Verifikasi
																		</a>
																	<?php } ?>-->
																	<a href="<?= base_url() ?>pegawai/ubahDataAnggota/<?= $item['id_anggota'] ?>" class="btn btn-primary btn-sm">
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
																		<img src="<?= base_url() ?>assets/datakoperasi/foto/<?= $item['foto_ktp_anggota'] ?>" class="img-fluid" alt="KTP Image" width="40%">
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
																		<img src="<?= base_url() ?>assets/datakoperasi/foto/<?= $item['foto_selfie_ktp_anggota'] ?>" class="img-fluid" alt="KYC Image" width="30%">
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