<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ProyekModel;
use App\Models\SuratMasukModel;
use App\Models\SuratKeluarModel;
use App\Models\NotifikasiModel;

class Beranda extends BaseController
{
    public function index()
    {
        if(!session()->get('logged_in')){
            return redirect()->to('/login');
        }else {           
            $userModel = new UserModel();
            $proyekModel = new ProyekModel();
            $masukModel = new SuratMasukModel();
            $keluarModel = new SuratKeluarModel();
            $count['users'] = $userModel->countAllResults();
            $count['suratMasuk'] = $masukModel->countAllResults();
            $count['suratKeluar'] = $keluarModel->countAllResults();
            $count['proyek'] = $proyekModel->countAllResults();
            $data = ['data' => 'beranda'];
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('beranda',$count);
            echo view('templates/beranda/footer');

        }
        
    }
}
