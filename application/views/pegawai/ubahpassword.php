<!-- Function Show Unshow Password -->
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
                        <strong class="card-title">Ubah Password</strong>
                    </div>
                    <div class="card-body">
                        <?php if (validation_errors()) {
                        ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors() ?>
                            </div>
                        <?php
                        } ?>
                        <form action="<?= base_url() ?>pegawai/ubahPassword" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <label class=" form-control-label">Masukan Password Baru</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                    <input class="form-control" type="password" name="password" id="password" required autofocus>
                                </div>
                                <small class="form-text text-muted">Minimal memiliki 5 karakter, contoh : andi1</small>
                                <span onclick="passwordShowUnshow()" style="cursor: pointer;">
                                    <i class="fa fa-eye"></i> Tampilkan/Sembunyikan Password
                                </span>
                            </div>
                            <a href="<?= base_url() ?>anggota" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                            <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Apakah anda yakin ingin mengganti password?')"><i class="fa fa-lock"></i> Ganti Password</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>