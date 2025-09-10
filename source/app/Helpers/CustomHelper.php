<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

if (! function_exists('removeImage')) {
    function removeImage($filePath)
    {
            if (File::exists(public_path($filePath))) {
                File::delete(public_path($filePath));
            }
    }
}

if (! function_exists('processFaviconImage')) {
    function processFaviconImage($image, $width, $height)
    {
            $name_gen = 'fevicon'.'.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize($width, $height);
            $image->toPng()->save('upload/fevicon/' . $name_gen);
            return 'upload/fevicon/' . $name_gen;
    }
}

if (! function_exists('processLogoImage')) {
    function processLogoImage($image, $width, $height)
    {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize($width, $height);
            $image->toPng()->save('upload/logo_image/' . $name_gen);
            return 'upload/logo_image/' . $name_gen;
    }
}

if (! function_exists('processPropertyImage')) {
    function processPropertyImage($image, $width, $height)
    {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize($width, $height);
            $image->toPng()->save('upload/property/thambnail/' . $name_gen);
            return 'upload/property/thambnail/' . $name_gen;
    }
}

if (! function_exists('processMultiPropertyImage')) {
    function processMultiPropertyImage($image, $width, $height)
    {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize($width, $height);
            $image->toPng()->save('upload/property/multi-image/' . $name_gen);
            return 'upload/property/multi-image/' . $name_gen;
    }
}

if (! function_exists('processBannerImage')) {
    function processBannerImage($image, $width, $height)
    {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $image = $manager->read($image)->resize($width, $height);
            $image->toPng()->save('frontend/assets/images/' . $name_gen);
            return 'frontend/assets/images/' . $name_gen;
    }
}
