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
        Schema::create('reminders', function (Blueprint $table) {
            $table->string('reminder_id')->primary();
            $table->double('original_price');
            $table->double('desired_price')->nullable();
            $table->string('price_change_indicator')->nullable();
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants');
            $table->string('property_id');
            $table->foreign('property_id')->references('property_id')->on('property_listings');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reminders');
    }
};
