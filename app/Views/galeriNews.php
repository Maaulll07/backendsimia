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
										<h2>Halaman Admin Galeri News</h2>
										<p>ini adalah halaman untuk membuat dan mengedit galeri news <span class="bread-ntd"></span></p>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalone">Tambah Galeri News</button>
                                <div class="modal fade" id="myModalone" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/galeri/save')?>" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                <h2>Form Tambah Galeri News</h2>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Judul</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="judul" class="form-control input-sm" placeholder="Masukkan Judul Galeri News" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Foto</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="file" name="file[]" class="form-control" multiple="multiple">
                                                                </div>
																<div id="file"></div>
                                                            </div>
															<div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
																<button id="add" class="btn btn-primary">Tambah File</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                
                                                <input type="hidden" name="created" class="form-control input-sm" value="<?= date('Y-m-d h:i:sa')?>" required>                                                 
                                                <input type="hidden" name="user" class="form-control input-sm" value="<?= $user?>" required>
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
                                        <th>Judul</th>
                                        <th>File</th>                                        
                                        <th>Tanggal Pembuatan</th>
                                        <th>Pembuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach($galeriNews as $key => $gal) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $gal['judul']?></td>
                                        <td><img src=" <?= base_url('galeriNewsFolder/'.$gal['namaFile']) ?> " width="100"></td>
                                        <td><?= $gal['created']?></td>
                                        <td><?= $gal['user']?></td>                                        
                                        <td>
                                        
                                        <a href="<?= base_url('/galeri/hapus/'.$gal['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ingin Hapus Data ?')">Hapus</a>
                                        </td>
                                    </tr>
                                    
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
    <script src="<?= base_url('js/beranda/jquery-3.3.1.js')?>"></script>
    <script>
        $(document).ready(function(){
            $('#add').click(function(event){
                var tambahfile = $('#file');
                event.preventDefault(); 
                $('<div id="box"><input type="file" name="file[]" class="form-control" multiple/><button id="remove">Hapus</button></div>').appendTo(tambahfile);     
            });
            
            $('body').on('click','#remove',function(){  
                $(this).parent('div').remove(); 
            });     
        });
        </script>