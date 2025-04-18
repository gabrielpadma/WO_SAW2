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
        Schema::create('wedding_packages', function (Blueprint $table) {
            $table->id();
            $table->string('package_title');
            $table->decimal('price', 10, 2);
            $table->json('features')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_recommend');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wedding_packages');
    }
};
