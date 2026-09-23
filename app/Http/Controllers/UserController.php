<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Models\Kelas;


class UserController extends Controller
{
    public $userModel;
    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->kelasModel = new Kelas();
    }

    public function store(Request $request)
    {
        $this->userModel->create([
            'nama' => $request->input('nama'),
            'npm' => $request->input('npm'),
            'kelas_id' => $request->input('kelas_id')
        ]);

        return redirect()->to('/user');
    }

    public function create()
    {
        $klasModel = new Kelas();
        $kelas = $klasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas
        ];
        return view('create_user', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'User List',
            'users' => $this->userModel->getUser()
        ];
        return view('user_list', $data);
    }
}
