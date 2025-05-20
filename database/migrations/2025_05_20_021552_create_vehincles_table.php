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
        Schema::create('vehincles', function (Blueprint $table) {
            $table->id();
            $table->string('plate_number')->unique();
            $table->enum('type', ['angkutan_orang', 'angkutan_barang']);
            $table->string('brand');
            $table->string('model')->nullable();
            $table->enum('ownership', ['milik', 'sewa']);
            $table->enum('fuel_type', ['bensin', 'solar', 'listrik'])->default('bensin');
            $table->enum('status', ['tersedia', 'dipesan', 'servis'])->default('tersedia');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehincles');
    }
};
