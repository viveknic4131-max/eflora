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
           $table->json('state_ids')->nullable()->before('deleted_at');
            $table->boolean('is_infra')->default(false);
            $table->json('infra_values')->nullable();
            $table->boolean('is_in')->default(false);
            $table->json('in_author')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('species', function (Blueprint $table) {
           $table->dropColumn([
            'state_ids',
            'is_infra',
            'infra_values',
            'is_in',
            'in_author',
        ]);
        });
    }
};
