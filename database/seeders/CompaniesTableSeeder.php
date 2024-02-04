<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyNames = [
            "المزرعة الشاملة", // The Comprehensive Farm
            "بساتين الخير", // Orchards of Goodness
            "موائد الطبيعة", // Nature's Tables
            "الغذاء الطازج", // Fresh Food
            "أسواق الفلاح" // The Farmer's Markets
        ];
        foreach ($companyNames as $companyName) {
            Company::create([
                'name' => $companyName,
                'slug' => Str::slug($companyName),
            ]);
        }
    }
}
