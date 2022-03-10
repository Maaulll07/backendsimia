<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NewsModel;
use App\Models\NotifikasiModel;

class News extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function home()
    {
        

        if(!session()->get('logged_in')){
            return redirect()->to('/login');
        } else {
            $model = new NewsModel();
            $news['news'] = $model->orderBy('created_at','DESC')->findAll();
            $data['data'] = "news";
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
        echo view('templates/beranda/header',$data);
        echo view('news',$news);
        echo view('templates/beranda/footer');

        }


    }

    public function save(){
        $session = session();
        $database = \Config\Database::connect();
        $db = $database->table('news');
        helper(['form','url']);
        $rules =[
            'judul' => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]'
                
            ],    
            
            'author' => 'required',
            'content' => 'required',
            'created_at' => 'required',
            'status' => 'required',
        ];

        if($this->validate($rules)){
            
            $img = $this->request->getFile('file');
            
                $namaAcak = $img->getRandomName(); 
            $img->move('newsFolder', $namaAcak);
            
            $tanggal = $this->request->getVar('created_at');
            $date = date('Y-m-d h:i:sa', strtotime($tanggal));
            $data = array(
                'judul' => $this->request->getVar('judul'),
                'file' => $img->getName(),
                'author' => $this->request->getVar('author'),
                'content' => $this->request->getVar('content'),
                'created_at' => $date,
                'status' => $this->request->getVar('status')                
            );
            $save = $db->insert($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah News',
                'isiNotifikasi' => $admin.' Telah Menambah News Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave dengan');
            return redirect()->to('/berita');
            
            
            
        }else{
            return $this->fail($this->validator->getErrors()); 
        }


    }
    public function hapus($id = null){
        $session = session();
        $model = new NewsModel();
        $file = $model->where('id', $id)->first();
        $nama = $file['file'];
        
        if($model->delete($id)){
            array_map('unlink', glob(FCPATH."uploads/$nama.*"));
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data News',
                'isiNotifikasi' => $admin.' Telah Menghapus News = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/berita');
        }
        
    }

    public function index()
    {
        $model = new NewsModel();
        $data = $model->orderBy('created_at','DESC')->findAll();
        return $this->respond($data);

    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        //
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $session = session();
        $model = new NewsModel();
        $database = \Config\Database::connect();
        $db = $database->table('news');
        helper(['form','url']);
        
        $rules =[
            
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png]',
                
            ],    
            
            
        ];
        if($this->validate($rules)){
            $img= $this->request->getFile('file');
            
                $namaAcak = $img->getRandomName();
            $img->move('newsFolder', $namaAcak);
            $data = array(
                'judul' => $this->request->getVar('judul'),
                'file' => $img->getName(),                
                'author' => $this->request->getVar('author'),
                'content' => $this->request->getVar('content'),
                'created_at' => $this->request->getVar('created_at'),
                'status' => $this->request->getVar('status') 
            );
            $model->update($id,$data);
            $nama = $this->request->getVar('judul');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data News',
                'isiNotifikasi' => $admin.' Telah Merubah Data News = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit dengan gambar');
        return redirect()->to('/berita');
            
            
        }else{
            
            
                
                $data = [
                    'judul' => $this->request->getVar('judul'),                    
                    'author' => $this->request->getVar('author'),
                    'content' => $this->request->getVar('content'),
                    'created_at' => $this->request->getVar('created_at'),
                    'status' => $this->request->getVar('status') 
                ];
                if($model->update($id,$data)){
                    $nama = $this->request->getVar('judul');
                    $notif= new NotifikasiModel();
                    $admin = $session->get('username');
                    $notifData = [
                        'jenisNotifikasi' => 'Edit Data News',
                        'isiNotifikasi' => $admin.' Telah Merubah Data News = '.$nama,
                        'status' => 'belum dibaca'
                    ];
                    $notif->save($notifData);
                    $session->setFlashdata('msg','Data Berhasil diedit, tanpa gambar');
                    return redirect()->to('/berita');
                }
            
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
