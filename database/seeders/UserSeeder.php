<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
    User::create([
        'name' => 'Nama Kamu',
        'email' => 'emailbaru@gmail.com', // Ganti dengan email baru
        'password' => Hash::make('passwordbaru123'), // Ganti dengan password baru
    ]);
}
}