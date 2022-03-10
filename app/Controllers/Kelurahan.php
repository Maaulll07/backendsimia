<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KelurahanModel;
use App\Models\KecamatanModel;
use App\Models\NotifikasiModel;

class Kelurahan extends ResourceController
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
            $model = new KecamatanModel();
            $modelKel = new KelurahanModel();
            $kelData['kecamatan'] = $model->findAll();
            $kelData['kelurahan'] = $modelKel->findAll();
            $data['data'] = "data";
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('kelurahan',$kelData);
            echo view('templates/beranda/footer');

        }
    }

    public function save()
    {
        $session = session();
        helper(['form']);
        $rules = [
            'kodeKecamatan' => 'required',
            'kodeKelurahan' => 'required',
            'namaKelurahan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KelurahanModel();
            $data = [
                'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
                'kodeKelurahan' => $this->request->getVar('kodeKelurahan'),
                'namaKelurahan' => $this->request->getVar('namaKelurahan')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Kelurahan',
                'isiNotifikasi' => $admin.' Telah Menambah Kelurahan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil ditambahkan');
            return redirect()->to('/dataKelurahan');
        }else{
            return $this->fail($this->validator->getErrors());
        }
    }
    public function hapus($id = null)
    {
        $session = session();
        $model = new KelurahanModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Kelurahan',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Kelurahan = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataKelurahan');
    }
    public function index()
    {
        $model = new KelurahanModel();
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
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'kodeKecamatan' => 'required',
            'kodeKelurahan' => 'required',
            'namaKelurahan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KelurahanModel();
            $data = [
                'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
                'kodeKelurahan' => $this->request->getVar('kodeKelurahan'),
                'namaKelurahan' => $this->request->getVar('namaKelurahan')
            ];
            $model->save($data);
            $response = [
                'status' => 201,
                'error' => null,
                'messages' => [
                    'success' => 'Data Inserted'
                ]
    
            ];
            return $this->respondCreated($response);
        }else{
            return $this->fail($this->validator->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $session = session();
        $model = new KelurahanModel();
        $data = [
            'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
            'kodeKelurahan' => $this->request->getVar('kodeKelurahan'),
            'namaKelurahan' => $this->request->getVar('namaKelurahan')
        ];
        $model->update($id,$data);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataKelurahan');
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
