<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Riwayat Pengajuan Penarikan Simpanan</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Total Penarikan</th>
                                    <th>Total Penarikan</th>
                                    <th>Tanggal Pengajuan Penarikan</th>
                                    <th>Status Penarikan</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($simpanan as $item) { ?>
                                    <tr>
                                        <td><?= $item['nominal_total_penarikan'] ?></td>
                                        <td><?= $item['total_akhir_simpanan'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($item['tanggal_permintaan_penarikan'])) ?></td>
                                        <td><?= $item['status_penarikan'] ?></td>
                                        <td><?= $item['pesan'] ?></td>
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