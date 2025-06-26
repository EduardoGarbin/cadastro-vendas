<?php

namespace Database\Factories;

use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'vendedor_id' => Vendedor::inRandomOrder()->first()?->id ?? Vendedor::factory(),
            'valor' => $this->faker->randomFloat(2, 100, 10000),
            'data' => $this->faker->dateTimeBetween('-1 month', 'now')->format('Y-m-d'),
        ];
    }
}
