<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ProyekModel;
use App\Models\KecamatanModel;
use App\Models\KelurahanModel;
use App\Models\NotifikasiModel;

class Proyek extends ResourceController
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
            $model = new ProyekModel();
            $modelKec = new KecamatanModel();
            $proyek['kecamatan'] = $modelKec->findAll();
            $proyek['kegiatan'] = $model->findAll();
            $data['data'] = "proyek";
            $notifikasi = new NotifikasiModel();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('proyek',$proyek);
            echo view('templates/beranda/footer');

        }
    }

    public function getKelurahan(){
        $model = new KelurahanModel();
        $kecamatanId = $this->request->getVar('id');
        $data = $model->where('kodeKecamatan', $kecamatanId)->findAll();
        return json_encode($data);
    }

    public function save(){
        $session = session();
        helper(['form']);
        $kecModel = new KecamatanModel();
        $kelModel = new KelurahanModel();
        $kecKode = $this->request->getVar('kodeKecamatan');
        $kelKode = $this->request->getVar('kodeKelurahan');
        $kecData = $kecModel->where('kodeKecamatan',$kecKode )->first();
        $kelData = $kelModel->where('kodeKelurahan',$kelKode)->first();
        $lokasi = 'Lampung Selatan - Kecamatan '.$kecData['namaKecamatan'].' - Kelurahan/Desa '.$kelData['namaKelurahan'];
        $tanggal = $this->request->getVar('tanggalProyek');
        $date = date('Y-m-d', strtotime($tanggal));
        
        $rules = [
            'namaProyek' => 'required',
            'tanggalProyek' => 'required',
            'subProyek' => 'required',
            'nilaiKontrak' => 'required',
            'nomorKontrak' => 'required',
            'kodeLelang' => 'required',
            'tahunAnggaran' => 'required',
            'progres' => 'required',
            'status' => 'required'
        ];
        if($this->validate($rules)){
            $model = new ProyekModel();
            $data = [
            'namaProyek' => $this->request->getVar('namaProyek'),
            'lokasiProyek' => $lokasi,
            'tanggalProyek' => $date,
            'subProyek' => $this->request->getVar('subProyek'),
            'nilaiKontrak' => $this->request->getVar('nilaiKontrak'),
            'nomorKontrak' => $this->request->getVar('nomorKontrak'),
            'kodeLelang' => $this->request->getVar('kodeLelang'),
            'tahunAnggaran' => $this->request->getVar('tahunAnggaran'),
            'progres' => $this->request->getVar('progres'),
            'status' => $this->request->getVar('status')

            ];
            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Data Kegiatan',
                'isiNotifikasi' => $admin.' Telah Menambah Kegiatan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/dataProyek');
        } else {
            return $this->fail($this->validator->getErrors());
        }
    }
    public function hapus($id = null){
        $session = session();
        $model = new ProyekModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Data Proyek',
                'isiNotifikasi' => $admin.' Telah Menghapus Kode Proyek = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/dataProyek');
    }
    public function index()
    {
        $model = new ProyekModel();
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
        $kecModel = new KecamatanModel();
        $kelModel = new KelurahanModel();
        $kecKode = $this->request->getVar('kodeKecamatan');
        $kelKode = $this->request->getVar('kodeKelurahan');
        $kecData = $kecModel->where('kodeKecamatan',$kecKode )->first();
        $kelData = $kelModel->where('kodeKelurahan',$kelKode)->first();
        $lokasi = $kecData['namaKecamatan'].'-'.$kelData['namaKelurahan'];

        $rules = [
            'namaProyek' => 'required',
            'tanggalProyek' => 'required',
            'subProyek' => 'required',
            'nilaiKontrak' => 'required',
            'nomorKontrak' => 'required',
            'kodeLelang' => 'required',
            'tahunAnggaran' => 'required',
            'progres' => 'required',
            'status' => 'required'
        ];
        $data = [
            'namaProyek' => $this->request->getVar('namaProyek'),
            'lokasiProyek' => $kecData['namaKecamatan'].'-'.$kelData['namaKelurahan'],
            'tanggalProyek' => $this->request->getVar('tanggalProyek'),
            'subProyek' => $this->request->getVar('subProyek'),
            'nilaiKontrak' => $this->request->getVar('nilaiKontrak'),
            'nomorKontrak' => $this->request->getVar('nomorKontrak'),
            'kodeLelang' => $this->request->getVar('kodeLelang'),
            'tahunAnggaran' => $this->request->getVar('tahunAnggaran'),
            'progres' => $this->request->getVar('progres'),
            'status' => $this->request->getVar('status')

            ];
            if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
            $model = new ProyekModel();
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
        //
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
