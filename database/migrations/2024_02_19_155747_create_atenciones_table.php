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
        Schema::create('atenciones', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->rut()->index();
            $table->string('names');
            $table->string('lastname_1');
            $table->string('lastname_2')->nullable();
            $table->foreignId('sector_id');
            $table->string('phone')->nullable();
            $table->string('nationality')->default('CL');
            $table->foreignId('tramite_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atenciones');
    }
};
