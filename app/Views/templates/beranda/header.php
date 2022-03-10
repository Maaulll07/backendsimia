<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Halaman Admin SIMIA</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url()?>/favicons.ico" type="image/x-icon">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/bootstrap.min.css')?>">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/font-awesome.min.css')?>">
    <!-- owl.carousel CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/owl.carousel.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/beranda/owl.theme.css')?>">
    <link rel="stylesheet" href="<?= base_url('css/beranda/owl.transitions.css')?>">
    <!-- meanmenu CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/meanmenu/meanmenu.min.css')?>">
    <!-- animate CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/animate.css')?>">
    <!-- normalize CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/normalize.css')?>">
    <!-- mCustomScrollbar CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/scrollbar/jquery.mCustomScrollbar.min.css')?>">
    <!-- summernote CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/summernote/summernote.css')?>">
    <!-- datapicker CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/datapicker/datepicker3.css')?>">
    
    <!-- notika icon CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/notika-custom-icon.css')?>">
    <!-- Data Table JS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/jquery.dataTables.min.css')?>">
    <!-- wave CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/wave/waves.min.css')?>">
    <!-- main CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/main.css')?>">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/style.css')?>">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?= base_url('css/beranda/responsive.css')?>">
    <!-- modernizr JS
		============================================ -->
    <script src="<?= base_url('js/beranda/vendor/modernizr-2.8.3.min.js')?>"></script>
    
</head>

