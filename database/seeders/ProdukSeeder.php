<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk')->insert([
            'nama_produk' => 'Mie Sedap Ayam Bawang'
        ]);
        DB::table('produk')->insert([
            'nama_produk' => 'Sabun Lifebuoy'
        ]);
    }
}
