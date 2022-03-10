<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\GaleriNewsModel;
use App\Models\NotifikasiModel;

class GaleriNews extends ResourceController
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
            $session = session();
            $model = new GaleriNewsModel();
            $data['data'] = "news";
            $galeri['galeriNews'] = $model->findAll();
            $galeri['user'] = $session->get('username');
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('galeriNews',$galeri);
            echo view('templates/beranda/footer');
        }
    }
    public function save()
    {
        $session = session();
        $database = \Config\Database::connect();
        $db = $database->table('galerinews');
        helper(['form','url']);
        $rules = [
            'judul' => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,image/jpg,image/jpeg,image/png,video/mp4,video/mpeg,video/avi,video/x-sgi-movie,video/3gp,video/x-flv]'
            ],
            'created' => 'required',
            'user' => 'required'
        ];
        if($this->validate($rules)){

            $uploadFile = $this->request->getFiles();
            $judul = $this->request->getVar('judul');
            $created = $this->request->getVar('created');
            $user = $this->request->getVar('user');
            
            foreach($uploadFile['file'] as $file ){
                $namaAcak = $file->getRandomName();
                $file->move('galeriNewsFolder', $namaAcak);
                
                $data = [ 
                    'judul' => $judul,
                    'namaFile' => $file->getName(),
                    'created' => $created,
                    'user' => $user 
                ];
                
                $save = $db->insert($data);
                
            }
            
                $notif= new NotifikasiModel();
                $admin = $session->get('username');
                $notifData = [
                    'jenisNotifikasi' => 'Tambah Galeri News',
                    'isiNotifikasi' => $admin.' Telah Menambah Galeri News Baru',
                    'status' => 'belum dibaca'
                ];
                $notif->save($notifData);
                $session->setFlashdata('msg','Data Berhasil disave dengan'.count($uploadFile['file']).' files');
                return redirect()->to('/galeri');

        } else {
            return $this->fail($this->validator->getErrors());
        }



    }
    public function hapus($id = null){
        $session = session();
        $model = new GaleriNewsModel();
        $file = $model->where('id', $id)->first();
        $nama = $file['namaFile'];
        
        if($model->delete($id)){
            array_map('unlink', glob(FCPATH."galeriNewsFolder/$nama.*"));
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Galeri News',
                'isiNotifikasi' => $admin.' Telah Menghapus Galeri News = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/galeri');
        }
        
    }
    
    public function index()
    {
        $model = new GaleriNewsModel();
        $data = $model->findAll();
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
        //
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
