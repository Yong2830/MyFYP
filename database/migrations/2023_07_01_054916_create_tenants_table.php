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
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('tenant_id', 7)->primary();
            $table->string('tenant_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('tenant_status', 15)->default('Activated');
            $table->string('tenant_contact', 15);
            $table->date('tenant_DOB');
            $table->date('registration_date')->default(now());
            $table->string('registration_status', 15)->default('Success');
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
