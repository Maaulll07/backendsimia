<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\PptkModel;

class Pptk extends ResourceController
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
            $pptkModel = new PptkModel();
            $pptk['PPTK'] = $pptkModel->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataPPTK',$pptk);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodePPTK' => 'required',
            'namaPPTK' => 'required'
        ];
        if($this->validate($rules)){
            $model = new PptkModel();
            $data = [
                'kodePPTK' => $this->request->getVar('kodePPTK'),
                'namaPPTK' => $this->request->getVar('namaPPTK')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data PPTK',
                'isiNotifikasi' => $admin.' Telah Menambah PPTK Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataPPTK');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new PptkModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data PPTK',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode PPTK = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataPPTK');
    }
    public function index()
    {
        $model = new PptkModel();
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
            'kodePPTK' => 'required',
            'namaPPTK' => 'required'
        ];
        $data = [
            'kodePPTK' => $this->request->getVar('kodePPTK'),
            'namaPPTK' => $this->request->getVar('namaPPTK')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new PptkModel();
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
        $model = new PptkModel();
        $data = [
            'kodePPTK' => $this->request->getVar('kodePPTK'),
            'namaPPTK' => $this->request->getVar('namaPPTK')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaPPTK');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data PPTK',
                'isiNotifikasi' => $admin.' Telah Merubah Data PPTK = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataPPTK');
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
