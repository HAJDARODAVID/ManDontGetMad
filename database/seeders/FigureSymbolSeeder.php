<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FigureSymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('figure_symbol')->insert([
            [
                'name' => 'MALTESE CROSS',
                'code' => '&#10016;',
            ],
            [
                'name' => 'GEAR',
                'code' => '&#9881;',
            ],
            [
                'name' => 'HAMMER AND SICKLE',
                'code' => '&#9773;',
            ],
            [
                'name' => 'TAPE DRIVE',
                'code' => '&#9991;',
            ],
        ]);
    }
}
