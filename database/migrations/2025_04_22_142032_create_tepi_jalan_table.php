<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('tepi_jalan', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('node_awal');
        $table->unsignedBigInteger('node_tujuan');
        $table->float('jarak');
        $table->timestamps();
    
        // Pastikan nama tabel target benar: 'pos_damkars' (bukan 'pos_damkar')
        $table->foreign('node_awal')->references('id')->on('pos_damkars')->onDelete('cascade');
        $table->foreign('node_tujuan')->references('id')->on('pos_damkars')->onDelete('cascade');
    });
    
    
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tepi_jalan');
    }
};
