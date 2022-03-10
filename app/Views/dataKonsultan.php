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
										<h2>Halaman Admin Data Konsultan</h2>
										<p>ini adalah halaman untuk membuat dan mengedit data konsultan <span class="bread-ntd"></span></p>
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
                            <div class="modals-single">
                                <div class="modals-default-cl">
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalone">Tambah Data Konsultan</button>
                                <div class="modal fade" id="myModalone" role="dialog">
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/dataKonsultan/save')?>">
                                            <div class="modal-body">
                                                <h2>Form Tambah Data Konsultan</h2>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Konsultan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="kodeKonsultan" class="form-control input-sm" placeholder="Masukkan Kode Konsultan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Konsultan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="namaKonsultan" class="form-control input-sm" placeholder="Masukkan Nama Konsultan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Konsultan Supervisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="supervisi" class="form-control input-sm" placeholder="Masukkan Nama Konsultan Supervisi" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Inspector</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="inspector" class="form-control input-sm" placeholder="Masukkan Nama Inspector" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Konsultan</th>
                                        <th>Nama Konsultan</th>
                                        <th>Nama Supervisi</th>
                                        <th>Nama Inspector</th>
                                        <th>Action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($Konsultan as $key => $data):?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $data['kodeKonsultan']?></td>
                                        <td><?= $data['namaKonsultan']?></td>
                                        <td><?= $data['supervisi']?></td>
                                        <td><?= $data['inspector']?></td>
                                        <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-<?= $data['id'] ?>">Edit</button>
                                        <a href="<?= base_url('/dataKonsultan/hapus/'.$data['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ingin Hapus Data ?')">Hapus</a>
                                        </td>                                        
                                    </tr>
                                    <div class="modal fade" id="editModal-<?= $data['id']?>" role="dialog">
                                        <div class="modal-dialog modals-default">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post" action="<?= base_url('/dataKonsultan/edit/'.$data['id'])?>">
                                                <div class="modal-body">
                                                <h2>Form Edit Data Konsultan</h2>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Konsultan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="kodeKonsultan" class="form-control input-sm" value="<?= $data['kodeKonsultan']?>" placeholder="Masukkan Kode Konsultan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Konsultan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="namaKonsultan" class="form-control input-sm" value="<?= $data['namaKonsultan']?>" placeholder="Masukkan Nama Konsultan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Konsultan Supervisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="supervisi" class="form-control input-sm" value="<?= $data['supervisi']?>" placeholder="Masukkan Nama Konsultan Supervisi" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Inspector</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="inspector" class="form-control input-sm" value="<?= $data['inspector']?>" placeholder="Masukkan Nama Inspector" required>
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
                                    <?php endforeach;?>
                                </tbody>                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->