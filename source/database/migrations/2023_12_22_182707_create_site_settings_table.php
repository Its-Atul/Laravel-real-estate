<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('side_header_logo')->nullable();
            $table->string('footer_logo')->nullable();
            $table->string('favicon')->nullable();
            $table->string('support_phone')->nullable();
            $table->text('company_address')->nullable();
            $table->string('company_name')->nullable();
            $table->string('currency_symbol',5)->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('youtube')->nullable();
            $table->string('open_timming')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
