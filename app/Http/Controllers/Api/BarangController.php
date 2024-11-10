<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BarangModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index()
    {
        return BarangModel::all();
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required|integer',
            'barang_kode' => 'required|string|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string',
            'harga_beli' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Simpan gambar
        $imagePath = $request->file('image')->store('images', 'public');

        // Buat data barang baru
        $barang = BarangModel::create([
            'kategori_id' => $request->kategori_id,
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'image' => $imagePath
        ]);

        return response()->json($barang, 201);
    }

    public function show(BarangModel $barang)
    {
        return $barang;
    }

    public function update(Request $request, BarangModel $barang)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'sometimes|integer',
            'barang_kode' => 'sometimes|string|unique:m_barang,barang_kode,' . $barang->id,
            'barang_nama' => 'sometimes|string',
            'harga_beli' => 'sometimes|numeric',
            'harga_jual' => 'sometimes|numeric',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Periksa jika ada file gambar baru
        if ($request->hashFile('image')) {
            // Hapus gambar lama jika ada
            if ($barang->image) {
                Storage::disk('public')->delete($barang->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('images', 'public');
            $barang->image = $imagePath;
        }

        // Update data barang
        $barang->update($request->except('image') + ['image' => $barang->image]);

        return response()->json($barang);
    }

    public function destroy(BarangModel $barang)
    {
        // Hapus gambar jika ada
        if ($barang->image) {
            Storage::disk('public')->delete($barang->image);
        }

        // Hapus data barang
        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data terhapus',
        ]);
    }
}

