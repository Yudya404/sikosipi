<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"> Daftar Transaksi Simpanan</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
						<div class="d-flex justify-content-between">
							<div>
								<a href="<?= base_url() ?>simpanan/cetakTransaksiDataSimpanan" target="_blank" class="btn btn-primary btn-sm">
									<i class="fa fa-print"></i> Cetak Data
								</a>
							</div>
							<div>
								<a href="<?= base_url() ?>simpanan/tambah_simpanan" class="btn btn-success btn-sm">
									<i class="fa fa-plus"></i> Simpanan Pokok
								</a><br><br>
							</div>
						</div>
						<table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama</th>
									<th>Tanggal Transaksi</th>
									<th>Jumlah Simpanan Pokok</th>
									<th>Jumlah Simpanan Wajib</th>
									<th>Total (Pokok + Wajib)</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								$total_pokok = 0;
								$total_wajib = 0;

								foreach ($simpanan as $item) {
									// Check if the status_simpanan is not 'Sudah Ditarik'
									if ($item['status_simpanan'] != 'Sudah Ditarik') {
										$total_pokok += $item['jumlah_simpanan_pokok'];
										$total_wajib += $item['jumlah_simpanan_wajib'];
										$total_simpanan = $item['jumlah_simpanan_pokok'] + $item['jumlah_simpanan_wajib'];
								?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $item['nama_anggota'] ?></td>
										<td><?= formatTanggal($item['tgl_transaksi_sp']) ?></td>
										<td>Rp <?= number_format($item['jumlah_simpanan_pokok'], 0, ',', '.') ?></td>
										<td>Rp <?= number_format($item['jumlah_simpanan_wajib'], 0, ',', '.') ?></td>
										<td>Rp <?= number_format($total_simpanan, 0, ',', '.') ?></td>
										<td>
											<?php
											$status_class = '';
											switch ($item['status_simpanan']) {
												case 'Sudah Ditarik':
													$status_class = 'badge-success';
													break;
												case 'Sedang Diverifikasi':
													$status_class = 'badge-warning';
													break;
												default:
													$status_class = 'badge-primary';
													break;
											}
											?>
											<span class="badge <?= $status_class ?>"><?= $item['status_simpanan'] ?></span>
										</td>
										<td>
											<?php if ($item['status_simpanan'] != "Sudah Ditarik") { ?>
												<a href="<?= base_url() ?>simpanan/tambah_setoran/<?= $item['id_simpanan'] ?>" class="badge badge-success">
													<i class="fa fa-plus"></i> Simpanan Wajib
												</a>
											<?php } ?>
											<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_simpanan'] ?>" class="badge badge-info">
												<i class="fa fa-eye"></i> Riwayat Setoran
											</a>
										</td>
									</tr>
								<?php
									$no++;
									}
								} ?>
							</tbody>
							<tfoot>
								<tr>
									<th colspan="3">Total Simpanan :</th>
									<th>Rp <?= number_format($total_pokok, 0, ',', '.') ?></th>
									<th>Rp <?= number_format($total_wajib, 0, ',', '.') ?></th>
									<th>Rp <?= number_format($total_pokok + $total_wajib, 0, ',', '.') ?></th>
									<th colspan="2"></th>
								</tr>
							</tfoot>
						</table>

						<!-- Penempatan Modal di Sini -->
						<?php foreach ($simpanan as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_simpanan'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_simpanan'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_simpanan'] ?>">Riwayat Setoran Simpanan Wajib <?= $item['nama_anggota'] ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-header">
															<strong class="card-title">Riwayat</strong>
														</div>
														<div class="card-body">
															<table class="table table-striped table-bordered table-responsive-lg data-table">
																<thead>
																	<tr>
																		<th>No</th>
																		<th>Nama Anggota</th>
																		<th>Tanggal Transaksi</th>
																		<th>Jumlah</th>
																		<th>Nama Teller</th>
																		<th>Aksi</th>
																	</tr>
																</thead>
																<tbody>
																	<?php
																	$no_setoran = 1;
																	$total_setoran = 0; // Variable to store total amount of deposits

																	foreach ($item['data_setoran'] as $setoran) {
																		if ($setoran['jumlah_setor_tunai'] != 0 && $item['status_simpanan'] != 'Sudah Ditarik') {
																			$total_setoran += $setoran['jumlah_setor_tunai']; // Adding each deposit amount to the total
																	?>
																			<tr>
																				<td><?= $no_setoran ?></td>
																				<td><?= $setoran['nama_anggota'] ?></td>
																				<td><?= formatTanggal($setoran['tanggal_setor_tunai']) ?></td>
																				<td>Rp <?= number_format($setoran['jumlah_setor_tunai'], 0, ',', '.') ?></td>
																				<td><?= $setoran['nama_pegawai'] ?></td>
																				<td>
																					<a href="<?= base_url() ?>simpanan/hapusSetoran/<?= $setoran['id_simpanan_detail'] ?>" class="badge badge-danger"><i class="fa fa-trash-o"></i>Hapus</a>
																					<a href="<?= base_url() ?>simpanan/cetakSetoranSaya/<?= $setoran['id_simpanan_detail'] ?>" target="_blank" class="badge badge-success"><i class="fa fa-print"></i>Cetak</a>
																				</td>
																			</tr>
																	<?php
																			$no_setoran++;
																		}
																	}
																	?>
																</tbody>
																<tfoot>
																	<tr>
																		<th colspan="3">Total Simpanan Wajib :</th>
																		<th>Rp <?= number_format($total_setoran, 0, ',', '.') ?></th>
																		<th colspan="2"></th>
																	</tr>
																</tfoot>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

