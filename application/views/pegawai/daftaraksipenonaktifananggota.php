<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Permintaan Penonaktifan</strong>
                    </div>
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<div>
								<a href="<?= base_url() ?>pegawai/cetakAksiPenonaktifanAnggota" target="_blank" class="btn btn-primary btn-sm">
									<i class="fa fa-print"></i> Cetak Data
								</a>
							</div>
						</div>
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
									<th>Nama Anggota</th>
                                    <th>Tanggal Permintaan</th>
                                    <th>Pegawai Yang Request</th>
                                    <th>Admin Yang Memverifikasi</th>
                                    <th>Status Permintaan</th>
                                    <th>Status Verifikasi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$no = 1;
								
                                foreach ($aksi as $item) { 
								
								?>
                                    <tr>
										<td><?= $no ?></td>
										<td><?= $item['nama_anggota'] ?></td>
                                        <td><?= formatTanggal($item['tanggal_aksi']) ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td>
											<?php
												$status_class = '';
												if ($item['nama_admin'] == 'Sedang Diverifikasi') {
													$status_class = 'badge-Warning';
													echo '<span class="badge ' . $status_class . '">' . $item['nama_admin'] . '</span>';
												} else {
													echo $item['nama_admin'];
												}
											?>
										</td>
                                        <td>
											<?php
											$status_class = '';
											switch ($item['status_aksi']) {
												case 'Berhasil':
													$status_class = 'badge-success';
													break;
												case 'Ditolak':
													$status_class = 'badge-danger';
													break;
												default:
													$status_class = 'badge-warning';
													break;
											}
											?>
											<span class="badge <?= $status_class ?>"><?= $item['status_aksi'] ?></span>
										</td>
                                        <td>
											<?php
											$status_class = '';
											switch ($item['status_verifikasi']) {
												case 'Diterima':
													$status_class = 'badge-success';
													break;
												case 'Ditolak':
													$status_class = 'badge-danger';
													break;
												default:
													$status_class = 'badge-warning';
													break;
											}
											?>
											<span class="badge <?= $status_class ?>"><?= $item['status_verifikasi'] ?></span>
										</td>
                                        <td>
											<?php
											if ($item['status_verifikasi'] == "Pending") {

												if ($this->session->userdata('kategori') == "1") {
											?>
													<a href="<?= base_url() ?>pegawai/reviewPenonaktifanAnggota/<?= $item['id_aksi'] ?>" class="badge badge-info"><i class="fa fa-eye"></i> Review Aksi</a>
											<?php
												} else {
											?>
													<span class="badge badge-danger"><i class="fa fa-times"></i> Anda Bukan Admin</span>
											<?php
												}
											} else {
												if ("Aksi Telah Ditanggapi Admin") {
											?>
													<span class="badge badge-success"><i class="fa fa-check"></i> Permintaan Sudah Diverifikasi Admin</span>
											<?php
												} else {
													echo $item['status_verifikasi']; // Menampilkan status lain selain yang ditentukan
												}
											}
											?>
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