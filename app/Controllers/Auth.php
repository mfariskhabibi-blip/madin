<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        // Jika sudah login, redirect sesuai rolenya
        if (session()->get('isLoggedIn')) {
            return $this->redirectBasedOnRole(session()->get('role'));
        }

        $data = [
            'judul' => 'Login LMS PTQ Al-Hikmah'
        ];
        return view('auth/login', $data);
    }

    public function process()
    {
        $session = session();
        $model = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user) {
            if ($user['status'] === 'nonaktif') {
                $session->setFlashdata('error', 'Akun Anda sedang dinonaktifkan. Hubungi admin.');
                return redirect()->to('/auth/login');
            }

            if (password_verify($password, $user['password'])) {
                $ses_data = [
                    'id'           => $user['id'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'email'        => $user['email'],
                    'role'         => $user['role'],
                    'avatar'       => $user['avatar'],
                    'isLoggedIn'   => true
                ];
                $session->set($ses_data);
                
                return $this->redirectBasedOnRole($user['role']);
            } else {
                $session->setFlashdata('error', 'Password salah.');
                return redirect()->to('/auth/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan.');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth/login');
    }

    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->to('/admin/dashboard');
            case 'ustadz':
                return redirect()->to('/ustadz/dashboard');
            case 'ortu':
                return redirect()->to('/ortu/dashboard');
            default:
                return redirect()->to('/');
        }
    }
}
