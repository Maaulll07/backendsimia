<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\DivisiModel;
use App\Models\PekerjaanModel;

class Divisi extends ResourceController
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
            $model = new DivisiModel();
            $kerModel = new PekerjaanModel();
            $divisi['pekerjaan'] = $kerModel->findAll();
            $divisi['divisi'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataDivisi',$divisi);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodePekerjaan' => 'required',
            'kodeDivisi' => 'required',
            'namaDivisi' => 'required'
        ];
        if($this->validate($rules)){
            $model = new DivisiModel();
            $data = [
                'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
                'kodeDivisi' => $this->request->getVar('kodeDivisi'),
                'namaDivisi' => $this->request->getVar('namaDivisi')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Divisi',
                'isiNotifikasi' => $admin.' Telah Menambah Divisi Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataDivisi');
        }
    }
    public function hapus($id = null){
        $session = session();
        $model = new DivisiModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Divisi',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Divisi = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataDivisi');
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
            'kodePekerjaan' => 'required',
            'kodeDivisi' => 'required',
            'namaDivisi' => 'required'
        ];
        $data = [
            'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
            'kodeDivisi' => $this->request->getVar('kodeDivisi'),
            'namaDivisi' => $this->request->getVar('namaDivisi')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new DivisiModel();
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
        $model = new DivisiModel();
        $data = [
            'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
            'kodeDivisi' => $this->request->getVar('kodeDivisi'),
            'namaDivisi' => $this->request->getVar('namaDivisi')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaDivisi');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Divisi',
                'isiNotifikasi' => $admin.' Telah Merubah Data Divisi = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataDivisi');
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
