<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lead_files', function (Blueprint $table) {
            $table->id();
            $table->integer('lead_id');
            $table->string('file_path'); // Dosyanın storage yolu
            $table->string('original_name'); // Orijinal dosya adı
            $table->integer('uploaded_by');
            $table->timestamps(); // created_at ve updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_files');
    }
};

