<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            $data = [
                [
                    'barang_id' => 1,
                    'kategori_id' => 1,
                    'barang_kode' => 'C011',
                    'barang_nama' => 'Mie Instan',
                    'harga_beli' => 2000,
                    'harga_jual' => 2500,
                ],
                [
                    'barang_id' => 2,
                    'kategori_id' => 1,
                    'barang_kode' => 'C012',
                    'barang_nama' => 'Sabun Mandi',
                    'harga_beli' => 3000,
                    'harga_jual' => 3500,
                ],
                [
                    'barang_id' => 3,
                    'kategori_id' => 1,
                    'barang_kode' => 'C013',
                    'barang_nama' => 'Susu Bubuk',
                    'harga_beli' => 10000,
                    'harga_jual' => 12000,
                ],
                [
                    'barang_id' => 4,
                    'kategori_id' => 2,
                    'barang_kode' => 'C014',
                    'barang_nama' => 'Shampoo',
                    'harga_beli' => 5000,
                    'harga_jual' => 6000,
                ],
                [
                    'barang_id' => 5,
                    'kategori_id' => 2,
                    'barang_kode' => 'C015',
                    'barang_nama' => 'Pasta Gigi',
                    'harga_beli' => 4000,
                    'harga_jual' => 4500,
                ],
                [
                    'barang_id' => 6,
                    'kategori_id' => 2,
                    'barang_kode' => 'C016',
                    'barang_nama' => 'Hand Sanitizer',
                    'harga_beli' => 15000,
                    'harga_jual' => 17000,
                ],
                [
                    'barang_id' => 7,
                    'kategori_id' => 3,
                    'barang_kode' => 'C017',
                    'barang_nama' => 'Sabun Cuci Piring',
                    'harga_beli' => 7000,
                    'harga_jual' => 8000,
                ],
                [
                    'barang_id' => 8,
                    'kategori_id' => 3,
                    'barang_kode' => 'C018',
                    'barang_nama' => 'Detergen',
                    'harga_beli' => 9000,
                    'harga_jual' => 10000,
                ],
                [
                    'barang_id' => 9,
                    'kategori_id' => 3,
                    'barang_kode' => 'C019',
                    'barang_nama' => 'Pembersih Lantai',
                    'harga_beli' => 6000,
                    'harga_jual' => 7000,
                ],
                [
                    'barang_id' => 10,
                    'kategori_id' => 4,
                    'barang_kode' => 'C020',
                    'barang_nama' => 'Tisu Bayi',
                    'harga_beli' => 12000,
                    'harga_jual' => 14000,
                ],
                [
                    'barang_id' => 11,
                    'kategori_id' => 4,
                    'barang_kode' => 'C021',
                    'barang_nama' => 'Popok Bayi',
                    'harga_beli' => 20000,
                    'harga_jual' => 22000,
                ],
                [
                    'barang_id' => 12,
                    'kategori_id' => 4,
                    'barang_kode' => 'C022',
                    'barang_nama' => 'Minyak Telon',
                    'harga_beli' => 10000,
                    'harga_jual' => 12000,
                ],
                [
                    'barang_id' => 13,
                    'kategori_id' => 5,
                    'barang_kode' => 'C023',
                    'barang_nama' => 'Minuman Kemasan',
                    'harga_beli' => 5000,
                    'harga_jual' => 6000,
                ],
                [
                    'barang_id' => 14,
                    'kategori_id' => 5,
                    'barang_kode' => 'C024',
                    'barang_nama' => 'Cokelat Batangan',
                    'harga_beli' => 8000,
                    'harga_jual' => 10000,
                ],
                [
                    'barang_id' => 15,
                    'kategori_id' => 5,
                    'barang_kode' => 'C025',
                    'barang_nama' => 'Keripik Kentang',
                    'harga_beli' => 7000,
                    'harga_jual' => 8500,
                ]
            ];
            DB::table('m_barang')->insert($data);
        }
    }
}
