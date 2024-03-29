<?php

namespace Database\Factories;

use App\Models\Pemasok;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PemasokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemasok::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kode_pemasok' => $this->faker->numberBetween(1000, 100000),
            'nama_pemasok' => $this->faker->company,
            'alamat' => $this->faker->address,
            'kota' => $this->faker->city,
            'no_telp' => $this->faker->phoneNumber
        ];
    }
}
