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
        Schema::create('patient_call_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id');
            $table->enum('call_type', ['incoming', 'outgoing']);
            $table->integer('call_duration')->nullable(); // Saniye cinsinden arama süresi
            $table->enum('call_status', ['completed', 'missed', 'failed']); // Arama durumu
            $table->integer('called_by'); // Aramayı yapan kullanıcı
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_call_logs');
    }
};
