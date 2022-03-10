<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\KonsultanModel;

class Konsultan extends ResourceController
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
            $model = new KonsultanModel();
            $konsultan['Konsultan'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('dataKonsultan', $konsultan);
            echo view('templates/beranda/footer');

        }
    }
    public function save()
    {
        $session = session();
        helper(['form']);
        $rules =[
            'kodeKonsultan' => 'required',
            'namaKonsultan' => 'required'
        ];
        if($this->validate($rules)){
            $model = new KonsultanModel();
            $data = [
                'kodeKonsultan' => $this->request->getVar('kodeKonsultan'),
                'namaKonsultan' => $this->request->getVar('namaKonsultan'),
                'supervisi' => $this->request->getVar('supervisi'),
                'inspector' => $this->request->getVar('inspector')
            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Konsultan',
                'isiNotifikasi' => $admin.' Telah Menambah Konsultan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataKonsultan');
        }
    }

    public function hapus($id = null){
        $session = session();
        $model = new KonsultanModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Konsultan',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Konsultan = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataKonsultan');
    }
    public function index()
    {
        $model = new KonsultanModel();
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
            'kodeKonsultan' => 'required',
            'namaKonsultan' => 'required'
        ];
        $data = [
            'kodeKonsultan' => $this->request->getVar('kodeKonsultan'),
            'namaKonsultan' => $this->request->getVar('namaKonsultan'),
            'supervisi' => $this->request->getVar('supervisi'),
            'inspector' => $this->request->getVar('inspector')
        ];
        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new KonsultanModel();
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
        $model = new KonsultanModel();
        $data = [
            'kodeKonsultan' => $this->request->getVar('kodeKonsultan'),
            'namaKonsultan' => $this->request->getVar('namaKonsultan'),
            'supervisi' => $this->request->getVar('supervisi'),
            'inspector' => $this->request->getVar('inspector')
        ];
        $model->update($id,$data);
        $nama = $this->request->getVar('namaKonsultan');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Data Konsultan',
                'isiNotifikasi' => $admin.' Telah Merubah Data Konsultan = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/dataKonsultan');
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
