<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('DEFAULT_USER_EMAIL')],
            [
                'name' => 'Usuário Admin',
                'password' => bcrypt(env('DEFAULT_USER_PASSWORD')),
            ]
        );
    }
}
