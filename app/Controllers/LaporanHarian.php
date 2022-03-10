<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\NotifikasiModel;
use App\Models\LaporanHarianModel;
use App\Models\InfoKegiatanModel;

class LaporanHarian extends ResourceController
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
            $session = session();
            $data['data'] = "informasi";
            $notifikasi = new NotifikasiModel();
            $model = new LaporanHarianModel();
            $infoModel = new InfoKegiatanModel();
            $laporanHarian['infoKegiatan'] = $infoModel->findAll();
            $laporanHarian['laporanHarian'] = $model->findAll();
            $laporanHarian['user'] = $session->get('username');
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('laporanHarian',$laporanHarian);
            echo view('templates/beranda/footer');

        }
    }
    
    public function save()
    {
        $session = session();
        $database = \Config\Database::connect();
        $db = $database->table('laporanharians');
        helper(['form','url']);
        $rules =[
            'kodeLaporan' => 'required',
            'file' => [
                'uploaded[file]',
                'mime_in[file,application/pdf]'
                
            ],    
            
            'upload' => 'required',
            'user' => 'required'
        ];
        if($this->validate($rules)){
            $pdf = $this->request->getFile('file');
            $namaAcak = $pdf->getRandomName(); 
            $pdf->move('laporanFolder', $namaAcak);
            $data = [
                'kodeLaporan' => $this->request->getVar('kodeLaporan'),
                'namaFile' => $pdf->getName(),
                'upload' => $this->request->getVar('upload'),
                'user' => $this->request->getVar('user')
                ];
            $save = $db->insert($data);
            $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Tambah Laporan Progres',
                'isiNotifikasi' => $admin.' Telah Menambah Laporan Progres Baru',
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
            $session->setFlashdata('msg','Data Berhasil disave dengan');
            return redirect()->to('/laporanProgres');
        }else{
            return $this->fail($this->validator->getErrors()); 
        }
    }
    public function index()
    {
        $model = new LaporanHarianModel();
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
        $pdf = $this->request->getFile('file');
        $namaPdf = $pdf->getName();
        
        $temp = explode(".", $namaPdf);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        if($pdf->move("laporanFolder",$newfilename))
        {
            $model = new LaporanHarianModel();
            $data = [
                'kodeLaporan' => $this->request->getVar('kodeLaporan'),
                'namaFile' => $newfilename,
                'upload' => $this->request->getVar('upload'),
                'user' => $this->request->getVar('user')
                ];
            if($model->insert($data))
            {
                $notif = new NotifikasiModel();
            
                $notifData = [
                    'jenisNotifikasi' => 'Tambah Laporan Progres',
                    'isiNotifikasi' => 'Laporan Progres Baru Telah Ditambahkan',
                    'status' => 'belum dibaca'
                ];
                $notif->save($notifData);
                $response = [
					'status' => 200,
					'error' => false,
					'message' => 'Laporan Berhasil Terkirim',
					'data' => []
				];
				
				
            } else {
                $response = [
					'status' => 500,
					'error' => true,
					'message' => 'Gagal upload laporan',
					'data' => []
				];
				
            }
        } else {

			$response = [
				'status' => 500,
				'error' => true,
				'message' => 'Failed to upload image',
				'data' => []
			];
		}
		
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
