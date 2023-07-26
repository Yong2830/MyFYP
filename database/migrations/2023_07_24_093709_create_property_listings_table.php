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
        Schema::create('property_listings', function (Blueprint $table) {
            $table->string('property_id')->primary();
            $table->string('property_name');
            $table->string('property_address');
            $table->string('property_address_state');
            $table->string('property_postal');
            $table->string('property_description');
            $table->string('property_housing_type');
            $table->string('property_image1');
            $table->string('property_image2')->nullable();
            $table->string('property_image3')->nullable();
            $table->string('property_image4')->nullable();
            $table->string('property_image5')->nullable();
            $table->string('property_type');
            $table->integer('property_number_room');
            $table->string('property_room_type')->nullable();
            $table->string('property_rental_status')->default('Vacant');
            $table->string('property_posting_status')->default('Pending');
            $table->double('property_price');
            $table->date('property_post_date');
            $table->date('property_updated_date')->nullable();
            $table->string('property_feature');
            $table->string('reject_reason')->nullable();
            $table->string('advertiser_id');
            $table->foreign('advertiser_id')->references('advertiser_id')->on('advertisers');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_listings');
    }
};
