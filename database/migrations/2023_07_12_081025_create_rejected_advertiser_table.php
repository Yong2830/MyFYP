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
        Schema::create('rejected_advertiser', function (Blueprint $table) {
            $table->string('rejected_advertiser_id')->primary();
            $table->date('rejected_date')->default(now());
            $table->string('rejected_reason');
            $table->string('advertiser_id');
            $table->foreign('advertiser_id')->references('advertiser_id')->on('advertisers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejected_advertiser');
    }
};
