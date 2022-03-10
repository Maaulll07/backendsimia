<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\DivisiModel;
use App\Models\SubDivisiModel;

class SubDivisi extends ResourceController
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
            $model = new SubDivisiModel();
            $divModel = new DivisiModel();
            $subdivisi['divisi']= $divModel->findAll();
            $subdivisi['subdivisi'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataSubDivisi',$subdivisi);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodeDivisi' => 'required',
            'kodeSubDivisi' => 'required',
            'namaSubDivisi' => 'required'
        ];
        if($this->validate($rules)){
            $model = new SubDivisiModel();
            $data = [
                'kodeDivisi' => $this->request->getVar('kodeDivisi'),
                'kodeSubDivisi' => $this->request->getVar('kodeSubDivisi'),
                'namaSubDivisi' => $this->request->getVar('namaSubDivisi')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Sub Divisi',
                'isiNotifikasi' => $admin.' Telah Menambah Sub Divisi Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataSubDivisi');
        }
    }
    public function hapus($id = null){
        $session = session();
        $model = new SubDivisiModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Sub Divisi',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Sub Divisi = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataSubDivisi');
    }
    public function index()
    {
        //
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
            'kodeDivisi' => 'required',
            'kodeSubDivisi' => 'required',
            'namaSubDivisi' => 'required'
        ];
        $data = [
            'kodeDivisi' => $this->request->getVar('kodeDivisi'),
            'kodeSubDivisi' => $this->request->getVar('kodeSubDivisi'),
            'namaSubDivisi' => $this->request->getVar('namaSubDivisi')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new SubDivisiModel();
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
        $model = new SubDivisiModel();
        $data = [
            'kodeDivisi' => $this->request->getVar('kodeDivisi'),
            'kodeSubDivisi' => $this->request->getVar('kodeSubDivisi'),
            'namaSubDivisi' => $this->request->getVar('namaSubDivisi')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaSubDivisi');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Sub Divisi',
                'isiNotifikasi' => $admin.' Telah Merubah Data Sub Divisi = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataSubDivisi');
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
