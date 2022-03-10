<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\KontraktorModel;

class Kontraktor extends ResourceController
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
            $kontModel = new KontraktorModel();
            $kontraktor['Kontraktor'] = $kontModel->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataKontraktor',$kontraktor);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodeKontraktor' => 'required',
            'namaKontraktor' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KontraktorModel();
            $data = [
                'kodeKontraktor' => $this->request->getVar('kodeKontraktor'),
                'namaKontraktor' => $this->request->getVar('namaKontraktor'),
                'direktur' => $this->request->getVar('direktur'),
                'pengawas' => $this->request->getVar('pengawas')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Kontraktor',
                'isiNotifikasi' => $admin.' Telah Menambah Kontraktor Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataKontraktor');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new KontraktorModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Kontraktor',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Kontraktor = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataKontraktor');
    }
    public function index()
    {
        $model = new KontraktorModel();
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
            'kodeKontraktor' => 'required',
            'namaKontraktor' => 'required'
        ];
        $data = [
            'kodeKontraktor' => $this->request->getVar('kodeKontraktor'),
            'namaKontraktor' => $this->request->getVar('namaKontraktor'),
            'direktur' => $this->request->getVar('direktur'),
            'pengawas' => $this->request->getVar('pengawas')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new KontraktorModel();
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
        $model = new KontraktorModel();
        $data = [
            'kodeKontraktor' => $this->request->getVar('kodeKontraktor'),
            'namaKontraktor' => $this->request->getVar('namaKontraktor'),
            'direktur' => $this->request->getVar('direktur'),
            'pengawas' => $this->request->getVar('pengawas')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaKontraktor');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Kontraktor',
                'isiNotifikasi' => $admin.' Telah Merubah Data Kontraktor = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataKontraktor');
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
