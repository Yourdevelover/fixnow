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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->foreignId('technician_id')
                ->nullable()
                ->constrained('technicians')
                ->nullOnDelete();

            $table->foreignId('service_id')
                ->constrained()
                ->onDelete('cascade');

            $table->text('address');

            $table->text('problem_description');

            $table->integer('price');

            $table->enum(
                'status',
                [
                    'pending',
                    'process',
                    'completed',
                    'cancelled'
                ]
            )->default('pending');

           $table->enum(
                'payment_status',
                ['paid','unpaid']
            )->default('unpaid');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
