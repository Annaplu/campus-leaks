<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function pengguna()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.pengguna', compact('users'));
    }
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit_pengguna', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'identifier' => 'required',
            'role' => 'required|in:admin,dosen,mahasiswa',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['name', 'identifier', 'role']));

        return redirect()->route('admin.pengguna')->with('success', 'Data pengguna diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->route('admin.pengguna')->with('success', 'Pengguna berhasil dihapus');
    }
    public function index(Request $request)
{
    $query = User::query();

    // Filter berdasarkan pencarian nama/NIM
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('identifier', 'like', "%$search%");
        });
    }
}

}
