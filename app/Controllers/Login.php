<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;


class Login extends BaseController
{
    public function index()
    {
        helper(['form']);
        echo view('templates/login/header');
        echo view('login');
        echo view('templates/login/footer');
    }

    public function auth(){

        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $sess_data = [
                    'id_user' => $data['id_user'],
                    'username' => $data['username'],
                    'level' => $data['level'],
                    'logged_in' => TRUE
                ];
                $session->set($sess_data);
                return redirect()->to('/beranda');
            } else {
                $session->setFlashdata('msg','Password Salah');
                return redirect()->to('/login');
            }

        }else 
        {
            $session->setFlashdata('msg','Username Salah/Tidak Terdaftar');
                return redirect()->to('/login');
        }

    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
