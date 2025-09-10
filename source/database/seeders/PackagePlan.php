<?php

namespace Database\Seeders;
use App\Models\package_plan_setting;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PackagePlan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTime = now();

        package_plan_setting::insert([
            // Basic
            [
                'package_name' => 'Basic',
                'package_credits' => 1,
                'package_amount' => 0,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ],
            // Business
            [
                'package_name' => 'Business',
                'package_credits' => 3,
                'package_amount' => 20,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ],
            // Professional
            [
                'package_name' => 'Professional',
                'package_credits' => 10,
                'package_amount' => 50,
                'created_at' => $currentTime,
                'updated_at' => $currentTime,
            ]
        ]);
    }
}
