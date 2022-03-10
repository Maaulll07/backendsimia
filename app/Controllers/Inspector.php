<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\InspectorModel;


class Inspector extends ResourceController
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
            $insModel = new InspectorModel();
            $inspector['Inspector'] = $insModel->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataInspector',$inspector);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodeInspector' => 'required',
            'namaInspector' => 'required'
        ];
        if($this->validate($rules)){
            $model = new InspectorModel();
            $data = [
                'kodeInspector' => $this->request->getVar('kodeInspector'),
                'namaInspector' => $this->request->getVar('namaInspector')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Inspector',
                'isiNotifikasi' => $admin.' Telah Menambah Inspector Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataInspector');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new InspectorModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Inspector',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Inspector = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataInspector');
    }
    public function index()
    {
        $model = new InspectorModel();
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
            'kodeInspector' => 'required',
            'namaInspector' => 'required'
        ];
        $data = [
            'kodeInspector' => $this->request->getVar('kodeInspector'),
            'namaInspector' => $this->request->getVar('namaInspector')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new InspectorModel();
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
        $model = new InspectorModel();
        $data = [
            'kodeInspector' => $this->request->getVar('kodeInspector'),
            'namaInspector' => $this->request->getVar('namaInspector')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaInspector');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Inspector',
                'isiNotifikasi' => $admin.' Telah Merubah Data Inspector = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataInspector');
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
