<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DataUnitModel;
use App\Models\DataBidangModel;
use App\Models\NotifikasiModel;

class DataUnit extends ResourceController
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
            $model = new DataUnitModel();
            $bidModel = new DataBidangModel();
            $unit['bidang'] = $bidModel->findAll();
            $unit['unit'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataUnit',$unit);
            echo view('templates/beranda/footer');

        }
    }
    public function save(){
        $session = session();
        helper(['form']);
        $rules =[
            'kodeUnit' => 'required',
            'kodeBidang' => 'required',
            'namaUnit' => 'required'
        ];
        if($this->validate($rules)){
            $model = new DataUnitModel();
            $data = [
                'kodeUnit' => $this->request->getVar('kodeUnit'),
                'kodeBidang' => $this->request->getVar('kodeBidang'),
                'namaUnit' => $this->request->getVar('namaUnit')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Unit',
                'isiNotifikasi' => $admin.' Telah Menambah Unit Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/unit');
        }
    }
    public function hapus($id = null){
        $session = session();
        $model = new DataUnitModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Unit',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Unit = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/unit');
    }
    public function index()
    {
        $model = new DataUnitModel();
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
            'kodeUnit' => 'required',
            'kodeBidang' => 'required',
            'namaUnit' => 'required'
        ];
        $data = [
            'kodeUnit' => $this->request->getVar('kodeUnit'),
            'kodeBidang' => $this->request->getVar('kodeBidang'),
            'namaUnit' => $this->request->getVar('namaUnit')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new DataUnitModel();
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
        $model = new DataUnitModel();
        $data = [
            'kodeUnit' => $this->request->getVar('kodeUnit'),
            'kodeBidang' => $this->request->getVar('kodeBidang'),
            'namaUnit' => $this->request->getVar('namaUnit')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaUnit');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Bidang',
                'isiNotifikasi' => $admin.' Telah Merubah Data Bidang = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/unit');
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
