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
        Schema::create('chat_lists', function (Blueprint $table) {
            $table->string('chat_list_id');
            $table->string('tenant_id');
            $table->foreign('tenant_id')->references('tenant_id')->on('tenants');
            $table->string('advertiser_id');
            $table->foreign('advertiser_id')->references('advertiser_id')->on('advertisers');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_lists');
    }
};
