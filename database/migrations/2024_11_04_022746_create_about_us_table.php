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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('mission');
            $table->string('mission_title');
            $table->text('mission_desc');
            $table->string('mission_image');
            $table->string('why_us_title');
            $table->text('why_us_desc');
            $table->string('why_us_image');
            $table->string('total_project')->nullable();
            $table->string('total_vendor')->nullable();
            $table->string('team_members')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};