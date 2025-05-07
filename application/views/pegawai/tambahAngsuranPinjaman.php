<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Pembayaran Angsuran Pinjaman</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php if (validation_errors()) { ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors() ?>
                                </div>
                            <?php } ?>
							<?php if($this->session->flashdata('message')): ?>
								<div class="alert alert-success">
									<?= $this->session->flashdata('message'); ?>
								</div>
							<?php endif; ?>
                            <?php if (!empty($pinjaman)) { // Check if $pinjaman is not empty ?>
                                <div class="card-body card-block">
                                    <form action="<?= base_url() ?>pegawai/prosesTambahAngsuran" method="POST">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Nama Anggota :</label></div>
                                            <div class="col-12 col-md-9"><label><?= $pinjaman['nama_anggota'] ?></label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Tanggal Pinjam Dana :</label></div>
                                            <div class="col-12 col-md-9"><label><?= formatTanggal($pinjaman['tanggal_meminjam']) ?></label></div>
                                        </div>
										<div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Jumlah Tempo Angsuran :</label></div>
                                            <div class="col-12 col-md-9"><label><?= $pinjaman['jml_tempo_angsuran'] ?> /Bulan</label></div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Tanggal Pelunasan :</label></div>
                                            <div class="col-12 col-md-9">
												<input type="text" id="tanggal_pelunasan" name="tanggal_pelunasan" value="<?= formatTanggal($pinjaman['tanggal_pelunasan']) ?>" class="form-control" readonly>
											</div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label class=" form-control-label">Angsuran Pembayaran :</label></div>
                                            <div class="col-12 col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" value="<?= $pinjaman['id_pinjaman'] ?>" name="id_pinjaman">
                                                    <input class="form-control" type="text" value="<?= $pinjaman['angsuran_bulanan'] ?>" readonly name="angsuran_pembayaran" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 text-center">
                                            <a href="<?= base_url() ?>pegawai/daftarPinjaman" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                                            <button type="submit" name="submit" onclick="return confirm('Apakah anda yakin ingin Menambahkan Angsuran Pinjaman Ini?')" class="btn btn-success btn-sm">
                                                <i class="fa fa-save"></i> Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            <?php } else { ?>
                                <div class="alert alert-danger" role="alert">
                                    Data pinjaman tidak ditemukan.
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
