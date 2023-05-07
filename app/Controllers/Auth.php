<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index()
    {
        return redirect()->to('/login');
    }

    public function login()
    {
        // Jika user sudah login, redirect ke halaman dashboard
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data['title'] = 'Login';

        if ($this->request->getMethod() == 'post') {
            // Validasi form login
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required',
            ];

            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $userModel = new UserModel();

                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');

                $user = $userModel->where('email', $email)->first();

                if (!$user) {
                    $data['error'] = 'User dengan email tersebut tidak ditemukan';
                } elseif (!password_verify($password, $user['password'])) {
                    $data['error'] = 'Password yang dimasukkan salah';
                } else {
                    $this->setUserSession($user);
                    return redirect()->to('/dashboard');
                }
            }
        }

        return view('login', $data);
    }

    private function setUserSession($user)
    {
        $data = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'isLoggedIn' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
