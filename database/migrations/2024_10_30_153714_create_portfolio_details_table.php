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
        Schema::create('portfolio_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');

            $table->string('detail_image1')->nullable();
            $table->string('detail_image2')->nullable();
            $table->string('detail_image3')->nullable();
            $table->string('detail_image4')->nullable();
            $table->timestamps();
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_details');
    }
};