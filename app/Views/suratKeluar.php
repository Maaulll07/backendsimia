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
										<h2>Halaman Admin Surat Keluar</h2>
										<p>ini adalah halaman untuk membuat dan mengedit surat keluar <span class="bread-ntd"></span></p>
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
                                
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Agenda</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal Kirim</th>
                                        <th>Tujuan Surat</th>
                                        <th>Untuk Pengguna</th>
                                        <th>Isi Ringkasan</th>
                                        <th>Status</th>                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($suratKeluar as $key => $surat) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $surat['noAgenda']?></td>
                                        <td><?= $surat['noSurat']?></td>
                                        <td><?= $surat['tanggalKirim']?></td>
                                        <td><?= $surat['tujuanSurat']?></td>
                                        <td><?= $surat['untukPengguna']?></td>
                                        <td><?= $surat['isiRingkasan']?></td>
                                        <td><?= $surat['status']?></td>
                                    </tr>
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