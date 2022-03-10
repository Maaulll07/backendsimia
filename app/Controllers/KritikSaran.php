<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KritikSaranModel;
use App\Models\NotifikasiModel;

class KritikSaran extends ResourceController
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
            $data['data'] = "informasi";
            $notifikasi = new NotifikasiModel();
            $model = new KritikSaranModel();
            $ks['kritikSaran'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('kritikSaran',$ks);
            echo view('templates/beranda/footer');

        }
    }
    public function index()
    {
        $model = new KritikSaranModel();
        $data = $model->where('status','acc')->findAll();
        return $this->respond($data);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new KritikSaranModel();
        $data = $model->where('id',$id)->first();
        return $this->respond($data);
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
        helper(['form']);
        $rules = [
            'kontak' => 'required',
            'isi' => 'required',
            'status' => 'required'            
        ];

        $data = [
            'kontak' => $this->request->getVar('kontak'),
            'isi' => $this->request->getVar('isi'),
            'status' => $this->request->getVar('status')    
            
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new KritikSaranModel();
        if($model->save($data)){
          $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Tambah Kritik dan Saran',
                'isiNotifikasi' => 'Kritik dan Saran Baru Telah Ditambahkan',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]

        ];
        return redirect()->to("https://simia.enmuh.my.id/kritik-dan-saran-anda-telah-terkirim");
        }
        
        
        return $this->respondCreated($response);
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $session = session();
        $data = [
            'status' => $this->request->getVar('status')
            ];
        $model = new KritikSaranModel();
        $model->update($id,$data);
        $nama = $this->request->getVar('status');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Kritik dan Saran',
                'isiNotifikasi' => $admin.' Telah Merubah Status Kritik dan Saran = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Status Kritik dan Saran Berhasil diedit');
        return redirect()->to('/kritiksaran');
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
        $model = new KritikSaranModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Hapus Kritik dan Saran',
                'isiNotifikasi' => 'Kritik dan Saran Telah Dihapus',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Deleted'
            ]

        ];
        return $this->respond($response);
    }
}
