@extends('layouts.template')

@section('title', 'Upload Foto Profil')

@section('content')
<div class="container-fluid mt-5">
    <h2 class="text-center mb-4">Upload Foto Profil</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <form action="{{ route('profile.update.photo') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="photo" class="font-weight-bold">Unggah Foto:</label>
                            <input type="file" name="photo" required accept="image/*" class="form-control-file border">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Unggah Foto</button>
                    </form>

                    @if(session('success'))
                        <div class="alert alert-success mt-3">{{ session('success') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
