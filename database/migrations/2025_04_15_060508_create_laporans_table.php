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
    Schema::create('laporans', function (Blueprint $table) {
        $table->id();
        $table->string('nama_pelapor');
        $table->string('nama_lokasi');
        $table->text('keterangan');
        $table->string('foto')->nullable();
        $table->decimal('latitude', 10, 7);
        $table->decimal('longitude', 10, 7);
        $table->unsignedBigInteger('pos_damkar_id');
        $table->foreign('pos_damkar_id')
              ->references('id')
              ->on('pos_damkars')
              ->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
