<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Laporan Angsuran Pinjaman</strong>
                    </div>
					<div class="card-body">
						<div class="row">
							<form action="<?= base_url() ?>pinjaman/filterLaporanAngsuran" method="POST">
								<div class="col-md-6 mb-3">
									<label class="form-control-label">Tanggal Awal</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											<input type="date" name="startDate" class="form-control" required>
										</div>
									</div>
								<div class="col-md-6 mb-3">
									<label class="form-control-label">Tanggal Akhir</label>
										<div class="input-group">
											<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
											<input type="date" name="endDate" class="form-control" required>
										</div>
									</div>
								<div class="col-12 mb-3">
									<button type="submit" name="submit" class="btn btn-success btn-sm"><i class="fa fa-search"></i> Filter</button>
									<?php if (!empty($startDate)) { ?>
										<form action="<?= base_url() ?>pinjaman/filterCetakPinjaman" method="POST" target="_blank" style="display: inline-block;">
											<input type="hidden" name="startDate" value="<?= $startDate ?>">
												<input type="hidden" name="endDate" value="<?= $endDate ?>">
											<button class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Filter Data</button>
										</form>
									<?php } else { ?>
										<a href="<?= base_url() ?>pinjaman/cetakTransaksiPinjaman" target="_blank" class="btn btn-primary btn-sm"><i class="fa fa-print"></i> Cetak Data</a>
									<?php } ?>
								</div>
							</form>
						</div>
					</div>
					
                    <div class="card-body">
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Anggota</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Jumlah Angsuran</th>
                                    <th>Nama Pegawai</th>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($angsuran_detail as $item) { ?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td><?= formatTanggal($item['tanggal_angsuran']) ?></td>
                                        <td><?= $item['angsuran_pembayaran'] ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
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