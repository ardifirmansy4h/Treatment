<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('jenis_treatment');

            $table->unsignedBigInteger('jenis_id')->after('alamat');
            $table->foreign('jenis_id')->references('id')->on('jenis');
        });
    }

    public function down(): void
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropForeign(['jenis_id']);
            $table->dropColumn('jenis_id');
            $table->string('jenis_treatment')->after('alamat');
        });
    }
};
