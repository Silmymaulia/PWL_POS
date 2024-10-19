<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SupplierModel;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Supplier',
            'list' => ['Home', 'Supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier barang.'
        ];

        $activeMenu = 'supplier'; // set menu yang sedang aktif

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $suppliers = SupplierModel::select('supplier_id', 'supplier_kode', 'supplier_name', 'supplier_alamat');

        return DataTables::of($suppliers)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn = '<button onclick="modalAction(\''.url('/supplier/' . $supplier->supplier_id . '/show_ajax').'\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\''.url('/supplier/' . $supplier->supplier_id . '/edit_ajax').'\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<form class="d-inline-block" method="POST" action="'.url('/supplier/' . $supplier->supplier_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // pastikan 'aksi' dirender sebagai HTML
            ->make(true);
    }


    public function create_ajax()
    {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_kode',
                'supplier_name' => 'required|string|max:100',
                'supplier_alamat' => 'required|string|max:255'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            SupplierModel::create([
                'supplier_kode' => $request->supplier_kode,
                'supplier_name' => $request->supplier_name,
                'supplier_alamat' => $request->supplier_alamat
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil disimpan',
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $supplier = SupplierModel::find($id);

        if (!$supplier) {
            return response()->json(['status' => false, 'message' => 'Data supplier tidak ditemukan']);
        }

        return view('supplier.edit_ajax', ['supplier' => $supplier]);
    }

    public function update_ajax(Request $request, string $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'supplier_kode' => 'required|string|min:3|unique:m_supplier,supplier_kode,' . $id . ',supplier_id',
                'supplier_name' => 'required|string|max:100',
                'supplier_alamat' => 'required|string|max:255',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors(),
                ]);
            }

            $supplier = SupplierModel::find($id);

            if ($supplier) {
                $supplier->update($request->all());

                return response()->json([
                    'status' => true,
                    'message' => 'Data supplier berhasil diupdate',
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan'
            ]);
        }

        return redirect('/');
    }

    public function destroy(string $id)
    {
        $supplier = SupplierModel::find($id);

        if (!$supplier) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id);
            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }

    public function confirm_ajax(string $id)
{
    // Ambil data supplier berdasarkan ID
    $supplier = SupplierModel::find($id);

    // Jika data supplier tidak ditemukan, kirimkan respon error
    if (!$supplier) {
        return response()->json([
            'status' => false,
            'message' => 'Supplier tidak ditemukan.'
        ]);
    }

    // Kembalikan view konfirmasi penghapusan supplier
    return view('supplier.confirm_ajax', ['supplier' => $supplier]);
}

public function show_ajax(string $id)
{
    // Ambil data supplier berdasarkan ID
    $supplier = SupplierModel::find($id);

    // Jika data supplier tidak ditemukan, kirimkan respon error
    if (!$supplier) {
        return response()->json([
            'status' => false,
            'message' => 'Supplier tidak ditemukan.'
        ]);
    }

    // Kembalikan view konfirmasi penghapusan supplier
    return view('supplier.show_ajax', ['supplier' => $supplier]);
}

public function delete_ajax(Request $request, $id)
{
    // Pastikan request berasal dari AJAX
    if ($request->ajax() || $request->wantsJson()) {
        $supplier = SupplierModel::find($id);

        // Jika data supplier ditemukan, hapus
        if ($supplier) {
            $supplier->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data supplier berhasil dihapus!',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data supplier tidak ditemukan!',
            ]);
        }
    }

    return redirect('/');
}

}
