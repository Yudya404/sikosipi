<!-- Left Panel -->
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fa fa-bars"></i>
			</button>
			<div class="navbar-brand">
				<img src="<?= base_url() . 'assets/dashboard/images/logo/logo_koperasi.png' ?>" alt="Logo Koperasi" style="height: 95px; width: auto; margin-bottom: 3px;">
			</div>
			<!--<h4 class="navbar-brand"> SIKOSIPI</h4>-->
		</div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="<?= base_url() ?>pegawai"> 
						<i class="menu-icon fa fa-home"></i>Dashboard 
					</a>
                </li>
                <h3 class="menu-title">Menu SIKOSIPI</h3><!-- /.menu-title -->

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Simpanan</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon ti-layout-list-thumb-alt"></i><a href="<?= base_url() ?>simpanan/dataSimpanan">Data Simpanan</a></li>
                        <li><i class="menu-icon fa fa-file-pdf-o"></i><a href="<?= base_url() ?>simpanan/laporan">Laporan</a></li>
                        <li><i class="menu-icon ti-announcement"></i><a href="<?= base_url() ?>simpanan/daftarAksiPenghapusanSetoran">Aksi Hapus Setoran</a></li>
                        <li><i class="menu-icon ti-announcement"></i><a href="<?= base_url() ?>simpanan/dataAksiPenarikan">Aksi Penarikan Simpanan</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-book"></i>Pinjaman</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon ti-layout-list-thumb-alt"></i><a href="<?= base_url() ?>pegawai/daftarPinjaman">Daftar Pinjaman</a></li>
                        <li><i class="menu-icon ti-layout-list-thumb-alt"></i><a href="<?= base_url() ?>pegawai/daftarPengajuanPinjaman">Daftar Pengajuan Pinjaman</a></li>
                        <li><i class="menu-icon fa fa-file-pdf-o"></i><a href="<?= base_url() ?>pinjaman/laporan">Laporan</a></li>
                        <li><i class="menu-icon ti-announcement"></i><a href="<?= base_url() ?>pinjaman/daftarAksiPenghapusanAngsuran">Aksi Hapus Angsuran</a></li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Anggota</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon ti-layout-list-thumb-alt"></i><a href="<?= base_url() ?>pegawai/daftarAnggota">Daftar Anggota</a></li>
                        <li><i class="menu-icon ti-announcement"></i><a href="<?= base_url() ?>pegawai/daftarAksiPenonaktifanAnggota">Aksi Penonaktifan Anggota</a></li>
                    </ul>
                </li>
                <?php
                if ($this->session->userdata('kategori') == "1") {
                ?>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-user"></i>Pegawai</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon ti-layout-list-thumb-alt"></i><a href="<?= base_url() ?>pegawai/daftarPegawai">Daftar Pegawai</a></li>
                        </ul>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->