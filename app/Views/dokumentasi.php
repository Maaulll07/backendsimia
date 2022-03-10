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
										<h2>Halaman Admin Dokumentasi</h2>
										<p>ini adalah halaman untuk membuat dan mengedit dokumentasi <span class="bread-ntd"></span></p>
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
                            <h2>Dokumentasi</h2>
                            
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Proyek</th>
                                        <th>Nomor Kontrak</th>
                                        <th>Progres</th>
                                        <th>Foto</th>
                                        <th>Tanggal Posting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($dokumentasi as $key => $dokumen) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $dokumen['namaProyek']?></td>
                                        <td><?= $dokumen['nomorKontrak']?></td>
                                        <td><?= $dokumen['progres']?></td>
                                        <td><img src=" <?= base_url('uploads/'.$dokumen['namaFile']) ?> " width="100"></td>
                                        <td><?= $dokumen['tanggal']?></td>
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