<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'kategori_kode' => 'A01',
                'kategori_nama' => 'Makanan',
            ],
            [
                'kategori_id' => 2,
                'kategori_kode' => 'A02',
                'kategori_nama' => 'Minuman',
            ],
            [
                'kategori_id' => 3,
                'kategori_kode' => 'A03',
                'kategori_nama' => 'Perawatan Tubuh',
            ],
            [
                'kategori_id' => 4,
                'kategori_kode' => 'A04',
                'kategori_nama' => 'Kebutuhan Dapur',
            ],
            [
                'kategori_id' => 5,
                'kategori_kode' => 'A05',
                'kategori_nama' => 'Kesehatan',
            ]
            ];
            DB::table('m_kategori')->insert($data);
    }
}
