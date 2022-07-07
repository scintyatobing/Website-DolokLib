<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_id' => $this->faker->numberBetween(1, 10),
            'isbn' => $this->faker->bothify('isbn-###-####-####'),
            'judul' => $this->faker->realText(20, 1),
            'pengarang' =>  $this->faker->name(),
            'penerbit' => $this->faker->name(),
            'jumlah_halaman' =>  $this->faker->numberBetween(15, 300),
            'tahun_terbit' =>  $this->faker->numberBetween(1990, 2022),
            'foto' =>  $this->faker->imageUrl('200','200','cats', true, 'Faker', true),
            'status' =>  $this->faker->randomElement(['tersedia' ,'dipinjam']),
            'edisi_buku' =>  $this->faker->randomElement(['baru' ,'bekas']),
            'created_by' =>  $this->faker->numberBetween(1, 10),
            'updated_by' => $this->faker->numberBetween(1, 10),
            'created_at' =>  now(),
            'updated_at' =>  now(),
        ];
    }
}
