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
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->string('chat_message_id')->primary();
            $table->string('chat_message_content');
            $table->dateTime('chat_message_timestamp');
            $table->string('sender_id');
            $table->string('receiver_id');
            $table->string('chat_list_id');
            $table->foreign('chat_list_id')->references('chat_list_id')->on('chat_lists');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_histories');
    }
};
