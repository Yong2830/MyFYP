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
        Schema::create('administrators', function (Blueprint $table) {
            $table->string('administrator_id', 7)->primary();
            $table->string('administrator_name', 50);
            $table->string('email', 100)->unique;
            $table->string('password');
            $table->string('administrator_contact', 15);
            $table->date('administrator_DOB');
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
        Schema::dropIfExists('administrators');
    }
};
