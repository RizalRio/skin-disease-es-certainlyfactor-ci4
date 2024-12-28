<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User as ModelUser;

class User extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new ModelUser();
    }

    public function index()
    {
        return view('pages/login');
    }

    public function login()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $userCek = new ModelUser();
        $cek = $userCek->where('username', $username)->first();

        if ($cek) {
            $cekPassword = password_verify($password, $cek['password_hash']);
            if($cekPassword){
                $sessData = [
                    'id' => $cek['id'],
                    'username' => $cek['username'],
                    'password' => $cek['password_hash'],
                    'role' => $cek['role'],
                    'logged_in' => TRUE,
                ];
                $session->set($sessData);
                return redirect()->to('/dashboard');
            } else {
                session()->setFlashdata('pesan', 'Login Gagal! Password salah!');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('pesan', 'Login Gagal! Username tidak ditemukan!');
            return redirect()->back();
        }
    }


    public function register()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi jika input kosong
            if (empty($username) || empty($password)) {
            session()->setFlashdata('pesan', 'Registrasi Gagal! Username dan Password harus diisi.');
            return redirect()->back()->withInput();
        }

        // Validasi jika username sudah ada di database
        $userCek = new ModelUser();
        $cek = $userCek->where('username', $username)->first();
        if ($cek) {
            session()->setFlashdata('pesan', 'Registrasi Gagal! Username sudah digunakan.');
            return redirect()->back()->withInput();
        }

        // Hash password sebelum disimpan
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Data untuk disimpan ke database
        $data = [
            'username' => $username,
            'password_hash' => $passwordHash,
        ];

        // Simpan data ke database
        $tambah = $userCek->insert($data);

        if ($tambah) {
            // Jika berhasil, arahkan ke halaman login dengan pesan sukses
            session()->setFlashdata('pesan', 'Registrasi berhasil! Silakan login.');
            return redirect()->to('/login');
        } else {
           // Jika gagal, kembalikan dengan pesan error
            session()->setFlashdata('pesan', 'Registrasi Gagal! Terjadi kesalahan.');
            return redirect()->back()->withInput();
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

}