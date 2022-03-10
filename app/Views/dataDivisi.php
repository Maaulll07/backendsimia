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
										<h2>Halaman Admin Data Divisi</h2>
										<p>ini adalah halaman untuk membuat dan mengedit data divisi <span class="bread-ntd"></span></p>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalone">Tambah Data Divisi</button>
                                <div class="modal fade" id="myModalone" role="dialog">
                                    <div class="modal-dialog modals-default">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/dataDivisi/save')?>">
                                            <div class="modal-body">
                                                <h2>Form Tambah Data Divisi</h2>

												<div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Pekerjaan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodePekerjaan" id="kodePekerjaan" class="form-control input-lg" required>
                                                                        <option value="">Pilih Pekerjaan</option>
                                                                        <?php 
                                                                        foreach($pekerjaan as $row){
                                                                            echo  '<option value="'.$row['kodePekerjaan'].'">'.$row['jenisPekerjaan'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Divisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="kodeDivisi" class="form-control input-sm" placeholder="Masukkan Kode Divisi" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Divisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="namaDivisi" class="form-control input-sm" placeholder="Masukkan Nama Divisi" required>
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
                                        <th>Kode Pekerjaan</th>
                                        <th>Kode Divisi</th>
                                        <th>Nama Divisi</th>
                                        <th>Action</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($divisi as $key => $data):?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $data['kodePekerjaan']?></td>
                                        <td><?= $data['kodeDivisi']?></td>
                                        <td><?= $data['namaDivisi']?></td>
                                        <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-<?= $data['id'] ?>">Edit</button>
                                        <a href="<?= base_url('/dataDivisi/hapus/'.$data['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ingin Hapus Data ?')">Hapus</a>
                                        </td>                                        
                                    </tr>
                                    <div class="modal fade" id="editModal-<?= $data['id']?>" role="dialog">
                                        <div class="modal-dialog modals-default">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <form method="post" action="<?= base_url('/dataDivisi/edit/'.$data['id'])?>">
                                                <div class="modal-body">
                                                <h2>Form Edit Data Divisi</h2>

												<div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Pekerjaan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodePekerjaan" id="kodePekerjaan" class="form-control input-lg" required>
                                                                        <option value="">Pilih Pekerjaan</option>
                                                                        <?php foreach($pekerjaan as $row) :?>
                                                                        
                                                                            <option value="<?= $row['kodePekerjaan']?>" <?php if($row['kodePekerjaan']==$data['kodePekerjaan']){echo 'selected';}?>><?= $row['jenisPekerjaan']?></option>;
                                                                        
                                                                        <?php endforeach ;?>
                                                                    </select>                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                </div>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Divisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="kodeDivisi" class="form-control input-sm" value="<?= $data['kodeDivisi']?>" placeholder="Masukkan Kode Divisi" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Divisi</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="namaDivisi" class="form-control input-sm" value="<?= $data['namaDivisi']?>" placeholder="Masukkan Nama Divisi" required>
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