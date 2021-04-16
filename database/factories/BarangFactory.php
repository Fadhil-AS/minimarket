<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Produk;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class BarangFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Barang::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_barang' => "K".sprintf('%08d', $this->faker->unique()->numberBetween(1, 99999999)),
            'produk_id' => $this->faker->randomElement(Produk::select('id')->get()),
            'nama_barang' => $this->faker->randomElement(['Mie Sedap Ayam Bawang', 'Sabun Lifebuoy']),
            'satuan' => $this->faker->randomElement(['pcs', 'item', 'kardus']),
            'harga_jual' => $this->faker->numberBetween(1000, 100000),
            'stok' => $this->faker->numberBetween(1, 1000),
            'users_id' => '1'
        ];
    }
}
