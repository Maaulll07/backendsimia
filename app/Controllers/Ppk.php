<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\PpkModel;


class Ppk extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    public function home(){
        if(!session()->get('logged_in')){
            return redirect()->to('/login');
        } else {
            $data['data'] = "proyek";
            $notifikasi = new NotifikasiModel();
            $ppkModel = new PpkModel();
            $ppk['PPK'] = $ppkModel->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataPPK',$ppk);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodePPK' => 'required',
            'namaPPK' => 'required'
        ];
        if($this->validate($rules)){
            $model = new PpkModel();
            $data = [
                'kodePPK' => $this->request->getVar('kodePPK'),
                'namaPPK' => $this->request->getVar('namaPPK')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data PPK',
                'isiNotifikasi' => $admin.' Telah Menambah PPK Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataPPK');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new PpkModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data PPK',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode PPK = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataPPK');
    }
    public function index()
    {
        $model = new PpkModel();
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
        helper(['form']);
        $rules =[
            'kodePPK' => 'required',
            'namaPPK' => 'required'
        ];
        $data = [
            'kodePPK' => $this->request->getVar('kodePPK'),
            'namaPPK' => $this->request->getVar('namaPPK')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new PpkModel();
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
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $session = session();
        $model = new PpkModel();
        $data = [
            'kodePPK' => $this->request->getVar('kodePPK'),
            'namaPPK' => $this->request->getVar('namaPPK')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaPPK');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data PPK',
                'isiNotifikasi' => $admin.' Telah Merubah Data PPK = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataPPK');
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
