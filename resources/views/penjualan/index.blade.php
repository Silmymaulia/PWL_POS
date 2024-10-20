@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modalAction('{{ url('/penjualan/create_ajax') }}')" class="btn btn-success">Tambah Data</button>
            <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export Penjualan XLSX</a>
            <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export Penjualan PDF</a>
        </div>
    </div> 
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
            
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Barang ID</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Total Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function() {
            $('#myModal').modal('show');
        });
    }

    var datapenjualan;

    $(document).ready(function() {
        datapenjualan = $('#table_penjualan').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('penjualan/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {
                    data: "penjualan_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_id",  // Ganti dengan nama kolom yang sesuai
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tanggal",  // Tanggal penjualan
                    className: "",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "jumlah",  // Jumlah penjualan
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "total_harga",  // Total harga
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
