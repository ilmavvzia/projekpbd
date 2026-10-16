<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SatuanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['nama_satuan' => 'Pcs', 'status' => 1],
            ['nama_satuan' => 'Box', 'status' => 1],
            ['nama_satuan' => 'Botol', 'status' => 1],
        ];

        foreach ($data as $item) {
            DB::table('satuan')->updateOrInsert(
                ['nama_satuan' => $item['nama_satuan']],
                ['status' => $item['status']]
            );
        }
    }
}
