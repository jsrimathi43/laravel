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
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->id();
            $table->tinyText('delivery_collection_time');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->unsignedBigInteger('billing_country_id');
            $table->foreign('billing_country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('billing_state_id');
            $table->foreign('billing_state_id')->references('id')->on('states');
            $table->unsignedBigInteger('billing_city_id');
            $table->foreign('billing_city_id')->references('id')->on('cities');
            $table->string('billing_street');
            $table->string('billing_zip_code');
            $table->string('billing_phone_number');

            $table->unsignedBigInteger('shipping_country_id')->nullable();
            $table->foreign('shipping_country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('shipping_state_id')->nullable();
            $table->foreign('shipping_state_id')->references('id')->on('states');
            $table->unsignedBigInteger('shipping_city_id')->nullable();
            $table->foreign('shipping_city_id')->references('id')->on('cities');
            $table->string('shipping_street')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('shipping_phone_number')->nullable();

            $table->string('email_id');
            $table->string('delivery_time');
            $table->string('billing_first_name');
            $table->string('billing_last_name');
            $table->string('shipping_first_name')->nullable();
            $table->string('shipping_last_name')->nullable();
            $table->longText('notes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_addresses');
    }
};
