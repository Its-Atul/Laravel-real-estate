<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $about = 'Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt ut labore dolore magna aliqua enim ad minim venitam.Quis nostrud exercita laboris nisi ut aliquip commodo.';

         // Process the logo image
         $logoImagePath = public_path('frontend/assets/images/logo.png');
         $save_url = $this->processImage($logoImagePath);

         // Process the side header logo image
         $sideHeaderImagePath = public_path('frontend/assets/images/logo-2.png');
         $save_side_url = $this->processImage($sideHeaderImagePath);

         // Process the footer logo image
         $footerImagePath = public_path('frontend/assets/images/footer-logo.png');
         $save_footer_url = $this->processImage($footerImagePath);

        SiteSetting::create([
            'support_phone' => '1800962312',
            'company_address' => 'B-1/24, Bara Chandganj, Kapoorthala, Sec- A, Aliganj, Lucknow (UP), India',
            'company_name' => 'Sprinix',
            'open_timming' => 'Mon - Sat 9.00 - 18.00',
            'website' => 'https://www.sprinix.com/',
            'email' => 'info@example.com',
            'facebook' => 'https://www.facebook.com/',
            'about' => $about,
            'instagram' => 'https://www.instagram.com/',
            'youtube' => 'https://www.youtube.com/',
            'twitter' => 'https://twitter.com/i/flow/login',
            'logo' => $save_url,
            'footer_logo' => $save_footer_url,
            'side_header_logo' => $save_side_url,
            'latitude' => '-41.856123855533966',
            'longitude' => '146.69564281102788',
            'currency_symbol' => '$',
        ]);
    }

    private function processImage($imagePath)
    {
        $image = File::get($imagePath);
        $name_gen = hexdec(uniqid()) . '.png';
        File::put(public_path('upload/logo_image/' . $name_gen), $image);

        return 'upload/logo_image/' . $name_gen;
    }
}

