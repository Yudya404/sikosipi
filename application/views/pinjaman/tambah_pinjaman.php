<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Formulir Pengajuan Pinjaman</strong>
                                </div>
                                <div class="card-body card-block">
                                    <form action="<?= base_url() ?>pinjaman/tambah_pinjaman" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="select2" class="form-control-label">Nama Anggota :</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="id_anggota" id="select2" class="form-control" required>
                                                    <option value="">Pilih Nama</option>
                                                    <?php if (!empty($anggota)) { ?>
                                                        <?php foreach ($anggota as $item) { ?>
															<?php if ($item['status_pengajuan'] != 'Sedang Diverifikasi') { ?>
																<option value="<?= $item['id_anggota'] ?>"><?= $item['nama_anggota'] ?></option>
															<?php } ?>
														<?php } ?>
                                                    <?php } else { ?>
                                                        <option value="" disabled>Tidak ada anggota yang tersedia</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
										<div class="row form-group">
                                            <div class="col col-md-3"><label for="file-input" class="form-control-label">Alasan Pengajuan :</label></div>
                                            <div class="col-9">
                                                <textarea name="alasan_pinjaman" id="textarea-input" rows="2" placeholder="Alasan (wajib diisi)" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="jumlah_pinjaman" class="form-control-label">Jumlah Pinjaman :</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" required>
                                                    <option value="">Pilih Jumlah Pinjaman</option>
                                                    <option value="500000">Rp 500.000</option>
                                                    <option value="1000000">Rp 1.000.000</option>
                                                    <option value="2000000">Rp 2.000.000</option>
                                                    <option value="3000000">Rp 3.000.000</option>
                                                    <option value="4000000">Rp 4.000.000</option>
                                                    <option value="5000000">Rp 5.000.000</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="bunga" class="form-control-label">Bunga :</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="bunga" name="bunga" value="5%" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="cicilan" class="form-control-label">Cicilan (bulan) :</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select name="cicilan" id="cicilan" class="form-control" required>
                                                    <option value="">Pilih Cicilan</option>
                                                    <option value="3">3 Bulan</option>
                                                    <option value="6">6 Bulan</option>
													<option value="9">9 Bulan</option>
                                                    <option value="12">12 Bulan</option>
													<option value="15">15 Bulan</option>
													<option value="18">18 Bulan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="cicilan_per_bulan" class="form-control-label">Cicilan per Bulan :</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <input type="text" id="cicilan_per_bulan" name="cicilan_per_bulan" value="cicilan_per_bulan" class="form-control" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <a href="<?= base_url() ?>pegawai/daftarPengajuanPinjaman" class="btn btn-primary btn-sm">
                                                <i class="fa fa-arrow-left"></i> Kembali
                                            </a>
                                            <button type="submit" name="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-save"></i> Ajukan
                                            </button>
                                        </div>
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