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
        Schema::create('applicant_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('criteria_id');
            $table->unsignedBigInteger('sub_criteria_id')->nullable();
            $table->integer('raw_score');
            $table->decimal('weighted_score', 5, 2);

            $table->foreign('application_id')->references('id')->on('applications')->onDelete('cascade');
            $table->foreign('criteria_id')->references('id')->on('criteria')->onDelete('cascade');
            $table->foreign('sub_criteria_id')->references('id')->on('sub_criteria')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicant_scores');
    }
};