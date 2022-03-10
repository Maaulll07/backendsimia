<?php namespace App\Libraries;
use App\Models\NotifikasiModel;

class Widget
{
    public function recentActivity(array $data){
        $notifikasi = new NotifikasiModel();        
        $data['dataNotif'] = $notifikasi->orderBy('id','DESC')->where('status','dibaca')->findAll();
        return view('templates/beranda/widget',$data);
    }
}
?>