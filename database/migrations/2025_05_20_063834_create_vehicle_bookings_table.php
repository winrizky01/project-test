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
        Schema::create('vehicle_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // pemesan
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('driver_id');
            $table->text('location')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('destination');
            $table->foreignId('approval_level_1')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('approval_level_2')->nullable()->constrained('users')->onDelete('set null');
            $table->enum('status', ['pending', 'approved_level_1', 'approved', 'rejected'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_bookings');
    }
};
