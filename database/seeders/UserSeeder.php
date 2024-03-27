<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            [
                'email' => "shovon@gmail.com"
            ],
            [
                'name' => "Shovon Dev",
                'email_verified_at' => now(),
                'password' => Hash::make('password')
            ]
        );
    }
}
