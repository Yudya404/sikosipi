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
                        <strong class="card-title">Formulir Tambah Pegawai</strong>
                    </div>
                    <div class="card-body">
						<form action="<?= base_url() ?>pegawai/tambahDataPegawai" enctype="multipart/form-data" method="POST">
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
										<label class="form-control-label">NIK Pegawai</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan nik pegawai" type="text" name="nik_pegawai" required autofocus>
										</div>
										<label class="form-control-label">Nama Pegawai</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan nama pegawai" type="text" name="nama_pegawai" required autofocus>
										</div>
										<label class="form-control-label">Alamat Pegawai</label>
										<div class="input-group">
											<textarea class="form-control" placeholder="Masukan alamat pegawai" name="alamat_pegawai" rows="4" required></textarea>
										</div>
										<label class="form-control-label">No Telpon Pegawai</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan No, telp contoh 081xxxxx" type="tel" name="no_telp_pegawai" required>
										</div>
									</div>
									<div class="col-md-6">
										<label class="form-control-label">Email</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan email pegawai" type="email" name="email" required>
										</div>
										<label class="form-control-label">Kategori Pegawai</label>
										<div class="input-group">
											<select class="form-control" name="kategori" required>
												<option value="" disabled selected>Pilih Kategori Pegawai</option>
												<option value="1">Admin</option>
												<option value="2">Kepala Bagian</option>
												<option value="3">Pegawai Biasa</option>
												<!-- Tambahkan opsi lain sesuai kebutuhan -->
											</select>
										</div>
										<label class="form-control-label">Username</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan username pegawai" type="text" name="username" required>
										</div>
										<label class="form-control-label">Password</label>
										<div class="input-group">
											<input class="form-control" placeholder="Masukan Password" type="password" id="password" name="password" required>
											<div class="input-group-append">
												<span class="input-group-text" onclick="passwordShowUnshow()" style="cursor: pointer;">
													<i class="fa fa-eye" id="eye-icon"></i>
												</span>
											</div>
										</div>
										<small>* Passsword minimal menggunakan 8 Karakter (ex : yahoo@12)</small><br>
										<label for="file-input" class="form-control-label">Foto Pegawai</label>
										<div class="input-group">
											<input class="form-control" type="file" id="foto_pegawai" name="foto_pegawai" />
										</div>
										<small>* Maksimal ukuran upload foto 2mb</small>
										<br><br>
									</div>
									<div class="col-md-12 text-center">
										<a href="<?= base_url() ?>pegawai/daftarPegawai" class="btn btn-primary btn-sm">
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