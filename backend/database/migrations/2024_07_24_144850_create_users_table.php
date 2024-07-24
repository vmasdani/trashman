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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('username')->nullable();
            $table->text('password')->nullable();
            $table->text('email')->nullable();
            $table->text('phone')->nullable();
            $table->integer('role')->nullable(); // 1=admin, 2=operator
            $table->integer('gender')->nullable(); // 1=male, 2=female
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();

            $table->timestamps();

            $table->dateTime('deleted_at')->nullable();
            $table->integer('ordering')->nullable();
            $table->text('uuid')->nullable();
            $table->bigInteger('created_by')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
