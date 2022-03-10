<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use App\Models\NotifikasiModel;

class Users extends ResourceController
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
            $model = new UserModel();
            $notifikasi = new NotifikasiModel();
            $user['users'] = $model->findAll();
            $user['userlog'] = $session->get('username');
            $data['data'] = "data";            
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('user',$user);
            echo view('templates/beranda/footer');
        }
    }

    public function save()
    {
        $session = session();
        helper(['form']);
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
            'createdBy' => 'required',
        ];
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getVar('level'),
                'createdBy' => $this->request->getVar('createdBy'),
            ];
            $model->save($data);
            $notif = new NotifikasiModel();
            $admin = $this->request->getVar('createdBy');
            $notifData = [
                'jenisNotifikasi' => 'Tambah User',
                'isiNotifikasi' => $admin.' Telah Menambah User Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/user'); 

        }else {
            return $this->fail($this->validator->getErrors()); 
        }
    }

    public function edit($id = null){
        $session = session();
        $model = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),            
            'level' => $this->request->getVar('level'),
            
        ];
        $model->update($id,$data);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/user');
    }

    public function hapus($id = null){
        $session = session();
        $model = new UserModel();
        $model->delete($id);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/user');
    }


    public function index()
    {
        $model = new UserModel();
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
        $model = new UserModel();
        $data = $model->find(['id_user' => $id]);
        if(!$data) return $this->FailNotFound('No Data Found');
        return $this->respond($data[0]);
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
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
            'createdBy' => 'required',
        ];
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'level' => $this->request->getVar('level'),
            'createdBy' => $this->request->getVar('createdBy'),
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new UserModel();
        $model->save($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]

        ];
        return $this->respondCreated($response);
    }

    
    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
            'createdBy' => 'required',
        ];
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level'),
            'createdBy' => $this->request->getVar('createdBy'),
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new UserModel();
        $findById = $model->find(['id_user' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->update($id,$data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated'
            ]

        ];
        return $this->respond($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new UserModel();
        $findById = $model->find(['id_user' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
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
