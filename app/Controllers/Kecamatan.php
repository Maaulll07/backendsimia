<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\KecamatanModel;
use App\Models\NotifikasiModel;

class Kecamatan extends ResourceController
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
            $kecData['kecamatan'] = $model->findAll();
            $data['data'] = "data";
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('kecamatan',$kecData);
            echo view('templates/beranda/footer');

        }
    }

    public function save()
    {
        $session = session();
        helper(['form']);
        $rules = [
            'kodeKecamatan' => 'required',
            'namaKecamatan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KecamatanModel();
            $data = [
                'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
                'namaKecamatan' => $this->request->getVar('namaKecamatan')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Kecamatan',
                'isiNotifikasi' => $admin.' Telah Menambah Kecamatan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataKecamatan');
        }else{
            return $this->fail($this->validator->getErrors());
        }
    }

    public function edit($id = null)
    {
        $session = session();
        $model = new KecamatanModel();
        $data = [
            'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
            'namaKecamatan' => $this->request->getVar('namaKecamatan')
        ];
        $model->update($id,$data);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataKecamatan');
    }

    public function hapus($id = null)
    {
        $session = session();
        $model = new KecamatanModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Kecamatan',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Kecamatan = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataKecamatan');
    }
    public function index()
    {
        $model = new KecamatanModel();
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
            'namaKecamatan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KecamatanModel();
            $data = [
                'kodeKecamatan' => $this->request->getVar('kodeKecamatan'),
                'namaKecamatan' => $this->request->getVar('namaKecamatan')
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
