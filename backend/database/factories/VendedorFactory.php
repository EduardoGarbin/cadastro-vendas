<?php

namespace Database\Factories;

use App\Models\Vendedor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendedorFactory extends Factory
{
    protected $model = Vendedor::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
