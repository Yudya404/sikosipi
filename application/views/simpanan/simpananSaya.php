<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Simpanan</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah Simpanan Pokok</th>
                                    <th>Jumlah Simpanan Wajib</th>
                                    <th>Status Simpanan</th>
                                    <th>Aksi</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($simpanan as $item) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td><?= $item['jumlah_simpanan_pokok'] ?></td>
                                        <td><?= $item['jumlah_simpanan_wajib'] ?></td>
                                        <td><?= $item['status_simpanan'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>anggota/dataSetoranSaya/<?= $item['id_simpanan'] ?>" class="badge badge-warning"><i class="fa fa-list"></i> Riwayat Setoran</a>
                                            <a href="<?= base_url() ?>anggota/requestTarikSimpanan/<?= $item['id_simpanan'] ?>" class="badge badge-success"><i class="fa fa-plus"></i> Tarik Simpanan</a>
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