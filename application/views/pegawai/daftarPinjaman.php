<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Pinjaman</strong>
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
                                    <th>Nama </th>
                                    <th>Status </th>
                                    <th>Tanggal Pinjaman</th>
                                    <th>Tanggal Pelunasan</th>
                                    <th>Total Pinjaman</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$no = 1;
									
								foreach ($pinjaman as $item) { 
								?>
                                    <tr>
										<td><?= $no ?></td>
                                        <td><?= $item['nama_anggota'] ?></td>
                                        <td><?php
											$status_class = '';
											switch ($item['status_pinjaman']) {
												case 'Sudah Lunas':
													$status_class = 'badge-success';
													break;
												default:
													$status_class = 'badge-danger';
													break;
											}
											?>
											<span class="badge <?= $status_class ?>"><?= $item['status_pinjaman'] ?></span>
										</td>
                                        <td><?= formatTanggal($item['tanggal_meminjam']) ?></td>
                                        <td><?= $item['tanggal_pelunasan'] ?></td>
                                        <td><?= $item['total_pinjaman'] ?></td>
                                        <td>
                                            <?php
                                            if ($item['status_pinjaman'] == "Belum Lunas") {
                                            ?>
                                                <a href="<?= base_url() ?>pegawai/tambahAngsuran/<?= $item['id_pinjaman'] ?>" class="badge badge-success">
													<i class="fa fa-plus"></i> Angsuran Pinjaman
												</a>
                                            <?php
                                            }
                                            ?>
											<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_pinjaman'] ?>" class="badge badge-info"><i class="fa fa-eye"></i> Riwayat Angsuran</a>
                                        </td>
                                    </tr>
                                <?php 
									$no++;
								} ?>
                            </tbody>
                        </table>
						
						<!-- Penempatan Modal di Sini -->
						<?php foreach ($pinjaman as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_pinjaman'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_pinjaman'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_pinjaman'] ?>">Riwayat Angsuran <?= $item['nama_anggota'] ?></h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="row">
												<div class="col-md-12">
													<div class="card">
														<div class="card-header">
															<strong class="card-title">Detail</strong>
														</div>
														<div class="card-body">
															<table class="table table-striped table-bordered table-responsive-lg data-table">
																<thead>
																	<tr>
																		<th>No</th>
																		<th>Nama Anggota</th>
																		<th>Tanggal Transaksi</th>
																		<th>Jumlah Transaksi</th>
																		<th>Nama Teller</th>
																		<th>Aksi</th>
																</thead>
																<tbody>
																	<?php
																	$no = 1;
																	
																	foreach ($item['data_angsuran'] as $angsuran) {
																	
																	?>
																		<tr>
																			<td><?= $no ?></td>
																			<td><?= $angsuran['nama_anggota'] ?></td>
																			<td><?= formatTanggal($angsuran['tanggal_angsuran']) ?></td>
																			<td><?= $angsuran['angsuran_pembayaran'] ?></td>
																			<td><?= $angsuran['nama_pegawai'] ?></td>
																			<td>
																				<a href="<?= base_url() ?>pinjaman/hapusAngsuran/<?= $angsuran['id_angsuran_detail'] ?>" class="badge badge-danger">
																					<i class="fa fa-trash"></i> Hapus
																				</a>
																				<a href="<?= base_url() ?>pinjaman/cetakAngsuran/<?= $angsuran['id_angsuran_detail'] ?>" target="_blank" class="badge badge-success">
																					<i class="fa fa-print"></i> Cetak
																				</a>
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