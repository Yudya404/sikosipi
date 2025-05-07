<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Hapus Setoran Simpanan Wajib</strong>
                    </div>
                    <?php foreach ($setoran as $item) { ?>
						<div class="card-body card-block">
							<div class="alert alert-danger" role="alert">
								<i class="fa fa-info-circle"></i><b> Jika anda ingin menghapus transaksi setoran ini maka: </b><br>
								1. Saldo pada simpanan wajib anggota akan berkurang sesuai dengan transaksi yang dihapus. <br>
								2. Penghapusan transaksi ini akan diverifikasi admin terlebih dahulu. <br>
							</div>
							<div class="row form-group">
								<div class="col-md-6">
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Anggota :</label></div>
										<div class="col-6"><label><?= $item['nama_anggota'] ?></label></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Jumlah Simpanan Wajib :</label></div>
										<div class="col-6"><label>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></label></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Jumlah Simpanan Pokok :</label></div>
										<div class="col-6"><label>Rp <?= number_format($item['jumlah_simpanan_pokok'], 0, ',', '.') ?></label></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Nama Pegawai :</label></div>
										<div class="col-6"><label><?= $item['nama_pegawai'] ?></label></div>
									</div>
									<div class="row form-group" style="border: 2px solid #ff0000; padding: 8px; margin-bottom: 9px; background-color: #ffe9e9;">
										<div class="col col-md-7"><label for="textarea-input" class="form-control-label">Jumlah Nominal pada setoran ini :</label></div>
										<div class="col-5"><label>Rp <?= number_format($item['jumlah_setor_tunai'], 0, ',', '.') ?></label></div>
									</div>
									<div class="row form-group">
										<div class="col col-md-6"><label for="textarea-input" class="form-control-label">Tanggal Transaksi:</label></div>
										<div class="col-6"><label><?= formatTanggal($item['tanggal_setor_tunai']) ?></label></div>
									</div>
								</div>
								<div class="col-md-12">
									<form action="<?= base_url() ?>simpanan/prosesHapusSetoran" method="POST">
										<input type="hidden" name="id_simpanan_detail" value="<?= $item['id_simpanan_detail'] ?>">
										<div class="row form-group">
											<div class="col col-md-3"><label for="textarea-input" class="form-control-label">Alasan :</label></div>
											<div class="col-9"><textarea name="pesan_aksi" id="textarea-input" rows="5" placeholder="Anda wajib menuliskan alasan kenapa menghapus transaksi ini" required class="form-control"></textarea></div>
										</div>
										<div class="row form-group">
											<div class="col-md-12 text-center">
												<a href="<?= base_url() ?>simpanan/dataSimpanan" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Kembali</a>
												<button class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin Menghapus Transaksi ini?')"><i class="fa fa-trash"></i> Hapus Setoran</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php } ?>
                </div>
            </div>
        </div>
    </div>