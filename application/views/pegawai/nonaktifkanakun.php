<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Nonaktifkan Anggota</strong>
                    </div>
                    <?php foreach ($anggota as $item) { ?>
                        <div class="card-body card-block">
							<div class="alert alert-danger" role="alert">
								<i class="fa fa-info-circle"></i><b> Jika anda menonaktifkan akun ini maka: </b><br>
								1. Anggota tidak dapat melakukan transaksi apa-apa.<br>
								2. Penonaktifan akun akan diverifikasi admin terlebih dahulu.<br>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group row">
										<label for="nama_anggota" class="col-md-4 form-control-label">Nama :</label>
										<div class="col-md-8"><label><?= $item['nama_anggota'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="alamat_anggota" class="col-md-4 form-control-label">Alamat :</label>
										<div class="col-md-8"><label><?= $item['alamat_anggota'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="email_anggota" class="col-md-4 form-control-label">Email :</label>
										<div class="col-md-8"><label><?= $item['email'] ?></label></div>
									</div>
									<div class="form-group row">
										<label for="no_telp_anggota" class="col-md-4 form-control-label">No, Handphone :</label>
										<div class="col-md-8"><label><?= $item['no_telp_anggota'] ?></label></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group row">
										<label for="status_anggota" class="col-md-6 form-control-label">Status Saat Ini:</label>
										<div class="col-md-6">
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
							<form action="<?= base_url() ?>pegawai/prosesNonaktifkanAnggota" method="POST">
								<input type="hidden" name="id_anggota" value="<?= $item['id_anggota'] ?>">
								<div class="form-group row">
									<label for="pesan_aksi" class="col-md-3 form-control-label">Alasan Penonaktifan :</label>
									<div class="col-md-9">
										<textarea name="pesan_aksi" id="pesan_aksi" rows="3" placeholder="Anda wajib menuliskan alasan kenapa menonaktifkan akun ini" required class="form-control" rows="3"></textarea>
									</div>
								</div>
								<div class="form-group row">
									<div class="col-md-12 text-center">
										<a href="<?= base_url() ?>pegawai/daftarAnggota" class="btn btn-primary btn-sm">
											<i class="fa fa-arrow-left"></i> Kembali 
										</a>
										<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin Menonaktifkan Akun Ini?')">
											<i class="fa fa-minus-circle"></i> Nonaktifkan
										</button>
									</div>
								</div>
							</form>
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