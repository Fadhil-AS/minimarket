<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Factory;
use App\Models\Pemasok;
use Illuminate\Support\Str;

class PemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pemasok::factory(10)->create();
    }
}
