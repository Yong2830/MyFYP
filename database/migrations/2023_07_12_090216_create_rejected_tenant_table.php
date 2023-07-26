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
        Schema::create('rejected_tenant', function (Blueprint $table) {
            $table->string('rejected_tenant_id')->primary();
            $table->date('rejected_date')->default(now());
            $table->string('rejected_reason');
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rejected_tenant');
    }
};
