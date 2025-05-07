<script>
    function passwordShowUnshow() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Ubah Data Anggota</strong>
                    </div>
                    <?php foreach ($anggota as $item) {?>
                        <div class="card-body card-block">
							<form method="POST" action="<?= base_url() ?>pegawai/prosesUbahDataAnggota/<?= $item['id_anggota'] ?>" enctype="multipart/form-data">					
								<div class="row">
									<div class="col-md-12">
										<?php if (validation_errors()) { ?>
											<div class="alert alert-danger" role="alert">
												<?= validation_errors() ?>
											</div>
										<?php } ?>
										<?php if ($this->session->flashdata('message')): ?>
											<?= $this->session->flashdata('message') ?>
										<?php endif; ?>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="nik_anggota" class="form-control-label">NIK Anggota :</label>
											
											<input type="text" id="nik_anggota" name="nik_anggota" value="<?= $item['nik_anggota'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="nama_anggota" class="form-control-label">Nama Anggota :</label>
											<input type="text" id="nama_anggota" name="nama_anggota" value="<?= $item['nama_anggota'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="email_anggota" class="form-control-label">Email Anggota :</label>
											<input type="email" id="email_anggota" name="email_anggota" value="<?= $item['email'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="no_telp_anggota" class="form-control-label">No Telp Anggota :</label>
											<input type="tel" id="no_telp_anggota" name="no_telp_anggota" value="<?= $item['no_telp_anggota'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="alamat_anggota" class="form-control-label">Alamat Anggota :</label>
											<textarea id="alamat_anggota" name="alamat_anggota" class="form-control" rows="3"><?= $item['alamat_anggota'] ?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="foto_ktp_anggota" class="form-control-label">Foto KTP Anggota :</label>
											<label>
												<img src="<?php echo base_url('assets/datakoperasi/foto/' . $item['foto_ktp_anggota']) ?>" width="40%" />
											</label>
										</div>
										<div class="form-group">
											<input class="form-control" type="file" id="foto_ktp_anggota" name="foto_ktp_anggota" />
											<small>* Maksimal ukuran upload foto 2mb.</small>
										</div>
										<div class="form-group">
											<label for="foto_ktp_anggota" class="form-control-label">Foto KCY Anggota :</label>
											<label>
												<img src="<?php echo base_url('assets/datakoperasi/foto/' . $item['foto_selfie_ktp_anggota']) ?>" width="30%" />
											</label>
										</div>
										<div class="form-group">
											<input class="form-control" type="file" id="foto_selfie_ktp_anggota" name="foto_selfie_ktp_anggota" />
											<small>* Maksimal ukuran upload foto 2mb.</small>
										</div>
									</div>
								</div>
								<div class="col-md-12 text-center">
									<a href="<?= base_url() ?>pegawai/daftarAnggota" class="btn btn-primary btn-sm">
										<i class="fa fa-arrow-left"></i> Kembali
									</a>
									<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin mengubah Data Anggota?')">
										<i class="fa fa-edit"></i> Ubah 
									</button>
								</div>
							</form>
						</div>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>