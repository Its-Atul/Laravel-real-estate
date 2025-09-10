<?php

namespace Database\Seeders;

use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PrivacyPolicyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $text = "This is your dummy Privacy Policy content. You can replace this with the actual Privacy Policy text for your real estate site.";

        PrivacyPolicy::create([
            'privacy_policy' => $text
        ]);
    }

}
