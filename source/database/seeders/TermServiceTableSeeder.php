<?php

namespace Database\Seeders;

use App\Models\TermService;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TermServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $termServiceText = "This is your dummy Term of Service content. You can replace this with the actual Terms of Service text for your real estate site.";

        TermService::create([
            'term_service' => $termServiceText,
        ]);
    }
}
