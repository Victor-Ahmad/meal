<?php

namespace Database\Seeders;

use App\Models\Offer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Offer::factory()->count(10)->create();
    }
}
