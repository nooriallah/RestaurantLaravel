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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('table_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            
            $table->string("full_name");
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('special_requests')->nullable();
            $table->dateTime('reservation_time');
            $table->integer('number_of_guests')->default(2);
            $table->string('status')->default('pending'); // e.g., pending, reserved, cancelled

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
