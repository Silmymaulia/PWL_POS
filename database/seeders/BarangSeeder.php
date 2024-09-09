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
                    'harga beli' => 2000,
                    'harga jual' => 2500,
                ],
                [
                    'barang_id' => 2,
                    'kategori_id' => 1,
                    'barang_kode' => 'C012',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 3,
                    'kategori_id' => 1,
                    'barang_kode' => 'C013',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 4,
                    'kategori_id' => 2,
                    'barang_kode' => 'C014',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 5,
                    'kategori_id' => 2,
                    'barang_kode' => 'C015',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 6,
                    'kategori_id' => 2,
                    'barang_kode' => 'C016',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 7,
                    'kategori_id' => 3,
                    'barang_kode' => 'C017',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 8,
                    'kategori_id' => 3,
                    'barang_kode' => 'C018',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 9,
                    'kategori_id' => 3,
                    'barang_kode' => 'C019',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 10,
                    'kategori_id' => 4,
                    'barang_kode' => 'C020',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 11,
                    'kategori_id' => 4,
                    'barang_kode' => 'C021',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 12,
                    'kategori_id' => 4,
                    'barang_kode' => 'C022',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 13,
                    'kategori_id' => 5,
                    'barang_kode' => 'C023',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 14,
                    'kategori_id' => 5,
                    'barang_kode' => 'C024',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ],
                [
                    'barang_id' => 15,
                    'kategori_id' => 5,
                    'barang_kode' => 'C025',
                    'barang_nama' => 'PT Unilever',
                    'harga beli' =>,
                    'harga jual' =>,
                ]
                ];
                DB::table('m_supplier')->insert($data);
        }/
    }
}
