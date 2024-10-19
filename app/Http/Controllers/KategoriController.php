<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\KategoriModel;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home','Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori yang ada'
        ];

        $activeMenu = 'kategori';

        return view('kategori.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request) {
        $kategoris = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($kategoris)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/kategori/' . $kategori->kategori_id . '/delete_ajax').'\')" class="btn btn-danger btn-sm">Hapus</button>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home','Kategori','Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori baru'
        ];

        $activeMenu = 'kategori';

        return view('kategori.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'kategori_kode'  => 'required|string|unique:m_kategori,kategori_kode',
            'kategori_nama'  => 'required|string|max:100',
        ]);

        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect('/kategori')->with('success', 'Data kategori berhasil disimpan.');
    }

    public function create_ajax()
{
    // Tidak ada relasi pada kategori, jadi langsung mengembalikan view form
    return view('kategori.create_ajax');
}

public function store_ajax(Request $request) {
    if ($request->ajax() || $request->wantsJson()) {
        // Aturan validasi untuk input kategori
        $rules = [
            'kategori_kode' => 'required|string|min:3|unique:m_kategori,kategori_kode',
            'kategori_nama' => 'required|string|max:100',
        ];

        // Melakukan validasi
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            // Mengembalikan respon jika validasi gagal
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors(),
            ]);
        }

        // Menyimpan data kategori
        KategoriModel::create([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama,
        ]);

        // Mengembalikan respon sukses
        return response()->json([
            'status' => true,
            'message' => 'Data kategori berhasil disimpan',
        ]);
    }

    return redirect('/');
    }

    public function show_ajax(string $id)
    {
        // Ambil kategori berdasarkan ID
        $kategori = KategoriModel::find($id);

        // Jika data kategori tidak ditemukan, kembalikan respon dengan status false
        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan.'
            ]);
        }

        // Kirim data kategori ke view confirm_ajax
        return view('kategori.show_ajax', ['kategori' => $kategori]);
    }

    public function edit_ajax(string $id) {
        // Temukan data kategori berdasarkan ID
        $kategori = KategoriModel::find($id);

        if (!$kategori) {
            return response()->json(['status' => false, 'message' => 'Data kategori tidak ditemukan']);
        }

        return view('kategori.edit_ajax', ['kategori' => $kategori]);
    }

    public function update_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kategori_kode' => 'required|string|max:20|unique:m_kategori,kategori_kode,' . $id . ',kategori_id',
                'kategori_nama' => 'required|string|max:100',
            ];

            // Validasi input
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi gagal.',
                    'msgField' => $validator->errors(),
                ]);
            }

            $kategori = KategoriModel::find($id);

            if ($kategori) {
                $kategori->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        // Ambil kategori berdasarkan ID
        $kategori = KategoriModel::find($id);

        // Jika data kategori tidak ditemukan, kembalikan respon dengan status false
        if (!$kategori) {
            return response()->json([
                'status' => false,
                'message' => 'Data kategori tidak ditemukan.'
            ]);
        }

        // Kirim data kategori ke view confirm_ajax
        return view('kategori.confirm_ajax', ['kategori' => $kategori]);
    }

    public function delete_ajax(Request $request, $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $kategori = KategoriModel::find($id);

            if ($kategori) {
                $kategori->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                ]);
            }
        }

        return redirect('/');
    }
}
