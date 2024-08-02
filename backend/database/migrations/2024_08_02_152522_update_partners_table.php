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
        //
        Schema::table('partners', function (Blueprint $table) {
            $table->text('provinsi')->nullable();
            $table->text('kabupaten')->nullable();
            $table->text('kecamatan')->nullable();
            $table->text('kelurahan')->nullable();
            $table->integer('legal_entity')->nullable(); // 0 = UD, 1 = CV, 2 = PT, 3 = Sekolah, 4 = Paroki
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};