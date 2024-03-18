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
        Schema::create('booking_calendar_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('cal_name');
            $table->string('cal_email');
            $table->integer('cal_contact');
            $table->time('cal_from_time');
            $table->time('cal_to_time');
            $table->integer('cal_guest');
            $table->text('cal_message');
            $table->string('booking_number');
            $table->tinyInteger('email_verified');
            $table->tinyInteger('booking_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_calendar_tasks');
    }
};
