<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'name' => 'مؤكد'],
            ['id' => 2, 'name' => 'غير مؤكد'],
            ['id' => 3, 'name' => 'في الطريق'],
            ['id' => 4, 'name' => 'تم الاستلام'],
            ['id' => 5, 'name' => 'ملغي'],
        ];

        foreach ($statuses as $status) {
            DB::table('order_statuses')->updateOrInsert(['id' => $status['id']], $status);
        }
    }
}
