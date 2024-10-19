@extends('layouts.template')

@section('title', 'Profil Pengguna')

@section('content')

@php
    $activeMenu = 'profile'; // Set active menu to 'profile'
@endphp

<div class="container-fluid mt-5">
    <h2 class="text-center mb-4">Profil Pengguna</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body text-center">
                    <!-- Ambil foto dari database, atau gunakan default jika kosong -->
                    <img src="{{ $user->photo ?? asset('default_photo.jpg') }}" alt="Foto Profil" class="rounded-circle mb-3" style="width: 150px; height: 150px;">
                    
                    <!-- Tampilkan nama dan username -->
                    <h5 class="card-title">{{ $user->nama }}</h5> <!-- Ganti 'name' menjadi 'nama' -->
                    <p class="card-text">Username: {{ $user->username }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-warning">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
