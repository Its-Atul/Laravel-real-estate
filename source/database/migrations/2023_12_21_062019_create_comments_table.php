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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsinged();
            $table->integer('post_id')->unsinged();
            $table->integer('parent_id')->unsinged()->nullable();
            $table->text('subject')->nullable();
            $table->text('message');
            $table->enum('status',['reply',['unreply']])->default('unreply');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
