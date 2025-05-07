<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Request Penarikan Simpanan</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() ?>anggota/prosesRequestPenarikan" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <?php if (validation_errors()) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= validation_errors() ?>
                                    </div>
                                <?php
                                } ?>
                                <?php foreach ($simpanan as $item) {
                                    $totalPenarikan = $item['jumlah_simpanan_pokok'] + $item['jumlah_simpanan_wajib'];
                                ?>
                                    <input type="hidden" name="id_simpanan" value="<?= $item['id_simpanan'] ?>">
                                    <label class=" form-control-label">Total Tabungan Anda</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                        <input class="form-control" type="number" value="<?= $totalPenarikan ?>" name="nominal_total_penarikan" id="nominal_total_penarikan" required readonly>
                                    </div>
                                    <small class="form-text text-muted">*Tabungan belum dikalikan bunga, yang bertugas mengalikan pegawai</small>
                            </div>
                        <?php
                                } ?>
                        <a href="<?= base_url() ?>anggota/simpananSaya" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('Apakah anda yakin ingin Mengajukan Penarikan Simpanan?')">Request Penarikan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>