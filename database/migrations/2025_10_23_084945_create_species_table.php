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
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->uuid('species_code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('genus_id');
            $table->unsignedBigInteger('family_id');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->foreign('genus_id')->references('id')->on('genera')->onDelete('cascade');
            $table->string('author')->nullable();
            $table->string('publication')->nullable();
            $table->year('year_described')->nullable();
            $table->string('volume')->nullable();
            $table->string('page')->nullable();
            $table->string('common_name')->nullable();
            // $table->string('distribution')->nullable();
            // $table->string('habitat')->nullable();
            $table->json('synonyms')->nullable();
              $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
