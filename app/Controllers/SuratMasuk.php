<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SuratMasukModel;
use App\Models\NotifikasiModel;

class SuratMasuk extends ResourceController
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
            $data['data'] = "surat"; 
            $notifikasi = new NotifikasiModel();
            $model = new SuratMasukModel();
            $surat['suratMasuk'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();           
            echo view('templates/beranda/header',$data);
        echo view('suratMasuk',$surat);
        echo view('templates/beranda/footer');

        }
        
    }
    
    public function getSuratMasuk(){
        $model = new SuratMasukModel();
        $data = $model->where('status','sudah disposisi')->findAll();
        return $this->respond($data);
    }

    public function index(){
        $model = new SuratMasukModel();
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
        $model = new SuratMasukModel();
        $data = $model->where('id_suratMasuk',$id)->find();
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
            'asalSurat' => 'required',
            'tujuanSurat' => 'required',
            'noSurat' => 'required',
            'tanggalSurat' => 'required',
            'tanggalTerima' => 'required',
            'noAgenda' => 'required',
            'sifatSurat' => 'required',
            'perihal' => 'required',
            'fileSurat' => 'required',            
            'status' => 'required'

        ];
        $data = [
            'asalSurat' => $this->request->getVar('asalSurat'),
            'tujuanSurat' => $this->request->getVar('tujuanSurat'), 
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalSurat' => $this->request->getVar('tanggalSurat'),
            'tanggalTerima' => $this->request->getVar('tanggalTerima'),
            'noAgenda' => $this->request->getVar('noAgenda'),
            'sifatSurat' => $this->request->getVar('sifatSurat'),
            'perihal' => $this->request->getVar('perihal'),
            'fileSurat' => $this->request->getVar('fileSurat'),
            'status' => $this->request->getVar('status'),
            'keterangan' => $this->request->getVar('keterangan')
            
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new SuratMasukModel();
        $model->save($data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Tambah Surat Masuk',
                'isiNotifikasi' => 'Surat Masuk Baru Telah Ditambahkan',
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
        return $this->respondCreated($response);
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
        helper(['form']);
        $rules = [
                        
            'status' => 'required'

        ];
        $data = [
            'asalSurat' => $this->request->getVar('asalSurat'),
            'tujuanSurat' => $this->request->getVar('tujuanSurat'), 
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalSurat' => $this->request->getVar('tanggalSurat'),
            'tanggalTerima' => $this->request->getVar('tanggalTerima'),
            'noAgenda' => $this->request->getVar('noAgenda'),
            'sifatSurat' => $this->request->getVar('sifatSurat'),
            'perihal' => $this->request->getVar('perihal'),
            'fileSurat' => $this->request->getVar('fileSurat'),
            'status' => $this->request->getVar('status'),
            'keterangan' => $this->request->getVar('keterangan')
            
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new SuratMasukModel();
        $findById = $model->find(['id_suratMasuk' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->update($id,$data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Edit Surat Masuk',
                'isiNotifikasi' => 'Surat Masuk Telah Diedit',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => 'Data Updated'
            ]

        ];
        return $this->respondCreated($response);
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new SuratMasukModel();
        $findById = $model->find(['id_suratMasuk' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Hapus Surat Masuk',
                'isiNotifikasi' => 'Surat Masuk Telah Dihapus',
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
