<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\LaporanMasyarakatModel;
use App\Models\NotifikasiModel;

class LaporanMasyarakat extends ResourceController
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
            $model = new LaporanMasyarakatModel();
            $laporan['laporanMasyarakat'] = $model->findAll();
            $data['notif'] = $notifikasi->where('status','belum dibaca')->countAllResults();
            $data['dataNotif'] = $notifikasi->where('status','belum dibaca')->findAll();
            echo view('templates/beranda/header',$data);
            echo view('laporanMasyarakat',$laporan);
            echo view('templates/beranda/footer');

        }
    }
    public function index()
    {
        $model = new LaporanMasyarakatModel();
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
        $model = new LaporanMasyarakatModel();
        $data = $model->where('id',$id)->first();
        return $this->respond($data);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        
        
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $img = $this->request->getFile('file');
        $namaImg = $img->getName();
        
        $temp = explode(".", $namaImg);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        
        if($img->move("uploads",$newfilename)){
            $model = new LaporanMasyarakatModel();
            
            $data = [
                'nama' => $this->request->getVar('nama'),
                'isi' => $this->request->getVar('isi'),
                'kontak' => $this->request->getVar('kontak'),
                'tanggal' => $this->request->getVar('tanggal'),
                'file' => $newfilename,
                'status' => $this->request->getVar('status')
                ];
            
            if($model->insert($data)){
                $notif = new NotifikasiModel();
            
                $notifData = [
                    'jenisNotifikasi' => 'Tambah Laporan Masyarakat',
                    'isiNotifikasi' => 'Laporan Masyarakat Baru Telah Ditambahkan',
                    'status' => 'belum dibaca'
                ];
                $notif->save($notifData);
                $response = [
					'status' => 200,
					'error' => false,
					'message' => 'Laporan Berhasil Terkirim',
					'data' => []
				];
				return redirect()->to("https://simia.enmuh.my.id/terima-kasih");
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
        $session = session();
        $data = [
            'status' => $this->request->getVar('status')
            ];
        $model = new LaporanMasyarakatModel();
        $model->update($id,$data);
        $nama = $this->request->getVar('status');
        $notif= new NotifikasiModel();
            $admin = $session->get('username');
            $notifData = [
                'jenisNotifikasi' => 'Edit Laporan Masyarakat',
                'isiNotifikasi' => $admin.' Telah Merubah Status Laporan Masyarakat = '.$nama,
                'status' => 'belum dibaca'
            ];
            $notif->save($notifData);
        $session->setFlashdata('msg','Data laporan Berhasil diedit');
        return redirect()->to('/laporan');
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new LaporanMasyarakatModel();
        $findById = $model->find(['id' => $id]);
        if(!$findById) return $this->FailNotFound('No Data Found');
        $model->delete($id);
        $notif = new NotifikasiModel();
            
            $notifData = [
                'jenisNotifikasi' => 'Hapus Kritik dan Saran',
                'isiNotifikasi' => 'Kritik dan Saran Telah Dihapus',
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
