<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FiguresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('figures')->insert([
            [
                'color' => 'ff0000',
                'alias' => 'red',
            ],
            [
                'color' => '51ff00',
                'alias' => 'green',
            ],
            [
                'color' => '2529ff',
                'alias' => 'blue',
            ],
            [
                'color' => 'ff29f4',
                'alias' => 'pink',
            ],
            [
                'color' => '12da97',
                'alias' => 'turquoise',
            ],
            [
                'color' => 'fae62f',
                'alias' => 'yellow',
            ],
            ]);
    }
}
