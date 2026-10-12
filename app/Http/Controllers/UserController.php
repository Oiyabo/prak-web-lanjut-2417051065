<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $userModel;

    public $kelasModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->kelasModel = new Kelas;
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
            'kelas_id' => $validated['kelas_id'],
        ]);

        return redirect()->route('user.index');
    }

    public function create()
    {
        $klasModel = new Kelas;
        $kelas = $klasModel->getKelas();
        $data = [
            'title' => 'Create User',
            'kelas' => $kelas,
        ];

        return view('create_user', $data);
    }

    public function index()
    {
        $data = [
            'title' => 'User List',
            'users' => $this->userModel->getUser(),
        ];

        return view('list_user', $data);
    }

    public function edit(string $id)
    {
        $user = $this->userModel->findOrFail($id);

        return view('edit_user', [
            'title' => 'Edit User',
            'user' => $user,
            'kelas' => $this->kelasModel->getKelas(),
        ]);
    }

    public function update(Request $request, string $id)
    {
        $user = $this->userModel->findOrFail($id);
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'npm' => ['required', 'string', 'max:30'],
            'kelas_id' => ['required', 'exists:kelas,id'],
        ]);

        $user->update([
            'nama' => $validated['nama'],
            'nim' => $validated['npm'],
            'kelas_id' => $validated['kelas_id'],
        ]);

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $user = $this->userModel->findOrFail($id);
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data pengguna berhasil dihapus.');
    }
}
