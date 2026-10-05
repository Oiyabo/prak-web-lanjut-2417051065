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
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:30'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ]);

        $this->userModel->create([
            'nama' => $validated['nama'],
            'nim' => $validated['npm'],
            'kelas_id' => $validated['kelas_id']
        ]);

        return redirect()->route('user.index');
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
        return view('list_user', $data);
    }
}
