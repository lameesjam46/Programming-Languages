<?php

namespace Database\Seeders;

use App\Models\size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        size::query()->create([
            'size'=>'L',
        ]);
        size::query()->create([
            'size'=>'XL',
        ]);
        size::query()->create([
            'size'=>'XXL',
        ]);
        size::query()->create([
            'size'=>'M',
        ]);

    }
}
