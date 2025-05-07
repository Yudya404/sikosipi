<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Riwayat Pengajuan Pinjaman</strong>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>Total Pengajuan</th>
                                    <th>Alasan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Status Pengajuan</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pinjaman as $item) { ?>
                                    <tr>
                                        <td><?= $item['total_pengajuan_pinjaman'] ?></td>
                                        <td><?= $item['alasan_pinjaman'] ?></td>
                                        <td><?= date("d-m-Y", strtotime($item['tanggal_pengajuan'])) ?></td>
                                        <td><?= $item['status_pengajuan'] ?></td>
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