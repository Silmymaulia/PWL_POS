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
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Penjualan',
            'list' => ['Home', 'Penjualan']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi penjualan yang tercatat.'
        ];

        $activeMenu = 'penjualan'; // Set menu yang sedang aktif

        return view('penjualan.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    // Mengambil data untuk DataTable
    public function list(Request $request) {
        $penjualan = PenjualanModel::with('barang')->select('penjualan_id', 'barang_id', 'tanggal', 'jumlah', 'total_harga');

        return DataTables::of($penjualan)
            ->addIndexColumn()
            ->addColumn('aksi', function ($penjualan) {
                $btn = '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/penjualan/' . $penjualan->penjualan_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="deletePenjualan('.$penjualan->penjualan_id.')" class="btn btn-danger btn-sm">Hapus</button>';

                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
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
}
