<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Terima Pengajuan Pinjaman</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <?php if (validation_errors()) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    <?= validation_errors() ?>
                                </div>
                            <?php
                            } ?>
                            <?php
                            foreach ($pinjaman as $item) {
                            ?>
                                <form action="<?= base_url() ?>pegawai/prosesTambahPinjaman" method="POST">
                                    <div class="card-body card-block">
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="textarea-input" class=" form-control-label">Nama Anggota</label></div>
                                            <div class="col-12 col-md-9"><label><?= $item['nama_anggota'] ?></label></div>
                                        </div>
                                        <input type="hidden" value="<?= $item['id_anggota'] ?>" name="id_anggota">
                                        <input type="hidden" value="<?= $item['id_pengajuan'] ?>" name="id_pengajuan">
                                        <div class="form-group">
                                            <label class=" form-control-label">Tanggal Meminjam</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input class="form-control" type="text" value="<?= date('Y-m-d'); ?>" readonly name="tanggal_meminjam" id="tanggal_meminjam" required>
                                            </div>
                                            <small class="form-text text-muted">ex. 18-10-2020</small>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Total Pinjaman</label>
                                            <div class="input-group">
                                                <?php
                                                $totalPinjaman = $item['total_pengajuan_pinjaman'];
                                                $jumlahPinjamanBunga = $totalPinjaman + ($totalPinjaman * 0.05);
                                                $angsuran = $jumlahPinjamanBunga / 10;
                                                ?>
                                                <div class="input-group-addon"><i class="fa fa-question"></i></div>
                                                <input class="form-control" type="text" readonly value="<?= $totalPinjaman ?>" name="total_pinjaman" id="total_pinjaman" required>
                                            </div>
                                            <small class="form-text text-muted">Total Biaya yang diajukan * 5%</small>
                                        </div>
                                        <div class="form-group">
                                            <label class=" form-control-label">Angsuran Bulanan</label>
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                                <input class="form-control" type="text" readonly value="<?= $angsuran ?>" name="angsuran_bulanan" id="angsuran_bulanan" required>
                                            </div>
                                            <small class="form-text text-muted">Total Pinjaman / 10</small>
                                        </div>
                                        <a href="<?= base_url() ?>pegawai/daftarPengajuanPinjaman" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
                                        <button type="submit" name="submit" onclick="return confirm('Apakah anda yakin ingin Menambahkan Pinjaman Ini?')" class="btn btn-primary btn-sm">Submit</button>
                                </form>
                        </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>