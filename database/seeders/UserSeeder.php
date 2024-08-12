<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'amer mohy',
            'email' => 'amermohy10@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '01017038123',
        ]);

        DB::table('users')->insert([
            'name' => 'amer',
            'email' => 'amer10@gmail.com',
            'password' => Hash::make('password'),
            'phone_number' => '01117468950',
        ]);
    }
}
