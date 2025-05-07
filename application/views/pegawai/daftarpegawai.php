<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Daftar Pegawai</strong>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($this->session->flashdata('message')) {
                            echo $this->session->flashdata('message');
                        } ?>
						<div class="text-right">
							<div>
								<a href="<?= base_url() ?>pegawai/tambahDataPegawai" class="btn btn-success btn-sm">
									<i class="fa fa-plus"></i> Tambah Pegawai
								</a><br><br>
							</div>
						</div>
                        <table id="bootstrap-data-table-export" class="table table-striped table-bordered table-responsive-lg">
                            <thead>
                                <tr>
									<th>No</th>
									<th>NIK</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>No Telfon</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
								$no = 1;
								foreach ($pegawai as $item) { 
								?>
                                    <tr>
										<td><?= $no ?></td>
										<td><?= $item['nik_pegawai'] ?></td>
                                        <td><?= $item['nama_pegawai'] ?></td>
                                        <td><?= $item['username'] ?></td>
                                        <td><?= $item['no_telp_pegawai'] ?></td>
                                        <td>
                                            <?php if ($item['kategori'] == 1) {
                                                echo 'Admin';
                                            } else {
                                                echo 'Pegawai';
                                            } ?>

                                        </td>
                                        <td>
											<a href="#" data-toggle="modal" data-target="#RiwayatModal<?= $item['id_pegawai'] ?>" class="badge badge-info">
												<i class="fa fa-eye"></i> Detail
											</a>
											<a href="<?= base_url() ?>pegawai/ubahDataPegawai/<?= $item['id_pegawai'] ?>" class="badge badge-success">
												<i class="fa fa-edit"></i> Edit
											</a>
											<a href="<?= base_url() ?>pegawai/hapusDataPegawai/<?= $item['id_pegawai'] ?>" class="badge badge-danger" onclick="return confirm('Apakah anda yakin ingin menghapus Data Pegawai?')">
												<i class="fa fa-trash"></i> Hapus
											</a>
                                        </td>
                                    </tr>
                                <?php 
									$no++;
								} ?>
                            </tbody>
                        </table>
						
						<!-- Penempatan Modal di Sini -->
						<?php foreach ($pegawai as $item) { ?>
							<div class="modal fade" id="RiwayatModal<?= $item['id_pegawai'] ?>" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="RiwayatModalLabel<?= $item['id_pegawai'] ?>" aria-hidden="true">
								<div class="modal-dialog modal-custom-size" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="RiwayatModalLabel<?= $item['id_pegawai'] ?>">Detail Pegawai</h5>
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
														<div class="card-body card-block">
															<div class="row">
																<div class="col-md-8">
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">NIK Pegawai :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['nik_pegawai'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">Nama Pegawai :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['nama_pegawai'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">Alamat Pegawai :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['alamat_pegawai'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">No Telpon :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['no_telp_pegawai'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">Username :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['username'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">Email :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext"><?= $item['email'] ?></label>
																		</div>
																	</div>
																	<div class="form-group row">
																		<label class="col-md-3 col-form-label">Kategori :</label>
																		<div class="col-md-9">
																			<label class="form-control-plaintext">
																				<?= $item['kategori'] == "1" ? 'Admin' : 'Pegawai' ?>
																			</label>
																		</div>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group row">
																		<label class="col-12 col-form-label text-center">Foto Pegawai :</label>
																		<div class="col-12 text-center">
																			<img src="<?php echo base_url('assets/datakoperasi/foto/' . $item['foto_pegawai']) ?>" class="img-fluid" alt="Foto Pegawai"/>
																		</div>
																	</div>
																</div>
															</div>
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