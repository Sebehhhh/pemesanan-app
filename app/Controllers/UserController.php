<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        // Ambil semua data pengguna
        $data['users'] = $this->userModel->findAll();

        // Tampilkan view index dengan data pengguna
        return view('users/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }

        return view('users/create');
    }

    public function store()
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        helper(['form']);
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses simpan data pengguna
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        $this->userModel->insert($data);

        // Redirect ke halaman pengguna setelah berhasil disimpan
        return redirect()->to('/users')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        // Ambil data pengguna berdasarkan ID
        $data['user'] = $this->userModel->find($id);

        // Tampilkan form edit pengguna
        return view('users/edit', $data);
    }

    public function update($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        helper(['form']);
        // Validasi input
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'email' => 'required|valid_email',
            'password' => 'permit_empty|min_length[6]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Proses update data pengguna
        $data = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        // Cek apakah ada password yang diubah
        $password = $this->request->getPost('password');
        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->userModel->update($id, $data);

        // Redirect ke halaman pengguna setelah berhasil diupdate
        return redirect()->to('/users')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        if (!session()->get('logged_in')) {
            return view('/errors/html/error_401');
        }
        // Hapus data pengguna berdasarkan ID
        $this->userModel->delete($id);

        // Redirect ke halaman pengguna setelah berhasil dihapus
        return redirect()->to('/users')->with('success', 'User deleted successfully');
    }
}
