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
                        <strong>Ubah Data Pegawai</strong>
                    </div>
					 <?php foreach ($pegawai as $item) { ?>
						<div class="card-body card-block">
							<form method="POST" action="<?= base_url() ?>pegawai/prosesUbahDataPegawai/<?= $item['id_pegawai'] ?>" enctype="multipart/form-data">
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
											<label for="nik_pegawai" class="form-control-label">NIK Pegawai:</label>
											<input type="hidden" name="id_pegawai" value="<?= $item['id_pegawai'] ?>">
											<input type="hidden" name="kategori" value="<?= $item['kategori'] ?>">
											<input type="text" id="nik_pegawai" name="nik_pegawai" value="<?= $item['nik_pegawai'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="nama_pegawai" class="form-control-label">Nama Pegawai:</label>
											<input type="text" id="nama_pegawai" name="nama_pegawai" value="<?= $item['nama_pegawai'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="email" class="form-control-label">Email :</label>
											<input type="email" id="email" name="email" value="<?= $item['email'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="no_telp_pegawai" class="form-control-label">No. Telp :</label>
											<input type="tel" id="no_telp_pegawai" name="no_telp_pegawai" value="<?= $item['no_telp_pegawai'] ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="username" class="form-control-label">Username :</label>
											<input type="text" id="username" name="username" value="<?= $item['username'] ?>" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="alamat_pegawai" class="form-control-label">Alamat :</label>
											<textarea id="alamat_pegawai" name="alamat_pegawai" class="form-control" rows="3"><?= $item['alamat_pegawai'] ?></textarea>
										</div>
										<div class="form-group">
											<label for="password" class="form-control-label">Ubah Password :</label>
											<div class="input-group">
												<input class="form-control" placeholder="Masukan Password (Kosongkan Jika Tidak Mengubah)" type="password" id="password" name="password">
												<div class="input-group-append">
													<span class="input-group-text" onclick="passwordShowUnshow()" style="cursor: pointer;">
														<i class="fa fa-eye" id="eye-icon"></i>
													</span>
												</div>
											</div>
											<small>* Passsword minimal menggunakan 8 Karakter (ex : yahoo@12)</small><br>
										</div>
										<div class="form-group">
											<div class="col col-md-6"><label class="form-control-label">Foto Pegawai :</label></div>
											<div class="col-12 col-md-9">
												<label>
													<img src="<?php echo base_url('assets/datakoperasi/foto/' . $item['foto_pegawai']) ?>" width="40%" />
												</label>
											</div>
										</div>
										<div class="form-group">
											<input class="form-control" type="file" id="foto_pegawai" name="foto_pegawai" />
											<small>* Maksimal ukuran upload foto 2mb.</small>
										</div>
									</div>
									<div class="col-md-12 text-center">
										<div class="form-group">
											<a href="<?= base_url() ?>pegawai/daftarPegawai" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali </a>
											<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin mengubah Data Pegawai?')"><i class="fa fa-edit"></i> Ubah </button>
										</div>
									</div>
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