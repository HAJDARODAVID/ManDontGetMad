<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'Game board',
            'email' => 'gameborad@gmail.com',
            'password' =>Hash::make('123'),
            'type' => '0'
        ],
        [
            'name' => 'David',
            'email' => 'david@gmail.com',
            'password' =>Hash::make('123'),
            'type' => '1'
        ],
        [
            'name' => 'Dominik',
            'email' => 'dominik@gmail.com',
            'password' =>Hash::make('123'),
            'type' => '1'
        ]
        ]);
    }
}
