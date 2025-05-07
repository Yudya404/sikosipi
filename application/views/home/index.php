<div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
        <div class="login-content">
            <div class="login-form">
                <form action="<?= base_url() ?>auth/prosesLoginPegawai" method="POST">
                    <div class="form-group">
                        <center><label style="font-weight: bold;">Login Pegawai</label></center>
                        <div class="login-logo">
                            <a href="<?= base_url() ?>">
                                <img class="align-content" src="<?= base_url() ?>assets/home/img/logo/logo_koperasi.png" width="20%" alt="">
                            </a>
                        </div>
                        <?= $this->session->flashdata('message'); ?><br>
                        <label>Username Pegawai</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukkan Username" autofocus required>
                    </div>
                    <div class="form-group">
                        <label>Password Pegawai</label>
						<div class="input-group">
						<input class="form-control" placeholder="Masukan Password" type="password" id="password" name="password" required>
							<div class="input-group-append">
								<span class="input-group-text" onclick="passwordShowUnshow()" style="cursor: pointer;">
									<i class="fa fa-eye" id="eye-icon"></i>
								</span>
							</div>
						</div>
                    </div>
                    <div class="text-right">
                        <label class="pull-right">
							<a href="#" data-toggle="modal" data-target="#lupapasswordModal"> Lupa Password? </a>
                        </label>
						<!-- Modal for KTP Image -->
						<div class="modal fade" id="lupapasswordModal" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="lupapasswordModalLabel" aria-hidden="true">
							<div class="modal-dialog" style="max-width: 500px; max-height: 700px;" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="lupapasswordModalLabel">Helpdesk SIKOSIPI</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body text-center">
										<img src="<?= base_url() ?>assets/home/img/gambar/helpdesk.png" class="img-fluid" alt="Helpdesk Image">
									</div>
								</div>
							</div>
						</div>
                    </div>
                    <button type="submit" class="btn btn-success btn-flat">Login <i class="fa fa-sign-in"></i></button>
                </form>
				<br><center><p>Created By <a href='#' title='wbs.com' target='_blank'>wbs.com</a></p></center>
            </div>
        </div>
    </div>
</div>

</body>
</html>
