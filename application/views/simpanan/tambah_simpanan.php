<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <!--/.col-->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card-block">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Pembayaran Simpanan Pokok</strong>
                                </div>
                                <div class="card-body card-block">
									<form action="<?= base_url() ?>simpanan/tambah_simpanan" method="post" enctype="multipart/form-data" class="form-horizontal">
										<div class="row form-group">
											<div class="col col-md-3">
												<label for="select2" class="form-control-label">Nama Anggota :</label>
											</div>
											<div class="col-12 col-md-9">
												<select name="id_anggota" id="select2" class="form-control" required>
													<option value="">Pilih Nama</option>
													<?php if (!empty($anggota)) { ?>
														<?php foreach ($anggota as $item) { ?>
															<option value="<?= $item['id_anggota'] ?>"><?= $item['nama_anggota'] ?></option>
														<?php } ?>
													<?php } else { ?>
														<option value="" disabled>Tidak ada anggota yang tersedia</option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="row form-group">
											<div class="col col-md-3">
												<label for="jumlah_simpanan_pokok" class="form-control-label">Simpanan Pokok :</label>
											</div>
											<div class="col-12 col-md-9">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">Rp</div>
													</div>
													<input type="number" id="jumlah_simpanan_pokok" name="jumlah_simpanan_pokok" placeholder="Number" value="100000" class="form-control" readonly>
												</div>
												<small class="form-text text-muted"></small>
											</div>
										</div>
										<div class="col-md-12 text-center">
											<a href="<?= base_url() ?>simpanan/dataSimpanan" class="btn btn-primary btn-sm">
												<i class="fa fa-arrow-left"></i> Kembali
											</a>
											<button type="submit" name="submit" class="btn btn-danger btn-sm">
												<i class="fa fa-save"></i> Simpan
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
