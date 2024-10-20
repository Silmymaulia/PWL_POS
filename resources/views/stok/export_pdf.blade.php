<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 4px 3px;
        }
        th {
            text-align: left;
        }
        .d-block {
            display: block;
        }
        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .p-1 {
            padding: 5px 1px;
        }
        .font-10 {
            font-size: 10pt;
        }
        .font-11 {
            font-size: 11pt;
        }
        .font-12 {
            font-size: 12pt;
        }
        .font-13 {
            font-size: 13pt;
        }
        .border-bottom-header {
            border-bottom: 1px solid;
        }
        .border-all, .border-all th, .border-all td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('polinema-bw.png') }}" alt="Logo Polinema">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    
    <h3 class="text-center">LAPORAN DATA STOK</h3>
    
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Stok</th>
                <th>Nama Stok</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Kondisi</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stok as $s)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $s->stok_kode }}</td>
                    <td>{{ $s->stok_nama }}</td>
                    <td class="text-right">{{ number_format($s->jumlah, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $s->kondisi }}</td>
                    <td>{{ $s->kategori->kategori_nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 4px 3px;
        }
        th {
            text-align: left;
        }
        .d-block {
            display: block;
        }
        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .p-1 {
            padding: 5px 1px;
        }
        .font-10 {
            font-size: 10pt;
        }
        .font-11 {
            font-size: 11pt;
        }
        .font-12 {
            font-size: 12pt;
        }
        .font-13 {
            font-size: 13pt;
        }
        .border-bottom-header {
            border-bottom: 1px solid;
        }
        .border-all, .border-all th, .border-all td {
            border: 1px solid;
        }
    </style>
</head>
<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('polinema-bw.png') }}" alt="Logo Polinema">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    
    <h3 class="text-center">LAPORAN DATA STOK</h3>
    
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Stok</th>
                <th>Nama Stok</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Kondisi</th>
                <th>Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stok as $s)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $s->stok_kode }}</td>
                    <td>{{ $s->stok_nama }}</td>
                    <td class="text-right">{{ number_format($s->jumlah, 0, ',', '.') }}</td>
                    <td class="text-right">{{ $s->kondisi }}</td>
                    <td>{{ $s->kategori->kategori_nama }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>