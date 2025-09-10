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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('ptype_id');
            $table->string('amenities_id');
            $table->string('property_name');
            $table->string('property_slug');
            $table->string('property_code');
            $table->string('property_status');
            $table->string('lowest_price')->nullable();
            $table->string('max_price')->nullable();
            $table->string('property_thambnail');
            $table->text('short_descp')->nullable();
            $table->text('long_descp')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('garage')->nullable();
            $table->string('garage_size')->nullable();
            $table->string('property_size')->nullable();
            $table->string('property_video')->nullable();

            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id')->references('id')->on('countries');

            $table->unsignedBigInteger('state_id');
            $table->foreign('state_id')->references('id')->on('states');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');

            $table->unsignedBigInteger('local_area_id');
            $table->foreign('local_area_id')->references('id')->on('local_areas');

            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('featured')->nullable();
            $table->string('hot')->nullable();
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id')->references('id')->on('users');
            $table->string('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
