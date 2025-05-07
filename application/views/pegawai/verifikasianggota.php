<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Verifikasi Anggota</strong>
                    </div>
                    <?php foreach ($anggota as $item) { ?>
                        <div class="card-body card-block">
							<div class="col-md-6">
								<div class="row form-group">
									<div class="col col-md-4"><label for="textarea-input" class=" form-control-label">NIK :</label></div>
									<div class="col-12 col-md-8"><label><?= $item['nik_anggota'] ?></label></div>
								</div>
								<div class="row form-group">
									<div class="col col-md-4"><label for="textarea-input" class=" form-control-label">Nama :</label></div>
									<div class="col-12 col-md-8"><label><?= $item['nama_anggota'] ?></label></div>
								</div>
								<div class="row form-group">
									<div class="col col-md-4"><label for="file-input" class=" form-control-label">Alamat :</label></div>
									<div class="col-12 col-md-8"><label><?= $item['alamat_anggota'] ?></label></div>
								</div>
								<div class="row form-group">
									<div class="col col-md-4"><label for="file-input" class=" form-control-label">No Handphone :</label></div>
									<div class="col-12 col-md-8"><label><?= $item['no_telp_anggota'] ?></label></div>
								</div>
							</div>
							<div class="col-md-6">
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
								<div class="row form-group">
									<div class="col col-md-6"><label for="file-input" class=" form-control-label">Status Anggota Saat Ini :</label></div>
									<div class="col-md-6">
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
							
							<div class="col-md-12">
                    <?php } ?>
								<div class="row form-group">
									<div class="col col-md-2"><label class=" form-control-label">Verifikasi Status :</label></div>
									<div class="col-12 col-md-9">
										<form method="POST" action="<?= base_url() ?>pegawai/prosesVerifikasiAnggota">
											<?php foreach ($anggota as $i) { ?>
												<input type="hidden" name="id_anggota" value="<?= $i['id_anggota'] ?>">
												<select class="form-control" name="status_anggota" required>
													<option value="<?= $i['status_anggota'] ?>" disabled selected><?= $i['status_anggota'] ?></option>
											<?php } ?>
													<option value="Sedang Diverifikasi (Menunggu Pembayaran Simpanan Pokok)">Verifikasi Data Diterima (Data Valid)</option>
													<option value="Verifikasi Ulang">Request Verifikasi Ulang</option>
													<option value="Aktif">Aktifkan Member</option>
												</select>
												<br>
											<a href="<?= base_url() ?>pegawai/daftarAnggota" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
											<button class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Verifikasi Anggota?')"><i class="fa fa-check-circle-o"></i> Verifikasi</button>
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