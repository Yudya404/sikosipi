<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"> Pinjaman Anggota </strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Status pinjaman</th>
                                    <th>Tanggal Peminjaman</th>
                                    <th>Tanggal Pelunasan</th>
                                    <th>Total Pinjaman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pinjaman as $item) { ?>
                                    <tr>
                                        <td><?= $item['status_pinjaman'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($item['tanggal_meminjam'])) ?></td>
                                        <td><?= $item['tanggal_pelunasan'] ?></td>
                                        <td><?= $item['total_pinjaman'] ?></td>
                                        <td>
                                            <a href="<?= base_url() ?>pinjaman/angsuranSaya/<?= $item['id_pinjaman'] ?>" class="badge badge-info"><i class="fa fa-eye"></i> Riwayat Angsuran</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->