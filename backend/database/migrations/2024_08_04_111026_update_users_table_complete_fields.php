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
        Schema::table('users', function (Blueprint $table) {
            $table->text('mp')->nullable();
            $table->text('provinsi')->nullable();
            $table->text('kabupaten')->nullable();
            $table->text('kecamatan')->nullable();
            $table->text('kelurahan')->nullable();
            $table->integer('member_type')->nullable();
            $table->text('family_id')->nullable();
            
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
