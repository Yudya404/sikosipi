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
									<?php foreach ($data_setoran as $item) { ?>
                                    <strong>Pembayaran Setoran Simpanan Wajib <?= $item['nama_anggota'] ?> </strong>
									<?php } ?>
                                </div>
                                <div class="card-body card-block">
                                    <form action="<?= base_url() ?>simpanan/proses_tambah_setoran" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        <?php foreach ($data_setoran as $item) { ?>
                                            <input type="hidden" name="id_simpanan" value="<?= $item['id_simpanan'] ?>">
                                        <?php } ?>
                                        <div class="row form-group">
											<div class="col col-md-3"><label for="text-input" class="form-control-label">Jumlah Setor Tunai :</label></div>
											<div class="col-12 col-md-9 d-flex align-items-center">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">Rp</div>
													</div>
												<input type="number" id="text-input" name="jumlah_setor_tunai" placeholder="Number" value="50000" class="form-control" readonly>
												<small class="form-text text-muted"></small>
												</div>
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