<body>
  <!-- Start Header Top Area -->
  <div class="header-top-area" >
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="logo-area">
                        <a href="#"><img src="<?= base_url('img/logo/Back Admin Simia.png')  ?>" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="header-top-menu">
                        <ul class="nav navbar-nav notika-top-nav">
                            
                            <li class="nav-item nc-al"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-alarm"></i></span></a>
                                <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>Notification</h2>
                                    </div>
                                    <div class="hd-message-info">
                                    <?php foreach($dataNotif as $key => $datas) :?>
                                      <form id="Notifikasi" method="post" action="<?= base_url('/notifikasi/edit/'.$datas['id'])?>">                                     
                                            
                                            <div class="hd-message-sn">                                                
                                                <div class="hd-mg-ctn">
                                                    <h3><?= $datas['jenisNotifikasi']?></h3>
                                                    <p><?= $datas['isiNotifikasi']?></p>
                                                </div>
                                                <input type="hidden" name="status" value="dibaca">
                                                
                                                <button type="submit" class="btn btn-primary">Dibaca</button>
                                            </div>
                                            
                                      </form> 
                                      <?php endforeach;?>                                                                              
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
                            
                            <li class="nav-item"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-support"></i></span><?php if($notif != 0):?>
                              <div class="spinner4 spinner-4"></div><div class="ntd-ctn"><span><?= $notif?></span></div>
                            <?php endif;?></a>
                            <div role="menu" class="dropdown-menu message-dd notification-dd animated zoomIn">
                                    <div class="hd-mg-tt">
                                        <h2>User Profile</h2>
                                    </div>
                                    <div class="hd-message-info">
                                        
                                    </div>
                                    <div class="hd-mg-va">
                                        <a href="#">View All</a>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item"><a href="<?= base_url('/login/logout')?>" role="button" aria-expanded="false" class="nav-link dropdown-toggle"><span><i class="notika-icon notika-close"></i></span></a>
                                
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header Top Area -->
    
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li><a href="<?= base_url('/')?>">Beranda</a>                                    
                                </li>
                                <li><a data-toggle="collapse" data-target="#DataNews" href="#">News</a>
                                    <ul id="DataNews" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url('/berita')?>">News</a>
										</li>
										<li><a href="<?= base_url('/galeri')?>">Galeri News</a>
										</li>                                        
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#DataSurat" href="#">Master Surat</a>
                                    <ul id="DataSurat" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url('/suratM')?>">Surat Masuk</a>
										</li>
										<li><a href="<?= base_url('/suratK')?>">Surat Keluar</a>
										</li>                                        
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#MasterData" href="#">Master Data</a>
                                    <ul id="MasterData" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url('/user')?>">Data User</a>
										</li>                                
										<li><a href="<?= base_url('/dataKecamatan')?>">Data Kecamatan</a>
										</li>
										<li><a href="<?= base_url('/dataKelurahan')?>">Data Kelurahan</a>
										</li>
										<li><a href="<?= base_url('/kehadiranPegawai')?>">Data Kehadiran Pegawai</a>
										</li>
										<li><a href="<?= base_url('/bidang')?>">Data Bidang</a>
										</li>
										<li><a href="<?= base_url('/unit')?>">Data Unit</a>
										</li>
										<li><a href="<?= base_url('/tamu')?>">Data Tamu</a>
										</li>
										<li><a href="<?= base_url('/fotoDokumentasi')?>">Dokumentasi</a>
										</li>
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#DataProyek" href="#">Kegiatan</a>
                                    <ul id="DataProyek" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url('/dataProyek')?>">Data Kegiatan</a>
										</li>
										<li><a href="<?= base_url('/dataPekerjaan')?>">Data Proyek</a>
										</li>                                
										<li><a href="<?= base_url('/dataKonsultan')?>">Data Konsultan</a>
										</li>
										<li><a href="<?= base_url('/dataKontraktor')?>">Data Penyedia Jasa</a>
										</li>
										<li><a href="<?= base_url('/dataInspector')?>">Data Pengawas</a>
										</li>
										<li><a href="<?= base_url('/dataPPK')?>">Data PPK</a>
										</li>
										<li><a href="<?= base_url('/dataPPTK')?>">Data PPTK</a>
										</li>
										
                                    </ul>
                                </li>
                                <li><a data-toggle="collapse" data-target="#DataInformasi" href="#">Informasi</a>
                                    <ul id="DataInformasi" class="collapse dropdown-header-top">
                                        <li><a href="<?= base_url('/info')?>">Info Kegiatan</a>
										</li>
										<li><a href="<?= base_url('/kritiksaran')?>">Kritik & Saran</a>
										</li>
										<li><a href="<?= base_url('/laporanProgres')?>">Laporan Progres</a>
										</li>
										<li><a href="<?= base_url('/laporan')?>">Laporan Masyarakat</a>
										</li>
                                    </ul>
                                </li>
                                <li><a href="<?= base_url('/tandaTangan')?>">Tanda Tangan Digital</a>                                    
                                </li>                                
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu end -->
    
    <!-- Main Menu area start-->
    <div class="main-menu-area mg-tb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <ul class="nav nav-tabs notika-menu-wrap menu-it-icon-pro">
                        <li class="<?= $data == 'beranda' ? 'active':''?>"><a href="<?= base_url('/')?>"><i class="notika-icon notika-house"></i>Beranda</a>
                        </li>
                        <li class="<?= $data == 'news' ? 'active':''?>"><a data-toggle="tab" href="#Berita"><i class="notika-icon notika-paperclip"></i> News</a>
                        </li>
                        <li class="<?= $data == 'surat' ? 'active':''?>"><a data-toggle="tab" href="#Surat"><i class="notika-icon notika-mail"></i> Master Surat</a>
                        </li>
                        <li class="<?= $data == 'data' ? 'active':''?>"><a data-toggle="tab" href="#Data"><i class="notika-icon notika-bar-chart"></i>Master Data</a>
                        </li>
                        <li class="<?= $data == 'proyek' ? 'active':''?>"><a data-toggle="tab" href="#Proyek"><i class="notika-icon notika-travel"></i>Kegiatan</a>
                        </li>
                        <li class="<?= $data == 'informasi' ? 'active':''?>"><a data-toggle="tab" href="#Informasi"><i class="notika-icon notika-windows"></i>Informasi</a>
                        </li>
                        <li class="<?= $data == 'ttdigital' ? 'active':''?>"><a href="<?= base_url('/tandaTangan')?>"><i class="notika-icon notika-form"></i> Tanda Tangan Digital</a>
                        </li>                                        
                    </ul>
                    <div class="tab-content custom-menu-content">
                          
                        <div id="Berita" class="tab-pane notika-tab-menu-bg animated flipInX <?= $data == 'news' ? 'active':''?>">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= base_url('/berita')?>">News</a>
                                </li>
                                <li><a href="<?= base_url('/galeri')?>">Galeri News</a>
                                </li>                                
                            </ul>
                        </div>
                        
                        <div id="Surat" class="tab-pane notika-tab-menu-bg animated flipInX <?= $data == 'surat' ? 'active':''?>">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= base_url('/suratM')?>">Surat Masuk</a>
                                </li>
                                <li><a href="<?= base_url('/suratK')?>">Surat Keluar</a>
                                </li>                                
                            </ul>
                        </div>
                        <div id="Data" class="tab-pane notika-tab-menu-bg animated flipInX <?= $data == 'data' ? 'active':''?>">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= base_url('/user')?>">Data User</a>
                                </li>                                
                                <li><a href="<?= base_url('/dataKecamatan')?>">Data Kecamatan</a>
                                </li>
                                <li><a href="<?= base_url('/dataKelurahan')?>">Data Kelurahan</a>
                                </li>
                                <li><a href="<?= base_url('/kehadiranPegawai')?>">Data Kehadiran Pegawai</a>
                                </li>
                                <li><a href="<?= base_url('/bidang')?>">Data Bidang</a>
                                </li>
                                <li><a href="<?= base_url('/unit')?>">Data Unit</a>
                                </li>
                                <li><a href="<?= base_url('/tamu')?>">Data Tamu</a>
                                </li>
                                <li><a href="<?= base_url('/fotoDokumentasi')?>">Dokumentasi</a>
                                </li>
                                
                            </ul>
                        </div>
                        <div id="Proyek" class="tab-pane notika-tab-menu-bg animated flipInX <?= $data == 'proyek' ? 'active':''?>">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= base_url('/dataProyek')?>">Data Kegiatan</a>
                                </li>
                                <li><a href="<?= base_url('/dataPekerjaan')?>">Data Proyek</a>
                                </li>                                
                                <li><a href="<?= base_url('/dataKonsultan')?>">Data Konsultan</a>
                                </li>
                                <li><a href="<?= base_url('/dataKontraktor')?>">Data Penyedia Jasa</a>
                                </li>
                                <li><a href="<?= base_url('/dataInspector')?>">Data Pengawas</a>
                                </li>
                                <li><a href="<?= base_url('/dataPPK')?>">Data PPK</a>
                                </li>
                                <li><a href="<?= base_url('/dataPPTK')?>">Data PPTK</a>
                                </li>
                                
                                
                                
                            </ul>
                        </div>
                        <div id="Informasi" class="tab-pane notika-tab-menu-bg animated flipInX <?= $data == 'informasi' ? 'active':''?>">
                            <ul class="notika-main-menu-dropdown">
                                <li><a href="<?= base_url('/info')?>">Info Kegiatan</a>
                                </li>
                                <li><a href="<?= base_url('/kritiksaran')?>">Kritik & Saran</a>
                                </li>
                                <li><a href="<?= base_url('/laporanProgres')?>">Laporan Progres</a>
                                </li>
                                <li><a href="<?= base_url('/laporan')?>">Laporan Masyarakat</a>
                                </li>
                            </ul>
                        </div>   
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Menu area End-->