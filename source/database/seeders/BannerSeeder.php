<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\File;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Process the logo image
        $bannerImagePath = public_path('frontend/assets/images/banner/banner-2.jpg');
        $banner_url = $this->processImage($bannerImagePath);

        Banner::create([

            'heading' => 'Create Lasting Wealth Through Sprinix',
            'subheading' => 'Amet consectetur adipisicing elit sed do eiusmod.',
            'banner' => $banner_url
        ]);
    }

    private function processImage($imagePath)
    {
        $image = File::get($imagePath);
        $name_gen = hexdec(uniqid()) . '.png';
        File::put(public_path('frontend/assets/images/banner' . $name_gen), $image);
        return 'frontend/assets/images/banner' . $name_gen;
    }
}
