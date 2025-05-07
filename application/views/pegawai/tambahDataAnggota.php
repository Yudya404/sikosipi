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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Formulir Tambah Anggota</strong>
                    </div>
                    <div class="card-body">
						<form action="<?= base_url() ?>pegawai/tambahDataAnggota" enctype="multipart/form-data" method="POST">
							<div class="form-group">
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
								</div>
								<div class="row">
									<div class="col-md-6">
										<label class="form-control-label"> NIK Anggota</label>
										<div class="input-group mb-3">
											<input class="form-control" placeholder="Masukan NIK Anggota" type="text" name="nik_anggota" required autofocus>
										</div>
										<label class="form-control-label"> Nama</label>
										<div class="input-group mb-3">
											<input class="form-control" placeholder="Masukan nama anggota" type="text" name="nama_anggota" required autofocus>
										</div>
										<label class="form-control-label"> Alamat</label>
										<div class="input-group mb-3">
											<textarea class="form-control" placeholder="Masukan alamat anggota" name="alamat_anggota" rows="4" required></textarea>
										</div>
										<label class="form-control-label">No Telpon Anggota</label>
										<div class="input-group mb-3">
											<input class="form-control" placeholder="Masukan No, telp contoh 081xxxxx" type="tel" name="no_telp_anggota" required>
										</div>
									</div>
									<div class="col-md-6">
										<label class="form-control-label">Email</label>
										<div class="input-group mb-3">
											<input class="form-control" placeholder="Masukan email anggota" type="email" name="email" required>
										</div>
										<label for="file-input" class="form-control-label">Foto KTP Anggota</label>
										<div class="input-group mb-3">
											<input class="form-control" type="file" id="foto_ktp_anggota" name="foto_ktp_anggota" />
										</div>
										<small>* Maksimal ukuran upload foto 2MB</small>
										<br><br>
										<label for="file-input" class="form-control-label">Foto Selfie KTP Anggota</label>
										<div class="input-group mb-3">
											<input class="form-control" type="file" id="foto_selfie_ktp_anggota" name="foto_selfie_ktp_anggota" required>
										</div>
										<small>* Maksimal ukuran upload foto 2MB</small>
										<br><br>
									</div>
									<div class="col-md-12 text-center">
										<a href="<?= base_url() ?>pegawai/daftarAnggota" class="btn btn-primary btn-sm">
											<i class="fa fa-arrow-left"></i> Kembali 
										</a>
										<button type="submit" onclick="return confirm('Apakah data sudah benar?')" class="btn btn-danger btn-sm">
											<i class="fa fa-save"></i> Simpan
										</button>
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