<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Detail Anggota</strong>
                    </div>
                    <?php foreach ($anggota as $item) { ?>
                        <div class="card-body card-block">
							<div class="row">
								<div class="col-md-6">
									<!-- Kolom kiri -->
									<div class="form-group row">
										<label for="nik_anggota" class="col-md-4 form-control-label">NIK Anggota:</label>
										<div class="col-md-8"><label><?= $item['nik_anggota'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="nama_anggota" class="col-md-4 form-control-label">Nama Anggota:</label>
										<div class="col-md-8"><label><?= $item['nama_anggota'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="email" class="col-md-4 form-control-label">Email:</label>
										<div class="col-md-8"><label><?= $item['email'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="username" class="col-md-4 form-control-label">Username:</label>
										<div class="col-md-8"><label><?= $item['username'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="no_telp_anggota" class="col-md-4 form-control-label">No Telpon:</label>
										<div class="col-md-8"><label><?= $item['no_telp_anggota'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="alamat_anggota" class="col-md-4 form-control-label">Alamat Anggota:</label>
										<div class="col-md-8"><label><?= $item['alamat_anggota'] ?></label></div>
									</div>
								</div>
								<div class="col-md-6">
									<!-- Kolom kanan -->
									<div class="form-group row">
										<label for="tanggal_keanggotaan" class="col-md-6 form-control-label">Tanggal Keanggotaan:</label>
										<div class="col-md-4"><label><?= $item['tanggal_keanggotaan'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="status_anggota" class="col-md-6 form-control-label">Status Anggota:</label>
										<div class="col-md-4">
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
										<label for="foto_ktp_anggota" class="col-md-4 form-control-label">Foto KTP:</label>
										<div class="col-md-8">
											<?php if ($item['foto_ktp_anggota'] == "Belum Diupload") {
												echo "Belum Upload Foto KTP";
											} else { ?>
												<a href="#" data-toggle="modal" data-target="#ktpModal<?= $item['id_anggota'] ?>"><i class="fa fa-external-link"></i> Tampilkan Gambar KTP</a>
											<?php } ?>
										</div>
									</div>
									<div class="form-group row">
										<label for="foto_selfie_ktp_anggota" class="col-md-4 form-control-label">Foto KYC:</label>
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
									<a href="<?= base_url() ?>pegawai/daftarAnggota" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
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
					<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>