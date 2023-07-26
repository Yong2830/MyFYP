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
        Schema::create('deactivated_advertiser', function (Blueprint $table) {
            $table->string('deactivated_advertiser_id')->primary();
            $table->date('deactivated_date')->default(now());
            $table->string('deactivated_reason');
            $table->string('advertiser_id');
            $table->foreign('advertiser_id')->references('advertiser_id')->on('advertisers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deactivated_advertiser');
    }
};
