<?php

namespace Database\Factories;

use App\Models\Pasien;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{

    protected $model = Pasien::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElements(['laki-laki', 'perempuan'])[0];

        return [
            'idpasien' => $this->faker->randomDigit,
            'namapasien' => $this->faker->name,
            'jk' => $gender,
            'tanggallahir' => $this->faker->date($format ='Y-m-d', $max ='now'),
            'nohp' => $this->faker->numberBetween(8000,9000),
            'email' => $this->faker->safeEmail,
            'alamat' => $this->faker->address
        ];
    }
}
