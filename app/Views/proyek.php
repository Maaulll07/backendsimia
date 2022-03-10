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
										<h2>Halaman Admin Data Kegiatan</h2>
										<p>ini adalah halaman untuk membuat dan mengedit data kegiatan<span class="bread-ntd"></span></p>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalone">Tambah Data Kegiatan</button>
                                <div class="modal fade" id="myModalone" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/dataProyek/save')?>">
                                            <div class="modal-body">
                                                <h2>Form Tambah Data Kegiatan</h2>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Kegiatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="namaProyek" class="form-control input-sm" placeholder="Masukkan Nama Kegiatan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Lokasi Kegiatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodeKecamatan" id="kodeKecamatan" class="form-control input-lg" required>
                                                                        <option value="">Pilih Kecamatan</option>
                                                                        <?php 
                                                                        foreach($kecamatan as $row){
                                                                            echo  '<option value="'.$row['kodeKecamatan'].'">'.$row['namaKecamatan'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                    <select name="kodeKelurahan" id="kodeKelurahan" class="form-control"></select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Sub Kegiatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="subProyek" class="form-control input-sm" placeholder="Masukkan Sub Kegiatan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nilai Kontrak</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="nilaiKontrak" class="form-control input-sm" placeholder="Masukkan Nilai Kontrak" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nomor Kontrak</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="nomorKontrak" class="form-control input-sm" placeholder="Masukkan Nomor Kontrak" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Lelang</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="kodeLelang" class="form-control input-sm" placeholder="Masukkan Nama Kegiatan" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Tahun Anggaran</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="tahunAnggaran" class="form-control input-sm" placeholder="Masukkan Tahun Anggaran" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                    <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Tanggal Pembuatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="form-group nk-datapk-ctm form-elet-mg" id="data_1">                                
                                                                    <div class="input-group date nk-int-st">
                                                                        <span class="input-group-addon"></span>
                                                                            <input type="text" class="form-control" name="tanggalProyek" value="<?= date('Y-m-d')?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Progres</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="number" name="progres" class="form-control input-sm" placeholder="Masukkan Progres" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Status</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                <select name="status" id="status" class="form-control input-lg" required>
                                                                        <option value="pending">Pending</option>
                                                                        <option value="berjalan">Berjalan</option>
                                                                        <option value="selesai">Selesai</option>
                                                                    </select>
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
                                        <th>Kegiatan</th>
                                        <th>Sub Kegiatan</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal</th>
                                        <th>Tahun Anggaran</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($kegiatan as $key => $data) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $data['namaProyek']?></td>
                                        <td><?= $data['subProyek']?></td>
                                        <td><?= $data['lokasiProyek']?></td>
                                        <td><?= $data['tanggalProyek']?></td>
                                        <td><?= $data['tahunAnggaran']?></td>
                                        <td><?= $data['status']?></td>
                                    </tr>
                                    
                                </tbody>
                                <?php endforeach;?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Data Table area End-->
    <script src="<?= base_url('js/beranda/jquery-3.3.1.js')?>"></script>
    <script type=text/javascript>
        $(document).ready(function(){

$('#kodeKecamatan').change(function(){

    var kecamatan_id = $(this).val();
    $.ajax({
        url : "<?= base_url('/dataProyek/getKelurahan')?>",
        method : "POST",
        data : {id: kecamatan_id},
        async : true,
        dataType : 'json',
        success : function(data){
            var html = '';
            var kel = '';
            var i;
            for(i=0; i<data.length; i++){
                kel = JSON.stringify(data[i].kodeKelurahan);
                html += '<option value='+kel+'>'+data[i].namaKelurahan+'</option>';
                
            }
            $('#kodeKelurahan').html(html);

        }

    });
    return false;
    

    
    
});


});
    </script>