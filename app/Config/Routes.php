<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->resource('users');
$routes->resource('notifikasi');
$routes->resource('masuk');
$routes->resource('dataBidang');
$routes->resource('dataKehadiranPegawai');
$routes->resource('dataPegawai');
$routes->resource('dataTamu');
$routes->resource('dataUnit');
$routes->resource('dokumentasi');
$routes->resource('infoKegiatan');
$routes->resource('kecamatan');
$routes->resource('kelurahan');
$routes->resource('kritikSaran');
$routes->resource('laporanMasyarakat');
$routes->resource('news');
$routes->resource('proyek');
$routes->resource('suratKeluar');
$routes->resource('suratMasuk');
$routes->resource('TTDigital');
$routes->resource('divisi');
$routes->resource('inspector');
$routes->resource('konsultan');
$routes->resource('kontraktor');
$routes->resource('laporanHarian');
$routes->resource('pekerjaan');
$routes->resource('ppk');
$routes->resource('pptk');
$routes->resource('subDivisi');
$routes->resource('galeriNews');
$routes->add('/galeri/save', 'GaleriNews::save',['filter' => 'auth']);
$routes->add('/galeri/hapus/(:any)', 'GaleriNews::hapus/$1',['filter' => 'auth']);
$routes->get('/galeri', 'GaleriNews::home',['filter' => 'auth']);
$routes->get('/surMas', 'SuratMasuk::getSuratMasuk');
$routes->add('/dataProyek/getKelurahan', 'Proyek::getKelurahan');
$routes->add('/info/getProyek', 'InfoKegiatan::getProyek');
$routes->get('/', 'Beranda::index',['filter' => 'auth']);
$routes->get('/berita', 'News::home',['filter' => 'auth']);
$routes->add('/berita/save', 'News::save',['filter' => 'auth']);
$routes->add('/berita/edit/(:any)', 'News::edit/$1',['filter' => 'auth']);
$routes->add('/berita/hapus/(:any)', 'News::hapus/$1',['filter' => 'auth']);
$routes->get('/suratM', 'SuratMasuk::home',['filter' => 'auth']);
$routes->get('/suratK', 'SuratKeluar::home',['filter' => 'auth']);
$routes->get('/user', 'Users::home',['filter' => 'auth']);
$routes->get('/dataProyek', 'Proyek::home',['filter' => 'auth']);
$routes->add('/dataProyek/save', 'Proyek::save',['filter' => 'auth']);
$routes->add('/dataProyek/edit/(:any)', 'Proyek::edit/$1',['filter' => 'auth']);
$routes->add('/dataProyek/hapus/(:any)', 'Proyek::hapus/$1',['filter' => 'auth']);
$routes->get('/dataKecamatan', 'Kecamatan::home',['filter' => 'auth']);
$routes->add('/dataKecamatan/save', 'Kecamatan::save',['filter' => 'auth']);
$routes->add('/dataKecamatan/edit/(:any)', 'Kecamatan::edit/$1',['filter' => 'auth']);
$routes->add('/dataKecamatan/hapus/(:any)', 'Kecamatan::hapus/$1',['filter' => 'auth']);
$routes->get('/dataKelurahan', 'Kelurahan::home',['filter' => 'auth']);
$routes->add('/dataKelurahan/save', 'Kelurahan::save',['filter' => 'auth']);
$routes->add('/dataKelurahan/edit/(:any)', 'Kelurahan::edit/$1',['filter' => 'auth']);
$routes->add('/dataKelurahan/hapus/(:any)', 'Kelurahan::hapus/$1',['filter' => 'auth']);
$routes->get('/kehadiranPegawai', 'DataKehadiranPegawai::home',['filter' => 'auth']);
$routes->get('/bidang', 'DataBidang::home',['filter' => 'auth']);
$routes->add('/bidang/save', 'DataBidang::save',['filter' => 'auth']);
$routes->add('/bidang/edit/(:any)', 'DataBidang::edit/$1',['filter' => 'auth']);
$routes->add('/bidang/hapus/(:any)', 'DataBidang::hapus/$1',['filter' => 'auth']);
$routes->get('/unit', 'DataUnit::home',['filter' => 'auth']);
$routes->add('/unit/save', 'DataUnit::save',['filter' => 'auth']);
$routes->add('/unit/edit/(:any)', 'DataUnit::edit/$1',['filter' => 'auth']);
$routes->add('/unit/hapus/(:any)', 'DataUnit::hapus/$1',['filter' => 'auth']);
$routes->get('/tamu', 'DataTamu::home',['filter' => 'auth']);
$routes->get('/info', 'InfoKegiatan::home',['filter' => 'auth']);
$routes->add('/info/save', 'InfoKegiatan::save',['filter' => 'auth']);
$routes->add('/info/edit/(:any)', 'InfoKegiatan::edit/$1',['filter' => 'auth']);
$routes->add('/info/hapus/(:any)', 'InfoKegiatan::hapus/$1',['filter' => 'auth']);
$routes->get('/kritiksaran', 'KritikSaran::home',['filter' => 'auth']);
$routes->add('/kritiksaran/edit/(:any)', 'KritikSaran::edit/$1',['filter' => 'auth']);
$routes->get('/laporan', 'LaporanMasyarakat::home',['filter' => 'auth']);
$routes->add('/laporan/edit/(:any)', 'LaporanMasyarakat::edit/$1',['filter' => 'auth']);
$routes->get('/tandaTangan', 'TTDigital::home',['filter' => 'auth']);
$routes->get('/TtDigital/user/(:segment)', 'TTDigital::user/$1');
$routes->get('/fotoDokumentasi', 'Dokumentasi::home',['filter' => 'auth']);
$routes->add('/user/save', 'Users::save',['filter' => 'auth']);
$routes->add('/user/edit/(:any)', 'Users::edit/$1',['filter' => 'auth']);
$routes->add('/user/hapus/(:any)', 'Users::hapus/$1',['filter' => 'auth']);
$routes->get('/dataDivisi', 'Divisi::home',['filter' => 'auth']);
$routes->add('/dataDivisi/save', 'Divisi::save',['filter' => 'auth']);
$routes->add('/dataDivisi/edit/(:any)', 'Divisi::edit/$1',['filter' => 'auth']);
$routes->add('/dataDivisi/hapus/(:any)', 'Divisi::hapus/$1',['filter' => 'auth']);
$routes->get('/dataInspector', 'Inspector::home',['filter' => 'auth']);
$routes->add('/dataInspector/save', 'Inspector::save',['filter' => 'auth']);
$routes->add('/dataInspector/edit/(:any)', 'Inspector::edit/$1',['filter' => 'auth']);
$routes->add('/dataInspector/hapus/(:any)', 'Inspector::hapus/$1',['filter' => 'auth']);
$routes->get('/dataKonsultan', 'Konsultan::home',['filter' => 'auth']);
$routes->add('/dataKonsultan/save', 'Konsultan::save',['filter' => 'auth']);
$routes->add('/dataKonsultan/edit/(:any)', 'Konsultan::edit/$1',['filter' => 'auth']);
$routes->add('/dataKonsultan/hapus/(:any)', 'Konsultan::hapus/$1',['filter' => 'auth']);
$routes->get('/dataKontraktor', 'Kontraktor::home',['filter' => 'auth']);
$routes->add('/dataKontraktor/save', 'Kontraktor::save',['filter' => 'auth']);
$routes->add('/dataKontraktor/edit/(:any)', 'Kontraktor::edit/$1',['filter' => 'auth']);
$routes->add('/dataKontraktor/hapus/(:any)', 'Kontraktor::hapus/$1',['filter' => 'auth']);
$routes->get('/laporanProgres', 'LaporanHarian::home',['filter' => 'auth']);
$routes->add('/laporanProgres/save', 'LaporanHarian::save',['filter' => 'auth']);
$routes->get('/dataPekerjaan', 'Pekerjaan::home',['filter' => 'auth']);
$routes->add('/dataPekerjaan/save', 'Pekerjaan::save',['filter' => 'auth']);
$routes->add('/dataPekerjaan/edit/(:any)', 'Pekerjaan::edit/$1',['filter' => 'auth']);
$routes->add('/dataPekerjaan/hapus/(:any)', 'Pekerjaan::hapus/$1',['filter' => 'auth']);
$routes->get('/dataPPK', 'Ppk::home',['filter' => 'auth']);
$routes->add('/dataPPK/save', 'Ppk::save',['filter' => 'auth']);
$routes->add('/dataPPK/edit/(:any)', 'Ppk::edit/$1',['filter' => 'auth']);
$routes->add('/dataPPK/hapus/(:any)', 'Ppk::hapus/$1',['filter' => 'auth']);
$routes->get('/dataPPTK', 'Pptk::home',['filter' => 'auth']);
$routes->add('/dataPPTK/save', 'Pptk::save',['filter' => 'auth']);
$routes->add('/dataPPTK/edit/(:any)', 'Pptk::edit/$1',['filter' => 'auth']);
$routes->add('/dataPPTK/hapus/(:any)', 'Pptk::hapus/$1',['filter' => 'auth']);
$routes->get('/dataSubDivisi', 'SubDivisi::home',['filter' => 'auth']);
$routes->add('/dataSubDivisi/save', 'SubDivisi::save',['filter' => 'auth']);
$routes->add('/dataSubDivisi/edit/(:any)', 'SubDivisi::edit/$1',['filter' => 'auth']);
$routes->add('/dataSubDivisi/hapus/(:any)', 'SubDivisi::hapus/$1',['filter' => 'auth']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
