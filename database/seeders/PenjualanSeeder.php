<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 1,
                'pembeli' => 'John Doe',
                'penjualan_kode' => 'TRX001',
                'penjualan_tanggal' => Carbon::now()->subDays(10),
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 2,
                'pembeli' => 'Jane Smith',
                'penjualan_kode' => 'TRX002',
                'penjualan_tanggal' => Carbon::now()->subDays(9),
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 1,
                'pembeli' => 'Mike Johnson',
                'penjualan_kode' => 'TRX003',
                'penjualan_tanggal' => Carbon::now()->subDays(8),
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Emily Brown',
                'penjualan_kode' => 'TRX004',
                'penjualan_tanggal' => Carbon::now()->subDays(7),
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 2,
                'pembeli' => 'Chris Evans',
                'penjualan_kode' => 'TRX005',
                'penjualan_tanggal' => Carbon::now()->subDays(6),
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Sarah Connor',
                'penjualan_kode' => 'TRX006',
                'penjualan_tanggal' => Carbon::now()->subDays(5),
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 1,
                'pembeli' => 'Bruce Wayne',
                'penjualan_kode' => 'TRX007',
                'penjualan_tanggal' => Carbon::now()->subDays(4),
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 2,
                'pembeli' => 'Diana Prince',
                'penjualan_kode' => 'TRX008',
                'penjualan_tanggal' => Carbon::now()->subDays(3),
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 1,
                'pembeli' => 'Clark Kent',
                'penjualan_kode' => 'TRX009',
                'penjualan_tanggal' => Carbon::now()->subDays(2),
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Tony Stark',
                'penjualan_kode' => 'TRX010',
                'penjualan_tanggal' => Carbon::now()->subDay(),
            ]
        ];

        // Inserting the data into the 't_penjualan' table
        DB::table('t_penjualan')->insert($data);
    }
}
