<?php

namespace App\Http\Controllers;

use App\Models\PenjualanModel;
use App\Models\BarangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PenjualanController extends Controller
{
    // Menampilkan daftar penjualan
// Metode untuk menampilkan halaman daftar penjualan
public function index()
{
    // Mengambil semua data penjualan
    $penjualan = PenjualanModel::with('details')->paginate(10); 

    // Data Breadcrumb
    $breadcrumb = (object) [
        'title' => 'Daftar Penjualan',
        'list' => ['Home', 'Penjualan']
    ];

    // Hitung total transaksi
    $total_transaksi = $penjualan->count($penjualan);

    // Hitung total item yang terjual
    $total_item_terjual = $penjualan->sum(function ($penjualan) {
        return $penjualan->details->sum('jumlah');
    });

    // Hitung total pendapatan
    $total_pendapatan = $penjualan->sum(function ($penjualan) {
        return $penjualan->details->sum(function ($detail) {
            return $detail->harga * $detail->jumlah;
        });
    });

    // Kirimkan data ke view
    return view('penjualan.index', compact('penjualan', 'total_transaksi', 'total_item_terjual', 'total_pendapatan', 'breadcrumb'));
}

// Mengambil data untuk DataTable
public function list(Request $request)
{
    // Ambil data penjualan dengan eager loading untuk details
    $penjualan = PenjualanModel::with('details')
        ->select('penjualan_id', 'penjualan_kode', 'pembeli', 'penjualan_tanggal', 'user_id')
        ->orderBy('penjualan_id', 'asc')
        ->paginate(10);

    // Mengembalikan data ke DataTables
    return DataTables::of($penjualan)
        ->addIndexColumn()
        ->addColumn('aksi', function ($penjualan) {
            return '
                <button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button>
                <button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button>
                <button onclick="deletePenjualan('.$penjualan->penjualan_id.')" class="btn btn-danger btn-sm">Hapus</button>
            ';
        })
        ->rawColumns(['aksi'])
        ->make(true);
}

public function show($id)
{
    $penjualan = PenjualanModel::with('details.barang')->findOrFail($id);
    return view('show_ajax', compact('penjualan'));
}


public function show_ajax(string $id)
{
    // Ambil data penjualan berdasarkan ID
    $penjualan = PenjualanModel::find($id);

    // Jika data penjualan tidak ditemukan, kirimkan respon error
    if (!$penjualan) {
        return response()->json([
            'status' => false,
            'message' => 'Data penjualan tidak ditemukan.'
        ]);
    }

    // Kembalikan view dengan data penjualan
    return view('penjualan.show_ajax', ['penjualan' => $penjualan]);
}

    // Menampilkan form untuk menambahkan penjualan
    public function create_ajax() {
        $barang = BarangModel::all(); // Mendapatkan semua data barang

        $breadcrumb = (object) [
            'title' => 'Tambah Penjualan (AJAX)',
            'list' => ['Home', 'Penjualan', 'Tambah']
        ];

        return view('penjualan.create_ajax', compact('barang', 'breadcrumb'));
    }

    // Menyimpan data penjualan baru
    public function store_ajax(Request $request)
    {
        // Aturan validasi
        $rules = [
            'barang_id' => 'required|exists:m_barang,barang_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:0',
        ];

        // Validasi input
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors()
            ]);
        }

        // Menyimpan data penjualan
        PenjualanModel::create([
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data penjualan berhasil disimpan'
        ]);
    }

    // Menampilkan form untuk mengedit penjualan
    public function edit_ajax($id)
    {
        $penjualan = PenjualanModel::with('barang')->find($id);

        if (!$penjualan) {
            return response()->json(['status' => false, 'message' => 'Data penjualan tidak ditemukan']);
        }

        // Mendapatkan list barang
        $barang = BarangModel::select('barang_id', 'barang_nama')->get();

        return view('penjualan.edit_ajax', ['penjualan' => $penjualan, 'barang' => $barang]);
    }

    // Memperbarui data penjualan
    public function update_ajax(Request $request, $id)
    {
        $rules = [
            'barang_id' => 'required|exists:m_barang,barang_id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:1',
            'total_harga' => 'required|numeric|min:0',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msgField' => $validator->errors()
            ]);
        }

        $penjualan = PenjualanModel::find($id);
        if (!$penjualan) {
            return response()->json(['status' => false, 'message' => 'Data penjualan tidak ditemukan']);
        }

        $penjualan->update([
            'barang_id' => $request->barang_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'total_harga' => $request->total_harga,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data penjualan berhasil diperbarui'
        ]);
    }

    // Menghapus data penjualan
    public function destroy_ajax($id)
    {
        $penjualan = PenjualanModel::find($id);
        if (!$penjualan) {
            return response()->json(['status' => false, 'message' => 'Data penjualan tidak ditemukan']);
        }

        $penjualan->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data penjualan berhasil dihapus'
        ]);
    }

    public function import_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'file_penjualan' => ['required', 'mimes:xlsx', 'max:1024']
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }
            $file = $request->file('file_penjualan');
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $data = $sheet->toArray(null, false, true, true);
            $insert = [];
            if (count($data) > 1) {
                foreach ($data as $baris => $value) {
                    if ($baris > 1) {
                        $insert[] = [
                            'penjualan_nama' => $value['A'],
                            'created_at' => now(),
                        ];
                    }
                }
                if (count($insert) > 0) {
                    PenjualanModel::insertOrIgnore($insert);
                }
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diimport'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Tidak ada data yang diimport'
                ]);
            }
        }
        return redirect('/');
    }

    public function export_excel() {
        $penjualan = PenjualanModel::all();

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Penjualan');
        $sheet->getStyle('A1:B1')->getFont()->setBold(true);

        $no = 1;
        $baris = 2;

        foreach ($penjualan as $value) {
            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue('B' . $baris, $value->penjualan_nama);
            $baris++;
            $no++;
        }

        foreach (range('A', 'B') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        $sheet->setTitle('Data Penjualan');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
        $filename = 'Data_Penjualan_' . date('Y-m-d_H-i-s') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 25 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer->save('php://output');
        exit;
    }

    public function export_pdf() {
        // Fetch all penjualan records
        $penjualan = PenjualanModel::all();
        
        // Load the view and pass the penjualan data
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('penjualan.export_pdf', ['penjualan' => $penjualan]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->render();
    
        // Stream the generated PDF to the browser
        return $pdf->stream('Data Penjualan ' . date('Y-m-d H:i:s') . '.pdf');
    }
    
    
}
