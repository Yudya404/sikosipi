<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"> Angsuran Saya </strong>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url() ?>pinjaman/pinjamanSaya" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</a><br><br>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Tanggal Angsuran</th>
                                    <th>Jumlah Angsuran</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($pinjaman as $item) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td><?= $item['tanggal_angsuran'] ?></td>
                                        <td><?= $item['angsuran_pembayaran'] ?></td>
                                        <td><a href="<?= base_url() ?>pinjaman/cetakAngsuranSaya/<?= $item['id_angsuran_detail'] ?>" target="_blank" class="badge badge-warning"><i class="fa fa-print"></i>Cetak</a></td>
                                    </tr>
                                <?php
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->