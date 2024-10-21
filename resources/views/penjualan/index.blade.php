@extends('layouts.template')

@section('content')

<div class="container">

    <div class="card-tools mb-3">
          <a href="{{ url('/penjualan/export_excel') }}" class="btn btn-primary"><i class="fa fa-file-excel"></i> Export penjualan XLSX</a>
          <a href="{{ url('/penjualan/export_pdf') }}" class="btn btn-warning"><i class="fa fa-file-pdf"></i> Export penjualan PDF</a>
    </div>

    {{-- Ringkasan total penjualan --}}
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card bg-info text-white">
                <div class="card-body text-center">
                    <h5>Total Transaksi</h5>
                    <h3>{{ $total_transaksi }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <h5>Total Item Terjual</h5>
                    <h3>{{ $total_item_terjual }}</h3>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card bg-warning text-white">
                <div class="card-body text-center">
                    <h5>Total Pendapatan</h5>
                    <h3>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel daftar transaksi penjualan --}}
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="table_penjualan">
            <thead class="thead-dark">
                <tr>
                    <th>ID Penjualan</th>
                    <th>Kode Penjualan</th>
                    <th>Nama Pembeli</th>
                    <th>Tanggal Penjualan</th>
                    <th>User ID</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualan as $data)
                    <tr>
                        <td>{{ $data->penjualan_id }}</td>
                        <td>{{ $data->penjualan_kode }}</td>
                        <td>{{ $data->pembeli }}</td>
                        <td>{{ \Carbon\Carbon::parse($data->penjualan_tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $data->user_id }}</td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="modalAction('{{ url('/penjualan/' . $data->penjualan_id . '/show_ajax') }}')">
                                Lihat Detail
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center">
        {{ $penjualan->links() }} <!-- Menampilkan links untuk navigasi halaman -->
    </div>
</div>

{{-- Modal for AJAX Content --}}
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true"></div>

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

    var dataPenjualan;

    $(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
            // serverSide: true, jika ingin menggunakan server side 
            processing: true,
            serverSide: true,
            ajax: {
                "url": "{{ url('penjualan/list') }}",
                "dataType": "json",
                "type": "POST",
            },
            columns: [
                {
                    data: "penjualan_id",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "penjualan_kode",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "pembeli", // Adjust to the correct field name
                    orderable: true,
                    searchable: true
                },
                {
                    data: "penjualan_tanggal", // Adjust to the correct field name
                    orderable: true,
                    searchable: true,
                    render: function(data) {
                        return moment(data).format('DD-MM-YYYY'); // Format the date
                    }
                },
                {
                    data: "user_id",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false
                }
            ]
        });
    });
</script>
@endpush
