<?php

namespace Database\Seeders;

use App\Models\Vendedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendedorSeeder extends Seeder
{
    public function run(): void
    {
        Vendedor::factory()->count(10)->create();
    }
}
