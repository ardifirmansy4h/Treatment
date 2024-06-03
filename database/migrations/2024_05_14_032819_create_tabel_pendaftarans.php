<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->integer('usia');
            $table->string('alamat');
            $table->string('jenis_treatment');
            $table->string('keterangan');
            $table->integer('dp');
            $table->date('tgl_pembayaran_dp');
            $table->integer('sisa_pembayaran')->nullable();
            $table->date('tgl_pembayaran_sisa')->nullable();
            $table->unsignedBigInteger('slot_id');
            $table->string('status');
            $table->timestamps();

            $table->foreign('slot_id')->references('id')->on('slot');
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
