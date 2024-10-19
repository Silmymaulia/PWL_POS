<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user(); // Ambil pengguna yang sedang login
        
        // Proses pembaruan nama
        $user->nama = $request->nama;

        // Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/photos'), $filename);

            // Simpan path foto di database
            $user->photo = 'uploads/photos/' . $filename;
        }

        $user->save(); // Simpan perubahan di database

        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }

    public function showProfile()
    {
        // Mengambil pengguna yang sedang login
        $user = Auth::user();

        // Pastikan ada pengguna yang login
        if (!$user) {
            return redirect()->route('login')->withErrors('Anda harus login terlebih dahulu.');
        }

        // Menyiapkan breadcrumb
        $breadcrumb = (object) [
            'title' => 'Dashboard',
            'list' => [
                'Home',
                (object) ['url' => '/profile', 'label' => 'Profile'],
                'Edit'
            ]
        ];

        // Mengirimkan data user dan breadcrumb ke view
        return view('profile.show', compact('user', 'breadcrumb'));
    }

    public function edit()
    {
        $user = Auth::user();

        // Definisikan breadcrumb
        $breadcrumb = (object) [
            'title' => 'Edit Profile',
            'list' => [
                (object) ['label' => 'Profile', 'url' => route('profile.show')],
                'Edit'
            ]
        ];

        return view('profile.edit', compact('user', 'breadcrumb'));
    }
}
