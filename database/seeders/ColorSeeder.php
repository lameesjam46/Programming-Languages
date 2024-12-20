<?php

namespace Database\Seeders;

use App\Models\color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        color::query()->create([
            'nameColor'=>'red',
        ]);
        color::query()->create([
            'nameColor'=>'green',
        ]);
        color::query()->create([
            'nameColor'=>'blue',
        ]);
        color::query()->create([
            'nameColor'=>'yellow',
        ]);

    }
}
