<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'supplier_id' => 1,
                'supplier_kode' => 'B11',
                'supplier_name' => 'PT Unilever',
                'supplier_alamat' => 'Jl. Soekarno Hatta No. 11, Kota Malang',
            ],
            [
                'supplier_id' => 2,
                'supplier_kode' => 'B12',
                'supplier_name' => 'PT Indofood',
                'supplier_alamat' => 'Jl. Merdeka No 23, Kota Jakarta',
            ],
            [
                'supplier_id' => 3,
                'supplier_kode' => 'B13',
                'supplier_name' => 'PT Husada',
                'supplier_alamat' => 'Jl. Bougenvile No. 189, Kabupaten Sidoarjo',
            ]
            ];
            DB::table('m_supplier')->insert($data);
    }
}
