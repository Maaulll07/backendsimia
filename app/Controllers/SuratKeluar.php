<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SuratKeluarModel;
use App\Models\NotifikasiModel;

class SuratKeluar extends ResourceController
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
            $model = new SuratKeluarModel();
            $surat['suratKeluar'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('suratKeluar',$surat);
            echo view('templates/beranda/footer');

        }

    }
    public function index()
    {
        $model = new SuratKeluarModel();
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
        $model = new SuratKeluarModel();
        $data = $model->where('noSurat',$id)->first();
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
            'noAgenda' => 'required',
            'noSurat' => 'required',
            'tanggalKirim' => 'required',
            'tujuanSurat' => 'required',
            'untukPengguna' => 'required',
            'isiRingkasan' => 'required',
            'fileSurat' => 'required',            
            'status' => 'required'
        ];

        $data = [
            'noAgenda' => $this->request->getVar('noAgenda'),
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalKirim' => $this->request->getVar('tanggalKirim'),
            'tujuanSurat' => $this->request->getVar('tujuanSurat'),
            'untukPengguna' => $this->request->getVar('untukPengguna'),
            'isiRingkasan' => $this->request->getVar('isiRingkasan'),
            'fileSurat' => $this->request->getVar('fileSurat'),
            'status' => $this->request->getVar('status'),            
            
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors()); 

        $model = new SuratKeluarModel();
        $model->save($data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Tambah Surat Keluar',
                'isiNotifikasi' => 'Surat Keluar Baru Telah Ditambahkan',
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
            'noAgenda' => 'required',
            'noSurat' => 'required',
            'tanggalKirim' => 'required',
            'tujuanSurat' => 'required',
            'untukPengguna' => 'required',
            'isiRingkasan' => 'required',
            'fileSurat' => 'required',            
            'status' => 'required'
        ];

        $data = [
            'noAgenda' => $this->request->getVar('noAgenda'),
            'noSurat' => $this->request->getVar('noSurat'),
            'tanggalKirim' => $this->request->getVar('tanggalKirim'),
            'tujuanSurat' => $this->request->getVar('tujuanSurat'),
            'untukPengguna' => $this->request->getVar('untukPengguna'),
            'isiRingkasan' => $this->request->getVar('isiRingkasan'),
            'fileSurat' => $this->request->getVar('fileSurat'),
            'status' => $this->request->getVar('status'),            
            
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());

        $model = new SuratKeluarModel();
        $findById = $model->find(['id_suratKeluar' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->update($id,$data);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Edit Surat Keluar',
                'isiNotifikasi' => 'Surat Keluar Telah Diedit',
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
        $model = new SuratKeluarModel();
        $findById = $model->find(['id_suratKeluar' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Hapus Surat Keluar',
                'isiNotifikasi' => 'Surat Keluar Telah Dihapus',
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
