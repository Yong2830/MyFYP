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
        Schema::create('restrict_word', function (Blueprint $table) {
            $table->string('word_id')->primary();
            $table->string('word_name');
            $table->string('administrator_id');
            $table->foreign('administrator_id')->references('administrator_id')->on('administrators');
                 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restrict_word');
    }
};
