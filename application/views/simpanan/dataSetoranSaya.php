<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Riwayat Setoran</strong>
                    </div>
                    <div class="card-body">
                        <a href="<?= base_url() ?>anggota/simpananSaya" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left"></i> Back</a><br><br>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penyetor</th>
                                    <th>Tanggal Setor Tunai</th>
                                    <th>Jumlah Setoran Tunai</th>
                                    <th>Nama Teller</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($data_setoran as $item) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($item['tanggal_setor_tunai'])) ?></td>
                                        <td><?= $item['jumlah_setor_tunai'] ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>anggota/cetakSetoranSaya/<?= $item['id_simpanan_detail'] ?>" target="_blank" class="badge badge-warning"><i class="fa fa-print"></i>Cetak</a>
                                        </td>
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