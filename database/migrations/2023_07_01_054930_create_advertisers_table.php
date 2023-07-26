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
        Schema::create('advertisers', function (Blueprint $table) {
            $table->string('advertiser_id', 7)->primary();
            $table->string('advertiser_name', 50);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->string('advertiser_status', 15)->default('Activated');
            $table->string('advertiser_contact', 15);
            $table->date('advertiser_DOB');
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
        Schema::dropIfExists('advertisers');
    }
};
