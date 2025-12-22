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
        Schema::table('species', function (Blueprint $table) {
            $table->drop()->column('description');
            $table->drop()->column('common_name');
            $table->drop()->column('synonyms');

            $table->bigInteger('species_synonym_id')->nullable()->after('id');
            $table->foreign('species_synonym_id')->references('id')->on('species_synonyms')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('species', function (Blueprint $table) {
            $table->string('description')->nullable();
            $table->string('common_name')->nullable();
            $table->json('synonyms')->nullable();

            $table->dropForeign(['species_synonym_id']);
            $table->dropColumn('species_synonym_id');
        });
    }
};
