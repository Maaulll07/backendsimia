<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\InfoKegiatanModel;
use App\Models\ProyekModel;
use App\Models\KonsultanModel;
use App\Models\KontraktorModel;
use App\Models\InspectorModel;
use App\Models\PpkModel;
use App\Models\PptkModel;
use App\Models\PekerjaanModel;
use App\Models\NotifikasiModel;

class InfoKegiatan extends ResourceController
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
            $data['data'] = "informasi";
            $notifikasi = new NotifikasiModel();
            $model = new InfoKegiatanModel();
            $proyekModel = new ProyekModel();
            $konsultanModel = new KonsultanModel();
            $kontraktorModel = new KontraktorModel();
            $inspectorModel = new InspectorModel();
            $ppkModel = new PpkModel();
            $pptkModel = new PptkModel();
            $pekerjaanModel = new PekerjaanModel();            
            $info['proyek'] = $proyekModel->findAll();
            $info['konsultan'] = $konsultanModel->findAll();
            $info['kontraktor'] = $kontraktorModel->findAll();
            $info['inspector'] = $inspectorModel->findAll();
            $info['ppk'] = $ppkModel->findAll();
            $info['pptk'] = $pptkModel->findAll();
            $info['pekerjaan'] = $pekerjaanModel->findAll();
            $info['infoKegiatan'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('infoKegiatan',$info);
            echo view('templates/beranda/footer');

        }
    }

    public function getProyek(){
        $model = new ProyekModel();
        $proyekId = $this->request->getVar('id');
        $data = $model->where('id', $proyekId)->find();
        return json_encode($data);
    }

    public function save(){
        $session = session();
        helper(['form']);
        $rules = [
            'namaProyek' => 'required',
            'tanggalProyek' => 'required',
            'kodePekerjaan' => 'required',
            'klpd' => 'required',
            'kodeKonsultan' => 'required',
            'kodeKontraktor' => 'required',
            'subProyek' => 'required',
            'nilaiKontrak' => 'required',
            'kodeLelang' => 'required',
            'tahunAnggaran' => 'required',
            'kodePPK' => 'required',
            'kodePPTK' => 'required',
            'kodeInspector' => 'required',
            'kodeLaporan' => 'required',
            'lokasiProyek' => 'required',
            'nomorKontrak' => 'required',
            'status' => 'required'
        ];

        if($this->validate($rules)){
            $model = new InfoKegiatanModel();
            $pekerjaanModel = new PekerjaanModel();
            $konsultanModel = new KonsultanModel();
            $kontraktorModel = new KontraktorModel();
            $inspectorModel = new InspectorModel();
            $ppkModel = new PpkModel();
            $pptkModel = new PptkModel();
            $konsultan = $this->request->getVar('kodeKonsultan');
            $dataKonsultan = $konsultanModel->where('kodeKonsultan', $konsultan)->first();
            $namaKonsultan = $dataKonsultan['namaKonsultan'];
            $kontraktor = $this->request->getVar('kodeKontraktor');
            $dataKontraktor = $kontraktorModel->where('kodeKontraktor', $kontraktor)->first();
            $namaKontraktor = $dataKontraktor['namaKontraktor'];
            $inspector = $this->request->getVar('kodeInspector');
            $dataInspector = $inspectorModel->where('kodeInspector', $inspector)->first();
            $namaInspector = $dataInspector['namaInspector'];
            $ppk = $this->request->getVar('kodePPK');
            $dataPpk = $ppkModel->where('kodePPK', $ppk)->first();
            $namaPpk = $dataPpk['namaPPK'];
            $pptk = $this->request->getVar('kodePPTK');
            $dataPptk = $pptkModel->where('kodePPTK', $pptk)->first();
            $namaPptk = $dataPptk['namaPPTK'];
            $pekerjaan = $this->request->getVar('kodePekerjaan');
            $dataPekerjaan = $pekerjaanModel->where('kodePekerjaan',$pekerjaan)->first();
            $namaPekerjaan = $dataPekerjaan['jenisPekerjaan'];
            
            $data = [
                'namaProyek' => $this->request->getVar('namaProyek'),
                'tanggalProyek' => $this->request->getVar('tanggalProyek'),
                'kodePekerjaan' => $namaPekerjaan,
                'klpd' => $this->request->getVar('klpd'),
                'kodeKonsultan' => $namaKonsultan,
                'kodeKontraktor' => $namaKontraktor,
                'subProyek' => $this->request->getVar('subProyek'),
                'nilaiKontrak' => $this->request->getVar('nilaiKontrak'),
                'kodeLelang' => $this->request->getVar('kodeLelang'),
                'tahunAnggaran' => $this->request->getVar('tahunAnggaran'),
                'kodePPK' => $namaPpk,
                'kodePPTK' => $namaPptk,
                'kodeInspector' => $namaInspector,
                'kodeLaporan' => $this->request->getVar('kodeLaporan'),
                'lokasiProyek' => $this->request->getVar('lokasiProyek'),
                'nomorKontrak' => $this->request->getVar('nomorKontrak'),
                'status' => $this->request->getVar('status')
            ];

            

            $model->save($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Info Kegiatan',
                'isiNotifikasi' => $admin.' Telah Menambah Info Kegiatan Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave');
            return redirect()->to('/info');
        } else {
            return $this->fail($this->validator->getErrors());
        }

    }
    public function hapus($id = null){
        $session = session();
        $model = new InfoKegiatanModel();
        $model->delete($id);
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Hapus Info Kegiatan',
                'isiNotifikasi' => $admin.' Telah Menghapus Info kegiatan = '.$id,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil dihapus');
        return redirect()->to('/info');

    }
    public function index()
    {
        $model = new InfoKegiatanModel();
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
        $model = new InfoKegiatanModel();
        $data = $model->where('noKontrak',$id)->first();
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
            'namaProyek' => 'required',
            'tanggalProyek' => 'required',
            'kodePekerjaan' => 'required',
            'klpd' => 'required',
            'kodeKonsultan' => 'required',
            'kodeKontraktor' => 'required',
            'subProyek' => 'required',
            'nilaiKontrak' => 'required',
            'kodeLelang' => 'required',
            'tahunAnggaran' => 'required',
            'kodePPK' => 'required',
            'kodePPTK' => 'required',
            'kodeInspector' => 'required',
            'kodeLaporan' => 'required',
            'lokasiProyek' => 'required',
            'nomorKontrak' => 'required',
            'status' => 'required'
        ];

        $data = [
            'namaProyek' => $this->request->getVar('namaProyek'),
                'tanggalProyek' => $this->request->getVar('tanggalProyek'),
                'kodePekerjaan' => $this->request->getVar('kodePekerjaan'),
                'klpd' => $this->request->getVar('klpd'),
                'kodeKonsultan' => $this->request->getVar('kodeKonsultan'),
                'kodeKontraktor' => $this->request->getVar('kodeKontraktor'),
                'subProyek' => $this->request->getVar('subProyek'),
                'nilaiKontrak' => $this->request->getVar('nilaiKontrak'),
                'kodeLelang' => $this->request->getVar('kodeLelang'),
                'tahunAnggaran' => $this->request->getVar('tahunAnggaran'),
                'kodePPK' => $this->request->getVar('kodePPK'),
                'kodePPTK' => $this->request->getVar('kodePPTK'),
                'kodeInspector' => $this->request->getVar('kodeInspector'),
                'kodeLaporan' => $this->request->getVar('kodeLaporan'),
                'lokasiProyek' => $this->request->getVar('lokasiProyek'),
                'nomorKontrak' => $this->request->getVar('nomorKontrak'),
                'status' => $this->request->getVar('status')
        ];

        if(!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new InfoKegiatanModel();
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
            $model = new InfoKegiatanModel();
            $data = [
                
                'status' => $this->request->getVar('status')
            ];
            $model->update($id,$data);
            $nama = $this->request->getVar('status');
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Info Kegiatan',
                'isiNotifikasi' => $admin.' Telah Merubah Status Info Kegiatan = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/info');
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
            $session = session();
            $model = new InfoKegiatanModel();
            $data = [
                
                'status' => $this->request->getVar('status')
            ];
            $model->update($id,$data);
            $nama = $this->request->getVar('status');
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Info Kegiatan',
                'isiNotifikasi' => $admin.' Telah Merubah Status Info Kegiatan = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data Berhasil diedit');
        return redirect()->to('/info');
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
