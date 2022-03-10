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
										<h2>Halaman Admin Info Kegiatan</h2>
										<p>ini adalah halaman untuk membuat dan mengedit info kegiatan <span class="bread-ntd"></span></p>
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
                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModalone">Tambah Info Kegiatan</button>
                                <div class="modal fade" id="myModalone" role="dialog">
                                    <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/info/save')?>">
                                            <div class="modal-body">
                                                <h2>Form Tambah Info Kegiatan</h2>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Nama Kegiatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="namaProyek" id="namaProyek" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama Kegiatan</option>
                                                                        <?php 
                                                                        foreach($proyek as $row){
                                                                            echo  '<option value="'.$row['id'].'">'.$row['namaProyek'].'</option>';
                                                                        }
                                                                        ?>
                                                                    </select>                                                                    
                                                                </div>
                                                                <div class="nk-int-st" id="namaProyek1"></div>
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
                                                                    <select name="subProyek" id="subProyek" class="form-control" disabled></select>
                                                                    
                                                                </div>
                                                                <div class="nk-int-st" id="subProyek1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Tanggal Kegiatan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">                                                     
                                                                    
                                                                    <select name="tanggalProyek" id="tanggalProyek" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="tanggalProyek1"></div>
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
                                                                    
                                                                    <select name="nilaiKontrak" id="nilaiKontrak" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="nilaiKontrak1"></div>
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
                                                                    
                                                                    <select name="kodeLelang" id="kodeLelang" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="kodeLelang1"></div>
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
                                                                    
                                                                    <select name="tahunAnggaran" id="tahunAnggaran" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="tahunAnggaran1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                                                

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Lokasi Proyek</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">                                                     
                                                                    
                                                                    <select name="lokasiProyek" id="lokasiProyek" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="lokasiProyek1"></div>
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
                                                                    
                                                                    <select name="nomorKontrak" id="nomorKontrak" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="nomorKontrak1"></div>
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
                                                                    
                                                                    <select name="status" id="status" class="form-control" disabled></select>
                                                                </div>
                                                                <div class="nk-int-st" id="status1"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Kode Laporan</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">                                                     
                                                                    
                                                                <input type="text" name="kodeLaporan" class="form-control input-sm" placeholder="Masukkan Kode Laporan" required>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Jenis Proyek</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodePekerjaan" id="kodePekerjaan" class="form-control input-lg" required>
                                                                        <option value="">Pilih Jenis Proyek</option>
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
                                                                <label class="hrzn-fm">K/L/P/D</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <input type="text" name="klpd" class="form-control input-sm" placeholder="Masukkan K/L/P/D" required>
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
                                                                    <select name="kodeKonsultan" id="kodeKonsultan" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama Konsultan</option>
                                                                        <?php 
                                                                        foreach($konsultan as $row){
                                                                            echo  '<option value="'.$row['kodeKonsultan'].'">'.$row['namaKonsultan'].'</option>';
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
                                                                <label class="hrzn-fm">Nama Kontraktor</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodeKontraktor" id="kodeKontraktor" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama Kontraktor</option>
                                                                        <?php 
                                                                        foreach($kontraktor as $row){
                                                                            echo  '<option value="'.$row['kodeKontraktor'].'">'.$row['namaKontraktor'].'</option>';
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
                                                                <label class="hrzn-fm">Nama PPK</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodePPK" id="kodePPK" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama PPK</option>
                                                                        <?php 
                                                                        foreach($ppk as $row){
                                                                            echo  '<option value="'.$row['kodePPK'].'">'.$row['namaPPK'].'</option>';
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
                                                                <label class="hrzn-fm">Nama PPTK</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodePPTK" id="kodePPTK" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama PPTK</option>
                                                                        <?php 
                                                                        foreach($pptk as $row){
                                                                            echo  '<option value="'.$row['kodePPTK'].'">'.$row['namaPPTK'].'</option>';
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
                                                                <label class="hrzn-fm">Nama Inspector</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="kodeInspector" id="kodeInspector" class="form-control input-lg" required>
                                                                        <option value="">Pilih Nama Inspector</option>
                                                                        <?php 
                                                                        foreach($inspector as $row){
                                                                            echo  '<option value="'.$row['kodeInspector'].'">'.$row['namaInspector'].'</option>';
                                                                        }
                                                                        ?>
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
                                        <th>Pekerjaan</th>
                                        <th>Lokasi</th>
                                        <th>Tanggal Kontrak</th>
                                        <th>K/L/P/D</th>
                                        <th>Konsultan</th>
                                        <th>Penyedia Jasa</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($infoKegiatan as $key => $info) :?>
                                    <tr>
                                        <td><?= ++$key?></td>
                                        <td><?= $info['namaProyek']?></td>
                                        <td><?= $info['kodePekerjaan']?></td>
                                        <td><?= $info['lokasiProyek']?></td>
                                        <td><?= $info['tanggalProyek']?></td>
                                        <td><?= $info['klpd']?></td>
                                        <td><?= $info['kodeKonsultan']?></td>
                                        <td><?= $info['kodeKontraktor']?></td>
                                        <td><?= $info['status']?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal-<?= $info['id'] ?>">Edit</button>
                                            <a href="<?= base_url('/info/hapus/'.$info['id']) ?>" class="btn btn-danger" onclick="return confirm('Apakah Yakin ingin Hapus Data ?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editModal-<?= $info['id']?>" role="dialog">
                                        <div class="modal-dialog modal-large">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form method="post" action="<?= base_url('/info/edit/'.$info['id'])?>">
                                            <div class="modal-body">
                                                <h2>Form Edit Info Kegiatan</h2>
                                                
                                                <div class="form-example-int form-horizental">
                                                    <div class="form-group">
                                                        <div class="row">
                                                            <div class="col-lg-2 col-md-3 col-sm-3 col-xs-12">
                                                                <label class="hrzn-fm">Status</label>
                                                            </div>
                                                            <div class="col-lg-8 col-md-7 col-sm-7 col-xs-12">
                                                                <div class="nk-int-st">
                                                                    <select name="status" id="status" class="form-control input-lg" required>
                                                                            <option value="pending" <?php if($info['status'] == "pending"){ echo "selected" ;}?>>Pending</option>;
                                                                            <option value="berjalan" <?php if($info['status'] == "berjalan"){ echo "selected" ;}?>>Berjalan</option>;
                                                                            <option value="selesai" <?php if($info['status'] == "selesai"){ echo "selected" ;}?>>Selesai</option>;
                                                                        
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
    <script src="<?= base_url('js/beranda/jquery-3.3.1.js')?>"></script>
    <script type=text/javascript>
        $(document).ready(function(){

$('#namaProyek').change(function(){

    var proyek_id = $(this).val();
    $.ajax({
        url : "<?= base_url('/info/getProyek')?>",
        method : "POST",
        data : {id: proyek_id},
        async : true,
        dataType : 'json',
        success : function(data){
            var nama = '';
            var sub = '';
            var nilai = '';
            var lelang = '';
            var lokasi = '';
            
            var namaProyek1 = '';            
            var subProyek = '';
            var subProyek1 = '';
            var tanggalProyek = '';
            var tanggalProyek1 = '';
            var nilaiKontrak = '';
            var nilaiKontrak1 = '';
            var kodeLelang = '';
            var kodeLelang1 = '';
            var tahunAnggaran = '';
            var tahunAnggaran1 = '';            
            var lokasiProyek = '';
            var lokasiProyek1 = '';
            var nomorKontrak = '';
            var nomorKontrak1 = '';
            var status = '';
            var status1 = '';
            var i;
            for(i=0; i<data.length; i++){
                nama = JSON.stringify(data[i].namaProyek);
                sub = JSON.stringify(data[i].subProyek);
                nilai = JSON.stringify(data[i].nilaiKontrak);
                lelang = JSON.stringify(data[i].kodeLelang);
                lokasi = JSON.stringify(data[i].lokasiProyek);
                namaProyek1 += '<input type="hidden" name="namaProyek" value='+nama+'>';
                subProyek += '<option value='+data[i].subProyek+' selected>'+data[i].subProyek+'</option>';
                subProyek1 += '<input type="hidden" name="subProyek" value='+sub+'>';
                tanggalProyek += '<option value='+data[i].tanggalProyek+' selected>'+data[i].tanggalProyek+'</option>';
                tanggalProyek1 += '<input type="hidden" name="tanggalProyek" value='+data[i].tanggalProyek+' >';
                nilaiKontrak += '<option value='+data[i].nilaiKontrak+' selected>'+data[i].nilaiKontrak+'</option>';
                nilaiKontrak1 += '<input type="hidden" name="nilaiKontrak" value='+nilai+'>';
                kodeLelang += '<option value='+data[i].kodeLelang+' selected>'+data[i].kodeLelang+'</option>';
                kodeLelang1 += '<input type="hidden" name="kodeLelang" value='+lelang+'>';
                tahunAnggaran += '<option value='+data[i].tahunAnggaran+' selected>'+data[i].tahunAnggaran+'</option>';
                tahunAnggaran1 += '<input type="hidden" name="tahunAnggaran" value='+data[i].tahunAnggaran+'>';                
                lokasiProyek += '<option value='+data[i].lokasiProyek+' selected>'+data[i].lokasiProyek+'</option>';
                lokasiProyek1 += '<input type="hidden" name="lokasiProyek" value='+lokasi+'>';
                nomorKontrak += '<option value='+data[i].nomorKontrak+' selected>'+data[i].nomorKontrak+'</option>';
                nomorKontrak1 += '<input type="hidden" name="nomorKontrak" value='+data[i].nomorKontrak+'>';
                status += '<option value='+data[i].status+' selected>'+data[i].status+'</option>';
                status1 += '<input type="hidden" name="status" value='+data[i].status+'>';
                
            }
            $('#namaProyek1').html(namaProyek1);
            $('#subProyek').html(subProyek);            
            $('#subProyek1').html(subProyek1);
            $('#tanggalProyek').html(tanggalProyek);
            $('#tanggalProyek1').html(tanggalProyek1);
            $('#nilaiKontrak').html(nilaiKontrak);
            $('#nilaiKontrak1').html(nilaiKontrak1);
            $('#kodeLelang').html(kodeLelang);
            $('#kodeLelang1').html(kodeLelang1);
            $('#tahunAnggaran').html(tahunAnggaran);
            $('#tahunAnggaran1').html(tahunAnggaran1);            
            $('#lokasiProyek').html(lokasiProyek);
            $('#lokasiProyek1').html(lokasiProyek1);
            $('#nomorKontrak').html(nomorKontrak);
            $('#nomorKontrak1').html(nomorKontrak1);
            $('#status').html(status);
            $('#status1').html(status1);

        }

    });
    return false;
    

    
    
});


});
    </script>