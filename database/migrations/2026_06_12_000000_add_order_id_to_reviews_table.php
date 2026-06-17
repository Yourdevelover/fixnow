<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Add order_id column if it doesn't exist
            if (!Schema::hasColumn('reviews', 'order_id')) {
                $table->foreignId('order_id')
                    ->nullable()
                    ->after('technician_id')
                    ->constrained()
                    ->onDelete('cascade');
            }

            // comment nullable
            $table->text('comment')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->text('comment')->nullable(false)->change();
        });
    }
};