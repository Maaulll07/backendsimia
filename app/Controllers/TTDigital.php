<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TTDigitalModel;
use App\Models\NotifikasiModel;

class TTDigital extends ResourceController
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
            $data['data'] = "ttdigital";
            $notifikasi = new NotifikasiModel();
            $model = new TTDigitalModel();
            $ttd['ttd'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('ttDigital',$ttd);
            echo view('templates/beranda/footer');

        }
    }
    public function index()
    {
        $model = new TTDigitalModel();
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
        $model = new TTDigitalModel();
        $data = $model->where('kode',$id)->first();
        if(!$data)return $this->FailNotFound('No Data Found');
        return $this->respond($data);
        
    }
    
    public function user($id= null){
        $model = new TTDigitalModel();
        $data = $model->where('nip',$id)->find();
        if(!$data)return $this->FailNotFound('No Data Found');
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
            'nip' => 'required',
            'nama' => 'required',
            'peruntukan' => 'required',
            'tanggalPembuatan' => 'required',
            'kode' => 'required',
            'namaDokumen' => 'required'
        ];
        $data = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'), 
            'peruntukan' => $this->request->getVar('peruntukan'),
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalPembuatan' => $this->request->getVar('tanggalPembuatan'),
            'kode' => $this->request->getVar('kode'),
            'namaDokumen' => $this->request->getVar('namaDokumen')
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new TTDigitalModel();
        $model->save($data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Tambah Tanda Tangan Digital',
                'isiNotifikasi' => 'Tanda Tangan Digital Baru Telah Ditambahkan',
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
            'nip' => 'required',
            'nama' => 'required',
            'peruntukan' => 'required',
            'tanggalPembuatan' => 'required',
            'kode' => 'required',
        ];
        $data = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'), 
            'peruntukan' => $this->request->getVar('peruntukan'),
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalPembuatan' => $this->request->getVar('tanggalPembuatan'),
            'kode' => $this->request->getVar('kode'),
            'namaDokumen' => $this->request->getVar('namaDokumen')
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new TTDigitalModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->update($id,$data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Edit Tanda Tangan Digital',
                'isiNotifikasi' => 'Tanda Tangan Digital Telah Diedit',
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
        $model = new TTDigitalModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Hapus Tanda Tangan Digital',
                'isiNotifikasi' => 'Tanda Tangan Digital Telah Dihapus',
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
