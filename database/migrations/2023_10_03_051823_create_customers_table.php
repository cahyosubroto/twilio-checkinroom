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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('booking_id');
            $table->string('country_code')->default('+62');
            $table->bigInteger('phone_number');
            $table->string('fiendly_phone');
            $table->string('room_number');
            $table->string('name');
            $table->string('room_passcode');
            $table->timestamp('checkin_date');
            $table->timestamp('checkout_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
