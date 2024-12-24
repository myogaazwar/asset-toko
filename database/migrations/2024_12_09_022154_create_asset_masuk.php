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
        Schema::create('asset_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('kodemasuk');
            $table->string('kodeasset');
            $table->foreign('kodeasset')->references('kodeasset')->on('assets');
            $table->date('tanggal');
            $table->integer('qty');
            $table->double('hrgtotal', 15, 2);
            $table->enum('statusmasuk', ['PROCESS', 'APPROVED']);
            $table->timestamp('tgl_input')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('asset_masuk');
    }
};
