<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Pending'],
            ['name' => 'Processing'],
            ['name' => 'Shipped'],
            ['name' => 'Delivered'],
            ['name' => 'Cancelled'],
            ['name' => 'Refunded'],
        ];

        foreach ($statuses as $status) {
            DB::table('orderStatus')->insert($status);
        }
    }
}
