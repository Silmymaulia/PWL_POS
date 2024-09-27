<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        //tambah data user dengan eloguent mode
        // $data = [
        //     // 'level_id' => 2,
        //     // 'username' => 'manager_dua',
        //     // 'nama' => 'Manager 2',
        //     // 'password' => Hash::make('12345')

        //     'level_id' => 2,
        //     'username' => 'manager_tiga',
        //     'nama' => 'Manager 2',
        //     'password' => Hash::make('12345')
        // ];
        // UserModel::create($data);
        // // UserModel::insert($data); //tambahkan data ke tabel m_user
        // //UserModel::where('username', 'customer-1')->update($data); //update data user

        // //coba akses model UserModel
        // $user = UserModel::all(); //ambil semua data dari tabel m_user
        // return view('user', ['data' => $user]);

        //praktikum 2.1
        // $user = UserModel::findOr(20, ['username', 'nama'], function () {
        //     abort(404);
        // });

        //praktikum 2.2
        // $user = UserModel::where('level_id', 2)->count();
        // //dd($user);
        // return view('user', ['data' => $user]);

        // Menghitung jumlah user dengan level_id = 2
        // $userCount = UserModel::where('level_id', 2)->count();
        
        // // Mengirim hasil perhitungan ke view
        // return view('user', ['userCount' => $userCount]);

        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make('12345'),
        //         'level_id' => 2
        //     ],
        // );

        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make('12345'),
                'level_id' => 2
            ]
        );
        $user->save();
        
        return view('user', ['data' => $user]);
    }
}
