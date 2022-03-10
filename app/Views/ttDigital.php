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
										<h2>Halaman Admin Tanda Tangan Digital</h2>
										<p>ini adalah halaman untuk melihat tanda tangan digital <span class="bread-ntd"></span></p>
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
                            <h2>Data Tanda Tangan Digital</h2>
                            
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIP</th>
                                        <th>Nama</th>
                                        <th>Peruntukan</th>
                                        <th>Tanggal DIbuat</th>
                                        <th>Kode Akses</th>
                                        <th>Nama Dokumen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($ttd as $key => $tanda) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $tanda['nip']?></td>
                                        <td><?= $tanda['nama']?></td>
                                        <td><?= $tanda['peruntukan']?></td>
                                        <td><?= $tanda['tanggalPembuatan']?></td>
                                        <td><?= $tanda['kode']?></td>
                                        <td><?= $tanda['namaDokumen']?></td>
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