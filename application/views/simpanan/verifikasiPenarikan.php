<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Verifikasi Pengajuan Penarikan Simpanan (BY Pegawai)</strong>
                    </div>
                    <?php foreach ($simpanan as $item) { ?>
                        <div class="card-body card-block">
							<form method="POST" action="<?= base_url() ?>simpanan/prosesVerifikasiPenarikanByPegawai">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Nama Anggota :</label></div>
                                        <div class="col-6"><label><?= $item['nama_anggota'] ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Tanggal Keanggotaan :</label></div>
                                        <div class="col-6"><label><?= formatTanggal($item['tanggal_keanggotaan']) ?></label></div>
                                    </div>
                                    <div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Jumlah Penarikan :</label></div>
                                        <div class="col-6"><label>Rp <?= number_format($item['nominal_total_penarikan'], 0, ',', '.') ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Tanggal Pengajuan :</label></div>
                                        <div class="col-6"><label><?= formatTanggal($item['tanggal_permintaan_penarikan']) ?></label></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Status Penarikan :</label></div>
                                        <div class="col-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['status_penarikan']) {
													case 'Berhasil':
													$status_class = 'badge-success';
													break;
													case 'Ditolak':
													$status_class = 'badge-danger';
													break;
													default:
													$status_class = 'badge-warning';
													break;
												}
												?>
												<span class="badge <?= $status_class ?>"><?= $item['status_penarikan'] ?></span>
											</label>
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Verifikasi Admin :</label></div>
                                        <div class="col-6">
											<label>
												<?php
													$status_class = '';
													switch ($item['verifikasi_admin']) {
													case 'Diterima':
													$status_class = 'badge-success';
													break;
													case 'Ditolak':
													$status_class = 'badge-danger';
													break;
													default:
													$status_class = 'badge-warning';
													break;
												}
												?>
												<span class="badge <?= $status_class ?>"><?= $item['verifikasi_admin'] ?></span>
											</label>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
									<div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Total Saldo Akhir :</label></div>
                                        <div class="col-6">
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">Rp</div>
												</div>
												<input class="form-control" type="number" value="<?= $item['total_akhir_simpanan'] ?>" name="total_akhir_simpanan" id="total_akhir_simpanan" required readonly>
											</div>	
										</div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-6"><label for="file-input" class=" form-control-label">Verifikasi Pegawai :</label></div>
                                        <div class="col-6">
                                            <input type="hidden" name="id_penarikan" value="<?= $item['id_penarikan'] ?>">
											<input type="hidden" name="id_pegawai" value="<?= $item['id_pegawai'] ?>">
												<select class="form-control" name="verifikasi_pegawai" id="verifikasi_pegawai" required onchange="togglePesanPegawai()">
                                                    <option value="<?= $item['verifikasi_pegawai'] ?>" disabled selected><?= $item['verifikasi_pegawai'] ?></option>
                                                    <option value="Diterima">Diterima</option>
                                                    <option value="Ditolak"><b style="color:red">Ditolak</b></option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="row form-group" id="pesan-container" style="display: none;">
                                        <div class="col col-md-3"><label for="file-input" class=" form-control-label">Pesan :</label></div>
                                        <div class="col-9">
											<textarea name="pesan" id="textarea-input" rows="3" placeholder="Pesan (wajib diisi jika ditolak)" class="form-control"></textarea>
										</div>
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <small class="form-text text-muted"><b>* Bunga didapatkan setiap tahun sebesar 2%, JIKA masa keanggotaan KURANG dari SATU TAHUN maka TIDAK MENDAPAT BUNGA SIMPANAN!</b></small><br>
									<a href="<?= base_url() ?>simpanan/dataAksiPenarikan" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
                                    <button class="btn btn-success btn-sm" onclick="return confirm('Apakah anda yakin ingin Verifikasi Penarikan ?')"><i class="fa fa-check"></i> Verifikasi</button>
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