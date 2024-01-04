<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class seeder1 extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        factory(Category::class, 5)->create();
    }
}
