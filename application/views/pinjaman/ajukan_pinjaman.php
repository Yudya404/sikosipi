<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Tambah Pengajuan Pinjaman</strong>
                    </div>
                    <div class="card-body">
                        <form action="<?= base_url() ?>pinjaman/prosesAjukanPinjaman" enctype="multipart/form-data" method="POST">
                            <div class="form-group">
                                <?php if (validation_errors()) {
                                ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= validation_errors() ?>
                                    </div>
                                <?php
                                } ?>
                                <input type="hidden" name="id_anggota" value="<?= $this->session->userdata('id_anggota'); ?>">
                                <label class=" form-control-label">Total Tunai Yang diajukan</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-money"></i></div>
                                    <input class="form-control" type="number" name="total_pengajuan_pinjaman" id="total_pengajuan_pinjaman" required autofocus>
                                </div>
                                <small class="form-text text-muted">ex. 5.000.000</small>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Alasan Pinjaman</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-question"></i></div>
                                    <input class="form-control" type="text" name="alasan_pinjaman" id="alasan_pinjaman" required>
                                </div>
                                <small class="form-text text-muted">ex. Untuk Keperluan Modal UMKM .....</small>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Lampiran Dokumen Pendukung</label>
                                <div class="input-group">
                                    <input class="form-control" type="file" name="lampiran_pendukung" id="lampiran_pendukung" required>
                                </div>
                                <small class="form-text text-muted">ex. Proposal Usaha</small>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>