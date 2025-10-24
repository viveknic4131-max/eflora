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
        Schema::create('genera', function (Blueprint $table) {
            $table->id();
            $table->uuid('genus_code')->unique();
            $table->string('name');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('family_id');
            $table->foreign('family_id')->references('id')->on('families')->onDelete('cascade');
            $table->unsignedBigInteger('volume_id');
            $table->foreign('volume_id')->references('id')->on('volumes')->onDelete('cascade');
              $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genera');
    }
};
