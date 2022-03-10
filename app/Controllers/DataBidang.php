<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DataBidangModel;
use App\Models\NotifikasiModel;

class DataBidang extends ResourceController
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
            $data['data'] = "data";
            $notifikasi = new NotifikasiModel();
            $model = new DataBidangModel();
            $bidang['bidang'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataBidang',$bidang);
            echo view('templates/beranda/footer');

        }

    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodeBidang' => 'required',
            'namaBidang' => 'required'
        ];
        if($this->validate($rules)){
            $model = new DataBidangModel();
            $data = [
                'kodeBidang' => $this->request->getVar('kodeBidang'),
                'namaBidang' => $this->request->getVar('namaBidang')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Bidang',
                'isiNotifikasi' => $admin.' Telah Menambah Bidang Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/bidang');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new DataBidangModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Bidang',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Bidang = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/bidang');
    }
    public function index()
    {
        $model = new DataBidangModel();
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
            'kodeBidang' => 'required',
            'namaBidang' => 'required'
        ];
        $data = [
            'kodeBidang' => $this->request->getVar('kodeBidang'),
            'namaBidang' => $this->request->getVar('namaBidang')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new DataBidangModel();
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
        $model = new DataBidangModel();
        $data = [
            'kodeBidang' => $this->request->getVar('kodeBidang'),
            'namaBidang' => $this->request->getVar('namaBidang')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaBidang');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Bidang',
                'isiNotifikasi' => $admin.' Telah Merubah Data Bidang = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/bidang');
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
