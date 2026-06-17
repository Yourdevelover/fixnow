<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technician_applications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // ← INI YANG DITAMBAH — service_id wajib ada
            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('specialist');   // auto-filled dari service_name
            $table->integer('experience');  // dalam tahun
            $table->text('description')->nullable();

            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technician_applications');
    }
};