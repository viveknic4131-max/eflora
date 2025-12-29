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
          $table->dropColumn([
                'is_in',
                'common_name',
                'synonyms',
                'description',
            ]);


            $table->string('in_author', 255)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('species', function (Blueprint $table) {
            $table->boolean('is_in')->default(false);
            $table->string('common_name')->nullable();
            $table->text('synonyms')->nullable();
            $table->text('description')->nullable();

            // revert in_author back to json
            $table->json('in_author')->nullable()->change();
        });
    }
};
