<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\PekerjaanModel;


class Pekerjaan extends ResourceController
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
            $pekerjaanModel = new PekerjaanModel();
            $pekerjaan['pekerjaan'] = $pekerjaanModel->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataPekerjaan',$pekerjaan);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodePekerjaan' => 'required',
            'jenisPekerjaan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new PekerjaanModel();
            $data = [
                'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
                'jenisPekerjaan' => $this->request->getVar('jenisPekerjaan')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Pekerjaan',
                'isiNotifikasi' => $admin.' Telah Menambah Pekerjaan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataPekerjaan');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new PekerjaanModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Pekerjaan',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Pekerjaan = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataPekerjaan');
    }
    public function index()
    {
        $model = new PekerjaanModel();
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
            'kodePekerjaan' => 'required',
            'jenisPekerjaan' => 'required'
        ];
        $data = [
            'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
            'jenisPekerjaan' => $this->request->getVar('jenisPekerjaan')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new PekerjaanModel();
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
        $model = new DataPekerjaanModel();
        $data = [
            'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
            'jenisPekerjaan' => $this->request->getVar('jenisPekerjaan')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('jenisPekerjaan');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Pekerjaan',
                'isiNotifikasi' => $admin.' Telah Merubah Data Pekerjaan = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataPekerjaan');
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
