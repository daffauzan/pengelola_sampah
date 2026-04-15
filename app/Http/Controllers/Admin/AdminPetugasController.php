<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminPetugasController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'petugas')->latest()->get();
        return view('admin.petugas.index', compact('data'));
    }

    public function create()
    {
        return view('admin.petugas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'petugas'
        ]);

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas ditambahkan');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        return view('admin.petugas.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => "required|email|unique:users,email,$id",
        ]);

        User::findOrFail($id)->update(
            $request->only('nama', 'email')
        );

        return redirect()->route('admin.petugas.index')
            ->with('success', 'Petugas diupdate');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'Petugas dihapus');
    }
}
