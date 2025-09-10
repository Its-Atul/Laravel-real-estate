<?php

namespace Database\Seeders;

use App\Models\SmtpSetting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SmtpSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SmtpSetting::create([
            'mailer' => 'smtp',
            'host' => 'sandbox.smtp.mailtrap.io',
            'port' => '2525',
            'username' => 'f129311ef43535',
            'password' => 'c7cb06dec6d7c0',
            'encryption' => 'tls',
            'from_address' => 'realstate@support.com',
        ]);
    }
}
