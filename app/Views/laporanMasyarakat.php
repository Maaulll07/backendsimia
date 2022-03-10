<!-- Breadcomb area Start-->
<div class="breadcomb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcomb-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcomb-wp">
									<div class="breadcomb-icon">
										<i class="notika-icon notika-edit"></i>
									</div>
									<div class="breadcomb-ctn">
										<h2>Halaman Admin Laporan Masyarakat</h2>
										<p>ini adalah halaman untuk melihat laporan masyarakat<span class="bread-ntd"></span></p>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
								<div class="breadcomb-report">
									<button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="notika-icon notika-sent"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcomb area End-->
	<!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd">
                            <?php if(session()->getFlashdata('msg')):?>
                                <div class="alert alert-info"><?= session()->getFlashdata('msg') ?></div>
                            <?php endif;?>
                            <h2>Laporan Masyarakat</h2>
                            
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Isi Laporan</th>
                                        <th>Kontak</th>
                                        <th>Tanggal Laporan</th>
                                        <th>Foto Laporan</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($laporanMasyarakat as $key => $laporan) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $laporan['nama']?></td>
                                        <td><?= $laporan['isi']?></td>
                                        <td><?= $laporan['kontak']?></td>
                                        <td><?= $laporan['tanggal']?></td>
                                        <td><img src=" <?= base_url('uploads/'.$laporan['file']) ?> " width="100"></td>
                                        <td><?= $laporan['status']?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-<?= $laporan['id'] ?>">Edit</button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal-<?= $laporan['id']?>" role="dialog">
                                        <div class="modal-dialog modals-default">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post" action="<?= base_url('/laporan/edit/'.$laporan['id'])?>">
                                                <div class="modal-body">
                                                <h2>Form Edit Laporan Masyarakat</h2>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Status</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                <select name="status" id="status" class="form-control input-lg" required>
                                                                        <option value="pending" <?php if($laporan['status'] == 'pending'){ echo 'selected';}?>>Pending</option>
                                                                        <option value="acc" <?php if($laporan['status'] == 'acc'){ echo 'selected';}?>>Terima</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Edit</button>
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ;?>
                                </tbody>
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->