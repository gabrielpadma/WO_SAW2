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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('service_title');
            $table->text('service_desc');
            $table->string('icon_service_1')->nullable();
            $table->string('service_text_1')->nullable();
            $table->string('icon_service_2')->nullable();
            $table->string('service_text_2')->nullable();
            $table->string('icon_service_3')->nullable();
            $table->string('service_text_3')->nullable();
            $table->string('icon_service_4')->nullable();
            $table->string('service_text_4')->nullable();
            $table->string('icon_service_5')->nullable();
            $table->string('service_text_5')->nullable();
            $table->string('icon_service_6')->nullable();
            $table->string('service_text_6')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
