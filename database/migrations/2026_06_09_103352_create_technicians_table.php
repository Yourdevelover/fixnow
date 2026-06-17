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
        Schema::create('technicians', function (Blueprint $table) {

            $table->id();

            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('restrict');

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('specialist');

            $table->integer('experience');

            $table->float('rating')
                ->default(0);

            $table->enum('availability_status',[
                'available',
                'busy'
            ])->default('available');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
