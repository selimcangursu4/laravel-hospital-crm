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
        Schema::create('surgery_appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->dateTime('scheduled_at');
            $table->integer('doctor_id');
            $table->integer('surgery_type_id');
            $table->integer('operation_room_id');
            $table->integer('status_id');
            $table->text('notes')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surgery_appointments');
    }
};
