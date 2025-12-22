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
        Schema::create('species_synonyms', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('species_id');
            $table->string('spcies')->nullable();
            $table->string('genus')->nullable();
            $table->string('author')->nullable();
            $table->string('publication')->nullable();
            $table->string('volume')->nullable();
            $table->integer('page')->nullable();
            $table->year('year_described')->nullable();
            $table->boolean('is_infra')->default(false);
            $table->json('infra_values')->nullable();
            $table->boolean('is_in')->default(false);
            $table->json('in_author')->nullable();

            $table->foreign('species_id')->references('id')->on('species')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('species_synonyms');
    }
};
