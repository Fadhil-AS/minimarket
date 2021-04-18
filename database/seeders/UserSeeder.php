<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        $data = [
            'name' => 'Muhammad Fadhil Ardiansyah S',
            'email' => 'mfadhil@test.com',
            'password' => Hash::make('fadhil123'),
            'level' => 'admin'
        ];
        DB::table('users')->insert($data);
    }
}
