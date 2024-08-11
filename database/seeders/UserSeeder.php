<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nicholas Antonius',
            'email' => 'nicholasantonius46@gmail.com',
            'password' => '$2y$12$yDJrwkdLGTfh9lJ9LZ60Ge1mZHi4dvI9pzDuEmv9..CVAdeb0XUKG', // Password yang sudah di-hash
        ]);
    }
}
