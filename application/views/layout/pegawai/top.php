<!-- Right Panel -->
<div id="right-panel" class="right-panel">
    <!-- Header-->
    <header id="header" class="header">
        <div class="header-menu">
            <div class="col-sm-1">
                <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-desktop"></i></a>
            </div>
			<div class="col-sm-6 d-flex align-items-center">
				<a id="menuToggle" class="menutoggle pull-left"><img src="<?= base_url() . 'assets/dashboard/images/logo/logo_koperasi.png' ?>" alt="Logo Koperasi" style="height: 40px; width: auto; margin-bottom: 2px;"></a>
				<span class="ml-1" style="font-size: 18px; font-weight: bold;">SIKOSIPI</span>
			</div>
            <div class="col-sm-5">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle text-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <h6><i class="fa fa-user"></i> Selamat Datang, <?= $this->session->userdata('nama_pegawai') ?> </h6>
                    </a>
                    <div class="dropdown">
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userMenu">
							<a class="dropdown-item text-primary" href="<?= base_url() ?>pegawai/profileDataPegawai/<?= $this->session->userdata('id_pegawai') ?>">
								<i class="fa fa-user mr-2"></i> Profil <?= $this->session->userdata('nama_pegawai') ?>
							</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item text-danger" href="<?= base_url() ?>auth/logout">
								<i class="fa fa-power-off mr-2"></i> Logout
							</a>
						</div>
					</div>
                </div>
            </div>
        </div>
    </header>
	<!-- /header -->
	
    <!-- Header-->
    <div class="breadcrumbs">
        <div class="col-sm-6">
            <div class="page-header float-left">
                <div class="page-title">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div>
    </div>